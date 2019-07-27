<?php namespace dao\seguridad;
require_once CORE.'BaseDao.php';

use core\BaseDAO;
/**
 * Description of UsuarioDAO
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   06/06/2019
 * 
 */
class UsuarioDAO extends BaseDAO{
    
    const NOMBRE_TABLA = "seg_usuario";
    const PRIMARY_KEY = [
        "datatype" => "s",
        "nombre" => "username",
    ];
    
     public function __construct(){
        parent::__construct(self::NOMBRE_TABLA, self::PRIMARY_KEY);
    }
    
    public function obtenerUsuarioPorCredenciales($id, $password){
        $prymaryKey = (array)self::PRIMARY_KEY;
        $query = "SELECT * FROM ". self::NOMBRE_TABLA . " WHERE " . $prymaryKey["nombre"] . " = :id and password = :password";

        if (!($stmt = $this->conn->prepare($query))) {
            throw new Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$stmt->bindParam(':id', $id)) {
            throw new Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$stmt->bindParam(':password', $password)) {
            throw new Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$stmt->execute()) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
        return $stmt->fetch();
    }
    
    public function obtenerUsuariosClientes(){
        $query = "SELECT * FROM ".self::NOMBRE_TABLA."  WHERE ES_CLIENTE = 1";

        if (!($stmt = $this->conn->prepare($query))) {
            throw new Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$stmt->execute()) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
        return $stmt->fetchAll();
    }
    
    public function obtenerRepartidores(){
        $query = "SELECT * FROM ".self::NOMBRE_TABLA."  WHERE ES_REPARTIDOR = 1";

        if (!($stmt = $this->conn->prepare($query))) {
            throw new Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$stmt->execute()) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
        return $stmt->fetchAll();
    }
    
}
