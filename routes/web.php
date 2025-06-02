<?php
/**
 * Configuration des routes de l'application (version paramètres GET)
 * 
 * @package Touche Pas Au Klaxon
 */

// Récupérer la route depuis les paramètres GET
$route = $_GET['route'] ?? '/';

// Vérifier l'authentification pour certaines routes
$authController = new \Controllers\AuthController();

// Router simple avec switch
switch ($route) {
    case '/':
    case 'home':
        $controller = new \Controllers\HomeController();
        $controller->index();
        break;
        
    case 'login':
        $controller = new \Controllers\AuthController();
        $controller->showLoginForm();
        break;
        
    case 'login_post':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new \Controllers\AuthController();
            $controller->login();
        } else {
            header('Location: ?route=login');
            exit;
        }
        break;
        
    case 'logout':
        $controller = new \Controllers\AuthController();
        $controller->logout();
        break;
        
    // Routes utilisateur (nécessitent authentification)
    case 'user':
        if ($authController->checkUserAuth()) {
            $controller = new \Controllers\UserController();
            $controller->dashboard();
        }
        break;
        
    case 'user_trajet_create':
        if ($authController->checkUserAuth()) {
            $controller = new \Controllers\TrajetController();
            $controller->create();
        }
        break;
        
    case 'user_trajet_store':
        if ($authController->checkUserAuth() && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new \Controllers\TrajetController();
            $controller->store();
        }
        break;
        
    case 'user_trajet_edit':
        if ($authController->checkUserAuth() && isset($_GET['id'])) {
            $controller = new \Controllers\TrajetController();
            $controller->edit($_GET['id']);
        }
        break;
        
    case 'user_trajet_update':
        if ($authController->checkUserAuth() && isset($_GET['id']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new \Controllers\TrajetController();
            $controller->update($_GET['id']);
        }
        break;
        
    case 'user_trajet_delete':
        if ($authController->checkUserAuth() && isset($_GET['id'])) {
            $controller = new \Controllers\TrajetController();
            $controller->delete($_GET['id']);
        }
        break;
        
    case 'user_trajet_details':
        if ($authController->checkUserAuth() && isset($_GET['id'])) {
            $controller = new \Controllers\TrajetController();
            $controller->details($_GET['id']);
        }
        break;
        
    // Routes admin (nécessitent authentification admin)
    case 'admin':
        if ($authController->checkAdminAuth()) {
            $controller = new \Controllers\AdminController();
            $controller->dashboard();
        }
        break;
        
    case 'admin_users':
        if ($authController->checkAdminAuth()) {
            $controller = new \Controllers\AdminController();
            $controller->users();
        }
        break;
        
    case 'admin_agences':
        if ($authController->checkAdminAuth()) {
            $controller = new \Controllers\AdminController();
            $controller->agences();
        }
        break;
        
    case 'admin_agence_create':
        if ($authController->checkAdminAuth()) {
            $controller = new \Controllers\AdminController();
            $controller->createAgence();
        }
        break;
        
    case 'admin_agence_store':
        if ($authController->checkAdminAuth() && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new \Controllers\AdminController();
            $controller->storeAgence();
        }
        break;
        
    case 'admin_agence_edit':
        if ($authController->checkAdminAuth() && isset($_GET['id'])) {
            $controller = new \Controllers\AdminController();
            $controller->editAgence($_GET['id']);
        }
        break;
        
    case 'admin_agence_update':
        if ($authController->checkAdminAuth() && isset($_GET['id']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new \Controllers\AdminController();
            $controller->updateAgence($_GET['id']);
        }
        break;
        
    case 'admin_agence_delete':
        if ($authController->checkAdminAuth() && isset($_GET['id'])) {
            $controller = new \Controllers\AdminController();
            $controller->deleteAgence($_GET['id']);
        }
        break;
        
    case 'admin_trajets':
        if ($authController->checkAdminAuth()) {
            $controller = new \Controllers\AdminController();
            $controller->trajets();
        }
        break;
        
    case 'admin_trajet_delete':
        if ($authController->checkAdminAuth() && isset($_GET['id'])) {
            $controller = new \Controllers\AdminController();
            $controller->deleteTrajet($_GET['id']);
        }
        break;
        
    default:
        echo "<h1>Page non trouvée</h1>";
        echo "<p>La route '$route' n'existe pas.</p>";
        echo "<a href='?route=home'>Retour à l'accueil</a>";
        break;
}
?>