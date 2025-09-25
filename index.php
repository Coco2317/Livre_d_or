<?php
include 'includes/header.php';
require 'includes/config.php';

// Récupération des commentaires
$stmt = $pdo->query("
    SELECT commentaires.commentaire, commentaires.date, utilisateurs.login
    FROM commentaires
    JOIN utilisateurs ON commentaires.id_utilisateur = utilisateurs.id
    ORDER BY commentaires.date DESC
");
$comments = $stmt->fetchAll();
?>

<!-- HERO -->
<section class="hero" style="background-image: url('assets/Japon-hero.png');"></section>
<br>
<!-- Galerie -->
<section class="vignettes">
  <img src="assets/img1.jpg" alt="Tokyo street view" />
  <img src="assets/img2.jpg" alt="Tokyo skyline" />
  <img src="assets/img3.jpg" alt="Cherry blossoms" />
  <img src="assets/img4.jpg" alt="Tokyo temple" />
</section>

<!-- Travel & Tips -->
<section class="tips">
  <h2>Travel and Inspire Your Life</h2>
  <p>Explorez des conseils utiles et des histoires inspirantes d’aventuriers au Japon. Que vous soyez passionné de gastronomie, d’architecture ou de traditions, le Japon vous émerveillera à chaque instant.</p>
</section>

<!-- Section Article -->
<section class="article">
  <div class="article-container">
    <div class="article-image">
      <img src="assets/article.jpg" alt="tenue-traditionnelle-japonaise">
    </div>
    <div class="article-text">
      <h2>Découvrir Kyoto, l’âme traditionnelle du Japon</h2>
      <p>
        Kyoto est une ville où se mêlent harmonieusement histoire, culture et nature. Entre ses temples millénaires, ses jardins zen et ses ruelles pittoresques, chaque coin raconte une histoire. Les cérémonies du thé, les kimonos colorés et les festivals traditionnels plongent les visiteurs dans un Japon authentique et préservé.
      </p>
      <p>
        Chaque quartier de Kyoto a sa propre identité : Arashiyama avec sa célèbre forêt de bambous, Gion avec ses geishas élégantes et Higashiyama avec ses ruelles pittoresques et ses boutiques artisanales. C’est un véritable voyage dans le temps qui éveille tous les sens et invite à la contemplation.
      </p>
      <a href="index.php" class="btn-en-savoir-plus">En savoir plus</a>
    </div>
  </div>
</section>

<div class="section-divider"></div>


<!-- Commentaires -->
<section class="commentaires">
  <h2>Commentaires</h2>

  <?php if (isset($_SESSION['user_id'])): ?>
    <p><a href="commentaire.php">Ajouter un commentaire</a></p>
  <?php else: ?>
    <p><a href="connexion.php">Connectez-vous</a> pour laisser un commentaire.</p>
  <?php endif; ?>

  <?php if ($comments): ?>
    <?php foreach ($comments as $comment): ?>
      <div class="commentaire">
        <div class="meta">
          Posté le <?= htmlspecialchars(date('d/m/Y', strtotime($comment['date']))) ?> 
          par <?= htmlspecialchars($comment['login']) ?>
        </div>
        <p><?= nl2br(htmlspecialchars($comment['commentaire'])) ?></p>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p>Aucun commentaire pour le moment.</p>
  <?php endif; ?>
</section>

<?php include 'includes/footer.php'; ?>
