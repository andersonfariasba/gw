<?php
/* Classe(business): Colaboradores
 * Autor: Anderson Farias
 * Última atualização: 23/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Rh_colaboradoresBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

            $objColaborador = $this->Factory->createPojo("rh_colaboradores",$dados);
            $colaboradorDao = $this->Factory->createDao("rh_colaboradores");
            $colaboradorDao->connect();
            $cod_colaborador = $colaboradorDao->cadastrar($objColaborador);
	    $colaboradorDao->disconnect();
	    return $cod_colaborador;
	        
        } 
        
        catch (Exception $exc) {
	        throw $exc;
        }
    }

    //LISTA
    public function filtro($dados=null){
    	try {
    		
    	    $colaboradorDao = $this->Factory->createDao("rh_colaboradores");
            $colaboradorDao->connect();
            $listColaborador = $colaboradorDao->filtro($dados);
            $colaboradorDao->disconnect();
            return $listColaborador;

            } catch (Exception $exc) {
                throw $exc;
            }
    }

    


    //LISTA
    public function comissao($dados=null){
        try {
            
            $colaboradorDao = $this->Factory->createDao("rh_colaboradores");
            $colaboradorDao->connect();
            $listColaborador = $colaboradorDao->comissao($dados);
            $colaboradorDao->disconnect();
            return $listColaborador;

            } catch (Exception $exc) {
                throw $exc;
            }
    }



    
    //VISUALIZA
    public function visualizar($id_colaborador){
    	try {
    	    $colaboradorDao = $this->Factory->createDao("rh_colaboradores");
            $colaboradorDao->connect();
            $objColaborador = $colaboradorDao->visualizar($id_colaborador);
            $colaboradorDao->disconnect();
            return $objColaborador;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    
    //EDITAR
    public function editar($dados){
    	try {
    	    $objColaborador = $this->Factory->createPojo("rh_colaboradores",$dados);
            $colaboradorDao = $this->Factory->createDao("rh_colaboradores");
            $colaboradorDao->connect();
            $colaboradorDao->alterar($objColaborador);
            $colaboradorDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //EXCLUS�O
    public function excluir($id_colaborador){
    	try {
    	    $colaboradorDao = $this->Factory->createDao("rh_colaboradores");
            $colaboradorDao->connect();
            $colaboradorDao->excluir($id_colaborador);
            $colaboradorDao->disconnect();
    	} catch (Exception $exc) {
                throw $exc;
            }
    }




}
?>
