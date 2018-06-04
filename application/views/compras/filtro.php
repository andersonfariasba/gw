<?php $objDateFormat = $this->DateFormat; 
 
 $janela = array(
              'width'      => '2048',
              'height'     => '790',
              'scrollbars' => 'yes',
              'status'     => 'yes',
              'resizable'  => 'yes',
              'screenx'    => '200',
              'screeny'    => '100'
            );

?>


<script type="text/javascript">
 /* function explode(){
  alert("Boom!");
}
setTimeout(explode, 1000);
  */
</script>

<!-- modal filtro avançado -->	
	<div id="form-content" class="modal hide fade in" style="display: none; ">
	        <div class="modal-header">
	              <a class="close" data-dismiss="modal">×</a>
                      <h3><i class="btn-icon-only icon-search"> </i>Pesquisa Avançada</h3>
	        </div>
		
			<!--<form class="contact">-->
                        
  <form class="contact" method="post" id="forgot_form" action="<?php echo base_url(); ?>compras/filtro/<?php echo $tipo; ?>" >
  <input type="hidden" name="tipo" value="<?php echo $tipo; ?>" id="tipo">     
  <input type="hidden" value="<?php echo $aba; ?>" id="aba">              

    			<fieldset>
		         <div class="modal-body">
		        	 <ul class="nav nav-list">
			   

            <li class="nav-header">Status:</li>
                                <li>
                                    <select name="status" id="status">
                                    <option value="">Todos...</option>   
                                   <option value="<?= ANDAMENTO; ?>" <?= set_select('status',ANDAMENTO); ?>>ANDAMENTO</option>
                                    <!--<option value="<?= APROVADO; ?>" <?= set_select('status',APROVADO); ?>>REALIZADO</option>-->
                                    <option value="<?= FINALIZADO; ?>" <?= set_select('status',FINALIZADO); ?>>FINALIZADO</option>
                                     <option value="<?= CANCELADO; ?>" <?= set_select('status',CANCELADO); ?>>CANCELADO</option>
                                  
                                   </select>     
               
                                </li>
      

        <li class="nav-header">Código Compra:</li>
        <li><input class="input-medium" type="text" name="id_pedido" id="id_pedido"></li>	

        <li class="nav-header">Data De:</li>
				<li><input class="input-medium calendario" type="text" name="data_de" id="data_de"></li>
				<li class="nav-header">Data Até:</li>
				<li><input class="input-medium calendario" type="text" name="data_ate" id="data_ate"></li>
			
				</ul> 
		        </div>
			</fieldset>
			
		
	     <div class="modal-footer">
                  <input type="submit" value="Buscar" class="btn btn-primary" />
	         <!--<button class="btn btn-primary" id="submit">Buscar</button>-->
	         <a href="#" class="btn" data-dismiss="modal">Fechar</a>
  	   </div>
            </form>
	</div>
<!-- FINAL MODAL -->


<div class="pull-right"> 

 <?php $tipo_titulo =  "Compra"; ?>

<a href="<?php echo site_url('compras/filtro/'.PEDIDO); ?>" class="btn btn-small btn-success"><i class="btn-icon-only icon-refresh"></i>Atualizar Página</a>

 <?php echo anchor_popup(site_url('compras/solicitar_fornecedor/'.$tipo),' <button type="button" class="btn btn-small btn-success" id="popup"><i class="btn-icon-only icon-plus-sign"></i>Nova '.$tipo_titulo.'</button>',$janela);?>


<a data-toggle="modal" href="#form-content" class="btn btn-primary btn-small" id="btMostrar"><i class="btn-icon-only icon-search"> </i>Pesquisa avançada</a>



</div>



