<?php namespace negocio\ventas;

 require_once ENTIDADES.VENTAS.'Pedido.php';
 require_once ENTIDADES.VENTAS.'DetallePedido.php';
 
 require_once DTO.VENTAS.'PedidoDTO.php';
 require_once DTO.SEGURIDAD."UsuarioDTO.php";
 
 require_once DAO.VENTAS.'PedidoDAO.php';
 
 require_once NEGOCIO . VENTAS . "NDetallePedido.php";
 require_once NEGOCIO . SEGURIDAD . "NUsuario.php";
 
 use config\Constantes;
 
 use entidades\ventas\Pedido;
 
 use dao\ventas\PedidoDAO;
 
 use dto\seguridad\UsuarioDTO;
 use dto\ventas\PedidoDTO;
 use dto\ventas\DetallePedidoDTO;
 
 use negocio\ventas\NDetallePedido;
 use negocio\seguridad\NUsuario;
 
 use Exception;
/**
 * Description of NPedido
 *
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   26/06/2019
 * 
 */
class NPedido {
    private $pedidoDAO;
    private $nDetallePedido;
    private $nUsuario;
    
    public function __construct() {
       $this->pedidoDAO = new PedidoDAO();
       $this->nUsuario = new NUsuario();
       $this->nDetallePedido = new NDetallePedido();
    }
    
    public function crearPedido(PedidoDTO $pedidoDTO) {
         $idPedido = null;
         $distanciaDTO;
        try{    
            $pedido = new Pedido();

            $pedido->setIdPedido("");
            $pedido->setFecha($pedidoDTO->fecha);
            $pedido->setEstado(Constantes::ELABORADO);
            $pedido->setDireccion($pedidoDTO->direccion);
            $pedido->setCiudad($pedidoDTO->ciudad);
            $pedido->setTelefono($pedidoDTO->telefono);
            $pedido->setSubtotal($pedidoDTO->subtotal);
            $pedido->setIva($pedidoDTO->iva);
            $pedido->setTotal($pedidoDTO->total);
            $pedido->setIdCliente($pedidoDTO->cliente->UsuarioDTO->username);
            $pedido->setIdVendedor($pedidoDTO->vendedor->UsuarioDTO->username);
            
            $cliente = new UsuarioDTO($pedidoDTO->cliente->UsuarioDTO,false);
            $distanciaDTO = $this->nUsuario->encontrarRepartidor( $cliente);
            $pedido->setIdRepartidor($distanciaDTO->repartidor);

            $idPedido = $this->pedidoDAO->guardar((object)$pedido);
            //Guardamos los detalles del pedido
            foreach ($pedidoDTO->detallesPedido as &$item){
                $detallePedidoDTO = new DetallePedidoDTO($item->DetallePedidoDTO, false);
                $this->nDetallePedido->guardarValidaStock($idPedido, $detallePedidoDTO);
            }
            
        }catch(\Exception $e){
            if($idPedido != null){
                $this->nDetallePedido->eliminarPorPedido($idPedido);
                $this->pedidoDAO->eliminar($idPedido);
            }
            throw new Exception($e->getMessage(),$e->getCode(),null);
        }
        return $distanciaDTO;
    }
    
    public function consultarPedidos(UsuarioDTO $usuarioDTO) {
        if($usuarioDTO->esCliente){
            $result = $this->pedidoDAO->obtenerPedidosCliente($usuarioDTO->username);
        }else if($usuarioDTO->esAdministrador){
            $result = $this->pedidoDAO->obtenerTodo();
        }else if($usuarioDTO->esRepartidor){
            $result =  $this->pedidoDAO->obtenerPedidosRepartidor($usuarioDTO->username);
        }else{
            $result = $this->pedidoDAO->obtenerPedidosVendedor($usuarioDTO->username);
        }
        
        foreach($result as $pedido){
            $pedidoDTO = new PedidoDTO(json_decode(json_encode($pedido)),true);
            $pedidoDTO->cliente = $this->nUsuario->consultarUsuario($pedidoDTO->cliente);
            $pedidoDTO->detallesPedido = $this->nDetallePedido->obtenerPorPedido($pedidoDTO->idPedido); 
            $listaPedidos[] = $pedidoDTO;
        }
        return $listaPedidos;  
    }
    
    public function actualizarEstadoDespachado(PedidoDTO $pedidoDTO ){
        $this->pedidoDAO->actualizarEstado($pedidoDTO->idPedido, Constantes::DESPACHADO);
        $this->nDetallePedido->actualizarEstadoDespachadoPorPedido($pedidoDTO->idPedido);        
    }

    
}
