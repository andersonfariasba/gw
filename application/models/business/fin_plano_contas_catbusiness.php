<?php
/* Classe(business): Centro de custos
 * Autor: Anderson Farias
 * Última atualização: 03/07/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Fin_plano_contas_catBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

            $objCusto = $this->Factory->createPojo("fin_plano_contas_cat",$dados);
            $custoDao = $this->Factory->createDao("fin_plano_contas_cat");
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
    		
    	    $custoDao = $this->Factory->createDao("fin_plano_contas_cat");
            $custoDao->connect();
            $listCusto = $custoDao->filtro($dados);
            $custoDao->disconnect();
            return $listCusto;

            } catch (Exception $exc) {
                throw $exc;
            }
    }

     public function listar_por_tipo($tipo_conta){
        try {
            
            $custoDao = $this->Factory->createDao("fin_plano_contas_cat");
            $custoDao->connect();
            $listCusto = $custoDao->listar_por_tipo($tipo_conta);
            $custoDao->disconnect();
            return $listCusto;

            } catch (Exception $exc) {
                throw $exc;
            }
    }




     public function ajax_listar_tipo($tipo_conta){
        try {
            
            $categoriaDao = $this->Factory->createDao("fin_plano_contas_cat");
            $categoriaDao->connect();
            $listCategoria = $categoriaDao->ajax_listar_tipo($tipo_conta);
            $categoriaDao->disconnect();

            return $listCategoria;

            } catch (Exception $exc) {
                throw $exc;
            }
    }

     public function ajax_visualizar_grupo($id_plano_categoria){
        try {
            
            $categoriaDao = $this->Factory->createDao("fin_plano_contas_cat");
            $categoriaDao->connect();
            $listCategoria = $categoriaDao->ajax_visualizar_grupo($id_plano_categoria);
            $categoriaDao->disconnect();

            return $listCategoria;

            } catch (Exception $exc) {
                throw $exc;
            }
    }



    
    //VISUALIZA
    public function visualizar($id_plano_categoria){
    	try {
    	    $custoDao = $this->Factory->createDao("fin_plano_contas_cat");
            $custoDao->connect();
            $objCusto = $custoDao->visualizar($id_plano_categoria);
            $custoDao->disconnect();
            return $objCusto;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    
    //EDITAR
    public function editar($dados){
    	try {
    	    $objCusto = $this->Factory->createPojo("fin_plano_contas_cat",$dados);
            $custoDao = $this->Factory->createDao("fin_plano_contas_cat");
            $custoDao->connect();
            $custoDao->alterar($objCusto);
            $custoDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //EXCLUSÃO
    public function excluir($id_plano_categoria){
    	try {
    	    $custoDao = $this->Factory->createDao("fin_plano_contas_cat");
            $custoDao->connect();
            $custoDao->excluir($id_plano_categoria);
            $custoDao->disconnect();
    	} catch (Exception $exc) {
                throw $exc;
            }
    }




}
?>
