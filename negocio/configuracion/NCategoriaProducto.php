<?php namespace negocio\configuracion;
 require_once ENTIDADES.CONFIGURACION.'CategoriaProducto.php';
 require_once DTO.CONFIGURACION.'CategoriaProductoDTO.php';
 require_once DAO.CONFIGURACION.'CategoriaProductoDAO.php';

 use entidades\configuracion\CategoriaProducto;
 
 use dao\configuracion\CategoriaProductoDAO;
 
 use dto\configuracion\CategoriaProductoDTO;
/**
 * Description of NCategoriaProducto
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   26/06/2019a
 * 
 */
class NCategoriaProducto {
    private $categoriaProductoDAO;
    
    public function __construct() {
       $this->categoriaProductoDAO = new CategoriaProductoDAO();
    }
    
    public function crearCategoriaProducto(CategoriaProductoDTO $categoriaProductoDTO) {
        $categoriaProducto = new CategoriaProducto();
        
        $categoriaProducto->setIdCategoriaProducto("");
        $categoriaProducto->setNombre($categoriaProductoDTO->nombre);
        $categoriaProducto->setNombreCorto($categoriaProductoDTO->nombreCorto);
        $categoriaProducto->setMnenonico($categoriaProductoDTO->mnemonico);
        $categoriaProducto->setDescripcion($categoriaProductoDTO->descripcion);
        $categoriaProducto->setActivo($categoriaProductoDTO->activo);
       
        $this->categoriaProductoDAO->guardar((object)$categoriaProducto);
    }
    
     public function actualizarCategoriaProducto(CategoriaProductoDTO $categoriaProductoDTO) {
        $categoriaProducto = new CategoriaProducto();
        
        $categoriaProducto->setIdCategoriaProducto($categoriaProductoDTO->idCategoriaProducto);
        $categoriaProducto->setNombre($categoriaProductoDTO->nombre);
        $categoriaProducto->setNombreCorto($categoriaProductoDTO->nombreCorto);
        $categoriaProducto->setMnenonico($categoriaProductoDTO->mnemonico);
        $categoriaProducto->setDescripcion($categoriaProductoDTO->descripcion);
        $categoriaProducto->setActivo($categoriaProductoDTO->activo);
        
        $this->categoriaProductoDAO->actualizar($categoriaProducto->getIdCategoriaProducto(), (object)$categoriaProducto);
        
    }
    
    public function consultarCategoriasProducto() {
        $result = $this->categoriaProductoDAO->obtenerTodo();
        foreach($result as $categoriaProducto){
            $categoriaProductoDTO = new CategoriaProductoDTO(json_decode(json_encode($categoriaProducto)),true);
            $listaCategoriasProducto[] = $categoriaProductoDTO;
        }
        return $listaCategoriasProducto;
    }
    
    public function consultarCategoriaProducto(CategoriaProductoDTO $categoriaProductoDTO) {
        $result = $this->categoriaProductoDAO->obtenerPorId($categoriaProductoDTO->idCategoriaProducto);
        return new CategoriaProductoDTO(json_decode(json_encode($result)),true);
    }
}
