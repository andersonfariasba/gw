<?php
/* Classe(controller): Produtos
 * Autor: Anderson Farias
 * Última atualização: 30/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Compras extends MY_Controller {
	
    //VALIDAÇÃO
    private function Rules(){
       
        $this->form_validation->set_rules('descricao','Descrição','required');
        $this->form_validation->set_error_delimiters('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');
    }
    
    //CADASTRA
    public function cadastrar($msg=null){
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
        $this->Rules();
        $info['msg'] = $msg;
        
        if($this->form_validation->run()==FALSE){
                  
            
            //Fornecedor
            $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
            $listFornecedor = $fornecedorBusiness->filtro();
            $info["listFornecedor"] = $listFornecedor;
           
            $content = $this->load->view("compras/cadastrar",$info,TRUE);
            $this->loadPage($content);
        }
        else{
           $dados = $this->input->post();
            
           $dados['data_cadastro'] = date('Y-m-d');
           $produtosBusiness = $this->Factory->createBusiness("comp_produtos");
           $cod_produto = $produtosBusiness->cadastrar($dados);
           $msg = true;
           redirect('compras/cadastrar/'.$msg);
        }

    }


    //LISTAGEM
    public function filtro($dados=null){
        try {
            $this->load->helper(array('form','url'));
            
            if ($this->input->post() == NULL) {
            
            $produtosBusiness = $this->Factory->createBusiness("comp_produtos");
            $listProdutos = $produtosBusiness->filtro($dados);
            $info['listProdutos'] = $listProdutos;

           
            
            $content = $this->load->view("compras/filtro",$info,TRUE);
            $this->loadPage($content);

            }else{
            
            $dados = $this->input->post();
            
            $produtosBusiness = $this->Factory->createBusiness("comp_produtos");
            $listProdutos = $produtosBusiness->filtro($dados);
            $info['listProdutos'] = $listProdutos;

          
           	
            $content = $this->load->view("compras/filtro",$info,TRUE);
            $this->loadPage($content);	
            	
            }
            
          } catch (Exception $exc) {
            $this->loadError($ex);
        }
    }
    
    //VISUALIZAÇÃO
    public function visualizar($id_produto){
          try {
              $this->load->helper(array('form','url'));
              
                   
              
              $produtosBusiness = $this->Factory->createBusiness("comp_produtos");
              $info["objProduto"] = $produtosBusiness->visualizar($id_produto);
              
              $content = $this->load->view("compras/visualizar",$info,TRUE);
              $this->loadPage($content);

          } catch (Exception $exc) {
              echo $exc->getTraceAsString();
          }

      }

      //EDIÇÃO
      public function editar($id_produto,$msg=null){
          $this->load->helper(array('form','url'));
          $this->load->library('form_validation');
          
          $this->Rules();
          
          if($this->form_validation->run()==FALSE){
            

            $produtosBusiness = $this->Factory->createBusiness("comp_produtos");
            $objProduto = $produtosBusiness->visualizar($id_produto);
            $info["objProduto"] = $objProduto;

            $info['msg'] = $msg;
           
            $content = $this->load->view("compras/editar",$info,TRUE);
            $this->loadPage($content);
              
           }
           
           else{
           	$dados = $this->input->post();
           	
          
            $produtosBusiness = $this->Factory->createBusiness("comp_produtos");
           	$cod_produto = $produtosBusiness->editar($dados);

            $msg = true;


           	redirect('compras/editar/'.$dados['id_produto'].'/'.$msg);
            
           }
      }

      //EXCLUSÃO
      public function excluir($id_produto){
          $this->load->helper(array('form','url'));

          $produtosBusiness = $this->Factory->createBusiness("comp_produtos");
          $produtosBusiness->excluir($id_produto);
          redirect("compras/filtro");
      }
      
     
      
  


}
?>
