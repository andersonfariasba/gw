<?php
/* Classe(business): Contas
 * Autor: Anderson Farias
 * Última atualização: 12/07/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Fin_contasBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

            $objConta = $this->Factory->createPojo("fin_contas",$dados);
            $contaDao = $this->Factory->createDao("fin_contas");
            $contaDao->connect();
            $cod_conta = $contaDao->cadastrar($objConta);
	    $contaDao->disconnect();
            return $cod_conta;
	        
        } 
        
        catch (Exception $exc) {
	        throw $exc;
        }
    }

    //LISTA
    public function filtro($dados=null){
    	try {
    		
    	    $contaDao = $this->Factory->createDao("fin_contas");
            $contaDao->connect();
            $listConta = $contaDao->filtro($dados);
            $contaDao->disconnect();
            return $listConta;

            } catch (Exception $exc) {
                throw $exc;
            }
    }

        //LISTA
    public function filtro_recebimento_resumo($dados=null){
        try {
            
            $contaDao = $this->Factory->createDao("fin_contas");
            $contaDao->connect();
            $listConta = $contaDao->filtro_recebimento_resumo($dados);
            $contaDao->disconnect();
            return $listConta;

            } catch (Exception $exc) {
                throw $exc;
            }
    }


      //LISTA
    public function filtro_pedido_total($dados=null){
        try {
            
            $contaDao = $this->Factory->createDao("fin_contas");
            $contaDao->connect();
            $listConta = $contaDao->filtro_pedido_total($dados);
            $contaDao->disconnect();
            return $listConta;

            } catch (Exception $exc) {
                throw $exc;
            }
    }


      //LISTA
    public function filtro_contas_cartao($dados=null){
        try {
            
            $contaDao = $this->Factory->createDao("fin_contas");
            $contaDao->connect();
            $listConta = $contaDao->filtro_contas_cartao($dados);
            $contaDao->disconnect();
            return $listConta;

            } catch (Exception $exc) {
                throw $exc;
            }
    }




      //LISTA
    public function filtro_compra_total($dados=null){
        try {
            
            $contaDao = $this->Factory->createDao("fin_contas");
            $contaDao->connect();
            $listConta = $contaDao->filtro_compra_total($dados);
            $contaDao->disconnect();
            return $listConta;

            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //VISUALIZA
    public function visualizar($id_conta){
    	try {
    	    $contaDao = $this->Factory->createDao("fin_contas");
            $contaDao->connect();
            $objConta = $contaDao->visualizar($id_conta);
            $contaDao->disconnect();
            return $objConta;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }


      //VISUALIZA
    public function visualizar_por_pedido($id_pedido){
        try {
            $contaDao = $this->Factory->createDao("fin_contas");
            $contaDao->connect();
            $objConta = $contaDao->visualizar_por_pedido($id_pedido);
            $contaDao->disconnect();
            return $objConta;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    
    
    //EDITAR
    public function editar($dados){
    	try {
    	    $objConta = $this->Factory->createPojo("fin_contas",$dados);
            $contaDao = $this->Factory->createDao("fin_contas");
            $contaDao->connect();
            $contaDao->alterar($objConta);
            $contaDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //EXCLUSÃO
    public function excluir($id_conta){
    	try {
    	    $contaDao = $this->Factory->createDao("fin_contas");
            $contaDao->connect();
            $contaDao->excluir($id_conta);
            $contaDao->disconnect();
    	} catch (Exception $exc) {
                throw $exc;
            }
    }


     //EXCLUSÃO
    public function excluir_por_pedido($id_pedido){
        try {
            $contaDao = $this->Factory->createDao("fin_contas");
            $contaDao->connect();
            $contaDao->excluir_por_pedido($id_pedido);
            $contaDao->disconnect();
        } catch (Exception $exc) {
                throw $exc;
            }
    }





       //EDITAR
    public function editar_tela_lanc($dados){
        try {
            //$objConta = $this->Factory->createPojo("fin_contas",$dados);
            $contaDao = $this->Factory->createDao("fin_contas");
            $contaDao->connect();
            $contaDao->editar_tela_lanc($dados);
            $contaDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }




}
?>
