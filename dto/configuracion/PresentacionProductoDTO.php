<?php namespace dto\configuracion;

use ReflectionClass;

/**
 * Description of PresentacionProductoCTO
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   24/06/2019
 * 
 */
class PresentacionProductoDTO implements \JsonSerializable {
    public $idPresentacionProducto;
    public $nombre;
    public $nombreCorto;
    public $mnemonico;
    public $descripcion;
    public $activo;
    public $unidadMedida;

    public function __construct($json , $serializarDesdeDB) {
        
        $this->nombre = $json->nombre;
        $this->mnemonico = $json->mnemonico;
        $this->descripcion = $json->descripcion;
        $this->activo = $json->activo==1?true:false;
        
        if($serializarDesdeDB){
            $this->idPresentacionProducto = $json->id_presentacion_producto;
            $this->nombreCorto = $json->nombre_corto;
            $this->unidadMedida = $json->id_unidad_medida;
        }
        else{
            $this->idPresentacionProducto = $json->idPresentacionProducto;
            $this->nombreCorto = $json->nombreCorto;
            $this->unidadMedida = $json->unidadMedida;
        }
        
        
    }

    public function jsonSerialize() {
        return array((new ReflectionClass($this))->getShortName() => get_object_vars($this));
    }
}