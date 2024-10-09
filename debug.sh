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

# Example usage of the function:
# Replace '/path/to/env/directory' with your desired directory
source_env "."

# Specify the directory where the debug.lock file will be toggled
LOCKFILE="$VB_DIRECTORY/debug.lock"

# Check if the directory exists
if [[ ! -d "$VB_DIRECTORY" ]]; then
  echo "Error: Directory $VB_DIRECTORY does not exist."
  exit 1
fi

# Toggle the existence of the debug.lock file
if [[ -f "$LOCKFILE" ]]; then
  echo "Removing debug.lock file."
  rm "$LOCKFILE"
else
  echo "Creating debug.lock file."
  touch "$LOCKFILE"
fi

unset_env "."