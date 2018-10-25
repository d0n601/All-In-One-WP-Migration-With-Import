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
?>

<div class="ai1wm-container">
	<div class="ai1wm-row">
		<div class="ai1wm-left">
			<div class="ai1wm-holder">
				<h1>
					<i class="ai1wm-icon-export"></i>
					<?php _e( 'Backups', AI1WM_PLUGIN_NAME ); ?>
				</h1>

				<?php include AI1WM_TEMPLATES_PATH . '/common/report-problem.php'; ?>

				<form action="" method="post" id="ai1wm-backups-form" class="ai1wm-clear">

					<?php if ( is_readable( AI1WM_BACKUPS_PATH ) && is_writable( AI1WM_BACKUPS_PATH ) ) : ?>
						<?php if ( $backups ) : ?>
							<table class="ai1wm-backups">
								<thead>
									<tr>
										<th class="ai1wm-column-name"><?php _e( 'Name', AI1WM_PLUGIN_NAME ); ?></th>
										<th class="ai1wm-column-date"><?php _e( 'Date', AI1WM_PLUGIN_NAME ); ?></th>
										<th class="ai1wm-column-size"><?php _e( 'Size', AI1WM_PLUGIN_NAME ); ?></th>
										<th class="ai1wm-column-actions"></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ( $backups as $backup ) : ?>
									<tr>
										<td class="ai1wm-column-name">
											<?php if ( $backup['path'] ) : ?>
												<i class="ai1wm-icon-folder"></i>
												<?php echo esc_html( $backup['path'] ); ?>
												<br />
											<?php endif; ?>
											<i class="ai1wm-icon-file-zip"></i>
											<?php echo esc_html( basename( $backup['filename'] ) ); ?>
										</td>
										<td class="ai1wm-column-date">
											<?php echo esc_html( sprintf( __( '%s ago', AI1WM_PLUGIN_NAME ), human_time_diff( $backup['mtime'] ) ) ); ?>
										</td>
										<td class="ai1wm-column-size">
											<?php if ( is_null( $backup['size'] ) ) : ?>
												<?php _e( '2GB+', AI1WM_PLUGIN_NAME ); ?>
											<?php else : ?>
												<?php echo size_format( $backup['size'], 2 ); ?>
											<?php endif; ?>
										</td>
										<td class="ai1wm-column-actions ai1wm-backup-actions">
											<a href="<?php echo ai1wm_backup_url( array( 'archive' => esc_attr( $backup['filename'] ) ) ); ?>" class="ai1wm-button-green ai1wm-backup-download">
												<i class="ai1wm-icon-arrow-down"></i>
												<span><?php _e( 'Download', AI1WM_PLUGIN_NAME ); ?></span>
											</a>
											<a href="#" data-archive="<?php echo esc_attr( $backup['filename'] ); ?>" class="ai1wm-button-gray ai1wm-backup-restore">
												<i class="ai1wm-icon-cloud-upload"></i>
												<span><?php _e( 'Restore', AI1WM_PLUGIN_NAME ); ?></span>
											</a>
											<a href="#" data-archive="<?php echo esc_attr( $backup['filename'] ); ?>" class="ai1wm-button-red ai1wm-backup-delete">
												<i class="ai1wm-icon-close"></i>
												<span><?php _e( 'Delete', AI1WM_PLUGIN_NAME ); ?></span>
											</a>
										</td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						<?php endif; ?>
						<div class="ai1wm-backups-create">
							<p class="ai1wm-backups-empty <?php echo $backups ? 'ai1wm-hide' : null; ?>">
								<?php _e( 'There are no backups available at this time, why not create a new one?', AI1WM_PLUGIN_NAME ); ?>
							</p>
							<p>
								<a href="<?php echo esc_url( network_admin_url( 'admin.php?page=ai1wm_export' ) ); ?>" class="ai1wm-button-green">
									<i class="ai1wm-icon-export"></i>
									<?php _e( 'Create backup', AI1WM_PLUGIN_NAME ); ?>
								</a>
							</p>
						</div>
					<?php else : ?>
						<div class="ai1wm-clear ai1wm-message ai1wm-red-message">
							<?php
							printf(
								__(
									'<h3>Site could not create backups!</h3>' .
									'<p>Please make sure that storage directory <strong>%s</strong> has read and write permissions.</p>',
									AI1WM_PLUGIN_NAME
								),
								AI1WM_STORAGE_PATH
							);
							?>
						</div>
					<?php endif; ?>

					<?php do_action( 'ai1wm_backups_left_end' ); ?>

					<input type="hidden" name="ai1wm_manual_restore" value="1" />

				</form>
			</div>
		</div>
		<div class="ai1wm-right">
			<div class="ai1wm-sidebar">
				<div class="ai1wm-segment">

					<?php if ( ! AI1WM_DEBUG ) : ?>
						<?php include AI1WM_TEMPLATES_PATH . '/common/share-buttons.php'; ?>
					<?php endif; ?>

					<h2><?php _e( 'Leave Feedback', AI1WM_PLUGIN_NAME ); ?></h2>

					<?php include AI1WM_TEMPLATES_PATH . '/common/leave-feedback.php'; ?>

				</div>
			</div>
		</div>
	</div>
</div>
