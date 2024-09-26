<?php 

/* REQUERMIMOS MODELO Y VISTA : el controler es un pasamanos*/
require_once './app/models/owner.model.php';
require_once './app/views/owner.view.php';

//CLASE --> cada componente del MVC es un clase y los metodos lógicos van dentro de cada clase 
Class OwnerController{
    // ATRIBUTOS PRIVADOS
    private $model;
    private $view;
    
    // CONSTRUCTOR
    public function __construct(){
        $this->model = new OwnerModel();
        $this->view = new  OwnerView();
    }
    
    // MÉTODOS O FUNCIONES DE LA CLASE  
    public function getAllOwners(){
        // obtengo los dueños de la DB 
        $owners = $this->model->getAll();
        
        // mando los dueños a la vista 
        return $this->view->showOwners($owners);
    }
    public function getOwner($id){/* no lo pedia, pero lo hicimos. */
        // obtengo un dueños de la DB 
        $owner = $this->model->get($id);
        
        // mando los dueños a la vista 
        return $this->view->showOwner($owner);
    }

    public function deleteOwner($id){/* no lo pedia, pero lo hicimos. */
        // obtengo un dueños de la DB 
        $owner = $this->model->get($id);
        
        if(!$owner){
            return $this->view->showError("No Existe el dueño con el id:. $id .");
        }

        $this->model->delete($id);
        header('Location'.BASE_URL); /* PARA REDIRIJIR AL HOME UNA VEZ ELIMINADO EL DUEÑO */
        
        // mando los dueños a la vista 
        return $this->view->showOwners($owner);
    }
}