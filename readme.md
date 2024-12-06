# vBulletin Command Line Tools

This is a series of command line tools that I have created over the years to help manage vBulletin on my local machine. All of these were developed and tested on macOS. While ZSH is my primary shell, these use the BASH processor.

> Note: While these scripts are not tied to a specific vBulletin version, they are intended to work with vBulletin 6 and higher. I do not know how they will work with older versions.

## Setup

1. Unzip the archive.
2. Rename the `env.sample` file to `.env`.
3. Edit the `.env` file and update the variables.
4. Copy or Upload the contents of the archive to your server. They do not need to be placed in the vBulletin directory.
5. Run the following command: `chmod +x *.sh`

## The Tools

### backup.sh

 Creates a backup of your vBulletin files, compresses them with GZIP and places them in a _backup directory. If the directory doesn't exist, it will create the directory and copy an .htaccess file to prohibit browsing. Backups will be timestamped and will not overwrite the old files. Automatically deletes backups older than 15 days.

**Usage:**  `./backup.sh`

### buildChecksums.sh

Will look for config_*.php files in the checksum subdirectory and process them to create md5 sum files as requested. This is handy if you upload additional smilies, ranks, or want the system to check your attachment directory for bad files.

**Usage:**

- Copy vB5checksum.phar from /do_not_upload/checksum to this directory.
- Update your config_XX.php files to include the files you want checked by the diagnotics. You can use on of the included example files or the one in the do_not_upload/checksums directory for reference.
- Run the command with `./buildChecksums.sh`

### compress.sh

Compresses the specified directory into a tar.gz file.

**Usage:** `./compress.sh <dirname>`

### dbBackup.sh

Creates a database backup and places it in the _backup directory. If the directory does not exist, it will create it and copy an .htaccess file to prohibit browsing. Backups will be timestamped and will not overwrite the old files. Automatically deletes backups older than 15 days.

**Usage:** `./dbBackup.sh`

### dBClone.sh

Creates a copy of the specified database in the target database. There must be enough space on the partition to create a temporary backup of the source database. When the clone runs, it will verify if the database exists and ask if you wish to delete it before proceeding.

**Usage:** `./dbClone.sh`

### debug.sh

Used in conjunction with the provided vBulletin Configuration files to toggle debug mode in vBulletin. This file will add or remove a debug.lock file to the vBulletin directory.

**Usage:** `.\debug.sh`

### upgrade.sh

This script will upgrade your site. It does the following:

- Copies /maintenance/maintenace.html to your vBulletin directory
- Backs up your current .htaccess.
- Replaces your .htaccess with a global redirect to maintenance.html
- Calls dbBackup.php
- Runs the vBulletin upgrade scripts
- Removes maintenance mode by restoring your default .htaccess.

**Usage:** `./upgrade.sh`

## vBulletin Configuration

I've included a set of vBulletin config.php files that includes changes to the local PHP configuration. These are located in the `config` directory. You can overwrite your existing files with them after updating with your database information.

> In order to use these files, there should be no disabled functions within PHP.

- vBulletin will look for a file named debug.lock to enable or disable Debug Mode.
- Turns off Display Errors in PHP.
- Sets the error_log values so the system writes aa PHP error_log and it is located in the /logs directory of vBulletin. You must create the /logs directory.
- Sets the error output to include all PHP notices, warnings, deprecations, and errors in the log. Adjust as necessary.
- Sets the timezone to Los Angeles time. You can change this to your timezone.
- Disables the Suspect File Check on upgrades. use with caution.

## My Setup

These scripts are developed and tested on the following platform.

- Operating System: macOS 15
- Package Manager: Homebrew 4.4.0
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
