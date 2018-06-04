<?php
/* Classe(controller): Departamentos colaboradores
 * Autor: Anderson Farias
 * Última atualização: 03/01/2016
 * Contato: andersonjfarias@yahoo.com.br
 */

class Rh_departamentos extends MY_Controller {
	
    //VALIDA��O
    private function Rules(){
        $this->form_validation->set_rules('departamento','Departamento','required');
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
        	
          $content = $this->load->view("rh_departamentos/cadastrar",$info,TRUE);
          $this->loadPage($content);
        }
        else{
        	
            $dados = $this->input->post();
            $dados['status'] = ATIVO;
            
            $depBusiness = $this->Factory->createBusiness("rh_departamentos");
            $cod_dep = $depBusiness->cadastrar($dados);
            
            $msg = true;
            redirect('rh_departamentos/cadastrar/'.$msg);
        }

    }


    //LISTAGEM
    public function filtro(){
        try {
            $this->load->helper(array('form','url'));
            
            if ($this->input->post() == NULL) {
            
            $depBusiness = $this->Factory->createBusiness("rh_departamentos");
            $listDep = $depBusiness->filtro(null);
            $info['listDep'] = $listDep;
            
            $content = $this->load->view("rh_departamentos/filtro",$info,TRUE);
            $this->loadPage($content);

            }else{
            
            $dados = $this->input->post();
            
            $depBusiness = $this->Factory->createBusiness("rh_departamentos");
            $listDep = $depBusiness->filtro($dados);
            $info['listDep'] = $listDep;
           	
            $content = $this->load->view("rh_departamentos/filtro",$info,TRUE);
            $this->loadPage($content);	
            	
            }
                       
        } catch (Exception $exc) {
            $this->loadError($ex);
        }
    }
    
    //VISUALIZAÇÃO
    public function visualizar($id_departamento){
          try {
              $this->load->helper(array('form','url'));
              
              $depBusiness = $this->Factory->createBusiness("rh_departamentos");
              $info["objDep"] = $depBusiness->visualizar($id_departamento);
              
              $content = $this->load->view("rh_departamentos/visualizar",$info,TRUE);
              $this->loadPage($content);

          } catch (Exception $exc) {
              echo $exc->getTraceAsString();
          }

      }

      //EDIÇÃO
      public function editar($id_departamento,$msg=null){
          $this->load->helper(array('form','url'));
          $this->load->library('form_validation');
          
          $this->Rules();
          
          if($this->form_validation->run()==FALSE){
              
              $depBusiness = $this->Factory->createBusiness("rh_departamentos");
              $objDep = $depBusiness->visualizar($id_departamento);
              $info["objDep"] = $objDep;
              $info['msg'] = $msg;
             
              $content = $this->load->view("rh_departamentos/editar",$info,TRUE);
              $this->loadPage($content);
              
           }
           
           else{
           	
            $dados = $this->input->post();
           	$depBusiness = $this->Factory->createBusiness("rh_departamentos");
           	$cod_dep = $depBusiness->editar($dados);
            $msg = true;
           	redirect('rh_departamentos/editar/'.$dados['id_departamento'].'/'.$msg);
           }


      }

      

      //EXCLUSÃO
      public function excluir($id_departamento){
          $this->load->helper(array('form','url'));

          $depBusiness = $this->Factory->createBusiness("rh_departamentos");
          $depBusiness->excluir($id_departamento);
          redirect("rh_departamentos/filtro");
      }
      
      
}
?>
