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
         $this->form_validation->set_rules('descricao','Descrição','required');
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
            $contaBusiness = $this->Factory->createBusiness("fin_contas_pagar");
            $id_conta = $contaBusiness->cadastrar($dados);

            $dadosLanc['id_conta'] = $id_conta;
            $dadosLanc['id_forma'] = $dados['id_forma'];
            $dadosLanc['observacao'] = $dados['observacao'];

             $nParcelas = $dados['parcela_qtd'];
             $dias = 31;
             
             for($x = 0; $x < $nParcelas; $x++){

               $total_dias = $dias * $x;
              
            
              $vencimento = $objDateFormat->date_mysql($dados['data_vencimento']);
              $dadosLanc['data_vencimento'] = date('Y-m-d', strtotime("+$total_dias days",strtotime($vencimento)));
              
              $dadosLanc['valor_titulo'] = $dados["valor"]; //str_replace(",",".",str_replace(".","",$dados['valor']));
              $dadosLanc["parcela"] = $x+1;
             

              $lancamentoBusiness = $this->Factory->createBusiness("fin_lancamentos_pagar");
              $id_lancamento = $lancamentoBusiness->cadastrar($dadosLanc);
                
            }


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
           
            //Centro de custos
            $custoBusiness = $this->Factory->createBusiness("fin_centro_custos");
            $listCustos = $custoBusiness->filtro();
            $info["listCusto"] = $listCustos;
            $tipo = CONTAS_PAGAR;


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
            
           
              //Fornecedores
            $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
            $listFornecedor = $fornecedorBusiness->filtro();
            $info["listFornecedor"] = $listFornecedor;
           
            //Centro de custos
            $custoBusiness = $this->Factory->createBusiness("fin_centro_custos");
            $listCustos = $custoBusiness->filtro();
            $info["listCusto"] = $listCustos;
                    
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
                $lancamentoBusiness = $this->Factory->createBusiness("fin_lancamentos_pagar");
                $id_lancamento = $lancamentoBusiness->editar($dadosLanc);

                //editar dados conta
                $dadosConta['id_conta'] = $dadosLanc['id_conta'];
                $dadosConta['descricao'] = $dadosLanc['descricao'];
                $dadosConta['id_fornecedor'] = $dadosLanc['id_fornecedor'];
                
                if($dadosLanc['id_custo']!=""){
                $dadosConta['id_custo'] = $dadosLanc['id_custo']; 
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
      
      
}
?>
