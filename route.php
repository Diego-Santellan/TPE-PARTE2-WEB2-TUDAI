<?php
require_once './libs/response.php';
// Requiere los middlewares
require_once './app/middlewares/session.auth.middleware.php';
require_once './app/middlewares/verify.auth.middleware.php';
// Requiere los controladores 
require_once './app/controllers/auth.controller.php';
require_once './app/controllers/owner.controller.php';
require_once './app/controllers/property.controller.php';

// Base_URL para redirecciones y base tag. Base URL: es el localhost , el dominio en desarrollo
define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$res = new Response();

$action = 'properties'; // Acción por defecto si no se envía ninguna
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

// Parsea la acción para separar la acción real de los parámetros
$params = explode('/', $action);


/*
| Ruta                  | Controlador y Acción                              | Descripción                                                         |
|-----------------------|---------------------------------------------------|---------------------------------------------------------------------|
| /owners               | OwnerController()->getAllOwners()                 | Lista todos los dueños (categorías).                                |
| /owner/:ID            | OwnerController()->getOwner($id)                  | Muestra los detalles de un dueño específicado por parámetro.        |
| /deleteOwner/:ID      | OwnerController()->deleteOwner($id)               | Elimina un dueño específicado por parámetro.                        |
| /updateOwner/:ID      | OwnerController()->updateOwner($id)               | Actualiza los datos de un dueño específicado por parámetro.         |
| /addOwner             | OwnerController()->addOwner()                     | Agrega un nuevo dueño.                                              |
| /properties           | PropertyController()->getAllProperties()          | Lista todas las propiedades (items).                                |
| /property/:ID         | PropertyController()->getProperty($id)            | Muestra los detalles de una propiedad específica.                   |
| /propertiesForOwner   | PropertyController()->getPropertiesForOwner()     | Filtra propiedades por dueño.                                       |
| /deleteProperty/:ID   | PropertyController()->deleteProperty($id)         | Elimina una propiedad específica.                                   |
| /updateProperty/:ID   | PropertyController()->updateProperty($id)         | Actualiza los datos de una propiedad específica.                    |
| /addProperty          | PropertyController()->addProperty()               | Agrega una nueva propiedad.                                         |
| /showRegister         | AuthController()->showRegister()                  | Muestra el formulario de registro de usuario.                       |
| /register             | AuthController()->register()                      | Registra un nuevo usuario.                                          |
| /showLogin            | AuthController()->showLogin()                     | Muestra el formulario de inicio de sesión.                          |
| /login                | AuthController()->login()                         | Inicia sesión en la aplicación.                                     |
| /logout               | AuthController()->logout()                        | Cierra sesión en la aplicación.                                     |
| default               | 404 Page Not Found                                | Muestra una página de error 404 si la ruta no existe.               |
|-----------------------|---------------------------------------------------|---------------------------------------------------------------------|
*/








switch ($params[0]) {
        // rutas del lado 1 de la relación: dueño(Categorías) . 
    case 'owners':
        sessionAuthMiddleware($res); // Setea $res->user si existe session
        $controller = new OwnerController($res);
        $controller->getAllOwners();
        break;

    case 'owner':
        sessionAuthMiddleware($res);
        if (isset($params[1])) { //verifica que el parametro este setado
            $controller = new OwnerController($res);
            // Antes de usar $params[1] en acciones como owner, deleteOwner, updateOwner, se debe verificar si el índice existe para evitar errores si no se proporciona el parámetro.
            $controller->getOwner($params[1]);
        } else {
            $controller->showError("El parámetro no puede estar vacío");
        }
        break;

    case 'deleteOwner': /* Recargar la página al eliminar un elemento, en caso de que no se pueda avisar */
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        if (isset($params[1])) {
            $controller = new OwnerController($res);
            $controller->deleteOwner($params[1]);
        } else {
            $controller->showError("El parámetro no puede estar vacío");
        }
        break;

    case 'updateOwner':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        if (isset($params[1])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $controller = new OwnerController($res);
                $controller->updateOwner($params[1]);
            } else {
                $controller->showError("Se esperaba se usara el método POST");
            }
        } else {
            $controller->showError("El parámetro no puede estar vacío");
        }
        break;

    case 'addOwner':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $controller = new OwnerController($res);
            $controller->addOwner();
        } else {
            $controller->showError("Se esperaba se usara el método POST");
        }
        break;

        // lado N de la relación: propiedades(items) . 
    case 'properties':
        // puede verse sin estar loggeado 
        sessionAuthMiddleware($res);
        $controller = new PropertyController($res);
        $controller->getAllProperties();
        break;

    case 'property':
        sessionAuthMiddleware($res);
        if (isset($params[1])) {
            $controller = new PropertyController($res);
            $controller->getProperty($params[1]);
        } else {
            $controller->showError("El parámetro no puede estar vacío");
        }
        break;


    case 'propertiesForOwner': // es el action de filter_properties(form con el select)
        sessionAuthMiddleware($res);
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $controller = new PropertyController($res);
            $controller->getPropertiesForOwner();
        } else {
            $controller->showError("Se esperaba se usara el método GET");
        }
        break;

    case 'deleteProperty': /* Recargar la pagina al eliminar un elemento, en caso de que no se pueda avisar*/
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        if (isset($params[1])) {
            $controller = new PropertyController($res);
            $controller->deleteProperty($params[1]);
        } else {
            $controller->showError("El parámetro no puede estar vacío");
        }
        break;

    case 'updateProperty':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        if (isset($params[1])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $controller = new PropertyController($res);
                $controller->updateProperty($params[1]);
            } else {
                $controller->showError("Se esperaba se usara el método POST");
            }
        } else {
            $controller->showError("El parámetro no puede estar vacío");
        }
        break;

    case 'addProperty':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $controller = new PropertyController($res);
            $controller->addProperty();
        } else {
            $controller->showError("Se esperaba se usara el método POST");
        }
        break;

    case 'showRegister':
        $controller = new AuthController();
        $controller->showRegister(); //mostrar form de registo propiamente dicho
        break;

    case 'register': // el form al ser enviado llama a register 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $controller = new AuthController();
            $controller->register();
        } else {
            return $controller->showError("Se esperaba se usara el método POST");
        }
        break;

    case 'showLogin': // si el midleware de auth entra en el else(el usuario no está logueado te manda al showLogin)
        $controller = new AuthController();
        $controller->showLogin(); //renderiza el form para loguearte
        break;

    case 'login': // el form al ser enviado llama a login 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $controller = new AuthController();
            $controller->login(); //acción de login propiamente dicha
        } else {
            return $controller->showError("Se esperaba se usara el método POST");
        }
        break;

    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;

    default:
        header("HTTP/1.1 404 Not Found");
        echo "404 Page Not Found";
        break;
}
