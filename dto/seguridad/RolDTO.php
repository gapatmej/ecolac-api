<?php namespace dto\seguridad;

use ReflectionClass;

/**
 * Description of RolDTO
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   15/06/2019
 * 
 */
class RolDTO implements \JsonSerializable {

    public $idRol;
    public $nombre;
    public $nombreCorto;
    public $mnemonico;
    public $descripcion;
    public $activo;
    public $recursos;

    public function __construct($json , $serializarDesdeDB) {
        
        $this->nombre = $json->nombre;
        $this->mnemonico = $json->mnemonico;
        $this->descripcion = $json->descripcion;
        $this->activo = $json->activo==1?true:false;
        
        if($serializarDesdeDB){
            $this->idRol = $json->id_rol;
            $this->nombreCorto = $json->nombre_corto;
        }
        else{
            $this->idRol = $json->idRol;
            $this->nombreCorto = $json->nombreCorto;
        }
        $this->recursos = $json->recursos;
    }

    public function jsonSerialize() {
        return array((new ReflectionClass($this))->getShortName() => get_object_vars($this));
    }

}
