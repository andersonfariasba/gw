<?php
/* Classe(controller): Usuários
 * Autor: Anderson Farias
 * Última atualização: 25/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Agenda extends MY_Controller {
	
    //VALIDA��O
    private function Rules(){
        $this->form_validation->set_rules('login','Login','required');
        $this->form_validation->set_rules('senha','Senha','required');
        $this->form_validation->set_rules('id_perfil','Perfil','required');
         $this->form_validation->set_rules('id_colaborador','Colaborador','required');
        
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"  id="msgOk">
<strong><i class="fa fa-check"></i></strong> ', '</div>');
        
    }
    
    
    
    //VISUALIZAÇÃO
    public function visualizar_V1(){
          try {
              $this->load->helper(array('form','url'));
              
             $dentistaBusiness = $this->Factory->createBusiness("dentistas");
            $listDentista = $dentistaBusiness->filtro();
            $info['listDentista'] = $listDentista;
             
              $this->load->view("agenda/visualizar",$info);
              //$content = $this->load->view("agenda/visualizar",$info,TRUE);
              //$this->loadPage($content);

          } catch (Exception $exc) {
              echo $exc->getTraceAsString();
          }

      }

        //VISUALIZAÇÃO
    public function visualizar(){
          try {
              $this->load->helper(array('form','url'));
              
            $userBusiness = $this->Factory->createBusiness("acesso_usuarios");
            $listUser = $userBusiness->filtro(null);
            $info['listUser'] = $listUser;
             
              $this->load->view("agenda/visualizar",$info);
              //$content = $this->load->view("agenda/visualizar",$info,TRUE);
              //$this->loadPage($content);

          } catch (Exception $exc) {
              echo $exc->getTraceAsString();
          }

      }




       public function cadastrar(){
          try {
              $this->load->helper(array('form','url'));
              
             $dados = $this->input->post();



             //$dados['paciente'] = "ANDERSON";
             //$dados['dentista'] = "DR. ENZO";
             //$dados['start'] = date('Y-m-d');
             //$dados['end'] = date('Y-m-d');
             $dados['status'] = 0;
             $dados['deletado'] = 0;

            $dentistaBusiness = $this->Factory->createBusiness("agenda");
             $id = $dentistaBusiness->cadastrar($dados);

             redirect('agenda/visualizar/');

            
             
             
              //$this->load->view("agenda/visualizar",$info);
              //$content = $this->load->view("agenda/visualizar",$info,TRUE);
              //$this->loadPage($content);

          } catch (Exception $exc) {
              echo $exc->getTraceAsString();
          }

      }



    public function ajax_listar($id_usuario=null){

      //header( 'Cache-Control: no-cache' );
      //header( 'Content-type: application/xml; charset="utf-8"', true );
      
     

      $this->load->helper(array('form','url'));

      //$dentista = "DRA AMANDA ENDODONTIA";

        $userBusiness = $this->Factory->createBusiness("acesso_usuarios");
        $objUser = $userBusiness->visualizar($id_usuario);
        
        $user = "";
        if($objUser!=null){
          $user = $objUser->getLogin();
        }


       
      $itemBusiness = $this->Factory->createBusiness("agenda");
      $list = $itemBusiness->ajax_listar($user);  

          
      echo json_encode($list); 
      
      
   }


     public function excluir(){
          try {
              $this->load->helper(array('form','url'));
              
             $id = $this->input->post('id');



           
            $dentistaBusiness = $this->Factory->createBusiness("agenda");
            $delete = $dentistaBusiness->excluir($id);

           
          } catch (Exception $exc) {
              echo $exc->getTraceAsString();
          }

      }








      
}
?>
