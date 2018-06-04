<?php
/* Classe(controller): Cargos colaboradores
 * Autor: Anderson Farias
 * Última atualização: 23/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Relatorio_comercial extends MY_Controller {
	
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
        public function clientes($dados=null) {

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('mpdf'); //carrega a biblioteca mpdf que está em aplication/libraries/mpdf

        if ($this->input->post() == NULL) {

              $clientesBusiness = $this->Factory->createBusiness("com_clientes");
            $listCliente = $clientesBusiness->filtro(null);
            $info['listCliente'] = $listCliente;
                     

            $content = $this->load->view('relatorio_comercial/entrada_cliente', $info, TRUE);
            $this->loadPage($content);
       
            } else {

            
            $dados = $this->input->post();
            
         
            $clientesBusiness = $this->Factory->createBusiness("com_clientes");
            $listCliente = $clientesBusiness->filtro($dados);
            $info['listCliente'] = $listCliente;

            if($dados['formato']=="EXCEL"){                
            $info['excel'] = true;
                $content = $this->load->view('relatorio_comercial/clientes_pdf', $info);
            }
           
           else if($dados['formato']=="WEB"){ 
            $info['excel'] = false;
                $content = $this->load->view('relatorio_comercial/clientes_pdf', $info);
            }
            else{ 
            $info['excel'] = false;
            
            $content = $this->load->view('relatorio_comercial/clientes_pdf', $info, TRUE);

            $this->mpdf->setFooter('{PAGENO}'); //numero de paginas
            $this->mpdf->WriteHTML($content); // Converte os dados html para pdf
            $this->mpdf->Output(); //gera
            }

           
            
            //$content = $this->load->view('financeiro/filtroPagar',$info, TRUE);
            //$this->loadPage($content);
       
        }
    }


     // CLIENTES
        public function fornecedores($dados=null) {

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('mpdf'); //carrega a biblioteca mpdf que está em aplication/libraries/mpdf

        if ($this->input->post() == NULL) {
           
            $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
            $listFornecedor = $fornecedorBusiness->filtro(null);
            $info['listFornecedor'] = $listFornecedor;
                     

            $content = $this->load->view('relatorio_comercial/entrada_fornecedor', $info, TRUE);
            $this->loadPage($content);
       
            } else {

            
            $dados = $this->input->post();
            
         
            $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
            $listFornecedor = $fornecedorBusiness->filtro($dados);
            $info['listFornecedor'] = $listFornecedor;

            $content = $this->load->view('relatorio_comercial/fornecedores_pdf', $info, TRUE);

            $this->mpdf->setFooter('{PAGENO}'); //numero de paginas
            $this->mpdf->WriteHTML($content); // Converte os dados html para pdf
            $this->mpdf->Output(); //gera
            
            //$content = $this->load->view('financeiro/filtroPagar',$info, TRUE);
            //$this->loadPage($content);
       
        }
    }



  
   
      
      
}
?>
