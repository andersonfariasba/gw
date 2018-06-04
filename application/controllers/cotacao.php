<?php
/* Classe(controller): Produtos
 * Autor: Anderson Farias
 * Última atualização: 30/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Cotacao extends MY_Controller {
	
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
            $listSolicitacao = $solicitacaoBusiness->filtro_cotacao();
            $info["listSolicitacao"] = $listSolicitacao;

            $statusBusiness = $this->Factory->createBusiness("conf_status");
            $listStatus = $statusBusiness->filtro(null);
            $info['listStatus'] = $listStatus;

            /* $statusPerfilBusiness = $this->Factory->createBusiness("acesso_perfil_status");
             $listStatusPerfil = $statusPerfilBusiness->listar($this->session->userdata('id_perfil'));
             $info['listStatus'] = $listStatusPerfil;*/

            $colaboradoresBusiness = $this->Factory->createBusiness("rh_colaboradores");
            $listColaborador = $colaboradoresBusiness->filtro(null);
            $info['listUser'] = $listColaborador;

           $colaboradoresBusiness = $this->Factory->createBusiness("acesso_usuarios");
            $perfis = array(PERFIL_COORDENADOR, PERFIL_MASTER);
            $listColaborador = $colaboradoresBusiness->listar_aprovador($perfis);
            //$listColaborador = $colaboradoresBusiness->listar_por_perfil(PERFIL_COORDENADOR);
            $info['listUserAprovador'] = $listColaborador;

           
            
            $content = $this->load->view("cotacao/filtro",$info,TRUE);
            $this->loadPage($content);

            }else{
            
            $dados = $this->input->post();
            
            //Lista de Solicitação
            $solicitacaoBusiness = $this->Factory->createBusiness("comp_solicitacao");
            $listSolicitacao = $solicitacaoBusiness->filtro($dados);
            $info["listSolicitacao"] = $listSolicitacao;

           /* $statusBusiness = $this->Factory->createBusiness("conf_status");
            $listStatus = $statusBusiness->filtro(null);
            $info['listStatus'] = $listStatus;
            */

             $statusPerfilBusiness = $this->Factory->createBusiness("acesso_perfil_status");
             $listStatusPerfil = $statusPerfilBusiness->listar($this->session->userdata('id_perfil'));
             $info['listStatus'] = $listStatusPerfil;

            $colaboradoresBusiness = $this->Factory->createBusiness("rh_colaboradores");
            $listColaborador = $colaboradoresBusiness->filtro(null);
            $info['listUser'] = $listColaborador;

             $aprovadorBusiness = $this->Factory->createBusiness("acesso_usuarios");
            $listUserAprovador = $aprovadorBusiness->listar_por_perfil(PERFIL_COORDENADOR);
            $info['listUserAprovador'] = $listUserAprovador;
            
            $content = $this->load->view("cotacao/filtro",$info,TRUE);
            $this->loadPage($content);  
              
            }
            
          } catch (Exception $exc) {
            $this->loadError($ex);
        }
    }


        //INCLUSÃO DE ITENS
    public function visualizar($id_solicitacao){
        $this->load->helper(array('form','url'));
        //$this->load->library('form_validation');
       
        
        $info['msg'] = "";
        
       if ($this->input->post() == NULL) {
                               
            
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
            $listItens = $itensBusiness->listar($id_solicitacao);
            $info['listItens'] = $listItens;

            $colaboradoresBusiness = $this->Factory->createBusiness("acesso_usuarios");
            $perfis = array(PERFIL_COORDENADOR, PERFIL_MASTER);
            $listColaborador = $colaboradoresBusiness->listar_aprovador($perfis);
            //$listColaborador = $colaboradoresBusiness->listar_por_perfil(PERFIL_COORDENADOR);
            $info['listUser'] = $listColaborador;

            $userBusiness = $this->Factory->createBusiness("acesso_usuarios");
            $objUser = $userBusiness->visualizar($this->session->userdata('id_usuario'));
            $info["objUser"] = $objUser;


             //Fornecedores
            $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
            $listFornecedor = $fornecedorBusiness->filtro();
            $info["listFornecedor"] = $listFornecedor;

            //VARIAVEIS QUE DETERMINA SE A QTD DE ITENS LANÇADOS SÃO IGUAIS AO SOLICITADO
            //PARA SABER SE A COTAÇAO ESTÁ CONCLUIDA

            //VERIFICA A QTD DE COTAÇÃO(ITENS) FORAM LANÇADOS
            $cotacaoItemBusiness = $this->Factory->createBusiness("comp_cotacoes");
            $qtd_cotacao_lancada = $cotacaoItemBusiness->qtd_cotacao_lancada($id_solicitacao);
            $info['qtd_cotacao_lancada'] = $qtd_cotacao_lancada;

            //QTD TOTAL DE ITENS
             $qtd_cotacao_total = sizeof($listItens);
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



     

            $statusBusiness = $this->Factory->createBusiness("conf_status");
            $listStatus = $statusBusiness->filtro(null);
            $info['listStatus'] = $listStatus;

             /*$statusPerfilBusiness = $this->Factory->createBusiness("acesso_perfil_status");
             $listStatusPerfil = $statusPerfilBusiness->listar($this->session->userdata('id_perfil'));
             $info['listStatus'] = $listStatusPerfil;*/

           
            $content = $this->load->view("cotacao/visualizar",$info,TRUE);
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

           $itensBusiness = $this->Factory->createBusiness("comp_itens");
           $id_item = $itensBusiness->cadastrar($dadosItens);

           $solicitacaoBusiness = $this->Factory->createBusiness("comp_solicitacao");
           $id_solicitacao = $solicitacaoBusiness->editar($dadosSol);
           
           $msg = true;
           
           redirect('cotacao/visualizar/'.$dados['id_solicitacao']);


        }

    }



     public function add_preco(){
        $this->load->helper(array('form','url'));
                
                $dados = $this->input->post();
                
                $id_solicitacao = $dados['id_solicitacao'];
                
                $objDateFormat = $this->DateFormat;
                $dadosItens['data_entrega'] = $objDateFormat->date_mysql($dados['data_entrega']);
                $dadosItens['data_inclusao'] = date('Y-m-d');

                $dadosItens['id_item'] = $dados['id_item'];
                $dadosItens['id_produto'] = $dados['id_produto'];
                
                //SE APROVAR PELA TELA DE CADASTRO
                if(isset($dados['status'])){

                  $dadosItens['status'] = COTACAO_APROVADA;
                   //atualiza todo os item como anadamento e depois aprova o iten selecionado
                    $dadosSol['id_item'] = $dados['id_item'];
                    $dadosSol['status'] = COTACAO_ANDAMENTO; 
                    $cotacaoItemBusiness = $this->Factory->createBusiness("comp_cotacoes");
                    $cotacaoItemBusiness->editar_todos_itens($dadosSol);
                
                }

                else{
                  $dadosItens['status'] = COTACAO_ANDAMENTO;
                }

                //FINAL TESTE



                
                //$dadosItens['status'] = COTACAO_ANDAMENTO;
                $dadosItens['id_fornecedor'] = $dados['id_fornecedor'];
                $dadosItens['qtd'] = $dados['qtd'];
                //$dadosItens['valor'] = str_replace(",", "." ,$dados['valor']);
                $dadosItens['valor'] = str_replace(",",".",str_replace(".","",$dados['valor']));
                $dadosItens['observacao'] = $dados['observacao'];

              
               $registroBusiness = $this->Factory->createBusiness("comp_cotacoes");
               $cod_registro = $registroBusiness->cadastrar($dadosItens);

               redirect('cotacao/visualizar/'.$dados['id_solicitacao']);

    }



    //Listar preços na tela de cotação
    public function ajax_listar_cotacao($id_item){

      //header( 'Cache-Control: no-cache' );
      //header( 'Content-type: application/xml; charset="utf-8"', true );
      
      $this->load->helper(array('form','url'));

      $fatBusiness = $this->Factory->createBusiness("comp_cotacoes");
      $listFat = $fatBusiness->ajax_listar_cotacao($id_item);
     
      echo json_encode($listFat); 
    
    }

      public function ajax_listar_fornecedor($id_solicitacao){

      //header( 'Cache-Control: no-cache' );
      //header( 'Content-type: application/xml; charset="utf-8"', true );
      
      $this->load->helper(array('form','url'));

      $fatBusiness = $this->Factory->createBusiness("comp_cotacoes");
      $listFat = $fatBusiness->ajax_listar_fornecedor($id_solicitacao);
     
      echo json_encode($listFat); 
    
    }
   

    public function teste(){
        $this->load->helper(array('form','url'));
                
                //$dados = $this->input->post();
                
                //$id_solicitacao = $dados['id_solicitacao'];
                
                $objDateFormat = $this->DateFormat;
                $dadosItens['data_entrega'] = date('Y-m-d');
                $dadosItens['data_inclusao'] = date('Y-m-d');

                $dadosItens['id_item'] = 257;
                $dadosItens['id_fornecedor'] = 5;
                $dadosItens['qtd'] = 1;
                $dadosItens['valor'] = 2;
                $dadosItens['observacao'] = "teste";

              
               $registroBusiness = $this->Factory->createBusiness("comp_cotacoes");
               $cod_registro = $registroBusiness->cadastrar($dadosItens);

               //redirect('cotacao/visualizar/'.$dados['id_solicitacao']);

    }

      //ATUALIZAR ITEM
      public function aprovar_item($id_cotacao,$id_solicitacao){
          $this->load->helper(array('form','url'));


           $cotacaoItemBusiness = $this->Factory->createBusiness("comp_cotacoes");
          $objCotacao = $cotacaoItemBusiness->visualizar($id_cotacao);

           //ATUALIZADO TODOS OS ITENS PARA ANDAMENTO
           $dadosSol['id_item'] = $objCotacao->getId_item();
           $dadosSol['status'] = COTACAO_ANDAMENTO; 
           $cotacaoItemBusiness->editar_todos_itens($dadosSol);

           //ATUALLIZA O STATUS SELECIONADO
           $dados['id_cotacao'] = $id_cotacao;
           $dados['status'] = COTACAO_APROVADA; 
          
          $cotacaoItemBusiness->editar($dados);
          
          redirect("cotacao/visualizar/".$id_solicitacao);
      }

       //ATUALIZAR ITEM
      public function excluir_item($id_cotacao,$id_solicitacao){
          $this->load->helper(array('form','url'));

          $cotacaoItemBusiness = $this->Factory->createBusiness("comp_cotacoes");
          $objCotacao = $cotacaoItemBusiness->visualizar($id_cotacao);

                  
          $cotacaoItemBusiness->excluir($id_cotacao);
          
          redirect("cotacao/visualizar/".$id_solicitacao);
      }


      public function confirmar(){
        $this->load->helper(array('form','url'));

          $dados = $this->input->post();
                   
          $objDateFormat = $this->DateFormat;
          $dados['data_necessidade'] = $objDateFormat->date_mysql($dados['data_necessidade']);
          $dados['data_criacao'] = $objDateFormat->date_mysql($dados['data_criacao']);

            //VERIFICA SE É DIRETORIA || COORDENADOR
           if($this->session->userdata('id_perfil')==PERFIL_COORDENADOR || $this->session->userdata('id_perfil')==PERFIL_MASTER){

              //VERIFICA O STATUS DE APROVAÇÃO
              if ($dados['id_status_cotacao']==ST_APROVADO || $dados['id_status_cotacao']==ST_APROVADO_PARCIAL){

                 $dados['data_aprovacao_cotacao'] = date('Y-m-d');
              $dados['codigo_pc'] = $dados['id_solicitacao'];

              //SETANDO OS ITENS COM A FLAG PARCIAL
              //SETAR ITENS DA COTAÇÃO != 1 (LANÇADO) ALTERANDO O VALOR DA FLAG PARA 0
              //Flag Parcial da cotação: (em conjunto com a flag lançada = 1)
              // "" não foi lançada pela responsável da cotação
              // = 0 lançada para aprovação da diretoria
              // = 1 lançada pela diretoria

                $cotacaoItemBusiness = $this->Factory->createBusiness("comp_cotacoes");
                $listCotacao = $cotacaoItemBusiness->verificar_cotacao_parcial($dados['id_solicitacao']);

                foreach ($listCotacao as $objIten):
                $dadosAlt['id_cotacao'] = $objIten['id_cotacao'];
                $dadosAlt['flag_parcial'] = 0;

                $cotacaoItemBusiness = $this->Factory->createBusiness("comp_cotacoes");
                $edit = $cotacaoItemBusiness->editar($dadosAlt);

               
                endforeach; 
              
              } //FINAL VERIFICAÇÃO DE STATUS
           
            
           
           
           } //FINAL IF APROVADOR PERFIL

           //FINAL VERIFICA SE É DIRETORIA || COORDENADO
           //CASO SEJA OUTRO PEIFL (REQUISITANTE OU CONTROLADORIA)
           else{

            //ENVIA EMAIL PARA APROVADOR
            $dados['id_status_cotacao'] = ST_EM_APROVACAO;

            $enviar_email = true;

            //Pega os dados do aprovador
            $aprovadorBusiness = $this->Factory->createBusiness("rh_colaboradores");
            $objAprovador = $aprovadorBusiness->visualizar($dados['id_aprovador_cotacao']);


            $this->load->library('email');

            $this->email->to($objAprovador->getEmail()); //Para 
            $this->email->from('comercial@estrategicengenharia.com.br', 'Estrategic'); //remetente
            $this->email->set_mailtype("html");
            $this->email->subject('Aprovar Cotação - Estrategic');
            $this->email->message('<p>Favor verificar o sistema da Estrateic Engenharia, a Cotação Nº <strong>'.$dados['id_solicitacao'].' </strong>precisa da sua aprovação.</p><p><strong>Equipe Estrategic agradece!</strong></p>');  

            $this->email->send();
           

           } // FINAL ELSE OUTRO PERFIL
                    
           
      

          $solicitacaoBusiness = $this->Factory->createBusiness("comp_solicitacao");
          $id_solicitacao = $solicitacaoBusiness->editar($dados);
          

          $msg = true;
           
        
          redirect('cotacao/filtro/');


      }




     public function ___confirmar(){
        $this->load->helper(array('form','url'));

          $dados = $this->input->post();
                   
          $objDateFormat = $this->DateFormat;
          $dados['data_necessidade'] = $objDateFormat->date_mysql($dados['data_necessidade']);
          $dados['data_criacao'] = $objDateFormat->date_mysql($dados['data_criacao']);
                    
         

          //ENVIAR EMAIL CASO SELECIONE 
          if($dados['id_aprovador_cotacao']!="" && $this->session->userdata('id_perfil')!=PERFIL_COORDENADOR){
              
              //$dados['data_aprovacao_cotacao'] = date('Y-m-d');
              $dados['id_status_cotacao'] = ST_EM_APROVACAO;

              $enviar_email = true;

              //Pega os dados do aprovador
               $aprovadorBusiness = $this->Factory->createBusiness("rh_colaboradores");
               $objAprovador = $aprovadorBusiness->visualizar($dados['id_aprovador_cotacao']);

               
               $this->load->library('email');

                $this->email->to($objAprovador->getEmail()); //Para 
                $this->email->from('comercial@estrategicengenharia.com.br', 'Estrategic'); //remetente
                $this->email->set_mailtype("html");
                $this->email->subject('Aprovar Cotação - Estrategic');
                $this->email->message('<p>Favor verificar o sistema da Estrateic Engenharia, a Cotação Nº <strong>'.$dados['id_solicitacao'].' </strong>precisa da sua aprovação.</p><p><strong>Equipe Estrategic agradece!</strong></p>');  

                $this->email->send();

                


             
              //FINAL ENVIO DO EMAIL


          }

          else if ($dados['id_aprovador_cotacao']=="" && $this->session->userdata('id_perfil')!=PERFIL_COORDENADOR) {
            $dados['id_status_cotacao'] = EM_ELABORACAO;
            
          }

           else if ($dados['id_status_cotacao']==ST_APROVADO || $dados['id_status_cotacao']==ST_APROVADO_PARCIAL) {          
              $dados['data_aprovacao_cotacao'] = date('Y-m-d');
              $dados['codigo_pc'] = $dados['id_solicitacao'];

              //SETANDO OS ITENS COM A FLAG PARCIAL
              //SETAR ITENS DA COTAÇÃO != 1 (LANÇADO) ALTERANDO O VALOR DA FLAG PARA 0

                $cotacaoItemBusiness = $this->Factory->createBusiness("comp_cotacoes");
                $listCotacao = $cotacaoItemBusiness->verificar_cotacao_parcial($dados['id_solicitacao']);

                foreach ($listCotacao as $objIten):
                $dadosAlt['id_cotacao'] = $objIten['id_cotacao'];
                $dadosAlt['flag_parcial'] = 0;

                $cotacaoItemBusiness = $this->Factory->createBusiness("comp_cotacoes");
                $edit = $cotacaoItemBusiness->editar($dadosAlt);

               
                endforeach; 




          }

         

          $solicitacaoBusiness = $this->Factory->createBusiness("comp_solicitacao");
          $id_solicitacao = $solicitacaoBusiness->editar($dados);
          

          $msg = true;
           
        
          redirect('cotacao/filtro/');
           
               
    }



     //ATUALIZAR ITEM
      public function testex($id_solicitacao){
          $this->load->helper(array('form','url'));

          $cotacaoItemBusiness = $this->Factory->createBusiness("comp_cotacoes");
          $qtd_lancada = $cotacaoItemBusiness->qtd_cotacao_lancada($id_solicitacao);

            $itensBusiness = $this->Factory->createBusiness("comp_itens");
            $listItens = $itensBusiness->listar($id_solicitacao);
           

            echo "Lançados: ".$qtd_lancada;
            echo "<br>";
             echo "Geral: ".sizeof($listItens);



          //print_r($listCotacao);

        /* foreach ($listCotacao as $objIten):
            echo $objIten['id_cotacao'];
          echo "<br>";

         endforeach; 
         */

          
      }







} //final classs

?>
