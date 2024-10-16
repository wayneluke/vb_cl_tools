<?php
/*=========================================================================*\
|| ####################################################################### ||
|| # vBulletin Core Configuration                                        # ||
|| # vBulletin 6.0.4 Release Candidate 2
|| # ------------------------------------------------------------------- # ||
|| # Copyright 2000-2024 MH Sub I, LLC dba vBulletin. All Rights Reserved.  # ||
|| # This file may not be redistributed in whole or significant part.    # ||
|| # ----------------- VBULLETIN IS NOT FREE SOFTWARE ------------------ # ||
|| # http://www.vbulletin.com | http://www.vbulletin.com/license.html    # ||
|| ####################################################################### ||
\*=========================================================================*/

ini_set('display_errors', 0);
ini_set('log_errors',1);
ini_set("error_log", dirname(__DIR__,2) . "/logs/php_error.log");
error_reporting(E_ALL);
date_default_timezone_set('America/Los_Angeles');

// Skips checking file integrity hash on upgrade.
DEFINE ('SKIP_UPGRADE_FILE_CHECK',1);
 
/*----------------------------------------------------------------------*\
|        ****** NOTE REGARDING THE VARIABLES IN THIS FILE ******         |
+------------------------------------------------------------------------+
| If you get any errors while attempting to connect to MySQL, you will   |
| need to email your webhost because we cannot tell you the correct      |
| values for the variables in this file.                                 |
|                                                                        |
| When making changes to the file, the edit should always be to the      |
| right of the = sign between the single quotes                          |
| Default: $config['MasterServer']['username'] = 'root';                 |
| Example: $config['MasterServer']['username'] = 'myuser';  GOOD!        |
| Example: $config['MasterServer']['myuser'] = 'root';      BAD!         |
\*----------------------------------------------------------------------*/

    //    ****** DATABASE NAME ******
    //    This is the name of the database where your vBulletin will be located.
    //    This must be created by your webhost.
$config['Database']['dbname'] = 'forum';

    //    ****** TABLE PREFIX ******
    //    Prefix that your vBulletin tables have in the database.
$config['Database']['tableprefix'] = '';

    //    ****** TECHNICAL EMAIL ADDRESS ******
    //    If any database errors occur, they will be emailed to the address specified here.
    //    Leave this blank to not send any emails when there is a database error.
$config['Database']['technicalemail'] = 'dbmaster@example.com';

    //    ****** DATABASE ERROR LOG FILE ******
    //    If you would like to log all database errors to a file, enter the path to the file here.
    //    The file will be saved as {filename}.log.
    //    Errors connecting to the database server will not be logged. Such errors can be emailed
    //    to you via the setting the $config['Database']['technicalemail'] config.
    //    Please note that the directory in which this file is to be created must be writable by
    //    the web server.
$config['Database']['logfile'] = '/volumes/secondary/sites/vbulletin/manual/logs/database.log';

    //    ****** DATABASE ERROR LOG MAX FILE SIZE ******
    //    If you would like your database error logs to be rotated when they reach a certain size,
    //    enter the maximum file-size in bytes here.
    //    1048576 bytes = 1 megabyte.
    //    When a log file reaches this size, it will be renamed as {filename}{unix timestamp}.log
    //    and a new file will be created.
    //    Set this value to 0 to disable database error log rotation.
$config['Database']['errorlogmaxsize'] = '1048576';

    //    ****** MASTER DATABASE SERVER NAME AND PORT ******
    //    This is the hostname or IP address and port of the database server.
    //    If you are unsure of what to put here, leave the default values.
    //
    //    Note: If you are using IIS 7+ and MySQL is on the same machine, you
    //    need to use 127.0.0.1 instead of localhost
$config['MasterServer']['servername'] = 'localhost';
$config['MasterServer']['port'] = 3306;

    //    ****** MASTER DATABASE USERNAME & PASSWORD ******
    //    This is the username and password you use to access MySQL.
    //    These must be obtained through your webhost.
$config['MasterServer']['username'] = 'root';
$config['MasterServer']['password'] = 'password';

    //    ****** MASTER DATABASE PERSISTENT CONNECTIONS ******
    //    This option allows you to turn persistent connections to MySQL on or off.
    //    The difference in performance is negligible for all but the largest boards.
    //    If you are unsure what this should be, leave it off. (0 = off; 1 = on)
$config['MasterServer']['usepconnect'] = 0;

    //    ****** SLAVE DATABASE CONFIGURATION ******
    //    If you have multiple database backends, this is the information for your slave
    //    server. If you are not 100% sure you need to fill in this information,
    //    do not change any of the values here.
