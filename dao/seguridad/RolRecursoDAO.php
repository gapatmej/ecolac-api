<?php namespace dao\seguridad;

require_once CORE.'BaseDao.php';

use core\BaseDAO;

/**
 * Description of RolRecursoDAO
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   15/06/2019
 * 
 */
class RolRecursoDAO extends BaseDAO{
    const NOMBRE_TABLA = "seg_rol_recurso";
    const PRIMARY_KEY = [
        "datatype" => "i",
        "nombre" => "id_rol_recurso",
    ];
    
     public function __construct(){
        parent::__construct(self::NOMBRE_TABLA, self::PRIMARY_KEY);
    }
    
    public function obtenerRecursosPorRol($idRol){
        $query = "SELECT id_recurso FROM ". self::NOMBRE_TABLA . " WHERE id_rol = :idRol";
        
        if (!($stmt = $this->conn->prepare($query))) {
            throw new Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$stmt->bindParam(':idRol', $idRol)) {
            throw new Exception($this->conn->error, $this->conn->errno);
        }
       
        if (!$stmt->execute()) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }

        return $stmt->fetchAll();
    }
    
    public function obtenerRolRecursoPorRol($idRol){
        $query = "SELECT id_rol_recurso FROM ". self::NOMBRE_TABLA . " WHERE id_rol = :idRol";
        
        if (!($stmt = $this->conn->prepare($query))) {
            throw new Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$stmt->bindParam(':idRol', $idRol)) {
            throw new Exception($this->conn->error, $this->conn->errno);
        }
       
        if (!$stmt->execute()) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }

        return $stmt->fetchAll();
    }
}
