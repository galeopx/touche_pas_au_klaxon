# TOUCHE PAS AU KLAXON

Application de covoiturage interne pour entreprise avec implantations multiples, développée en PHP avec une architecture MVC.

## Description

Cette application permet de faciliter le covoiturage entre les différents sites d'une entreprise. Les employés peuvent proposer des trajets et visualiser les trajets disponibles, afin d'optimiser les déplacements et réduire le nombre de véhicules utilisés.

### Fonctionnalités principales

- Affichage des trajets disponibles sur la page d'accueil
- Système d'authentification (employés/administrateur)
- Création, modification et suppression de trajets
- Gestion des agences (par l'administrateur)
- Visualisation des détails de contact pour les trajets

## Prérequis

- PHP 7.4 ou supérieur
- MySQL 5.7 ou supérieur (ou MariaDB)
- Composer
- Serveur web (Apache, Nginx, ou serveur intégré de PHP)
- Extension PHP : zip, pdo_mysql, mbstring

## Installation

1. **Cloner le dépôt**
git clone https://github.com/galeopx/touche_pas_au_klaxon
cd touche_pas_au_klaxon

2. **Installer les dépendances**
[composer install]

3. **Configuration de la base de données**
- Créer une base de données MySQL
- Importer le schéma depuis `database/schema.sql`
- Importer les données de test depuis `database/seed.sql`
- Configurer les informations de connexion dans `config/config.php`

## Structure du projet

touche_pas_au_klaxon/
├── assets/              # Ressources statiques (CSS, SCSS)
├── config/              # Fichiers de configuration
├── controllers/         # Contrôleurs MVC
├── database/            # Scripts SQL
├── models/              # Modèles MVC
├── public/              # Point d'entrée public
├── routes/              # Configuration des routes
├── tests/               # Tests unitaires
├── utils/               # Classes utilitaires
├── vendor/              # Dépendances (via Composer)
└── views/               # Vues MVC

## Architecture MVC

- **Modèles** : représentent les données et la logique métier
- **Vues** : gèrent l'affichage et l'interface utilisateur
- **Contrôleurs** : coordonnent les interactions entre les modèles et les vues

## Tests

Pour exécuter les tests unitaires :
[vendor/bin/phpunit]

## Identifiants de test

### Administrateur
- Email : arthur.henry@email.fr
- Mot de passe : password

### Utilisateur standard
- Email : alexandre.martin@email.fr
- Mot de passe : password

## Technologies utilisées

- PHP 8.0
- MySQL
- Architecture MVC
- Bootstrap 5
- SASS
- PHPUnit
- PHPStan
- IzniburakRouter

## Palette de couleurs

- Principal : #0074c7
- Secondaire : #00497c
- Foncé : #384050
- Danger : #cd2c2e
- Succès : #82b864
- Clair : #f1f8fc

## Contributeurs

- PRIOUX Galéo
