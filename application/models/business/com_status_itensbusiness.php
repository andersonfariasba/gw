<?php
/* Classe(business): Unidade de medida
 * Autor: Anderson Farias
 * Última atualização: 27/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Com_status_itensBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

            $objCategoria = $this->Factory->createPojo("com_status_itens",$dados);
            $categoriaDao = $this->Factory->createDao("com_status_itens");
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
    		
    	    $categoriaDao = $this->Factory->createDao("com_status_itens");
            $categoriaDao->connect();
            $listCategoria = $categoriaDao->filtro($dados);
            $categoriaDao->disconnect();
            return $listCategoria;

            } catch (Exception $exc) {
                throw $exc;
            }
    }


     //LISTA AJAX
    public function ajax_listar($pos){
        try {
            
            $categoriaDao = $this->Factory->createDao("com_status_itens");
            $categoriaDao->connect();
            $listCategoria = $categoriaDao->ajax_listar($pos);
            $categoriaDao->disconnect();
            return $listCategoria;

            } catch (Exception $exc) {
                throw $exc;
            }
    }

    
    //VISUALIZA
    public function visualizar($id_status){
    	try {
    	    $categoriaDao = $this->Factory->createDao("com_status_itens");
            $categoriaDao->connect();
            $objCategoria = $categoriaDao->visualizar($id_status);
            $categoriaDao->disconnect();
            return $objCategoria;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    
    //EDITAR
    public function editar($dados){
    	try {
    	    $objCategoria = $this->Factory->createPojo("com_status_itens",$dados);
            $categoriaDao = $this->Factory->createDao("com_status_itens");
            $categoriaDao->connect();
            $categoriaDao->alterar($objCategoria);
            $categoriaDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //EXCLUSÃO
    public function excluir($id_status){
    	try {
    	    $categoriaDao = $this->Factory->createDao("com_status_itens");
            $categoriaDao->connect();
            $categoriaDao->excluir($id_status);
            $categoriaDao->disconnect();
    	} catch (Exception $exc) {
                throw $exc;
            }
    }




}
?>
