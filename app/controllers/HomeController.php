<?php
require_once __DIR__ . '/../models/Commentaire.php';

class HomeController {
    public function index($db) {
        $commentaireModel = new Commentaire($db);
        $comments = $commentaireModel->getAll();

        require __DIR__ . '/../views/home/index.php';
    }
}
