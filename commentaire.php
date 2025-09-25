<?php
include 'includes/header.php';
require 'includes/config.php';

// Vérifier si utilisateur connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit;
}

$errors = [];
$commentaire = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $commentaire = trim($_POST['commentaire'] ?? '');

    if (empty($commentaire)) {
        $errors[] = "Le champ commentaire ne peut pas être vide.";
    }

    if (empty($errors)) {
        // Insérer le commentaire en base
        $stmt = $pdo->prepare("INSERT INTO commentaires (commentaire, id_utilisateur, date) VALUES (?, ?, NOW())");
        $stmt->execute([$commentaire, $_SESSION['user_id']]);

        // Rediriger vers le livre d'or après ajout
        header('Location: livre-or.php');
        exit;
    }
}
?>

<!-- HERO Section -->
<section class="hero-commentaire"></section>

<div class="container">
    <h1>Ajouter un commentaire</h1>

    <?php if ($errors): ?>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form action="commentaire.php" method="post" novalidate>
        <label for="commentaire">Votre commentaire :</label>
        <textarea id="commentaire" name="commentaire" rows="5" required><?= htmlspecialchars($commentaire) ?></textarea>
        <button type="submit">Envoyer</button>
    </form>

    <p><a href="livre-or.php" class="btn">Retour au livre d’or</a></p>
</div>

<?php include 'includes/footer.php'; ?>
