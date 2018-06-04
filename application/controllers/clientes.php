<?php
/* Classe(controller): Clientes
 * Autor: Anderson Farias
 * Última atualização: 03/07/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Clientes extends MY_Controller {
	
    //VALIDAÇÃO
    private function Rules(){
        $this->form_validation->set_rules('nome_fantasia','Nome','required');
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
          $info["objCliente"] = null;
        //$info = null;
        
               
        if($this->form_validation->run()==FALSE){
            
                       
            $content = $this->load->view("clientes/cadastrar",$info,TRUE);
            $this->loadPage($content);
        }
        else{
          
           error_reporting(0);

           $dados = $this->input->post();
            
           $dados['status'] = ATIVO;
           $dados['data_cadastro'] = date('Y-m-d');
           $objDateFormat = $this->DateFormat;
           $dados['data_nascimento'] = $objDateFormat->date_mysql($dados['data_nascimento']);
           $clientesBusiness = $this->Factory->createBusiness("com_clientes");
           $cod_cliente = $clientesBusiness->cadastrar($dados);

             //cadastro de endereço de entrega
           $dadosEntrega['endereco'] = $dados['endereco_entrega'];
           $dadosEntrega['bairro'] = $dados['bairro_entrega'];
           $dadosEntrega['cep'] = $dados['cep_entrega'];
           $dadosEntrega['cidade'] = $dados['cidade_entrega'];
           $dadosEntrega['estado'] = $dados['uf_entrega'];
           $dadosEntrega['observacao'] = $dados['observacao_entrega'];
           $dadosEntrega['id_cliente'] = $cod_cliente;


           $entregaBusiness = $this->Factory->createBusiness("com_clientes_end_entrega");
           $cod_entrega = $entregaBusiness->cadastrar($dadosEntrega);

            $clienteBusiness = $this->Factory->createBusiness("com_clientes");
              $info["objCliente"] = $clienteBusiness->visualizar($cod_cliente);
        

          

           //final cadastro de entrega

            $msg = true;      
        
           $info["msg"] = true;  
           
            $content = $this->load->view("clientes/cadastrar",$info,TRUE);
            $this->loadPage($content);

           //redirect('clientes/editar/'.$cod_cliente.'/'.$msg);
           //redirect('clientes/cadastrar/'.$msg);
           
          
        }

    }



     public function verificar_existente($cnpj_cpf) {
        try {
            
            $cnpj_cpf = $this->input->post("cnpj_cpf");

            $clientesBusiness = $this->Factory->createBusiness("com_clientes");

            if($cnpj_cpf!=""){
              if ($clientesBusiness->verificar_existente($cnpj_cpf)) {
                  $this->form_validation->set_message('verificar_existente', 'O documento <a href='.site_url("clientes/visualizar_por_documento/".$cnpj_cpf).'>'.$cnpj_cpf.'</a> fornecido já existe na base de dados!');
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
            
            $clientesBusiness = $this->Factory->createBusiness("com_clientes");
            $listCliente = $clientesBusiness->filtro(null);
            $info['listCliente'] = $listCliente;
            
            $content = $this->load->view("clientes/filtro",$info,TRUE);
            $this->loadPage($content);

            }else{
            
            $dados = $this->input->post();
           
            
            $clientesBusiness = $this->Factory->createBusiness("com_clientes");
            $listClientes = $clientesBusiness->filtro($dados);
            $info['listCliente'] = $listClientes;
           	
            $content = $this->load->view("clientes/filtro",$info,TRUE);
            $this->loadPage($content);	
            	
            }
            
            

        } catch (Exception $exc) {
            $this->loadError($ex);
        }
    }

    
    
        //LISTAGEM
    public function teste(){
        try {
            
             $this->load->helper(array('form','url'));
            
            $nome_fantasia = $this->input->post('nome_fantasia');
            $cnpj_cpf = $this->input->post('nome_fantasia');
             //echo "<scrit>alert({$this->input->post('nome_fantasia')})</script>";
            
            $dados = array('nome_fantasia' => $nome_fantasia,'cnpj_cpf' => $cnpj_cpf);
 
            $clientesBusiness = $this->Factory->createBusiness("com_clientes");
            $listClientes = $clientesBusiness->filtro($dados);
            $info['listCliente'] = $listClientes;
           	
            $content = $this->load->view("clientes/filtro",$info,TRUE);
            $this->loadPage($content);	
            
            

           
            

        } catch (Exception $exc) {
            $this->loadError($ex);
        }
    }

    
    
    //VISUALIZAÇÃO
    public function visualizar_por_documento($documento){
          try {
              $this->load->helper(array('form','url'));
              
              $clienteBusiness = $this->Factory->createBusiness("com_clientes");
            
              $objCliente = $clienteBusiness->verificar_existente($documento);
              $info["objCliente"] = $objCliente;

               $entregaBusiness = $this->Factory->createBusiness("com_clientes_end_entrega");
              $objEntrega = $entregaBusiness->visualizar_por_cliente($objCliente->getId_cliente());
              $info["objEntrega"] = $objEntrega;

              $info['msg'] = null; 

                           
              $content = $this->load->view("clientes/editar",$info,TRUE);
              $this->loadPage($content);

          } catch (Exception $exc) {
              echo $exc->getTraceAsString();
          }

      }

    
    

    //VISUALIZAÇÃO
    public function visualizar($id_cliente){
          try {
              $this->load->helper(array('form','url'));
              
              $clienteBusiness = $this->Factory->createBusiness("com_clientes");
              $info["objCliente"] = $clienteBusiness->visualizar($id_cliente);
              
              $content = $this->load->view("clientes/visualizar",$info,TRUE);
              $this->loadPage($content);

          } catch (Exception $exc) {
              echo $exc->getTraceAsString();
          }

      }

      //EDIÇÃO
      public function editar($id_cliente,$msg=null){
          $this->load->helper(array('form','url'));
          $this->load->library('form_validation');
          
          $this->Rules();
          
          if($this->form_validation->run()==FALSE){
              
              $clientesBusiness = $this->Factory->createBusiness("com_clientes");
              $objCliente = $clientesBusiness->visualizar($id_cliente);
              $info["objCliente"] = $objCliente;

              $entregaBusiness = $this->Factory->createBusiness("com_clientes_end_entrega");
              $objEntrega = $entregaBusiness->visualizar_por_cliente($id_cliente);
              $info["objEntrega"] = $objEntrega;
             
              $estadosBusiness = $this->Factory->createBusiness("estado");
              $listEstado = $estadosBusiness->filtro();
              $info['listEstados'] = $listEstado; 



              $info['msg'] = $msg;
             
              $content = $this->load->view("clientes/editar",$info,TRUE);
              $this->loadPage($content);
              
           }
           
           else{
           	 error_reporting(0);
            $dados = $this->input->post();
           	$clientesBusiness = $this->Factory->createBusiness("com_clientes");
           	 $objDateFormat = $this->DateFormat;
           $dados['data_nascimento'] = $objDateFormat->date_mysql($dados['data_nascimento']);
           
            $cod_cliente = $clientesBusiness->editar($dados);

             //cadastro de endereço de entrega
           $dadosEntrega['endereco'] = $dados['endereco_entrega'];
           $dadosEntrega['bairro'] = $dados['bairro_entrega'];
           $dadosEntrega['cep'] = $dados['cep_entrega'];
           $dadosEntrega['cidade'] = $dados['cidade_entrega'];
           $dadosEntrega['estado'] = $dados['uf_entrega'];
           $dadosEntrega['observacao'] = $dados['observacao_entrega'];
           $dadosEntrega['id_cliente'] = $dados['id_cliente'];
           $dadosEntrega['id_endereco'] = $dados['id_endereco'];

           $entregaBusiness = $this->Factory->createBusiness("com_clientes_end_entrega");
           $cod_entrega = $entregaBusiness->editar($dadosEntrega);


            $msg = true;
           	redirect('clientes/editar/'.$dados['id_cliente'].'/'.$msg);
           }
      }

      //EXCLUSÃO
      public function excluir($id_cliente){
          $this->load->helper(array('form','url'));

          $clientesBusiness = $this->Factory->createBusiness("com_clientes");
          $clientesBusiness->excluir($id_cliente);
          redirect("clientes/filtro");
      }
      
      
      public function pdf($id_cliente) {


        try {
            $this->load->helper(array('form', 'url'));
             $this->load->library('mpdf'); //carrega a biblioteca mpdf que está em aplication/libraries/mpdf
             //obj pedido
             $clientesBusiness = $this->Factory->createBusiness("com_clientes");
             $objCliente = $clientesBusiness->visualizar($id_cliente);
             $info["objCliente"] = $objCliente;
             
             
            $content = $this->load->view('clientes/pdf', $info,TRUE);
            
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
      $clienteBusiness = $this->Factory->createBusiness("com_clientes");
      $listCliente = $clienteBusiness->ajax_listar($pos);  
     
      echo json_encode($listCliente); 
                
    }


     //VISUALIZAÇÃO
    public function passos(){
          try {
              $this->load->helper(array('form','url'));
              
              $info = "";
              
              $content = $this->load->view("clientes/passos",$info,TRUE);
              $this->loadPage($content);

          } catch (Exception $exc) {
              echo $exc->getTraceAsString();
          }

      }



   
    
    
         
      
}
?>
