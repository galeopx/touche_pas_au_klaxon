<?php 
$title = "Détails du trajet";
ob_start(); 
?>

<h1 class="mb-4">Détails du trajet</h1>

<div class="card">
    <div class="card-header bg-secondary text-white">
        <h3 class="mb-0">Trajet de <?= htmlspecialchars($trajet->agence_depart) ?> à <?= htmlspecialchars($trajet->agence_arrivee) ?></h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h4>Informations sur le trajet</h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item"><strong>Départ:</strong> <?= htmlspecialchars($trajet->agence_depart) ?></li>
                    <li class="list-group-item"><strong>Date de départ:</strong> <?= date('d/m/Y', strtotime($trajet->date_depart)) ?></li>
                    <li class="list-group-item"><strong>Heure de départ:</strong> <?= date('H:i', strtotime($trajet->heure_depart)) ?></li>
                    <li class="list-group-item"><strong>Arrivée:</strong> <?= htmlspecialchars($trajet->agence_arrivee) ?></li>
                    <li class="list-group-item"><strong>Date d'arrivée:</strong> <?= date('d/m/Y', strtotime($trajet->date_arrivee)) ?></li>
                    <li class="list-group-item"><strong>Heure d'arrivée:</strong> <?= date('H:i', strtotime($trajet->heure_arrivee)) ?></li>
                    <li class="list-group-item"><strong>Places disponibles:</strong> <?= $trajet->places_disponibles ?> / <?= $trajet->places_total ?></li>
                </ul>
            </div>
            <div class="col-md-6">
                <h4>Contact</h4>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Nom:</strong> <?= htmlspecialchars($trajet->utilisateur_prenom . ' ' . $trajet->utilisateur_nom) ?></li>
                    <li class="list-group-item"><strong>Téléphone:</strong> <?= htmlspecialchars($trajet->telephone) ?></li>
                    <li class="list-group-item"><strong>Email:</strong> <?= htmlspecialchars($trajet->email) ?></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="/user" class="btn btn-secondary">Retour à la liste</a>
        <?php if ($_SESSION['user_id'] == $trajet->utilisateur_id): ?>
            <a href="/user/trajet/edit/<?= $trajet->id ?>" class="btn btn-warning">Modifier</a>
            <a href="/user/trajet/delete/<?= $trajet->id ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce trajet ?')">Supprimer</a>
        <?php endif; ?>
    </div>
</div>

<?php 
$content = ob_get_clean(); 
require_once '../views/layouts/default.php';
?>