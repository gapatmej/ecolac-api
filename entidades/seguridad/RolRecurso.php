<?php namespace entidades\seguridad;

/**
 * Description of RolRecurso
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   24/06/2019
 * 
 */
class RolRecurso implements \JsonSerializable {
    
    private $idRolRecurso;
    private $idRol;
    private $idRecurso;
    
    function getIdRolRecurso() {
        return $this->idRolRecurso;
    }

    function getIdRol() {
        return $this->idRol;
    }

    function getIdRecurso() {
        return $this->idRecurso;
    }

    function setIdRolRecurso($idRolRecurso) {
        $this->idRolRecurso = $idRolRecurso;
    }

    function setIdRol($idRol) {
        $this->idRol = $idRol;
    }

    function setIdRecurso($idRecurso) {
        $this->idRecurso = $idRecurso;
    }

        
    
     public function jsonSerialize() {
        return get_object_vars($this);
    }

}
