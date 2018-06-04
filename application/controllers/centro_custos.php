<?php
/* Classe(controller): Centro de custos
 * Autor: Anderson Farias
 * Última atualização: 03/07/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Centro_custos extends MY_Controller {
	
    //VALIDAÇÃO
    private function Rules(){
        $this->form_validation->set_rules('custo','Centro de Custo','required');
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
                
            
            $custosBusiness = $this->Factory->createBusiness("fin_centro_custos");
            $listCustos = $custosBusiness->filtro();
            $info["listCustos"] = $listCustos;
           
            $content = $this->load->view("centro_custos/cadastrar",$info,TRUE);
            $this->loadPage($content);
        }
        else{
           $dados = $this->input->post();
           $dados['status'] = ATIVO;
            
           $custosBusiness = $this->Factory->createBusiness("fin_centro_custos");
           $cod_produto = $custosBusiness->cadastrar($dados);
           $msg = true;
           redirect('centro_custos/cadastrar/'.$msg);
        }

    }


    //LISTAGEM
    public function filtro(){
        try {
            $this->load->helper(array('form','url'));
            
            if ($this->input->post() == NULL) {
            
            $custosBusiness = $this->Factory->createBusiness("fin_centro_custos");
            $listCustos = $custosBusiness->filtro(null);
            $info['listCustos'] = $listCustos;
            
            $content = $this->load->view("centro_custos/filtro",$info,TRUE);
            $this->loadPage($content);

            }else{
            
            $dados = $this->input->post();
            
            $custosBusiness = $this->Factory->createBusiness("fin_centro_custos");
            $listCustos = $custosBusiness->filtro($dados);
            $info['listCustos'] = $listCustos;
           	
            $content = $this->load->view("centro_custos/filtro",$info,TRUE);
            $this->loadPage($content);	
            	
            }
            
          } catch (Exception $exc) {
            $this->loadError($ex);
        }
    }
    
    //VISUALIZAÇÃO
    public function visualizar($id_custo){
          try {
              $this->load->helper(array('form','url'));
              
              $custoBusiness = $this->Factory->createBusiness("fin_centro_custos");
              $info["objCusto"] = $custoBusiness->visualizar($id_custo);
              
              $content = $this->load->view("centro_custos/visualizar",$info,TRUE);
              $this->loadPage($content);

          } catch (Exception $exc) {
              echo $exc->getTraceAsString();
          }

      }

      //EDIÇÃO
      public function editar($id_custo,$msg=null){
          $this->load->helper(array('form','url'));
          $this->load->library('form_validation');
          
          $this->Rules();
          
          if($this->form_validation->run()==FALSE){
              $custoBusiness = $this->Factory->createBusiness("fin_centro_custos");
              $objCusto = $custoBusiness->visualizar($id_custo);
              $info["objCusto"] = $objCusto;
              $info['msg'] = $msg;
             
              $content = $this->load->view("centro_custos/editar",$info,TRUE);
              $this->loadPage($content);
              
           }
            else{
           	$dados = $this->input->post();
           	$custoBusiness = $this->Factory->createBusiness("fin_centro_custos");
           	$cod_custo = $custoBusiness->editar($dados);
            $msg = true;
           	redirect('centro_custos/editar/'.$dados['id_custo'].'/'.$msg);
           }
      }

      //EXCLUSÃO
      public function excluir($id_custo){
          $this->load->helper(array('form','url'));

          $custoBusiness = $this->Factory->createBusiness("fin_centro_custos");
          $custoBusiness->excluir($id_custo);
          redirect("centro_custos/filtro");
      }
      
      
}
?>
