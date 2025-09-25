<?php
require 'includes/config.php';
include 'includes/header.php';

$errors = [];
$login = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $password = $_POST['password'] ?? '';

    // Vérification des champs
    if (empty($login)) {
        $errors[] = "Le login est requis.";
    }
    if (empty($password)) {
        $errors[] = "Le mot de passe est requis.";
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT id, login, password FROM utilisateurs WHERE login = ?");
        $stmt->execute([$login]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Connexion réussie
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_login'] = $user['login'];

            // Redirige vers la page profil
            header('Location: profil.php');
            exit;
        } else {
            $errors[] = "Login ou mot de passe incorrect.";
        }
    }
}
?>

<div class="auth-page">
    <div class="auth-image" style="background-image: url('assets/connexion.jpg');"></div>

    <div class="auth-form">
        <h1>Connexion</h1>

        <?php if ($errors): ?>
            <ul class="errors">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <form action="connexion.php" method="post" novalidate>
            <label for="login">Login :</label>
            <input type="text" id="login" name="login" required value="<?= htmlspecialchars($login) ?>" />

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required />

            <button type="submit">Se connecter</button>
        </form>
        <br>
        <p>Pas encore inscrit ? <a href="inscription.php">Inscrivez-vous ici</a>.</p>
        <a href="index.php" class="back-home-btn">← Retour à l'accueil</a>
    </div>
</div>
