<?php
class Commentaire {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Récupérer les commentaires paginés
    public function getPagined($limit, $offset) {
        $stmt = $this->db->prepare("
            SELECT commentaires.commentaire, commentaires.date, utilisateurs.login
            FROM commentaires
            JOIN utilisateurs ON commentaires.id_utilisateur = utilisateurs.id
            ORDER BY commentaires.date DESC
            LIMIT :limit OFFSET :offset
        ");
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Compter tous les commentaires (pour la pagination)
    public function countAll() {
        $stmt = $this->db->query("SELECT COUNT(*) FROM commentaires");
        return $stmt->fetchColumn();
    }

    // Ajouter un commentaire
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
