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

// ================
// = Plugin Debug =
// ================
define( 'AI1WM_DEBUG', false );

// ==================
// = Plugin Version =
// ==================
define( 'AI1WM_VERSION', '6.77' );

// ===============
// = Plugin Name =
// ===============
define( 'AI1WM_PLUGIN_NAME', 'all-in-one-wp-migration' );

// ============================
// = Directory index.php File =
// ============================
define( 'AI1WM_DIRECTORY_INDEX', 'index.php' );

// ================
// = Storage Path =
// ================
define( 'AI1WM_STORAGE_PATH', AI1WM_PATH . DIRECTORY_SEPARATOR . 'storage' );

// ==================
// = Error Log Path =
// ==================
define( 'AI1WM_ERROR_FILE', AI1WM_STORAGE_PATH . DIRECTORY_SEPARATOR . 'error.log' );

// ===============
// = Status Path =
// ===============
define( 'AI1WM_STATUS_FILE', AI1WM_STORAGE_PATH . DIRECTORY_SEPARATOR . 'status.js' );

// ============
// = Lib Path =
// ============
define( 'AI1WM_LIB_PATH', AI1WM_PATH . DIRECTORY_SEPARATOR . 'lib' );

// ===================
// = Controller Path =
// ===================
define( 'AI1WM_CONTROLLER_PATH', AI1WM_LIB_PATH . DIRECTORY_SEPARATOR . 'controller' );

// ==============
// = Model Path =
// ==============
define( 'AI1WM_MODEL_PATH', AI1WM_LIB_PATH . DIRECTORY_SEPARATOR . 'model' );

// ===============
// = Export Path =
// ===============
define( 'AI1WM_EXPORT_PATH', AI1WM_MODEL_PATH . DIRECTORY_SEPARATOR . 'export' );

// ===============
// = Import Path =
// ===============
define( 'AI1WM_IMPORT_PATH', AI1WM_MODEL_PATH . DIRECTORY_SEPARATOR . 'import' );

// =============
// = View Path =
// =============
define( 'AI1WM_TEMPLATES_PATH', AI1WM_LIB_PATH . DIRECTORY_SEPARATOR . 'view' );

// ===================
// = Set Bandar Path =
// ===================
define( 'BANDAR_TEMPLATES_PATH', AI1WM_TEMPLATES_PATH );

// ===============
// = Vendor Path =
// ===============
define( 'AI1WM_VENDOR_PATH', AI1WM_LIB_PATH . DIRECTORY_SEPARATOR . 'vendor' );

// =========================
// = ServMask Feedback Url =
// =========================
define( 'AI1WM_FEEDBACK_URL', 'https://servmask.com/ai1wm/feedback/create' );

// =======================
// = ServMask Report Url =
// =======================
define( 'AI1WM_REPORT_URL', 'https://servmask.com/ai1wm/report/create' );

// ==============================
// = ServMask Archive Tools Url =
// ==============================
define( 'AI1WM_ARCHIVE_TOOLS_URL', 'https://servmask.com/archive/tools' );

// =========================
// = ServMask Table Prefix =
// =========================
define( 'AI1WM_TABLE_PREFIX', 'SERVMASK_PREFIX_' );

// ========================
// = Archive Backups Name =
// ========================
define( 'AI1WM_BACKUPS_NAME', 'ai1wm-backups' );

// =========================
// = Archive Database Name =
// =========================
define( 'AI1WM_DATABASE_NAME', 'database.sql' );

// ========================
// = Archive Package Name =
// ========================
define( 'AI1WM_PACKAGE_NAME', 'package.json' );

// ==========================
// = Archive Multisite Name =
// ==========================
define( 'AI1WM_MULTISITE_NAME', 'multisite.json' );

// ======================
// = Archive Blogs Name =
// ======================
define( 'AI1WM_BLOGS_NAME', 'blogs.json' );

// =========================
// = Archive Settings Name =
// =========================
define( 'AI1WM_SETTINGS_NAME', 'settings.json' );

// ==========================
// = Archive Multipart Name =
// ==========================
define( 'AI1WM_MULTIPART_NAME', 'multipart.list' );

// ========================
// = Archive Filemap Name =
// ========================
define( 'AI1WM_FILEMAP_NAME', 'filemap.list' );

