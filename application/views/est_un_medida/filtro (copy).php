<!-- modal filtro avançado -->	
	<div id="form-content" class="modal hide fade in" style="display: none; ">
	        <div class="modal-header">
	              <a class="close" data-dismiss="modal">×</a>
                      <h3><i class="btn-icon-only icon-search"> </i>Pesquisa Avançada</h3>
	        </div>
		
			<!--<form class="contact">-->
                        
                        <form class="contact" method="post" id="forgot_form" action="<?php echo base_url(); ?>est_un_medida/filtro/">
                

    			<fieldset>
		         <div class="modal-body">
		        	 <ul class="nav nav-list">
				<li class="nav-header">Unidade de Medida</li>
				<li><input class="input-xlarge" type="text" name="unidade" id="unidade"></li>
				<li class="nav-header">Sigla</li>
				<li><input class="input-xlarge" type="text" name="sigla" id="sigla"></li>
				
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
<a href="<?php echo site_url('est_un_medida/cadastrar'); ?>" class="btn btn-small btn-success"><i class="btn-icon-only icon-ok"></i>Novo Unidade de Medida</a>
<a data-toggle="modal" href="#form-content" class="btn btn-primary btn-small" id="btMostrar"><i class="btn-icon-only icon-search"> </i>Pesquisa avançada</a>

</div>


<div class="row">
  <div class="span12">
      
     <div class="widget ">
        <div class="widget-header">
                <i class="icon-edit"></i>
                <h3>Unidade Medida Listagem</h3>
         </div> <!-- /widget-header -->
            <div class="widget-content">
              <table id="listagemDados" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th width="20%">CÓDIGO UNIDADE</th>
                    <th>UNIDADE</th>
                      <th>SIGLA</th>
                    <th class="td-actions">OPERAÇÕES</th>
                  </tr>
                </thead>
                
                <tfoot>
                    <tr>
                    <th>CÓDIGO UNIDADE</th>
                    <th>UNIDADE</th>
                      <th>SIGLA</th>
                    <th class="td-actions">OPERAÇÕES</th>
                  </tr>
                </tfoot>
                
                <tbody>
                  <?php foreach ($listUnidade as $objUnidade): ?>
                  <tr>
                  <td><?php echo $objUnidade->getId_unidade(); ?></td>
                  <td><?php echo $objUnidade->getUnidade(); ?></td>
                   <td><?php echo $objUnidade->getSigla(); ?></td>
                 <td class="td-actions">
                     <a href="<?php echo site_url('est_un_medida/editar/'.$objUnidade->getId_unidade()); ?>" class="btn btn-small btn-primary"><i class="btn-icon-only icon-pencil"></i>Editar</a>
                     <a href="#" class="confirm-delete btn btn-danger btn-small" data-id="<?php echo $objUnidade->getId_unidade(); ?>"><i class="btn-icon-only icon-remove"> </i>Excluir</a>
                    
                                        </td>
                    
                  </tr>
                  
                  <?php endforeach;?>
                  
                                  
                </tbody>
              </table>

            
           <?php if($listUnidade==null):?> 
           <div class="alert alert-success">
               <!--   <button type="button" class="close" data-dismiss="alert">&times;</button>-->
                    <strong>Nenhuma Unidade de Medida encontrada!</strong> <a href="<?php echo site_url('est_un_medida/cadastrar'); ?>" class="btn btn-small btn-success"><i class="btn-icon-only icon-ok"></i>Novo Unidade de Medida</a>
    
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
  	location.href="<?php echo site_url('est_un_medida/excluir'); ?>/"+id;
  	
});

});

</script>      


        
                  
                       
                        
                        
                        

