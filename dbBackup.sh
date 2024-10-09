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

# Variables
TIMESTAMP=$(date +"%Y%m%d_%H%M%S")
SQL_FILE="${DB_NAME}_${TIMESTAMP}.sql"
BACKUP_FILE="${DB_NAME}_${TIMESTAMP}.sql.tar.gz"

# Create backup directory if it doesn't exist
if [ ! -d "$BACKUP_DIR" ]; then
  mkdir -p "$BACKUP_DIR"
  cp .htaccess "$BACKUP_DIR"
  echo "Backup directory '$BACKUP_DIR' created."
fi

# Perform the MySQL dump
echo "Starting backup of database '$DB_NAME'..."
#mysqldump -u "$DB_USER" -p"$DB_PASSWORD" "$DB_NAME" > "$BACKUP_DIR/$SQL_FILE"
mysqldump -u "$DB_USER" "$DB_NAME" > "$BACKUP_DIR/$SQL_FILE"

# Check if the mysqldump was successful
if [ $? -eq 0 ]; then
  echo "MySQL dump completed successfully. File: $SQL_FILE"

  # Compress the SQL file into a tar.gz archive
  echo "Compressing the backup file..."
  tar -czf "$BACKUP_DIR/$BACKUP_FILE" -C "$BACKUP_DIR" "$SQL_FILE"

  # Check if the compression was successful
  if [ $? -eq 0 ]; then
    echo "Backup compressed successfully. File: $BACKUP_FILE"

    # Remove the uncompressed SQL file
    rm "$BACKUP_DIR/$SQL_FILE"
    echo "Removed the uncompressed SQL file: $SQL_FILE"
  else
    echo "Compression failed."
    exit 1
  fi

else
  echo "MySQL dump failed."
  exit 1
fi

unset_env "."

echo "Removing backups older than 15 days."
find "$BACKUP_DIR" -type f -name "*.sql.tar.gz" -mtime +15 -exec rm {} \;

