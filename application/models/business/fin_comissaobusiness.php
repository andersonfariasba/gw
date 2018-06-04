<?php
/* Classe(business): Lançamentos
 * Autor: Anderson Farias
 * Última atualização: 12/07/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Fin_comissaoBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

            $objLanc = $this->Factory->createPojo("fin_comissao",$dados);
            $lancDao = $this->Factory->createDao("fin_comissao");
            $lancDao->connect();
            $cod_lanc = $lancDao->cadastrar($objLanc);
	        $lancDao->disconnect();
            return $cod_lanc;
	        
        } 
        
        catch (Exception $exc) {
	        throw $exc;
        }
    }

    //LISTAR COMISSÕES
    public function filtro($dados=null){
    	try {
    		
    	    $lancDao = $this->Factory->createDao("fin_comissao");
            $lancDao->connect();
            $listLanc = $lancDao->filtro($dados);
            $lancDao->disconnect();
            return $listLanc;

            } catch (Exception $exc) {
                throw $exc;
            }
    }



     
   
    
   

}
?>
