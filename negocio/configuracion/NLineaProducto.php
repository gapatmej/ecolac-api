<?php namespace negocio\configuracion;
 require_once ENTIDADES.CONFIGURACION.'LineaProducto.php';
 require_once DTO.CONFIGURACION.'LineaProductoDTO.php';
 require_once DAO.CONFIGURACION.'LineaProductoDAO.php';
 
 use entidades\configuracion\LineaProducto;
 
 use dao\configuracion\LineaProductoDAO;
 
 use dto\configuracion\LineaProductoDTO;
/**
 * Description of NLineaProducto
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   26/06/2019
 * 
 */
class NLineaProducto {
    private $lineaProductoDAO;
    
    public function __construct() {
       $this->lineaProductoDAO = new LineaProductoDAO();
    }
    
    public function crearLineaProducto(LineaProductoDTO $lineaProductoDTO) {
        $lineaProducto = new LineaProducto();
        
        $lineaProducto->setIdLineaProducto("");
        $lineaProducto->setNombre($lineaProductoDTO->nombre);
        $lineaProducto->setNombreCorto($lineaProductoDTO->nombreCorto);
        $lineaProducto->setMnenonico($lineaProductoDTO->mnemonico);
        $lineaProducto->setDescripcion($lineaProductoDTO->descripcion);
        $lineaProducto->setActivo($lineaProductoDTO->activo);
        
        $this->lineaProductoDAO->guardar((object)$lineaProducto);
    }
    
     public function actualizarLineaProducto(LineaProductoDTO $lineaProductoDTO) {
        $lineaProducto = new LineaProducto();
        
        $lineaProducto->setIdLineaProducto($lineaProductoDTO->idLineaProducto);
        $lineaProducto->setNombre($lineaProductoDTO->nombre);
        $lineaProducto->setNombreCorto($lineaProductoDTO->nombreCorto);
        $lineaProducto->setMnenonico($lineaProductoDTO->mnemonico);
        $lineaProducto->setDescripcion($lineaProductoDTO->descripcion);
        $lineaProducto->setActivo($lineaProductoDTO->activo);
       
        $this->lineaProductoDAO->actualizar($lineaProducto->getIdLineaProducto(), (object)$lineaProducto);
    }
    
    public function consultarLineasProducto() {
        $result = $this->lineaProductoDAO->obtenerTodo();
        foreach($result as $lineaProducto){
            $lineaProductoDTO = new LineaProductoDTO(json_decode(json_encode($lineaProducto)),true);
            $listaLineasProducto[] = $lineaProductoDTO;
        }
        return $listaLineasProducto;
    }
    
    public function consultarLineaProducto(LineaProductoDTO $lineaProductoDTO) {
        $result = $this->lineaProductoDAO->obtenerPorId($lineaProductoDTO->idLineaProducto);
        return new LineaProductoDTO(json_decode(json_encode($result)),true);
    }
}
