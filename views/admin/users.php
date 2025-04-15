<?php 
$title = "Gestion des utilisateurs";
ob_start(); 
?>

<h1 class="mb-4">Gestion des utilisateurs</h1>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Rôle</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($users)): ?>
                        <tr>
                            <td colspan="6">Aucun utilisateur trouvé.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= $user->id ?></td>
                                <td><?= htmlspecialchars($user->nom) ?></td>
                                <td><?= htmlspecialchars($user->prenom) ?></td>
                                <td><?= htmlspecialchars($user->email) ?></td>
                                <td><?= htmlspecialchars($user->telephone) ?></td>
                                <td>
                                    <span class="badge <?= $user->role === 'admin' ? 'bg-danger' : 'bg-primary' ?>">
                                        <?= $user->role === 'admin' ? 'Administrateur' : 'Utilisateur' ?>
                                    </span>
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