$config['SlaveServer']['servername'] = '';
$config['SlaveServer']['port'] = 3306;
$config['SlaveServer']['username'] = '';
$config['SlaveServer']['password'] = '';
$config['SlaveServer']['usepconnect'] = 0;


    //    ****** PATH TO MODERATOR CONTROL PANELS ******
    //    This setting allows you to change the name of the folders that the
    //    moderator control panels reside in. You may wish to do this for security purposes.
    //    Please note that if you change the name of the directory here, you will still need
    //    to manually change the name of the directory on the server.

$config['Misc']['modcpdir'] = 'modcp';

    //    Prefix that all vBulletin cookies will have
    //    Keep this short and only use numbers and letters, i.e. 1-9 and a-Z
$config['Misc']['cookieprefix'] = 'bb_';

    //    ******** FULL PATH TO FORUMS DIRECTORY ******
    //    On a few systems it may be necessary to input the full path to your forums directory
    //    for vBulletin to function normally. You can ignore this setting unless vBulletin
    //    tells you to fill this in. Do not include a trailing slash!
    //    Example Unix:
    //      $config['Misc']['forumpath'] = '/home/users/public_html/forums';
    //    Example Win32:
    //      $config['Misc']['forumpath'] = 'c:\program files\apache group\apache\htdocs\vb3';
$config['Misc']['forumpath'] = '';

    //    ******** FRONTEND (SITE) URL ******
    //    On a few systems it may be necessary to input the base url.
    //    This should be the same setting as $config['baseurl'] in the frontend config file
    //    You do not need to fill this in unless instructed by vBulletin Support.
	//	  Do not include a trailing slash.
    //    Example: $config['Misc']['baseurl'] = 'http://www.mysite.comt/forums';
$config['Misc']['baseurl'] = '';

    //    ****** USERS WITH ADMIN LOG VIEWING PERMISSIONS ******
    //    The userids specified here will be allowed to view the admin log in the control panel.
    //    Users must be specified by *ID number* here. To obtain a user's ID number,
    //    view their profile via the control panel. If this is a new installation, leave
    //    the first user created will have a user ID of 1. Seperate each userid with a comma.
$config['SpecialUsers']['canviewadminlog'] = '1';

    //    ****** USERS WITH ADMIN LOG PRUNING PERMISSIONS ******
    //    The userids specified here will be allowed to remove ("prune") entries from the admin
    //    log. See the above entry for more information on the format.
$config['SpecialUsers']['canpruneadminlog'] = '1';

    //    ****** USERS WITH QUERY RUNNING PERMISSIONS ******
    //    The userids specified here will be allowed to run queries from the control panel.
    //    See the above entries for more information on the format.
    //    Please note that the ability to run queries is quite powerful. You may wish
    //    to remove all user IDs from this list for security reasons.
$config['SpecialUsers']['canrunqueries'] = '1';

    //    ****** UNDELETABLE / UNALTERABLE USERS ******
    //    The userids specified here will not be deletable or alterable from the control panel by any users.
    //    To specify more than one user, separate userids with commas.
$config['SpecialUsers']['undeletableusers'] = '';

    //    ****** SUPER ADMINISTRATORS ******
    //    The userids specified below will have permission to access all areas of vBulletin 5.
    //    Note that this is different to vB3 & vB4 where they only had extra permissions in the
    //    Admin Control Panel. Be very careful who you grant this super power to.
    //    The name of this setting has changed from superadministrator to superadmins.
    //    This is to avoid the accidental granting of this permission when using older config files.
$config['SpecialUsers']['superadmins'] = '1';

    // ****** CACHE CONFIGURATION *****
    // Here you can configure different methods for caching items.
    // The following are the cacheing classes that can be used.
    // vB_Cache_Db - This setting stores the data in the database
    // vB_Cache_APC - This setting stores the data in APC
    // vB_Cache_Memcached - This stores the data in memcache
    // vB_Cache_Memory - This setting uses php's memory while a page is being generated.
    // Each cache area can use its own cache type.
$config['Cache']['class'][0] = 'vB_Cache_Db'; //regular cache
$config['Cache']['class'][1] = 'vB_Cache_Memory'; //fastest cache
$config['Cache']['class'][2] = 'vB_Cache_Db'; //largest cache and longest life.

