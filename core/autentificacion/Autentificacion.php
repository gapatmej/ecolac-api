<?php namespace core\autentificacion;
require_once './php-jwt-master/src/BeforeValidException.php';
require_once './php-jwt-master/src/ExpiredException.php';
require_once('./php-jwt-master/src/JWT.php');
require_once('./php-jwt-master/src/SignatureInvalidException.php');

require_once CORE.AUTENTIFICACION."Token.php";
require_once CORE.AUTENTIFICACION."Data.php";

use Firebase\JWT\JWT;

use dto\seguridad\UsuarioDTO;

/**
 * Description of Autentificacion
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   04/06/2019
 * 
 */
class Autentificacion {
    
    private static $encrypt = ['HS256'];
    private static $auditoria = null;
    private static $data = null;

    public static function autentificarse(UsuarioDTO $usuarioDTO)
    {   
        $data = new Data();
        $data->username = $usuarioDTO->username;
        foreach ($usuarioDTO->roles as &$rol){
            foreach ($rol->recursos as &$recurso){
                $data->recursos[] = $recurso->mnemonico;
            }
        }   
        $token = new Token(self::obtenerAud(), $data);
        
        return JWT::encode($token, CLAVE_SECRETA);
    }

    public static function validarToken($token)
    {
        if(empty($token))
        {
            return false;
        }

        $decode = JWT::decode($token,CLAVE_SECRETA, self::$encrypt);
        
        if($decode->aud !== self::obtenerAud())
        {
            throw new Exception("Invalid user logged in.");
        }
        
        return $decode->data;
    }

    private static function obtenerAud()
    {
        $auditoria = '';

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $auditoria = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $auditoria = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $auditoria = $_SERVER['REMOTE_ADDR'];
        }

        $auditoria .= @$_SERVER['HTTP_USER_AGENT'];
        $auditoria .= gethostname();

        return sha1($auditoria);
    }
    
}
