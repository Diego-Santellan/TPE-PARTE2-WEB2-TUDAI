<?php
require_once './app/models/user.model.php';
require_once './app/views/auth.view.php';

class AuthController
{
    private $model;
    private $view;

    public function __construct()
    {
        $this->model = new UserModel();
        $this->view = new AuthView();
    }



    public function register()
    {
        $isValid = true;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // VALIDACIONES NOMBREUSARIO
            // si no esta definida o si esta vacia :
            if (!isset($_POST['usernameRegister']) || empty($_POST['usernameRegister'])) {
                $isValid = false;
                return $this->view->showRegister('Falta completar el nombre de usuario');
            }

            //Validar que el nombre usuario no exceda los 20 caracteres
            if (strlen($_POST['usernameLogin']) > 20) {
                $isValid = false;
                return $this->view->showLogin("El nombre de usuario no puede exceder los 20 caracteres");
            }

            // Verificar caracteres válidos (solo letras y números)
            if (!preg_match('/^[a-zA-Z0-9_]+$/', $_POST['usernameLogin'])) {
                $isValid = false;
                return $this->view->showLogin("El nombre de usuario sólo puede contener letras, números y guiones bajos.");
            }

            // VALIDACIONES CONTRASEÑA
            if (!isset($_POST['passwordRegister']) || empty($_POST['passwordRegister'])) {
                $isValid = false;
                return $this->view->showRegister('Falta completar la contraseña');
            }

            if ($isValid) {
                $username = $_POST['usernameRegister'];
                $password = $_POST['passwordRegister'];

                // Verificar que el usuario está en la base de datos
                $userFromDB = $this->model->getUserByUsername($username);
                $passwordHash = password_hash($password, PASSWORD_DEFAULT); //hasheo la contraseña que ingreso el us

                // verifica que el us no este en la DB  
                if (!$userFromDB) {
                    // Guardo en la sesión el ID del usuario y otros datos de el
                    $this->model->addUser($username, $passwordHash);
                    session_start();
                    $_SESSION['id_user'] = $userFromDB->id_user;
                    $_SESSION['username'] = $userFromDB->username;
                    $_SESSION['LAST_ACTIVITY'] = time();
                    // Redirijo al home
                    header('Location: ' . BASE_URL);
                } else {
                    return $this->view->showRegister('Ese usuario ya existe.No puede registrarse con ese nombre de usuario');
                }
            }
        } else {
            return $this->view->showRegister("Se esperaba se usara el método POST");
        }
    }
    public function showRegister()
    {
        // Muestro el formulario de login
        return $this->view->showRegister();
    }

    public function showLogin()
    {
        // Muestro el formulario de login
        return $this->view->showLogin();
    }
    public function login()
    {
        $isValid = true;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // VALIDACIONES NOMBREUSUARIO
            // si no está definida o si está vacia :
            if (!isset($_POST['usernameLogin']) || empty($_POST['usernameLogin'])) {
                $isValid = false;
                return $this->view->showLogin('Falta completar el nombre de usuario');
            }

            //Validar que el nombre usuario no exceda los 20 caracteres
            if (strlen($_POST['usernameLogin']) > 20) {
                $isValid = false;
                return $this->view->showLogin("El nombre de usuario no puede exceder los 20 caracteres");
            }

            // Verificar caracteres válidos (solo letras y números)
            if (!preg_match('/^[a-zA-Z0-9_]+$/', $_POST['usernameLogin'])) {
                $isValid = false;
                return $this->view->showLogin("El nombre de usuario sólo puede contener letras, números y guiones bajos.");
            }

            // VALIDACIONES CONTRASEÑA

            // si no está definida o si está vacia :
            if (!isset($_POST['passwordLogin']) || empty($_POST['passwordLogin'])) {
                $isValid = false;
                return $this->view->showLogin('Falta completar la contraseña');
            }

            if ($isValid) {
                $username = $_POST['usernameLogin'];
                $password = $_POST['passwordLogin'];

                // Verificar que el usuario está en la base de datos
                $userFromDB = $this->model->getUserByUsername($username);

                if ($userFromDB) { //el usuario existe en la DB
                    if (password_verify($password, $userFromDB->password)) { //la contraseña ingresada sea igual a la contraseña hasheada de la DB 
                        // Guardo en la sesión el ID del usuario y otros datos de el
                        session_start();
                        $_SESSION['id_user'] = $userFromDB->id_user;
                        $_SESSION['username'] = $userFromDB->username;
                        $_SESSION['LAST_ACTIVITY'] = time();
                        // Redirijo al home
                        header('Location: ' . BASE_URL);
                    } else { //el usuario no existe en la DB
                        return $this->view->showLogin(error: 'Contraseña incorrectas');
                    }
                } else {
                    // agregar btn a registrar 
                    return $this->view->showLogin(error: 'usuario sin registrar');
                }
            }
        } else {
            return $this->view->showLogin("Se esperaba se usara el método POST");
        }
    }

    public function logout()
    {
        session_start(); // Va a buscar la cookie
        session_destroy(); // Borra la cookie que se buscó
        header('Location: ' . BASE_URL);
    }
}
