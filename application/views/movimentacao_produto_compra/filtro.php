<?php $objDateFormat = $this->DateFormat; ?>
<!-- modal filtro avançado -->	
	<div id="form-content" class="modal hide fade in" style="display: none; ">
	        <div class="modal-header">
	              <a class="close" data-dismiss="modal">×</a>
                      <h3><i class="btn-icon-only icon-search"> </i>Pesquisa Avançada</h3>
	        </div>
		
			<!--<form class="contact">-->
                        
        <!--<form class="contact" method="post" id="forgot_form" action="<?php echo base_url(); ?>movimentacao_produto/filtro">
            -->

         <?php echo form_open('movimentacao_produto_compra/filtro',array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
           

    			<fieldset>
		         <div class="modal-body">
		        	 <ul class="nav nav-list">
				<li class="nav-header">De:</li>
				<li><input class="input-medium calendario" type="text" name="data_de" id="data_de"></li>
				<li class="nav-header">Até:</li>
				<li><input class="input-medium calendario" type="text" name="data_ate" id="data_ate"></li>

        <li class="nav-header">Tipo Movimentação:</li>
                                <li>
                                    <select name="tipo_movimentacao" id="status">
                                    <option value="">Todos...</option>   
                                    <option value="<?= ADD_MOV; ?>" <?= set_select('tipo_movimentacao',ADD_MOV); ?>>ENTRADA</option>
                                    <option value="<?= REMOVER_MOV; ?>" <?= set_select('tipo_movimentacao',REMOVER_MOV); ?>>SAÍDA</option>
                                    </select>     
               
                                </li>
      
				 <!--  <li class="nav-header">Tipo Movimentação:</li>
         

           <li>                   
				 <label class="radio inline">
                                     
                                     <label class="radio inline">
                    <input type="radio" name="tipo_movimentacao" checked="" value=""> <span style="font-weight:bold">Ambos</span>
                </label>
                          <label class="radio inline">            
                    <input type="radio"  name="tipo_movimentacao" value="<?php echo set_value('tipo_movimentacao','1')?>"> <span style="color:green;font-weight:bold">Entrada</span>
                </label>

                <label class="radio inline">
                    <input type="radio" name="tipo_movimentacao" value="<?php echo set_value('tipo_movimentacao','2')?>"> <span style="color:red;font-weight:bold">Saída</span>
                </label>
               </li>                 
             -->                   
                                
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
<a href="<?php echo site_url('movimentacao_produto/cadastrar_pela_mov'); ?>" class="btn btn-small btn-success"><i class="btn-icon-only icon-plus"></i>Movimentar Quantidade do Estoque</a>
<a data-toggle="modal" href="#form-content" class="btn btn-primary btn-small"><i class="btn-icon-only icon-search"> </i>Pesquisa avançada</a>

</div>


<div class="row">
  <div class="span12">
      
     <div class="widget ">
        <div class="widget-header">
                <i class="icon-retweet"></i>
                <h3>Movimentação Produto de Compras</h3>
         </div> <!-- /widget-header -->
            <div class="widget-content">
              <table id="listagemItens" class="table table-striped table-bordered">
                <thead>
                  <tr>
                  <th>DATA</th>
                  <th>PRODUTO</th>
                  <th>CÓDIGO</th>
                  <th align="center">MOVIMENTAÇÃO</th>
                  <th>QTD</th>
                  <th class="td-actions">OPERAÇÕES</th>
                 
                  </tr>
                </thead>
                <tfoot>
                    <tr>
                  <th>DATA</th>
                  <th>PRODUTO</th>
                  <th>CÓDIGO</th>
                  <th align="center">MOVIMENTAÇÃO</th>
                  <th>QTD</th>
                  <th class="td-actions">OPERAÇÕES</th>
                 
                  </tr>
                </tfoot>
                <tbody>
                  <?php foreach ($listMov as $objMov): ?>
                  <tr>
                  <td><?php echo $objDateFormat->date_format_pedido($objMov->getData()); ?></td>
                  <td><?php echo $objMov->getProduto()->getDescricao(); ?></td>
                  <td><?php echo $objMov->getProduto()->getCodigo();?></td>
                  <td align="center"><?php echo $objMov->printMovimentacao();?></td>
                  <td><?php echo $objMov->getQtd_mov();?></td>
                  <td><a href="<?php echo site_url('movimentacao_produto/visualizar/'.$objMov->getId_movimentacao()); ?>" class="btn btn-small"><i class="btn-icon-only icon-list-alt"></i>Visualizar</a></td>

               
                    
                  </tr>
                  
                  <?php endforeach;?>
                  
                                  
                </tbody>
              </table>

            
           <?php if($listMov==null):?> 
           <div class="alert alert-success">
               <!--   <button type="button" class="close" data-dismiss="alert">&times;</button>-->
                    <strong>Nenhuma movimentação encontrada para a pesquisa!</strong>    
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
  	location.href="<?php echo site_url('produtos/excluir'); ?>/"+id;
  	
});

});

</script>      


                  
                       
                        
                        
                        

