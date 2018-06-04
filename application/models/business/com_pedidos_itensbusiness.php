<?php
/* Classe(business): Pedidos Itens
 * Autor: Anderson Farias
 * Última atualização: 11/10/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class com_pedidos_itensBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

            $objItem = $this->Factory->createPojo("com_pedidos_itens",$dados);
            $itemDao = $this->Factory->createDao("com_pedidos_itens");
            $itemDao->connect();
            $cod_item = $itemDao->cadastrar($objItem);
	        $itemDao->disconnect();
            return $cod_item;
	        
        } 
        
        catch (Exception $exc) {
	        throw $exc;
        }
    }

    //LISTA
    public function listar($id_pedido){
    	try {
    		
    	    $itemDao = $this->Factory->createDao("com_pedidos_itens");
            $itemDao->connect();
            $listPedido = $itemDao->listar($id_pedido);
            $itemDao->disconnect();
            return $listPedido;

            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //VISUALIZA
    public function visualizar($id_item){
    	try {
    	    $itemDao = $this->Factory->createDao("com_pedidos_itens");
            $itemDao->connect();
            $objItem = $itemDao->visualizar($id_item);
            $itemDao->disconnect();
            return $objItem;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    
    //EDITAR
    public function editar($dados){
    	try {
    	    $objItem = $this->Factory->createPojo("com_pedidos_itens",$dados);
            $itemDao = $this->Factory->createDao("com_pedidos_itens");
            $itemDao->connect();
            $itemDao->alterar($objItem);
            $itemDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }


     public function editar_manual($dados){
        try {
            $itemDao = $this->Factory->createDao("com_pedidos_itens");
            $itemDao->connect();
            $itemDao->editar_manual($dados);
            $itemDao->disconnect();
        } catch (Exception $exc) {
                throw $exc;
            }
    }


     //VISUALIZA
    public function item_validar($id_pedido,$id_produto){
        try {
            $itemDao = $this->Factory->createDao("com_pedidos_itens");
            $itemDao->connect();
            $objItem = $itemDao->item_validar($id_pedido,$id_produto);
            $itemDao->disconnect();
            return $objItem;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //EXCLUSÃO
    public function excluir($id_item){
    	try {
    	    $itemDao = $this->Factory->createDao("com_pedidos_itens");
            $itemDao->connect();
            $itemDao->excluir($id_item);
            $itemDao->disconnect();
    	} catch (Exception $exc) {
                throw $exc;
            }
    }


    //EXCLUSÃO
    public function excluir_por_pedido($id_pedido){
        try {
            $itemDao = $this->Factory->createDao("com_pedidos_itens");
            $itemDao->connect();
            $itemDao->excluir_por_pedido($id_pedido);
            $itemDao->disconnect();
        } catch (Exception $exc) {
                throw $exc;
            }
    }


    //TOTAL PEDIDO
    public function valor_total($id_pedido){
        try {
            $itemDao = $this->Factory->createDao("com_pedidos_itens");
            $itemDao->connect();
            $objItem = $itemDao->valor_total($id_pedido);
            $itemDao->disconnect();
            return $objItem;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }




}
?>
