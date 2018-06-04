<?php

/* Classe(controller): Categoria de Produtos
 * Autor: Anderson Farias
 * Última atualização: 27/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Itens extends MY_Controller {
	
    //VALIDAÇÃO
    private function Rules(){
        $this->form_validation->set_rules('numero','Número da Mesa','required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"  id="msgOk">
<strong><i class="fa fa-check"></i></strong> ', '</div>');
    }
    
  

    //LISTAGEM
    public function filtro(){
        try {
            $this->load->helper(array('form','url'));
            
            if ($this->input->post() == NULL) {
            
            $categoriaBusiness = $this->Factory->createBusiness("com_pedidos_itens");
            $listCategoria = $categoriaBusiness->filtro(null);
            $info['listItens'] = $listCategoria;
            
            $content = $this->load->view("itens/filtro",$info,TRUE);
            $this->loadPage($content);

            }

            else{
            
            $dados = $this->input->post();
            
            $categoriaBusiness = $this->Factory->createBusiness("com_pedidos_itens");
            $listCategoria = $categoriaBusiness->filtro($dados);
            $info['listItens'] = $listCategoria;
           	
            $content = $this->load->view("itens/filtro",$info,TRUE);
            $this->loadPage($content);	
            	
            }

          } catch (Exception $exc) {
            $this->loadError($ex);
        }
  }


   public function alterar_status($id_item,$status){


         $this->load->helper(array('form','url'));
        
         $dados['id_item'] = $id_item;
         $dados['status'] = $status;
         $dados['usuario'] = $this->session->userdata('login');

         $pedidoBusiness = $this->Factory->createBusiness("com_pedidos_itens");
         $pedidoBusiness->editar_manual($dados);

         redirect('itens/filtro/');


      }

      public function conferir($id_item){


         $this->load->helper(array('form','url'));
        
         $dados['id_item'] = $id_item;
         $dados['conferir'] = SIM;
         $dados['usuario'] = $this->session->userdata('login');


         $pedidoBusiness = $this->Factory->createBusiness("com_pedidos_itens");
         $pedidoBusiness->editar_manual($dados);

         redirect('pedidos/filtro/2');


      }

       public function conferir_todos(){


         $this->load->helper(array('form','url'));
          error_reporting(0);
        
        // $dados['usuario'] = $this->session->userdata('login');


         $pedidoBusiness = $this->Factory->createBusiness("com_pedidos_itens");
         $pedidoBusiness->conferir_todos();

         redirect('pedidos/filtro/2');


      }



       public function editar_itens(){
        
       $this->load->helper(array('form','url'));
       
       $dadosForm = $this->input->post();
       
       $dados['id_item'] = $dadosForm['id_item'];
       $dados['id_produto'] = $dadosForm['edit_id_produto'];
       //$dados['valor_unitario'] = $dadosForm['edit_preco'];
       $dados['valor_unitario'] =  str_replace(",",".",str_replace(".","",$dadosForm['edit_preco']));
       $dados['qtd'] = $dadosForm['edit_qtd'];
       $dados['descricao'] = $dadosForm['edit_descricao'];

        //Pega o nome do produto
        $produtosBusiness = $this->Factory->createBusiness("est_produtos");
        $objProduto = $produtosBusiness->visualizar($dados['id_produto']);
        if($objProduto!=null){
           $dados['produto_nome'] = $objProduto->getDescricao(); 
        }

          $objDateFormat = $this->DateFormat;
          $dados['data_inicio'] = $objDateFormat->date_mysql($dadosForm['edit_data_inicio']);
          $dados['data_prev_entrega'] = $objDateFormat->date_mysql($dadosForm['edit_data_prev_entrega']);

       

         $pedidoBusiness = $this->Factory->createBusiness("com_pedidos_itens");
         $pedidoBusiness->editar_manual($dados);

         //redirect('itens/filtro/');


      }

        public function duplica_itens(){
        
       $this->load->helper(array('form','url'));
       
       $dadosForm = $this->input->post();
       
      
       $dados['id_pedido'] = $dadosForm['id_pedido'];
       $dados['id_produto'] = $dadosForm['edit_id_produto'];
       $dados['cozinha'] = $dadosForm['edit_cozinha'];
       $dados['deletado'] = 0;
       $dados['desconto'] = 0;
       $dados['data_inclusao'] = date('Y-m-d'); 
      
       $dados['usuario'] = $this->session->userdata('login');
       $dados['status'] = ITEM_ABERTO;

       $dados['valor_unitario'] =  str_replace(",",".",str_replace(".","",$dadosForm['edit_preco']));
       $dados['qtd'] = $dadosForm['edit_qtd'];
       $dados['descricao'] = $dadosForm['edit_descricao'];

        //Pega o nome do produto
        $produtosBusiness = $this->Factory->createBusiness("est_produtos");
        $objProduto = $produtosBusiness->visualizar($dados['id_produto']);
        if($objProduto!=null){
           $dados['produto_nome'] = $objProduto->getDescricao(); 
        }

       

         $pedidoBusiness = $this->Factory->createBusiness("com_pedidos_itens");
         $pedidoBusiness->cadastrar($dados);

         //redirect('itens/filtro/');


      }




   //EDIÇÃO (ANALISAR, NÃO USADO)
      public function editar($id_mesa,$msg=null){
          $this->load->helper(array('form','url'));
          $this->load->library('form_validation');
          
          $this->Rules();
          
          if($this->form_validation->run()==FALSE){
              $categoriaBusiness = $this->Factory->createBusiness("mesas");
              $objCategoria = $categoriaBusiness->visualizar($id_mesa);
              $info["objCategoria"] = $objCategoria;
              $info['msg'] = $msg;
             
              $content = $this->load->view("mesas/editar",$info,TRUE);
              $this->loadPage($content);
              
           }
           
           else{
            $dados = $this->input->post();
            $categoriaBusiness = $this->Factory->createBusiness("mesas");
            $cod_categoria = $categoriaBusiness->editar($dados);
            $msg = true;
            redirect('mesas/editar/'.$dados['id_mesa'].'/'.$msg);
           }
      }

      //EXCLUSÃO
      public function excluir($id_mesa){
          $this->load->helper(array('form','url'));

          $categoriaBusiness = $this->Factory->createBusiness("mesas");
          $categoriaBusiness->excluir($id_categoria);
          redirect("mesas/filtro");
      }


        public function ajax_visualizar_item($id_item){

      //header( 'Cache-Control: no-cache' );
      //header( 'Content-type: application/xml; charset="utf-8"', true );
      
      $this->load->helper(array('form','url'));
      
      $itemBusiness = $this->Factory->createBusiness("com_pedidos_itens");
      $item = $itemBusiness->visualizar($id_item);  

      $objDateFormat = $this->DateFormat; 
         
         $itemArr[] = array(
               'id_item'   => $item->getId_item(),
               'id_pedido'   => $item->getId_pedido(),
               'id_produto'   => $item->getId_produto(),
               'produto_nome'   => $item->getProduto_nome(),
               'qtd'   => round($item->getQtd()),
               'data_inicio'   => $objDateFormat->date_format($item->getData_inicio()),
               'data_prev_entrega'   => $objDateFormat->date_format($item->getData_prev_entrega()),
              
               'valor_unitario'   => number_format($item->getValor_unitario(), 2, ',', '.'),
               'descricao'   => $item->getDescricao()
                           
               

               );
      echo json_encode($itemArr); 
                
    }


     public function ajax_listar_entrega(){

      //header( 'Cache-Control: no-cache' );
      //header( 'Content-type: application/xml; charset="utf-8"', true );
      
      $this->load->helper(array('form','url'));
      
      $itemBusiness = $this->Factory->createBusiness("com_pedidos_itens");
      $item = $itemBusiness->ajax_listar_entrega();  

      echo json_encode($item); 
                
    }


  






     
      
      
}
?>
