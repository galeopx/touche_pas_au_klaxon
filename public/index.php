<?php
/**
 * Point d'entrée principal de l'application
 * 
 * @package Touche Pas Au Klaxon
 */

// Charger la configuration
require_once '../config/config.php';

// Chargement des bibliothèques
require_once '../vendor/autoload.php';

// Instancier la base de données
require_once '../config/database.php';
$database = new Database();

// Démarrer la session
session_start();

// Charger le routeur
require_once '../routes/web.php';