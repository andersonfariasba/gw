<?php

/* Classe(controller): Categoria de Produtos
 * Autor: Anderson Farias
 * Última atualização: 27/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Forma_entrega extends MY_Controller {
	
    //VALIDAÇÃO
    private function Rules(){
        $this->form_validation->set_rules('forma','Nome da Forma','required');
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
            $content = $this->load->view("forma_entrega/cadastrar",$info,TRUE);
            $this->loadPage($content);
        }
       
        else{
       
            $dados = $this->input->post();
            $dados['situacao'] = ATIVO;
            $categoriaBusiness = $this->Factory->createBusiness("com_forma_entrega");
            $cod_categoria = $categoriaBusiness->cadastrar($dados);
            $msg = true;
            redirect('forma_entrega/cadastrar/'.$msg);
        }
    }


    //LISTAGEM
    public function filtro(){
        try {
            $this->load->helper(array('form','url'));
            
            if ($this->input->post() == NULL) {
            
            $categoriaBusiness = $this->Factory->createBusiness("com_forma_entrega");
            $listCategoria = $categoriaBusiness->filtro(null);
            $info['listCategoria'] = $listCategoria;
            
            $content = $this->load->view("forma_entrega/filtro",$info,TRUE);
            $this->loadPage($content);

            }

            else{
            
            $dados = $this->input->post();
            
            $categoriaBusiness = $this->Factory->createBusiness("com_forma_entrega");
            $listCategoria = $categoriaBusiness->filtro($dados);
            $info['listCategoria'] = $listCategoria;
           	
            $content = $this->load->view("forma_entrega/filtro",$info,TRUE);
            $this->loadPage($content);	
            	
            }

          } catch (Exception $exc) {
            $this->loadError($ex);
        }
  }

   //EDIÇÃO
      public function editar($id_forma,$msg=null){
          $this->load->helper(array('form','url'));
          $this->load->library('form_validation');
          
          $this->Rules();
          
          if($this->form_validation->run()==FALSE){
              $categoriaBusiness = $this->Factory->createBusiness("com_forma_entrega");
              $objCategoria = $categoriaBusiness->visualizar($id_forma);
              $info["objCategoria"] = $objCategoria;
              $info['msg'] = $msg;
             
              $content = $this->load->view("forma_entrega/editar",$info,TRUE);
              $this->loadPage($content);
              
           }
           
           else{
            $dados = $this->input->post();
            $categoriaBusiness = $this->Factory->createBusiness("com_forma_entrega");
            $cod_categoria = $categoriaBusiness->editar($dados);
            $msg = true;
            redirect('forma_entrega/editar/'.$dados['id_forma'].'/'.$msg);
           }
      }

      //EXCLUSÃO
      public function excluir($id_forma){
          $this->load->helper(array('form','url'));

          $categoriaBusiness = $this->Factory->createBusiness("com_forma_entrega");
          $categoriaBusiness->excluir($id_forma);
          redirect("forma_entrega/filtro");
      }


         //LISTAGEM
    public function ajax_listar($pos){

      //header( 'Cache-Control: no-cache' );
      //header( 'Content-type: application/xml; charset="utf-8"', true );
      
      $this->load->helper(array('form','url'));
      $categoriaBusiness = $this->Factory->createBusiness("com_forma_entrega");
      $listCategoria = $categoriaBusiness->ajax_listar($pos);  
     
      echo json_encode($listCategoria); 
                
    }







     
      
      
}
?>
