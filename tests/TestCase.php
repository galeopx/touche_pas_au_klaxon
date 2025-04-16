<?php
namespace Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;
use PDO;

class TestCase extends BaseTestCase
{
    protected $pdo;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        // Créer une connexion PDO pour les tests
        $this->pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ]);
        
        // Vider les tables avant chaque test
        $this->truncateTables();
    }
    
    protected function truncateTables()
    {
        // Désactiver les contraintes de clés étrangères
        $this->pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
        
        // Vider les tables
        $tables = ['trajet', 'agence', 'utilisateur'];
        foreach ($tables as $table) {
            $this->pdo->exec("TRUNCATE TABLE $table");
        }
        
        // Réactiver les contraintes de clés étrangères
        $this->pdo->exec('SET FOREIGN_KEY_CHECKS = 1');
    }
    
    protected function tearDown(): void
    {
        // Fermer la connexion
        $this->pdo = null;
        
        parent::tearDown();
    }
    
    // Méthode utilitaire pour insérer des utilisateurs de test
    protected function createTestUser($role = 'user')
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO utilisateur (nom, prenom, telephone, email, role, password) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        
        $nom = 'Test';
        $prenom = 'User';
        $telephone = '0123456789';
        $email = 'test@example.com';
        $password = password_hash('password', PASSWORD_DEFAULT);
        
        $stmt->execute([$nom, $prenom, $telephone, $email, $role, $password]);
        
        return $this->pdo->lastInsertId();
    }
    
    // Méthode utilitaire pour insérer des agences de test
    protected function createTestAgence($nom = 'Test Agence')
    {
        $stmt = $this->pdo->prepare("INSERT INTO agence (nom) VALUES (?)");
        $stmt->execute([$nom]);
        
        return $this->pdo->lastInsertId();
    }
}