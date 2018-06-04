<?php
/* Classe(controller): Formas Pagamentos
 * Autor: Anderson Farias
 * Última atualização: 03/07/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Formas_pagamentos extends MY_Controller {
	
    //VALIDAÇÃO
    private function Rules(){
        $this->form_validation->set_rules('forma','Forma Pagamento','required');
        $this->form_validation->set_error_delimiters('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');
    }
    
    //CADASTRA
    public function cadastrar($msg=null){
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
        $this->Rules();
        $info['msg'] = $msg;
        
        if($this->form_validation->run()==FALSE){
                
            
            $formasBusiness = $this->Factory->createBusiness("fin_formas_pagamentos");
            $listFormas = $formasBusiness->filtro();
            $info["listFormas"] = $listFormas;
           
            $content = $this->load->view("formas_pagamentos/cadastrar",$info,TRUE);
            $this->loadPage($content);
        }
        else{
           error_reporting(0);
           $dados = $this->input->post();
            $dados["status"] = ATIVO;
           $formasBusiness = $this->Factory->createBusiness("fin_formas_pagamentos");
           $cod_forma = $formasBusiness->cadastrar($dados);
           $msg = true;
        
           redirect('formas_pagamentos/cadastrar/'.$msg);
        }

    }


    //LISTAGEM
    public function filtro(){
        try {
            $this->load->helper(array('form','url'));
            
            if ($this->input->post() == NULL) {
            
            $dados['disponivel'] = FORMA_CONTA_PAGAR;
            $formasBusiness = $this->Factory->createBusiness("fin_formas_pagamentos");
            $listFormas = $formasBusiness->filtro($dados);
            $info['listFormas'] = $listFormas;
            
            $content = $this->load->view("formas_pagamentos/filtro",$info,TRUE);
            $this->loadPage($content);

            }else{
            
            $dados = $this->input->post();
            
            $formasBusiness = $this->Factory->createBusiness("fin_formas_pagamentos");
            $dados['disponivel'] = FORMA_CONTA_PAGAR;
            $listFormas = $formasBusiness->filtro($dados);
            $info['listFormas'] = $listFormas;
           	
            $content = $this->load->view("formas_pagamentos/filtro",$info,TRUE);
            $this->loadPage($content);	
            	
            }
            
          } catch (Exception $exc) {
            $this->loadError($ex);
        }
    }
    
    //VISUALIZAÇÃO
    public function visualizar($id_forma){
          try {
              $this->load->helper(array('form','url'));
              
              $formaBusiness = $this->Factory->createBusiness("fin_formas_pagamentos");
              $info["objForma"] = $formaBusiness->visualizar($id_forma);
              
              $content = $this->load->view("formas_pagamentos/visualizar",$info,TRUE);
              $this->loadPage($content);

          } catch (Exception $exc) {
              echo $exc->getTraceAsString();
          }

      }

      //EDIÇÃO
      public function editar($id_forma,$msg=null){
          $this->load->helper(array('form','url'));
          $this->load->library('form_validation');
          
          $this->Rules();
          
          if($this->form_validation->run()==FALSE){
              $formaBusiness = $this->Factory->createBusiness("fin_formas_pagamentos");
              $objForma = $formaBusiness->visualizar($id_forma);
              $info["objForma"] = $objForma;

              $info['msg'] = $msg;
             
              $content = $this->load->view("formas_pagamentos/editar",$info,TRUE);
              $this->loadPage($content);
              
           }
            else{
           error_reporting(0);
           	$dados = $this->input->post();
           	$formaBusiness = $this->Factory->createBusiness("fin_formas_pagamentos");
           	$cod_forma = $formaBusiness->editar($dados);
            $msg = true;
           	redirect('formas_pagamentos/editar/'.$dados['id_forma'].'/'.$msg);
           }
      }

      //EXCLUSÃO
      public function excluir($id_forma){
          $this->load->helper(array('form','url'));

          $formaBusiness = $this->Factory->createBusiness("fin_formas_pagamentos");
          $formaBusiness->excluir($id_forma);
          redirect("formas_pagamentos/filtro");
      }

       //LISTAGEM
    public function ajax_listar($disponivel){

      //header( 'Cache-Control: no-cache' );
      //header( 'Content-type: application/xml; charset="utf-8"', true );
      
      $this->load->helper(array('form','url'));
      $formaBusiness = $this->Factory->createBusiness("fin_formas_pagamentos");
      $listForma = $formaBusiness->ajax_listar($disponivel);
     
      echo json_encode($listForma); 
                
      
}


   //LISTAGEM
    public function verificar_cartao($id_forma){

      //header( 'Cache-Control: no-cache' );
      //header( 'Content-type: application/xml; charset="utf-8"', true );
      
      $this->load->helper(array('form','url'));
      $formaBusiness = $this->Factory->createBusiness("fin_formas_pagamentos");
      $listForma = $formaBusiness->verificar_cartao($id_forma);
     
      echo json_encode($listForma); 
                
      
}

      
      
}
?>
