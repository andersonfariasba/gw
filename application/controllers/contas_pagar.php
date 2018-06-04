<?php
/* Classe(controller): Contas pagar
 * Autor: Anderson Farias
 * Última atualização: 04/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Contas_pagar extends MY_Controller {
	
    //VALIDAÇÃO
    private function RulesCadastrar(){
        $this->form_validation->set_rules('id_fornecedor','Fornecedor','required');
        //$this->form_validation->set_rules('id_custo','Centro de custo','required');
        $this->form_validation->set_rules('data_vencimento','Data vencimento','required');
         $this->form_validation->set_rules('data','Data Emissão','required');
         $this->form_validation->set_rules('id_plano','Natureza','required');
        $this->form_validation->set_rules('valor','Valor','required');
         $this->form_validation->set_rules('parcela_qtd','Parcela','required');
       // $this->form_validation->set_error_delimiters('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"  id="msgOk">
<strong><i class="fa fa-check"></i></strong> ', '</div>');  
    }
    
    
    private function RulesEditar(){
        $this->form_validation->set_rules('data_vencimento','Data vencimento','required');
         $this->form_validation->set_rules('id_fornecedor','Fornecedor','required');
        //$this->form_validation->set_error_delimiters('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"  id="msgOk">
<strong><i class="fa fa-check"></i></strong> ', '</div>');  
    }

     private function RulesBaixa(){
        $this->form_validation->set_rules('data_pagamento','Data Pagamento','required');
         $this->form_validation->set_rules('valor_titulo','Valor','required');
        //$this->form_validation->set_error_delimiters('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"  id="msgOk">
<strong><i class="fa fa-check"></i></strong> ', '</div>');  
    }
    
   

//CADASTRA
    public function cadastrar($msg=null){
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
        $this->RulesCadastrar();
      
        
        if($this->form_validation->run()==FALSE){
            
            //Plano de contas
            $categoriasBusiness = $this->Factory->createBusiness("fin_plano_contas_cat");

            
            $listCategoria = $categoriasBusiness->listar_por_tipo(CONTAS_PAGAR);
            $info["listCategoria"] = $listCategoria;

            /*$planosBusiness = $this->Factory->createBusiness("fin_plano_contas");
            $listPlanos = $planosBusiness->listar_por_categoria();
            $info["listPlanos"] = $listPlanos;*/

            //Fornecedores
            $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
            $listFornecedor = $fornecedorBusiness->filtro();
            $info["listFornecedor"] = $listFornecedor;
           
           
            $custoBusiness = $this->Factory->createBusiness("fin_centro_custos");
            $listCustos = $custoBusiness->filtro();
            $info["listCusto"] = $listCustos;

             //FORMA DE PAGAMENTO
            $formasBusiness = $this->Factory->createBusiness("fin_formas_pagamentos");
            $listFormas = $formasBusiness->filtro();
            $info['listForma'] = $listFormas;
           
             $info['msg'] = $msg; 


            $content = $this->load->view("contas_pagar/cadastrar",$info,TRUE);
            $this->loadPage($content);
        }
          
          else{
            error_reporting(0);
            
            $dados = $this->input->post();

              //operacação imagem
              if($_FILES['arquivo']['error'] != 4){ 
                $config['upload_path'] = './doc/';//Caminho onde será salvo
                $config['allowed_types'] = 'pdf|doc|docx|xls|xlsx|jpeg|png|JPG|JPEG|gif|jpg|zip|rar';//Tipos de imagem aceito
                $config['max_size'] = '4096';//Tamanho - Aqui aceitamos até 2 Mb
                $config['overwrite']  = FALSE;//Não irá sobre-escrever o arquivo
                $config['encrypt_name'] = TRUE;//Trocará o nome do arquivo para um HASH - TRUE PADRÃO
               
                $field_name1 = "arquivo";// Nome do campo INPUT do formulário                         
                $this->load->library('upload');
                $this->upload->initialize($config);

                if(!$this->upload->do_upload($field_name1))
                {
                $error = array('erro' => $this->upload->display_errors());
                echo "<script>alert('Verifique o tamanho ou formato do arquivo!')</script>";
                echo "<script>history.back()</script>";
              
                }

                $dadosUp = $this->upload->data();
                $dadosLanc['arquivo'] = $dadosUp['file_name'];
             }


             //Operação contas a pagar
            //$dados['data'] = date('Y-m-d');
            $dados['valor_total'] = $dados["valor"]; //str_replace(",",".",str_replace(".","",$dados['valor']));
 //$dados["valor"];
            //se for não parcelado setar a qtd da parcela para contas como zero
            
            /*if($dados['repetir_conta']==null){
                $dados['parcela_qtd'] = 1;
                 
            }*/

            $objDateFormat = $this->DateFormat;

            /*if($dados['pagamento_realizado']!=null){
              $dadosLanc['status'] = PAGO;
              $dadosLanc['data_pagamento'] = $objDateFormat->date_mysql($dados['data_pagamento']);
            }else{
               $dadosLanc['status'] = ABERTO;
            }*/

            $dados['data'] = $objDateFormat->date_mysql($dados['data']);
            $dadosLanc['status'] = ABERTO;
                    
            
            //cadastra a conta
            $contaBusiness = $this->Factory->createBusiness("fin_contas_pagar");
            $id_conta = $contaBusiness->cadastrar($dados);

            $dadosLanc['id_conta'] = $id_conta;
            $dadosLanc['id_forma'] = $dados['id_forma'];
           
            $dadosLanc['descricao'] = $dados['descricao'];

             $nParcelas = $dados['parcela_qtd'];
             $dias = 31;

             $dadosLanc['multa'] = $dados['multa'];
             $dadosLanc['juros'] = $dados['juros'];
             
             $valor_titulo = $dados["valor"] + $dados['multa'] + $dados['juros'];

              $prazo = 30;
              //$data = date('Y-m-d');
              $vencimento = $objDateFormat->date_mysql($dados['data_vencimento']);
              $data_vencimento = date('d/m/Y', strtotime($vencimento));

              $dataExplode = explode( "/",$data_vencimento );

              $dia = $dataExplode[0];
              $mes = $dataExplode[1];
              $ano = $dataExplode[2];

             
             for($x = 0; $x < $nParcelas; $x++){

               //$total_dias = $dias * $x;
              

            
              //$vencimento = $objDateFormat->date_mysql($dados['data_vencimento']);
              //$dadosLanc['data_vencimento'] = date('Y-m-d', strtotime("+$total_dias days",strtotime($vencimento)));
              
               $mes = $mes+1;
                  if ($mes >12){
                  $mes = 1;
                  // ++$ano;
                  $ano = $ano+1;
                  }

              $dadosLanc['data_vencimento'] = date("Y-m-d",mktime(0,0,0,$mes-1,$dia,$ano));
              $dadosLanc['valor_titulo'] = $valor_titulo / $dados['parcela_qtd']; //str_replace(",",".",str_replace(".","",$dados['valor']));
              $dadosLanc["parcela"] = $x+1;
             

              $lancamentoBusiness = $this->Factory->createBusiness("fin_lancamentos_pagar");
              $id_lancamento = $lancamentoBusiness->cadastrar($dadosLanc);
                
            }


             $msg = true;
            
            redirect('contas_pagar/editar/'.$id_lancamento.'/'.$msg);

            
            }

    }




    //LISTAGEM
    public function filtro($dados=null){
        try {
            $this->load->helper(array('form','url'));
            
            if ($this->input->post() == NULL) {
            
             //Plano de contas
            $categoriasBusiness = $this->Factory->createBusiness("fin_plano_contas_cat");
            $listCategoria = $categoriasBusiness->listar_por_tipo(CONTAS_PAGAR);
            $info["listCategoria"] = $listCategoria;

            //Fornecedores
            $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
            $listFornecedor = $fornecedorBusiness->filtro();
            $info["listFornecedor"] = $listFornecedor;
           
            //Centro de custos
            $custoBusiness = $this->Factory->createBusiness("fin_centro_custos");
            $listCustos = $custoBusiness->filtro();
            $info["listCusto"] = $listCustos;
            $tipo = CONTAS_PAGAR;

             //Conta Banco
            $conta_bancoBusiness = $this->Factory->createBusiness("fin_contas_banco");
            $listContasBanco = $conta_bancoBusiness->filtro();
            $info["listContaBanco"] = $listContasBanco;


               //FORMA DE PAGAMENTO
            $formasBusiness = $this->Factory->createBusiness("fin_formas_pagamentos");
            $listFormas = $formasBusiness->filtro();
            $info['listForma'] = $listFormas;
            
            $lancamentosBusiness = $this->Factory->createBusiness("fin_lancamentos_pagar");
            $listLanc = $lancamentosBusiness->filtro();
            $info['listLanc'] = $listLanc;
            
            $content = $this->load->view("contas_pagar/filtro",$info,TRUE);
            $this->loadPage($content);

            }else{
            
            $dados = $this->input->post();
            
           
             //Plano de contas
            $categoriasBusiness = $this->Factory->createBusiness("fin_plano_contas_cat");
            $listCategoria = $categoriasBusiness->listar_por_tipo(CONTAS_PAGAR);
            $info["listCategoria"] = $listCategoria;


            //Fornecedores
            $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
            $listFornecedor = $fornecedorBusiness->filtro();
            $info["listFornecedor"] = $listFornecedor;
           
            //Centro de custos
            $custoBusiness = $this->Factory->createBusiness("fin_centro_custos");
            $listCustos = $custoBusiness->filtro();
            $info["listCusto"] = $listCustos;

             //Conta Banco
            $conta_bancoBusiness = $this->Factory->createBusiness("fin_contas_banco");
            $listContasBanco = $conta_bancoBusiness->filtro();
            $info["listContaBanco"] = $listContasBanco;
                    
            $tipo = CONTAS_PAGAR;
            $lancamentosBusiness = $this->Factory->createBusiness("fin_lancamentos_pagar");
            $listLanc = $lancamentosBusiness->filtro($dados);
            $info['listLanc'] = $listLanc;

            
               //FORMA DE PAGAMENTO
            $formasBusiness = $this->Factory->createBusiness("fin_formas_pagamentos");
           
            $listFormas = $formasBusiness->filtro();
            $info['listForma'] = $listFormas;
            	
            $content = $this->load->view("contas_pagar/filtro",$info,TRUE);
            $this->loadPage($content);	
            	
            }
            
          } catch (Exception $exc) {
            $this->loadError($ex);
        }
    }
    
    //VISUALIZAÇÃO
    public function visualizar($id_lanc){
          try {
              $this->load->helper(array('form','url'));
              
               //Fornecedores
            $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
            $listFornecedor = $fornecedorBusiness->filtro();
            $info["listFornecedor"] = $listFornecedor;
           
            //Centro de custos
            $custoBusiness = $this->Factory->createBusiness("fin_centro_custos");
            $listCustos = $custoBusiness->filtro();
            $info["listCusto"] = $listCustos;


             //Conta Banco
            $conta_bancoBusiness = $this->Factory->createBusiness("fin_contas_banco");
            $listContasBanco = $conta_bancoBusiness->filtro();
            $info["listContaBanco"] = $listContasBanco;
            
              
            $lancBusiness = $this->Factory->createBusiness("fin_lancamentos");
            $objLanc = $lancBusiness->visualizar($id_lanc);
            $info["objLanc"] = $objLanc;

              $content = $this->load->view("contas_pagar/visualizar",$info,TRUE);
              $this->loadPage($content);

          } catch (Exception $exc) {
              echo $exc->getTraceAsString();
          }

      }

      //EDIÇÃO
      public function editar($id_lanc,$msg=null){
          $this->load->helper(array('form','url'));
          $this->load->library('form_validation');
          
          $this->RulesEditar();
          
          if($this->form_validation->run()==FALSE){
              
              
             //Plano de contas
            $categoriasBusiness = $this->Factory->createBusiness("fin_plano_contas_cat");
            $listCategoria = $categoriasBusiness->listar_por_tipo(CONTAS_PAGAR);
            $info["listCategoria"] = $listCategoria;

              //Fornecedores
            $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
            $listFornecedor = $fornecedorBusiness->filtro();
            $info["listFornecedor"] = $listFornecedor;
           
            //Centro de custos
            $custoBusiness = $this->Factory->createBusiness("fin_centro_custos");
            $listCustos = $custoBusiness->filtro();
            $info["listCusto"] = $listCustos;

              //FORMA DE PAGAMENTO
            $formasBusiness = $this->Factory->createBusiness("fin_formas_pagamentos");
            
            $listFormas = $formasBusiness->filtro();
            $info['listForma'] = $listFormas;




             //Conta Banco
            $conta_bancoBusiness = $this->Factory->createBusiness("fin_contas_banco");
            $listContasBanco = $conta_bancoBusiness->filtro();
            $info["listContaBanco"] = $listContasBanco;
            
              
            $lancBusiness = $this->Factory->createBusiness("fin_lancamentos_pagar");
            $objLanc = $lancBusiness->visualizar($id_lanc);
            $info["objLanc"] = $objLanc;

            $listLanc = $lancBusiness->listar_por_conta($objLanc->getId_conta());
            $info['listLanc'] = $listLanc;

            $info['msg'] = $msg;

            $content = $this->load->view("contas_pagar/editar",$info,TRUE);
            $this->loadPage($content);
              
           }
           
           else{
           	   error_reporting(0);
               

                $dados = $this->input->post();

                   //imagem
                $config['upload_path'] = './doc/';//Caminho onde será salvo
                $config['allowed_types'] = 'pdf|doc|docx|xls|xlsx|jpeg|png|JPG|JPEG|gif|jpg|zip|rar';//Tipos de imagem aceito
                $config['max_size'] = '4096';//Tamanho - Aqui aceitamos até 2 Mb
                $config['overwrite']  = FALSE;//Não irá sobre-escrever o arquivo
                $config['encrypt_name'] = TRUE;//Trocará o nome do arquivo para um HASH - TRUE PADRÃO
               
                $field_name1 = "arquivo";// Nome do campo INPUT do formulário                         
                $this->load->library('upload');
                $this->upload->initialize($config);

               if($_FILES['arquivo']['error'] != 4){ 
                   
                    $this->upload->initialize($config);

                    if(!$this->upload->do_upload($field_name1))
                    {
                    $error = array('erro' => $this->upload->display_errors());
                    echo "<script>alert('Verifique o tamanho ou formato da imagem')</script>";
                    echo "<script>window.history.back();</script>";
                  
                    }


                    $dadosUp = $this->upload->data();
                    $dadosLanc['arquivo'] = $dadosUp['file_name'];
                    unset($dados['arquivo_atual']);
               }
                 else{
                     $dadosLanc['arquivo'] = $dados['arquivo_atual'];
                     unset($dados['arquivo_atual']);

               }
               //final imagem

                
                $objDateFormat = $this->DateFormat;
                
                $dadosLanc['data_vencimento'] = $objDateFormat->date_mysql($dados['data_vencimento']);
                $dadosLanc['data_pagamento'] = $objDateFormat->date_mysql($dados['data_pagamento']);
                $dadosLanc['id_lancamento'] = $dados['id_lancamento'];
                $dadosLanc['descricao'] = $dados['descricao'];
                $dadosLanc['id_conta_banco'] = $dados['id_conta_banco'];
                $dadosLanc['id_forma'] = $dados['id_forma'];
                 
               
                
                //$multa_juros = 0;
                //calcula os juros + multa com o valor total
                //$multa_juros = $dadosLanc['multa'] + $dadosLanc['juros'];
                //$dadosLanc['valor_titulo'] = $dadosLanc['valor_titulo'] + $multa_juros;
                                
                //cadastra o lançamento
                $lancamentoBusiness = $this->Factory->createBusiness("fin_lancamentos_pagar");
                $id_lancamento = $lancamentoBusiness->baixa($dadosLanc);

               
                //editar dados conta
                
                $dadosConta['id_conta'] = $dados['id_conta'];
                $dadosConta['id_fornecedor'] = $dados['id_fornecedor'];
                $dadosConta['id_plano'] = $dados['id_plano'];
                $dadosConta['data'] = $objDateFormat->date_mysql($dados['data']);
                $dadosConta['numero_nf'] = $dados['numero_nf'];
                
                if($dados['id_custo']!=""){
                $dadosConta['id_custo'] = $dados['id_custo']; 
                }
                else{
                    $dadosConta['id_custo'] = null; 
                }


                $contaBusiness = $this->Factory->createBusiness("fin_contas_pagar");
                $id_conta = $contaBusiness->editar_tela_lanc($dadosConta);


                $msg = true;
                redirect('contas_pagar/editar/'.$dadosLanc['id_lancamento'].'/'.$msg);
                
           }
      }


      //EDIÇÃO
      public function baixa($id_lanc,$msg=null){
          $this->load->helper(array('form','url'));
          $this->load->library('form_validation');
          
          $this->RulesBaixa();
          
          if($this->form_validation->run()==FALSE){
              
              //Fornecedores
            $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
            $listFornecedor = $fornecedorBusiness->filtro();
            $info["listFornecedor"] = $listFornecedor;
           
            //Centro de custos
            $custoBusiness = $this->Factory->createBusiness("fin_centro_custos");
            $listCustos = $custoBusiness->filtro();
            $info["listCusto"] = $listCustos;

              //FORMA DE PAGAMENTO
            $formasBusiness = $this->Factory->createBusiness("fin_formas_pagamentos");
            
            $listFormas = $formasBusiness->filtro();
            $info['listForma'] = $listFormas;

             //Conta Banco
            $conta_bancoBusiness = $this->Factory->createBusiness("fin_contas_banco");
            $listContasBanco = $conta_bancoBusiness->filtro();
            $info["listContaBanco"] = $listContasBanco;
            
              
            $lancBusiness = $this->Factory->createBusiness("fin_lancamentos_pagar");
            $objLanc = $lancBusiness->visualizar($id_lanc);
            $info["objLanc"] = $objLanc;

            $listLanc = $lancBusiness->listar_por_conta($objLanc->getId_conta());
            $info['listLanc'] = $listLanc;

            $info['msg'] = $msg;

            $content = $this->load->view("contas_pagar/baixa",$info,TRUE);
            $this->loadPage($content);
              
           }
           
           else{
                 error_reporting(0);
                $dados = $this->input->post();

                   //imagem
                $config['upload_path'] = './doc/';//Caminho onde será salvo
                $config['allowed_types'] = 'pdf|doc|docx|xls|xlsx|jpeg|png|JPG|JPEG|gif|jpg|zip|rar';//Tipos de imagem aceito
                $config['max_size'] = '4096';//Tamanho - Aqui aceitamos até 2 Mb
                $config['overwrite']  = FALSE;//Não irá sobre-escrever o arquivo
                $config['encrypt_name'] = TRUE;//Trocará o nome do arquivo para um HASH - TRUE PADRÃO
               
                $field_name1 = "arquivo";// Nome do campo INPUT do formulário                         
                $this->load->library('upload');
                $this->upload->initialize($config);

               if($_FILES['arquivo']['error'] != 4){ 
                   
                    $this->upload->initialize($config);

                    if(!$this->upload->do_upload($field_name1))
                    {
                    $error = array('erro' => $this->upload->display_errors());
                    echo "<script>alert('Verifique o tamanho ou formato da imagem')</script>";
                    echo "<script>window.history.back();</script>";
                  
                    }


                    $dadosUp = $this->upload->data();
                    $dadosLanc['arquivo'] = $dadosUp['file_name'];
                    unset($dados['arquivo_atual']);
               }
                 else{
                     $dadosLanc['arquivo'] = $dados['arquivo_atual'];
                     unset($dados['arquivo_atual']);

               }
               //final imagem
                
                $objDateFormat = $this->DateFormat;
                
                $dadosLanc['data_vencimento'] = $objDateFormat->date_mysql($dados['data_vencimento']);
                
                $dadosLanc['data_pagamento'] = $objDateFormat->date_mysql($dados['data_pagamento']);
                 
                //if($dadosLanc['data_pagamento']!=NULL){
                   //  $dadosLanc['status'] = PAGO;
                 //}
                
                $multa_juros = 0;
                //calcula os juros + multa com o valor total
                $multa_juros = $dados['multa'] + $dados['juros'];
                $dadosLanc['multa'] = $dados['multa'];
                $dadosLanc['juros'] = $dados['juros'];
                $dadosLanc['valor_titulo'] = $dados['valor_titulo'] + $multa_juros;
                $dadosLanc['status'] = PAGO;
                $dadosLanc['id_lancamento'] = $dados['id_lancamento'];
                 $dadosLanc['id_forma'] = $dados['id_forma'];
                $dadosLanc['id_conta_banco'] = $dados['id_conta_banco'];
                $dadosLanc['descricao'] = $dados['descricao'];
                                
                //cadastra o lançamento
                $lancamentoBusiness = $this->Factory->createBusiness("fin_lancamentos_pagar");
                $id_lancamento = $lancamentoBusiness->baixa($dadosLanc);

                //editar dados conta
                $dadosConta['id_conta'] = $dados['id_conta'];
                $dadosConta['descricao'] = $dados['descricao'];
                $dadosConta['id_fornecedor'] = $dados['id_fornecedor'];
                
                if($dados['id_custo']!=""){
                $dadosConta['id_custo'] = $dados['id_custo']; 
                }
                else{
                    $dadosConta['id_custo'] = null; 
                }


                $contaBusiness = $this->Factory->createBusiness("fin_contas_pagar");
                $id_conta = $contaBusiness->editar_tela_lanc($dadosConta);


                $msg = true;
                redirect('contas_pagar/editar/'.$dadosLanc['id_lancamento'].'/'.$msg);
                
           }
      }

      


      //EXCLUSÃO
      public function excluir($id_lancamento){
          $this->load->helper(array('form','url'));

          $contaBusiness = $this->Factory->createBusiness("fin_lancamentos_pagar");
          $contaBusiness->excluir($id_lancamento);
          redirect("contas_pagar/filtro");
      }


       public function ajax_lancamentos_vencidos(){
          $this->load->helper(array('form','url'));

          $contaBusiness = $this->Factory->createBusiness("fin_lancamentos_pagar");
          $listLanc = $contaBusiness->lancamentos_vencidos();

          $objDateFormat = $this->DateFormat;

           foreach ($listLanc as $objLanc){

            

            
                $list[] = array(
               'id_lancamento'   => $objLanc->getId_lancamento(),
               'data_vencimento'   => $objDateFormat->date_format($objLanc->getData_vencimento()),
               'descricao'      => $objLanc->getDescricao(),
               'natureza'      => $objLanc->getConta()->getPlano()->getNome(),
               'valor_titulo'      => number_format($objLanc->getValor_titulo(), 2, ',', '.'),
               'fornecedor'      =>  $objLanc->getConta()->getFornecedor()->getNome_fantasia(),
               
               

               );
                  
          }

         echo json_encode($list);


          
      }
      
      
}
?>
