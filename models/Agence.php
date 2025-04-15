<?php
/**
 * Modèle pour la gestion des agences
 * 
 * @package Touche Pas Au Klaxon
 */

namespace App\Models;

class Agence
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
     * Récupère toutes les agences
     * 
     * @return array
     */
    public function getAll()
    {
        $this->db->query("SELECT * FROM agence ORDER BY nom");
        return $this->db->resultSet();
    }
    
    /**
     * Trouve une agence par son ID
     * 
     * @param int $id L'identifiant de l'agence
     * @return object|false
     */
    public function findById($id)
    {
        $this->db->query("SELECT * FROM agence WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    
    /**
     * Crée une nouvelle agence
     * 
     * @param array $data Les données de l'agence
     * @return bool
     */
    public function create($data)
    {
        $this->db->query("INSERT INTO agence (nom) VALUES (:nom)");
        $this->db->bind(':nom', $data['nom']);
        return $this->db->execute();
    }
    
    /**
     * Met à jour une agence
     * 
     * @param int $id L'identifiant de l'agence
     * @param array $data Les données de l'agence
     * @return bool
     */
    public function update($id, $data)
    {
        $this->db->query("UPDATE agence SET nom = :nom WHERE id = :id");
        $this->db->bind(':nom', $data['nom']);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
    
    /**
     * Supprime une agence
     * 
     * @param int $id L'identifiant de l'agence
     * @return bool
     */
    public function delete($id)
    {
        $this->db->query("DELETE FROM agence WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}