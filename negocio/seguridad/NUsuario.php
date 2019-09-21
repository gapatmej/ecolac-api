<?php

namespace negocio\seguridad;

require_once ENTIDADES . SEGURIDAD . "Usuario.php";
require_once ENTIDADES . SEGURIDAD . "UsuarioRol.php";

require_once DAO . SEGURIDAD . "UsuarioDAO.php";
require_once DAO . SEGURIDAD . "UsuarioRolDAO.php";
require_once DAO . SEGURIDAD . "RolDao.php";
require_once DAO . SEGURIDAD . "RolRecursoDAO.php";
require_once DAO . SEGURIDAD . "RecursoDAO.php";

require_once DTO . SEGURIDAD . "UsuarioDTO.php";
require_once DTO . VENTAS . "DistanciaDTO.php";
require_once DTO . SEGURIDAD . "RolDTO.php";
require_once DTO . SEGURIDAD . "RecursoDTO.php";

use config\Constantes;
use config;
use core\utilidades\Utilidades;
use core\autentificacion\Autentificacion;
use entidades\seguridad\Usuario;
use entidades\seguridad\UsuarioRol;
use dao\seguridad\UsuarioDAO;
use dao\seguridad\UsuarioRolDAO;
use dao\seguridad\RolDAO;
use dao\seguridad\RolRecursoDAO;
use dao\seguridad\RecursoDAO;
use dto\seguridad\UsuarioDTO;
use dto\seguridad\RolDTO;
use dto\seguridad\RecursoDTO;
use config\Mensajes;
use dto\ventas\DistanciaDTO;
use Exception;

/**
 * Description of NUsuario
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   06/06/2019
 * 
 */
class NUsuario {

    private $usuarioDAO;
    private $usuarioRolDAO;
    private $rolRecursoDAO;
    private $rolDAO;
    private $recursoDAO;

    public function __construct() {
        $this->usuarioDAO = new UsuarioDAO();
        $this->usuarioRolDAO = new UsuarioRolDAO();
        $this->rolRecursoDAO = new RolRecursoDAO();
        $this->rolDAO = new RolDAO();
        $this->recursoDAO = new RecursoDAO();
    }

    public function login(UsuarioDTO $usuarioDTO, &$token) {
        $result = $this->usuarioDAO->obtenerUsuarioPorCredenciales($usuarioDTO->username, $usuarioDTO->password);
        if (!$result) {
            throw new Exception(Mensajes::$ERROR_USUARIO_CONTRASENIA_INCORRECTA["mensaje"], Mensajes::$ERROR_USUARIO_CONTRASENIA_INCORRECTA["cod"], null);
        }
        $usuarioDTOResponse = new UsuarioDTO(json_decode(json_encode($result)), true);

        //Obtenemos la relacion entre Usuario y Rol
        $result = $this->usuarioRolDAO->obtenerRolesPorUsuario($usuarioDTOResponse->username);

        if ($result) {
            $result = $this->rolDAO->obtenerPorVariosId(Utilidades::obtenerArrayIds($result));
            // return $result;
            foreach ($result as $rol) {
                $rolDTO = new RolDTO(json_decode(json_encode($rol)), true);
                //Obtenemos la relacion entre rol y recursos
                $result = $this->rolRecursoDAO->obtenerRecursosPorRol($rolDTO->idRol);

                if ($result) {
                    $result = $this->recursoDAO->obtenerPorVariosId(Utilidades::obtenerArrayIds($result));

                    foreach ($result as $recurso) {
                        $recursoDTO = new RecursoDTO(json_decode(json_encode($recurso)), true);
                        $rolDTO->recursos[] = $recursoDTO;
                    }
                }           
                $usuarioDTOResponse->roles[] = $rolDTO;
            }
        }

        $token = Autentificacion::autentificarse($usuarioDTOResponse);

        return $usuarioDTOResponse;
    }

