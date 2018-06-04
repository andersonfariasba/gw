<?php
/* Classe(business): Unidade de medida
 * Autor: Anderson Farias
 * Última atualização: 27/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Fin_tabela_nomeBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

            $objCategoria = $this->Factory->createPojo("fin_tabela_nome",$dados);
            $categoriaDao = $this->Factory->createDao("fin_tabela_nome");
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
    		
    	    $categoriaDao = $this->Factory->createDao("fin_tabela_nome");
            $categoriaDao->connect();
            $listCategoria = $categoriaDao->filtro($dados);
            $categoriaDao->disconnect();
            return $listCategoria;

            } catch (Exception $exc) {
                throw $exc;
            }
    }


      
    //VISUALIZA
    public function visualizar($id_tabela_nome){
    	try {
    	    $categoriaDao = $this->Factory->createDao("fin_tabela_nome");
            $categoriaDao->connect();
            $objCategoria = $categoriaDao->visualizar($id_tabela_nome);
            $categoriaDao->disconnect();
            return $objCategoria;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    
    //EDITAR
    public function editar($dados){
    	try {
    	    $objCategoria = $this->Factory->createPojo("fin_tabela_nome",$dados);
            $categoriaDao = $this->Factory->createDao("fin_tabela_nome");
            $categoriaDao->connect();
            $categoriaDao->alterar($objCategoria);
            $categoriaDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //EXCLUSÃO
    public function excluir($id_tabela_nome){
    	try {
    	    $categoriaDao = $this->Factory->createDao("fin_tabela_nome");
            $categoriaDao->connect();
            $categoriaDao->excluir($id_tabela_nome);
            $categoriaDao->disconnect();
    	} catch (Exception $exc) {
                throw $exc;
            }
    }




}
?>
