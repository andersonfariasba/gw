<?php $objDateFormat = $this->DateFormat; ?>
<!-- modal filtro avançado -->	
	<div id="form-content" class="modal hide fade in" style="display: none; ">
	        <div class="modal-header">
	              <a class="close" data-dismiss="modal">×</a>
                      <h3><i class="btn-icon-only icon-search"> </i>Pesquisa Avançada</h3>
	        </div>
		
			<!--<form class="contact">-->
                        
                        <form class="contact" method="post" id="forgot_form" action="<?php echo base_url(); ?>contas_receber/filtro/">
                

    			<fieldset>
		         <div class="modal-body">
		        	 <ul class="nav nav-list">
        <li class="nav-header">Venda Nº:</li>
        <li><input class="input-medium" type="text" name="id_pedido" id="id_pedido"></li>
				<li class="nav-header">Vencimento De:</li>
				<li><input class="input-medium calendario" type="text" name="data_de" id="data_de"></li>
				<li class="nav-header">Vencimento Até:</li>
				<li><input class="input-medium calendario" type="text" name="data_ate" id="data_ate"></li>
				
         <li class="nav-header">Forma de Pagamento:</li>
                <li>
                <select name="id_forma" id="id_forma" style="width:220px;">
                        <option value="">Todos...</option>
                         <?php foreach ($listForma as $objForma):   ?>
                           
                        <option value="<?php echo $objForma->getId_forma(); ?>" <?php echo set_select('id_forma',$objForma->getId_forma()); ?>>
                           <?php echo $objForma->getForma(); ?>
                        </option>
                         <?php endforeach; ?>
                </select>
                </li>

        <li class="nav-header">Status:</li>
                                <li>
                                    <select name="status" id="status">
                                     <option value="">Todos...</option>   
                                     <option value="<?= ABERTO; ?>" <?= set_select('status',ABERTO); ?>>AGUARDANDO</option>
                                     <option value="<?= PAGO; ?>" <?= set_select('status',PAGO); ?>>APROVADO</option>
                                     <option value="<?= CANCELADO; ?>" <?= set_select('status',CANCELADO); ?>>CANCELADO</option>
                                   </select>     
               
                                </li>
				</ul> 
		        </div>
			</fieldset>
			
		
	     <div class="modal-footer">
                 <button type="submit" class="btn btn-primary" id="salvar_orcamento">
                <i class="icon-search icon-white"></i> Buscar
               </button>
       
           <a href="#" class="btn" data-dismiss="modal"><i class="icon-remove icon-white"></i> Fechar</a>
  	   </div>
            </form>
	</div>
<!-- FINAL MODAL -->


<div class="pull-right"> 
<a href="<?php echo site_url('contas_receber/filtro/'); ?>" class="btn btn-small btn-success"><i class="btn-icon-only icon-refresh"></i>Atualizar Página</a>
<a data-toggle="modal" href="#form-content" class="btn btn-primary btn-small" id="btMostrar"><i class="btn-icon-only icon-search"> </i>Pesquisa avançada</a>
</div>



<div class="row">
  <div class="span12">
      
     
      <div class="widget ">
        <div class="widget-header">
                <i class="icon-money"></i>
                <h3>Contas a Receber Listagem</h3>
         </div> <!-- /widget-header -->
            <div class="widget-content">
              <table id="listagemItens" class="table table-striped table-bordered">
                <thead>
                  <tr>
                  
                    <th>DATA VENCIMENTO</th>
                    <th>CLIENTE</th>
                    <th>VENDA</th>
                    <th>VALOR TITULO</th>
                    <th width="50px">PARCELA</th>
                    <th>FORMA PAGAMENTO</th>
                    <th>STATUS</th>
                    <th class="td-actions">OPERAÇÕES</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $total = 0;
                  foreach ($listLanc as $objLanc): 
                   $total+=$objLanc->getValor_titulo();   
                   ?>
                  
                  <?php //if( ($objLanc->getData_vencimento() < date('Y-m-d')) and $objLanc->getStatus()==ABERTO ) { ?>
                   <!--<tr class="aberto">-->
                  <?php //} else{ ?>
                  <tr class="">

                  <?php //} ?>
                  
                  <td><?php echo $objDateFormat->date_format($objLanc->getData_vencimento()); ?></td>
                  <td><?php echo $objLanc->getConta()->getCliente()->getNome_fantasia(); ?></td>
                  <td><?php echo $objLanc->getConta()->getId_pedido(); ?></td>
                   <td><?php echo number_format($objLanc->getValor_titulo(), 2, ',', '.'); ?></td>
                  <td>
                  <?php echo $objLanc->getParcela()." / ".$objLanc->getConta()->getParcela_qtd(); ?>
                 
                  </td>
                  <td><?php 
                  if($objLanc->getForma()!=null){
                    echo $objLanc->getForma()->getForma(); 
                   }

                  ?>

                  </td>
                  <td><?php echo $objLanc->printStatusReceber(); ?></td>
                  
                  <td class="td-actions">
                     <a href="<?php echo site_url('contas_receber/editar/'.$objLanc->getId_lancamento()); ?>" class="btn btn-small btn-primary"><i class="btn-icon-only icon-pencil"></i>Visualizar</a>
                     
                     <!--<a href="<?php echo site_url('contas_receber/visualizar/'.$objLanc->getId_lancamento()); ?>" class="btn btn-small"><i class="btn-icon-only icon-list-alt"></i>Visualizar</a>
                     -->
                    <!--
                     <a href="#" class="confirm-delete btn btn-danger btn-small" data-id="<?php echo $objLanc->getId_lancamento(); ?>"><i class="btn-icon-only icon-remove"> </i>Excluir</a>
                    -->
                     
                   </td>
                    
                  </tr>
                  
                  <?php endforeach;?>
                  
                                  
                </tbody>
                
                <tfoot>
                  <tr>
                  
                    <th>DATA VENCIMENTO</th>
                    <th>CLIENTE</th>
                    <th>VENDA</th>
                    <th><h4><?php echo number_format($total, 2, ',', '.'); ?></h4></th>
                    <th>PARCELA</th>
                      <th>FORMA PAGAMENTO</th>
                    <th>STATUS</th>
                    <th class="td-actions">OPERAÇÕES</th>
                  </tr>
                </tfoot>
              </table>

            
           <?php if($listLanc==null):?> 
           <div class="alert alert-success">
               <!--   <button type="button" class="close" data-dismiss="alert">&times;</button>-->
                    <strong>Nenhuma Conta a Receber encontrada!</strong> 
    
            </div>
            <?php endif; ?>
            
            </div>
                </div>
                
                
                
                <div id="myModal" class="modal hide">
    <div class="modal-header">
        <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
         <h3>Excluir</h3>
    </div>
    <div class="modal-body">
        
        <p>Deseja realmente excluir o registro?</p>
    </div>
    <div class="modal-footer">
      <a href="#" id="btnYes" class="btn btn-danger">Confirmar exclusão</a>
      <a href="#" data-dismiss="modal" aria-hidden="true" class="btn secondary">Cancelar</a>
    </div>
                
                
                
                
                               
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
});

$('#btnYes').click(function() {
    // handle deletion here
  	var id = $('#myModal').data('id');
  	$('[data-id='+id+']').remove();
  	$('#myModal').modal('hide');
  	location.href="<?php echo site_url('contas_pagar/excluir'); ?>/"+id;
  	
});

});

</script>      


                       

