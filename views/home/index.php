<?php 
$title = "Accueil";
ob_start(); 
?>

<h1 class="mb-4">Trajets proposés</h1>

<?php if (!isset($_SESSION['user_id'])): ?>
    <div class="alert alert-info">
        Pour obtenir plus d'informations sur un trajet, veuillez vous connecter
    </div>
<?php endif; ?>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Départ</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Destination</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Places</th>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <th>Actions</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($trajets)): ?>
                <tr>
                    <td colspan="<?= isset($_SESSION['user_id']) ? '8' : '7' ?>">Aucun trajet disponible pour le moment.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($trajets as $trajet): ?>
                    <tr>
                        <td><?= htmlspecialchars($trajet->agence_depart) ?></td>
                        <td><?= date('d/m/Y', strtotime($trajet->date_depart)) ?></td>
                        <td><?= date('H:i', strtotime($trajet->heure_depart)) ?></td>
                        <td><?= htmlspecialchars($trajet->agence_arrivee) ?></td>
                        <td><?= date('d/m/Y', strtotime($trajet->date_arrivee)) ?></td>
                        <td><?= date('H:i', strtotime($trajet->heure_arrivee)) ?></td>
                        <td><?= $trajet->places_disponibles ?></td>
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <td>
                                <a href="/user/trajet/details/<?= $trajet->id ?>" class="btn btn-sm btn-info" title="Détails">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <?php if ($_SESSION['user_id'] == $trajet->utilisateur_id): ?>
                                    <a href="/user/trajet/edit/<?= $trajet->id ?>" class="btn btn-sm btn-warning" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="/user/trajet/delete/<?= $trajet->id ?>" class="btn btn-sm btn-danger" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce trajet ?')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                <?php endif; ?>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php 
$content = ob_get_clean(); 
require_once '../views/layouts/default.php';
?>