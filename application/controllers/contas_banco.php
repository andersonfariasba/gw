<?php
/* Classe(controller): Cargos colaboradores
 * Autor: Anderson Farias
 * Última atualização: 23/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Contas_banco extends MY_Controller {
	
    //VALIDA��O
    private function Rules(){
        $this->form_validation->set_rules('id_filial','Filial','required');
        $this->form_validation->set_rules('banco','Banco','required');
        $this->form_validation->set_error_delimiters('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');
    }
    
    //CADASTRA
    public function cadastrar($msg=null){
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
        $this->Rules();
        $info['msg'] = $msg;
        
        if($this->form_validation->run()==FALSE){

        $filiaisBusiness = $this->Factory->createBusiness("fin_filiais");
        $listFilial = $filiaisBusiness->filtro();
        $info['listFilial'] = $listFilial;
        	
          $content = $this->load->view("contas_banco/cadastrar",$info,TRUE);
          $this->loadPage($content);
        }
        else{
        	
            $dados = $this->input->post();
            $dados['status'] = ATIVO;
            
            $contaBusiness = $this->Factory->createBusiness("fin_contas_banco");
            $cod_conta = $contaBusiness->cadastrar($dados);
            $msg = true;
            redirect('contas_banco/cadastrar/'.$msg);
        }

    }


    //LISTAGEM
    public function filtro(){
        try {
            $this->load->helper(array('form','url'));
            
            if ($this->input->post() == NULL) {
            
            $contaBusiness = $this->Factory->createBusiness("fin_contas_banco");
            $listConta = $contaBusiness->filtro(null);
            $info['listConta'] = $listConta;

            $filiaisBusiness = $this->Factory->createBusiness("fin_filiais");
            $listFilial = $filiaisBusiness->listar();
            $info['listFilial'] = $listFilial;


            
            $content = $this->load->view("contas_banco/filtro",$info,TRUE);
            $this->loadPage($content);

            }else{
            
            $dados = $this->input->post();
            
             $contaBusiness = $this->Factory->createBusiness("fin_contas_banco");
            $listConta = $contaBusiness->filtro($dados);
            $info['listConta'] = $listConta;

            $filiaisBusiness = $this->Factory->createBusiness("fin_filiais");
            $listFilial = $filiaisBusiness->listar();
            $info['listFilial'] = $listFilial;
           	
            $content = $this->load->view("contas_banco/filtro",$info,TRUE);
            $this->loadPage($content);	
            	
            }
            
            

        } catch (Exception $exc) {
            $this->loadError($ex);
        }
    }
    
    //VISUALIZAÇÃO
    public function visualizar($id_conta){
          try {
              $this->load->helper(array('form','url'));
              
              $contaBusiness = $this->Factory->createBusiness("fin_contas_banco");
              $info["objConta"] = $contaBusiness->visualizar($id_conta);

              $filiaisBusiness = $this->Factory->createBusiness("fin_filiais");
              $listFilial = $filiaisBusiness->listar();
              $info['listFilial'] = $listFilial;
              
              $content = $this->load->view("contas_banco/visualizar",$info,TRUE);
              $this->loadPage($content);

          } catch (Exception $exc) {
              echo $exc->getTraceAsString();
          }

      }

      //EDIÇÃO
      public function editar($id_conta,$msg=null){
          $this->load->helper(array('form','url'));
          $this->load->library('form_validation');
          
          $this->Rules();
          
          if($this->form_validation->run()==FALSE){
              $contaBusiness = $this->Factory->createBusiness("fin_contas_banco");
              $objConta = $contaBusiness->visualizar($id_conta);
              $info["objConta"] = $objConta;

              $filiaisBusiness = $this->Factory->createBusiness("fin_filiais");
              $listFilial = $filiaisBusiness->listar();
              $info['listFilial'] = $listFilial;
              
              $info['msg'] = $msg;
             
              $content = $this->load->view("contas_banco/editar",$info,TRUE);
              $this->loadPage($content);
              
           }
           
           else{
           	$dados = $this->input->post();
           	$contaBusiness = $this->Factory->createBusiness("fin_contas_banco");
           	$cod_conta = $contaBusiness->editar($dados);
            $msg = true;
           	redirect('contas_banco/editar/'.$dados['id_conta_banco'].'/'.$msg);
           }
      }

      //EXCLUSÃO
      public function excluir($id_conta){
          $this->load->helper(array('form','url'));

          $contaBusiness = $this->Factory->createBusiness("fin_contas_banco");
          $contaBusiness->excluir($id_conta);
          redirect("contas_banco/filtro");
      }
      
      
}
?>
