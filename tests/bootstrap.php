<?php
// Inclure l'autoloader de Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Définir les constantes pour les tests
define('APP_ROOT', dirname(__DIR__));
define('URL_ROOT', 'http://localhost/touche_pas_au_klaxon');
define('DB_HOST', $_ENV['DB_HOST'] ?? 'localhost');
define('DB_USER', $_ENV['DB_USER'] ?? 'root');
define('DB_PASS', $_ENV['DB_PASS'] ?? '');
define('DB_NAME', $_ENV['DB_NAME'] ?? 'touche_pas_au_klaxon_test');

// Créer une base de données de test si elle n'existe pas
function createTestDatabase() {
    $pdo = new PDO('mysql:host='.DB_HOST, DB_USER, DB_PASS);
    $pdo->exec('CREATE DATABASE IF NOT EXISTS ' . DB_NAME);
    $pdo->exec('USE ' . DB_NAME);
    
    // Exécuter le script de création de tables
    $sql = file_get_contents(APP_ROOT . '/database/schema.sql');
    $pdo->exec($sql);
    
    return $pdo;
}

// Initialiser la base de données de test
createTestDatabase();