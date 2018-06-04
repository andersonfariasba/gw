<?php
/* Classe(business): Unidade de medida
 * Autor: Anderson Farias
 * Última atualização: 27/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Est_motivo_movBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

            $objCategoria = $this->Factory->createPojo("est_motivo_mov",$dados);
            $categoriaDao = $this->Factory->createDao("est_motivo_mov");
            $categoriaDao->connect();
            $cod_unidade = $categoriaDao->cadastrar($objCategoria);
	    $categoriaDao->disconnect();
            return $cod_unidade;
	        
        } 
        
        catch (Exception $exc) {
	        throw $exc;
        }
    }

    //LISTA
    public function filtro($dados=null){
    	try {
    		
    	    $categoriaDao = $this->Factory->createDao("est_motivo_mov");
            $categoriaDao->connect();
            $listCategoria = $categoriaDao->filtro($dados);
            $categoriaDao->disconnect();
            return $listCategoria;

            } catch (Exception $exc) {
                throw $exc;
            }
    }


     //LISTA AJAX
    public function ajax_listar($pos,$tipo){
        try {
            
            $categoriaDao = $this->Factory->createDao("est_motivo_mov");
            $categoriaDao->connect();
            $listCategoria = $categoriaDao->ajax_listar($pos,$tipo);
            $categoriaDao->disconnect();
            return $listCategoria;

            } catch (Exception $exc) {
                throw $exc;
            }
    }

    
    //VISUALIZA
    public function visualizar($id_motivo){
    	try {
    	    $categoriaDao = $this->Factory->createDao("est_motivo_mov");
            $categoriaDao->connect();
            $objCategoria = $categoriaDao->visualizar($id_motivo);
            $categoriaDao->disconnect();
            return $objCategoria;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    
    //EDITAR
    public function editar($dados){
    	try {
    	    $objCategoria = $this->Factory->createPojo("est_motivo_mov",$dados);
            $categoriaDao = $this->Factory->createDao("est_motivo_mov");
            $categoriaDao->connect();
            $categoriaDao->alterar($objCategoria);
            $categoriaDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //EXCLUSÃO
    public function excluir($id_motivo){
    	try {
    	    $categoriaDao = $this->Factory->createDao("est_motivo_mov");
            $categoriaDao->connect();
            $categoriaDao->excluir($id_motivo);
            $categoriaDao->disconnect();
    	} catch (Exception $exc) {
                throw $exc;
            }
    }




}
?>
