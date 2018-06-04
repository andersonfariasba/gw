<?php
/* Classe(controller): Perfil de usuários
 * Autor: Anderson Farias
 * Última atualização: 23/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Acesso_historico extends MY_Controller {
	
    //VALIDA��O
    private function Rules(){
        $this->form_validation->set_rules('perfil','Perfil','required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"  id="msgOk">
<strong><i class="fa fa-check"></i></strong> ', '</div>');
    
    }
    
    //LISTAGEM
    public function filtro(){
        try {
            $this->load->helper(array('form','url'));
            
            if ($this->input->post() == NULL) {
            
            $historicoBusiness = $this->Factory->createBusiness("acesso_historico");
            $listHistorico = $historicoBusiness->filtro(null);
            $info['listHistorico'] = $listHistorico;
            
            $content = $this->load->view("acesso_historico/filtro",$info,TRUE);
            $this->loadPage($content);

            }else{
            
            $dados = $this->input->post();
            
            $historicoBusiness = $this->Factory->createBusiness("acesso_historico");
            $listHistorico = $historicoBusiness->filtro($dados);
            $info['listHistorico'] = $listHistorico;
           	
            $content = $this->load->view("acesso_historico/filtro",$info,TRUE);
            $this->loadPage($content);	
            	
            }
            
            

        } catch (Exception $exc) {
            $this->loadError($ex);
        }
    }
    
       //EXCLUSÃO
      public function excluir($id_acesso){
          $this->load->helper(array('form','url'));

          $historicoBusiness = $this->Factory->createBusiness("acesso_historico");
          $historicoBusiness->excluir($id_acesso);
          redirect("acesso_historico/filtro");
      }
      
}
?>
