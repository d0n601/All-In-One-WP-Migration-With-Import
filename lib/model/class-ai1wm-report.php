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

class Ai1wm_Report {

	/**
	 * Submit customer report to servmask.com
	 *
	 * @param  string  $email   User e-mail
	 * @param  string  $message User message
	 * @param  integer $terms   User accept terms
	 *
	 * @return array
	 */
	public function add( $email, $message, $terms ) {
		$errors = array();

		// Submit report to ServMask
		if ( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
			$errors[] = __( 'Your email is not valid.', AI1WM_PLUGIN_NAME );
		} elseif ( empty( $message ) ) {
			$errors[] = __( 'Please enter comments in the text area.', AI1WM_PLUGIN_NAME );
		} elseif ( empty( $terms ) ) {
			$errors[] = __( 'Please accept report term conditions.', AI1WM_PLUGIN_NAME );
		} else {
			$response = wp_remote_post(
				AI1WM_REPORT_URL,
				array(
					'timeout' => 15,
					'body'    => array(
						'email'   => $email,
						'message' => $message,
					),
				)
			);

			if ( is_wp_error( $response ) ) {
				$errors[] = sprintf( __( 'Something went wrong: %s', AI1WM_PLUGIN_NAME ), $response->get_error_message() );
			}
		}

		return $errors;
	}
}
