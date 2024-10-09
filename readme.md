# vBulletin Command Line Tools

This is a series of command line tools that I have created over the years to help manage vBulletin on my local machine. All of these were developed and tested on macOS. While ZSH is my primary shell, these use the BASH processor.

These scripts are vBulletin version agnostic. They should operate with any version but are geared towards vB5 and vB6.

## Setup

1. Unzip the archive.
2. Rename the `env.sample` file to `.env`.
3. Edit the `.env` file and update the variables.
4. Copy or Upload the contents of the archive to your server. They do not need to be placed in the vBulletin directory.

## The Tools

Example Usage: `./backup.sh`

- **backup.sh**: Creates a backup of your vBulletin files, compresses them with GZIP and places them in a _backup directory. If the directory doesn't exist, it will create the directory and copy an .htaccess file to prohibit browsing. Backups will be timestamped and will not overwrite the old files. Automatically deletes backups older than 15 days.
- **dbBackup.sh**: Creates a database backup and places it in the _backup directory. If the directory does not exist, it will create it and copy an .htaccess file to prohibit browsing. Backups will be timestamped and will not overwrite the old files. Automatically deletes backups older than 15 days.
- **buildChecksums.sh**: Will look for config_*.php files in the checksum subdirectory and process them to create md5 sum files as requested. This is handy if you upload additional smilies, ranks, or want the system to check your attachment directory for bad files.
- 
- **upgrade.sh**: This script will upgrade your site. It does the following:
  - Copies /maintenance/maintenace.html to your vBulletin directory
  - Backs up your current .htaccess.
  - Replaces your .htaccess with a global redirect to maintenance.html
  - Calls dbBackup.php
  - Runs the vBulletin upgrade scripts
  - Removes maintenance mode by restoring your default .htaccess.

## vBulletin Configuration

I've included a set of vBulletin config.php files that includes changes to some variables in the system. These are located in the `config` directory. You can overwrite your existing files with them after updating with your database information.

- vBulletin will look for a file named debug.lock to enable or disable Debug Mode.
- Turns off Display Errors in PHP.
- Sets the error_log values so the system writes aa PHP error_log and it is located in the /logs directory of vBulletin. You must create the /logs directory.
- Sets the error output to include all PHP notices, warnings, deprecations, and errors in the log. Adjust as necessary.
- Sets the timezone to Los Angeles time. You can change this to your timezone.
- Disables the Suspect File Check on upgrades. use with caution.

## My Setup

My current setup is:

- Operating System: MacOS 15
- Primary Shell: ZSH 5.9
- bash Shell: 3.2.57
- Apache 2.4.62
- PHP 8.3.11
- MySQL 8.3.0

## Support

Post any [issues](https://github.com/wayneluke/vb_cl_tools/issues) in the Github Repository.

## Questions

### Can I use these with my web browser?

These tools are not available in your web browser. You must use the server's command line to access them.

### Can you make these available as Windows batch files?

Not at this time.
