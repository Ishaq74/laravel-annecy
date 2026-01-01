#!/bin/bash

# Production Setup Script for Salut Annecy
# This script helps prepare the application for production deployment

set -e

echo "🚀 Salut Annecy - Production Setup"
echo "===================================="
echo ""

# Check if running as root
if [ "$EUID" -eq 0 ]; then 
   echo "❌ Please do not run this script as root"
   exit 1
fi

# Check PHP version
PHP_VERSION=$(php -r 'echo PHP_VERSION;')
echo "✓ PHP Version: $PHP_VERSION"

if ! php -v | grep -qE "PHP (8\.[23])"; then
    echo "❌ PHP 8.2 or 8.3 is required"
    exit 1
fi

# Check if .env exists
if [ ! -f .env ]; then
    echo "📝 Creating .env from .env.production..."
    cp .env.production .env
    echo "⚠️  Please edit .env with your production credentials before continuing"
    exit 0
fi

echo ""
echo "📦 Installing dependencies..."
composer install --optimize-autoloader --no-dev --no-interaction

echo ""
echo "🔑 Generating application key..."
php artisan key:generate --force

echo ""
echo "🗄️  Running database migrations..."
read -p "Run migrations? (y/N): " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]; then
    php artisan migrate --force
fi

echo ""
echo "📦 Installing Node dependencies..."
npm ci --production=false

echo ""
echo "🎨 Building assets..."
npm run build

echo ""
echo "🔗 Creating storage link..."
php artisan storage:link

echo ""
echo "⚡ Optimizing for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

echo ""
echo "🔒 Setting permissions..."
chmod -R 755 .
chmod -R 775 storage
chmod -R 775 bootstrap/cache

echo ""
echo "✅ Production setup complete!"
echo ""
echo "Next steps:"
echo "1. Configure your web server (see DEPLOYMENT.md)"
echo "2. Set up SSL certificates"
echo "3. Configure queue workers (Horizon)"
echo "4. Set up cron jobs"
echo "5. Configure backups"
echo ""
echo "For detailed instructions, see DEPLOYMENT.md"
