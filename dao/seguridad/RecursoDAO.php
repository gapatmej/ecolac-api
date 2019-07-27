<?php namespace dao\seguridad;

require_once CORE.'BaseDao.php';

use core\BaseDAO;

/**
 * Description of RecursoDAO
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   15/06/2019
 * 
 */
class RecursoDAO extends BaseDAO {
    const NOMBRE_TABLA = "seg_recurso";
    const PRIMARY_KEY = [
        "datatype" => "i",
        "nombre" => "id_recurso",
    ];
    
     public function __construct(){
        parent::__construct(self::NOMBRE_TABLA, self::PRIMARY_KEY);
    }
}
