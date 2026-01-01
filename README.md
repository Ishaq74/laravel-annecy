# Salut Annecy - Guide Local Complet 🏔️

Une plateforme web complète pour découvrir et explorer Annecy, France. Ce guide local permet aux utilisateurs de découvrir les meilleurs endroits, événements, randonnées, et de participer à une communauté locale dynamique.

## 🌐 Multi-Language Support

**6 langues disponibles :**
- Français 🇫🇷
- English 🇬🇧
- Español 🇪🇸
- Deutsch 🇩🇪
- العربية 🇸🇦
- 中文 🇨🇳

Changez de langue directement depuis l'interface utilisateur avec le sélecteur de langue dans le header.

## 🎯 Fonctionnalités Principales

### 📍 Découverte de Lieux
- **Restaurants** : Découvrez les meilleures adresses culinaires (gastronomique, savoyard, pizzeria, etc.)
- **Hébergements** : Hôtels, chambres d'hôtes avec système de réservation
- **Activités** : Sports aériens, activités nautiques et terrestres
- **Commerces** : Produits du terroir, boutiques artisanales
- Système de notation et d'avis utilisateurs
- Carte interactive avec Leaflet
- Filtres avancés par catégorie, prix, attributs

### 📅 Événements
- Agenda complet des événements locaux
- Festivals, concerts, marchés, événements sportifs et culturels
- Calendrier avec dates et lieux
- Système de propositions d'événements par les utilisateurs

### 🥾 Randonnées
- Catalogue de sentiers de randonnée
- Informations détaillées : distance, dénivelé, durée, difficulté
- Fichiers GPX téléchargeables
- Points de départ géolocalisés

### 📰 Magazine & Articles
- Articles éditoriaux sur Annecy
- Guides et recommandations
- Système de commentaires
- Contenu généré par la communauté

### 🏪 Petites Annonces
- **Emploi** : Offres d'emploi locales
- **Immobilier** : Ventes et locations
- **Bonnes Affaires** : Achats/ventes entre particuliers
- **Services** : Prestations de services locaux

### 💬 Communauté
- **Forums** : Discussions par catégories (Restaurants, Hébergement, Activités, etc.)
- **Groupes** : Création et participation à des groupes d'intérêt
- **Messagerie** : Conversations privées entre utilisateurs
- **Profils utilisateurs** : Système de niveaux et points
- Membres vérifiés et experts locaux

### 🔴 Live Events (Temps Réel)
- Promotions éphémères
- Alertes trafic et météo
- Informations d'affluence
- Système de vote (upvote/downvote)

### 💼 Espace Professionnel
- Gestion de lieux pour les professionnels
- Système de réclamation de lieux
- E-commerce : Vente de produits
- Réservations de services
- Analytiques détaillées
- Campagnes publicitaires
- Gestion des commandes et réservations

### ✨ Fonctionnalités Avancées
- Recherche intelligente avec AI (Google Gemini)
- Suggestions de lieux similaires avec IA
- Système de favoris
- Propositions de contenu par les utilisateurs (modération)
- Tableau de bord utilisateur
- Signalement de contenu
- Cookie banner et RGPD
- Export de données personnelles

## 🛠️ Stack Technique

- **Framework** : Laravel 12
- **Frontend** : Livewire 4, Volt, Flux UI
- **Base de données** : PostgreSQL avec support multi-langue
- **Styling** : Tailwind CSS 4
- **Testing** : Pest 4
- **Code Quality** : Laravel Pint, PHPStan
- **Packages** : 
  - Laravel Folio (routing basé sur les fichiers)
  - Laravel Fortify (authentification)
  - Laravel Horizon (gestion des queues)
  - Laravel Scout (recherche)
  - Laravel Telescope (debugging)
  - Spatie Media Library
  - Spatie Permissions

## 📦 Installation

### Prérequis

- PHP ^8.2 ou ^8.3
- Composer
- Node.js 22+
- PostgreSQL
- Redis (recommandé pour la production)

### Installation locale avec Laravel Sail

1. **Cloner le repository**
```bash
git clone https://github.com/Ishaq74/laravel-annecy.git
cd laravel-annecy
```

2. **Copier le fichier d'environnement**
```bash
cp .env.example .env
```

3. **Installer les dépendances avec Sail**
```bash
./vendor/bin/sail up -d
./vendor/bin/sail composer install
./vendor/bin/sail npm install
```

