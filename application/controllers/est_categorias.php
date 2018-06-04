<?php

/* Classe(controller): Categoria de Produtos
 * Autor: Anderson Farias
 * Última atualização: 27/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Est_categorias extends MY_Controller {
	
    //VALIDAÇÃO
    private function Rules(){
        $this->form_validation->set_rules('categoria','Categoria','required');
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
            $content = $this->load->view("est_categorias/cadastrar",$info,TRUE);
            $this->loadPage($content);
        }
       
        else{
       
            $dados = $this->input->post();
            $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
            $cod_categoria = $categoriaBusiness->cadastrar($dados);
            $msg = true;
            redirect('est_categorias/cadastrar/'.$msg);
        }
    }


    //LISTAGEM
    public function filtro(){
        try {
            $this->load->helper(array('form','url'));
            
            if ($this->input->post() == NULL) {
            
            $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
            $listCategoria = $categoriaBusiness->filtro(null);
            $info['listCategoria'] = $listCategoria;
            
            $content = $this->load->view("est_categorias/filtro",$info,TRUE);
            $this->loadPage($content);

            }

            else{
            
            $dados = $this->input->post();
            
            $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
            $listCategoria = $categoriaBusiness->filtro($dados);
            $info['listCategoria'] = $listCategoria;
           	
            $content = $this->load->view("est_categorias/filtro",$info,TRUE);
            $this->loadPage($content);	
            	
            }

          } catch (Exception $exc) {
            $this->loadError($ex);
        }
  }

   //EDIÇÃO
      public function editar($id_categoria,$msg=null){
          $this->load->helper(array('form','url'));
          $this->load->library('form_validation');
          
          $this->Rules();
          
          if($this->form_validation->run()==FALSE){
              $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
              $objCategoria = $categoriaBusiness->visualizar($id_categoria);
              $info["objCategoria"] = $objCategoria;
              $info['msg'] = $msg;
             
              $content = $this->load->view("est_categorias/editar",$info,TRUE);
              $this->loadPage($content);
              
           }
           
           else{
            $dados = $this->input->post();
            $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
            $cod_categoria = $categoriaBusiness->editar($dados);
            $msg = true;
            redirect('est_categorias/editar/'.$dados['id_categoria'].'/'.$msg);
           }
      }

      //EXCLUSÃO
      public function excluir($id_categoria){
          $this->load->helper(array('form','url'));

          $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
          $categoriaBusiness->excluir($id_categoria);
          redirect("est_categorias/filtro");
      }


   //VISUALIZAÇÃO
    public function visualizar($id_categoria){
          try {
              $this->load->helper(array('form','url'));
              
              $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
              $info["objCategoria"] = $categoriaBusiness->visualizar($id_categoria);
              
              $content = $this->load->view("est_categorias/visualizar",$info,TRUE);
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
      $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
      $listCategoria = $categoriaBusiness->ajax_listar($pos);  
     
      echo json_encode($listCategoria); 
                
    }







     
      
      
}
?>
