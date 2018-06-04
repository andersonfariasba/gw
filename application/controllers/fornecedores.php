<?php
/* Classe(controller): Fornecedores
 * Autor: Anderson Farias
 * Última atualização: 23/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Fornecedores extends MY_Controller {
	
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
            $content = $this->load->view("fornecedores/cadastrar",$info,TRUE);
            $this->loadPage($content);
        }
        else{
           $dados = $this->input->post();
            
           $dados['status'] = ATIVO;
           $dados['data_cadastro'] = date('Y-m-d');
           $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
           $cod_fornecedor = $fornecedorBusiness->cadastrar($dados);
           
           $msg = true;
           $info["msg"] = true;  


           redirect('fornecedores/cadastrar/'.$msg);
        }

    }

    public function verificar_existente($cnpj_cpf) {
        try {
            
            $cnpj_cpf = $this->input->post("cnpj_cpf");

            $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");

            if($cnpj_cpf!=""){
              if ($fornecedorBusiness->verificar_existente($cnpj_cpf)) {
                  $this->form_validation->set_message('verificar_existente', 'O documento <a href='.site_url("fornecedores/visualizar_por_documento/".$cnpj_cpf).'>'.$cnpj_cpf.'</a> fornecido já existe na base de dados!');
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
            
            $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
            $listFornecedor = $fornecedorBusiness->filtro(null);
            $info['listFornecedor'] = $listFornecedor;
            
            $content = $this->load->view("fornecedores/filtro",$info,TRUE);
            $this->loadPage($content);

            }else{
            
            $dados = $this->input->post();
            
            $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
            $listFornecedor = $fornecedorBusiness->filtro($dados);
            $info['listFornecedor'] = $listFornecedor;
           	
            $content = $this->load->view("fornecedores/filtro",$info,TRUE);
            $this->loadPage($content);	
            	
            }
            
            

        } catch (Exception $exc) {
            $this->loadError($ex);
        }
    }
    
    //VISUALIZAÇÃO
    public function visualizar($id_fornecedor){
          try {
              $this->load->helper(array('form','url'));
              
              $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
              $info["objFornecedor"] = $fornecedorBusiness->visualizar($id_fornecedor);
              
              $content = $this->load->view("fornecedores/visualizar",$info,TRUE);
              $this->loadPage($content);

          } catch (Exception $exc) {
              echo $exc->getTraceAsString();
          }

      }



       //VISUALIZAÇÃO
    public function visualizar_por_documento($documento){
          try {
              $this->load->helper(array('form','url'));
              
              $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
              $info["objFornecedor"] = $fornecedorBusiness->verificar_existente($documento);
              $info['msg'] = null;
                                                   
              $content = $this->load->view("fornecedores/editar",$info,TRUE);
              $this->loadPage($content);

          } catch (Exception $exc) {
              echo $exc->getTraceAsString();
          }

      }


      //EDIÇÃO
      public function editar($id_fornecedor,$msg=null){
          $this->load->helper(array('form','url'));
          $this->load->library('form_validation');
          
          $this->Rules();
          
          if($this->form_validation->run()==FALSE){
              $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
              $objFornecedor = $fornecedorBusiness->visualizar($id_fornecedor);
              $info["objFornecedor"] = $objFornecedor;

                $estadosBusiness = $this->Factory->createBusiness("estado");
              $listEstado = $estadosBusiness->filtro();
              $info['listEstados'] = $listEstado;

              $info['msg'] = $msg;
             
              $content = $this->load->view("fornecedores/editar",$info,TRUE);
              $this->loadPage($content);
              
           }
           
           else{
           	$dados = $this->input->post();
           	$fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
           	$cod_fornecedor = $fornecedorBusiness->editar($dados);

            $msg = true;
           	
            redirect('fornecedores/editar/'.$dados['id_fornecedor'].'/'.$msg);
           }
      }

      //EXCLUSÃO
      public function excluir($id_fornecedor){
          $this->load->helper(array('form','url'));

          $fornecedoresBusiness = $this->Factory->createBusiness("com_fornecedores");
          $fornecedoresBusiness->excluir($id_fornecedor);
          redirect("fornecedores/filtro");
      }
      
      
      public function pdf($id_fornecedor) {


        try {
            $this->load->helper(array('form', 'url'));
             $this->load->library('mpdf'); //carrega a biblioteca mpdf que está em aplication/libraries/mpdf
             //obj pedido
             $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
             $objFornecedor = $fornecedorBusiness->visualizar($id_fornecedor);
             $info["objFornecedor"] = $objFornecedor;
             
             
            $content = $this->load->view('fornecedores/pdf', $info,TRUE);
            
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
      $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
      $listFornecedor = $fornecedorBusiness->ajax_listar($pos);  
     
      echo json_encode($listFornecedor); 
                
    }
      
      
      
}
?>
