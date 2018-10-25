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

class Ai1wm_Import_Database {

	public static function execute( $params ) {
		global $wpdb;

		// Skip database import
		if ( ! is_file( ai1wm_database_path( $params ) ) ) {
			return $params;
		}

		// Set query offset
		if ( isset( $params['query_offset'] ) ) {
			$query_offset = (int) $params['query_offset'];
		} else {
			$query_offset = 0;
		}

		// Set total queries size
		if ( isset( $params['total_queries_size'] ) ) {
			$total_queries_size = (int) $params['total_queries_size'];
		} else {
			$total_queries_size = 1;
		}

		// Read blogs.json file
		$handle = ai1wm_open( ai1wm_blogs_path( $params ), 'r' );

		// Parse blogs.json file
		$blogs = ai1wm_read( $handle, filesize( ai1wm_blogs_path( $params ) ) );
		$blogs = json_decode( $blogs, true );

		// Close handle
		ai1wm_close( $handle );

		// Read package.json file
		$handle = ai1wm_open( ai1wm_package_path( $params ), 'r' );

		// Parse package.json file
		$config = ai1wm_read( $handle, filesize( ai1wm_package_path( $params ) ) );
		$config = json_decode( $config, true );

		// Close handle
		ai1wm_close( $handle );

		// What percent of queries have we processed?
		$progress = (int) ( ( $query_offset / $total_queries_size ) * 100 );

		// Set progress
		Ai1wm_Status::info( sprintf( __( 'Restoring database...<br />%d%% complete', AI1WM_PLUGIN_NAME ), $progress ) );

		$old_replace_values = $old_replace_raw_values = array();
		$new_replace_values = $new_replace_raw_values = array();

		// Get Blog URLs
		foreach ( $blogs as $blog ) {

			$home_urls = array();

			// Add Home URL
			if ( ! empty( $blog['Old']['HomeURL'] ) ) {
				$home_urls[] = $blog['Old']['HomeURL'];
			}

			// Add Internal Home URL
			if ( ! empty( $blog['Old']['InternalHomeURL'] ) ) {
				if ( parse_url( $blog['Old']['InternalHomeURL'], PHP_URL_SCHEME ) && parse_url( $blog['Old']['InternalHomeURL'], PHP_URL_HOST ) ) {
					$home_urls[] = $blog['Old']['InternalHomeURL'];
				}
			}

			// Get Home URL
			foreach ( $home_urls as $home_url ) {

				// Get blogs dir Upload Path
				if ( ! in_array( sprintf( "'%s'", trim( ai1wm_blogsdir_path( $blog['Old']['BlogID'] ), '/' ) ), $old_replace_raw_values ) ) {
					$old_replace_raw_values[] = sprintf( "'%s'", trim( ai1wm_blogsdir_path( $blog['Old']['BlogID'] ), '/' ) );
					$new_replace_raw_values[] = sprintf( "'%s'", get_option( 'upload_path' ) );
				}

				// Get sites dir Upload Path
				if ( ! in_array( sprintf( "'%s'", trim( ai1wm_uploads_path( $blog['Old']['BlogID'] ), '/' ) ), $old_replace_raw_values ) ) {
					$old_replace_raw_values[] = sprintf( "'%s'", trim( ai1wm_uploads_path( $blog['Old']['BlogID'] ), '/' ) );
					$new_replace_raw_values[] = sprintf( "'%s'", get_option( 'upload_path' ) );
				}

				// Handle old and new sites dir style
				if ( defined( 'UPLOADBLOGSDIR' ) ) {

					// Get plain Upload Path
					if ( ! in_array( ai1wm_blogsdir_path( $blog['Old']['BlogID'] ), $old_replace_values ) ) {
						$old_replace_values[] = ai1wm_blogsdir_path( $blog['Old']['BlogID'] );
						$new_replace_values[] = ai1wm_blogsdir_path( $blog['New']['BlogID'] );
					}

					// Get URL encoded Upload Path
					if ( ! in_array( urlencode( ai1wm_blogsdir_path( $blog['Old']['BlogID'] ) ), $old_replace_values ) ) {
						$old_replace_values[] = urlencode( ai1wm_blogsdir_path( $blog['Old']['BlogID'] ) );
						$new_replace_values[] = urlencode( ai1wm_blogsdir_path( $blog['New']['BlogID'] ) );
					}

					// Get URL raw encoded Upload Path
					if ( ! in_array( rawurlencode( ai1wm_blogsdir_path( $blog['Old']['BlogID'] ) ), $old_replace_values ) ) {
						$old_replace_values[] = rawurlencode( ai1wm_blogsdir_path( $blog['Old']['BlogID'] ) );
						$new_replace_values[] = rawurlencode( ai1wm_blogsdir_path( $blog['New']['BlogID'] ) );
					}

					// Get JSON escaped Upload Path
					if ( ! in_array( addcslashes( ai1wm_blogsdir_path( $blog['Old']['BlogID'] ), '/' ), $old_replace_values ) ) {
						$old_replace_values[] = addcslashes( ai1wm_blogsdir_path( $blog['Old']['BlogID'] ), '/' );
						$new_replace_values[] = addcslashes( ai1wm_blogsdir_path( $blog['New']['BlogID'] ), '/' );
					}

					// Get plain Upload Path
					if ( ! in_array( ai1wm_uploads_path( $blog['Old']['BlogID'] ), $old_replace_values ) ) {
						$old_replace_values[] = ai1wm_uploads_path( $blog['Old']['BlogID'] );
						$new_replace_values[] = ai1wm_blogsdir_path( $blog['New']['BlogID'] );
					}

					// Get URL encoded Upload Path
					if ( ! in_array( urlencode( ai1wm_uploads_path( $blog['Old']['BlogID'] ) ), $old_replace_values ) ) {
						$old_replace_values[] = urlencode( ai1wm_uploads_path( $blog['Old']['BlogID'] ) );
						$new_replace_values[] = urlencode( ai1wm_blogsdir_path( $blog['New']['BlogID'] ) );
					}

					// Get URL raw encoded Upload Path
					if ( ! in_array( rawurlencode( ai1wm_uploads_path( $blog['Old']['BlogID'] ) ), $old_replace_values ) ) {
						$old_replace_values[] = rawurlencode( ai1wm_uploads_path( $blog['Old']['BlogID'] ) );
						$new_replace_values[] = rawurlencode( ai1wm_blogsdir_path( $blog['New']['BlogID'] ) );
					}

					// Get JSON escaped Upload Path
					if ( ! in_array( addcslashes( ai1wm_uploads_path( $blog['Old']['BlogID'] ), '/' ), $old_replace_values ) ) {
						$old_replace_values[] = addcslashes( ai1wm_uploads_path( $blog['Old']['BlogID'] ), '/' );
						$new_replace_values[] = addcslashes( ai1wm_blogsdir_path( $blog['New']['BlogID'] ), '/' );
					}
				} else {

					// Get files dir Upload URL
					if ( ! in_array( sprintf( '%s/%s/', untrailingslashit( $home_url ), 'files' ), $old_replace_values ) ) {
						$old_replace_values[] = sprintf( '%s/%s/', untrailingslashit( $home_url ), 'files' );
						$new_replace_values[] = ai1wm_uploads_url( $blog['New']['BlogID'] );
					}

					// Get plain Upload Path
					if ( ! in_array( ai1wm_blogsdir_path( $blog['Old']['BlogID'] ), $old_replace_values ) ) {
						$old_replace_values[] = ai1wm_blogsdir_path( $blog['Old']['BlogID'] );
						$new_replace_values[] = ai1wm_uploads_path( $blog['New']['BlogID'] );
					}

					// Get URL encoded Upload Path
					if ( ! in_array( urlencode( ai1wm_blogsdir_path( $blog['Old']['BlogID'] ) ), $old_replace_values ) ) {
						$old_replace_values[] = urlencode( ai1wm_blogsdir_path( $blog['Old']['BlogID'] ) );
						$new_replace_values[] = urlencode( ai1wm_uploads_path( $blog['New']['BlogID'] ) );
					}

					// Get URL raw encoded Upload Path
					if ( ! in_array( rawurlencode( ai1wm_blogsdir_path( $blog['Old']['BlogID'] ) ), $old_replace_values ) ) {
						$old_replace_values[] = rawurlencode( ai1wm_blogsdir_path( $blog['Old']['BlogID'] ) );
						$new_replace_values[] = rawurlencode( ai1wm_uploads_path( $blog['New']['BlogID'] ) );
					}

					// Get JSON escaped Upload Path
					if ( ! in_array( addcslashes( ai1wm_blogsdir_path( $blog['Old']['BlogID'] ), '/' ), $old_replace_values ) ) {
						$old_replace_values[] = addcslashes( ai1wm_blogsdir_path( $blog['Old']['BlogID'] ), '/' );
						$new_replace_values[] = addcslashes( ai1wm_uploads_path( $blog['New']['BlogID'] ), '/' );
					}

					// Get plain Upload Path
					if ( ! in_array( ai1wm_uploads_path( $blog['Old']['BlogID'] ), $old_replace_values ) ) {
						$old_replace_values[] = ai1wm_uploads_path( $blog['Old']['BlogID'] );
						$new_replace_values[] = ai1wm_uploads_path( $blog['New']['BlogID'] );
					}

					// Get URL encoded Upload Path
					if ( ! in_array( urlencode( ai1wm_uploads_path( $blog['Old']['BlogID'] ) ), $old_replace_values ) ) {
						$old_replace_values[] = urlencode( ai1wm_uploads_path( $blog['Old']['BlogID'] ) );
						$new_replace_values[] = urlencode( ai1wm_uploads_path( $blog['New']['BlogID'] ) );
					}

					// Get URL raw encoded Upload Path
					if ( ! in_array( rawurlencode( ai1wm_uploads_path( $blog['Old']['BlogID'] ) ), $old_replace_values ) ) {
						$old_replace_values[] = rawurlencode( ai1wm_uploads_path( $blog['Old']['BlogID'] ) );
						$new_replace_values[] = rawurlencode( ai1wm_uploads_path( $blog['New']['BlogID'] ) );
					}

					// Get JSON escaped Upload Path
					if ( ! in_array( addcslashes( ai1wm_uploads_path( $blog['Old']['BlogID'] ), '/' ), $old_replace_values ) ) {
						$old_replace_values[] = addcslashes( ai1wm_uploads_path( $blog['Old']['BlogID'] ), '/' );
						$new_replace_values[] = addcslashes( ai1wm_uploads_path( $blog['New']['BlogID'] ), '/' );
					}
				}
			}

			$site_urls = array();

			// Add Site URL
			if ( ! empty( $blog['Old']['SiteURL'] ) ) {
				$site_urls[] = $blog['Old']['SiteURL'];
			}

			// Add Internal Site URL
			if ( ! empty( $blog['Old']['InternalSiteURL'] ) ) {
				if ( parse_url( $blog['Old']['InternalSiteURL'], PHP_URL_SCHEME ) && parse_url( $blog['Old']['InternalSiteURL'], PHP_URL_HOST ) ) {
					$site_urls[] = $blog['Old']['InternalSiteURL'];
				}
			}

			// Get Site URL
			foreach ( $site_urls as $site_url ) {

				// Replace Site URL
				if ( $site_url !== $blog['New']['SiteURL'] ) {

					// Get www URL
					if ( stripos( $site_url, '//www.' ) !== false ) {
						$site_url_www_inversion = str_ireplace( '//www.', '//', $site_url );
					} else {
						$site_url_www_inversion = str_ireplace( '//', '//www.', $site_url );
					}

					// Replace Site URL
					foreach ( array( $site_url, $site_url_www_inversion ) as $url ) {

						// Get domain
						$old_domain = parse_url( $url, PHP_URL_HOST );
						$new_domain = parse_url( $blog['New']['SiteURL'], PHP_URL_HOST );

						// Get path
						$old_path = parse_url( $url, PHP_URL_PATH );
						$new_path = parse_url( $blog['New']['SiteURL'], PHP_URL_PATH );

						// Get scheme
						$new_scheme = parse_url( $blog['New']['SiteURL'], PHP_URL_SCHEME );

						// Add domain and path
						if ( ! in_array( sprintf( "'%s','%s'", $old_domain, trailingslashit( $old_path ) ), $old_replace_raw_values ) ) {
							$old_replace_raw_values[] = sprintf( "'%s','%s'", $old_domain, trailingslashit( $old_path ) );
							$new_replace_raw_values[] = sprintf( "'%s','%s'", $new_domain, trailingslashit( $new_path ) );
						}

						// Add domain and path with single quote
						if ( ! in_array( sprintf( "='%s%s", $old_domain, untrailingslashit( $old_path ) ), $old_replace_values ) ) {
							$old_replace_values[] = sprintf( "='%s%s", $old_domain, untrailingslashit( $old_path ) );
							$new_replace_values[] = sprintf( "='%s%s", $new_domain, untrailingslashit( $new_path ) );
						}

						// Add domain and path with double quote
						if ( ! in_array( sprintf( '="%s%s', $old_domain, untrailingslashit( $old_path ) ), $old_replace_values ) ) {
							$old_replace_values[] = sprintf( '="%s%s', $old_domain, untrailingslashit( $old_path ) );
							$new_replace_values[] = sprintf( '="%s%s', $new_domain, untrailingslashit( $new_path ) );
						}

						// Add Site URL scheme
						$old_schemes = array( 'http', 'https', '' );
						$new_schemes = array( $new_scheme, $new_scheme, '' );

						// Replace Site URL scheme
						for ( $i = 0; $i < count( $old_schemes ); $i++ ) {

							// Add plain Site URL
							if ( ! in_array( ai1wm_url_scheme( $url, $old_schemes[ $i ] ), $old_replace_values ) ) {
								$old_replace_values[] = ai1wm_url_scheme( $url, $old_schemes[ $i ] );
								$new_replace_values[] = ai1wm_url_scheme( $blog['New']['SiteURL'], $new_schemes[ $i ] );
							}

							// Add URL encoded Site URL
							if ( ! in_array( urlencode( ai1wm_url_scheme( $url, $old_schemes[ $i ] ) ), $old_replace_values ) ) {
								$old_replace_values[] = urlencode( ai1wm_url_scheme( $url, $old_schemes[ $i ] ) );
								$new_replace_values[] = urlencode( ai1wm_url_scheme( $blog['New']['SiteURL'], $new_schemes[ $i ] ) );
							}

							// Add URL raw encoded Site URL
							if ( ! in_array( rawurlencode( ai1wm_url_scheme( $url, $old_schemes[ $i ] ) ), $old_replace_values ) ) {
								$old_replace_values[] = rawurlencode( ai1wm_url_scheme( $url, $old_schemes[ $i ] ) );
								$new_replace_values[] = rawurlencode( ai1wm_url_scheme( $blog['New']['SiteURL'], $new_schemes[ $i ] ) );
							}

							// Add JSON escaped Site URL
							if ( ! in_array( addcslashes( ai1wm_url_scheme( $url, $old_schemes[ $i ] ), '/' ), $old_replace_values ) ) {
								$old_replace_values[] = addcslashes( ai1wm_url_scheme( $url, $old_schemes[ $i ] ), '/' );
								$new_replace_values[] = addcslashes( ai1wm_url_scheme( $blog['New']['SiteURL'], $new_schemes[ $i ] ), '/' );
							}
						}

						// Add email
						if ( ! isset( $config['NoEmailReplace'] ) ) {
							if ( ! in_array( sprintf( '@%s', $old_domain ), $old_replace_values ) ) {
								$old_replace_values[] = sprintf( '@%s', $old_domain );
								$new_replace_values[] = sprintf( '@%s', $new_domain );
							}
						}
					}
				}
			}

			$home_urls = array();

			// Add Home URL
			if ( ! empty( $blog['Old']['HomeURL'] ) ) {
				$home_urls[] = $blog['Old']['HomeURL'];
			}

			// Add Internal Home URL
			if ( ! empty( $blog['Old']['InternalHomeURL'] ) ) {
				if ( parse_url( $blog['Old']['InternalHomeURL'], PHP_URL_SCHEME ) && parse_url( $blog['Old']['InternalHomeURL'], PHP_URL_HOST ) ) {
					$home_urls[] = $blog['Old']['InternalHomeURL'];
				}
			}

			// Get Home URL
			foreach ( $home_urls as $home_url ) {

				// Replace Home URL
				if ( $home_url !== $blog['New']['HomeURL'] ) {

					// Get www URL
					if ( stripos( $home_url, '//www.' ) !== false ) {
						$home_url_www_inversion = str_ireplace( '//www.', '//', $home_url );
					} else {
						$home_url_www_inversion = str_ireplace( '//', '//www.', $home_url );
					}

					// Replace Home URL
					foreach ( array( $home_url, $home_url_www_inversion ) as $url ) {

						// Get domain
						$old_domain = parse_url( $url, PHP_URL_HOST );
						$new_domain = parse_url( $blog['New']['HomeURL'], PHP_URL_HOST );

						// Get path
						$old_path = parse_url( $url, PHP_URL_PATH );
						$new_path = parse_url( $blog['New']['HomeURL'], PHP_URL_PATH );

						// Get scheme
						$new_scheme = parse_url( $blog['New']['HomeURL'], PHP_URL_SCHEME );

						// Add domain and path
						if ( ! in_array( sprintf( "'%s','%s'", $old_domain, trailingslashit( $old_path ) ), $old_replace_raw_values ) ) {
							$old_replace_raw_values[] = sprintf( "'%s','%s'", $old_domain, trailingslashit( $old_path ) );
							$new_replace_raw_values[] = sprintf( "'%s','%s'", $new_domain, trailingslashit( $new_path ) );
						}

						// Add domain and path with single quote
						if ( ! in_array( sprintf( "='%s%s", $old_domain, untrailingslashit( $old_path ) ), $old_replace_values ) ) {
							$old_replace_values[] = sprintf( "='%s%s", $old_domain, untrailingslashit( $old_path ) );
							$new_replace_values[] = sprintf( "='%s%s", $new_domain, untrailingslashit( $new_path ) );
						}

						// Add domain and path with double quote
						if ( ! in_array( sprintf( '="%s%s', $old_domain, untrailingslashit( $old_path ) ), $old_replace_values ) ) {
							$old_replace_values[] = sprintf( '="%s%s', $old_domain, untrailingslashit( $old_path ) );
							$new_replace_values[] = sprintf( '="%s%s', $new_domain, untrailingslashit( $new_path ) );
						}

						// Set Home URL scheme
						$old_schemes = array( 'http', 'https', '' );
						$new_schemes = array( $new_scheme, $new_scheme, '' );

						// Replace Home URL scheme
						for ( $i = 0; $i < count( $old_schemes ); $i++ ) {

							// Add plain Home URL
							if ( ! in_array( ai1wm_url_scheme( $url, $old_schemes[ $i ] ), $old_replace_values ) ) {
								$old_replace_values[] = ai1wm_url_scheme( $url, $old_schemes[ $i ] );
								$new_replace_values[] = ai1wm_url_scheme( $blog['New']['HomeURL'], $new_schemes[ $i ] );
							}

							// Add URL encoded Home URL
							if ( ! in_array( urlencode( ai1wm_url_scheme( $url, $old_schemes[ $i ] ) ), $old_replace_values ) ) {
								$old_replace_values[] = urlencode( ai1wm_url_scheme( $url, $old_schemes[ $i ] ) );
								$new_replace_values[] = urlencode( ai1wm_url_scheme( $blog['New']['HomeURL'], $new_schemes[ $i ] ) );
							}

							// Add URL raw encoded Home URL
							if ( ! in_array( rawurlencode( ai1wm_url_scheme( $url, $old_schemes[ $i ] ) ), $old_replace_values ) ) {
								$old_replace_values[] = rawurlencode( ai1wm_url_scheme( $url, $old_schemes[ $i ] ) );
								$new_replace_values[] = rawurlencode( ai1wm_url_scheme( $blog['New']['HomeURL'], $new_schemes[ $i ] ) );
							}

							// Add JSON escaped Home URL
							if ( ! in_array( addcslashes( ai1wm_url_scheme( $url, $old_schemes[ $i ] ), '/' ), $old_replace_values ) ) {
								$old_replace_values[] = addcslashes( ai1wm_url_scheme( $url, $old_schemes[ $i ] ), '/' );
								$new_replace_values[] = addcslashes( ai1wm_url_scheme( $blog['New']['HomeURL'], $new_schemes[ $i ] ), '/' );
							}
						}

						// Add email
						if ( ! isset( $config['NoEmailReplace'] ) ) {
							if ( ! in_array( sprintf( '@%s', $old_domain ), $old_replace_values ) ) {
								$old_replace_values[] = sprintf( '@%s', $old_domain );
								$new_replace_values[] = sprintf( '@%s', $new_domain );
							}
						}
					}
				}
			}
		}

		$site_urls = array();

		// Add Site URL
		if ( ! empty( $config['SiteURL'] ) ) {
			$site_urls[] = $config['SiteURL'];
		}

		// Add Internal Site URL
		if ( ! empty( $config['InternalSiteURL'] ) ) {
			if ( parse_url( $config['InternalSiteURL'], PHP_URL_SCHEME ) && parse_url( $config['InternalSiteURL'], PHP_URL_HOST ) ) {
				$site_urls[] = $config['InternalSiteURL'];
			}
		}

		// Get Site URL
		foreach ( $site_urls as $site_url ) {

			// Replace Site URL
			if ( $site_url !== site_url() ) {

				// Get www URL
				if ( stripos( $site_url, '//www.' ) !== false ) {
					$site_url_www_inversion = str_ireplace( '//www.', '//', $site_url );
				} else {
					$site_url_www_inversion = str_ireplace( '//', '//www.', $site_url );
				}

				// Replace Site URL
				foreach ( array( $site_url, $site_url_www_inversion ) as $url ) {

					// Get domain
					$old_domain = parse_url( $url, PHP_URL_HOST );
					$new_domain = parse_url( site_url(), PHP_URL_HOST );

					// Get path
					$old_path = parse_url( $url, PHP_URL_PATH );
					$new_path = parse_url( site_url(), PHP_URL_PATH );

					// Get scheme
					$new_scheme = parse_url( site_url(), PHP_URL_SCHEME );

					// Add domain and path
					if ( ! in_array( sprintf( "'%s','%s'", $old_domain, trailingslashit( $old_path ) ), $old_replace_raw_values ) ) {
						$old_replace_raw_values[] = sprintf( "'%s','%s'", $old_domain, trailingslashit( $old_path ) );
						$new_replace_raw_values[] = sprintf( "'%s','%s'", $new_domain, trailingslashit( $new_path ) );
					}

					// Add domain and path with single quote
					if ( ! in_array( sprintf( "='%s%s", $old_domain, untrailingslashit( $old_path ) ), $old_replace_values ) ) {
						$old_replace_values[] = sprintf( "='%s%s", $old_domain, untrailingslashit( $old_path ) );
						$new_replace_values[] = sprintf( "='%s%s", $new_domain, untrailingslashit( $new_path ) );
					}

					// Add domain and path with double quote
					if ( ! in_array( sprintf( '="%s%s', $old_domain, untrailingslashit( $old_path ) ), $old_replace_values ) ) {
						$old_replace_values[] = sprintf( '="%s%s', $old_domain, untrailingslashit( $old_path ) );
						$new_replace_values[] = sprintf( '="%s%s', $new_domain, untrailingslashit( $new_path ) );
					}

					// Set Site URL scheme
					$old_schemes = array( 'http', 'https', '' );
					$new_schemes = array( $new_scheme, $new_scheme, '' );

					// Replace Site URL scheme
					for ( $i = 0; $i < count( $old_schemes ); $i++ ) {

						// Add plain Site URL
						if ( ! in_array( ai1wm_url_scheme( $url, $old_schemes[ $i ] ), $old_replace_values ) ) {
							$old_replace_values[] = ai1wm_url_scheme( $url, $old_schemes[ $i ] );
							$new_replace_values[] = ai1wm_url_scheme( site_url(), $new_schemes[ $i ] );
						}

						// Add URL encoded Site URL
						if ( ! in_array( urlencode( ai1wm_url_scheme( $url, $old_schemes[ $i ] ) ), $old_replace_values ) ) {
							$old_replace_values[] = urlencode( ai1wm_url_scheme( $url, $old_schemes[ $i ] ) );
							$new_replace_values[] = urlencode( ai1wm_url_scheme( site_url(), $new_schemes[ $i ] ) );
						}

						// Add URL raw encoded Site URL
						if ( ! in_array( rawurlencode( ai1wm_url_scheme( $url, $old_schemes[ $i ] ) ), $old_replace_values ) ) {
							$old_replace_values[] = rawurlencode( ai1wm_url_scheme( $url, $old_schemes[ $i ] ) );
							$new_replace_values[] = rawurlencode( ai1wm_url_scheme( site_url(), $new_schemes[ $i ] ) );
						}

						// Add JSON escaped Site URL
						if ( ! in_array( addcslashes( ai1wm_url_scheme( $url, $old_schemes[ $i ] ), '/' ), $old_replace_values ) ) {
							$old_replace_values[] = addcslashes( ai1wm_url_scheme( $url, $old_schemes[ $i ] ), '/' );
							$new_replace_values[] = addcslashes( ai1wm_url_scheme( site_url(), $new_schemes[ $i ] ), '/' );
						}
					}

					// Add email
					if ( ! isset( $config['NoEmailReplace'] ) ) {
						if ( ! in_array( sprintf( '@%s', $old_domain ), $old_replace_values ) ) {
							$old_replace_values[] = sprintf( '@%s', $old_domain );
							$new_replace_values[] = sprintf( '@%s', $new_domain );
						}
					}
				}
			}
		}

		$home_urls = array();

		// Add Home URL
		if ( ! empty( $config['HomeURL'] ) ) {
			$home_urls[] = $config['HomeURL'];
		}

		// Add Internal Home URL
		if ( ! empty( $config['InternalHomeURL'] ) ) {
			if ( parse_url( $config['InternalHomeURL'], PHP_URL_SCHEME ) && parse_url( $config['InternalHomeURL'], PHP_URL_HOST ) ) {
				$home_urls[] = $config['InternalHomeURL'];
			}
		}

		// Get Home URL
		foreach ( $home_urls as $home_url ) {

			// Replace Home URL
			if ( $home_url !== home_url() ) {

				// Get www URL
				if ( stripos( $home_url, '//www.' ) !== false ) {
					$home_url_www_inversion = str_ireplace( '//www.', '//', $home_url );
				} else {
					$home_url_www_inversion = str_ireplace( '//', '//www.', $home_url );
				}

				// Replace Home URL
				foreach ( array( $home_url, $home_url_www_inversion ) as $url ) {

					// Get domain
					$old_domain = parse_url( $url, PHP_URL_HOST );
					$new_domain = parse_url( home_url(), PHP_URL_HOST );

					// Get path
					$old_path = parse_url( $url, PHP_URL_PATH );
					$new_path = parse_url( home_url(), PHP_URL_PATH );

					// Get scheme
					$new_scheme = parse_url( home_url(), PHP_URL_SCHEME );

					// Add domain and path
					if ( ! in_array( sprintf( "'%s','%s'", $old_domain, trailingslashit( $old_path ) ), $old_replace_raw_values ) ) {
						$old_replace_raw_values[] = sprintf( "'%s','%s'", $old_domain, trailingslashit( $old_path ) );
						$new_replace_raw_values[] = sprintf( "'%s','%s'", $new_domain, trailingslashit( $new_path ) );
					}

					// Add domain and path with single quote
					if ( ! in_array( sprintf( "='%s%s", $old_domain, untrailingslashit( $old_path ) ), $old_replace_values ) ) {
						$old_replace_values[] = sprintf( "='%s%s", $old_domain, untrailingslashit( $old_path ) );
						$new_replace_values[] = sprintf( "='%s%s", $new_domain, untrailingslashit( $new_path ) );
					}

					// Add domain and path with double quote
					if ( ! in_array( sprintf( '="%s%s', $old_domain, untrailingslashit( $old_path ) ), $old_replace_values ) ) {
						$old_replace_values[] = sprintf( '="%s%s', $old_domain, untrailingslashit( $old_path ) );
						$new_replace_values[] = sprintf( '="%s%s', $new_domain, untrailingslashit( $new_path ) );
					}

					// Add Home URL scheme
					$old_schemes = array( 'http', 'https', '' );
					$new_schemes = array( $new_scheme, $new_scheme, '' );

					// Replace Home URL scheme
					for ( $i = 0; $i < count( $old_schemes ); $i++ ) {

						// Add plain Home URL
						if ( ! in_array( ai1wm_url_scheme( $url, $old_schemes[ $i ] ), $old_replace_values ) ) {
							$old_replace_values[] = ai1wm_url_scheme( $url, $old_schemes[ $i ] );
							$new_replace_values[] = ai1wm_url_scheme( home_url(), $new_schemes[ $i ] );
						}

						// Add URL encoded Home URL
						if ( ! in_array( urlencode( ai1wm_url_scheme( $url, $old_schemes[ $i ] ) ), $old_replace_values ) ) {
							$old_replace_values[] = urlencode( ai1wm_url_scheme( $url, $old_schemes[ $i ] ) );
							$new_replace_values[] = urlencode( ai1wm_url_scheme( home_url(), $new_schemes[ $i ] ) );
						}

						// Add URL raw encoded Home URL
						if ( ! in_array( rawurlencode( ai1wm_url_scheme( $url, $old_schemes[ $i ] ) ), $old_replace_values ) ) {
							$old_replace_values[] = rawurlencode( ai1wm_url_scheme( $url, $old_schemes[ $i ] ) );
							$new_replace_values[] = rawurlencode( ai1wm_url_scheme( home_url(), $new_schemes[ $i ] ) );
						}

						// Add JSON escaped Home URL
						if ( ! in_array( addcslashes( ai1wm_url_scheme( $url, $old_schemes[ $i ] ), '/' ), $old_replace_values ) ) {
							$old_replace_values[] = addcslashes( ai1wm_url_scheme( $url, $old_schemes[ $i ] ), '/' );
							$new_replace_values[] = addcslashes( ai1wm_url_scheme( home_url(), $new_schemes[ $i ] ), '/' );
						}
					}

					// Add email
					if ( ! isset( $config['NoEmailReplace'] ) ) {
						if ( ! in_array( sprintf( '@%s', $old_domain ), $old_replace_values ) ) {
							$old_replace_values[] = sprintf( '@%s', $old_domain );
							$new_replace_values[] = sprintf( '@%s', $new_domain );
						}
					}
				}
			}
		}

		// Get WordPress Content Dir
		if ( isset( $config['WordPress']['Content'] ) && ( $content_dir = $config['WordPress']['Content'] ) ) {

			// Replace WordPress Content Dir
			if ( $content_dir !== WP_CONTENT_DIR ) {

				// Add plain WordPress Content
				if ( ! in_array( $content_dir, $old_replace_values ) ) {
					$old_replace_values[] = $content_dir;
					$new_replace_values[] = WP_CONTENT_DIR;
				}

				// Add URL encoded WordPress Content
				if ( ! in_array( urlencode( $content_dir ), $old_replace_values ) ) {
					$old_replace_values[] = urlencode( $content_dir );
					$new_replace_values[] = urlencode( WP_CONTENT_DIR );
				}

				// Add URL raw encoded WordPress Content
				if ( ! in_array( rawurlencode( $content_dir ), $old_replace_values ) ) {
					$old_replace_values[] = rawurlencode( $content_dir );
					$new_replace_values[] = rawurlencode( WP_CONTENT_DIR );
				}

				// Add JSON escaped WordPress Content
				if ( ! in_array( addcslashes( $content_dir, '/' ), $old_replace_values ) ) {
					$old_replace_values[] = addcslashes( $content_dir, '/' );
					$new_replace_values[] = addcslashes( WP_CONTENT_DIR, '/' );
				}
			}
		}

		// Get replace old and new values
		if ( isset( $config['Replace'] ) && ( $replace = $config['Replace'] ) ) {
			for ( $i = 0; $i < count( $replace['OldValues'] ); $i++ ) {
				if ( ! empty( $replace['OldValues'][ $i ] ) && ! empty( $replace['NewValues'][ $i ] ) ) {

					// Add plain replace values
					if ( ! in_array( $replace['OldValues'][ $i ], $old_replace_values ) ) {
						$old_replace_values[] = $replace['OldValues'][ $i ];
						$new_replace_values[] = $replace['NewValues'][ $i ];
					}

					// Add URL encoded replace values
					if ( ! in_array( urlencode( $replace['OldValues'][ $i ] ), $old_replace_values ) ) {
						$old_replace_values[] = urlencode( $replace['OldValues'][ $i ] );
						$new_replace_values[] = urlencode( $replace['NewValues'][ $i ] );
					}

					// Add URL raw encoded replace values
					if ( ! in_array( rawurlencode( $replace['OldValues'][ $i ] ), $old_replace_values ) ) {
						$old_replace_values[] = rawurlencode( $replace['OldValues'][ $i ] );
						$new_replace_values[] = rawurlencode( $replace['NewValues'][ $i ] );
					}

					// Add JSON Escaped replace values
					if ( ! in_array( addcslashes( $replace['OldValues'][ $i ], '/' ), $old_replace_values ) ) {
						$old_replace_values[] = addcslashes( $replace['OldValues'][ $i ], '/' );
						$new_replace_values[] = addcslashes( $replace['NewValues'][ $i ], '/' );
					}
				}
			}
		}

		// Get site URL
		$site_url = get_option( AI1WM_SITE_URL );

		// Get home URL
		$home_url = get_option( AI1WM_HOME_URL );

		// Get secret key
		$secret_key = get_option( AI1WM_SECRET_KEY );

		// Get HTTP user
		$auth_user = get_option( AI1WM_AUTH_USER );

		// Get HTTP password
		$auth_password = get_option( AI1WM_AUTH_PASSWORD );

		$old_table_prefixes = array();
		$new_table_prefixes = array();

		// Set main table prefixes
		$old_table_prefixes[] = ai1wm_servmask_prefix( 'mainsite' );
		$new_table_prefixes[] = ai1wm_table_prefix();

		// Set site table prefixes
		foreach ( $blogs as $blog ) {
			if ( ai1wm_main_site( $blog['Old']['BlogID'] ) === false ) {
				$old_table_prefixes[] = ai1wm_servmask_prefix( $blog['Old']['BlogID'] );
				$new_table_prefixes[] = ai1wm_table_prefix( $blog['New']['BlogID'] );
			}
		}

		// Set base table prefixes
		foreach ( $blogs as $blog ) {
			if ( ai1wm_main_site( $blog['Old']['BlogID'] ) === true ) {
				$old_table_prefixes[] = ai1wm_servmask_prefix( 'basesite' );
				$new_table_prefixes[] = ai1wm_table_prefix( $blog['New']['BlogID'] );
			}
		}

		// Set site table prefixes
		foreach ( $blogs as $blog ) {
			if ( ai1wm_main_site( $blog['Old']['BlogID'] ) === true ) {
				$old_table_prefixes[] = ai1wm_servmask_prefix( $blog['Old']['BlogID'] );
				$new_table_prefixes[] = ai1wm_table_prefix( $blog['New']['BlogID'] );
			}
		}

		// Set table prefixes
		$old_table_prefixes[] = ai1wm_servmask_prefix();
		$new_table_prefixes[] = ai1wm_table_prefix();

		// Get database client
		if ( empty( $wpdb->use_mysqli ) ) {
			$mysql = new Ai1wm_Database_Mysql( $wpdb );
		} else {
			$mysql = new Ai1wm_Database_Mysqli( $wpdb );
		}

		// Set database options
		$mysql->set_old_table_prefixes( $old_table_prefixes )
			->set_new_table_prefixes( $new_table_prefixes )
			->set_old_replace_values( $old_replace_values )
			->set_new_replace_values( $new_replace_values )
			->set_old_replace_raw_values( $old_replace_raw_values )
			->set_new_replace_raw_values( $new_replace_raw_values );

		// Flush database
		if ( isset( $config['Plugin']['Version'] ) && ( $version = $config['Plugin']['Version'] ) ) {
			if ( $version !== 'develop' && version_compare( $version, '4.10', '<' ) ) {
				$mysql->set_include_table_prefixes( array( ai1wm_table_prefix() ) );
				$mysql->flush();
			}
		}

		// Set atomic tables (do not stop the current request for all listed tables if timeout has been exceeded)
		$mysql->set_atomic_tables( array( ai1wm_table_prefix() . 'options' ) );

		// Set Visual Composer
		$mysql->set_visual_composer( ai1wm_validate_plugin_basename( 'js_composer/js_composer.php' ) );

		// Set BeTheme Responsive
		$mysql->set_betheme_responsive( ai1wm_validate_theme_basename( 'betheme/style.css' ) );

		// Import database
		if ( $mysql->import( ai1wm_database_path( $params ), $query_offset ) ) {

			// Set progress
			Ai1wm_Status::info( __( 'Done restoring database.', AI1WM_PLUGIN_NAME ) );

			// Unset query offset
			unset( $params['query_offset'] );

			// Unset total queries size
			unset( $params['total_queries_size'] );

			// Unset completed flag
			unset( $params['completed'] );

		} else {

			// Get total queries size
			$total_queries_size = ai1wm_database_bytes( $params );

			// What percent of queries have we processed?
			$progress = (int) ( ( $query_offset / $total_queries_size ) * 100 );

			// Set progress
			Ai1wm_Status::info( sprintf( __( 'Restoring database...<br />%d%% complete', AI1WM_PLUGIN_NAME ), $progress ) );

			// Set query offset
			$params['query_offset'] = $query_offset;

			// Set total queries size
			$params['total_queries_size'] = $total_queries_size;

			// Set completed flag
			$params['completed'] = false;
		}

		// Flush WP cache
		ai1wm_cache_flush();

		// Activate plugins
		ai1wm_activate_plugins( ai1wm_active_servmask_plugins() );

		// Set the new site URL
		update_option( AI1WM_SITE_URL, $site_url );

		// Set the new home URL
		update_option( AI1WM_HOME_URL, $home_url );

		// Set the new secret key value
		update_option( AI1WM_SECRET_KEY, $secret_key );

		// Set the new HTTP user
		update_option( AI1WM_AUTH_USER, $auth_user );

		// Set the new HTTP password
		update_option( AI1WM_AUTH_PASSWORD, $auth_password );

		return $params;
	}
}
