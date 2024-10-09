#!/bin/bash

# This automatically runs through a list of configuration PHP files for vBulletin's checksum.phar tool.
# The file is located in the /do_not_upload/checksum directory. 

# Directory containing the PHP files
DIRECTORY="./checksum"

# Loop through each PHP file in the specified directory
if [ -e "vB5checksum.phar" ]; then
        for file in "$DIRECTORY"/config*.php; do
        # Check if the file exists to avoid errors when no PHP files are found
            if [ -e "$file" ]; then
                echo -e "\nProcessing $file..."
                php vB5checksum.phar --config="$file"
            else
                echo "No configuration files found in $DIRECTORY."
            break
        fi
        done
else 
    echo "vb5Checksum.phar does not exist. This file must be copied from the vBulletin package to here."
    echo "The original file should be located in /do_not_upload/checksum."
fi
