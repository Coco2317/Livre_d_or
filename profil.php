<?php
require 'includes/config.php';
include 'includes/header.php';

// Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit;
}

$errors = [];
$success = '';

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT login FROM utilisateurs WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if (!$user) {
    die("Utilisateur introuvable.");
}

$current_login = $user['login'];
$new_login = $current_login;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_login = trim($_POST['login'] ?? '');
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';

    if (empty($new_login)) {
        $errors[] = "Le login ne peut pas être vide.";
    } else {
        $stmt = $pdo->prepare("SELECT id FROM utilisateurs WHERE login = ? AND id != ?");
        $stmt->execute([$new_login, $user_id]);
        if ($stmt->fetch()) {
            $errors[] = "Ce login est déjà utilisé par un autre utilisateur.";
        }
    }

    if (!empty($password) || !empty($password_confirm)) {
        if ($password !== $password_confirm) {
            $errors[] = "Les mots de passe ne correspondent pas.";
        }
    }

    if (empty($errors)) {
        if (!empty($password)) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE utilisateurs SET login = ?, password = ? WHERE id = ?");
            $stmt->execute([$new_login, $hash, $user_id]);
        } else {
            $stmt = $pdo->prepare("UPDATE utilisateurs SET login = ? WHERE id = ?");
            $stmt->execute([$new_login, $user_id]);
        }

        $_SESSION['user_login'] = $new_login;
        $success = "Profil mis à jour avec succès.";
    }
}
?>

<!-- HERO -->
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

    <form action="profil.php" method="post" novalidate>
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

<?php include 'includes/footer.php'; ?>
