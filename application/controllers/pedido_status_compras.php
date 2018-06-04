<?php

/* Classe(controller): Categoria de Produtos
 * Autor: Anderson Farias
 * Última atualização: 27/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Pedido_status_compras extends MY_Controller {
	
    //VALIDAÇÃO
    private function Rules(){
        $this->form_validation->set_rules('status','Status','required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"  id="msgOk">
<strong><i class="fa fa-check"></i></strong> ', '</div>');
    }
    
    //CADASTRAR
    public function cadastrar($msg=null){
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
        $this->Rules();
        $info['msg'] = $msg;
        
        if($this->form_validation->run()==FALSE){
            $content = $this->load->view("pedido_status_compras/cadastrar",$info,TRUE);
            $this->loadPage($content);
        }
       
        else{
       
            $dados = $this->input->post();
            $dados['situacao'] = ATIVO;
            $categoriaBusiness = $this->Factory->createBusiness("conf_status");
            $cod_categoria = $categoriaBusiness->cadastrar($dados);
            $msg = true;
            redirect('pedido_status_compras/cadastrar/'.$msg);
        }
    }


    //LISTAGEM
    public function filtro(){
        try {
            $this->load->helper(array('form','url'));
            
            if ($this->input->post() == NULL) {
            
            $categoriaBusiness = $this->Factory->createBusiness("conf_status");
            $listCategoria = $categoriaBusiness->filtro(null);
            $info['listCategoria'] = $listCategoria;
            
            $content = $this->load->view("pedido_status_compras/filtro",$info,TRUE);
            $this->loadPage($content);

            }

            else{
            
            $dados = $this->input->post();
            
            $categoriaBusiness = $this->Factory->createBusiness("conf_status");
            $listCategoria = $categoriaBusiness->filtro($dados);
            $info['listCategoria'] = $listCategoria;
           	
            $content = $this->load->view("pedido_status_compras/filtro",$info,TRUE);
            $this->loadPage($content);	
            	
            }

          } catch (Exception $exc) {
            $this->loadError($ex);
        }
  }

   //EDIÇÃO
      public function editar($id_status,$msg=null){
          $this->load->helper(array('form','url'));
          $this->load->library('form_validation');
          
          $this->Rules();
          
          if($this->form_validation->run()==FALSE){
              $categoriaBusiness = $this->Factory->createBusiness("conf_status");
              $objCategoria = $categoriaBusiness->visualizar($id_status);
              $info["objCategoria"] = $objCategoria;
              $info['msg'] = $msg;
             
              $content = $this->load->view("pedido_status_compras/editar",$info,TRUE);
              $this->loadPage($content);
              
           }
           
           else{
            $dados = $this->input->post();
            $categoriaBusiness = $this->Factory->createBusiness("conf_status");
            $cod_categoria = $categoriaBusiness->editar($dados);
            $msg = true;
            redirect('pedido_status_compras/editar/'.$dados['id_status'].'/'.$msg);
           }
      }

      //EXCLUSÃO
      public function excluir($id_status){
          $this->load->helper(array('form','url'));

          $categoriaBusiness = $this->Factory->createBusiness("conf_status");
          $categoriaBusiness->excluir($id_status);
          redirect("pedido_status_compras/filtro");
      }


   //VISUALIZAÇÃO
    public function visualizar($id_status){
          try {
              $this->load->helper(array('form','url'));
              
              $categoriaBusiness = $this->Factory->createBusiness("conf_status");
              $info["objCategoria"] = $categoriaBusiness->visualizar($id_status);
              
              $content = $this->load->view("pedido_status_compras/visualizar",$info,TRUE);
              $this->loadPage($content);

          } catch (Exception $exc) {
              echo $exc->getTraceAsString();
          }

      }


       //LISTAGEM
    public function ajax_listar($pos){

      //header( 'Cache-Control: no-cache' );
      //header( 'Content-type: application/xml; charset="utf-8"', true );
      
      $this->load->helper(array('form','url'));
      $categoriaBusiness = $this->Factory->createBusiness("conf_status");
      $listCategoria = $categoriaBusiness->ajax_listar($pos);  
     
      echo json_encode($listCategoria); 
                
    }







     
      
      
}
?>
