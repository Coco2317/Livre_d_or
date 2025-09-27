<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../app/core/Database.php';

$db = Database::getConnection();

$controllerName = $_GET['controller'] ?? 'home';
$action = $_GET['action'] ?? 'index';

$controllerClass = ucfirst($controllerName) . 'Controller';
$controllerFile = __DIR__ . '/../app/controllers/' . $controllerClass . '.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controller = new $controllerClass();
    if (method_exists($controller, $action)) {
        $controller->$action($db);
    } else {
        echo "Action $action non trouvée";
    }
} else {
    echo "Contrôleur $controllerName non trouvé";
}
