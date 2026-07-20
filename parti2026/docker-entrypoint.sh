#!/bin/sh

# ponytail: dynamic port binding for Render.com using native sed
if [ -n "$PORT" ]; then
    sed -i "s/80/${PORT}/g" /etc/apache2/sites-available/*.conf /etc/apache2/ports.conf
fi

# Create storage directories if they do not exist
mkdir -p /var/www/html/storage/app/public/sponsors /var/www/html/storage/app/public/posters /var/www/html/storage/app/public/documents

# Execute Laravel storage symlink creation
php artisan storage:link --force

# Ensure full permissions for Apache user www-data across storage, public, and bootstrap/cache
chown -R www-data:www-data /var/www/html/storage /var/www/html/public /var/www/html/bootstrap/cache
chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache

# Run database migrations in production
if [ -n "$DB_HOST" ]; then
    echo "Running migrations..."
    php artisan migrate --force
fi

# Start Apache in the foreground
exec apache2-foreground

