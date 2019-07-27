<?php namespace dto\ventas;

use ReflectionClass;

/**
 * Description of PedidoDTO
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   26/06/2019
 * 
 */
class PedidoDTO implements \JsonSerializable  {
    public $idPedido;
    public $fecha;
    public $estado;
    public $direccion;
    public $ciudad;
    public $telefono;
    public $subtotal;
    public $iva;
    public $total;
    public $cliente;
    public $vendedor;
    public $repartidor;
    public $detallesPedido;
    
    public function __construct($json, $serializarDesdeDB) {
        $this->fecha = $json->fecha;
        $this->estado = $json->estado;
        $this->direccion = $json->direccion;
        $this->ciudad = $json->ciudad;
        $this->telefono = $json->telefono;
        $this->subtotal = $json->subtotal;
        $this->iva = $json->iva;
        $this->total = $json->total;

        if($serializarDesdeDB){
            $this->idPedido = $json->id_pedido;
            $this->cliente = $json->id_cliente;
            $this->vendedor = $json->id_vendedor;
            $this->repartidor = $json->id_repartidor;
            
        }
        else{
            $this->idPedido = $json->idPedido;
            $this->cliente = $json->cliente;
            $this->vendedor = $json->vendedor;
            $this->repartidor = $json->idRepartidor;
        }
        
        $this->detallesPedido = $json->detallesPedido;
        
    }

    public function jsonSerialize() {
        return array((new ReflectionClass($this))->getShortName() => get_object_vars($this));
    }
}
