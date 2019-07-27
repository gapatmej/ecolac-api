<?php namespace negocio\configuracion;
 require_once ENTIDADES.CONFIGURACION.'UnidadMedida.php';
 require_once DTO.CONFIGURACION.'UnidadMedidaDTO.php';
 require_once DAO.CONFIGURACION.'UnidadMedidaDAO.php';
/**
 * Description of NUnidadMedida
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   24/06/2019
 * 
 */
use entidades\configuracion\UnidadMedida;

use dto\configuracion\UnidadMedidaDTO;

use dao\configuracion\UnidadMedidaDAO;

class NUnidadMedida {
    
    private $unidadMedidaDAO;
    
    public function __construct() {
       $this->unidadMedidaDAO = new UnidadMedidaDAO();
    }
    
    public function crearUnidadMedida(UnidadMedidaDTO $unidadMedidaDTO) {
        $unidadMedida = new UnidadMedida();
        
        $unidadMedida->setIdUnidadMedida("");
        $unidadMedida->setNombre($unidadMedidaDTO->nombre);
        $unidadMedida->setNombreCorto($unidadMedidaDTO->nombreCorto);
        $unidadMedida->setMnenonico($unidadMedidaDTO->mnemonico);
        $unidadMedida->setDescripcion($unidadMedidaDTO->descripcion);
        $unidadMedida->setActivo($unidadMedidaDTO->activo);
       
        $this->unidadMedidaDAO->guardar((object)$unidadMedida);
    }
    
     public function actualizarUnidadMedida(UnidadMedidaDTO $unidadMedidaDTO) {
        $unidadMedida = new UnidadMedida();
        
        $unidadMedida->setIdUnidadMedida($unidadMedidaDTO->idUnidadMedida);
        $unidadMedida->setNombre($unidadMedidaDTO->nombre);
        $unidadMedida->setNombreCorto($unidadMedidaDTO->nombreCorto);
        $unidadMedida->setMnenonico($unidadMedidaDTO->mnemonico);
        $unidadMedida->setDescripcion($unidadMedidaDTO->descripcion);
        $unidadMedida->setActivo($unidadMedidaDTO->activo);
       
        $this->unidadMedidaDAO->actualizar($unidadMedidaDTO->idUnidadMedida, (object)$unidadMedida);
        
    }
    
    public function consultarUnidadesMedida() {
        $result = $this->unidadMedidaDAO->obtenerTodo();
        foreach($result as $unidadMedida){
            $unidadMedidaDTO = new UnidadMedidaDTO(json_decode(json_encode($unidadMedida)),true);
            $listaUnidadesMedida[] = $unidadMedidaDTO;
        }
        return $listaUnidadesMedida;
    }
    
    public function consultarUnidadeMedida(UnidadMedidaDTO $unidadMedidaDTO) {
        $result = $this->unidadMedidaDAO->obtenerPorId($unidadMedidaDTO->idUnidadMedida);
        return new UnidadMedidaDTO(json_decode(json_encode($result)),true);
    }
    
}
