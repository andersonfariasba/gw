<?php
/* Classe(controller): Cargos colaboradores
 * Autor: Anderson Farias
 * Última atualização: 23/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Relatorio_Locacao extends MY_Controller {
	
    //VALIDA��O
    private function Rules(){
        $this->form_validation->set_rules('cargo','Cargo','required');
        $this->form_validation->set_error_delimiters('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');
    }


    //RELATORIOS


       



       public function menu(){
            $this->load->helper(array('form','url'));

            $info = null;
            $content = $this->load->view("relatorio_pedido/menu",$info,TRUE);
            $this->loadPage($content);

       }

       
        // pedido detalhado
        public function pedidos_detalhado($dados=null) {

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('mpdf'); //carrega a biblioteca mpdf que está em aplication/libraries/mpdf

        if ($this->input->post() == NULL) {

             $info = "";

                     

            $content = $this->load->view('relatorio_Locacao/entrada_pedido', $info, TRUE);
            $this->loadPage($content);
       
            } else {

            
            $dados = $this->input->post();
            
         
            $tipo = PEDIDO; 

            //Pedidos
            $pedidosBusiness = $this->Factory->createBusiness("com_pedidos");
            $listPedido = $pedidosBusiness->filtro_loc($tipo,$dados);
            $info["listPedidos"] = $listPedido;

            
            $content = $this->load->view('relatorio_locacao/pedidos_pdf', $info, TRUE);

            $this->mpdf->setFooter('{PAGENO}'); //numero de paginas
            $this->mpdf->WriteHTML($content); // Converte os dados html para pdf
            $this->mpdf->Output(); //gera
            
            //$content = $this->load->view('financeiro/filtroPagar',$info, TRUE);
            //$this->loadPage($content);
       
        }
    }


    // pedido detalhado
        public function entrega($dados=null) {

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('mpdf'); //carrega a biblioteca mpdf que está em aplication/libraries/mpdf

        if ($this->input->post() == NULL) {

             $info = "";

                 

            $content = $this->load->view('relatorio_Locacao/entrada_pedido', $info, TRUE);
            $this->loadPage($content);
       
            } else {

            
            $dados = $this->input->post();
            
         
            $categoriaBusiness = $this->Factory->createBusiness("com_pedidos");
            $listCategoria = $categoriaBusiness->filtro_entrega($dados);
            $info['listItens'] = $listCategoria;

            
            $content = $this->load->view('relatorio_locacao/entregas_pdf', $info, TRUE);

            $this->mpdf->setFooter('{PAGENO}'); //numero de paginas
            $this->mpdf->WriteHTML($content); // Converte os dados html para pdf
            $this->mpdf->Output(); //gera
            
            //$content = $this->load->view('financeiro/filtroPagar',$info, TRUE);
            //$this->loadPage($content);
       
        }
    }



    // pedido detalhado
        public function orcamentos_detalhado($dados=null) {

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('mpdf'); //carrega a biblioteca mpdf que está em aplication/libraries/mpdf

        if ($this->input->post() == NULL) {

             $info = "";

                     

            $content = $this->load->view('relatorio_pedido/entrada_pedido', $info, TRUE);
            $this->loadPage($content);
       
            } else {

            
            $dados = $this->input->post();
            
         
            $tipo = ORCAMENTO; 

            //Pedidos
            $pedidosBusiness = $this->Factory->createBusiness("com_pedidos");
            $listPedido = $pedidosBusiness->filtro($tipo,$dados);
            $info["listPedidos"] = $listPedido;

            
            $content = $this->load->view('relatorio_pedido/orcamentos_pdf', $info, TRUE);

            $this->mpdf->setFooter('{PAGENO}'); //numero de paginas
            $this->mpdf->WriteHTML($content); // Converte os dados html para pdf
            $this->mpdf->Output(); //gera
            
            //$content = $this->load->view('financeiro/filtroPagar',$info, TRUE);
            //$this->loadPage($content);
       
        }
    }





  
   
      
      
}
?>
