<?php namespace dto\configuracion;

use ReflectionClass;

/**
 * Description of UnidadMedidaDTO
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   24/06/2019
 * 
 */
class UnidadMedidaDTO  implements \JsonSerializable {
    public $idUnidadMedida;
    public $nombre;
    public $nombreCorto;
    public $mnemonico;
    public $descripcion;
    public $activo;

    public function __construct($json , $serializarDesdeDB) {
        
        $this->nombre = $json->nombre;
        $this->mnemonico = $json->mnemonico;
        $this->descripcion = $json->descripcion;
        $this->activo = $json->activo==1?true:false;
        
        if($serializarDesdeDB){
            $this->idUnidadMedida = $json->id_unidad_medida;
            $this->nombreCorto = $json->nombre_corto;
        }
        else{
            $this->idUnidadMedida = $json->idUnidadMedida;
            $this->nombreCorto = $json->nombreCorto;
        }
    }

    public function jsonSerialize() {
        return array((new ReflectionClass($this))->getShortName() => get_object_vars($this));
    }
}
