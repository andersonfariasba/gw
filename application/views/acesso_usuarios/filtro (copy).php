<!-- modal filtro avançado -->	
	<div id="form-content" class="modal hide fade in" style="display: none; ">
	        <div class="modal-header">
	              <a class="close" data-dismiss="modal">×</a>
                      <h3><i class="btn-icon-only icon-search"> </i>Pesquisa Avançada</h3>
	        </div>
		
			<!--<form class="contact">-->
                        
                        <form class="contact" method="post" id="forgot_form" action="<?php echo base_url(); ?>acesso_usuarios/filtro/">
                

    			<fieldset>
		         <div class="modal-body">
		        	 <ul class="nav nav-list">
        <li class="nav-header">Perfil:</li>
        <li>
          <select name="id_perfil" id="id_perfil">
                        <option value="">Selecione...</option>
                         <?php foreach ($listPerfil as $objPerfil): ?>
                        <option value="<?php echo $objPerfil->getId_perfil(); ?>" <?php echo set_select('id_perfil',$objPerfil->getId_perfil()); ?>>
                           <?php echo $objPerfil->getPerfil(); ?>
                        </option>
                         <?php endforeach; ?>
                    </select>
        </li>       
				<li class="nav-header">Login:</li>
				<li><input class="input-xlarge" type="text" name="login" id="login"></li>
				
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
<a href="<?php echo site_url('acesso_usuarios/cadastrar'); ?>" class="btn btn-small btn-success"><i class="btn-icon-only icon-ok"></i>Novo Usuário</a>
<a data-toggle="modal" href="#form-content" class="btn btn-primary btn-small" id="btMostrar"><i class="btn-icon-only icon-search"> </i>Pesquisa avançada</a>
</div>


<div class="row">
  <div class="span12">
      
     <div class="widget ">
        <div class="widget-header">
                <i class="icon-user"></i>
                <h3>Usuário Listagem</h3>
         </div> <!-- /widget-header -->
            <div class="widget-content">
              <table id="listagemDados" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th width="100px">CÓDIGO USUÁRIO</th>
                    <th>LOGIN</th>
                    <th>COLABORADOR</th>
                    <th>PERFIL</th>
                    <th>STATUS</th>
                    
                    
                    <th class="td-actions">OPERAÇÕES</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($listUser as $objUser): ?>
                  <tr>
                  <td><?php echo $objUser->getId_usuario(); ?></td>
                  <td><?php echo $objUser->getLogin(); ?></td>
                    <td><?php echo $objUser->getColaborador()->getNome(); ?></td>
                  <td><?php echo $objUser->getPerfil()->getPerfil(); ?></td>
                  <td><?php echo $objUser->printStatus(); ?></td>
                  
                  <td class="td-actions">
                     <a href="<?php echo site_url('acesso_usuarios/editar/'.$objUser->getId_usuario()); ?>" class="btn btn-small btn-primary"><i class="btn-icon-only icon-pencil"></i>Editar</a>
                   
                     <?php if($objUser->getId_usuario()!=CODIGO_ADMINISTRADOR){ ?>
                         <a href="#" class="confirm-delete btn btn-danger btn-small" data-id="<?php echo $objUser->getId_usuario(); ?>"><i class="btn-icon-only icon-remove"> </i>Excluir</a>
                     <?php } ?>
                     
                   </td>
                    
                  </tr>
                  
                  <?php endforeach;?>
                  
                                  
                </tbody>
              </table>

            
           <?php if($listUser==null):?> 
           <div class="alert alert-success">
               <!--   <button type="button" class="close" data-dismiss="alert">&times;</button>-->
                    <strong>Nenhum Usuário encontrado!</strong> <a href="<?php echo site_url('acesso_usuarios/cadastrar'); ?>" class="btn btn-small btn-success"><i class="btn-icon-only icon-ok"></i>Novo Usuário</a>
    
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
  	location.href="<?php echo site_url('acesso_usuarios/excluir'); ?>/"+id;
  	
});

});

</script>      


                 
                       
                        
                        
                        

