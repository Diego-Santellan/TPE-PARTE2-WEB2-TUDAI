<?php
require_once './libs/response.php';
require_once './app/middlewares/session.auth.middleware.php';
require_once './app/controllers/auth.controller.php';
require_once './app/controllers/owner.controller.php';
require_once './app/controllers/property.controller.php';

// base_url para redirecciones y base tag
define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$res = new Response();

$action = 'getAllOwners'; // accion por defecto si no se envia ninguna
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

// parsea la accion para separar accion real de parametros
$params = explode('/', $action);

// tabla de ruteo

// getAllOwners
// getAllOwners
// getOwner/:ID 
// deleteOwner/:ID 
// updateOwner/:ID 
// addOwner
// getAllProperties
// getProperty/:ID 
// deleteProperty/:ID 
// updateProperty/:ID 
// addProperty
// showRegister
// register
// login
// showLogin
// logout
// default


switch ($params[0]) {

        // lado 1 de la relación: duenio(Categorías) . 
    case 'getAllOwners':
        sessionAuthMiddleware(res: $res);
        $controller = new OwnerController();
        $controller->getAllOwners();
        break;

    case 'getOwner':
        sessionAuthMiddleware(res: $res);
        $controller = new OwnerController();
        $controller->getOwner($params[1]);
        break;

    case 'deleteOwner': /* Realizar una accion como recargar la pagina al eliminar un elemento... en caso de que no se pueda avisar y detallar*/
        sessionAuthMiddleware(res: $res);
        $controller = new OwnerController();
        $controller->deleteOwner($params[1]);
        break;

    case 'updateOwner':
        sessionAuthMiddleware(res: $res);
        $controller = new OwnerController();
        $controller->updateOwner($params[1]);
        break;

    case 'addOwner':
        sessionAuthMiddleware(res: $res);
        $controller = new OwnerController();
        $controller->addOwner();
        break;

        // lado N de la relacion: propiedades(items) . 
    case 'getAllProperties':
        sessionAuthMiddleware(res: $res);
        $controller = new PropertyController();
        $controller->getAllProperties();
        break;

    case 'getProperty':
        sessionAuthMiddleware(res: $res);
        $controller = new PropertyController();
        $controller->getProperty($params[1]);
        break;

    
    case 'getAllPropertiesForOwner':
        sessionAuthMiddleware(res: $res);
        $controller = new PropertyController();
        $controller->getAllPropertiesForOwner();
        break;

    case 'deleteProperty': /* Realizar una acción como recargar la pagina al eliminar un elemento... en caso de que no se pueda avisar y detallar*/
        sessionAuthMiddleware(res: $res);
        $controller = new PropertyController();
        $controller->deleteProperty($params[1]);
        break;

    case 'updateProperty':
        sessionAuthMiddleware(res: $res);
        $controller = new PropertyController();
        $controller->updateProperty($params[1]);
        break;

    case 'addProperty':
        sessionAuthMiddleware(res: $res);
        $controller = new PropertyController();
        $controller->addProperty();
        break;

    case 'showRegister':
        $controller = new AuthController();
        $controller->showRegister(); //mostrar form de registo propiamente dicho
        break;

    case 'register': // el form al ser enviado llama a register 
        $controller = new AuthController();
        $controller->register(); 
        break;

    case 'login': // el form al ser enviado llama a login 
        $controller = new AuthController();
        $controller->login(); //accion de login propiamente dicha
        break;

    case 'showLogin': // si el midleware de auth entra en el else(el usuario no esta logueado te manda al login )
        $controller = new AuthController();
        $controller->showLogin();
        break;

    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;

    default:
        echo "404 Page Not Found";
        header("HTTP/1.1 404 Not Found");
        break;
}
