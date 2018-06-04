<?php
/* Classe(business): Unidade de medida
 * Autor: Anderson Farias
 * Última atualização: 27/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Comp_solicitacaoBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

            $objCategoria = $this->Factory->createPojo("comp_solicitacao",$dados);
            $categoriaDao = $this->Factory->createDao("comp_solicitacao");
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
    		
    	    $categoriaDao = $this->Factory->createDao("comp_solicitacao");
            $categoriaDao->connect();
            $listCategoria = $categoriaDao->filtro($dados);
            $categoriaDao->disconnect();
            return $listCategoria;

            } catch (Exception $exc) {
                throw $exc;
            }
    }

      //LISTA
    public function filtro_cotacao($dados=null){
        try {
            
            $categoriaDao = $this->Factory->createDao("comp_solicitacao");
            $categoriaDao->connect();
            $listCategoria = $categoriaDao->filtro_cotacao($dados);
            $categoriaDao->disconnect();
            return $listCategoria;

            } catch (Exception $exc) {
                throw $exc;
            }
    }

      //LISTA
    public function filtro_pc($dados=null){
        try {
            
            $categoriaDao = $this->Factory->createDao("comp_solicitacao");
            $categoriaDao->connect();
            $listCategoria = $categoriaDao->filtro_pc($dados);
            $categoriaDao->disconnect();
            return $listCategoria;

            } catch (Exception $exc) {
                throw $exc;
            }
    }

     //LISTA
    public function listar_itens_pc($id_solicitacao){
        try {
            
            $produtoDao = $this->Factory->createDao("comp_solicitacao");
            $produtoDao->connect();
            $listProduto = $produtoDao->listar_itens_pc($id_solicitacao);
            $produtoDao->disconnect();
            return $listProduto;

            } catch (Exception $exc) {
                throw $exc;
            }
    }

     //LISTA
    public function listar_itens_pc_group($id_solicitacao){
        try {
            
            $produtoDao = $this->Factory->createDao("comp_solicitacao");
            $produtoDao->connect();
            $listProduto = $produtoDao->listar_itens_pc_group($id_solicitacao);
            $produtoDao->disconnect();
            return $listProduto;

            } catch (Exception $exc) {
                throw $exc;
            }
    }





     //LISTA AJAX
    public function ajax_listar($pos){
        try {
            
            $categoriaDao = $this->Factory->createDao("comp_solicitacao");
            $categoriaDao->connect();
            $listCategoria = $categoriaDao->ajax_listar($pos);
            $categoriaDao->disconnect();
            return $listCategoria;

            } catch (Exception $exc) {
                throw $exc;
            }
    }

    
    //VISUALIZA
    public function visualizar($id_solicitacao){
    	try {
    	    $categoriaDao = $this->Factory->createDao("comp_solicitacao");
            $categoriaDao->connect();
            $objCategoria = $categoriaDao->visualizar($id_solicitacao);
            $categoriaDao->disconnect();
            return $objCategoria;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    
    //EDITAR
    public function editar($dados){
    	try {
    	    //$objCategoria = $this->Factory->createPojo("comp_solicitacao",$dados);
            $categoriaDao = $this->Factory->createDao("comp_solicitacao");
            $categoriaDao->connect();
            $categoriaDao->alterar($dados);
            $categoriaDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //EXCLUSÃO
    public function excluir($id_solicitacao){
    	try {
    	    $categoriaDao = $this->Factory->createDao("comp_solicitacao");
            $categoriaDao->connect();
            $categoriaDao->excluir($id_solicitacao);
            $categoriaDao->disconnect();
    	} catch (Exception $exc) {
                throw $exc;
            }
    }


      //RELATORIOS

    //SOLICITACAO
    public function relatorio_solicitacao($dados=null){
        try {
            
            $categoriaDao = $this->Factory->createDao("comp_solicitacao");
            $categoriaDao->connect();
            $listCategoria = $categoriaDao->relatorio_solicitacao($dados);
            $categoriaDao->disconnect();
            return $listCategoria;

            } catch (Exception $exc) {
                throw $exc;
            }
    }




}
?>
