<?php

require_once 'config/Config.php';
require_once CONFIG . "Mensajes.php";
require_once CONFIG . "Constantes.php";
require_once CONFIG . "Servicios.php";
require_once CORE . AUTENTIFICACION . "Autentificacion.php";
require_once CORE . INPUT . "JsonInput.php";
require_once CORE . OUTPUT . "JsonOutput.php";
require_once CORE . UTILIDADES . "Utilidades.php";

use config\Mensajes;
use config\Servicios;
use config\Recursos;
use core\input\JsonInput;
use core\output\JsonOutput;
use core\autentificacion\Autentificacion;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;

/**
 * Description of proccessjson
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   03/06/2019
 * 
 */
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
set_error_handler('exceptions_error_handler');
function exceptions_error_handler($severity, $message, $filename, $lineno) {
  if (error_reporting() == 0) {
    return;
  }
  if (error_reporting() & $severity) {
    if($severity == 8){
        throw new ErrorException(Mensajes::$ERROR_TRAMA_MAL_FORMADA["mensaje"], Mensajes::$ERROR_TRAMA_MAL_FORMADA["cod"],$severity , $filename, $lineno);
    }
    else{
        throw new ErrorException($message, -1, $severity, $filename, $lineno);
    }
      throw new ErrorException($message, -1, $severity, $filename, $lineno);
  }
}

$jsonOutput = new JsonOutput();


try {
    $jsonInput = new JsonInput(json_decode(file_get_contents('php://input')));

    //Header parameters
    $recurso = $jsonInput->getHeaderInput()->getRecurso();
    $transaccion = $jsonInput->getHeaderInput()->getTransaccion();
    $token = $jsonInput->getHeaderInput()->getToken();

    //Body parameters
    $data = $jsonInput->getBodyInput()->getData();
} catch (\Exception $e) {
    $jsonOutput->getErrorOutput()->setCodigoError(Mensajes::$ERROR_TRAMA_MAL_FORMADA["cod"]);
    $jsonOutput->getErrorOutput()->setMensajeError(Mensajes::$ERROR_TRAMA_MAL_FORMADA["mensaje"]);
    echo json_encode($jsonOutput);
    return;
}

