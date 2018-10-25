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

<div class="ai1wm-report-problem">
	<button type="button" id="ai1wm-report-problem-button" class="ai1wm-button-red">
		<i class="ai1wm-icon-notification"></i>
		<?php _e( 'Report issue', AI1WM_PLUGIN_NAME ); ?>
	</button>
	<div class="ai1wm-report-problem-dialog">
		<div class="ai1wm-field">
			<input placeholder="<?php _e( 'Enter your email address..', AI1WM_PLUGIN_NAME ); ?>" type="text" id="ai1wm-report-email" class="ai1wm-report-email" />
		</div>
		<div class="ai1wm-field">
			<textarea rows="3" id="ai1wm-report-message" class="ai1wm-report-message" placeholder="<?php _e( 'Please describe your problem here..', AI1WM_PLUGIN_NAME ); ?>"></textarea>
		</div>
		<div class="ai1wm-field ai1wm-report-terms-segment">
			<label for="ai1wm-report-terms">
				<input type="checkbox" class="ai1wm-report-terms" id="ai1wm-report-terms" />
				<?php _e( 'I agree that by filling in the contact form with my data, I authorize All-in-One WP Migration to use my <strong>email</strong> to reply to my requests for information. <a href="https://www.iubenda.com/privacy-policy/946881" target="_blank">Privacy policy</a>', AI1WM_PLUGIN_NAME ); ?>
			</label>
		</div>
		<div class="ai1wm-field">
			<div class="ai1wm-buttons">
				<a href="#" id="ai1wm-report-cancel" class="ai1wm-report-cancel"><?php _e( 'Cancel', AI1WM_PLUGIN_NAME ); ?></a>
				<button type="submit" id="ai1wm-report-submit" class="ai1wm-button-blue ai1wm-form-submit">
					<i class="ai1wm-icon-paperplane"></i>
					<?php _e( 'Send', AI1WM_PLUGIN_NAME ); ?>
				</button>
				<span class="spinner"></span>
				<div class="ai1wm-clear"></div>
			</div>
		</div>
	</div>
</div>
