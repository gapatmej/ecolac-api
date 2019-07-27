<?php namespace entidades\configuracion;

/**
 * Description of Producto
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   26/06/2019
 * 
 */
class Producto implements \JsonSerializable{
    
    private $idProducto;
    private $foto;
    private $nombre;
    private $nombreCorto;
    private $precio;
    private $descripcion;
    private $stock;
    private $atributo1;
    private $atributo2;
    private $activo;
    private $idPresentacionProducto;
    private $idCategoriaProducto;
    private $idLineaProducto;
    
    function getIdProducto() {
        return $this->idProducto;
    }

    function getFoto() {
        return $this->foto;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getNombreCorto() {
        return $this->nombreCorto;
    }

    function getPrecio() {
        return $this->precio;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getStock() {
        return $this->stock;
    }

    function getAtributo1() {
        return $this->atributo1;
    }

    function getAtributo2() {
        return $this->atributo2;
    }

    function getActivo() {
        return $this->activo;
    }

    function getIdPresentacionProducto() {
        return $this->idPresentacionProducto;
    }

    function getIdCategoriaProducto() {
        return $this->idCategoriaProducto;
    }

    function getIdLineaProducto() {
        return $this->idLineaProducto;
    }

    function setIdProducto($idProducto) {
        $this->idProducto = $idProducto;
    }

    function setFoto($foto) {
        $this->foto = $foto;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setNombreCorto($nombreCorto) {
        $this->nombreCorto = $nombreCorto;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setStock($stock) {
        $this->stock = $stock;
    }

    function setAtributo1($atributo1) {
        $this->atributo1 = $atributo1;
    }

    function setAtributo2($atributo2) {
        $this->atributo2 = $atributo2;
    }

    function setActivo($activo) {
        $this->activo = $activo;
    }

    function setIdPresentacionProducto($idPresentacionProducto) {
        $this->idPresentacionProducto = $idPresentacionProducto;
    }

    function setIdCategoriaProducto($idCategoriaProducto) {
        $this->idCategoriaProducto = $idCategoriaProducto;
    }

    function setIdLineaProducto($idLineaProducto) {
        $this->idLineaProducto = $idLineaProducto;
    }
    
    public function jsonSerialize() {
        return get_object_vars($this);
    }
   
}
