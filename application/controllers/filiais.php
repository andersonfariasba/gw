<?php
/* Classe(controller): Clientes
 * Autor: Anderson Farias
 * Última atualização: 03/07/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Filiais extends MY_Controller {
	
    //VALIDAÇÃO
    private function Rules(){
        $this->form_validation->set_rules('nome_fantasia','Nome Fantasia','required');
         $this->form_validation->set_rules('cnpj_cpf','CNPJ','required');
        $this->form_validation->set_error_delimiters('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');
    }
    
    //CADASTRA
    public function cadastrar($msg=null){
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
        $this->Rules();
        $this->form_validation->set_rules('cnpj_cpf', 'CPFCNPJ', 'callback_verificar_existente');
        
        $info['msg'] = $msg;
        //$info = null;
        
               
        if($this->form_validation->run()==FALSE){
            
                       
            $content = $this->load->view("filiais/cadastrar",$info,TRUE);
            $this->loadPage($content);
        }
        else{
           $dados = $this->input->post();
            
           $dados['status'] = ATIVO;
           $dados['data_cadastro'] = date('Y-m-d');
           $clientesBusiness = $this->Factory->createBusiness("fin_filiais");
           $cod_cliente = $clientesBusiness->cadastrar($dados);
           $msg = true;           
           
           $info["msg"] = true;  
           redirect('filiais/cadastrar/'.$msg);
           
          
        }

    }



     public function verificar_existente($cnpj_cpf) {
        try {
            
            $cnpj_cpf = $this->input->post("cnpj_cpf");

            $clientesBusiness = $this->Factory->createBusiness("fin_filiais");

            if($cnpj_cpf!=""){
              if ($clientesBusiness->verificar_existente($cnpj_cpf)) {
                  $this->form_validation->set_message('verificar_existente', 'O documento <a href='.site_url("filiais/visualizar_por_documento/".$cnpj_cpf).' target=_blank>'.$cnpj_cpf.'</a> fornecido já existe na base de dados!');
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
            
            $clientesBusiness = $this->Factory->createBusiness("fin_filiais");
            $listCliente = $clientesBusiness->filtro(null);
            $info['listCliente'] = $listCliente;
            
            $content = $this->load->view("filiais/filtro",$info,TRUE);
            $this->loadPage($content);

            }else{
            
            $dados = $this->input->post();
           
            
            $clientesBusiness = $this->Factory->createBusiness("fin_filiais");
            $listClientes = $clientesBusiness->filtro($dados);
            $info['listCliente'] = $listClientes;
           	
            $content = $this->load->view("filiais/filtro",$info,TRUE);
            $this->loadPage($content);	
            	
            }
            
            

        } catch (Exception $exc) {
            $this->loadError($ex);
        }
    }

    
    
    
    //VISUALIZAÇÃO
    public function visualizar_por_documento($documento){
          try {
              $this->load->helper(array('form','url'));
              
              $clienteBusiness = $this->Factory->createBusiness("fin_filiais");
            
              $objCliente = $clienteBusiness->verificar_existente($documento);
              $info["objCliente"] = $objCliente; 

                           
              $content = $this->load->view("filiais/visualizar",$info,TRUE);
              $this->loadPage($content);

          } catch (Exception $exc) {
              echo $exc->getTraceAsString();
          }

      }

    
    

    //VISUALIZAÇÃO
    public function visualizar($id_filial){
          try {
              $this->load->helper(array('form','url'));
              
              $clienteBusiness = $this->Factory->createBusiness("fin_filiais");
              $info["objCliente"] = $clienteBusiness->visualizar($id_filial);
              
              $content = $this->load->view("filiais/visualizar",$info,TRUE);
              $this->loadPage($content);

          } catch (Exception $exc) {
              echo $exc->getTraceAsString();
          }

      }

      //EDIÇÃO
      public function editar($id_filial,$msg=null){
          $this->load->helper(array('form','url'));
          $this->load->library('form_validation');
          
          $this->Rules();
          
          if($this->form_validation->run()==FALSE){
              
              $clientesBusiness = $this->Factory->createBusiness("fin_filiais");
              $objCliente = $clientesBusiness->visualizar($id_filial);
              $info["objCliente"] = $objCliente;

               $estadosBusiness = $this->Factory->createBusiness("estado");
              $listEstado = $estadosBusiness->filtro();
              $info['listEstados'] = $listEstado; 

              $info['msg'] = $msg;
             
              $content = $this->load->view("filiais/editar",$info,TRUE);
              $this->loadPage($content);
              
           }
           
           else{
           	$dados = $this->input->post();
           	
            //IMAGEM
              //imagem
               $config['upload_path'] = './images/';//Caminho onde será salvo
               $config['allowed_types'] = 'jpeg|png|JPG|JPEG|gif|jpg';//Tipos de imagem aceito
               $config['max_size'] = '4096';//Tamanho - Aqui aceitamos até 2 Mb
               $config['overwrite']  = FALSE;//Não irá sobre-escrever o arquivo
               $config['encrypt_name'] = TRUE;//Trocará o nome do arquivo para um HASH - TRUE PADRÃO
               
                $field_name1 = "logo";// Nome do campo INPUT do formulário                         
                $this->load->library('upload');
                $this->upload->initialize($config);

                 if($_FILES['logo']['error'] != 4){ 
                   
                    $this->upload->initialize($config);

                    if(!$this->upload->do_upload($field_name1))
                    {
                    $error = array('erro' => $this->upload->display_errors());
                    echo "<script>alert('Verifique o tamanho ou formato da imagem')</script>";
                    echo "<script>window.location.href='".site_url('fin_filiais/editar/1')."'</script>";
                  
                    }

                    $dadosUp = $this->upload->data();
                    $dados['logo'] = $dadosUp['file_name'];
                    unset($dados['arquivo_atual']);
               }
                 else{
                     $dados['logo'] = $dados['arquivo_atual'];
                     unset($dados['arquivo_atual']);

               }


            //FINAL IMAGEM


            $dados['observacao'] = trim($dados['observacao']);
            
            $clientesBusiness = $this->Factory->createBusiness("fin_filiais");
           	$cod_cliente = $clientesBusiness->editar($dados);

           //final cadastro de entrega

            $msg = true;
            redirect('login/sair/');
           	//redirect('filiais/editar/'.$dados['id_filial'].'/'.$msg);
           }
      }

      //EXCLUSÃO
      public function excluir($id_filial){
          $this->load->helper(array('form','url'));

          $clientesBusiness = $this->Factory->createBusiness("fin_filiais");
          $clientesBusiness->excluir($id_filial);
          redirect("filiais/filtro");
      }
      
      
      public function pdf($id_filial) {


        try {
            $this->load->helper(array('form', 'url'));
             $this->load->library('mpdf'); //carrega a biblioteca mpdf que está em aplication/libraries/mpdf
             //obj pedido
             $clientesBusiness = $this->Factory->createBusiness("fin_filiais");
             $objCliente = $clientesBusiness->visualizar($id_filial);
             $info["objCliente"] = $objCliente;
             
             
            $content = $this->load->view('filiais/pdf', $info,TRUE);
            
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
      $clienteBusiness = $this->Factory->createBusiness("fin_filiais");
      $listClientes = $clienteBusiness->ajax_listar($pos);  
     
      echo json_encode($listClientes); 
                
    }



   
    
    
         
      
}
?>
