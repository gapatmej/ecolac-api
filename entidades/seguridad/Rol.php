<?php namespace entidades\seguridad;

/**
 * Description of Rol
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   04/06/2019
 * 
 */
class Rol implements \JsonSerializable {
    private $idRol;
    private $nombre;
    private $nombreCorto;
    private $mnemonico;
    private $descripcion;
    private $activo;

    function getIdRol() {
        return $this->idRol;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getNombreCorto() {
        return $this->nombreCorto;
    }

    function getMnemonico() {
        return $this->mnemonico;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setIdRol($idRol) {
        $this->idRol = $idRol;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setNombreCorto($nombreCorto) {
        $this->nombreCorto = $nombreCorto;
    }

    function setMnemonico($mnemonico) {
        $this->mnemonico = $mnemonico;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
    
    function getActivo() {
        return $this->activo;
    }

    function setActivo($activo) {
        $this->activo = $activo;
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}
