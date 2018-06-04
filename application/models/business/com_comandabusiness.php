<?php
/* Classe(business): Pedidos Itens
 * Autor: Anderson Farias
 * Última atualização: 11/10/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Com_comandaBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

            $objItem = $this->Factory->createPojo("com_comanda",$dados);
            $itemDao = $this->Factory->createDao("com_comanda");
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
    		
    	    $itemDao = $this->Factory->createDao("com_comanda");
            $itemDao->connect();
            $listPedido = $itemDao->listar($id_pedido);
            $itemDao->disconnect();
            return $listPedido;

            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //VISUALIZA
    public function visualizar($id_comanda){
    	try {
    	    $itemDao = $this->Factory->createDao("com_comanda");
            $itemDao->connect();
            $objItem = $itemDao->visualizar($id_comanda);
            $itemDao->disconnect();
            return $objItem;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    
    //EDITAR
    public function editar($dados){
    	try {
    	    $objItem = $this->Factory->createPojo("com_comanda",$dados);
            $itemDao = $this->Factory->createDao("com_comanda");
            $itemDao->connect();
            $itemDao->alterar($objItem);
            $itemDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }


     //VISUALIZA
    public function item_validar($id_pedido,$id_produto){
        try {
            $itemDao = $this->Factory->createDao("com_comanda");
            $itemDao->connect();
            $objItem = $itemDao->item_validar($id_pedido,$id_produto);
            $itemDao->disconnect();
            return $objItem;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //EXCLUSÃO
    public function excluir($id_comanda){
    	try {
    	    $itemDao = $this->Factory->createDao("com_comanda");
            $itemDao->connect();
            $itemDao->excluir($id_comanda);
            $itemDao->disconnect();
    	} catch (Exception $exc) {
                throw $exc;
            }
    }


   



}
?>
