<?php namespace entidades\seguridad;

/**
 * Description of UsuarioRol
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   04/06/2019
 * 
 */
class UsuarioRol implements \JsonSerializable {
    private $idUsuarioRol;
    private $username;
    private $idRol;
    
    function getIdUsuarioRol() {
        return $this->idUsuarioRol;
    }

    function getUsername() {
        return $this->username;
    }

    function getIdRol() {
        return $this->idRol;
    }

    function setIdUsuarioRol($idUsuarioRol) {
        $this->idUsuarioRol = $idUsuarioRol;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setIdRol($idRol) {
        $this->idRol = $idRol;
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}
