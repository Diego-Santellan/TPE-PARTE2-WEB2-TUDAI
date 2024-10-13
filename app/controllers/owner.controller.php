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

        // mando los dueños a la vista 
        return $this->view->showOwner($owner);
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
        header('Location: ' . BASE_URL .'getAllOwners'); /* PARA REDIRIJIR AL HOME UNA VEZ ELIMINADO EL DUEÑO */
        exit();
    }

    public function updateOwner($id)
    {
        $isValid = true;

        // obtengo un dueño de la DB 
        $owner = $this->model->get($id);
        // chequear si existe lo que se quiere modificar  
        if (!$owner) {
            return $this->view->showError("No Existe el dueño con el id: $id .");
        }

        // tomar datos del form ingresados por el usuario y validarlos , funcion importante del contoller 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $name = $_POST['nameOwnerEdit'];
            $phone = $_POST['phoneOwnerEdit'];
            $email = $_POST['emailOwnerEdit'];

            // VALIDACIONES NAME
            // Verificar si el campo existe, no es null, ni vacío
            if (!isset($name) || is_null($name) || trim($name) === '') {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo Nombre es requerido");
            }

            //Validar que el nombre no exceda los 50 caracteres
            if (strlen($name) > 50) {
                $isValid = false;
                return $this->view->showError(mjsError: "El nombre no puede exceder los 50 caracteres");
            }

            // Validar que solo contenga letras y espacios
            if (!preg_match("/^[A-Za-z\s]+$/", $name)) {
                $isValid = false;
                return $this->view->showError(mjsError: "El nombre solo puede contener letras y espacios");
            }

            // VALIDACIONES PHONE
            // Verificar si el campo existe, no es null, ni vacío
            if (!isset($phone) || is_null($phone) || trim($phone) === '') {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo teléfono es requerido");
            }

            //Validar que el teléfono no exceda los 20 caracteres
            if (strlen($phone) > 20) {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo teléfono no puede exceder los 20 caracteres");
            }

            // VALIDACIONES EMAIL
            // Verificar si el campo existe, no es null, ni vacío
            if (!isset($email) || is_null($email) || trim($email) === '') {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo Email es requerido");
            }

            // Validar que el nombre no exceda los 80 caracteres
            if (strlen($email) > 80) {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo Email no puede exceder los 80 caracteres");
            }

            // Validar formato email 
            if (!preg_match("/^[\w\.\-]+@[a-zA-Z\d\-]+\.[a-zA-Z]{2,}$/", $email)) {
                $isValid = false;
                return $this->view->showError(mjsError: "El Email no tiene formato válido");
            }

            if ($isValid) { // si los datos del usuario pasaron todas las validaciones 
                $this->model->update($id, $name, $phone, $email);
                header('Location: ' . BASE_URL .'getAllOwners');
                exit();
            }

        } else {
            return $this->view->showError("Se esperaba se usara el método POST");
        }
    }


    public function addOwner()
    {
        $isValid = true;

        // tomar datos del form ingresados por el usuario y validarlos , funcion importante del contoller 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $name = $_POST['nameOwnerAdd'];
            $phone = $_POST['phoneOwnerAdd'];
            $email = $_POST['emailOwnerAdd'];

            // VALIDACIONES NAME
            // Verificar si el campo existe, no es null, ni vacío
            if (!isset($name) || is_null($name) || trim($name) === '') {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo Nombre es requerido");
            }

            //Validar que el nombre no exceda los 50 caracteres
            if (strlen($name) > 50) {
                $isValid = false;
                return $this->view->showError(mjsError: "El nombre no puede exceder los 50 caracteres");
            }

            // Validar que solo contenga letras y espacios
            if (!preg_match("/^[A-Za-z\s]+$/", $name)) {
                $isValid = false;
                return $this->view->showError(mjsError: "El nombre solo puede contener letras y espacios");
            }

            // VALIDACIONES PHONE
            // Verificar si el campo existe, no es null, ni vacío
            if (!isset($phone) || is_null($phone) || trim($phone) === '') {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo teléfono es requerido");
            }

            //Validar que el teléfono no exceda los 20 caracteres
            if (strlen($phone) > 20) {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo teléfono no puede exceder los 20 caracteres");
            }

            // VALIDACIONES EMAIL
            // Verificar si el campo existe, no es null, ni vacío
            if (!isset($email) || is_null($email) || trim($email) === '') {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo Email es requerido");
            }

            // Validar que el nombre no exceda los 80 caracteres
            if (strlen($email) > 80) {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo Email no puede exceder los 80 caracteres");
            }

            // Validar formato email 
            if (!preg_match("/^[\w\.\-]+@[a-zA-Z\d\-]+\.[a-zA-Z]{2,}$/", $email)) {
                $isValid = false;
                return $this->view->showError(mjsError: "El Email no tiene formato válido");
            }

            if ($isValid) { // si los datos del usuario pasaron todas las validaciones 
                $this->model->add($name, $phone, $email);
                header('Location: ' . BASE_URL .'getAllOwners');
                exit();
            }
        } else {
            return $this->view->showError("Se esperaba se usara el método POST");
        }
    }

    public function showError($error){
        return $this->view->showError($error);
    }
}
