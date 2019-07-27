<?php namespace dao\ventas;
require_once CORE.'BaseDao.php';

use core\BaseDAO;

/**
 * Description of PedidoDAO
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   26/06/2019
 * 
 */
class PedidoDAO extends BaseDAO{
    
    const NOMBRE_TABLA = "ven_pedido";
    const PRIMARY_KEY = [
        "datatype" => "i",
        "nombre" => "id_pedido",
    ];
    
     public function __construct(){
        parent::__construct(self::NOMBRE_TABLA, self::PRIMARY_KEY);
    }
    
    public function obtenerPedidosCliente($username){
        $query = "SELECT * FROM ". self::NOMBRE_TABLA. " WHERE ID_CLIENTE = :ID_CLIENTE ";

        if (!($stmt = $this->conn->prepare($query))) {
            throw new Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$stmt->bindParam(':ID_CLIENTE', $username)) {
            throw new Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$stmt->execute()) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
        return $stmt->fetchAll();
    }
    
    public function obtenerPedidosVendedor($username){
        $query = "SELECT * FROM ". self::NOMBRE_TABLA. " WHERE ID_VENDEDOR = :ID_VENDEDOR ";

        if (!($stmt = $this->conn->prepare($query))) {
            throw new Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$stmt->bindParam(':ID_VENDEDOR', $username)) {
            throw new Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$stmt->execute()) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
        return $stmt->fetchAll();
    }
    
    public function obtenerPedidosRepartidor($username){
        $query = "SELECT * FROM ". self::NOMBRE_TABLA. " WHERE ID_REPARTIDOR = :ID_REPARTIDOR ";

        if (!($stmt = $this->conn->prepare($query))) {
            throw new Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$stmt->bindParam(':ID_REPARTIDOR', $username)) {
            throw new Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$stmt->execute()) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
        return $stmt->fetchAll();
    }
    
    public function actualizarEstado($idPedido, $estado){
        $array = self::PRIMARY_KEY;
        $query = "UPDATE ". self::NOMBRE_TABLA. " SET ESTADO = '$estado' WHERE ". $array["nombre"]. " = :ID_PEDIDO";

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