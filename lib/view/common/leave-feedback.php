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

<div class="ai1wm-feedback">
	<ul class="ai1wm-feedback-types">
		<li>
			<input type="radio" class="ai1wm-flat-radio-button ai1wm-feedback-type" id="ai1wm-feedback-type-1" name="ai1wm_feedback_type" value="review" />
			<a id="ai1wm-feedback-type-link-1" href="https://wordpress.org/support/view/plugin-reviews/all-in-one-wp-migration?rate=5#postform" target="_blank">
				<i></i>
				<span><?php _e( 'I would like to review this plugin', AI1WM_PLUGIN_NAME ); ?></span>
			</a>
		</li>
		<li>
			<input type="radio" class="ai1wm-flat-radio-button ai1wm-feedback-type" id="ai1wm-feedback-type-2" name="ai1wm_feedback_type" value="suggestions" />
			<a id="ai1wm-feedback-type-link-2" href="https://feedback.wp-migration.com" target="_blank">
				<i></i>
				<span><?php _e( 'I have ideas to improve this plugin', AI1WM_PLUGIN_NAME ); ?></span>
			</a>
		</li>
		<li>
			<input type="radio" class="ai1wm-flat-radio-button ai1wm-feedback-type" id="ai1wm-feedback-type-3" name="ai1wm_feedback_type" value="help-needed" />
			<label for="ai1wm-feedback-type-3">
				<i></i>
				<span><?php _e( 'I need help with this plugin', AI1WM_PLUGIN_NAME ); ?></span>
			</label>
		</li>
	</ul>

	<div class="ai1wm-feedback-form">
		<div class="ai1wm-field">
			<input placeholder="<?php _e( 'Enter your email address..', AI1WM_PLUGIN_NAME ); ?>" type="text" id="ai1wm-feedback-email" class="ai1wm-feedback-email" />
		</div>
		<div class="ai1wm-field">
			<textarea rows="3" id="ai1wm-feedback-message" class="ai1wm-feedback-message" placeholder="<?php _e( 'Leave plugin developers any feedback here..', AI1WM_PLUGIN_NAME ); ?>"></textarea>
		</div>
		<div class="ai1wm-field ai1wm-feedback-terms-segment">
			<label for="ai1wm-feedback-terms">
				<input type="checkbox" class="ai1wm-feedback-terms" id="ai1wm-feedback-terms" />
				<?php _e( 'I agree that by filling in the contact form with my data, I authorize All-in-One WP Migration to use my <strong>email</strong> to reply to my requests for information. <a href="https://www.iubenda.com/privacy-policy/946881" target="_blank">Privacy policy</a>', AI1WM_PLUGIN_NAME ); ?>
			</label>
		</div>
		<div class="ai1wm-field">
			<div class="ai1wm-buttons">
				<a class="ai1wm-feedback-cancel" id="ai1wm-feedback-cancel" href="#"><?php _e( 'Cancel', AI1WM_PLUGIN_NAME ); ?></a>
				<button type="submit" id="ai1wm-feedback-submit" class="ai1wm-button-blue ai1wm-form-submit">
					<i class="ai1wm-icon-paperplane"></i>
					<?php _e( 'Send', AI1WM_PLUGIN_NAME ); ?>
				</button>
				<span class="spinner"></span>
				<div class="ai1wm-clear"></div>
			</div>
		</div>
	</div>
</div>
