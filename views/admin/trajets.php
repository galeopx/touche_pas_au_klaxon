<?php 
$title = "Gestion des trajets";
ob_start(); 
?>

<h1 class="mb-4">Gestion des trajets</h1>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Départ</th>
                        <th>Date/Heure</th>
                        <th>Arrivée</th>
                        <th>Date/Heure</th>
                        <th>Places</th>
                        <th>Utilisateur</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($trajets)): ?>
                        <tr>
                            <td colspan="8">Aucun trajet trouvé.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($trajets as $trajet): ?>
                            <tr>
                                <td><?= $trajet->id ?></td>
                                <td><?= htmlspecialchars($trajet->agence_depart) ?></td>
                                <td>
                                    <?= date('d/m/Y', strtotime($trajet->date_depart)) ?> 
                                    <?= date('H:i', strtotime($trajet->heure_depart)) ?>
                                </td>
                                <td><?= htmlspecialchars($trajet->agence_arrivee) ?></td>
                                <td>
                                    <?= date('d/m/Y', strtotime($trajet->date_arrivee)) ?> 
                                    <?= date('H:i', strtotime($trajet->heure_arrivee)) ?>
                                </td>
                                <td>
                                    <?= $trajet->places_disponibles ?> / <?= $trajet->places_total ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($trajet->utilisateur_prenom . ' ' . $trajet->utilisateur_nom) ?>
                                </td>
                                <td>
                                    <a href="/admin/trajet/delete/<?= $trajet->id ?>" class="btn btn-sm btn-danger" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce trajet ?')">
                                        <i class="bi bi-trash"></i> Supprimer
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean(); 
require_once '../views/layouts/default.php';
?>