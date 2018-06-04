<?php
/* Classe(business): Clientes
 * Autor: Anderson Farias
 * última atualização: 03/07/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Com_clientesBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

           $objCliente = $this->Factory->createPojo("com_clientes",$dados);
           $clienteDao = $this->Factory->createDao("com_clientes");
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
    		
    	   $clienteDao = $this->Factory->createDao("com_clientes");
           $clienteDao->connect();
           $listClientes =$clienteDao->filtro($dados);
           $clienteDao->disconnect();
            return $listClientes;

            } catch (Exception $exc) {
                throw $exc;
            }
    }


     //LISTA DE CLIENTES PARA ORLAMENTO
    public function listar_cliente_orcamento(){
      try {
        
           $clienteDao = $this->Factory->createDao("com_clientes");
           $clienteDao->connect();
           $listClientes =$clienteDao->listar_cliente_orcamento();
           $clienteDao->disconnect();
            return $listClientes;

            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //VISUALIZA
    public function visualizar($id_cliente){
    	try {
    	   $clienteDao = $this->Factory->createDao("com_clientes");
           $clienteDao->connect();
           $objCliente =$clienteDao->visualizar($id_cliente);
           $clienteDao->disconnect();
            return $objCliente;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    
    //EDITAR
    public function editar($dados){
    	try {
    	   $objCliente = $this->Factory->createPojo("com_clientes",$dados);
           $clienteDao = $this->Factory->createDao("com_clientes");
           $clienteDao->connect();
           $clienteDao->alterar($objCliente);
           $clienteDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //DELETE
    public function excluir($id_cliente){
    	try {
    	   $clienteDao = $this->Factory->createDao("com_clientes");
           $clienteDao->connect();
           $clienteDao->excluir($id_cliente);
           $clienteDao->disconnect();
    	} catch (Exception $exc) {
                throw $exc;
            }
    }


     //VISUALIZA
    public function verificar_existente($documento){
      try {
         $clienteDao = $this->Factory->createDao("com_clientes");
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
            
            $clienteDao = $this->Factory->createDao("com_clientes");
            $clienteDao->connect();
            $listCliente = $clienteDao->ajax_listar($pos);
            $clienteDao->disconnect();
            return $listCliente;

            } catch (Exception $exc) {
                throw $exc;
            }
    }


}

?>
