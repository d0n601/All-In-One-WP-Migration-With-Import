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

class Ai1wm_Notification {

	public static function ok( $subject, $message ) {
		// Enable notifications
		if ( ! apply_filters( 'ai1wm_notification_ok_toggle', false ) ) {
			return;
		}

		// Set email
		if ( ! ( $email = apply_filters( 'ai1wm_notification_ok_email', get_option( 'admin_email', false ) ) ) ) {
			return;
		}

		// Set subject
		if ( ! ( $subject = apply_filters( 'ai1wm_notification_ok_subject', $subject ) ) ) {
			return;
		}

		// Set message
		if ( ! ( $message = apply_filters( 'ai1wm_notification_ok_message', $message ) ) ) {
			return;
		}

		// Send email
		if ( ai1wm_is_scheduled_backup() ) {
			wp_mail( $email, $subject, $message, array( 'Content-Type: text/html; charset=UTF-8' ) );
		}
	}

	public static function error( $subject, $message ) {
		// Enable notifications
		if ( ! apply_filters( 'ai1wm_notification_error_toggle', false ) ) {
			return;
		}

		// Set email
		if ( ! ( $email = apply_filters( 'ai1wm_notification_error_email', get_option( 'admin_email', false ) ) ) ) {
			return;
		}

		// Set subject
		if ( ! ( $subject = apply_filters( 'ai1wm_notification_error_subject', $subject ) ) ) {
			return;
		}

		// Set message
		if ( ! ( $message = apply_filters( 'ai1wm_notification_error_message', $message ) ) ) {
			return;
		}

		// Send email
		if ( ai1wm_is_scheduled_backup() ) {
			wp_mail( $email, $subject, $message, array( 'Content-Type: text/html; charset=UTF-8' ) );
		}
	}
}
