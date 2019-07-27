<?php namespace entidades\ventas;

/**
 * Description of Pedido
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   26/06/2019
 * 
 */
class Pedido implements \JsonSerializable {
    private $idPedido;
    private $fecha;
    private $estado;
    private $direccion;
    private $ciudad;
    private $telefono;
    private $subtotal;
    private $iva;
    private $total;
    private $idCliente;
    private $idVendedor;
    private $idRepartidor;
    
    function getIdPedido() {
        return $this->idPedido;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getEstado() {
        return $this->estado;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getCiudad() {
        return $this->ciudad;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getSubtotal() {
        return $this->subtotal;
    }

    function getIva() {
        return $this->iva;
    }

    function getTotal() {
        return $this->total;
    }

    function getIdCliente() {
        return $this->idCliente;
    }

    function getIdVendedor() {
        return $this->idVendedor;
    }

    function getIdRepartidor() {
        return $this->idRepartidor;
    }

    function setIdPedido($idPedido) {
        $this->idPedido = $idPedido;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setCiudad($ciudad) {
        $this->ciudad = $ciudad;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setSubtotal($subtotal) {
        $this->subtotal = $subtotal;
    }

    function setIva($iva) {
        $this->iva = $iva;
    }

    function setTotal($total) {
        $this->total = $total;
    }

    function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }

    function setIdVendedor($idVendedor) {
        $this->idVendedor = $idVendedor;
    }

    function setIdRepartidor($idRepartidor) {
        $this->idRepartidor = $idRepartidor;
    }

        public function jsonSerialize() {
        return get_object_vars($this);
    }

}
