<?php namespace core;

require_once CONFIG . 'Conexion.php';

use config\Conexion;
use Exception;

/**
 * Description of BaseDAO
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   28/05/2019
 * 
 */
class BaseDAO extends Conexion {

    private $tabla;
    private $primaryKey;
    private $columnas;
    private $columnasEntity;
    public $conn;

    public function __construct($tabla, $primaryKey) {
        $this->conn = Conexion::conectar();
        $this->tabla = (string) $tabla;
        $this->primaryKey = (array) $primaryKey;
        $this->columnas = (array) self::obtenerColumnas();
    }

    public function getConn() {
        return $this->conn;
    }

    public function obtenerTodo() {     
        $query = "SELECT * FROM $this->tabla ";

        if (!($stmt = $this->conn->prepare($query))) {
            throw new Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$stmt->execute()) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
        return $stmt->fetchAll();
    }

    public function obtenerPorId($id) {
        $query = "SELECT * FROM $this->tabla ". " WHERE " . $this->primaryKey["nombre"] . " = :id ";;

        if (!($stmt = $this->conn->prepare($query))) {
            throw new Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$stmt->bindParam(':id', $id)) {
            throw new Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$stmt->execute()) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
        return $stmt->fetch();
    }
    
     public function obtenerPorVariosId(array $arrayId) {
        $placeholders = str_repeat ('?, ',  count ($arrayId) - 1) . '?';
         
        $query = "SELECT * FROM $this->tabla ". " WHERE " . $this->primaryKey["nombre"] . " in ($placeholders) ";

        if (!($stmt = $this->conn->prepare($query))) {
            throw new Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$stmt->execute($arrayId)) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
        return $stmt->fetchAll();
    }
    

    public function guardar(object $entity) {
        $clavePrimaria = 0;
        $arrayEntity = self::formatearIndicesEntity($entity);
        $arrayKeys = array_keys($arrayEntity);

        $primary = str_replace("_", "",$this->primaryKey["nombre"]);

        if($arrayEntity[$primary] == ""){
           $clavePrimaria = self::consultarId()+1;
           $arrayEntity[$primary] = $clavePrimaria;
        }

        $query = "INSERT INTO " . $this->tabla . " ( ";

        foreach ($this->columnas as $columna) {
            $query .= $columna . ",";
        }
        
        $query = substr_replace($query, " ) ", -1);
        $query .= "VALUES ( ";
        
        foreach ($arrayKeys as $columna) {
            $query .= ":" . $columna . " ,";
        }
        $query = substr_replace($query, ")", -1);
  
        if (!($stmt = $this->conn->prepare($query))) {
            throw new Exception($this->conn->error, $this->conn->errno);
        }

        foreach ($arrayKeys as $columna) {
            if (!$stmt->bindParam(":".$columna, $arrayEntity[$columna])) {
                throw new Exception($this->conn->error, $this->conn->errno);
            }  
        }

        if (!$stmt->execute()) {
            throw new Exception($this->conn->error, $this->conn->errno);
        }
        return $clavePrimaria;
    }

    public function actualizar($id, object $entity) {

        $arrayEntity = self::formatearIndicesEntity($entity);

        $arrayKeys = array_keys($arrayEntity) ;

        $query = "UPDATE $this->tabla SET ";
        $i=0;
        foreach ($this->columnas as $columna) {
            $query .= " $columna = :$arrayKeys[$i], ";
            $i++;
        }
        
        $query = substr_replace($query, "  ", -2);

        $query.= " WHERE ". $this->primaryKey['nombre']." = :id ";
        
        if (!($stmt = $this->conn->prepare($query))) {
            throw new Exception($this->conn->error, $this->conn->errno);
        }

        foreach ($arrayKeys as $columna) {
            if (!$stmt->bindParam(":".$columna, $arrayEntity[$columna])) {
                throw new Exception($this->conn->error, $this->conn->errno);
            }  
        }
        
        if (!$stmt->bindParam(':id', $id)) {
            throw new Exception($this->conn->error, $this->conn->errno);
        }

        if (!$stmt->execute()) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
    }

    public function eliminar($id) {

        $query = "DELETE FROM $this->tabla ". " WHERE " . $this->primaryKey["nombre"] . " = :id ";

        if (!($stmt = $this->conn->prepare($query))) {
            throw new Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$stmt->bindParam(':id', $id)) {
            throw new Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$stmt->execute()) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
    }

    private function obtenerColumnas() {
        $query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = :tabla";

        if (!($stmt = $this->conn->prepare($query))) {
            throw new Exception($this->conn->error, $this->conn->errno);
        }

        if (!$stmt->bindParam(':tabla', $this->tabla)) {
            throw new Exception($this->conn->error, $this->conn->errno);
        }

        $stmt->execute();

        while ($row = $stmt->fetch()) {
            $rows[] = $row;
        }
        return array_column($rows, 'COLUMN_NAME');
    }

    private function formatearIndicesEntity(object $entity) {
        return array_change_key_case(json_decode(json_encode($entity), true), CASE_LOWER);
    }
    
     private function consultarId() {

        $query = "SELECT MAX(". $this->primaryKey['nombre']. ") FROM $this->tabla";
        
        if (!($stmt = $this->conn->prepare($query))) {
            throw new Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$stmt->execute()) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }

        return $stmt->fetch(\PDO::FETCH_NUM)[0];
    }

}
