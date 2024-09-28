<?php

require_once './app/controllers/owner.controller.php';
require_once './app/controllers/property.controller.php';

// base_url para redirecciones y base tag
define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$action = 'getAllOwners'; // accion por defecto si no se envia ninguna
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

// parsea la accion para separar accion real de parametros
$params = explode('/', $action);

switch ($params[0]) {

    // lado 1 de la relacion: duenio(Categorías) . 
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

        // lado N de la relacion: propiedades (items) . 
    case 'getAllProperties':
        $controller = new PropertyController();
        $controller->getAllProperties();
        break;

    case 'getProperty':
        $controller = new PropertyController();
        $controller->getProperty($params[1]);
        break;

    case 'deleteProperty': /* Realizar una accion como recargar la pagina al eliminar un elemento... en caso de que no se pueda avisar y detallar*/
        $controller = new PropertyController();
        $controller->deleteProperty($params[1]);
        break;
        
    case 'updateProperty':
        $controller = new PropertyController();
        $controller->updateProperty($params[1]);
        break;

    case 'addProperty':
        $controller = new PropertyController();
        $controller->addProperty();
        break;
    
    default:
        echo "404 Page Not Found";
        header("HTTP/1.1 404 Not Found");
        break;
}
