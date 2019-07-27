<?php namespace entidades\seguridad;

/**
 * Description of Recursos
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   04/06/2019
 * 
 */
class Recurso implements \JsonSerializable {
    private $idRecurso;
    private $nombre;
    private $nombreCorto;
    private $mnemonico;
    private $componente;
    private $descripcion;
    private $url;
    
    function getIdRecurso() {
        return $this->idRecurso;
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

    function getComponente() {
        return $this->componente;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setIdRecurso($idRecurso) {
        $this->idRecurso = $idRecurso;
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

    function setComponente($componente) {
        $this->componente = $componente;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }
    
    function getUrl() {
        return $this->url;
    }

    function setUrl($url) {
        $this->url = $url;
    }

}
