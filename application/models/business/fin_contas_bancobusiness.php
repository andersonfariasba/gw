<?php
/* Classe(business): Contas
 * Autor: Anderson Farias
 * Última atualização: 12/07/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class fin_contas_bancoBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

            $objConta = $this->Factory->createPojo("fin_contas_banco",$dados);
            $contaDao = $this->Factory->createDao("fin_contas_banco");
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
    		
    	    $contaDao = $this->Factory->createDao("fin_contas_banco");
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
    	    $contaDao = $this->Factory->createDao("fin_contas_banco");
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
    	    $objConta = $this->Factory->createPojo("fin_contas_banco",$dados);
            $contaDao = $this->Factory->createDao("fin_contas_banco");
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
    	    $contaDao = $this->Factory->createDao("fin_contas_banco");
            $contaDao->connect();
            $contaDao->excluir($id_conta);
            $contaDao->disconnect();
    	} catch (Exception $exc) {
                throw $exc;
            }
    }




}
?>
