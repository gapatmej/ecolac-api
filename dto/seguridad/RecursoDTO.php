<?php namespace dto\seguridad;

use ReflectionClass;

/**
 * Description of RecursoDTO
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   15/06/2019
 * 
 */
class RecursoDTO implements \JsonSerializable {
    public $idRecurso;
    public $nombre;
    public $nombreCorto;
    public $mnemonico;
    public $componente;
    public $descripcion;
    public $url;
    
    public function __construct($json, $serializarDesdeDB ) {
        $this->nombre = $json->nombre;
        $this->mnemonico = $json->mnemonico;
        $this->componente = $json->componente;
        $this->descripcion = $json->descripcion;
        $this->url = $json->url;
        
        if($serializarDesdeDB){
            $this->idRecurso = $json->id_recurso;
            $this->nombreCorto = $json->nombre_corto;
        }
        else{
            $this->idRecurso = $json->idRecurso;
            $this->nombreCorto = $json->nombreCorto;
        }
        
    }
   
     public function jsonSerialize() {
        return array((new ReflectionClass($this))->getShortName() => get_object_vars($this));
    }
}
