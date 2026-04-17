# 🔄 CONFIGURATION SUPERVISOR - Gestion-CV

**Status:** ✅ Fichier de config fourni  
**Dernière mise à jour:** 17 avril 2026

---

## 📋 RÉSUMÉ

Supervisor va gérer tes queue workers qui traitent les jobs Redis.

**Inclus:**
- ✅ 2 workers Redis (traitement parallèle)
- ✅ Auto-restart si un worker crash
- ✅ Logs configurés
- ✅ Environment production

---

## 🔧 INSTALLATION SUR TON VPS

### Étape 1: Installe Supervisor
```bash
# SSH à ton VPS
ssh user@your-vps.com

# Installe Supervisor (si pas déjà fait)
sudo apt update
sudo apt install -y supervisor

# Vérifie
supervisord --version
```

### Étape 2: Copie le fichier de config
```bash
# Depuis ton local (ou VPS si tu as un git repo):
# Le fichier gestion-cv-worker.conf est fourni dans le projet

# Copie-le sur ton VPS dans Supervisor:
sudo cp gestion-cv-worker.conf /etc/supervisor/conf.d/

# Ou manuellement:
sudo nano /etc/supervisor/conf.d/gestion-cv-worker.conf
# Copie le contenu du fichier fourni
```

### Étape 3: Remplace les chemins si nécessaire
```bash
# Édite si ton chemin app est différent:
sudo nano /etc/supervisor/conf.d/gestion-cv-worker.conf

# Change cette ligne au besoin:
command=php /var/www/gestion-cv/artisan queue:work redis --sleep=3 --tries=3 --timeout=0
                    ^^^^^^^^^^^^^^^^
                    Ton chemin exact

# Vérifie aussi l'utilisateur (www-data ou autre):
user=www-data
```

### Étape 4: Redémarrage Supervisor
```bash
# Relis la config
sudo supervisorctl reread

# Mets à jour
sudo supervisorctl update

# Démarre les workers
sudo supervisorctl start gestion-cv-workers:*

# Vérifie le statut
sudo supervisorctl status
```

**Succès = Voir RUNNING:**
```
gestion-cv-redis-worker:gestion-cv-redis-worker_00   RUNNING   pid 1234, uptime 0:00:05
gestion-cv-redis-worker:gestion-cv-redis-worker_01   RUNNING   pid 1235, uptime 0:00:05
```

---

## 📊 VÉRIFIER QUE ÇA MARCHE

### Test 1: Vérifie que les workers tournent
```bash
sudo supervisorctl status

# Devrait afficher:
gestion-cv-redis-worker:gestion-cv-redis-worker_00   RUNNING
gestion-cv-redis-worker:gestion-cv-redis-worker_01   RUNNING
```

### Test 2: Dispatch un job test
```bash
# SSH dans ton app:
cd /var/www/gestion-cv

# Artisan tinker:
php artisan tinker

# Dispatch un job:
>>> dispatch(new App\Jobs\YourTestJob());
# Ou pour tester:
>>> \App\Mail\TestMail::dispatch('test@example.com');

# Quitte:
>>> exit

# Vérifie les logs:
tail -20 /var/log/supervisor/gestion-cv-worker.log
# Devrait voir le job processed
```

### Test 3: Monitore les workers en temps réel
```bash
# Affiche les 10 dernières lignes et suit les updates:
tail -f /var/log/supervisor/gestion-cv-worker.log

# Ou depuis Supervisor:
sudo supervisorctl tail gestion-cv-redis-worker
```

---

## 🎯 COMMANDES SUPERVISOR COURANTES

```bash
# Affiche statut de tous les workers
sudo supervisorctl status

# Démarre les workers
sudo supervisorctl start gestion-cv-workers:*

# Arrête les workers
sudo supervisorctl stop gestion-cv-workers:*

# Redémarre les workers
sudo supervisorctl restart gestion-cv-workers:*

# Voit les logs
sudo supervisorctl tail gestion-cv-redis-worker stdout
sudo supervisorctl tail gestion-cv-redis-worker stderr

# Recharge la config (après édition)
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl restart gestion-cv-workers:*

# Reload du service supervisor lui-même
sudo systemctl reload supervisor

# Pour débugger un worker spécifique en avant-plan (non-daemon):
php /var/www/gestion-cv/artisan queue:work redis --verbose
```

---

## ⚙️ PERSONNALISATION

### Plus de workers (par défaut: 2)
```ini
[program:gestion-cv-redis-worker]
numprocs=4  # Augmente de 2 à 4 workers
```

### Changer le sleep time (par défaut: 3 sec)
```ini
command=php /var/www/gestion-cv/artisan queue:work redis --sleep=1 --tries=3
                                                                   ^^^
                                                    Sleep less si beaucoup de jobs
```

### Ignorer les jobs qui fail après 3 tentatives
```ini
command=php /var/www/gestion-cv/artisan queue:work redis --tries=5 --timeout=60
                                                                ^^^^
                                                    Aumenta tentatives si besoin
```

