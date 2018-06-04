<?php
/* Classe(controller): Cargos colaboradores
 * Autor: Anderson Farias
 * Última atualização: 23/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Relatorio_financeiro extends MY_Controller {
	
    //VALIDA��O
    private function Rules(){
        $this->form_validation->set_rules('cargo','Cargo','required');
        $this->form_validation->set_error_delimiters('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');
    }


    //RELATORIOS


        public function teste($dados=null){
            $this->load->helper(array('form','url'));

            $contasBusiness = $this->Factory->createBusiness("fin_contas");
            $listConta = $contasBusiness->filtro_contas_cartao($dados);

            print_r($listConta);
           
             
    }



       public function menu(){
            $this->load->helper(array('form','url'));

            $info = null;
            $content = $this->load->view("relatorio_financeiro/menu",$info,TRUE);
            $this->loadPage($content);

       }


       // CONTAS A RECEBER
        public function caixa($dados=null) {

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('mpdf'); //carrega a biblioteca mpdf que está em aplication/libraries/mpdf

        if ($this->input->post() == NULL) {

            $info = "";           
                      

            $content = $this->load->view('relatorio_painel/menu', $info, TRUE);
            $this->loadPage($content);
       
            } else {

            
            $dados = $this->input->post();
            
         
            //Recebimenos
            $lancBusiness = $this->Factory->createBusiness("fin_contas_receber");
            $listLanc = $lancBusiness->filtro_agrupar_forma($dados);
            
            $info['listLanc'] = $listLanc;
            $info['data_de'] = $dados['data_de'];
            $info['data_ate'] = $dados['data_ate'];

            //Abertura de Caixa
            $categoriaBusiness = $this->Factory->createBusiness("fin_caixa_abertura");
            $listCategoria = $categoriaBusiness->filtro($dados);
            $info['listCaixa'] = $listCategoria;

           //Sangria
            $sangriaBusiness = $this->Factory->createBusiness("fin_caixa_sangria");
            $listSangria = $sangriaBusiness->filtro($dados);
            $info['listSangria'] = $listSangria;

            //Reforço
            $reforcoBusiness = $this->Factory->createBusiness("fin_caixa_reforco");
            $listReforco = $reforcoBusiness->filtro($dados);
            $info['listReforco'] = $listReforco;

            



            //$this->load->view('relatorio_financeiro/contas_receber_cartao_pdf', $info);
            $content = $this->load->view('relatorio_financeiro/caixa_pdf', $info, TRUE);
           
            $this->mpdf->setFooter('{PAGENO}'); //numero de paginas
            $this->mpdf->WriteHTML($content); // Converte os dados html para pdf
            $this->mpdf->Output(); //gera
            
          
       
        }
    }
    

        
        // CONTAS A PAGAR
        public function contas_pagar($dados=null) {

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('mpdf'); //carrega a biblioteca mpdf que está em aplication/libraries/mpdf

        if ($this->input->post() == NULL) {

           $info = "";
            

            $content = $this->load->view('relatorio_financeiro/entrada_contas_pagar', $info, TRUE);
            $this->loadPage($content);
       
            } else {

            
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


               //FORMA DE PAGAMENTO
            $formasBusiness = $this->Factory->createBusiness("fin_formas_pagamentos");
            $dados['disponivel'] = FORMA_CONTA_PAGAR;
            $listFormas = $formasBusiness->filtro($dados);
            $info['listForma'] = $listFormas;
            
            $lancamentosBusiness = $this->Factory->createBusiness("fin_lancamentos_pagar");
            $listLanc = $lancamentosBusiness->filtro($dados);
            $info['listLanc'] = $listLanc;
            $content = $this->load->view('relatorio_financeiro/contas_pagar_pdf', $info, TRUE);

            $this->mpdf->setFooter('{PAGENO}'); //numero de paginas
            $this->mpdf->WriteHTML($content); // Converte os dados html para pdf
            $this->mpdf->Output(); //gera
            
            //$content = $this->load->view('financeiro/filtroPagar',$info, TRUE);
            //$this->loadPage($content);
       
        }
    }



        // CONTAS A RECEBER
        public function contas_receber($dados=null) {

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('mpdf'); //carrega a biblioteca mpdf que está em aplication/libraries/mpdf

        if ($this->input->post() == NULL) {

            $info = "";
            

            $content = $this->load->view('relatorio_financeiro/entrada_contas_receber', $info, TRUE);
            $this->loadPage($content);
       
            } else {

            
            $dados = $this->input->post();
            
         
             //Fornecedores
            $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
            $listFornecedor = $fornecedorBusiness->filtro();
            $info["listFornecedor"] = $listFornecedor;
           
            //Centro de custos
            $custoBusiness = $this->Factory->createBusiness("fin_centro_custos");
            $listCustos = $custoBusiness->filtro();
            $info["listCusto"] = $listCustos;
           

               //FORMA DE PAGAMENTO
            $formasBusiness = $this->Factory->createBusiness("fin_formas_recebimentos");
            $dados['disponivel'] = FORMA_CONTA_RECEBER;
            $listFormas = $formasBusiness->filtro($dados);
            $info['listForma'] = $listFormas;
            
            $lancamentosBusiness = $this->Factory->createBusiness("fin_lancamentos_receber");
            $listLanc = $lancamentosBusiness->filtro($dados);
            $info['listLanc'] = $listLanc;
            //$this->load->view('relatorio_financeiro/contas_receber_pdf', $info);
            $content = $this->load->view('relatorio_financeiro/contas_receber_pdf', $info, TRUE);
            $this->mpdf->setFooter('{PAGENO}'); //numero de paginas
            $this->mpdf->WriteHTML($content); // Converte os dados html para pdf
            $this->mpdf->Output(); //gera
            
          
       
        }
    }



    // CONTAS A RECEBER
        public function contas_receber_agrupado($dados=null) {

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('mpdf'); //carrega a biblioteca mpdf que está em aplication/libraries/mpdf

        if ($this->input->post() == NULL) {

            $info = "";           
                      

            $content = $this->load->view('relatorio_financeiro/entrada_contas_receber_cartao', $info, TRUE);
            $this->loadPage($content);
       
            } else {

            
            $dados = $this->input->post();
            
         
            $lancBusiness = $this->Factory->createBusiness("fin_contas_receber");
            $listLanc = $lancBusiness->filtro_agrupar_forma($dados);
            
            $info['listLanc'] = $listLanc;
            $info['data_de'] = $dados['data_de'];
            $info['data_ate'] = $dados['data_ate'];

            //$this->load->view('relatorio_financeiro/contas_receber_cartao_pdf', $info);
            $content = $this->load->view('relatorio_financeiro/contas_receber_agrupado_pdf', $info, TRUE);
           
            $this->mpdf->setFooter('{PAGENO}'); //numero de paginas
            $this->mpdf->WriteHTML($content); // Converte os dados html para pdf
            $this->mpdf->Output(); //gera
            
          
       
        }
    }
    

     // CONTAS A RECEBER
        public function contas_receber_resumo($dados=null) {

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('mpdf'); //carrega a biblioteca mpdf que está em aplication/libraries/mpdf

        if ($this->input->post() == NULL) {

             //Fornecedores
            $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
            $listFornecedor = $fornecedorBusiness->filtro();
            $info["listFornecedor"] = $listFornecedor;
           
            //Centro de custos
            $custoBusiness = $this->Factory->createBusiness("fin_centro_custos");
            $listCustos = $custoBusiness->filtro();
            $info["listCusto"] = $listCustos;
            $tipo = CONTAS_RECEBER;


               //FORMA DE PAGAMENTO
            $formasBusiness = $this->Factory->createBusiness("fin_formas_pagamentos");
            $dados['disponivel'] = FORMA_CONTA_RECEBER;
            $listFormas = $formasBusiness->filtro($dados);
            $info['listForma'] = $listFormas;
            
                      

            $content = $this->load->view('relatorio_financeiro/entrada_contas_receber_resumo', $info, TRUE);
            $this->loadPage($content);
       
            } else {

            
            $dados = $this->input->post();
            
         
             //Fornecedores
            $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
            $listFornecedor = $fornecedorBusiness->filtro();
            $info["listFornecedor"] = $listFornecedor;
           
            //Centro de custos
            $custoBusiness = $this->Factory->createBusiness("fin_centro_custos");
            $listCustos = $custoBusiness->filtro();
            $info["listCusto"] = $listCustos;
            $tipo = CONTAS_RECEBER;


               //FORMA DE PAGAMENTO
            $formasBusiness = $this->Factory->createBusiness("fin_formas_pagamentos");
            $dados['disponivel'] = FORMA_CONTA_RECEBER;
            $listFormas = $formasBusiness->filtro($dados);
            $info['listForma'] = $listFormas;
            
            $lancamentosBusiness = $this->Factory->createBusiness("fin_contas");
            $listLanc = $lancamentosBusiness->filtro_recebimento_resumo($dados);
            $info['listLanc'] = $listLanc;
            $this->load->view('relatorio_financeiro/contas_receber_resumo_pdf', $info);
            //$content = $this->load->view('relatorio_financeiro/contas_receber_pdf', $info, TRUE);
            //$this->mpdf->setFooter('{PAGENO}'); //numero de paginas
            //$this->mpdf->WriteHTML($content); // Converte os dados html para pdf
            //$this->mpdf->Output(); //gera
            
          
       
        }
    }


    // CONTAS A RECEBER
        public function comissao_venda($dados=null) {

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('mpdf'); //carrega a biblioteca mpdf que está em aplication/libraries/mpdf

        if ($this->input->post() == NULL) {

            $userBusiness = $this->Factory->createBusiness("acesso_usuarios");
            $listUser = $userBusiness->filtro(null);
            $info['listUser'] = $listUser;        
                      

            $content = $this->load->view('relatorio_financeiro/entrada_comissao_venda', $info, TRUE);
            $this->loadPage($content);
       
            } else {

            
            $dados = $this->input->post();
            
         
            $colaboradorBusiness = $this->Factory->createBusiness("fin_comissao");
            $list = $colaboradorBusiness->filtro($dados);
            
            $info['listLanc'] = $list;
            $info['data_de'] = $dados['data_de'];
            $info['data_ate'] = $dados['data_ate'];

            //$this->load->view('relatorio_financeiro/contas_receber_cartao_pdf', $info);
            $content = $this->load->view('relatorio_financeiro/comissao_venda_pdf', $info, TRUE);
           
            $this->mpdf->setFooter('{PAGENO}'); //numero de paginas
            $this->mpdf->WriteHTML($content); // Converte os dados html para pdf
            $this->mpdf->Output(); //gera
            
          
       
        }
    }



      // CONTAS A RECEBER
        public function resumo_financeiro($dados=null) {

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('mpdf'); //carrega a biblioteca mpdf que está em aplication/libraries/mpdf

        if ($this->input->post() == NULL) {

            $userBusiness = $this->Factory->createBusiness("acesso_usuarios");
            $listUser = $userBusiness->filtro(null);
            $info['listUser'] = $listUser;        
                      

            $content = $this->load->view('relatorio_financeiro/entrada_comissao_venda', $info, TRUE);
            $this->loadPage($content);
       
            } else {

            
            $dados = $this->input->post();
            
         
            $crBusiness = $this->Factory->createBusiness("fin_contas_receber");
            $listCr = $crBusiness->resumo_conta_receber($dados);

             $cpBusiness = $this->Factory->createBusiness("fin_contas_pagar");
            $listCp = $cpBusiness->resumo_conta_pagar($dados);
             
             $info['recebimentos'] = "";
              $info['pagamentos'] = "";
             //Total Recebimentos
             foreach ($listCr as $objCr):
              $info['recebimentos'] =  $objCr['valor'];
             endforeach; 

              foreach ($listCp as $objCp):
              $info['pagamentos'] =  $objCp['valor'];
             endforeach; 
            
            //$info['listCr'] = $listCr;

            //print_r($listCr);

            $info['data_de'] = $dados['data_de'];
            $info['data_ate'] = $dados['data_ate'];

            //$this->load->view('relatorio_financeiro/contas_receber_cartao_pdf', $info);
           $content = $this->load->view('relatorio_financeiro/resumo_financeiro_pdf', $info, TRUE);
           
            $this->mpdf->setFooter('{PAGENO}'); //numero de paginas
            $this->mpdf->WriteHTML($content); // Converte os dados html para pdf
            $this->mpdf->Output(); //gera
            
          
       
        }
    }
    


    






    
    
    
   
      
      
}
?>
