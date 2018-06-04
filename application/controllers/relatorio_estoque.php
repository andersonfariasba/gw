<?php
/* Classe(controller): Cargos colaboradores
 * Autor: Anderson Farias
 * Última atualização: 23/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Relatorio_estoque extends MY_Controller {
	
    //VALIDA��O
    private function Rules(){
        $this->form_validation->set_rules('cargo','Cargo','required');
        $this->form_validation->set_error_delimiters('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');
    }


    //RELATORIOS


       

    public function teste($dados=null){
            $this->load->helper(array('form','url'));

            $movimentoBusiness = $this->Factory->createBusiness("Est_movimentacao");
            $listEstoque = $movimentoBusiness->filtro_mov_total($dados);

            print_r($listEstoque);
           
             
    }

       public function menu(){
            $this->load->helper(array('form','url'));

            $info = null;
            $content = $this->load->view("relatorio_estoque/menu",$info,TRUE);
            $this->loadPage($content);

       }

        
        //  ESTOQUE
        public function produtos($dados=null) {

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('mpdf'); //carrega a biblioteca mpdf que está em aplication/libraries/mpdf

        if ($this->input->post() == NULL) {

            $produtosBusiness = $this->Factory->createBusiness("est_produtos");
            $listProdutos = $produtosBusiness->filtro($dados);
            $info['listProdutos'] = $listProdutos;

            //Categoria
            $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
            $listCategoria = $categoriaBusiness->filtro();
            $info["listCategoria"] = $listCategoria;

            //Fornecedor
            $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
            $listFornecedor = $fornecedorBusiness->filtro();
            $info["listFornecedor"] = $listFornecedor;


            $content = $this->load->view('relatorio_estoque/entrada_produto', $info, TRUE);
            $this->loadPage($content);
       
            } else {

            
            $dados = $this->input->post();
            
         
            $produtosBusiness = $this->Factory->createBusiness("est_produtos");
            $listProdutos = $produtosBusiness->filtro($dados);
            $info['listProdutos'] = $listProdutos;

            //Categoria
            $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
            $listCategoria = $categoriaBusiness->filtro();
            $info["listCategoria"] = $listCategoria;

            //Fornecedor
            $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
            $listFornecedor = $fornecedorBusiness->filtro();
            $info["listFornecedor"] = $listFornecedor;

            //$this->load->view('relatorio_estoque/produtos_pdf', $info);
           
            $content = $this->load->view('relatorio_estoque/produtos_pdf', $info, TRUE);

            $this->mpdf->setFooter('{PAGENO}'); //numero de paginas
            $this->mpdf->WriteHTML($content); // Converte os dados html para pdf
            $this->mpdf->Output(); //gera
           
       
        }
    }



    //  ESTOQUE
        public function servicos($dados=null) {

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('mpdf'); //carrega a biblioteca mpdf que está em aplication/libraries/mpdf

        if ($this->input->post() == NULL) {

           $info = "";


            $content = $this->load->view('relatorio_estoque/entrada_produto', $info, TRUE);
            $this->loadPage($content);
       
            } else {

            
            $dados = $this->input->post();
            
         
            $produtosBusiness = $this->Factory->createBusiness("est_servicos");
            $listProdutos = $produtosBusiness->filtro($dados);
            $info['listProdutos'] = $listProdutos;

            //Categoria
            $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
            $listCategoria = $categoriaBusiness->filtro();
            $info["listCategoria"] = $listCategoria;

            //Fornecedor
            $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
            $listFornecedor = $fornecedorBusiness->filtro();
            $info["listFornecedor"] = $listFornecedor;

            //$this->load->view('relatorio_estoque/produtos_pdf', $info);
           
            $content = $this->load->view('relatorio_estoque/servicos_pdf', $info, TRUE);

            $this->mpdf->setFooter('{PAGENO}'); //numero de paginas
            $this->mpdf->WriteHTML($content); // Converte os dados html para pdf
            $this->mpdf->Output(); //gera
           
       
        }
    }


    //  ESTOQUE
        public function movimentacao_consolidado($dados=null) {

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('mpdf'); //carrega a biblioteca mpdf que está em aplication/libraries/mpdf

        if ($this->input->post() == NULL) {

            $info = null;

            $content = $this->load->view('relatorio_estoque/entrada_produto', $info, TRUE);
            $this->loadPage($content);
       
            } else {

            
            $dados = $this->input->post();
            
         
            $produtosBusiness = $this->Factory->createBusiness("est_produtos");
            $listProdutos = $produtosBusiness->movimentacao_consolidado($dados);
            $info['listProdutos'] = $listProdutos;

            $info['data_de'] = $dados['data_de'];
            $info['data_ate'] = $dados['data_ate'];

         
            //$this->load->view('relatorio_estoque/produtos_pdf', $info);
           
            $content = $this->load->view('relatorio_estoque/movimentacao_consolidado_pdf', $info, TRUE);

            $this->mpdf->setFooter('{PAGENO}'); //numero de paginas
            $this->mpdf->WriteHTML($content); // Converte os dados html para pdf
            $this->mpdf->Output(); //gera
           
       
        }
    }






      // CONTAS A RECEBER
        public function movimentacao($dados=null) {

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('mpdf'); //carrega a biblioteca mpdf que está em aplication/libraries/mpdf

        if ($this->input->post() == NULL) {

            $movimentacaoBusiness = $this->Factory->createBusiness("est_movimentacao");
            $listMov = $movimentacaoBusiness->filtro($dados);
            $info['listMov'] = $listMov;
            
            

            $content = $this->load->view('relatorio_estoque/entrada_movimentacao_resumo', $info, TRUE);
            $this->loadPage($content);
       
            } else {

            
            $dados = $this->input->post();
            
         
            $movimentacaoBusiness = $this->Factory->createBusiness("est_movimentacao");
            //$listMov = $movimentacaoBusiness->filtro_mov_total($dados);
            $listMov = $movimentacaoBusiness->filtro($dados);
            $info['listMov'] = $listMov;
            $info['data_de'] = $dados['data_de'];
            $info['data_ate'] = $dados['data_ate'];

          $content = $this->load->view('relatorio_estoque/movimentacao_pdf', $info, TRUE);
            
            //$content = $this->load->view('relatorio_estoque/movimentacao_resumo_pdf', $info, TRUE);

            $this->mpdf->setFooter('{PAGENO}'); //numero de paginas
            $this->mpdf->WriteHTML($content); // Converte os dados html para pdf
            $this->mpdf->Output(); //gera
            
        }
    }




    //  ESTOQUE
        public function estoque_financeiro($dados=null) {

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('mpdf'); //carrega a biblioteca mpdf que está em aplication/libraries/mpdf

        if ($this->input->post() == NULL) {

            $info = null;
            $content = $this->load->view('relatorio_estoque/entrada_estoque_financeiro', $info, TRUE);
            $this->loadPage($content);
       
            } else {

            
            $dados = $this->input->post();
            
         
           $movimentoBusiness = $this->Factory->createBusiness("Est_movimentacao");
           $listEstoque = $movimentoBusiness->filtro_financeiro($dados);
           $info['listEstoque'] = $listEstoque;
           
            $content = $this->load->view('relatorio_estoque/estoque_financeiro_pdf', $info, TRUE);

            $this->mpdf->setFooter('{PAGENO}'); //numero de paginas
            $this->mpdf->WriteHTML($content); // Converte os dados html para pdf
            $this->mpdf->Output(); //gera
            
            //$content = $this->load->view('financeiro/filtroPagar',$info, TRUE);
            //$this->loadPage($content);
       
        }
    }


        //  ESTOQUE
        public function ranking_produto($dados=null) {

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('mpdf'); //carrega a biblioteca mpdf que está em aplication/libraries/mpdf

        if ($this->input->post() == NULL) {

            $info = null;

            $content = $this->load->view('relatorio_estoque/entrada_produto', $info, TRUE);
            $this->loadPage($content);
       
            } else {

            
            $dados = $this->input->post();
            
         
            $produtosBusiness = $this->Factory->createBusiness("est_produtos");
            $listProdutos = $produtosBusiness->ranking_produto($dados);
            $info['listProdutos'] = $listProdutos;

            $info['data_de'] = $dados['data_de'];
            $info['data_ate'] = $dados['data_ate'];


          
            //$this->load->view('relatorio_estoque/produtos_pdf', $info);
           
            $content = $this->load->view('relatorio_estoque/ranking_produto_pdf', $info, TRUE);

            $this->mpdf->setFooter('{PAGENO}'); //numero de paginas
            $this->mpdf->WriteHTML($content); // Converte os dados html para pdf
            $this->mpdf->Output(); //gera
           
       
        }
    }



    
    
    
   
      
      
}
?>
