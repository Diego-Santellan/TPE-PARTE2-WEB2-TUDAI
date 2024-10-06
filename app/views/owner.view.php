<?php
class  OwnerView
{
    
    public function showOwners($owners){
        require_once './templates/list_owners.phtml';
    }
    public function showOwner($owner)
    {
        require_once './templates/list_owner.phtml';   
        
    }
    public function showError($mjsError)
    {
        require_once './templates/error.owner.phtml';  
}
}