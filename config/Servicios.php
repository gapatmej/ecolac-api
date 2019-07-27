<?php namespace config;

/**
 * Description of Servicios
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   13/06/2019
 * 
 */
abstract class Servicios {
    //Servicios Públicos
    const S_LOGIN001= "servicioLogin001";
    
    const S_CREAR_USUARIO_001= "servicioCrearUsuario001";
    const S_CREAR_USUARIO_002= "servicioCrearUsuario002";
    const S_ACTUALIZAR_USUARIO_001= "servicioActualizarUsuario001";
    const S_CONSULTAR_USUARIOS_001= "servicioConsultarUsuarios001";
    const S_CONSULTAR_USUARIOS_002= "servicioConsultarUsuarios002";
    const S_ELIMINAR_USUARIO_001= "servicioEliminarUsuario001";
    
    const S_CREAR_ROL_001= "servicioCrearRol001";
    const S_ACTUALIZAR_ROL_001= "servicioActualizarRol001";
    const S_CONSULTAR_ROLES_001= "servicioConsultarRoles001";
    
    const S_CONSULTAR_RECURSOS_001 = "servicioConsultarRecursos001";
    
    const S_CREAR_UNIDAD_MEDIDA_001= "servicioCrearUnidadMedida001";
    const S_ACTUALIZAR_UNIDAD_MEDIDA_001= "servicioActualizarUnidadMedida001";
    const S_CONSULTAR_UNIDADES_MEDIDA_001 = "servicioConsultarUnidadesMedida001";
    
    const S_CREAR_PRESENTACION_PRODUCTO_001= "servicioCrearPresentacionProducto001";
    const S_ACTUALIZAR_PRESENTACION_PRODUCTO_001= "servicioActualizarPresentacionProducto001";
    const S_CONSULTAR_PRESENTACIONES_PRODUCTO_001 = "servicioConsultarPresentacionesProducto001";
    
    const S_CREAR_CATEGORIA_PRODUCTO_001= "servicioCrearCategoriaProducto001";
    const S_ACTUALIZAR_CATEGORIA_PRODUCTO_001= "servicioActualizarCategoriaProducto001";
    const S_CONSULTAR_CATEGORIAS_PRODUCTO_001 = "servicioConsultarCategoriasProducto001";
    
    const S_CREAR_LINEA_PRODUCTO_001= "servicioCrearLineaProducto001";
    const S_ACTUALIZAR_LINEA_PRODUCTO_001= "servicioActualizarLineaProducto001";
    const S_CONSULTAR_LINEAS_PRODUCTO_001 = "servicioConsultarLineasProducto001";
    
    const S_CREAR_PRODUCTO_001= "servicioCrearProducto001";
    const S_ACTUALIZAR_PRODUCTO_001= "servicioActualizarProducto001";
    const S_CONSULTAR_PRODUCTO_001 = "servicioConsultarProducto001";
    const S_CONSULTAR_PRODUCTOS_001 = "servicioConsultarProductos001";
    const S_CONSULTAR_PRODUCTOS_002 = "servicioConsultarProductos002";
    
    const S_CREAR_PEDIDO_001= "servicioCrearPedido001";
    const S_ACTUALIZAR_PEDIDO_001= "servicioActualizarPedido001";
    const S_ACTUALIZAR_DETALLE_PEDIDO_001= "servicioActualizarDetallePedido001";
    const S_CONSULTAR_PEDIDOS_001 = "servicioConsultarPedidos001";
    
}

abstract class Recursos {

    const R_PUBLICO= "PUBLICO";
    const R_GES_USU= "GES_USU";
    const R_GES_ROL= "GES_ROL";
    const R_GES_UNI_ME= "GES_UNI_ME";
    const R_GES_PRE= "GES_PRE";
    const R_GES_CAT= "GES_CAT";
    const R_GES_LIN= "GES_LIN";
    const R_GES_PRO= "GES_PRO";
    const R_GES_PED= "GES_PED";
    const R_PRO_VEN= "PRO_VEN";

}
