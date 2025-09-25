<?php
// includes/functions.php

// Nettoie une chaîne de caractères pour éviter les injections et les erreurs d’affichage
function cleanInput(string $input): string {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

// Vérifie si un utilisateur est connecté (basé sur la session)
function isUserConnected(): bool {
    return isset($_SESSION['user_id']);
}

// Récupère les infos utilisateur depuis la session
function getUserLogin(): ?string {
    return $_SESSION['user_login'] ?? null;
}

// Redirige vers une autre page puis arrête le script
function redirect(string $url): void {
    header("Location: $url");
    exit;
}