// =================================
// = Archive Must-Use Plugins Name =
// =================================
define( 'AI1WM_MUPLUGINS_NAME', 'mu-plugins' );

// =============================
// = Endurance Page Cache Name =
// =============================
define( 'AI1WM_ENDURANCE_PAGE_CACHE_NAME', 'endurance-page-cache.php' );

// ===========================
// = Endurance PHP Edge Name =
// ===========================
define( 'AI1WM_ENDURANCE_PHP_EDGE_NAME', 'endurance-php-edge.php' );

// ================================
// = Endurance Browser Cache Name =
// ================================
define( 'AI1WM_ENDURANCE_BROWSER_CACHE_NAME', 'endurance-browser-cache.php' );

// =========================
// = GD System Plugin Name =
// =========================
define( 'AI1WM_GD_SYSTEM_PLUGIN_NAME', 'gd-system-plugin.php' );

// ===================
// = Export Log Name =
// ===================
define( 'AI1WM_EXPORT_NAME', 'export.log' );

// ===================
// = Import Log Name =
// ===================
define( 'AI1WM_IMPORT_NAME', 'import.log' );

// ==================
// = Error Log Name =
// ==================
define( 'AI1WM_ERROR_NAME', 'error.log' );

// ==============
// = Secret Key =
// ==============
define( 'AI1WM_SECRET_KEY', 'ai1wm_secret_key' );

// =============
// = Auth User =
// =============
define( 'AI1WM_AUTH_USER', 'ai1wm_auth_user' );

// =================
// = Auth Password =
// =================
define( 'AI1WM_AUTH_PASSWORD', 'ai1wm_auth_password' );

// ============
// = Site URL =
// ============
define( 'AI1WM_SITE_URL', 'siteurl' );

// ============
// = Home URL =
// ============
define( 'AI1WM_HOME_URL', 'home' );

// ==================
// = Active Plugins =
// ==================
define( 'AI1WM_ACTIVE_PLUGINS', 'active_plugins' );

// ===========================
// = Active Sitewide Plugins =
// ===========================
define( 'AI1WM_ACTIVE_SITEWIDE_PLUGINS', 'active_sitewide_plugins' );

// ==========================
// = Jetpack Active Modules =
// ==========================
define( 'AI1WM_JETPACK_ACTIVE_MODULES', 'jetpack_active_modules' );

// ======================
// = MS Files Rewriting =
// ======================
define( 'AI1WM_MS_FILES_REWRITING', 'ms_files_rewriting' );

// ===================
// = Active Template =
// ===================
define( 'AI1WM_ACTIVE_TEMPLATE', 'template' );

// =====================
// = Active Stylesheet =
// =====================
define( 'AI1WM_ACTIVE_STYLESHEET', 'stylesheet' );

// ============
// = Cron Key =
// ============
define( 'AI1WM_CRON', 'cron' );

// ===============
// = Updater Key =
// ===============
define( 'AI1WM_UPDATER', 'ai1wm_updater' );

// ==============
// = Status Key =
// ==============
define( 'AI1WM_STATUS', 'ai1wm_status' );

// ================
// = Messages Key =
// ================
define( 'AI1WM_MESSAGES', 'ai1wm_messages' );

// =================
// = Support Email =
// =================
define( 'AI1WM_SUPPORT_EMAIL', 'support@servmask.com' );

// =================
// = Max File Size =
// =================
define( 'AI1WM_MAX_FILE_SIZE', 48 << 28 );

// ==================
// = Max Chunk Size =
// ==================
define( 'AI1WM_MAX_CHUNK_SIZE', 5 * 1024 * 1024 );

// =====================
// = Max Chunk Retries =
// =====================
define( 'AI1WM_MAX_CHUNK_RETRIES', 10 );

// ===========================
// = WP_CONTENT_DIR Constant =
// ===========================
if ( ! defined( 'WP_CONTENT_DIR' ) ) {
	define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
}

// ================
// = Uploads Path =
// ================
define( 'AI1WM_UPLOADS_PATH', 'uploads' );

// ==============
// = Blogs Path =
// ==============
define( 'AI1WM_BLOGSDIR_PATH', 'blogs.dir' );

