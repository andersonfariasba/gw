  
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
<div class="row">
  <div class="span12">
       <div class="widget ">
        


          <div class="span11">
          
             <!--<div class="widget-header"> <i class="icon-cloud"></i>
              <h3>Dados do Cliente:</h3>
            </div>

     

          <div class="widget-content">
           
           <fieldset class="grupo">
              <div class="campo">
                <label for="nome" class="labelDados"> <span <?php echo $fundoCodigo; ?> >Pedido: <?php echo $objPedido->getId_pedido(); ?></span></label>
              </div>

               <div class="campo">
                <label for="nome" class="labelDados"><span <?php echo $fundoCodigo; ?> ><?php echo $objPedido->getMesa()->getNome(); ?></span></label>
              </div>

              <div class="campo">
                <label for="nome" class="labelDados"><span <?php echo $fundoCodigo; ?> >Cliente:     <?php echo $objPedido->getCliente()->getNome_fantasia(); ?></span></label>
              </div>

               <div class="campo">
        <label for="nome" class="labelDados"><?php echo $objPedido->printStatus(); ?></label>
      
     </div>

           
           </fieldset>
         


          </div>-->


          <!-- /widget-content --> 

          <!-- INCLUSAO ITENS COMANDA -->
          <div class="widget-header">
            <i class="icon-shopping-cart"></i>
            <h3>Pesquisar Produto do Estoque <span <?php echo $fundoCodigo; ?> > Venda Nº: <?php echo $objPedido->getId_pedido(); ?></span></h3>
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
       <label for="nome" class="tituloItens">Quantidade:</label>
       <input type="text" name="qtd" class="span2" id="qtd" value="<?php echo set_value('qtd','1')?>" onkeypress='return SomenteNumero(event)'>
     </div>

     <div class="campo">
        <label for="nome" class="labelDados">&nbsp</label>
        <button type="submit" class="btn btn-success btItensAdd">
          <i class="icon-search icon-white "></i> Pesquisar no estoque
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
          <td class="tituloMostrarDados">QTD</td>
          <td class="tituloMostrarDados">ADICIONAR</td>
        </tr>
      </thead>

      <tbody>
         <?php foreach($listProdutos as $objProduto): ?>
            <tr>           
                <td class="detalheItens"><?php echo $objProduto->getCodigo(); ?></td>
                <td class="detalheItens"><?php echo $objProduto->getDescricao(); ?></td>
                 <td class="detalheItens"><?php echo $objProduto->getValor_venda(); ?></td>
                <td class="detalheItens"><?php echo $qtd; ?></td>
                <td><a href=<?php echo site_url('pedidos/add_item_consulta/'.$objProduto->getId_produto()."/".$objPedido->getId_pedido()."/".$qtd); ?> id='add_item_modal' class='btn btn-small btn-success'> <i class='btn-icon-only icon-plus-sign'></i>Incluir</a></td>
              
              

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
                        </div> <!-- /widget -->


                        <!-- MODAL EXCLUSÃO DE ITENS -->
 <div id="myModal" class="modal hide">
    <div class="modal-header">
        <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
         <h3>Excluir Item</h3>
    </div>
    <div class="modal-body">
        
        <p>Deseja realmente excluir o item ?</p>
    </div>
    <div class="modal-footer">
      <a href="#" id="btnYes" class="btn btn-danger"><i class="icon-remove icon-white"></i> Confirmar exclusão</a>
      <a href="#" data-dismiss="modal" aria-hidden="true" class="btn secondary">Cancelar</a>
    </div>
  </div> <!-- /widget-content -->
                        

 



<script type="text/javascript">
$(function () {

$('#myModal').on('show', function() {
    var id = $(this).data('id'),
        removeBtn = $(this).find('.danger');
});

$('.confirm-delete').on('click', function(e) {
    e.preventDefault();

    var id = $(this).data('id');
    $('#myModal').data('id', id).modal('show');
});

$('#btnYes').click(function() {
    // handle deletion here
    var id = $('#myModal').data('id');
    var id_pedido = $('#id_pedido').val();
    $('[data-id='+id+']').remove();
    $('#myModal').modal('hide');
    location.href="<?php echo site_url('pedidos/excluir_item_comanda'); ?>/"+id+"/"+id_pedido;
    
});






});



</script>

 <script type="text/javascript" src="<?php echo base_url(); ?>js/text_numero.js"></script>