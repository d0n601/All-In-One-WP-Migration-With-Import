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

class Ai1wm_Export_Database {

	public static function execute( $params ) {
		global $wpdb;

		// Set exclude database
		if ( isset( $params['options']['no_database'] ) ) {
			return $params;
		}

		// Set table index
		if ( isset( $params['table_index'] ) ) {
			$table_index = (int) $params['table_index'];
		} else {
			$table_index = 0;
		}

		// Set table offset
		if ( isset( $params['table_offset'] ) ) {
			$table_offset = (int) $params['table_offset'];
		} else {
			$table_offset = 0;
		}

		// Set total tables count
		if ( isset( $params['total_tables_count'] ) ) {
			$total_tables_count = (int) $params['total_tables_count'];
		} else {
			$total_tables_count = 1;
		}

		// What percent of tables have we processed?
		$progress = (int) ( ( $table_index / $total_tables_count ) * 100 );

		// Set progress
		Ai1wm_Status::info( sprintf( __( 'Exporting database...<br />%d%% complete', AI1WM_PLUGIN_NAME ), $progress ) );

		// Get database client
		if ( empty( $wpdb->use_mysqli ) ) {
			$mysql = new Ai1wm_Database_Mysql( $wpdb );
		} else {
			$mysql = new Ai1wm_Database_Mysqli( $wpdb );
		}

		// Exclude spam comments
		if ( isset( $params['options']['no_spam_comments'] ) ) {
			$mysql->set_table_where_clauses( ai1wm_table_prefix() . 'comments', array( "`comment_approved` != 'spam'" ) )
				->set_table_where_clauses( ai1wm_table_prefix() . 'commentmeta', array( sprintf( "`comment_ID` IN ( SELECT `comment_ID` FROM `%s` WHERE `comment_approved` != 'spam' )", ai1wm_table_prefix() . 'comments' ) ) );
		}

		// Exclude post revisions
		if ( isset( $params['options']['no_post_revisions'] ) ) {
			$mysql->set_table_where_clauses( ai1wm_table_prefix() . 'posts', array( "`post_type` != 'revision'" ) );
		}

		$old_table_prefixes = $old_column_prefixes = array();
		$new_table_prefixes = $new_column_prefixes = array();

		// Set table prefixes
		if ( ai1wm_table_prefix() ) {
			$old_table_prefixes[] = $old_column_prefixes[] = ai1wm_table_prefix();
			$new_table_prefixes[] = $new_column_prefixes[] = ai1wm_servmask_prefix();
		} else {
			// Set table prefixes based on table name
			foreach ( $mysql->get_tables() as $table_name ) {
				$old_table_prefixes[] = $table_name;
				$new_table_prefixes[] = ai1wm_servmask_prefix() . $table_name;
			}

			// Set table prefixes based on column name
			foreach ( array( 'user_roles' ) as $option_name ) {
				$old_column_prefixes[] = $option_name;
				$new_column_prefixes[] = ai1wm_servmask_prefix() . $option_name;
			}

			// Set table prefixes based on column name
			foreach ( array( 'capabilities', 'user_level', 'dashboard_quick_press_last_post_id', 'user-settings', 'user-settings-time' ) as $meta_key ) {
				$old_column_prefixes[] = $meta_key;
				$new_column_prefixes[] = ai1wm_servmask_prefix() . $meta_key;
			}
		}

		$include_table_prefixes = array();
		$exclude_table_prefixes = array();

		// Include table prefixes
		if ( ai1wm_table_prefix() ) {
			$include_table_prefixes[] = ai1wm_table_prefix();
		} else {
			foreach ( $mysql->get_tables() as $table_name ) {
				$include_table_prefixes[] = $table_name;
			}
		}

		// Set database options
		$mysql->set_old_table_prefixes( $old_table_prefixes )
			->set_new_table_prefixes( $new_table_prefixes )
			->set_old_column_prefixes( $old_column_prefixes )
			->set_new_column_prefixes( $new_column_prefixes )
			->set_include_table_prefixes( $include_table_prefixes )
			->set_exclude_table_prefixes( $exclude_table_prefixes );

		// Exclude site options
		$mysql->set_table_where_clauses( ai1wm_table_prefix() . 'options', array( sprintf( "`option_name` NOT IN ('%s', '%s', '%s', '%s', '%s', '%s', '%s')", AI1WM_ACTIVE_PLUGINS, AI1WM_ACTIVE_TEMPLATE, AI1WM_ACTIVE_STYLESHEET, AI1WM_STATUS, AI1WM_SECRET_KEY, AI1WM_AUTH_USER, AI1WM_AUTH_PASSWORD ) ) );

		// Replace table prefix on columns
		$mysql->set_table_prefix_columns( ai1wm_table_prefix() . 'options', array( 'option_name' ) )
			->set_table_prefix_columns( ai1wm_table_prefix() . 'usermeta', array( 'meta_key' ) );

		// Export database
		if ( $mysql->export( ai1wm_database_path( $params ), $table_index, $table_offset ) ) {

			// Set progress
			Ai1wm_Status::info( __( 'Done exporting database.', AI1WM_PLUGIN_NAME ) );

			// Unset table index
			unset( $params['table_index'] );

			// Unset table offset
			unset( $params['table_offset'] );

			// Unset total tables count
			unset( $params['total_tables_count'] );

			// Unset completed flag
			unset( $params['completed'] );

		} else {

			// Get total tables count
			$total_tables_count = count( $mysql->get_tables() );

			// What percent of tables have we processed?
			$progress = (int) ( ( $table_index / $total_tables_count ) * 100 );

			// Set progress
			Ai1wm_Status::info( sprintf( __( 'Exporting database...<br />%d%% complete', AI1WM_PLUGIN_NAME ), $progress ) );

			// Set table index
			$params['table_index'] = $table_index;

			// Set table offset
			$params['table_offset'] = $table_offset;

			// Set total tables count
			$params['total_tables_count'] = $total_tables_count;

			// Set completed flag
			$params['completed'] = false;
		}

		return $params;
	}
}
