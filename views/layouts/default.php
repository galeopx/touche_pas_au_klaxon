<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title . ' - ' : '' ?>Touche Pas Au Klaxon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= URL_ROOT ?>/assets/css/style.css" rel="stylesheet">
</head>
<body>
    <header class="mb-4">
        <?php include APP_ROOT . '/views/layouts/header.php'; ?>
    </header>

    <main class="container mb-4">
        <?php 
        // Afficher les messages flash
        require_once APP_ROOT . '/utils/Flash.php';
        \App\Utils\Flash::display();
        
        // Contenu principal
        echo $content ?? 'Aucun contenu à afficher';
        ?>
    </main>

    <footer class="mt-auto py-3">
        <?php include APP_ROOT . '/views/layouts/footer.php'; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= URL_ROOT ?>/assets/js/script.js"></script>
</body>
</html>