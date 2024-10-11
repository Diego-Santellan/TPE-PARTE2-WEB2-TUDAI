<?php

/* REQUERMIMOS MODELO Y VISTA : el controler es un pasamanos*/
require_once './app/models/property.model.php';
require_once './app/models/owner.model.php';
require_once './app/views/property.view.php';

//CLASE --> cada componente del MVC es un clase y los metodos lógicos van dentro de cada clase 
class PropertyController
{
    // ATRIBUTOS PRIVADOS
    private $model;
    private $modelOwner;
    private $view;

    // estas opciones podrian estar dese una db o archivo 
    private $optionsTypeProperty = ["house", "apartament", "lot", "countryHouse"];
    private $optionsModeProperty = ["sell", "rent"];
    private $optionsStatusProperty = ["sold", "rented", "available"];

    // CONSTRUCTOR
    public function __construct($res)
    {
        // este controler requiere dos modelos (propiedads y owner)
        $this->model = new PropertyModel();
        $this->modelOwner = new OwnerModel();
        $this->view = new PropertyView($res->user);
    }

    // MÉTODOS O FUNCIONES DE LA CLASE  

    public function getAllProperties()
    {
        // obtengo las propiedades de la DB 
        $properties = $this->model->getAll();
        //uso el modelo de owners para traer todos los dueños
        $owners = $this->modelOwner->getAll();
        // mando las propiedades a la vista y todos los dueños
        return $this->view->showProperties($properties, $owners);
    }


    public function getAllPropertiesForOwner()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            $optionFilterId = $_GET['filterOwner']; //guardo el valor selecciondo por el us

