<?php $objDateFormat = $this->DateFormat; ?>
<!DOCTYPE html>
<html lang="en">
  
 <head>
    <meta charset="utf-8">
    <title>FRENTE DE CAIXA</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    
  <!--  <link href="<?= base_url() ?>caixa/css/bootstrap.min.css" rel="stylesheet">
	<link rel="shortcut icon" href="<?= base_url(); ?>img/favicon.png" />
	<link href="<?= base_url() ?>caixa/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>caixa/css/bootstrap-responsive.min.css" rel="stylesheet">

	<script src="<?= base_url() ?>caixa/js/bootstrap.js"></script>-->

  <!--<script src="<?= base_url() ?>caixa/js/jquery-1.7.2.min.js"></script>-->
  <!-- Latest compiled and minified JavaScript -->
  
  <!-- LIB BOOTSTRAP -->

  <!-- FINAL LIB BOOSTRAP -->
   <link href="<?= base_url() ?>css/select/select2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url() ?>bootstrap/css/bootstrap.min.css">

  <link rel="stylesheet" href="<?= base_url() ?>bootstrap/css/bootstrap-theme.min.css">





  
  <link type="text/css" rel="stylesheet" href="<?= base_url() ?>css/jquery.ui.theme/redmond/style.css" /> 

<style type="text/css">
    .bs-example{
      margin: 20px;
    }
    @media screen and (min-width: 768px) {
        .modal-dialog {
          width: 700px; /* New width for default modal */
        }
        .modal-sm {
          width: 350px; /* New width for small modal */
        }
    }
    @media screen and (min-width: 992px) {
        .modal-lg {
          width: 950px; /* New width for large modal */
        }
    }
</style>

<script src="<?= base_url() ?>bootstrap/js/jquery.min.js"></script>  
<script src="<?= base_url() ?>bootstrap/js/bootstrap.min.js"></script>
  

  
<style type="text/css">




 
  table tbody, table thead
{
    display: block;
   
}

table tbody.itens 
{
   overflow: auto;
   height: 200px;
}

table {
    width:800px; /* can be dynamic */
}

/* TAMAMANHO DA COLUNA */
th,td
{
    width: 200px;
}
  
  




/*.old_ie_wrapper {

  height: @table_body_height;
  width: @table_width;
  overflow-x: hidden;
  overflow-y: auto;
  tbody { height: auto; }
}*/
  
</style>


</head>

<body>
	
<div class="container-fluid">


<!-- TOPO DADOS PEDIDO -->
<div class="panel panel-primary">

  <div class="panel-heading">

<?php 
  $partes = explode(' ', $objPedido->getCliente()->getNome_fantasia());
  $primeiroNome = array_shift($partes);
  $ultimoNome = array_pop($partes);
?>



    <strong>
    <span class="badge">
    <?php 
    if($objPedido->getOrcamento()!=SIM){
       echo "Nº OS: ".$objPedido->getCodigo();
      }
      
      else{
        echo "Nº ORC: ".$objPedido->getCodigo_orcamento();
      }

     ?>
      
    </span>
    </strong>


     <strong>Cliente: </strong><?php echo $primeiroNome." ".$ultimoNome; ;?> | <strong>Usuário:</strong> <?php echo $objPedido->getUsuario()->getLogin(); ?> | <strong>Data Emissão:</strong> <?php echo $objDateFormat->date_format($objPedido->getData_inicio()); ?> | <strong>Data de Entrega:</strong> <?php echo $objDateFormat->date_format($objPedido->getData_final()); ?> | <!--<strong>Status:</strong> <strong><?php echo $objPedido->printStatus(); ?></strong>-->

    <!-- SELECÇÃO DE STATUS -->
    <div class="btn-group">

  <button type="button" class="btn btn-sm btn-warning"><strong>
  
  <?php 

      if($objPedido->getObjStatus()!=null){
         echo strtoupper($objPedido->getObjStatus()->getStatus()); 
      }

  ?>
    
  </strong></button>
  <button type="button" class="btn btn-sm btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
  <span class="caret"></span>
  <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu" role="menu">
  <?php foreach($listStatus as $objStatus):  ?>
  <li><a href="<?php echo site_url('pedidos/alterar_status/'.$objPedido->getId_pedido().'/'.$objStatus->getId_status()); ?>"><i class="fa fa-check"></i> <strong><?php echo strtoupper($objStatus->getStatus()); ?></strong></a></li>
  <?php endforeach; ?>
  
  </ul>

</div>

    <!-- FINAL SELEÇÃO DE STATUS -->



   
    <!-- BOTÃO EDITAR DADOS DO PEDIDO -->
     <span><a href="#" id="modal_editar_dados" role="button" class="btn btn-sm btn-primary" data-toggle="modal"><strong><i class="glyphicon glyphicon-pencil" aria-hidden="true" title="Editar Dados"></i></strong></a></span>
   
    <!-- BOTÃO INCLUIR PRODUTO OU CLIENTE -->
    <?php if($objPedido->getFaturado()!=SIM){ ?>
    <span style="margin-left:0px">
    <button type="button" class="btn btn-sm btn-primary" id="modal_novo_cadastro"><strong><i class="glyphicon glyphicon-plus-sign" aria-hidden="true" title="Incluir Novo Produto ou Cliente"></i></strong></button> 
    </span>
    <?php } ?>

     <!-- BOTÃO PESQUISAR PRODUTO OU CLIENTE -->
    <span style="margin-left:0px">
    <!--<button type="button" class="btn btn-sm btn-primary"><strong><i class="glyphicon glyphicon-print" aria-hidden="true" title="Imprimir Pedido"></i></strong></button>--> 
      <a href="<?php echo site_url('pedidos/imprimir/'.$objPedido->getId_pedido()); ?>" target="_blank" class="btn btn-sm btn-primary"><strong><i class="glyphicon glyphicon-print" aria-hidden="true" title="Imprimir Pedido"></i></strong></a>

       <a href="#" id="fechar_janela" class="btn btn-sm btn-danger"><strong><i class="glyphicon glyphicon-remove" aria-hidden="true" title="Fechar Janela"></i> Janela</strong></a>

    
    </span>
    <?php if($objPedido->getTipo()==ORCAMENTO){ echo "<span style='font-size:11px;font-weight:800;'>Você está em cotação</span>"; } ?>

   

  </div>
  <!--<div class="panel-body"></div>-->
</div>
<!-- FINAL TOPO DADOS PEDIDO -->


<!-- SELECIONAR ITENS DO PEDIDO -->
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title"><strong><i class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></i> Incluir Item </strong></h3>
  </div>
  
  <div class="panel-body" style="background-color:#FFFAFA; ">
  
  
   <?php echo validation_errors(); ?>
  

   <?php echo form_open('pedidos/add_item/'.$objPedido->getId_pedido(),array("onsubmit"=>"return validate()","class"=>"form-horizontal","id"=>"formulario")); ?>
    <input type="hidden" name="id_pedido" id="id_pedido" value="<?php echo $objPedido->getId_pedido(); ?>" />


  <div style="padding-bottom:30px; ">
    
    <!--<div><strong>Buscar item por:</strong> </div>
    <label class="radio-inline">
    <input type="radio" name="tipo_item" id="selecao_codigo" value="1"> Código do Produto
    </label>
    <label class="radio-inline">
    <input type="radio" checked name="tipo_item" id="selecao_descricao" value="2"> Nome do Produto
    </label>-->
   
     <input type="hidden" name="tipo_item" id="selecao_descricao" value="2">

    
    </div>

<div class="row">
  
  <div class="col-xs-3" id="camada_codigo"  style="display:none;">
    <label>CÓDIGO</label>
    <input type="text" name="codigo" id="codigo_item" class="form-control" placeholder="Informar Código">
  </div>

  <div class="col-xs-3" id="camada_descricao" style="display:none;">
    <label>DESCRIÇÃO</label>
    <input type="text" id="descricao" name="descricao" disabled class="form-control">
  </div>

 
  <div class="col-xs-5" id="manual" style="display:none;">
    <label>DESCRIÇÃO</label>
    <input type="text" id="descricao_manual" name="produto_nome" class="form-control">
  </div>
  

   <div class="col-xs-4" id="camada_nome_produto">
    
    <label>PRODUTO</label><br />
    <select style="width:400px;" name="id_produto" id="id_produto" class="form-control select2_single" tabindex="1">
      <option value="">Selecione...</option>
      <?php foreach ($listProdutos as $objProduto): ?>
      
      <?php if($objProduto['saldo']>0 || $objProduto['tipo']==SERVICO){ ?>
      <option value="<?php echo $objProduto['id_produto']; ?>" <?php echo set_select('id_produto'); ?>>
        <?php echo $objProduto['codigo']." ".$objProduto['produto']." R$: ". number_format($objProduto['valor_venda'], 2, ',', '.')." - ".$objProduto['saldo']." ".$objProduto['unidade']; ?>
      </option>
      
      <?php } else{  ?>
       <option disabled value="<?php echo $objProduto['id_produto']; ?>" <?php echo set_select('id_produto'); ?>>
        <?php echo $objProduto['codigo']." ".$objProduto['produto']." R$: ". number_format($objProduto['valor_venda'], 2, ',', '.'); ?> (Indisponível)
      </option>
      <?php } ?>



              <?php endforeach; ?>
    
    </select>
    
  </div>
  
  
   <div class="col-xs-2">
  <label>PREÇO</label>
    <input type="text" tipo="moneyReal" id="preco_item" name="valor_unitario" class="form-control">
  </div>

  <div class="col-xs-1">
  <label>QTD</label>
    <!-- tipo="moneyReal" -->
    <input type="text" name="qtd" onkeypress='return SomenteNumero(event)' class="form-control">
  </div>

 

   <div class="col-xs-2" style="margin-top:25px;" >
   <?php if($objPedido->getFaturado()!=SIM){ ?>
   <button type="submit" class="btn btn-primary"><strong><i class="glyphicon glyphicon-plus-sign" aria-hidden="true"></i> Incluir</strong></button>
  <?php } 
      
       else{

        if($objPedido->getObjStatus()!=null){
         echo "<strong>Pedido Faturado - ".$objPedido->getObjStatus()->getStatus()."</strong>";
        }
         //echo $objPedido->printStatus();
       }

    ?>
  </div>


  </form>

</div>
<!-- FINAL SELECIONAR ITENS DO PEDIDO -->


