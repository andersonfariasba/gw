<?php
/* Classe(business): Produtos
 * Autor: Anderson Farias
 * Última atualização: 30/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Est_produtosBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

            $objProduto = $this->Factory->createPojo("est_produtos",$dados);
            $produtoDao = $this->Factory->createDao("est_produtos");
            $produtoDao->connect();
            $cod_produto = $produtoDao->cadastrar($objProduto);
	    $produtoDao->disconnect();
            return $cod_produto;
	        
        } 
        
        catch (Exception $exc) {
	        throw $exc;
        }
    }

      ////VERIFICA A QUANTIDADE POR CUSTO E OBRA
    public function verificar_qtd($id_produto){
        try {
            
            $produtoDao = $this->Factory->createDao("est_produtos");
            $produtoDao->connect();
            $listProduto = $produtoDao->verificar_qtd($id_produto);
            $produtoDao->disconnect();
            return $listProduto;

            } catch (Exception $exc) {
                throw $exc;
            }
    }


    //LISTA
    public function filtro($dados=null){
    	try {
    		
    	    $produtoDao = $this->Factory->createDao("est_produtos");
            $produtoDao->connect();
            $listProduto = $produtoDao->filtro($dados);
            $produtoDao->disconnect();
            return $listProduto;

            } catch (Exception $exc) {
                throw $exc;
            }
    }

      //LISTA
    public function pesquisa_geral($dados=null){
        try {
            
            $produtoDao = $this->Factory->createDao("est_produtos");
            $produtoDao->connect();
            $listProduto = $produtoDao->pesquisa_geral($dados);
            $produtoDao->disconnect();
            return $listProduto;

            } catch (Exception $exc) {
                throw $exc;
            }
    }

      //LISTA
    public function ranking_produto($dados=null,$paramDash=null){
        try {
            
            $produtoDao = $this->Factory->createDao("est_produtos");
            $produtoDao->connect();
            $listProduto = $produtoDao->ranking_produto($dados,$paramDash);
            $produtoDao->disconnect();
            return $listProduto;

            } catch (Exception $exc) {
                throw $exc;
            }
    }

     public function ranking_produto_dash(){
        try {
            
            $produtoDao = $this->Factory->createDao("est_produtos");
            $produtoDao->connect();
            $listProduto = $produtoDao->ranking_produto_dash();
            $produtoDao->disconnect();
            return $listProduto;

            } catch (Exception $exc) {
                throw $exc;
            }
    }




     //LISTA
    public function movimentacao_consolidado($dados=null){
        try {
            
            $produtoDao = $this->Factory->createDao("est_produtos");
            $produtoDao->connect();
            $listProduto = $produtoDao->movimentacao_consolidado($dados);
            $produtoDao->disconnect();
            return $listProduto;

            } catch (Exception $exc) {
                throw $exc;
            }
    }



      //LISTA
    public function listar_produto_servico(){
        try {
            
            $produtoDao = $this->Factory->createDao("est_produtos");
            $produtoDao->connect();
            $listProduto = $produtoDao->listar_produto_servico();
            $produtoDao->disconnect();
            return $listProduto;

            } catch (Exception $exc) {
                throw $exc;
            }
    }


       //LISTA
    public function listar_produto_servico_loc(){
        try {
            
            $produtoDao = $this->Factory->createDao("est_produtos");
            $produtoDao->connect();
            $listProduto = $produtoDao->listar_produto_servico_loc();
            $produtoDao->disconnect();
            return $listProduto;

            } catch (Exception $exc) {
                throw $exc;
            }
    }





    
    //VISUALIZA
    public function visualizar($id_produto){
    	try {
    	    $produtoDao = $this->Factory->createDao("est_produtos");
            $produtoDao->connect();
            $objProduto = $produtoDao->visualizar($id_produto);
            $produtoDao->disconnect();
            return $objProduto;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }

    //VISUALIZA POR CODIGO
    public function visualizar_por_codigo($codigo){
        try {
            $produtoDao = $this->Factory->createDao("est_produtos");
            $produtoDao->connect();
            $objProduto = $produtoDao->visualizar_por_codigo($codigo);
            $produtoDao->disconnect();
            return $objProduto;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    
    
    //EDITAR
    public function editar($dados){
    	try {
    	    $objProduto = $this->Factory->createPojo("est_produtos",$dados);
            $produtoDao = $this->Factory->createDao("est_produtos");
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
    	    $produtoDao = $this->Factory->createDao("est_produtos");
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
            
            $produtoDao = $this->Factory->createDao("est_produtos");
            $produtoDao->connect();
            $listProduto = $produtoDao->ajax_listar_produto($dados);
            $produtoDao->disconnect();
            return $listProduto;

            } catch (Exception $exc) {
                throw $exc;
            }
    }

      //LISTA AJAX
    public function ajax_visualizar_produto($id_produto){
        try {
            
            $categoriaDao = $this->Factory->createDao("est_produtos");
            $categoriaDao->connect();
            $listCategoria = $categoriaDao->ajax_visualizar_produto($id_produto);
            $categoriaDao->disconnect();

            return $listCategoria;

            } catch (Exception $exc) {
                throw $exc;
            }
    }



    public function listar_categoria($id_categoria){
            try {
                  $registroDao = $this->Factory->createDao("est_produtos");
                  $registroDao->connect();
                  $listRegistro = $registroDao->listar_categoria($id_categoria);
                  $registroDao->disconnect();
                  return $listRegistro;

            } catch (Exception $exc) {
                throw $exc;
            }
           
      }



        public function valor_medio($id_produto) {
              try {
              $contaDao = $this->Factory->createDao("est_produtos");

              $contaDao->connect();
              $listConta = $contaDao->valor_medio($id_produto);
              $contaDao->disconnect();


              return $listConta;
              } catch (Exception $ex) {
              throw $ex;
              }
        }





}
?>
