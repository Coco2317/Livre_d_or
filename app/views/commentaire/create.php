<?php include __DIR__ . '/../layouts/header.php'; ?>
<link rel="stylesheet" href="assets/css/commentaire.css">

<section class="hero-commentaire"></section>

<div class="container">
    <h2>Ajouter un commentaire</h2>

    <?php if (!empty($errors)): ?>
        <ul class="errors">
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form action="index.php?controller=commentaire&action=create" method="POST">
        <label for="commentaire">Votre commentaire :</label><br>
        <textarea name="commentaire" id="commentaire" rows="4" required></textarea><br><br>

        <button type="submit">Publier</button>
    </form>

    <p><a href="index.php">← Retour à l’accueil</a></p>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
