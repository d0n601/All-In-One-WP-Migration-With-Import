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

class Ai1wm_File {

	/**
	 * Create a file with content
	 *
	 * @param  string $path    Path to the file
	 * @param  string $content Content of the file
	 * @return boolean
	 */
	public static function create( $path, $content ) {
		if ( ! @file_exists( $path ) ) {
			if ( ! @is_writable( dirname( $path ) ) ) {
				return false;
			}

			if ( ! @touch( $path ) ) {
				return false;
			}
		} elseif ( ! @is_writable( $path ) ) {
			return false;
		}

		$is_written = false;
		if ( ( $handle = @fopen( $path, 'w' ) ) !== false ) {
			if ( @fwrite( $handle, $content ) !== false ) {
				$is_written = true;
			}

			@fclose( $handle );
		}

		return $is_written;
	}

	/**
	 * Create a file with marker and content
	 *
	 * @param  string $path    Path to the file
	 * @param  string $marker  Name of the marker
	 * @param  string $content Content of the file
	 * @return boolean
	 */
	public static function create_with_markers( $path, $marker, $content ) {
		return @insert_with_markers( $path, $marker, $content );
	}
}
