<?php
/**
 * Copyright (C) 2014-2018 ServMask Inc.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * ███████╗███████╗██████╗ ██╗   ██╗███╗   ███╗ █████╗ ███████╗██╗  ██╗
 * ██╔════╝██╔════╝██╔══██╗██║   ██║████╗ ████║██╔══██╗██╔════╝██║ ██╔╝
 * ███████╗█████╗  ██████╔╝██║   ██║██╔████╔██║███████║███████╗█████╔╝
 * ╚════██║██╔══╝  ██╔══██╗╚██╗ ██╔╝██║╚██╔╝██║██╔══██║╚════██║██╔═██╗
 * ███████║███████╗██║  ██║ ╚████╔╝ ██║ ╚═╝ ██║██║  ██║███████║██║  ██╗
 * ╚══════╝╚══════╝╚═╝  ╚═╝  ╚═══╝  ╚═╝     ╚═╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝
 */

abstract class Ai1wm_Archiver {

	/**
	 * Filename including path to the file
	 *
	 * @type string
	 */
	protected $file_name = null;

	/**
	 * Handle to the file
	 *
	 * @type resource
	 */
	protected $file_handle = null;

	/**
	 * Header block format of a file
	 *
	 * Field Name    Offset    Length    Contents
	 * name               0       255    filename (no path, no slash)
	 * size             255        14    size of file contents
	 * mtime            269        12    last modification time
	 * prefix           281      4096    path name, no trailing slashes
	 *
	 * @type array
	 */
	protected $block_format = array(
		'a255',  // filename
		'a14',   // size of file contents
		'a12',   // last time modified
		'a4096', // path
	);

	/**
	 * End of file block string
	 *
	 * @type string
	 */
	protected $eof = null;

	/**
	 * Default constructor
	 *
	 * Initializes filename and end of file block
	 *
	 * @param string $file_name Archive file
	 * @param bool   $write     Read/write mode
	 */
	public function __construct( $file_name, $write = false ) {
		$this->file_name = $file_name;

		// Initialize end of file block
		$this->eof = pack( 'a4377', '' );

		// Open archive file
		if ( $write ) {
			// Open archive file for writing
			if ( ( $this->file_handle = @fopen( $file_name, 'cb' ) ) === false ) {
				throw new Ai1wm_Not_Accessible_Exception( sprintf( 'Unable to open file for writing. File: %s', $this->file_name ) );
			}

			// Seek to end of archive file
			if ( @fseek( $this->file_handle, 0, SEEK_END ) === -1 ) {
				throw new Ai1wm_Not_Seekable_Exception( sprintf( 'Unable to seek to end of file. File: %s', $this->file_name ) );
			}
		} else {
			// Open archive file for reading
			if ( ( $this->file_handle = @fopen( $file_name, 'rb' ) ) === false ) {
				throw new Ai1wm_Not_Accessible_Exception( sprintf( 'Unable to open file for reading. File: %s', $this->file_name ) );
			}
		}
	}

	/**
	 * Set current file pointer
	 *
	 * @param int $offset Archive offset
	 *
	 * @throws \Ai1wm_Not_Seekable_Exception
	 *
	 * @return void
	 */
	public function set_file_pointer( $offset ) {
		if ( @fseek( $this->file_handle, $offset, SEEK_SET ) === -1 ) {
			throw new Ai1wm_Not_Seekable_Exception( sprintf( 'Unable to seek to offset of file. File: %s Offset: %d', $this->file_name, $offset ) );
		}
	}

	/**
	 * Get current file pointer
	 *
	 * @throws \Ai1wm_Not_Tellable_Exception
	 *
	 * @return int
	 */
	public function get_file_pointer() {
		if ( ( $offset = @ftell( $this->file_handle ) ) === false ) {
			throw new Ai1wm_Not_Tellable_Exception( sprintf( 'Unable to tell offset of file. File: %s', $this->file_name ) );
		}

		return $offset;
	}

	/**
	 * Appends end of file block to the archive file
	 *
	 * @throws \Ai1wm_Not_Seekable_Exception
	 * @throws \Ai1wm_Not_Writable_Exception
	 * @throws \Ai1wm_Quota_Exceeded_Exception
	 *
	 * @return void
	 */
	protected function append_eof() {
		// Seek to end of archive file
		if ( @fseek( $this->file_handle, 0, SEEK_END ) === -1 ) {
			throw new Ai1wm_Not_Seekable_Exception( sprintf( 'Unable to seek to end of file. File: %s', $this->file_name ) );
		}

		// Write end of file block
		if ( ( $file_bytes = @fwrite( $this->file_handle, $this->eof ) ) !== false ) {
			if ( strlen( $this->eof ) !== $file_bytes ) {
				throw new Ai1wm_Quota_Exceeded_Exception( sprintf( 'Out of disk space. Unable to write end of block to file. File: %s', $this->file_name ) );
			}
		} else {
			throw new Ai1wm_Not_Writable_Exception( sprintf( 'Unable to write end of block to file. File: %s', $this->file_name ) );
		}
	}

	/**
	 * Replace forward slash with current directory separator
	 *
	 * @param string $path Path
	 *
	 * @return string
	 */
	protected function replace_forward_slash_with_directory_separator( $path ) {
		return str_replace( '/', DIRECTORY_SEPARATOR, $path );
	}

	/**
	 * Replace current directory separator with forward slash
	 *
	 * @param string $path Path
	 *
	 * @return string
	 */
	protected function replace_directory_separator_with_forward_slash( $path ) {
		return str_replace( DIRECTORY_SEPARATOR, '/', $path );
	}

	/**
	 * Escape Windows directory separator
	 *
	 * @param string $path Path
	 *
	 * @return string
	 */
	protected function escape_windows_directory_separator( $path ) {
		return preg_replace( '/[\\\\]+/', '\\\\\\\\', $path );
	}

	/**
	 * Validate archive file
	 *
	 * @return bool
	 */
	public function is_valid() {
		if ( ( $offset = @ftell( $this->file_handle ) ) !== false ) {
			if ( @fseek( $this->file_handle, -4377, SEEK_END ) !== -1 ) {
				if ( @fread( $this->file_handle, 4377 ) === $this->eof ) {
					if ( @fseek( $this->file_handle, $offset, SEEK_SET ) !== -1 ) {
						return true;
					}
				}
			}
		}

		return false;
	}

	/**
	 * Truncates the archive file
	 *
	 * @return void
	 */
	public function truncate() {
		if ( ( $offset = @ftell( $this->file_handle ) ) === false ) {
			throw new Ai1wm_Not_Tellable_Exception( sprintf( 'Unable to tell offset of file. File: %s', $this->file_name ) );
		}

		if ( @filesize( $this->file_name ) > $offset ) {
			if ( @ftruncate( $this->file_handle, $offset ) === false ) {
				throw new Ai1wm_Not_Truncatable_Exception( sprintf( 'Unable to truncate file. File: %s', $this->file_name ) );
			}
		}
	}

	/**
	 * Closes the archive file
	 *
	 * We either close the file or append the end of file block if complete argument is set to true
	 *
	 * @param  bool $complete Flag to append end of file block
	 *
	 * @return void
	 */
	public function close( $complete = false ) {
		// Are we done appending to the file?
		if ( true === $complete ) {
			$this->append_eof();
		}

		if ( @fclose( $this->file_handle ) === false ) {
			throw new Ai1wm_Not_Closable_Exception( sprintf( 'Unable to close file. File: %s', $this->file_name ) );
		}
	}
}