<!-- LISTA DE ITENS DO PEDIDO -->
<div style="margin-top:10px;">
  <table class="table fixed_headers" width="100%" style="font-size:12px;font-weight:500;">
  <thead>
  <tr>
  <th>CÓDIGO</th>
  <th>DESCRIÇÃO</th>
  <th>PREÇO</th>
  <th>QTD</th>
  <th>SUB-TOTAL</th>
   <th>AÇÕES</th>
  </tr>
  </thead>

  <tbody class="itens">
      
      <?php 
         $sub_total = 0;
         $total = 0;
         foreach($listItens as $objItem): 
            $sub_total = $objItem->getValor_unitario() * $objItem->getQtd();
            $total = $total + $sub_total; ?>
                  
                  <tr>           
                <td>
                <?php 
                
                if($objItem->getProduto()!=null){
                 echo $objItem->getProduto()->getCodigo();
                } else{
                  echo " - ";

                 
                } ?>
                </td>
                
                <td><?php echo $objItem->getProduto_nome(); ?></td>
                <td><?php echo number_format($objItem->getValor_unitario(), 2, ',', '.'); ?></td>
               
                 <td>

                <?php 
                if($objItem->getProduto()!=null){
                 echo round($objItem->getQtd(),0); 
                }else{
                   echo round($objItem->getQtd(),0);
                }
                ?>
                </td>

                <td>R$: <?php echo number_format($sub_total, 2, ',', '.'); ?></td>
                <td>
                 <?php if($objPedido->getFaturado()!=SIM){ ?>
               
                   <a href="#myModalItens" class="open-AddBookDialog btn btn-sm btn-primary" data-toggle="modal" data-id="<?php echo $objItem->getId_item(); ?>">
                  <strong><i class="glyphicon glyphicon-pencil"  title="Editar Itens"></i></strong></a>

                 <a href="#" class="confirm-delete btn btn-danger btn-sm" data-id="<?php echo $objItem->getId_item(); ?>"><i class="glyphicon glyphicon-trash"> </i></a>


                 <?php } ?>
                </td>

            </tr>
        
        
        <?php endforeach; ?>
        
                    

                  </tbody>

  <tfoot>
    <th colspan="6" style="text-align:right;">
    <div>
    
    <?php

       $total_geral = ( $objPedido->getTotal_Itens() + $objPedido->getTaxa_frete() ) - $objPedido->getDesconto();
       //$total_geral = number_format($total_geral, 2, ',', '.');

      $total_itens = number_format($objPedido->getTotal_Itens(), 2, ',', '.');

       ?> 

    <input type="hidden" value="<?php echo $total_itens; ?>" class="total_pagar" />
   
    <?php if($objPedido->getFaturado()!=SIM){ ?>
    <button type="button" class="btn btn-sm btn-success"><strong style="font-size:18px;">TOTAL R$ <span style="font-size:18px;" class="total_pedido_adicional"></span></strong></button> 
    <?php } else { ?>

     <button type="button" class="btn btn-sm btn-success"><strong style="font-size:18px;">TOTAL R$ <?php echo number_format($total_geral, 2, ',', '.'); ?> </strong></button> 


    <?php } ?>

   
   </div>
    </th>
  </tfoot>

</table>

  
  </div>
  <!-- FINAL DA LISTA DE ITENS DO PEDIDO -->

</div> <!-- CONTAINER ITENS INCLUIR -->


</div> <!-- CONTAINER PRINCIPAL DO ITENS -->



<div class="container-fluid footer navbar-fixed-bottom" style="height:100px; ">
  <div class="panel panel-success">
    <div class="panel-body">
      <div class="row">
        <div class="col-xs-2">
          <label>DESCONTO(R$)</label>
          <input type="text" tipo="moneyReal" class="form-control" id="desconto" tipo="moneyReal" value="<?php echo set_value('desconto',number_format($objPedido->getDesconto(), 2, ',', ''))?>" >
        </div>
        <div class="col-xs-2">
          <label>ACRÉSCIMO(R$)</label>
          <input type="text" tipo="moneyReal" id="taxa_frete" class="form-control" tipo="moneyReal" value="<?php echo set_value('taxa_frete',number_format($objPedido->getTaxa_frete(), 2, ',', ''))?>">
        </div>
        
        <div class="col-xs-2">
        <label>VALOR PAGO(R$)</label>
          <input type="text" tipo="moneyReal" id="valor_pago" class="form-control" value="<?php echo set_value('taxa_frete',number_format($objPedido->getValor_pago(), 2, ',', ''))?>">
        </div>

        <div class="col-xs-2">
        <label>TROCO(R$)</label>
          <input type="text" tipo="moneyReal" id="troco" readonly class="form-control">
        </div>

       <?php if($objPedido->getFaturado()!=SIM && $objPedido->getTipo()==PEDIDO){ ?>
       <div class="col-xs-4">
        <label>FORMA DE PAGAMENTO</label><br />
        <a href="#" <?php if(count($listItens)==0) {echo "disabled"; } ?> id="modal_forma_dinheiro" class="btn btn-primary"><strong><i class="glyphicon glyphicon-usd" aria-hidden="true"></i> DINHEIRO</strong></a>
       <a href="#" <?php if(count($listItens)==0) {echo "disabled"; } ?> id="modal_forma_mult" class="btn btn-primary" data-target=".bs-example-modal-lg"><strong><i class="glyphicon glyphicon-credit-card" aria-hidden="true" data-number="1"></i> OUTRAS FORMAS</strong></a>
      </div>
       <?php } ?>

       <!-- BOTÃO DE CONTAÇÃO -->
       <?php if($objPedido->getTipo()==ORCAMENTO){ ?>
       <div class="col-xs-2">
         <label></label><br />
        <a href="#" <?php if(count($listItens)==0) {echo "disabled"; } ?> id="modal_cotacao" class="btn btn-primary"><strong><i class="glyphicon glyphicon-ok" aria-hidden="true"></i> SALVAR COTAÇÃO</strong></a>
        </div>

        <div class="col-xs-1">
         <label></label><br />
        <a href="#" <?php if(count($listItens)==0) {echo "disabled"; } ?> id="modal_cotacao_venda" class="btn btn-primary"><strong><i class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></i> GERAR VENDA</strong></a>
        </div>

        <?php } ?>

      

       <!-- FINAL BOTÃO COTAÇÃO -->

 
    </div>
  </div>

</div> <!-- CONTAINER ITENS INCLUIR -->


</div>


</div>


 <!-- MODAL EXCLUSÃO DE ITENS -->
 <div id="myModalDelete" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            

    <div class="modal-body">
        
        <h3 style="color:red;">Deseja realmente excluir o item ?</h3>
    </div>
    <div class="modal-footer">
      <a href="#" id="btnYes" class="btn btn-danger"><i class="icon-remove icon-white"></i> Confirmar exclusão</a>
      <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-info">Cancelar</a>
    </div>
  </div>
</div>
</div>
   <!-- /widget-content -->


<!-- FINAL MODAL EXCLUSÃO DE ITENS -->


<!-- Modal Editar Dados Pedido -->
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Editar Dados Pedido</h4>
            </div>
            
            <div class="modal-body">
             <form action="" method="post" id="ajax_edit_pedido">
              <input type="hidden" name="id_pedido" value="<?php echo $objPedido->getId_pedido(); ?>">


            <div class="form-group">
            <label for="recipient-name" class="control-label">Cliente:</label><br />
            <select class="form-control select2_single" name="id_cliente" id="id_cliente" style="width:100%; ">
            <option value="<?php echo PAD_CAD_CLIENTE; ?>">SEM CADASTRO</option>
              <?php foreach ($listCliente as $objCliente): 
                   $cliente = $objCliente->getId_cliente();
              ?>
      <option value="<?php echo $objCliente->getId_cliente(); ?>" <?php echo set_select('id_cliente',$cliente,$objPedido->clienteIs($cliente)); ?>>
                    <?php echo $objCliente->getNome_fantasia(); ?>
                  </option>
              <?php endforeach; ?>
          </select>
          </div>

          <div class="form-group">
            <label for="recipient-name" class="control-label">Usuário:</label>
           <select name="id_usuario" id="id_usuario" class="form-control">
              <?php foreach ($listUser as $objUser): 
                  $user = $objUser->getId_usuario();
              ?>
  <option value="<?php echo $objUser->getId_usuario(); ?>" <?php echo set_select('id_usuario',$user,$objPedido->usuarioIs($user)); ?>>
                    <?php echo $objUser->getLogin(); ?>
                  </option>
              <?php endforeach; ?>
          </select>
              
          
          </div>

          <div class="form-group">
            <label for="recipient-name" class="control-label">Data Emissão:</label>
             <input type="text" name="data_inicio" class="form-control calendario" value="<?php echo $objDateFormat->date_format($objPedido->getData_inicio()); ?>">
          </div>

           <div class="form-group">
            <label for="recipient-name" class="control-label">Data Entrega:</label>
             <input type="text" name="data_final" class="form-control calendario" value="<?php echo $objDateFormat->date_format($objPedido->getData_final()); ?>">
          </div>

           <div class="form-group">
            <label for="recipient-name" class="control-label">Hora Retirada:</label>
             <input type="text" name="hora_retirada" class="form-control hora" value="<?php echo $objPedido->getHora_retirada(); ?>">
          </div>

           <!-- <div class="form-group">
            <label for="recipient-name" class="control-label">Status:</label>
            <select name="status" id="status" class="form-control">
                   <?php $status = $objPedido->getStatus();?>
                          <option value="<?= $objPedido->getStatus(); ?>" <?= set_select('status',$status,$objPedido->statusIs($status)); ?>>
                           <?= $objPedido->printStatus(); ?>
                  <option value="<?= ANDAMENTO; ?>" <?= set_select('status',ANDAMENTO); ?>>ANDAMENTO</option>
                  
                </select>
              <option></option>
              
            </select>
          </div> -->

           <div class="form-group">
            <label for="recipient-name" class="control-label">Anotações:</label>
             <textarea class="form-control" name="observacao"><?php echo $objPedido->getObservacao(); ?></textarea>
          </div>
            
               
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i> Fechar Janela </button>
                <button type="button" class="btn btn-primary" id="edit_pedido_btn"><i class="glyphicon glyphicon-ok" aria-hidden="true"></i> Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Final modal edit dados -->



