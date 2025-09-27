<?php if ($totalPages > 1): ?>
    <div class="pagination">

        <!-- Lien Précédent -->
        <?php if ($page > 1): ?>
            <a href="index.php?controller=<?= $controller ?>&action=<?= $action ?>&page=<?= $page - 1 ?>">« Précédent</a>
        <?php endif; ?>

        <!-- Page 1 -->
        <?php if ($page == 1): ?>
            <span class="current">1</span>
        <?php else: ?>
            <a href="index.php?controller=<?= $controller ?>&action=<?= $action ?>&page=1">1</a>
        <?php endif; ?>

        <!-- Points de suspension si besoin -->
        <?php if ($page > 4): ?>
            <span class="dots">...</span>
        <?php endif; ?>

        <!-- Pages autour de la page courante -->
        <?php for ($i = max(2, $page - 2); $i <= min($totalPages - 1, $page + 2); $i++): ?>
            <?php if ($i == $page): ?>
                <span class="current"><?= $i ?></span>
            <?php else: ?>
                <a href="index.php?controller=<?= $controller ?>&action=<?= $action ?>&page=<?= $i ?>"><?= $i ?></a>
            <?php endif; ?>
        <?php endfor; ?>

        <!-- Points de suspension si besoin -->
        <?php if ($page < $totalPages - 3): ?>
            <span class="dots">...</span>
        <?php endif; ?>

        <!-- Dernière page -->
        <?php if ($totalPages > 1): ?>
            <?php if ($page == $totalPages): ?>
                <span class="current"><?= $totalPages ?></span>
            <?php else: ?>
                <a href="index.php?controller=<?= $controller ?>&action=<?= $action ?>&page=<?= $totalPages ?>"><?= $totalPages ?></a>
            <?php endif; ?>
        <?php endif; ?>

        <!-- Lien Suivant -->
        <?php if ($page < $totalPages): ?>
            <a href="index.php?controller=<?= $controller ?>&action=<?= $action ?>&page=<?= $page + 1 ?>">Suivant »</a>
        <?php endif; ?>

    </div>
<?php endif; ?>
