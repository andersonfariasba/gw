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


<!-- SELECIONAR ITENS DO PEDIDO -->
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title"><strong><i class="glyphicon glyphicon-pencil" aria-hidden="true"></i> Editar Item </strong></h3>
  </div>
  
  <div class="panel-body" style="background-color:#FFFAFA; ">
  
  
   <?php echo validation_errors(); ?>
  

   <?php echo form_open('solicitacao/item_editar/'.$objItem->getId_item()."/".$objSolicitacao->getId_solicitacao(),array("onsubmit"=>"return validate()","class"=>"form-horizontal","id"=>"formulario")); ?>
    
    <input type="hidden" name="id_solicitacao" id="id_solicitacao" value="<?php echo $objSolicitacao->getId_solicitacao()?>" />
    <input type="hidden" name="id_item" id="id_item" value="<?php echo $objItem->getId_item()?>" />


<div class="row">
  
  
   
  
   <div class="col-xs-6">
  <label>Material</label>
    <input type="text" tipo="moneyReal" id="preco_item" readonly class="form-control" value="<?php echo $objItem->getProduto()->getDescricao(); ?>">
  </div>

  <div class="col-xs-3">
  <label>Qtd</label>
    <input type="text" onkeypress='return SomenteNumero(event)' id="preco_item" name="qtd" value="<?php echo $objItem->getQtd(); ?>" class="form-control">
  </div>

  

 </div>

<br />
<div class="row">

<div class="col-xs-6">
  <label>Obra</label>
    <input type="text" readonly tipo="moneyReal" id="preco_item" value="<?php echo $objItem->getObra()->getNome_obra(); ?>" class="form-control">
  </div>

   <div class="col-xs-3">
  <label>Centro de Custo</label>
    <input type="text" tipo="moneyReal" readonly id="preco_item" value="<?php echo $objItem->getObra()->getCusto()->getCusto(); ?>" class="form-control">
  </div>


</div>
<br />
<div class="row">

<div class="col-xs-2">
  
   <button type="submit" class="btn btn-success"><strong><i class="glyphicon glyphicon-pencil" aria-hidden="true"></i> Salvar</strong></button>
  
  </div>
</div>

 </div>

  </form>


<!-- FINAL SELECIONAR ITENS DO PEDIDO -->



</body>


</html>

<script type="text/javascript" src="<?php echo base_url(); ?>js/text_numero.js"></script>
