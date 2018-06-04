<?php
/* Classe(business): Cargos dos colaboradores
 * Autor: Anderson Farias
 * Última atualização: 26/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Rh_cargosBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

            $objCargo = $this->Factory->createPojo("rh_cargos",$dados);
            $cargoDao = $this->Factory->createDao("rh_cargos");
            $cargoDao->connect();
            $cod_cargo = $cargoDao->cadastrar($objCargo);
            $cargoDao->disconnect();
	    return $cod_cargo;
	        
        } 
        
        catch (Exception $exc) {
	        throw $exc;
        }
    }

    //LISTA
    public function filtro($dados=null){
    	try {
    		
    	    $cargoDao = $this->Factory->createDao("rh_cargos");
            $cargoDao->connect();
            $listCargo = $cargoDao->filtro($dados);
            $cargoDao->disconnect();
            return $listCargo;

            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //VISUALIZA
    public function visualizar($id_cargo){
    	try {
    	    $cargoDao = $this->Factory->createDao("rh_cargos");
            $cargoDao->connect();
            $objCargo = $cargoDao->visualizar($id_cargo);
            $cargoDao->disconnect();
            return $objCargo;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    
    //EDITAR
    public function editar($dados){
    	try {
    	    $objCargo = $this->Factory->createPojo("rh_cargos",$dados);
            $cargoDao = $this->Factory->createDao("rh_cargos");
            $cargoDao->connect();
            $cargoDao->alterar($objCargo);
            $cargoDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //EXCLUS�O
    public function excluir($id_cargo){
    	try {
    	    $cargoDao = $this->Factory->createDao("rh_cargos");
            $cargoDao->connect();
            $cargoDao->excluir($id_cargo);
            $cargoDao->disconnect();
    	} catch (Exception $exc) {
                throw $exc;
            }
    }




}
?>
