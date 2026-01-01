# 🚀 Guide de Déploiement Production - Salut Annecy

Ce guide détaille les étapes pour déployer l'application en production de manière sécurisée et optimisée.

## 📋 Pré-requis Serveur

### Configuration Minimale
- **OS**: Ubuntu 22.04 LTS (recommandé) ou similaire
- **PHP**: 8.2 ou 8.3
- **PostgreSQL**: 14+
- **Redis**: 6+
- **Nginx**: 1.18+ ou Apache 2.4+
- **Node.js**: 22+
- **RAM**: 2GB minimum (4GB recommandé)
- **Disque**: 20GB minimum
- **SSL**: Certificat valide (Let's Encrypt recommandé)

### Extensions PHP Requises
```bash
sudo apt install -y php8.3-cli php8.3-fpm php8.3-pgsql php8.3-redis \
    php8.3-mbstring php8.3-xml php8.3-curl php8.3-zip php8.3-gd \
    php8.3-intl php8.3-bcmath php8.3-opcache
```

## 🔧 Étapes de Déploiement

### 1. Préparation du Serveur

#### Installation des dépendances système
```bash
# Mise à jour du système
sudo apt update && sudo apt upgrade -y

# Installation de Nginx
sudo apt install nginx -y

# Installation de PostgreSQL
sudo apt install postgresql postgresql-contrib -y

# Installation de Redis
sudo apt install redis-server -y

# Installation de Node.js 22
curl -fsSL https://deb.nodesource.com/setup_22.x | sudo -E bash -
sudo apt install -y nodejs

# Installation de Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

#### Configuration de PostgreSQL
```bash
# Connexion à PostgreSQL
sudo -u postgres psql

# Créer la base de données et l'utilisateur
CREATE DATABASE ville_production;
CREATE USER annecy_user WITH ENCRYPTED PASSWORD 'your_secure_password';
GRANT ALL PRIVILEGES ON DATABASE ville_production TO annecy_user;
\q
```

#### Configuration de Redis
```bash
# Éditer la configuration Redis
sudo nano /etc/redis/redis.conf

# Recommandations:
# maxmemory 256mb
# maxmemory-policy allkeys-lru
# bind 127.0.0.1

# Redémarrer Redis
sudo systemctl restart redis
sudo systemctl enable redis
```

### 2. Déploiement de l'Application

#### Cloner le repository
```bash
cd /var/www
sudo git clone https://github.com/Ishaq74/laravel-annecy.git
cd laravel-annecy
sudo chown -R www-data:www-data /var/www/laravel-annecy
```

#### Installation des dépendances
```bash
# Dépendances PHP (production seulement)
composer install --optimize-autoloader --no-dev

# Dépendances Node.js
npm ci --production=false
```

#### Configuration de l'environnement
```bash
# Copier le template de production
cp .env.production .env

# Éditer les variables d'environnement
nano .env

# Générer la clé d'application
php artisan key:generate
```

**Variables critiques à configurer dans `.env`:**
- `APP_URL` : URL complète de votre domaine
- `APP_KEY` : Généré automatiquement
- `DB_*` : Paramètres de base de données PostgreSQL
- `REDIS_HOST` : Host Redis (généralement 127.0.0.1)
- `MAIL_*` : Configuration SMTP pour les emails

#### Migrations et optimisations
```bash
# Exécuter les migrations
php artisan migrate --force

# Seeders (optionnel, selon vos besoins)
# php artisan db:seed --force

# Compiler les assets
npm run build

# Optimisations Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Créer le lien de stockage
php artisan storage:link
```

#### Permissions
```bash
sudo chown -R www-data:www-data /var/www/laravel-annecy
sudo chmod -R 755 /var/www/laravel-annecy
sudo chmod -R 775 /var/www/laravel-annecy/storage
sudo chmod -R 775 /var/www/laravel-annecy/bootstrap/cache
```

### 3. Configuration de Nginx

```bash
sudo nano /etc/nginx/sites-available/salut-annecy
```

**Configuration Nginx complète:**
```nginx
server {
    listen 80;
    listen [::]:80;
    server_name your-domain.com www.your-domain.com;
    
    # Redirection vers HTTPS
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name your-domain.com www.your-domain.com;
    
    root /var/www/laravel-annecy/public;
    index index.php index.html;

    # SSL Configuration
    ssl_certificate /etc/letsencrypt/live/your-domain.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/your-domain.com/privkey.pem;
    ssl_protocols TLSv1.2 TLSv1.3;
    ssl_ciphers HIGH:!aNULL:!MD5;
    ssl_prefer_server_ciphers on;

    # Security Headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;
    add_header Referrer-Policy "no-referrer-when-downgrade" always;
    add_header Content-Security-Policy "default-src 'self' http: https: data: blob: 'unsafe-inline'" always;
    add_header Strict-Transport-Security "max-age=31536000; includeSubDomains" always;

    # Logs
    access_log /var/log/nginx/salut-annecy-access.log;
    error_log /var/log/nginx/salut-annecy-error.log;

    # Client body size (for file uploads)
    client_max_body_size 20M;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { 
        access_log off; 
        log_not_found off; 
    }
    
    location = /robots.txt  { 
        access_log off; 
        log_not_found off; 
    }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
        fastcgi_read_timeout 300;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }

    # Cache static files
    location ~* \.(jpg|jpeg|png|gif|ico|css|js|svg|woff|woff2|ttf|eot)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
    }
}
```

**Activer le site:**
```bash
sudo ln -s /etc/nginx/sites-available/salut-annecy /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

