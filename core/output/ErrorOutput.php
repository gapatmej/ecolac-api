<?php namespace core\output;

/**
 * Description of ErrorOutput
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   04/06/2019
 * 
 */
class ErrorOutput implements \JsonSerializable{
    
    private $codigoError;
    private $mensajeError;
    
    function getCodigoError() {
        return $this->codigoError;
    }

    function getMensajeError() {
        return $this->mensajeError;
    }

    function setCodigoError($codigoError) {
        $this->codigoError = $codigoError;
    }

    function setMensajeError($mensajeError) {
        $this->mensajeError = $mensajeError;
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}
