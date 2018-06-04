<?php
/* Classe(controller): Contas pagar
 * Autor: Anderson Farias
 * Última atualização: 04/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Contas_receber extends MY_Controller {
	
       
    
    private function RulesEditar(){
        $this->form_validation->set_rules('data_vencimento','Data vencimento','required');
        //$this->form_validation->set_rules('id_forma','Forma de Recebimento','required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"  id="msgOk">
<strong><i class="fa fa-check"></i></strong> ', '</div>');
    }

      private function RulesCadastrar(){
        $this->form_validation->set_rules('id_cliente','Cliente','required');
        //$this->form_validation->set_rules('id_custo','Centro de custo','required');
        $this->form_validation->set_rules('data_vencimento','Data vencimento','required');
         $this->form_validation->set_rules('descricao','Descrição','required');
        $this->form_validation->set_error_delimiters('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');
    }



   
    public function cadastrar($msg=null){
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
        $this->RulesCadastrar();
      
        
        if($this->form_validation->run()==FALSE){
            //Fornecedores
            $clienteBusiness = $this->Factory->createBusiness("com_clientes");
            $listCliente = $clienteBusiness->filtro();
            $info["listCliente"] = $listCliente;

           
           
           $custoBusiness = $this->Factory->createBusiness("fin_centro_custos");
            $listCustos = $custoBusiness->filtro();
            $info["listCusto"] = $listCustos;

             //FORMA DE PAGAMENTO
            $formasBusiness = $this->Factory->createBusiness("fin_formas_recebimentos");
            $listFormas = $formasBusiness->filtro();
            $info['listForma'] = $listFormas;
           
             $info['msg'] = $msg; 


            $content = $this->load->view("contas_receber/cadastrar",$info,TRUE);
            $this->loadPage($content);
        }
          
          else{

             error_reporting(0);
            $dados = $this->input->post();
            //$dados['tipo'] = CONTAS_RECEBER_MANUAL;

             //Operação contas a pagar
            $dados['data'] = date('Y-m-d');
            $dados['valor_total'] = $dados["valor"]; //str_replace(",",".",str_replace(".","",$dados['valor']));
 //$dados["valor"];
            //se for não parcelado setar a qtd da parcela para contas como zero
            if($dados['repetir_conta']==null){
                $dados['parcela_qtd'] = 1;
                 
            }

            $objDateFormat = $this->DateFormat;

            if($dados['pagamento_realizado']!=null){
              $dadosLanc['status'] = PAGO;
              $dadosLanc['data_pagamento'] = $objDateFormat->date_mysql($dados['data_pagamento']);
            }else{
               $dadosLanc['status'] = ABERTO;
            }
                    
            
            //cadastra a conta
            $contaBusiness = $this->Factory->createBusiness("fin_contas_receber");
            $id_conta = $contaBusiness->cadastrar($dados);

            $dadosLanc['id_conta'] = $id_conta;
            $dadosLanc['id_forma'] = $dados['id_forma'];
            $dadosLanc['observacao'] = $dados['observacao'];
            $dadosLanc['descricao'] = $dados['descricao'];


             $nParcelas = $dados['parcela_qtd'];
             $dias = 31;
             
             for($x = 0; $x < $nParcelas; $x++){

               $total_dias = $dias * $x;
              
            
              $vencimento = $objDateFormat->date_mysql($dados['data_vencimento']);
              $dadosLanc['data_vencimento'] = date('Y-m-d', strtotime("+$total_dias days",strtotime($vencimento)));
              
              $dadosLanc['valor_titulo'] = $dados["valor"]; //str_replace(",",".",str_replace(".","",$dados['valor']));
              $dadosLanc["parcela"] = $x+1;
             

              $lancamentoBusiness = $this->Factory->createBusiness("fin_lancamentos_receber");
              $id_lancamento = $lancamentoBusiness->cadastrar($dadosLanc);
                
            }


             $msg = true;
            
            redirect('contas_receber/cadastrar/'.$msg);

            
            }

    }

    


    //LISTAGEM
    public function filtro($dados=null){
        try {
            $this->load->helper(array('form','url'));
            
            if ($this->input->post() == NULL) {
            
            //Listagem de Clientes
            $clientesBusiness = $this->Factory->createBusiness("com_clientes");
            $listCliente = $clientesBusiness->listar_cliente_orcamento();
            $info['listCliente'] = $listCliente;
           
                       
            $lancamentosBusiness = $this->Factory->createBusiness("fin_lancamentos_receber");
            $listLanc = $lancamentosBusiness->filtro(null);
            $info['listLanc'] = $listLanc;

              //FORMA DE PAGAMENTO
            $formasBusiness = $this->Factory->createBusiness("fin_formas_recebimentos");
            //$dadosRec['disponivel'] = FORMA_CONTA_RECEBER;
            $listFormas = $formasBusiness->filtro();
            $info['listForma'] = $listFormas;
            
            $content = $this->load->view("contas_receber/filtro",$info,TRUE);
            $this->loadPage($content);

            }else{
            
            $dados = $this->input->post();
            
             //Listagem de Clientes
            $clientesBusiness = $this->Factory->createBusiness("com_clientes");
            $listCliente = $clientesBusiness->listar_cliente_orcamento();
            $info['listCliente'] = $listCliente;
           
                    
            $tipo = CONTAS_RECEBER;
            $lancamentosBusiness = $this->Factory->createBusiness("fin_lancamentos_receber");
            $listLanc = $lancamentosBusiness->filtro($dados);
            $info['listLanc'] = $listLanc;

              //FORMA DE PAGAMENTO
            $formasBusiness = $this->Factory->createBusiness("fin_formas_recebimentos");
            //$dadosRec['disponivel'] = FORMA_CONTA_RECEBER;
            $listFormas = $formasBusiness->filtro();
            $info['listForma'] = $listFormas;
            	
            $content = $this->load->view("contas_receber/filtro",$info,TRUE);
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
            $info["listForncedor"] = $listFornecedor;
           
            //Centro de custos
            $custoBusiness = $this->Factory->createBusiness("fin_centro_custos");
            $listCustos = $custoBusiness->filtro();
            $info["listCusto"] = $listCustos;
            
              
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
              
              //Fornecedores
            /*$fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
            $listFornecedor = $fornecedorBusiness->filtro();
            $info["listForncedor"] = $listFornecedor;*/

            $clienteBusiness = $this->Factory->createBusiness("com_clientes");
            $listCliente = $clienteBusiness->filtro();
            $info["listCliente"] = $listCliente;

           
            //Centro de custos
            $custoBusiness = $this->Factory->createBusiness("fin_centro_custos");
            $listCustos = $custoBusiness->filtro();
            $info["listCusto"] = $listCustos;

            //FORMA DE PAGAMENTO
            $formasBusiness = $this->Factory->createBusiness("fin_formas_recebimentos");
            
            $listFormas = $formasBusiness->filtro();
            $info['listForma'] = $listFormas;
             
            //BANDEIRA CARTÃO 
            $bandeiraBusiness = $this->Factory->createBusiness("fin_bandeira_cartao");
            $listBandeira = $bandeiraBusiness->filtro(null);
            $info['listBandeira'] = $listBandeira;

              //Conta Banco
            $conta_bancoBusiness = $this->Factory->createBusiness("fin_contas_banco");
            $listContasBanco = $conta_bancoBusiness->filtro();
            $info["listContaBanco"] = $listContasBanco;
            
              
            $lancBusiness = $this->Factory->createBusiness("fin_lancamentos_receber");
            $objLanc = $lancBusiness->visualizar($id_lanc);
            $info["objLanc"] = $objLanc;

            
            $listLanc = $lancBusiness->listar_por_pedido($objLanc->getConta()->getId_pedido());
            $info['listLanc'] = $listLanc;

            $info['msg'] = $msg;

            $content = $this->load->view("contas_receber/editar",$info,TRUE);
            $this->loadPage($content);
              
           }
           


           else{
           	
                error_reporting(0);
                $dadosLanc = $this->input->post();
                
                $objDateFormat = $this->DateFormat;
                $dadosLanc['data_vencimento'] = $objDateFormat->date_mysql($dadosLanc['data_vencimento']);
                $dadosLanc['data_pagamento'] = $objDateFormat->date_mysql($dadosLanc['data_pagamento']);

                if($dadosLanc['id_conta_banco']==""){
                  $dadosLanc['id_conta_banco'] = null;
                }
                 
                /*if($dadosLanc['data_pagamento']!=NULL){
                     $dadosLanc['status'] = PAGO;
                 }*/
                
                //$multa_juros = 0;
                //calcula os juros + multa com o valor total
                //$multa_juros = $dadosLanc['multa'] + $dadosLanc['juros'];
                //$dadosLanc['valor_titulo'] = $dadosLanc['valor_titulo'] + $multa_juros;
                                
                //cadastra o lançamento
                $lancamentoBusiness = $this->Factory->createBusiness("fin_lancamentos_receber");
                $id_lancamento = $lancamentoBusiness->editar($dadosLanc);
                $msg = true;
                redirect('contas_receber/editar/'.$dadosLanc['id_lancamento'].'/'.$msg);
                
           }
      }

      //EXCLUSÃO
      public function excluir($id_lancamento){
          $this->load->helper(array('form','url'));

          $contaBusiness = $this->Factory->createBusiness("fin_lancamentos_receber");
          $contaBusiness->excluir($id_lancamento);
          redirect("contas_receber/filtro");
      }




      //ALTERAR FORMA DE PAGAMENTO
      public function alterar_forma_pagamento(){
          $this->load->helper(array('form','url'));

          $dadosForm = $this->input->post();
         
          $dados['id_lancamento'] = $dadosForm['id_lancamento'];
          $dados['id_forma'] = $dadosForm['id_forma_modal'];
          $dados['id_bandeira'] = $dadosForm['id_bandeira_modal'];
          $dados['status'] = $dadosForm['status_modal'];
        
           
         $lancBusiness = $this->Factory->createBusiness("fin_lancamentos");
         $lancBusiness->alterar_forma_pagamento($dados);

    }


      //ALTERAR FORMA DE PAGAMENTO
      public function teste(){
          $this->load->helper(array('form','url'));

                  
         $lancBusiness = $this->Factory->createBusiness("fin_lancamentos_receber");
         $listLanc = $lancBusiness->total_recebimento();
         echo $listLanc;
         //print_r($listLanc);


    }

      
      
}
?>