### 4. Configuration SSL avec Let's Encrypt

```bash
# Installer Certbot
sudo apt install certbot python3-certbot-nginx -y

# Obtenir un certificat SSL
sudo certbot --nginx -d your-domain.com -d www.your-domain.com

# Le renouvellement automatique est configuré par défaut
# Tester le renouvellement:
sudo certbot renew --dry-run
```

### 5. Configuration des Workers

#### Laravel Horizon (Queue Workers)

**Créer le fichier supervisor:**
```bash
sudo nano /etc/supervisor/conf.d/laravel-horizon.conf
```

```ini
[program:laravel-horizon]
process_name=%(program_name)s
command=php /var/www/laravel-annecy/artisan horizon
autostart=true
autorestart=true
user=www-data
redirect_stderr=true
stdout_logfile=/var/www/laravel-annecy/storage/logs/horizon.log
stopwaitsecs=3600
```

**Démarrer Horizon:**
```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start laravel-horizon
```

#### Tâches Planifiées (Cron)

```bash
sudo crontab -e -u www-data
```

Ajouter:
```
* * * * * cd /var/www/laravel-annecy && php artisan schedule:run >> /dev/null 2>&1
```

### 6. Configuration PHP-FPM

```bash
sudo nano /etc/php/8.3/fpm/php.ini
```

**Optimisations recommandées:**
```ini
memory_limit = 512M
max_execution_time = 300
upload_max_filesize = 20M
post_max_size = 20M

; OPcache
opcache.enable=1
opcache.memory_consumption=256
opcache.interned_strings_buffer=16
opcache.max_accelerated_files=10000
opcache.validate_timestamps=0
opcache.save_comments=1
opcache.fast_shutdown=1
```

```bash
sudo systemctl restart php8.3-fpm
```

### 7. Monitoring et Logs

#### Logs Laravel
```bash
# Créer une rotation des logs
sudo nano /etc/logrotate.d/laravel-annecy
```

```
/var/www/laravel-annecy/storage/logs/*.log {
    daily
    missingok
    rotate 14
    compress
    delaycompress
    notifempty
    create 0640 www-data www-data
    sharedscripts
}
```

#### Monitoring avec Telescope (staging uniquement)
Pour l'environnement de staging, activer Telescope:
```env
TELESCOPE_ENABLED=true
```

⚠️ **IMPORTANT**: Désactiver Telescope en production ou le protéger par authentification.

### 8. Sauvegardes

#### Script de sauvegarde PostgreSQL
```bash
sudo nano /usr/local/bin/backup-laravel-annecy.sh
```

```bash
#!/bin/bash
BACKUP_DIR="/var/backups/laravel-annecy"
DATE=$(date +%Y%m%d_%H%M%S)

# Créer le dossier de sauvegarde
mkdir -p $BACKUP_DIR

# Sauvegarde de la base de données
pg_dump -U annecy_user ville_production > $BACKUP_DIR/db_$DATE.sql

# Sauvegarde des fichiers storage
tar -czf $BACKUP_DIR/storage_$DATE.tar.gz /var/www/laravel-annecy/storage/app

# Garder seulement les 7 dernières sauvegardes
find $BACKUP_DIR -name "db_*.sql" -mtime +7 -delete
find $BACKUP_DIR -name "storage_*.tar.gz" -mtime +7 -delete
```

