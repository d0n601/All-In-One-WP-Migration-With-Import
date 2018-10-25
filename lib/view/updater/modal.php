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

<div id="ai1wm-modal-dialog-<?php echo esc_attr( $modal ); ?>" class="ai1wm-modal-dialog">
	<div class="ai1wm-modal-container">
		<h2><?php _e( 'Enter your Purchase ID', AI1WM_PLUGIN_NAME ); ?></h2>
		<p><?php _e( 'To update your plugin/extension to the latest version, please fill your Purchase ID below.', AI1WM_PLUGIN_NAME ); ?></p>
		<p class="ai1wm-modal-error"></p>
		<p>
			<input type="text" class="ai1wm-purchase-id" placeholder="<?php _e( 'Purchase ID', AI1WM_PLUGIN_NAME ); ?>" />
			<input type="hidden" class="ai1wm-update-link" value="<?php echo esc_url( $url ); ?>" />
		</p>
		<p>
			<?php _e( "Don't have a Purchase ID? You can find your Purchase ID", AI1WM_PLUGIN_NAME ); ?>
			<a href="https://servmask.com/lost-purchase" target="_blank" class="ai1wm-help-link"><?php _e( 'here', AI1WM_PLUGIN_NAME ); ?></a>
		</p>
		<p class="ai1wm-modal-buttons submitbox">
			<button type="button" class="ai1wm-purchase-add ai1wm-button-green">
				<?php _e( 'Save', AI1WM_PLUGIN_NAME ); ?>
			</button>
			<a href="#" class="submitdelete ai1wm-purchase-discard"><?php _e( 'Discard', AI1WM_PLUGIN_NAME ); ?></a>
		</p>
	</div>
</div>

<span id="ai1wm-update-section-<?php echo esc_attr( $modal ); ?>">
	<i class="ai1wm-icon-update"></i>
	<?php _e( 'There is an update available. To update, you must enter your', AI1WM_PLUGIN_NAME ); ?>
	<a href="#ai1wm-modal-dialog-<?php echo esc_attr( $modal ); ?>"><?php _e( 'Purchase ID', AI1WM_PLUGIN_NAME ); ?></a>.
</span>
