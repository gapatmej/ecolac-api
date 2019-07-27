<?php namespace negocio\seguridad;
require_once DTO.SEGURIDAD."RolDTO.php";
require_once DTO.SEGURIDAD."RecursoDTO.php";

require_once DAO.SEGURIDAD."RolRecursoDAO.php";
require_once DAO.SEGURIDAD."RolDAO.php";
require_once DAO.SEGURIDAD."RecursoDao.php";

require_once ENTIDADES.SEGURIDAD."Rol.php";
require_once ENTIDADES.SEGURIDAD."RolRecurso.php";

use core\utilidades\Utilidades;
 
use dao\seguridad\RolDao;
use dao\seguridad\RolRecursoDAO;
use dao\seguridad\RecursoDAO;

use dto\seguridad\RolDTO;
use dto\seguridad\RecursoDTO;

use entidades\seguridad\Rol;
use entidades\seguridad\RolRecurso;

/**
 * Description of NRol
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   15/06/2019
 * 
 */
class NRol {
    private $rolDAO;
    private $rolRecursoDAO;
    private $recursoDAO;
    
    public function __construct() {
       $this->rolDAO = new RolDao();
       $this->rolRecursoDAO = new RolRecursoDAO();
       $this->recursoDAO = new RecursoDAO();
    }
    
    public function crearRol(RolDTO $rolDTO) {
        $rol = new Rol();
        
        $rol->setIdRol("");
        $rol->setNombre($rolDTO->nombre);
        $rol->setNombreCorto($rolDTO->nombreCorto);
        $rol->setMnemonico($rolDTO->mnemonico);
        $rol->setDescripcion($rolDTO->descripcion);
        $rol->setActivo($rolDTO->activo);
       
        $idRol = $this->rolDAO->guardar((object)$rol);

        //Guardamos recursos atado al rol
       // return $idRol;
       // return $rolDTO->recursos;
        foreach ($rolDTO->recursos as &$recurso){
            $rolRecurso = new RolRecurso();
            $rolRecurso->setIdRolRecurso("");
            $rolRecurso->setIdRol($idRol);
            $rolRecurso->setIdRecurso($recurso->RecursoDTO->idRecurso);
            $this->rolRecursoDAO->guardar($rolRecurso);
        }
        
    }
    
     public function actualizarRol(RolDTO $rolDTO) {
         $rol = new Rol();
        
        //Guardamos el usuario
        $rol->setIdRol($rolDTO->idRol);
        $rol->setNombre($rolDTO->nombre);
        $rol->setNombreCorto($rolDTO->nombreCorto);
        $rol->setMnemonico($rolDTO->mnemonico);
        $rol->setDescripcion($rolDTO->descripcion);
        $rol->setActivo($rolDTO->activo);
        
        $this->rolDAO->actualizar($rol->getIdRol(),(object)$rol);
        
        //Eliminamos los recursos del Rol
        $result = Utilidades::obtenerArrayIds($this->rolRecursoDAO->obtenerRolRecursoPorRol($rol->getIdRol()));

        foreach($result as $rolRecurso){
            $this->rolRecursoDAO->eliminar($rolRecurso);
        }
        
        //Guardamos nuevos recursos atado al rol
        foreach ($rolDTO->recursos as &$recurso){
            $rolRecurso = new RolRecurso();
            $rolRecurso->setIdRolRecurso("");
            $rolRecurso->setIdRol($rolDTO->idRol);
            $rolRecurso->setIdRecurso($recurso->RecursoDTO->idRecurso);
            $this->rolRecursoDAO->guardar($rolRecurso);
        }
        
    }
    
    public function consultarRoles() {
        $result = $this->rolDAO->obtenerTodo();
        foreach($result as $rol){
            $rolDTO = new RolDTO(json_decode(json_encode($rol)),true);
            $result = $this->rolRecursoDAO->obtenerRecursosPorRol($rolDTO->idRol);
            $recursos = array();
            if($result){
                 $result = $this->recursoDAO->obtenerPorVariosId(Utilidades::obtenerArrayIds($result));
                 foreach($result as $recurso){
                    $recursoDTO = new RecursoDTO(json_decode(json_encode($recurso)),true);
                    $recursos[] = $recursoDTO;
                }
            }
            $rolDTO->recursos = $recursos;
            $listaRoles[] = $rolDTO;
        }
        return $listaRoles;
    }
    
}