//vB keeps a copy of all items loaded from the cache in local memory.
//Normally this is cleared at the end of a page load, but for some long running
//operations -- particularly command line scripts -- this can cause out of memory errors.
//Setting these will cause vB to clear out old cache entries to mitigate these problems.
//These values will be applied to all caches.

//$config['Cache']['maxmemoryitems'] = 10000; //Number of items allowed in memory per cache. 0/null/unset is unlimited
//$config['Cache']['memorycheckinterval'] = 100; //The number of item writes between checks.  Lower number means more frequent checks.

// If these are not set they default to 0 .
//$config['Cache']['maxtablesize'] = 500; //When clearing expired cache items if the cache table exceed this size (in Mb) additonal items will be removed.  If 0 then cache is unlimited.
//$config['Cache']['maxtabledeletecount'] = 0; //Number of (unexpired) records to remove when the cache tables are too big.  If 0 then empty the cache.

//	Cache options are
// 		vB_Cache_Memory			fastest but doesn't survive a page load.
//		vB_Cache_Db				significant speed improvement and available to everyone.
//		vB_Cache_Filesystem		good performance, reduces traffic and load on db server. Not available to everyone-
//								your web server must be able to write to the file system.
//		vB_Cache_Memcached		excellent performance but usually only available to dedicated or virtual hosted sites.
//		vB_Cache_APC			excellent performance but only available to those with APC installed, and on a single web server.

//Fast DS Configuration Options
// $config['fastDS'] = true; // Use to enable or disable fastDS (true/false).
// $config['fastDSType'] = 'APC'; // Storage Type, at this time APC is the only option.
// $config['fastDSPrefix'] = ''; // Prefix to prevent collisions on shared systems. Defaults to datastore prefix.
//Note that if you use the same cache type for this and fast or large cache, and the same prefix, you may have conflicts.
// $config['fastDSLimit'] = 6000000; // Limits the amount of memory consumed, in bytes

//	******** FILESYSTEM CACHE CONFIGURATION ******
//If you use filesystem cache you MUST uncomment the line below.
//set the path to somewher writeable by the web server process. This location must already exist. Please put
// this somewhere outside the document root. Otherwise you have just created a serious security issue.
//Don't include the final '/'

//$config['Cache']['fileCachePath'] = '/valid/writeable/for/my/webserver';


	// ****** DATASTORE CACHE CONFIGURATION *****
	// Here you can configure different methods for caching datastore items.
	// You may need to clear this cache after installing/upgrading. You can do this either
	// in the control panel (Maintenance) or by restarting the web server.
	// vB_Datastore_Filecache  - to use includes/datastore/datastore_cache.php
	// vB_Datastore_APC - to use APC
	// vB_Datastore_WinCache - to use WinCache
	// vB_Datastore_Memcached - to use a Memcache server, more configuration below
	// $config['Datastore']['class'] = 'vB_Datastore_Filecache';
	//if you use Filecache you can accept the default location, or better
	// to uncomment the next line and set a location
	// $config['Misc']['datastorepath'] = '/valid/writeable/for/my/webserver';
	// or if you have set $config['Cache']['fileCachePath' above you can do nothing and
	// it will use that location.

    // ******** DATASTORE PREFIX ******
    // If you are using a PHP Caching system (APC, WinCache) with more
    // than one set of forums installed on your host, you *may* need to use a prefix
    // so that they do not try to use the same variable within the cache.
    // This works in a similar manner to the database table prefix.
// $config['Datastore']['prefix'] = '';

    // It is also necessary to specify the hostname or IP address and the port the server is listening on
/*
$config['Datastore']['class'] = 'vB_Datastore_Memcached';
$i = 0;
// First Server
$i++;
$config['Misc']['memcacheserver'][$i]        = '127.0.0.1';
$config['Misc']['memcacheport'][$i]            = 11211;
$config['Misc']['memcachepersistent'][$i]    = true;
$config['Misc']['memcacheweight'][$i]        = 1;
$config['Misc']['memcachetimeout'][$i]        = 1;
$config['Misc']['memcacheretry_interval'][$i] = 15;
*/
//If you are using Memcache you should can set a prefix. This is needed only if the memcache server is shared. If dedicated you don't need it.
$config['Cache']['memcacheprefix'] = '';



// ******** SPHINX SEARCH CONFIGURATION ******
//Please refer to the documentation in  do_not_upload/sphinx_install_unix.txt or do_not_upload/sphinx_install_windows.txt
//for how to configure sphinx to work with vBulletin
//$config['Misc']['sphinx_host']		= '127.0.0.1';
//$config['Misc']['sphinx_port']		= '9306';
//$config['Misc']['sphinx_path']		= '<sphinx_root>'; //no trailing slash
//$config['Misc']['sphinx_config']	= $config['Misc']['sphinx_path'] . '/etc/vbulletin_sphinx.conf';

