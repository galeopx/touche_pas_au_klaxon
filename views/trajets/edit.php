<?php 
$title = "Modifier un trajet";
ob_start(); 
?>

<h1 class="mb-4">Modifier un trajet</h1>

<?php if (isset($errors) && !empty($errors)): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($errors as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-body">
        <form method="POST" action="/user/trajet/update/<?= $trajet->id ?>">
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="agence_depart">Agence de départ</label>
                        <select class="form-control" id="agence_depart" name="agence_depart" required>
                            <option value="">Sélectionner une agence</option>
                            <?php foreach ($agences as $agence): ?>
                                <option value="<?= $agence->id ?>" <?= $trajet->agence_depart_id == $agence->id ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($agence->nom) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="agence_arrivee">Agence d'arrivée</label>
                        <select class="form-control" id="agence_arrivee" name="agence_arrivee" required>
                            <option value="">Sélectionner une agence</option>
                            <?php foreach ($agences as $agence): ?>
                                <option value="<?= $agence->id ?>" <?= $trajet->agence_arrivee_id == $agence->id ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($agence->nom) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="date_depart">Date de départ</label>
                        <input type="date" class="form-control" id="date_depart" name="date_depart" required value="<?= $trajet->date_depart ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="heure_depart">Heure de départ</label>
                        <input type="time" class="form-control" id="heure_depart" name="heure_depart" required value="<?= $trajet->heure_depart ?>">
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="date_arrivee">Date d'arrivée</label>
                        <input type="date" class="form-control" id="date_arrivee" name="date_arrivee" required value="<?= $trajet->date_arrivee ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="heure_arrivee">Heure d'arrivée</label>
                        <input type="time" class="form-control" id="heure_arrivee" name="heure_arrivee" required value="<?= $trajet->heure_arrivee ?>">
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="places_total">Nombre total de places</label>
                        <input type="number" class="form-control" id="places_total" name="places_total" min="<?= max($trajet->places_total - $trajet->places_disponibles, 1) ?>" max="10" value="<?= $trajet->places_total ?>" required>
                        <div class="form-text">Note: Le nombre total ne peut pas être inférieur au nombre de places déjà réservées.</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="places_disponibles">Places disponibles</label>
                        <input type="number" class="form-control" id="places_disponibles" name="places_disponibles" min="0" max="<?= $trajet->places_total ?>" value="<?= $trajet->places_disponibles ?>" required>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="/user" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</div>

<script>
// JavaScript pour la validation côté client
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const agenceDepart = document.getElementById('agence_depart');
    const agenceArrivee = document.getElementById('agence_arrivee');
    const dateDepart = document.getElementById('date_depart');
    const heureDepart = document.getElementById('heure_depart');
    const dateArrivee = document.getElementById('date_arrivee');
    const heureArrivee = document.getElementById('heure_arrivee');
    const placesTotal = document.getElementById('places_total');
    const placesDisponibles = document.getElementById('places_disponibles');
    
    // Mettre à jour le max des places disponibles quand le total change
    placesTotal.addEventListener('change', function() {
        placesDisponibles.max = this.value;
        if (parseInt(placesDisponibles.value) > parseInt(this.value)) {
            placesDisponibles.value = this.value;
        }
    });
    
    form.addEventListener('submit', function(e) {
        // Vérifier que les agences sont différentes
        if (agenceDepart.value === agenceArrivee.value) {
            e.preventDefault();
            alert("L'agence de départ et d'arrivée doivent être différentes.");
            return;
        }
        
        // Vérifier que la date/heure d'arrivée est postérieure à la date/heure de départ
        const departDateTime = new Date(dateDepart.value + 'T' + heureDepart.value);
        const arriveeDateTime = new Date(dateArrivee.value + 'T' + heureArrivee.value);
        
        if (arriveeDateTime <= departDateTime) {
            e.preventDefault();
            alert("La date et l'heure d'arrivée doivent être postérieures à la date et l'heure de départ.");
            return;
        }
        
        // Vérifier que les places disponibles ne dépassent pas le total
        if (parseInt(placesDisponibles.value) > parseInt(placesTotal.value)) {
            e.preventDefault();
            alert("Le nombre de places disponibles ne peut pas dépasser le nombre total de places.");
            return;
        }
    });
});
</script>

<?php 
$content = ob_get_clean(); 
require_once '../views/layouts/default.php';
?>