try{
$jsonOutput->setHeaderOutput($jsonInput->getHeaderInput());
$jsonOutput->setBodyOutput($jsonInput->getBodyInput());
$codigoError = Mensajes::$ERROR_SERVICIO_NO_ENCONTRADO["cod"];
$mensajeError = Mensajes::$ERROR_SERVICIO_NO_ENCONTRADO["mensaje"];

validarSesion($token, $recurso, $transaccion);
//var_dump (validarSesion($token, $recurso, $transaccion));
sleep (1) ;
switch ($recurso) {
    case Recursos::R_PUBLICO: 
        switch ($transaccion) {
            case Servicios::S_LOGIN001 :
                require_once NEGOCIO . SEGURIDAD . "NUsuario.php";
                $user = new \dto\seguridad\UsuarioDTO($data->UsuarioDTO, false);
                $data = (new negocio\seguridad\NUsuario())->login($user, $token);
                $jsonOutput->getHeaderOutput()->setToken($token);
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
            case Servicios::S_CREAR_USUARIO_002 :
                require_once NEGOCIO . SEGURIDAD . "NUsuario.php";
                $user = new \dto\seguridad\UsuarioDTO($data->UsuarioDTO, false);
                //$data = (new negocio\seguridad\NUsuario())->registrarUsuario($user);
                (new negocio\seguridad\NUsuario())->registrarUsuario($user);
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
            case Servicios::S_CONSULTAR_PRESENTACIONES_PRODUCTO_001 :
                require_once NEGOCIO . CONFIGURACION . "NPresentacionProducto.php";
                $data = (new \negocio\configuracion\NPresentacionProducto())->obtenerTodo();
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
            case Servicios::S_CONSULTAR_PRESENTACIONES_PRODUCTO_001 :
                require_once NEGOCIO . CONFIGURACION . "NPresentacionProducto.php";
                $data = (new \negocio\configuracion\NPresentacionProducto())->obtenerTodo();
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
            case Servicios::S_CONSULTAR_CATEGORIAS_PRODUCTO_001 :
                require_once NEGOCIO . CONFIGURACION . "NCategoriaProducto.php";
                $data = (new \negocio\configuracion\NCategoriaProducto())->consultarCategoriasProducto();
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
             case Servicios::S_CONSULTAR_LINEAS_PRODUCTO_001 :
                require_once NEGOCIO . CONFIGURACION . "NLineaProducto.php";
                $data = (new \negocio\configuracion\NLineaProducto())->consultarLineasProducto();
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
            case Servicios::S_CONSULTAR_PRODUCTOS_001 :
                require_once NEGOCIO . CONFIGURACION . "NProducto.php";
                $data = (new \negocio\configuracion\NProducto)->consultarProductos();
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
        }
        break;
    case Recursos::R_GES_USU:
        switch ($transaccion) {
            case Servicios::S_CREAR_USUARIO_001 :
                require_once NEGOCIO . SEGURIDAD . "NUsuario.php";
                $user = new \dto\seguridad\UsuarioDTO($data->UsuarioDTO, false);
                //$data = (new negocio\seguridad\NUsuario())->crearUsuario($user);
                (new negocio\seguridad\NUsuario())->crearUsuario($user);
                // $data = "ok";
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
            case Servicios::S_ACTUALIZAR_USUARIO_001 :
                require_once NEGOCIO . SEGURIDAD . "NUsuario.php";
                $user = new \dto\seguridad\UsuarioDTO($data->UsuarioDTO, false);
                //$data = (new negocio\seguridad\NUsuario())->actualizarUsuario($user);
                (new negocio\seguridad\NUsuario())->actualizarUsuario($user);
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
            case Servicios::S_CONSULTAR_USUARIOS_001 :
                require_once NEGOCIO . SEGURIDAD . "NUsuario.php";
                $data = (new negocio\seguridad\NUsuario())->consultarUsuarios();
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
            case Servicios::S_CONSULTAR_USUARIOS_002 :
                require_once NEGOCIO . SEGURIDAD . "NUsuario.php";
                $data = (new negocio\seguridad\NUsuario())->consultarUsuariosClientes();
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
            case Servicios::S_ELIMINAR_USUARIO_001 :
                require_once NEGOCIO . SEGURIDAD . "NUsuario.php";
                $user = new \dto\seguridad\UsuarioDTO($data->UsuarioDTO, false);
                $data = (new negocio\seguridad\NUsuario())->eliminarUsuario($user);
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
        }
        break;
    case Recursos::R_GES_ROL:
        switch ($transaccion) {
            case Servicios::S_CREAR_ROL_001 :
                require_once NEGOCIO . SEGURIDAD . "NRol.php";
                $rol = new \dto\seguridad\RolDTO($data->RolDTO, false);
                //$data = (new negocio\seguridad\NRol())->crearRol($rol);
                (new negocio\seguridad\NRol())->crearRol($rol);
                // $data = "ok";
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
            case Servicios::S_ACTUALIZAR_ROL_001 :
                require_once NEGOCIO . SEGURIDAD . "NRol.php";
                $rol = new \dto\seguridad\RolDTO($data->RolDTO, false);
                //$data = (new negocio\seguridad\NRol())->actualizarRol($rol);
                (new negocio\seguridad\NRol())->actualizarRol($rol);
                // $data = "ok";
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
            case Servicios::S_CONSULTAR_ROLES_001 :
                require_once NEGOCIO . SEGURIDAD . "NRol.php";
                $data = (new negocio\seguridad\NRol())->consultarRoles();
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
            case Servicios::S_CONSULTAR_RECURSOS_001 :
                require_once NEGOCIO . SEGURIDAD . "NRecurso.php";
                $data = (new negocio\seguridad\NRecurso())->consultarRecursos();
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
        }
        break;
    case Recursos::R_GES_UNI_ME:
        switch ($transaccion) {
            case Servicios::S_CREAR_UNIDAD_MEDIDA_001 :
                require_once NEGOCIO . CONFIGURACION . "NUnidadMedida.php";
                $unidadMedida = new dto\configuracion\UnidadMedidaDTO($data->UnidadMedidaDTO, false);
               // $data = (new negocio\configuracion\NUnidadMedida())->crearUnidadMedida($unidadMedida);
                (new negocio\configuracion\NUnidadMedida())->crearUnidadMedida($unidadMedida);
                // $data = "ok";
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
            case Servicios::S_ACTUALIZAR_UNIDAD_MEDIDA_001 :
                require_once NEGOCIO . CONFIGURACION . "NUnidadMedida.php";
                $unidadMedida = new dto\configuracion\UnidadMedidaDTO($data->UnidadMedidaDTO, false);
               // $data = (new negocio\configuracion\NUnidadMedida())->crearUnidadMedida($unidadMedida);
                (new negocio\configuracion\NUnidadMedida())->actualizarUnidadMedida($unidadMedida);
                // $data = "ok";
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
            case Servicios::S_CONSULTAR_UNIDADES_MEDIDA_001 :
                require_once NEGOCIO . CONFIGURACION . "NUnidadMedida.php";
                $data = (new negocio\configuracion\NUnidadMedida())->consultarUnidadesMedida();
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
        }
        break;
    case Recursos::R_GES_PRE:
        switch ($transaccion) {
            case Servicios::S_CREAR_PRESENTACION_PRODUCTO_001 :
                require_once NEGOCIO . CONFIGURACION . "NPresentacionProducto.php";
                $presentacionProducto = new dto\configuracion\PresentacionProductoDTO($data->PresentacionProductoDTO, false);
                //$data = (new \negocio\configuracion\NPresentacionProducto())->crearPresentacionProducto($presentacionProducto);
                (new \negocio\configuracion\NPresentacionProducto())->crearPresentacionProducto($presentacionProducto);
                // $data = "ok";
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
            case Servicios::S_ACTUALIZAR_PRESENTACION_PRODUCTO_001 :
                require_once NEGOCIO . CONFIGURACION . "NPresentacionProducto.php";
                $presentacionProducto = new dto\configuracion\PresentacionProductoDTO($data->PresentacionProductoDTO, false);
                //$data = (new \negocio\configuracion\NPresentacionProducto())->actualizarPresentacionProducto($presentacionProducto);
                (new \negocio\configuracion\NPresentacionProducto())->actualizarPresentacionProducto($presentacionProducto);
                // $data = "ok";
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
            case Servicios::S_CONSULTAR_PRESENTACIONES_PRODUCTO_001 :
                require_once NEGOCIO . CONFIGURACION . "NPresentacionProducto.php";
                $data = (new \negocio\configuracion\NPresentacionProducto())->consultarPresentacionesProducto();
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
        }
        break;
    case Recursos::R_GES_CAT:
        switch ($transaccion) {
            case Servicios::S_CREAR_CATEGORIA_PRODUCTO_001 :
                require_once NEGOCIO . CONFIGURACION . "NCategoriaProducto.php";
                $categoriaProducto = new dto\configuracion\CategoriaProductoDTO($data->CategoriaProductoDTO, false);
                //$data = (new \negocio\configuracion\NPresentacionProducto())->crearPresentacionProducto($presentacionProducto);
                (new \negocio\configuracion\NCategoriaProducto())->crearCategoriaProducto($categoriaProducto);
                // $data = "ok";
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
            case Servicios::S_ACTUALIZAR_CATEGORIA_PRODUCTO_001 :
                require_once NEGOCIO . CONFIGURACION . "NCategoriaProducto.php";
                $categoriaProducto = new dto\configuracion\CategoriaProductoDTO($data->CategoriaProductoDTO, false);
                //$data = (new \negocio\configuracion\NPresentacionProducto())->crearPresentacionProducto($presentacionProducto);
                (new \negocio\configuracion\NCategoriaProducto())->actualizarCategoriaProducto($categoriaProducto);
                // $data = "ok";
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
            case Servicios::S_CONSULTAR_CATEGORIAS_PRODUCTO_001 :
                require_once NEGOCIO . CONFIGURACION . "NCategoriaProducto.php";
                $data = (new \negocio\configuracion\NCategoriaProducto())->consultarCategoriasProducto();
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
        }
        break;
    case Recursos::R_GES_LIN:
        switch ($transaccion) {
            case Servicios::S_CREAR_LINEA_PRODUCTO_001 :
                require_once NEGOCIO . CONFIGURACION . "NLineaProducto.php";
                $lineaProducto = new dto\configuracion\LineaProductoDTO($data->LineaProductoDTO, false);
                //$data = (new \negocio\configuracion\NPresentacionProducto())->crearPresentacionProducto($presentacionProducto);
                (new \negocio\configuracion\NLineaProducto())->crearLineaProducto($lineaProducto);
                // $data = "ok";
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
            case Servicios::S_ACTUALIZAR_LINEA_PRODUCTO_001 :
                require_once NEGOCIO . CONFIGURACION . "NLineaProducto.php";
                $lineaProducto = new dto\configuracion\LineaProductoDTO($data->LineaProductoDTO, false);
                //$data = (new \negocio\configuracion\NPresentacionProducto())->crearPresentacionProducto($presentacionProducto);
                (new \negocio\configuracion\NLineaProducto())->actualizarLineaProducto($lineaProducto);
                // $data = "ok";
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
            case Servicios::S_CONSULTAR_LINEAS_PRODUCTO_001 :
                require_once NEGOCIO . CONFIGURACION . "NLineaProducto.php";
                $data = (new \negocio\configuracion\NLineaProducto())->consultarLineasProducto();
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
        }
        break;
    case Recursos::R_GES_PRO:
        switch ($transaccion) {
            case Servicios::S_CREAR_PRODUCTO_001 :
                require_once NEGOCIO . CONFIGURACION . "NProducto.php";
                $producto = new dto\configuracion\ProductoDTO($data->ProductoDTO, false);
                //$data = (new \negocio\configuracion\NProducto)->crearProducto($producto);
                (new \negocio\configuracion\NProducto)->crearProducto($producto);
                // $data = "ok";
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
            case Servicios::S_ACTUALIZAR_PRODUCTO_001 :
                require_once NEGOCIO . CONFIGURACION . "NProducto.php";
                $producto = new dto\configuracion\ProductoDTO($data->ProductoDTO, false);
                //$data = $data->ProductoDTO->foto;
                (new \negocio\configuracion\NProducto)->actualizarProducto($producto);
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
            case Servicios::S_CONSULTAR_PRODUCTO_001 :
                require_once NEGOCIO . CONFIGURACION . "NProducto.php";
                $producto = new dto\configuracion\ProductoDTO($data->ProductoDTO, false);
                $data = (new \negocio\configuracion\NProducto)->consultarProducto($producto);
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
            case Servicios::S_CONSULTAR_PRODUCTOS_001 :
                require_once NEGOCIO . CONFIGURACION . "NProducto.php";
                $data = (new \negocio\configuracion\NProducto)->consultarProductos();
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
        }
        break;
    case Recursos::R_GES_DES:
        switch ($transaccion) {
            case Servicios::S_ACTUALIZAR_PEDIDO_001 :
                require_once NEGOCIO . VENTAS . "NPedido.php";
                $pedido = new dto\ventas\PedidoDTO($data->PedidoDTO, false);
                //$data = (new negocio\ventas\NPedido)->actualizarEstadoDespachado($pedido);
                (new negocio\ventas\NPedido)->actualizarEstadoDespachado($pedido);
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
            case Servicios::S_ACTUALIZAR_DETALLE_PEDIDO_001 :
                require_once NEGOCIO . VENTAS . "NDetallePedido.php";
                $detallePedido = new dto\ventas\DetallePedidoDTO($data->DetallePedidoDTO, false);
                //$data = (new negocio\ventas\NDetallePedido())->actualizarEstadoDespachadoPorId($detallePedido);
                (new negocio\ventas\NDetallePedido())->actualizarEstadoDespachadoPorId($detallePedido);
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
            case Servicios::S_CONSULTAR_PEDIDOS_001 :
                require_once NEGOCIO . VENTAS . "NPedido.php";
                $user = new \dto\seguridad\UsuarioDTO($data->UsuarioDTO, false);
                $data = (new negocio\ventas\NPedido)->consultarPedidos($user);
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
        }
        break;
    case Recursos::R_GES_PED:
        switch ($transaccion) {
            case Servicios::S_CREAR_PEDIDO_001:
                require_once NEGOCIO . VENTAS . "NPedido.php";
                $pedido = new dto\ventas\PedidoDTO($data->PedidoDTO, false);
                $data = (new negocio\ventas\NPedido)->crearPedido($pedido);
                //(new negocio\ventas\NPedido)->crearPedido($pedido);
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
            case Servicios::S_ACTUALIZAR_PEDIDO_001 :
                require_once NEGOCIO . VENTAS . "NPedido.php";
                $pedido = new dto\ventas\PedidoDTO($data->PedidoDTO, false);
                //$data = (new negocio\ventas\NPedido)->actualizarEstadoDespachado($pedido);
                (new negocio\ventas\NPedido)->actualizarEstadoDespachado($pedido);
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
            case Servicios::S_ACTUALIZAR_DETALLE_PEDIDO_001 :
                require_once NEGOCIO . VENTAS . "NDetallePedido.php";
                $detallePedido = new dto\ventas\DetallePedidoDTO($data->DetallePedidoDTO, false);
                //$data = (new negocio\ventas\NDetallePedido())->actualizarEstadoDespachadoPorId($detallePedido);
                (new negocio\ventas\NDetallePedido())->actualizarEstadoDespachadoPorId($detallePedido);
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
            case Servicios::S_CONSULTAR_PEDIDOS_001 :
                require_once NEGOCIO . VENTAS . "NPedido.php";
                $user = new \dto\seguridad\UsuarioDTO($data->UsuarioDTO, false);
                $data = (new negocio\ventas\NPedido)->consultarPedidos($user);
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
             case Servicios::S_CONSULTAR_USUARIOS_002 :
                require_once NEGOCIO . SEGURIDAD . "NUsuario.php";
                $data = (new negocio\seguridad\NUsuario())->consultarUsuariosClientes();
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
            case Servicios::S_CONSULTAR_PRODUCTOS_001 :
                require_once NEGOCIO . CONFIGURACION . "NProducto.php";
                $data = (new \negocio\configuracion\NProducto)->consultarProductos();
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
        }
        break;
    case Recursos::R_PRO_VEN:
         switch ($transaccion) {
            case Servicios::S_CONSULTAR_PRODUCTOS_002:
                require_once NEGOCIO . CONFIGURACION . "NProducto.php";
                $user = new \dto\seguridad\UsuarioDTO($data->UsuarioDTO, false);
                $data = (new \negocio\configuracion\NProducto)->consultarProductosVendidos($user);
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
         }
         break;
     case Recursos::R_CLIENTE:
         switch ($transaccion) {
            case Servicios::S_CREAR_PEDIDO_001:
                require_once NEGOCIO . VENTAS . "NPedido.php";
                $pedido = new dto\ventas\PedidoDTO($data->PedidoDTO, false);
                $data = (new negocio\ventas\NPedido)->crearPedido($pedido);
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
            case Servicios::S_CONSULTAR_PEDIDOS_001 :
                require_once NEGOCIO . VENTAS . "NPedido.php";
                $user = new \dto\seguridad\UsuarioDTO($data->UsuarioDTO, false);
                $data = (new negocio\ventas\NPedido)->consultarPedidos($user);
                $codigoError = Mensajes::$MSJ_ESTADO_CORRECTO["cod"];
                $mensajeError = Mensajes::$MSJ_ESTADO_CORRECTO["mensaje"];
                break;
         }
         break;
}

$jsonOutput->getBodyOutput()->setData($data);

$jsonOutput->getErrorOutput()->setCodigoError($codigoError);
$jsonOutput->getErrorOutput()->setMensajeError($mensajeError);

  }catch(ExpiredException $e){
  $jsonOutput->getErrorOutput()->setCodigoError(Mensajes::$ERROR_TOKEN_EXPIRADO["cod"]);
  $jsonOutput->getErrorOutput()->setMensajeError(Mensajes::$ERROR_TOKEN_EXPIRADO["mensaje"]);
  }catch(SignatureInvalidException $e){
  $jsonOutput->getErrorOutput()->setCodigoError(Mensajes::$ERROR_TOKEN_FIRMA_INVALIDA["cod"]);
  $jsonOutput->getErrorOutput()->setMensajeError(Mensajes::$ERROR_TOKEN_FIRMA_INVALIDA["mensaje"]);
  }catch (Exception $e) {
  //echo $e;
  $jsonOutput->getErrorOutput()->setCodigoError($e->getCode());
  $jsonOutput->getErrorOutput()->setMensajeError($e->getMessage());
  } 

echo json_encode($jsonOutput);
return;

function validarSesion($token, $recurso) {
   // return true;
    if ($recurso == Recursos::R_PUBLICO) {
        return true;
    }

    $usuario = Autentificacion::validarToken($token);
    foreach ($usuario->recursos as &$r) {
        if ($r == $recurso) {
            return true;
        }
    }

    throw new Exception(Mensajes::$ERROR_SERVICIO_NO_AUTORIZADO["mensaje"], Mensajes::$ERROR_SERVICIO_NO_AUTORIZADO["cod"], null);
}
