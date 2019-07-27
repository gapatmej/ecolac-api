<?php namespace negocio\seguridad;

require_once DTO.SEGURIDAD."RecursoDTO.php";

require_once DAO.SEGURIDAD."RecursoDAO.php";

require_once ENTIDADES.SEGURIDAD."Recurso.php";

use dao\seguridad\RecursoDAO;

use dto\seguridad\RecursoDTO;

use entidades\seguridad\Recurso;
/**
 * Description of NRecurso
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   01/07/2019
 * 
 */
class NRecurso {
    private $recursoDAO;
    
    public function __construct() {
       $this->recursoDAO = new RecursoDAO();
    }
    
    public function consultarRecursos() {
        $result = $this->recursoDAO->obtenerTodo();
        foreach($result as $recurso){
            $recursoDTO = new RecursoDTO(json_decode(json_encode($recurso)),true);
            $listaRecursos[] = $recursoDTO;
        }
        return $listaRecursos;
       
    }
}
