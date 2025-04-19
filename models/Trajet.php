<?php
/**
 * Modèle pour la gestion des trajets
 * 
 * @package Touche Pas Au Klaxon
 */

namespace Models;

class Trajet
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
     * Récupère tous les trajets
     * 
     * @return array
     */
    public function getAll()
    {
        $this->db->query("SELECT * FROM trajet ORDER BY date_depart, heure_depart");
        return $this->db->resultSet();
    }
    
    /**
     * Récupère tous les trajets avec détails (agences et utilisateur)
     * 
     * @return array
     */
    public function getAllWithDetails()
    {
        $this->db->query("
            SELECT t.*, 
                ad.nom as agence_depart, 
                aa.nom as agence_arrivee,
                u.nom as utilisateur_nom,
                u.prenom as utilisateur_prenom,
                u.telephone,
                u.email
            FROM trajet t
            JOIN agence ad ON t.agence_depart_id = ad.id
            JOIN agence aa ON t.agence_arrivee_id = aa.id
            JOIN utilisateur u ON t.utilisateur_id = u.id
            ORDER BY t.date_depart, t.heure_depart
        ");
        return $this->db->resultSet();
    }
    
    /**
     * Récupère les trajets disponibles (places > 0 et date future)
     * 
     * @return array
     */
    public function getAvailableTrajets()
    {
        $this->db->query("
            SELECT t.*, 
                ad.nom as agence_depart, 
                aa.nom as agence_arrivee
            FROM trajet t
            JOIN agence ad ON t.agence_depart_id = ad.id
            JOIN agence aa ON t.agence_arrivee_id = aa.id
            WHERE t.places_disponibles > 0
            AND (t.date_depart > CURDATE() 
                OR (t.date_depart = CURDATE() AND t.heure_depart > CURTIME()))
            ORDER BY t.date_depart, t.heure_depart
        ");
        return $this->db->resultSet();
    }
    
    /**
     * Récupère les trajets d'un utilisateur
     * 
     * @param int $userId L'identifiant de l'utilisateur
     * @return array
     */
    public function getUserTrajets($userId)
    {
        $this->db->query("
            SELECT t.*, 
                ad.nom as agence_depart, 
                aa.nom as agence_arrivee
            FROM trajet t
            JOIN agence ad ON t.agence_depart_id = ad.id
            JOIN agence aa ON t.agence_arrivee_id = aa.id
            WHERE t.utilisateur_id = :user_id
            ORDER BY t.date_depart, t.heure_depart
        ");
        $this->db->bind(':user_id', $userId);
        return $this->db->resultSet();
    }
    
    /**
     * Trouve un trajet par son ID
     * 
     * @param int $id L'identifiant du trajet
     * @return object|false
     */
    public function findById($id)
    {
        $this->db->query("SELECT * FROM trajet WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    
    /**
     * Récupère les détails d'un trajet (agences et utilisateur)
     * 
     * @param int $id L'identifiant du trajet
     * @return object|false
     */
    public function getTrajetDetails($id)
    {
        $this->db->query("
            SELECT t.*, 
                ad.nom as agence_depart, 
                aa.nom as agence_arrivee,
                u.nom as utilisateur_nom,
                u.prenom as utilisateur_prenom,
                u.telephone,
                u.email
            FROM trajet t
            JOIN agence ad ON t.agence_depart_id = ad.id
            JOIN agence aa ON t.agence_arrivee_id = aa.id
            JOIN utilisateur u ON t.utilisateur_id = u.id
            WHERE t.id = :id
        ");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    
    /**
     * Crée un nouveau trajet
     * 
     * @param array $data Les données du trajet
     * @return bool
     */
    public function create($data)
    {
        $this->db->query("
            INSERT INTO trajet 
                (date_depart, heure_depart, date_arrivee, heure_arrivee, 
                places_total, places_disponibles, utilisateur_id, 
                agence_depart_id, agence_arrivee_id) 
            VALUES 
                (:date_depart, :heure_depart, :date_arrivee, :heure_arrivee, 
                :places_total, :places_disponibles, :utilisateur_id, 
                :agence_depart_id, :agence_arrivee_id)
        ");
        
        $this->db->bind(':date_depart', $data['date_depart']);
        $this->db->bind(':heure_depart', $data['heure_depart']);
        $this->db->bind(':date_arrivee', $data['date_arrivee']);
        $this->db->bind(':heure_arrivee', $data['heure_arrivee']);
        $this->db->bind(':places_total', $data['places_total']);
        $this->db->bind(':places_disponibles', $data['places_disponibles']);
        $this->db->bind(':utilisateur_id', $data['utilisateur_id']);
        $this->db->bind(':agence_depart_id', $data['agence_depart_id']);
        $this->db->bind(':agence_arrivee_id', $data['agence_arrivee_id']);
        
        return $this->db->execute();
    }
    
    /**
     * Met à jour un trajet
     * 
     * @param int $id L'identifiant du trajet
     * @param array $data Les données du trajet
     * @return bool
     */
    public function update($id, $data)
    {
        $this->db->query("
            UPDATE trajet SET 
                date_depart = :date_depart,
                heure_depart = :heure_depart,
                date_arrivee = :date_arrivee,
                heure_arrivee = :heure_arrivee,
                places_total = :places_total,
                places_disponibles = :places_disponibles,
                agence_depart_id = :agence_depart_id,
                agence_arrivee_id = :agence_arrivee_id
            WHERE id = :id AND utilisateur_id = :utilisateur_id
        ");
        
        $this->db->bind(':date_depart', $data['date_depart']);
        $this->db->bind(':heure_depart', $data['heure_depart']);
        $this->db->bind(':date_arrivee', $data['date_arrivee']);
        $this->db->bind(':heure_arrivee', $data['heure_arrivee']);
        $this->db->bind(':places_total', $data['places_total']);
        $this->db->bind(':places_disponibles', $data['places_disponibles']);
        $this->db->bind(':agence_depart_id', $data['agence_depart_id']);
        $this->db->bind(':agence_arrivee_id', $data['agence_arrivee_id']);
        $this->db->bind(':id', $id);
        $this->db->bind(':utilisateur_id', $data['utilisateur_id']);
        
        return $this->db->execute();
    }
    
    /**
     * Supprime un trajet
     * 
     * @param int $id L'identifiant du trajet
     * @return bool
     */
    public function delete($id)
    {
        $this->db->query("DELETE FROM trajet WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}