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
            <h3>Pesquisar Produto do Estoque </h3>
              <a href="<?php echo site_url('produto/add_tela_venda/'.$objPedido->getId_pedido()); ?>" class="btn btn-default btn-small" id="modal_alterar_pedido"><i class="icon-pencil"></i> <strong> Novo Produto</strong></a>
          </div> <!-- widget header -->

    <div class="widget-content">
         <?php echo form_open('pedidos/estoque_pesquisa/'.$objPedido->getId_pedido(),array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
          <input type="hidden" name="id_pedido" id="id_pedido" value="<?php echo $objPedido->getId_pedido(); ?>" />
              <?php echo validation_errors(); ?>

          <fieldset class="grupo">
        
        <div class="campo">
           <label for="nome" class="tituloItens">Código Produto:</label>
          <input type="text" name="codigo" class="span2 campoItens" id="codigo">
        </div>

       <div class="campo">
           <label for="nome" class="tituloItens">Nome Produto:</label>
          <input type="text" name="descricao" class="span3 campoItens" id="descricao">
        </div>
       

   

     <div class="campo">
        <label for="nome" class="labelDados">&nbsp</label>
        <button type="submit" class="btn btn-success btItensAdd">
          <i class="icon-search icon-white "></i> Pesquisar
        </button>       
      </div>
       </fieldset>

       </form>

           
          </div>
          <!-- FINAL ITENS COMANDA -->

          <!-- INICIO LISTAGEM DE ITENS -->

          <!-- DADOS DA LISTAGEM DOS  ITENS PEDIDO -->
  <div class="widget-header">
    <i class="icon-list"></i>
      <h3>Resultado Pesquisa:</h3>
  </div> <!-- widget header -->

  <div class="widget-content listaItens">

    <?php if($listProdutos!=null){ ?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <td class="tituloMostrarDados">CODIGO</td>
          <td class="tituloMostrarDados">PRODUTO</td>
          <td class="tituloMostrarDados">VALOR</td>
          <td class="tituloMostrarDados">QTD DIPONÍVEL</td>
          <td class="tituloMostrarDados">ADICIONAR</td>
        </tr>
      </thead>

      <tbody>
         <?php 
                   $entrada =0;
                    $saida = 0;
                    $qtd = 0;
   
         foreach($listProdutos as $objProduto): 
                   $entrada = $objProduto["Entrada"];
                    $saida = $objProduto["Saida"];
                    $qtd = $entrada - $saida;

          ?>
           <?php if(($objProduto['tipo']==PRODUTO) && ($qtd<0 || $qtd<$objProduto['qtd_minima']) ) { ?>
                   <tr style="color:red;">
              <?php } else { ?>
                  <tr class="dadosTabela">

              <?php } ?>


                <td class="detalheItens"><?php echo $objProduto['codigo']; ?></td>
                <td class="detalheItens"><?php echo $objProduto['produto']; if($objProduto['tipo']==SERVICO) {  echo " <strong>(SERVIÇO)</strong>"; }  ?></td>
                 <td class="detalheItens">R$ <?php echo number_format($objProduto['valor_venda'], 2, ',', '.'); ?></td>
              <td>
                    
                   
                   <?php 
                   
                   if($objProduto['tipo']==PRODUTO){
                    echo number_format($qtd, 2, ',', '.'); 
                   }

                   ?>  
                 
                  </td>
                <td>

               
                 <?php if($objPedido->getStatus()==ANDAMENTO || $objPedido->getStatus()==PROCESSAMENTO){ ?>
                 <a data-toggle="modal" href="#form-content" data-id="<?php echo $objProduto['id_produto']; ?>" class="btn btn-success incluir_quantidade"><i class="btn-icon-only icon-plus-sign"> </i>Incluir</a>
                 <?php } ?>
                
               
                </td>
              
              

            </tr>
        
        
        <?php endforeach; ?>
        
     


      </tbody>

  
    </table>
<?php } ?>
           
    </div> <!-- widgte content -->
<!-- FINAL DA LISTAGEM DOS ITENS DO PEDIDO -->

          <!-- FINAL LISTAGEM DE ITESN -->






          
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




<script type="text/javascript">

$(function () {



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