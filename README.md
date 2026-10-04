# Mini-module de demandes de contact
Application Laravel + Blade permettant à des visiteurs d'envoyer une demande, et à un admin de la consulter.
## Lancer le projet
1. `git clone https://github.com/priscille827/mini-module-contact.git && cd mini-module-contact`
2. `composer install && cp .env.example .env && php artisan key:generate`
3. Configurer la BDD dans `.env`, puis importer le fichier `bdh_contact.sql` (fourni à la racine).
4. Renseigner `RESEND_API_KEY` dans `.env`. L'adresse d'envoi et de réception admin est `priscillekindoho@gmail.com`.
5. `php artisan serve` → http://localhost:8000
## Terminé
Formulaire public, enregistrement BDD, espace admin (login, dashboard, recherche, filtres, pagination, traitement, corbeille), suivi de demande côté client, e-mails Resend, responsive mobile, déploiement Railway.
