<?php namespace dto\configuracion;

use ReflectionClass;


/**
 * Description of LineaProductoDTO
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   26/06/2019
 * 
 */
class LineaProductoDTO implements \JsonSerializable {
    public $idLineaProducto;
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
            $this->idLineaProducto = $json->id_linea_producto;
            $this->nombreCorto = $json->nombre_corto;
        }
        else{
            $this->idLineaProducto = $json->idLineaProducto;
            $this->nombreCorto = $json->nombreCorto;
        }
    }

    public function jsonSerialize() {
        return array((new ReflectionClass($this))->getShortName() => get_object_vars($this));
    }
}