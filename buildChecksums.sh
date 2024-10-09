#!/bin/bash

# This automatically runs through a list of configuration PHP files for vBulletin's checksum.phar tool.
# The file is located in the /do_not_upload/checksum directory. 

# Function to source .env file from a specific directory
source_env() {
  ENV_DIR="$1"
  ENV_FILE="${ENV_DIR}/.env"

  # Check if the .env file exists
  if [ -f "$ENV_FILE" ]; then
    echo "Configuring Database with $ENV_FILE"
    # Export environment variables from the .env file
    set -o allexport
    source "$ENV_FILE"
    set +o allexport
  else
    echo "Error: .env file not found in directory: $ENV_DIR"
    return 1
  fi
}

# Function to unset environment variables defined in a .env file
unset_env() {
  ENV_DIR="$1"
  ENV_FILE="${ENV_DIR}/.env"

  # Check if the .env file exists
  if [ -f "$ENV_FILE" ]; then
    echo "Unsetting variables from .env file"

    # Read each line in the .env file
    while IFS='=' read -r key _; do
      # Ignore lines starting with comments or empty lines
      if [[ $key =~ ^#.* ]] || [[ -z "$key" ]]; then
        continue
      fi

      # Unset the environment variable
      unset "$key"
    done < "$ENV_FILE"
  else
    echo "Error: .env file not found in directory: $ENV_DIR"
    return 1
  fi
}

# Example usage of the function:
# Replace '/path/to/env/directory' with your desired directory
source_env "."

# Directory containing the PHP files
DIRECTORY="./checksum"

find "$VB_DIRECTORY"/core/includes -type f -name "md5_*" -print0 | xargs -r0 chmod +w

# chmod +w "$VB_DIRECTORY/core/includes/md5_sums_*.php"

# Loop through each PHP file in the specified directory
if [ -e "vB5checksum.phar" ]; then
        for file in "$DIRECTORY"/config*.php; do
        # Check if the file exists to avoid errors when no PHP files are found
            if [ -e "$file" ]; then
                echo -e "\nProcessing $file..."
                php vB5checksum.phar --config="$file"
                echo -e "\n"
            else
                echo "No configuration files found in $DIRECTORY."
            break
        fi
        done
else 
    echo "vb5Checksum.phar does not exist. This file must be copied from the vBulletin package to here."
    echo "The original file should be located in /do_not_upload/checksum."
fi

find "$VB_DIRECTORY"/core/includes -type f -name "md5_*" -print0 | xargs -r0 chmod -w
#chmod -w "$VB_DIRECTORY/core/includes/md5_sums*.php"
unset_env "."