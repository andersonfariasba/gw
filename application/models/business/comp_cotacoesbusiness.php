<?php
/* Classe(business): Pedidos Itens
 * Autor: Anderson Farias
 * Última atualização: 11/10/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Comp_cotacoesBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

            $objItem = $this->Factory->createPojo("comp_cotacoes",$dados);
            $itemDao = $this->Factory->createDao("comp_cotacoes");
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
    public function listar($id_item){
    	try {
    		
    	    $itemDao = $this->Factory->createDao("comp_cotacoes");
            $itemDao->connect();
            $listPedido = $itemDao->listar($id_item);
            $itemDao->disconnect();
            return $listPedido;

            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //VISUALIZA
    public function visualizar($id_cotacao){
    	try {
    	    $itemDao = $this->Factory->createDao("comp_cotacoes");
            $itemDao->connect();
            $objItem = $itemDao->visualizar($id_cotacao);
            $itemDao->disconnect();
            return $objItem;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    
    //EDITAR
    public function editar($dados){
    	try {
    	    //$objItem = $this->Factory->createPojo("comp_cotacoes",$dados);
            $itemDao = $this->Factory->createDao("comp_cotacoes");
            $itemDao->connect();
            $itemDao->alterar($dados);
            $itemDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }

      //EDITAR
    public function editar_todos_itens($dados){
        try {
            //$objItem = $this->Factory->createPojo("comp_cotacoes",$dados);
            $itemDao = $this->Factory->createDao("comp_cotacoes");
            $itemDao->connect();
            $itemDao->alterar_todos_itens($dados);
            $itemDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }



   

    
    //EXCLUSÃO
    public function excluir($id_cotacao){
    	try {
    	    $itemDao = $this->Factory->createDao("comp_cotacoes");
            $itemDao->connect();
            $itemDao->excluir($id_cotacao);
            $itemDao->disconnect();
    	} catch (Exception $exc) {
                throw $exc;
            }
    }

      //LISTA
    public function ajax_listar_cotacao($id_item){
        try {
            
            $fatDao = $this->Factory->createDao("comp_cotacoes");
            $fatDao->connect();
            $listFat = $fatDao->ajax_listar_cotacao($id_item);
            $fatDao->disconnect();
            return $listFat;

            } catch (Exception $exc) {
                throw $exc;
            }
    }

     public function ajax_listar_fornecedor($id_solicitacao){
        try {
            
            $fatDao = $this->Factory->createDao("comp_cotacoes");
            $fatDao->connect();
            $listFat = $fatDao->ajax_listar_fornecedor($id_solicitacao);
            $fatDao->disconnect();
            return $listFat;

            } catch (Exception $exc) {
                throw $exc;
            }
    }


      //LISTA
    public function cotacao_lancada($id_solicitacao){
        try {
            
            $itemDao = $this->Factory->createDao("comp_cotacoes");
            $itemDao->connect();
            $listPedido = $itemDao->cotacao_lancada($id_solicitacao);
            $itemDao->disconnect();
            return $listPedido;

            } catch (Exception $exc) {
                throw $exc;
            }
    }


      //LISTA
    public function qtd_cotacao_lancada($id_solicitacao){
        try {
            
            $itemDao = $this->Factory->createDao("comp_cotacoes");
            $itemDao->connect();
            $listPedido = $itemDao->qtd_cotacao_lancada($id_solicitacao);
            $itemDao->disconnect();
            return $listPedido;

            } catch (Exception $exc) {
                throw $exc;
            }
    }

     //LISTA
    public function verificar_cotacao_parcial($id_solicitacao){
        try {
            
            $itemDao = $this->Factory->createDao("comp_cotacoes");
            $itemDao->connect();
            $listPedido = $itemDao->verificar_cotacao_parcial($id_solicitacao);
            $itemDao->disconnect();
            return $listPedido;

            } catch (Exception $exc) {
                throw $exc;
            }
    }


     //LISTA
    public function listar_itens_fornecedor($id_solicitacao,$id_fornecedor){
        try {
            
            $produtoDao = $this->Factory->createDao("comp_cotacoes");
            $produtoDao->connect();
            $listProduto = $produtoDao->listar_itens_fornecedor($id_solicitacao,$id_fornecedor);
            $produtoDao->disconnect();
            return $listProduto;

            } catch (Exception $exc) {
                throw $exc;
            }
    }


   

   



}
?>
