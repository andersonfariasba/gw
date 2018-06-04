<?php
/* Classe(controller): Unidade de Medida
 * Autor: Anderson Farias
 * Última atualização: 27/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Est_un_medida extends MY_Controller {
	
    //VALIDA��O
    private function Rules(){
        $this->form_validation->set_rules('unidade','Unidade de Medida','required');
        $this->form_validation->set_rules('sigla','Sigla','required');
        
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
        	$content = $this->load->view("est_un_medida/cadastrar",$info,TRUE);
            $this->loadPage($content);
        }
        else{
            $dados = $this->input->post();
            
            $unidadeBusiness = $this->Factory->createBusiness("est_un_medida");
            $cod_unidade = $unidadeBusiness->cadastrar($dados);

            $msg = true;
            redirect('est_un_medida/cadastrar/'.$msg);
        }

    }


    //LISTAGEM
    public function filtro(){
        try {
            $this->load->helper(array('form','url'));
            
            if ($this->input->post() == NULL) {
            
            $unidadeBusiness = $this->Factory->createBusiness("est_un_medida");
            $listUnidade = $unidadeBusiness->filtro(null);
            $info['listUnidade'] = $listUnidade;
            
            $content = $this->load->view("est_un_medida/filtro",$info,TRUE);
            $this->loadPage($content);

            }else{
            
            $dados = $this->input->post();
            
            $unidadeBusiness = $this->Factory->createBusiness("est_un_medida");
            $listUnidade = $unidadeBusiness->filtro($dados);
            $info['listUnidade'] = $listUnidade;
           	
            $content = $this->load->view("est_un_medida/filtro",$info,TRUE);
            $this->loadPage($content);	
            	
            }
            
            

        } catch (Exception $exc) {
            $this->loadError($ex);
        }
    }
    
    //VISUALIZAÇÃO
    public function visualizar($id_unidade){
          try {
              $this->load->helper(array('form','url'));
              
              $unidadeBusiness = $this->Factory->createBusiness("est_un_medida");
              $info["objUnidade"] = $unidadeBusiness->visualizar($id_unidade);
              
              $content = $this->load->view("est_un_medida/visualizar",$info,TRUE);
              $this->loadPage($content);

          } catch (Exception $exc) {
              echo $exc->getTraceAsString();
          }

      }

      //EDIÇÃO
      public function editar($id_unidade,$msg=null){
          $this->load->helper(array('form','url'));
          $this->load->library('form_validation');
          
          $this->Rules();
          
          if($this->form_validation->run()==FALSE){
              $unidadeBusiness = $this->Factory->createBusiness("est_un_medida");
              $objUnidade = $unidadeBusiness->visualizar($id_unidade);
              $info["objUnidade"] = $objUnidade;
              $info['msg'] = $msg;
             
              $content = $this->load->view("est_un_medida/editar",$info,TRUE);
              $this->loadPage($content);
              
           }
           
           else{
           	$dados = $this->input->post();
           	$unidadeBusiness = $this->Factory->createBusiness("est_un_medida");
           	$cod_unidade = $unidadeBusiness->editar($dados);
            $msg = true;
           	redirect('est_un_medida/editar/'.$dados['id_unidade'].'/'.$msg);
           }
      }

      //EXCLUSÃO
      public function excluir($id_unidade){
          $this->load->helper(array('form','url'));

          $unidadeBusiness = $this->Factory->createBusiness("est_un_medida");
          $unidadeBusiness->excluir($id_unidade);
          redirect("est_un_medida/filtro");
      }


        //LISTAGEM
    public function ajax_listar($pos){

      //header( 'Cache-Control: no-cache' );
      //header( 'Content-type: application/xml; charset="utf-8"', true );
      
      $this->load->helper(array('form','url'));
      $unidadeBusiness = $this->Factory->createBusiness("est_un_medida");
      $listUnidade = $unidadeBusiness->ajax_listar($pos);  
     
      echo json_encode($listUnidade); 
                
    }


      
      
}
?>
