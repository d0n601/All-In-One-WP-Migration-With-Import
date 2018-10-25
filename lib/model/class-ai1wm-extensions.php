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

class Ai1wm_Extensions {

	/**
	 * Get active extensions
	 *
	 * @return array
	 */
	public static function get() {
		$extensions = array();

		// Add Microsoft Azure extension
		if ( defined( 'AI1WMZE_PLUGIN_NAME' ) ) {
			$extensions[ AI1WMZE_PLUGIN_NAME ] = array(
				'key'      => AI1WMZE_PLUGIN_KEY,
				'title'    => AI1WMZE_PLUGIN_TITLE,
				'about'    => AI1WMZE_PLUGIN_ABOUT,
				'basename' => AI1WMZE_PLUGIN_BASENAME,
				'version'  => AI1WMZE_VERSION,
				'requires' => '1.1',
				'short'    => AI1WMZE_PLUGIN_SHORT,
			);
		}

		// Add Backblaze B2 extension
		if ( defined( 'AI1WMAE_PLUGIN_NAME' ) ) {
			$extensions[ AI1WMAE_PLUGIN_NAME ] = array(
				'key'      => AI1WMAE_PLUGIN_KEY,
				'title'    => AI1WMAE_PLUGIN_TITLE,
				'about'    => AI1WMAE_PLUGIN_ABOUT,
				'basename' => AI1WMAE_PLUGIN_BASENAME,
				'version'  => AI1WMAE_VERSION,
				'requires' => '1.3',
				'short'    => AI1WMAE_PLUGIN_SHORT,
			);
		}

		// Add Box Extension
		if ( defined( 'AI1WMBE_PLUGIN_NAME' ) ) {
			$extensions[ AI1WMBE_PLUGIN_NAME ] = array(
				'key'      => AI1WMBE_PLUGIN_KEY,
				'title'    => AI1WMBE_PLUGIN_TITLE,
				'about'    => AI1WMBE_PLUGIN_ABOUT,
				'basename' => AI1WMBE_PLUGIN_BASENAME,
				'version'  => AI1WMBE_VERSION,
				'requires' => '1.13',
				'short'    => AI1WMBE_PLUGIN_SHORT,
			);
		}

		// Add DigitalOcean Extension
		if ( defined( 'AI1WMIE_PLUGIN_NAME' ) ) {
			$extensions[ AI1WMIE_PLUGIN_NAME ] = array(
				'key'      => AI1WMIE_PLUGIN_KEY,
				'title'    => AI1WMIE_PLUGIN_TITLE,
				'about'    => AI1WMIE_PLUGIN_ABOUT,
				'basename' => AI1WMIE_PLUGIN_BASENAME,
				'version'  => AI1WMIE_VERSION,
				'requires' => '1.6',
				'short'    => AI1WMIE_PLUGIN_SHORT,
			);
		}

		// Add Dropbox Extension
		if ( defined( 'AI1WMDE_PLUGIN_NAME' ) ) {
			$extensions[ AI1WMDE_PLUGIN_NAME ] = array(
				'key'      => AI1WMDE_PLUGIN_KEY,
				'title'    => AI1WMDE_PLUGIN_TITLE,
				'about'    => AI1WMDE_PLUGIN_ABOUT,
				'basename' => AI1WMDE_PLUGIN_BASENAME,
				'version'  => AI1WMDE_VERSION,
				'requires' => '3.32',
				'short'    => AI1WMDE_PLUGIN_SHORT,
			);
		}

		// Add FTP Extension
		if ( defined( 'AI1WMFE_PLUGIN_NAME' ) ) {
			$extensions[ AI1WMFE_PLUGIN_NAME ] = array(
				'key'      => AI1WMFE_PLUGIN_KEY,
				'title'    => AI1WMFE_PLUGIN_TITLE,
				'about'    => AI1WMFE_PLUGIN_ABOUT,
				'basename' => AI1WMFE_PLUGIN_BASENAME,
				'version'  => AI1WMFE_VERSION,
				'requires' => '2.37',
				'short'    => AI1WMFE_PLUGIN_SHORT,
			);
		}

		// Add Google Cloud Storage Extension
		if ( defined( 'AI1WMCE_PLUGIN_NAME' ) ) {
			$extensions[ AI1WMCE_PLUGIN_NAME ] = array(
				'key'      => AI1WMCE_PLUGIN_KEY,
				'title'    => AI1WMCE_PLUGIN_TITLE,
				'about'    => AI1WMCE_PLUGIN_ABOUT,
				'basename' => AI1WMCE_PLUGIN_BASENAME,
				'version'  => AI1WMCE_VERSION,
				'requires' => '1.0',
				'short'    => AI1WMCE_PLUGIN_SHORT,
			);
		}

		// Add Google Drive Extension
		if ( defined( 'AI1WMGE_PLUGIN_NAME' ) ) {
			$extensions[ AI1WMGE_PLUGIN_NAME ] = array(
				'key'      => AI1WMGE_PLUGIN_KEY,
				'title'    => AI1WMGE_PLUGIN_TITLE,
				'about'    => AI1WMGE_PLUGIN_ABOUT,
				'basename' => AI1WMGE_PLUGIN_BASENAME,
				'version'  => AI1WMGE_VERSION,
				'requires' => '2.36',
				'short'    => AI1WMGE_PLUGIN_SHORT,
			);
		}

		// Add Amazon Glacier extension
		if ( defined( 'AI1WMRE_PLUGIN_NAME' ) ) {
			$extensions[ AI1WMRE_PLUGIN_NAME ] = array(
				'key'      => AI1WMRE_PLUGIN_KEY,
				'title'    => AI1WMRE_PLUGIN_TITLE,
				'about'    => AI1WMRE_PLUGIN_ABOUT,
				'basename' => AI1WMRE_PLUGIN_BASENAME,
				'version'  => AI1WMRE_VERSION,
				'requires' => '1.0',
				'short'    => AI1WMRE_PLUGIN_SHORT,
			);
		}

		// Add Mega Extension
		if ( defined( 'AI1WMEE_PLUGIN_NAME' ) ) {
			$extensions[ AI1WMEE_PLUGIN_NAME ] = array(
				'key'      => AI1WMEE_PLUGIN_KEY,
				'title'    => AI1WMEE_PLUGIN_TITLE,
				'about'    => AI1WMEE_PLUGIN_ABOUT,
				'basename' => AI1WMEE_PLUGIN_BASENAME,
				'version'  => AI1WMEE_VERSION,
				'requires' => '1.10',
				'short'    => AI1WMEE_PLUGIN_SHORT,
			);
		}

		// Add Multisite Extension
		if ( defined( 'AI1WMME_PLUGIN_NAME' ) ) {
			$extensions[ AI1WMME_PLUGIN_NAME ] = array(
				'key'      => AI1WMME_PLUGIN_KEY,
				'title'    => AI1WMME_PLUGIN_TITLE,
				'about'    => AI1WMME_PLUGIN_ABOUT,
				'basename' => AI1WMME_PLUGIN_BASENAME,
				'version'  => AI1WMME_VERSION,
				'requires' => '3.59',
				'short'    => AI1WMME_PLUGIN_SHORT,
			);
		}

		// Add OneDrive Extension
		if ( defined( 'AI1WMOE_PLUGIN_NAME' ) ) {
			$extensions[ AI1WMOE_PLUGIN_NAME ] = array(
				'key'      => AI1WMOE_PLUGIN_KEY,
				'title'    => AI1WMOE_PLUGIN_TITLE,
				'about'    => AI1WMOE_PLUGIN_ABOUT,
				'basename' => AI1WMOE_PLUGIN_BASENAME,
				'version'  => AI1WMOE_VERSION,
				'requires' => '1.23',
				'short'    => AI1WMOE_PLUGIN_SHORT,
			);
		}

		// Add pCloud Extension
		if ( defined( 'AI1WMPE_PLUGIN_NAME' ) ) {
			$extensions[ AI1WMPE_PLUGIN_NAME ] = array(
				'key'      => AI1WMPE_PLUGIN_KEY,
				'title'    => AI1WMPE_PLUGIN_TITLE,
				'about'    => AI1WMPE_PLUGIN_ABOUT,
				'basename' => AI1WMPE_PLUGIN_BASENAME,
				'version'  => AI1WMPE_VERSION,
				'requires' => '1.0',
				'short'    => AI1WMPE_PLUGIN_SHORT,
			);
		}

		// Add Amazon S3 extension
		if ( defined( 'AI1WMSE_PLUGIN_NAME' ) ) {
			$extensions[ AI1WMSE_PLUGIN_NAME ] = array(
				'key'      => AI1WMSE_PLUGIN_KEY,
				'title'    => AI1WMSE_PLUGIN_TITLE,
				'about'    => AI1WMSE_PLUGIN_ABOUT,
				'basename' => AI1WMSE_PLUGIN_BASENAME,
				'version'  => AI1WMSE_VERSION,
				'requires' => '3.27',
				'short'    => AI1WMSE_PLUGIN_SHORT,
			);
		}

		// Add Unlimited Extension
		if ( defined( 'AI1WMUE_PLUGIN_NAME' ) ) {
			$extensions[ AI1WMUE_PLUGIN_NAME ] = array(
				'key'      => AI1WMUE_PLUGIN_KEY,
				'title'    => AI1WMUE_PLUGIN_TITLE,
				'about'    => AI1WMUE_PLUGIN_ABOUT,
				'basename' => AI1WMUE_PLUGIN_BASENAME,
				'version'  => AI1WMUE_VERSION,
				'requires' => '2.18',
				'short'    => AI1WMUE_PLUGIN_SHORT,
			);
		}

		// Add URL Extension
		if ( defined( 'AI1WMLE_PLUGIN_NAME' ) ) {
			$extensions[ AI1WMLE_PLUGIN_NAME ] = array(
				'key'      => AI1WMLE_PLUGIN_KEY,
				'title'    => AI1WMLE_PLUGIN_TITLE,
				'about'    => AI1WMLE_PLUGIN_ABOUT,
				'basename' => AI1WMLE_PLUGIN_BASENAME,
				'version'  => AI1WMLE_VERSION,
				'requires' => '2.27',
				'short'    => AI1WMLE_PLUGIN_SHORT,
			);
		}

		return $extensions;
	}
}
