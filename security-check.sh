#!/bin/bash

# Script de vérification de sécurité avant production
# À exécuter: bash security-check.sh

echo "🔒 Vérification de Sécurité - Sama CV"
echo "===================================="

# 1. Vérifier APP_DEBUG
if grep -q "APP_DEBUG=true" .env; then
    echo "❌ APP_DEBUG=true détecté! Mettre à false en production"
else
    echo "✅ APP_DEBUG=false"
fi

# 2. Vérifier APP_ENV
if grep -q "APP_ENV=production" .env; then
    echo "✅ APP_ENV=production"
else
    echo "⚠️  APP_ENV n'est pas production (développement ok)"
fi

# 3. Vérifier la clé APP_KEY
if grep -q "APP_KEY=base64:" .env; then
    echo "✅ APP_KEY initialisée"
else
    echo "❌ APP_KEY non trouvée! Exécuter: php artisan key:generate"
fi

# 4. Vérifier les fichiers sensibles
if [ -f ".env.example" ]; then
    echo "✅ .env.example trouvé"
fi

if [ -f ".env" ]; then
    echo "✅ .env existe"
    if [ -r ".env" ]; then
        echo "⚠️  .env est lisible - Vérifier les permissions: chmod 600 .env"
    fi
fi

# 5. Vérifier les dossiers de stockage
if [ -d "storage/logs" ]; then
    echo "✅ Dossier storage/logs existe"
else
    echo "❌ Dossier storage/logs manquant!"
fi

# 6. Vérifier les permissions web root
echo ""
echo "📁 Recommandations de permissions:"
echo "chmod -R 755 /var/www/sama-cv"
echo "chmod -R 775 /var/www/sama-cv/bootstrap/cache"
echo "chmod -R 775 /var/www/sama-cv/storage"
echo "chown -R www-data:www-data /var/www/sama-cv"

# 7. Vérifier les dépendances
echo ""
if command -v php &> /dev/null; then
    php_version=$(php -r "echo PHP_VERSION;")
    echo "✅ PHP $php_version"
    
    if [ "$php_version" \< "8.0" ]; then
        echo "❌ PHP 8.0+ requis!"
    fi
fi

# 8. Vérifier les extensions PHP
echo ""
echo "🔍 Extensions PHP requises:"
required_extensions=("pdo" "mbstring" "tokenizer" "XML" "Ctype" "JSON" "bcmath")

for ext in "${required_extensions[@]}"; do
    if php -m | grep -qi "^${ext}"; then
        echo "✅ $ext"
    else
        echo "❌ $ext manquante"
    fi
done

# 9. Sauvegardes
echo ""
echo "💾 Recommandations de sauvegarde:"
echo "- Configurer des backups automatiques de la base de données"
echo "- Backups quotidiens MINIMUM"
echo "- Tester les restaurations régulièrement"

echo ""
echo "✅ Vérification complètie!"
echo "Vérifier manuellement les points marqués ⚠️"
