<?php

/* Classe(controller): Categoria de Produtos
 * Autor: Anderson Farias
 * Última atualização: 27/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Operadoras_cartao extends MY_Controller {
	
    //VALIDAÇÃO
    private function Rules(){
        $this->form_validation->set_rules('empresa','Empresa','required');
        $this->form_validation->set_error_delimiters('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');
    }
    
    //CADASTRAR
    public function cadastrar($msg=null){
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
        $this->Rules();
        $info['msg'] = $msg;
        
        if($this->form_validation->run()==FALSE){
            $content = $this->load->view("operadoras_cartao/cadastrar",$info,TRUE);
            $this->loadPage($content);
        }
       
        else{
       
            $dados = $this->input->post();
            $categoriaBusiness = $this->Factory->createBusiness("fin_operadoras_cartao");
            $dados['status'] = ATIVO;
            $cod_categoria = $categoriaBusiness->cadastrar($dados);
            $msg = true;
            redirect('operadoras_cartao/cadastrar/'.$msg);
        }
    }


    //LISTAGEM
    public function filtro(){
        try {
            $this->load->helper(array('form','url'));
            
            if ($this->input->post() == NULL) {
            
            $categoriaBusiness = $this->Factory->createBusiness("fin_operadoras_cartao");
            $listCategoria = $categoriaBusiness->filtro(null);
            $info['listCategoria'] = $listCategoria;
            
            $content = $this->load->view("operadoras_cartao/filtro",$info,TRUE);
            $this->loadPage($content);

            }

            else{
            
            $dados = $this->input->post();
            
            $categoriaBusiness = $this->Factory->createBusiness("fin_operadoras_cartao");
            $listCategoria = $categoriaBusiness->filtro($dados);
            $info['listCategoria'] = $listCategoria;
           	
            $content = $this->load->view("operadoras_cartao/filtro",$info,TRUE);
            $this->loadPage($content);	
            	
            }

          } catch (Exception $exc) {
            $this->loadError($ex);
        }
  }

   //EDIÇÃO
      public function editar($id_operadora,$msg=null){
          $this->load->helper(array('form','url'));
          $this->load->library('form_validation');
          
          $this->Rules();
          
          if($this->form_validation->run()==FALSE){
              $categoriaBusiness = $this->Factory->createBusiness("fin_operadoras_cartao");
              $objCategoria = $categoriaBusiness->visualizar($id_operadora);
              $info["objOperadora"] = $objCategoria;
              $info['msg'] = $msg;
             
              $content = $this->load->view("operadoras_cartao/editar",$info,TRUE);
              $this->loadPage($content);
              
           }
           
           else{
            $dados = $this->input->post();
            $categoriaBusiness = $this->Factory->createBusiness("fin_operadoras_cartao");
            $cod_categoria = $categoriaBusiness->editar($dados);
            $msg = true;
            redirect('operadoras_cartao/editar/'.$dados['id_operadora'].'/'.$msg);
           }
      }

      //EXCLUSÃO
      public function excluir($id_operadora){
          $this->load->helper(array('form','url'));

          $categoriaBusiness = $this->Factory->createBusiness("fin_operadoras_cartao");
          $categoriaBusiness->excluir($id_operadora);
          redirect("operadoras_cartao/filtro");
      }


   //VISUALIZAÇÃO
    public function visualizar($id_operadora){
          try {
              $this->load->helper(array('form','url'));
              
              $categoriaBusiness = $this->Factory->createBusiness("fin_operadoras_cartao");
              $info["objCategoria"] = $categoriaBusiness->visualizar($id_operadora);
              
              $content = $this->load->view("operadoras_cartao/visualizar",$info,TRUE);
              $this->loadPage($content);

          } catch (Exception $exc) {
              echo $exc->getTraceAsString();
          }

      }


       //LISTAGEM
    public function ajax_listar($pos){

      //header( 'Cache-Control: no-cache' );
      //header( 'Content-type: application/xml; charset="utf-8"', true );
      
      $this->load->helper(array('form','url'));
      $categoriaBusiness = $this->Factory->createBusiness("fin_operadoras_cartao");
      $listCategoria = $categoriaBusiness->ajax_listar($pos);  
     
      echo json_encode($listCategoria); 
                
    }







     
      
      
}
?>