// ==============
// = Sites Path =
// ==============
define( 'AI1WM_SITES_PATH', AI1WM_UPLOADS_PATH . DIRECTORY_SEPARATOR . 'sites' );

// ================
// = Backups Path =
// ================
define( 'AI1WM_BACKUPS_PATH', WP_CONTENT_DIR . DIRECTORY_SEPARATOR . 'ai1wm-backups' );

// ==========================
// = Storage index.php File =
// ==========================
define( 'AI1WM_STORAGE_INDEX', AI1WM_STORAGE_PATH . DIRECTORY_SEPARATOR . 'index.php' );

// ==========================
// = Backups index.php File =
// ==========================
define( 'AI1WM_BACKUPS_INDEX', AI1WM_BACKUPS_PATH . DIRECTORY_SEPARATOR . 'index.php' );

// ==========================
// = Backups .htaccess File =
// ==========================
define( 'AI1WM_BACKUPS_HTACCESS', AI1WM_BACKUPS_PATH . DIRECTORY_SEPARATOR . '.htaccess' );

// ===========================
// = Backups web.config File =
// ===========================
define( 'AI1WM_BACKUPS_WEBCONFIG', AI1WM_BACKUPS_PATH . DIRECTORY_SEPARATOR . 'web.config' );

// ============================
// = WordPress .htaccess File =
// ============================
define( 'AI1WM_WORDPRESS_HTACCESS', ABSPATH . DIRECTORY_SEPARATOR . '.htaccess' );

// ================================
// = WP Migration Plugin Base Dir =
// ================================
if ( defined( 'AI1WM_PLUGIN_BASENAME' ) ) {
	define( 'AI1WM_PLUGIN_BASEDIR', dirname( AI1WM_PLUGIN_BASENAME ) );
} else {
	define( 'AI1WM_PLUGIN_BASEDIR', 'all-in-one-wp-migration' );
}

// ======================================
// = Microsoft Azure Extension Base Dir =
// ======================================
if ( defined( 'AI1WMZE_PLUGIN_BASENAME' ) ) {
	define( 'AI1WMZE_PLUGIN_BASEDIR', dirname( AI1WMZE_PLUGIN_BASENAME ) );
} else {
	define( 'AI1WMZE_PLUGIN_BASEDIR', 'all-in-one-wp-migration-azure-storage-extension' );
}

// ===================================
// = Microsoft Azure Extension Title =
// ===================================
if ( ! defined( 'AI1WMZE_PLUGIN_TITLE' ) ) {
	define( 'AI1WMZE_PLUGIN_TITLE', 'Microsoft Azure Storage Extension' );
}

// ===================================
// = Microsoft Azure Extension About =
// ===================================
if ( ! defined( 'AI1WMZE_PLUGIN_ABOUT' ) ) {
	define( 'AI1WMZE_PLUGIN_ABOUT', 'https://servmask.com/products/microsoft-azure-storage-extension/about' );
}

// =================================
// = Microsoft Azure Extension Key =
// =================================
if ( ! defined( 'AI1WMZE_PLUGIN_KEY' ) ) {
	define( 'AI1WMZE_PLUGIN_KEY', 'ai1wmze_plugin_key' );
}

// ===================================
// = Microsoft Azure Extension Short =
// ===================================
if ( ! defined( 'AI1WMZE_PLUGIN_SHORT' ) ) {
	define( 'AI1WMZE_PLUGIN_SHORT', 'azure-storage' );
}

// ===================================
// = Backblaze B2 Extension Base Dir =
// ===================================
if ( defined( 'AI1WMAE_PLUGIN_BASENAME' ) ) {
	define( 'AI1WMAE_PLUGIN_BASEDIR', dirname( AI1WMAE_PLUGIN_BASENAME ) );
} else {
	define( 'AI1WMAE_PLUGIN_BASEDIR', 'all-in-one-wp-migration-b2-extension' );
}

// ================================
// = Backblaze B2 Extension Title =
// ================================
if ( ! defined( 'AI1WMAE_PLUGIN_TITLE' ) ) {
	define( 'AI1WMAE_PLUGIN_TITLE', 'Backblaze B2 Extension' );
}

// ================================
// = Backblaze B2 Extension About =
// ================================
if ( ! defined( 'AI1WMAE_PLUGIN_ABOUT' ) ) {
	define( 'AI1WMAE_PLUGIN_ABOUT', 'https://servmask.com/products/backblaze-b2-extension/about' );
}

