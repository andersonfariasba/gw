<?php
/* Classe(controller): Unidade de Medida
 * Autor: Anderson Farias
 * Última atualização: 27/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Teste extends MY_Controller {
	
    //VALIDA��O
    private function Rules(){
        //$this->form_validation->set_rules('categoria','Categoria','required');
        //$this->form_validation->set_error_delimiters('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');
    }
    
    //CADASTRA
    public function cadastrar(){
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
        $this->Rules();
        $info = null;
        
        if($this->form_validation->run()==FALSE){
            $content = $this->load->view("teste/cadastrar",$info,TRUE);
            $this->loadPage($content);
        }
        else{
            $dados = $this->input->post();
            
            $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
            $cod_categoria = $categoriaBusiness->cadastrar($dados);
            redirect('est_categorias/cadastrar');
        }

    }

     //CADASTRA
    public function modal(){
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
        $this->Rules();
        $info = null;
        
        if($this->form_validation->run()==FALSE){
            $content = $this->load->view("teste/modal",$info,TRUE);
            $this->loadPage($content);
        }
        else{
            $dados = $this->input->post();
            
            $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
            $cod_categoria = $categoriaBusiness->cadastrar($dados);
            redirect('est_categorias/cadastrar');
        }

    }







    //LISTAGEM
    public function filtro(){
        try {
            $this->load->helper(array('form','url'));
            
            if ($this->input->post() == NULL) {
            
            $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
            $listCategoria = $categoriaBusiness->filtro(null);
            $info['listCategoria'] = $listCategoria;
            
            $content = $this->load->view("est_categorias/filtro",$info,TRUE);
            $this->loadPage($content);

            }else{
            
            $dados = $this->input->post();
            
            $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
            $listCategoria = $categoriaBusiness->filtro($dados);
            $info['listCategoria'] = $listCategoria;
           	
            $content = $this->load->view("est_categorias/filtro",$info,TRUE);
            $this->loadPage($content);	
            	
            }
            
            

        } catch (Exception $exc) {
            $this->loadError($ex);
        }
    }
    
    //VISUALIZAÇÃO
    public function visualizar($id_categoria){
          try {
              $this->load->helper(array('form','url'));
              
              $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
              $info["objCategoria"] = $categoriaBusiness->visualizar($id_categoria);
              
              $content = $this->load->view("est_categorias/visualizar",$info,TRUE);
              $this->loadPage($content);

          } catch (Exception $exc) {
              echo $exc->getTraceAsString();
          }

      }

      //EDIÇÃO
      public function editar($id_categoria){
          $this->load->helper(array('form','url'));
          $this->load->library('form_validation');
          
          $this->Rules();
          
          if($this->form_validation->run()==FALSE){
              $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
              $objCategoria = $categoriaBusiness->visualizar($id_categoria);
              $info["objCategoria"] = $objCategoria;
             
              $content = $this->load->view("est_categorias/editar",$info,TRUE);
              $this->loadPage($content);
              
           }
           
           else{
           	$dados = $this->input->post();
           	$categoriaBusiness = $this->Factory->createBusiness("est_categorias");
           	$cod_categoria = $categoriaBusiness->editar($dados);
           	redirect('est_categorias/filtro');
           }
      }

      //EXCLUSÃO
      public function excluir($id_categoria){
          $this->load->helper(array('form','url'));

          $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
          $categoriaBusiness->excluir($id_categoria);
          redirect("est_categorias/filtro");
      }
      
      
}
?>
