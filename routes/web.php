<?php
/**
 * Configuration des routes de l'application
 * 
 * @package Touche Pas Au Klaxon
 */

use Buki\Router\Router;

$router = new Router([
    'paths' => [
        'controllers' => '../controllers',
    ],
    'namespaces' => [
        'controllers' => 'Controllers',
    ]
]);

// Routes publiques
$router->get('/', 'HomeController@index');
$router->get('/login', 'AuthController@showLoginForm');
$router->post('/login', 'AuthController@login');

// Routes utilisateur
$router->group('/user', function($router) {
    $router->get('/', 'UserController@dashboard');
    $router->get('/logout', 'AuthController@logout');
    
    // Gestion des trajets
    $router->get('/trajet/create', 'TrajetController@create');
    $router->post('/trajet/store', 'TrajetController@store');
    $router->get('/trajet/edit/:id', 'TrajetController@edit');
    $router->post('/trajet/update/:id', 'TrajetController@update');
    $router->get('/trajet/delete/:id', 'TrajetController@delete');
    $router->get('/trajet/details/:id', 'TrajetController@details');
}, ['before' => 'AuthController@checkUserAuth']);

// Routes admin
$router->group('/admin', function($router) {
    $router->get('/', 'AdminController@dashboard');
    
    // Gestion des utilisateurs
    $router->get('/users', 'AdminController@users');
    
    // Gestion des agences
    $router->get('/agences', 'AdminController@agences');
    $router->get('/agence/create', 'AdminController@createAgence');
    $router->post('/agence/store', 'AdminController@storeAgence');
    $router->get('/agence/edit/:id', 'AdminController@editAgence');
    $router->post('/agence/update/:id', 'AdminController@updateAgence');
    $router->get('/agence/delete/:id', 'AdminController@deleteAgence');
    
    // Gestion des trajets
    $router->get('/trajets', 'AdminController@trajets');
    $router->get('/trajet/delete/:id', 'AdminController@deleteTrajet');
}, ['before' => 'AuthController@checkAdminAuth']);

$router->run();