// ==============================
// = Backblaze B2 Extension Key =
// ==============================
if ( ! defined( 'AI1WMAE_PLUGIN_KEY' ) ) {
	define( 'AI1WMAE_PLUGIN_KEY', 'ai1wmae_plugin_key' );
}

// ================================
// = Backblaze B2 Extension Short =
// ================================
if ( ! defined( 'AI1WMAE_PLUGIN_SHORT' ) ) {
	define( 'AI1WMAE_PLUGIN_SHORT', 'b2' );
}

// ==========================
// = Box Extension Base Dir =
// ==========================
if ( defined( 'AI1WMBE_PLUGIN_BASENAME' ) ) {
	define( 'AI1WMBE_PLUGIN_BASEDIR', dirname( AI1WMBE_PLUGIN_BASENAME ) );
} else {
	define( 'AI1WMBE_PLUGIN_BASEDIR', 'all-in-one-wp-migration-box-extension' );
}

// =======================
// = Box Extension Title =
// =======================
if ( ! defined( 'AI1WMBE_PLUGIN_TITLE' ) ) {
	define( 'AI1WMBE_PLUGIN_TITLE', 'Box Extension' );
}

// =======================
// = Box Extension About =
// =======================
if ( ! defined( 'AI1WMBE_PLUGIN_ABOUT' ) ) {
	define( 'AI1WMBE_PLUGIN_ABOUT', 'https://servmask.com/products/box-extension/about' );
}

// =====================
// = Box Extension Key =
// =====================
if ( ! defined( 'AI1WMBE_PLUGIN_KEY' ) ) {
	define( 'AI1WMBE_PLUGIN_KEY', 'ai1wmbe_plugin_key' );
}

// =======================
// = Box Extension Short =
// =======================
if ( ! defined( 'AI1WMBE_PLUGIN_SHORT' ) ) {
	define( 'AI1WMBE_PLUGIN_SHORT', 'box' );
}

// ===================================
// = DigitalOcean Extension Base Dir =
// ===================================
if ( defined( 'AI1WMIE_PLUGIN_BASENAME' ) ) {
	define( 'AI1WMIE_PLUGIN_BASEDIR', dirname( AI1WMIE_PLUGIN_BASENAME ) );
} else {
	define( 'AI1WMIE_PLUGIN_BASEDIR', 'all-in-one-wp-migration-digitalocean-extension' );
}

// ================================
// = DigitalOcean Extension Title =
// ================================
if ( ! defined( 'AI1WMIE_PLUGIN_TITLE' ) ) {
	define( 'AI1WMIE_PLUGIN_TITLE', 'DigitalOcean Spaces Extension' );
}

// ================================
// = DigitalOcean Extension About =
// ================================
if ( ! defined( 'AI1WMIE_PLUGIN_ABOUT' ) ) {
	define( 'AI1WMIE_PLUGIN_ABOUT', 'https://servmask.com/products/digitalocean-spaces-extension/about' );
}

// ==============================
// = DigitalOcean Extension Key =
// ==============================
if ( ! defined( 'AI1WMIE_PLUGIN_KEY' ) ) {
	define( 'AI1WMIE_PLUGIN_KEY', 'ai1wmie_plugin_key' );
}

// ================================
// = DigitalOcean Extension Short =
// ================================
if ( ! defined( 'AI1WMIE_PLUGIN_SHORT' ) ) {
	define( 'AI1WMIE_PLUGIN_SHORT', 'digitalocean' );
}

// ==============================
// = Dropbox Extension Base Dir =
// ==============================
if ( defined( 'AI1WMDE_PLUGIN_BASENAME' ) ) {
	define( 'AI1WMDE_PLUGIN_BASEDIR', dirname( AI1WMDE_PLUGIN_BASENAME ) );
} else {
	define( 'AI1WMDE_PLUGIN_BASEDIR', 'all-in-one-wp-migration-dropbox-extension' );
}

// ===========================
// = Dropbox Extension Title =
// ===========================
if ( ! defined( 'AI1WMDE_PLUGIN_TITLE' ) ) {
	define( 'AI1WMDE_PLUGIN_TITLE', 'Dropbox Extension' );
}

