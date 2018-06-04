<?php
/* Classe(controller): Produtos
 * Autor: Anderson Farias
 * Última atualização: 30/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Pedido_compra extends MY_Controller {
	
    //VALIDAÇÃO
    private function Rules(){
       
        $this->form_validation->set_rules('data_necessidade','Data Prioridade','required');
       
        $this->form_validation->set_rules('data_criacao','Data da Solicitação','required');
        $this->form_validation->set_rules('id_solicitante','Solicitante','required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"  id="msgOk">
<strong><i class="fa fa-check"></i></strong> ', '</div>');    
    }

     

   


    

     //LISTAGEM
    public function filtro($dados=null){
        try {
            $this->load->helper(array('form','url'));
            
            if ($this->input->post() == NULL) {
            
           
            //Lista de Solicitação
           
            $solicitacaoBusiness = $this->Factory->createBusiness("comp_solicitacao");
            $listSolicitacao = $solicitacaoBusiness->filtro_pc();
            $info["listSolicitacao"] = $listSolicitacao;

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
            
            $content = $this->load->view("pedido_compra/filtro",$info,TRUE);
            $this->loadPage($content);

            }else{
            
            $dados = $this->input->post();
            
            //Lista de Solicitação
            $solicitacaoBusiness = $this->Factory->createBusiness("comp_solicitacao");
            $listSolicitacao = $solicitacaoBusiness->filtro_pc($dados);
            $info["listSolicitacao"] = $listSolicitacao;

            $statusBusiness = $this->Factory->createBusiness("conf_status");
            $listStatus = $statusBusiness->filtro(null);
            $info['listStatus'] = $listStatus;

            $colaboradoresBusiness = $this->Factory->createBusiness("rh_colaboradores");
            $listColaborador = $colaboradoresBusiness->filtro(null);
            $info['listUser'] = $listColaborador;

             $aprovadorBusiness = $this->Factory->createBusiness("acesso_usuarios");
            $listUserAprovador = $aprovadorBusiness->listar_por_perfil(PERFIL_COORDENADOR);
            $info['listUserAprovador'] = $listUserAprovador;
            
            $content = $this->load->view("pedido_compra/filtro",$info,TRUE);
            $this->loadPage($content);  
              
            }
            
          } catch (Exception $exc) {
            $this->loadError($ex);
        }
    }



    //VISUALIZAR ITENS
    public function visualizar($id_solicitacao){
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
        $this->Rules();
        
        $info['msg'] = "";
        
        if($this->form_validation->run()==FALSE){
                               
            
            //Dados da visualização da solicitação
            $solicitacaoBusiness = $this->Factory->createBusiness("comp_solicitacao");
            $objSolicitacao = $solicitacaoBusiness->visualizar($id_solicitacao);
            $info['objSolicitacao'] = $objSolicitacao;

            //lista dos produtos
            $produtosBusiness = $this->Factory->createBusiness("est_produtos");
            $listProdutos = $produtosBusiness->listar_produto_servico();
            $info['listProdutos'] = $listProdutos;

         
             //lista dos produtos
            $itensBusiness = $this->Factory->createBusiness("comp_itens");
            $listItens = $itensBusiness->filtro($id_solicitacao);
            $info['listItens'] = $listItens;

            $itensBusiness = $this->Factory->createBusiness("comp_solicitacao");
            $listItensPc = $itensBusiness->listar_itens_pc($id_solicitacao);
            $info['listItensPc'] = $listItensPc;

           
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

             /*$statusPerfilBusiness = $this->Factory->createBusiness("acesso_perfil_status");
             $listStatusPerfil = $statusPerfilBusiness->listar($this->session->userdata('id_perfil'));
             $info['listStatus'] = $listStatusPerfil;*/

               //VARIAVEIS QUE DETERMINA SE A QTD DE ITENS LANÇADOS SÃO IGUAIS AO SOLICITADO
            //PARA SABER SE A COTAÇAO ESTÁ CONCLUIDA

            //VERIFICA A QTD DE COTAÇÃO(ITENS) FORAM LANÇADOS
            $cotacaoItemBusiness = $this->Factory->createBusiness("comp_cotacoes");
            $qtd_cotacao_lancada = $cotacaoItemBusiness->qtd_cotacao_lancada($id_solicitacao);
            $info['qtd_cotacao_lancada'] = $qtd_cotacao_lancada;

            //QTD TOTAL DE ITENS
            $itensBusiness = $this->Factory->createBusiness("comp_itens");
            $listItensCotacao = $itensBusiness->listar($id_solicitacao);

             $qtd_cotacao_total = sizeof($listItensCotacao);
             $info['qtd_cotacao_total'] =  $qtd_cotacao_total;

             //SE QTD TOTAL FOR MAIOR QUE ZERO E IGUAL A QTD JÁ LANÇA PELA DIRETORIA JÁ ESTÁ COMPLETA
             if($qtd_cotacao_total > 0 && ($qtd_cotacao_total==$qtd_cotacao_lancada) )
              {
                $status = 1;
              }
              
              else{
                $status = 0;
              }

              $info['status_geral'] = $status;

           
            $content = $this->load->view("pedido_compra/visualizar",$info,TRUE);
            $this->loadPage($content);
        }
        
        else{
           //error_reporting(0);
           $dados = $this->input->post();
            
          
           $objDateFormat = $this->DateFormat;
           $dadosSol['data_necessidade'] = $objDateFormat->date_mysql($dados['data_necessidade']);
           $dadosSol['data_criacao'] = $objDateFormat->date_mysql($dados['data_criacao']);
           $dadosSol['id_solicitacao'] = $dados['id_solicitacao'];
           
           //print_r($dados); exit;

           $dadosItens['data_inclusao'] = date('Y-m-d');
           $dadosItens['id_obra'] = $dados['id_obra'];
           $dadosItens['qtd'] = $dados['qtd'];
           $dadosItens['id_produto'] = $dados['id_produto'];
           $dadosItens['id_solicitacao'] = $dados['id_solicitacao'];
           $dadosItens['id_custo'] = $dados['id_custo'];

           $itensBusiness = $this->Factory->createBusiness("comp_itens");
           $id_item = $itensBusiness->cadastrar($dadosItens);

           $solicitacaoBusiness = $this->Factory->createBusiness("comp_solicitacao");
           $id_solicitacao = $solicitacaoBusiness->editar($dadosSol);
           
           $msg = true;
           
           redirect('solicitacao/incluir_itens/'.$dados['id_solicitacao']);


        }

    }



    //CONFIRMAR SOLICITAÇÃO
    public function aprovar(){
        $this->load->helper(array('form','url'));

          $dados = $this->input->post();

           $solicitacaoBusiness = $this->Factory->createBusiness("comp_solicitacao");
           $objSolicitacao = $solicitacaoBusiness->visualizar($dados['id_solicitacao']);


          //ALTERA APENAS O STATUS DA CONTROLADORIA
          if($this->session->userdata('id_perfil')==PERFIL_COORDENADOR){
            
            $dadosAprova['id_solicitacao'] = $dados['id_solicitacao'];
            $dadosAprova['id_status_controladoria'] = $dados['id_status_controladoria'];
            $dadosAprova['id_aprovador_controladoria'] = $this->session->userdata('id_colaborador');
            $dadosAprova['observacao_controladoria'] = $dados['observacao_controladoria'];

             if($dados['id_status_controladoria']==ST_APROVADO || $dados['id_status_controladoria']==ST_APROVADO_PARCIAL){
              $dadosAprova['data_aprovacao_controladoria'] = date('Y-m-d');
            }  
            
            
            $solicitacaoBusiness = $this->Factory->createBusiness("comp_solicitacao");
            $id_solicitacao = $solicitacaoBusiness->editar($dadosAprova); 

          }

          elseif($this->session->userdata('id_perfil')==PERFIL_MASTER){
            
            $dadosAprova['id_solicitacao'] = $dados['id_solicitacao'];
             $dadosAprova['observacao_diretoria'] = $dados['observacao_diretoria'];  
            

            $dadosAprova['id_status_controladoria'] = $dados['id_status_controladoria'];
            
           /* if($objSolicitacao->getId_aprovador_controladoria()>0){
                $dadosAprova['id_aprovador_controladoria'] = $dados['id_aprovador_controladoria'];
            }*/
            //SE O STATUS DA CONTROLADORIA FOR SELECIONADO E NÃO TIVER APROVADOR PEGAR O USUÁRIO LOGADO QUE APROVOU
            if($dados['id_status_controladoria']!=null && $objSolicitacao->getId_aprovador_controladoria()==null ){
                 $dadosAprova['id_aprovador_controladoria'] = $this->session->userdata('id_colaborador'); 
            }

            //DATA DA APROVAÇÃO
            if($dados['id_status_diretoria']==ST_APROVADO || $dados['id_status_diretoria']==ST_APROVADO_PARCIAL){
              $dadosAprova['data_aprovacao_diretoria'] = date('Y-m-d');
            }
            


            $dadosAprova['id_status_diretoria'] = $dados['id_status_diretoria'];
            $dadosAprova['id_aprovador_diretoria'] = $this->session->userdata('id_colaborador'); 
            
            $solicitacaoBusiness = $this->Factory->createBusiness("comp_solicitacao");
            $id_solicitacao = $solicitacaoBusiness->editar($dadosAprova); 

            //SE O PERFIL FOR DIRETORIA E STATUS FOR APROVADOR - GERAR PEDIDOS

            
            if($dados['id_status_diretoria']==ST_APROVADO || $dados['id_status_diretoria']==ST_APROVADO_PARCIAL){
                
                //AGRUPA POR FORNECEDOR A SOLICITAÇÃO
                $solicitacaoBusiness = $this->Factory->createBusiness("comp_solicitacao");
                $list = $solicitacaoBusiness->listar_itens_pc_group($dados['id_solicitacao']);
                 
                 //CADASTRA NA TABELA PEDIDO DE COMPRA
                 foreach ($list as $objSol):
                     
                    //INCLUI PEDIDOS APENAS PARA AS COTAÇÕES QUE NÃO FORAM LANÇADAS
                    //$cotacaoItemBusiness = $this->Factory->createBusiness("comp_cotacoes");
                    //$listCotacao = $cotacaoItemBusiness->cotacao_lancada($dados['id_solicitacao']);

                    //SE LANÇADA
                    //if(sizeof($listCotacao)==0){
                      
                      $dadosPedido['id_fornecedor'] =  $objSol['id_fornecedor']; 
                      $dadosPedido['id_solicitacao'] =  $objSol['id_solicitacao'];
                      $dadosPedido['id_status'] = EM_ELABORACAO;
                      $dadosPedido['data'] = date('Y-m-d'); 
                      $dadosPedido['faturar'] = SIM;
                      $pedidosBusiness = $this->Factory->createBusiness("comp_pedidos");
                      $id_pedido_new = $pedidosBusiness->cadastrar($dadosPedido);

                      //********** INICIO TESTE

                    //$listItens = $solicitacaoBusiness->listar_itens_pc($dados['id_solicitacao']);


                $cotacaoBusiness = $this->Factory->createBusiness("comp_cotacoes");
                $listItens = $cotacaoBusiness->listar_itens_fornecedor($dados['id_solicitacao'],$dadosPedido['id_fornecedor']);
                    
                    foreach ($listItens as $objItem):

                        //VERIFICA NO LOOP DOS ITENS O PEDIDO QUE FOI CADASTRADO ANTERIORMENTE PARA 
                        //INCLUIR NA TABELA DOS ITENS A REFERENCIA DO PEDIDO
                        //$pedidosBusiness = $this->Factory->createBusiness("comp_pedidos");
                        //$objPedido = $pedidosBusiness->visualizar_por_solicitacao($objItem['id_solicitacao'],$objItem['id_fornecedor']);
                        
                           // if($objPedido!=null){
                                
                              //INCLUIR OS ITENS APENAS QUE NÃO FORAM LANÇADOS COMO PARCIAL
                              if($objItem['lancada']!=SIM){ 
                                $dadosItem['id_pedido'] = $id_pedido_new;
                                $dadosItem['id_produto'] = $objItem['id_produto'];
                                $dadosItem['id_custo'] = $objItem['id_custo'];
                                $dadosItem['id_obra'] = $objItem['id_obra'];
                                $dadosItem['valor_unitario'] = $objItem['valor'];
                                $dadosItem['qtd'] = $objItem['qtd'];
                                $dadosItem['data_entrega'] = $objItem['data_entrega'];
                                $dadosItem['status'] = 0;
                                

                                $itensBusiness = $this->Factory->createBusiness("comp_pedidos_itens");
                                $id_pedido_item = $itensBusiness->cadastrar($dadosItem);

                                //ALTERA O ITEM DA COTAÇÃO COMO LANÇADO
                                
                                $dadosCotacao['id_cotacao'] =  $objItem['id_cotacao'];
                                $dadosCotacao['lancada'] = SIM;
                                $dadosCotacao['flag_parcial'] = SIM;
                                $cotacaoBusiness = $this->Factory->createBusiness("comp_cotacoes");
                                $id_cot = $cotacaoBusiness->editar($dadosCotacao);
                            }


                           // }

                     endforeach;

                      //********* FINAL TESTE
                      
                     

                    //} //SE COTACAO === 0

                  endforeach; 

                  //LOOP EM TODOS OS ITENS DA SOLICITAÇÃO APROVADA

                   /* $listItens = $solicitacaoBusiness->listar_itens_pc($dados['id_solicitacao']);
                    
                    foreach ($listItens as $objItem):

                        //VERIFICA NO LOOP DOS ITENS O PEDIDO QUE FOI CADASTRADO ANTERIORMENTE PARA 
                        //INCLUIR NA TABELA DOS ITENS A REFERENCIA DO PEDIDO
                        $pedidosBusiness = $this->Factory->createBusiness("comp_pedidos");
                        $objPedido = $pedidosBusiness->visualizar_por_solicitacao($objItem['id_solicitacao'],$objItem['id_fornecedor']);
                        
                            if($objPedido!=null){
                                
                              //INCLUIR OS ITENS APENAS QUE NÃO FORAM LANÇADOS COMO PARCIAL
                              if($objItem['lancada']!=SIM){ 
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

                                //ALTERA O ITEM DA COTAÇÃO COMO LANÇADO
                                
                                $dadosCotacao['id_cotacao'] =  $objItem['id_cotacao'];
                                $dadosCotacao['lancada'] = SIM;
                                $cotacaoBusiness = $this->Factory->createBusiness("comp_cotacoes");
                                $id_cot = $cotacaoBusiness->editar($dadosCotacao);
                            }


                            }

                     endforeach; 
                     */





                  //FINAL LOOP 
         

          }


            //FINAL INSERÇÃO




          }


           
        
          redirect('pedido_compra/visualizar/'.$dados['id_solicitacao']);
           
               
    }
    //CONFIRMAR SOLICITAÇÃO ORIGINAL
    public function __aprovar(){
        $this->load->helper(array('form','url'));

          $dados = $this->input->post();

           $solicitacaoBusiness = $this->Factory->createBusiness("comp_solicitacao");
           $objSolicitacao = $solicitacaoBusiness->visualizar($dados['id_solicitacao']);


          //ALTERA APENAS O STATUS DA CONTROLADORIA
          if($this->session->userdata('id_perfil')==PERFIL_CONTROLADORIA){
            
            $dadosAprova['id_solicitacao'] = $dados['id_solicitacao'];
            $dadosAprova['id_status_controladoria'] = $dados['id_status_controladoria'];
            $dadosAprova['id_aprovador_controladoria'] = $this->session->userdata('id_colaborador');
            $dadosAprova['observacao_controladoria'] = $dados['observacao_controladoria'];

             if($dados['id_status_controladoria']==ST_APROVADO || $dados['id_status_controladoria']==ST_APROVADO_PARCIAL){
              $dadosAprova['data_aprovacao_controladoria'] = date('Y-m-d');
            }  
            
            
            $solicitacaoBusiness = $this->Factory->createBusiness("comp_solicitacao");
            $id_solicitacao = $solicitacaoBusiness->editar($dadosAprova); 

          }

          elseif($this->session->userdata('id_perfil')==PERFIL_MASTER){
            
            $dadosAprova['id_solicitacao'] = $dados['id_solicitacao'];
             $dadosAprova['observacao_diretoria'] = $dados['observacao_diretoria'];  
            

            $dadosAprova['id_status_controladoria'] = $dados['id_status_controladoria'];
            
           /* if($objSolicitacao->getId_aprovador_controladoria()>0){
                $dadosAprova['id_aprovador_controladoria'] = $dados['id_aprovador_controladoria'];
            }*/
            //SE O STATUS DA CONTROLADORIA FOR SELECIONADO E NÃO TIVER APROVADOR PEGAR O USUÁRIO LOGADO QUE APROVOU
            if($dados['id_status_controladoria']!=null && $objSolicitacao->getId_aprovador_controladoria()==null ){
                 $dadosAprova['id_aprovador_controladoria'] = $this->session->userdata('id_colaborador'); 
            }

            //DATA DA APROVAÇÃO
            if($dados['id_status_diretoria']==ST_APROVADO || $dados['id_status_diretoria']==ST_APROVADO_PARCIAL){
              $dadosAprova['data_aprovacao_diretoria'] = date('Y-m-d');
            }
            


            $dadosAprova['id_status_diretoria'] = $dados['id_status_diretoria'];
            $dadosAprova['id_aprovador_diretoria'] = $this->session->userdata('id_colaborador'); 
            
            $solicitacaoBusiness = $this->Factory->createBusiness("comp_solicitacao");
            $id_solicitacao = $solicitacaoBusiness->editar($dadosAprova); 

            //SE O PERFIL FOR DIRETORIA E STATUS FOR APROVADOR - GERAR PEDIDOS

            
            if($dados['id_status_diretoria']==ST_APROVADO || $dados['id_status_diretoria']==ST_APROVADO_PARCIAL){
                
                //AGRUPA POR FORNECEDOR A SOLICITAÇÃO
                $solicitacaoBusiness = $this->Factory->createBusiness("comp_solicitacao");
                $list = $solicitacaoBusiness->listar_itens_pc_group($dados['id_solicitacao']);
                 
                 //CADASTRA NA TABELA PEDIDO DE COMPRA
                 foreach ($list as $objSol):
                     
                    //INCLUI PEDIDOS APENAS PARA AS COTAÇÕES QUE NÃO FORAM LANÇADAS
                    $cotacaoItemBusiness = $this->Factory->createBusiness("comp_cotacoes");
                    $listCotacao = $cotacaoItemBusiness->cotacao_lancada($dados['id_solicitacao']);

                    //SE LANÇADA
                    //if(sizeof($listCotacao)==0){
                      
                      $dadosPedido['id_fornecedor'] =  $objSol['id_fornecedor']; 
                      $dadosPedido['id_solicitacao'] =  $objSol['id_solicitacao'];
                      $dadosPedido['id_status'] = EM_ELABORACAO;
                      $dadosPedido['data'] = date('Y-m-d'); 
                      $dadosPedido['faturar'] = SIM;
                      $pedidosBusiness = $this->Factory->createBusiness("comp_pedidos");
                      $id_pedido_new = $pedidosBusiness->cadastrar($dadosPedido);

                      //********** INICIO TESTE

                      $listItens = $solicitacaoBusiness->listar_itens_pc($dados['id_solicitacao']);
                    
                    foreach ($listItens as $objItem):

                        //VERIFICA NO LOOP DOS ITENS O PEDIDO QUE FOI CADASTRADO ANTERIORMENTE PARA 
                        //INCLUIR NA TABELA DOS ITENS A REFERENCIA DO PEDIDO
                        //$pedidosBusiness = $this->Factory->createBusiness("comp_pedidos");
                        //$objPedido = $pedidosBusiness->visualizar_por_solicitacao($objItem['id_solicitacao'],$objItem['id_fornecedor']);
                        
                           // if($objPedido!=null){
                                
                              //INCLUIR OS ITENS APENAS QUE NÃO FORAM LANÇADOS COMO PARCIAL
                              if($objItem['lancada']!=SIM){ 
                                $dadosItem['id_pedido'] = $id_pedido_new;
                                $dadosItem['id_produto'] = $objItem['id_produto'];
                                $dadosItem['id_custo'] = $objItem['id_custo'];
                                $dadosItem['id_obra'] = $objItem['id_obra'];
                                $dadosItem['valor_unitario'] = $objItem['valor'];
                                $dadosItem['qtd'] = $objItem['qtd'];
                                $dadosItem['data_entrega'] = $objItem['data_entrega'];
                                $dadosItem['status'] = 0;

                                $itensBusiness = $this->Factory->createBusiness("comp_pedidos_itens");
                                $id_pedido_item = $itensBusiness->cadastrar($dadosItem);

                                //ALTERA O ITEM DA COTAÇÃO COMO LANÇADO
                                
                                $dadosCotacao['id_cotacao'] =  $objItem['id_cotacao'];
                                $dadosCotacao['lancada'] = SIM;
                                //$dadosCotacao['flag_parcial']
                                $cotacaoBusiness = $this->Factory->createBusiness("comp_cotacoes");
                                $id_cot = $cotacaoBusiness->editar($dadosCotacao);
                            }


                           // }

                     endforeach;

                      //********* FINAL TESTE
                      
                     

                    //} //SE COTACAO === 0

                  endforeach; 

                  //LOOP EM TODOS OS ITENS DA SOLICITAÇÃO APROVADA

                   /* $listItens = $solicitacaoBusiness->listar_itens_pc($dados['id_solicitacao']);
                    
                    foreach ($listItens as $objItem):

                        //VERIFICA NO LOOP DOS ITENS O PEDIDO QUE FOI CADASTRADO ANTERIORMENTE PARA 
                        //INCLUIR NA TABELA DOS ITENS A REFERENCIA DO PEDIDO
                        $pedidosBusiness = $this->Factory->createBusiness("comp_pedidos");
                        $objPedido = $pedidosBusiness->visualizar_por_solicitacao($objItem['id_solicitacao'],$objItem['id_fornecedor']);
                        
                            if($objPedido!=null){
                                
                              //INCLUIR OS ITENS APENAS QUE NÃO FORAM LANÇADOS COMO PARCIAL
                              if($objItem['lancada']!=SIM){ 
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

                                //ALTERA O ITEM DA COTAÇÃO COMO LANÇADO
                                
                                $dadosCotacao['id_cotacao'] =  $objItem['id_cotacao'];
                                $dadosCotacao['lancada'] = SIM;
                                $cotacaoBusiness = $this->Factory->createBusiness("comp_cotacoes");
                                $id_cot = $cotacaoBusiness->editar($dadosCotacao);
                            }


                            }

                     endforeach; 
                     */





                  //FINAL LOOP 
         

          }


            //FINAL INSERÇÃO




          }


           
        
          redirect('pedido_compra/visualizar/'.$dados['id_solicitacao']);
           
               
    }

     

     public function teste(){
        $this->load->helper(array('form','url'));
                
            $solicitacaoBusiness = $this->Factory->createBusiness("comp_solicitacao");
            $list = $solicitacaoBusiness->listar_itens_pc_group(12);
             foreach ($list as $objSol):
              echo $objSol['id_fornecedor']; 

            endforeach; 

    }



       


} //final classs

?>
