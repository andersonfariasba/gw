<?php
/* Classe(business): Fornecedores
 * Autor: Anderson Farias
 * última atualização: 29/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Com_transportadorasBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

            $objTransportadora = $this->Factory->createPojo("com_transportadoras",$dados);
            $transDao = $this->Factory->createDao("com_transportadoras");
            $transDao->connect();
            $cod_tran = $transDao->cadastrar($objTransportadora);
            $transDao->disconnect();
            return $cod_trans;
             } 
        
        catch (Exception $exc) {
	        throw $exc;
        }
    }

    //LISTA
    public function filtro($dados=null){
    	try {
    		
    	    $transportadoraDao = $this->Factory->createDao("com_transportadoras");
            $transportadoraDao->connect();
            $listFornecedor = $transportadoraDao->filtro($dados);
            $transportadoraDao->disconnect();
            return $listFornecedor;

            } catch (Exception $exc) {
                throw $exc;
            }
    }


      //LISTA AJAX
    public function ajax_listar($pos){
        try {
            
            $transportadoraDao = $this->Factory->createDao("com_transportadoras");
            $transportadoraDao->connect();
            $listTransportadora = $transportadoraDao->ajax_listar($pos);
            $transportadoraDao->disconnect();
            return $listTransportadora;

            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //VISUALIZA
    public function visualizar($id_transportadora){
    	try {
    	    $transportadoraDao = $this->Factory->createDao("com_transportadoras");
            $transportadoraDao->connect();
            $objTransportadora = $transportadoraDao->visualizar($id_transportadora);
            $transportadoraDao->disconnect();
            return$objTransportadora;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    
    //EDITAR
    public function editar($dados){
    	try {
    	   $objTransportadora = $this->Factory->createPojo("com_transportadoras",$dados);
            $transportadoraDao = $this->Factory->createDao("com_transportadoras");
            $transportadoraDao->connect();
            $transportadoraDao->alterar($objTransportadora);
            $transportadoraDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //DELETE
    public function excluir($id_transportadora){
    	try {
    	    $transportadoraDao = $this->Factory->createDao("com_transportadoras");
            $transportadoraDao->connect();
            $transportadoraDao->excluir($id_transportadora);
            $transportadoraDao->disconnect();
    	} catch (Exception $exc) {
                throw $exc;
            }
    }


     //VISUALIZA
    public function verificar_existente($documento){
      try {
           $transportadoraDao = $this->Factory->createDao("com_transportadoras");
           $transportadoraDao->connect();
           $objTransportadora =$transportadoraDao->verificar_existente($documento);
           $transportadoraDao->disconnect();
            return $objTransportadora;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }


}

?>
