<?php
/* Classe(business): Contas
 * Autor: Anderson Farias
 * Última atualização: 12/07/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class fin_contas_pagarBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

            $objConta = $this->Factory->createPojo("fin_contas_pagar",$dados);
            $contaDao = $this->Factory->createDao("fin_contas_pagar");
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
    		
    	    $contaDao = $this->Factory->createDao("fin_contas_pagar");
            $contaDao->connect();
            $listConta = $contaDao->filtro($dados);
            $contaDao->disconnect();
            return $listConta;

            } catch (Exception $exc) {
                throw $exc;
            }
    }

    


    //VISUALIZA
    public function visualizar($id_conta){
    	try {
    	    $contaDao = $this->Factory->createDao("fin_contas_pagar");
            $contaDao->connect();
            $objConta = $contaDao->visualizar($id_conta);
            $contaDao->disconnect();
            return $objConta;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }


  
    
    
    //EDITAR
    public function editar($dados){
    	try {
    	    $objConta = $this->Factory->createPojo("fin_contas_pagar",$dados);
            $contaDao = $this->Factory->createDao("fin_contas_pagar");
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
    	    $contaDao = $this->Factory->createDao("fin_contas_pagar");
            $contaDao->connect();
            $contaDao->excluir($id_conta);
            $contaDao->disconnect();
    	} catch (Exception $exc) {
                throw $exc;
            }
    }

     //EDITAR
    public function editar_tela_lanc($dados){
        try {
            //$objConta = $this->Factory->createPojo("fin_contas",$dados);
            $contaDao = $this->Factory->createDao("fin_contas_pagar");
            $contaDao->connect();
            $contaDao->editar_tela_lanc($dados);
            $contaDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }

     //LISTA
    public function resumo_conta_pagar($dados=null){
        try {
            
            $contaDao = $this->Factory->createDao("fin_contas_pagar");
            $contaDao->connect();
            $listConta = $contaDao->resumo_conta_pagar($dados);
            $contaDao->disconnect();
            return $listConta;

            } catch (Exception $exc) {
                throw $exc;
            }
    }



   




      




}
?>
