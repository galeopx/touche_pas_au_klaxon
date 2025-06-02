<?php 
$title = "Tableau de bord administrateur";
ob_start(); 
?>

<h1 class="mb-4">Tableau de bord administrateur</h1>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title mb-0">Utilisateurs</h3>
            </div>
            <div class="card-body">
                <p>Gérer les utilisateurs de l'application.</p>
                <a href="?route=admin_users" class="btn btn-primary">Voir les utilisateurs</a>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-header bg-secondary text-white">
                <h3 class="card-title mb-0">Agences</h3>
            </div>
            <div class="card-body">
                <p>Gérer les agences (villes) disponibles.</p>
                <a href="?route=admin_agences" class="btn btn-secondary">Voir les agences</a>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-header" style="background-color: #384050; color: white;">
                <h3 class="card-title mb-0">Trajets</h3>
            </div>
            <div class="card-body">
                <p>Gérer tous les trajets de l'application.</p>
                <a href="?route=admin_trajets" class="btn btn-dark">Voir les trajets</a>
            </div>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean(); 
require_once '../views/layouts/default.php';
?>