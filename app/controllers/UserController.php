<?php
require_once __DIR__ . '/../models/User.php';

class UserController {

    // Connexion utilisateur
    public function login($db) {
        $errors = [];
        $login = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = trim($_POST['login'] ?? '');
            $password = $_POST['password'] ?? '';

            $userModel = new User($db);
            $user = $userModel->findByLogin($login);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_login'] = $user['login'];
                header("Location: index.php?controller=user&action=profil");
                exit;
            } else {
                $errors[] = "Login ou mot de passe incorrect.";
            }
        }

        require __DIR__ . '/../views/user/login.php';
    }

    // Inscription utilisateur
    public function register($db) {
        $errors = [];
        $login = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = trim($_POST['login'] ?? '');
            $password = $_POST['password'] ?? '';
            $password_confirm = $_POST['password_confirm'] ?? '';

            if (empty($login)) $errors[] = "Le login est requis.";
            if (empty($password)) $errors[] = "Le mot de passe est requis.";
            if ($password !== $password_confirm) $errors[] = "Les mots de passe ne correspondent pas.";

            $userModel = new User($db);

            if (empty($errors) && $userModel->exists($login)) {
                $errors[] = "Ce login est déjà pris.";
            }

            if (empty($errors)) {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $userModel->create($login, $hash);

                header("Location: index.php?controller=user&action=login");
                exit;
            }
        }

        require __DIR__ . '/../views/user/register.php';
    }

    // Profil utilisateur
    public function profil($db) {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?controller=user&action=login");
            exit;
        }

        $errors = [];
        $success = '';
        $userModel = new User($db);
        $user = $userModel->findById($_SESSION['user_id']);

        if (!$user) {
            die("Utilisateur introuvable.");
        }

        $new_login = $user['login'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $new_login = trim($_POST['login'] ?? '');
            $password = $_POST['password'] ?? '';
            $password_confirm = $_POST['password_confirm'] ?? '';

            if (empty($new_login)) {
                $errors[] = "Le login ne peut pas être vide.";
            } elseif ($userModel->exists($new_login) && $new_login !== $user['login']) {
                $errors[] = "Ce login est déjà utilisé.";
            }

            if (!empty($password) || !empty($password_confirm)) {
                if ($password !== $password_confirm) {
                    $errors[] = "Les mots de passe ne correspondent pas.";
                }
            }

            if (empty($errors)) {
                if (!empty($password)) {
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    $userModel->update($_SESSION['user_id'], $new_login, $hash);
                } else {
                    $userModel->update($_SESSION['user_id'], $new_login);
                }

                $_SESSION['user_login'] = $new_login;
                $success = "Profil mis à jour avec succès.";
            }
        }

        require __DIR__ . '/../views/user/profil.php';
    }

    // Déconnexion
    public function logout($db) {
        session_destroy();
        header("Location: index.php");
        exit;
    }
}
