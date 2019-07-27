<?php namespace core\output;

require_once CORE.OUTPUT."HeaderOutput.php";
require_once CORE.OUTPUT."BodyOutput.php";
require_once CORE.OUTPUT."ErrorOutput.php";

use core\output\HeaderOutput;
use core\output\BodyOutput;
use core\output\ErrorOutput;
/**
 * Description of JsonOutput
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   04/06/2019
 * 
 */
class JsonOutput implements \JsonSerializable {
    private $headerOutput;
    private $bodyOutput;
    private $errorOutput;
    
    public function __construct() {
        $this->errorOutput = new ErrorOutput();
    }
    
    function getHeaderOutput() {
        return $this->headerOutput;
    }

    function getBodyOutput() {
        return $this->bodyOutput;
    }

    function getErrorOutput() {
        return $this->errorOutput;
    }

    function setHeaderOutput($headerOutput) {
        $this->headerOutput = $headerOutput;
    }

    function setBodyOutput($bodyOutput) {
        $this->bodyOutput = $bodyOutput;
    }

    function setErrorOutput($errorOutput) {
        $this->errorOutput = $errorOutput;
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}
