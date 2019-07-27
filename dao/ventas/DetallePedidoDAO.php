<?php namespace dao\ventas;
require_once CORE.'BaseDao.php';

use core\BaseDAO;

/**
 * Description of DetallePedidoDAO
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   07/07/2019
 * 
 */
class DetallePedidoDAO extends BaseDAO{
    
    const NOMBRE_TABLA = "ven_detalle_pedido";
    const PRIMARY_KEY = [
        "datatype" => "i",
        "nombre" => "id_detalle_pedido",
    ];
    
     public function __construct(){
        parent::__construct(self::NOMBRE_TABLA, self::PRIMARY_KEY);
    }
    
    public function obtenerPorPedido($idPedido){
        $query = "SELECT * FROM ". self::NOMBRE_TABLA. " WHERE ID_PEDIDO = :id_pedido ";

        if (!($stmt = $this->conn->prepare($query))) {
            throw new Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$stmt->bindParam(':id_pedido', $idPedido)) {
            throw new Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$stmt->execute()) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
        return $stmt->fetchAll();
    }
    
    public function eliminarPorPedido($idPedido){
        $query = "DELETE FROM ". self::NOMBRE_TABLA. " WHERE ID_PEDIDO = :id_pedido ";

        if (!($stmt = $this->conn->prepare($query))) {
            throw new Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$stmt->bindParam(':id_pedido', $idPedido)) {
            throw new Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$stmt->execute()) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
    }
    
    public function actualizarEstadoPorId($idDetallePedido, $estado){
        $array = self::PRIMARY_KEY;
        $query = "UPDATE ". self::NOMBRE_TABLA . " SET ESTADO = '$estado' WHERE ". $array['nombre']. " = :ID_DETALLE_PEDIDO";
        if (!($stmt = $this->conn->prepare($query))) {
            throw new Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$stmt->bindParam(':ID_DETALLE_PEDIDO', $idDetallePedido)) {
            throw new Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$stmt->execute()) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
    }
    
    public function actualizarEstadoPorPedido($idPedido, $estado){
        $query = "UPDATE ". self::NOMBRE_TABLA. " SET ESTADO = '$estado' WHERE ID_PEDIDO = :ID_PEDIDO";

        if (!($stmt = $this->conn->prepare($query))) {
            throw new Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$stmt->bindParam(':ID_PEDIDO', $idPedido)) {
            throw new Exception($this->conn->error, $this->conn->errno);
        }

        if (!$stmt->execute()) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
    }
    
}