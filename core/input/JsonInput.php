<?php namespace core\input;
 require_once CORE.INPUT.'HeaderInput.php';
 require_once CORE.INPUT.'BodyInput.php';
 
 use core\input\HeaderInput;
 use core\input\BodyInput;
 
/**
 * Description of JsonInput
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   12/06/2019
 * 
 */
class JsonInput implements \JsonSerializable{
    private $headerInput;
    private $bodyInput;
    
    public function __construct($json) {
        $this->headerInput = new HeaderInput($json->headerInput);
        $this->bodyInput = new BodyInput($json->bodyInput);
    }
    
    function getHeaderInput() {
        return $this->headerInput;
    }

    function getBodyInput() {
        return $this->bodyInput;
    }

    function setHeaderInput($headerInput) {
        $this->headerInput = $headerInput;
    }

    function setBodyInput($bodyInput) {
        $this->bodyInput = $bodyInput;
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}