4. **Générer la clé d'application**
```bash
./vendor/bin/sail artisan key:generate
```

5. **Exécuter les migrations et seeders**
```bash
./vendor/bin/sail artisan migrate --seed
```

6. **Compiler les assets**
```bash
./vendor/bin/sail npm run build
```

7. **Accéder à l'application**
```bash
./vendor/bin/sail open
```

### Installation sans Sail

1. **Cloner et configurer**
```bash
git clone https://github.com/Ishaq74/laravel-annecy.git
cd laravel-annecy
cp .env.example .env
```

2. **Installer les dépendances**
```bash
composer install
npm install
```

3. **Configuration de la base de données**
Éditez `.env` avec vos paramètres PostgreSQL :
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=ville
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

4. **Initialiser l'application**
```bash
php artisan key:generate
php artisan migrate --seed
npm run build
```

5. **Démarrer le serveur**
```bash
php artisan serve
```

## 🚀 Déploiement en Production

### Configuration de Production

1. **Variables d'environnement essentielles**
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

# Base de données
DB_CONNECTION=pgsql
DB_HOST=your-db-host
DB_DATABASE=your-db-name
DB_USERNAME=your-db-user
DB_PASSWORD=your-secure-password

# Cache (Redis recommandé)
CACHE_STORE=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis

# Redis
REDIS_HOST=your-redis-host
REDIS_PASSWORD=your-redis-password
REDIS_PORT=6379

# Mail
MAIL_MAILER=smtp
MAIL_HOST=your-mail-host
MAIL_PORT=587
MAIL_USERNAME=your-mail-username
MAIL_PASSWORD=your-mail-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@your-domain.com
MAIL_FROM_NAME="${APP_NAME}"
```

2. **Optimisations**
```bash
# Optimiser l'autoloader
composer install --optimize-autoloader --no-dev

# Cacher les configurations
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Compiler les assets
npm run build

# Permissions
chmod -R 755 storage bootstrap/cache
```

3. **Configuration du serveur web**

Pour Nginx :
```nginx
server {
    listen 80;
    listen [::]:80;
    server_name your-domain.com;
    root /path/to/laravel-annecy/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### Checklist de Déploiement

- [ ] Variables d'environnement configurées
- [ ] APP_DEBUG=false
- [ ] APP_URL définie correctement
- [ ] Base de données PostgreSQL configurée
- [ ] Redis configuré pour cache et sessions
- [ ] Migrations exécutées
- [ ] Caches optimisés (config, routes, views)
- [ ] Assets compilés avec `npm run build`
- [ ] Queue workers configurés (Horizon)
- [ ] Tâches planifiées configurées (cron)
- [ ] Permissions correctes (storage, bootstrap/cache)
- [ ] HTTPS/SSL configuré
- [ ] Backups configurés
- [ ] Monitoring configuré (Telescope en lecture seule)

## 🧪 Tests

```bash
# Lancer tous les tests
./vendor/bin/sail artisan test

# Tests spécifiques
./vendor/bin/sail artisan test --filter=ExplorePageTest

# Avec couverture
./vendor/bin/sail artisan test --coverage
```

## 🎨 Code Quality

```bash
# Formater le code avec Pint
./vendor/bin/sail bin pint

# Analyse statique avec PHPStan
./vendor/bin/sail bin phpstan analyse
```

## 📚 Documentation

- Voir `DOCUMENTATION_INDEX.md` pour un guide complet de toute la documentation
- Lire `CRITIQUE_ET_PRECONISATION.md` pour comprendre l'état actuel
- Consulter `ACTION_PLAN.md` pour le plan d'amélioration

## 🤝 Contribution

Les contributions sont les bienvenues ! Veuillez :

1. Fork le projet
2. Créer une branche feature (`git checkout -b feature/AmazingFeature`)
3. Commit vos changements (`git commit -m 'Add some AmazingFeature'`)
4. Push vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrir une Pull Request

## 📝 License

MIT License - voir le fichier LICENSE pour plus de détails.

## 👤 Auteur

**Ishaq74**
- GitHub: [@Ishaq74](https://github.com/Ishaq74)

## 🙏 Remerciements

- Laravel Framework
- Livewire & Volt
- Flux UI
- Tous les contributeurs du projet

---

Made with ❤️ in Annecy
