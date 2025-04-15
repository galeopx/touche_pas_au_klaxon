<?php
/**
 * Modèle pour la gestion des utilisateurs
 * 
 * @package Touche Pas Au Klaxon
 */

namespace App\Models;

class User
{
    private $db;
    
    /**
     * Constructeur
     */
    public function __construct()
    {
        $this->db = new \Database();
    }
    
    /**
     * Récupère tous les utilisateurs
     * 
     * @return array
     */
    public function getAll()
    {
        $this->db->query("SELECT * FROM utilisateur ORDER BY nom, prenom");
        return $this->db->resultSet();
    }
    
    /**
     * Trouve un utilisateur par son ID
     * 
     * @param int $id L'identifiant de l'utilisateur
     * @return object|false
     */
    public function findById($id)
    {
        $this->db->query("SELECT * FROM utilisateur WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    
    /**
     * Trouve un utilisateur par son email
     * 
     * @param string $email L'email de l'utilisateur
     * @return object|false
     */
    public function findByEmail($email)
    {
        $this->db->query("SELECT * FROM utilisateur WHERE email = :email");
        $this->db->bind(':email', $email);
        return $this->db->single();
    }
}