// ===========================
// = Dropbox Extension About =
// ===========================
if ( ! defined( 'AI1WMDE_PLUGIN_ABOUT' ) ) {
	define( 'AI1WMDE_PLUGIN_ABOUT', 'https://servmask.com/products/dropbox-extension/about' );
}

// =========================
// = Dropbox Extension Key =
// =========================
if ( ! defined( 'AI1WMDE_PLUGIN_KEY' ) ) {
	define( 'AI1WMDE_PLUGIN_KEY', 'ai1wmde_plugin_key' );
}

// ===========================
// = Dropbox Extension Short =
// ===========================
if ( ! defined( 'AI1WMDE_PLUGIN_SHORT' ) ) {
	define( 'AI1WMDE_PLUGIN_SHORT', 'dropbox' );
}

// ==========================
// = FTP Extension Base Dir =
// ==========================
if ( defined( 'AI1WMFE_PLUGIN_BASENAME' ) ) {
	define( 'AI1WMFE_PLUGIN_BASEDIR', dirname( AI1WMFE_PLUGIN_BASENAME ) );
} else {
	define( 'AI1WMFE_PLUGIN_BASEDIR', 'all-in-one-wp-migration-ftp-extension' );
}

// =======================
// = FTP Extension Title =
// =======================
if ( ! defined( 'AI1WMFE_PLUGIN_TITLE' ) ) {
	define( 'AI1WMFE_PLUGIN_TITLE', 'FTP Extension' );
}

// =======================
// = FTP Extension About =
// =======================
if ( ! defined( 'AI1WMFE_PLUGIN_ABOUT' ) ) {
	define( 'AI1WMFE_PLUGIN_ABOUT', 'https://servmask.com/products/ftp-extension/about' );
}

// =====================
// = FTP Extension Key =
// =====================
if ( ! defined( 'AI1WMFE_PLUGIN_KEY' ) ) {
	define( 'AI1WMFE_PLUGIN_KEY', 'ai1wmfe_plugin_key' );
}

// =======================
// = FTP Extension Short =
// =======================
if ( ! defined( 'AI1WMFE_PLUGIN_SHORT' ) ) {
	define( 'AI1WMFE_PLUGIN_SHORT', 'ftp' );
}

// ===========================================
// = Google Cloud Storage Extension Base Dir =
// ===========================================
if ( defined( 'AI1WMCE_PLUGIN_BASENAME' ) ) {
	define( 'AI1WMCE_PLUGIN_BASEDIR', dirname( AI1WMCE_PLUGIN_BASENAME ) );
} else {
	define( 'AI1WMCE_PLUGIN_BASEDIR', 'all-in-one-wp-migration-gcloud-storage-extension' );
}

// ========================================
// = Google Cloud Storage Extension Title =
// ========================================
if ( ! defined( 'AI1WMCE_PLUGIN_TITLE' ) ) {
	define( 'AI1WMCE_PLUGIN_TITLE', 'Google Cloud Storage Extension' );
}

// ========================================
// = Google Cloud Storage Extension About =
// ========================================
if ( ! defined( 'AI1WMCE_PLUGIN_ABOUT' ) ) {
	define( 'AI1WMCE_PLUGIN_ABOUT', 'https://servmask.com/products/google-cloud-storage-extension/about' );
}

// ======================================
// = Google Cloud Storage Extension Key =
// ======================================
if ( ! defined( 'AI1WMCE_PLUGIN_KEY' ) ) {
	define( 'AI1WMCE_PLUGIN_KEY', 'ai1wmce_plugin_key' );
}

// ========================================
// = Google Cloud Storage Extension Short =
// ========================================
if ( ! defined( 'AI1WMCE_PLUGIN_SHORT' ) ) {
	define( 'AI1WMCE_PLUGIN_SHORT', 'gcloud-storage' );
}

// ===================================
// = Google Drive Extension Base Dir =
// ===================================
if ( defined( 'AI1WMGE_PLUGIN_BASENAME' ) ) {
	define( 'AI1WMGE_PLUGIN_BASEDIR', dirname( AI1WMGE_PLUGIN_BASENAME ) );
} else {
	define( 'AI1WMGE_PLUGIN_BASEDIR', 'all-in-one-wp-migration-gdrive-extension' );
}

