<?php
/* Classe(business): Clientes
 * Autor: Anderson Farias
 * última atualização: 03/07/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Fin_filiaisBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

           $objCliente = $this->Factory->createPojo("fin_filiais",$dados);
           $clienteDao = $this->Factory->createDao("fin_filiais");
           $clienteDao->connect();
           $cod_cliente =$clienteDao->cadastrar($objCliente);
           $clienteDao->disconnect();
            return $cod_cliente;
             } 
        
        catch (Exception $exc) {
	        throw $exc;
        }
    }

    //LISTA
    public function filtro($dados=null){
    	try {
    		
    	   $clienteDao = $this->Factory->createDao("fin_filiais");
           $clienteDao->connect();
           $listClientes =$clienteDao->filtro($dados);
           $clienteDao->disconnect();
            return $listClientes;

            } catch (Exception $exc) {
                throw $exc;
            }
    }


    public function listar(){
      try {
        
           $clienteDao = $this->Factory->createDao("fin_filiais");
           $clienteDao->connect();
           $listClientes =$clienteDao->listar();
           $clienteDao->disconnect();
            return $listClientes;

            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //VISUALIZA
    public function visualizar($id_filial){
    	try {
    	   $clienteDao = $this->Factory->createDao("fin_filiais");
           $clienteDao->connect();
           $objCliente =$clienteDao->visualizar($id_filial);
           $clienteDao->disconnect();
            return $objCliente;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    
    //EDITAR
    public function editar($dados){
    	try {
    	   $objCliente = $this->Factory->createPojo("fin_filiais",$dados);
           $clienteDao = $this->Factory->createDao("fin_filiais");
           $clienteDao->connect();
           $clienteDao->alterar($objCliente);
           $clienteDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //DELETE
    public function excluir($id_filial){
    	try {
    	   $clienteDao = $this->Factory->createDao("fin_filiais");
           $clienteDao->connect();
           $clienteDao->excluir($id_filial);
           $clienteDao->disconnect();
    	} catch (Exception $exc) {
                throw $exc;
            }
    }


     //VISUALIZA
    public function verificar_existente($documento){
      try {
         $clienteDao = $this->Factory->createDao("fin_filiais");
           $clienteDao->connect();
           $objCliente =$clienteDao->verificar_existente($documento);
           $clienteDao->disconnect();
            return $objCliente;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }


       //LISTA AJAX
    public function ajax_listar($pos){
        try {
            
            $clienteDao = $this->Factory->createDao("fin_filiais");
            $clienteDao->connect();
            $listClientes = $clienteDao->ajax_listar($pos);
            $clienteDao->disconnect();
            return $listClientes;

            } catch (Exception $exc) {
                throw $exc;
            }
    }



}

?>
