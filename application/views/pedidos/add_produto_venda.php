<!DOCTYPE html>
<html lang="en">
  
 <head>
    <meta charset="utf-8">
    <title>FRENTE DE CAIXA</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">

<link href="<?= base_url() ?>caixa/css/bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url() ?>caixa/css/bootstrap-responsive.min.css" rel="stylesheet">

<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
<link href="<?= base_url() ?>caixa/css/font-awesome.css" rel="stylesheet">

<link href="<?= base_url() ?>caixa/css/style.css" rel="stylesheet">


<link href="<?= base_url() ?>caixa/css/form_style.css" rel="stylesheet">

<link href="<?= base_url() ?>caixa/css/pages/reports.css" rel="stylesheet">


  
<style type="text/css">
 
      

.tituloMostrarDados{
  font-weight:bold; 
}

.obrigatorio{
color:#FF8C00;
font-size:9px;   
}
        
    
</style>

  <?php
      //COR DE IDENTIFICAÇÃO PARA PEDIDOS OU ORÇAMENTOS
      if($objPedido->getTipo()==ORCAMENTO){
         $fundoCodigo = "class='btn btn-warning'";
       }
       else{
         $fundoCodigo = "class='btn btn-success'";
       }
    ?>


<body>
<div class="row">
  <div class="span12">
       <div class="widget ">
        


          <div class="span11">
          
           

          <!-- /widget-content --> 

          <!-- INCLUSAO ITENS COMANDA -->
          <div class="widget-header">
            <i class="icon-shopping-cart"></i>
            <h3>Cadastrar Produto </h3>
              <a href="<?php echo site_url('pedidos/estoque_pesquisa/'.$objPedido->getId_pedido()); ?>" class="btn btn-info btn-small" id="modal_alterar_pedido"> <strong>Listar Produtos</strong></a>
          </div> <!-- widget header -->

    <div class="widget-content">
         <?php echo form_open('pedidos/add_produto_venda/'.$objPedido->getId_pedido(),array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
          <input type="hidden" name="id_pedido" id="id_pedido" value="<?php echo $objPedido->getId_pedido(); ?>" />
              <?php echo validation_errors(); ?>

          
          <fieldset class="grupo">
        
       
       <div class="campo">
           <label for="nome" class="tituloItens">Nome Produto: <span class="obrigatorio">*</span></label>
          <input type="text" name="descricao" class="span3 campoItens" id="descricao">
        </div>
         

         <div class="campo">
           <label for="nome" class="tituloItens">Categoria:</label>
          <select class="form-control" name="id_categoria" id="id_categoria">
                        </select>
        </div>
        </fieldset>

         <fieldset class="grupo">
        
         <div class="campo">
           <label for="nome" class="tituloItens">Unidade de Medida:</label>
          <select class="form-control" name="id_unidade" id="id_unidade">
                        </select>
        </div>

         <div class="campo">
           <label for="nome" class="tituloItens">Fornecedor:</label>
          <select class="form-control" name="id_fornecedor" id="id_fornecedor">

          </select>
        </div>

        
        </fieldset>

         <fieldset class="grupo">

            <div class="campo">
           <label for="nome" class="tituloItens">Valor do Produto: <span class="obrigatorio">*</span></label>
           <input type="text" name="valor_venda" class="span3 campoItens" tipo="moneyReal" id="codigo">
        </div>
        
       

         <div class="campo">
           <label for="nome" class="tituloItens">Tipo:</label>
          
          <select class="form-control" name="tipo" id="tipo">
            <option value="<?php echo PRODUTO; ?>">PRODUTO</option>
             <option value="<?php echo SERVICO; ?>">SERVIÇO</option>
          </select>
        
        </div>

        
        </fieldset>

         <fieldset class="grupo">

         <div class="campo">
           <label for="nome" class="tituloItens">Código:</label>
           <input type="text" name="codigo" class="span3 campoItens" id="codigo">
        </div>

         </fieldset>



  
  <fieldset class="grupo">
  
        
        
       

   

     <div class="campo">
        <label for="nome" class="labelDados">&nbsp</label>
        <button type="submit" class="btn btn-success btItensAdd">
          <i class="icon-cloud-upload icon-white "></i> Cadastrar
        </button>       
      </div>
       </fieldset>

       </form>

           
          </div>
          <!-- FINAL ITENS COMANDA -->

          <!-- INICIO LISTAGEM DE ITENS -->

          <!-- DADOS DA LISTAGEM DOS  ITENS PEDIDO -->




          
          </div><!-- SPAN 6 -->  

           <!-- </div> -->
                </div>
                    </div> <!-- /widget-content -->


<!-- MODAL QUANTIDADE -->  
 <!-- <div id="form-content" class="modal hide fade in" style="display: none; ">-->
   <div id="myModal" class="modal hide">

   
          <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                      <h3><i class="btn-icon-only icon-money"> </i>Incluir Pagamento</h3>
          </div>


        <fieldset>
          <div class="modal-body">
            <form action="" method="post" id="ajax_finalizar"> 
            <input type="hidden" name="id_pedido" value="<?php echo $objPedido->getId_pedido(); ?>"> 
             <input type="hidden" name="id_produto" id="id_produto"> 

            <fieldset class="grupo">
              <div class="campo">
                <label for="nome" class="labelDados">QUANTIDADE:</label>
                <input type="text" name="quantidade" id="quantidade" class="span2" onkeypress='return SomenteNumero(event)'>

              </div>
            </fieldset>  
            
            </form>

          </div>
        </fieldset>


       <div class="modal-footer">
          <input type="submit" class="btn btn-primary" value="Confirmar" id="confirmar_qtd" />
       
           <a href="#" class="btn" data-dismiss="modal"><i class="icon-remove icon-white"></i> Fechar</a>

       </div>

  </div>

  <!-- FINAL MODAL QUANTIDADE -->  



                        </div> <!-- /widget -->

</body>

</html>



                        

 <script type="text/javascript" src="<?php echo base_url(); ?>js/text_numero.js"></script>
<script src="<?= base_url() ?>caixa/js/jquery-1.7.2.min.js"></script>
<script src="<?= base_url() ?>caixa/js/bootstrap.js"></script>
<script src="<?= base_url() ?>caixa/js/base.js"></script>

<script type="text/javascript" src="<?= base_url() ?>js/jquery-maskMoney.js"></script> <!--Jquery ... -->
        <script type="text/javascript" src="<?= base_url() ?>js/jquery.magicforms-b1.0.js"></script> <!--Leonardo simas e Weslley leandro -->
        <script type="text/javascript" src="<?= base_url() ?>js/select.maskgrupo.myconfig.js"></script> <!--Leonardo simas e Weslley leandro -->





<script type="text/javascript">

$(function () {

  //Categoria   
   var url = '<?= site_url("/est_categorias/ajax_listar/0"); ?>/';
   $.getJSON(url, function(j){
                             
      var options = '';
       //options += '<option value="">Selecione...</option>';
       for (var i = 0; i < j.length; i++) {
          options += '<option value="' + j[i].id_categoria + '">' + j[i].categoria + '</option>';
        } 
       $('#id_categoria').html(options).show();
       
    });


    //Unidade   
   var urlUnidade = '<?= site_url("/est_un_medida/ajax_listar/0"); ?>/';
   $.getJSON(urlUnidade, function(u){
                             
      var optionsUnidade = '';
       //options += '<option value="">Selecione...</option>';
       for (var x = 0; x < u.length; x++) {
          optionsUnidade += '<option value="' + u[x].id_unidade + '">' + u[x].unidade + '</option>';
        } 
       $('#id_unidade').html(optionsUnidade).show();
       
    });


     //Fornecedor   
   var urlFornecedor = '<?= site_url("/fornecedores/ajax_listar/0"); ?>/';
   $.getJSON(urlFornecedor, function(u){
                             
      var optionsForn = '';
       optionsForn += '<option value="1">SEM CADASTRO</option>';
       for (var x = 0; x < u.length; x++) {
          optionsForn += '<option value="' + u[x].id_fornecedor + '">' + u[x].nome_fantasia + '</option>';
        } 
       $('#id_fornecedor').html(optionsForn).show();
       
    });




  $('.incluir_quantidade').click(function(e){
   var id_produto = $(this).data('id');
  
   $("#id_produto").val(id_produto);
    
    $('#myModal').data('id', id_produto).modal('show');
    e.preventDefault();

   });

    
    $('#confirmar_qtd').click(function(e){

       if($('#quantidade').val()==""){
            alert('Campo QUANTIDADE Vazio');
           return false;
          }


       $.ajax({
             type: 'POST',
             url: "<?php echo site_url('pedidos/add_item_consulta/'); ?>",         
             data: $('#ajax_finalizar').serialize(),
             success : function(txt){
              var id_pedido = $('#id_pedido').val();
              //window.location.href="<?php echo site_url('pedidos/estoque_pesquisa/'); ?>/"+id_pedido;
              $('#myModal').modal('hide');
              window.opener.location.href="<?php echo site_url('pedidos/visualizar/'); ?>/"+id_pedido;
              //window.close();
              
        },
        error: function (request, status, error) {
              alert(request.responseText);
             // alert('NÃO REALIZADA!');
              //window.back();
         }
             
         });

         return false;
    


    });





 

});



</script>

 <script type="text/javascript" src="<?php echo base_url(); ?>js/text_numero.js"></script>