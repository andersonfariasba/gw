<?php
/* Classe(controller): Pedidos
 * Autor: Anderson Farias
 * Última atualização: 01/10/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Locacao extends MY_Controller {
	
    //VALIDAÇÃO
    private function Rules(){
        $this->form_validation->set_rules('tipo','Tipo','required');
        $this->form_validation->set_rules('id_cliente','Cliente','required');
        $this->form_validation->set_rules('id_garcom','Garçom','required');
        $this->form_validation->set_error_delimiters('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');
 
    }

    private function RulesItem(){
        $this->form_validation->set_rules('qtd','Quantidade','required|callback_item_validar');
        //$this->form_validation->set_rules('codigo', 'Produto', 'required|alpha_numeric|callback_item_validar');
        //$this->form_validation->set_error_delimiters('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
    }


     private function RulesItemManual(){
        $this->form_validation->set_rules('qtd','Quantidade','required');
        $this->form_validation->set_rules('descricao','Descrição','required');
        $this->form_validation->set_rules('valor_unitario','Valor Unitário','required');
        
        $this->form_validation->set_error_delimiters('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');
    }

    //PRODUTOS OU SERVIÇOS PELO ESTOQUE
    public function solicitar_cliente($tipo,$id_cliente=null){
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
       

          
          $dados['tipo'] = $tipo;
          
          if($tipo==ORCAMENTO){
           $dados['orcamento'] = SIM;
          }

          $dados['status'] = ANDAMENTO;

          $dados['data_inicio'] = date('Y-m-d H:i:s');
          $dados['id_usuario'] =  $this->session->userdata('id_usuario');
          
          $pedidosBusiness = $this->Factory->createBusiness("com_pedidos");
         
          if($id_cliente==null){
           $dados['id_cliente'] = PAD_CAD_CLIENTE;
          }else{
            $dados['id_cliente'] = $id_cliente;
          }


          $dados['escopo'] = PRODUTO;
          $dados['locacao'] = SIM;
          $cod_pedido = $pedidosBusiness->cadastrar($dados);

          //redirect('pedidos/visualizar/'.$cod_pedido);

          redirect('locacao/novo/'.$cod_pedido);



    }

    //SERVIÇOS MANUAL
    public function solicitar_cliente2($tipo,$id_cliente=null){
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
       

          
          $dados['tipo'] = $tipo;
          
          /*if($tipo==PEDIDO){
           $dados['status'] = PROCESSAMENTO;
          }else{
            $dados['status'] = ANDAMENTO;
          }*/


          $dados['status'] = ANDAMENTO;

          $dados['data_inicio'] = date('Y-m-d H:i:s');
          $dados['id_usuario'] =  $this->session->userdata('id_usuario');
          
          $pedidosBusiness = $this->Factory->createBusiness("com_pedidos");
         
          if($id_cliente==null){
           $dados['id_cliente'] = PAD_CAD_CLIENTE;
          }else{
            $dados['id_cliente'] = $id_cliente;
          }


          $dados['escopo'] = SERVICO;
           $dados['locacao'] = SIM;
          $cod_pedido = $pedidosBusiness->cadastrar($dados);

          redirect('locacao/novo/'.$cod_pedido);      

    }





    //LISTAGEM
    public function filtro($tipo,$aba=null,$dados=null){
        try {
            $this->load->helper(array('form','url'));
            
            if ($this->input->post() == NULL) {
            
            //Pedidos
            $pedidosBusiness = $this->Factory->createBusiness("com_pedidos");
            $listPedido = $pedidosBusiness->filtro_loc($tipo);
            $info["listPedidos"] = $listPedido;

             //Listagem de Clientes
            $clientesBusiness = $this->Factory->createBusiness("com_clientes");
            $listCliente = $clientesBusiness->listar_cliente_orcamento();
            $info['listCliente'] = $listCliente;

             $userBusiness = $this->Factory->createBusiness("acesso_usuarios");
             $listUser = $userBusiness->filtro(null);
             $info['listUser'] = $listUser;

              $statusBusiness = $this->Factory->createBusiness("fin_status_pedido");
            $listStatus = $statusBusiness->filtro(null);
            $info['listStatus'] = $listStatus;


          
            $info['tipo'] = $tipo;

            $info['aba'] = $aba;
           
          
            
            $content = $this->load->view("locacao/filtro",$info,TRUE);
            $this->loadPage($content);

            } else{
            
            $dados = $this->input->post();
            
            
            //Pedidos
            $pedidosBusiness = $this->Factory->createBusiness("com_pedidos");
            $listPedido = $pedidosBusiness->filtro_loc($tipo,$dados);
            $info["listPedidos"] = $listPedido;

             //Listagem de Clientes
            $clientesBusiness = $this->Factory->createBusiness("com_clientes");
            $listCliente = $clientesBusiness->listar_cliente_orcamento();
            $info['listCliente'] = $listCliente;

              $userBusiness = $this->Factory->createBusiness("acesso_usuarios");
             $listUser = $userBusiness->filtro(null);
             $info['listUser'] = $listUser;

              $statusBusiness = $this->Factory->createBusiness("fin_status_pedido");
            $listStatus = $statusBusiness->filtro(null);
            $info['listStatus'] = $listStatus;

           
            $info['tipo'] = $tipo;

            $info['aba'] = $aba;
              
            $content = $this->load->view("locacao/filtro",$info,TRUE);
            $this->loadPage($content);  
              
            }
            
          } catch (Exception $exc) {
            $this->loadError($ex);
        }
    }


    public function filtro_entrega($id_pedido){
        try {
           
            $this->load->helper(array('form','url'));
            
                       
            //Pedidos
            $pedidosBusiness = $this->Factory->createBusiness("com_pedidos");
            $listPedido = $pedidosBusiness->filtro_entrega($id_pedido);
            $info["listPedidos"] = $listPedido;

             //Listagem de Clientes
            $clientesBusiness = $this->Factory->createBusiness("com_clientes");
            $listCliente = $clientesBusiness->listar_cliente_orcamento();
            $info['listCliente'] = $listCliente;

             $userBusiness = $this->Factory->createBusiness("acesso_usuarios");
             $listUser = $userBusiness->filtro(null);
             $info['listUser'] = $listUser;

              $statusBusiness = $this->Factory->createBusiness("fin_status_pedido");
            $listStatus = $statusBusiness->filtro(null);
            $info['listStatus'] = $listStatus;


          
            $info['tipo'] = PEDIDO;

           
            $info['aba'] = null;
           
          
            
            $content = $this->load->view("locacao/filtro",$info,TRUE);
            $this->loadPage($content);

          
            
          } catch (Exception $exc) {
            $this->loadError($ex);
        }
    }
    
    



    function pesquisar_cliente_auto()
    {
      $this->load->helper(array('form','url'));
      
      $this->load->model('autocomplete_model');
      
      $term = $this->input->post('term',TRUE);

      $rows = $this->autocomplete_model->BuscarCliente($term);

      //$rows = $this->autocomplete_model->BuscarCliente(array('keyword' => $term));

      $json_array = array();

      foreach ($rows as $row){
         
           
            $data[] = array(
                'label' => $row->nome_fantasia." - ".$row->cnpj_cpf,
                'value' =>$row->id_cliente
            );
            
            }
                    
      echo json_encode($data);
          
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
                'label' => $row->codigo." - ".$row->descricao." - R$".$row->valor_venda,
                'value' =>$row->id_produto,
                'valor_venda' =>$row->valor_venda
            );
            
            }
                    
      echo json_encode($data);
          
  }


   function novo($id){

    $this->load->helper(array('form','url'));
    $this->load->library('form_validation');
   
    //PEDIDO
    $pedidosBusiness = $this->Factory->createBusiness("com_pedidos");
    $objPedido = $pedidosBusiness->visualizar($id);
    $info['objPedido'] = $objPedido;

    //PRODUTOS
    $produtosBusiness = $this->Factory->createBusiness("est_produtos");
    $listProdutos = $produtosBusiness->listar_produto_servico_loc();
    $info['listProdutos'] = $listProdutos;

    //ITENS SELECIONADOS
    $pedidosItensBusiness = $this->Factory->createBusiness("com_pedidos_itens");
    $listItens = $pedidosItensBusiness->listar($id);
    $info['listItens'] = $listItens;

     $unidadeBusiness = $this->Factory->createBusiness("est_un_medida");
            $listUnidade = $unidadeBusiness->filtro();
            $info["listUnidade"] = $listUnidade;

  //Listagem de Clientes
    $clientesBusiness = $this->Factory->createBusiness("com_clientes");
    $listCliente = $clientesBusiness->listar_cliente_orcamento();
    $info['listCliente'] = $listCliente;

     $userBusiness = $this->Factory->createBusiness("acesso_usuarios");
     $listUser = $userBusiness->filtro(null);
     $info['listUser'] = $listUser;

      $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
            $listCategoria = $categoriaBusiness->filtro();
            $info["listCategoria"] = $listCategoria;

            $statusBusiness = $this->Factory->createBusiness("fin_status_pedido");
            $listStatus = $statusBusiness->filtro(null);
            $info['listStatus'] = $listStatus;

    $info["menu_geral"] = true;
    $info["footer"] = true;
    
    $info["tipo"] = $objPedido->getTipo();

    $this->load->view("locacao/novo",$info);
    

    }

    




    //2ª ETAPA - TELA DE PEDIDOS
   public function visualizar($id){

        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');

          $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
          $listCategoria = $categoriaBusiness->filtro(null);
          $info['listCategoria'] = $listCategoria;

         //PEDIDOS
         $pedidosBusiness = $this->Factory->createBusiness("com_pedidos");
         $objPedido = $pedidosBusiness->visualizar($id);
         $info['objPedido'] = $objPedido;
         
         $info['tipo'] = $objPedido->getTipo();
         
         //PRODUTOS
         $produtosBusiness = $this->Factory->createBusiness("est_produtos");
         $listProdutos = $produtosBusiness->listar_produto_servico();
         $info['listProdutos'] = $listProdutos;

         //ITENS SELECIONADOS
         $pedidosItensBusiness = $this->Factory->createBusiness("com_pedidos_itens");
         $listItens = $pedidosItensBusiness->listar($id);
         $info['listItens'] = $listItens;

          $formasBusiness = $this->Factory->createBusiness("fin_formas_pagamentos");
          $dadosRec['disponivel'] = FORMA_CONTA_RECEBER;
          $listFormas = $formasBusiness->filtro($dadosRec);
          $info['listFormas'] = $listFormas;


           //Listagem de Clientes
        $clientesBusiness = $this->Factory->createBusiness("com_clientes");
        $listCliente = $clientesBusiness->listar_cliente_orcamento();
        $info['listCliente'] = $listCliente;

         $userBusiness = $this->Factory->createBusiness("acesso_usuarios");
         $listUser = $userBusiness->filtro(null);
         $info['listUser'] = $listUser;
         
 
         
 
         $info["menu_geral"] = true;
         $info["footer"] = true;

        
       // $content = $this->load->view("pedidos/visualizar",$info,TRUE);
        $this->load->view("locacao/visualizar",$info);
        //$this->loadPage($content);      

  }




  //ADICIONAR ITENS DA COMANDA
  public function estoque_pesquisa($id){
      $this->load->helper(array('form','url'));
      //$this->load->library('form_validation');
      
     //$this->form_validation->set_rules('qtd','Quantidade','required');
    // $this->form_validation->set_error_delimiters('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');

         if ($this->input->post() == NULL) {
        //if($this->form_validation->run()==FALSE){
         
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
              
         
           //$info["menu_geral"] = true;
           //$content = $this->load->view("pedidos/estoque_pesquisa",$info,TRUE);
           //$this->loadPage($content);

          $info["menu_geral"] = true;
         $info["footer"] = true;

          $this->load->view("locacao/estoque_pesquisa",$info);


           

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
           $listProdutos = $produtosBusiness->pesquisa_geral($dadosEst);
           $info['listProdutos'] = $listProdutos;
          
            
         $info["menu_geral"] = true;
         $info["footer"] = true;

          $this->load->view("locacao/estoque_pesquisa",$info);


          //$info["menu_geral"] = true;
         
          //$content = $this->load->view("pedidos/estoque_pesquisa",$info,TRUE);
          //$this->loadPage($content);

         }

}


 //ADICIONAR ITENS DA COMANDA
  public function add_produto_venda($id){
      $this->load->helper(array('form','url'));
      //$this->load->library('form_validation');
      
     //$this->form_validation->set_rules('qtd','Quantidade','required');
    // $this->form_validation->set_error_delimiters('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');

         if ($this->input->post() == NULL) {
        //if($this->form_validation->run()==FALSE){
         
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
              
         
           //$info["menu_geral"] = true;
           //$content = $this->load->view("pedidos/estoque_pesquisa",$info,TRUE);
           //$this->loadPage($content);

          $info["menu_geral"] = true;
          $info["footer"] = true;

          $this->load->view("locacao/add_produto_venda",$info);


           

         }
         
         else{

           $dados = $this->input->post();

           //$dadosEst['codigo'] = $dados['codigo'];
           //$dadosEst['descricao'] = $dados['descricao'];
           //$dadosEst['id_fornecedor'] = null;
           //$dadosEst['id_categoria'] = null;

           
           //PEDIDOS
         $pedidosBusiness = $this->Factory->createBusiness("com_pedidos");
         $objPedido = $pedidosBusiness->visualizar($dados['id_pedido']);
         $info['objPedido'] = $objPedido;

         

          if($dados['descricao']=="" || $dados['valor_venda']==""){
            echo "<script>alert('Campos Descricao e Valor de Venda nao podem ser vazio.')</script>";
            echo "<script>history.back()</script>";    
          exit;
          }
           
          $dados['status'] = ATIVO;
          $dados['data_cadastro'] = date('Y-m-d');
          $dados['habilitado_venda'] = SIM;
          $produtosBusiness = $this->Factory->createBusiness("est_produtos");
          $cod_produto = $produtosBusiness->cadastrar($dados);


           $produtosBusiness = $this->Factory->createBusiness("est_produtos");
           $listProdutos = $produtosBusiness->pesquisa_geral(null);
           $info['listProdutos'] = $listProdutos;
          
            
         $info["menu_geral"] = true;
         $info["footer"] = true;

          $this->load->view("locacao/estoque_pesquisa",$info);


          //$info["menu_geral"] = true;
         
          //$content = $this->load->view("pedidos/estoque_pesquisa",$info,TRUE);
          //$this->loadPage($content);

         }

}



        
public function buscar_cliente(){
          $this->load->helper(array('form','url'));

             $dadosForm = $this->input->post();      

          
            $pedidoBusiness = $this->Factory->createBusiness("com_pedidos");
            $objPedido = $pedidoBusiness->visualizar($dadosForm['id_pedido']);

           
            $dados['cnpj_cpf'] = $dadosForm['cnpj_cpf'];
            
            $clientesBusiness = $this->Factory->createBusiness("com_clientes");
            $objCliente = $clientesBusiness->verificar_existente($dados['cnpj_cpf']);
             
            if($objCliente==null || $dados['cnpj_cpf']==null){
              echo 0;
            } else{
              echo 1;
            }                  
                        
                       
            
            $dadosPedido['id_pedido'] = $dadosForm['id_pedido'];
            $dadosPedido['id_cliente'] = $objCliente->getId_cliente();
            
            $cod_pedido = $pedidoBusiness->salvar_pedido($dadosPedido);

                       
            
          

    }

        

        public function incluir_cliente(){
          $this->load->helper(array('form','url'));

           $dadosForm = $this->input->post();      

           //Pegar valor do produto
            $pedidoBusiness = $this->Factory->createBusiness("com_pedidos");
            $objPedido = $pedidoBusiness->visualizar($dadosForm['id_pedido']);

           
            $dados['tipo'] = $dadosForm['tipo'];
            $dados['nome_fantasia'] = $dadosForm['nome_fantasia'];
            $dados['cnpj_cpf'] = $dadosForm['cnpj_cpf'];
             $dados['telefone1'] = $dadosForm['telefone1'];
            $dados['data_cadastro'] = date('Y-m-d');
            $dados['status'] = ATIVO;
            $dados['deletado'] = DELETADO;

            $clientesBusiness = $this->Factory->createBusiness("com_clientes");
            $objCliente = $clientesBusiness->verificar_existente($dados['cnpj_cpf']);
                                     

           if($objCliente==null || $dados['cnpj_cpf']==null){
            
            $clientesBusiness = $this->Factory->createBusiness("com_clientes");
            $cod_cliente = $clientesBusiness->cadastrar($dados);

            $dadosPedido['id_pedido'] = $dadosForm['id_pedido'];
            $dadosPedido['id_cliente'] = $cod_cliente;

           $dadosEntrega['id_cliente'] = $cod_cliente;
           $dadosEntrega['deletado'] = DELETADO;


           $entregaBusiness = $this->Factory->createBusiness("com_clientes_end_entrega");
           $cod_entrega = $entregaBusiness->cadastrar($dadosEntrega);
           $cod_pedido = $pedidoBusiness->salvar_pedido($dadosPedido);
         }
         else{

          echo 1;


         }
            
            
          

    }


     public function incluir_novo_produto(){
          $this->load->helper(array('form','url'));

           $dados = $this->input->post();      

         
           $dados['status'] = ATIVO;
           $dados['data_cadastro'] = date('Y-m-d');
           $dados['habilitado_venda'] = SIM;
           $dados['deletado'] = DELETADO;
           $dados['id_fornecedor'] = PAD_CAD_FORNECEDOR;
           $dados['valor_venda'] = str_replace(",",".",str_replace(".","",$dados['valor_venda']));
           $produtosBusiness = $this->Factory->createBusiness("est_produtos");
          
           $objProduto = $produtosBusiness->visualizar_por_codigo($dados['codigo']);
                                     

           if($objProduto==null || $dados['codigo']==null){
            
            $cod_produto = $produtosBusiness->cadastrar($dados);
         }
         
         else{

          echo 1;


         }
            
            
          

    }




       //add item consulta
      //public function add_item_consulta($item,$pedido,$qtd){
       public function editar_pedido(){
          $this->load->helper(array('form','url'));

           $dadosForm = $this->input->post();      

           //Pegar valor do produto
            $pedidoBusiness = $this->Factory->createBusiness("com_pedidos");
            $objPedido = $pedidoBusiness->visualizar($dadosForm['id_pedido']);
                      
            
              $dados['id_pedido'] = $dadosForm['id_pedido'];
              $dados['hora_retirada'] = $dadosForm['hora_retirada'];
              $dados['id_cliente'] = $dadosForm['id_cliente']; 
              $dados['id_usuario'] = $dadosForm['id_usuario'];
              //$dados['status'] = $dadosForm['status'];
              $dados['observacao'] = trim($dadosForm['observacao']);
              $objDateFormat = $this->DateFormat;
              $hora = date('H:m');
              $data_inicio = $objDateFormat->date_mysql($dadosForm['data_inicio']);
              $dados['data_inicio'] = $data_inicio." ".$hora;
              $data_final = $objDateFormat->date_mysql($dadosForm['data_final']);
              
              if($dadosForm['data_final']!=""){
               $dados['data_final'] = $data_final." ".$hora;
              }

               if($dadosForm['data_validade']!=""){
               $dados['data_validade'] = $objDateFormat->date_mysql($dadosForm['data_validade']);
              }



              
            // ORÇAMENTO -> VENDAS  
            if($objPedido->getTipo()==ORCAMENTO && $dadosForm['tipo']==PEDIDO){            
                            
               $dados['tipo'] = PEDIDO;
               $dados['status'] = ANDAMENTO;
               //$dados['codigo'] = $pedidoBusiness->gerar_codigo();
             }


             
            $cod_pedido = $pedidoBusiness->salvar_pedido($dados);
            
            
          

    }




     //add item consulta
      //public function add_item_consulta($item,$pedido,$qtd){
       public function add_item_consulta(){
          $this->load->helper(array('form','url'));

           $dadosForm = $this->input->post();      

           $itemBusiness = $this->Factory->createBusiness("com_pedidos_itens");

            //Pegar valor do produto
            $produtosBusiness = $this->Factory->createBusiness("est_produtos");
            $objProduto = $produtosBusiness->visualizar($dadosForm['id_produto']);
                      
            $dados['valor_unitario'] = $objProduto->getValor_venda();
            $dados['data_inclusao'] = date('Y-m-d'); 
            $dados['qtd'] = $dadosForm['quantidade'];
            $dados['id_pedido'] = $dadosForm['id_pedido'];
            $dados['id_produto'] = $dadosForm['id_produto'];
            
            $cod_item = $itemBusiness->cadastrar($dados);
            
            
            //echo "<script>window.opener.location.href='".site_url('pedidos/visualizar/'.$pedido)."'</script>";
            //echo "<script>window.close();</script>"; 
            

            //redirect('pedidos/visualizar/'.$pedido);

    }





   

 //ADICIONAR ITENS AO ORÇAMENTO
  public function add_item($id){
      $this->load->helper(array('form','url'));
      $this->load->library('form_validation');
      
      $this->RulesItem();

         //if ($this->input->post() == NULL) {
        if($this->form_validation->run()==FALSE){
         
            //PEDIDOS
         $pedidosBusiness = $this->Factory->createBusiness("com_pedidos");
         $objPedido = $pedidosBusiness->visualizar($id);
         $info['objPedido'] = $objPedido;

            $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
          $listCategoria = $categoriaBusiness->filtro(null);
          $info['listCategoria'] = $listCategoria;
         
         //PRODUTOS
          $produtosBusiness = $this->Factory->createBusiness("est_produtos");
    $listProdutos = $produtosBusiness->listar_produto_servico_loc();
    $info['listProdutos'] = $listProdutos;
         
        //ITENS SELECIONADOS
         $pedidosItensBusiness = $this->Factory->createBusiness("com_pedidos_itens");
         $listItens = $pedidosItensBusiness->listar($id);
         $info['listItens'] = $listItens;

         $info["menu_geral"] = true;
         $info["footer"] = true;
         $info["tipo"] = $objPedido->getTipo();

         $formasBusiness = $this->Factory->createBusiness("fin_formas_pagamentos");
          $dadosRec['disponivel'] = FORMA_CONTA_RECEBER;
          $listFormas = $formasBusiness->filtro($dadosRec);
          $info['listFormas'] = $listFormas;


           //Listagem de Clientes
        $clientesBusiness = $this->Factory->createBusiness("com_clientes");
        $listCliente = $clientesBusiness->listar_cliente_orcamento();
        $info['listCliente'] = $listCliente;

         $userBusiness = $this->Factory->createBusiness("acesso_usuarios");
         $listUser = $userBusiness->filtro(null);
         $info['listUser'] = $listUser;
         

          $this->load->view("locacao/novo",$info);
         //  $content = $this->load->view("pedidos/visualizar",$info,TRUE);
          // $this->loadPage($content);

           //redirect('pedidos/visualizar/'.$id_pedido);

         }
         else{

           $dados = $this->input->post();
           $dados['data_inclusao'] = date('Y-m-d'); 
           $itemBusiness = $this->Factory->createBusiness("com_pedidos_itens");

            //Pegar valor do produto
          
           $objDateFormat = $this->DateFormat;
           $dados['data_inicio'] = $objDateFormat->date_mysql($dados['data_inicio']);
           $dados['data_prev_entrega'] = $objDateFormat->date_mysql($dados['data_prev_entrega']);

            if($dados['tipo_item']==1 || $dados['tipo_item']==2){
            $produtosBusiness = $this->Factory->createBusiness("est_produtos");
            $objProduto = $produtosBusiness->visualizar_por_codigo($dados['codigo']);
                
            
            if($objProduto!=null){
              $dados['valor_unitario'] = $dados['valor_unitario']; //$objProduto->getValor_venda();
              $dados['id_produto'] = $objProduto->getId_produto();
              $dados['produto_nome'] = $objProduto->getDescricao(); 
              $cod_item = $itemBusiness->cadastrar($dados);
             }

           }
           
           else if($dados['tipo_item']==3){
               $dados['id_produto'] = NULL;
               $cod_item = $itemBusiness->cadastrar($dados);
           }  


            redirect('locacao/novo/'.$dados["id_pedido"]);
            


         }

  }



  //ADICIONAR ITENS AO ORÇAMENTO
  public function add_item_manual($id){
      $this->load->helper(array('form','url'));
      $this->load->library('form_validation');
      
      $this->RulesItemManual();

         //if ($this->input->post() == NULL) {
        if($this->form_validation->run()==FALSE){
         
            //PEDIDOS
         $pedidosBusiness = $this->Factory->createBusiness("com_pedidos");
         $objPedido = $pedidosBusiness->visualizar($id);
         $info['objPedido'] = $objPedido;

            $categoriaBusiness = $this->Factory->createBusiness("est_categorias");
          $listCategoria = $categoriaBusiness->filtro(null);
          $info['listCategoria'] = $listCategoria;
         
         //PRODUTOS
         $produtosBusiness = $this->Factory->createBusiness("est_produtos");
         $listProdutos = $produtosBusiness->listar_produto_servico();
         $info['listProdutos'] = $listProdutos;
         
        //ITENS SELECIONADOS
         $pedidosItensBusiness = $this->Factory->createBusiness("com_pedidos_itens");
         $listItens = $pedidosItensBusiness->listar($id);
         $info['listItens'] = $listItens;

         $info["menu_geral"] = true;
         $info["footer"] = true;
         $info["tipo"] = $objPedido->getTipo();

         $formasBusiness = $this->Factory->createBusiness("fin_formas_pagamentos");
          $dadosRec['disponivel'] = FORMA_CONTA_RECEBER;
          $listFormas = $formasBusiness->filtro($dadosRec);
          $info['listFormas'] = $listFormas;


           //Listagem de Clientes
        $clientesBusiness = $this->Factory->createBusiness("com_clientes");
        $listCliente = $clientesBusiness->listar_cliente_orcamento();
        $info['listCliente'] = $listCliente;

         $userBusiness = $this->Factory->createBusiness("acesso_usuarios");
         $listUser = $userBusiness->filtro(null);
         $info['listUser'] = $listUser;
         

          $this->load->view("locacao/visualizar",$info);
         //  $content = $this->load->view("pedidos/visualizar",$info,TRUE);
          // $this->loadPage($content);

           //redirect('pedidos/visualizar/'.$id_pedido);

         }
         else{

           $dados = $this->input->post();
           $dados['data_inclusao'] = date('Y-m-d'); 
           $itemBusiness = $this->Factory->createBusiness("com_pedidos_itens");
           $dados['valor_unitario'] =  str_replace(",",".",str_replace(".","",$dados['valor_unitario']));
           $cod_item = $itemBusiness->cadastrar($dados);

            //Pegar valor do produto
            //$produtosBusiness = $this->Factory->createBusiness("est_produtos");
            //$objProduto = $produtosBusiness->visualizar_por_codigo($dados['codigo']);

                
            
            /*if($objProduto!=null){
              $dados['valor_unitario'] = $objProduto->getValor_venda();
              $dados['id_produto'] = $objProduto->getId_produto();
              $cod_item = $itemBusiness->cadastrar($dados);
             }*/


            redirect('locacao/visualizar/'.$dados["id_pedido"]);
            


         }

  }



    

  public function item_validar($id_pedido,$codigo) {
        try {
            
            $pedido = $this->input->post("id_pedido");
            $produto = $this->input->post("codigo");
            $tipo_item = $this->input->post("tipo_item");
            $produto_nome = $this->input->post("produto_nome");

            if($tipo_item!=3){

            $pedidoBus = $this->Factory->createBusiness("est_produtos");
         
            if ($pedidoBus->visualizar_por_codigo($produto)) {
                return TRUE;
            } else {
                $this->form_validation->set_message('item_validar', 'Produto não encontrado no estoque.');
                return FALSE;
            }

           }
             else{

                if($produto_nome!=""){
                  return TRUE;
                } 

                else{

                  $this->form_validation->set_message('item_validar', '<strong>Descrição Obrigatória.</strong>');
                return FALSE;

                }

           }





        } catch (Excpeption $ex) {
            $this->loadError($ex);
        }
    }





   //EXCLUSÃO DE ITENS
      public function excluir_item($id_item,$id_pedido){
          $this->load->helper(array('form','url'));

          $itemBusiness = $this->Factory->createBusiness("com_pedidos_itens");
          $itemBusiness->excluir($id_item);
          redirect("locacao/novo/".$id_pedido);
      }



      //CONFIRMAR ORÇAMENTO
      public function confirmar_orcamento($id_pedido){
          $this->load->helper(array('form','url'));

          $dados = $this->input->post();

          $pedidoBusiness = $this->Factory->createBusiness("com_pedidos");
          $pedidoBusiness->confirmar_orcamento($dados);

          redirect("locacao/visualizar/".$id_pedido);
          
          //redirect("pedidos/filtro/".ORCAMENTO);
      }


     


       //ALTERAR ORÇAMENTO PARA PEDIDO
      public function alterar_tipo($id_pedido){
        
          $this->load->helper(array('form','url'));      
          $pedidoBusiness = $this->Factory->createBusiness("com_pedidos");
          $pedidoBusiness->alterar_tipo($id_pedido);

          redirect("locacao/visualizar/".$id_pedido);
      }
 
       
    

      
       //ADIÇÃO DE FATURAMENTO DAS FORMAS DE PAGAMENTOS
       public function add_forma_pagamento(){

        $this->load->helper(array('form','url'));

        $dadosForm = $this->input->post();

        //CAPTURA OS DADOS DO PEDIDO
        $dados['id_pedido'] = $dadosForm['id_pedido'];
        $dados['id_forma'] =  $dadosForm['id_forma'];
        $dados['parcela'] = $dadosForm['qtd_parcela_pag'];
        $dados['valor'] =  str_replace(",",".",str_replace(".","",$dadosForm['valor_pago_forma']));
        $dados['status'] = ABERTO;
        $dados['parcelado'] = ABERTO;
        $dados['antecipado'] = ABERTO;
        $dados['id_usuario'] =  $this->session->userdata('id_usuario');
        $dados['data'] = date('Y-m-d H:i:s');
        $dados['data_vencimento'] = $dadosForm['data_vencimento'];

        $pedidoBusiness = $this->Factory->createBusiness("com_pedidos");
        $objPedido = $pedidoBusiness->visualizar($dados['id_pedido']);

        //Faturamento
        $formaBusiness = $this->Factory->createBusiness("fin_forma_pag_fat");
        $id_forma_fat = $formaBusiness->cadastrar($dados);

        //CRIA OBJETO DE FORMA DE RECEBIMENTO SELECIONADA
        $formaBusiness = $this->Factory->createBusiness("fin_formas_recebimentos");
        $objForma = $formaBusiness->visualizar($dados['id_forma']);

        //INCLUIR OS DADOS NA TABELA DE CONTA COM FLAG DELETADO_FATURADO
        $dadosConta['id_pedido'] = $dadosForm['id_pedido'];
        $dadosConta['tipo'] = CONTAS_RECEBER;
        $dadosConta['valor_total'] = str_replace(",",".",str_replace(".","",$dadosForm['valor_pedido']));
        $dadosConta['parcela_qtd'] = $dadosForm['qtd_parcela_pag'];
        $dadosConta['deletado'] = DELETADO_FATURADO;
        $dadosConta['data'] = date('Y-m-d');
        $dadosConta['id_cliente'] = $objPedido->getId_cliente();

        
        //PROCESSO PARA TER APENAS UMA CONTA VINCULADO A OUTROS LANÇAENTOS
        $contaBusiness = $this->Factory->createBusiness("fin_contas_receber");
        $objConta = $contaBusiness->visualizar_por_pedido($dadosForm['id_pedido']);
        //CASO SEJA O PRIMEIRO REGISTRO REALIZA O CADATRO, CASO PRECISA APENAS DO ID DA CONTA        
        if($objConta==null){
         $id_conta = $contaBusiness->cadastrar($dadosConta);
        }
        else{
          $id_conta = $objConta->getId_conta();
        }
        //FINAL CONTAS

        
        //INICIO TRANSAÇÃO DOS LANÇAMENTOS
          
          //VERIFICA SE O TIPO DE FORMA ESTÁ CONFIGURADO PARA PARCELADO
          if($objForma->getTipo()==TIPO_REC_PARCELADO){
          
            $nParcelas = $dadosForm['qtd_parcela_pag'];
          }
          
          else{

            $nParcelas = 1;  
          }

          //VERIFICA OS DIAS DE COMPENSAÇÃO
          if($objForma->getQtd_dia_compensa()!=null){
                  $dias = $objForma->getQtd_dia_compensa(); 
          }
                
          else{
                  $dias = 1;
          }

         
          //BUSCA TAXA OPERADORA CARTÃO SIMPLES
          if($objForma->getCartao()==SIM && $objForma->getTaxa_tipo()==TAXA_UNICA ){
            $dadosLanc['transacao_cartao'] = SIM;
            $dadosLanc['taxa_operadora_cartao'] = $objForma->getTaxa();
          }
          
          //BUSCA TAXA OPERADORA CARTÃO - TABELA 
          else if($objForma->getCartao()==SIM && $objForma->getTaxa_tipo()==TAXA_TABELA ){
            
            $dadosLanc['transacao_cartao'] = SIM;
            $taxaBusiness = $this->Factory->createBusiness("fin_tabela_taxa");
            
            if($objForma->getId_tabela_nome()!=NULL || $objForma->getId_tabela_nome()!=0){
              $dadosLanc['taxa_operadora_cartao'] = $taxaBusiness->visualizar_taxa($objForma->getId_tabela_nome(),$dadosForm['qtd_parcela_pag']);
             }
             
          }




         for($x = 1; $x <= $nParcelas; $x++){

          $total_dias = $dias * $x;
          
          $vencimento = date('d-m-Y');  
          
          $dadosLanc['id_conta'] = $id_conta;
          $dadosLanc['id_forma_fat'] = $id_forma_fat;
          $dadosLanc['id_forma'] = $dadosForm['id_forma'];
          
          //SE FOR DIFERENTE DE DATA MANUAL REFERENTE AO TIPO DE FORMA DE RECEBIMENTO
          if($objForma->getData_vencimento_manual()!=SIM){
           $dadosLanc['data_vencimento'] = date('Y-m-d', strtotime("+$total_dias days",strtotime($vencimento)));
          }
          else
           {
             $objDateFormat = $this->DateFormat;
             $dadosLanc['data_vencimento'] = $objDateFormat->date_mysql($dadosForm['data_vencimento']);
          }

          //SE O STATUS FINANCEIRO DA FORMA FOR PAGO, DATA DE PAGAMENTO SERÁ IGUAL A DE VENCIMENTO
          if($objForma->getStatus_financeiro()==PAGO){
            $dadosLanc['data_pagamento'] = $dadosLanc['data_vencimento'];
          }

          $dadosLanc['valor_titulo'] = str_replace(",",".",str_replace(".","",$dadosForm['valor_pago_forma'])) / $nParcelas; //$dadosForm['qtd_parcela_pag'];
          $dadosLanc['status'] = $objForma->getStatus_financeiro(); 
          $dadosLanc['deletado'] = DELETADO_FATURADO;
          $dadosLanc['parcela'] = $x;

          $lancBusiness = $this->Factory->createBusiness("fin_lancamentos_receber");
          $cod_lanc = $lancBusiness->cadastrar($dadosLanc);

        
         }



        
      
      }



  //FINAL FATURAMENTO


    public function ajax_listar_faturamento($id_pedido){

      //header( 'Cache-Control: no-cache' );
      //header( 'Content-type: application/xml; charset="utf-8"', true );
      
      $this->load->helper(array('form','url'));

      $fatBusiness = $this->Factory->createBusiness("fin_forma_pag_fat");
      $listFat = $fatBusiness->ajax_listar_faturamento($id_pedido);
     
      echo json_encode($listFat); 
    
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
         $pedidoBusiness = $this->Factory->createBusiness("com_pedidos");
         $pedidoBusiness->salvar_pedido($dados);

    }



     
  //CONFIRMA FORMA DE PAGAMENTO A VISTA
  public function finalizar_pedido_dinheiro(){

    $this->load->helper(array('form','url'));

    $dadosForm = $this->input->post();  

    //DADOS DO PEDIDO
    $dadosAdd['id_pedido'] =  $dadosForm['id_pedido'];
    
   

    /*$dadosAdd['desconto_perc'] =   str_replace(",",".",str_replace(".","",$dadosForm['descontoFlag'])); 
    $dadosAdd['desconto'] =   str_replace(",",".",str_replace(".","",$dadosForm['desconto_perc'])); 
    
    $dadosAdd['taxa_frete'] = str_replace(",",".",str_replace(".","",$dadosForm['taxa_freteFlag'])); 
    */

    $dadosAdd['desconto_perc'] = $dadosForm['descontoFlag'];
    $dadosAdd['desconto'] = $dadosForm['desconto_perc'];
    $dadosAdd['taxa_frete'] = $dadosForm['taxa_freteFlag'];

    
    $dadosAdd['observacao'] = $dadosForm['observacaoFlag'];
    
    $dadosAdd['valor_total'] = str_replace(",",".",str_replace(".","",$dadosForm['total_pagar'])); //total pedido sem desconto e taxas
    //FINAL DADOS DO PEDIDO

     //GERAR CÓDIGO PEDIDO SEQUENCIAL
     $pedidoBusiness = $this->Factory->createBusiness("com_pedidos");
     $dadosAdd['codigo'] = $pedidoBusiness->gerar_codigo();
     $dadosAdd['faturado'] = SIM;
    $dadosAdd['status'] = FECHADO;
 
     //ALTERAR DADOS DO PEDIDO
     $pedidoBusiness->salvar_pedido($dadosAdd);

     //INCLUIR NA TABELA DE CONTA
      $dadosConta['id_pedido']  = $dadosForm['id_pedido'];
      $dadosConta['id_cliente'] = $dadosForm['id_cliente'];
      $dadosConta['tipo'] = CONTAS_RECEBER;
      $dadosConta['valor_total'] =  $dados['valor'] =  str_replace(",",".",str_replace(".","",$dadosForm['total_pagar']));
       //$dadosForm['total_pagar'];
      $dadosConta['parcela_qtd'] = 1;
      $dadosConta['data'] = date('Y-m-d');
      $dadosConta['deletado'] = DELETADO;
      $dadosConta['descricao'] = "VENDA Nº ". $dadosAdd['codigo'];

      $contaBusiness = $this->Factory->createBusiness("fin_contas_receber");
      $id_conta = $contaBusiness->cadastrar($dadosConta);
      // FINAL OPERAÇÃO CONTA

      //INCLUIR NA TABELA DE LANÇAMENTOS A RECEBER
      $dadosLanc['id_conta'] = $id_conta;
      $dadosLanc['id_forma'] = FORMA_REC_DINHEIRO;
      $dadosLanc['parcela'] = 1;
      $dadosLanc['valor_titulo'] = $dadosConta['valor_total'];
      $dadosLanc['descricao'] = "VENDA Nº ". $dadosAdd['codigo'];
      $dadosLanc['data_vencimento'] = date('Y-m-d');
      $dadosLanc['data_pagamento'] = date('Y-m-d');
      $dadosLanc['pagamento_antecipado'] = SIM;
      $dadosLanc['status'] = PAGO;
      $dadosLanc['deletado'] = DELETADO;

      $lancBusiness = $this->Factory->createBusiness("fin_lancamentos_receber");
      $cod_lanc = $lancBusiness->cadastrar($dadosLanc);
      //FINAL INCLUSÃO LANÇAMENTO A RECEBER

      
      //REDUZIR ITENS DO ESTOQUE
      $pedidoBusiness = $this->Factory->createBusiness("com_pedidos");
      $objPedido = $pedidoBusiness->visualizar($dadosForm['id_pedido']);  

      //GRAVA NA TABELA DE COMISSAO
      $dadosCom['id_pedido'] = $objPedido->getId_pedido();
      $dadosCom['id_usuario'] = $objPedido->getId_usuario();
      $dadosCom['data'] = date('Y-m-d');
      $dadosCom['percentual'] = $objPedido->getUsuario()->getColaborador()->getComissao_venda();
      $dadosCom['valor_venda'] = $objPedido->getValor_total();

      $comissaoBusiness = $this->Factory->createBusiness("fin_comissao");
      $cod_comissao = $comissaoBusiness->cadastrar($dadosCom);

      //FINAL TABELA DE COMISSAO

        
        
         if($objPedido->getEscopo()==PRODUTO){
        $movimentacaoBusiness = $this->Factory->createBusiness("est_movimentacao");

         //CONSULTA O PRODUTO PARA SABER SE O MESMO ESTÁ HABILITADO PARA REMOVER ITENS DO ESTOQUE
        $produtoBusiness = $this->Factory->createBusiness("est_produtos");
        //realiza o desconto no estoque
        //pegar os itens do pedido
        //movimentação itens do traco
        
        foreach ($objPedido->getItens_pedidos() as $objMov):
          
           $objProduto = $produtoBusiness->visualizar($objMov->getId_produto()); 

            $dadosMov['id_produto'] = $objMov->getId_produto();
            $dadosMov['data'] = date('Y-m-d');
            $dadosMov['qtd_mov_saida'] = $objMov->getQtd();
            $dadosMov['tipo_movimentacao'] = REMOVER_MOV;
            $dadosMov['id_pedido'] = $dadosForm['id_pedido'];
            $dadosMov['valor_unitario'] = $objMov->getValor_unitario(); //$objProduto->getValor_venda();
            $dadosMov['valor_custo'] = $objProduto->getValor_custo();
            $dadosMov['tipo_retirada'] = MOV_VENDA;
            $dadosMov['descricao'] = "VENDA Nº". $dadosAdd['codigo'];
            $dadosMov['responsavel'] = $this->session->userdata('login');
            $dadosMov['id_usuario'] = $this->session->userdata('id_usuario');
      
          
          $movimentacaoBusiness->cadastrar($dadosMov);
           
            // FINAL OPERAÇÕE ESTOQUE


        endforeach;
        
        } //final escopo produto para movimentação

        //******ALTERA O STATUS PARA FINALIZADO
        
         //$pedidoBusiness = $this->Factory->createBusiness("com_pedidos");
         //$pedidoBusiness->alterar_status($dadosForm['id_pedido'],FINALIZADO);
        
        //******FINAL ALTERAÇÃO STATUS ****************


        

      //FINAL REDUZIR ITENS DO ESTOQUE

}



 //SALVAR COTAÇÃO
  public function salvar_cotacao(){

    $this->load->helper(array('form','url'));

    $dadosForm = $this->input->post();  

    //DADOS DO PEDIDO
    $dadosAdd['id_pedido'] =  $dadosForm['id_pedido'];
    $dadosAdd['desconto'] =   str_replace(",",".",str_replace(".","",$dadosForm['descontoFlag'])); 
    $dadosAdd['desconto_perc'] =   str_replace(",",".",str_replace(".","",$dadosForm['desconto_perc'])); 
    $dadosAdd['taxa_frete'] = str_replace(",",".",str_replace(".","",$dadosForm['taxa_freteFlag'])); 
    //$dadosAdd['observacao'] = $dadosForm['observacaoFlag'];
    $dadosAdd['valor_total'] = str_replace(",",".",str_replace(".","",$dadosForm['total_pedido'])); //total pedido sem desconto e taxas
    //FINAL DADOS DO PEDIDO

    $pedidoBusiness = $this->Factory->createBusiness("com_pedidos");

     $objPedido = $pedidoBusiness->visualizar($dadosForm['id_pedido']);
         
         if($objPedido->getCodigo_orcamento()==""){
             $dadosAdd['codigo_orcamento'] = $pedidoBusiness->gerar_codigo_orcamento();
          }


     
     //ALTERAR DADOS DO PEDIDO
     $pedidoBusiness->salvar_pedido($dadosAdd);

    

}

