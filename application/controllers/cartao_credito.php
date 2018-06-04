<?php
/* Classe(controller): Contas pagar
 * Autor: Anderson Farias
 * Última atualização: 04/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Cartao_credito extends MY_Controller {
	
    //VALIDAÇÃO
    private function RulesCadastrar(){
        $this->form_validation->set_rules('id_fornecedor','Fornecedor','required');
        //$this->form_validation->set_rules('id_custo','Centro de custo','required');
        $this->form_validation->set_rules('data_vencimento','Data vencimento','required');
         $this->form_validation->set_rules('descricao','Descrição','required');
        $this->form_validation->set_error_delimiters('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');
    }
    
    
    private function RulesEditar(){
        $this->form_validation->set_rules('data_vencimento','Data vencimento','required');
         $this->form_validation->set_rules('id_fornecedor','Fornecedor','required');
        $this->form_validation->set_error_delimiters('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');
    }
    
    //CADASTRA
    public function cadastrar($msg=null){
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
        $this->RulesCadastrar();
      
        
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
            $dados['disponivel'] = FORMA_CONTA_PAGAR;
            $listFormas = $formasBusiness->filtro($dados);
            $info['listForma'] = $listFormas;
           
             $info['msg'] = $msg; 


            $content = $this->load->view("contas_pagar/cadastrar",$info,TRUE);
            $this->loadPage($content);
        }
        else{
            
            error_reporting(0);
            $dados = $this->input->post();
            
            
            
            //Operação contas a pagar
            $dados['data'] = date('Y-m-d');
            $dados['valor_total'] = $dados["valor"];
            //se for não parcelado setar a qtd da parcela para contas como zero
            if($dados['parcelado']==NAO && $dados['parcela_qtd']==null){
                $dados['parcela_qtd'] = 1;
            }
            
            //cadastra a conta
            $contaBusiness = $this->Factory->createBusiness("fin_contas");
            $id_conta = $contaBusiness->cadastrar($dados);
            $dadosLanc['id_conta'] = $id_conta;
            $dadosLanc['id_forma'] = $dados['id_forma'];
            
            //TRANSAÇÃO LANÇAMENTO NÃO PARCELADO
           // if($dados["parcelado"]==NAO){
            if($dados['parcela_qtd'] <= 1){
            
                //OBS: Depois de terminar os testes implementar transação para o banco de dados (rolback)
                //Operação Lançamento
                $objDateFormat = $this->DateFormat;
                $dadosLanc['data_vencimento'] = $objDateFormat->date_mysql($dados['data_vencimento']);
                $dadosLanc['data_pagamento'] = $objDateFormat->date_mysql($dados['data_pagamento']);
                $dadosLanc['parcela'] = 1;
                $dadosLanc['multa'] = $dados['multa'];
                $dadosLanc['juros'] = $dados['juros'];
                $multa_juros = 0;
                //calcula os juros + multa com o valor total
                $multa_juros = $dadosLanc['multa'] + $dadosLanc['juros'];
                $dadosLanc['valor_titulo'] = $dados['valor_total'] + $multa_juros;
                $dados['parcela_qtd'] = 1;
                
                if($dados['paga']==NAO){
                 $dadosLanc['status'] = ABERTO;
                }else{
                    $dadosLanc['status'] = PAGO;
                }
                
                //cadastra o lançamento
                $lancamentoBusiness = $this->Factory->createBusiness("fin_lancamentos");
                $id_lancamento = $lancamentoBusiness->cadastrar($dadosLanc);
                
                
                
              } //final if trasação não parcelada
            //FINAL CONTA NÃO PARCELADA
              
              
            //TRANSAÇÃO PARA CONTAS PARCELADAS 
            //if($dados["parcelado"]==SIM){
              if($dados['parcela_qtd'] > 1){
            
                $dadosLanc['valor_titulo'] = $dados['valor'] / $dados['parcela_qtd'];
              
                 for ($nParcela = 1; $nParcela <= $dados['parcela_qtd']; $nParcela++) {
              
                /* Se for o ultimo lancamento */
                /* Altera o valor da ultima parcela para o caso de nao ser uma divisao precisa */
                /*if ($nParcela == $dados['parcela_qtd'] - 1) {
                    
                    $valorTotalParcelado = $dadosLanc["valor_titulo"] * $dados['parcela_qtd'];
                    $dadosLanc["valor_titulo"] = $dadosLanc["valor_titulo"] + ($dados['valor'] - $valorTotalParcelado);
                }*/

                /* Incrementando 1 mes para as parcelas */
                $objDateFormat = $this->DateFormat;
                $dados['data_vencimento'] = $objDateFormat->date_mysql($dados['data_vencimento']);
                $dataInArray = date_parse($dados['data_vencimento']);
                $dataInTime = mktime(0, 0, 0, $dataInArray["month"], $dataInArray["day"], $dataInArray["year"]);
                $dadosLanc["data_vencimento"] = date("Y-m-d", strtotime("+" . $nParcela . " month", $dataInTime));
                $dadosLanc["parcela"] = $nParcela;
                $dadosLanc['status'] = ABERTO;
                $lancamentoBusiness = $this->Factory->createBusiness("fin_lancamentos");
                $id_lancamento = $lancamentoBusiness->cadastrar($dadosLanc);
                
                /*print_r($dados);
                echo "<hr>";
                print_r($dadosLanc);*/
                
              }
                   
             }//final if trasação parcelada
              
              
              $msg = true;
            
               redirect('contas_pagar/cadastrar/'.$msg);
            
          }

    }


    //LISTAGEM
    public function filtro($dados=null){
        try {
            $this->load->helper(array('form','url'));
            
            if ($this->input->post() == NULL) {
            
            //Fornecedores
            $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
            $listFornecedor = $fornecedorBusiness->filtro();
            $info["listFornecedor"] = $listFornecedor;
           
                      
            $lancamentosBusiness = $this->Factory->createBusiness("fin_lanc_cartao");
            $listLanc = $lancamentosBusiness->filtro(null);
            $info['listLanc'] = $listLanc;
            
            $content = $this->load->view("cartao_credito/filtro",$info,TRUE);
            $this->loadPage($content);

            }else {
            
            $dados = $this->input->post();
            
           //Fornecedores
            $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
            $listFornecedor = $fornecedorBusiness->filtro();
            $info["listFornecedor"] = $listFornecedor;
           
                      
            $lancamentosBusiness = $this->Factory->createBusiness("fin_lanc_cartao");
            $listLanc = $lancamentosBusiness->filtro($dados);
            $info['listLanc'] = $listLanc;
            	
            $content = $this->load->view("cartao_credito/filtro",$info,TRUE);
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
            $dados['disponivel'] = FORMA_CONTA_PAGAR;
            $listFormas = $formasBusiness->filtro($dados);
            $info['listForma'] = $listFormas;


             //Conta Banco
            $conta_bancoBusiness = $this->Factory->createBusiness("fin_contas_banco");
            $listContasBanco = $conta_bancoBusiness->filtro();
            $info["listContaBanco"] = $listContasBanco;
            
              
            $lancBusiness = $this->Factory->createBusiness("fin_lancamentos");
            $objLanc = $lancBusiness->visualizar($id_lanc);
            $info["objLanc"] = $objLanc;

            $info['msg'] = $msg;

            $content = $this->load->view("contas_pagar/editar",$info,TRUE);
            $this->loadPage($content);
              
           }
           
           else{
           	
                $dadosLanc = $this->input->post();
                
                $objDateFormat = $this->DateFormat;
                $dadosLanc['data_vencimento'] = $objDateFormat->date_mysql($dadosLanc['data_vencimento']);
                $dadosLanc['data_pagamento'] = $objDateFormat->date_mysql($dadosLanc['data_pagamento']);
                 
                //if($dadosLanc['data_pagamento']!=NULL){
                   //  $dadosLanc['status'] = PAGO;
                 //}
                
                $multa_juros = 0;
                //calcula os juros + multa com o valor total
                $multa_juros = $dadosLanc['multa'] + $dadosLanc['juros'];
                $dadosLanc['valor_titulo'] = $dadosLanc['valor_titulo'] + $multa_juros;
                                
                //cadastra o lançamento
                $lancamentoBusiness = $this->Factory->createBusiness("fin_lancamentos");
                $id_lancamento = $lancamentoBusiness->editar($dadosLanc);

                //editar dados conta
                $dadosConta['id_conta'] = $dadosLanc['id_conta'];
                $dadosConta['descricao'] = $dadosLanc['descricao'];
                $dadosConta['id_fornecedor'] = $dadosLanc['id_fornecedor'];
                
                if($dados['id_custo']!=""){
                $dadosConta['id_custo'] = $dadosLanc['id_custo']; 
                }
                else{
                    $dadosConta['id_custo'] = null; 
                }


                $contaBusiness = $this->Factory->createBusiness("fin_contas");
                $id_conta = $contaBusiness->editar_tela_lanc($dadosConta);


                $msg = true;
                redirect('contas_pagar/editar/'.$dadosLanc['id_lancamento'].'/'.$msg);
                
           }
      }

      //EXCLUSÃO
      public function excluir($id_lancamento){
          $this->load->helper(array('form','url'));

          $contaBusiness = $this->Factory->createBusiness("fin_lancamentos");
          $contaBusiness->excluir($id_lancamento);
          redirect("contas_pagar/filtro");
      }
      
      
}
?>
