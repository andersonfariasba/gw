<!-- modal filtro avançado -->	
	<div id="form-content" class="modal hide fade in" style="display: none; ">
	        <div class="modal-header">
	              <a class="close" data-dismiss="modal">×</a>
                      <h3><i class="btn-icon-only icon-search"> </i>Pesquisa Avançada</h3>
	        </div>
		
			<!--<form class="contact">-->
                        
                        <form class="contact" method="post" id="forgot_form" action="<?php echo base_url(); ?>rh_colaboradores/filtro/">
                

    			<fieldset>
		         <div class="modal-body">
		        	 <ul class="nav nav-list">
				<li class="nav-header">Nome:</li>
				<li><input class="input-xlarge" type="text" name="nome" id="nome"></li>
				<li class="nav-header">Cargo:</li>
                                <li>
                                    <select name="id_cargo" id="id_cargo">
                                        <option value="">Selecione...</option>
                                         <?php foreach ($listCargo as $objCargo): ?>
                                        <option value="<?php echo $objCargo->getId_cargo(); ?>" <?php echo set_select('id_cargo',$objCargo->getId_cargo()); ?>>
                                           <?php echo $objCargo->getCargo(); ?>
                                        </option>
                                         <?php endforeach; ?>
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
<a href="<?php echo site_url('rh_colaboradores/cadastrar'); ?>" class="btn btn-small btn-success"><i class="btn-icon-only icon-ok"></i>Novo Funcionário</a>
<a data-toggle="modal" href="#form-content" class="btn btn-primary btn-small" id="btMostrar"><i class="btn-icon-only icon-search"> </i>Pesquisa avançada</a>
</div>


<div class="row">
  <div class="span12">
      
     <div class="widget ">
        <div class="widget-header">
                <i class="icon-group"></i>
                <h3>Funcionário Listagem</h3>
         </div> <!-- /widget-header -->
            <div class="widget-content">
              <table id="listagemDados" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th width="100px">CÓDIGO</th>
                    <th>NOME</th>
                    <th>CARGO</th>
                    <th>CELULAR</th>
                    <th>STATUS</th>
                    <th class="td-actions">OPERAÇÕES</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($listColaborador as $objColaborador): ?>
                  <tr>
                  <td><?php echo $objColaborador->getId_colaborador(); ?></td>
                  <td><?php echo $objColaborador->getNome(); ?></td>
                  <td><?php echo $objColaborador->getCargo()->getCargo(); ?></td>
                  <td><?php echo $objColaborador->getCelular1(); ?></td>
                   <td><?php echo $objColaborador->printStatus(); ?></td>
                  
                  <td class="td-actions">
                     <a href="<?php echo site_url('rh_colaboradores/editar/'.$objColaborador->getId_colaborador()); ?>" class="btn btn-small btn-primary"><i class="btn-icon-only icon-pencil"></i>Editar</a>
                     <a href="<?php echo site_url('rh_colaboradores/visualizar/'.$objColaborador->getId_colaborador()); ?>" class="btn btn-small"><i class="btn-icon-only icon-list-alt"></i>Visualizar</a>
                      <a href="#" class="confirm-delete btn btn-danger btn-small" data-id="<?php echo $objColaborador->getId_colaborador(); ?>"><i class="btn-icon-only icon-remove"> </i>Excluir</a>
                    
                     
                   </td>
                    
                  </tr>
                  
                  <?php endforeach;?>
                  
                                  
                </tbody>
              </table>

            
           <?php if($listColaborador==null):?> 
           <div class="alert alert-success">
               <!--   <button type="button" class="close" data-dismiss="alert">&times;</button>-->
                    <strong>Nenhum Funcionário encontrado!</strong> <a href="<?php echo site_url('rh_colaboradores/cadastrar'); ?>" class="btn btn-small btn-success"><i class="btn-icon-only icon-ok"></i>Novo Funcionário</a>
    
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
  	location.href="<?php echo site_url('rh_colaboradores/excluir'); ?>/"+id;
  	
});

});

</script>      


                      
                        
                        
                        

