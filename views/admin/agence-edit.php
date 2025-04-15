<?php 
$title = "Modifier une agence";
ob_start(); 
?>

<h1 class="mb-4">Modifier une agence</h1>

<?php if (isset($error)): ?>
    <div class="alert alert-danger">
        <?= $error ?>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-body">
        <form method="POST" action="/admin/agence/update/<?= $agence->id ?>">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom de l'agence</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?= htmlspecialchars($agence->nom) ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="/admin/agences" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</div>

<?php 
$content = ob_get_clean(); 
require_once '../views/layouts/default.php';
?>