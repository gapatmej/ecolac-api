<?php namespace negocio\ventas;

require_once ENTIDADES . VENTAS . 'DetallePedido.php';

require_once DTO . VENTAS . 'DetallePedidoDTO.php';

require_once DAO . VENTAS . 'DetallePedidoDAO.php';

require_once NEGOCIO . CONFIGURACION . "NProducto.php";

use entidades\ventas\DetallePedido;
use dao\ventas\DetallePedidoDAO;
use dto\ventas\DetallePedidoDTO;
use negocio\configuracion\NProducto;

use entidades\configuracion\Producto;

use Exception;
use config\Mensajes;
use config\Constantes;

/**
 * Description of NPedido
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   26/06/2019
 * 
 */
class NDetallePedido {

    private $detallePedidoDAO;
    private $nProducto;

    public function __construct() {
        $this->detallePedidoDAO = new DetallePedidoDAO();
        $this->nProducto = new NProducto();
    }
    
    public function guardarValidaStock($idPedido, DetallePedidoDTO $detallePedidoDTO) {
        $producto = json_decode(json_encode($this->nProducto->obtenerProducto($detallePedidoDTO->producto->idProducto)));
        if($producto->stock < $detallePedidoDTO->cantidad ){
            throw new Exception(Mensajes::$ERROR_STOCK_PRODUCTO_AGOTADO["mensaje"].$producto->nombre, Mensajes::$ERROR_STOCK_PRODUCTO_AGOTADO["cod"], null);
        }
        
        $detallePedido = new DetallePedido();
        $detallePedido->setDescripcion($detallePedidoDTO->descripcion);
        $detallePedido->setCantidad($detallePedidoDTO->cantidad);
        $detallePedido->setPrecioUnitario($detallePedidoDTO->precioUnitario);
        $detallePedido->setTotal($detallePedidoDTO->total);
        $detallePedido->setEstado(Constantes::PENDIENTE);
        $detallePedido->setIdProducto($detallePedidoDTO->producto->idProducto);
        $detallePedido->setIdPedido($idPedido);
        
        $this->detallePedidoDAO->guardar((object) $detallePedido);
        $this->nProducto->actualizarStockProducto($detallePedidoDTO->producto->idProducto, $detallePedidoDTO->cantidad *(-1));
        
    }
    
    public function obtenerPorPedido($idPedido) {
        $result = $this->detallePedidoDAO->obtenerPorPedido($idPedido);
        $detallesPedido = array();
        if($result){
             foreach($result as $detallePedido){
                $detallePedidoDTO = new DetallePedidoDTO(json_decode(json_encode($detallePedido)),true);
                $detallesPedido[] = $detallePedidoDTO;
            }
        }
        return $detallesPedido;
    }

    public function eliminarPorPedido($idPedido) {
        $result = $this->detallePedidoDAO->obtenerPorPedido($idPedido);

        foreach ($result as $detallePedido) {
            $detallePedidoDTO = new DetallePedidoDTO(json_decode(json_encode($detallePedido)), true);
            $this->nProducto->actualizarStockProducto($detallePedidoDTO->producto, $detallePedidoDTO->cantidad);
            $this->detallePedidoDAO->eliminar($detallePedidoDTO->idDetallePedido);
        }
    }

    public function actualizarEstadoDespachadoPorId(DetallePedidoDTO $detallePedidoDTO ){
        //return $detallePedidoDTO->idDetallePedido;
        $this->detallePedidoDAO->actualizarEstadoPorId($detallePedidoDTO->idDetallePedido, Constantes::DESPACHADO);
    }
    public function actualizarEstadoDespachadoPorPedido($idPedido ){
        $this->detallePedidoDAO->actualizarEstadoPorPedido($idPedido, Constantes::DESPACHADO);
    }
}
