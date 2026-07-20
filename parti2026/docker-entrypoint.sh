#!/bin/sh

# ponytail: dynamic port binding for Render.com using native sed
if [ -n "$PORT" ]; then
    sed -i "s/80/${PORT}/g" /etc/apache2/sites-available/*.conf /etc/apache2/ports.conf
fi

# Create storage symlink if not exists
php artisan storage:link --force

# Ensure permissions for storage and bootstrap/cache
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Run database migrations in production
if [ -n "$DB_HOST" ]; then
    echo "Running migrations..."
    php artisan migrate --force
fi

# Start Apache in the foreground
exec apache2-foreground

