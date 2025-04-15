<?php
/**
 * Contrôleur d'authentification
 * 
 * @package Touche Pas Au Klaxon
 */

namespace App\Controllers;

class AuthController
{
    /**
     * Affiche le formulaire de connexion
     * 
     * @return void
     */
    public function showLoginForm()
    {
        require_once '../views/auth/login.php';
    }
    
    /**
     * Traite la tentative de connexion
     * 
     * @return void
     */
    public function login()
    {
        // Vérifier si le formulaire a été soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];
            
            $userModel = new \App\Models\User();
            $user = $userModel->findByEmail($email);
            
            if ($user && password_verify($password, $user->password)) {
                // Connexion réussie
                $_SESSION['user_id'] = $user->id;
                $_SESSION['user_name'] = $user->prenom . ' ' . $user->nom;
                $_SESSION['user_role'] = $user->role;
                
                // Rediriger selon le rôle
                if ($user->role === 'admin') {
                    header('Location: /admin');
                } else {
                    header('Location: /user');
                }
                exit;
            } else {
                // Échec de la connexion
                $error = 'Email ou mot de passe incorrect';
                require_once '../views/auth/login.php';
            }
        }
    }
    
    /**
     * Déconnecte l'utilisateur
     * 
     * @return void
     */
    public function logout()
    {
        // Détruire la session
        session_start();
        session_unset();
        session_destroy();
        
        // Rediriger vers la page d'accueil
        header('Location: /');
        exit;
    }
    
    /**
     * Vérifie si l'utilisateur est connecté
     * 
     * @return bool
     */
    public function checkUserAuth()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
            return false;
        }
        return true;
    }
    
    /**
     * Vérifie si l'utilisateur est un administrateur
     * 
     * @return bool
     */
    public function checkAdminAuth()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: /login');
            exit;
            return false;
        }
        return true;
    }
}