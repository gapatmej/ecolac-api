<?php namespace entidades\ventas; 
 

/**
 * Description of DetallePedido
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   26/06/2019
 * 
 */
class DetallePedido implements \JsonSerializable{
    private $idDetallePedido;
    private $descripcion;
    private $cantidad;
    private $precioUnitario;
    private $total;
    private $estado;
    private $idProducto;
    private $idPedido;
    
    function getIdDetallePedido() {
        return $this->idDetallePedido;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getCantidad() {
        return $this->cantidad;
    }

    function getPrecioUnitario() {
        return $this->precioUnitario;
    }

    function getTotal() {
        return $this->total;
    }

    function getEstado() {
        return $this->estado;
    }

    function getIdProducto() {
        return $this->idProducto;
    }

    function getIdPedido() {
        return $this->idPedido;
    }

    function setIdDetallePedido($idDetallePedido) {
        $this->idDetallePedido = $idDetallePedido;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    function setPrecioUnitario($precioUnitario) {
        $this->precioUnitario = $precioUnitario;
    }

    function setTotal($total) {
        $this->total = $total;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setIdProducto($idProducto) {
        $this->idProducto = $idProducto;
    }

    function setIdPedido($idPedido) {
        $this->idPedido = $idPedido;
    }

    

    
    public function jsonSerialize() {
        return get_object_vars($this);
    }
    
}
