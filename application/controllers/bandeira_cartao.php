<?php
/* Classe(controller): Bandeira Cartão
 * Autor: Anderson Farias
 * Última atualização: 15/07/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Bandeira_cartao extends MY_Controller {
	
    //VALIDAÇÃO
    private function Rules(){
        $this->form_validation->set_rules('id_forma','Forma','required');
          $this->form_validation->set_rules('id_operadora','Operadora','required');
        $this->form_validation->set_rules('bandeira','Bandeira','required');
        
        $this->form_validation->set_error_delimiters('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');
    }
    
    //CADASTRA
    public function cadastrar($msg=null){
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
        $this->Rules();
        $info['msg'] = $msg;
        
        if($this->form_validation->run()==FALSE){
                
            $formaBusiness = $this->Factory->createBusiness("fin_formas_recebimentos");
            $listForma = $formaBusiness->visualizarFormaCartao(SIM);
            $info["listForma"] = $listForma;

            $operadoraBusiness = $this->Factory->createBusiness("fin_operadoras_cartao");
            $listOperadora = $operadoraBusiness->filtro();
            $info["listOperadora"] = $listOperadora;
           
            $content = $this->load->view("bandeira_cartao/cadastrar",$info,TRUE);
            $this->loadPage($content);
        }
        else{
           $dados = $this->input->post();
           $dados["status"] = ATIVO;
           $bandeiraBusiness = $this->Factory->createBusiness("fin_bandeira_cartao");
           $cod_bandeira = $bandeiraBusiness->cadastrar($dados);
           $msg = true;
           redirect('bandeira_cartao/cadastrar/'.$msg);
        }

    }


    //LISTAGEM
    public function filtro(){
        try {
            $this->load->helper(array('form','url'));
            
            if ($this->input->post() == NULL) {
            
            $bandeiraBusiness = $this->Factory->createBusiness("fin_bandeira_cartao");
            $listBandeira = $bandeiraBusiness->filtro(null);
            $info['listBandeira'] = $listBandeira;
            
            $content = $this->load->view("bandeira_cartao/filtro",$info,TRUE);
            $this->loadPage($content);

            }else{
            
            $dados = $this->input->post();
            
            $bandeiraBusiness = $this->Factory->createBusiness("fin_bandeira_cartao");
            $listBandeira = $bandeiraBusiness->filtro($dados);
            $info['listBandeira'] = $listBandeira;
           	
            $content = $this->load->view("bandeira_cartao/filtro",$info,TRUE);
            $this->loadPage($content);	
            	
            }
            
          } catch (Exception $exc) {
            $this->loadError($ex);
        }
    }
    
    //VISUALIZAÇÃO
    public function visualizar($id_bandeira){
          try {
              $this->load->helper(array('form','url'));
              
              $bandeiraBusiness = $this->Factory->createBusiness("fin_bandeira_cartao");
              $info["objBandeira"] = $bandeiraBusiness->visualizar($id_bandeira);
              
              $content = $this->load->view("bandeira_cartao/visualizar",$info,TRUE);
              $this->loadPage($content);

          } catch (Exception $exc) {
              echo $exc->getTraceAsString();
          }

      }

      //EDIÇÃO
      public function editar($id_bandeira,$msg=null){
          $this->load->helper(array('form','url'));
          $this->load->library('form_validation');
          
          $this->Rules();
          
          if($this->form_validation->run()==FALSE){
              
              $bandeiraBusiness = $this->Factory->createBusiness("fin_bandeira_cartao");
              $objBandeira = $bandeiraBusiness->visualizar($id_bandeira);
              $info["objBandeira"] = $objBandeira;
              
             $formaBusiness = $this->Factory->createBusiness("fin_formas_recebimentos");
            $listForma = $formaBusiness->visualizarFormaCartao(SIM);
            $info["listForma"] = $listForma;

               $operadoraBusiness = $this->Factory->createBusiness("fin_operadoras_cartao");
            $listOperadora = $operadoraBusiness->filtro();
            $info["listOperadora"] = $listOperadora;

              $info['msg'] = $msg;
           
             
              $content = $this->load->view("bandeira_cartao/editar",$info,TRUE);
              $this->loadPage($content);
              
           }
            else{
           	$dados = $this->input->post();
           	$bandeiraBusiness = $this->Factory->createBusiness("fin_bandeira_cartao");
           	$cod_bandeira = $bandeiraBusiness->editar($dados);
            $msg = true;
           	redirect('bandeira_cartao/editar/'.$dados['id_bandeira'].'/'.$msg);
           }
      }

      //EXCLUSÃO
      public function excluir($id_bandeira){
          $this->load->helper(array('form','url'));

          $bandeiraBusiness = $this->Factory->createBusiness("fin_bandeira_cartao");
          $bandeiraBusiness->excluir($id_bandeira);
          redirect("bandeira_cartao/filtro");
      }


       //LISTAGEM
    public function listarPorForma($id_forma){

      //header( 'Cache-Control: no-cache' );
      //header( 'Content-type: application/xml; charset="utf-8"', true );
      
      $this->load->helper(array('form','url'));
      $bandeiraBusiness = $this->Factory->createBusiness("fin_bandeira_cartao");
      $listBandeira = $bandeiraBusiness->listarPorForma($id_forma);
     
      echo json_encode($listBandeira); 
                
      
}


 //LISTAGEM
    public function listarPorOperadora($id_operadora){

      //header( 'Cache-Control: no-cache' );
      //header( 'Content-type: application/xml; charset="utf-8"', true );
      
      $this->load->helper(array('form','url'));
      $bandeiraBusiness = $this->Factory->createBusiness("fin_bandeira_cartao");
      $listBandeira = $bandeiraBusiness->listarPorOperadora($id_operadora);
     
      echo json_encode($listBandeira); 
                
      
}



}
?>
