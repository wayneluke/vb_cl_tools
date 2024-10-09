#!/bin/bash

# Name of the backup directory
backup_dir="../_backup"

# Create _backup directory if it does not exist
if [ ! -d "$backup_dir" ]; then
  mkdir "$backup_dir"
fi

# Name of the resulting compressed file
output_file="${backup_dir}/file_backup_$(date +%Y%m%d_%H%M%S).tar.gz"

# Compress the current directory tree, excluding the _backup directory
tar --exclude="./${backup_dir}" -czf "$output_file" .

# Check if the tar command was successful
if [ $? -eq 0 ]; then
  echo "Directory compressed successfully into: $output_file"
else
  echo "Error: Compression failed."
fi

echo "Removing backups older than 7 days."
find "$BACKUP_DIR" -type f -name "files_backup_*" -mtime +7 -exec rm {} \;