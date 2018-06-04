<?php
/* Classe(controller): Cargos colaboradores
 * Autor: Anderson Farias
 * Última atualização: 23/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Rh_cargos extends MY_Controller {
	
    //VALIDA��O
    private function Rules(){
        $this->form_validation->set_rules('cargo','Cargo','required');
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
        	
          $content = $this->load->view("rh_cargos/cadastrar",$info,TRUE);
          $this->loadPage($content);
        }
        else{
        	
            $dados = $this->input->post();
            $dados['status'] = ATIVO;
            $cargoBusiness = $this->Factory->createBusiness("rh_cargos");
            $cod_cargo = $cargoBusiness->cadastrar($dados);
            $msg = true;
            redirect('rh_cargos/cadastrar/'.$msg);
        }

    }


    //LISTAGEM
    public function filtro(){
        try {
            $this->load->helper(array('form','url'));
            
            if ($this->input->post() == NULL) {
            
            $cargoBusiness = $this->Factory->createBusiness("rh_cargos");
            $listCargo = $cargoBusiness->filtro(null);
            $info['listCargo'] = $listCargo;
            
            $content = $this->load->view("rh_cargos/filtro",$info,TRUE);
            $this->loadPage($content);

            }else{
            
            $dados = $this->input->post();
            
            $cargoBusiness = $this->Factory->createBusiness("rh_cargos");
            $listCargo = $cargoBusiness->filtro($dados);
            $info['listCargo'] = $listCargo;
           	
            $content = $this->load->view("rh_cargos/filtro",$info,TRUE);
            $this->loadPage($content);	
            	
            }
            
            

        } catch (Exception $exc) {
            $this->loadError($ex);
        }
    }
    
    //VISUALIZAÇÃO
    public function visualizar($id_cargo){
          try {
              $this->load->helper(array('form','url'));
              
              $cargoBusiness = $this->Factory->createBusiness("rh_cargos");
              $info["objCargo"] = $cargoBusiness->visualizar($id_cargo);
              
              $content = $this->load->view("rh_cargos/visualizar",$info,TRUE);
              $this->loadPage($content);

          } catch (Exception $exc) {
              echo $exc->getTraceAsString();
          }

      }

      //EDIÇÃO
      public function editar($id_cargo,$msg=null){
          $this->load->helper(array('form','url'));
          $this->load->library('form_validation');
          
          $this->Rules();
          
          if($this->form_validation->run()==FALSE){
              $cargoBusiness = $this->Factory->createBusiness("rh_cargos");
              $objCargo = $cargoBusiness->visualizar($id_cargo);
              $info["objCargo"] = $objCargo;
              $info['msg'] = $msg;
             
              $content = $this->load->view("rh_cargos/editar",$info,TRUE);
              $this->loadPage($content);
              
           }
           
           else{
           	$dados = $this->input->post();
           	$cargoBusiness = $this->Factory->createBusiness("rh_cargos");
           	$cod_cargo = $cargoBusiness->editar($dados);
            $msg = true;
           	redirect('rh_cargos/editar/'.$dados['id_cargo'].'/'.$msg);
           }
      }

      //EXCLUSÃO
      public function excluir($id_cargo){
          $this->load->helper(array('form','url'));

          $cargoBusiness = $this->Factory->createBusiness("rh_cargos");
          $cargoBusiness->excluir($id_cargo);
          redirect("rh_cargos/filtro");
      }
      
      
}
?>
