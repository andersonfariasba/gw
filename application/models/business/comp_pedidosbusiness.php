<?php
/* Classe(business): Pedidos
 * Autor: Anderson Farias
 * Última atualização: 01/10/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Comp_pedidosBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

            $objPedido = $this->Factory->createPojo("comp_pedidos",$dados);
            $pedidoDao = $this->Factory->createDao("comp_pedidos");
            $pedidoDao->connect();
            $cod_pedido = $pedidoDao->cadastrar($objPedido);
	        $pedidoDao->disconnect();
            return $cod_pedido;
	        
        } 
        
        catch (Exception $exc) {
	        throw $exc;
        }
    }

    //LISTA
    public function filtro($dados=null){
    	try {
    		
    	    $pedidoDao = $this->Factory->createDao("comp_pedidos");
            $pedidoDao->connect();
            $listPedido = $pedidoDao->filtro($dados);
            $pedidoDao->disconnect();
            return $listPedido;

            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //VISUALIZA
    public function visualizar($id_pedido){
    	try {
    	    $pedidoDao = $this->Factory->createDao("comp_pedidos");
            $pedidoDao->connect();
            $objPedido = $pedidoDao->visualizar($id_pedido);
            $pedidoDao->disconnect();
            return $objPedido;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }

     //VISUALIZA
    public function visualizar_por_solicitacao($id_solicitacao,$id_fornecedor){
        try {
            $pedidoDao = $this->Factory->createDao("comp_pedidos");
            $pedidoDao->connect();
            $objPedido = $pedidoDao->visualizar_por_solicitacao($id_solicitacao,$id_fornecedor);
            $pedidoDao->disconnect();
            return $objPedido;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    
    //EDITAR
    public function editar($dados){
    	try {
    	    //$objPedido = $this->Factory->createPojo("comp_pedidos",$dados);
            $pedidoDao = $this->Factory->createDao("comp_pedidos");
            $pedidoDao->connect();
            $pedidoDao->alterar($dados);
            $pedidoDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }



     //EXCLUSÃO
    public function excluir($id_pedido){
    	try {
    	    $pedidoDao = $this->Factory->createDao("comp_pedidos");
            $pedidoDao->connect();
            $pedidoDao->excluir($id_pedido);
            $pedidoDao->disconnect();
    	} catch (Exception $exc) {
                throw $exc;
            }
    }

     public function ultima_compra($id_produto) {
              try {
              $contaDao = $this->Factory->createDao("comp_pedidos");

              $contaDao->connect();
              $listConta = $contaDao->ultima_compra($id_produto);
              $contaDao->disconnect();


              return $listConta;
              } catch (Exception $ex) {
              throw $ex;
              }
    }

     //LISTA
    public function listar_centro_custo($id_pedido){
        try {
            
            $pedidoDao = $this->Factory->createDao("comp_pedidos");
            $pedidoDao->connect();
            $listPedido = $pedidoDao->listar_centro_custo($id_pedido);
            $pedidoDao->disconnect();
            return $listPedido;

            } catch (Exception $exc) {
                throw $exc;
            }
    }




}
?>
