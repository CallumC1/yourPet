#!/bin/sh
# entrypoint.sh

# Navigate to the working directory
cd /var/www/html

# Install Node.js dependencies
npm install

# Build Tailwind CSS
npx tailwindcss build -i ./app/css/input.css -o ./public/assets/output.css --minify

# Start Apache
apache2-foreground
