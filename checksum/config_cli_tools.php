<?php

// Sample config file for creating checksum config.
// Run  php vB5Checksum.phar --help  for sample usage.


//    ****** REQUIRED ******

$forumroot = '/volumes/secondary/sites/vbulletin/demo';
$productid = 'cli_tools';
/*
	Contents of these directories will be added to the checksum file.
	These paths must be relative to $forumroot above and must be
	inside $forumroot.

	Do not use directory traversals (/../) in these paths as they may
	not work as expected and specified files outside of $forumroot
	will not be scanned by the diagnostics tool even if listed in the
	manifest.

	These paths may be directories or files.
 */
$scanpaths = [
	# directories
		'cli_tools/checksum',
		'cli_tools/config',
		'cli_tools/maintenance',
		'cli_tools/in_progress',
	# single files
		'cli_tools/.env',
		'cli_tools/backup.sh',
		'cli_tools/dbBackup.sh',
		'cli_tools/buildChecksums.sh',
		'cli_tools/readme.md',
		'cli_tools/upgrade.sh',

	# don't do this. It may resolve & add entries to the manifest, but will NOT be scanned
	# '../externalfolder',
];


//    ****** OPTIONAL ******

/*
If any of your custom files have a version header like "vBulletin 5.6.0"
you must specify that version here. If missing, the diagnostic tool may
show erroneous warnings like
"File version mismatch: found 5.6.0, expected "
If your files do not have a version header, you can skip this.
 */
//$version = '5.6.0';