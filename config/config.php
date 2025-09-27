<?php
session_start();

// Expiration de session après 2h 
$inactive = 7200;
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $inactive)) {
    session_unset();
    session_destroy();
    header("Location: index.php?controller=user&action=login&expired=1");
    exit;
}
$_SESSION['LAST_ACTIVITY'] = time();

// === Définition des constantes DB ===
define("DB_HOST", "localhost");
define("DB_NAME", "livreor");
define("DB_USER", "root");
define("DB_PASS", "");

// Pas besoin de créer la connexion ici, elle sera faite via Database::getConnection()
