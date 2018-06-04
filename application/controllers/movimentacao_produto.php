<?php
/* Classe(controller): Movimentação
 * Autor: Anderson Farias
 * Última atualização: 11/07/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Movimentacao_produto extends MY_Controller {
	
    //VALIDA��O
    private function Rules(){
        $this->form_validation->set_rules('id_produto','Produto','required');
        $this->form_validation->set_rules('qtd_mov','Quantidade','required');
        $this->form_validation->set_rules('descricao','Motivo da Movimentação','required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"  id="msgOk">
<strong><i class="fa fa-check"></i></strong> ', '</div>');    
            
    }
    
    //CADASTRA
    public function cadastrar($id_produto,$msg=null){
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
        $this->Rules();
        $this->form_validation->set_rules('id_produto', 'CODIGO', 'callback_verificar_existente');
        
        $produtosBusiness = $this->Factory->createBusiness("est_produtos");
        $info["objProduto"] = $produtosBusiness->visualizar($id_produto);

         $qtd_estoque = $produtosBusiness->verificar_qtd($id_produto);
         $info['qtd_estoque'] = $qtd_estoque;
        
        //Fornecedor
        $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
        $listFornecedor = $fornecedorBusiness->filtro();
        $info["listFornecedor"] = $listFornecedor;

        $info['msg'] = $msg;
           
       if($this->form_validation->run()==FALSE){
            $content = $this->load->view("movimentacao_produto/cadastrar",$info,TRUE);
            $this->loadPage($content);
        }
        else{
            $dados = $this->input->post();
            $dados["data"] = date("Y-m-d H:i:s");

            $produtosBusiness = $this->Factory->createBusiness("est_produtos");
            $objProduto = $produtosBusiness->visualizar($dados['id_produto']);
            
            $dados['valor_unitario'] = $objProduto->getValor_venda();
            $dados['valor_custo'] = $objProduto->getValor_custo();
            $dados['tipo_retirada'] = MOV_MANUAL;
             
            $dados['id_usuario'] = $this->session->userdata('id_usuario');

            if($dados['tipo_movimentacao']==ENTRADA){
              $dados['qtd_mov'] = $dados['qtd_mov'];
              $dados['qtd_mov_saida'] = 0;
            }
            else{
              $dados['qtd_mov_saida'] = $dados['qtd_mov'];
              $dados['qtd_mov'] = 0;
            }
            
            $movimentacaoBusiness = $this->Factory->createBusiness("est_movimentacao");
            $cod_movimentacao = $movimentacaoBusiness->cadastrar($dados);
            $msg = true;

            redirect('movimentacao_produto/cadastrar/'.$dados["id_produto"].'/'.$msg);
        }

    }

    public function verificar_existente($id_produto) {
        try {
            
           // error_reporting(0);

            $id_produto = $this->input->post("id_produto");
            $tipo_movimentacao = $this->input->post("tipo_movimentacao");
            $qtd_mov = $this->input->post("qtd_mov");

            $estBusiness = $this->Factory->createBusiness("est_produtos");

            if($id_produto!=""){
             

              
              if($id_produto!=""){
               $objMov = $estBusiness->verificar_qtd($id_produto);
              }
              else{
                $objMov = 0;
              }
              
              /*if ($estBusiness->visualizar_por_codigo($codigo)) {
                  $this->form_validation->set_message('verificar_existente', 'O Código <a href='.site_url("produtos/editar/".$objProduto->getId_produto()).' target=_blank>'.$codigo.'</a> fornecido já existe na base de dados!');
                  return false;
              }*/
             
              if( ($qtd_mov > $objMov) && $tipo_movimentacao==SAIDA)
              {

                $this->form_validation->set_message('verificar_existente', 'Quantidade indisponível!');
                  return false;


              }

            
              else {
                return true;
              } 
            }


            
        } catch (Excpeption $ex) {
            $this->loadError($ex);
        }
    }


       //CADASTRA
    public function cadastrar_pela_mov($msg=null){
       
     
       $this->load->helper(array('form','url'));
       $this->load->library('form_validation');
       $this->Rules();

         if($this->form_validation->run()==FALSE){

          //PRODUTOS
         $produtosBusiness = $this->Factory->createBusiness("est_produtos");
         $listProdutos = $produtosBusiness->listar_produto_servico();
         $info['listProdutos'] = $listProdutos;
        
        $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
          $listCategoria = $categoriaBusiness->filtro(null);
          $info['listCategoria'] = $listCategoria;

        
        //Fornecedor
        $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
        $listFornecedor = $fornecedorBusiness->filtro();
        $info["listFornecedor"] = $listFornecedor;

        $info['msg'] = $msg;
           
 
            $content = $this->load->view("movimentacao_produto/cadastrar_pela_mov",$info,TRUE);
            $this->loadPage($content);
      }
        
        else{
            
            $dados = $this->input->post();
            $dados["data"] = date("Y-m-d H:i:s");
             $dados['tipo_retirada'] = MOV_MANUAL;

            
            $movimentacaoBusiness = $this->Factory->createBusiness("est_movimentacao");
            $cod_movimentacao = $movimentacaoBusiness->cadastrar($dados);
            $msg = true;
            redirect('movimentacao_produto/cadastrar_pela_mov/'.$msg);
        }

    }





    //LISTAGEM
    public function filtro($dados=null){
        try {
            $this->load->helper(array('form','url'));
            
            if ($this->input->post() == NULL) {
            
            $movimentacaoBusiness = $this->Factory->createBusiness("est_movimentacao");
            $listMov = $movimentacaoBusiness->filtro($dados);
            $info['listMov'] = $listMov;
            
            $content = $this->load->view("movimentacao_produto/filtro",$info,TRUE);
            $this->loadPage($content);

            }else{
            
            $dados = $this->input->post();
            
            $movimentacaoBusiness = $this->Factory->createBusiness("est_movimentacao");
            $listMov = $movimentacaoBusiness->filtro($dados);
            $info['listMov'] = $listMov;
            	
            $content = $this->load->view("movimentacao_produto/filtro",$info,TRUE);
            $this->loadPage($content);	
            	
            }
            
            

        } catch (Exception $exc) {
            $this->loadError($ex);
        }
    }
    
    //VISUALIZAÇÃO
    public function visualizar($id_movimentacao){
          try {
              $this->load->helper(array('form','url'));
              
              $movimentacaoBusiness = $this->Factory->createBusiness("est_movimentacao");
              $info["objMov"] = $movimentacaoBusiness->visualizarSimples($id_movimentacao);
              
              $content = $this->load->view("movimentacao_produto/visualizar",$info,TRUE);
              $this->loadPage($content);

          } catch (Exception $exc) {
              echo $exc->getTraceAsString();
          }

      }

      //EDIÇÃO
      public function editar($id_categoria){
          $this->load->helper(array('form','url'));
          $this->load->library('form_validation');
          
          $this->Rules();
          
          if($this->form_validation->run()==FALSE){
              $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
              $objCategoria = $categoriaBusiness->visualizar($id_categoria);
              $info["objCategoria"] = $objCategoria;
             
              $content = $this->load->view("est_categorias/editar",$info,TRUE);
              $this->loadPage($content);
              
           }
           
           else{
           	$dados = $this->input->post();
           	$categoriaBusiness = $this->Factory->createBusiness("est_categorias");
           	$cod_categoria = $categoriaBusiness->editar($dados);
           	redirect('est_categorias/filtro');
           }
      }

      //EXCLUSÃO
      public function excluir($id_categoria){
          $this->load->helper(array('form','url'));

          $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
          $categoriaBusiness->excluir($id_categoria);
          redirect("est_categorias/filtro");
      }
      
      
}
?>
