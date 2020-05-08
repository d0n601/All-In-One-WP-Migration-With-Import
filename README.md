# All In One WP Migration Fork ###
### (from Version 6.77) ###

This is the last version of the All In One WP Migration plugin to include the import function. Versions after this (6.78+) require you to download an additional plugin, not hosted in the Wordpress plugin repository, which is a very large security risk.

The file upload size limit has been modified to be `32GB`. To change this you may define the limit in byes on line 284 in `constants.php`.

```php
// =================
// = Max File Size =
// =================
define( 'AI1WM_MAX_FILE_SIZE', 34359738368 );
```


The original version 6.77 can also be found [here](https://downloads.wordpress.org/plugin/all-in-one-wp-migration.6.77.zip).