//SALVAR COTAÇÃO
  public function cotacao_venda(){

    $this->load->helper(array('form','url'));

    $dadosForm = $this->input->post();  

    //DADOS DO PEDIDO
    $dadosAdd['tipo'] = PEDIDO;
    $dadosAdd['id_pedido'] = $dadosForm['id_pedido'];
    $dadosAdd['desconto'] =   str_replace(",",".",str_replace(".","",$dadosForm['descontoFlag'])); 
    $dadosAdd['desconto_perc'] =   str_replace(",",".",str_replace(".","",$dadosForm['desconto_perc'])); 
    $dadosAdd['taxa_frete'] = str_replace(",",".",str_replace(".","",$dadosForm['taxa_freteFlag'])); 
    //$dadosAdd['observacao'] = $dadosForm['observacaoFlag'];
    $dadosAdd['valor_total'] = str_replace(",",".",str_replace(".","",$dadosForm['total_pedido'])); //total pedido sem desconto e taxas
    //FINAL DADOS DO PEDIDO

     $pedidoBusiness = $this->Factory->createBusiness("com_pedidos");
     //ALTERAR DADOS DO PEDIDO
     $pedidoBusiness->salvar_pedido($dadosAdd);

    

}


public function alterar_cotacao_filtro($id_pedido){

    $this->load->helper(array('form','url'));

   
    //DADOS DO PEDIDO
    $dadosAdd['tipo'] = PEDIDO;
    $dadosAdd['id_pedido'] = $id_pedido;

    
     $pedidoBusiness = $this->Factory->createBusiness("com_pedidos");
     //ALTERAR DADOS DO PEDIDO
     $dadosAdd['codigo'] = $pedidoBusiness->gerar_codigo();
     $pedidoBusiness->salvar_pedido($dadosAdd);

     redirect("locacao/filtro/".PEDIDO);

    

}


 

  //CONFIRMA FORMA DE PAGAMENTO A VISTA
  public function finalizar_pedido_multipla(){

    $this->load->helper(array('form','url'));

    $dadosForm = $this->input->post();  
     
     //DADOS DO PEDIDO
     $pedidoBusiness = $this->Factory->createBusiness("com_pedidos");
     $objPedido = $pedidoBusiness->visualizar($dadosForm['id_pedido']);  

     //PEGAR CÓDIGO DA CONTA
     $contaBusiness = $this->Factory->createBusiness("fin_contas_receber");
     $objConta = $contaBusiness->visualizar_por_pedido($objPedido->getId_pedido());
     
     //FATURAR CONTA
     $faturar_conta = $contaBusiness->confirmar_faturamento_conta($objPedido->getId_pedido());
     
     //ALTERAR FATURAMENTO DA CONTA
     $lancBusiness = $this->Factory->createBusiness("fin_lancamentos_receber");
     $faturar_lanc = $lancBusiness->confirmar_faturamento_lanc($objConta->getId_conta());  


     
     //ALTERAR FATURAMENTO  
 
      if($objPedido->getEscopo()==PRODUTO){
      //MOVIMENTAÇÃO DO ESTOQUE
      $movimentacaoBusiness = $this->Factory->createBusiness("est_movimentacao");

         //CONSULTA O PRODUTO PARA SABER SE O MESMO ESTÁ HABILITADO PARA REMOVER ITENS DO ESTOQUE
        $produtoBusiness = $this->Factory->createBusiness("est_produtos");
        //realiza o desconto no estoque
        //pegar os itens do pedido
        //movimentação itens do traco
        
        //GRAVA NA TABELA DE COMISSAO
      $dadosCom['id_pedido'] = $objPedido->getId_pedido();
      $dadosCom['id_usuario'] = $objPedido->getId_usuario();
      $dadosCom['data'] = date('Y-m-d');
      $dadosCom['percentual'] = $objPedido->getUsuario()->getColaborador()->getComissao_venda();
      $dadosCom['valor_venda'] = str_replace(",",".",str_replace(".","",$dadosForm['valor_pedido']));

      $comissaoBusiness = $this->Factory->createBusiness("fin_comissao");
      $cod_comissao = $comissaoBusiness->cadastrar($dadosCom);

    
      //FINAL TABELA DE COMISSAO

      


           //ALTERAR DADOS DO PEDIDO
     
        // $pedidoBusiness = $this->Factory->createBusiness("com_pedidos");
         //$pedidoBusiness->alterar_status($dadosForm['id_pedido'],FINALIZADO);
        //******FINAL ALTERAÇÃO STATUS ****************

        //gerar codigo do pedido
         $dadosPedido['codigo'] = $pedidoBusiness->gerar_codigo();
         $dadosPedido['id_pedido'] = $dadosForm['id_pedido'];
         $dadosPedido['valor_total'] = str_replace(",",".",str_replace(".","",$dadosForm['valor_pedido']));
        
         /* $dadosPedido['desconto'] = str_replace(",",".",str_replace(".","",$dadosForm['desconto_perc']));
         $dadosPedido['desconto_perc'] = str_replace(",",".",str_replace(".","",$dadosForm['descontoFlag']));
        $dadosPedido['taxa_frete'] = str_replace(",",".",str_replace(".","",$dadosForm['taxa_freteFlag']));
        */

        $dadosPedido['desconto_perc'] = $dadosForm['descontoFlag'];
        $dadosPedido['desconto'] = $dadosForm['desconto_perc'];
        $dadosPedido['taxa_frete'] = $dadosForm['taxa_freteFlag'];


         $dadosPedido['status'] = FECHADO;
         $dadosPedido['faturado'] = SIM;
         $pedidoBusiness->salvar_pedido($dadosPedido);


           //ALTERAR VALOR TOTAL DA CONTA
          $dadosConta['descricao'] = "VENDA Nº ". $dadosPedido['codigo'];
          $dadosConta['valor_total'] = $dadosPedido['valor_total'];
          $dadosConta['id_conta'] = $objConta->getId_conta();

          $contaCad = $contaBusiness->editar_tela_lanc($dadosConta);
          //FINAL VALOR TOTAL DA CONTA




        foreach ($objPedido->getItens_pedidos() as $objMov):
          
           $objProduto = $produtoBusiness->visualizar($objMov->getId_produto()); 

            $dadosMov['id_produto'] = $objMov->getId_produto();
            $dadosMov['data'] = date('Y-m-d');
            $dadosMov['qtd_mov_saida'] = $objMov->getQtd();
            $dadosMov['tipo_movimentacao'] = REMOVER_MOV;
            $dadosMov['id_pedido'] = $dadosForm['id_pedido'];
            $dadosMov['valor_unitario'] = $objMov->getValor_unitario(); //$objProduto->getValor_venda();
            $dadosMov['valor_custo'] = $objProduto->getValor_custo();
            $dadosMov['tipo_retirada'] = MOV_VENDA;
            $dadosMov['descricao'] = "VENDA Nº".  $dadosPedido['codigo'];
            $dadosMov['responsavel'] = $this->session->userdata('login');
            $dadosMov['id_usuario'] = $this->session->userdata('id_usuario');
      
          
            
            //VERIFICA SE O PRODUTO ESTÁ HABILITADO NO ESTOQUE PARA RETIRADA
           // if($objProduto->getAbater_estoque()==SIM){ 
             $movimentacaoBusiness->cadastrar($dadosMov);
            //}
           
            // FINAL OPERAÇÕE ESTOQUE


        endforeach;
      
      } //final escopo produto  

        //******ALTERA O STATUS PARA FINALIZADO
         //GERAR CÓDIGO PEDIDO SEQUENCIAL
     






        

      //FINAL REDUZIR ITENS DO ESTOQUE

}

      
      //NÃO USADO, CONTROLLER ANTIGO
      public function finalizar_pedido(){

        $this->load->helper(array('form','url'));

        $dadosForm = $this->input->post(); 

        $dadosAdd['id_pedido'] = $dadosForm['id_pedido'];
        $dadosAdd['desconto'] = $dadosForm['descontoFlag']; //str_replace(".","",$dadosForm['descontoFlag']);
        $dadosAdd['taxa_frete'] = $dadosForm['taxa_freteFlag']; //str_replace(".","",$dadosForm['taxa_freteFlag']);
        $dadosAdd['observacao'] = $dadosForm['observacaoFlag'];

        //******INCLUIR FORMA DE PAGAMENTO NA TABELA fin_forma_pag_fat        
        /*$dados['id_pedido'] = $dadosForm['id_pedido'];
        $dados['id_forma'] = $dadosForm['id_forma'];
        $dados['id_bandeira'] = $dadosForm['id_bandeira'];
        $dados['parcela'] = $dadosForm['qtd_parcela_pag'];
        //VALOR TOTAL DA CONTA
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
  
         $pedidoBusiness = $this->Factory->createBusiness("com_pedidos");
         $dadosAdd['codigo'] = $pedidoBusiness->gerar_codigo();

          $dadosAdd['status'] = FECHADO;


         $pedidoBusiness->salvar_pedido($dadosAdd);
       
        //******FINAL ATUALIZAÇÃO DE VALORES E ANOTAÇÕES *******************  
       
        //******GERA CONTAS A RECEBER ****************
        //CONTAS
        $dadosConta['id_pedido']  = $dadosForm['id_pedido'];
        $dadosConta['id_cliente'] = $dadosForm['id_cliente'];
        $dadosConta['tipo'] = CONTAS_RECEBER;
       
       // $dadosConta['valor_total'] = ($dadosForm['valor']+$dadosAdd['taxa_frete']) - $dadosAdd['desconto'];
        
       $total1 = str_replace(",",".",$dadosForm['valor']);
       $total2 = str_replace(",",".",$dadosForm['valor_other']);  
         
        $dadosConta['valor_total'] = ($total1 + $total2 + $dadosAdd['taxa_frete']) - $dadosAdd['desconto'];
        
        $total_pedido = ($total1 +$dadosAdd['taxa_frete']) - $dadosAdd['desconto'];

        $dadosConta['data'] = date('Y-m-d');
        $dadosConta['parcela_qtd'] =  $dadosForm['qtd_parcela_pag'];

               


        //LANÇAMENTOS

          // OS LANÇAMENTOS ABAIXO SÃO APENAS SEM PARCELAS
          $data_vencimento = date('Y-m-d');

          //CONSULTAR SE EXISTE ANTECIPAÇÃO DE FORMA DE PAGAMENTO
          // $antecipacao = 1; //flag para ajudar a incrementar a data, caso seja 1 será 30 dias, 0 é no dia mesmo
           
           $formaBusiness = $this->Factory->createBusiness("fin_formas_pagamentos");
           $objForma = $formaBusiness->visualizar($dadosForm['id_forma']);
           
           $qtd_parcela = $dadosForm['qtd_parcela_pag'];
           
           $valor_parcela = $total_pedido / $dadosForm['qtd_parcela_pag'];


           // SE A FORMA POSSUIR BANDEIRA NA FORMA DE PAGAMENTO CONSULTAR A ANTECIPAÇÃO NA BANDEIRA
           if($objForma->getCartao()==SIM){
             $bandeiraBusiness = $this->Factory->createBusiness("fin_bandeira_cartao");
             $objBandeira = $bandeiraBusiness->visualizar($dadosForm['id_bandeira']);
              if($objBandeira->getAntecipacao_pagamento()==CR_ANTECIPADO_SIM){
                $antecipacao = SIM;
                $qtd_parcela = 1; //apenas uma parcela
                $dadosConta['parcela_qtd'] = $qtd_parcela;
                $valor_parcela = $total_pedido;
                $dadosLanc['pagamento_antecipado'] = SIM;
                $dadosLanc['status'] = PAGO;

              }else{
                $antecipacao = NAO;
                $dadosLanc['status'] = PAGO;
              }
          }



          // SE FOR OUTRAS FORMAS DE PAGAMENTOS BUSCAR ANTECIPAÇÃO NA FORMA DE PAGAMENTO 
          if($objForma->getCartao()==NAO || $objForma->getCartao()==""){
            if($objForma->getCrAntecipado()==CR_ANTECIPADO_SIM){
               $antecipacao = SIM;  //antencipou
               $qtd_parcela = 1; //apenas uma parcela
                $dadosConta['parcela_qtd'] = $qtd_parcela;
               $valor_parcela = $total_pedido;
               $dadosLanc['pagamento_antecipado'] = SIM;
               $dadosLanc['status'] = PAGO;


             }else{
               $antecipacao = NAO;  //nao antecipou
                $dadosLanc['status'] = PAGO;
             }
           }


        $contaBusiness = $this->Factory->createBusiness("fin_contas");
        $id_conta = $contaBusiness->cadastrar($dadosConta);
        
        $dadosLanc['id_conta'] = $id_conta;



          // $antecipacao = 0;
        //nparcela = 1 está pegando sem antecipação

        for($nParcela = 1; $nParcela <= $qtd_parcela; $nParcela++) {
                
                     
                $dadosLanc['valor_titulo'] = $valor_parcela; //str_replace(",", "." , $valor_parcela);//Realiza a conversão para o DB
             
              
                $dataInArray = date_parse($data_vencimento);
                $dataInTime = mktime(0, 0, 0, $dataInArray["month"], $dataInArray["day"], $dataInArray["year"]);
               
               
                $dadosLanc["data_vencimento"] = date("Y-m-d", strtotime("+" . $nParcela - $antecipacao . " month", $dataInTime));
                

                //$dadosLanc["parcela"] = $nParcela + 1; // pagamento não antecipado
                $dadosLanc["parcela"] = $nParcela; //pagamento antecipado
               
               
                $dadosLanc['id_forma'] = $dadosForm['id_forma'];
                
                if($dadosForm['id_forma']==FORMA_PAG_CREDITO || $dadosForm['id_forma']==FORMA_PAG_DEBITO ){
                  $dadosLanc['id_bandeira'] = $dadosForm['id_bandeira'];
                }

                $dadosLanc['data_pagamento'] = date('Y-m-d');
                

                //$dadosLanc["parcela"] = $nParcela;
                               
                $lancBusiness = $this->Factory->createBusiness("fin_lancamentos");
                $cod_lanc = $lancBusiness->cadastrar($dadosLanc);
                 
          }


          echo "<script>alert(".$antecipacao.")</script>";

        //******FINAL CONTAS A RECEBER ******************

        

        
        //******OUTRA FORMA DE PAGAMENTO*****************
          if($dadosForm['outra_forma']==1){

            if($dadosForm['id_forma_other']==""){
              $dadosLancOther['id_forma'] = FORMA_REC_DINHEIRO;
            }
            else{
               $dadosLancOther['id_forma'] = $dadosForm['id_forma_other'];

            }

          
          $dadosLancOther['id_conta'] = $id_conta;
         
          $dadosLancOther['id_bandeira'] = $dadosForm['id_bandeira_other'];
          $dadosLancOther['parcela'] = 1;
          $dadosLancOther['valor_titulo'] = str_replace(",",".",$dadosForm['valor_other']); //$dadosForm['valor_other'];
          $dadosLancOther['data_vencimento'] = $data_vencimento;
          $dadosLancOther['data_pagamento'] = $data_vencimento;
          $dadosLancOther['status'] = PAGO;
          $dadosLancOther['deletado'] = 0;
          $dadosLancOther['antecipacao'] = SIM;
          $lancBusiness = $this->Factory->createBusiness("fin_lancamentos");
          $cod_lanc = $lancBusiness->cadastrar($dadosLancOther);
        }
        //******FINAL OUTRA FORMA DE PAGAMENTO************




  


        //***** REALIZA O DESCONTO NO ESTOQUE
        $pedidoBusiness = $this->Factory->createBusiness("com_pedidos");
        $objPedido = $pedidoBusiness->visualizar($dadosForm['id_pedido']);  
        
        $movimentacaoBusiness = $this->Factory->createBusiness("est_movimentacao");

         //CONSULTA O PRODUTO PARA SABER SE O MESMO ESTÁ HABILITADO PARA REMOVER ITENS DO ESTOQUE
        $produtoBusiness = $this->Factory->createBusiness("est_produtos");
        //realiza o desconto no estoque
        //pegar os itens do pedido
        //movimentação itens do traco
        
        foreach ($objPedido->getItens_pedidos() as $objMov):
          
           $objProduto = $produtoBusiness->visualizar($objMov->getId_produto()); 

            $dadosMov['id_produto'] = $objMov->getId_produto();
            $dadosMov['data'] = date('Y-m-d');
            $dadosMov['qtd_mov_saida'] = $objMov->getQtd();
            $dadosMov['tipo_movimentacao'] = REMOVER_MOV;
            $dadosMov['id_pedido'] = $dadosForm['id_pedido'];
            $dadosMov['valor_unitario'] = $objProduto->getValor_venda();
            $dadosMov['valor_custo'] = $objProduto->getValor_custo();
            $dadosMov['responsavel'] = $this->session->userdata('login');
            $dadosMov['id_usuario'] = $this->session->userdata('id_usuario');

           
          
            
            //VERIFICA SE O PRODUTO ESTÁ HABILITADO NO ESTOQUE PARA RETIRADA
           // if($objProduto->getAbater_estoque()==SIM){ 
             $movimentacaoBusiness->cadastrar($dadosMov);
            //}
           
            // FINAL OPERAÇÕE ESTOQUE


        endforeach;
        //***** FINAL DESCONTO ESTOQUE ****************

      
        //******ALTERA O STATUS PARA FINALIZADO
         //$pedidoBusiness = $this->Factory->createBusiness("com_pedidos");
         //$pedidoBusiness->alterar_status($dadosForm['id_pedido'],FINALIZADO);
        //******FINAL ALTERAÇÃO STATUS ****************





      }

          
      //alterar status do pedido
      public function alterar_status($id_pedido,$status){


         $this->load->helper(array('form','url'));
        
         $pedidoBusiness = $this->Factory->createBusiness("com_pedidos");
         $pedidoBusiness->alterar_status($id_pedido,$status);

         redirect('locacao/novo/'.$id_pedido);


      }

      public function alterar_status_filtro($id_pedido,$status,$tipo){


         $this->load->helper(array('form','url'));
        
         $pedidoBusiness = $this->Factory->createBusiness("com_pedidos");
         $pedidoBusiness->alterar_status($id_pedido,$status);

         redirect('locacao/filtro/'.$tipo);


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

           $pedidoBusiness = $this->Factory->createBusiness("com_pedidos");
          $objPedido = $pedidoBusiness->visualizar($id_pedido);
         

         if($objUser->getSenha()==$senha){

         //DESABILITAR PEDIDO
         
          $dadosCancelar['deletado'] = 1;
          
          $dadosCancelar['id_pedido'] = $id_pedido;
          //$pedidoBusiness->alterar_status($id_pedido,CANCELADO);
          $pedidoBusiness->salvar_pedido($dadosCancelar);
          
          
          //DESABILITAR ITENS PEDIDOS
          //$itemBusiness = $this->Factory->createBusiness("com_pedidos_itens");
          //$itemBusiness->excluir_por_pedido($id_pedido);
          //DESABILITAR CONTA
          
          if($objPedido->getTipo()==PEDIDO){
          $contaBusiness = $this->Factory->createBusiness("fin_contas_receber");
          $contaBusiness->excluir_por_pedido($id_pedido);
          //OBJ CONTA
          $objConta = $contaBusiness->visualizar_por_pedido($id_pedido);
          if($objConta!=null){
          //DESABILITAR LANÇAMENTO
           $lancBusiness = $this->Factory->createBusiness("fin_lancamentos_receber");
           $lancBusiness->excluir_por_conta($objConta->getId_conta());
           }
          //MOVIMENTAÇÃO
          $movBusiness = $this->Factory->createBusiness("est_movimentacao");
          $movBusiness->excluir_por_pedido($id_pedido);
          
          }

          

          redirect("pedidos/filtro/".$objPedido->getTipo());
        


        }
        else{

          echo "<script>alert('OPERACAO NAO PERMITADA')</script>";
          echo "<script>window.location.href='".site_url('pedidos/filtro/')."/".$objPedido->getTipo()."'</script>";

        }




      }


      //imprimir pedido
      public function historico($id_cliente){

        error_reporting(E_ALL ^ E_DEPRECATED);
      
        try {
            
         $this->load->helper(array('form', 'url'));
         $this->load->library('mpdf'); //carrega a biblioteca mpdf que está em aplication/libraries/mpdf
        

          $pedidoBusiness = $this->Factory->createBusiness("com_pedidos");
          $listPedido = $pedidoBusiness->listar_por_cliente($id_cliente,PEDIDO);
          $listOrc = $pedidoBusiness->listar_por_cliente($id_cliente,ORCAMENTO);


          $clienteBusiness = $this->Factory->createBusiness("com_clientes");
          $info["objCliente"] = $clienteBusiness->visualizar($id_cliente);

          $info['listPedidos'] = $listPedido;
           $info['listOrc'] = $listOrc;

        
         $content = $this->load->view('pedidos/historico', $info,TRUE);
        
         $this->mpdf->setFooter('{PAGENO}'); //numero de paginas
         $this->mpdf->WriteHTML($content); // Converte os dados html para pdf
         $this->mpdf->Output(); //ger

        }

        catch (Exception $ex) {
            $this->loadError($ex);
        }


      }



      //imprimir pedido
      public function imprimir($id_pedido){

        error_reporting(E_ALL ^ E_DEPRECATED);
      
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
         $lancBusiness = $this->Factory->createBusiness("fin_lancamentos_receber");
         $listLanc = $lancBusiness->listar_por_pedido($id_pedido);
         $info['listLanc'] = $listLanc;

        
         $content = $this->load->view('locacao/impressao', $info,TRUE);
        
       
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



       public function incluir_obs(){

        $this->load->helper(array('form','url'));

        $dadosForm = $this->input->post();      

        $objDateFormat = $this->DateFormat;

        $dados['id_pedido'] = $dadosForm['id_pedido'];
        $dados['observacao'] = $dadosForm['observacao'];
        $dados['endereco_entrega'] = $dadosForm['endereco_entrega'];
        $dados['estado_entrega'] = $dadosForm['estado_entrega'];
        $dados['ponto_entrega'] = $dadosForm['ponto_entrega'];
        $dados['cidade_entrega'] = $dadosForm['cidade_entrega'];
        $dados['cep_entrega'] = $dadosForm['cep_entrega'];
        $dados['data_final'] = $objDateFormat->date_mysql($dadosForm['data_final']);


        $pedidoBusiness = $this->Factory->createBusiness("com_pedidos");
        $pedidoBusiness->incluir_obs($dados);

      }


       public function excluir_faturamento($id_forma,$id_pedido){

        $this->load->helper(array('form','url'));

        //$dadosForm = $this->input->post();      

        //$dados['id_pedido'] = $dadosForm['id_pedido'];
        //$dados['id_cliente'] = $dadosForm['id_cliente'];

        $fatBusiness = $this->Factory->createBusiness("fin_forma_pag_fat");
        $fatBusiness->excluir($id_forma);

        //PENDENTE

        //CONSULTAR A CONTA PELO PEDIDO
        // $contaBusiness = $this->Factory->createBusiness("fin_contas_receber");
         //$objConta = $contaBusiness->visualizar_por_pedido($id_pedido);
        // - EXCLUIR FISICAMENTE O LANÇAMENTO

         $lancBusiness = $this->Factory->createBusiness("fin_lancamentos_receber");
         $lancBusiness->excluir_por_faturamento($id_forma);

      //   $contaBusiness->excluir($objConta->getId_conta());



        // - EXCLUIR FISICAMENTE A CONTA
        

        
                
        $fatBusiness = $this->Factory->createBusiness("fin_forma_pag_fat");
        $listFat = $fatBusiness->ajax_listar_faturamento($id_pedido);
     
      echo json_encode($listFat); 

      }



      //envia o pedido por e-mail
      public function enviar_email($id_pedido){

      }

      //alterar vendedor do pedido
      public function alterar_vendedor($id_pedido){

      }

        //alterar status do pedido
      public function teste(){


         $this->load->helper(array('form','url'));

          //DADOS DO PEDIDO
          $taxaBusiness = $this->Factory->createBusiness("fin_tabela_taxa");
          $taxa = $taxaBusiness->visualizar_taxa(1,10);
          //print_r($taxa);
          echo $taxa;

          //print_r($listPedido);

        }


        public function printer($id_pedido){
      
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
         $lancBusiness = $this->Factory->createBusiness("fin_lancamentos_receber");
         $listLanc = $lancBusiness->listar_por_pedido($id_pedido);
         $info['listLanc'] = $listLanc;

         //$content = "";
         //$content = $this->load->view('pedidos/topo', $info,TRUE);
        // $this->mpdf->SetHeaderByName('MyHeader1');
        

         $content = $this->load->view('pedidos/teste', $info,TRUE);
          
         //$this->mpdf->SetHTMLHeader('<p>TESTE</p>');

          $this->mpdf->WriteHTML($content);
         //$this->mpdf->setFooter('{PAGENO}'); //numero de paginas
         //$this->mpdf->WriteHTML($content); // Converte os dados html para pdf
         $this->mpdf->Output(); //ger

        }

        catch (Exception $ex) {
            $this->loadError($ex);
        }


      }

       public function ajax_alterar_desconto(){
          $this->load->helper(array('form','url'));

          $dadosForm = $this->input->post();
         
          $dadosAdd['id_pedido'] = $dadosForm['id_pedido'];
          $dadosAdd['desconto'] = $dadosForm['desconto'];
         
          //$dadosAdd['desconto'] =  str_replace(",",".",str_replace(".","",$dadosForm['desconto'])); 
          
          
          $dadosAdd['taxa_frete'] = str_replace(",",".",str_replace(".","",$dadosForm['frete'])); 
         
          $dadosAdd['valor_total'] = str_replace(",",".",str_replace(".","",$dadosForm['valor_total'])); 
          
             
         
         //print_r($dados);
         $pedidoBusiness = $this->Factory->createBusiness("com_pedidos");
         $pedidoBusiness->salvar_pedido($dadosAdd);

    }

     public function ajax_alterar_frete(){
          $this->load->helper(array('form','url'));

          $dadosForm = $this->input->post();
         
          $dadosAdd['id_pedido'] = $dadosForm['id_pedido'];
          $dados['desconto'] = $dadosForm['desconto'];
         
          //$dadosAdd['desconto'] =  str_replace(",",".",str_replace(".","",$dadosForm['desconto'])); 
          
          $dados['taxa_frete'] = $dadosForm['frete'];
         // $dadosAdd['taxa_frete'] = str_replace(",",".",str_replace(".","",$dadosForm['frete'])); 
         
          $dadosAdd['valor_total'] = str_replace(",",".",str_replace(".","",$dadosForm['valor_total'])); 
          
             
         
         //print_r($dados);
         $pedidoBusiness = $this->Factory->createBusiness("com_pedidos");
         $pedidoBusiness->salvar_pedido($dadosAdd);

    }

     public function ajax_listar_entrega(){

      //header( 'Cache-Control: no-cache' );
      //header( 'Content-type: application/xml; charset="utf-8"', true );
      
      $this->load->helper(array('form','url'));
      
      $msgBusiness = $this->Factory->createBusiness("com_pedidos");
      $listMsg = $msgBusiness->ajax_listar_entrega();  
     
      echo json_encode($listMsg); 
                
    }









      
      
}
?>
