<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #00497c;">
    <div class="container">
        <a class="navbar-brand" href="?route=home">Touche pas au klaxon</a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link btn btn-dark" href="?route=login">Connexion</a>
                    </li>
                <?php elseif (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="?route=admin_users">Utilisateurs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?route=admin_agences">Agences</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?route=admin_trajets">Trajets</a>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link">Bonjour <?= htmlspecialchars($_SESSION['user_name']) ?></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-dark" href="?route=logout">Déconnexion</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link btn btn-success" href="?route=user_trajet_create">Créer un trajet</a>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link">Bonjour <?= htmlspecialchars($_SESSION['user_name']) ?></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-dark" href="?route=logout">Déconnexion</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>