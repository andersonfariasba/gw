<?php

/* Classe(controller): Categoria de Produtos
 * Autor: Anderson Farias
 * Última atualização: 27/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Caixa_abertura extends MY_Controller {
	
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
            
            $content = $this->load->view("caixa_abertura/cadastrar",$info,TRUE);
            $this->loadPage($content);
        
        }
       
        else{
       
            $dados = $this->input->post();
            $objDateFormat = $this->DateFormat;
            $dados['data'] = $objDateFormat->date_mysql($dados['data']);
            //$dados['hora'] = date('H:i:s');
            $dados['data_operacao'] = date('Y-m-d');
            $dados['usuario'] = $this->session->userdata('login');
            $categoriaBusiness = $this->Factory->createBusiness("fin_caixa_abertura");
            $id_abertura = $categoriaBusiness->cadastrar($dados);
            $msg = true;
            redirect('caixa_abertura/cadastrar/'.$msg);
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
            
            $categoriaBusiness = $this->Factory->createBusiness("fin_caixa_abertura");
            $listCategoria = $categoriaBusiness->filtro(null);
            $info['listCaixa'] = $listCategoria;
            
            $content = $this->load->view("caixa_abertura/filtro",$info,TRUE);
            $this->loadPage($content);

            }

            else{
            
            $dados = $this->input->post();
            
             $userBusiness = $this->Factory->createBusiness("acesso_usuarios");
             $listUser = $userBusiness->filtro(null);
             $info['listUser'] = $listUser;

            $categoriaBusiness = $this->Factory->createBusiness("fin_caixa_abertura");
            $listCategoria = $categoriaBusiness->filtro($dados);
            $info['listCaixa'] = $listCategoria;
           	
            $content = $this->load->view("caixa_abertura/filtro",$info,TRUE);
            $this->loadPage($content);	
            	
            }

          } catch (Exception $exc) {
            $this->loadError($ex);
        }
  }

   //EDIÇÃO
      public function editar($id_abertura,$msg=null){
          $this->load->helper(array('form','url'));
          $this->load->library('form_validation');
          
          $this->Rules();
          
          if($this->form_validation->run()==FALSE){
             
              $categoriaBusiness = $this->Factory->createBusiness("fin_caixa_abertura");
              $objCategoria = $categoriaBusiness->visualizar($id_abertura);
              $info["objCaixa"] = $objCategoria;
              $info['msg'] = $msg;
             
              $content = $this->load->view("caixa_abertura/editar",$info,TRUE);
              $this->loadPage($content);
              
           }
           
           else{
            
            $dados = $this->input->post();
            $objDateFormat = $this->DateFormat;
            
            $dados['data'] = $objDateFormat->date_mysql($dados['data']);
            //$dados['hora'] = date('H:i:s');
            $dados['data_operacao'] = date('Y-m-d');
            //$dados['usuario'] = $this->session->userdata('login');

            $categoriaBusiness = $this->Factory->createBusiness("fin_caixa_abertura");
            $cod_categoria = $categoriaBusiness->editar($dados);
            $msg = true;
            redirect('caixa_abertura/editar/'.$dados['id_abertura'].'/'.$msg);
           }
      }

      //EXCLUSÃO
      public function excluir($id_abertura){
          $this->load->helper(array('form','url'));

          $categoriaBusiness = $this->Factory->createBusiness("fin_caixa_abertura");
          $categoriaBusiness->excluir($id_abertura);
          redirect("caixa_abertura/filtro");
      }


   



     
      
      
}
?>
