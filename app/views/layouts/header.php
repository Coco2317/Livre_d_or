<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Livre d'or</title>
    <!-- CSS global -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="index.php?controller=commentaire&action=index">Livre d’or</a></li>

            <?php if (!isset($_SESSION['user_id'])): ?>
                <li><a href="index.php?controller=user&action=login">Connexion</a></li>
                <li><a href="index.php?controller=user&action=register">Inscription</a></li>
            <?php else: ?>
                <li><a href="index.php?controller=user&action=profil">Mon profil</a></li>
                <li><a href="index.php?controller=commentaire&action=create">Ajouter un commentaire</a></li>
                <li><a href="index.php?controller=user&action=logout">Déconnexion</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
<main>
