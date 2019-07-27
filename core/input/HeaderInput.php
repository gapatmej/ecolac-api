<?php namespace core\input;

/**
 * Description of HeaderInput
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   12/06/2019
 * 
 */
class HeaderInput implements \JsonSerializable {
    private $token;
    private $recurso;
    private $transaccion;
    
    public function __construct($json) {
        $this->token = $json->token;
        $this->recurso = $json->recurso;
        $this->transaccion = $json->transaccion;
    }
    
    function getTransaccion() {
        return $this->transaccion;
    }

    function getToken() {
        return $this->token;
    }
    
    function getRecurso() {
        return $this->recurso;
    }

    function setTransaccion($transaccion) {
        $this->transaccion = $transaccion;
    }

    function setToken($token) {
        $this->token = $token;
    }
    
    function setRecurso($recurso) {
        $this->recurso = $recurso;
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}
