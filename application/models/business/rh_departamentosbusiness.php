<?php
/* Classe(business): Departamentos dos colaboradores
 * Autor: Anderson Farias
 * Última atualização: 03/01/2016
 * Contato: andersonjfarias@yahoo.com.br
 */

class Rh_departamentosBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

            $objDep = $this->Factory->createPojo("rh_departamentos",$dados);
            $depDao = $this->Factory->createDao("rh_departamentos");
            $depDao->connect();
            $cod_dep = $depDao->cadastrar($objDep);
            $depDao->disconnect();
	    return $cod_cargo;
	        
        } 
        
        catch (Exception $exc) {
	        throw $exc;
        }
    }

    //LISTA
    public function filtro($dados=null){
    	try {
    		
    	    $depDao = $this->Factory->createDao("rh_departamentos");
            $depDao->connect();
            $listDep = $depDao->filtro($dados);
            $depDao->disconnect();
            return $listDep;

            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //VISUALIZA
    public function visualizar($id_departamento){
    	try {
    	    $depDao = $this->Factory->createDao("rh_departamentos");
            $depDao->connect();
            $objDep = $depDao->visualizar($id_departamento);
            $depDao->disconnect();
            return $objDep;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    
    //EDITAR
    public function editar($dados){
    	try {
    	    $objDep = $this->Factory->createPojo("rh_departamentos",$dados);
            $depDao = $this->Factory->createDao("rh_departamentos");
            $depDao->connect();
            $depDao->alterar($objDep);
            $depDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //EXCLUS�O
    public function excluir($id_departamento){
    	try {
    	    $depDao = $this->Factory->createDao("rh_departamentos");
            $depDao->connect();
            $depDao->excluir($id_departamento);
            $depDao->disconnect();
    	} catch (Exception $exc) {
                throw $exc;
            }
    }




}
?>
