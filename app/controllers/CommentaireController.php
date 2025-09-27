<?php
require_once __DIR__ . '/../models/Commentaire.php';

class CommentaireController {

    // Page Livre d'or avec pagination
    public function index($db) {
        $commentaireModel = new Commentaire($db);

        // Pagination
        $limit = 5; // nombre de commentaires par page
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $offset = ($page - 1) * $limit;

        $comments = $commentaireModel->getPagined($limit, $offset);
        $totalComments = $commentaireModel->countAll();
        $totalPages = ceil($totalComments / $limit);

        require __DIR__ . '/../views/commentaire/index.php';
    }

    // Création d’un commentaire
    public function create($db) {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $commentaire = trim($_POST['commentaire'] ?? '');
            $idUtilisateur = $_SESSION['user_id'] ?? null;

            if (empty($commentaire)) {
                $errors[] = "Le commentaire ne peut pas être vide.";
            }

            if (!$idUtilisateur) {
                $errors[] = "Vous devez être connecté pour poster.";
            }

            if (empty($errors)) {
                $commentaireModel = new Commentaire($db);
                $commentaireModel->create($commentaire, $idUtilisateur);

                // Redirection vers Livre d’or après succès
                header("Location: index.php?controller=commentaire&action=index");
                exit;
            }
        }

        require __DIR__ . '/../views/commentaire/create.php';
    }
}
