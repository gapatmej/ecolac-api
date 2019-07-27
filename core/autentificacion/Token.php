<?php namespace core\autentificacion;

/**
 * Description of Token
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   04/06/2019
 * 
 */
class Token implements \JsonSerializable{
    public $iat;
    public $exp;
    public $aud;
    public $data;
    
    function __construct($aud, $data ){
        $this->iat = time();
        $this->exp = time() + (60*60);
        $this->aud = $aud;
        $this->data = $data;
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}