//  ***** RESTRICT ADMINCP/MODCP ACCESS BY IP *****
//  You can provide a list of IP addresses that can access the AdminCP. This can increase security of your site.
//  Enter IP Addresses (XXX.XXX.XXX.XXX) separated by a comma. An Empty value disables this feature.
$config['Security']['AdminIP'] = '';

//  You can provide a list of IP addresses that can access the ModCP. This can increase security of your site.
//  Enter IP Addresses (XXX.XXX.XXX.XXX) separated by a comma. An Empty value disables this feature.
$config['Security']['ModIP'] = '';

// ******** TWO FACTOR AUTHENTICATION CONFIGURATION ******
// This will require that logins for the modcp, admincp, site builder, inline moderation
// will require a numeric code generated via an app on the user's cell phone or desktop
// Admins and moderators will be able to log into normal user portions of the site
// without any changes.
//
// This setting will enable two factor authentication for the site
//$config['Security']['mfa_enabled'] = true;

// Uncommenting this will allow individuals moderators and admins to set up the Two Factor
// security, but will not require it for those that choose not to enable it.  If it is
// not set at all Two Factor will be required for all control panel logins and users that
// have not configured their Two Factor Security will not be able to log in to the
// control panel functions.
//$config['Security']['mfa_force_cp'] = false;


// ****** The following options are only needed in special cases ******

    //    ****** MySQLI OPTIONS *****
    // When using MySQL 4.1+, MySQLi should be used to connect to the database.
    // If you need to set the default connection charset because your database
    // is using a charset other than latin1, you can set the charset here.
    // If you don't set the charset to be the same as your database, you
    // may receive collation errors.  Ignore this setting unless you
    // are sure you need to use it.
// $config['Mysqli']['charset'] = 'utf8';

    //    Optionally, PHP can be instructed to set connection parameters by
    //  reading from the file named in 'ini_file'. Please use a full path to
    //    the file.
    //    Example:
    //    $config['Mysqli']['ini_file'] = 'c:\program files\MySQL\MySQL Server 4.1\my.ini';
$config['Mysqli']['ini_file'] = '';

    // ******** IMAGE PROCESSING OPTIONS ********
    // Images that exceed either dimension below will not be resized by vBulletin.
    // If you need to resize larger images, alter these settings.
$config['Misc']['maxwidth'] = 6000;
$config['Misc']['maxheight'] = 6000;

    //  ******** SPECIAL SETTINGS ********
    //    The following are settings/permissions that are not normally used but
    //    are here for reference. Please be careful using them. Do not enable or
    //    uncomment without understanding what they do first.

    //    This allows you to disable modifications and extensions to the software.
    //    If your site is not functioning well after installing or using a third
    //    party modification, please enable this.
// define("DISABLE_HOOKS", true);

    //    This allows you to shut down all mail that is being sent by vBulletin.
    //    This is useful for test environments
    //    This allows you to shut down all mail that is being sent by vBulletin.
    //    This is useful for test environments
    // define("DISABLE_MAIL", true);

    //  This allows you to enter debug mode, which is for support or development
    //    to help understand how pages are built. This should NEVER be enabled in
    //    a live environment.
    if (file_exists(dirname(__DIR__,2) . '/debug.lock')) {    
        $config['Misc']['debug'] = true;
    }

		//	The ports in this array will not be appended to generated urls
		//  This is useful if you run vB on a non-standard port, e.g. with Varnish in front
// $config['Misc']['backendports'] = array();

		//	A list of allowed ports for uploading.
		// 	Other than ports 80 and 443, upload requests through any other ports
		// 	will be blocked, unless specified in the array.
		// 	Comma separated array of integers, Ex. array(8080, 3128);
// $config['Misc']['uploadallowedports'] = array();

		//	If specified, the installer will set the imported custom language
		//	with the following vblangcode as the default language. Note that
		//	default language is only set during a fresh installation, and never
		//	during an upgrade.
		//
		//	Note, the "vblangcode" attribute can be found near the top of a
		//	custom language XML file, as part of the outer-most <language > node.
		//	If not specified the last imported custom language will be set as the
		//	default.
		//
		//	The installer will not change the default language if the specified
		//	value does not match any existing custom language's vblangcode.
