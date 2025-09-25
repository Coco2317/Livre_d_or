<?php
// includes/config.php

// Paramètres de connexion à la base de données
$host = 'localhost';       // Adresse du serveur MySQL
$dbname = 'livreor';       // Nom de la base de données
$user = 'root';            // Nom d’utilisateur MySQL (à adapter)
$password = '';            // Mot de passe MySQL (à adapter)

try {
    // Création d'une nouvelle instance PDO avec gestion des erreurs en exceptions
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password);
    
    // Mode d'erreur sur exceptions
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Mode de récupération par défaut (tableau associatif)
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // En cas d'erreur, afficher un message simple et arrêter le script
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
