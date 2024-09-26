<?php
require_once './app/models/modelConectDB.php';
// CLASS
class OwnerModel extends ModelConectDB {// Cada modelo hijo hereda de la clase padre la conexion a la DB,seria el paso 1 para no reprtir codigo, la clase apdre abre la conexiona la bd
    
    public function getAll(){
        // 2. Ejecuto la consulta
        $query = $this->db->prepare('SELECT * FROM duenio');
        $query->execute();

        // 3. Obtengo los datos en un arreglo de objetos
        $owners = $query->fetchAll(PDO::FETCH_OBJ);

        return $owners;
    }
    public function get($id)
    {
        // 2. Ejecuto la consulta
        $query = $this->db->prepare('SELECT * FROM duenio WHERE id_owner = ?');
        $query->execute([$id]);

        $owner = $query->fetch(PDO::FETCH_OBJ);

        return $owner;
    }

    public function delete($id)
    {
        // 2. Ejecuto la consulta
        $query = $this->db->prepare('DELETE FROM duenio WHERE id_owner = ?');
        $query->execute([$id]);
    }
}
