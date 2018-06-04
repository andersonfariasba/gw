<?php
/* Classe(business): Clientes endereço de entrega
 * Autor: Anderson Farias
 * última atualização: 23/10/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class com_clientes_end_entregaBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

           $objCliente = $this->Factory->createPojo("com_clientes_end_entrega",$dados);
           $clienteDao = $this->Factory->createDao("com_clientes_end_entrega");
           $clienteDao->connect();
           $cod_cliente =$clienteDao->cadastrar($objCliente);
           $clienteDao->disconnect();
            return $cod_cliente;
             } 
        
        catch (Exception $exc) {
	        throw $exc;
        }
    }

  

     //LISTA DE CLIENTES PARA ORLAMENTO
    public function listar($id_cliente){
      try {
        
           $clienteDao = $this->Factory->createDao("com_clientes_end_entrega");
           $clienteDao->connect();
           $listClientes =$clienteDao->listar($id_cliente);
           $clienteDao->disconnect();
            return $listClientes;

            } catch (Exception $exc) {
                throw $exc;
            }
    }


     //VISUALIZA POR CLIETE
    public function visualizar_por_cliente($id_cliente){
      try {
         $clienteDao = $this->Factory->createDao("com_clientes_end_entrega");
           $clienteDao->connect();
           $objCliente =$clienteDao->visualizar_por_cliente($id_cliente);
           $clienteDao->disconnect();
            return$objCliente;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    
    //VISUALIZA
    public function visualizar($id_endereco){
    	try {
    	   $clienteDao = $this->Factory->createDao("com_clientes_end_entrega");
           $clienteDao->connect();
           $objCliente =$clienteDao->visualizar($id_endereco);
           $clienteDao->disconnect();
            return$objCliente;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    
    //EDITAR
    public function editar($dados){
    	try {
    	   $objCliente = $this->Factory->createPojo("com_clientes_end_entrega",$dados);
           $clienteDao = $this->Factory->createDao("com_clientes_end_entrega");
           $clienteDao->connect();
           $clienteDao->alterar($objCliente);
           $clienteDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
   

}

?>
