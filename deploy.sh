#!/bin/bash

# Script de déploiement automatisé pour Gestion-CV
# Utilisation: ./deploy.sh [production|staging|local]

set -e

ENVIRONMENT=${1:-production}
APP_PATH="/var/www/cv"

echo "🚀 Déploiement en cours sur: $ENVIRONMENT"
echo "-------------------------------------------"

# 1. Accéder au répertoire de l'application
cd $APP_PATH || { echo "❌ Erreur: Impossible d'accéder à $APP_PATH"; exit 1; }

# 2. Mettre à jour le code depuis Git
echo "📥 Mise à jour du code depuis GitHub..."
git config --global --add safe.directory $APP_PATH
git fetch origin
git pull origin main

# 3. Installer les dépendances Composer
echo "📦 Installation des dépendances Composer..."
composer install --no-dev --optimize-autoloader

# 4. Exécuter les migrations si nécessaire
echo "🔄 Exécution des migrations..."
php artisan migrate --force

# 5. Effacer le cache
echo "🧹 Effacement du cache..."
php artisan optimize:clear
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# 6. Recompiler les assets si nécessaire
echo "🎨 Préparation des assets..."
php artisan optimize

# 7. Redémarrer les workers Supervisor
if [ "$ENVIRONMENT" = "production" ]; then
    echo "♻️  Redémarrage des workers Supervisor..."
    supervisorctl restart laravel-cv-worker:*
fi

# 8. Vérifier l'intégrité de l'application
echo "✅ Vérification de l'application..."
php artisan tinker --execute="echo 'Application OK';" 2>/dev/null || echo "⚠️  Attention: Impossible de vérifier l'intégrité"

echo ""
echo "✅ Déploiement terminé avec succès!"
echo "-------------------------------------------"
echo "🌐 Site: https://cv.mio-ressources.me"
echo "📊 Admin: https://cv.mio-ressources.me/admin"
echo ""
