#!/bin/bash

# Directory to check
DIR=$1

# Check if the directory exists
if [ -d "$DIR" ]; then
  # Directory exists, compress it into a tar.gz file
  TAR_FILE="${DIR%/}.tar.gz"
  tar -czvf "$TAR_FILE" "$DIR"
  echo "Directory '$DIR' has been compressed into '$TAR_FILE'."
else
  # Directory does not exist
  echo "Directory '$DIR' does not exist."
fi