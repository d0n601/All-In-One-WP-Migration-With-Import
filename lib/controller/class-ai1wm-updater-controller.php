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

class Ai1wm_Updater_Controller {

	public static function plugins_api( $result, $action = null, $args = null ) {
		return Ai1wm_Updater::plugins_api( $result, $action, $args );
	}

	public static function pre_update_plugins( $transient ) {
		if ( empty( $transient->checked ) ) {
			return $transient;
		}

		// Check for updates
		Ai1wm_Updater::check_for_updates();

		return $transient;
	}

	public static function update_plugins( $transient ) {
		return Ai1wm_Updater::update_plugins( $transient );
	}

	public static function check_for_updates() {
		return Ai1wm_Updater::check_for_updates();
	}

	public static function plugin_row_meta( $links, $file ) {
		return Ai1wm_Updater::plugin_row_meta( $links, $file );
	}

	public static function updater( $params = array() ) {
		ai1wm_setup_environment();

		// Set params
		if ( empty( $params ) ) {
			$params = stripslashes_deep( $_POST );
		}

		// Set uuid
		$uuid = null;
		if ( isset( $params['ai1wm_uuid'] ) ) {
			$uuid = trim( $params['ai1wm_uuid'] );
		}

		// Set extension
		$extension = null;
		if ( isset( $params['ai1wm_extension'] ) ) {
			$extension = trim( $params['ai1wm_extension'] );
		}

		$extensions = Ai1wm_Extensions::get();

		// Verify whether extension exists
		if ( isset( $extensions[ $extension ] ) ) {
			update_option( $extensions[ $extension ]['key'], $uuid );
		}
	}
}
