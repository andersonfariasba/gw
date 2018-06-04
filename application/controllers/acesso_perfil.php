<?php
/* Classe(controller): Perfil de usuários
 * Autor: Anderson Farias
 * Última atualização: 23/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Acesso_perfil extends MY_Controller {
	
    //VALIDA��O
    private function Rules(){
        $this->form_validation->set_rules('perfil','Perfil','required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"  id="msgOk">
<strong><i class="fa fa-check"></i></strong> ', '</div>');
    
    }
    
    //CADASTRA
    public function cadastrar($msg=null){
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
        $this->Rules();
        $info['msg'] = $msg;
        
        if($this->form_validation->run()==FALSE){
        	$content = $this->load->view("acesso_perfil/cadastrar",$info,TRUE);
            $this->loadPage($content);
        }
        else{
        	$dados = $this->input->post();
          $dados['status'] = ATIVO;
        	
        	
        	$perfilBusiness = $this->Factory->createBusiness("acesso_perfil");
          $cod_perfil = $perfilBusiness->cadastrar($dados);
          $msg = true;
          redirect('acesso_perfil/cadastrar/'.$msg);

        }

    }


    //LISTAGEM
    public function filtro(){
        try {
            $this->load->helper(array('form','url'));
            
            if ($this->input->post() == NULL) {
            
            $perfilBusiness = $this->Factory->createBusiness("acesso_perfil");
            $listPerfil = $perfilBusiness->filtro(null);
            $info['listPerfil'] = $listPerfil;
            
            $content = $this->load->view("acesso_perfil/filtro",$info,TRUE);
            $this->loadPage($content);

            }else{
            
            $dados = $this->input->post();
            
            $perfilBusiness = $this->Factory->createBusiness("acesso_perfil");
            $listPerfil = $perfilBusiness->filtro($dados);
            $info['listPerfil'] = $listPerfil;
           	
            $content = $this->load->view("acesso_perfil/filtro",$info,TRUE);
            $this->loadPage($content);	
            	
            }
            
            

        } catch (Exception $exc) {
            $this->loadError($ex);
        }
    }
    
    //VISUALIZAÇÃO
    public function visualizar($id_perfil){
          try {
              $this->load->helper(array('form','url'));
              
              $perfilBusiness = $this->Factory->createBusiness("acesso_perfil");
              $info["objPerfil"] = $perfilBusiness->visualizar($id_perfil);
              
              $content = $this->load->view("acesso_perfil/visualizar",$info,TRUE);
              $this->loadPage($content);

          } catch (Exception $exc) {
              echo $exc->getTraceAsString();
          }

      }

      //EDIÇÃO
      public function editar($id_perfil,$msg=null){
          $this->load->helper(array('form','url'));
          $this->load->library('form_validation');
          
          $this->Rules();
          
          if($this->form_validation->run()==FALSE){
              $perfilBusiness = $this->Factory->createBusiness("acesso_perfil");
              $objPerfil = $perfilBusiness->visualizar($id_perfil);
              $info["objPerfil"] = $objPerfil;
              $info['msg'] = $msg;
             
              $content = $this->load->view("acesso_perfil/editar",$info,TRUE);
              $this->loadPage($content);
              
           }
           
           else{
           	$dados = $this->input->post();
           	$perfilBusiness = $this->Factory->createBusiness("acesso_perfil");
           	$cod_perfil = $perfilBusiness->editar($dados);
            $msg = true;
           	redirect('acesso_perfil/editar/'.$dados['id_perfil'].'/'.$msg);
           }
      }

      //EXCLUSÃO
      public function excluir($id_perfil){
          $this->load->helper(array('form','url'));

          $perfilBusiness = $this->Factory->createBusiness("acesso_perfil");
          $perfilBusiness->excluir($id_perfil);
          redirect("acesso_perfil/filtro");
      }
      
      
}
?>
