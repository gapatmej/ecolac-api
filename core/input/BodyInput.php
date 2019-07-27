<?php namespace core\input;

/**
 * Description of BodyInput
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   12/06/2019
 * 
 */
class BodyInput implements \JsonSerializable {
    private $data;
    
    public function __construct($json) {
        $this->data = $json->data;
    }
    
    function getData() {
        return $this->data;
    }

    function setData($data) {
        $this->data = $data;
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}
