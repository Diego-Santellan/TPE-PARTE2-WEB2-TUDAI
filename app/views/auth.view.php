<?php
class AuthView
{
    private $user = null;

    // el usuario ya esta registrado, ingresa. El pasaje del parametro error es opcional -> es por si hay un inic
    public function showLogin($error = ' ')
    {
        require_once './templates/form_login.phtml';
    }
    
    // si el usuario no esta registrado aun, ingresa un us y contraseña para loguearse y no esta registrado entonces el login lo manda a regitsrase 
    public function showRegister($error = ' ')
    {
        require_once './templates/form_register.phtml';
    }
}
