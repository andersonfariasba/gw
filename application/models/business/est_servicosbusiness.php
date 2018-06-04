<?php
/* Classe(business): Serviços
 * Autor: Anderson Farias
 * Última atualização: 12/07/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Est_servicosBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

            $objProduto = $this->Factory->createPojo("est_servicos",$dados);
            $produtoDao = $this->Factory->createDao("est_servicos");
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
    		
    	    $produtoDao = $this->Factory->createDao("est_servicos");
            $produtoDao->connect();
            $listProduto = $produtoDao->filtro($dados);
            $produtoDao->disconnect();
            return $listProduto;

            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //VISUALIZA
    public function visualizar($id_produto){
    	try {
    	    $produtoDao = $this->Factory->createDao("est_servicos");
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
    	    $objProduto = $this->Factory->createPojo("est_servicos",$dados);
            $produtoDao = $this->Factory->createDao("est_servicos");
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
    	    $produtoDao = $this->Factory->createDao("est_servicos");
            $produtoDao->connect();
            $produtoDao->excluir($id_produto);
            $produtoDao->disconnect();
    	} catch (Exception $exc) {
                throw $exc;
            }
    }




}
?>
