<?php
/* Classe(controller): Perfil de usuários
 * Autor: Anderson Farias
 * Última atualização: 23/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Dashboard extends MY_Controller {
	    
    //VALIDA��O
    private function Rules(){
        $this->form_validation->set_rules('perfil','Perfil','required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"  id="msgOk">
<strong><i class="fa fa-check"></i></strong> ', '</div>');
    
    }
    
    
    //VISUALIZAÇÃO
    public function entrada(){
          try {
              
              $this->load->helper(array('form','url'));
              
              $info ="";

               $total_recebimento = 0;
               $total_pagamento = 0;
               $saldo = 0;

               $lancBusiness = $this->Factory->createBusiness("fin_lancamentos_receber");
               $total_recebimento = $lancBusiness->total_recebimento();
               $info['total_recebimento'] = $total_recebimento;
               
               $lancCpBusiness = $this->Factory->createBusiness("fin_lancamentos_pagar");
               $total_pagamento = $lancCpBusiness->total_pagamento();
               $info['total_pagamento'] = $total_pagamento;
               
               $saldo = $total_recebimento - $total_pagamento;
               $info['saldo'] = $saldo;

              $dados['data_de'] = "";//date('Y-m-01'); 
              $dados['data_ate'] = "";//date("Y-m-t");
              //$dados = "";
              $produtosBusiness = $this->Factory->createBusiness("est_produtos");
              $paramDash = SIM;
              $listProdutos = $produtosBusiness->ranking_produto_dash();
              $info['listProdutos'] = $listProdutos;

              $lancCpBusiness = $this->Factory->createBusiness("fin_lancamentos_pagar");
              $listCpVencido = $lancCpBusiness->lancamentos_vencidos_cp(null);
              $info['listCpVencido'] = $listCpVencido;

              $pedidosBusiness = $this->Factory->createBusiness("com_pedidos");
              $listPedidos = $pedidosBusiness->ultimas_vendas();
              $info['listPedidos'] = $listPedidos;





              $content = $this->load->view("dashboard/dashboard",$info,TRUE);
              $this->loadPage($content);

          } catch (Exception $exc) {
              echo $exc->getTraceAsString();
          }

      }

      
      
}
?>
