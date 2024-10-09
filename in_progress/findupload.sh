#!/bin/bash

# Search for a directory named 'upload' in the current path
upload_directory=$(find . -type d -name "upload")

# Check if the directory was found
if [ -z "$upload_directory" ]; then
  echo "No directory named 'upload' found in the current path."
else
  echo "Found 'upload' directory:"
  echo "$upload_directory"
fi