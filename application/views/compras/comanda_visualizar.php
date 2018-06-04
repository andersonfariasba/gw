 <?php $objDateFormat = $this->DateFormat; ?> 
<style type="text/css">
 
        .fundoSelect{
         background-color:#999999; 
         font-weight:9OO; 
}

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
        

        <!--<div class="widget-header">
                <i class="icon-edit"></i>
                <h3>Seja bem Vindo!</h3>
         </div> 
         -->

            
          <!--  <div class="widget-content">-->

          <div class="span11">
          
             <div class="widget-header"> <i class="icon-cloud"></i>
              <h3>Dados do Cliente:</h3>
            </div>

            <!-- INICIO MENU -->

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
       <label for="nome" class="labelDados"><span <?php echo $fundoCodigo; ?> >Garçom <?php echo $objPedido->getGarcom()->getNome(); ?></span></label>
       
     </div>

         <div class="campo">
         <label for="nome" class="labelDados"><span <?php echo $fundoCodigo; ?> >Data<?php echo $objDateFormat->date_format_pedido($objPedido->getData_inicio()); ?></span></label>
       
       </div>


               <div class="campo">
        <label for="nome" class="labelDados"><?php echo $objPedido->printStatus(); ?></label>
      
     </div>

           
           </fieldset>
         


          </div>
          <!-- /widget-content --> 

       

          <!-- INICIO LISTAGEM DE ITENS -->

          <!-- DADOS DA LISTAGEM DOS  ITENS PEDIDO -->
  <div class="widget-header">
    <i class="icon-list"></i>
      <h3>Itens Selecionados:</h3>
  </div> <!-- widget header -->

  <div class="widget-content listaItens">

    <table class="table table-bordered">
      <thead>
        <tr>
          <td class="tituloMostrarDados">CODIGO</td>
          <td class="tituloMostrarDados">PRODUTO</td>
          <td class="tituloMostrarDados">QTD</td>
          <td class="tituloMostrarDados">EXCLUIR</td>
        </tr>
      </thead>

      <tbody>
         <?php foreach($listItens as $objItem): ?>
            <tr>           
                <td class="detalheItens" width="60px"><?php echo $objItem->getProduto()->getCodigo(); ?></td>
                <td class="detalheItens" width="170px"><?php echo $objItem->getProduto()->getDescricao(); ?></td>
                <td class="detalheItens" width="60"><?php echo $objItem->getQtd(); ?></td>
              
                <td>
                 <?php //if($objPedido->getStatus()==ANDAMENTO){ ?>
                <a href="#" class="confirm-delete btn btn-danger btn-small" data-id="<?php echo $objItem->getId_comanda(); ?>"><i class="btn-icon-only icon-remove"> </i>Excluir</a>
                 <?php //} ?>
                </td>

            </tr>
        
        
        <?php endforeach; ?>
        
     


      </tbody>

  
    </table>

       <!--
        <a href="<?php echo site_url('pedidos/confirmar_comanda/'.$objPedido->getId_pedido());?>" class="btn btn-success btn"><i class="btn-icon-only icon-ok"> </i><strong>Confirmar Pedido</strong></a>
           -->     
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

  $(this).attr("title", "<?=$objPedido->getMesa()->getNome();?>");

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