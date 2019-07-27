<?php namespace dao\seguridad;

require_once CORE.'BaseDao.php';

use core\BaseDAO;

/**
 * Description of RolDao
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   15/06/2019
 * 
 */
class RolDAO extends BaseDAO {
    const NOMBRE_TABLA = "seg_rol";
    const PRIMARY_KEY = [
        "datatype" => "i",
        "nombre" => "id_rol",
    ];
    
     public function __construct(){
        parent::__construct(self::NOMBRE_TABLA, self::PRIMARY_KEY);
    }
    
}
