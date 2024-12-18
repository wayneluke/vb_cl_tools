#!/bin/bash

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

source_env "."

# Name of the backup directory
backup_dir="$VB_DIRECTORY/_backup"

# Create _backup directory if it does not exist
if [ ! -d "$backup_dir" ]; then
  mkdir "$backup_dir"
  cp .htaccess "$backup_dir"
fi

# Name of the resulting compressed file
output_file="${backup_dir}/file_backup_$(date +%Y%m%d_%H%M%S).tar.gz"

# Compress the current directory tree, excluding the _backup directory
tar --exclude="./${backup_dir}" -czf "$output_file" $VB_DIRECTORY

# Check if the tar command was successful
if [ $? -eq 0 ]; then
  echo "Directory compressed successfully into: $output_file"
else
  echo "Error: Compression failed."
fi

echo "Removing backups older than 15 days."
find "$BACKUP_DIR" -type f -name "files_backup_*" -mtime +15 -exec rm {} \;

unset_env "."