// ================================
// = Google Drive Extension Title =
// ================================
if ( ! defined( 'AI1WMGE_PLUGIN_TITLE' ) ) {
	define( 'AI1WMGE_PLUGIN_TITLE', 'Google Drive Extension' );
}

// ================================
// = Google Drive Extension About =
// ================================
if ( ! defined( 'AI1WMGE_PLUGIN_ABOUT' ) ) {
	define( 'AI1WMGE_PLUGIN_ABOUT', 'https://servmask.com/products/google-drive-extension/about' );
}

// ==============================
// = Google Drive Extension Key =
// ==============================
if ( ! defined( 'AI1WMGE_PLUGIN_KEY' ) ) {
	define( 'AI1WMGE_PLUGIN_KEY', 'ai1wmge_plugin_key' );
}

// ================================
// = Google Drive Extension Short =
// ================================
if ( ! defined( 'AI1WMGE_PLUGIN_SHORT' ) ) {
	define( 'AI1WMGE_PLUGIN_SHORT', 'gdrive' );
}

// =====================================
// = Amazon Glacier Extension Base Dir =
// =====================================
if ( defined( 'AI1WMRE_PLUGIN_BASENAME' ) ) {
	define( 'AI1WMRE_PLUGIN_BASEDIR', dirname( AI1WMRE_PLUGIN_BASENAME ) );
} else {
	define( 'AI1WMRE_PLUGIN_BASEDIR', 'all-in-one-wp-migration-glacier-extension' );
}

// ==================================
// = Amazon Glacier Extension Title =
// ==================================
if ( ! defined( 'AI1WMRE_PLUGIN_TITLE' ) ) {
	define( 'AI1WMRE_PLUGIN_TITLE', 'Amazon Glacier Extension' );
}

// ==================================
// = Amazon Glacier Extension About =
// ==================================
if ( ! defined( 'AI1WMRE_PLUGIN_ABOUT' ) ) {
	define( 'AI1WMRE_PLUGIN_ABOUT', 'https://servmask.com/products/amazon-glacier-extension/about' );
}

// ================================
// = Amazon Glacier Extension Key =
// ================================
if ( ! defined( 'AI1WMRE_PLUGIN_KEY' ) ) {
	define( 'AI1WMRE_PLUGIN_KEY', 'ai1wmre_plugin_key' );
}

// ==================================
// = Amazon Glacier Extension Short =
// ==================================
if ( ! defined( 'AI1WMRE_PLUGIN_SHORT' ) ) {
	define( 'AI1WMRE_PLUGIN_SHORT', 'glacier' );
}

// ===========================
// = Mega Extension Base Dir =
// ===========================
if ( defined( 'AI1WMEE_PLUGIN_BASENAME' ) ) {
	define( 'AI1WMEE_PLUGIN_BASEDIR', dirname( AI1WMEE_PLUGIN_BASENAME ) );
} else {
	define( 'AI1WMEE_PLUGIN_BASEDIR', 'all-in-one-wp-migration-mega-extension' );
}

// ========================
// = Mega Extension Title =
// ========================
if ( ! defined( 'AI1WMEE_PLUGIN_TITLE' ) ) {
	define( 'AI1WMEE_PLUGIN_TITLE', 'Mega Extension' );
}

// ========================
// = Mega Extension About =
// ========================
if ( ! defined( 'AI1WMEE_PLUGIN_ABOUT' ) ) {
	define( 'AI1WMEE_PLUGIN_ABOUT', 'https://servmask.com/products/mega-extension/about' );
}

// ======================
// = Mega Extension Key =
// ======================
if ( ! defined( 'AI1WMEE_PLUGIN_KEY' ) ) {
	define( 'AI1WMEE_PLUGIN_KEY', 'ai1wmee_plugin_key' );
}

// ========================
// = Mega Extension Short =
// ========================
if ( ! defined( 'AI1WMEE_PLUGIN_SHORT' ) ) {
	define( 'AI1WMEE_PLUGIN_SHORT', 'mega' );
}

// ================================
// = Multisite Extension Base Dir =
// ================================
if ( defined( 'AI1WMME_PLUGIN_BASENAME' ) ) {
	define( 'AI1WMME_PLUGIN_BASEDIR', dirname( AI1WMME_PLUGIN_BASENAME ) );
} else {
	define( 'AI1WMME_PLUGIN_BASEDIR', 'all-in-one-wp-migration-multisite-extension' );
}

