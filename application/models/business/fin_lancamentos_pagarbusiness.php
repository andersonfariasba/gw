<?php
/* Classe(business): Lançamentos
 * Autor: Anderson Farias
 * Última atualização: 12/07/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class fin_lancamentos_pagarBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

            $objLanc = $this->Factory->createPojo("fin_lancamentos_pagar",$dados);
            $lancDao = $this->Factory->createDao("fin_lancamentos_pagar");
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
    		
    	    $lancDao = $this->Factory->createDao("fin_lancamentos_pagar");
            $lancDao->connect();
            $listLanc = $lancDao->filtro($dados);
            $lancDao->disconnect();
            return $listLanc;

            } catch (Exception $exc) {
                throw $exc;
            }
    }

    
     public function lancamentos_vencidos(){
        try {
            
            $lancDao = $this->Factory->createDao("fin_lancamentos_pagar");
            $lancDao->connect();
            $listLanc = $lancDao->lancamentos_vencidos();
            $lancDao->disconnect();
            return $listLanc;

            } catch (Exception $exc) {
                throw $exc;
            }
    }



    //UTILIZADO NO DASHBOARD
    public function lancamentos_vencidos_cp($dados=null){
        try {
            
            $lancDao = $this->Factory->createDao("fin_lancamentos_pagar");
            $lancDao->connect();
            $listLanc = $lancDao->lancamentos_vencidos_cp($dados);
            $lancDao->disconnect();
            return $listLanc;

            } catch (Exception $exc) {
                throw $exc;
            }
    }

      //FILTRO CONTAS A PAGAR
    public function total_pagamento(){
        try {
            
            $lancDao = $this->Factory->createDao("fin_lancamentos_pagar");
            $lancDao->connect();
            $listLanc = $lancDao->total_pagamento();
            $lancDao->disconnect();
            return $listLanc;

            } catch (Exception $exc) {
                throw $exc;
            }
    }

     //FILTRO CONTAS A PAGAR
    public function listar_por_conta($id_conta){
        try {
            
            $lancDao = $this->Factory->createDao("fin_lancamentos_pagar");
            $lancDao->connect();
            $listLanc = $lancDao->listar_por_conta($id_conta);
            $lancDao->disconnect();
            return $listLanc;

            } catch (Exception $exc) {
                throw $exc;
            }
    }



     
   
    
    //VISUALIZA
    public function visualizar($id_lancamento){
    	try {
    	    $lancDao = $this->Factory->createDao("fin_lancamentos_pagar");
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
    	    $objLanc = $this->Factory->createPojo("fin_lancamentos_pagar",$dados);
            $lancDao = $this->Factory->createDao("fin_lancamentos_pagar");
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
            $lancDao = $this->Factory->createDao("fin_lancamentos_pagar");
            $lancDao->connect();
            $lancDao->alterar_forma_pagamento($dados);
            $lancDao->disconnect();
        } catch (Exception $exc) {
                throw $exc;
            }
    }

     //BAIXA
    public function baixa($dados){
        try {
            $lancDao = $this->Factory->createDao("fin_lancamentos_pagar");
            $lancDao->connect();
            $lancDao->baixa($dados);
            $lancDao->disconnect();
        } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //EXCLUSÃO
    public function excluir($id_lancamento){
    	try {
    	    $lancDao = $this->Factory->createDao("fin_lancamentos_pagar");
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
            $lancDao = $this->Factory->createDao("fin_lancamentos_pagar");
            $lancDao->connect();
            $lancDao->excluir_por_conta($id_conta);
            $lancDao->disconnect();
        } catch (Exception $exc) {
                throw $exc;
            }
    }




}
?>
