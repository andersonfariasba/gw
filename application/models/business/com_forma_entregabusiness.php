<?php
/* Classe(business): Unidade de medida
 * Autor: Anderson Farias
 * Última atualização: 27/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Com_forma_entregaBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

            $objCategoria = $this->Factory->createPojo("com_forma_entrega",$dados);
            $categoriaDao = $this->Factory->createDao("com_forma_entrega");
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
    		
    	    $categoriaDao = $this->Factory->createDao("com_forma_entrega");
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
            
            $categoriaDao = $this->Factory->createDao("com_forma_entrega");
            $categoriaDao->connect();
            $listCategoria = $categoriaDao->ajax_listar($pos);
            $categoriaDao->disconnect();
            return $listCategoria;

            } catch (Exception $exc) {
                throw $exc;
            }
    }

    
    //VISUALIZA
    public function visualizar($id_forma){
    	try {
    	    $categoriaDao = $this->Factory->createDao("com_forma_entrega");
            $categoriaDao->connect();
            $objCategoria = $categoriaDao->visualizar($id_forma);
            $categoriaDao->disconnect();
            return $objCategoria;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    
    //EDITAR
    public function editar($dados){
    	try {
    	    //$objCategoria = $this->Factory->createPojo("com_forma_entrega",$dados);
            $categoriaDao = $this->Factory->createDao("com_forma_entrega");
            $categoriaDao->connect();
            $categoriaDao->alterar($dados);
            $categoriaDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //EXCLUSÃO
    public function excluir($id_forma){
    	try {
    	    $categoriaDao = $this->Factory->createDao("com_forma_entrega");
            $categoriaDao->connect();
            $categoriaDao->excluir($id_forma);
            $categoriaDao->disconnect();
    	} catch (Exception $exc) {
                throw $exc;
            }
    }




}
?>