// =============================
// = Multisite Extension Title =
// =============================
if ( ! defined( 'AI1WMME_PLUGIN_TITLE' ) ) {
	define( 'AI1WMME_PLUGIN_TITLE', 'Multisite Extension' );
}

// =============================
// = Multisite Extension About =
// =============================
if ( ! defined( 'AI1WMME_PLUGIN_ABOUT' ) ) {
	define( 'AI1WMME_PLUGIN_ABOUT', 'https://servmask.com/products/multisite-extension/about' );
}

// ===========================
// = Multisite Extension Key =
// ===========================
if ( ! defined( 'AI1WMME_PLUGIN_KEY' ) ) {
	define( 'AI1WMME_PLUGIN_KEY', 'ai1wmme_plugin_key' );
}

// =============================
// = Multisite Extension Short =
// =============================
if ( ! defined( 'AI1WMME_PLUGIN_SHORT' ) ) {
	define( 'AI1WMME_PLUGIN_SHORT', 'multisite' );
}

// ===============================
// = OneDrive Extension Base Dir =
// ===============================
if ( defined( 'AI1WMOE_PLUGIN_BASENAME' ) ) {
	define( 'AI1WMOE_PLUGIN_BASEDIR', dirname( AI1WMOE_PLUGIN_BASENAME ) );
} else {
	define( 'AI1WMOE_PLUGIN_BASEDIR', 'all-in-one-wp-migration-onedrive-extension' );
}

// ============================
// = OneDrive Extension Title =
// ============================
if ( ! defined( 'AI1WMOE_PLUGIN_TITLE' ) ) {
	define( 'AI1WMOE_PLUGIN_TITLE', 'OneDrive Extension' );
}

// ============================
// = OneDrive Extension About =
// ============================
if ( ! defined( 'AI1WMOE_PLUGIN_ABOUT' ) ) {
	define( 'AI1WMOE_PLUGIN_ABOUT', 'https://servmask.com/products/onedrive-extension/about' );
}

// ==========================
// = OneDrive Extension Key =
// ==========================
if ( ! defined( 'AI1WMOE_PLUGIN_KEY' ) ) {
	define( 'AI1WMOE_PLUGIN_KEY', 'ai1wmoe_plugin_key' );
}

// ============================
// = OneDrive Extension Short =
// ============================
if ( ! defined( 'AI1WMOE_PLUGIN_SHORT' ) ) {
	define( 'AI1WMOE_PLUGIN_SHORT', 'onedrive' );
}

// =============================
// = pCloud Extension Base Dir =
// =============================
if ( defined( 'AI1WMPE_PLUGIN_BASENAME' ) ) {
	define( 'AI1WMPE_PLUGIN_BASEDIR', dirname( AI1WMPE_PLUGIN_BASENAME ) );
} else {
	define( 'AI1WMPE_PLUGIN_BASEDIR', 'all-in-one-wp-migration-pcloud-extension' );
}

// ==========================
// = pCloud Extension Title =
// ==========================
if ( ! defined( 'AI1WMPE_PLUGIN_TITLE' ) ) {
	define( 'AI1WMPE_PLUGIN_TITLE', 'pCloud Extension' );
}

// ==========================
// = pCloud Extension About =
// ==========================
if ( ! defined( 'AI1WMPE_PLUGIN_ABOUT' ) ) {
	define( 'AI1WMPE_PLUGIN_ABOUT', 'https://servmask.com/products/pcloud-extension/about' );
}

// ========================
// = pCloud Extension Key =
// ========================
if ( ! defined( 'AI1WMPE_PLUGIN_KEY' ) ) {
	define( 'AI1WMPE_PLUGIN_KEY', 'ai1wmpe_plugin_key' );
}

// ==========================
// = pCloud Extension short =
// ==========================
if ( ! defined( 'AI1WMPE_PLUGIN_SHORT' ) ) {
	define( 'AI1WMPE_PLUGIN_SHORT', 'pcloud' );
}

