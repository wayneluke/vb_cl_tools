# Function to source .env file from a specific directory
source_env() {
  ENV_DIR="$1"
  ENV_FILE="${ENV_DIR}/.env"

  # Check if the .env file exists
  if [ -f "$ENV_FILE" ]; then
    echo "Sourcing .env file from: $ENV_FILE"
    # Export environment variables from the .env file
    set -o allexport
    source "$ENV_FILE"
    set +o allexport
  else
    echo "Error: .env file not found in directory: $ENV_DIR"
    return 1
  fi
}

# Example usage of the function:
# Replace '/path/to/env/directory' with your desired directory
source_env "."

# After sourcing, you can use the environment variables, e.g.,
echo "DB_USER is: $DB_USER"