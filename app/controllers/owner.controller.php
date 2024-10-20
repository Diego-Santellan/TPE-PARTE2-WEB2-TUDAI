<?php

/* REQUERMIMOS MODELO Y VISTA : el controler es un pasamanos*/
require_once './app/models/owner.model.php';
require_once './app/views/owner.view.php';

//CLASE --> cada componente del MVC es un clase y los metodos lógicos van dentro de cada clase 
class OwnerController
{
    // ATRIBUTOS PRIVADOS
    private $model;
    private $view;

    // CONSTRUCTOR
    public function __construct($res)
    {
        $this->model = new OwnerModel();
        $this->view = new  OwnerView($res->user);
    }

    // MÉTODOS O FUNCIONES DE LA CLASE  
    public function getAllOwners()
    {
        // obtengo los dueños de la DB 
        $owners = $this->model->getAll();

        // mando los dueños a la vista 
        return $this->view->showOwners($owners);
    }

    public function getOwner($id)
    {
        // obtengo un dueños de la DB 
        $owner = $this->model->get($id);
        if ($owner) { // si el id del dueño que pido existe
            // mando los dueños a la vista 
            return $this->view->showOwner($owner);
        } else {
            return $this->view->showError('El con el id: ' . $id . 'no existe');
        }
    }

    public function deleteOwner($id)
    {

        // obtengo un dueño de la DB 
        $owner = $this->model->get($id);

        // chequear si existe lo que se quiere borrar 
        if (!$owner) { //no existe ,retorna null
            return $this->view->showError("No Existe el dueño con el id:. $id .");
        } else if ($this->model->HasProperties($id)) { //buscar si el dueño tiene propiedades
            return $this->view->showError("No es posible eliminar el dueño si  tiene propiedades");
        }

        // no se puede borrar un duenio que tenga propiedades: ebido a una restricción de clave foránea en la db:eliminar una fila de la tabla duenio que está siendo referenciada en la tabla propiedad. La restricción de clave foránea impide la eliminación o actualización de un registro de la tabla duenio porque existen propiedades en la tabla propiedad que dependen de ese registro (id_owner)
        $this->model->delete($id);
        header('Location: ' . BASE_URL . 'owners'); /* PARA REDIRIJIR AL HOME UNA VEZ ELIMINADO EL DUEÑO */
        exit();
    }

    public function updateOwner($id)
    {
        $errors = [];

        // obtengo un dueño de la DB 
        $owner = $this->model->get($id);
        // chequear si existe lo que se quiere modificar  
        if (!$owner) {
            return $this->view->showError("No Existe el dueño con el id: $id .");
        }

        // tomar datos del form ingresados por el usuario y validarlos , funcion importante del contoller        

        // VALIDACIONES NAME
        // Verificar si el campo existe, no es null, ni vacío
        if (!isset($_POST['nameOwnerEdit']) || is_null($_POST['nameOwnerEdit']) || trim($_POST['nameOwnerEdit']) === '') {
            $errors[] = "El campo Nombre es requerido";
        }

        //Validar que el nombre no exceda los 50 caracteres
        if (strlen($_POST['nameOwnerEdit']) > 50) {
            $errors[] = "El nombre no puede exceder los 50 caracteres";
        }

        // Validar que solo contenga letras y espacios
        if (!preg_match("/^[A-Za-z\s]+$/", $_POST['nameOwnerEdit'])) {
            $errors[] = "El nombre sólo puede contener letras y espacios";
        }

        // VALIDACIONES PHONE
        // Verificar si el campo existe, no es null, ni vacío
        if (!isset($_POST['phoneOwnerEdit']) || is_null($_POST['phoneOwnerEdit']) || trim($_POST['phoneOwnerEdit']) === '') {
            $errors[] = "El campo teléfono es requerido";
        }

        //Validar que el teléfono no exceda los 20 caracteres
        if (strlen($_POST['phoneOwnerEdit']) > 20) {
            $errors[] = "El campo teléfono no puede exceder los 20 caracteres";
        }

        // VALIDACIONES EMAIL
        // Verificar si el campo existe, no es null, ni vacío
        if (!isset($_POST['emailOwnerEdit']) || is_null($_POST['emailOwnerEdit']) || trim($_POST['emailOwnerEdit']) === '') {
            $errors[] = "El campo Email es requerido";
        }

        // Validar que  no exceda los 80 caracteres
        if (strlen($_POST['emailOwnerEdit']) > 80) {
            $errors[] = "El campo Email no puede exceder los 80 caracteres";
        }

        // Validar formato email 
        if (!preg_match("/^[\w\.\-]+@[a-zA-Z\d\-]+\.[a-zA-Z]{2,}$/", $_POST['emailOwnerEdit'])) {
            $errors[] = "El Email no tiene formato válido";
        }

        if (count($errors) > 0) { // si los datos del usuario NO pasaron todas las validaciones 
            $errosString = implode(", ", $errors); //convierto el areglo de errores a string

            return $this->view->showError($errosString);
        } else {
            // encapasulamos los datos del form en variables PERO DESPUES DE VALIDARLOS 
            $name = $_POST['nameOwnerEdit'];
            $phone = $_POST['phoneOwnerEdit'];
            $email = $_POST['emailOwnerEdit'];
            
            $this->model->update($id, $name, $phone, $email);
            header('Location: ' . BASE_URL . 'owners');
            exit();
        }
    }


