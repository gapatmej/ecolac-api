<?php namespace core\utilidades;

/**
 * Description of Utilidades
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   15/06/2019
 * 
 */
class Utilidades {
    
    public static function obtenerArrayIds($result){
        foreach ($result as &$item) {
                foreach($item as $id){
                    $ids[] = $id;
                }
        }
        return $ids;
    }
}