<div class="row">
  <div class="span12">
      
     
      <div class="widget ">
        <div class="widget-header">
                <i class="icon-shopping-cart"></i>
                
               Compras Listagem
                
                

         
         </div> <!-- /widget-header -->
            <div class="widget-content" id="refresh_tabela">
              <table id="listagemItens" class="table table-striped table-bordered">
                <thead>
                  <tr>
                  
                    <th>DATA</th>
                    <th>
                      <?php if($tipo==PEDIDO){  
                      echo  "COD. COMPRA";
                      $fundoCodigo = "class='btn btn-success'";

                    }else{
                      echo "COD. COMPRA";
                      $fundoCodigo = "class='btn btn-warning'";
                    }
                    ?>

                    </th>
                   
                     <th>VALOR</th>
                    <th>STATUS</th>
                    <th class="td-actions">OPERAÇÕES</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $total = 0;
                  foreach ($listPedidos as $objPedido): 
                   $total_pedido = ( $objPedido->getTotal_Itens() + $objPedido->getTaxa_frete() ) - $objPedido->getDesconto();
                  ?>
                  <tr>
                 
                  <td><?php echo $objDateFormat->date_format_pedido($objPedido->getData_inicio()); ?></td>
                   <td><span <?php echo $fundoCodigo; ?> ><?php echo $objPedido->getId_pedido(); ?></span></td>
                 
                  <td><?php echo number_format( ($objPedido->getTotal_Itens() + $objPedido->getTaxa_frete() ) - $objPedido->getDesconto(), 2, ',', '.');  ?> </td>
                                
                  <td> <a href="<?php echo site_url('compras/visualizar/'.$objPedido->getId_pedido()); ?>" target="__blank"><?php echo $objPedido->printStatus(); ?></a></td>
                  
                  <td class="td-actions">
                 
                         <?php echo anchor_popup(site_url('compras/visualizar/'.$objPedido->getId_pedido()),'<span class="btn btn-success btn-small"><i class="btn-icon-only icon-list-alt"></i><strong>Visualizar Compra</strong></span>',$janela);?>
                   
                     <a href="#" class="confirm-delete btn btn-danger btn-small" data-id="<?php echo $objPedido->getId_pedido(); ?>"><i class="btn-icon-only icon-remove"> </i>Cancelar</a>
                    
                     
                   </td>
                    
                  </tr>
                  
                  <?php endforeach;?>
                  
                                  
                </tbody>
                
                <tfoot>
                  <tr>
                  
                      <th>DATA</th>
                    <th> CÓDIGO COMPRA</th>
                   
                    <th>VALOR</th>
                    <th>STATUS</th>
                    <th class="td-actions">OPERAÇÕES</th>
                  </tr>
                </tfoot>
              </table>

            
           <?php if($listPedidos==null):?> 
           <div class="alert alert-success">
               <!--   <button type="button" class="close" data-dismiss="alert">&times;</button>-->
                    <strong>Nenhum <?php echo ($tipo==ORCAMENTO)?"Orçamento":"Venda"; ?> encontrado!</strong>
    
            </div>
            <?php endif; ?>
            
            </div>
                </div>
                
                
                
                <div id="myModal" class="modal hide">
 

    <div class="modal-header">
        <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
         <h3>Informar Senha Administrador</h3>
    </div>
    <div class="modal-body">
          <form class="contact" method="post" action="<?php echo base_url(); ?>compras/cancelar/"; >
   <input type="hidden" id="id_pedido_cancelar" name="id_pedido_cancelar" value="<?php echo set_value('id_pedido_cancelar')?>"> 
        <ul class="nav nav-list">
           <li class="nav-header">Senha Administrador:</li>
            <li><input class="input-medium" type="password" name="senha" id="senha"></li>
        </ul>
    

    </div>
    


   <div class="modal-footer">
                  <input type="submit" value="Confirmar" class="btn btn-primary" />
           <!--<button class="btn btn-primary" id="submit">Buscar</button>-->
           <a href="#" class="btn" data-dismiss="modal">Fechar</a>
       </div>
                
                
                </form>
                
                               
                    </div> <!-- /widget-content -->
                        </div> <!-- /widget -->
                        

                
                        
                    
<script type="text/javascript">


$(function () {


$('#myModal').on('show', function() {
    var id = $(this).data('id'),
        removeBtn = $(this).find('.danger');
});

$(document).on('click', '.confirm-delete', function(e) {

    e.preventDefault();

    var id = $(this).data('id');

    $('#myModal').data('id', id).modal('show');
    $('#id_pedido_cancelar').val(id);
    


});

$('#btnYes').click(function() {
    // handle deletion here
  	var id = $('#myModal').data('id');
   
  	$('[data-id='+id+']').remove();
  	$('#myModal').modal('hide');
  	location.href="<?php echo site_url('compras/cancelar'); ?>/"+id;
  	
});

});

</script>      


                       

