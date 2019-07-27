<?php

namespace dto\ventas;

use ReflectionClass;

/**
 * Description of PedidoDTO
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   26/06/2019
 * 
 */
class DistanciaDTO implements \JsonSerializable {

    public $distancia;
    public $tiempo;
    public $repartidor;

    public function __construct($distancia, $tiempo, $username) {
        $this->distancia = $distancia;
        $this->tiempo = $tiempo;
        $this->repartidor = $username;
    }

    public function jsonSerialize() {
        return array((new ReflectionClass($this))->getShortName() => get_object_vars($this));
    }

}
