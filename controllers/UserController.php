<?php
/**
 * Contrôleur utilisateur
 * 
 * @package Touche Pas Au Klaxon
 */

namespace Controllers;

class UserController
{
    /**
     * Affiche le tableau de bord utilisateur
     * 
     * @return void
     */
    public function dashboard()
    {
        // Récupérer les trajets de l'utilisateur
        $trajetModel = new \Models\Trajet();
        $mesTrajets = $trajetModel->getUserTrajets($_SESSION['user_id'] ?? 0);
        
        // Récupérer les trajets disponibles
        $trajetsDisponibles = $trajetModel->getAvailableTrajets();
        
        // Charger la vue
        require_once '../views/users/dashboard.php';
    }
}