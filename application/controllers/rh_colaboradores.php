<?php
/* Classe(controller): Perfil de usu�rios
 * Autor: Anderson Farias
 * �ltima atualiza��o: 23/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Rh_colaboradores extends MY_Controller {
	
    //VALIDA��O
    private function Rules(){
         
        $this->form_validation->set_rules('nome','Nome','required');
        $this->form_validation->set_rules('id_cargo','Cargo','required');
        $this->form_validation->set_rules('email','Email','required');
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
            
            $cargoBusiness = $this->Factory->createBusiness("rh_cargos");
            $listCargo = $cargoBusiness->filtro();
            $info["listCargo"] = $listCargo;

            $depBusiness = $this->Factory->createBusiness("rh_departamentos");
            $listDep = $depBusiness->filtro(null);
            $info['listDep'] = $listDep;
           
            $content = $this->load->view("rh_colaboradores/cadastrar",$info,TRUE);
            $this->loadPage($content);
        }
        else{
        
        $dados = $this->input->post();
        
        $objDateFormat = $this->DateFormat;
        $dados['data_nascimento'] = $objDateFormat->date_mysql($dados['data_nascimento']);
        $dados['status'] = ATIVO;
        
        $colaboradorBusiness = $this->Factory->createBusiness("rh_colaboradores");
        $cod_colaborador = $colaboradorBusiness->cadastrar($dados);
        $msg = true;
        redirect('rh_colaboradores/cadastrar/'.$msg);
        }

    }


    //LISTAGEM
    public function filtro(){
        try {
            $this->load->helper(array('form','url'));
            
            if ($this->input->post() == NULL) {
            
            $cargoBusiness = $this->Factory->createBusiness("rh_cargos");
            $listCargo = $cargoBusiness->filtro();
            $info["listCargo"] = $listCargo;    
                
            $colaboradoresBusiness = $this->Factory->createBusiness("rh_colaboradores");
            $listColaborador = $colaboradoresBusiness->filtro(null);
            $info['listColaborador'] = $listColaborador;
            
            $content = $this->load->view("rh_colaboradores/filtro",$info,TRUE);
            $this->loadPage($content);

            }else{
            
            $dados = $this->input->post();
            
            $cargoBusiness = $this->Factory->createBusiness("rh_cargos");
            $listCargo = $cargoBusiness->filtro();
            $info["listCargo"] = $listCargo;    
                    
            
            $colaboradoresBusiness = $this->Factory->createBusiness("rh_colaboradores");
            $listColaborador = $colaboradoresBusiness->filtro($dados);
            $info['listColaborador'] = $listColaborador;
           	
            $content = $this->load->view("rh_colaboradores/filtro",$info,TRUE);
            $this->loadPage($content);	
            	
            }
            
            

        } catch (Exception $exc) {
            $this->loadError($ex);
        }
    }
    
    //VISUALIZAÇÃO
    public function visualizar($id_colaborador){
          try {
              $this->load->helper(array('form','url'));

              $cargoBusiness = $this->Factory->createBusiness("rh_cargos");
              $listCargo = $cargoBusiness->filtro();
              $info["listCargo"] = $listCargo;
              
              $colaboradorBusiness = $this->Factory->createBusiness("rh_colaboradores");
              $info["objColaborador"] = $colaboradorBusiness->visualizar($id_colaborador);
              
              $content = $this->load->view("rh_colaboradores/visualizar",$info,TRUE);
              $this->loadPage($content);

          } catch (Exception $exc) {
              echo $exc->getTraceAsString();
          }

      }

      //EDIÇÃO
      public function editar($id_colaborador,$msg=null){
          $this->load->helper(array('form','url'));
          $this->load->library('form_validation');
          
          $this->Rules();
          
          if($this->form_validation->run()==FALSE){
              $cargoBusiness = $this->Factory->createBusiness("rh_cargos");
              $listCargo = $cargoBusiness->filtro();
              $info["listCargo"] = $listCargo;

              $depBusiness = $this->Factory->createBusiness("rh_departamentos");
              $listDep = $depBusiness->filtro(null);
              $info['listDep'] = $listDep;
              
              $colaboradoresBusiness = $this->Factory->createBusiness("rh_colaboradores");
              $objColaborador = $colaboradoresBusiness->visualizar($id_colaborador);
              $info["objColaborador"] = $objColaborador;

              $info['msg'] = $msg;
             
              $content = $this->load->view("rh_colaboradores/editar",$info,TRUE);
              $this->loadPage($content);
              
           }
           
           else{
               
           	$dados = $this->input->post();
                
            $objDateFormat = $this->DateFormat;
            $dados['data_nascimento'] = $objDateFormat->date_mysql($dados['data_nascimento']);

            $colaboradorBusiness = $this->Factory->createBusiness("rh_colaboradores");
           	$cod_colaborador = $colaboradorBusiness->editar($dados);
            $msg = true;
           	redirect('rh_colaboradores/editar/'.$dados['id_colaborador'].'/'.$msg);
           }
      }

      //EXCLUSÃO
      public function excluir($id_colaborador){
          $this->load->helper(array('form','url'));

          $colaboradorBusiness = $this->Factory->createBusiness("rh_colaboradores");
          $colaboradorBusiness->excluir($id_colaborador);
          redirect("rh_colaboradores/filtro");
      }

       //EXCLUSÃO
      public function comissao($dados = null){
          $this->load->helper(array('form','url'));

          $colaboradorBusiness = $this->Factory->createBusiness("fin_comissao");
          $list = $colaboradorBusiness->filtro($dados);
          print_r($list);
          
      }
      
      
      
}
?>
