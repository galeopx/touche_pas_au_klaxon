<?php 
$title = "Créer un trajet";
ob_start(); 
?>

<h1 class="mb-4">Créer un nouveau trajet</h1>

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
        <form method="POST" action="/user/trajet/store">
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="agence_depart">Agence de départ</label>
                        <select class="form-control" id="agence_depart" name="agence_depart" required>
                            <option value="">Sélectionner une agence</option>
                            <?php foreach ($agences as $agence): ?>
                                <option value="<?= $agence->id ?>"><?= htmlspecialchars($agence->nom) ?></option>
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
                                <option value="<?= $agence->id ?>"><?= htmlspecialchars($agence->nom) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="date_depart">Date de départ</label>
                        <input type="date" class="form-control" id="date_depart" name="date_depart" required min="<?= date('Y-m-d') ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="heure_depart">Heure de départ</label>
                        <input type="time" class="form-control" id="heure_depart" name="heure_depart" required>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="date_arrivee">Date d'arrivée</label>
                        <input type="date" class="form-control" id="date_arrivee" name="date_arrivee" required min="<?= date('Y-m-d') ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="heure_arrivee">Heure d'arrivée</label>
                        <input type="time" class="form-control" id="heure_arrivee" name="heure_arrivee" required>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="places_total">Nombre total de places</label>
                        <input type="number" class="form-control" id="places_total" name="places_total" min="1" max="10" value="4" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <fieldset disabled>
                        <div class="form-group">
                            <label for="contact">Contact</label>
                            <input type="text" class="form-control" id="contact" value="<?= htmlspecialchars($user->prenom . ' ' . $user->nom) ?>" disabled>
                        </div>
                    </fieldset>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Créer le trajet</button>
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
    
    form.addEventListener('submit', function(e) {
        // Vérifier que les agences soient différentes
        if (agenceDepart.value === agenceArrivee.value) {
            e.preventDefault();
            alert("L'agence de départ et d'arrivée doivent être différentes.");
            return;
        }
        
        // Vérifier que la date et l'heure d'arrivée est postérieure à la date/heure de départ
        const departDateTime = new Date(dateDepart.value + 'T' + heureDepart.value);
        const arriveeDateTime = new Date(dateArrivee.value + 'T' + heureArrivee.value);
        
        if (arriveeDateTime <= departDateTime) {
            e.preventDefault();
            alert("La date et l'heure d'arrivée doivent être postérieures à la date et l'heure de départ.");
            return;
        }
    });
});
</script>

<?php 
$content = ob_get_clean(); 
require_once '../views/layouts/default.php';
?>