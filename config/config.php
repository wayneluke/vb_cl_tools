<?php
/*=========================================================================*\
|| ####################################################################### ||
|| # vBulletin 5 Presentation Configuration                              # ||
|| # vBulletin [#]version[#]
|| # ------------------------------------------------------------------- # ||
|| # All PHP code in this file is copyright 2000-[#]year[#] MH Sub I, LLC dba vBulletin.
|| # This file may not be redistributed in whole or significant part.    # ||
|| # ----------------- VBULLETIN IS NOT FREE SOFTWARE ------------------ # ||
|| # http://www.vbulletin.com | http://www.vbulletin.com/license.html    # ||
|| ####################################################################### ||
\*=========================================================================*/

/*-------------------------------------------------------*\
|  This file should NOT be modified. Only renamed.
|  Only make changes to this file if instructed to.
\*-------------------------------------------------------*/


/*-------------------------------------------------------*\
| ****** NOTE REGARDING THE VARIABLES IN THIS FILE ****** |
+---------------------------------------------------------+
| If making changes to the file, the edit should always   |
| be to the right of the = sign between the single quotes |
| Default: $config['cookie_prefix'] = 'bb';               |
| Example: $config['cookie_prefix'] = 'vb';  GOOD!        |
| Example: $config['vb'] = 'bb';             BAD!         |
\*-------------------------------------------------------*/

//    ****** Cookie Settings ******
// These are cookie related settings.
// This Setting allows you to change the cookie prefix
// This must match the core/includes/config.php file cookie prefix setting
$config['cookie_prefix'] = 'bb_';

//    ****** Special Settings ******
// These settings are only used in some circumstances
// Please do not edit if you are not sure what they do.

// You can ignore this setting for right now.
$config['cookie_enabled'] = true;

$config['report_all_php_errors'] = false;
$config['no_template_notices'] = true;

// This setting should never be used on a live site
$config['no_js_bundles'] = false;

// This setting enables debug mode, it should NEVER be used on a live site
if (file_exists('debug.lock')) {
  $config['debug'] = true;
}

$config['php_sessions'] = false;

/*=========================================================================*\
|| #######################################################################
|| # Downloaded: [#]zipbuilddate[#]
|| # CVS: $RCSfile$ - $Revision: 112019 $
|| #######################################################################
\*=========================================================================*/
