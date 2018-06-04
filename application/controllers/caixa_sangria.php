<?php

/* Classe(controller): Categoria de Produtos
 * Autor: Anderson Farias
 * Última atualização: 27/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Caixa_sangria extends MY_Controller {
	
    //VALIDAÇÃO
    private function Rules(){
        $this->form_validation->set_rules('data','Data','required');
         $this->form_validation->set_rules('hora','Hora','required');
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
            
            $content = $this->load->view("caixa_sangria/cadastrar",$info,TRUE);
            $this->loadPage($content);
        
        }
       
        else{
       
            $dados = $this->input->post();
            $objDateFormat = $this->DateFormat;
            $dados['data'] = $objDateFormat->date_mysql($dados['data']);
            //$dados['hora'] = date('H:i:s');
            $dados['data_operacao'] = date('Y-m-d');
            $dados['usuario'] = $this->session->userdata('login');
            $categoriaBusiness = $this->Factory->createBusiness("fin_caixa_sangria");
            $id_abertura = $categoriaBusiness->cadastrar($dados);
            $msg = true;
            redirect('caixa_sangria/cadastrar/'.$msg);
        }
    }


    //LISTAGEM
    public function filtro(){
        try {
            $this->load->helper(array('form','url'));
            
            if ($this->input->post() == NULL) {

              $userBusiness = $this->Factory->createBusiness("acesso_usuarios");
             $listUser = $userBusiness->filtro(null);
             $info['listUser'] = $listUser;
            
            $categoriaBusiness = $this->Factory->createBusiness("fin_caixa_sangria");
            $listCategoria = $categoriaBusiness->filtro(null);
            $info['listCaixa'] = $listCategoria;
            
            $content = $this->load->view("caixa_sangria/filtro",$info,TRUE);
            $this->loadPage($content);

            }

            else{
            
            $dados = $this->input->post();
            
             $userBusiness = $this->Factory->createBusiness("acesso_usuarios");
             $listUser = $userBusiness->filtro(null);
             $info['listUser'] = $listUser;

            $categoriaBusiness = $this->Factory->createBusiness("fin_caixa_sangria");
            $listCategoria = $categoriaBusiness->filtro($dados);
            $info['listCaixa'] = $listCategoria;
           	
            $content = $this->load->view("caixa_sangria/filtro",$info,TRUE);
            $this->loadPage($content);	
            	
            }

          } catch (Exception $exc) {
            $this->loadError($ex);
        }
  }

   //EDIÇÃO
      public function editar($id_sangria,$msg=null){
          $this->load->helper(array('form','url'));
          $this->load->library('form_validation');
          
          $this->Rules();
          
          if($this->form_validation->run()==FALSE){
             
              $categoriaBusiness = $this->Factory->createBusiness("fin_caixa_sangria");
              $objCategoria = $categoriaBusiness->visualizar($id_sangria);
              $info["objCaixa"] = $objCategoria;
              $info['msg'] = $msg;
             
              $content = $this->load->view("caixa_sangria/editar",$info,TRUE);
              $this->loadPage($content);
              
           }
           
           else{
            
            $dados = $this->input->post();
            $objDateFormat = $this->DateFormat;
            
            $dados['data'] = $objDateFormat->date_mysql($dados['data']);
            //$dados['hora'] = date('H:i:s');
            $dados['data_operacao'] = date('Y-m-d');
            //$dados['usuario'] = $this->session->userdata('login');

            $categoriaBusiness = $this->Factory->createBusiness("fin_caixa_sangria");
            $cod_categoria = $categoriaBusiness->editar($dados);
            $msg = true;
            redirect('caixa_sangria/editar/'.$dados['id_sangria'].'/'.$msg);
           }
      }

      //EXCLUSÃO
      public function excluir($id_sangria){
          $this->load->helper(array('form','url'));

          $categoriaBusiness = $this->Factory->createBusiness("fin_caixa_sangria");
          $categoriaBusiness->excluir($id_sangria);
          redirect("caixa_sangria/filtro");
      }


   



     
      
      
}
?>
