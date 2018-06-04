<?php
/* Classe(business): Centro de custos
 * Autor: Anderson Farias
 * Última atualização: 03/07/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Fin_formas_recebimentosBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

            $objForma = $this->Factory->createPojo("fin_formas_recebimentos",$dados);
            $formaDao = $this->Factory->createDao("fin_formas_recebimentos");
            $formaDao->connect();
            $cod_forma = $formaDao->cadastrar($objForma);
	    $formaDao->disconnect();
            return $cod_forma;
	        
        } 
        
        catch (Exception $exc) {
	        throw $exc;
        }
    }

    //LISTA
    public function filtro($dados=null){
    	try {
    		
    	    $formaDao = $this->Factory->createDao("fin_formas_recebimentos");
            $formaDao->connect();
            $listForma = $formaDao->filtro($dados);
            $formaDao->disconnect();
            return $listForma;

            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    
    //LISTA
    public function visualizarFormaCartao($cartao){
    	try {
    		
    	    $formaDao = $this->Factory->createDao("fin_formas_recebimentos");
            $formaDao->connect();
            $listForma = $formaDao->visualizarFormaCartao($cartao);
            $formaDao->disconnect();
            return $listForma;

            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    
    
    
    //VISUALIZA
    public function visualizar($id_forma){
    	try {
    	    $formaDao = $this->Factory->createDao("fin_formas_recebimentos");
            $formaDao->connect();
            $objForma = $formaDao->visualizar($id_forma);
            $formaDao->disconnect();
            return $objForma;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    
    //EDITAR
    public function editar($dados){
    	try {
    	    $objForma = $this->Factory->createPojo("fin_formas_recebimentos",$dados);
            $formaDao = $this->Factory->createDao("fin_formas_recebimentos");
            $formaDao->connect();
            $formaDao->alterar($objForma);
            $formaDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //EXCLUSÃO
    public function excluir($id_forma){
    	try {
    	    $formaDao = $this->Factory->createDao("fin_formas_recebimentos");
            $formaDao->connect();
            $formaDao->excluir($id_forma);
            $formaDao->disconnect();
    	} catch (Exception $exc) {
                throw $exc;
            }
    }


      //LISTA
    public function ajax_listar(){
        try {
            
            $formaDao = $this->Factory->createDao("fin_formas_recebimentos");
            $formaDao->connect();
            $listForma = $formaDao->ajax_listar();
            $formaDao->disconnect();
            return $listForma;

            } catch (Exception $exc) {
                throw $exc;
            }
    }

      //LISTA
    public function verificar_cartao($id_forma){
        try {
            
            $formaDao = $this->Factory->createDao("fin_formas_recebimentos");
            $formaDao->connect();
            $listForma = $formaDao->verificar_cartao($id_forma);
            $formaDao->disconnect();
            return $listForma;

            } catch (Exception $exc) {
                throw $exc;
            }
    }

     //LISTA
    public function exibir_parcela($id_forma){
        try {
            
            $formaDao = $this->Factory->createDao("fin_formas_recebimentos");
            $formaDao->connect();
            $listForma = $formaDao->exibir_parcela($id_forma);
            $formaDao->disconnect();
            return $listForma;

            } catch (Exception $exc) {
                throw $exc;
            }
    }




}
?>
