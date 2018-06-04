<?php
/* Classe(business): Movimentacao
 * Autor: Anderson Farias
 * Última atualização: 11/07/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Est_movimentacaoBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

            $objMovimentacao = $this->Factory->createPojo("est_movimentacao",$dados);
            $movimentacaoDao = $this->Factory->createDao("est_movimentacao");
            $movimentacaoDao->connect();
            $cod_movimentacao = $movimentacaoDao->cadastrar($objMovimentacao);
	    $movimentacaoDao->disconnect();
            return $cod_movimentacao;
	        
        } 
        
        catch (Exception $exc) {
	        throw $exc;
        }
    }

    //LISTA
    public function filtro($dados=null){
    	try {
    		
    	    $movimentacaoDao = $this->Factory->createDao("est_movimentacao");
            $movimentacaoDao->connect();
            $listMovimentacao = $movimentacaoDao->filtro($dados);
            $movimentacaoDao->disconnect();
            return $listMovimentacao;

            } catch (Exception $exc) {
                throw $exc;
            }
    }

      //LISTA
    public function filtro_mov_total($dados=null){
        try {
            
            $movimentacaoDao = $this->Factory->createDao("est_movimentacao");
            $movimentacaoDao->connect();
            $listMovimentacao = $movimentacaoDao->filtro_mov_total($dados);
            $movimentacaoDao->disconnect();
            return $listMovimentacao;

            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //VISUALIZA
    public function visualizar($id_movimentacao){
    	try {
    	    $movimentacaoDao = $this->Factory->createDao("est_movimentacao");
            $movimentacaoDao->connect();
            $objMovimentacao = $movimentacaoDao->visualizar($id_movimentacao);
            $movimentacaoDao->disconnect();
            return $objMovimentacao;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }

     //VISUALIZA
    public function visualizarSimples($id_movimentacao){
        try {
            $movimentacaoDao = $this->Factory->createDao("est_movimentacao");
            $movimentacaoDao->connect();
            $objMovimentacao = $movimentacaoDao->visualizarSimples($id_movimentacao);
            $movimentacaoDao->disconnect();
            return $objMovimentacao;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    
    //EDITAR
    public function editar($dados){
    	try {
    	    $objMovimentacao = $this->Factory->createPojo("est_movimentacao",$dados);
            $movimentacaoDao = $this->Factory->createDao("est_movimentacao");
            $movimentacaoDao->connect();
            $movimentacaoDao->alterar($objMovimentacao);
            $movimentacaoDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //EXCLUSÃO
    public function excluir($id_movimentacao){
    	try {
    	    $movimentacaoDao = $this->Factory->createDao("est_movimentacao");
            $movimentacaoDao->connect();
            $movimentacaoDao->excluir($id_movimentacao);
            $movimentacaoDao->disconnect();
    	} catch (Exception $exc) {
                throw $exc;
            }
    }

     //EXCLUSÃO
    public function excluir_por_pedido($id_pedido){
        try {
            $movimentacaoDao = $this->Factory->createDao("est_movimentacao");
            $movimentacaoDao->connect();
            $movimentacaoDao->excluir_por_pedido($id_pedido);
            $movimentacaoDao->disconnect();
        } catch (Exception $exc) {
                throw $exc;
            }
    }



     /*
     * Calcula a quantidade do produto em estoque
     */
    public function qtdEstoque($cod_produto) {
        try {
            $est_movimentacaoDao = $this->Factory->createDao("est_movimentacao");

            $est_movimentacaoDao->connect();
            //lista as movimentacoes de entrada (add)
            $listMovEntrada = $est_movimentacaoDao->listar($cod_produto, ADD_MOV);
            //lista as movimentacoes de saida (remover)
            $listMovSaida = $est_movimentacaoDao->listar($cod_produto, REMOVER_MOV);
            
            $qtdEntrada = 0;
            foreach ($listMovEntrada as $movEntrada) {
                $qtdEntrada = $qtdEntrada + $movEntrada->getQtd_mov();
            }
            
            $qtdSaida = 0;
            foreach ($listMovSaida as $movSaida) {
                $qtdSaida = $qtdSaida + $movSaida->getQtd_mov();
            }
            
            $qtdEstoque = $qtdEntrada - $qtdSaida ;
            
            $est_movimentacaoDao->disconnect();

            return $qtdEstoque;
        } catch (Exception $ex) {
            throw $ex;
        }
    }


      //FUNÇÃO PARA PESQUISA NO RELATÓRIO CRUZADO
    public function filtro_financeiro($dados) {
        try {
            $est_movimentacaoDao = $this->Factory->createDao("Est_movimentacao");

            $est_movimentacaoDao->connect();
            $listMov = $est_movimentacaoDao->filtro_financeiro($dados);
            $est_movimentacaoDao->disconnect();


            return $listMov;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

      public function total_item($id_pedido,$id_pedido_item) {
              try {
              $contaDao = $this->Factory->createDao("est_movimentacao");

              $contaDao->connect();
              $listConta = $contaDao->total_item($id_pedido,$id_pedido_item);
              $contaDao->disconnect();


              return $listConta;
              } catch (Exception $ex) {
              throw $ex;
              }
            }





}
?>
