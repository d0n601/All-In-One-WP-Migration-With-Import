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

class Ai1wm_Cron {

	/**
	 * Schedules a hook which will be executed by the WordPress
	 * actions core on a specific interval
	 *
	 * @param  string $hook       Event hook
	 * @param  string $recurrence How often the event should reoccur
	 * @param  array  $args       Arguments to pass to the hook function(s)
	 * @return mixed
	 */
	public static function add( $hook, $recurrence, $args = array() ) {
		$args      = array_slice( func_get_args(), 2 );
		$schedules = wp_get_schedules();

		if ( isset( $schedules[ $recurrence ] ) && ( $current = $schedules[ $recurrence ] ) ) {
			return wp_schedule_event( time() + $current['interval'], $recurrence, $hook, $args );
		}
	}

	/**
	 * Un-schedules all previously-scheduled cron jobs using a particular
	 * hook name or a specific combination of hook name and arguments.
	 *
	 * @param  string  $hook Event hook
	 * @return boolean
	 */
	public static function clear( $hook ) {
		$cron = get_option( AI1WM_CRON, array() );
		if ( empty( $cron ) ) {
			return false;
		}

		foreach ( $cron as $timestamp => $hooks ) {
			if ( isset( $hooks[ $hook ] ) ) {
				unset( $cron[ $timestamp ][ $hook ] );

				// Unset empty timestamps
				if ( empty( $cron[ $timestamp ] ) ) {
					unset( $cron[ $timestamp ] );
				}
			}
		}

		return update_option( AI1WM_CRON, $cron );
	}
}
