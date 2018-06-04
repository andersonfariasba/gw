<?php
/* Classe(business): Forma de pagamentos para faturamento
 * Autor: Anderson Farias
 * Última atualização: 03/07/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Fin_forma_pag_fatBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

            $objForma = $this->Factory->createPojo("fin_forma_pag_fat",$dados);
            $formaDao = $this->Factory->createDao("fin_forma_pag_fat");
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
    		
    	    $formaDao = $this->Factory->createDao("fin_forma_pag_fat");
            $formaDao->connect();
            $listForma = $formaDao->filtro($dados);
            $formaDao->disconnect();
            return $listForma;

            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
      
    
    
    //VISUALIZA
    public function visualizar($id_forma_fat){
    	try {
    	    $formaDao = $this->Factory->createDao("fin_forma_pag_fat");
            $formaDao->connect();
            $objForma = $formaDao->visualizar($id_forma_fat);
            $formaDao->disconnect();
            return $objForma;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }

    //LISTA
    public function ajax_listar_faturamento($id_pedido){
        try {
            
            $fatDao = $this->Factory->createDao("fin_forma_pag_fat");
            $fatDao->connect();
            $listFat = $fatDao->ajax_listar_faturamento($id_pedido);
            $fatDao->disconnect();
            return $listFat;

            } catch (Exception $exc) {
                throw $exc;
            }
    }

     //EXCLUSÃO
    public function excluir($id_forma_fat){
        try {
            $formaDao = $this->Factory->createDao("fin_forma_pag_fat");
            $formaDao->connect();
            $formaDao->excluir($id_forma_fat);
            $formaDao->disconnect();
        } catch (Exception $exc) {
                throw $exc;
            }
    }

    
    
   


}
?>
