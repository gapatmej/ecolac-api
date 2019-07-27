<?php namespace negocio\configuracion;
require_once NEGOCIO . CONFIGURACION . "NUnidadMedida.php";

require_once ENTIDADES.CONFIGURACION.'PresentacionProducto.php';
require_once DTO.CONFIGURACION.'PresentacionProductoDTO.php';
require_once DAO.CONFIGURACION.'PresentacionProductoDAO.php';

require_once DAO.CONFIGURACION.'UnidadMedidaDAO.php';
require_once DTO.CONFIGURACION.'UnidadMedidaDTO.php';
 
use entidades\configuracion\PresentacionProducto;

use dao\configuracion\PresentacionProductoDAO;
use dao\configuracion\UnidadMedidaDAO;

use dto\configuracion\PresentacionProductoDTO;
use dto\configuracion\UnidadMedidaDTO;
/**
 * Description of NPresentacionProducto
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   24/06/2019
 * 
 */
class NPresentacionProducto {
    private $presentacionProductoDAO;
    private $unidadMedidadDAO;
    
    public function __construct() {
       $this->presentacionProductoDAO = new PresentacionProductoDAO();
       $this->unidadMedidadDAO = new UnidadMedidaDAO();
    }
    
    public function crearPresentacionProducto(PresentacionProductoDTO $presentacionProductoDTO) {
        $presentacionProducto = new PresentacionProducto();
        
        $presentacionProducto->setIdPresentacionProducto("");
        $presentacionProducto->setNombre($presentacionProductoDTO->nombre);
        $presentacionProducto->setNombreCorto($presentacionProductoDTO->nombreCorto);
        $presentacionProducto->setMnenonico($presentacionProductoDTO->mnemonico);
        $presentacionProducto->setDescripcion($presentacionProductoDTO->descripcion);
        $presentacionProducto->setActivo($presentacionProductoDTO->activo);
        $presentacionProducto->setIdUnidadMedida($presentacionProductoDTO->unidadMedida->UnidadMedidaDTO->idUnidadMedida);
       
        $this->presentacionProductoDAO->guardar((object)$presentacionProducto);
    }
    
     public function actualizarPresentacionProducto(PresentacionProductoDTO $presentacionProductoDTO) {
        $presentacionProducto = new PresentacionProducto();
        
        $presentacionProducto->setIdPresentacionProducto($presentacionProductoDTO->idPresentacionProducto);
        $presentacionProducto->setNombre($presentacionProductoDTO->nombre);
        $presentacionProducto->setNombreCorto($presentacionProductoDTO->nombreCorto);
        $presentacionProducto->setMnenonico($presentacionProductoDTO->mnemonico);
        $presentacionProducto->setDescripcion($presentacionProductoDTO->descripcion);
        $presentacionProducto->setActivo($presentacionProductoDTO->activo);
        $presentacionProducto->setIdUnidadMedida($presentacionProductoDTO->unidadMedida->UnidadMedidaDTO->idUnidadMedida);
       
        $this->presentacionProductoDAO->actualizar($presentacionProducto->getIdPresentacionProducto(), (object)$presentacionProducto);
        
    }
    
    public function consultarPresentacionesProducto() {
        $result = $this->presentacionProductoDAO->obtenerTodo();
        foreach($result as $presentacion){
            $presentacionProductoDTO = new PresentacionProductoDTO(json_decode(json_encode($presentacion)),true);
            
            $unidadMedidadDTO = new UnidadMedidaDTO("",false);
            $unidadMedidadDTO->idUnidadMedida = $presentacionProductoDTO->unidadMedida;
            $presentacionProductoDTO->unidadMedida = (new \negocio\configuracion\NUnidadMedida())->consultarUnidadeMedida($unidadMedidadDTO);
            
            $listaPresentacionesProducto[] = $presentacionProductoDTO;
        }
        return $listaPresentacionesProducto;
    }
    
    public function consultarPresentacionProducto(PresentacionProductoDTO $presentacionProductoDTO) {
        $result = $this->presentacionProductoDAO->obtenerPorId($presentacionProductoDTO->idPresentacionProducto);
        $presentacionProductoDTO =  new PresentacionProductoDTO(json_decode(json_encode($result)),true);
        
        $unidadMedidadDTO = new UnidadMedidaDTO("",false);
        $unidadMedidadDTO->idUnidadMedida = $presentacionProductoDTO->unidadMedida;
        $presentacionProductoDTO->unidadMedida = (new \negocio\configuracion\NUnidadMedida())->consultarUnidadeMedida($unidadMedidadDTO);
        
        return $presentacionProductoDTO;
    }
    
    public function obtenerTodo() {
        $result = $this->presentacionProductoDAO->obtenerTodo();
        foreach($result as $presentacion){
            $presentacionProductoDTO = new PresentacionProductoDTO(json_decode(json_encode($presentacion)),true);
            $listaPresentacionesProducto[] = $presentacionProductoDTO;
        }
        return $listaPresentacionesProducto;
    }
    
}
