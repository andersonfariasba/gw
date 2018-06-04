<?php
/* Classe(controller): Cargos colaboradores
 * Autor: Anderson Farias
 * Última atualização: 23/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Mesas extends MY_Controller {
	
    //VALIDA��O
    private function Rules(){
        $this->form_validation->set_rules('nome','Nome da Mesa','required');
        $this->form_validation->set_error_delimiters('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');
    }
    
    //CADASTRA
    public function cadastrar($msg=null){
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
        $this->Rules();
        $info['msg'] = $msg;
        
        if($this->form_validation->run()==FALSE){
        	
          $content = $this->load->view("mesas/cadastrar",$info,TRUE);
          $this->loadPage($content);
        }
        else{
        	
            $dados = $this->input->post();
            $dados['status'] = ATIVO;
            $mesaBusiness = $this->Factory->createBusiness("com_mesas");
            $cod_mesa = $mesaBusiness->cadastrar($dados);
            $msg = true;
            redirect('mesas/cadastrar/'.$msg);
        }

    }


    //LISTAGEM
    public function filtro(){
        try {
            $this->load->helper(array('form','url'));
            
            if ($this->input->post() == NULL) {
            
            $mesaBusiness = $this->Factory->createBusiness("com_mesas");
            $listMesa = $mesaBusiness->filtro(null);
            $info['listMesa'] = $listMesa;
            
            $content = $this->load->view("mesas/filtro",$info,TRUE);
            $this->loadPage($content);

            }else{
            
            $dados = $this->input->post();
            
            $mesaBusiness = $this->Factory->createBusiness("com_mesas");
            $listMesa = $mesaBusiness->filtro($dados);
            $info['listMesa'] = $listMesa;
           	
            $content = $this->load->view("mesas/filtro",$info,TRUE);
            $this->loadPage($content);	
            	
            }
            
            

        } catch (Exception $exc) {
            $this->loadError($ex);
        }
    }
    
    //VISUALIZAÇÃO
    public function visualizar($id_mesa){
          try {
              $this->load->helper(array('form','url'));
              
              $mesaBusiness = $this->Factory->createBusiness("com_mesas");
              $info["objMesa"] = $mesaBusiness->visualizar($id_mesa);
              
              $content = $this->load->view("mesas/visualizar",$info,TRUE);
              $this->loadPage($content);

          } catch (Exception $exc) {
              echo $exc->getTraceAsString();
          }

      }

      //EDIÇÃO
      public function editar($id_mesa,$msg=null){
          $this->load->helper(array('form','url'));
          $this->load->library('form_validation');
          
          $this->Rules();
          
          if($this->form_validation->run()==FALSE){
              $mesaBusiness = $this->Factory->createBusiness("com_mesas");
              $objMesa = $mesaBusiness->visualizar($id_mesa);
              $info["objMesa"] = $objMesa;
              $info['msg'] = $msg;
             
              $content = $this->load->view("mesas/editar",$info,TRUE);
              $this->loadPage($content);
              
           }
           
           else{
           	$dados = $this->input->post();
           	$mesaBusiness = $this->Factory->createBusiness("com_mesas");
           	$cod_mesa = $mesaBusiness->editar($dados);
            $msg = true;
           	redirect('mesas/editar/'.$dados['id_mesa'].'/'.$msg);
           }
      }

      //EXCLUSÃO
      public function excluir($id_mesa){
          $this->load->helper(array('form','url'));

          $mesaBusiness = $this->Factory->createBusiness("com_mesas");
          $mesaBusiness->excluir($id_mesa);
          redirect("mesas/filtro");
      }
      
      
}
?>
