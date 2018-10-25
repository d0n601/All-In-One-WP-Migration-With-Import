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

class Ai1wm_Export_Config_File {

	public static function execute( $params ) {

		$package_bytes_written = 0;

		// Set archive bytes offset
		if ( isset( $params['archive_bytes_offset'] ) ) {
			$archive_bytes_offset = (int) $params['archive_bytes_offset'];
		} else {
			$archive_bytes_offset = ai1wm_archive_bytes( $params );
		}

		// Set package bytes offset
		if ( isset( $params['package_bytes_offset'] ) ) {
			$package_bytes_offset = (int) $params['package_bytes_offset'];
		} else {
			$package_bytes_offset = 0;
		}

		// Get total package size
		if ( isset( $params['total_package_size'] ) ) {
			$total_package_size = (int) $params['total_package_size'];
		} else {
			$total_package_size = ai1wm_package_bytes( $params );
		}

		// What percent of package have we processed?
		$progress = (int) min( ( $package_bytes_offset / $total_package_size ) * 100, 100 );

		// Set progress
		Ai1wm_Status::info( sprintf( __( 'Archiving configuration file...<br />%d%% complete', AI1WM_PLUGIN_NAME ), $progress ) );

		// Open the archive file for writing
		$archive = new Ai1wm_Compressor( ai1wm_archive_path( $params ) );

		// Set the file pointer to the one that we have saved
		$archive->set_file_pointer( $archive_bytes_offset );

		// Add package.json to archive
		if ( $archive->add_file( ai1wm_package_path( $params ), AI1WM_PACKAGE_NAME, $package_bytes_written, $package_bytes_offset ) ) {

			// Set progress
			Ai1wm_Status::info( __( 'Done archiving configuration file.', AI1WM_PLUGIN_NAME ) );

			// Unset archive bytes offset
			unset( $params['archive_bytes_offset'] );

			// Unset package bytes offset
			unset( $params['package_bytes_offset'] );

			// Unset total package size
			unset( $params['total_package_size'] );

			// Unset completed flag
			unset( $params['completed'] );

		} else {

			// Get archive bytes offset
			$archive_bytes_offset = $archive->get_file_pointer();

			// What percent of package have we processed?
			$progress = (int) min( ( $package_bytes_offset / $total_package_size ) * 100, 100 );

			// Set progress
			Ai1wm_Status::info( sprintf( __( 'Archiving configuration file...<br />%d%% complete', AI1WM_PLUGIN_NAME ), $progress ) );

			// Set archive bytes offset
			$params['archive_bytes_offset'] = $archive_bytes_offset;

			// Set package bytes offset
			$params['package_bytes_offset'] = $package_bytes_offset;

			// Set total package size
			$params['total_package_size'] = $total_package_size;

			// Set completed flag
			$params['completed'] = false;
		}

		// Truncate the archive file
		$archive->truncate();

		// Close the archive file
		$archive->close();

		return $params;
	}
}
