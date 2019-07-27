<?php namespace dao\configuracion;
require_once CORE.'BaseDao.php';

use core\BaseDAO;

/**
 * Description of Producto
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   26/06/2019
 * 
 */
class ProductoDAO extends BaseDAO {
    const NOMBRE_TABLA = "con_producto";
    const PRIMARY_KEY = [
        "datatype" => "s",
        "nombre" => "id_producto",
    ];
    
     public function __construct(){
        parent::__construct(self::NOMBRE_TABLA, self::PRIMARY_KEY);
    }
    
    public function obtenerProductosVendidos($username){
        $arrayKey = self::PRIMARY_KEY;
        $query = "SELECT CP.*, SUM(VD.CANTIDAD) cantidad_vendida FROM ". self::NOMBRE_TABLA. " CP, " 
                ."VEN_PEDIDO VP, VEN_DETALLE_PEDIDO VD "
                ."WHERE CP.".$arrayKey["nombre"]." = VD.".$arrayKey["nombre"]." "
                ."AND VD.ID_PEDIDO = VP.ID_PEDIDO "
                ."AND VP.ID_VENDEDOR = :ID_VENDEDOR "
                ."GROUP BY CP.".$arrayKey["nombre"];

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
    
}