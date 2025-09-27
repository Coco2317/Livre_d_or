<?php
class Commentaire {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAll() {
        $stmt = $this->db->query("
            SELECT commentaires.commentaire, commentaires.date, utilisateurs.login
            FROM commentaires
            JOIN utilisateurs ON commentaires.id_utilisateur = utilisateurs.id
            ORDER BY commentaires.date DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($commentaire, $idUtilisateur) {
        $stmt = $this->db->prepare("
            INSERT INTO commentaires (commentaire, id_utilisateur, date)
            VALUES (:commentaire, :id_utilisateur, NOW())
        ");
        return $stmt->execute([
            ':commentaire' => $commentaire,
            ':id_utilisateur' => $idUtilisateur
        ]);
    }
}
