<?php include __DIR__ . '/../layouts/header.php'; ?>
<link rel="stylesheet" href="assets/css/inscription.css">

<div class="auth-page">
    <div class="auth-image" style="background-image: url('assets/img/inscription.jpg');"></div>

    <div class="auth-form">
        <h1>Inscription</h1>

        <?php if ($errors): ?>
            <ul class="errors">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <form action="index.php?controller=user&action=register" method="post" novalidate>
            <label for="login">Login :</label>
            <input type="text" id="login" name="login" required value="<?= htmlspecialchars($login ?? '') ?>" />

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required />

            <label for="password_confirm">Confirmer mot de passe :</label>
            <input type="password" id="password_confirm" name="password_confirm" required />

            <button type="submit">S'inscrire</button>
        </form>
        <br>
        <p>Déjà inscrit ? <a href="index.php?controller=user&action=login">Connectez-vous ici</a>.</p>
        <a href="index.php" class="back-home-btn">← Retour à l'accueil</a>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