<!-- Modal Novo Cadastro -->
<div id="myModalNovoCadastro" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Novo Cadastro</h4>
            </div>
            
            <div class="modal-body">
            
            <div class="form-group">
            <label for="recipient-name" class="control-label"></label>
              <label>PRODUTO 
                      <input type="radio" name="tipo_cadastro" id="tipo_produto"  value="1" checked="" required /> </label>
              <label for="recipient-name" class="control-label"></label>
              <label>CLIENTE
                      <input type="radio" name="tipo_cadastro" id="tipo_cliente"  value="2" checked="" required /> </label>
            </div>


            <!-- NOVO CLIENTE -->
            <div id="camada_novo_cliente">
               <form action="" method="post" id="ajax_novo_cliente">
                 <input type="hidden" name="id_pedido" value="<?php echo $objPedido->getId_pedido(); ?>">

                <div class="form-group">
                <label for="recipient-name" class="control-label">Nome do Cliente:</label>
                 <input type="text" name="nome_fantasia" id="nome_fantasia" class="form-control">
                </div>

                <div class="form-group">
                <label for="recipient-name" class="control-label">Telefone:</label>
                 <input type="text" name="telefone1" class="form-control telefone">
                </div>

                <div class="form-group">
                <label for="recipient-name" class="control-label">CPF OU CNPJ:</label>
                 <input type="text" name="cnpj_cpf" id="cpfcnpj" class="form-control">
                </div>

                 <div class="form-group">
                <label for="recipient-name" class="control-label">Tipo:</label>
               <select class="form-control" name="tipo">
                    <option value="<?php echo PESSOA_FISICA; ?>">PESSOA FISICA</option>
                    <option value="<?php echo PESSOA_JURIDICA; ?>">PESSOA JURIDICA</option>
                        
                    </select>                
                </div>

                 <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i> Fechar Janela </button>
                <button type="button" class="btn btn-primary" id="add_novo_cliente_btn"><i class="glyphicon glyphicon-ok" aria-hidden="true"></i> Salvar</button>
                </form>
            </div>

            </div>
            <!-- FINAL NOVO CLIENTE -->

             <!-- NOVO PRODUTO-->
            <div id="camada_novo_produto" style="display: none;">
               <form action="" method="post" id="ajax_novo_produto">
                 <input type="hidden" name="id_pedido" value="<?php echo $objPedido->getId_pedido(); ?>">

                <div class="form-group">
                <label for="recipient-name" class="control-label">Nome do Produto:</label>
                 <input type="text" name="descricao" id="nome_produto" class="form-control">
                </div>

                 <div class="form-group">
                <label for="recipient-name" class="control-label">Código:</label>
                 <input type="text" name="codigo" class="form-control">
                </div>

                 <div class="form-group">
                <label for="recipient-name" class="control-label">Preço de Venda:</label>
                 <input type="text" name="valor_venda" tipo="moneyReal" class="form-control">
                </div>

                <div class="form-group">
                <label for="recipient-name" class="control-label">Categoria:</label>
                <select class="form-control" name="id_categoria">
                      
                        <?php foreach ($listCategoria as $objCategoria): ?>
                        <option value="<?php echo $objCategoria->getId_categoria(); ?>" <?php echo set_select('id_categoria',$objCategoria->getId_categoria()); ?>>
                           <?php echo $objCategoria->getCategoria(); ?>
                        </option>
                         <?php endforeach; ?>
                    </select>
                </div>

                 <div class="form-group">
                <label for="recipient-name" class="control-label">Unidade de Medida:</label>
                <select class="form-control" name="id_unidade">
                      
                        <?php foreach ($listUnidade as $objUnidade): ?>
                        <option value="<?php echo $objUnidade->getId_unidade(); ?>" <?php echo set_select('id_unidade',$objUnidade->getId_unidade()); ?>>
                           <?php echo $objUnidade->getUnidade(); ?>
                        </option>
                         <?php endforeach; ?>
                    </select>
                </div>
                


                <div class="form-group">
                <label for="recipient-name" class="control-label">Tipo:</label>
               <select class="form-control" name="tipo">
                    <option value="<?php echo PRODUTO; ?>">PRODUTO</option>
                    <option value="<?php echo SERVICO; ?>">SERVIÇO</option>
                        
                    </select>                
                </div>

                 <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i> Fechar Janela </button>
                <button type="button" class="btn btn-primary" id="add_novo_produto_btn"><i class="glyphicon glyphicon-ok" aria-hidden="true"></i> Salvar</button>
                </form>
            </div>



                
            </div>
            <!-- FINAL NOVO CLIENTE -->


            
               
            </div>

           

        </div>
    </div>
</div>
<!-- Final modal edit dados -->


<!-- EDITAR ITENS DO PEDIDO -->
<div id="myModalItens" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Editar Itens Pedido</h4>
            </div>
            
            <div class="modal-body">
             <form action="" method="post" id="ajax_edit_itens">
              <input type="hidden" name="id_item" id="edit_id_item">
              <input type="hidden" name="id_pedido" id="edit_id_pedido" value="<?php echo $objPedido->getId_pedido(); ?>">

            

          <div class="form-group">
            <label for="recipient-name" class="control-label">Produto:</label>
    <div class="id_100">
    <select style="width:350px;" name="edit_id_produto" id="edit_id_produto" class="form-control select2_single" tabindex="1">
      <option value="">Selecione...</option>
      <?php foreach ($listProdutos as $objProduto): ?>
      
      <!--<option value="<?php echo $objProduto['id_produto']; ?>">
        <?php echo $objProduto['codigo']." ".$objProduto['produto']." R$: ".$objProduto['valor_venda']; ?>
      </option>-->

      <?php if($objProduto['saldo']>0 || $objProduto['tipo']==SERVICO){ ?>
      <option value="<?php echo $objProduto['id_produto']; ?>" <?php echo set_select('id_produto'); ?>>
        <?php echo $objProduto['codigo']." ".$objProduto['produto']." R$: ". number_format($objProduto['valor_venda'], 2, ',', '.')." - ".$objProduto['saldo']." ".$objProduto['unidade']; ?>
      </option>
      
      <?php } else{  ?>
       <option disabled value="<?php echo $objProduto['id_produto']; ?>" <?php echo set_select('id_produto'); ?>>
        <?php echo $objProduto['codigo']." ".$objProduto['produto']." R$: ". number_format($objProduto['valor_venda'], 2, ',', '.'); ?> (Indisponível)
      </option>
      <?php } ?>


              <?php endforeach; ?>
    </select>
    </div>
    
  </div>

          <div class="form-group">
            <label for="recipient-name" class="control-label">Preço:</label>
             <input type="text" name="edit_preco" id="edit_preco" tipo="moneyReal" class="form-control">
          </div>

           <div class="form-group">
            <label for="recipient-name" class="control-label">Qtd:</label>
             <input type="text" name="edit_qtd" id="edit_qtd" onkeypress='return SomenteNumero(event)'name="parcela_qtd" class="form-control">
          </div>

           <div class="form-group">
            <label for="recipient-name" class="control-label">Observação:</label>
             <input type="text" name="edit_descricao" id="edit_descricao" class="form-control" style="font-size:12px;">
          </div>
 
         

           

               
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i> Fechar Janela </button>
                <button type="button" class="btn btn-primary" id="edit_itens_btn"><i class="glyphicon glyphicon-ok" aria-hidden="true"></i> Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Final modal edit dados -->



<!-- FINAL EDITAR DADOS DO PEDIDO -->

 




<!-- Modal Confirmar Pagamento Dinheiro -->
<div id="form-content-dinheiro" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Confirmar Pagamento Dinheiro</h4>
            </div>
            
            <div class="modal-body">
             <form action="" method="post" id="ajax_forma_dinheiro">
              
               <input type="hidden" name="id_cliente" value="<?php echo $objPedido->getId_cliente(); ?>">
              <input type="hidden" name="id_pedido" value="<?php echo $objPedido->getId_pedido(); ?>">
              <input type="hidden"  name="total_pedido" value="<?php echo $total_itens; ?>">
               <input type="hidden"  name="total_pagar" class="total_pag_dinheiro">

               <input type="hidden" name="escopo" id="escopo" value="<?php echo $objPedido->getEscopo(); ?>">
              
              <input type="hidden" name="descontoFlag" class="desconto_flag">
               <input type="hidden" name="desconto_perc" class="desconto_perc">
              <input type="hidden" name="taxa_freteFlag" class="taxa_flag">
             


            
          
          <div class="form-group" style="text-align:right;">
            <!--<label for="recipient-name" class="control-label">Valor Pagar:</label> -->
             <strong><span style="font-size:24px;font-weight:900;" class="btn btn-success">R$ </span><span style="font-size:24px;font-weight:900;" class="btn btn-success total_pedido_adicional"></span></strong>
          </div>

            
               
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i> Fechar Janela </button>
                <?php if($objPedido->getFaturado()!=SIM){ ?>
                <button type="submit" id="add_forma_dinheiro_btn" class="btn btn-primary" id="edit_pedido_btn"><i class="glyphicon glyphicon-ok" aria-hidden="true"></i> Confirmar Pagamento</button>
                <?php } ?>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- Final modal DINHEIRO -->



<!-- Modal Salvar Cotação -->
<div id="form-content-cotacao" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Salvar Cotaçao</h4>
            </div>
            
            <div class="modal-body">
             <form action="" method="post" id="ajax_forma_cotacao">
              
               <input type="hidden" name="id_cliente" value="<?php echo $objPedido->getId_cliente(); ?>">
              <input type="hidden" name="id_pedido" value="<?php echo $objPedido->getId_pedido(); ?>">
              <input type="hidden"  name="total_pedido" value="<?php echo $total_itens; ?>">
               <input type="hidden"  name="total_pagar" class="total_pag_dinheiro">

               <input type="hidden" name="escopo" id="escopo" value="<?php echo $objPedido->getEscopo(); ?>">
              
              <input type="hidden" name="descontoFlag" class="desconto_flag">
               <input type="hidden" name="desconto_perc" class="desconto_perc">
              <input type="hidden" name="taxa_freteFlag" class="taxa_flag">
             


            
          
          <div class="form-group" style="text-align:right;">
            <!--<label for="recipient-name" class="control-label">Valor Pagar:</label> -->
             <strong><span style="font-size:24px;font-weight:900;" class="btn btn-success">R$ </span><span style="font-size:24px;font-weight:900;" class="btn btn-success total_pedido_adicional"></span></strong>
          </div>

            
               
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i> Fechar Janela </button>
                <?php if($objPedido->getFaturado()!=SIM){ ?>
                <button type="submit" id="add_cotacao_btn" class="btn btn-primary"><i class="glyphicon glyphicon-ok" aria-hidden="true"></i> Confirmar Cotação</button>
                <?php } ?>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- Final modal Salvar Cotação -->


<!-- Modal Salvar Cotação -->
<div id="form-content-cotacao-venda" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Tranformar Cotação em Venda</h4>
            </div>
            
            <div class="modal-body">
             <form action="" method="post" id="ajax_forma_cotacao_venda">
              
               <input type="hidden" name="id_cliente" value="<?php echo $objPedido->getId_cliente(); ?>">
              <input type="hidden" name="id_pedido" value="<?php echo $objPedido->getId_pedido(); ?>">
              <input type="hidden"  name="total_pedido" value="<?php echo $total_itens; ?>">
               <input type="hidden"  name="total_pagar" class="total_pag_dinheiro">

               <input type="hidden" name="escopo" id="escopo" value="<?php echo $objPedido->getEscopo(); ?>">
              
              <input type="hidden" name="descontoFlag" class="desconto_flag">
              <input type="hidden" name="desconto_perc" class="desconto_perc">
              <input type="hidden" name="taxa_freteFlag" class="taxa_flag">
             


            
          
          <div class="form-group" style="text-align:right;">
            <!--<label for="recipient-name" class="control-label">Valor Pagar:</label> -->
             <strong><span style="font-size:24px;font-weight:900;" class="btn btn-success">R$ </span><span style="font-size:24px;font-weight:900;" class="btn btn-success total_pedido_adicional"></span></strong>
          </div>

            
               
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i> Fechar Janela </button>
                <?php if($objPedido->getFaturado()!=SIM){ ?>
                <button type="submit" id="add_cotacao_venda_btn" class="btn btn-primary"><i class="glyphicon glyphicon-ok" aria-hidden="true"></i>Gerar Venda</button>
                <?php } ?>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- Final modal DINHEIRO -->









