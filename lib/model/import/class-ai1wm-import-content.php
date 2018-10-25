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

class Ai1wm_Import_Content {

	public static function execute( $params ) {

		// Set archive bytes offset
		if ( isset( $params['archive_bytes_offset'] ) ) {
			$archive_bytes_offset = (int) $params['archive_bytes_offset'];
		} else {
			$archive_bytes_offset = 0;
		}

		// Set file bytes offset
		if ( isset( $params['file_bytes_offset'] ) ) {
			$file_bytes_offset = (int) $params['file_bytes_offset'];
		} else {
			$file_bytes_offset = 0;
		}

		// Get processed files size
		if ( isset( $params['processed_files_size'] ) ) {
			$processed_files_size = (int) $params['processed_files_size'];
		} else {
			$processed_files_size = 0;
		}

		// Get total files size
		if ( isset( $params['total_files_size'] ) ) {
			$total_files_size = (int) $params['total_files_size'];
		} else {
			$total_files_size = 1;
		}

		// Get total files count
		if ( isset( $params['total_files_count'] ) ) {
			$total_files_count = (int) $params['total_files_count'];
		} else {
			$total_files_count = 1;
		}

		// Read blogs.json file
		$handle = ai1wm_open( ai1wm_blogs_path( $params ), 'r' );

		// Parse blogs.json file
		$blogs = ai1wm_read( $handle, filesize( ai1wm_blogs_path( $params ) ) );
		$blogs = json_decode( $blogs, true );

		// Close handle
		ai1wm_close( $handle );

		// What percent of files have we processed?
		$progress = (int) min( ( $processed_files_size / $total_files_size ) * 100, 100 );

		// Set progress
		Ai1wm_Status::info( sprintf( __( 'Restoring %d files...<br />%d%% complete', AI1WM_PLUGIN_NAME ), $total_files_count, $progress ) );

		// Flag to hold if file data has been processed
		$completed = true;

		// Start time
		$start = microtime( true );

		// Open the archive file for reading
		$archive = new Ai1wm_Extractor( ai1wm_archive_path( $params ) );

		// Set the file pointer to the one that we have saved
		$archive->set_file_pointer( $archive_bytes_offset );

		$old_paths = array();
		$new_paths = array();

		// Set extract paths
		foreach ( $blogs as $blog ) {
			if ( ai1wm_main_site( $blog['Old']['BlogID'] ) === false ) {
				if ( defined( 'UPLOADBLOGSDIR' ) ) {
					// Old sites dir style
					$old_paths[] = ai1wm_files_path( $blog['Old']['BlogID'] );
					$new_paths[] = ai1wm_files_path( $blog['New']['BlogID'] );

					// New sites dir style
					$old_paths[] = ai1wm_sites_path( $blog['Old']['BlogID'] );
					$new_paths[] = ai1wm_files_path( $blog['New']['BlogID'] );
				} else {
					// Old sites dir style
					$old_paths[] = ai1wm_files_path( $blog['Old']['BlogID'] );
					$new_paths[] = ai1wm_sites_path( $blog['New']['BlogID'] );

					// New sites dir style
					$old_paths[] = ai1wm_sites_path( $blog['Old']['BlogID'] );
					$new_paths[] = ai1wm_sites_path( $blog['New']['BlogID'] );
				}
			}
		}

		// Set base site extract paths (should be added at the end of arrays)
		foreach ( $blogs as $blog ) {
			if ( ai1wm_main_site( $blog['Old']['BlogID'] ) === true ) {
				if ( defined( 'UPLOADBLOGSDIR' ) ) {
					// Old sites dir style
					$old_paths[] = ai1wm_files_path( $blog['Old']['BlogID'] );
					$new_paths[] = ai1wm_files_path( $blog['New']['BlogID'] );

					// New sites dir style
					$old_paths[] = ai1wm_sites_path( $blog['Old']['BlogID'] );
					$new_paths[] = ai1wm_files_path( $blog['New']['BlogID'] );
				} else {
					// Old sites dir style
					$old_paths[] = ai1wm_files_path( $blog['Old']['BlogID'] );
					$new_paths[] = ai1wm_sites_path( $blog['New']['BlogID'] );

					// New sites dir style
					$old_paths[] = ai1wm_sites_path( $blog['Old']['BlogID'] );
					$new_paths[] = ai1wm_sites_path( $blog['New']['BlogID'] );
				}
			}
		}

		while ( $archive->has_not_reached_eof() ) {
			$file_bytes_written = 0;

			// Exclude WordPress files
			$exclude_files = array_keys( _get_dropins() );

			// Exclude plugin files
			$exclude_files = array_merge( $exclude_files, array(
				AI1WM_PACKAGE_NAME,
				AI1WM_MULTISITE_NAME,
				AI1WM_DATABASE_NAME,
				AI1WM_MUPLUGINS_NAME,
			) );

			// Extract a file from archive to WP_CONTENT_DIR
			if ( ( $completed = $archive->extract_one_file_to( WP_CONTENT_DIR, $exclude_files, $old_paths, $new_paths, $file_bytes_written, $file_bytes_offset ) ) ) {
				$file_bytes_offset = 0;
			}

			// Get archive bytes offset
			$archive_bytes_offset = $archive->get_file_pointer();

			// Increment processed files size
			$processed_files_size += $file_bytes_written;

			// What percent of files have we processed?
			$progress = (int) min( ( $processed_files_size / $total_files_size ) * 100, 100 );

			// Set progress
			Ai1wm_Status::info( sprintf( __( 'Restoring %d files...<br />%d%% complete', AI1WM_PLUGIN_NAME ), $total_files_count, $progress ) );

			// More than 10 seconds have passed, break and do another request
			if ( ( $timeout = apply_filters( 'ai1wm_completed_timeout', 10 ) ) ) {
				if ( ( microtime( true ) - $start ) > $timeout ) {
					$completed = false;
					break;
				}
			}
		}

		// End of the archive?
		if ( $archive->has_reached_eof() ) {

			// Unset archive bytes offset
			unset( $params['archive_bytes_offset'] );

			// Unset file bytes offset
			unset( $params['file_bytes_offset'] );

			// Unset processed files size
			unset( $params['processed_files_size'] );

			// Unset total files size
			unset( $params['total_files_size'] );

			// Unset total files count
			unset( $params['total_files_count'] );

			// Unset completed flag
			unset( $params['completed'] );

		} else {

			// Set archive bytes offset
			$params['archive_bytes_offset'] = $archive_bytes_offset;

			// Set file bytes offset
			$params['file_bytes_offset'] = $file_bytes_offset;

			// Set processed files size
			$params['processed_files_size'] = $processed_files_size;

			// Set total files size
			$params['total_files_size'] = $total_files_size;

			// Set total files count
			$params['total_files_count'] = $total_files_count;

			// Set completed flag
			$params['completed'] = $completed;
		}

		// Close the archive file
		$archive->close();

		return $params;
	}
}
