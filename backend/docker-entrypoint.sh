#!/bin/sh
set -e

echo "⏳ Waiting for MySQL database (db:3306) to become ready..."
while ! nc -z db 3306; do
  echo "Database is still starting up, waiting 2 seconds..."
  sleep 2
done

echo "✅ MySQL is ready!"

# Ensure cache directories exist and are writable
mkdir -p bootstrap/cache storage/framework/cache storage/framework/sessions storage/framework/views storage/logs
chmod -R 777 bootstrap/cache storage

# Generate app key if needed
if [ -z "$APP_KEY" ]; then
  php artisan key:generate --force
fi

# Run database migrations and seeders automatically
echo "🔄 Running migrations and database seeder..."
php artisan migrate --force --seed || true

echo "🚀 Starting Laravel HTTP server on 0.0.0.0:8000..."
exec php artisan serve --host=0.0.0.0 --port=8000
