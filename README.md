# All In One WP Migration Fork 
*(from Version 6.77)*

## Notice
This repository originates from [Servmask](https://servmask.com/)'s [All-In-One-WP-Migration Version 6.77](https://downloads.wordpress.org/plugin/all-in-one-wp-migration.6.77.zip), which has the GPLv2 license. I do not claim to be the original author, and I do not claim to have ever had any involvement with Servmask. The modifications that I have made are clearly stated below, and include only one minor change to `constants.php`. 


### Why?
This repository is a fork of the last version of the [All In One WP Migration](https://wordpress.org/plugins/all-in-one-wp-migration/) plugin that easily allows modification of the import file size, and it includes those modifications. By modifying this freely available older version, users can empower themselves to migrate larger sites than they otherwise would be able to. Use at your own risk, and delete the plugin post migration as this older version contains [unpatched security vulnerabilities](https://www.wordfence.com/threat-intel/vulnerabilities/wordpress-plugins/all-in-one-wp-migration). 


### How?
The file upload size limit has been modified to be `32GB`. To change this you may define the limit in byes on line 284 in `constants.php` (if 32 Gigs doesn't float your boat). 

```php
// =================
// = Max File Size =
// =================
define( 'AI1WM_MAX_FILE_SIZE', 34359738368 );
```

### More
If you'd like to review the changes that Servmask has made to this plugin, please refer to the SVN Repository to browse the revision history yourself [here](https://plugins.trac.wordpress.org/log/all-in-one-wp-migration).
