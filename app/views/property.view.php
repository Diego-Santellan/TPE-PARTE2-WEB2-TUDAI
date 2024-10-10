<?php
class  PropertyView
{
    private $user = null;

    public function __construct($user) {
        $this->user = $user;
    }


    public function showProperties($properties, $owners)
    {
        require_once("./templates/list_properties.phtml");
    }
    
    public function showProperty($property)
    {
        require_once("./templates/list_property.phtml");
    }
    
    public function showError($mjsError)
    {
        require_once("./templates/error.phtml");
    }
}