    public function crearUsuario(UsuarioDTO $usuarioDTO) {
        $user = new Usuario;

        //Guardamos el usuario
        $user->setUsername($usuarioDTO->username);
        $user->setPassword($usuarioDTO->password);
        $user->setNombres($usuarioDTO->nombres);
        $user->setApellidos($usuarioDTO->apellidos);
        $user->setTelefono($usuarioDTO->telefono);
        $user->setEmail($usuarioDTO->email);
        $user->setCedula($usuarioDTO->cedula);
        $user->setLatitud($usuarioDTO->latitud);
        $user->setLongitud($usuarioDTO->longitud);
        $user->setDireccion($usuarioDTO->direccion);
        $user->setCiudad($usuarioDTO->ciudad);
        $user->setActivo($usuarioDTO->activo);
        $user->setEsAdministrador($usuarioDTO->esAdministrador);
        $user->setEsCliente($usuarioDTO->esCliente);
        $user->setEsRepartidor($usuarioDTO->esRepartidor);
        
        $this->usuarioDAO->guardar((object) $user);

        //Guardamos roles atado al usuario
        foreach ($usuarioDTO->roles as &$rol) {
            $usuarioRol = new UsuarioRol();
            $usuarioRol->setIdUsuarioRol("");
            $usuarioRol->setIdRol($rol->RolDTO->idRol);
            $usuarioRol->setUsername($usuarioDTO->username);
            $this->usuarioRolDAO->guardar($usuarioRol);
        }
    }

    public function registrarUsuario(UsuarioDTO $usuarioDTO) {
        $user = new Usuario;

        //Guardamos el usuario
        $user->setUsername($usuarioDTO->username);
        $user->setPassword($usuarioDTO->password);
        $user->setNombres($usuarioDTO->nombres);
        $user->setApellidos($usuarioDTO->apellidos);
        $user->setTelefono($usuarioDTO->telefono);
        $user->setEmail($usuarioDTO->email);
        $user->setCedula($usuarioDTO->cedula);
        $user->setLatitud($usuarioDTO->latitud);
        $user->setLongitud($usuarioDTO->longitud);
        $user->setDireccion($usuarioDTO->direccion);
        $user->setCiudad($usuarioDTO->ciudad);
        $user->setActivo(Constantes::ACTIVO);
        $user->setEsAdministrador(false);
        $user->setEsCliente(true);
        $user->setEsRepartidor(false);
        
        $this->usuarioDAO->guardar((object) $user);
    }

    public function actualizarUsuario(UsuarioDTO $usuarioDTO) {
        $user = new Usuario;

        //Actualizamos el usuario
        $user->setUsername($usuarioDTO->username);
        $user->setPassword($usuarioDTO->password);
        $user->setNombres($usuarioDTO->nombres);
        $user->setApellidos($usuarioDTO->apellidos);
        $user->setTelefono($usuarioDTO->telefono);
        $user->setEmail($usuarioDTO->email);
        $user->setCedula($usuarioDTO->cedula);
        $user->setLatitud($usuarioDTO->latitud);
        $user->setLongitud($usuarioDTO->longitud);
        $user->setDireccion($usuarioDTO->direccion);
        $user->setCiudad($usuarioDTO->ciudad);
        $user->setActivo($usuarioDTO->activo);
        $user->setEsAdministrador($usuarioDTO->esAdministrador);
        $user->setEsCliente($usuarioDTO->esCliente);
        $user->setEsRepartidor($usuarioDTO->esRepartidor);

        $this->usuarioDAO->actualizar($usuarioDTO->username, (object) $user);

        //Eliminamos los roles del usuario
        $result = Utilidades::obtenerArrayIds($this->usuarioRolDAO->obtenerUsuarioRolPorUsuario($usuarioDTO->username));

        foreach ($result as $usuarioRol) {
            $this->usuarioRolDAO->eliminar($usuarioRol);
        }

        //Guardamos roles atado al usuario
        foreach ($usuarioDTO->roles as &$rol) {
            $usuarioRol = new UsuarioRol();
            $usuarioRol->setIdUsuarioRol("");
            $usuarioRol->setIdRol($rol->RolDTO->idRol);
            $usuarioRol->setUsername($usuarioDTO->username);
            $this->usuarioRolDAO->guardar($usuarioRol);
        }
    }

