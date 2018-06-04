<?php
/* Classe(business): Lançamentos
 * Autor: Anderson Farias
 * Última atualização: 12/07/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class fin_lancamentos_receberBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

            $objLanc = $this->Factory->createPojo("fin_lancamentos_receber",$dados);
            $lancDao = $this->Factory->createDao("fin_lancamentos_receber");
            $lancDao->connect();
            $cod_lanc = $lancDao->cadastrar($objLanc);
	        $lancDao->disconnect();
            return $cod_lanc;
	        
        } 
        
        catch (Exception $exc) {
	        throw $exc;
        }
    }

    //FILTRO CONTAS A PAGAR
    public function filtro($dados=null){
    	try {
    		
    	    $lancDao = $this->Factory->createDao("fin_lancamentos_receber");
            $lancDao->connect();
            $listLanc = $lancDao->filtro($dados);
            $lancDao->disconnect();
            return $listLanc;

            } catch (Exception $exc) {
                throw $exc;
            }
    }


     //FILTRO CONTAS A PAGAR
    public function total_recebimento(){
        try {
            
            $lancDao = $this->Factory->createDao("fin_lancamentos_receber");
            $lancDao->connect();
            $listLanc = $lancDao->total_recebimento();
            $lancDao->disconnect();
            return $listLanc;

            } catch (Exception $exc) {
                throw $exc;
            }
    }



     
   
    
    //VISUALIZA
    public function visualizar($id_lancamento){
    	try {
    	    $lancDao = $this->Factory->createDao("fin_lancamentos_receber");
            $lancDao->connect();
            $objLanc = $lancDao->visualizar($id_lancamento);
            $lancDao->disconnect();
            return $objLanc;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    
    //EDITAR
    public function editar($dados){
    	try {
    	    $objLanc = $this->Factory->createPojo("fin_lancamentos_receber",$dados);
            $lancDao = $this->Factory->createDao("fin_lancamentos_receber");
            $lancDao->connect();
            $lancDao->alterar($objLanc);
            $lancDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }


     //ALTERAR FORMA DE PAGAMENTO
    public function alterar_forma_pagamento($dados){
        try {
            $lancDao = $this->Factory->createDao("fin_lancamentos_receber");
            $lancDao->connect();
            $lancDao->alterar_forma_pagamento($dados);
            $lancDao->disconnect();
        } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //EXCLUSÃO
    public function excluir($id_lancamento){
    	try {
    	    $lancDao = $this->Factory->createDao("fin_lancamentos_receber");
            $lancDao->connect();
            $lancDao->excluir($id_lancamento);
            $lancDao->disconnect();
    	} catch (Exception $exc) {
                throw $exc;
            }
    }


     //EXCLUSÃO
    public function excluir_por_conta($id_conta){
        try {
            $lancDao = $this->Factory->createDao("fin_lancamentos_receber");
            $lancDao->connect();
            $lancDao->excluir_por_conta($id_conta);
            $lancDao->disconnect();
        } catch (Exception $exc) {
                throw $exc;
            }
    }


     //EXCLUSÃO
    public function excluir_por_faturamento($id_forma_fat){
        try {
            $lancDao = $this->Factory->createDao("fin_lancamentos_receber");
            $lancDao->connect();
            $lancDao->excluir_por_faturamento($id_forma_fat);
            $lancDao->disconnect();
        } catch (Exception $exc) {
                throw $exc;
            }
    }


    //EXCLUSÃO
    public function confirmar_faturamento_lanc($id_conta){
        try {
            $lancDao = $this->Factory->createDao("fin_lancamentos_receber");
            $lancDao->connect();
            $lancDao->confirmar_faturamento_lanc($id_conta);
            $lancDao->disconnect();
        } catch (Exception $exc) {
                throw $exc;
            }
    }


     //TOTAL PEDIDO
    public function total_venda($id_pedido){
        try {
            $itemDao = $this->Factory->createDao("fin_lancamentos_receber");
            $itemDao->connect();
            $objItem = $itemDao->total_venda($id_pedido);
            $itemDao->disconnect();
            return $objItem;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    } 


     //LISTAR LANÇAMENTO POR PEDIDO
    public function listar_por_pedido($id_pedido){
        try {
            
            $lancDao = $this->Factory->createDao("fin_lancamentos_receber");
            $lancDao->connect();
            $listLanc = $lancDao->listar_por_pedido($id_pedido);
            $lancDao->disconnect();
            return $listLanc;

            } catch (Exception $exc) {
                throw $exc;
            }
    }








}
?>