//$config['Install']['default_language_vblangcode'] = 'martian1';

/* #### Reverse Proxy IP ####
If your use a system where the main IP address passed to vBulletin is the address of a proxy server
and the actual 'real' ip address is passed in another http header then you enter the details here */

/*
	Enter your known proxy servers here. You can list multiple trusted IPs separated by a comma.
	You can also use the * wildcard (at the end of a definition only) or use the keyword 'all' to represent any ip address.
	Using all is generally not recommended for security reasons.
*/
//$config['Misc']['proxyiplist'] = '127.0.0.1, 192.168.*, all';

/* If the real IP is passed in a http header variable other than HTTP_X_FORWARDED_FOR, then you can set the name here; */
//$config['Misc']['proxyipheader'] = 'HTTP_X_FORWARDED_FOR';

//Default proxy settings for common proxy providers.  Uncommenting this will override any previous proxy
//configuration (and thus only one of them can be used).
/*
//default configuration for Cloudflare proxy.
$config['Misc']['proxyiplist'] = '103.21.*, 103.22.*, 103.31.*, 104.16.*, 108.162.*, 131.0.*, ' .
	'141.101.*, 162.158.*, 172.64.*, 173.245.*, 188.114.*, 190.93.*, 197.234.*, 198.41.*, ' .
	'2400:cb00:*, 2405:b500:*, 2606:4700:*, 2803:f800:*, 2c0f:f248:*, 2a06:98c0:*';

$config['Misc']['proxyipheader'] = 'HTTP_CF_CONNECTING_IP';
*/

/*
//default configuration for Sucuri Firewall
$config['Misc']['proxyiplist'] = '192.88.134.2, 192.88.134.3, 192.88.134.4, 192.88.134.5, 192.88.134.6, ' .
	'192.88.134.7, 192.88.134.8, 192.88.134.9, 192.88.134.10, 192.88.134.11, 192.88.134.12, 192.88.134.13, ' .
	'192.88.134.14, 192.88.134.15, 192.88.134.16, 192.88.134.17, 192.88.134.18, 192.88.134.19, 192.88.134.20, ' .
	'192.88.134.21, 192.88.135.2, 192.88.135.3, 192.88.135.4, 192.88.135.5, 192.88.135.6, 192.88.135.7, ' .
	'192.88.135.8, 192.88.135.9, 192.88.135.10, 192.88.135.11, 192.88.135.12, 192.88.135.13, 192.88.135.14, ' .
	'192.88.135.15, 192.88.135.16, 192.88.135.17, 192.88.135.18, 192.88.135.19, 192.88.135.20, 192.88.135.21, ' .
	'185.93.228.2, 185.93.228.3, 185.93.228.4, 185.93.228.5, 185.93.228.6, 185.93.228.7, 185.93.228.8, 185.93.228.9, ' .
	'185.93.228.10, 185.93.228.11, 185.93.228.12, 185.93.228.13, 185.93.228.14, 185.93.228.15, 185.93.228.16, ' .
	'185.93.228.17, 185.93.228.18, 185.93.228.19, 185.93.228.20, 185.93.228.21, 185.93.229.2, 185.93.229.3, ' .
	'185.93.229.4, 185.93.229.5, 185.93.229.6, 185.93.229.7, 185.93.229.8, 185.93.229.9, 185.93.229.10, ' .
	'185.93.229.11, 185.93.229.12, 185.93.229.13, 185.93.229.14, 185.93.229.15, 185.93.229.16, 185.93.229.17, ' .
	'185.93.229.18, 185.93.229.19, 185.93.229.20, 185.93.229.21, 185.93.230.2, 185.93.230.3, 185.93.230.4, ' .
	'185.93.230.5, 185.93.230.6, 185.93.230.7, 185.93.230.8, 185.93.230.9, 185.93.230.10, 185.93.230.11, ' .
	'185.93.230.12, 185.93.230.13, 185.93.230.14, 185.93.230.15, 185.93.230.16, 185.93.230.17, 185.93.230.18, ' .
	'185.93.230.19, 185.93.230.20, 185.93.230.21';

// Support Sucuri Firewall
$config['Misc']['proxyipheader'] = 'HTTP_X_SUCURI_CLIENTIP';
*/


/*=========================================================================*\
|| #######################################################################
|| # Downloaded: 11:51, Mon Apr 8th 2024
|| # CVS: $RCSfile$ - $Revision 82642 $
|| #######################################################################
\*=========================================================================*/
