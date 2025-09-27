<?php
require_once __DIR__ . '/../models/Commentaire.php';

class CommentaireController {
    // Afficher tous les commentaires (page Livre d’or)
    public function index($db) {
        $commentaireModel = new Commentaire($db);
        $comments = $commentaireModel->getAll();

        require __DIR__ . '/../views/commentaire/index.php';
    }

    // jouter un commentaire
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

                // Redirection vers la page Livre d’or
                header("Location: index.php?controller=commentaire&action=index");
                exit;
            }
        }

        require __DIR__ . '/../views/commentaire/create.php';
    }
}