    public function eliminarUsuario(UsuarioDTO $usuarioDTO) {

        //Eliminamos los roles del usuario
        $result = Utilidades::obtenerArrayIds($this->usuarioRolDAO->obtenerUsuarioRolPorUsuario($usuarioDTO->username));

        foreach ($result as $usuarioRol) {
            $this->usuarioRolDAO->eliminar($usuarioRol);
        }
        //Eliminar Usuario
        $this->usuarioDAO->eliminar($usuarioDTO->username);
        return "";
    }

    public function consultarUsuarios() {
        //return $this->usuarioDAO->obtenerTodo();
        $result = $this->usuarioDAO->obtenerTodo();
        foreach ($result as $usuario) {
            $usuarioDTO = new UsuarioDTO(json_decode(json_encode($usuario)), true);
            $result = $this->usuarioRolDAO->obtenerRolesPorUsuario($usuarioDTO->username);
            $roles = array();
            if ($result) {
                $result = $this->rolDAO->obtenerPorVariosId(Utilidades::obtenerArrayIds($result));
                foreach ($result as $rol) {
                    $rolDTO = new RolDTO(json_decode(json_encode($rol)), true);
                    $roles[] = $rolDTO;
                }
            }
            $usuarioDTO->roles = $roles;
            $listaUsuarios[] = $usuarioDTO;
        }
        return $listaUsuarios;
    }

    public function consultarUsuariosClientes() {
        $result = $this->usuarioDAO->obtenerUsuariosClientes();
        foreach ($result as $usuario) {
            $usuarioDTO = new UsuarioDTO(json_decode(json_encode($usuario)), true);
            $result = $this->usuarioRolDAO->obtenerRolesPorUsuario($usuarioDTO->username);
            $roles = array();
            if ($result) {
                $result = $this->rolDAO->obtenerPorVariosId(Utilidades::obtenerArrayIds($result));
                foreach ($result as $rol) {
                    $rolDTO = new RolDTO(json_decode(json_encode($rol)), true);
                    $roles[] = $rolDTO;
                }
            }
            $usuarioDTO->roles = $roles;
            $listaUsuarios[] = $usuarioDTO;
        }
        return $listaUsuarios;
    }

    public function consultarUsuario($id) {
        return $this->usuarioDAO->obtenerPorId($id);
    }

    public function encontrarRepartidor(UsuarioDTO $cliente) {
        $distanciaDTO = new DistanciaDTO(null,null,null);
        $result = $this->usuarioDAO->obtenerRepartidores();
        
        foreach ($result as $usuario) {
            $repartidor = new UsuarioDTO(json_decode(json_encode($usuario)), true);
            $latitudOrigen = $repartidor->latitud;
            $longitudOrigen = $repartidor->longitud;

            $latitudDestino = $cliente->latitud;
            $longitudDestino = $cliente->longitud;

            $url = URL_GOOGLE_API . $latitudOrigen . "," . $longitudOrigen . "&destinations="
                    . $latitudDestino . "," . $longitudDestino . "&mode=driving&language=pl-PL"
                    . "&key=" . KEY_API;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            $response = curl_exec($ch);
            curl_close($ch);
            $response_a = json_decode($response, true);
            $distancia = $response_a['rows'][0]['elements'][0]['distance'];
            $tiempo = $response_a['rows'][0]['elements'][0]['duration'];
            
            if( $distanciaDTO->distancia == null){
                $distanciaDTO = new DistanciaDTO($distancia, $tiempo, $repartidor->username);
                continue;
            }
            if( $distancia["value"] < $distanciaDTO->distancia["value"]){
                $distanciaDTO = new DistanciaDTO($distancia, $tiempo, $repartidor->username);
            }
        }
        return $distanciaDTO;
    }

}
