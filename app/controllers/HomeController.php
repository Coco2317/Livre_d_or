<?php
require_once __DIR__ . '/../models/Commentaire.php';

class HomeController {
    public function index($db) {
        $commentaireModel = new Commentaire($db);

        // Pagination
        $limit = 5; // nb de commentaires par page
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $offset = ($page - 1) * $limit;

        $comments = $commentaireModel->getPagined($limit, $offset);
        $totalComments = $commentaireModel->countAll();
        $totalPages = ceil($totalComments / $limit);

        require __DIR__ . '/../views/home/index.php';
    }
}
