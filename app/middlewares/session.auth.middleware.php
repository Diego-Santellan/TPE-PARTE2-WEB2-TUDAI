<?php
    function sessionAuthMiddleware($res) {
        session_start();
        // este middlewere lee la sesion y con eso inicia la cookie 
        if(isset($_SESSION['id_user'])){ ///verifica que se haya logueado ( cdo hace el login correcto se guarda el id_user en el arreglo SESSION)
            $res->user = new stdClass();
            $res->user->id = $_SESSION['id_user'];
            $res->user->username = $_SESSION['username'];
            return;
        // } else {
        //     header('Location: ' . BASE_URL . 'showLogin');//baseurl/login
        //     die();
        // }
        }

    }
    // Las funciones `verifyAuthMiddleware` y `sessionAuthMiddleware` son parte de un sistema de autenticación en PHP que utiliza sesiones para controlar el acceso de los usuarios.

    // ### 1. `verifyAuthMiddleware($res)`
    // Esta función verifica si el usuario está autenticado. Hace lo siguiente:
    // - **Entrada**: Recibe como parámetro un objeto `$res`.
    // - **Verificación de autenticación**: Comprueba si el objeto `$res` tiene una propiedad `user`, que indica que el usuario está autenticado.
    //   - Si el usuario está autenticado (es decir, existe la propiedad `$res->user`), no hace nada y simplemente retorna (permitiendo la ejecución del resto del código).
    //   - Si el usuario **no** está autenticado, redirige a la página de login utilizando `header('Location: ' . BASE_URL . 'showLogin')` y termina la ejecución con `die()`.
    
    // Este middleware se usa generalmente para proteger rutas que solo deben estar disponibles para usuarios autenticados.
    
    // ### 2. `sessionAuthMiddleware($res)`
    // Esta función inicializa la sesión y verifica si el usuario ya ha iniciado sesión. Hace lo siguiente:
    // - **Inicio de sesión**: Llama a `session_start()` para iniciar la sesión en PHP.
    // - **Verificación de la sesión**: Revisa si existe el valor `id_user` en la variable global `$_SESSION`, lo que indica que el usuario ha iniciado sesión correctamente.
    //   - Si `$_SESSION['id_user']` existe:
    //     - Crea un nuevo objeto en `$res->user`.
    //     - Asigna a `$res->user->id` el valor de `$_SESSION['id_user']` (el ID del usuario logueado).
    //     - Asigna a `$res->user->username` el nombre de usuario almacenado en `$_SESSION['username']`.
    //     - De esta forma, almacena la información del usuario autenticado en `$res->user`, que puede ser utilizada por otras partes del código.
    //   - Si `$_SESSION['id_user']` no existe, no hace nada, pero podrías descomentar el bloque que redirige al login si deseas obligar a iniciar sesión.
    
    // ### Propósito conjunto
    // 1. **`sessionAuthMiddleware`**: Se encarga de leer la sesión del usuario cuando ya está autenticado y almacenar la información de la sesión en `$res->user`.
    // 2. **`verifyAuthMiddleware`**: Protege las rutas que requieren autenticación, redirigiendo a la página de login si no hay un usuario autenticado.
    
    // En resumen, estos middlewares trabajan juntos para manejar el control de acceso: uno para gestionar las sesiones, y otro para verificar si el usuario está autenticado.