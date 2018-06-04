<?php
/* Classe(controller): Produtos
 * Autor: Anderson Farias
 * Última atualização: 30/06/2015
 * Contato: andersonjfarias@yahoo.com.br
 */

class Solicitacao extends MY_Controller {
	
    //VALIDAÇÃO
    private function Rules(){
       
        //$this->form_validation->set_rules('data_necessidade','Data Prioridade','required');
       
        $this->form_validation->set_rules('data_criacao','Data da Solicitação','required');
        $this->form_validation->set_rules('id_solicitante','Solicitante','required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"  id="msgOk">
<strong><i class="fa fa-check"></i></strong> ', '</div>');    
    }

     private function RulesItens(){
       
      
        $this->form_validation->set_rules('id_produto','Material','required');
        $this->form_validation->set_rules('qtd','Quantidade','required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"  id="msgOk">
<strong><i class="fa fa-check"></i></strong> ', '</div>');    
    }

      private function RulesItensEditar(){
       
       
        $this->form_validation->set_rules('qtd','Quantidade','required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"  id="msgOk">
<strong><i class="fa fa-check"></i></strong> ', '</div>');    
    }


   


    //INICIA SOLICITACAO MANUAL DE COMPRA
    public function iniciar_manual($msg=null){
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
        $this->Rules();
        
        $info['msg'] = $msg;
        
        if($this->form_validation->run()==FALSE){
                   
            
            //Fornecedor
            $fornecedorBusiness = $this->Factory->createBusiness("com_fornecedores");
            $listFornecedor = $fornecedorBusiness->filtro();
            $info["listFornecedor"] = $listFornecedor;
           
            $content = $this->load->view("solicitacao/iniciar_manual",$info,TRUE);
            $this->loadPage($content);
        }
        
        else{
           //error_reporting(0);
           $dados = $this->input->post();
            
           $dados['id_status'] = EM_ELABORACAO;
           $dados['tipo_entrada'] = SOL_MANUAL;
           $objDateFormat = $this->DateFormat;
           $dados['data_necessidade'] = $objDateFormat->date_mysql($dados['data_necessidade']);
           $dados['data_criacao'] = $objDateFormat->date_mysql($dados['data_criacao']);
           
           $solicitacaoBusiness = $this->Factory->createBusiness("comp_solicitacao");
           $id_solicitacao = $solicitacaoBusiness->cadastrar($dados);
           
           $msg = true;
           
           redirect('solicitacao/incluir_itens/'.$id_solicitacao);


        }

    }

    
        //INCLUSÃO DE ITENS
    public function incluir_itens($id_solicitacao){
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
        $this->RulesItens();
        
        $info['msg'] = "";
        
        if($this->form_validation->run()==FALSE){
                               
            
            //Dados da visualização da solicitação
            $solicitacaoBusiness = $this->Factory->createBusiness("comp_solicitacao");
            $objSolicitacao = $solicitacaoBusiness->visualizar($id_solicitacao);
            $info['objSolicitacao'] = $objSolicitacao;

            //lista dos produtos
            $produtosBusiness = $this->Factory->createBusiness("est_produtos");
            $listProdutos = $produtosBusiness->filtro(null);
            $info['listProdutos'] = $listProdutos;

           
             //lista dos produtos
            $itensBusiness = $this->Factory->createBusiness("comp_itens");
            $listItens = $itensBusiness->filtro($id_solicitacao);
            $info['listItens'] = $listItens;

                     

            $colaboradoresBusiness = $this->Factory->createBusiness("acesso_usuarios");
            $perfis = array(PERFIL_COORDENADOR, PERFIL_MASTER);
            $listColaborador = $colaboradoresBusiness->listar_aprovador($perfis);
            //$listColaborador = $colaboradoresBusiness->listar_por_perfil(PERFIL_COORDENADOR);
            $info['listUser'] = $listColaborador;

            $userBusiness = $this->Factory->createBusiness("acesso_usuarios");
            $objUser = $userBusiness->visualizar($this->session->userdata('id_usuario'));
            $info["objUser"] = $objUser;
     

         
             /*$statusPerfilBusiness = $this->Factory->createBusiness("acesso_perfil_status");
             $listStatusPerfil = $statusPerfilBusiness->listar($this->session->userdata('id_perfil'));
             $info['listStatus'] = $listStatusPerfil;
             */

             $statusPerfilBusiness = $this->Factory->createBusiness("conf_status");
             $listStatusPerfil = $statusPerfilBusiness->filtro();
             $info['listStatus'] = $listStatusPerfil;
             

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
              
              

           
            $content = $this->load->view("solicitacao/incluir_itens",$info,TRUE);
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


     //LISTAGEM
    public function filtro($dados=null){
        try {
            $this->load->helper(array('form','url'));
            
            if ($this->input->post() == NULL) {
            
           
            //Lista de Solicitação
            $solicitacaoBusiness = $this->Factory->createBusiness("comp_solicitacao");
            $listSolicitacao = $solicitacaoBusiness->filtro();
            $info["listSolicitacao"] = $listSolicitacao;

            $statusBusiness = $this->Factory->createBusiness("conf_status");
            $listStatus = $statusBusiness->filtro(null);
            $info['listStatus'] = $listStatus;

            $colaboradoresBusiness = $this->Factory->createBusiness("rh_colaboradores");
            $listColaborador = $colaboradoresBusiness->filtro(null);
            $info['listUser'] = $listColaborador;

            
            /*$aprovadorBusiness = $this->Factory->createBusiness("acesso_usuarios");
            $listUserAprovador = $aprovadorBusiness->listar_por_perfil(PERFIL_COORDENADOR);
            $info['listUserAprovador'] = $listUserAprovador;
            */
            $colaboradoresBusiness = $this->Factory->createBusiness("acesso_usuarios");
            $perfis = array(PERFIL_COORDENADOR, PERFIL_MASTER);
            $listColaborador = $colaboradoresBusiness->listar_aprovador($perfis);
            //$listColaborador = $colaboradoresBusiness->listar_por_perfil(PERFIL_COORDENADOR);
            $info['listUserAprovador'] = $listColaborador;

           
            
            $content = $this->load->view("solicitacao/filtro",$info,TRUE);
            $this->loadPage($content);

            }else{
            
            $dados = $this->input->post();
            
            //Lista de Solicitação
            $solicitacaoBusiness = $this->Factory->createBusiness("comp_solicitacao");
            $listSolicitacao = $solicitacaoBusiness->filtro($dados);
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
            
            $content = $this->load->view("solicitacao/filtro",$info,TRUE);
            $this->loadPage($content);  
              
            }
            
          } catch (Exception $exc) {
            $this->loadError($ex);
        }
    }


    public function item_editar(){
        $this->load->helper(array('form','url'));
                
                $dados = $this->input->post();
                $id_solicitacao = $dados['id_solicitacao'];
                
                $dadosItens['id_item'] = $dados['id_item'];
                $dadosItens['qtd'] = $dados['qtd'];

                $registroBusiness = $this->Factory->createBusiness("comp_itens");
                $cod_registro = $registroBusiness->editar($dadosItens);

    }

    public function ajax_visualizar_item($id_item){

      //header( 'Cache-Control: no-cache' );
      //header( 'Content-type: application/xml; charset="utf-8"', true );
      
      $this->load->helper(array('form','url'));

     
     /* $itemBusiness = $this->Factory->createBusiness("comp_itens");
      $item = $itemBusiness->visualizar_soma($id_item);  

             
         $itemArr[] = array(
               'id_item'   => $item['id_item'],
               'id_solicitacao'   => $item['id_solicitacao'],
               'id_produto'   => $item['id_produto'],
               'produto_nome'   => $item['descricao'],
               'qtd'   => $item['qtd'],
                             
            );
      
      echo json_encode($itemArr); 

      */
      
      
      $itemBusiness = $this->Factory->createBusiness("comp_itens");
      $item = $itemBusiness->visualizar($id_item);  
         
         $itemArr[] = array(
               'id_item'   => $item->getId_item(),
               'id_solicitacao'   => $item->getId_solicitacao(),
               'id_produto'   => $item->getId_produto(),
               'produto_nome'   => $item->getProduto()->getDescricao(),
               'qtd'   => $item->getQtd()
               
              
            );
      
      echo json_encode($itemArr); 
      


                
    

    }




    //CONFIRMAR SOLICITAÇÃO
    public function confirmar(){
        $this->load->helper(array('form','url'));

          $dados = $this->input->post();
                   
          $objDateFormat = $this->DateFormat;
          $dados['data_necessidade'] = $objDateFormat->date_mysql($dados['data_necessidade']);
          $dados['data_criacao'] = $objDateFormat->date_mysql($dados['data_criacao']);
          
          //ENVIAR EMAIL CASO SELECIONE 
          
          //VERIFICA SE É DIRETORIA || COORDENADOR
          if($this->session->userdata('id_perfil')==PERFIL_COORDENADOR || $this->session->userdata('id_perfil')==PERFIL_MASTER){
            
              //CASO SEJA APROVADO ARMAZENAR A DATA DA APROVAÇÃO
              if($dados['id_status']==ST_APROVADO){
                $dados['data_aprovacao'] = date('Y-m-d');
                 $dados['id_status_cotacao'] = EM_ELABORACAO;
              } 

             
          
          }
          //FINAL VERIFICA SE É DIRETORIA || COORDENADO
          //CASO SEJA OUTRO PEIFL (REQUISITANTE OU CONTROLADORIA)
          else{
            
            //ENVIO PARA APROVAÇÃO

              $dados['id_status'] = ST_EM_APROVACAO;
              $dados['id_status_cotacao'] = EM_ELABORACAO;
            
              $enviar_email = true;

              //Pega os dados do aprovador
              $aprovadorBusiness = $this->Factory->createBusiness("rh_colaboradores");
              $objAprovador = $aprovadorBusiness->visualizar($dados['id_aprovador']);

              $this->load->library('email');

              $this->email->to($objAprovador->getEmail()); //Para 
              $this->email->from('comercial@estrategicengenharia.com.br', 'Estrategic'); //remetente
              $this->email->set_mailtype("html");
              $this->email->subject('Aprovar Solicitação - Estrategic');
              $this->email->message('<p>Favor verificar o sistema da Estrateic Engenharia, a solicitação Nº <strong>'.$dados['id_solicitacao'].' </strong>precisa da sua aprovação.</p><p><strong>Equipe Estrategic agradece!</strong></p>');  

              $this->email->send();

            //FINAL ENVIO


          } //FINAL ELSE OUTRO PERFIL


          $solicitacaoBusiness = $this->Factory->createBusiness("comp_solicitacao");
          $id_solicitacao = $solicitacaoBusiness->editar($dados);


          $msg = true;


          redirect('solicitacao/filtro/');
        
           
               


    }



    //INICIA SOLICITACAO MANUAL DE COMPRA
    public function iniciar_importacao($msg=null){
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
       

        $this->Rules();
        
        $info['msg'] = $msg;
        
        if($this->form_validation->run()==FALSE){
                   
            
            /*$colaboradoresBusiness = $this->Factory->createBusiness("rh_colaboradores");
            $listColaborador = $colaboradoresBusiness->filtro(null);
            $info['listUser'] = $listColaborador;*/

            $colaboradoresBusiness = $this->Factory->createBusiness("acesso_usuarios");
            $listColaborador = $colaboradoresBusiness->listar_por_perfil(PERFIL_COORDENADOR);
            $info['listUser'] = $listColaborador;

            //$statusBusiness = $this->Factory->createBusiness("conf_status");
            //$listStatus = $statusBusiness->filtro(null);
            //$info['listStatus'] = $listStatus;

             $statusPerfilBusiness = $this->Factory->createBusiness("acesso_perfil_status");
             $listStatusPerfil = $statusPerfilBusiness->listar($this->session->userdata('id_perfil'));
             $info['listStatus'] = $listStatusPerfil;


           
            $content = $this->load->view("solicitacao/iniciar_importacao",$info,TRUE);
            $this->loadPage($content);
        }
        
        else{
           error_reporting(0);
          $this->load->library('excel');
           $dados = $this->input->post();
            
           $dados['id_status'] = EM_ELABORACAO;
           $dados['tipo_entrada'] = SOL_IMPORT;
           $objDateFormat = $this->DateFormat;
           $dados['data_necessidade'] = $objDateFormat->date_mysql($dados['data_necessidade']);
           $dados['data_criacao'] = $objDateFormat->date_mysql($dados['data_criacao']);

           // SALVAR O ARQUIVO

                $config['upload_path'] = './importacao/';//Caminho onde será salvo
                $config['allowed_types'] = 'csv|xls|xlsx';//Tipos de imagem aceito
                $config['max_size'] = '9096';//Tamanho - Aqui aceitamos até 2 Mb
                $config['overwrite']  = FALSE;//Não irá sobre-escrever o arquivo
                $config['encrypt_name'] = TRUE;//Trocará o nome do arquivo para um HASH - TRUE PADRÃO

                              
                $field_name1 = "arquivo";// Nome do campo INPUT do formulário                         
                $this->load->library('upload');
                $this->upload->initialize($config);

                if(!$this->upload->do_upload($field_name1))
                {
                $error = array('erro' => $this->upload->display_errors());
                echo "<script>alert('Verifique o tamanho ou formato do arquivo!')</script>";
                echo "<script>window.history.back();</script>";
              
                }

                $dadosUp = $this->upload->data();
                $dadosLanc['arquivo'] = $dadosUp['file_name'];

                $objReader = new PHPExcel_Reader_Excel5();
                $objReader->setReadDataOnly(true);
                $teste = "importar_material.xlsx";
                $objPHPExcel = $objReader->load($config['upload_path'] . $dadosLanc['arquivo']);
                //$objPHPExcel = $objReader->load($config['upload_path'] . $teste);


                  if (!$objPHPExcel ){
                  echo "Arquivo nao encontrado";
                } 

                else{

                $i = 0;
                // Pegar total colunas
                $colunas = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
                $total_colunas = PHPExcel_Cell::columnIndexFromString($colunas);

                // Pegar total linhas
                $total_linhas = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow(); 

                //Bloco de leitura do arquivo
                $codigo_material = "";
                $qtd = "";
                $codigo_obra = "";


                for($linha=1; $linha <= $total_linhas; $linha++){

                  $i++;
                  $erro = false;
                  $this->msg = "<br><br>Linha: " . $linha;

                  //Ignora linha do cabecalho
                  if($linha!=1){

                  // navegar nas colunas da respectiva linha
                  for($coluna=0; $coluna <= $total_colunas-1; $coluna++){

                    //Quebra a linha seguindo o layout        
                    $valor_coluna = utf8_decode($objPHPExcel->getActiveSheet()->getCellByColumnAndRow($coluna, $linha)->getValue());

                     //CONTRATO
                    if($coluna==0){
                      $codigo_material = $valor_coluna;
                      //echo $contrato;
                    }

                    echo $codigo_material;




                  }

                }

              }


                

                } //ELSE $objPHPExcel
           
           //FINAL SALVAR O ARQUIVO 



           print_r($dados);
           
           //$solicitacaoBusiness = $this->Factory->createBusiness("comp_solicitacao");
           //$id_solicitacao = $solicitacaoBusiness->cadastrar($dados);
           
           //$msg = true;
           
           //redirect('solicitacao/incluir_itens/'.$id_solicitacao);


        }

    }





   public function importacao_confirmar(){
     
     error_reporting(0); 
      
      $this->load->helper(array('form','url'));
      $this->load->library('excel');

      $config['upload_path'] = './importacao/';//Caminho onde será salvo
      $config['allowed_types'] = 'txt|csv|xls|xlsx';//Tipos de imagem aceito
      $config['max_size'] = '9096';//Tamanho - Aqui aceitamos até 2 Mb
      $config['overwrite']  = FALSE;//Não irá sobre-escrever o arquivo
      $config['encrypt_name'] = TRUE;//Trocará o nome do arquivo para um HASH - TRUE PADRÃO

      $field_name1 = "arquivo";// Nome do campo INPUT do formulário                         
      $this->load->library('upload');
      $this->upload->initialize($config);

      if(!$this->upload->do_upload($field_name1))
        {
          $error = array('erro' => $this->upload->display_errors());
          echo "<script>alert('Verifique o tamanho ou formato do arquivo!')</script>";
          echo "<script>window.history.back();</script>";
          exit;
         
        }


//$file = './importacao/importar_material.xlsx';
$dados = $this->input->post(); 
$dadosUp = $this->upload->data();
$dadosLanc['arquivo'] = $dadosUp['file_name'];

 $file = $config['upload_path'] . $dadosLanc['arquivo'];

//load the excel library
$this->load->library('excel');
 
//read file from path
$objPHPExcel = PHPExcel_IOFactory::load($file);
 
//get only the Cell Collection
$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
 
//extract to a PHP readable array format
foreach ($cell_collection as $cell) {
    $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
    $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
    $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
 
    if($column=="A2"){
        echo $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
        echo "<br>";
    }
    
    //echo "<br/>";
    //The header will/should be in row 1 only. of course, this can be modified to suit your need.
    
   
    

    if ($row == 1) {
        $header[$row][$column] = $data_value;
        //echo $header[$row][$column]; 
    } else {
        $arr_data[$row][$column] = $data_value;
    }




}
 
//send the data in an array format
$data['header'] = $header;
$data['values'] = $arr_data;


// INCLUSÃO DADOS DA SOLICITAÇÃO
$objDateFormat = $this->DateFormat;
$dados['data_criacao'] = $objDateFormat->date_mysql($dados['data_criacao']);

if($dados['data_necessidade']!=null){
$dados['data_necessidade'] = $objDateFormat->date_mysql($dados['data_necessidade']);
}
else{
$dados['data_necessidade'] = date('Y-m-d');

}

$dados['tipo_entrada'] = SOL_IMPORT;

$solicitacaoBusiness = $this->Factory->createBusiness("comp_solicitacao");
$id_solicitacao = $solicitacaoBusiness->cadastrar($dados);

//FINAL INCLSUÃO DOS DADOS



foreach ($arr_data as $dados) {
    
    $codigo_material = $dados['A'];
    $qtd = $dados['B'];
    $codigo_obra = $dados['C'];
    $codigo_centro_custo = $dados['D'];

   

     if($codigo_material==""){
       echo "<script>alert('Possui campos de Cod. de Produtos em branco, favor analisar!')</script>";
          echo "<script>window.history.back();</script>";
          exit;
    }

    else if($qtd==""){
       echo "<script>alert('Possui campos Qtd em branco, favor analisar!')</script>";
          echo "<script>window.history.back();</script>";
          exit;
    }

     else if($codigo_obra==""){
       echo "<script>alert('Possui campos de Cod Obra em branco, favor analisar!')</script>";
          echo "<script>window.history.back();</script>";
          exit;
    }

     else if($codigo_centro_custo==""){
       echo "<script>alert('Possui campos de Cod. Centro de Custo em branco, favor analisar!')</script>";
          echo "<script>window.history.back();</script>";
          exit;
    }
   

    //echo $codigo_material." - ".$qtd." - ".$codigo_obra;
    //echo "<br>";

           $dadosItens['data_inclusao'] = date('Y-m-d');
           $dadosItens['id_obra'] = intval($codigo_obra);
           $dadosItens['qtd'] = intval($qtd);
           $dadosItens['id_produto'] = intval($codigo_material);
           $dadosItens['id_solicitacao'] = $id_solicitacao;

           //$dadosItens['id_custo'] = intval($codigo_centro_custo);

           //Verifica se possui obra referenciada
           $obraBusiness = $this->Factory->createBusiness("proj_obra");
           $objObra = $obraBusiness->visualizar($dadosItens['id_obra']);

            //Verifica se possui o devido codigo do material
            $produtosBusiness = $this->Factory->createBusiness("est_produtos");
            $objProduto = $produtosBusiness->visualizar($dadosItens['id_produto']);

            //Verifica se possui o devido codigo do material
            $custoBusiness = $this->Factory->createBusiness("fin_centro_custos");
            $objCusto = $custoBusiness->visualizar_por_codigo($codigo_centro_custo);
           
           
           if($objObra!=null && $objProduto!=null && $objCusto!=null ){
              
              $dadosItens['id_custo'] = $objCusto->getId_custo();

              $itensBusiness = $this->Factory->createBusiness("comp_itens");
              $id_item = $itensBusiness->cadastrar($dadosItens);
           
           }


}


         // print_r($arr_data);

          redirect('solicitacao/incluir_itens/'.$id_solicitacao);
  } //final controller



//CONFIRMAR SOLICITAÇÃO
    public function copiar(){
        $this->load->helper(array('form','url'));

          $dados = $this->input->post();
                   
               
           $id_solicitacao_pai = $dados['id_solicitacao'];

           $objDateFormat = $this->DateFormat;
           $dados['data_necessidade'] = $objDateFormat->date_mysql($dados['data_necessidade']);
           $dados['data_criacao'] = $objDateFormat->date_mysql($dados['data_criacao']);
           
           $dados['id_status'] = EM_ELABORACAO;
           $dados['tipo_entrada'] = SOL_MANUAL;

           //Busca os Dados da solicitacao
           $solicitacaoBusiness = $this->Factory->createBusiness("comp_solicitacao");
           $objSolicitacao = $solicitacaoBusiness->visualizar($id_solicitacao_pai);

           //Se existir solicitação
           if($objSolicitacao!=null){

            unset($dados['id_solicitacao']);
            $dados['id_solicitante'] = $this->session->userdata('id_colaborador');
            $id_solicitacao = $solicitacaoBusiness->cadastrar($dados);
              //Itens da solicitação
           $itensBusiness = $this->Factory->createBusiness("comp_itens");
           $listItens = $itensBusiness->filtro($id_solicitacao_pai);           

           foreach ($listItens as $objIten):
           
              $dadosItens['id_solicitacao'] = $id_solicitacao;
              $dadosItens['id_produto'] = $objIten->getId_produto();
              $dadosItens['qtd'] = $objIten->getQtd();
              $dadosItens['data_inclusao'] = date('Y-m-d');
              $dadosItens['deletado'] = 0;
              $itensBusiness = $this->Factory->createBusiness("comp_itens");
              $id_item = $itensBusiness->cadastrar($dadosItens);
           
           endforeach;  

           }

         
         $msg = true;
           
          
        redirect('solicitacao/filtro/');
           
               
    }




     //EXCLUSÃO
      public function excluir($id_solicitacao){
          $this->load->helper(array('form','url'));

          $solBusiness = $this->Factory->createBusiness("comp_solicitacao");
          $solBusiness->excluir($id_solicitacao);
          redirect("solicitacao/filtro");
      }

      public function excluir_item($id_item,$id_solicitacao){
          $this->load->helper(array('form','url'));

          $solBusiness = $this->Factory->createBusiness("comp_itens");
          $solBusiness->excluir($id_item);
          redirect("solicitacao/incluir_itens/".$id_solicitacao);
      }



      //imprimir pedido
      public function imprimir($id_solicitacao){

        error_reporting(E_ALL ^ E_DEPRECATED);
      
        try {
            
         $this->load->helper(array('form', 'url'));
         $this->load->library('mpdf'); //carrega a biblioteca mpdf que está em aplication/libraries/mpdf
        

          
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

        
         $content = $this->load->view('solicitacao/impressao', $info,TRUE);
        
       
         $this->mpdf->WriteHTML($content); // Converte os dados html para pdf
         $this->mpdf->Output(); //ger

        }

        catch (Exception $ex) {
            $this->loadError($ex);
        }


      }







} //final classs

?>
