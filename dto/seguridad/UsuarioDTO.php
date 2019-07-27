<?php namespace dto\seguridad;

use ReflectionClass;

/**
 * Description of UsuarioDTO
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   15/06/2019
 * 
 */
class UsuarioDTO implements \JsonSerializable {

    public $username;
    public $password;
    public $nombres;
    public $apellidos;
    public $telefono;
    public $email;
    public $cedula;
    public $latitud ;
    public $longitud;
    public $direccion;
    public $ciudad;
    public $esAdministrador;
    public $esCliente;
    public $esRepartidor;
    public $activo;
    public $roles;

    public function __construct($json, $serializarDesdeDB) {
        $this->username = $json->username;
        $this->password = $json->password;
        $this->nombres = $json->nombres;
        $this->apellidos = $json->apellidos;
        $this->telefono = $json->telefono;
        $this->email = $json->email;
        $this->cedula = $json->cedula;
        $this->latitud = floatval($json->latitud);
        $this->longitud = floatval($json->longitud);
        $this->direccion = $json->direccion;
        $this->ciudad = $json->ciudad;
        $this->activo = $json->activo==1?true:false;
        $this->roles = $json->roles;
        
        if($serializarDesdeDB){
            $this->esAdministrador = $json->es_administrador==1?true:false;;
            $this->esCliente = $json->es_cliente==1?true:false;
            $this->esRepartidor = $json->es_repartidor==1?true:false;
        }
        else{
            $this->esAdministrador = $json->esAdministrador==1?true:false;;
            $this->esCliente = $json->esCliente==1?true:false;
            $this->esRepartidor = $json->esRepartidor==1?true:false;
        }
        
    }

    public function jsonSerialize() {
        return array((new ReflectionClass($this))->getShortName() => get_object_vars($this));
    }

}
