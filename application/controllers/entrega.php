<?php

/* Classe(controller): Categoria de Produtos
 * Autor: Anderson Farias
 * Última atualização: 27/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Entrega extends MY_Controller {
	
    //VALIDAÇÃO
    private function Rules(){
        $this->form_validation->set_rules('id_status','Status de Entrega','required');
        $this->form_validation->set_rules('qtd_entregue','Quantidade Entregue','required');
        $this->form_validation->set_rules('conferente','Conferente','required');
        $this->form_validation->set_rules('forma_entrega','Forma de Entrega','required');
         $this->form_validation->set_rules('data_entrega_final','Data de Entrega','required');

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"  id="msgOk">
<strong><i class="fa fa-check"></i></strong> ', '</div>');
    }
    
    //LISTAGEM
    public function filtro(){
        try {
            $this->load->helper(array('form','url'));
            
            if ($this->input->post() == NULL) {
            
            $categoriaBusiness = $this->Factory->createBusiness("com_pedidos");
            $listCategoria = $categoriaBusiness->filtro_entrega(null);
            $info['listItens'] = $listCategoria;

            $categoriaBusiness = $this->Factory->createBusiness("com_status_itens");
            $listCategoria = $categoriaBusiness->filtro(null);
            $info['listStatus'] = $listCategoria;

              //Listagem de Clientes
            $clientesBusiness = $this->Factory->createBusiness("com_clientes");
            $listCliente = $clientesBusiness->listar_cliente_orcamento();
            $info['listCliente'] = $listCliente;

           
            
            $content = $this->load->view("entrega/filtro",$info,TRUE);
            $this->loadPage($content);

            }

            else{
            
            $dados = $this->input->post();
            
            $categoriaBusiness = $this->Factory->createBusiness("com_pedidos");
            $listCategoria = $categoriaBusiness->filtro_entrega($dados);
            $info['listItens'] = $listCategoria;

            $categoriaBusiness = $this->Factory->createBusiness("com_status_itens");
            $listCategoria = $categoriaBusiness->filtro(null);
            $info['listStatus'] = $listCategoria;

            //Listagem de Clientes
            $clientesBusiness = $this->Factory->createBusiness("com_clientes");
            $listCliente = $clientesBusiness->listar_cliente_orcamento();
            $info['listCliente'] = $listCliente;
           	
            $content = $this->load->view("entrega/filtro",$info,TRUE);
            $this->loadPage($content);	
            	
            }

          } catch (Exception $exc) {
            $this->loadError($ex);
        }
  }

  //LISTAGEM
    public function filtro_hoje(){
        try {
            $this->load->helper(array('form','url'));
            
            if ($this->input->post() == NULL) {
            
            $dados['data_de'] = date('Y-m-d');
            $dados['data_ate'] = date('Y-m-d');
            
            $categoriaBusiness = $this->Factory->createBusiness("com_pedidos");
            $listCategoria = $categoriaBusiness->filtro_entrega_hoje($dados);
            $info['listItens'] = $listCategoria;

            $categoriaBusiness = $this->Factory->createBusiness("com_status_itens");
            $listCategoria = $categoriaBusiness->filtro(null);
            $info['listStatus'] = $listCategoria;

              //Listagem de Clientes
            $clientesBusiness = $this->Factory->createBusiness("com_clientes");
            $listCliente = $clientesBusiness->listar_cliente_orcamento();
            $info['listCliente'] = $listCliente;

           
            
            $content = $this->load->view("entrega/filtro",$info,TRUE);
            $this->loadPage($content);

            }

            else{
            
            $dados = $this->input->post();
            
            $categoriaBusiness = $this->Factory->createBusiness("com_pedidos");
            $listCategoria = $categoriaBusiness->filtro_entrega($dados);
            $info['listItens'] = $listCategoria;

            $categoriaBusiness = $this->Factory->createBusiness("com_status_itens");
            $listCategoria = $categoriaBusiness->filtro(null);
            $info['listStatus'] = $listCategoria;

            //Listagem de Clientes
            $clientesBusiness = $this->Factory->createBusiness("com_clientes");
            $listCliente = $clientesBusiness->listar_cliente_orcamento();
            $info['listCliente'] = $listCliente;
            
            $content = $this->load->view("entrega/filtro",$info,TRUE);
            $this->loadPage($content);  
              
            }

          } catch (Exception $exc) {
            $this->loadError($ex);
        }
  }



  public function verificar_qtd($id_item) {
        try {
            
            $id_item = $this->input->post("id_item");
            $qtd_entregue_form =  $this->input->post("qtd_entregue");
            $itensBusiness = $this->Factory->createBusiness("com_pedidos_itens");
            $objItem = $itensBusiness->visualizar($id_item);
            $qtd_solicitada = $objItem->getQtd();
            $qtd_entregue_atual = $objItem->getQtd_entregue();
            $total_entregue = $qtd_entregue_form + $qtd_entregue_atual;

            // if($cnpj_cpf!=""){
              if ( ($total_entregue > $qtd_solicitada) && ($objItem->getQtd_entregue()!=$objItem->getQtd()) ) {
                  $this->form_validation->set_message('verificar_qtd', 'A quantidade Entregue informada esta superior a Solicitada');
                  return false;
              }
              else {
                return true;
              } 
            //}


            
        } catch (Excpeption $ex) {
            $this->loadError($ex);
        }
    }


    //EDIÇÃO
      public function editar($id_item,$msg=null){
          $this->load->helper(array('form','url'));
          $this->load->library('form_validation');
          
          $this->Rules();
           $this->form_validation->set_rules('id_item', 'id_item', 'callback_verificar_qtd');
          
          if($this->form_validation->run()==FALSE){
              
              //DADOS DO ITEM
              $itemBusiness = $this->Factory->createBusiness("com_pedidos_itens");
              $objItem = $itemBusiness->visualizar($id_item);
              $info["objItem"] = $objItem;

              $pedidosBusiness = $this->Factory->createBusiness("com_pedidos");
              $objPedido = $pedidosBusiness->visualizar($objItem->getId_pedido());
              $info['objPedido'] = $objPedido;

              $statusBusiness = $this->Factory->createBusiness("com_status_itens");
              $listStatus = $statusBusiness->filtro(null);
              $info['listStatus'] = $listStatus;

              $userBusiness = $this->Factory->createBusiness("acesso_usuarios");
              $listUser = $userBusiness->filtro(null);
              $info['listUser'] = $listUser;

              $formaEntregaBusiness = $this->Factory->createBusiness("com_forma_entrega");
              $listForma = $formaEntregaBusiness->filtro(null);
              $info['listForma'] = $listForma;



              $info['msg'] = $msg;


             
              $content = $this->load->view("entrega/editar",$info,TRUE);
              $this->loadPage($content);
              
           }
           
           else{
            $dados = $this->input->post();

            $itemBusiness = $this->Factory->createBusiness("com_pedidos_itens");
            $objItem = $itemBusiness->visualizar($dados['id_item']);
            $info["objItem"] = $objItem;

              if($objItem->getQtd_entregue()!=$dados['qtd_entregue']){
                 $dados['qtd_entregue'] = $objItem->getQtd_entregue() + $dados['qtd_entregue'];

                 //REALIZA MOVIMENTAÇÃO NO ESTOQUE
                $movimentacaoBusiness = $this->Factory->createBusiness("est_movimentacao");
                $dadosMov['id_produto'] = $objItem->getId_produto();
                $dadosMov['id_pedido'] = $objItem->getId_pedido();
                $dadosMov['data'] =  date('Y-m-d H:i');
                $dadosMov['qtd_mov'] = $dados['qtd_entregue'];
                $dadosMov['qtd_mov_saida'] = 0;
                $dadosMov['qtd_solicitada'] = $objItem->getQtd();
               
                $dadosMov['valor_unitario'] = $objItem->getValor_unitario();
                $dadosMov['id_usuario'] = $this->session->userdata('id_usuario');
                $dadosMov['responsavel'] = $this->session->userdata('login');
                $dadosMov['tipo_movimentacao'] = ADD_MOV;
                $dadosMov['descricao'] = "RETORNO PRODUTO LOCAÇÃO";
                $movimentacaoBusiness->cadastrar($dadosMov);


              }

            
            
            $objDateFormat = $this->DateFormat;
            $dados['data_entrega_final'] = $objDateFormat->date_mysql($dados['data_entrega_final']);

            $itensBusiness = $this->Factory->createBusiness("com_pedidos_itens");
            $item = $itensBusiness->editar_manual($dados);
            $msg = true;
            redirect('entrega/editar/'.$dados['id_item'].'/'.$msg);
           }
      }


   
       //LISTAGEM
    public function ajax_listar($pos){

      //header( 'Cache-Control: no-cache' );
      //header( 'Content-type: application/xml; charset="utf-8"', true );
      
      $this->load->helper(array('form','url'));
      $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
      $listCategoria = $categoriaBusiness->ajax_listar($pos);  
     
      echo json_encode($listCategoria); 
                
    }



      public function alterar_status($id_item,$id_status){


         $this->load->helper(array('form','url'));
          
         $dados['id_item'] = $id_item;
         $dados['id_status'] = $id_status; 
         $pedidoBusiness = $this->Factory->createBusiness("com_pedidos_itens");
         $pedidoBusiness->editar_manual($dados);

         redirect('entrega/filtro/');


      }







     
      
      
}
?>
