<?php
/* Classe(controller): Produtos
 * Autor: Anderson Farias
 * Última atualização: 30/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Produtos_compras extends MY_Controller {
	
    //VALIDAÇÃO
    private function Rules(){
        $this->form_validation->set_rules('id_unidade','Unidade de Medida','required');
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
            //Unidade
            $unidadeBusiness = $this->Factory->createBusiness("est_un_medida");
            $listUnidade = $unidadeBusiness->filtro();
            $info["listUnidade"] = $listUnidade;
           
            //Categoria
            $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
            $listCategoria = $categoriaBusiness->filtro();
            $info["listCategoria"] = $listCategoria;
           
            
            //Fornecedor
            $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
            $listFornecedor = $fornecedorBusiness->filtro();
            $info["listFornecedor"] = $listFornecedor;
           
            $content = $this->load->view("produtos_compras/cadastrar",$info,TRUE);
            $this->loadPage($content);
        }
        else{
           $dados = $this->input->post();
            
           $dados['status'] = ATIVO;
           $dados['data_cadastro'] = date('Y-m-d');

           $produtosBusiness = $this->Factory->createBusiness("comp_produtos");
           $cod_produto = $produtosBusiness->cadastrar($dados);
           $msg = true;
           redirect('produtos_compras/cadastrar/'.$msg);
        }

    }

     public function add_ajax(){

        $this->load->helper(array('form','url'));

        $dados = $this->input->post();
        $dados['id_fornecedor'] = PAD_CAD_FORNECEDOR;
        $dados['status'] = ATIVO;
         $dados['deletado'] = DELETADO;
        $dados['data_cadastro'] = date('Y-m-d'); 
        $dados['tipo'] = PRODUTO; 
        $produtosBusiness = $this->Factory->createBusiness("comp_produtos");
        $cod_produto = $produtosBusiness->cadastrar($dados);    

      }


    //LISTAGEM
    public function filtro($dados=null){
        try {
            $this->load->helper(array('form','url'));
            
            if ($this->input->post() == NULL) {
            
            $produtosBusiness = $this->Factory->createBusiness("comp_produtos");
            $listProdutos = $produtosBusiness->filtro($dados);
            $info['listProdutos'] = $listProdutos;

            //Categoria
            $categoriaBusiness = $this->Factory->createBusiness("comp_categorias");
            $listCategoria = $categoriaBusiness->filtro();
            $info["listCategoria"] = $listCategoria;

            //Fornecedor
            $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
            $listFornecedor = $fornecedorBusiness->filtro();
            $info["listFornecedor"] = $listFornecedor;
            
            $content = $this->load->view("produtos_compras/filtro",$info,TRUE);
            $this->loadPage($content);

            }else{
            
            $dados = $this->input->post();
            
            $produtosBusiness = $this->Factory->createBusiness("comp_produtos");
            $listProdutos = $produtosBusiness->filtro($dados);
            $info['listProdutos'] = $listProdutos;

            //Categoria
            $categoriaBusiness = $this->Factory->createBusiness("comp_categorias");
            $listCategoria = $categoriaBusiness->filtro();
            $info["listCategoria"] = $listCategoria;

            //Fornecedor
            $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
            $listFornecedor = $fornecedorBusiness->filtro();
            $info["listFornecedor"] = $listFornecedor;
           	
            $content = $this->load->view("produtos/filtro",$info,TRUE);
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
              
            //Unidade
            $unidadeBusiness = $this->Factory->createBusiness("est_un_medida");
            $listUnidade = $unidadeBusiness->filtro();
            $info["listUnidade"] = $listUnidade;
           
            //Categoria
            $categoriaBusiness = $this->Factory->createBusiness("comp_categorias");
            $listCategoria = $categoriaBusiness->filtro();
            $info["listCategoria"] = $listCategoria;
           
            
            //Fornecedor
            $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
            $listFornecedor = $fornecedorBusiness->filtro();
            $info["listFornecedor"] = $listFornecedor;
          
              
              $produtosBusiness = $this->Factory->createBusiness("comp_produtos");
              $info["objProduto"] = $produtosBusiness->visualizar($id_produto);
              
              $content = $this->load->view("produtos_compras/visualizar",$info,TRUE);
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
              
               //Unidade
            $unidadeBusiness = $this->Factory->createBusiness("est_un_medida");
            $listUnidade = $unidadeBusiness->filtro();
            $info["listUnidade"] = $listUnidade;
           
            //Categoria
            $categoriaBusiness = $this->Factory->createBusiness("comp_categorias");
            $listCategoria = $categoriaBusiness->filtro();
            $info["listCategoria"] = $listCategoria;
           
            
            //Fornecedor
            $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
            $listFornecedor = $fornecedorBusiness->filtro();
            $info["listFornecedor"] = $listFornecedor;

            
            $produtosBusiness = $this->Factory->createBusiness("comp_produtos");
            $objProduto = $produtosBusiness->visualizar($id_produto);
            $info["objProduto"] = $objProduto;

            $info['msg'] = $msg;
           
            $content = $this->load->view("produtos_compras/editar",$info,TRUE);
            $this->loadPage($content);
              
           }
           
           else{
           	$dados = $this->input->post();
           	
            if($dados['id_fornecedor']==""){
              $dados['id_fornecedor'] = null;
            }

            $produtosBusiness = $this->Factory->createBusiness("comp_produtos");
           	$cod_produto = $produtosBusiness->editar($dados);

            $msg = true;


           	redirect('produtos_compras/editar/'.$dados['id_produto'].'/'.$msg);
            
           }
      }

      //EXCLUSÃO
      public function excluir($id_produto){
          $this->load->helper(array('form','url'));

          $produtosBusiness = $this->Factory->createBusiness("comp_produtos");
          $produtosBusiness->excluir($id_produto);
          redirect("produtos_compras/filtro");
      }
      
      public function teste(){
           $this->load->helper(array('form','url'));
           $dados = $this->input->post();
           echo $dados["categoria"];
           
           
      }


           //LISTAGEM
    public function ajax_listar_produto(){
   
      $this->load->helper(array('form','url'));
      
      $dados['descricao'] = $this->input->post('descricao',TRUE);
      $dados['codigo'] = $this->input->post('codigo',TRUE); 

      $produtoBusiness = $this->Factory->createBusiness("comp_produtos");
      $listProdutos = $produtoBusiness->ajax_listar_produto($dados);  
     
      echo json_encode($listProdutos); 
      
      
}



}
?>
