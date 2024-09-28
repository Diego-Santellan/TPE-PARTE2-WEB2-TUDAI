<?php

require_once './app/controllers/owner.controller.php';

// base_url para redirecciones y base tag
define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$action = 'getAllOwners'; // accion por defecto si no se envia ninguna
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

// parsea la accion para separar accion real de parametros
$params = explode('/', $action);

switch ($params[0]) {

        // // lado N de la relacion: duenio . 
    case 'getAllOwners':
        $controller = new OwnerController();
        $controller->getAllOwners();
        break;

    case 'getOwner':
        $controller = new OwnerController();
        $controller->getOwner($params[1]);
        break;

    case 'deleteOwner': /* Realiazar una accion como recargar la pagina al eliminar un elemento... en caso de que no se pueda avisar y detallar*/
        $controller = new OwnerController();
        $controller->deleteOwner($params[1]);
        break;

    case 'updateOwner':
        $controller = new OwnerController();
        $controller->updateOwner($params[1]);
        break;

    case 'addOwner':
        $controller = new OwnerController();
        $controller->addOwner();
        break;

    default:
        echo "404 Page Not Found";
        header("HTTP/1.1 404 Not Found");
        break;
}
