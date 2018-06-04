<?php
/* Classe(business): Bandeira Cartão
 * Autor: Anderson Farias
 * Última atualização: 15/07/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Fin_bandeira_cartaoBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

            $objBandeira = $this->Factory->createPojo("fin_bandeira_cartao",$dados);
            $bandeiraDao = $this->Factory->createDao("fin_bandeira_cartao");
            $bandeiraDao->connect();
            $cod_bandeira = $bandeiraDao->cadastrar($objBandeira);
	    $bandeiraDao->disconnect();
            return $cod_bandeira;
	        
        } 
        
        catch (Exception $exc) {
	        throw $exc;
        }
    }

    //LISTA
    public function filtro($dados=null){
    	try {
    		
    	    $bandeiraDao = $this->Factory->createDao("fin_bandeira_cartao");
            $bandeiraDao->connect();
            $listBandeira = $bandeiraDao->filtro($dados);
            $bandeiraDao->disconnect();
            return $listBandeira;

            } catch (Exception $exc) {
                throw $exc;
            }
    }


      //LISTA
    public function listarPorForma($id_forma){
        try {
            
            $bandeiraDao = $this->Factory->createDao("fin_bandeira_cartao");
            $bandeiraDao->connect();
            $listBandeira = $bandeiraDao->listarPorForma($id_forma);
            $bandeiraDao->disconnect();
            return $listBandeira;

            } catch (Exception $exc) {
                throw $exc;
            }
    }

     //LISTA
    public function listarPorOperadora($id_operadora){
        try {
            
            $bandeiraDao = $this->Factory->createDao("fin_bandeira_cartao");
            $bandeiraDao->connect();
            $listBandeira = $bandeiraDao->listarPorOperadora($id_operadora);
            $bandeiraDao->disconnect();
            return $listBandeira;

            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //VISUALIZA
    public function visualizar($id_bandeira){
    	try {
    	    $bandeiraDao = $this->Factory->createDao("fin_bandeira_cartao");
            $bandeiraDao->connect();
            $objBandeira = $bandeiraDao->visualizar($id_bandeira);
            $bandeiraDao->disconnect();
            return $objBandeira;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    
    //EDITAR
    public function editar($dados){
    	try {
    	    $objBandeira = $this->Factory->createPojo("fin_bandeira_cartao",$dados);
            $bandeiraDao = $this->Factory->createDao("fin_bandeira_cartao");
            $bandeiraDao->connect();
            $bandeiraDao->alterar($objBandeira);
            $bandeiraDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //EXCLUSÃO
    public function excluir($id_bandeira){
    	try {
    	    $bandeiraDao = $this->Factory->createDao("fin_bandeira_cartao");
            $bandeiraDao->connect();
            $bandeiraDao->excluir($id_bandeira);
            $bandeiraDao->disconnect();
    	} catch (Exception $exc) {
                throw $exc;
            }
    }




}
?>
