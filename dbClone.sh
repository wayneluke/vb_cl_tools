#!/bin/bash

# Database credentials
SOURCE_DB="source_database"      # Replace with the source database name
TARGET_DB="target_database"      # Replace with the new database name
DB_USER="your_username"          # Replace with your MySQL username
DB_PASS="your_password"          # Replace with your MySQL password
DB_HOST="localhost"              # Replace with your MySQL host (default is localhost)


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
# Create the target database
echo "Creating the target database..."
mysql -u"$DB_USER" -p"$DB_PASS" -h"$DB_HOST" -e "CREATE DATABASE $TARGET_DB;"
if [ $? -ne 0 ]; then
    echo "Failed to create target database $TARGET_DB. Exiting."
    exit 1
fi

# Dump the source database and import it into the target database
echo "Duplicating the database..."
mysqldump -u"$DB_USER" -p"$DB_PASS" -h"$DB_HOST" "$SOURCE_DB" | mysql -u"$DB_USER" -p"$DB_PASS" -h"$DB_HOST" "$TARGET_DB"
if [ $? -ne 0 ]; then
    echo "Failed to duplicate the database. Exiting."
    exit 1
fi

echo "Database $SOURCE_DB successfully duplicated to $TARGET_DB."
