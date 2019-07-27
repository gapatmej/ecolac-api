<?php namespace negocio\configuracion;
require_once NEGOCIO . CONFIGURACION . "NCategoriaProducto.php";
require_once NEGOCIO . CONFIGURACION . "NLineaProducto.php";
require_once NEGOCIO . CONFIGURACION . "NPresentacionProducto.php";

require_once ENTIDADES.CONFIGURACION.'Producto.php';
require_once DTO.CONFIGURACION.'ProductoDTO.php';
require_once DTO.CONFIGURACION.'CategoriaProductoDTO.php';
require_once DTO.CONFIGURACION.'LineaProductoDTO.php';
require_once DTO.CONFIGURACION.'PresentacionProductoDTO.php';
require_once DTO.SEGURIDAD.'UsuarioDTO.php';

require_once DAO.CONFIGURACION.'ProductoDAO.php';
use config\Constantes;

 use entidades\configuracion\Producto;
 
 use dao\configuracion\ProductoDAO;
 
 use dto\configuracion\ProductoDTO;
 use dto\configuracion\CategoriaProductoDTO;
 use dto\configuracion\LineaProductoDTO;
 use dto\configuracion\PresentacionProductoDTO;
 
 use dto\seguridad\UsuarioDTO;

 
/**
 * Description of NProducto
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   26/06/2019
 * 
 */
class NProducto {
    private $productoDAO;
    
    public function __construct() {
       $this->productoDAO = new ProductoDAO();
    }
    
    public function crearProducto(ProductoDTO $productoDTO) {
        $producto = new Producto();
        
        $producto->setIdProducto("");
        $producto->setFoto($productoDTO->foto);
        $producto->setNombre($productoDTO->nombre);
        $producto->setNombreCorto($productoDTO->nombreCorto);
        $producto->setPrecio($productoDTO->precio);
        $producto->setDescripcion($productoDTO->descripcion);
        $producto->setStock($productoDTO->stock);
        $producto->setAtributo1($productoDTO->atributo1);
        $producto->setAtributo2($productoDTO->atributo2);
        $producto->setActivo($productoDTO->activo);
        $producto->setIdPresentacionProducto($productoDTO->presentacionProducto->PresentacionProductoDTO->idPresentacionProducto);
        $producto->setIdCategoriaProducto($productoDTO->categoriaProducto->CategoriaProductoDTO->idCategoriaProducto);
        $producto->setIdLineaProducto($productoDTO->lineaProducto->LineaProductoDTO->idLineaProducto);
       
        $this->productoDAO->guardar((object)$producto);
    }
    
     public function actualizarProducto(ProductoDTO $productoDTO) {
        $producto = new Producto();

        $producto->setIdProducto($productoDTO->idProducto);
        $producto->setFoto($productoDTO->foto);
        $producto->setNombre($productoDTO->nombre);
        $producto->setNombreCorto($productoDTO->nombreCorto);
        $producto->setPrecio($productoDTO->precio);
        $producto->setDescripcion($productoDTO->descripcion);
        $producto->setStock($productoDTO->stock);
        $producto->setAtributo1($productoDTO->atributo1);
        $producto->setAtributo2($productoDTO->atributo2);
        $producto->setActivo($productoDTO->activo);
        $producto->setIdPresentacionProducto($productoDTO->presentacionProducto->PresentacionProductoDTO->idPresentacionProducto);
        $producto->setIdCategoriaProducto($productoDTO->categoriaProducto->CategoriaProductoDTO->idCategoriaProducto);
        $producto->setIdLineaProducto($productoDTO->lineaProducto->LineaProductoDTO->idLineaProducto);
       
        $this->productoDAO->actualizar($producto->getIdProducto(), (object)$producto);
        
    }
    
    public function consultarProductos() {
        $result = $this->productoDAO->obtenerTodo();
        foreach($result as $producto){
            $productoDTO = new ProductoDTO(json_decode(json_encode($producto)),true);
            $listaProducto[] = $productoDTO;
        }
        return $listaProducto;
    }
    
     public function consultarProductosVendidos(UsuarioDTO $usuario) {
        $result = $this->productoDAO->obtenerProductosVendidos($usuario->username);
        foreach($result as $producto){
            $productoDTO = new ProductoDTO(json_decode(json_encode($producto)),true);
            $productoDTO->cantidadVendidos = json_decode(json_encode($producto))->cantidad_vendida;
            $listaProducto[] = $productoDTO;
        }
        return $listaProducto;
    }
    
    public function consultarProducto(ProductoDTO $productoDTO ) {
        $result = $this->productoDAO->obtenerPorId($productoDTO->idProducto);
        $productoDTO = new ProductoDTO(json_decode(json_encode($result)),true);
        $categoriaProductoDTO = new CategoriaProductoDTO("",false);
        $categoriaProductoDTO->idCategoriaProducto = $productoDTO->categoriaProducto;
        $productoDTO->categoriaProducto = (new \negocio\configuracion\NCategoriaProducto())->consultarCategoriaProducto($categoriaProductoDTO);

        $lineaProductoDTO = new LineaProductoDTO("",false);
        $lineaProductoDTO->idLineaProducto = $productoDTO->lineaProducto;
        $productoDTO->lineaProducto = (new \negocio\configuracion\NLineaProducto())->consultarLineaProducto($lineaProductoDTO);

        $presentacionProductoDTO = new PresentacionProductoDTO("",false);
        $presentacionProductoDTO->idPresentacionProducto = $productoDTO->presentacionProducto;
        $productoDTO->presentacionProducto = (new \negocio\configuracion\NPresentacionProducto())->consultarPresentacionProducto($presentacionProductoDTO);
        
        return $productoDTO;
    }
    
    public function actualizarStockProducto($idProducto, $cantidad){
        $productoJson = json_decode(json_encode($this->productoDAO->obtenerPorId($idProducto)));
        $productoJson->stock = $productoJson->stock+($cantidad);
        $this->productoDAO->actualizar($productoJson->id_producto, (object)$productoJson);
    }
    
    public function obtenerProducto($idProducto){
        return $this->productoDAO->obtenerPorId($idProducto);
    }
}