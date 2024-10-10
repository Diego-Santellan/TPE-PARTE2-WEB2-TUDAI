<?php
require_once './libs/response.php';
// Requiere los middlewares
require_once './app/middlewares/session.auth.middleware.php';
require_once './app/middlewares/verify.auth.middleware.php';
// Requiere los controladores 
require_once './app/controllers/auth.controller.php';
require_once './app/controllers/owner.controller.php';
require_once './app/controllers/property.controller.php';

// Base_url para redirecciones y base tag. Base URL: es el localhost , el dominio en desarrollo
define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$res = new Response();

$action = 'getAllOwners'; // Acción por defecto si no se envía ninguna
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

// Parsea la acción para separar la acción real de los parametros
$params = explode('/', $action);

// TABLA DE RUTEO

// getAllOwners             - Obtener todos los dueños.
// getOwner/:ID             - Obtener un dueño especificado por ID.
// deleteOwner/:ID          - Eliminar un dueño especificado por ID.
// updateOwner/:ID          - Actualizar un dueño especificado por ID.
// addOwner                 - Agregar un nuevo dueño.
// getAllProperties         - Obtener todas las propiedades.
// getProperty/:ID          - Obtener una propiedad específica por ID.
// getAllPropertiesForOwner - Obtener todas las propiedades de un dueño especificado.
// deleteProperty/:ID       - Eliminar una propiedad específica por ID.
// updateProperty/:ID       - Actualizar una propiedad específica por ID.
// addProperty              - Agregar una nueva propiedad.
// showRegister             - Mostrar el formulario de registro de usuario.
// register                 - Registrar un nuevo usuario.
// showLogin                - Mostrar el formulario de inicio de sesión.
// login                    - Iniciar sesión.
// logout                   - Cerrar sesión.
// default                  - Manejo de rutas no encontradas (404 Page Not Found).



switch ($params[0]) {

        // lado 1 de la relación: dueño(Categorías) . 
    case 'getAllOwners':
        sessionAuthMiddleware($res); // Setea $res->user si existe session
        verifyAuthMiddleware($res); // Verifica que el usuario esté logueado o redirige a login
        $controller = new OwnerController($res);
        $controller->getAllOwners();
        break;

    case 'getOwner':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new OwnerController($res);
        if (isset($params[1])) { //verifica que el parametro este setado
            // Antes de usar $params[1] en acciones como getOwner, deleteOwner, updateOwner, se debe verificar si el índice existe para evitar errores si no se proporciona el parámetro.
            $controller->getOwner($params[1]);
        } else {
            $controller->showError("El parámetro no puede estar vacío");
        }
        break;

    case 'deleteOwner': /* Realizar una accion como recargar la pagina al eliminar un elemento... en caso de que no se pueda avisar y detallar*/
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new OwnerController($res);
        if (isset($params[1])) {
            $controller->deleteOwner($params[1]);
        } else {
            $controller->showError("El parámetro no puede estar vacío");
        }
        break;

    case 'updateOwner':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new OwnerController($res);
        if (isset($params[1])) {
            $controller->updateOwner($params[1]);
        } else {
            $controller->showError("El parámetro no puede estar vacío");
        }
        break;

    case 'addOwner':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new OwnerController($res);
        $controller->addOwner();
        break;

        // lado N de la relacion: propiedades(items) . 
    case 'getAllProperties':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new PropertyController($res);
        $controller->getAllProperties();
        break;

    case 'getProperty':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new PropertyController($res);
        if (isset($params[1])) {
            $controller->getProperty($params[1]);
        } else {
            $controller->showError("El parámetro no puede estar vacío");
        }
        break;


    case 'getAllPropertiesForOwner': // es el action de filter_properties(form con el select)
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new PropertyController($res);
        $controller->getAllPropertiesForOwner();
        break;

    case 'deleteProperty': /* Realizar una acción como recargar la pagina al eliminar un elemento... en caso de que no se pueda avisar y detallar*/
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new PropertyController($res);
        if (isset($params[1])) {
            $controller->deleteProperty($params[1]);
        } else {
            $controller->showError("El parámetro no puede estar vacío");
        }
        break;

    case 'updateProperty':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new PropertyController($res);
        if (isset($params[1])) {
            $controller->updateProperty($params[1]);
        } else {
            $controller->showError("El parámetro no puede estar vacío");
        }
        break;

    case 'addProperty':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controller = new PropertyController($res);
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


    case 'showLogin': // si el midleware de auth entra en el else(el usuario no esta logueado te manda al showLogin )
        $controller = new AuthController();
        $controller->showLogin(); //te renderiza el form para loguearte
        break;

    case 'login': // el form al ser enviado llama a login 
        $controller = new AuthController();
        $controller->login(); //accion de login propiamente dicha
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
