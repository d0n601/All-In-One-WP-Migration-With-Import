<?php
/**
 * All-in-One WP Migration Command
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
 */

if ( class_exists( 'WP_CLI_Command' ) ) {
	class Ai1wm_WP_CLI_Command extends WP_CLI_Command {
		/**
		 * Creates a new backup.
		 *
		 * ## OPTIONS
		 *
		 * [--list]
		 * Get a list of backup files
		 *
		 * Example:
		 * $ wp ai1wm backup --list
		 * +------------------------------------------------+--------------+-----------+
		 * | Backup name                                    | Date created | Size      |
		 * +------------------------------------------------+--------------+-----------+
		 * | migration-wp-20170908-152313-435.wpress        | 4 days ago   | 536.77 MB |
		 * | migration-wp-20170908-152103-603.wpress        | 4 days ago   | 536.77 MB |
		 * | migration-wp-20170908-152036-162.wpress        | 4 days ago   | 536.77 MB |
		 * | migration-wp-20170908-151428-266.wpress        | 4 days ago   | 536.77 MB |
		 * +------------------------------------------------+--------------+-----------+
		 *
		 * [--exclude-spam-comments]
		 * Do not export spam comments
		 *
		 * [--exclude-post-revisions]
		 * Do not export post revisions
		 *
		 * [--exclude-media]
		 * Do not export media library (files)
		 *
		 * [--exclude-themes]
		 * Do not export themes (files)
		 *
		 * [--exclude-inactive-themes]
		 * Do not export inactive themes (files)
		 *
		 * [--exclude-muplugins]
		 * Do not export must-use plugins (files)
		 *
		 * [--exclude-plugins]
		 * Do not export plugins (files)
		 *
		 * [--exclude-inactive-plugins]
		 * Do not export inactive plugins (files)
		 *
		 * [--exclude-cache]
		 * Do not export cache (files)
		 *
		 * [--exclude-database]
		 * Do not export database (sql)
		 *
		 * [--exclude-email-replace]
		 * Do not replace email domain (sql)
		 *
		 * [--replace "find" "replace"]
		 * Find and replace text in the database
		 *
		 * Example:
		 * $ wp ai1wm backup --replace "wp" "WordPress"
		 * Backup in progress...
		 * Backup complete.
		 * Backup location: /repos/migration/wp/wp-content/ai1wm-backups/migration-wp-20170913-095743-931.wpress
		 *
		 * @subcommand backup
		 */
		public function backup( array $args, array $assoc_args ) {
			if ( is_multisite() ) {
				WP_CLI::error( __( 'WPI CLI is not supported in Multisite mode. Please use web interface to create a backup.', AI1WM_PLUGIN_NAME ) );
			}

			if ( ! is_dir( AI1WM_STORAGE_PATH ) ) {
				if ( ! mkdir( AI1WM_STORAGE_PATH ) ) {
					WP_CLI::error_multi_line( array(
						sprintf( __( 'All in One WP Migration is not able to create <strong>%s</strong> folder.', AI1WM_PLUGIN_NAME ), AI1WM_STORAGE_PATH ),
						__( 'You will need to create this folder and grant it read/write/execute permissions (0777) for the All in One WP Migration plugin to function properly.', AI1WM_PLUGIN_NAME ),
					) );
					exit;
				}
			}

			if ( ! is_dir( AI1WM_BACKUPS_PATH ) ) {
				if ( ! mkdir( AI1WM_BACKUPS_PATH ) ) {
					WP_CLI::error_multi_line( array(
						sprintf( __( 'All in One WP Migration is not able to create <strong>%s</strong> folder.', AI1WM_PLUGIN_NAME ), AI1WM_BACKUPS_PATH ),
						__( 'You will need to create this folder and grant it read/write/execute permissions (0777) for the All in One WP Migration plugin to function properly.', AI1WM_PLUGIN_NAME ),
					) );
					exit;
				}
			}

			$params = array();
			if ( isset( $assoc_args['list'] ) ) {
				$backups = new cli\Table;

				$backups->setHeaders( array(
					'name' => __( 'Backup name', AI1WM_PLUGIN_NAME ),
					'date' => __( 'Date created', AI1WM_PLUGIN_NAME ),
					'size' => __( 'Size', AI1WM_PLUGIN_NAME ),
				) );

				$model = new Ai1wm_Backups;
				foreach ( $model->get_files() as $backup ) {
					$backups->addRow( array(
						'name' => $backup['filename'],
						'date' => sprintf( __( '%s ago', AI1WM_PLUGIN_NAME ), human_time_diff( $backup['mtime'] ) ),
						'size' => size_format( $backup['size'], 2 ),
					) );
				}

				$backups->display();
				exit;
			}

			if ( isset( $assoc_args['exclude-spam-comments'] ) ) {
				$params['options']['no_spam_comments'] = true;
			}

			if ( isset( $assoc_args['exclude-post-revisions'] ) ) {
				$params['options']['no_post_revisions'] = true;
			}

			if ( isset( $assoc_args['exclude-media'] ) ) {
				$params['options']['no_media'] = true;
			}

			if ( isset( $assoc_args['exclude-themes'] ) ) {
				$params['options']['no_themes'] = true;
			}

			if ( isset( $assoc_args['exclude-inactive-themes'] ) ) {
				$params['options']['no_inactive_themes'] = true;
			}

			if ( isset( $assoc_args['exclude-muplugins'] ) ) {
				$params['options']['no_muplugins'] = true;
			}

			if ( isset( $assoc_args['exclude-plugins'] ) ) {
				$params['options']['no_plugins'] = true;
			}

			if ( isset( $assoc_args['exclude-inactive-plugins'] ) ) {
				$params['options']['no_inactive_plugins'] = true;
			}

			if ( isset( $assoc_args['exclude-cache'] ) ) {
				$params['options']['no_cache'] = true;
			}

			if ( isset( $assoc_args['exclude-database'] ) ) {
				$params['options']['no_database'] = true;
			}

			if ( isset( $assoc_args['exclude-email-replace'] ) ) {
				$params['options']['no_email_replace'] = true;
			}

			if ( isset( $assoc_args['replace'] ) ) {
				for ( $i = 0; $i < count( $args ); $i++ ) {
					if ( isset( $args[ $i ] ) && isset( $args[ $i + 1 ] ) ) {
						$params['options']['replace']['old_value'][] = $args[ $i ];
						$params['options']['replace']['new_value'][] = $args[ $i + 1 ];
					}
				}
			}

			WP_CLI::log( 'Backup in progress...' );

			try {

				// Disable completed timeout
				add_filter( 'ai1wm_completed_timeout', '__return_zero' );

				// Remove filters
				remove_filter( 'ai1wm_export', 'Ai1wm_Export_Clean::execute', 300 );

				// Run filters
				$params = apply_filters( 'ai1wm_export', $params );

			} catch ( Exception $e ) {
				WP_CLI::error( $e->getMessage() );
			}

			// Clean storage folder
			Ai1wm_Directory::delete( ai1wm_storage_path( $params ) );

			WP_CLI::log( __( 'Backup complete.', AI1WM_PLUGIN_NAME ) );
			WP_CLI::log( sprintf( __( 'Backup location: %s', AI1WM_PLUGIN_NAME ), ai1wm_backup_path( $params ) ) );
		}

		/**
		 * Restores a backup.
		 *
		 * Example:
		 * $ wp ai1wm restore migration-wp-20170913-095743-931.wpress
		 * Restore in progress...
		 * Restore complete.
		 *
		 * @subcommand restore
		 */
		public function restore( array $args, array $assoc_args ) {
			if ( is_multisite() ) {
				WP_CLI::error( __( 'WPI CLI is not supported in Multisite mode. Please use web interface to restore a backup.', AI1WM_PLUGIN_NAME ) );
			}

			if ( ! is_dir( AI1WM_STORAGE_PATH ) ) {
				if ( ! mkdir( AI1WM_STORAGE_PATH ) ) {
					WP_CLI::error_multi_line( array(
						sprintf( __( 'All in One WP Migration is not able to create <strong>%s</strong> folder.', AI1WM_PLUGIN_NAME ), AI1WM_STORAGE_PATH ),
						__( 'You will need to create this folder and grant it read/write/execute permissions (0777) for the All in One WP Migration plugin to function properly.', AI1WM_PLUGIN_NAME ),
					) );
					exit;
				}
			}

			$params = array();
			if ( isset( $args[0] ) && is_file( ai1wm_backup_path( array( 'archive' => $args[0] ) ) ) ) {
				$params = array(
					'storage'              => ai1wm_storage_folder(),
					'archive'              => $args[0],
					'ai1wm_manual_restore' => true,
				);
			} else {
				WP_CLI::error_multi_line( array(
					__( 'A valid backup name must be provided in order to proceed with the restore process.', AI1WM_PLUGIN_NAME ),
					__( 'Example: wp ai1wm restore migration-wp-20170913-095743-931.wpress', AI1WM_PLUGIN_NAME ),
				) );
				exit;
			}

			WP_CLI::log( 'Restore in progress...' );

			try {

				// Disable completed timeout
				add_filter( 'ai1wm_completed_timeout', '__return_zero' );

				// Remove filters
				remove_filter( 'ai1wm_import', 'Ai1wm_Import_Upload::execute', 5 );
				remove_filter( 'ai1wm_import', 'Ai1wm_Import_Confirm::execute', 100 );
				remove_filter( 'ai1wm_import', 'Ai1wm_Import_Clean::execute', 400 );

				// Run filters
				$params = apply_filters( 'ai1wm_import', $params );

			} catch ( Exception $e ) {
				WP_CLI::error( $e->getMessage() );
			}

			// Clean storage folder
			Ai1wm_Directory::delete( ai1wm_storage_path( $params ) );

			WP_CLI::log( 'Restore complete.' );
		}
	}
}
if ( class_exists( 'WP_CLI' ) ) {
	WP_CLI::add_command( 'ai1wm', 'Ai1wm_WP_CLI_Command', array( 'short_desc' => 'All-in-One WP Migration Command' ) );
}
