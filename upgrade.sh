#!/bin/bash

# Variables (You can customize these if needed)
HTACCESS_FILE="../.htaccess"
BACKUP_FILE="../htaccess.bak"
MAINTENANCE_FILE="./maintenance/htaccess.maintenance"
VB_UPGRADE="../core/install/upgrade.php"

echo "Putting site into maintenance mode"
# Check if the .htaccess file exists
if [ -f "$HTACCESS_FILE" ]; then
  echo "Moving $HTACCESS_FILE to $BACKUP_FILE"
  mv "$HTACCESS_FILE" "$BACKUP_FILE"
else
  echo "Warning: $HTACCESS_FILE not found, skipping backup."
fi

# Check if the htaccess.maintenance file exists
if [ -f "$MAINTENANCE_FILE" ]; then
  echo "Copying $MAINTENANCE_FILE to $HTACCESS_FILE"
  cp "$MAINTENANCE_FILE" "$HTACCESS_FILE"
else
  echo "Error: $MAINTENANCE_FILE not found."
  exit 1
fi

php "$VB_UPGRADE"

echo "Enabling Forums"
rm "$HTACCESS_FILE"
echo "Moving $BACKUP_FILE to $HTACCESS_FILE"
mv "$BACKUP_FILE" "$HTACCESS_FILE" 
