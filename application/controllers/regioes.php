<?php

/* Classe(controller): Categoria de Produtos
 * Autor: Anderson Farias
 * Última atualização: 27/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Regioes extends MY_Controller {
	
    //VALIDAÇÃO
    private function Rules(){
        $this->form_validation->set_rules('categoria','Categoria','required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"  id="msgOk">
<strong><i class="fa fa-check"></i></strong> ', '</div>');
    }
    
    public function estados(){
           $this->load->helper(array('form','url'));
          $categoriaBusiness = $this->Factory->createBusiness("estado");
          $list = $categoriaBusiness->ajax_listar(NAO);
           echo json_encode($list); 
   }

    public function cidades($uf){
           $this->load->helper(array('form','url'));
          $categoriaBusiness = $this->Factory->createBusiness("cidade");
          $list = $categoriaBusiness->ajax_listar($uf);
           echo json_encode($list); 
   }

   public function visualizar_cidade($ct_id){
           $this->load->helper(array('form','url'));
          $categoriaBusiness = $this->Factory->createBusiness("cidade");
          $list = $categoriaBusiness->ajax_visualizar($ct_id);

           echo json_encode($list); 
   }




 

       //LISTAGEM
    public function ajax_listar($pos){

      //header( 'Cache-Control: no-cache' );
      //header( 'Content-type: application/xml; charset="utf-8"', true );
      
      $this->load->helper(array('form','url'));
      $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
      $listCategoria = $categoriaBusiness->ajax_listar($pos);  
     
      echo json_encode($listCategoria); 
                
    }







     
      
      
}
?>
