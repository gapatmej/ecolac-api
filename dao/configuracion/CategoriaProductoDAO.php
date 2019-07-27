<?php namespace dao\configuracion;
require_once CORE.'BaseDao.php';

use core\BaseDAO;
/**
 * Description of CategoriaProductoDAO
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   26/06/2019
 * 
 */
class CategoriaProductoDAO extends BaseDAO {
    const NOMBRE_TABLA = "con_categoria_producto";
    const PRIMARY_KEY = [
        "datatype" => "s",
        "nombre" => "id_categoria_producto",
    ];
    
     public function __construct(){
        parent::__construct(self::NOMBRE_TABLA, self::PRIMARY_KEY);
    }
}