```bash
sudo chmod +x /usr/local/bin/backup-laravel-annecy.sh

# Ajouter au cron (sauvegarde quotidienne à 3h du matin)
sudo crontab -e
```

Ajouter:
```
0 3 * * * /usr/local/bin/backup-laravel-annecy.sh
```

### 9. Mise à Jour de l'Application

**Script de déploiement automatisé:**
```bash
sudo nano /var/www/laravel-annecy/deploy.sh
```

```bash
#!/bin/bash
set -e

echo "🚀 Starting deployment..."

# Mettre l'application en mode maintenance
php artisan down

# Pull les dernières modifications
git pull origin main

# Installer les dépendances
composer install --optimize-autoloader --no-dev
npm ci --production=false

# Compiler les assets
npm run build

# Exécuter les migrations
php artisan migrate --force

# Vider les caches
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Redémarrer les workers
sudo supervisorctl restart laravel-horizon

# Remettre l'application en ligne
php artisan up

echo "✅ Deployment completed!"
```

```bash
chmod +x /var/www/laravel-annecy/deploy.sh
```

## ✅ Checklist de Déploiement Final

### Configuration
- [ ] Variables `.env` configurées et sécurisées
- [ ] `APP_ENV=production`
- [ ] `APP_DEBUG=false`
- [ ] `APP_URL` correcte
- [ ] Base de données configurée et migrée
- [ ] Redis fonctionnel
- [ ] Clés API configurées (Mail, Scout, etc.)

### Sécurité
- [ ] SSL/HTTPS activé et fonctionnel
- [ ] Certificat SSL auto-renouvelé
- [ ] Headers de sécurité configurés
- [ ] Firewall configuré (UFW)
- [ ] Accès SSH sécurisé (clés, pas de root)
- [ ] Mots de passe forts pour DB et Redis

### Performance
- [ ] OPcache activé
- [ ] Redis cache configuré
- [ ] Assets compilés et minifiés
- [ ] Caches Laravel générés
- [ ] Compression Gzip activée (Nginx)

### Maintenance
- [ ] Logs rotationnés
- [ ] Sauvegardes automatiques configurées
- [ ] Horizon workers actifs
- [ ] Cron tasks configurés
- [ ] Monitoring en place

### Tests
- [ ] Application accessible via HTTPS
- [ ] Toutes les pages principales fonctionnent
- [ ] Upload de fichiers fonctionne
- [ ] Emails envoyés correctement
- [ ] Multi-langue fonctionne
- [ ] Recherche fonctionne
- [ ] Queue processing actif

## 🆘 Dépannage

### L'application ne se charge pas
```bash
# Vérifier les logs Nginx
sudo tail -f /var/log/nginx/salut-annecy-error.log

# Vérifier les logs Laravel
tail -f /var/www/laravel-annecy/storage/logs/laravel.log

# Vérifier PHP-FPM
sudo systemctl status php8.3-fpm
```

### Problèmes de permissions
```bash
sudo chown -R www-data:www-data /var/www/laravel-annecy
sudo chmod -R 755 /var/www/laravel-annecy
sudo chmod -R 775 /var/www/laravel-annecy/storage
sudo chmod -R 775 /var/www/laravel-annecy/bootstrap/cache
```

### Queue workers ne fonctionnent pas
```bash
# Vérifier Horizon
sudo supervisorctl status laravel-horizon

# Redémarrer Horizon
sudo supervisorctl restart laravel-horizon

# Vérifier les logs
tail -f /var/www/laravel-annecy/storage/logs/horizon.log
```

### Base de données inaccessible
```bash
# Vérifier PostgreSQL
sudo systemctl status postgresql

# Tester la connexion
psql -U annecy_user -d ville_production -h 127.0.0.1
```

## 📞 Support

Pour toute question ou problème :
- GitHub Issues : https://github.com/Ishaq74/laravel-annecy/issues
- Documentation : Voir README.md

---

**Dernière mise à jour** : Janvier 2026
