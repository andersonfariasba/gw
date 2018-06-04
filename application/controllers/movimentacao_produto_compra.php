<?php
/* Classe(controller): Movimentação
 * Autor: Anderson Farias
 * Última atualização: 11/07/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Movimentacao_produto_compra extends MY_Controller {
	
    //VALIDA��O
    private function Rules(){
        $this->form_validation->set_rules('id_produto','Produto','required');
        $this->form_validation->set_rules('qtd_mov','Quantidade','required');
        $this->form_validation->set_error_delimiters('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');
    }
    
    //CADASTRA
    public function cadastrar($id_produto,$msg=null){
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
        $this->Rules();
        
        $produtosBusiness = $this->Factory->createBusiness("comp_produtos");
        $info["objProduto"] = $produtosBusiness->visualizar($id_produto);
        
        //Fornecedor
        $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
        $listFornecedor = $fornecedorBusiness->filtro();
        $info["listFornecedor"] = $listFornecedor;

        $info['msg'] = $msg;
           
       if($this->form_validation->run()==FALSE){
            $content = $this->load->view("movimentacao_produto_compra/cadastrar",$info,TRUE);
            $this->loadPage($content);
        }
        else{
            $dados = $this->input->post();
            $dados["data"] = date("Y-m-d H:i:s");

            $produtosBusiness = $this->Factory->createBusiness("comp_produtos");
            $objProduto = $produtosBusiness->visualizar($dados['id_produto']);
            
            $dados['valor_unitario'] = $objProduto->getValor_venda();
            $dados['valor_custo'] = $objProduto->getValor_custo();
            
            $movimentacaoBusiness = $this->Factory->createBusiness("comp_movimentacao");
            $cod_movimentacao = $movimentacaoBusiness->cadastrar($dados);
            $msg = true;

            redirect('movimentacao_produto_compra/cadastrar/'.$dados["id_produto"].'/'.$msg);
        }

    }

       //CADASTRA
    public function cadastrar_pela_mov($msg=null){
       
     
       $this->load->helper(array('form','url'));
       $this->load->library('form_validation');
       $this->Rules();

         if($this->form_validation->run()==FALSE){

          //PRODUTOS
         $produtosBusiness = $this->Factory->createBusiness("comp_produtos");
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
           
 
            $content = $this->load->view("movimentacao_produto_compra/cadastrar_pela_mov",$info,TRUE);
            $this->loadPage($content);
      }
        
        else{
            
            $dados = $this->input->post();
            $dados["data"] = date("Y-m-d H:i:s");
            
            $movimentacaoBusiness = $this->Factory->createBusiness("comp_movimentacao");
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
            
            $movimentacaoBusiness = $this->Factory->createBusiness("comp_movimentacao");
            $listMov = $movimentacaoBusiness->filtro($dados);
            $info['listMov'] = $listMov;
            
            $content = $this->load->view("movimentacao_produto_compra/filtro",$info,TRUE);
            $this->loadPage($content);

            }else{
            
            $dados = $this->input->post();
            
            $movimentacaoBusiness = $this->Factory->createBusiness("comp_movimentacao");
            $listMov = $movimentacaoBusiness->filtro($dados);
            $info['listMov'] = $listMov;
            	
            $content = $this->load->view("movimentacao_produto_compra/filtro",$info,TRUE);
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
              
              $movimentacaoBusiness = $this->Factory->createBusiness("comp_movimentacao");
              $info["objMov"] = $movimentacaoBusiness->visualizarSimples($id_movimentacao);
              
              $content = $this->load->view("movimentacao_produto_compra/visualizar",$info,TRUE);
              $this->loadPage($content);

          } catch (Exception $exc) {
              echo $exc->getTraceAsString();
          }

      }

    
      
      
}
?>
