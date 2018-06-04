<?php
/* Classe(business): Pedidos
 * Autor: Anderson Farias
 * Última atualização: 01/10/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Com_pedidosBusiness extends CI_Model {

    //CADASTRA
	public function cadastrar($dados){
        try {

            $objPedido = $this->Factory->createPojo("com_pedidos",$dados);
            $pedidoDao = $this->Factory->createDao("com_pedidos");
            $pedidoDao->connect();
            $cod_pedido = $pedidoDao->cadastrar($objPedido);
	        $pedidoDao->disconnect();
            return $cod_pedido;
	        
        } 
        
        catch (Exception $exc) {
	        throw $exc;
        }
    }

    //LISTA
    public function filtro($tipo,$dados=null){
    	try {
    		
    	    $pedidoDao = $this->Factory->createDao("com_pedidos");
            $pedidoDao->connect();
            $listPedido = $pedidoDao->filtro($tipo,$dados);
            $pedidoDao->disconnect();
            return $listPedido;

            } catch (Exception $exc) {
                throw $exc;
            }
    }


    //LISTA
    public function filtro_loc($tipo,$dados=null){
        try {
            
            $pedidoDao = $this->Factory->createDao("com_pedidos");
            $pedidoDao->connect();
            $listPedido = $pedidoDao->filtro_loc($tipo,$dados);
            $pedidoDao->disconnect();
            return $listPedido;

            } catch (Exception $exc) {
                throw $exc;
            }
    }

      //LISTA
    public function filtro_bar($tipo,$dados=null){
        try {
            
            $pedidoDao = $this->Factory->createDao("com_pedidos");
            $pedidoDao->connect();
            $listPedido = $pedidoDao->filtro_bar($tipo,$dados);
            $pedidoDao->disconnect();
            return $listPedido;

            } catch (Exception $exc) {
                throw $exc;
            }
    }


     public function filtro_entrega($dados){
        try {
            
            $pedidoDao = $this->Factory->createDao("com_pedidos");
            $pedidoDao->connect();
            $listPedido = $pedidoDao->filtro_entrega($dados);
            $pedidoDao->disconnect();
            return $listPedido;

            } catch (Exception $exc) {
                throw $exc;
            }
    }

     public function filtro_entrega_hoje($dados){
        try {
            
            $pedidoDao = $this->Factory->createDao("com_pedidos");
            $pedidoDao->connect();
            $listPedido = $pedidoDao->filtro_entrega_hoje($dados);
            $pedidoDao->disconnect();
            return $listPedido;

            } catch (Exception $exc) {
                throw $exc;
            }
    }



     public function ultimas_vendas(){
        try {
            
            $pedidoDao = $this->Factory->createDao("com_pedidos");
            $pedidoDao->connect();
            $listPedido = $pedidoDao->ultimas_vendas();
            $pedidoDao->disconnect();
            return $listPedido;

            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    //VISUALIZA
    public function visualizar($id_pedido){
    	try {
    	    $pedidoDao = $this->Factory->createDao("com_pedidos");
            $pedidoDao->connect();
            $objPedido = $pedidoDao->visualizar($id_pedido);
            $pedidoDao->disconnect();
            return $objPedido;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }

      //VISUALIZA
    public function visualizar_bar($id_pedido){
        try {
            $pedidoDao = $this->Factory->createDao("com_pedidos");
            $pedidoDao->connect();
            $objPedido = $pedidoDao->visualizar_bar($id_pedido);
            $pedidoDao->disconnect();
            return $objPedido;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }

    public function visualizar_simples($id_pedido){
        try {
            $pedidoDao = $this->Factory->createDao("com_pedidos");
            $pedidoDao->connect();
            $objPedido = $pedidoDao->visualizar_simples($id_pedido);
            $pedidoDao->disconnect();
            return $objPedido;
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }
    
    
    //EDITAR
    public function editar($dados){
    	try {
    	    $objPedido = $this->Factory->createPojo("com_pedidos",$dados);
            $pedidoDao = $this->Factory->createDao("com_pedidos");
            $pedidoDao->connect();
            $pedidoDao->alterar($objPedido);
            $pedidoDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }



      //CONFIRMAR ORÇAMENTO
    public function confirmar_orcamento($dados){
        try {
            $objPedido = $this->Factory->createPojo("com_pedidos",$dados);
            $pedidoDao = $this->Factory->createDao("com_pedidos");
            $pedidoDao->connect();
            $pedidoDao->confirmar_orcamento($objPedido);
            $pedidoDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }


      //SALVAR PEDIDO
    public function salvar_pedido($dados){
        try {
            //$objPedido = $this->Factory->createPojo("com_pedidos",$dados);
            $pedidoDao = $this->Factory->createDao("com_pedidos");
            $pedidoDao->connect();
            $pedidoDao->salvar_pedido($dados);
            $pedidoDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }


     //SALVAR PEDIDO
    public function incluir_obs($dados){
        try {
            //$objPedido = $this->Factory->createPojo("com_pedidos",$dados);
            $pedidoDao = $this->Factory->createDao("com_pedidos");
            $pedidoDao->connect();
            $pedidoDao->incluir_obs($dados);
            $pedidoDao->disconnect();
                
            } catch (Exception $exc) {
                throw $exc;
            }
    }


     //ALTERAR ORÇAMENTO PARA PEDIDO
    public function alterar_tipo($id_pedido){
        try {
            $pedidoDao = $this->Factory->createDao("com_pedidos");
            $pedidoDao->connect();
            $pedidoDao->alterar_tipo($id_pedido);
            $pedidoDao->disconnect();
        } catch (Exception $exc) {
                throw $exc;
            }
    }


    //ALTERAR STATUS
    public function alterar_status($id_pedido,$status){
        try {
            $pedidoDao = $this->Factory->createDao("com_pedidos");
            $pedidoDao->connect();
            $pedidoDao->alterar_status($id_pedido,$status);
            $pedidoDao->disconnect();
        } catch (Exception $exc) {
                throw $exc;
            }
    }

     //ALTERAR STATUS
    public function alterar_cliente($dados){
        try {
            $pedidoDao = $this->Factory->createDao("com_pedidos");
            $pedidoDao->connect();
            $pedidoDao->alterar_cliente($dados);
            $pedidoDao->disconnect();
        } catch (Exception $exc) {
                throw $exc;
            }
    }




   
    //EXCLUSÃO
    public function excluir($id_pedido){
    	try {
    	    $pedidoDao = $this->Factory->createDao("com_pedidos");
            $pedidoDao->connect();
            $pedidoDao->excluir($id_pedido);
            $pedidoDao->disconnect();
    	} catch (Exception $exc) {
                throw $exc;
            }
    }

        public function gerar_codigo(){
            try {
                 $codigoDao = $this->Factory->createDao("com_pedidos");
                 $codigoDao->connect();
                 $objCodigo = $codigoDao->gerar_codigo();
                 $codigoDao->disconnect();
                 return $objCodigo;
                
            } catch (Exception $exc) {
                throw $exc;
            }
        }


         public function gerar_codigo_orcamento(){
            try {
                 $codigoDao = $this->Factory->createDao("com_pedidos");
                 $codigoDao->connect();
                 $objCodigo = $codigoDao->gerar_codigo_orcamento();
                 $codigoDao->disconnect();
                 return $objCodigo;
                
            } catch (Exception $exc) {
                throw $exc;
            }
        }

         //LISTA
   
    public function listar_por_cliente($id_cliente,$tipo=null){
        try {
            
            $pedidoDao = $this->Factory->createDao("com_pedidos");
            $pedidoDao->connect();
            $listPedido = $pedidoDao->listar_por_cliente($id_cliente,$tipo);
            $pedidoDao->disconnect();
            return $listPedido;

            } catch (Exception $exc) {
                throw $exc;
            }
    }


      public function ajax_listar_entrega(){
        try {
            
            $categoriaDao = $this->Factory->createDao("com_pedidos");
            $categoriaDao->connect();
            $listCategoria = $categoriaDao->ajax_listar_entrega();
            $categoriaDao->disconnect();
            return $listCategoria;

            } catch (Exception $exc) {
                throw $exc;
            }
    }




}
?>
