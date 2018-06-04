<?php
/* Classe(controller): Centro de custos
 * Autor: Anderson Farias
 * Última atualização: 03/07/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Plano_contas extends MY_Controller {
	
    //VALIDAÇÃO
    private function Rules(){
        $this->form_validation->set_rules('id_plano_categoria','Grupo','required');
        $this->form_validation->set_rules('nome','Nome do Plano','required');
        $this->form_validation->set_rules('classificacao','Classificação','required');

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
                
            
            $categoriasBusiness = $this->Factory->createBusiness("fin_plano_contas_cat");
            $listCategoria = $categoriasBusiness->filtro();
            $info["listCategoria"] = $listCategoria;
           
            $content = $this->load->view("plano_contas/cadastrar",$info,TRUE);
            $this->loadPage($content);
        }
        
        else{
           
           $dados = $this->input->post();
           $dados['status'] = ATIVO;
            
           $planoBusiness = $this->Factory->createBusiness("fin_plano_contas");
           $id_plano = $planoBusiness->cadastrar($dados);
           $msg = true;
           redirect('plano_contas/cadastrar/'.$msg);
        }

    }


    //LISTAGEM
    public function filtro(){
        try {
            $this->load->helper(array('form','url'));
            
            if ($this->input->post() == NULL) {
            
            $planoBusiness = $this->Factory->createBusiness("fin_plano_contas");
            $listPlanos = $planoBusiness->filtro(null);
            $info['listPlanos'] = $listPlanos;
            
            $content = $this->load->view("plano_contas/filtro",$info,TRUE);
            $this->loadPage($content);

            }else{
            
            $dados = $this->input->post();
            
             $planoBusiness = $this->Factory->createBusiness("fin_plano_contas");
            $listPlanos = $planoBusiness->filtro($dados);
            $info['listPlanos'] = $listPlanos;
           	
            $content = $this->load->view("plano_contas/filtro",$info,TRUE);
            $this->loadPage($content);	
            	
            }
            
          } catch (Exception $exc) {
            $this->loadError($ex);
        }
    }
    
  
      //EDIÇÃO
      public function editar($id_plano,$msg=null){
          $this->load->helper(array('form','url'));
          $this->load->library('form_validation');
          
          $this->Rules();
          
          if($this->form_validation->run()==FALSE){
              
              $planoBusiness = $this->Factory->createBusiness("fin_plano_contas");
              $objPlano = $planoBusiness->visualizar($id_plano);
              $info["objPlano"] = $objPlano;
              $info['msg'] = $msg;
             
              $content = $this->load->view("plano_contas/editar",$info,TRUE);
              $this->loadPage($content);
              
           }
            else{
           	$dados = $this->input->post();
           	$planoBusiness = $this->Factory->createBusiness("fin_plano_contas");
           	$cod_plano = $planoBusiness->editar($dados);
            $msg = true;
           	redirect('plano_contas/editar/'.$dados['id_plano'].'/'.$msg);
           }
      }

      //EXCLUSÃO
      public function excluir($id_plano){
          $this->load->helper(array('form','url'));

          $planoBusiness = $this->Factory->createBusiness("fin_plano_contas");
          $planoBusiness->excluir($id_plano);
          redirect("plano_contas/filtro");
      }


         //LISTAGEM
    public function ajax_listar_tipo($tipo_conta){

      //header( 'Cache-Control: no-cache' );
      //header( 'Content-type: application/xml; charset="utf-8"', true );
      
      $this->load->helper(array('form','url'));
      $categoriaBusiness = $this->Factory->createBusiness("fin_plano_contas_cat");
      $listCategoria = $categoriaBusiness->ajax_listar_tipo($tipo_conta);  
     
      echo json_encode($listCategoria); 
                
    }

    public function ajax_visualizar_grupo($id_plano_categoria){

      //header( 'Cache-Control: no-cache' );
      //header( 'Content-type: application/xml; charset="utf-8"', true );
      
      $this->load->helper(array('form','url'));
      $categoriaBusiness = $this->Factory->createBusiness("fin_plano_contas_cat");
      $listCategoria = $categoriaBusiness->ajax_visualizar_grupo($id_plano_categoria);  
     
      echo json_encode($listCategoria); 
                
    }
      
      
}
?>
