<?php namespace entidades\configuracion;

/**
 * Description of CategoriaProducto
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   26/06/2019
 * 
 */
class CategoriaProducto implements \JsonSerializable{
    
    private $idCategoriaProducto;
    private $nombre;
    private $nombreCorto;
    private $mnenonico;
    private $descripcion;
    private $activo;
    
    function getIdCategoriaProducto() {
        return $this->idCategoriaProducto;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getNombreCorto() {
        return $this->nombreCorto;
    }

    function getMnenonico() {
        return $this->mnenonico;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getActivo() {
        return $this->activo;
    }

    function setIdCategoriaProducto($idCategoriaProducto) {
        $this->idCategoriaProducto = $idCategoriaProducto;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setNombreCorto($nombreCorto) {
        $this->nombreCorto = $nombreCorto;
    }

    function setMnenonico($mnenonico) {
        $this->mnenonico = $mnenonico;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setActivo($activo) {
        $this->activo = $activo;
    }

       
    
    public function jsonSerialize() {
        return get_object_vars($this);
    }

}
