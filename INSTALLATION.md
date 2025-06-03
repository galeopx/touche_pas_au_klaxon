# Installation et lancement de l'application "Touche Pas Au Klaxon"

## Prérequis

- XAMPP (Apache + MySQL + PHP 8.x)
- Navigateur web moderne

## Étapes d'installation

### 1. Installation de XAMPP
- Télécharger et installer XAMPP depuis https://www.apachefriends.org/
- Démarrer le XAMPP Control Panel

### 2. Déploiement du projet
- Copier le dossier `touche_pas_au_klaxon` dans `C:\xampp\htdocs\`

### 3. Configuration de la base de données
- Démarrer Apache et MySQL dans XAMPP Control Panel
- Ouvrir phpMyAdmin : `http://localhost/phpmyadmin`
- Créer une nouvelle base de données nommée `touche_pas_au_klaxon`
- Importer les fichiers SQL dans l'ordre :
  1. `database/schema.sql` (structure des tables)
  2. `database/seed.sql` (données de test)

### 4. Installation des dépendances
- Ouvrir un terminal dans le dossier du projet
- Exécuter : `composer install`

### 5. Lancement de l'application
- S'assurer qu'Apache et MySQL sont démarrés dans XAMPP
- Ouvrir un navigateur et aller sur : `http://localhost/touche_pas_au_klaxon/public/`

## Identifiants de test

### Administrateur
- Email : `arthur.henry@email.fr`
- Mot de passe : `password`

### Utilisateur standard
- Email : `alexandre.martin@email.fr`
- Mot de passe : `password`

## Configuration

Le fichier de configuration se trouve dans `config/config.php` avec les paramètres :
- Base de données : `localhost`
- Utilisateur : `root`
- Mot de passe : (vide)
- Base : `touche_pas_au_klaxon`
