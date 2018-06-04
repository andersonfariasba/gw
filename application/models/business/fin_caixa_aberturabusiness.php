<?php
/* Classe(business): Unidade de medida
 * Autor: Anderson Farias
 * Última atualização: 27/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Fin_caixa_aberturaBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

            $objCategoria = $this->Factory->createPojo("fin_caixa_abertura",$dados);
            $categoriaDao = $this->Factory->createDao("fin_caixa_abertura");
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
    		
    	    $categoriaDao = $this->Factory->createDao("fin_caixa_abertura");
            $categoriaDao->connect();
            $listCategoria = $categoriaDao->filtro($dados);
            $categoriaDao->disconnect();
            return $listCategoria;

            } catch (Exception $exc) {
                throw $exc;
            }
    }


    
    //VISUALIZA
    public function visualizar($id_abertura){
    	try {
    	    $categoriaDao = $this->Factory->createDao("fin_caixa_abertura");
            $categoriaDao->connect();
            $objCategoria = $categoriaDao->visualizar($id_abertura);
            $categoriaDao->disconnect();
            return $objCategoria;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    
    //EDITAR
    public function editar($dados){
    	try {
    	    $objCategoria = $this->Factory->createPojo("fin_caixa_abertura",$dados);
            $categoriaDao = $this->Factory->createDao("fin_caixa_abertura");
            $categoriaDao->connect();
            $categoriaDao->alterar($objCategoria);
            $categoriaDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //EXCLUSÃO
    public function excluir($id_abertura){
    	try {
    	    $categoriaDao = $this->Factory->createDao("fin_caixa_abertura");
            $categoriaDao->connect();
            $categoriaDao->excluir($id_abertura);
            $categoriaDao->disconnect();
    	} catch (Exception $exc) {
                throw $exc;
            }
    }




}
?>
