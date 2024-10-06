<?php
    function sessionAuthMiddleware($res) {
        session_start();
        if(isset($_SESSION['id_user'])){ ///verifica que se haya logueado ( cdo hace el login correcto se guarda el id_user en el arreglo SESSION)
            $res->user = new stdClass();
            $res->user->id = $_SESSION['id_user'];
            $res->user->username = $_SESSION['username'];
            return;
        } else {
            header('Location: ' . BASE_URL . 'showLogin');//baseurl/login
            die();
        }
    }
