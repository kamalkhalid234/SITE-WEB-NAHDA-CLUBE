# SITE-WEB-NAHDA-CLUBE

Site web de l’association/clubs **Nahda Chichaoua**, avec :
- une partie publique (actualités, équipes, galerie, sponsors, contact),
- une partie administration pour gérer le contenu.

## Stack technique

- **PHP** (procédural)
- **MySQL / MariaDB**
- **Bootstrap + assets front-end** (AOS, Swiper, etc.)

## Structure du projet

- `/administration` : pages publiques principales du site (accueil, sports, actualités, contact…)
- `/admin` : espace d’administration (gestion joueurs, matchs, galerie, sponsors, actualités, etc.)
- `/inc` : composants partagés (`header.php`, `footer.php`, `link.php`)
- `/assets` : ressources front-end (CSS, JS, images, vendors)
- `base/association.sql` et `association-3.sql` : scripts SQL de base de données

## Prérequis

- PHP 8.x (7.4+ possible selon environnement)
- MySQL ou MariaDB
- Serveur local (Apache via XAMPP/WAMP/Laragon, ou équivalent)

## Installation locale

1. Copier le projet dans le dossier web local (`htdocs` par exemple).
2. Créer une base de données nommée **`association`**.
3. Importer un script SQL :
   - `base/association.sql` (recommandé en premier),
   - ou `association-3.sql` selon votre jeu de données.
4. Vérifier les paramètres de connexion MySQL dans les fichiers PHP (ex: `localhost`, `root`, mot de passe vide, base `association`).
5. Lancer Apache + MySQL puis ouvrir :
   - Site public : `http://localhost/SITE-WEB-NAHDA-CLUBE/administration/index.php`
   - Admin : `http://localhost/SITE-WEB-NAHDA-CLUBE/admin/index.php`

## Notes

- Plusieurs pages utilisent des connexions SQL directes dans les fichiers PHP.
- Le formulaire de contact utilise une librairie `PHP Email Form` (voir `forms/contact.php`).

## Améliorations possibles

- Centraliser la configuration base de données dans un seul fichier.
- Ajouter une validation/sanitisation plus stricte côté serveur.
- Ajouter une documentation des identifiants admin de démonstration (si existants).

