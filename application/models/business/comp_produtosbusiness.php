<?php
/* Classe(business): Produtos
 * Autor: Anderson Farias
 * Última atualização: 30/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Comp_produtosBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

            $objProduto = $this->Factory->createPojo("comp_produtos",$dados);
            $produtoDao = $this->Factory->createDao("comp_produtos");
            $produtoDao->connect();
            $cod_produto = $produtoDao->cadastrar($objProduto);
	    $produtoDao->disconnect();
            return $cod_produto;
	        
        } 
        
        catch (Exception $exc) {
	        throw $exc;
        }
    }

    //LISTA
    public function filtro($dados=null){
    	try {
    		
    	    $produtoDao = $this->Factory->createDao("comp_produtos");
            $produtoDao->connect();
            $listProduto = $produtoDao->filtro($dados);
            $produtoDao->disconnect();
            return $listProduto;

            } catch (Exception $exc) {
                throw $exc;
            }
    }



      //LISTA
    public function listar_produto_servico(){
        try {
            
            $produtoDao = $this->Factory->createDao("comp_produtos");
            $produtoDao->connect();
            $listProduto = $produtoDao->listar_produto_servico();
            $produtoDao->disconnect();
            return $listProduto;

            } catch (Exception $exc) {
                throw $exc;
            }
    }


    
    //VISUALIZA
    public function visualizar($id_produto){
    	try {
    	    $produtoDao = $this->Factory->createDao("comp_produtos");
            $produtoDao->connect();
            $objProduto = $produtoDao->visualizar($id_produto);
            $produtoDao->disconnect();
            return $objProduto;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    
    //EDITAR
    public function editar($dados){
    	try {
    	    $objProduto = $this->Factory->createPojo("comp_produtos",$dados);
            $produtoDao = $this->Factory->createDao("comp_produtos");
            $produtoDao->connect();
            $produtoDao->alterar($objProduto);
            $produtoDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //EXCLUSÃO
    public function excluir($id_produto){
    	try {
    	    $produtoDao = $this->Factory->createDao("comp_produtos");
            $produtoDao->connect();
            $produtoDao->excluir($id_produto);
            $produtoDao->disconnect();
    	} catch (Exception $exc) {
                throw $exc;
            }
    }


     //LISTA AJAX
    public function ajax_listar_produto($dados){
        try {
            
            $produtoDao = $this->Factory->createDao("comp_produtos");
            $produtoDao->connect();
            $listProduto = $produtoDao->ajax_listar_produto($dados);
            $produtoDao->disconnect();
            return $listProduto;

            } catch (Exception $exc) {
                throw $exc;
            }
    }


    public function listar_categoria($id_categoria){
            try {
                  $registroDao = $this->Factory->createDao("comp_produtos");
                  $registroDao->connect();
                  $listRegistro = $registroDao->listar_categoria($id_categoria);
                  $registroDao->disconnect();
                  return $listRegistro;

            } catch (Exception $exc) {
                throw $exc;
            }
           
      }





}
?>
