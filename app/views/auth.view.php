<?php
require_once 'vendor/autoload.php';

class AuthView
{
    private $user = null;

    // el usuario ya esta registrado, ingresa. El pasaje del parametro error es opcional -> es por si hay un inic
    public function showLogin($error = '') //va sin espacios para que no lo tome como un error ' ' 
    {
        global $smarty; // Asegúrate de que $smarty sea accesible aquí

        // Asignar variables a Smarty
        $smarty->assign('error', $error);

        // Mostrar la plantilla
        $smarty->display('form_login.tpl'); // Cambia a 'login.tpl' si es tu nombre de archivo
    }

    // si el usuario no esta registrado aun, ingresa un us y contraseña para loguearse y no esta registrado entonces el login lo manda a regitsrase 
    public function showRegister($error = '')
    {
        global $smarty; // Asegúrate de que $smarty sea accesible aquí

        // Asignar variables a Smarty
        $smarty->assign('error', $error);

        // Mostrar la plantilla
        $smarty->display('form_register.tpl'); // Cambia a 'login.tpl' si es tu nombre de archivo    }
    }
}
