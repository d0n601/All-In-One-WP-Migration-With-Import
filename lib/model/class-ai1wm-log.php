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

class Ai1wm_Log {

	public static function export( $params ) {
		$data = array();

		// Add date
		$data[] = date( 'M d Y H:i:s' );

		// Add params
		$data[] = json_encode( $params );

		// Add empty line
		$data[] = PHP_EOL;

		// Write log data
		if ( $handle = ai1wm_open( ai1wm_export_path( $params ), 'a' ) ) {
			ai1wm_write( $handle, implode( PHP_EOL, $data ) );
			ai1wm_close( $handle );
		}
	}

	public static function import( $params ) {
		$data = array();

		// Add date
		$data[] = date( 'M d Y H:i:s' );

		// Add params
		$data[] = json_encode( $params );

		// Add empty line
		$data[] = PHP_EOL;

		// Write log data
		if ( $handle = ai1wm_open( ai1wm_import_path( $params ), 'a' ) ) {
			ai1wm_write( $handle, implode( PHP_EOL, $data ) );
			ai1wm_close( $handle );
		}
	}

	public static function error( $params ) {
		$data = array();

		// Add date
		$data[] = date( 'M d Y H:i:s' );

		// Add params
		$data[] = json_encode( $params );

		// Add empty line
		$data[] = PHP_EOL;

		// Write log data
		if ( $handle = ai1wm_open( ai1wm_error_path(), 'a' ) ) {
			ai1wm_write( $handle, implode( PHP_EOL, $data ) );
			ai1wm_close( $handle );
		}
	}
}
