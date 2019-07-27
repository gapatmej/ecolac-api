<?php namespace entidades\configuracion;

/**
 * Description of UnidadMedida
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   03/06/2019
 * 
 */
class UnidadMedida implements \JsonSerializable{
    
    private $idUnidadMedida;
    private $nombre;
    private $nombreCorto;
    private $mnenonico;
    private $descripcion;
    private $activo;
    
    function getIdUnidadMedida() {
        return $this->idUnidadMedida;
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

    function setIdUnidadMedida($idUnidadMedida) {
        $this->idUnidadMedida = $idUnidadMedida;
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
