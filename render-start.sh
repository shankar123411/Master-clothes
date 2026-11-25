#!/usr/bin/env bash
set -e

mkdir -p database storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache
chmod -R 775 storage bootstrap/cache database

if [ ! -f .env ]; then
  cp .env.example .env
fi

export DB_CONNECTION="${DB_CONNECTION:-sqlite}"
export DB_DATABASE="${DB_DATABASE:-/var/www/html/database/database.sqlite}"

if [ "$DB_CONNECTION" = "sqlite" ] && [ ! -f "$DB_DATABASE" ]; then
  touch "$DB_DATABASE"
fi

if [ -z "$APP_KEY" ]; then
  php artisan key:generate --force
fi

php artisan migrate --force

USER_COUNT=$(php -r "require 'vendor/autoload.php'; \$app = require 'bootstrap/app.php'; \$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap(); echo App\Models\User::count();" 2>/dev/null || echo "0")
if [ "$USER_COUNT" = "0" ]; then
  php artisan db:seed --force
fi

php artisan config:clear
php artisan route:clear
php artisan view:clear

PORT="${PORT:-10000}"
exec php artisan serve --host=0.0.0.0 --port="$PORT"
