<?php
include 'includes/header.php';
require 'includes/config.php';

// Récupérer tous les commentaires avec le login de l’utilisateur
$stmt = $pdo->query("
    SELECT commentaires.commentaire, commentaires.date, utilisateurs.login
    FROM commentaires
    JOIN utilisateurs ON commentaires.id_utilisateur = utilisateurs.id
    ORDER BY commentaires.date DESC
");
$comments = $stmt->fetchAll();
?>

<!-- HERO Section -->
<section class="hero-livre-or">
    <div class="hero-overlay"></div>
</section>

<div class="container">
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="commentaire.php" class="btn">Ajouter un commentaire</a>
    <?php else: ?>
        <a href="connexion.php" class="btn">Connectez-vous pour ajouter un commentaire</a>
    <?php endif; ?>

    <?php if ($comments): ?>
        <?php foreach ($comments as $comment): ?>
            <article class="commentaire">
                <p class="meta">
                    Posté le <?= htmlspecialchars(date('d/m/Y', strtotime($comment['date']))) ?> 
                    par <?= htmlspecialchars($comment['login']) ?>
                </p>
                <p><?= nl2br(htmlspecialchars($comment['commentaire'])) ?></p>
            </article>
            <hr />
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun commentaire pour le moment.</p>
    <?php endif; ?>

    <a href="index.php" class="btn">Retour à l’accueil</a>
</div>

<?php include 'includes/footer.php'; ?>
