<?php

/* Classe(controller): Faturamento
 * Autor: Anderson Farias
 * Última atualização: 11/10/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Faturamento extends MY_Controller {
	
    //VALIDAÇÃO
    private function Rules(){
        $this->form_validation->set_rules('categoria','Categoria','required');
        $this->form_validation->set_error_delimiters('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');
    }


     //faturar
      public function alterar_status($id_pedido){
          $this->load->helper(array('form','url'));

          $dadosFat['desconto'] = 0;
          $dadosFat['taxa_frete'] = 0;

          $dados = $this->input->post();

          $dadosFat['id_pedido'] = $id_pedido;
          $dadosFat['desconto'] = $dados['desconto'];
          $dadosFat['taxa_frete'] = $dados['taxa_frete'];
          $total_pedido = $dados['total_pedido'];
          $dadosFat['valor_total'] = ($total_pedido + $dadosFat['taxa_frete']) - $dadosFat['desconto'];
          $dadosFat['observacao'] = $dados['observacao'];

         // $pedidoBusiness = $this->Factory->createBusiness("com_pedidos");
          //$pedidoBusiness->confirmar_orcamento($dados);

          //redirect("pedidos/filtro/".ORCAMENTO);

          print_r($dadosFat);
      }



    
    

     
      
      
}
?>
