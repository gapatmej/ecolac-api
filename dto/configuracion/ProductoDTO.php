<?php namespace dto\configuracion;

use ReflectionClass;

/**
 * Description of ProductoDTO
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   26/06/2019
 * 
 */
class ProductoDTO implements \JsonSerializable {
    public $idProducto;
    public $foto;
    public $nombre;
    public $nombreCorto;
    public $precio;
    public $descripcion;
    public $stock;
    public $atributo1;
    public $atributo2;
    public $activo;
    public $presentacionProducto;
    public $categoriaProducto;
    public $lineaProducto;

    public function __construct($json , $serializarDesdeDB) {
        
        $this->foto = $json->foto;
        $this->nombre = $json->nombre;
      //  $this->precio = number_format($json->precio, 2, ',', '.');
        $this->precio = $json->precio;
        $this->descripcion = $json->descripcion;
        $this->stock = $json->stock;
        $this->atributo1 = $json->atributo1;
        $this->atributo2 = $json->atributo2;
        $this->activo = $json->activo==1?true:false;
        
        if($serializarDesdeDB){
            $this->idProducto = $json->id_producto;
            $this->nombreCorto = $json->nombre_corto;
            $this->presentacionProducto = $json->id_presentacion_producto;
            $this->categoriaProducto = $json->id_categoria_producto;
            $this->lineaProducto = $json->id_linea_producto;
        }
        else{
            $this->idProducto = $json->idProducto;
            $this->nombreCorto = $json->nombreCorto;
            $this->presentacionProducto = $json->presentacionProducto;
            $this->categoriaProducto = $json->categoriaProducto;
            $this->lineaProducto = $json->lineaProducto;
        }
        
        
    }

    public function jsonSerialize() {
        return array((new ReflectionClass($this))->getShortName() => get_object_vars($this));
    }
}