            // obtengo todas las propiedades de la DB 
            $properties = $this->model->getPropertiesForOwner($optionFilterId);
            //uso el modelo de owners para traer todos los dueños
            $owners = $this->modelOwner->getAll();
            // mando las propiedades a la vista y todos los dueños
            return $this->view->showProperties($properties, $owners);
        } else {
            return $this->view->showError("Se esperaba se usara el método GET");
        }
    }

    public function getProperty($id)
    {/* no lo pedia, pero lo hicimos. */
        // obtengo una propiedad de la DB 
        $property = $this->model->get($id);

        // mando la propiedad a la vista 
        return $this->view->showProperty($property);
    }

    public function deleteProperty($id)
    {

        // obtengo una propiedad de la DB 
        $property = $this->model->get($id);

        // chequear si existe lo que se quiere borrar 
        if (!$property) { //no existe ,retorna null
            return $this->view->showError("No Existe la propiedad con el id: $id ");
        } //se puede eliminar una propiedad si tiene duenio, no se puede al revés ? es asi?


        $this->model->delete($id);
        header('Location: ' . BASE_URL . '/getAllProperties'); /* PARA REDIRIJIR AL HOME UNA VEZ ELIMINADA  la propiedad */
        exit();
    }

    public function updateProperty($id)
    {
        $isValid = true;

        // obtengo un propiedad de la DB 
        $property = $this->model->get($id);
        // chequear si existe lo que se quiere modificar  
        if (!$property) {
            return $this->view->showError("No Existe la propiedad con el id: $id ");
        }

        // tomar datos del form ingresados por el usuario y validarlos , funcion importante del contoller 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $type = $_POST['typePropertyEdit'];//name del formulario 
            $zone = $_POST['zonePropertyEdit'];
            $price = intval($_POST['pricePropertyEdit']); //quedarse sólo con la parte entera 
            $description = $_POST['descriptionPropertyEdit'];
            $mode = $_POST['modePropertyEdit'];
            $status = $_POST['statusPropertyEdit'];
            $city = $_POST['cityPropertyEdit'];
            $id_owner = $_POST['id_ownerPropertyEdit'];

            // VALIDACIONES TYPE
            // Verificar si el campo existe, no es null, ni vacío
            if (!isset($type) || is_null($type) || trim($type) === '') {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo tipo es requerido");
            }
            //verificar si ingresa una opcion no valida en el select del input type 
            if (!$this->validOption($type, $this->optionsTypeProperty)) {
                $isValid = false;
                return $this->view->showError(mjsError: "No seleccionó una opción válida para el campo tipo");
            }
            //Validar que el tipo no exceda los 20 caracteres
            if (strlen($type) > 20) {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo tipo no puede exceder los 20 caracteres");
            }
            // Validar que sólo contenga letras y espacios
            if (!preg_match("/^[A-Za-z\s]+$/", $type)) {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo tipo sólo puede contener letras y espacios");
            }

            // VALIDACIONES ZONE
            // Verificar si el campo existe, no es null, ni vacío
            if (!isset($zone) || is_null($zone) || trim($zone) === '') {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo zona es requerido");
            }
            //Validar que el zone no exceda los 45 caracteres
            if (strlen($zone) > 45) {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo zona no puede exceder los 45 caracteres");
            }
            // validar que sean letras, espacios o números
            if (!preg_match("/^[a-zA-Z0-9\s]+$/", $zone)) {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo zona solo admite letras, espacios o números");
            }



            // *********    VALIDACIONES PRECIO     *********//
            // Verificar si el campo existe, no es null, ni vacío
            if (!isset($price) || is_null($price) || trim($price) === '') {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo precio es requerido");
            }
            //Validar que sea un número comprendido en un rango validos y que tenga un máximo de 10 dígitos
            if ($price < 0 || $price > 9999999999) {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo precio esta fuera de rango, tiene que ser mayor a 0 y tener un maximo de 10 digitos.");
            }



            // *********     VALIDACIONES DESCRIPTION   *********//
            // que la descripcion sea requerida
            if (!isset($description) || is_null($description) || trim($description) === '') {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo descripción  es requerido");
            }
            // Validar que la descripción no exceda los 500 caracteres
            if (strlen($description) > 500) {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo descripción no puede exceder los 500 caracteres");
            }



            //*********     VALIDACIONES MODE   *********//
            // que la modo sea requerida
            if (!isset($mode) || is_null($mode) || trim($mode) === '') {
                $isValid = false;
                return $this->view->showError(mjsError: "El modo es requerido");
            }
            //verificar si ingresa una opcion no valida en el select del input MODE 
            if (!$this->validOption($mode, $this->optionsModeProperty)) {
                $isValid = false;
                return $this->view->showError(mjsError: "No seleccionó una opción válida para el campo mode");
            }
            //Validar que el modo no exceda los 20 caracteres
            if (strlen($mode) > 20) {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo zona no puede exceder los 20 caracteres");
            }
            // Validar que sólo contenga letras y espacios
            if (!preg_match("/^[A-Za-z\s]+$/", $mode)) {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo tipo sólo puede contener letras y espacios");
            }



            //*********     VALIDACIONES STATUS     *********//
            // que la status sea requerida
            if (!isset($status) || is_null($status) || trim($status) === '') {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo estado es requerido");
            }
            //Validar que el status no exceda los 20 caracteres
            if (strlen($status) > 20) {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo estado no puede exceder los 20 caracteres");
            }
            //verificar si ingresa una opcion no valida en el select del input status 
            if (!$this->validOption($status, $this->optionsStatusProperty)) {
                $isValid = false;
                return $this->view->showError(mjsError: "No seleccionó una opción válida para el campo estado");
            }
            // Validar que sólo contenga letras y espacios
            if (!preg_match("/^[A-Za-z\s]+$/", $status)) {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo estado sólo puede contener letras y espacios");
            }



            //*********     VALIDACIONES CITY     *********//
            // que la status sea requerida
            if (!isset($city) || is_null($city) || trim($city) === '') {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo ciudad es requerido");
            }
            //Validar que ciyu no exceda los 45 caracteres
            if (strlen($city) > 45) {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo ciudad no puede exceder los 45 caracteres");
            }
            // Validar que sólo contenga letras y espacios
            if (!preg_match("/^[A-Za-z\s]+$/", $city)) {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo ciudad sólo puede contener letras y espacios");
            }



            //*********     VALIDACIONES ID_OWNER     *********//





            if ($isValid) { // si los datos del usuario pasaron todas las validaciones 
                $this->model->update($id, $type, $zone, $price, $description, $mode, $status, $city, $id_owner);
                header(header: 'Location: ' . BASE_URL . '/getAllProperties');
                exit();
            }
            return  $this->getAllproperties();
        } else {
            return $this->view->showError("Se esperaba se usara el método POST");
        }
    }

    // chequear si la opción ingresada por el usuario es un valor para el select valido , le paso el campo y los valores posibles 
    public function validOption($field, $optionsField)
    {
        $valid = false;
        for ($i = 0; $i < count($optionsField); $i++) {
            if ($optionsField[$i] == $field) {
                $valid = true;
            }
        }
        return $valid;
    }
    public function addProperty()
    {
        $isValid = true;

        // tomar datos del form ingresados por el usuario y validarlos , funcion importante del contoller 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $type = $_POST['typePropertyAdd'];
            $zone = $_POST['zonePropertyAdd'];
            $price = intval($_POST['pricePropertyAdd']); //quedarse solo con la parte entera 
            $description = $_POST['descriptionPropertyAdd'];
            $mode = $_POST['modePropertyAdd'];
            $status = $_POST['statusPropertyAdd'];
            $city = $_POST['cityPropertyAdd'];
            $id_owner = $_POST['id_ownerPropertyAdd'];

            // VALIDACIONES TYPE
            // Verificar si el campo existe, no es null, ni vacío
            if (!isset($type) || is_null($type) || trim($type) === '') {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo tipo es requerido");
            }
            //verificar si ingresa una opcion no valida en el select del input type 
            if (!$this->validOption($type, $this->optionsTypeProperty)) {
                $isValid = false;
                return $this->view->showError(mjsError: "No seleccionó una opción válida para el campo tipo");
            }
            //Validar que el tipo no exceda los 20 caracteres
            if (strlen($type) > 20) {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo tipo no puede exceder los 20 caracteres");
            }
            // Validar que sólo contenga letras y espacios
            if (!preg_match("/^[A-Za-z\s]+$/", $type)) {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo tipo sólo puede contener letras y espacios");
            }

            // VALIDACIONES ZONE
            // Verificar si el campo existe, no es null, ni vacío
            if (!isset($zone) || is_null($zone) || trim($zone) === '') {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo zona es requerido");
            }
            //Validar que no exceda los 45 caracteres
            if (strlen($zone) > 45) {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo zona no puede exceder los 45 caracteres");
            }
            // validar que sean letras, espacios o números
            if (!preg_match("/^[a-zA-Z0-9\s]+$/", $zone)) {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo sólo admite letras, espacios o números");
            }


            // *********    VALIDACIONES PRECIO     *********//
            // Verificar si el campo existe, no es null, ni vacío
            if (!isset($price) || is_null($price) || trim($price) === '') {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo precio es requerido");
            }
            //Validar que sea un número comprendido en un rango validos y que tenga un máximo de 10 dígitos
            if ($price < 0 || $price > 9999999999) {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo precio esta fuera de rango, tiene que ser mayor a 0 y tener un maximo de 10 digitos.");
            }



            // *********     VALIDACIONES DESCRIPTION   *********//
            // que la descripcion sea requerida
            if (!isset($description) || is_null($description) || trim($description) === '') {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo descripción es requerido");
            }
            // Validar que la descripción no exceda los 500 caracteres
            if (strlen($description) > 500) {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo descripción no puede exceder los 500 caracteres");
            }



            //*********     VALIDACIONES MODE   *********//
            // que la modo sea requerida
            if (!isset($mode) || is_null($mode) || trim($mode) === '') {
                $isValid = false;
                return $this->view->showError(mjsError: "El modo es requerido");
            }
            //verificar si ingresa una opcion no valida en el select del input MODE 
            if (!$this->validOption($mode, $this->optionsModeProperty)) {
                $isValid = false;
                return $this->view->showError(mjsError: "No seleccionó una opción válida para el campo mode");
            }
            //Validar que el modo no exceda los 20 caracteres
            if (strlen($mode) > 20) {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo zona no puede exceder los 20 caracteres");
            }
            // Validar que sólo contenga letras y espacios
            if (!preg_match("/^[A-Za-z\s]+$/", $mode)) {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo tipo sólo puede contener letras y espacios");
            }



            //*********     VALIDACIONES STATUS     *********//
            // que la status sea requerida
            if (!isset($status) || is_null($status) || trim($status) === '') {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo estado es requerido");
            }
            //Validar que el status no exceda los 20 caracteres
            if (strlen($status) > 20) {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo estado no puede exceder los 20 caracteres");
            }
            //verificar si ingresa una opcion no valida en el select del input MODE 
            if (!$this->validOption($status, $this->optionsStatusProperty)) {
                $isValid = false;
                return $this->view->showError(mjsError: "No seleccionó una opción válida para el campo estado");
            }
            // Validar que sólo contenga letras y espacios
            if (!preg_match("/^[A-Za-z\s]+$/", $status)) {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo estado sólo puede contener letras y espacios");
            }



            //*********     VALIDACIONES CITY     *********//
            // que la status sea requerida
            if (!isset($city) || is_null($city) || trim($city) === '') {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo ciudad es requerido");
            }
            //Validar que ciyu no exceda los 45 caracteres
            if (strlen($city) > 45) {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo ciudad no puede exceder los 45 caracteres");
            }
            // Validar que sólo contenga letras y espacios
            if (!preg_match("/^[A-Za-z\s]+$/", $city)) {
                $isValid = false;
                return $this->view->showError(mjsError: "El campo ciudad sólo puede contener letras y espacios");
            }



            //*********     VALIDACIONES ID_OWNER     *********//
            if ($isValid) { // si los datos del usuario pasaron todas las validaciones 
                $this->model->add($type, $zone, $price, $description, $mode, $status, $city, $id_owner);
                header('Location: ' . BASE_URL . '/getAllProperties');
                exit();
            }
        } else {
            return $this->view->showError("Se esperaba se usara el método POST");
        }
    }

    public function showError($error)
    {
        return $this->view->showError($error);
    }
}
