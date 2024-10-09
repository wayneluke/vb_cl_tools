#!/bin/bash

# Preconfigured list of directories to search
directories=(
  "/path/to/directory1"
  "/path/to/directory2"
  "/path/to/directory3"
)

# Loop through each directory in the list
for dir in "${directories[@]}"; do
  # Check if the directory exists
  if [ ! -d "$dir" ]; then
    echo "Directory $dir does not exist. Skipping..."
    continue
  fi

  # Find and list all PHP files in the directory and its subdirectories
  php_files=$(find "$dir" -type f -name "*.php")

  # Display the results for the current directory
  if [ -z "$php_files" ]; then
    echo "No PHP files found in directory: $dir"
  else
    echo -e "\nFound PHP files in directory: $dir"
    echo "$php_files"
  fi
done