<!-- INICIO MODAL PAGAMENTO MULTIPLO -->
<div id="form-content-mult" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Confirmar Pagamento</h4>
            </div>
            
            <div class="modal-body">
            
               <form action="" method="post" id="ajax_forma_pagamento">
                  <input type="hidden" name="id_pedido" value="<?php echo $objPedido->getId_pedido(); ?>">
                  <!--<input type="hidden" name="valor_pedido" id="valorFlag" class="total_topo">-->
                  <input type="hidden" name="id_cliente" value="<?php echo $objPedido->getId_cliente(); ?>">

                  <input type="hidden"  name="total_pedido" value="<?php echo $total_itens; ?>">
                  <input type="hidden"  name="total_pagar" class="total_pag_dinheiro">
                  <input type="hidden" name="descontoFlag" class="desconto_flag">
                  <input type="hidden" name="taxa_freteFlag" class="taxa_flag">
                  <input type="hidden" name="desconto_perc" class="desconto_perc">
                   
                  <!--<input type="hidden" name="descontoFlag" id="descontoFlag">
                  <input type="hidden" name="taxa_freteFlag" id="taxa_freteFlag">-->

                  <div class="row">
                  
                  <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                   <strong><span class="btn btn-primary botao_total_pedido" style="font-size:18px"></span></strong>
                  </div>
                  
                  <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                   <strong><span class="btn btn-success botao_total_pago" style="font-size:18px"></span></strong></div>

                    <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                    <strong><span class="btn btn-warning botao_total_saldo" style="font-size:18px"></span></strong>
                    </div>
                
                </div>

                 
                 <div class="row">
                  
                  <div class="form-group">
                 
                 <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                    <label>Forma de Recebimento</label>
                     <select name="id_forma" id="id_forma" class="form-control">
                      <option value="">Selecione...</option>
                     </select>
                  
                  </div>
                  
                  <div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback" id="camada_qtd_parcela">
                    <label>Parcela</label>
                     <select name="qtd_parcela_pag" class="form-control span1" id="qtd_parcela_select">
                <option value="">Nenhuma</option>
                </select>
                  
                  </div>

                  <div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
                    <label>Valor Pago</label>
                      <input type="text" name="valor_pago_forma" tipo="moneyReal" class="form-control" id="valor_pago_forma" value="<?php echo set_value('taxa_frete','0,00')?>">
                  
                  </div>

                   <div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback" id="camada_data_vencimento">
                    <label>Data Vencimento</label>
                     <input type="text" name="data_vencimento"  class="form-control calendario" id="data_vencimento" value="<?php echo set_value('data_vencimento','')?>">
                  
                  </div>

                   <?php if($objPedido->getFaturado()!=SIM){ ?>
                   <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback" style="margin-top:20px;">
                    <label>&nbsp</label>
                  <button type="submit" id="add_forma_btn" class="btn btn-success">
                  <strong><i class="glyphicon glyphicon-plus-sign"></i> </strong>
                  </button> 
                  </div> 
                  <?php } ?>    

                  </form>   



                  </div>


                 </div>

                 <div class="row">

                   <table class="table table-striped" id="tabela_forma_pagamento" width="100%">
                <thead>
                  <tr>
                    <th>FORMA</th>
                    <th>VALOR PAGO</th>
                    <th>QTD PARCELA</th>
                    <th class="td-actions">REMOVER</th>
                  </tr>
                </thead>
                <tbody>
                
                </tbody>
              
              </table>
                 </div>

                 <div class="row">

                 <form action="" method="post" id="ajax_forma_multipla">
                  <input type="hidden" name="escopo" id="escopo" value="<?php echo $objPedido->getEscopo(); ?>">
                  <input type="hidden" name="id_pedido" value="<?php echo $objPedido->getId_pedido(); ?>">
                  <input type="hidden" name="valor_pedido" id="valorFlag" class="total_pag_dinheiro">
                  <input type="hidden" name="id_pedido" value="<?php echo $objPedido->getId_pedido(); ?>">
                  <input type="hidden" name="total_pago_forma" id="total_pago_forma">
                  <input type="hidden" name="id_cliente" value="<?php echo $objPedido->getId_cliente(); ?>">

                   <input type="hidden" name="descontoFlag" class="desconto_flag">
                  <input type="hidden" name="taxa_freteFlag" class="taxa_flag">
                  <input type="hidden" name="desconto_perc" class="desconto_perc">

                   
<?php if($objPedido->getFaturado()!=SIM){ ?>
                   <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" id="camada_confirmar" style="display:none;">
                     <button type="submit" id="add_forma_mult_btn" class="btn btn-success">
            <strong><i class="icon-ok-sign icon-white"></i> CONFIRMAR PAGAMENTO</strong>
            </button>       

                   </div>

                   <?php } ?>
 



                 </form>

                 </div>



                <!--<fieldset class="grupo">

                  <div class="campo">
                  <strong><span class="btn btn-primary botao_total_pedido" style="font-size:18px"></span></strong>
                  </div>

                  <div class="campo">
                  <strong><span class="btn btn-success botao_total_pago" style="font-size:18px"></span></strong>
                  </div>

                  <div class="campo">
                  <strong><span class="btn btn-warning botao_total_saldo" style="font-size:18px"></span></strong>
                  </div>

                </fieldset>-->

                 
                
               </form>
            
            </div>

          </div>

</div>

</div>
<!-- FINAL MODAL FORMA DE PAGAMENTO MULTIPLA -->



 <!-- MODAL SUCESSO VENDA -->
 
 <div id="myModalSucesso" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Confirmação Pagamento...</h4>
            </div>
            
            <div class="modal-body">
              <button type="submit" class="btn btn-default" name="btn-login" id="btn-carregar">
              <h3 style="color:green;">Venda Realizada com Sucesso ?</h3>

            </div>
          </div>
        </div>
    </div>




    <!--MODAL AUTORIZAÇÃO 50% VENDA -->


<!-- Start Calendar modal -->
      <div id="modal_cancelar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-trash"></i> Autorizar Venda</h4>
            </div>
            <div class="modal-body">
              <div id="testmodal">
              
                 <form class="contact" action="" id="ajax_confirmar_senha" >
                  
   
               
                  <div class="form-group">
                      <label>Senha Administrador</label>
                      
                      <input type="password" class="form-control" name="senha" id="senha" value="<?php echo set_value('senha')?>"/>
                   
                  </div>

                                                  

                
              </div>
            </div>
            
            <!--<div class="modal-footer">
             <a href="#" data-dismiss="modal" aria-hidden="true" class="btn">Fechar Janela</a>
              <button type="submit" class="btn btn-success"><i class="fa fa-trash"></i> Confirmar</button>
              </form>
            </div>-->

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i> Fechar Janela </button>
                <button type="button" class="btn btn-primary" id="bt_confirmar_senha"><i class="glyphicon glyphicon-ok" aria-hidden="true"></i> Salvar</button>
                </form>
            </div>

          </div>
        </div>
      </div>
      </form>


      <!-- final modal pesquisa -->




</body>


</html>

<script type="text/javascript" src="<?php echo base_url(); ?>js/text_numero.js"></script>

<script src="<?= base_url() ?>caixa/js/base.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js/jquery-maskMoney.js"></script> <!--Jquery ... -->
<script type="text/javascript" src="<?= base_url() ?>js/jquery.magicforms-b1.0.js"></script> <!--Leonardo simas e Weslley leandro -->
<script type="text/javascript" src="<?= base_url() ?>js/select.maskgrupo.myconfig.js"></script>


<script type="text/javascript" src="<?= base_url() ?>js/jquery-ui-1.9.1.custom.min.js"></script> 
<script type="text/javascript" src="<?= base_url() ?>js/jquery.ui.datepicker-pt-BR.js"></script> <!--Jquery 


<!-- SCRIPT EFEITO AUTOCOMPLETE DROP DOWN -->
<!--<script src="<?= base_url() ?>js/pace/pace.min.js"></script>
   <script src="<?= base_url() ?>js/custom.js"></script>-->
    <script src="<?= base_url() ?>js/select/select2.full.js"></script>
   <script src="<?= base_url() ?>js/jquery_plugin_cpfcnpj.js"></script> 

   <script>
    $(document).ready(function() {

      //selecao de cadastro de produto e cliente

      $("#tipo_produto").click(function(){
         $("#camada_novo_cliente").hide();
         $("#camada_novo_produto").show();
       });

       $("#tipo_cliente").click(function(){
         $("#camada_novo_cliente").show();
         $("#camada_novo_produto").hide();
       });

      // final seleção de cadastro de produto e cliente

      //maskara cpf e cnpj
        $("#cpfcnpj").keydown(function(){
    try {
      $("#cpfcnpj").unmask();
    } catch (e) {}
    
    var tamanho = $("#cpfcnpj").val().length;
  
    if(tamanho < 11){
        $("#cpfcnpj").mask("999.999.999-99");
    } else if(tamanho >= 11){
        $("#cpfcnpj").mask("99.999.999/9999-99");
    }                   
});
      //final maskara

//maskara telefone

 $(".telefone").mask("(99)99999-9999");
 $(".hora").mask("99:99");

//final mask
         

           
      //$("#myModal").modal('show');

      $(".select2_single").select2({
        placeholder: "Selecione...",
        allowClear: false
      });
      $(".select2_group").select2({});
      $(".select2_multiple").select2({
        maximumSelectionLength: 4,
        placeholder: "With Max Selection limit 4",
        allowClear: true
      });
    });
  </script>



<script type="text/javascript">
      
