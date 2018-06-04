<?php
/* Classe(business): Unidade de medida
 * Autor: Anderson Farias
 * Última atualização: 27/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Est_un_medidaBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

            $objUnidade = $this->Factory->createPojo("est_un_medida",$dados);
            $unidadeDao = $this->Factory->createDao("est_un_medida");
            $unidadeDao->connect();
            $cod_unidade = $unidadeDao->cadastrar($objUnidade);
	    $unidadeDao->disconnect();
            return $cod_unidade;
	        
        } 
        
        catch (Exception $exc) {
	        throw $exc;
        }
    }

    //LISTA
    public function filtro($dados=null){
    	try {
    		
    	    $unidadeDao = $this->Factory->createDao("est_un_medida");
            $unidadeDao->connect();
            $listUnidade = $unidadeDao->filtro($dados);
            $unidadeDao->disconnect();
            return $listUnidade;

            } catch (Exception $exc) {
                throw $exc;
            }
    }

    //LISTA AJAX
    public function ajax_listar($pos){
        try {
            
            $unidadeDao = $this->Factory->createDao("est_un_medida");
            $unidadeDao->connect();
            $listUnidade = $unidadeDao->ajax_listar($pos);
            $unidadeDao->disconnect();
            return $listUnidade;

            } catch (Exception $exc) {
                throw $exc;
            }
    }


    
    //VISUALIZA
    public function visualizar($id_unidade){
    	try {
    	    $unidadeDao = $this->Factory->createDao("est_un_medida");
            $unidadeDao->connect();
            $objUnidade = $unidadeDao->visualizar($id_unidade);
            $unidadeDao->disconnect();
            return $objUnidade;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    
    //EDITAR
    public function editar($dados){
    	try {
    	    $objUnidade = $this->Factory->createPojo("est_un_medida",$dados);
            $unidadeDao = $this->Factory->createDao("est_un_medida");
            $unidadeDao->connect();
            $unidadeDao->alterar($objUnidade);
            $unidadeDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //EXCLUSÃO
    public function excluir($id_unidade){
    	try {
    	    $unidadeDao = $this->Factory->createDao("est_un_medida");
            $unidadeDao->connect();
            $unidadeDao->excluir($id_unidade);
            $unidadeDao->disconnect();
    	} catch (Exception $exc) {
                throw $exc;
            }
    }




}
?>
