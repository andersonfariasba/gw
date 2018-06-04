<?php $objDateFormat = $this->DateFormat; ?>
<!-- modal filtro avançado -->	
	<div id="form-content" class="modal hide fade in" style="display: none; ">
	        <div class="modal-header">
	              <a class="close" data-dismiss="modal">×</a>
                      <h3><i class="btn-icon-only icon-search"> </i>Pesquisa Avançada</h3>
	        </div>
		
			<!--<form class="contact">-->
                        
                        <form class="contact" method="post" id="forgot_form" action="<?php echo base_url(); ?>cartao_credito/filtro/">
                

    			<fieldset>
		         <div class="modal-body">
		        	 <ul class="nav nav-list">
        <li class="nav-header">Descrição:</li>
        <li><input class="input-xlarge" type="text" name="descricao" id="descricao"></li>

				<li class="nav-header">Vencimento De:</li>
				<li><input class="input-medium calendario" type="text" name="data_de" id="data_de"></li>
				<li class="nav-header">Vencimento Até:</li>
				<li><input class="input-medium calendario" type="text" name="data_ate" id="data_ate"></li>
				 <li class="nav-header">Bandeira:</li>
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
                                  <option value="<?= ABERTO; ?>" <?= set_select('status',ABERTO); ?>>ABERTO</option>
                                  <option value="<?= PAGO; ?>" <?= set_select('status',PAGO); ?>>PAGO</option>
                                  
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
<a href="<?php echo site_url('cartao_credito/filtro/'); ?>" class="btn btn-small btn-success"><i class="btn-icon-only icon-refresh"></i>Atualizar Página</a>
<a href="#" class="btn btn-small btn-success"><i class="btn-icon-only icon-ok"></i>Novo Lançamento Cartão de Crédito</a>
<a data-toggle="modal" href="#form-content" class="btn btn-primary btn-small" id="btMostrar"><i class="btn-icon-only icon-search"> </i>Pesquisa avançada</a>
</div>



<div class="row">
  <div class="span12">
      
     
      <div class="widget ">
        <div class="widget-header">
                <i class="icon-credit-card"></i>
                <h3>Cartão de Crédito Lançamentos</h3>
         </div> <!-- /widget-header -->
            <div class="widget-content">
              <table id="listagemItens" class="table table-striped table-bordered">
                <thead>
                  <tr>
                  
                    <th width="100px">DATA TRANSAÇÃO</th>
                    <th width="100px">DATA VENCIMENTO</th>
                    <th width="100px">BANDEIRA</th>
                     <th width="100px">MOTIVO PAGAMENTO</th>
                      <th width="100px">VALOR PARCELA</th>
                       <th width="100px">QTD PARCELA</th>
                        <th width="100px">FORNECEDOR</th>
                        <th>STATUS</th>

                    <th width="300px" class="td-actions">OPERAÇÕES</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $total = 0;
                  foreach ($listLanc as $objLanc): 
                   $total= $total + $objLanc->getValor_parcela();   
                   ?>
                  
                  <?php if( ($objLanc->getData_vencimento() < date('Y-m-d')) and $objLanc->getStatus()==ABERTO ) { ?>
                   <tr class="aberto">
                  <?php } else{ ?>
                  <tr class="">

                  <?php } ?>
                  
                  <td><?php echo $objDateFormat->date_format($objLanc->getData_transacao()); ?></td>
                  <td><?php echo $objDateFormat->date_format($objLanc->getData_vencimento()); ?></td>
                  <td><?php echo $objLanc->getForma()->getForma(); ?></td>
                  <td><?php echo $objLanc->getDescricao(); ?></td>
                  <td><?php echo $objLanc->getValor_parcela(); ?></td>
                   <td><?php echo $objLanc->getQtd_parcela(); ?></td>
                  <td><?php 

                  if($objLanc->getFornecedor()!=null){

                  echo $objLanc->getFornecedor()->getNome_fantasia(); 
                }

                  ?></td>
                 
                   
                   <td><?php echo $objLanc->printStatus(); ?></td>
                  
                  <td class="td-actions">
                     <a href="<?php echo site_url('cartao_credito/editar/'.$objLanc->getId_lanc_cartao()); ?>" class="btn btn-small btn-primary"><i class="btn-icon-only icon-pencil"></i>Editar</a>
                    
                    <!-- <a href="<?php echo site_url('contas_pagar/visualizar/'.$objLanc->getId_lancamento()); ?>" class="btn btn-small"><i class="btn-icon-only icon-list-alt"></i>Visualizar</a>
                     -->
                     <a href="#" class="confirm-delete btn btn-danger btn-small" data-id="<?php echo $objLanc->getId_lanc_cartao(); ?>"><i class="btn-icon-only icon-remove"> </i>Excluir</a>
                    
                     
                   </td>
                    
                  </tr>
                  
                  <?php endforeach;?>
                  
                                  
                </tbody>
                
              <!--  <tfoot>
                  <tr>
                  
                    <th>DATA VENCIMENTO</th>
                    <th>FORNECEDOR</th>
                    <th>DESCRIÇÃO</th>
                    <th><h4><?php echo number_format($total, 2, ',', '.'); ?></h4></th>
                    <th>PARCELA</th>
                     <th>FORMA PAG.</th>
                    <th>STATUS</th>
                    <th class="td-actions">OPERAÇÕES</th>
                  </tr>
                </tfoot>
                -->

              </table>

            
           <?php if($listLanc==null):?> 
           <div class="alert alert-success">
               <!--   <button type="button" class="close" data-dismiss="alert">&times;</button>-->
                    <strong>Nenhum Lançamento encontrado!</strong> <a href="#" class="btn btn-small btn-success"><i class="btn-icon-only icon-ok"></i>Novo Lançamento Cartão de Crédito</a>
    
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
  	location.href="<?php echo site_url('cartao_credito/excluir'); ?>/"+id;
  	
});

});

</script>      


                       

