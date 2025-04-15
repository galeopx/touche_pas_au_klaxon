<?php
/**
 * Contrôleur d'administration
 * 
 * @package Touche Pas Au Klaxon
 */

namespace App\Controllers;

class AdminController
{
    /**
     * Affiche le tableau de bord administrateur
     * 
     * @return void
     */
    public function dashboard()
    {
        require_once '../views/admin/dashboard.php';
    }
    
    /**
     * Affiche la liste des utilisateurs
     * 
     * @return void
     */
    public function users()
    {
        $userModel = new \App\Models\User();
        $users = $userModel->getAll();
        
        require_once '../views/admin/users.php';
    }
    
    /**
     * Affiche la liste des agences
     * 
     * @return void
     */
    public function agences()
    {
        $agenceModel = new \App\Models\Agence();
        $agences = $agenceModel->getAll();
        
        require_once '../views/admin/agences.php';
    }
    
    /**
     * Affiche le formulaire de création d'une agence
     * 
     * @return void
     */
    public function createAgence()
    {
        require_once '../views/admin/agence-create.php';
    }
    
    /**
     * Enregistre une nouvelle agence
     * 
     * @return void
     */
    public function storeAgence()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
            
            if (!empty($nom)) {
                $agenceModel = new \App\Models\Agence();
                
                if ($agenceModel->create(['nom' => $nom])) {
                    $_SESSION['flash'] = [
                        'type' => 'success',
                        'message' => 'L\'agence a été créée avec succès.'
                    ];
                    
                    header('Location: /admin/agences');
                    exit;
                } else {
                    $error = "Une erreur est survenue lors de la création de l'agence.";
                }
            } else {
                $error = "Le nom de l'agence est requis.";
            }
            
            require_once '../views/admin/agence-create.php';
        }
    }
    
    /**
     * Affiche le formulaire d'édition d'une agence
     * 
     * @param int $id L'identifiant de l'agence
     * @return void
     */
    public function editAgence($id)
    {
        $agenceModel = new \App\Models\Agence();
        $agence = $agenceModel->findById($id);
        
        if (!$agence) {
            header('Location: /admin/agences');
            exit;
        }
        
        require_once '../views/admin/agence-edit.php';
    }
    
    /**
     * Met à jour une agence existante
     * 
     * @param int $id L'identifiant de l'agence
     * @return void
     */
    public function updateAgence($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
            
            if (!empty($nom)) {
                $agenceModel = new \App\Models\Agence();
                
                if ($agenceModel->update($id, ['nom' => $nom])) {
                    $_SESSION['flash'] = [
                        'type' => 'success',
                        'message' => 'L\'agence a été mise à jour avec succès.'
                    ];
                    
                    header('Location: /admin/agences');
                    exit;
                } else {
                    $error = "Une erreur est survenue lors de la mise à jour de l'agence.";
                }
            } else {
                $error = "Le nom de l'agence est requis.";
            }
            
            $agence = (object)['id' => $id, 'nom' => $nom];
            require_once '../views/admin/agence-edit.php';
        }
    }
    
    /**
     * Supprime une agence
     * 
     * @param int $id L'identifiant de l'agence
     * @return void
     */
    public function deleteAgence($id)
    {
        $agenceModel = new \App\Models\Agence();
        
        if ($agenceModel->delete($id)) {
            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'L\'agence a été supprimée avec succès.'
            ];
        } else {
            $_SESSION['flash'] = [
                'type' => 'danger',
                'message' => 'Une erreur est survenue lors de la suppression de l\'agence.'
            ];
        }
        
        header('Location: /admin/agences');
        exit;
    }
    
    /**
     * Affiche la liste des trajets
     * 
     * @return void
     */
    public function trajets()
    {
        $trajetModel = new \App\Models\Trajet();
        $trajets = $trajetModel->getAllWithDetails();
        
        require_once '../views/admin/trajets.php';
    }
    
    /**
     * Supprime un trajet
     * 
     * @param int $id L'identifiant du trajet
     * @return void
     */
    public function deleteTrajet($id)
    {
        $trajetModel = new \App\Models\Trajet();
        
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
        
        header('Location: /admin/trajets');
        exit;
    }
}