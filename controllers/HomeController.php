<?php
/**
 * Contrôleur de la page d'accueil
 * 
 * @package Touche Pas Au Klaxon
 */

namespace Controllers;

class HomeController
{
    /**
     * Affiche la page d'accueil
     * 
     * @return void
     */
    public function index()
    {
        // Récupérer les trajets disponibles à venir, triés par date
        $trajetModel = new \Models\Trajet();
        $trajets = $trajetModel->getAvailableTrajets();
        
        // Charger la vue
        require_once '../views/home/index.php';
    }
}