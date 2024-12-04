#!/bin/bash

# Check if uuidgen is installed
if ! command -v uuidgen &> /dev/null; then
    echo "uuidgen is not installed. Please install it to use this script."
    exit 1
fi

# Number of GUIDs to generate (default is 1)
NUM_GUIDS=1

# If the user provides an argument, use it as the number of GUIDs
if [ "$#" -ge 1 ]; then
    if [[ "$1" =~ ^[0-9]+$ ]]; then
        NUM_GUIDS="$1"
    else
        echo "Invalid number of GUIDs specified. Please provide a positive integer."
        exit 1
    fi
fi

# Generate the GUIDs
echo "Generating $NUM_GUIDS GUID(s):"
for ((i = 1; i <= NUM_GUIDS; i++)); do
    uuidgen
done
