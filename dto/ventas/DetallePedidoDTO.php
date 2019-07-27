<?php namespace dto\ventas;

use ReflectionClass;

/**
 * Description of DetallePedidoDTO
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   07/07/2019
 * 
 */
class DetallePedidoDTO implements \JsonSerializable  {
    public $idDetallePedido;
    public $descripcion;
    public $cantidad;
    public $precioUnitario;
    public $total;
    public $estado;
    public $producto;
    public $pedido;
    
    public function __construct($json, $serializarDesdeDB) {
        $this->descripcion = $json->descripcion;
        $this->cantidad = $json->cantidad;
        $this->total = $json->total;
        $this->estado = $json->estado;
        
        if($serializarDesdeDB){
            $this->idDetallePedido = $json->id_detalle_pedido;
            $this->precioUnitario = $json->precio_unitario;
            $this->producto = $json->id_producto;
            $this->pedido = $json->id_pedido;
        }
        else{
            $this->idDetallePedido = $json->idDetallePedido;
            $this->precioUnitario = $json->precioUnitario;
            $this->producto = $json->producto->ProductoDTO;
            $this->pedido = $json->pedido->PedidoDTO;
        }
    }

    public function jsonSerialize() {
        return array((new ReflectionClass($this))->getShortName() => get_object_vars($this));
    }
    
}
