<?php
/* Classe(controller): Pedidos
 * Autor: Anderson Farias
 * Última atualização: 01/10/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Compras extends MY_Controller {
	
    //VALIDAÇÃO
    private function Rules(){
        $this->form_validation->set_rules('tipo','Tipo','required');
        $this->form_validation->set_rules('id_fornecedor','Fornecedor','required');
        $this->form_validation->set_error_delimiters('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');
 
    }

    private function RulesItem(){
        $this->form_validation->set_rules('qtd','Quantidade','required');
        $this->form_validation->set_rules('id_produto', 'Produto', 'required|alpha_numeric|callback_item_validar');
        $this->form_validation->set_error_delimiters('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');
    }

    //1ª ETAPA - SOLICITAÇÃO DADOS DO CLIENTES
    public function solicitar_fornecedor($tipo){
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
        $this->Rules();

         if ($this->input->post() == NULL) {

       //Fornecedor
        $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
        $listFornecedor = $fornecedorBusiness->filtro();
        $info["listFornecedor"] = $listFornecedor;

      
        $info["menu_geral"] = true;

        $info["tipo"] = $tipo; 

        $content = $this->load->view("compras/solicitar_fornecedor",$info,TRUE);
        $this->loadPage($content);   
        
        } else {

          $dados = $this->input->post();
          $dados['status'] = ANDAMENTO;
          $dados['data_inicio'] = date('Y-m-d H:i:s');
          $dados['id_usuario'] =  $this->session->userdata('id_usuario');
          $pedidosBusiness = $this->Factory->createBusiness("comp_pedidos");
          
          if($dados['id_fornecedor']==""){
            $dados['id_fornecedor'] = PAD_CAD_FORNECEDOR;
          }
          

          $cod_pedido = $pedidosBusiness->cadastrar($dados);

          redirect('compras/visualizar/'.$cod_pedido);


        }


    }





   function pesquisar_produto_auto()
    {
      $this->load->helper(array('form','url'));
      
      $this->load->model('autocomplete_model');
      
      $term = $this->input->post('term',TRUE);

      $rows = $this->autocomplete_model->BuscarProduto($term);

      //$rows = $this->autocomplete_model->BuscarCliente(array('keyword' => $term));

      $json_array = array();

      foreach ($rows as $row){
         
           
            $data[] = array(
                'label' => $row->descricao." - ".$row->codigo,
                'value' =>$row->id_produto,
                'valor_venda' =>$row->valor_venda
            );
            
            }
                    
      echo json_encode($data);
          
  }




    //2ª ETAPA - TELA DE PEDIDOS
   public function visualizar($id){

        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');

          $categoriaBusiness = $this->Factory->createBusiness("comp_categorias");
          $listCategoria = $categoriaBusiness->filtro(null);
          $info['listCategoria'] = $listCategoria;

         //PEDIDOS
         $pedidosBusiness = $this->Factory->createBusiness("comp_pedidos");
         $objPedido = $pedidosBusiness->visualizar($id);
         $info['objPedido'] = $objPedido;
         
         //PRODUTOS
         $produtosBusiness = $this->Factory->createBusiness("comp_produtos");
         $listProdutos = $produtosBusiness->listar_produto_servico();
         $info['listProdutos'] = $listProdutos;

         //ITENS SELECIONADOS
         $pedidosItensBusiness = $this->Factory->createBusiness("comp_pedidos_itens");
         $listItens = $pedidosItensBusiness->listar($id);
         $info['listItens'] = $listItens;

          $formasBusiness = $this->Factory->createBusiness("fin_formas_pagamentos");
          $dadosRec['disponivel'] = FORMA_CONTA_PAGAR;
          $listFormas = $formasBusiness->filtro($dadosRec);
          $info['listFormas'] = $listFormas;

           //Unidade
            $unidadeBusiness = $this->Factory->createBusiness("est_un_medida");
            $listUnidade = $unidadeBusiness->filtro();
            $info["listUnidade"] = $listUnidade;


           //Listagem de Clientes
        $clientesBusiness = $this->Factory->createBusiness("com_clientes");
        $listCliente = $clientesBusiness->listar_cliente_orcamento();
        $info['listCliente'] = $listCliente;

          //Fornecedor
        $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
        $listFornecedor = $fornecedorBusiness->filtro();
        $info["listFornecedor"] = $listFornecedor;
         
 
         $info["menu_geral"] = true;

        
        $content = $this->load->view("compras/visualizar",$info,TRUE);
        $this->loadPage($content);      

  }



   //COMANDA ADICIONAR 
   public function comanda_add($id){

        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');

         //PEDIDOS
         $pedidosBusiness = $this->Factory->createBusiness("com_pedidos");
         $objPedido = $pedidosBusiness->visualizar($id);
         $info['objPedido'] = $objPedido;
         
          $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
          $listCategoria = $categoriaBusiness->filtro(null);
          $info['listCategoria'] = $listCategoria;

         //ITENS SELECIONADOS
         $ItensBusiness = $this->Factory->createBusiness("com_comanda");
         $listItens = $ItensBusiness->listar($id);
         $info['listItens'] = $listItens;

          $formasBusiness = $this->Factory->createBusiness("fin_formas_pagamentos");
          $dadosRec['disponivel'] = FORMA_CONTA_RECEBER;
          $listFormas = $formasBusiness->filtro($dadosRec);
          $info['listFormas'] = $listFormas;

           //Listagem de Clientes
        $clientesBusiness = $this->Factory->createBusiness("com_clientes");
        $listCliente = $clientesBusiness->listar_cliente_orcamento();
        $info['listCliente'] = $listCliente;
         
 
         $info["menu_geral"] = true;

        
        $content = $this->load->view("pedidos/comanda_add",$info,TRUE);
        $this->loadPage($content);      

  }


  //ADICIONAR ITENS DA COMANDA
  public function estoque_pesquisa($id){
      $this->load->helper(array('form','url'));
      $this->load->library('form_validation');
      
     $this->form_validation->set_rules('qtd','Quantidade','required');
     $this->form_validation->set_error_delimiters('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');

        // if ($this->input->post() == NULL) {
        if($this->form_validation->run()==FALSE){
         
           //PEDIDOS
         $pedidosBusiness = $this->Factory->createBusiness("com_pedidos");
         $objPedido = $pedidosBusiness->visualizar($id);
         $info['objPedido'] = $objPedido;

         // $produtosBusiness = $this->Factory->createBusiness("est_produtos");
           //$listProdutos = $produtosBusiness->filtro(null);
           $info['listProdutos'] = "";
         
          $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
          $listCategoria = $categoriaBusiness->filtro(null);
          $info['listCategoria'] = $listCategoria;

         //ITENS SELECIONADOS
              
         
           $info["menu_geral"] = true;
           $content = $this->load->view("pedidos/estoque_pesquisa",$info,TRUE);
           $this->loadPage($content);

           //redirect('pedidos/visualizar/'.$id_pedido);

         }
         
         else{

           $dados = $this->input->post();

           $dadosEst['codigo'] = $dados['codigo'];
           $dadosEst['descricao'] = $dados['descricao'];
           $dadosEst['id_fornecedor'] = null;
           $dadosEst['id_categoria'] = null;



           
           //PEDIDOS
         $pedidosBusiness = $this->Factory->createBusiness("com_pedidos");
         $objPedido = $pedidosBusiness->visualizar($dados['id_pedido']);
         $info['objPedido'] = $objPedido;

           $produtosBusiness = $this->Factory->createBusiness("est_produtos");
           $listProdutos = $produtosBusiness->filtro($dadosEst);
           $info['listProdutos'] = $listProdutos;
          
                            
          $info["menu_geral"] = true;
          $info['qtd'] = $dados['qtd'];
          $content = $this->load->view("pedidos/estoque_pesquisa",$info,TRUE);
          $this->loadPage($content);

         }

}


     //add item consulta
      public function add_item_consulta($item,$pedido,$qtd){
          $this->load->helper(array('form','url'));

           $dados['data_inclusao'] = date('Y-m-d'); 
           $itemBusiness = $this->Factory->createBusiness("com_pedidos_itens");

            //Pegar valor do produto
            $produtosBusiness = $this->Factory->createBusiness("est_produtos");
            $objProduto = $produtosBusiness->visualizar($item);
            
          
            $dados['valor_unitario'] = $objProduto->getValor_venda();
            
           

            $dados['qtd'] = $qtd;
            $dados['id_pedido'] = $pedido;
            $dados['id_produto'] = $item;
         
            
            $cod_item = $itemBusiness->cadastrar($dados);
            
            
            echo "<script>window.opener.location.href='".site_url('pedidos/visualizar/'.$pedido)."'</script>";
            echo "<script>window.close();</script>"; 
            

            //redirect('pedidos/visualizar/'.$pedido);

    }





   


 //ADICIONAR ITENS AO ORÇAMENTO
  public function add_item($id){
      $this->load->helper(array('form','url'));
      $this->load->library('form_validation');
      
      $this->RulesItem();

       //  if ($this->input->post() == NULL) {
        if($this->form_validation->run()==FALSE){
         
            //PEDIDOS
         $pedidosBusiness = $this->Factory->createBusiness("comp_pedidos");
         $objPedido = $pedidosBusiness->visualizar($id);
         $info['objPedido'] = $objPedido;

          $categoriaBusiness = $this->Factory->createBusiness("comp_categorias");
          $listCategoria = $categoriaBusiness->filtro(null);
          $info['listCategoria'] = $listCategoria;
         
         //PRODUTOS
         $produtosBusiness = $this->Factory->createBusiness("comp_produtos");
         $listProdutos = $produtosBusiness->listar_produto_servico();
         $info['listProdutos'] = $listProdutos;


         //ITENS SELECIONADOS
         $pedidosItensBusiness = $this->Factory->createBusiness("comp_pedidos_itens");
         $listItens = $pedidosItensBusiness->listar($id);
         $info['listItens'] = $listItens;

           $info["menu_geral"] = true;
           $content = $this->load->view("compras/visualizar",$info,TRUE);
           $this->loadPage($content);

           //redirect('pedidos/visualizar/'.$id_pedido);

         }
         
         else{

           $dados = $this->input->post();
           $dados['data_inclusao'] = date('Y-m-d'); 
           $itemBusiness = $this->Factory->createBusiness("comp_pedidos_itens");
            //Pegar valor do produto
            $produtosBusiness = $this->Factory->createBusiness("comp_produtos");
            $objProduto = $produtosBusiness->visualizar($dados['id_produto']);

            $cod_item = $itemBusiness->cadastrar($dados);

             //echo "<script>window.location.href='".site_url('compras/visualizardsdsd/').$dados['id_pedido']."'</script>";


           redirect('compras/visualizar/'.$dados["id_pedido"]);

         }

  }


    



  public function item_validar($id_pedido,$id_produto) {
        try {
            
            $pedido = $this->input->post("id_pedido");
            $produto = $this->input->post("id_produto");

            $pedidoBus = $this->Factory->createBusiness("comp_pedidos_itens");

            if (!$pedidoBus->item_validar($pedido, $produto)) {
                return TRUE;
            } else {
                $this->form_validation->set_message('item_validar', 'Itens Já selecionado.');
                return FALSE;
            }
        } catch (Excpeption $ex) {
            $this->loadError($ex);
        }
    }





   //EXCLUSÃO DE ITENS
      public function excluir_item($id_item,$id_pedido){
          $this->load->helper(array('form','url'));

          $itemBusiness = $this->Factory->createBusiness("comp_pedidos_itens");
          $itemBusiness->excluir($id_item);
          redirect("compras/visualizar/".$id_pedido);
      }

      



      //CONFIRMAR ORÇAMENTO
      public function confirmar_orcamento($id_pedido){
          $this->load->helper(array('form','url'));

          $dados = $this->input->post();

          $pedidoBusiness = $this->Factory->createBusiness("comp_pedidos");
          $pedidoBusiness->confirmar_orcamento($dados);

          redirect("compras/visualizar/".$id_pedido);
          
          //redirect("pedidos/filtro/".ORCAMENTO);
      }


     


       //ALTERAR ORÇAMENTO PARA PEDIDO
      public function alterar_tipo($id_pedido){
        
          $this->load->helper(array('form','url'));      
          $pedidoBusiness = $this->Factory->createBusiness("comp_pedidos");
          $pedidoBusiness->alterar_tipo($id_pedido);

          redirect("compras/visualizar/".$id_pedido);
      }
 
       
    //LISTAGEM
    public function filtro($tipo,$aba=null,$dados=null){
        try {
            $this->load->helper(array('form','url'));
            
            if ($this->input->post() == NULL) {
            
            //Pedidos
            $pedidosBusiness = $this->Factory->createBusiness("comp_pedidos");
            $listPedido = $pedidosBusiness->filtro($tipo);
            $info["listPedidos"] = $listPedido;

             //Listagem de Clientes
            $clientesBusiness = $this->Factory->createBusiness("com_clientes");
            $listCliente = $clientesBusiness->listar_cliente_orcamento();
            $info['listCliente'] = $listCliente;

          

            $info['tipo'] = $tipo;

            $info['aba'] = $aba;
           
          
            
            $content = $this->load->view("compras/filtro",$info,TRUE);
            $this->loadPage($content);

            } else{
            
            $dados = $this->input->post();
            
            
            //Pedidos
            $pedidosBusiness = $this->Factory->createBusiness("comp_pedidos");
            $listPedido = $pedidosBusiness->filtro($tipo,$dados);
            $info["listPedidos"] = $listPedido;

             //Listagem de Clientes
            $clientesBusiness = $this->Factory->createBusiness("com_clientes");
            $listCliente = $clientesBusiness->listar_cliente_orcamento();
            $info['listCliente'] = $listCliente;

           
            $info['tipo'] = $tipo;

            $info['aba'] = $aba;
            	
            $content = $this->load->view("compras/filtro",$info,TRUE);
            $this->loadPage($content);	
            	
            }
            
          } catch (Exception $exc) {
            $this->loadError($ex);
        }
    }
    

      //EDIÇÃO
      public function editar($id_lanc){
          $this->load->helper(array('form','url'));
          $this->load->library('form_validation');
          
          $this->RulesEditar();
          
          if($this->form_validation->run()==FALSE){
              
              //Fornecedores
            $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
            $listFornecedor = $fornecedorBusiness->filtro();
            $info["listForncedor"] = $listFornecedor;
           
            //Centro de custos
            $custoBusiness = $this->Factory->createBusiness("fin_centro_custos");
            $listCustos = $custoBusiness->filtro();
            $info["listCusto"] = $listCustos;
            
              
            $lancBusiness = $this->Factory->createBusiness("fin_lancamentos");
            $objLanc = $lancBusiness->visualizar($id_lanc);
            $info["objLanc"] = $objLanc;

            $content = $this->load->view("contas_pagar/editar",$info,TRUE);
            $this->loadPage($content);
              
           }
           
           else{
           	
                $dadosLanc = $this->input->post();
                
                             
                redirect('contas_pagar/filtro/');
                
           }
      }


           //CONFIRMAR ORÇAMENTO
      public function salvar_pedido(){
          $this->load->helper(array('form','url'));

          $dadosForm = $this->input->post();
         
          $dados['id_pedido'] = $dadosForm['id_pedido'];
         // $dados['desconto'] = $dadosForm['desconto'];
          $dados['desconto'] = str_replace(".","",$dadosForm['desconto']);
          $dados['taxa_frete'] = str_replace(".","",$dadosForm['taxa_frete']);
          $dados['observacao'] = $dadosForm['observacao'];

  
         //print_r($dados);
         $pedidoBusiness = $this->Factory->createBusiness("comp_pedidos");
         $pedidoBusiness->salvar_pedido($dados);

    }





      public function finalizar_pedido(){

        $this->load->helper(array('form','url'));

        $dadosForm = $this->input->post();      

        //******INCLUIR FORMA DE PAGAMENTO NA TABELA fin_forma_pag_fat        
       /* $dados['id_pedido'] = $dadosForm['id_pedido'];
        $dados['id_forma'] = $dadosForm['id_forma'];
        $dados['id_bandeira'] = null; //$dadosForm['id_bandeira'];
        $dados['parcela'] = $dadosForm['qtd_parcela_pag'];
        $dados['valor'] = $dadosForm['valor'];
        $dados['id_usuario'] =  $this->session->userdata('id_usuario');
        $dados['data'] = date('Y-m-d H:i:s');
        $dados['status'] = FINALIZADO;

        $formaBusiness = $this->Factory->createBusiness("fin_forma_pag_fat");
        $formaBusiness->cadastrar($dados);
        */
        
        //******FINAL INCLUSÃO FORMA DE PAGAMENTO ****************

        //******ATUALIZAR DADOS DOS VALORES DO PEDIDO E ANOTAÇÕES***********
         $dadosAdd['id_pedido'] = $dadosForm['id_pedido'];
         $dadosAdd['desconto'] = $dadosForm['descontoFlag']; //str_replace(".","",$dadosForm['descontoFlag']);
         $dadosAdd['taxa_frete'] = $dadosForm['taxa_freteFlag']; //str_replace(".","",$dadosForm['taxa_freteFlag']);
         $dadosAdd['observacao'] = $dadosForm['observacaoFlag'];
  
         $pedidoBusiness = $this->Factory->createBusiness("comp_pedidos");
         $pedidoBusiness->salvar_pedido($dadosAdd);
       
        //******FINAL ATUALIZAÇÃO DE VALORES E ANOTAÇÕES *******************  
       
        //******GERA CONTAS A RECEBER ****************
        //CONTAS
        $dadosConta['id_pedido']  = $dadosForm['id_pedido'];
        $dadosConta['id_fornecedor'] = $dadosForm['id_fornecedor'];
        $dadosConta['tipo'] = CONTAS_PAGAR;
        $dadosConta['valor_total'] = ($dadosForm['valor']+$dadosAdd['taxa_frete']) - $dadosAdd['desconto'];
        
        $total_pedido = ($dadosForm['valor']+$dadosAdd['taxa_frete']) - $dadosAdd['desconto'];

        $dadosConta['data'] = date('Y-m-d');
        $dadosConta['parcela_qtd'] =  $dadosForm['qtd_parcela_pag'];
        $dadosConta['descricao'] = "Compra Nº: ".$dadosForm['id_pedido'];

        $contaBusiness = $this->Factory->createBusiness("fin_contas");
        $id_conta = $contaBusiness->cadastrar($dadosConta);
        
        $dadosLanc['id_conta'] = $id_conta;
        


        //LANÇAMENTOS

          // OS LANÇAMENTOS ABAIXO SÃO APENAS SEM PARCELAS
          $data_vencimento = date('Y-m-d');

          //CONSULTAR SE EXISTE ANTECIPAÇÃO DE FORMA DE PAGAMENTO
          // $antecipacao = 1; //flag para ajudar a incrementar a data, caso seja 1 será 30 dias, 0 é no dia mesmo
           
           $formaBusiness = $this->Factory->createBusiness("fin_formas_pagamentos");
           $objForma = $formaBusiness->visualizar($dadosForm['id_forma']);
           
           $qtd_parcela = $dadosForm['qtd_parcela_pag'];
           $valor_parcela = $total_pedido / $dadosForm['qtd_parcela_pag'];
         

         
           if($objForma->getCrAntecipado()==CR_ANTECIPADO_SIM){
          
          
                $antecipacao = SIM;
                $qtd_parcela = 1; //apenas uma parcela
                $valor_parcela = $total_pedido;
                $dadosLanc['pagamento_antecipado'] = SIM;
                $dadosLanc['status'] = PAGO;
           }
         
          else{
                $antecipacao = NAO;
                $dadosLanc['status'] = ABERTO;
              }  



          /*

          // SE FOR OUTRAS FORMAS DE PAGAMENTOS BUSCAR ANTECIPAÇÃO NA FORMA DE PAGAMENTO 
          if($objForma->getCartao()==NAO || $objForma->getCartao()==""){
            if($objForma->getCrAntecipado()==CR_ANTECIPADO_SIM){
               $antecipacao = SIM;  //antencipou
               $qtd_parcela = 1; //apenas uma parcela
               $valor_parcela = $total_pedido;
               $dadosLanc['pagamento_antecipado'] = SIM;
               $dadosLanc['status'] = PAGO;

             }else{
               $antecipacao = NAO;  //nao antecipou
                $dadosLanc['status'] = ABERTO;
             }
           }

         */

        for($nParcela = 1; $nParcela <= $qtd_parcela; $nParcela++) {
                
                     
                $dadosLanc['valor_titulo'] = str_replace(",", "." , $valor_parcela);//Realiza a conversão para o DB
             
              
                $dataInArray = date_parse($data_vencimento);
                $dataInTime = mktime(0, 0, 0, $dataInArray["month"], $dataInArray["day"], $dataInArray["year"]);
               
               
                $dadosLanc["data_vencimento"] = date("Y-m-d", strtotime("+" . $nParcela - $antecipacao . " month", $dataInTime));
                

                //$dadosLanc["parcela"] = $nParcela + 1; // pagamento não antecipado
                $dadosLanc["parcela"] = $nParcela; //pagamento antecipado
               
               
                $dadosLanc['id_forma'] = $dadosForm['id_forma'];
                
                /*if($dadosForm['id_forma']==FORMA_PAG_CREDITO || $dadosForm['id_forma']==FORMA_PAG_DEBITO ){
                  $dadosLanc['id_bandeira'] = $dadosForm['id_bandeira'];
                }*/

                $dadosLanc['data_pagamento'] = date('Y-m-d');

                $dadosLanc['status'] = PAGO;
                 $dadosLanc['pagamento_antecipado'] = SIM;
                

                //$dadosLanc["parcela"] = $nParcela;
                               
                $lancBusiness = $this->Factory->createBusiness("fin_lancamentos");
                $cod_lanc = $lancBusiness->cadastrar($dadosLanc);
                 
          }


          //echo "<script>alert(".$antecipacao.")</script>";

        //******FINAL CONTAS A RECEBER ****************
  


        //***** REALIZA O DESCONTO NO ESTOQUE
        $pedidoBusiness = $this->Factory->createBusiness("comp_pedidos");
        $objPedido = $pedidoBusiness->visualizar($dadosForm['id_pedido']);  
        
        $movimentacaoBusiness = $this->Factory->createBusiness("comp_movimentacao");

         //CONSULTA O PRODUTO PARA SABER SE O MESMO ESTÁ HABILITADO PARA REMOVER ITENS DO ESTOQUE
        $produtoBusiness = $this->Factory->createBusiness("comp_produtos");
        //realiza o desconto no estoque
        //pegar os itens do pedido
        //movimentação itens do traco
        
        foreach ($objPedido->getItens_pedidos() as $objMov):
          
           $objProduto = $produtoBusiness->visualizar($objMov->getId_produto()); 

            $dadosMov['id_produto'] = $objMov->getId_produto();
            $dadosMov['data'] = date('Y-m-d');
            $dadosMov['qtd_mov'] = $objMov->getQtd();
            $dadosMov['tipo_movimentacao'] = ADD_MOV;
            $dadosMov['id_pedido'] = $dadosForm['id_pedido'];
           // $dadosMov['valor_unitario'] = $objMov->getVa //$objProduto->getValor_venda();
            $dadosMov['valor_custo'] = $objMov->getValor_unitario(); //$objProduto->getValor_custo();

           
          
            
            //VERIFICA SE O PRODUTO ESTÁ HABILITADO NO ESTOQUE PARA RETIRADA
           // if($objProduto->getAbater_estoque()==SIM){ 
             $movimentacaoBusiness->cadastrar($dadosMov);
            //}
           
            // FINAL OPERAÇÕE ESTOQUE


        endforeach;
        //***** FINAL DESCONTO ESTOQUE ****************

      
        //******ALTERA O STATUS PARA FINALIZADO
         $pedidoBusiness = $this->Factory->createBusiness("comp_pedidos");
         $pedidoBusiness->alterar_status($dadosForm['id_pedido'],FINALIZADO);
        //******FINAL ALTERAÇÃO STATUS ****************


        //******ENVIA E-MAIL PARA O CLIENTE (caso o mesmo tenha no cadastro)
        //******FINAL ENVIO DE E-MAIL

      }

          
      //alterar status do pedido
      public function alterar_status($id_pedido){


         $this->load->helper(array('form','url'));
        
         $pedidoBusiness = $this->Factory->createBusiness("comp_pedidos");
         $pedidoBusiness->alterar_status($id_pedido,CANCELADO);

         redirect('pedidos/visualizar/'.$id_pedido);


      }


         //alterar status do pedido
      public function confirmar_comanda($id_pedido){


         $this->load->helper(array('form','url'));
        
         $pedidoBusiness = $this->Factory->createBusiness("com_pedidos");
         $status = APROVADO;
         $pedidoBusiness->alterar_status($id_pedido,$status);

         redirect('pedidos/comanda_add/'.$id_pedido);


      }

      //alterar de orçamento para pedido
      public function alterar_orcamento_pedido($id_pedido){

      }

      //CANCELAR PEDIDOS
      public function cancelar(){


             error_reporting(0);
          $this->load->helper(array('form','url'));

          $dados = $this->input->post();  
          $id_pedido = $dados['id_pedido_cancelar'];
          //senha informada
          $senha_informada = $dados['senha'];
          //criptografada
          $senha = md5($dados['senha'].CRIPTOGRAFIA);

          $userBusiness = $this->Factory->createBusiness("acesso_usuarios");
          $objUser = $userBusiness->visualizar(CODIGO_ADMINISTRADOR);
         

         if($objUser->getSenha()==$senha){

         //DESABILITAR PEDIDO
          $pedidoBusiness = $this->Factory->createBusiness("comp_pedidos");
          $pedidoBusiness->alterar_status($id_pedido,CANCELADO);
          
          //DESABILITAR ITENS PEDIDOS
         // $itemBusiness = $this->Factory->createBusiness("comp_pedidos_itens");
          //$itemBusiness->excluir_por_pedido($id_pedido);
          //DESABILITAR CONTA
          $contaBusiness = $this->Factory->createBusiness("fin_contas");
          $contaBusiness->excluir_por_pedido($id_pedido);
          //OBJ CONTA
          $objConta = $contaBusiness->visualizar_por_pedido($id_pedido);
          if($objConta!=null){
          //DESABILITAR LANÇAMENTO
           $lancBusiness = $this->Factory->createBusiness("fin_lancamentos");
           $lancBusiness->excluir_por_conta($objConta->getId_conta());
           }
          //MOVIMENTAÇÃO
          $movBusiness = $this->Factory->createBusiness("comp_movimentacao");
          $movBusiness->excluir_por_pedido($id_pedido);
  
          redirect("compras/filtro/".PEDIDO);
        }
        else{

          echo "<script>alert('OPERACAO NAO PERMITADA')</script>";
           echo "<script>window.location.href='".site_url('compras/filtro/2')."'</script>";

        }




      }

      //imprimir pedido
      public function imprimir($id_pedido){
      
        try {
            
         $this->load->helper(array('form', 'url'));
         $this->load->library('mpdf'); //carrega a biblioteca mpdf que está em aplication/libraries/mpdf
        

           //PEDIDOS
         $pedidosBusiness = $this->Factory->createBusiness("com_pedidos");
         $objPedido = $pedidosBusiness->visualizar($id_pedido);
         $info['objPedido'] = $objPedido;

          //ITENS SELECIONADOS
         $pedidosItensBusiness = $this->Factory->createBusiness("com_pedidos_itens");
         $listItens = $pedidosItensBusiness->listar($id_pedido);
         $info['listItens'] = $listItens;

          //LANÇAMENTOS
         $lancBusiness = $this->Factory->createBusiness("fin_lancamentos");
         $listLanc = $lancBusiness->listar_por_pedido($id_pedido);
         $info['listLanc'] = $listLanc;

        
         $content = $this->load->view('pedidos/impressao', $info,TRUE);
        
         $this->mpdf->setFooter('{PAGENO}'); //numero de paginas
         $this->mpdf->WriteHTML($content); // Converte os dados html para pdf
         $this->mpdf->Output(); //ger

        }

        catch (Exception $ex) {
            $this->loadError($ex);
        }


      }


       public function alterar_cliente(){

        $this->load->helper(array('form','url'));

        $dadosForm = $this->input->post();      

        $dados['id_pedido'] = $dadosForm['id_pedido'];
        $dados['id_cliente'] = $dadosForm['id_cliente'];

        $pedidoBusiness = $this->Factory->createBusiness("com_pedidos");
        $pedidoBusiness->alterar_cliente($dados);

      }

      //envia o pedido por e-mail
      public function enviar_email($id_pedido){

      }

      //alterar vendedor do pedido
      public function alterar_vendedor($id_pedido){

      }

        //alterar status do pedido
      public function teste($id_forma){


         $this->load->helper(array('form','url'));


        $formaBusiness = $this->Factory->createBusiness("fin_formas_pagamentos");
         $objForma = $formaBusiness->visualizar($id_forma);
           
           // SE A FORMA POSSUIR BANDEIRA NA FORMA DE PAGAMENTO CONSULTAR A ANTECIPAÇÃO NA BANDEIRA
           if($objForma->getCartao()==SIM){
             $bandeiraBusiness = $this->Factory->createBusiness("fin_bandeira_cartao");
             $objBandeira = $bandeiraBusiness->visualizar($dadosForm['id_bandeira']);
              if($objBandeira->getAntecipacao_pagamento()==SIM){
                $antecipacao = 0;  
              }
          }  

          // SE FOR OUTRAS FORMAS DE PAGAMENTOS BUSCAR ANTECIPAÇÃO NA FORMA DE PAGAMENTO 
          if($objForma->getCartao()==NAO || $objForma->getCartao()==""){
            if($objForma->getCrAntecipado()==CR_ANTECIPADO_SIM){
               $antecipacao = 0;  
             }else{
               $antecipacao = 1;  
             }
           }


           echo $antecipacao;
      


      }







      
      
}
?>
