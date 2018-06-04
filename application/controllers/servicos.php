<?php
/* Classe(controller): Servicos
 * Autor: Anderson Farias
 * Última atualização: 12/07/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Servicos extends MY_Controller {
	
    //VALIDAÇÃO
    private function Rules(){
        $this->form_validation->set_rules('id_categoria','Categoria','required');
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
           
            //Categoria
            $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
            $listCategoria = $categoriaBusiness->filtro();
            $info["listCategoria"] = $listCategoria;
           
            $content = $this->load->view("servicos/cadastrar",$info,TRUE);
            $this->loadPage($content);
        }
        else{
           $dados = $this->input->post();
            
           $dados['status'] = ATIVO;
           $dados['habilitado_venda'] = SIM;
           $dados['data_cadastro'] = date('Y-m-d');
           $produtosBusiness = $this->Factory->createBusiness("est_servicos");
           $cod_produto = $produtosBusiness->cadastrar($dados);
           $msg = true;

           redirect('servicos/cadastrar/'.$msg);
        }

    }


    //LISTAGEM
    public function filtro($dados=null){
        try {
            $this->load->helper(array('form','url'));
            
            if ($this->input->post() == NULL) {
            
            $produtosBusiness = $this->Factory->createBusiness("est_servicos");
            $listProdutos = $produtosBusiness->filtro($dados);
            $info['listProdutos'] = $listProdutos;

             //Categoria
            $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
            $listCategoria = $categoriaBusiness->filtro();
            $info["listCategoria"] = $listCategoria;
            
            $content = $this->load->view("servicos/filtro",$info,TRUE);
            $this->loadPage($content);

            }else{
            
            $dados = $this->input->post();
            
            $produtosBusiness = $this->Factory->createBusiness("est_servicos");
            $listProdutos = $produtosBusiness->filtro($dados);
            $info['listProdutos'] = $listProdutos;

             //Categoria
            $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
            $listCategoria = $categoriaBusiness->filtro();
            $info["listCategoria"] = $listCategoria;
           	
            $content = $this->load->view("servicos/filtro",$info,TRUE);
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
              
              
                //Categoria
              $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
              $listCategoria = $categoriaBusiness->filtro();
              $info["listCategoria"] = $listCategoria;
              
              $produtosBusiness = $this->Factory->createBusiness("est_servicos");
              $info["objProduto"] = $produtosBusiness->visualizar($id_produto);
              
              $content = $this->load->view("servicos/visualizar",$info,TRUE);
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
              
             //Categoria
            $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
            $listCategoria = $categoriaBusiness->filtro();
            $info["listCategoria"] = $listCategoria;
           
            $produtosBusiness = $this->Factory->createBusiness("est_produtos");
            $objProduto = $produtosBusiness->visualizar($id_produto);
            $info["objProduto"] = $objProduto;

            $info['msg'] = $msg;

            $content = $this->load->view("servicos/editar",$info,TRUE);
            $this->loadPage($content);
              
           }
           
           else{
           	
            $dados = $this->input->post();
            $dados['habilitado_venda'] = SIM;
           	
            $produtosBusiness = $this->Factory->createBusiness("est_servicos");
           	$cod_produto = $produtosBusiness->editar($dados);

            $msg = true;
           	redirect('servicos/editar/'.$dados['id_produto'].'/'.$msg);
           }
      }

      //EXCLUSÃO
      public function excluir($id_produto){
          $this->load->helper(array('form','url'));

          $produtosBusiness = $this->Factory->createBusiness("est_servicos");
          $produtosBusiness->excluir($id_produto);
          redirect("servicos/filtro");
      }
      
      
}
?>
