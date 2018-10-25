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

class Ai1wm_Import_Confirm {

	public static function execute( $params ) {

		$messages = array();

		// Read package.json file
		$handle = ai1wm_open( ai1wm_package_path( $params ), 'r' );

		// Parse package.json file
		$package = ai1wm_read( $handle, filesize( ai1wm_package_path( $params ) ) );
		$package = json_decode( $package, true );

		// Close handle
		ai1wm_close( $handle );

		// Set message
		$messages[] = __(
			'The import process will overwrite your website including the database, media, plugins, and themes. ' .
			'Please ensure that you have a backup of your data before proceeding to the next step.',
			AI1WM_PLUGIN_NAME
		);

		// Check compatibility of PHP versions
		if ( isset( $package['PHP']['Version'] ) ) {
			if ( version_compare( $package['PHP']['Version'], '7.0.0', '<' ) && version_compare( PHP_VERSION, '7.0.0', '>=' ) ) {
				$messages[] = __(
					'<i class="ai1wm-import-info">Your backup is from a PHP 5 but the site that you are importing to is PHP 7. ' .
					'This could cause the import to fail. <a href="https://help.servmask.com/knowledgebase/migrate-wordpress-from-php-5-to-php-7/" target="_blank">Technical details</a></i>',
					AI1WM_PLUGIN_NAME
				);
			}
		}

		// Set progress
		Ai1wm_Status::confirm( implode( $messages ) );
		exit;
	}
}
