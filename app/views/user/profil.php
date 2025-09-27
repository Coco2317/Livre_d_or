<?php include __DIR__ . '/../layouts/header.php'; ?>
<link rel="stylesheet" href="assets/css/profil.css">

<section class="hero-profil"></section>

<div class="container">
    <h1>Modifier votre profil</h1>

    <?php if ($errors): ?>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <?php if ($success): ?>
        <p class="success"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <form action="index.php?controller=user&action=profil" method="post" novalidate>
        <label for="login">Login :</label>
        <input type="text" id="login" name="login" required value="<?= htmlspecialchars($new_login) ?>">

        <label for="password">Nouveau mot de passe (optionnel) :</label>
        <input type="password" id="password" name="password">

        <label for="password_confirm">Confirmer nouveau mot de passe :</label>
        <input type="password" id="password_confirm" name="password_confirm">

        <button type="submit">Mettre à jour</button>
    </form>
    <br>
    <p><a href="index.php" class="btn">Retour à l'accueil</a></p>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
