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


<script src="<?= base_url() ?>bootstrap/js/jquery.min.js"></script>  
<script src="<?= base_url() ?>bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/text_numero.js"></script>
  

  

</head>

<body>
	


<div class="container-fluid">

<h3>ABERTURA - <?php echo $objMesa->getNome(); ?></h3>
 

 <?php echo form_open('pedidos_mesa/abrir/'.$objMesa->getId_mesa(),array("onsubmit"=>"return validate()","class"=>"form-horizontal","id"=>"formulario")); ?>
    <input type="hidden" name="id_mesa" id="id_mesa" value="<?php echo $objMesa->getId_mesa(); ?>" />

<div class="row">
 
 <div class="col-xs-4">
    <label>GARÇON</label>
      <select class="form-control" name="id_garcon" id="id_garcon">
                        <option value="">Nenhum</option>
                         <?php foreach($listColaborador as $objCol): ?>
                        <option value="<?php echo $objCol->getId_colaborador(); ?>" <?php echo set_select('id_garcon',$objCol->getId_colaborador()); ?>>
                           <?php echo $objCol->getNome(); ?>
                        </option>
                         <?php endforeach; ?>
                    </select>
  </div>
</div>

<br />

<div class="row">
  <div class="col-xs-4">
  <label>QTD DE PESSOAS</label>
    <!-- tipo="moneyReal" -->
    <input type="text" name="qtd_pessoas_mesa" onkeypress='return SomenteNumero(event)' class="form-control">
  </div>

</div>

<br>

<div class="row">
  <div class="col-xs-4">
 <button type="submit" class="btn btn-success btn-lg btn-block">CONFIRMAR</button> 
</div>
</div>

</form>

</div>

</body>
</html>