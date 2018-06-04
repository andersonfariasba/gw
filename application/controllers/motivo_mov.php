<?php

/* Classe(controller): Categoria de Produtos
 * Autor: Anderson Farias
 * Última atualização: 27/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Motivo_mov extends MY_Controller {
	
    //VALIDAÇÃO
    private function Rules(){
        $this->form_validation->set_rules('descricao','descricao','required');
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
            $content = $this->load->view("motivo_mov/cadastrar",$info,TRUE);
            $this->loadPage($content);
        }
       
        else{
       
            $dados = $this->input->post();
            $categoriaBusiness = $this->Factory->createBusiness("est_motivo_mov");
            $cod_categoria = $categoriaBusiness->cadastrar($dados);
            $msg = true;
            redirect('motivo_mov/cadastrar/'.$msg);
        }
    }


    //LISTAGEM
    public function filtro(){
        try {
            $this->load->helper(array('form','url'));
            
            if ($this->input->post() == NULL) {
            
            $categoriaBusiness = $this->Factory->createBusiness("est_motivo_mov");
            $listCategoria = $categoriaBusiness->filtro(null);
            $info['list'] = $listCategoria;

           // print_r($listCategoria);
            //exit;
            
            $content = $this->load->view("motivo_mov/filtro",$info,TRUE);
            $this->loadPage($content);

            }

            else{
            
            $dados = $this->input->post();
            
            $categoriaBusiness = $this->Factory->createBusiness("est_motivo_mov");
            $listCategoria = $categoriaBusiness->filtro($dados);
            $info['list'] = $listCategoria;
           	
            $content = $this->load->view("motivo_mov/filtro",$info,TRUE);
            $this->loadPage($content);	
            	
            }

          } catch (Exception $exc) {
            $this->loadError($ex);
        }
  }

   //EDIÇÃO
      public function editar($id_motivo,$msg=null){
          $this->load->helper(array('form','url'));
          $this->load->library('form_validation');
          
          $this->Rules();
          
          if($this->form_validation->run()==FALSE){
              $categoriaBusiness = $this->Factory->createBusiness("est_motivo_mov");
              $objCategoria = $categoriaBusiness->visualizar($id_motivo);
              $info["objCategoria"] = $objCategoria;
              $info['msg'] = $msg;
             
              $content = $this->load->view("motivo_mov/editar",$info,TRUE);
              $this->loadPage($content);
              
           }
           
           else{
            $dados = $this->input->post();
            $categoriaBusiness = $this->Factory->createBusiness("est_motivo_mov");
            $cod_categoria = $categoriaBusiness->editar($dados);
            $msg = true;
            redirect('motivo_mov/editar/'.$dados['id_motivo'].'/'.$msg);
           }
      }

      //EXCLUSÃO
      public function excluir($id_motivo){
          $this->load->helper(array('form','url'));

          $categoriaBusiness = $this->Factory->createBusiness("est_motivo_mov");
          $categoriaBusiness->excluir($id_motivo);
          redirect("motivo_mov/filtro");
      }


   //VISUALIZAÇÃO
    public function visualizar($id_motivo){
          try {
              $this->load->helper(array('form','url'));
              
              $categoriaBusiness = $this->Factory->createBusiness("est_motivo_mov");
              $info["objCategoria"] = $categoriaBusiness->visualizar($id_motivo);
              
              $content = $this->load->view("motivo_mov/visualizar",$info,TRUE);
              $this->loadPage($content);

          } catch (Exception $exc) {
              echo $exc->getTraceAsString();
          }

      }


       //LISTAGEM
    public function ajax_listar($pos,$tipo=null){

      //header( 'Cache-Control: no-cache' );
      //header( 'Content-type: application/xml; charset="utf-8"', true );
      
      $this->load->helper(array('form','url'));
      $categoriaBusiness = $this->Factory->createBusiness("est_motivo_mov");
      $listCategoria = $categoriaBusiness->ajax_listar($pos,$tipo);  
     
      echo json_encode($listCategoria); 
                
    }







     
      
      
}
?>
