<?php 
$title = "Mes trajets";
ob_start(); 
?>

<h1 class="mb-4">Mes trajets</h1>

<div class="mb-3">
    <a href="/user/trajet/create" class="btn btn-success">
        <i class="bi bi-plus-lg"></i> Proposer un nouveau trajet
    </a>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title mb-0">Mes trajets proposés</h3>
            </div>
            <div class="card-body">
                <?php if (empty($mesTrajets)): ?>
                    <p>Vous n'avez proposé aucun trajet pour le moment.</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Départ</th>
                                    <th>Arrivée</th>
                                    <th>Date</th>
                                    <th>Places</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($mesTrajets as $trajet): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($trajet->agence_depart) ?></td>
                                        <td><?= htmlspecialchars($trajet->agence_arrivee) ?></td>
                                        <td><?= date('d/m/Y H:i', strtotime($trajet->date_depart . ' ' . $trajet->heure_depart)) ?></td>
                                        <td><?= $trajet->places_disponibles ?> / <?= $trajet->places_total ?></td>
                                        <td>
                                            <a href="/user/trajet/edit/<?= $trajet->id ?>" class="btn btn-sm btn-warning" title="Modifier">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="/user/trajet/delete/<?= $trajet->id ?>" class="btn btn-sm btn-danger" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce trajet ?')">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-secondary text-white">
                <h3 class="card-title mb-0">Trajets disponibles</h3>
            </div>
            <div class="card-body">
                <?php if (empty($trajetsDisponibles)): ?>
                    <p>Aucun trajet disponible pour le moment.</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Départ</th>
                                    <th>Arrivée</th>
                                    <th>Date</th>
                                    <th>Places</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($trajetsDisponibles as $trajet): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($trajet->agence_depart) ?></td>
                                        <td><?= htmlspecialchars($trajet->agence_arrivee) ?></td>
                                        <td><?= date('d/m/Y H:i', strtotime($trajet->date_depart . ' ' . $trajet->heure_depart)) ?></td>
                                        <td><?= $trajet->places_disponibles ?></td>
                                        <td>
                                            <a href="/user/trajet/details/<?= $trajet->id ?>" class="btn btn-sm btn-info" title="Détails">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean(); 
require_once '../views/layouts/default.php';
?>