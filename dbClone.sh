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
echo "If asked for a password, it is requesting the password for your database user."

# Command to check if the targer database exists
DB_EXISTS=$(mysql -u"$DB_USER" -p -h"$DB_HOST" -e "SHOW DATABASES LIKE '$TARGET_DB';" | grep "$TARGET_DB" | wc -l)

if [ $DB_EXISTS -ne 0 ]; then
    echo "Database '$TARGET_DB' exists."

    # Prompt to delete the database
    read -p "Do you want to delete the database '$TARGET_DB'? (y/n): " CONFIRM

    if [[ $CONFIRM == "y" || $CONFIRM == "Y" ]]; then
        mysql -u"$DB_USER" -p -h"$DB_HOST" -e "DROP DATABASE $TARGET_DB;"
        if [ $? -eq 0 ]; then
            echo "Database '$TARGET_DB' has been deleted."
        else
            echo "Failed to delete the database '$TARGET_DB'. Check your permissions."
        fi
    else
        echo "Database '$TARGET_DB' was not deleted."
        exit 0;
    fi
fi

# Create the target database
echo "Creating the target database..."
mysql -u"$DB_USER" -p -h"$DB_HOST" -e "CREATE DATABASE $TARGET_DB;"
if [ $? -ne 0 ]; then
    echo "Failed to create target database $TARGET_DB. Exiting."
    exit 1
fi

echo "Backing up source database..."
mysqldump -u"$DB_USER" -p -h"$DB_HOST" "$DB_NAME" > source_backup.sql
if [ $? -ne 0 ]; then
    echo "Failed to create backup"
    exit 1
fi
# Dump the source database and import it into the target database
echo "Duplicating the database..."
mysql -u"$DB_USER" -p -h"$DB_HOST" "$TARGET_DB" < source_backup.sql
if [ $? -ne 0 ]; then
    echo "Failed to duplicate the database. Exiting."
    exit 1
fi

rm -f source_backup.sql

echo "Database $SOURCE_DB successfully duplicated to $TARGET_DB."
