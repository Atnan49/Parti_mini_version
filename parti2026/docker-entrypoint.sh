#!/bin/sh

# ponytail: dynamic port binding for Render.com using native sed
if [ -n "$PORT" ]; then
    sed -i "s/80/${PORT}/g" /etc/apache2/sites-available/*.conf /etc/apache2/ports.conf
fi

# Create public/storage subdirectories if they do not exist
mkdir -p /var/www/html/public/storage/sponsors /var/www/html/public/storage/posters /var/www/html/public/storage/documents

# Ensure full permissions for Apache user www-data across public/storage, storage, and bootstrap/cache
chown -R www-data:www-data /var/www/html/public/storage /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 777 /var/www/html/public/storage /var/www/html/storage /var/www/html/bootstrap/cache

# Run database migrations in production
if [ -n "$DB_HOST" ]; then
    echo "Running migrations..."
    php artisan migrate --force
fi

# Start Apache in the foreground
exec apache2-foreground

