<?php namespace entidades\seguridad;

/**
 * Description of Usuario
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   04/06/2019
 * 
 */
class Usuario implements \JsonSerializable{
    private $username;
    private $password;
    private $nombres;
    private $apellidos;
    private $telefono;
    private $email;
    private $cedula;
    private $latitud;
    private $longitud;
    private $direccion;
    private $ciudad;
    private $activo;
    private $esAdministrador;
    private $esCliente;
    private $esRepartidor;
        
    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function getNombres() {
        return $this->nombres;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getEmail() {
        return $this->email;
    }

    function getCedula() {
        return $this->cedula;
    }

    function getLatitud() {
        return $this->latitud;
    }

    function getLongitud() {
        return $this->longitud;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getCiudad() {
        return $this->ciudad;
    }

    function getActivo() {
        return $this->activo;
    }

    function getEsAdministrador() {
        return $this->esAdministrador;
    }

    function getEsCliente() {
        return $this->esCliente;
    }

    function getEsRepartidor() {
        return $this->esRepartidor;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setNombres($nombres) {
        $this->nombres = $nombres;
    }

    function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setCedula($cedula) {
        $this->cedula = $cedula;
    }

    function setLatitud($latitud) {
        $this->latitud = $latitud;
    }

    function setLongitud($longitud) {
        $this->longitud = $longitud;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setCiudad($ciudad) {
        $this->ciudad = $ciudad;
    }

    function setActivo($activo) {
        $this->activo = $activo;
    }

    function setEsAdministrador($esAdministrador) {
        $this->esAdministrador = $esAdministrador;
    }

    function setEsCliente($esCliente) {
        $this->esCliente = $esCliente;
    }

    function setEsRepartidor($esRepartidor) {
        $this->esRepartidor = $esRepartidor;
    }

        public function jsonSerialize() {
        return get_object_vars($this);
    }

}
