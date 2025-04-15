<?php 
$title = "Gestion des agences";
ob_start(); 
?>

<h1 class="mb-4">Gestion des agences</h1>

<div class="mb-3">
    <a href="/admin/agence/create" class="btn btn-success">
        <i class="bi bi-plus-lg"></i> Ajouter une agence
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($agences)): ?>
                        <tr>
                            <td colspan="3">Aucune agence trouvée.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($agences as $agence): ?>
                            <tr>
                                <td><?= $agence->id ?></td>
                                <td><?= htmlspecialchars($agence->nom) ?></td>
                                <td>
                                    <a href="/admin/agence/edit/<?= $agence->id ?>" class="btn btn-sm btn-warning" title="Modifier">
                                        <i class="bi bi-pencil"></i> Modifier
                                    </a>
                                    <a href="/admin/agence/delete/<?= $agence->id ?>" class="btn btn-sm btn-danger" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette agence ?')">
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