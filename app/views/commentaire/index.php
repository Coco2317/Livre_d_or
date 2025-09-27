<?php include __DIR__ . '/../layouts/header.php'; ?>
<link rel="stylesheet" href="assets/css/livre-or.css">

<section class="hero-livre-or"></section>

<div class="container">
    <h1>Livre d’or</h1>

    <?php if (isset($_SESSION['user_id'])): ?>
        <p><a href="index.php?controller=commentaire&action=create" class="btn">Ajouter un commentaire</a></p>
    <?php else: ?>
        <p><a href="index.php?controller=user&action=login">Connectez-vous</a> pour laisser un commentaire.</p>
    <?php endif; ?>

    <?php if (!empty($comments)): ?>
        <?php foreach ($comments as $comment): ?>
            <div class="commentaire">
                <div class="meta">
                    Posté le <?= htmlspecialchars(date('d/m/Y', strtotime($comment['date']))) ?>
                    par <?= htmlspecialchars($comment['login']) ?>
                </div>
                <p><?= nl2br(htmlspecialchars($comment['commentaire'])) ?></p>
            </div>
        <?php endforeach; ?>

        <?php
        // Pagination spécifique à la page Livre d'or
        $controller = "commentaire";
        $action = "index";
        include __DIR__ . '/../partials/pagination.php';
        ?>

    <?php else: ?>
        <p>Aucun commentaire pour le moment.</p>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
