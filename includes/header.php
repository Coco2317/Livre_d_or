<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>
    <?php
    $page = basename($_SERVER['PHP_SELF'], ".php");
    echo ucfirst($page);
    ?>
  </title>

  <!-- CSS global -->
  <link rel="stylesheet" href="style.css" />

  <!-- CSS spécifique aux pages -->
  <?php if ($page === 'inscription'): ?>
    <link rel="stylesheet" href="inscription.css" />
  <?php elseif ($page === 'connexion'): ?>
    <link rel="stylesheet" href="connexion.css" />
  <?php elseif ($page === 'livre-or'): ?>
    <link rel="stylesheet" href="livre-or.css" />
  <?php elseif ($page === 'commentaire'): ?>
    <link rel="stylesheet" href="commentaire.css" />
  <?php elseif ($page === 'profil'): ?>
    <link rel="stylesheet" href="profil.css" />
  <?php endif; ?>
</head>
<body>
  <header class="site-header">
    <nav class="main-nav">
      <ul class="navbar">
        <li><a href="index.php">Accueil</a></li>

        <?php if (isset($_SESSION['user_id'])): ?>
          <li><a href="profil.php">Profil</a></li>
          <li><a href="commentaire.php">Ajouter un commentaire</a></li>
          <li><a href="logout.php">Déconnexion</a></li>
        <?php else: ?>
          <li><a href="inscription.php">Inscription</a></li>
          <li><a href="connexion.php">Connexion</a></li>
        <?php endif; ?>
        
        <li><a href="livre-or.php">Forum</a></li>
      </ul>
    </nav>
  </header>
