<?php namespace core\autentificacion;

/**
 * Description of Data
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   15/06/2019
 * 
 */
class Data implements \JsonSerializable{
    public  $username ;
    public  $recursos ;
      
    public function jsonSerialize() {
        return get_object_vars($this);
    }        
}
