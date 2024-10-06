<?php
require_once './app/models/modelConectDB.php';

class UserModel extends ModelConectDB {
    public function getUserByUsername($username) {    
        $query = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $query->execute([$username]);
    
        $user = $query->fetch(PDO::FETCH_OBJ);
    
        return $user;//te da el obejto usuario con sus propiedades(cols de la DB)
    }
    public function addUser($username, $passwordHash){

        $query = $this->db->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
        $query->execute([$username, $passwordHash]);
        
        $id = $this->db->lastInsertId();
        return $id;
    }

}