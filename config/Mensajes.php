<?php namespace config;

/**
 * Description of CodigoErrores
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   13/06/2019
 * 
 */
abstract class Mensajes {
    public static $MSJ_ESTADO_CORRECTO= array("cod" =>'0', "mensaje" => 'Ok');
    
    
    public static $ERROR_TRAMA_MAL_FORMADA = array("cod" =>'001', "mensaje" => 'Trama mal formada');
    public static $ERROR_TOKEN_FIRMA_INVALIDA = array("cod" =>'002', "mensaje" => 'Firma del token invalida');
    public static $ERROR_TOKEN_EXPIRADO = array("cod" =>'003', "mensaje" => 'Token Expirado');
    public static $ERROR_USUARIO_CONTRASENIA_INCORRECTA = array("cod" =>'004', "mensaje" => 'Usuario o contrasenia incorrecta');
    public static $ERROR_USUARIO_SIN_ROLES = array("cod" =>'005', "mensaje" => 'Usuario no tiene atado un rol');
    public static $ERROR_SERVICIO_NO_ENCONTRADO = array("cod" =>'006', "mensaje" => 'El servicio solicitado no se ha encontrado');
    public static $ERROR_SERVICIO_NO_AUTORIZADO = array("cod" =>'007', "mensaje" => 'No tiene asignado permisos al recurso solicitado ');
    public static $ERROR_STOCK_PRODUCTO_AGOTADO= array("cod" =>'008', "mensaje" => 'Stock agotado para el producto : ');
}
