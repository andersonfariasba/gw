<?php
/* Classe(controller): Produtos
 * Autor: Anderson Farias
 * Última atualização: 30/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Produtos extends MY_Controller {
	
    //VALIDAÇÃO
    private function Rules(){
       // $this->form_validation->set_rules('id_fornecedor','Fornecedor','required');
        $this->form_validation->set_rules('id_unidade','Unidade de Medida','required');
        $this->form_validation->set_rules('id_categoria','Categoria','required');
        $this->form_validation->set_rules('descricao','Descrição','required');
        $this->form_validation->set_rules('codigo','Código','required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"  id="msgOk">
<strong><i class="fa fa-check"></i></strong> ', '</div>');    
    }
    
    //CADASTRA
    public function cadastrar($msg=null){
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
        $this->Rules();
        $this->form_validation->set_rules('codigo', 'CODIGO', 'callback_verificar_existente');
        
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
           
            $content = $this->load->view("produtos/cadastrar",$info,TRUE);
            $this->loadPage($content);
        }
        else{
            error_reporting(0);
           $dados = $this->input->post();
            
           $dados['status'] = ATIVO;
           $dados['data_cadastro'] = date('Y-m-d');
           if($dados['id_fornecedor']==""){
            $dados['id_fornecedor'] = PAD_CAD_FORNECEDOR;
           }

           $produtosBusiness = $this->Factory->createBusiness("est_produtos");
           $cod_produto = $produtosBusiness->cadastrar($dados);

           //CASO INSIRA UMA QUANTIDADE

           if($dados['qtd_disponivel']>0){

           $dadosMov['id_produto'] = $cod_produto;
           $dadosMov['valor_unitario'] = $dados['valor_venda'];
           $dadosMov['valor_custo'] = $dados['valor_custo'];
           $dadosMov['data'] = date('Y-m-d');
           $dadosMov['tipo_movimentacao'] = ENTRADA;
           $dadosMov['qtd_mov'] = $dados['qtd_disponivel'];
           $dadosMov['descricao'] = "ENTRADA INICIAL";
           $dados['responsavel'] = $this->session->userdata('login');
           $dados['id_usuario'] = $this->session->userdata('id_usuario');

            
           $movimentacaoBusiness = $this->Factory->createBusiness("est_movimentacao");
           $cod_movimentacao = $movimentacaoBusiness->cadastrar($dadosMov);
          }


           //FINAL OPERAÇÃO DE QUANTIDADE



           $msg = true;
           redirect('produtos/cadastrar/'.$msg);
        }

    }

     public function verificar_existente($codigo) {
        try {
            
            $codigo = $this->input->post("codigo");

            $estBusiness = $this->Factory->createBusiness("est_produtos");

            if($codigo!=""){
              $objProduto = $estBusiness->visualizar_por_codigo($codigo);

              if ($estBusiness->visualizar_por_codigo($codigo)) {
                  $this->form_validation->set_message('verificar_existente', 'O Código <a href='.site_url("produtos/editar/".$objProduto->getId_produto()).' target=_blank>'.$codigo.'</a> fornecido já existe na base de dados!');
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


    //LISTAGEM
    public function filtro($dados=null){
        try {
            $this->load->helper(array('form','url'));
            
            if ($this->input->post() == NULL) {
            
            $produtosBusiness = $this->Factory->createBusiness("est_produtos");
            $listProdutos = $produtosBusiness->filtro($dados);
            $info['listProdutos'] = $listProdutos;

            //Categoria
            $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
            $listCategoria = $categoriaBusiness->filtro();
            $info["listCategoria"] = $listCategoria;

            //Fornecedor
            $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
            $listFornecedor = $fornecedorBusiness->filtro();
            $info["listFornecedor"] = $listFornecedor;
            
            $content = $this->load->view("produtos/filtro",$info,TRUE);
            $this->loadPage($content);

            }else{
            
            $dados = $this->input->post();
            
            $produtosBusiness = $this->Factory->createBusiness("est_produtos");
            $listProdutos = $produtosBusiness->filtro($dados);
            $info['listProdutos'] = $listProdutos;

            //Categoria
            $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
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
            $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
            $listCategoria = $categoriaBusiness->filtro();
            $info["listCategoria"] = $listCategoria;
           
            
            //Fornecedor
            $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
            $listFornecedor = $fornecedorBusiness->filtro();
            $info["listFornecedor"] = $listFornecedor;
          
              
              $produtosBusiness = $this->Factory->createBusiness("est_produtos");
              $info["objProduto"] = $produtosBusiness->visualizar($id_produto);
              
              $content = $this->load->view("produtos/visualizar",$info,TRUE);
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
            $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
            $listCategoria = $categoriaBusiness->filtro();
            $info["listCategoria"] = $listCategoria;
           
            
            //Fornecedor
            $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
            $listFornecedor = $fornecedorBusiness->filtro();
            $info["listFornecedor"] = $listFornecedor;

            
            $produtosBusiness = $this->Factory->createBusiness("est_produtos");
            $objProduto = $produtosBusiness->visualizar($id_produto);
            $info["objProduto"] = $objProduto;

            $info["valor_medio"] = $produtosBusiness->valor_medio($id_produto);

            $info['msg'] = $msg;
           
            $content = $this->load->view("produtos/editar",$info,TRUE);
            $this->loadPage($content);
              
           }
           
           else{
           	 error_reporting(0);
            $dados = $this->input->post();
           	
            if($dados['id_fornecedor']==""){
              $dados['id_fornecedor'] = null;
            }

            /*if($dados['habilitado_venda']==null){
             $dados['habilitado_venda'] = null; 
            }else{
              $dados['habilitado_venda'] = SIM;
            }*/

            $produtosBusiness = $this->Factory->createBusiness("est_produtos");
           	$cod_produto = $produtosBusiness->editar($dados);

            $msg = true;


           	redirect('produtos/editar/'.$dados['id_produto'].'/'.$msg);
            
           }
      }

      //EXCLUSÃO
      public function excluir($id_produto){
          $this->load->helper(array('form','url'));

          $produtosBusiness = $this->Factory->createBusiness("est_produtos");
          $produtosBusiness->excluir($id_produto);
          redirect("produtos/filtro");
      }
      
      public function teste($codigo){
           $this->load->helper(array('form','url'));
            $produtoBusiness = $this->Factory->createBusiness("est_produtos");
            $objProduto = $produtoBusiness->visualizar_por_codigo($codigo);

            $listCategoria[] = array(
               'id_produto'   => $objProduto->getId_produto(),
               'codigo'   => $objProduto->getCodigo(),
               'descricao'      => $objProduto->getDescricao(),
               'valor_venda'      => $objProduto->getValor_venda(),
               );

             
              echo json_encode($listCategoria); 
           

      }


           //LISTAGEM
    public function ajax_listar_produto(){
   
      $this->load->helper(array('form','url'));
      
      $dados['descricao'] = $this->input->post('descricao',TRUE);
      $dados['codigo'] = $this->input->post('codigo',TRUE); 

      $produtoBusiness = $this->Factory->createBusiness("est_produtos");
      $listProdutos = $produtoBusiness->ajax_listar_produto($dados);  
     
      echo json_encode($listProdutos); 
      
      
}

 public function pesquisar_por_codigo($codigo){
           
           $this->load->helper(array('form','url'));
            $produtoBusiness = $this->Factory->createBusiness("est_produtos");
            $objProduto = $produtoBusiness->visualizar_por_codigo($codigo);

            $listCategoria[] = array(
               'id_produto'   => $objProduto->getId_produto(),
               'codigo'   => $objProduto->getCodigo(),
               'descricao'      => $objProduto->getDescricao(),
               'valor_venda'      => $objProduto->getValor_venda(),
               );

             
              echo json_encode($listCategoria); 
           

  }


   public function ajax_visualizar_produto($id_produto){
           $this->load->helper(array('form','url'));
            
            $produtoBusiness = $this->Factory->createBusiness("est_produtos");
            $listProdutos = $produtoBusiness->ajax_visualizar_produto($id_produto);  
            echo json_encode($listProdutos); 
            
          
      }



}
?>
