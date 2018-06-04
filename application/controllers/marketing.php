<?php
/* Classe(controller): Cargos colaboradores
 * Autor: Anderson Farias
 * Última atualização: 23/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Marketing extends MY_Controller {
	
    //VALIDA��O
    private function Rules(){
        $this->form_validation->set_rules('cargo','Cargo','required');
        $this->form_validation->set_error_delimiters('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');
    }


    //RELATORIOS


       

       public function customizacao(){
            $this->load->helper(array('form','url'));

            $clientesBusiness = $this->Factory->createBusiness("fin_filiais");
            $objCliente = $clientesBusiness->visualizar(PAD_CAD_FILIAL);
            $info["objFilial"] = $objCliente;
            
            $content = $this->load->view("marketing/info_customizacao",$info,TRUE);
            $this->loadPage($content);

       }

        
       
    
  
   
      
      
}
?>
