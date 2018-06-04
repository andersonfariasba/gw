<?php
/* Classe(controller): Produtos
 * Autor: Anderson Farias
 * Última atualização: 30/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Pedidos_acompanhamento extends MY_Controller {
	
    //VALIDAÇÃO
    private function Rules(){
       
        $this->form_validation->set_rules('id_pedido','Código Pedido Inexistente','required');
       
       
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"  id="msgOk">
<strong><i class="fa fa-check"></i></strong> ', '</div>');    
    }

  
   //LISTAGEM
    public function filtro($dados=null){
        try {
            $this->load->helper(array('form','url'));
            
            if ($this->input->post() == NULL) {
            
           
            //Lista de Solicitação
           
            $solicitacaoBusiness = $this->Factory->createBusiness("comp_pedidos");
            $listSolicitacao = $solicitacaoBusiness->filtro();
            $info["listSolicitacao"] = $listSolicitacao;

             //Fornecedores
            $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
            $listFornecedor = $fornecedorBusiness->filtro();
            $info["listFornecedor"] = $listFornecedor;

            $statusBusiness = $this->Factory->createBusiness("conf_status");
            $listStatus = $statusBusiness->filtro(null);
            $info['listStatus'] = $listStatus;

             /*$statusPerfilBusiness = $this->Factory->createBusiness("acesso_perfil_status");
             $listStatusPerfil = $statusPerfilBusiness->listar($this->session->userdata('id_perfil'));
             $info['listStatus'] = $listStatusPerfil;*/

            $colaboradoresBusiness = $this->Factory->createBusiness("rh_colaboradores");
            $listColaborador = $colaboradoresBusiness->filtro(null);
            $info['listUser'] = $listColaborador;

             $aprovadorBusiness = $this->Factory->createBusiness("acesso_usuarios");
            $listUserAprovador = $aprovadorBusiness->listar_por_perfil(PERFIL_COORDENADOR);
            $info['listUserAprovador'] = $listUserAprovador;

            /*$acessoBusiness = $this->Factory->createBusiness("rh_colaboradores");
            $listUser = $acessoBusiness->filtro($param);
            $info['listUserx'] = $listUser;
            */
            
            $content = $this->load->view("pedidos_acompanhamento/filtro",$info,TRUE);
            $this->loadPage($content);

            }else{
            
            $dados = $this->input->post();
            
            //Lista de Solicitação
            $solicitacaoBusiness = $this->Factory->createBusiness("comp_pedidos");
            $listSolicitacao = $solicitacaoBusiness->filtro($dados);
            $info["listSolicitacao"] = $listSolicitacao;

             //Fornecedores
            $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
            $listFornecedor = $fornecedorBusiness->filtro();
            $info["listFornecedor"] = $listFornecedor;

            $statusBusiness = $this->Factory->createBusiness("conf_status");
            $listStatus = $statusBusiness->filtro(null);
            $info['listStatus'] = $listStatus;

            $colaboradoresBusiness = $this->Factory->createBusiness("rh_colaboradores");
            $listColaborador = $colaboradoresBusiness->filtro(null);
            $info['listUser'] = $listColaborador;

             $aprovadorBusiness = $this->Factory->createBusiness("acesso_usuarios");
            $listUserAprovador = $aprovadorBusiness->listar_por_perfil(PERFIL_COORDENADOR);
            $info['listUserAprovador'] = $listUserAprovador;
            
            $content = $this->load->view("pedidos_acompanhamento/filtro",$info,TRUE);
            $this->loadPage($content);  
              
            }
            
          } catch (Exception $exc) {
            $this->loadError($ex);
        }
    }



    //VISUALIZAR ITENS
    public function visualizar($id_pedido){
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
        $this->Rules();
        
        $info['msg'] = "";
        
        if($this->form_validation->run()==FALSE){
                               
            
            //Dados da visualização da solicitação
            $solicitacaoBusiness = $this->Factory->createBusiness("comp_pedidos");
            $objSolicitacao = $solicitacaoBusiness->visualizar($id_pedido);
            $info['objSolicitacao'] = $objSolicitacao;

            //lista dos produtos
            $produtosBusiness = $this->Factory->createBusiness("est_produtos");
            $listProdutos = $produtosBusiness->listar_produto_servico();
            $info['listProdutos'] = $listProdutos;

          
             //lista dos produtos
            $itensBusiness = $this->Factory->createBusiness("comp_pedidos_itens");
            $listItens = $itensBusiness->listar($id_pedido);
            $info['listItens'] = $listItens;

            $transBusiness = $this->Factory->createBusiness("com_transportadoras");
            $listTrans = $transBusiness->filtro(null);
            $info['listTransportadora'] = $listTrans;

                     
            /*$colaboradoresBusiness = $this->Factory->createBusiness("rh_colaboradores");
            $listColaborador = $colaboradoresBusiness->filtro(null);
            $info['listUser'] = $listColaborador;*/

            $colaboradoresBusiness = $this->Factory->createBusiness("acesso_usuarios");
            $listColaborador = $colaboradoresBusiness->listar_por_perfil(PERFIL_COORDENADOR);
            $info['listUser'] = $listColaborador;

            $userBusiness = $this->Factory->createBusiness("acesso_usuarios");
            $objUser = $userBusiness->visualizar($this->session->userdata('id_usuario'));
            $info["objUser"] = $objUser;
     

            $statusBusiness = $this->Factory->createBusiness("conf_status");
            $listStatus = $statusBusiness->filtro(null);
            $info['listStatus'] = $listStatus;

            /* $statusPerfilBusiness = $this->Factory->createBusiness("acesso_perfil_status");
             $listStatusPerfil = $statusPerfilBusiness->listar($this->session->userdata('id_perfil'));
             $info['listStatus'] = $listStatusPerfil;*/

           
            $content = $this->load->view("pedidos_acompanhamento/visualizar",$info,TRUE);
            $this->loadPage($content);
        }
        
        else{
           //error_reporting(0);
           $dados = $this->input->post();
            
          
           $objDateFormat = $this->DateFormat;
           $dados['data_vencimento'] = $objDateFormat->date_mysql($dados['data_vencimento']);
           $dados['data_envio_financeiro'] = $objDateFormat->date_mysql($dados['data_envio_financeiro']);
           $dados['data_entrega'] = $objDateFormat->date_mysql($dados['data_entrega']);
                    
          
            //imagem
                $config['upload_path'] = './importacao/';//Caminho onde será salvo
                $config['allowed_types'] = 'pdf|doc|docx|xls|xlsx|jpeg|png|JPG|JPEG|gif|jpg|zip|rar';//Tipos de imagem aceito
                $config['max_size'] = '4096';//Tamanho - Aqui aceitamos até 2 Mb
                $config['overwrite']  = FALSE;//Não irá sobre-escrever o arquivo
                $config['encrypt_name'] = TRUE;//Trocará o nome do arquivo para um HASH - TRUE PADRÃO
               
                $field_name1 = "arquivo";// Nome do campo INPUT do formulário                         
                $this->load->library('upload');
                $this->upload->initialize($config);

               if($_FILES['arquivo']['error'] != 4){ 
                   
                    $this->upload->initialize($config);

                    if(!$this->upload->do_upload($field_name1))
                    {
                    $error = array('erro' => $this->upload->display_errors());
                    echo "<script>alert('Verifique o tamanho ou formato da imagem')</script>";
                    echo "<script>history.back(0)'</script>";
                  
                    }


                    $dadosUp = $this->upload->data();
                    $dados['arquivo'] = $dadosUp['file_name'];
                    unset($dados['arquivo_atual']);
               }
                 else{
                     $dados['arquivo'] = $dados['arquivo_atual'];
                     unset($dados['arquivo_atual']);

               }
               //final imagem



           $solicitacaoBusiness = $this->Factory->createBusiness("comp_pedidos");
           $id_solicitacao = $solicitacaoBusiness->editar($dados);
           
           $msg = true;
           
           redirect('pedidos_acompanhamento/visualizar/'.$dados['id_pedido']);


        }

    }



    //CONFIRMAR SOLICITAÇÃO
    public function aprovar(){
        $this->load->helper(array('form','url'));

          $dados = $this->input->post();

           $solicitacaoBusiness = $this->Factory->createBusiness("comp_solicitacao");
           $objSolicitacao = $solicitacaoBusiness->visualizar($dados['id_solicitacao']);


          //ALTERA APENAS O STATUS DA CONTROLADORIA
          if($this->session->userdata('id_perfil')==PERFIL_CONTROLADORIA){
            
            $dadosAprova['id_solicitacao'] = $dados['id_solicitacao'];
            $dadosAprova['id_status_controladoria'] = $dados['id_status_controladoria'];
            $dadosAprova['id_aprovador_controladoria'] = $this->session->userdata('id_colaborador'); 
            
            $solicitacaoBusiness = $this->Factory->createBusiness("comp_solicitacao");
            $id_solicitacao = $solicitacaoBusiness->editar($dadosAprova); 

          }

          elseif($this->session->userdata('id_perfil')==PERFIL_MASTER){
            
            $dadosAprova['id_solicitacao'] = $dados['id_solicitacao'];
            

            $dadosAprova['id_status_controladoria'] = $dados['id_status_controladoria'];
            
           /* if($objSolicitacao->getId_aprovador_controladoria()>0){
                $dadosAprova['id_aprovador_controladoria'] = $dados['id_aprovador_controladoria'];
            }*/
            //SE O STATUS DA CONTROLADORIA FOR SELECIONADO E NÃO TIVER APROVADOR PEGAR O USUÁRIO LOGADO QUE APROVOU
            if($dados['id_status_controladoria']!=null && $objSolicitacao->getId_aprovador_controladoria()==null ){
                 $dadosAprova['id_aprovador_controladoria'] = $this->session->userdata('id_colaborador'); 
            }
            


            $dadosAprova['id_status_diretoria'] = $dados['id_status_diretoria'];
            $dadosAprova['id_aprovador_diretoria'] = $this->session->userdata('id_colaborador'); 
            
            $solicitacaoBusiness = $this->Factory->createBusiness("comp_solicitacao");
            $id_solicitacao = $solicitacaoBusiness->editar($dadosAprova); 

            //SE O PERFIL FOR DIRETORIA E STATUS FOR APROVADOR - GERAR PEDIDOS

            if($dados['id_status_diretoria']==ST_APROVADO){
                $solicitacaoBusiness = $this->Factory->createBusiness("comp_solicitacao");
                $list = $solicitacaoBusiness->listar_itens_pc_group($dados['id_solicitacao']);
                 
                 //CADASTRA NA TABELA PEDIDO DE COMPRA
                 foreach ($list as $objSol):
                    $dadosPedido['id_fornecedor'] =  $objSol['id_fornecedor']; 
                    $dadosPedido['id_solicitacao'] =  $objSol['id_solicitacao'];
                    $dadosPedido['id_status'] = EM_ELABORACAO;
                    $dadosPedido['data'] = date('Y-m-d'); 
                    
                    $pedidosBusiness = $this->Factory->createBusiness("comp_pedidos");
                    $sucesso = $pedidosBusiness->cadastrar($dadosPedido);

                  endforeach; 

                  //LOOP EM TODOS OS ITENS DA SOLICITAÇÃO APROVADA

                    $listItens = $solicitacaoBusiness->listar_itens_pc($dados['id_solicitacao']);
                    
                    foreach ($listItens as $objItem):

                        //VERIFICA NO LOOP DOS ITENS O PEDIDO QUE FOI CADASTRADO ANTERIORMENTE PARA 
                        //INCLUIR NA TABELA DOS ITENS A REFERENCIA DO PEDIDO
                        $pedidosBusiness = $this->Factory->createBusiness("comp_pedidos");
                        $objPedido = $pedidosBusiness->visualizar_por_solicitacao($objItem['id_solicitacao'],$objItem['id_fornecedor']);
                        
                            if($objPedido!=null){
                                $dadosItem['id_pedido'] = $objPedido->getId_pedido();
                                $dadosItem['id_produto'] = $objItem['id_produto'];
                                $dadosItem['id_custo'] = $objItem['id_custo'];
                                $dadosItem['id_obra'] = $objItem['id_obra'];
                                $dadosItem['valor_unitario'] = $objItem['valor'];
                                $dadosItem['qtd'] = $objItem['qtd'];
                                $dadosItem['data_entrega'] = $objItem['data_entrega'];
                                $dadosItem['status'] = 0;

                                $itensBusiness = $this->Factory->createBusiness("comp_pedidos_itens");
                                $id_pedido_item = $itensBusiness->cadastrar($dadosItem);

                            }

                     endforeach; 



                  //FINAL LOOP 
         

          }


            //FINAL INSERÇÃO




          }


           
        
          redirect('pedido_compra/visualizar/'.$dados['id_solicitacao']);
           
               
    }


    //imprimir pedido
      public function imprimir($id_pedido){

        error_reporting(E_ALL ^ E_DEPRECATED);
      
        try {
            
         $this->load->helper(array('form', 'url'));
         $this->load->library('mpdf'); //carrega a biblioteca mpdf que está em aplication/libraries/mpdf
        

          
            //lista dos produtos
            //$custoBusiness = $this->Factory->createBusiness("comp_pedidos");
            //$listCusto = $custoBusiness->listar_centro_custo($id_pedido);
            //$info['listCusto'] = $listCusto;


         //Dados da visualização da solicitação
            $solicitacaoBusiness = $this->Factory->createBusiness("comp_pedidos");
            $objSolicitacao = $solicitacaoBusiness->visualizar($id_pedido);
            $info['objSolicitacao'] = $objSolicitacao;

            //lista dos produtos
            $produtosBusiness = $this->Factory->createBusiness("est_produtos");
            $listProdutos = $produtosBusiness->listar_produto_servico();
            $info['listProdutos'] = $listProdutos;

          
             //lista dos produtos
            $itensBusiness = $this->Factory->createBusiness("comp_pedidos_itens");
            $listItens = $itensBusiness->listar($id_pedido);
            $info['listItens'] = $listItens;

            $transBusiness = $this->Factory->createBusiness("com_transportadoras");
            $listTrans = $transBusiness->filtro(null);
            $info['listTransportadora'] = $listTrans;

                     
            /*$colaboradoresBusiness = $this->Factory->createBusiness("rh_colaboradores");
            $listColaborador = $colaboradoresBusiness->filtro(null);
            $info['listUser'] = $listColaborador;*/

            $colaboradoresBusiness = $this->Factory->createBusiness("acesso_usuarios");
            $listColaborador = $colaboradoresBusiness->listar_por_perfil(PERFIL_COORDENADOR);
            $info['listUser'] = $listColaborador;

            $userBusiness = $this->Factory->createBusiness("acesso_usuarios");
            $objUser = $userBusiness->visualizar($this->session->userdata('id_usuario'));
            $info["objUser"] = $objUser;
     

            $statusBusiness = $this->Factory->createBusiness("conf_status");
            $listStatus = $statusBusiness->filtro(null);
            $info['listStatus'] = $listStatus;

            

        
         $content = $this->load->view('pedidos_acompanhamento/impressao', $info,TRUE);
        
       
         $this->mpdf->WriteHTML($content); // Converte os dados html para pdf
         $this->mpdf->Output(); //ger

        }

        catch (Exception $ex) {
            $this->loadError($ex);
        }


      }


       public function imprimir_interna($id_pedido){

        error_reporting(E_ALL ^ E_DEPRECATED);
      
        try {
            
         $this->load->helper(array('form', 'url'));
         $this->load->library('mpdf'); //carrega a biblioteca mpdf que está em aplication/libraries/mpdf
        

          
            //lista dos produtos
            //$custoBusiness = $this->Factory->createBusiness("comp_pedidos");
            //$listCusto = $custoBusiness->listar_centro_custo($id_pedido);
            //$info['listCusto'] = $listCusto;


         //Dados da visualização da solicitação
            $solicitacaoBusiness = $this->Factory->createBusiness("comp_pedidos");
            $objSolicitacao = $solicitacaoBusiness->visualizar($id_pedido);
            $info['objSolicitacao'] = $objSolicitacao;

            //lista dos produtos
            $produtosBusiness = $this->Factory->createBusiness("est_produtos");
            $listProdutos = $produtosBusiness->listar_produto_servico();
            $info['listProdutos'] = $listProdutos;

           
             //lista dos produtos
            $itensBusiness = $this->Factory->createBusiness("comp_pedidos_itens");
            $listItens = $itensBusiness->listar($id_pedido);
            $info['listItens'] = $listItens;

            $transBusiness = $this->Factory->createBusiness("com_transportadoras");
            $listTrans = $transBusiness->filtro(null);
            $info['listTransportadora'] = $listTrans;

                     
            /*$colaboradoresBusiness = $this->Factory->createBusiness("rh_colaboradores");
            $listColaborador = $colaboradoresBusiness->filtro(null);
            $info['listUser'] = $listColaborador;*/

            $colaboradoresBusiness = $this->Factory->createBusiness("acesso_usuarios");
            $listColaborador = $colaboradoresBusiness->listar_por_perfil(PERFIL_COORDENADOR);
            $info['listUser'] = $listColaborador;

            $userBusiness = $this->Factory->createBusiness("acesso_usuarios");
            $objUser = $userBusiness->visualizar($this->session->userdata('id_usuario'));
            $info["objUser"] = $objUser;
     

            $statusBusiness = $this->Factory->createBusiness("conf_status");
            $listStatus = $statusBusiness->filtro(null);
            $info['listStatus'] = $listStatus;

             //$statusPerfilBusiness = $this->Factory->createBusiness("acesso_perfil_status");
             //$listStatusPerfil = $statusPerfilBusiness->listar($this->session->userdata('id_perfil'));
             //$info['listStatus'] = $listStatusPerfil;

        
         $content = $this->load->view('pedidos_acompanhamento/impressao_interna', $info,TRUE);
        
       
         $this->mpdf->WriteHTML($content); // Converte os dados html para pdf
         $this->mpdf->Output(); //ger

        }

        catch (Exception $ex) {
            $this->loadError($ex);
        }


      }






     public function teste(){
        $this->load->helper(array('form','url'));
                
            /*$solicitacaoBusiness = $this->Factory->createBusiness("comp_solicitacao");
            $list = $solicitacaoBusiness->listar_itens_pc_group(12);
             foreach ($list as $objSol):
              echo $objSol['id_fornecedor']; 

            endforeach; 
            */

             $cotacaoBusiness = $this->Factory->createBusiness("comp_cotacoes");
            $listItens = $cotacaoBusiness->listar_itens_fornecedor(59,6);

            print_r($listItens);

    }



       


} //final classs

?>
