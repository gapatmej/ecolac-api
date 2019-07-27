<?php namespace dao\configuracion;
require_once CORE.'BaseDao.php';

use core\BaseDAO;

/**
 * Description of PresentacionProductoDAO
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   24/06/2019
 * 
 */
class PresentacionProductoDAO extends BaseDAO {
    const NOMBRE_TABLA = "con_presentacion_producto";
    const PRIMARY_KEY = [
        "datatype" => "s",
        "nombre" => "id_presentacion_producto",
    ];
    
     public function __construct(){
        parent::__construct(self::NOMBRE_TABLA, self::PRIMARY_KEY);
    }
    
}
