<?php
/* Classe(business): Centro de custos
 * Autor: Anderson Farias
 * Última atualização: 03/07/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Fin_centro_custosBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

            $objCusto = $this->Factory->createPojo("fin_centro_custos",$dados);
            $custoDao = $this->Factory->createDao("fin_centro_custos");
            $custoDao->connect();
            $cod_custo = $custoDao->cadastrar($objCusto);
	    $custoDao->disconnect();
            return $cod_custo;
	        
        } 
        
        catch (Exception $exc) {
	        throw $exc;
        }
    }

    //LISTA
    public function filtro($dados=null){
    	try {
    		
    	    $custoDao = $this->Factory->createDao("fin_centro_custos");
            $custoDao->connect();
            $listCusto = $custoDao->filtro($dados);
            $custoDao->disconnect();
            return $listCusto;

            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //VISUALIZA
    public function visualizar($id_custo){
    	try {
    	    $custoDao = $this->Factory->createDao("fin_centro_custos");
            $custoDao->connect();
            $objCusto = $custoDao->visualizar($id_custo);
            $custoDao->disconnect();
            return $objCusto;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    
    //EDITAR
    public function editar($dados){
    	try {
    	    $objCusto = $this->Factory->createPojo("fin_centro_custos",$dados);
            $custoDao = $this->Factory->createDao("fin_centro_custos");
            $custoDao->connect();
            $custoDao->alterar($objCusto);
            $custoDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //EXCLUSÃO
    public function excluir($id_custo){
    	try {
    	    $custoDao = $this->Factory->createDao("fin_centro_custos");
            $custoDao->connect();
            $custoDao->excluir($id_custo);
            $custoDao->disconnect();
    	} catch (Exception $exc) {
                throw $exc;
            }
    }




}
?>
