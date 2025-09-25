<?php
require 'includes/config.php';
include 'includes/header.php';

$errors = [];
$login = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';

    if (empty($login)) {
        $errors[] = "Le login est requis.";
    }
    if (empty($password)) {
        $errors[] = "Le mot de passe est requis.";
    }
    if ($password !== $password_confirm) {
        $errors[] = "Les mots de passe ne correspondent pas.";
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT id FROM utilisateurs WHERE login = ?");
        $stmt->execute([$login]);
        if ($stmt->fetch()) {
            $errors[] = "Ce login est déjà pris.";
        }
    }

    if (empty($errors)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO utilisateurs (login, password) VALUES (?, ?)");
        $stmt->execute([$login, $hash]);

        header("Location: connexion.php");
        exit;
    }
}
?>

<div class="auth-page">
    <div class="auth-image" style="background-image: url('assets/inscription.jpg');"></div>

    <div class="auth-form">
        <h1>Inscription</h1>

        <?php if ($errors): ?>
            <ul class="errors">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <form action="inscription.php" method="post" novalidate>
            <label for="login">Login :</label>
            <input type="text" id="login" name="login" required value="<?= htmlspecialchars($login) ?>" />

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required />

            <label for="password_confirm">Confirmer mot de passe :</label>
            <input type="password" id="password_confirm" name="password_confirm" required />

            <button type="submit">S'inscrire</button>
        </form>
        <br>

        <p>Déjà inscrit ? <a href="connexion.php">Connectez-vous ici</a>.</p>
        <a href="index.php" class="back-home-btn">← Retour à l'accueil</a>
    </div>
</div>

