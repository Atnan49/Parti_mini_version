#!/bin/sh

# ponytail: dynamic port binding for Render.com using native sed
if [ -n "$PORT" ]; then
    sed -i "s/80/${PORT}/g" /etc/apache2/sites-available/*.conf /etc/apache2/ports.conf
fi

# Run database migrations in production
if [ -n "$DB_HOST" ]; then
    echo "Running migrations..."
    php artisan migrate --force
fi

# Start Apache in the foreground
exec apache2-foreground