    public function addOwner()
    {
        $errors = [];

        // tomar datos del form ingresados por el usuario y validarlos , funcion importante del contoller 

       
        // VALIDACIONES NAME
        // Verificar si el campo existe, no es null, ni vacío
        if (!isset($_POST['nameOwnerAdd']) || is_null($_POST['nameOwnerAdd']) || trim($_POST['nameOwnerAdd']) === '') {
            $errors[] = "El campo Nombre es requerido";
        }

        //Validar que el nombre no exceda los 50 caracteres
        if (strlen($_POST['nameOwnerAdd']) > 50) {
            $errors[] = "El nombre no puede exceder los 50 caracteres";
        }

        // Validar que solo contenga letras y espacios
        if (!preg_match("/^[A-Za-z\s]+$/", $_POST['nameOwnerAdd'])) {
            $errors[] = "El nombre sólo puede contener letras y espacios";
        }

        // VALIDACIONES PHONE
        // Verificar si el campo existe, no es null, ni vacío
        if (!isset($_POST['phoneOwnerAdd']) || is_null($_POST['phoneOwnerAdd']) || trim($_POST['phoneOwnerAdd']) === '') {
            $errors[] = "El campo teléfono es requerido";
        }

        //Validar que el teléfono no exceda los 20 caracteres
        if (strlen($_POST['phoneOwnerAdd']) > 20) {
            $errors[] = "El campo teléfono no puede exceder los 20 caracteres";
        }

        // VALIDACIONES EMAIL
        // Verificar si el campo existe, no es null, ni vacío
        if (!isset($_POST['emailOwnerAdd']) || is_null($_POST['emailOwnerAdd']) || trim($_POST['emailOwnerAdd']) === '') {
            $errors[] = "El campo Email es requerido";
        }

        // Validar que el nombre no exceda los 80 caracteres
        if (strlen($_POST['emailOwnerAdd']) > 80) {
            $errors[] = "El campo Email no puede exceder los 80 caracteres";
        }

        // Validar formato email 
        if (!preg_match("/^[\w\.\-]+@[a-zA-Z\d\-]+\.[a-zA-Z]{2,}$/", $_POST['emailOwnerAdd'])) {
            $errors[] = "El Email no tiene formato válido";
        }

        if (count($errors) > 0) {
            $errosString = implode(", ", $errors); //convierto el areglo de errores a string
            return $this->view->showError($errosString);
        } else {
            // si los datos del usuario pasaron todas las validaciones LOS GUARDO EN VARIABLES PRIMERO VERIFICAR
            $name = $_POST['nameOwnerAdd'];
            $phone = $_POST['phoneOwnerAdd'];
            $email = $_POST['emailOwnerAdd'];
    
            $id= $this->model->add($name, $phone, $email);

            if(!$id){
                return $this->view->showError('Error en la inserción');
            }

            header('Location: ' . BASE_URL . 'owners');
            exit();
        }
    }

    public function showError($error)
    {
        return $this->view->showError($error);
    }
}
