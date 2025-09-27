<?php
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Chercher un utilisateur par login (pour la connexion)
    public function findByLogin($login) {
        $stmt = $this->db->prepare("SELECT * FROM utilisateurs WHERE login = :login");
        $stmt->execute([':login' => $login]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Vérifier si un login existe déjà (pour l'inscription)
    public function exists($login) {
        $stmt = $this->db->prepare("SELECT id FROM utilisateurs WHERE login = :login");
        $stmt->execute([':login' => $login]);
        return $stmt->fetch();
    }

    // Créer un nouvel utilisateur
    public function create($login, $passwordHash) {
        $stmt = $this->db->prepare("INSERT INTO utilisateurs (login, password) VALUES (:login, :password)");
        return $stmt->execute([
            ':login' => $login,
            ':password' => $passwordHash
        ]);
    }

    // Récupérer un utilisateur par ID (pour le profil)
    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM utilisateurs WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Mettre à jour un utilisateur (login + mot de passe optionnel)
    public function update($id, $login, $passwordHash = null) {
        if ($passwordHash) {
            $stmt = $this->db->prepare("UPDATE utilisateurs SET login = :login, password = :password WHERE id = :id");
            return $stmt->execute([
                ':login' => $login,
                ':password' => $passwordHash,
                ':id' => $id
            ]);
        } else {
            $stmt = $this->db->prepare("UPDATE utilisateurs SET login = :login WHERE id = :id");
            return $stmt->execute([
                ':login' => $login,
                ':id' => $id
            ]);
        }
    }
}
