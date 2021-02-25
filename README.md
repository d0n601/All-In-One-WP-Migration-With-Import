# All In One WP Migration Fork ###
### (from Version 6.77) ###

This is the last version of the All In One WP Migration plugin to include the import function. Versions after this (6.78+) required you to download an additional plugin, not hosted in the Wordpress plugin repository. They then removed WP-CLI functionality in versions after.

The file upload size limit has been modified to be `32GB`. To change this you may define the limit in byes on line 284 in `constants.php`.

```php
// =================
// = Max File Size =
// =================
define( 'AI1WM_MAX_FILE_SIZE', 34359738368 );
```


If you'd like to review the changes that Servmask has made to this plugin, please rever to the SVN Repository, and browse the revision history yourself [here](https://plugins.trac.wordpress.org/log/all-in-one-wp-migration).