$(function () {

 
    //$('#total_lado_item').text(total_pagar_pedido.toFixed(2).replace(".", ","));
    
    //PROCESSO DE CÁLCULO
    
    function moedaParaNumero(valor)
    {
      return isNaN(valor) == false ? parseFloat(valor) :   parseFloat(valor.replace("R$","").replace(".","").replace(",","."));
    }

    //total_pagar = soma dos itens do pedido
    var total_pagar = moedaParaNumero($('.total_pagar').val()); 
    var total_final = moedaParaNumero($('.total_pag_dinheiro').val()); 

   
    
    //TESTE VALOR COM DESCONTO E ACRESCIMO
       var desconto = moedaParaNumero($("#desconto").val());
       $('.desconto_perc').val(desconto);
      
       var frete_temp = moedaParaNumero($("#taxa_frete").val());
       var taxa_frete = (isNaN(frete_temp) ? 0 : moedaParaNumero($("#taxa_frete").val())); 
       
       //var percentual = (desconto / 100) * moedaParaNumero(total_pagar + taxa_frete);
       //var percentual = desconto;
       var valor_com_desconto = (total_pagar + taxa_frete) - moedaParaNumero(desconto);
      //  $('.desconto_flag').val(percentual.toFixed(2).replace(".", ","));
      
       $('.total_pedido_adicional').text(valor_com_desconto.toFixed(2).replace(".", ","));
       $('.taxa_flag').val(taxa_frete);

       $('.botao_total_pedido').text("TOTAL PEDIDO = R$: "+valor_com_desconto.toFixed(2).replace(".", ","));
      

      $('.total_pedido').text(total_pagar.toFixed(2).replace(".", ","));
      $('.total_pag_dinheiro').val(valor_com_desconto.toFixed(2).replace(".", ","));
    

    
    //
    
    
  
  //ATUALIZAR CAMPO DESCONTO AO SAIR 
  $("#desconto").focusout(function(){
      
   
       //e.preventDefault();
       var id_pedido = $("#id_pedido").val();
       var desconto = moedaParaNumero($("#desconto").val());
       $('.desconto_perc').val(desconto);
       var frete_temp = moedaParaNumero($("#taxa_frete").val());
       var taxa_frete = (isNaN(frete_temp) ? 0 : moedaParaNumero($("#taxa_frete").val())); 
       //var percentual = (desconto / 100) * moedaParaNumero(total_pagar + taxa_frete);
       var percentual = (desconto * 100) / moedaParaNumero(total_pagar);


       //var valor_com_desconto = (total_pagar + taxa_frete) - moedaParaNumero(percentual);
       var valor_com_desconto = (total_pagar + taxa_frete) - moedaParaNumero(percentual);
      
     $.ajax({
             type: 'POST',
             url: "<?php echo site_url('pedidos/ajax_alterar_desconto/'); ?>",         
             //data: $('#form_rodape').serialize(),
              data: jQuery.param({ id_pedido: id_pedido, desconto : desconto, frete:taxa_frete,valor_desconto:percentual,valor_total:valor_com_desconto }) ,
             //data: { id_pedido: '97', desconto : '12'} ,
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
             success : function(response){
               //alert(response.status);
                //alert($("#id_pedido").val());
                //alert("OI");
               },
        error: function (request, status, error) {
              alert('erro');
              //alert(request.responseText);
              //alert('VENDA NÃO REALIZADA!');
              //window.back();
         }
             
         });

         //return false;

     
     }); //FINAL FOCUS desconto


    //ATUALIZAR CAMPO FRETE AO SAIR 
  $("#taxa_frete").focusout(function(){

    //alert($("#id_pedido").val());
     //alert($("#desconto").val());
       //e.preventDefault();
       var id_pedido = $("#id_pedido").val();
       
       /*var desconto = moedaParaNumero($("#desconto").val());
       $('.desconto_perc').val(desconto);
       var frete_temp = moedaParaNumero($("#taxa_frete").val());
       var taxa_frete = (isNaN(frete_temp) ? 0 : moedaParaNumero($("#taxa_frete").val())); 
       var percentual = (desconto / 100) * moedaParaNumero(total_pagar + taxa_frete);
       var valor_com_desconto = (total_pagar + taxa_frete) - moedaParaNumero(percentual);
      */

       //novas var frete
       var desconto = (isNaN(moedaParaNumero($("#desconto").val())) ? 0 : moedaParaNumero($("#desconto").val())); //parseFloat($("#desconto").val());
       var frete_temp = moedaParaNumero($("#taxa_frete").val());
       var taxa_frete = (isNaN(frete_temp) ? 0 : moedaParaNumero($("#taxa_frete").val())); 
       //var percentual = (desconto / 100) * parseFloat(total_pagar + taxa_frete);
       var percentual = (desconto / 100) * moedaParaNumero(total_pagar + taxa_frete);
      
       var valor_com_frete = (total_pagar + taxa_frete) - desconto;
       
     $.ajax({
             type: 'POST',
             url: "<?php echo site_url('pedidos/ajax_alterar_frete/'); ?>",         
             //data: $('#form_rodape').serialize(),
              data: jQuery.param({ id_pedido: id_pedido, desconto : desconto, frete:taxa_frete,valor_desconto:percentual,valor_total:valor_com_frete }) ,
             //data: { id_pedido: '97', desconto : '12'} ,
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
             success : function(response){
               //alert(response.status);
                //alert($("#id_pedido").val());
                //alert("OI");
               },
        error: function (request, status, error) {
              alert('erro');
              //alert(request.responseText);
              //alert('VENDA NÃO REALIZADA!');
              //window.back();
         }
             
         });

         //return false;

     
     }); //FINAL FOCUS FRETE





    //DESCONTO
    
     $("#desconto").keyup(function(){
       
       var desconto = moedaParaNumero($("#desconto").val());
       $('.desconto_perc').val(desconto);
       var frete_temp = moedaParaNumero($("#taxa_frete").val());
       var taxa_frete = (isNaN(frete_temp) ? 0 : moedaParaNumero($("#taxa_frete").val())); 
       //var percentual = (desconto / 100) * moedaParaNumero(total_pagar + taxa_frete);
       var percentual = desconto;
       var valor_com_desconto = (total_pagar + taxa_frete) - moedaParaNumero(percentual);
       $('.desconto_flag').val(percentual.toFixed(2).replace(".", ","));
       $('.botao_total_pedido').text("TOTAL PEDIDO = R$: "+valor_com_desconto.toFixed(2).replace(".", ","));
       $('.botao_total_saldo').text("SALDO = R$: "+valor_com_desconto.toFixed(2).replace(".", ","));
       $('.total_pedido_adicional').text(valor_com_desconto.toFixed(2).replace(".", ","));
    
    
              
      
       
        $('.total_pedido').text(valor_com_desconto.toFixed(2).replace(".", ","));
        $('.total_pag_dinheiro').val(valor_com_desconto.toFixed(2).replace(".", ","));

       
      

     })


    //FINAL DESCONTO

    //OUTRAS DESPESAS
     $("#taxa_frete").keyup(function(){

       var desconto = (isNaN(moedaParaNumero($("#desconto").val())) ? 0 : moedaParaNumero($("#desconto").val())); //parseFloat($("#desconto").val());
       var frete_temp = moedaParaNumero($("#taxa_frete").val());
       var taxa_frete = (isNaN(frete_temp) ? 0 : moedaParaNumero($("#taxa_frete").val())); 
       //var percentual = (desconto / 100) * parseFloat(total_pagar + taxa_frete);
       var valor_com_frete = (total_pagar + taxa_frete) - desconto;
       $('.total_pedido').text(valor_com_frete.toFixed(2).replace(".", ","));
       $('.total_pag_dinheiro').val(valor_com_frete.toFixed(2).replace(".", ","));
       $('.taxa_flag').val(taxa_frete.toFixed(2).replace(".", ","));
       $('.botao_total_pedido').text("TOTAL PEDIDO = R$: "+valor_com_frete.toFixed(2).replace(".", ","));

       $('.botao_total_saldo').text("SALDO = R$: "+valor_com_frete.toFixed(2).replace(".", ","));

       $('.total_pedido_adicional').text(valor_com_frete.toFixed(2).replace(".", ","));
    
    

              
      })
    //FINAL OUTRAS DESPESAS

     //OUTRAS DESPESAS
     $("#valor_pago").keyup(function(){
       var desconto = (isNaN(moedaParaNumero($("#desconto").val())) ? 0 : moedaParaNumero($("#desconto").val())); //parseFloat($("#desconto").val());
       var frete_temp = moedaParaNumero($("#taxa_frete").val());
       var taxa_frete = (isNaN(frete_temp) ? 0 : moedaParaNumero($("#taxa_frete").val())); 
       //var percentual = (desconto / 100) * parseFloat(total_pagar + taxa_frete);
       var valor_com_frete = (total_pagar + taxa_frete) - desconto;
       var valor_pago =  (isNaN(moedaParaNumero($("#valor_pago").val())) ? 0 : moedaParaNumero($("#valor_pago").val()));
       var troco = valor_pago -  moedaParaNumero(valor_com_frete);
       
       if(troco>0){
        $("#troco").val(troco.toFixed(2).replace(".", ","));
       }else{
        $("#troco").val(0);
       }

       $('.total_pedido').text(valor_com_frete.toFixed(2).replace(".", ","));

       $('.botao_total_pedido').text("TOTAL PEDIDO = R$: "+valor_com_frete.toFixed(2).replace(".", ","));
        $('.botao_total_saldo').text("SALDO = R$: "+valor_com_frete.toFixed(2).replace(".", ","));
    
    
              
      
      })
    //FINAL OUTRAS DESPESAS
    
    
    





    // FINAL PROCESSO DE CÁLCULO
    
   
    //Calendário
    $(".calendario").datepicker();

    //modal novo cadastro de produto e cliente
    $("#modal_novo_cadastro").click(function(){
       //e.preventDefault();
             
        $("#myModalNovoCadastro").modal('show');
    });

    //Modal Editar dados
    $("#modal_editar_dados").click(function(){
       //e.preventDefault();
             
        $("#myModal").modal('show');
    });

    //Modal Forma Dinheiro
    $("#modal_forma_dinheiro").click(function(){
       //e.preventDefault();
             
        $("#form-content-dinheiro").modal('show');

    });

     //Modal Forma Dinheiro
    $("#modal_cotacao").click(function(){
       //e.preventDefault();
            
        $("#form-content-cotacao").modal('show');

    });

    $("#modal_cotacao_venda").click(function(){
       //e.preventDefault();
            
        $("#form-content-cotacao-venda").modal('show');

    });



     //Modal Forma Multiplas formas
    $("#modal_forma_mult").click(function(){
       //e.preventDefault();
             
        $("#form-content-mult").modal('show');

    });

    //fechar janela multiplas formas
    $('#form-content-mult').on('hidden.bs.modal', function () {
    // do something…
    //alert('teste');
    //$('#form-content-mult').modal('hide');
    //$('.modal').removeClass('show');
     //location.reload();
     //$(this).closest('.modal').modal('hide');
 location.reload();

    
    });


   


     $("#modal_excluir_item").click(function(){
       //e.preventDefault();
         
        $("#myModalDelete").modal('show');
    });



    //********** INCLUIR FORMA DE PAGAMENTO LISTAGEM AJAX
$('#add_forma_dinheiro_btn').click(function(e){


    e.preventDefault();

     $.ajax({
             type: 'POST',
             url: "<?php echo site_url('pedidos/finalizar_pedido_dinheiro/'); ?>",         
             data: $('#ajax_forma_dinheiro').serialize(),
             success : function(txt){
              var id_pedido = $('#id_pedido').val();
              var escopo = $('#escopo').val();

              //alert('VENDA FINALIZADA!');
              $('#form-content-dinheiro').modal('hide');
              $('#myModalSucesso').modal('show');
               $("#btn-carregar").html('<img src="<?= base_url(); ?>caixa/img/ajax-loader.gif" /> &nbsp; Salvando ...');

             /* if(escopo==1){ //caso seja pedido pelo estoque
              setTimeout('window.location.href = "<?php echo site_url('pedidos/solicitar_cliente/2'); ?>"; window.opener.location.href="<?php echo site_url('pedidos/filtro/2'); ?>"' , 3000);
              }else { //caso seja pedido manualmente
                setTimeout('window.location.href = "<?php echo site_url('pedidos/solicitar_cliente2/2'); ?>"; window.opener.location.href="<?php echo site_url('pedidos/filtro/2'); ?>"' , 3000);
              }*/

              window.location.href="<?php echo site_url('pedidos/imprimir'); ?>/"+id_pedido;
              window.opener.location.href="<?php echo site_url('pedidos/filtro/2'); ?>";
              
              //window.location.href="<?php echo site_url('pedidos/solicitar_cliente/2'); ?>";
              //window.opener.location.href="<?php echo site_url('pedidos/filtro/2'); ?>";
              //window.close();
              
        },
        error: function (request, status, error) {
              alert(request.responseText);
              //alert('VENDA NÃO REALIZADA!');
              //window.back();
         }
             
         });

         return false;

}); //final click btn dinheiro


//************* FINAL CONFIRMAÇÃO PAGAMENTO A VISTA




//********** SALVAR COTAÇÃO
$('#add_cotacao_btn').click(function(e){

    e.preventDefault();

     $.ajax({
             type: 'POST',
             url: "<?php echo site_url('pedidos/salvar_cotacao/'); ?>",         
             data: $('#ajax_forma_cotacao').serialize(),
             success : function(txt){
              var id_pedido = $('#id_pedido').val();
             // var escopo = $('#escopo').val();

            
              $('#form-content-cotacao').modal('hide');
              $('#myModalSucesso').modal('show');
               $("#btn-carregar").html('<img src="<?= base_url(); ?>caixa/img/ajax-loader.gif" /> &nbsp; Salvando ...');

            // setTimeout('window.location.href = "<?php echo site_url('pedidos/solicitar_cliente2/2'); ?>"; window.opener.location.href="<?php echo site_url('pedidos/filtro/1'); ?>"' , 3000);

              
              //window.location.href="<?php echo site_url('pedidos/solicitar_cliente/2'); ?>";
              window.opener.location.href="<?php echo site_url('pedidos/filtro/1'); ?>";
              window.close();
              
        },
        error: function (request, status, error) {
              alert(request.responseText);
              //alert('VENDA NÃO REALIZADA!');
              //window.back();
         }
             
         });

         return false;



}); //final click btn dinheiro


//************* FINAL SALVAR COTAÇÃO

//********** SALVAR COTAÇÃO
$('#add_cotacao_venda_btn').click(function(e){

    e.preventDefault();


     $.ajax({
             type: 'POST',
             url: "<?php echo site_url('pedidos/cotacao_venda/'); ?>",         
             data: $('#ajax_forma_cotacao_venda').serialize(),
             success : function(txt){
              var id_pedido = $('#id_pedido').val();
             
              window.location.href="<?php echo site_url('pedidos/novo/'); ?>/"+id_pedido;
              window.opener.location.href="<?php echo site_url('pedidos/filtro/2'); ?>";
                

              //window.close();
              
        },
        error: function (request, status, error) {
              alert(request.responseText);
              //alert('VENDA NÃO REALIZADA!');
              //window.back();
         }
             
         });

         return false;



}); //final click btn dinheiro


//************* FINAL CONFIRMAÇÃO PAGAMENTO A VISTA






//LISTA FATURAMENT DAS FORMAS DE RECEMINETOS MULTIPLAS


              var url_fat = '<?= site_url("/pedidos/ajax_listar_faturamento/"); ?>/'+$('#id_pedido').val();
              $.getJSON(url_fat, function(j){

              //var options = '';
              //options += '<option value="">Nenhum...</option>';
              
              var html = '';
              var total_pago = 0;
              var rowCount = 0;

              for (var i = 0; i < j.length; i++) {
              total_pago = parseFloat(total_pago) + parseFloat(j[i].valor);
               rowCount++;
              //options += '<option value="' + j[i].id_bandeira + '">' + j[i].bandeira + '</option>';
              

               html+= '<tr><td>'+j[i].forma+'</td><td>'+j[i].valor+'</td><td>'+j[i].parcela+'</td><td class=td-actions><a href="#" id="excluir_fat" class="confirm-delete-teste btn btn-danger btn-small" data-id='+ j[i].id_forma_fat +'><i class="btn-icon-only icon-remove"></i>Excluir</a></td></tr>';

                 //$('#tabela_forma_pagamento > tbody:last').append(html);


              }

              if(rowCount > 0){
                 $("#camada_confirmar").show();
               } 

              $("#tabela_forma_pagamento > tbody:last").html(html);
              $("input:text[name=total_pago_forma]").val(total_pago);
              $("#total_pago_topo").val(total_pago);
              
              $('.botao_total_pago').text("TOTAL PAGO = R$: "+total_pago.toFixed(2).replace(".", ","));
              
              var total_pedido = moedaParaNumero($('.total_pag_dinheiro').val());

              //TOTAL PEDIDO

              /*var desconto = moedaParaNumero($("#desconto").val());
              $('.desconto_perc').val(desconto);
              var frete_temp = moedaParaNumero($("#taxa_frete").val());
              var taxa_frete = (isNaN(frete_temp) ? 0 : moedaParaNumero($("#taxa_frete").val())); 
              var percentual = (desconto / 100) * moedaParaNumero(total_pagar + taxa_frete);
              var total_pedido = (total_pagar + taxa_frete) - moedaParaNumero(percentual);
              */
      

              //FINAL TOTAL
             
              
              var saldo = 0;
              saldo = total_pedido - total_pago;

               if(total_pago==total_pedido){
                  $("#camada_confirmar").show();
               }else{
                 $("#camada_confirmar").hide();
               }

              
              $('.botao_total_saldo').text("SALDO = R$: "+saldo.toFixed(2).replace(".", ","));


  
            });

//FINAL LISTA


//ACAO FORMA DE PAGAMENTO MULT


   //********** INCLUIR FORMA DE PAGAMENTO LISTAGEM AJAX
$('#add_forma_btn').click(function(e){

  //VALIDAÇÕES

    //VALIDAÇÕES DOS CAMPOS DE FORMAS DE PAGAMENTOS
          if($('#id_forma').val()==""){
            alert('Campo Forma de Pagamento Vazio.');
           return false;
          }

          if($('#qtd_parcela_pag').val()==""){
            alert('Campo Parcela Vazio.');
           return false;
          }

          if($('#id_operadora').val()!="" && $('#id_bandeira').val()=="" ){
            alert('Campo Bandeira Vazio.');
           return false;
          }




  //FINAL VALIDAÇÕES

  e.preventDefault();


//INICIO VERIFICAÇÃO 50%

                // Variaveis de apoio Lógica Autorização 
              
              //Forma de Recebimento PRAZO
              //global variavel para validar se necessário 50%
              top.validacao = "";
              
              var forma_prazo = $('#id_forma').val();
              //valor pago
              var valor_prazo = moedaParaNumero($('#valor_pago_forma').val());

               //Verificando Autorização de senha
               //Valor de 50% do pedido
               
               var total_pedido = moedaParaNumero($('.total_pag_dinheiro').val());

               var valor_minimo = (total_pedido * 50) / 100;
               
               //alert(valor_prazo);
                
               if(forma_prazo==999 && (valor_prazo > valor_minimo)){
              //  if(forma_prazo==4){
                
               
                $('#modal_cancelar').modal('show');

                
                //$("#form-content-mult").modal('hide');

               
                //alert("Necessario autorização");
                //Abri modal de login

                 $('#bt_confirmar_senha').click(function(e){

                    // var senha = $('#senha').val();

                     //AJAX SENHA 
          
          // INICIO VERIFICAÇÃO DE LOGIN
          $.ajax({
             
             type: 'POST',
             url: "<?php echo site_url('acesso_usuarios/verificar_senha/'); ?>",         
             data: $('#ajax_confirmar_senha').serialize(),
             success : function(aut){
                
                if(aut==1){

                
                
           

         /********* AJAX ADIÇÃO ITEM ********************/
         $.ajax({
             
             type: 'POST',
             url: "<?php echo site_url('pedidos/add_forma_pagamento/'); ?>",         
             data: $('#ajax_forma_pagamento').serialize(),
             success : function(txt){

             //BUSCA O FATURAMENTO PO PEDIDO PARA EXIBIÇÃO NA LISTAGEM


              var url_fat = '<?= site_url("/pedidos/ajax_listar_faturamento/"); ?>/'+$('#id_pedido').val();
              $.getJSON(url_fat, function(j){

              //var options = '';
              //options += '<option value="">Nenhum...</option>';
              
              var html = '';
              var total_pago = 0;

             

              for (var i = 0; i < j.length; i++) {
              
              //forma_prazo = j[i].id_forma;



              total_pago = parseFloat(total_pago) + parseFloat(j[i].valor);

              //options += '<option value="' + j[i].id_bandeira + '">' + j[i].bandeira + '</option>';
              

               html+= '<tr><td>'+j[i].forma+'</td><td>'+j[i].valor+'</td><td>'+j[i].parcela+'</td><td class=td-actions><a href="#" class="confirm-delete-teste btn btn-danger btn-small" data-id='+ j[i].id_forma_fat +'><i class="btn-icon-only icon-remove"></i>Excluir</a></td></tr>';

                 //$('#tabela_forma_pagamento > tbody:last').append(html);

              } 

              //alert(forma_prazo+" "+valor_prazo);


              $("#valor_pago_forma").val("");
              $("#tabela_forma_pagamento > tbody:last").html(html);
             
              $("input:text[name=total_pago_forma]").val(total_pago);
              //$("#total_pago_topo").val(total_pago);
              
              $('.botao_total_pago').text("TOTAL PAGO = R$: "+total_pago.toFixed(2).replace(".", ","));

              var saldo = 0;
              //saldo = total_pagar_pedido - total_pago;
              //$('.botao_total_saldo').text("SALDO = R$: "+saldo.toFixed(2).replace(".", ","));
             
               var total_pedido = moedaParaNumero($('.total_pag_dinheiro').val());

               //var desconto = moedaParaNumero($('#desconto').val());
               //var taxa_entrega = moedaParaNumero($('#taxa_entrega').val());
               //alert(desconto);
     
               //var total_pagar = (total_pedido + taxa_entrega ) - desconto; 

               //saldo = total_pagar - total_pago;
               saldo = total_pedido - total_pago;
          
               $('.botao_total_saldo').text("SALDO = R$: "+saldo.toFixed(2).replace(".", ","));
               //$('#ajax_forma_pagamento')[0].reset();
              
               //FINAL VERIFICAÇÃO 50%
               
               //alert(forma_prazo);
           // if(forma_prazo!=4 && (valor_prazo < valor_minimo)){
               if(total_pago==total_pedido){
                  $("#camada_confirmar").show();
               }
            //}

               

            $("#modal_cancelar").hide();



            }); /********* GET ADIÇÃO ITEN ********************/




        }, /********* SUCESS AJAX ADIÇÃO ********************/

        error: function (request, status, error) {
        alert(request.responseText);
         }
             
         });/********* FINAL AJAX ADIÇÃO ITEM ********************/
        //return false

        // AUTETINTICAÇÃO ELSE
        
        } else{
                  $("#camada_confirmar").hide();
                  alert("SENHA NÃO AUTORIZADO PARA ESSA TRANSAÇÃO");
                   $("#camada_confirmar").hide();
                   $('#modal_cancelar').modal('hide');
                   $("#form-content-mult").modal('hide');
                   
                   //$('#ajax_forma_pagamento')[0].reset();
                  location.reload();


                    //top.validacao = 9;
                     //return false;  
                          
        } // FINAL ELSE


        }, //FINAL SUCESS AUTENTICAÇÃO AJAX
          error: function (request, status, error) {
        alert(request.responseText);
         }


      }); /********* FINAL AJAX AUTENTICAÇÃO ********************/
                     
      return false;                     
                
        
        
        });  //FINAL CLICK BOTÃO DE SENHA

                


                } //IF FORMA PRAZO



       




      //|| (forma_prazo==4 && (valor_prazo <= valor_minimo))

       //if(forma_prazo!=4 || valor_prazo<=valor_minimo){ 
         else{
         //if(top.validacao==1){

                         
         $.ajax({
             
             type: 'POST',
             url: "<?php echo site_url('pedidos/add_forma_pagamento/'); ?>",         
             data: $('#ajax_forma_pagamento').serialize(),
             success : function(txt){

             //BUSCA O FATURAMENTO PO PEDIDO PARA EXIBIÇÃO NA LISTAGEM


              var url_fat = '<?= site_url("/pedidos/ajax_listar_faturamento/"); ?>/'+$('#id_pedido').val();
              $.getJSON(url_fat, function(j){

              //var options = '';
              //options += '<option value="">Nenhum...</option>';
              
              var html = '';
              var total_pago = 0;

             

              for (var i = 0; i < j.length; i++) {
              
              //forma_prazo = j[i].id_forma;



              total_pago = parseFloat(total_pago) + parseFloat(j[i].valor);

              //options += '<option value="' + j[i].id_bandeira + '">' + j[i].bandeira + '</option>';
              

               html+= '<tr><td>'+j[i].forma+'</td><td>'+j[i].valor+'</td><td>'+j[i].parcela+'</td><td class=td-actions><a href="#" class="confirm-delete-teste btn btn-danger btn-small" data-id='+ j[i].id_forma_fat +'><i class="btn-icon-only icon-remove"></i>Excluir</a></td></tr>';

                 //$('#tabela_forma_pagamento > tbody:last').append(html);

              } 

              //alert(forma_prazo+" "+valor_prazo);


              $("#valor_pago_forma").val("");
              $("#tabela_forma_pagamento > tbody:last").html(html);
             
              $("input:text[name=total_pago_forma]").val(total_pago);
              //$("#total_pago_topo").val(total_pago);
              
              $('.botao_total_pago').text("TOTAL PAGO = R$: "+total_pago.toFixed(2).replace(".", ","));

              var saldo = 0;
              //saldo = total_pagar_pedido - total_pago;
              //$('.botao_total_saldo').text("SALDO = R$: "+saldo.toFixed(2).replace(".", ","));
             
               var total_pedido = moedaParaNumero($('.total_pag_dinheiro').val());

               //var desconto = moedaParaNumero($('#desconto').val());
               //var taxa_entrega = moedaParaNumero($('#taxa_entrega').val());
               //alert(desconto);
     
               //var total_pagar = (total_pedido + taxa_entrega ) - desconto; 

               //saldo = total_pagar - total_pago;
               saldo = total_pedido - total_pago;
          
               $('.botao_total_saldo').text("SALDO = R$: "+saldo.toFixed(2).replace(".", ","));
               // $('#ajax_forma_pagamento')[0].reset();
              
               //FINAL VERIFICAÇÃO 50%
               
          //if(forma_prazo!=4 && (valor_prazo < valor_minimo)){
               if(total_pago==total_pedido){
                  $("#camada_confirmar").show();
               }
            //}

               





            });




        },

        error: function (request, status, error) {
        alert(request.responseText);
         }
             
         });

        

         return false;

          } //fina if validacao

      





}); //final click


 



// EXCLUSÃO FATURAMENTO

$(document).on('click', '.confirm-delete-teste', function(e) {
    
    e.preventDefault();
   
    var id = $(this).data('id');
    var id_pedido = $('#id_pedido').val(); 
    //alert(id);
    //$('#id_pedido').val()

             var url_fat = '<?= site_url("/pedidos/excluir_faturamento/"); ?>/'+id+'/'+id_pedido;
             $.getJSON(url_fat, function(j){

              //var options = '';
              //options += '<option value="">Nenhum...</option>';
              
              var html = '';
              var total_pago = 0;
                var rowCount = 0;

              for (var i = 0; i < j.length; i++) {
                rowCount++;
                total_pago = parseFloat(total_pago) + parseFloat(j[i].valor);

              //options += '<option value="' + j[i].id_bandeira + '">' + j[i].bandeira + '</option>';
              

               html+= '<tr><td>'+j[i].forma+'</td><td>'+j[i].valor+'</td><td>'+j[i].parcela+'</td><td class=td-actions><a href="#" class="confirm-delete-teste btn btn-danger btn-small" data-id='+ j[i].id_forma_fat +'><i class="btn-icon-only icon-remove"></i>Excluir</a></td></tr>';

                 //$('#tabela_forma_pagamento > tbody:last').append(html);

              } 

              $("#tabela_forma_pagamento > tbody:last").html(html);
              $("input:text[name=total_pago_forma]").val(total_pago);
              $("#total_pago_topo").val(total_pago);
              
              //if(rowCount==0){
                $("#camada_confirmar").hide();
              //}
              
              $('.botao_total_pago').text("TOTAL PAGO = R$: "+total_pago.toFixed(2).replace(".", ","));

              //var saldo = 0;
              //saldo = total_pagar_pedido - total_pago;
              //$('.botao_total_saldo').text("SALDO = R$: "+saldo.toFixed(2).replace(".", ","));

              var saldo = 0;
              //saldo = total_pagar_pedido - total_pago;
              //$('.botao_total_saldo').text("SALDO = R$: "+saldo.toFixed(2).replace(".", ","));
             
              // var total_pedido = moedaParaNumero($('#total_pedido').val());
               //var desconto = moedaParaNumero($('#desconto').val());
               //var taxa_entrega = moedaParaNumero($('#taxa_entrega').val());
     
               //var total_pagar = (total_pedido + taxa_entrega ) - desconto; 

               //saldo = total_pagar - total_pago;

                var total_pedido = moedaParaNumero($('.total_pag_dinheiro').val());
              var saldo = 0;
              saldo = total_pedido - total_pago;
          
               $('.botao_total_saldo').text("SALDO = R$: "+saldo.toFixed(2).replace(".", ","));
               // $('#ajax_forma_pagamento')[0].reset();
             

            });


    
}); //final documenta click


//FINAL EXCLUSÃO FATURAMENTO


//CONFIMAÇÃO DE PAGAMENTO MULTIPLAS FORMAS

//********** INCLUIR FORMA DE PAGAMENTO LISTAGEM AJAX
$('#add_forma_mult_btn').click(function(e){




    e.preventDefault();

     $.ajax({
             type: 'POST',
             url: "<?php echo site_url('pedidos/finalizar_pedido_multipla/'); ?>",         
             data: $('#ajax_forma_multipla').serialize(),
             success : function(txt){
              var id_pedido = $('#id_pedido').val();
              var escopo = $('#escopo').val();

              //alert('VENDA FINALIZADA!');
              /*$('#form-content-mult').modal('hide');
              $('#myModalSucesso').modal('show');
               $("#btn-carregar").html('<img src="<?= base_url(); ?>caixa/img/ajax-loader.gif" /> &nbsp; Salvando ...');*/

             
                 window.location.href="<?php echo site_url('pedidos/imprimir'); ?>/"+id_pedido;
              window.opener.location.href="<?php echo site_url('pedidos/filtro/2'); ?>";


             
              
        },
        error: function (request, status, error) {
              alert(request.responseText);
              //alert('VENDA NÃO REALIZADA!');
              //window.back();
         }
             
         });

         return false;

}); //final click btn dinheiro


//************* FINAL CONFIRMAÇÃO PAGAMENTO A VISTA



//FINAL CONFIRMAÇÃO MÚLTIPLAS FORMAS



//********** FINAL INCLUSÃO FORMA DE PAGAMENTO AJAX


   //***********EXCLUSÃO ITENS

$('#myModalDelete').on('show', function() {
    var id = $(this).data('id'),
        removeBtn = $(this).find('.danger');
});


$('.confirm-delete').on('click', function(e) {

   // e.preventDefault();

    var id = $(this).data('id');
    $('#myModalDelete').data('id', id).modal('show');
});

$('#btnYes').click(function() {
    // handle deletion here
    var id = $('#myModalDelete').data('id');
    var id_pedido = $('#id_pedido').val();
    $('[data-id='+id+']').remove();
    $('#myModalDelete').modal('hide');
    location.href="<?php echo site_url('pedidos/excluir_item'); ?>/"+id+"/"+id_pedido;
    
});

   //**********FINAL EXCLUSÃO ITENS

//************LISTAR FORMA DE PAGAMENTO
$('#operadora_camada').hide();
$('#bandeira_camada').hide();
$('#camada_qtd_parcela').hide();
$('#qtd_parcela_pag').val('1');


 var url = '<?= site_url("/formas_recebimentos/ajax_listar/"); ?>/';
          $.getJSON(url, function(j){
                
           var flag = "";
            var options = '<option value="">Selecione...</option>'; 
              for (var i = 0; i < j.length; i++) {
                options += '<option value="' + j[i].id_forma + '">' + j[i].forma + '</option>';
                flag = j[i].cartao;
              } 
           
             $('#id_forma').html(options).show();
                       
             /*if(j.length>0){
              $('#operadora_camada').show();
             }else{
                $('#operadora_camada').hide();
             }*/

             $('.carregando').hide();
          });
//************FINAL FORMA DE PAGAMENTO




//AO CLICAR NO SELECT DO MODAL EM FORMA DE PAGAMENTO

 $('#camada_data_vencimento').hide();
$('#id_forma').change(function(){

    var forma_dinheiro = "<?php echo FORMA_REC_DINHEIRO; ?>";

    if( $(this).val() ) {
        
        /*if( $(this).val()==forma_dinheiro){
           $('#camada_qtd_parcela').hide();
           $('#qtd_parcela_pag').val('1');
        }
        else{
          $('#camada_qtd_parcela').show();
        }*/

        $('#camada_qtd_parcela').show();


      
          
          $('.carregando').show();
          var url = '<?= site_url("/formas_recebimentos/exibir_parcela/"); ?>/'+$(this).val();
          $.getJSON(url, function(j){
                   
            
            //var options = '<option value="">Nenhum...</option>'; 
            var options ='';
              for (var i = 0; i < j.length; i++) {
                  
                  //Exibir campo data de vencimento manual no lançamento
                  if(j[i].data_vencimento_manual==1){
                       $('#camada_data_vencimento').show();
                    // alert('manual');
                  }else{
                    //alert('nao manual');
                      $('#camada_data_vencimento').hide();
                  }

                for(var x=1;x <= j[i].maximo_parcela;x++){
                  options += '<option value="' + x + '">' + x + '</option>';
                 }
              } 

             $('#qtd_parcela_select').html(options).show();
             
            
            /* if(j.length>0){
              $('#operadora_camada').show();
             }else{
                $('#operadora_camada').hide();
             }*/

             $('.carregando').hide();
          });






          //BANDEIRA
 $('#id_operadora').change(function(){
       
   $('#bandeira_camada').show();
   var url = '<?= site_url("/bandeira_cartao/listarPorOperadora/"); ?>/'+$(this).val();
   $.getJSON(url, function(j){
                             
      var options = '';
       options += '<option value="">Nenhum...</option>';
       for (var i = 0; i < j.length; i++) {
          options += '<option value="' + j[i].id_bandeira + '">' + j[i].bandeira + '</option>';
        } 
       
       
       $('#id_bandeira').html(options).show();
       
    });
});
//FINAL BANDEIRA

       //***********FINAL VERIFICAÇÃO



      } //FINAL VAL

  
  }); //FINAL SELEÇÃO DE FORMA DE PAGAMENTO
//FINAL CLICAR NA FORMA DE PAGAMENTO




//FINAL ACAO FORMA DE PAGAMENTO MULT




 
  //Na seleção de itens caso selecione:
  //Código
  $("#selecao_codigo").click(function(){
    $("#camada_nome_produto").hide();
    $("#manual").hide();
    $("#camada_codigo").show();
    $("#camada_descricao").show();
    $("#preco_item").val("");
    $("#descricao").val("");
    $("#codigo_item").val("");
    

  });

  //Nome do Produto
  $("#selecao_descricao").click(function(){
    $("#camada_nome_produto").show();
    $("#camada_codigo").hide();
    $("#camada_descricao").hide();
    $("#manual").hide();
    $("#preco_item").val("");
    $("#descricao").val("");
    $("#codigo_item").val("");
    
  });

  //Descrição Manual
  $("#selecao_manual").click(function(){
    $("#camada_nome_produto").hide();
    $("#manual").show();
    $("#camada_codigo").hide();
    $("#camada_descricao").hide();
    $("#preco_item").val("");
    $("#descricao").val("");
    $("#codigo_item").val("");
    
  });




//CONSULTA ITENS POR CÓDIGO
$('#codigo_item').blur(function() {
   
   var url = '<?= site_url("/produtos/pesquisar_por_codigo/"); ?>/'+$("#codigo_item").val();
   $.getJSON(url, function(j){

       var descricao = "";
       var preco = "";
       var id_produto= "";

                  
       for (var i = 0; i < j.length; i++) {
         
          descricao = j[i].descricao;
          preco = j[i].valor_venda;

          $('#descricao').val(descricao);
          $('#preco_item').val(preco);
      
       } 



}); 

  
}); // FINAL CONSULTA POR CÓDIGO ITENS



//Consulta Produto pelo autocomplete
 $('#id_produto').change(function(){

    //alert($(this).val());

     var url = '<?= site_url("/produtos/ajax_visualizar_produto/"); ?>/'+$(this).val();
     $.getJSON(url, function(j){
      var preco = 0;
                             
     // var options = '';
       //options += '<option value="">Selecione...</option>';
       for (var i = 0; i < j.length; i++) {
         // options += '<option value="' + j[i].ct_id + '">' + j[i].ct_nome + '</option>';
         preco = j[i].valor_venda;
         codigo = j[i].codigo;

        } 

        //alert(preco);

         $("#preco_item").val(preco);
         $("#codigo_item").val(codigo);
       
      // $('#id_cidade').html(options).show();
       
    });

  }); //final ajax

  

  //ATUALIZANDO DADOS DO PEDIDO

  $('#edit_pedido_btn').click(function(e){
    //alert('TESTE');

    e.preventDefault();

     $.ajax({
             type: 'POST',
             url: "<?php echo site_url('pedidos/editar_pedido/'); ?>",         
             data: $('#ajax_edit_pedido').serialize(),
             success : function(txt){
              var id_pedido = $('#id_pedido').val();
              //alert('VENDA FINALIZADA!');
              $('#myModal').modal('hide');

               var tipo = 2;
               window.location.href="<?php echo site_url('pedidos/novo/'); ?>/"+id_pedido;
               window.opener.location.href="<?php echo site_url('pedidos/filtro/'); ?>/"+tipo;
                               
              //window.close();
       },
        error: function (request, status, error) {
              alert(request.responseText);
              //alert('VENDA NÃO REALIZADA!');
              //window.back();
         }
             
         });

         return false;

  }); // FINAL EDIT PEDIDOS




//********** INCIO NOVO CLIENTE
$('#add_novo_cliente_btn').click(function(e){
 var tipo = 2; //$('#tipo').val();
 //var flag_tipo_op = $('#flag_tipo_op').val();
 
 var nome_fantasia = $('#nome_fantasia').val();
 
 if(nome_fantasia==""){
   alert('INFORME UM NOME PARA O CADASTRO!');
  } else { 

    e.preventDefault();

     $.ajax({
             type: 'POST',
             //url: "<?php echo site_url('pedidos/editar_pedido/'); ?>",
             url: "<?php echo site_url('pedidos/incluir_cliente/'); ?>",         
             data: $('#ajax_novo_cliente').serialize(),
             success : function(txt){
              var id_pedido = $('#id_pedido').val();
              $('#myModalNovoCadastro').modal('hide');

               if(txt==1){
                 alert('CLIENTE JÁ EXISTE NA BASE DE DADOS!');
                 $('#myModalNovoCadastro').modal('hide');
               } 


               window.location.href="<?php echo site_url('pedidos/novo/'); ?>/"+id_pedido;
               window.opener.location.href="<?php echo site_url('pedidos/filtro/'); ?>/"+tipo;

                //window.close();
      },
        error: function (request, status, error) {
              alert(request.responseText);
              //alert('VENDA NÃO REALIZADA!');
              //window.back();
         }
             
         });

         return false;
    }


}); //final click btn dinheiro


//************* FINAL REQUISIÇÃO NOVO CLIENTE


//********** INCIO NOVO PRODUTO
$('#add_novo_produto_btn').click(function(e){
 var tipo = 2; //$('#tipo').val();
 //var flag_tipo_op = $('#flag_tipo_op').val();
 
 var nome_produto = $('#nome_produto').val();
 
 if(nome_produto==""){
   alert('INFORME UM NOME DE PRODUTO PARA O CADASTRO!');
  } else { 

    e.preventDefault();

     $.ajax({
             type: 'POST',
             
             url: "<?php echo site_url('pedidos/incluir_novo_produto/'); ?>",         
             data: $('#ajax_novo_produto').serialize(),
             success : function(txt){
              var id_pedido = $('#id_pedido').val();
              $('#myModalNovoCadastro').modal('hide');

               if(txt==1){
                 alert('PRODUTO JÁ EXISTE NA BASE DE DADOS!');
                 $('#myModalNovoCadastro').modal('hide');
               } 


               window.location.href="<?php echo site_url('pedidos/novo/'); ?>/"+id_pedido;
               window.opener.location.href="<?php echo site_url('pedidos/filtro/'); ?>/"+tipo;

                //window.close();
      },
        error: function (request, status, error) {
              alert(request.responseText);
              //alert('VENDA NÃO REALIZADA!');
              //window.back();
         }
             
         });

         return false;
    }


}); //final click btn dinheiro


//************* FINAL REQUISIÇÃO NOVO PRODUTO


 $(".open-AddBookDialog").click(function(){

          
     var myBookId = $(this).data('id');
     var acessou = "nao";
     //alert(myBookId);
     
    var url = '<?= site_url("/itens/ajax_visualizar_item/"); ?>/'+myBookId;
    
   $.getJSON(url, function(j){
                             
    
       var id_item = "";
       var id_pedido = "";
       var id_produto = "";
       var descricao = "";
       var valor_unitario = "";
       var qtd = "";

       
       for (var i = 0; i < j.length; i++) {
        
          id_item = j[i].id_item;
          id_pedido = j[i].id_pedido;
          id_produto = j[i].id_produto;
          qtd = j[i].qtd;
          valor_unitario = j[i].valor_unitario;
          descricao = j[i].descricao;


        } 
      
      $("#edit_id_item").val(id_item);
      $("#edit_id_pedido").val(id_pedido);
      $("#edit_qtd").val(qtd);
      $("#edit_preco").val(valor_unitario);
      $("#edit_descricao").val(descricao);
      $("#edit_id_produto").val(id_produto).change();
      //$("div.id_100 select").val(id_produto);
      //alert(acessou);

});

    
});



$('#edit_itens_btn').click(function(e){
    //alert('TESTE');
      if($("#edit_id_produto").val()=="" || $("#edit_qtd").val()==0)

      {
        alert("CAMPO PRODUTO E QTD OBRIGATORIOS")
      }

      else {

    e.preventDefault();

     $.ajax({
             type: 'POST',
             url: "<?php echo site_url('itens/editar_itens/'); ?>",         
             data: $('#ajax_edit_itens').serialize(),
             success : function(txt){
              var id_pedido = $('#edit_id_pedido').val();
              //alert('VENDA FINALIZADA!');
              $('#myModal').modal('hide');

               var tipo = 2;
               window.location.href="<?php echo site_url('pedidos/novo/'); ?>/"+id_pedido;
               window.opener.location.href="<?php echo site_url('pedidos/filtro/'); ?>/"+tipo;
                               
              //window.close();
       },
        error: function (request, status, error) {
              alert(request.responseText);
              //alert('VENDA NÃO REALIZADA!');
              //window.back();
         }
             
         });

         return false;
}


  }); // FINAL EDIT PEDIDOS


$('#fechar_janela').click(function(e){

    e.preventDefault();

    window.opener.location.href="<?php echo site_url('pedidos/filtro/'.$tipo); ?>";
    window.close();

});



}); //FINAL GERAL

</script>