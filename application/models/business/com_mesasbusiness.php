<?php
/* Classe(business): Cargos dos colaboradores
 * Autor: Anderson Farias
 * Última atualização: 26/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Com_mesasBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

            $objMesa = $this->Factory->createPojo("com_mesas",$dados);
            $mesaDao = $this->Factory->createDao("com_mesas");
            $mesaDao->connect();
            $cod_mesa = $mesaDao->cadastrar($objMesa);
            $mesaDao->disconnect();
	    return $cod_mesa;
	        
        } 
        
        catch (Exception $exc) {
	        throw $exc;
        }
    }

    //LISTA
    public function filtro($dados=null){
    	try {
    		
    	    $mesaDao = $this->Factory->createDao("com_mesas");
            $mesaDao->connect();
            $listMesa = $mesaDao->filtro($dados);
            $mesaDao->disconnect();
            return $listMesa;

            } catch (Exception $exc) {
                throw $exc;
            }
    }

       //LISTA
    public function controle_mesas($dados=null){
        try {
            
            $mesaDao = $this->Factory->createDao("com_mesas");
            $mesaDao->connect();
            $listMesa = $mesaDao->controle_mesas($dados);
            $mesaDao->disconnect();
            return $listMesa;

            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //VISUALIZA
    public function visualizar($id_mesa){
    	try {
    	    $mesaDao = $this->Factory->createDao("com_mesas");
            $mesaDao->connect();
            $objMesa = $mesaDao->visualizar($id_mesa);
            $mesaDao->disconnect();
            return $objMesa;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    
    //EDITAR
    public function editar($dados){
    	try {
    	    //$objMesa = $this->Factory->createPojo("com_mesas",$dados);
            $mesaDao = $this->Factory->createDao("com_mesas");
            $mesaDao->connect();
            $mesaDao->alterar($dados);
            $mesaDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //EXCLUS�O
    public function excluir($id_mesa){
    	try {
    	    $mesaDao = $this->Factory->createDao("com_mesas");
            $mesaDao->connect();
            $mesaDao->excluir($id_mesa);
            $mesaDao->disconnect();
    	} catch (Exception $exc) {
                throw $exc;
            }
    }




}
?>
