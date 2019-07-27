<?php namespace dao\seguridad;

require_once CORE.'BaseDao.php';

use core\BaseDAO;
/**
 * Description of UsuarioRol
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   15/06/2019
 * 
 */
class UsuarioRolDAO extends BaseDAO {
    const NOMBRE_TABLA = "seg_usuario_rol";
    const PRIMARY_KEY = [
        "datatype" => "i",
        "nombre" => "id_usuario_rol",
    ];
    
     public function __construct(){
        parent::__construct(self::NOMBRE_TABLA, self::PRIMARY_KEY);
    }
    
     public function obtenerRolesPorUsuario($username){
        $query = "SELECT id_rol FROM ". self::NOMBRE_TABLA . " WHERE USERNAME = :username";
        
        if (!($stmt = $this->conn->prepare($query))) {
            throw new Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$stmt->bindParam(':username', $username)) {
            throw new Exception($this->conn->error, $this->conn->errno);
        }
       
        if (!$stmt->execute()) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }

        return $stmt->fetchAll();
    }
    
    public function obtenerUsuarioRolPorUsuario($username){
        $query = "SELECT id_usuario_rol FROM ". self::NOMBRE_TABLA . " WHERE USERNAME = :username";
        
        if (!($stmt = $this->conn->prepare($query))) {
            throw new Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$stmt->bindParam(':username', $username)) {
            throw new Exception($this->conn->error, $this->conn->errno);
        }
       
        if (!$stmt->execute()) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }

        return $stmt->fetchAll();
    }
}
