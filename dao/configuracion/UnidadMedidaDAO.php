<?php namespace dao\configuracion;
require_once CORE.'BaseDao.php';

use core\BaseDAO;
/**
 * Description of UnidadMedidaDAO
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   03/06/2019
 * 
 */

class UnidadMedidaDAO extends BaseDAO {
    const NOMBRE_TABLA = "con_unidad_medida";
    const PRIMARY_KEY = [
        "datatype" => "s",
        "nombre" => "id_unidad_medida",
    ];
    
     public function __construct(){
        parent::__construct(self::NOMBRE_TABLA, self::PRIMARY_KEY);
    }
    
}
