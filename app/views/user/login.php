<?php include __DIR__ . '/../layouts/header.php'; ?>
<link rel="stylesheet" href="assets/css/connexion.css">

<div class="auth-page">
    <div class="auth-image" style="background-image: url('assets/img/connexion.jpg');"></div>

    <div class="auth-form">
        <h1>Connexion</h1>

        <?php if ($errors): ?>
            <ul class="errors">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <form action="index.php?controller=user&action=login" method="post" novalidate>
            <label for="login">Login :</label>
            <input type="text" id="login" name="login" required value="<?= htmlspecialchars($login ?? '') ?>" />

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required />

            <button type="submit">Se connecter</button>
        </form>
        <br>
        <p>Pas encore inscrit ? <a href="index.php?controller=user&action=register">Inscrivez-vous ici</a>.</p>
        <a href="index.php" class="back-home-btn">← Retour à l'accueil</a>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