### Auto-restart après X jobs
```ini
command=php /var/www/gestion-cv/artisan queue:work redis --max-jobs=1000
```

### Timeout du job (par défaut: 0 = illimité)
```ini
command=php /var/www/gestion-cv/artisan queue:work redis --timeout=300
                                                                       ^^^
                                                    300 sec = 5 min max par job
```

---

## 🚨 TROUBLESHOOTING

### "Connection refused" worker
```bash
# Vérifie Redis:
redis-cli ping
# Devrait: PONG

# Redémarre Redis:
sudo systemctl restart redis-server

# Redémarre les workers:
sudo supervisorctl restart gestion-cv-workers:*
```

### Worker crash au démarrage
```bash
# Vérifie les logs:
tail -50 /var/log/supervisor/gestion-cv-worker.log

# Vérifie le chemin PHP:
which php
# Change la command avec le bon chemin si besoin

# Vérifie les permissions:
ls -la /var/www/gestion-cv/artisan
# Devrait être lisible par www-data

# Redémarre:
sudo supervisorctl restart gestion-cv-workers:*
```

### Worker s'arrête après quelques secondes
```bash
# Probable: Erreur dans le app code
# Vérifie les logs détaillés:
sudo supervisorctl tail gestion-cv-redis-worker stderr

# Test manuellement:
cd /var/www/gestion-cv
php artisan queue:work redis --verbose
# Lance en avant-plan pour voir les erreurs

# Fix le code et redémarre:
sudo supervisorctl restart gestion-cv-workers:*
```

### Queue jobs ne s'exécutent pas
```bash
# 1. Vérifie que les workers tournent:
sudo supervisorctl status
# Devrait voir RUNNING

# 2. Vérifie que les jobs sont dans Redis:
redis-cli
> KEYS default:*
> LLEN default:default  # Nombre de jobs en queue

# 3. Recréé le worker s'il y a un problème:
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl restart gestion-cv-workers:*

# 4. Redispatch les failed jobs:
php artisan queue:retry all

# Quitte Redis:
> exit
```

---

## 📈 MONITORING AVANCÉ

### Logs avec des timestamps
```bash
# Affiche les logs avec timestamps:
tail -f /var/log/supervisor/gestion-cv-worker.log | cat -A

# Ou utilise journalctl:
journalctl -u supervisor -f
```

### Notifications si un worker crash
```bash
# Ajoute un email alert:
sudo nano /etc/supervisor/conf.d/gestion-cv-worker.conf

# Ajoute:
eventlistener=gestion-cv-event-worker

# Puis crée le listener (avancé, skip si trop complexe)
```

### Statistiques des jobs
```bash
# Nombre de jobs en queue:
redis-cli LLEN default:default

# Jobs qui ont échoué:
redis-cli LLEN failed

# Vérifie les queues disponibles:
redis-cli KEYS default:*
```

---

## ✨ QUICK START

```bash
# 1. Installe Supervisor
sudo apt install -y supervisor

# 2. Copie la config
sudo cp gestion-cv-worker.conf /etc/supervisor/conf.d/

# 3. Redémarre Supervisor
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl restart gestion-cv-workers:*

# 4. Vérifie
sudo supervisorctl status
# Devrait voir RUNNING

# 5. Teste
php artisan tinker
>>> dispatch(new App\Jobs\TestJob());
>>> exit

# 6. Monitore
tail -f /var/log/supervisor/gestion-cv-worker.log
```

---

## 📝 CE QUI EST CONFIGURÉ 

**gestion-cv-worker.conf inclut:**
- ✅ 2 workers parallèles (numprocs=2)
- ✅ Auto-restart si crash (autorestart=true)
- ✅ Redémarrage automatique si erreur (autostart=true)
- ✅ Logs rotatifs (10MB max, 5 backups)
- ✅ User www-data (permissions correctes)
- ✅ Environment production

**Champs clés expliqués:**
```ini
command=...                          # Commande à exécuter
autostart=true                       # Lance au boot du VPS
autorestart=true                     # Relance si crash
redirect_stderr=true                 # Logs stderr → stdout
stdout_logfile=/var/log/...          # Où enregistrer les logs
user=www-data                        # Quel user exécute
numprocs=2                           # Nombre de workers
```

---

## 🎉 CONFIGURATION COMPLÈTE!

Supervisor va maintenant:
- ✅ Lancer 2 workers au démarrage du VPS
- ✅ Relancer automatiquement si un worker crash
- ✅ Traiter les jobs Redis en arrière-plan
- ✅ Logger tout dans les fichiers

**Tu peux maintenant:**
```bash
# Dispatcher des jobs
dispatch(new App\Jobs\SendEmail($user));

# Les workers les traiteront automatiquement
# Sans bloquer les utilisateurs!
```

**Performance:**
- **Avant:** Les emails/PDFs bloquaient les users (slow requests)
- **Après:** Traitement asynchrone, réponse rapide (< 100ms)

**Prêt à déployer!** 🚀
