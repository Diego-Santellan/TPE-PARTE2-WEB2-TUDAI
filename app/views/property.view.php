<?php
class  PropertyView
{
    private $user = null;

    public function __construct($user) {
        $this->user = $user;
    }


    public function showProperties($properties, $owners)
    {        
        require_once("./templates/list_properties.phtml");//lista todas las propiedades y les pasa los oenwer y las propiedades qe recibe del controller
    }
    
    public function showProperty($property, $owner)
    {
        require_once("./templates/list_property.phtml");//lista una 
    }
    
    public function showError($mjsError)
    {
        require_once("./templates/error.phtml");
    }
}
