<?php
require_once './config.php';
// crea una conexión a MySQL con los datos definidos en las constantes MYSQL_HOST, MYSQL_DB, MYSQL_USER, y MYSQL_PASS de config.php.

// Para asegurarte de que todos los modelos compartan la misma conexión a la base de datos, puedes  crear una clase padre para los modelos. Esta clase padre contendrá la conexión a la base de datos, y todos los modelos específicos heredarán de ella. 
class ModelConectDB
{ //clase padre
    protected $db; //atributo db que guarla la url para la conecxion a la DB

    public function __construct()
    {
        try {

            // 1. abro la conexion a la DB 
            $this->db = new PDO(
                "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB . ";charset=utf8",
                MYSQL_USER,
                MYSQL_PASS
            );

            // Establecer el modo de error de PDO a excepción  
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) { 
            //$e->getMessage(): Este es un método nativo de la clase Exception (de la cual PDOException hereda). Este método devuelve un mensaje de error que describe la excepción.Uso: Proporciona información específica sobre lo que salió mal, como un error de conexión, un error en la consulta SQL, etc.
            // Manejo de errores de conexión
            echo "Error de conexión: " . $e->getMessage();
            exit; // Termina la ejecución del script en caso de error
        }
    }
}


//configuración de cómo PDO (PHP Data Objects) maneja los errores que pueden ocurrir durante las operaciones de base de datos. Al establecer el modo de error a excepción, estás indicando a PDO que, en caso de un error, lance una excepción en lugar de manejarlo silenciosamente o retornar un código de error.
// ¿Por qué es importante? Manejo de errores más claro: Al lanzar excepciones, puedes capturarlas y manejarlas en tu código, lo que te permite saber exactamente qué salió mal, Durante el desarrollo, es mucho más fácil detectar y solucionar problemas cuando se lanzan excepciones.  Seguridad: Un manejo adecuado de errores puede ayudar a prevenir que se filtren detalles sensibles del sistema en los mensajes de error.
// Si no estableces el modo de error y ocurre un problema al ejecutar una consulta SQL, PDO podría devolver false, y tendrías que verificar manualmente si hubo un error. Sin embargo, al establecer el modo de error a excepción, puedes usar un bloque try-catch para capturar el error:

// Modos de error de PDO
    // PDO ofrece diferentes modos de error que puedes establecer:
    
    // PDO::ERRMODE_SILENT: (predeterminado) No genera errores. Debes verificar manualmente si la operación fue exitosa.
    
    // PDO::ERRMODE_WARNING: Genera advertencias, pero no lanza excepciones.
    
    // PDO::ERRMODE_EXCEPTION: Lanza excepciones, lo que permite un manejo más sencillo y efectivo de los errores.
    
    // establecer el modo de error de PDO a excepción es una buena práctica que te ayuda a gestionar los errores de manera más efectiva y a mantener un código más robusto y mantenible.