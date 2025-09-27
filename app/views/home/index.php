<?php include __DIR__ . '/../layouts/header.php'; ?>

<!-- HERO -->
<section class="hero" style="background-image: url('assets/img/Japon-hero.png');"></section>
<br>

<!-- Galerie -->
<section class="vignettes">
  <img src="assets/img/img1.jpg" alt="Tokyo street view" />
  <img src="assets/img/img2.jpg" alt="Tokyo skyline" />
  <img src="assets/img/img3.jpg" alt="Cherry blossoms" />
  <img src="assets/img/img4.jpg" alt="Tokyo temple" />
</section>

<!-- Travel & Tips -->
<section class="tips">
  <h2>Travel and Inspire Your Life</h2>
  <p>Explorez des conseils utiles et des histoires inspirantes d’aventuriers au Japon...</p>
</section>

<!-- Section Article -->
<section class="article">
  <div class="article-container">
    <div class="article-image">
      <img src="assets/img/article.jpg" alt="tenue-traditionnelle-japonaise">
    </div>
    <div class="article-text">
      <h2>Découvrir Kyoto, l’âme traditionnelle du Japon</h2>
      <p>Kyoto est une ville où se mêlent harmonieusement histoire, culture et nature...</p>
      <a href="index.php" class="btn-en-savoir-plus">En savoir plus</a>
    </div>
  </div>
</section>

<div class="section-divider"></div>

<!-- Commentaires -->
<section class="commentaires">
  <h2>Commentaires</h2>

  <?php if (isset($_SESSION['user_id'])): ?>
    <p><a href="index.php?controller=commentaire&action=create">Ajouter un commentaire</a></p>
  <?php else: ?>
    <p><a href="index.php?controller=user&action=login">Connectez-vous</a> pour laisser un commentaire.</p>
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

<?php include __DIR__ . '/../layouts/footer.php'; ?>