// ================================
// = Amazon S3 Extension Base Dir =
// ================================
if ( defined( 'AI1WMSE_PLUGIN_BASENAME' ) ) {
	define( 'AI1WMSE_PLUGIN_BASEDIR', dirname( AI1WMSE_PLUGIN_BASENAME ) );
} else {
	define( 'AI1WMSE_PLUGIN_BASEDIR', 'all-in-one-wp-migration-s3-extension' );
}

// =============================
// = Amazon S3 Extension Title =
// =============================
if ( ! defined( 'AI1WMSE_PLUGIN_TITLE' ) ) {
	define( 'AI1WMSE_PLUGIN_TITLE', 'Amazon S3 Extension' );
}

// =============================
// = Amazon S3 Extension About =
// =============================
if ( ! defined( 'AI1WMSE_PLUGIN_ABOUT' ) ) {
	define( 'AI1WMSE_PLUGIN_ABOUT', 'https://servmask.com/products/amazon-s3-extension/about' );
}

// ===========================
// = Amazon S3 Extension Key =
// ===========================
if ( ! defined( 'AI1WMSE_PLUGIN_KEY' ) ) {
	define( 'AI1WMSE_PLUGIN_KEY', 'ai1wmse_plugin_key' );
}

// =============================
// = Amazon S3 Extension Short =
// =============================
if ( ! defined( 'AI1WMSE_PLUGIN_SHORT' ) ) {
	define( 'AI1WMSE_PLUGIN_SHORT', 's3' );
}

// ================================
// = Unlimited Extension Base Dir =
// ================================
if ( defined( 'AI1WMUE_PLUGIN_BASENAME' ) ) {
	define( 'AI1WMUE_PLUGIN_BASEDIR', dirname( AI1WMUE_PLUGIN_BASENAME ) );
} else {
	define( 'AI1WMUE_PLUGIN_BASEDIR', 'all-in-one-wp-migration-unlimited-extension' );
}

// =============================
// = Unlimited Extension Title =
// =============================
if ( ! defined( 'AI1WMUE_PLUGIN_TITLE' ) ) {
	define( 'AI1WMUE_PLUGIN_TITLE', 'Unlimited Extension' );
}

// =============================
// = Unlimited Extension About =
// =============================
if ( ! defined( 'AI1WMUE_PLUGIN_ABOUT' ) ) {
	define( 'AI1WMUE_PLUGIN_ABOUT', 'https://servmask.com/products/unlimited-extension/about' );
}

// ===========================
// = Unlimited Extension Key =
// ===========================
if ( ! defined( 'AI1WMUE_PLUGIN_KEY' ) ) {
	define( 'AI1WMUE_PLUGIN_KEY', 'ai1wmue_plugin_key' );
}

// =============================
// = Unlimited Extension Short =
// =============================
if ( ! defined( 'AI1WMUE_PLUGIN_SHORT' ) ) {
	define( 'AI1WMUE_PLUGIN_SHORT', 'unlimited' );
}

// ==========================
// = URL Extension Base Dir =
// ==========================
if ( defined( 'AI1WMLE_PLUGIN_BASENAME' ) ) {
	define( 'AI1WMLE_PLUGIN_BASEDIR', dirname( AI1WMLE_PLUGIN_BASENAME ) );
} else {
	define( 'AI1WMLE_PLUGIN_BASEDIR', 'all-in-one-wp-migration-url-extension' );
}

// =======================
// = URL Extension Title =
// =======================
if ( ! defined( 'AI1WMLE_PLUGIN_TITLE' ) ) {
	define( 'AI1WMLE_PLUGIN_TITLE', 'URL Extension' );
}

// =======================
// = URL Extension About =
// =======================
if ( ! defined( 'AI1WMLE_PLUGIN_ABOUT' ) ) {
	define( 'AI1WMLE_PLUGIN_ABOUT', 'https://servmask.com/products/url-extension/about' );
}

// =====================
// = URL Extension Key =
// =====================
if ( ! defined( 'AI1WMLE_PLUGIN_KEY' ) ) {
	define( 'AI1WMLE_PLUGIN_KEY', 'ai1wmle_plugin_key' );
}

// =======================
// = URL Extension Short =
// =======================
if ( ! defined( 'AI1WMLE_PLUGIN_SHORT' ) ) {
	define( 'AI1WMLE_PLUGIN_SHORT', 'url' );
}
