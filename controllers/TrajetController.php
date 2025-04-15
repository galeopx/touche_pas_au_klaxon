<?php
/**
 * Contrôleur de gestion des trajets
 * 
 * @package Touche Pas Au Klaxon
 */

namespace App\Controllers;

class TrajetController
{
    /**
     * Affiche le formulaire de création d'un trajet
     * 
     * @return void
     */
    public function create()
    {
        $agenceModel = new \App\Models\Agence();
        $agences = $agenceModel->getAll();
        
        $userModel = new \App\Models\User();
        $user = $userModel->findById($_SESSION['user_id']);
        
        require_once '../views/trajets/create.php';
    }
    
    /**
     * Enregistre un nouveau trajet
     * 
     * @return void
     */
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validation des données
            $errors = [];
            
            $agenceDepart = filter_input(INPUT_POST, 'agence_depart', FILTER_SANITIZE_NUMBER_INT);
            $agenceArrivee = filter_input(INPUT_POST, 'agence_arrivee', FILTER_SANITIZE_NUMBER_INT);
            $dateDepart = filter_input(INPUT_POST, 'date_depart', FILTER_SANITIZE_STRING);
            $heureDepart = filter_input(INPUT_POST, 'heure_depart', FILTER_SANITIZE_STRING);
            $dateArrivee = filter_input(INPUT_POST, 'date_arrivee', FILTER_SANITIZE_STRING);
            $heureArrivee = filter_input(INPUT_POST, 'heure_arrivee', FILTER_SANITIZE_STRING);
            $placesTotal = filter_input(INPUT_POST, 'places_total', FILTER_SANITIZE_NUMBER_INT);
            
            // Vérifier que les agences sont différentes
            if ($agenceDepart === $agenceArrivee) {
                $errors[] = "L'agence de départ et d'arrivée doivent être différentes.";
            }
            
            // Vérifier les dates et heures
            $timestampDepart = strtotime("$dateDepart $heureDepart");
            $timestampArrivee = strtotime("$dateArrivee $heureArrivee");
            
            if ($timestampArrivee <= $timestampDepart) {
                $errors[] = "La date et l'heure d'arrivée doivent être postérieures à la date et l'heure de départ.";
            }
            
            // Si pas d'erreurs, sauvegarder le trajet
            if (empty($errors)) {
                $trajetModel = new \App\Models\Trajet();
                $trajet = [
                    'date_depart' => $dateDepart,
                    'heure_depart' => $heureDepart,
                    'date_arrivee' => $dateArrivee,
                    'heure_arrivee' => $heureArrivee,
                    'places_total' => $placesTotal,
                    'places_disponibles' => $placesTotal,
                    'utilisateur_id' => $_SESSION['user_id'],
                    'agence_depart_id' => $agenceDepart,
                    'agence_arrivee_id' => $agenceArrivee
                ];
                
                if ($trajetModel->create($trajet)) {
                    // Message flash de succès
                    $_SESSION['flash'] = [
                        'type' => 'success',
                        'message' => 'Le trajet a été créé avec succès.'
                    ];
                    
                    header('Location: /user');
                    exit;
                } else {
                    $errors[] = "Une erreur est survenue lors de la création du trajet.";
                }
            }
            
            // S'il y a des erreurs, réafficher le formulaire
            if (!empty($errors)) {
                $agenceModel = new \App\Models\Agence();
                $agences = $agenceModel->getAll();
                
                $userModel = new \App\Models\User();
                $user = $userModel->findById($_SESSION['user_id']);
                
                require_once '../views/trajets/create.php';
            }
        }
    }
    
    /**
     * Affiche le formulaire d'édition d'un trajet
     * 
     * @param int $id L'identifiant du trajet
     * @return void
     */
    public function edit($id)
    {
        $trajetModel = new \App\Models\Trajet();
        $trajet = $trajetModel->findById($id);
        
        // Vérifier que le trajet existe et appartient à l'utilisateur
        if (!$trajet || $trajet->utilisateur_id != $_SESSION['user_id']) {
            header('Location: /user');
            exit;
        }
        
        $agenceModel = new \App\Models\Agence();
        $agences = $agenceModel->getAll();
        
        require_once '../views/trajets/edit.php';
    }
    
    /**
     * Met à jour un trajet existant
     * 
     * @param int $id L'identifiant du trajet
     * @return void
     */
    public function update($id)
    {
        // Logique similaire à store() mais pour la mise à jour
        // ...
    }
    
    /**
     * Supprime un trajet
     * 
     * @param int $id L'identifiant du trajet
     * @return void
     */
    public function delete($id)
    {
        $trajetModel = new \App\Models\Trajet();
        $trajet = $trajetModel->findById($id);
        
        // Vérifier que le trajet existe et appartient à l'utilisateur
        if (!$trajet || $trajet->utilisateur_id != $_SESSION['user_id']) {
            header('Location: /user');
            exit;
        }
        
        if ($trajetModel->delete($id)) {
            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Le trajet a été supprimé avec succès.'
            ];
        } else {
            $_SESSION['flash'] = [
                'type' => 'danger',
                'message' => 'Une erreur est survenue lors de la suppression du trajet.'
            ];
        }
        
        header('Location: /user');
        exit;
    }
    
    /**
     * Affiche les détails d'un trajet
     * 
     * @param int $id L'identifiant du trajet
     * @return void
     */
    public function details($id)
    {
        $trajetModel = new \App\Models\Trajet();
        $trajet = $trajetModel->getTrajetDetails($id);
        
        if (!$trajet) {
            header('Location: /user');
            exit;
        }
        
        require_once '../views/trajets/details.php';
    }
}