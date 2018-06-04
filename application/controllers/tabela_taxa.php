<?php

/* Classe(controller): Categoria de Produtos
 * Autor: Anderson Farias
 * Última atualização: 27/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Tabela_taxa extends MY_Controller {
	
    //VALIDAÇÃO
    private function Rules(){
        $this->form_validation->set_rules('nome','Nome Tabela','required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"  id="msgOk">
<strong><i class="fa fa-check"></i></strong> ', '</div>');
    }

     private function Rules_parcela(){
        $this->form_validation->set_rules('id_tabela_nome','Tabela','required');
        $this->form_validation->set_rules('parcela_inicio','Parcela De','required');
        $this->form_validation->set_rules('parcela_fim','Parcela Ate','required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"  id="msgOk">
<strong><i class="fa fa-check"></i></strong> ', '</div>');
    }
    
    //CADASTRAR
    public function cadastrar($msg=null){
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
        $this->Rules();
        $info['msg'] = $msg;
        
        if($this->form_validation->run()==FALSE){
            $content = $this->load->view("tabela_taxa/cadastrar",$info,TRUE);
            $this->loadPage($content);
        }
       
        else{
       
            $dados = $this->input->post();
            $tabBusiness = $this->Factory->createBusiness("fin_tabela_nome");
            $id_tabela_nome = $tabBusiness->cadastrar($dados);
            $msg = true;
            
            redirect('tabela_taxa/incluir_parcela/'.$id_tabela_nome);
        }
    
    }

    public function incluir_parcela($id_tabela_nome,$msg=null){
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
        $this->Rules_parcela();
        
        $info['msg'] = $msg;
        
        if($this->form_validation->run()==FALSE){

            $tabBusiness = $this->Factory->createBusiness("fin_tabela_taxa");
            $listTab = $tabBusiness->listar($id_tabela_nome);
            $info['listTab'] = $listTab;

             $tabNomeBusiness = $this->Factory->createBusiness("fin_tabela_nome");
             $objTabNome = $tabNomeBusiness->visualizar($id_tabela_nome);
             $info["objTabNome"] = $objTabNome;

            $content = $this->load->view("tabela_taxa/incluir_parcela",$info,TRUE);
            $this->loadPage($content);
        }
       
        else{
       
            $dados = $this->input->post();
            $tabBusiness = $this->Factory->createBusiness("fin_tabela_taxa");
            $id_tabela_taxa = $tabBusiness->cadastrar($dados);
            $msg = true;
            
            redirect('tabela_taxa/incluir_parcela/'.$dados['id_tabela_nome']);
        }
    
    }


    //LISTAGEM
    public function filtro(){
        try {
            $this->load->helper(array('form','url'));
            
            if ($this->input->post() == NULL) {
            
            $tabBusiness = $this->Factory->createBusiness("fin_tabela_nome");
            $listTab = $tabBusiness->filtro(null);
            $info['listTab'] = $listTab;
            
            $content = $this->load->view("tabela_taxa/filtro",$info,TRUE);
            $this->loadPage($content);

            }

            else{
            
            $dados = $this->input->post();
            
          $tabBusiness = $this->Factory->createBusiness("fin_tabela_nome");
            $listTab = $tabBusiness->filtro($dados);
            $info['listTab'] = $listTab;
           	
            $content = $this->load->view("tabela_taxa/filtro",$info,TRUE);
            $this->loadPage($content);	
            	
            }

          } catch (Exception $exc) {
            $this->loadError($ex);
        }
  }



   //EDIÇÃO
      public function editar($id_categoria,$msg=null){
          $this->load->helper(array('form','url'));
          $this->load->library('form_validation');
          
          $this->Rules();
          
          if($this->form_validation->run()==FALSE){
              $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
              $objCategoria = $categoriaBusiness->visualizar($id_categoria);
              $info["objCategoria"] = $objCategoria;
              $info['msg'] = $msg;
             
              $content = $this->load->view("est_categorias/editar",$info,TRUE);
              $this->loadPage($content);
              
           }
           
           else{
            $dados = $this->input->post();
            $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
            $cod_categoria = $categoriaBusiness->editar($dados);
            $msg = true;
            redirect('est_categorias/editar/'.$dados['id_categoria'].'/'.$msg);
           }
      }

      //EXCLUSÃO
      public function excluir_parcela($id_tabela_taxa,$id_tabela_nome){
          $this->load->helper(array('form','url'));

          $tabBusiness = $this->Factory->createBusiness("fin_tabela_taxa");
          $tabBusiness->excluir($id_tabela_taxa);
          redirect("tabela_taxa/incluir_parcela/".$id_tabela_nome);
      }

       public function excluir($id_tabela_nome){
          $this->load->helper(array('form','url'));

          $tabBusiness = $this->Factory->createBusiness("fin_tabela_nome");
          $tabBusiness->excluir($id_tabela_nome);
          redirect("tabela_taxa/filtro/");
      }


       
      
      
}
?>
