<?php
/* Classe(business): Fornecedores
 * Autor: Anderson Farias
 * última atualização: 29/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Com_fornecedoresBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

            $objFornecedor = $this->Factory->createPojo("com_fornecedores",$dados);
            $fornecedorDao = $this->Factory->createDao("com_fornecedores");
            $fornecedorDao->connect();
            $cod_fornecedor = $fornecedorDao->cadastrar($objFornecedor);
            $fornecedorDao->disconnect();
            return $cod_fornecedor;
             } 
        
        catch (Exception $exc) {
	        throw $exc;
        }
    }

    //LISTA
    public function filtro($dados=null){
    	try {
    		
    	    $fornecedorDao = $this->Factory->createDao("com_fornecedores");
            $fornecedorDao->connect();
            $listFornecedor = $fornecedorDao->filtro($dados);
            $fornecedorDao->disconnect();
            return $listFornecedor;

            } catch (Exception $exc) {
                throw $exc;
            }
    }


      //LISTA AJAX
    public function ajax_listar($pos){
        try {
            
            $fornecedorDao = $this->Factory->createDao("com_fornecedores");
            $fornecedorDao->connect();
            $listFornecedor = $fornecedorDao->ajax_listar($pos);
            $fornecedorDao->disconnect();
            return $listFornecedor;

            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //VISUALIZA
    public function visualizar($id_fornecedor){
    	try {
    	    $fornecedorDao = $this->Factory->createDao("com_fornecedores");
            $fornecedorDao->connect();
            $objFornecedor = $fornecedorDao->visualizar($id_fornecedor);
            $fornecedorDao->disconnect();
            return$objFornecedor;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    
    //EDITAR
    public function editar($dados){
    	try {
    	   $objFornecedor = $this->Factory->createPojo("com_fornecedores",$dados);
            $fornecedorDao = $this->Factory->createDao("com_fornecedores");
            $fornecedorDao->connect();
            $fornecedorDao->alterar($objFornecedor);
            $fornecedorDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //DELETE
    public function excluir($id_fornecedor){
    	try {
    	    $fornecedorDao = $this->Factory->createDao("com_fornecedores");
            $fornecedorDao->connect();
            $fornecedorDao->excluir($id_fornecedor);
            $fornecedorDao->disconnect();
    	} catch (Exception $exc) {
                throw $exc;
            }
    }


     //VISUALIZA
    public function verificar_existente($documento){
      try {
           $fornecedorDao = $this->Factory->createDao("com_fornecedores");
           $fornecedorDao->connect();
           $objFornecedor =$fornecedorDao->verificar_existente($documento);
           $fornecedorDao->disconnect();
            return $objFornecedor;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }


}

?>
