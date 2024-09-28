<?php
require_once './app/models/modelConectDB.php';
// CLASS
class PropertyModel extends ModelConectDB
{ // Cada modelo hijo hereda de la clase padre la conexion a la DB,seria el paso 1 para no reprtir codigo, la clase padre abre la conexion a la bd

    public function getAll()
    {
        // 2. Ejecuto la consulta
        $query = $this->db->prepare('SELECT * FROM propiedad');
        $query->execute();

        // 3. Obtengo los datos en un arreglo de objetos
        $properties = $query->fetchAll(PDO::FETCH_OBJ);

        return $properties;
    }

    public function get($id)
    {
        // 2. Ejecuto la consulta
        $query = $this->db->prepare('SELECT * FROM propiedad WHERE id_property = ?');
        $query->execute([$id]);

        // 3. Obtengo los datos en un arreglo de objetos
        $property = $query->fetch(PDO::FETCH_OBJ);

        return $property; // Si no encuentra ningún registro en la base de datos con el ID proporcionado, fetch() devolverá false.
    }

    public function delete($id)
    {
        // 2. Ejecuto la consulta
        $query = $this->db->prepare('DELETE FROM propiedad WHERE id_property = ?');
        $query->execute([$id]);
    }
    public function update($id_property, $type, $zone, $price, $description, $mode, $status, $city, $id_owner)
    {
        // 2. Ejecuto la consulta Modificar registros de una tabla en 2 pasos apra evitar la inyeccion de datos          
        $query = $this->db->prepare('UPDATE propiedad SET  type = ?, zone = ?, price = ?, description = ?, mode = ?, status = ?, city = ?, id_owner = ? WHERE id_property = ?');
        $query->execute([$type, $zone, $price, $description, $mode, $status, $city, $id_owner, $id_property]);
    }

    public function add($type, $zone, $price, $description, $mode, $status, $city, $id_owner)
    {
        // 2. Ejecuto la consulta insertar registros de una tabla en 2 pasos apra evitar la inyeccion de datos          
        $query = $this->db->prepare('INSERT INTO propiedad (type, zone, price, description, mode, status, city, id_owner) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');

        $query->execute([$type, $zone, $price, $description, $mode, $status, $city, $id_owner]);
        $id = $this->db->lastInsertId();

        return $id;
    }
}