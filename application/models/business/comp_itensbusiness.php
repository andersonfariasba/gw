<?php
/* Classe(business): Pedidos Itens
 * Autor: Anderson Farias
 * Última atualização: 11/10/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Comp_itensBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

            $objItem = $this->Factory->createPojo("comp_itens",$dados);
            $itemDao = $this->Factory->createDao("comp_itens");
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
    public function filtro($id_solicitacao){
        try {
            
            $itemDao = $this->Factory->createDao("comp_itens");
            $itemDao->connect();
            $listPedido = $itemDao->filtro($id_solicitacao);
            $itemDao->disconnect();
            return $listPedido;

            } catch (Exception $exc) {
                throw $exc;
            }
    }


    //LISTA
    public function listar($id_solicitacao){
    	try {
    		
    	    $itemDao = $this->Factory->createDao("comp_itens");
            $itemDao->connect();
            $listPedido = $itemDao->listar($id_solicitacao);
            $itemDao->disconnect();
            return $listPedido;

            } catch (Exception $exc) {
                throw $exc;
            }
    }

      //LISTA
    public function visualizar_soma($id_item){
        try {
            
            $itemDao = $this->Factory->createDao("comp_itens");
            $itemDao->connect();
            $listPedido = $itemDao->visualizar_soma($id_item);
            $itemDao->disconnect();
            return $listPedido;

            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //VISUALIZA
    public function visualizar($id_item){
    	try {
    	    $itemDao = $this->Factory->createDao("comp_itens");
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
    	    //$objItem = $this->Factory->createPojo("comp_itens",$dados);
            $itemDao = $this->Factory->createDao("comp_itens");
            $itemDao->connect();
            $itemDao->alterar($dados);
            $itemDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }


     public function editar_manual($dados){
        try {
            $itemDao = $this->Factory->createDao("comp_itens");
            $itemDao->connect();
            $itemDao->editar_manual($dados);
            $itemDao->disconnect();
        } catch (Exception $exc) {
                throw $exc;
            }
    }


     //VISUALIZA
    public function item_validar($id_solicitacao,$id_solicitacao){
        try {
            $itemDao = $this->Factory->createDao("comp_itens");
            $itemDao->connect();
            $objItem = $itemDao->item_validar($id_solicitacao,$id_produto);
            $itemDao->disconnect();
            return $objItem;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //EXCLUSÃO
    public function excluir($id_item){
    	try {
    	    $itemDao = $this->Factory->createDao("comp_itens");
            $itemDao->connect();
            $itemDao->excluir($id_item);
            $itemDao->disconnect();
    	} catch (Exception $exc) {
                throw $exc;
            }
    }


    //EXCLUSÃO
    public function excluir_por_pedido($id_solicitacao){
        try {
            $itemDao = $this->Factory->createDao("comp_itens");
            $itemDao->connect();
            $itemDao->excluir_por_pedido($id_solicitacao);
            $itemDao->disconnect();
        } catch (Exception $exc) {
                throw $exc;
            }
    }


   



}
?>
