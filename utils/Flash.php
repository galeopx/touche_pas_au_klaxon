<?php
/**
 * Classe utilitaire pour gérer les messages flash
 * 
 * @package Touche Pas Au Klaxon
 */

namespace Utils;

class Flash
{
    /**
     * Affiche le message flash s'il existe puis le supprime
     * 
     * @return void
     */
    public static function display()
    {
        if (isset($_SESSION['flash'])) {
            echo '<div class="alert alert-' . $_SESSION['flash']['type'] . ' alert-dismissible fade show" role="alert">';
            echo $_SESSION['flash']['message'];
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '</div>';
            
            unset($_SESSION['flash']);
        }
    }
}