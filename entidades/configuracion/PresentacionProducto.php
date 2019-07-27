<?php namespace entidades\configuracion;

/**
 * Description of PresentacionProducto
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   24/06/2019
 * 
 */
class PresentacionProducto implements \JsonSerializable{
    
    private $idPresentacionProducto;
    private $nombre;
    private $nombreCorto;
    private $mnenonico;
    private $descripcion;
    private $activo;
    private $idUnidadMedida;
    
    function getIdPresentacionProducto() {
        return $this->idPresentacionProducto;
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

    function getIdUnidadMedida() {
        return $this->idUnidadMedida;
    }

    function setIdPresentacionProducto($idPresentacionProducto) {
        $this->idPresentacionProducto = $idPresentacionProducto;
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

    function setIdUnidadMedida($idUnidadMedida) {
        $this->idUnidadMedida = $idUnidadMedida;
    }

        
    public function jsonSerialize() {
        return get_object_vars($this);
    }
    
}
