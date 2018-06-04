<?php
/* Classe(controller): Fornecedores
 * Autor: Anderson Farias
 * Última atualização: 23/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Transportadoras extends MY_Controller {
	
    //VALIDAÇÃO
    private function Rules(){
        $this->form_validation->set_rules('nome_fantasia','Nome Fantasia','required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"  id="msgOk">
<strong><i class="fa fa-check"></i></strong> ', '</div>');    
     
    }
    
    //CADASTRA
    public function cadastrar($msg=null){
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
        $this->Rules();
        $this->form_validation->set_rules('cnpj_cpf', 'CPFCNPJ', 'callback_verificar_existente');
        
        $info['msg'] = $msg;
        
        if($this->form_validation->run()==FALSE){
            $content = $this->load->view("transportadoras/cadastrar",$info,TRUE);
            $this->loadPage($content);
        }
        else{
           $dados = $this->input->post();
            
           $dados['status'] = ATIVO;
           $dados['data_cadastro'] = date('Y-m-d');
           $transBusiness = $this->Factory->createBusiness("com_transportadoras");
           $cod_trans = $transBusiness->cadastrar($dados);
           
           $msg = true;
           $info["msg"] = true;  


           redirect('transportadoras/cadastrar/'.$msg);
        }

    }

    public function verificar_existente($cnpj_cpf) {
        try {
            
            $cnpj_cpf = $this->input->post("cnpj_cpf");

            $fornecedorBusiness = $this->Factory->createBusiness("com_transportadoras");

            if($cnpj_cpf!=""){
              if ($fornecedorBusiness->verificar_existente($cnpj_cpf)) {
                  $this->form_validation->set_message('verificar_existente', 'O documento <a href='.site_url("transportadoras/visualizar_por_documento/".$cnpj_cpf).' target=_blank>'.$cnpj_cpf.'</a> fornecido já existe na base de dados!');
                  return false;
              }
              else {
                return true;
              } 
            }


            
        } catch (Excpeption $ex) {
            $this->loadError($ex);
        }
    }


    //LISTAGEM
    public function filtro(){
        try {
            $this->load->helper(array('form','url'));
            
            if ($this->input->post() == NULL) {
            
            $transBusiness = $this->Factory->createBusiness("com_transportadoras");
            $listTrans = $transBusiness->filtro(null);
            $info['listTransportadora'] = $listTrans;
            
            $content = $this->load->view("transportadoras/filtro",$info,TRUE);
            $this->loadPage($content);

            }else{
            
            $dados = $this->input->post();
            
            $transBusiness = $this->Factory->createBusiness("com_transportadoras");
            $listTransportadora = $transBusiness->filtro($dados);
            $info['listTransportadora'] = $listTransportadora;
           	
            $content = $this->load->view("transportadoras/filtro",$info,TRUE);
            $this->loadPage($content);	
            	
            }
            
            

        } catch (Exception $exc) {
            $this->loadError($ex);
        }
    }
    
    //VISUALIZAÇÃO
    public function visualizar($id_transportadora){
          try {
              $this->load->helper(array('form','url'));
              
              $transBusiness = $this->Factory->createBusiness("com_transportadoras");
              $info["objTransportadora"] = $transBusiness->visualizar($id_transportadora);
              
              $content = $this->load->view("transportadoras/visualizar",$info,TRUE);
              $this->loadPage($content);

          } catch (Exception $exc) {
              echo $exc->getTraceAsString();
          }

      }



       //VISUALIZAÇÃO
    public function visualizar_por_documento($documento){
          try {
              $this->load->helper(array('form','url'));
              
              $transBusiness = $this->Factory->createBusiness("com_transportadoras");
              $info["objTrans"] = $transBusiness->verificar_existente($documento);
                                                   
              $content = $this->load->view("transportadoras/visualizar",$info,TRUE);
              $this->loadPage($content);

          } catch (Exception $exc) {
              echo $exc->getTraceAsString();
          }

      }


      //EDIÇÃO
      public function editar($id_transportadora,$msg=null){
          $this->load->helper(array('form','url'));
          $this->load->library('form_validation');
          
          $this->Rules();
          
          if($this->form_validation->run()==FALSE){
              $transBusiness = $this->Factory->createBusiness("com_transportadoras");
              $objTransportadora = $transBusiness->visualizar($id_transportadora);
              $info["objTransportadora"] = $objTransportadora;

              //echo $objTransportadora->getId_transportadora();
              //exit;


              $info['msg'] = $msg;
             
              $content = $this->load->view("transportadoras/editar",$info,TRUE);
              $this->loadPage($content);
              
           }
           
           else{
           	$dados = $this->input->post();
           	$transBusiness = $this->Factory->createBusiness("com_transportadoras");
           	$cod_trans = $transBusiness->editar($dados);

            $msg = true;
           	
            redirect('transportadoras/editar/'.$dados['id_transportadora'].'/'.$msg);
           }
      }

      //EXCLUSÃO
      public function excluir($id_transportadora){
          $this->load->helper(array('form','url'));

          $transBusiness = $this->Factory->createBusiness("com_transportadoras");
          $transBusiness->excluir($id_transportadora);
          redirect("transportadoras/filtro");
      }
      
      
      public function pdf($id_transportadora) {


        try {
            $this->load->helper(array('form', 'url'));
             $this->load->library('mpdf'); //carrega a biblioteca mpdf que está em aplication/libraries/mpdf
             //obj pedido
             $transBusiness = $this->Factory->createBusiness("com_transportadoras");
             $objTransportadora = $fornecedorBusiness->visualizar($id_transportadora);
             $info["objTransportadora"] = $objTransportadora;
             
             
            $content = $this->load->view('transportadoras/pdf', $info,TRUE);
            
             //ini_set('memory_limit','128M');
             
            $this->mpdf->setFooter('{PAGENO}'); //numero de paginas
            $this->mpdf->WriteHTML($content); // Converte os dados html para pdf
            $this->mpdf->Output(); //gera o pdf na tela
        } catch (Exception $ex) {
            $this->loadError($ex);
        }
    }


     //LISTAGEM
    public function ajax_listar($pos){

      //header( 'Cache-Control: no-cache' );
      //header( 'Content-type: application/xml; charset="utf-8"', true );
      
      $this->load->helper(array('form','url'));
      $transBusiness = $this->Factory->createBusiness("com_transportadoras");
      $listTransportadora = $transBusiness->ajax_listar($pos);  
     
      echo json_encode($listTransportadora); 
                
    }
      
      
      
}
?>
