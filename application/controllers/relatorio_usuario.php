<?php
/* Classe(controller): Cargos colaboradores
 * Autor: Anderson Farias
 * Última atualização: 23/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Relatorio_usuario extends MY_Controller {
	
    //VALIDA��O
    private function Rules(){
        $this->form_validation->set_rules('cargo','Cargo','required');
        $this->form_validation->set_error_delimiters('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');
    }


    //RELATORIOS


       



       public function menu(){
            $this->load->helper(array('form','url'));

            $info = null;
            $content = $this->load->view("relatorio_comercial/menu",$info,TRUE);
            $this->loadPage($content);

       }

        
        // CLIENTES
        public function transacao_acesso($dados=null) {

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('mpdf'); //carrega a biblioteca mpdf que está em aplication/libraries/mpdf

        if ($this->input->post() == NULL) {

              $clientesBusiness = $this->Factory->createBusiness("com_clientes");
            $listCliente = $clientesBusiness->filtro(null);
            $info['listCliente'] = $listCliente;
                     

            $content = $this->load->view('relatorio_painel/menu', $info, TRUE);
            $this->loadPage($content);
       
            } else {

            
            $dados = $this->input->post();
            
         
            $historicoBusiness = $this->Factory->createBusiness("acesso_historico");
            $listHistorico = $historicoBusiness->filtro($dados);
            $info['listHistorico'] = $listHistorico;

            $info['data_de'] = $dados['data_de'];
            $info['data_ate'] = $dados['data_ate'];

            $content = $this->load->view('relatorio_usuario/transacao_acesso_pdf', $info, TRUE);

            $this->mpdf->setFooter('{PAGENO}'); //numero de paginas
            $this->mpdf->WriteHTML($content); // Converte os dados html para pdf
            $this->mpdf->Output(); //gera
            
            //$content = $this->load->view('financeiro/filtroPagar',$info, TRUE);
            //$this->loadPage($content);
       
        }
    }


     
   
      
      
}
?>
