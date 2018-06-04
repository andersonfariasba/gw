<?php
/* Classe(controller): Formas Pagamentos
 * Autor: Anderson Farias
 * Última atualização: 03/07/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Formas_recebimentos extends MY_Controller {
	
    //VALIDAÇÃO
    private function Rules(){
        $this->form_validation->set_rules('forma','Forma Recebimento','required');
       $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"  id="msgOk">
<strong><i class="fa fa-check"></i></strong> ', '</div>');    
    }


     public function validar_parcelado() {
        try {
            
            
            $forma = $this->input->post("forma");
            $tipo = $this->input->post("tipo");
            $max_parcela = $this->input->post("maximo_parcela");
            $qtd_dia_compensa = $this->input->post("qtd_dia_compensa");
            




            if( ($tipo==TIPO_REC_PARCELADO && $max_parcela<=1) && $qtd_dia_compensa<=1 ){
              $this->form_validation->set_message('validar_parcelado', 'O campo Limite de Parcela e Dias de Compensação devem ser maior que 0 (Zero)');
    
              return false;
            }

            else if( ($tipo==TIPO_REC_PARCELADO) && ($max_parcela<1) ){
              $this->form_validation->set_message('validar_parcelado', 'O campo Limite de Parcela é obrigatório para essa operação');
    
              return false;
            }

             else if( ($tipo==TIPO_REC_PARCELADO) && ($max_parcela>0 && $qtd_dia_compensa<1)){
              $this->form_validation->set_message('validar_parcelado', 'O campo Quantidade Dias Compensação é obrigatório para essa operação e precisa ser maior que zero');
    
              return false;
            }
            

            else{

              return true;

            }


            //$clientesBusiness = $this->Factory->createBusiness("com_clientes");

           /* if($cnpj_cpf!=""){
              if ($clientesBusiness->verificar_existente($cnpj_cpf)) {
                  $this->form_validation->set_message('verificar_existente', 'O documento <a href='.site_url("clientes/visualizar_por_documento/".$cnpj_cpf).'>'.$cnpj_cpf.'</a> fornecido já existe na base de dados!');
                  return false;
              }
              else {
                return true;
              } 
            }*/


            
        } catch (Excpeption $ex) {
            $this->loadError($ex);
        }
    }



    
    //CADASTRA
    public function cadastrar($msg=null){
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
        $this->Rules();
        $this->form_validation->set_rules('tipo', 'FORMA', 'callback_validar_parcelado');
        
        $info['msg'] = $msg;
        
        if($this->form_validation->run()==FALSE){
                
            
            $formasBusiness = $this->Factory->createBusiness("fin_formas_recebimentos");
            $listFormas = $formasBusiness->filtro();
            $info["listFormas"] = $listFormas;

            $tabBusiness = $this->Factory->createBusiness("fin_tabela_nome");
            $listTab = $tabBusiness->filtro(null);
            $info['listTab'] = $listTab;
           
            $content = $this->load->view("formas_recebimentos/cadastrar",$info,TRUE);
            $this->loadPage($content);
        }
        else{
           
           error_reporting(0);
           $dados = $this->input->post();
           $dados["status"] = ATIVO;
           
           if($dados['maximo_parcela']==null || $dados['maximo_parcela']==""){
             $dados['maximo_parcela'] = 1;
           }

            

           $formasBusiness = $this->Factory->createBusiness("fin_formas_recebimentos");
           $cod_forma = $formasBusiness->cadastrar($dados);
           
           $msg = true;
        
           redirect('formas_recebimentos/cadastrar/'.$msg);
        }

    }


    //LISTAGEM
    public function filtro(){
        try {
            $this->load->helper(array('form','url'));
            
            if ($this->input->post() == NULL) {

                      
            $formasBusiness = $this->Factory->createBusiness("fin_formas_recebimentos");
            $dados = null;
            $listFormas = $formasBusiness->filtro($dados);
            $info['listFormas'] = $listFormas;
            
            $content = $this->load->view("formas_recebimentos/filtro",$info,TRUE);
            $this->loadPage($content);

            }else{
            
            $dados = $this->input->post();
            
            $formasBusiness = $this->Factory->createBusiness("fin_formas_recebimentos");
           
            $listFormas = $formasBusiness->filtro($dados);
            $info['listFormas'] = $listFormas;
           	
            $content = $this->load->view("formas_recebimentos/filtro",$info,TRUE);
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
              
              $formaBusiness = $this->Factory->createBusiness("fin_formas_recebimentos");
              $info["objForma"] = $formaBusiness->visualizar($id_forma);
              
              $content = $this->load->view("formas_recebimentos/visualizar",$info,TRUE);
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
          $this->form_validation->set_rules('tipo', 'FORMA', 'callback_validar_parcelado');
      
          
          if($this->form_validation->run()==FALSE){
              $formaBusiness = $this->Factory->createBusiness("fin_formas_recebimentos");
              $objForma = $formaBusiness->visualizar($id_forma);
              $info["objForma"] = $objForma;

              $tabBusiness = $this->Factory->createBusiness("fin_tabela_nome");
              $listTab = $tabBusiness->filtro(null);
              $info['listTab'] = $listTab;

              $info['msg'] = $msg;
             
              $content = $this->load->view("formas_recebimentos/editar",$info,TRUE);
              $this->loadPage($content);
              
           }
            else{
           	
            error_reporting(0);
            
            $dados = $this->input->post();

            if($dados['maximo_parcela']==null || $dados['maximo_parcela']==""){
             $dados['maximo_parcela'] = 1;
            }


           	$formaBusiness = $this->Factory->createBusiness("fin_formas_recebimentos");
           	$cod_forma = $formaBusiness->editar($dados);
            $msg = true;
           	redirect('formas_recebimentos/editar/'.$dados['id_forma'].'/'.$msg);
           }
      }

      //EXCLUSÃO
      public function excluir($id_forma){
          $this->load->helper(array('form','url'));

          $formaBusiness = $this->Factory->createBusiness("fin_formas_recebimentos");
          $formaBusiness->excluir($id_forma);
          redirect("formas_recebimentos/filtro");
      }


        //LISTAGEM
    public function ajax_listar(){

      //header( 'Cache-Control: no-cache' );
      //header( 'Content-type: application/xml; charset="utf-8"', true );
      
      $this->load->helper(array('form','url'));
      $formaBusiness = $this->Factory->createBusiness("fin_formas_recebimentos");
      $listForma = $formaBusiness->ajax_listar();
     
      echo json_encode($listForma); 
                
    }

      public function verificar_cartao($id_forma){

      //header( 'Cache-Control: no-cache' );
      //header( 'Content-type: application/xml; charset="utf-8"', true );
      
      $this->load->helper(array('form','url'));
      $formaBusiness = $this->Factory->createBusiness("fin_formas_recebimentos");
      $listForma = $formaBusiness->verificar_cartao($id_forma);
     
      echo json_encode($listForma); 
                
    }

    public function exibir_parcela($id_forma){

      //header( 'Cache-Control: no-cache' );
      //header( 'Content-type: application/xml; charset="utf-8"', true );
      
      $this->load->helper(array('form','url'));
      $formaBusiness = $this->Factory->createBusiness("fin_formas_recebimentos");
      $listForma = $formaBusiness->exibir_parcela($id_forma);
     
      echo json_encode($listForma); 
                
      
}

      
      
}
?>
