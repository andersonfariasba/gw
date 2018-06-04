<!-- modal filtro avançado -->	
	<div id="form-content" class="modal hide fade in" style="display: none; ">
	        <div class="modal-header">
	              <a class="close" data-dismiss="modal">×</a>
                      <h3><i class="btn-icon-only icon-search"> </i>Pesquisa Avançada (Filiais)</h3>
	        </div>
		
			<!--<form class="contact">-->
                        
                        <form class="contact" method="post" id="forgot_form" action="<?php echo base_url(); ?>clientes/filtro">
                

    			<fieldset>
		         <div class="modal-body">
		        	 <ul class="nav nav-list">
    

           <li class="nav-header">TIPO:</li>
                                <li>
                                  <select name="tipo" id="tipo">
                                      <option value="">Todos</option>
                                    <option value="<?= PESSOA_JURIDICA; ?>" <?= set_select('tipo',PESSOA_JURIDICA); ?>>Pessoa Juridica</option>
                                    <option value="<?= PESSOA_FISICA; ?>" <?= set_select('tipo',PESSOA_FISICA); ?>>Pessoa Física</option>
                                  </select>
                   
          </li>

          
				<li class="nav-header">Nome Fantasia</li>
				<li><input class="input-xlarge" type="text" name="nome_fantasia" id="nome_fantasia"></li>
				<li class="nav-header">CNPJ / CPF</li>
				<li><input class="input-xlarge" type="text" name="cnpj_cpf" id="cnpj_cpf"></li>
                                <li class="nav-header">STATUS:</li>
                                <li>
                                  <select name="status" id="status">
                                      <option value="">Todos</option>
                                    <option value="<?= ATIVO; ?>" <?= set_select('status',ATIVO); ?>>ATIVO</option>
                                    <option value="<?= BLOQUEADO; ?>" <?= set_select('status',BLOQUEADO); ?>>BLOQUEADO</option>
                                  </select>
                   
                                    
                                </li>
				
				
				</ul> 
		        </div>
			</fieldset>
			
		
	     <div class="modal-footer">
            <!--<input type="submit" value="Buscar" class="btn btn-primary" />
            -->

               <button type="submit" class="btn btn-primary" id="salvar_orcamento">
                <i class="icon-search icon-white"></i> Buscar
               </button>
	     
	         <a href="#" class="btn" data-dismiss="modal"><i class="icon-remove icon-white"></i> Fechar</a>
  	   </div>
            </form>
	</div>
<!-- FINAL MODAL -->
                    

<div class="pull-right"> 
<a href="<?php echo site_url('filiais/cadastrar'); ?>" class="btn btn-small btn-success"><i class="btn-icon-only icon-plus"></i>Nova Filial</a>
<a data-toggle="modal" href="#form-content" class="btn btn-primary btn-small" id="btMostrar"><i class="btn-icon-only icon-search"> </i>Pesquisa avançada</a>

</div>



<div class="row">
  <div class="span12">
      
     <div class="widget ">
        <div class="widget-header">
                <i class="icon-group"></i>
                <h3>Filiais Listagem</h3><div id="thanks"></div>
         </div> <!-- /widget-header -->
         <div class="widget-content">
              <table id="listagemDados" class="table table-striped table-bordered">
                <thead>
                  <tr>
                   
                    <th>FILIAL</th>
                    <th>CNPJ</th>
                    <th>STATUS</th>
                    <th class="td-actions">OPERAÇÕES</th>
                 
                  </tr>
                </thead>
                
                <tfoot>
                  <tr>
                   
                    <th>FILIAL</th>
                    <th>CNPJ</th>
                    <th>STATUS</th>
                    <th class="td-actions">OPERAÇÕES</th>
                
                  </tr>
                </tfoot>
                
                <tbody>
                  <?php foreach ($listCliente as $objCliente): ?>
                  <tr>
                 
                  <td><?php echo $objCliente->getNome_fantasia(); ?></td>
                  <td><?php echo $objCliente->getCnpj_cpf(); ?></td>
                  <td><?php echo $objCliente->printStatus(); ?></td>
                  
                  <td class="td-actions">
                     <a href="<?php echo site_url('filiais/editar/'.$objCliente->getId_filial()); ?>" class="btn btn-small btn-primary"><i class="btn-icon-only icon-edit"></i>Editar</a>
                    <!-- <a href="<?php echo site_url('filiais/visualizar/'.$objCliente->getId_filial()); ?>" class="btn btn-small"><i class="btn-icon-only icon-list-alt"></i>Visualizar</a>
                     -->
                     <?php if($objCliente->getId_filial()!=PAD_CAD_FILIAL){ ?>
                      <a href="#" class="confirm-delete btn btn-danger btn-small" data-id="<?php echo $objCliente->getId_filial(); ?>"><i class="btn-icon-only icon-remove"> </i>Excluir</a>
                     <?php } ?>
                   </td>
                  
                 
                   
                  </tr>
                  
                  <?php endforeach;?>
                  
                                  
                </tbody>
              </table>

            
           <?php if($listCliente==null):?> 
           <div class="alert alert-success">
               <!--   <button type="button" class="close" data-dismiss="alert">&times;</button>-->
                    <strong>Nenhuma Filial encontrada!</strong> <a href="<?php echo site_url('filiais/cadastrar'); ?>" class="btn btn-small btn-success"><i class="btn-icon-only icon-ok"></i>Nova Filial</a>
    
            </div>
            <?php endif; ?>
            
            </div>
                </div>
                
                
   <!-- MODAL EXCLUIR -->             
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
                
 </div> 
   <!-- FINAL MODAL EXCLUIR -->
   <!-- /widget-content -->
  
  </div> <!-- /widget -->
                        
                        
                        

            
                        
                    
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
  	$('[data-id='+id+']').remove();
  	$('#myModal').modal('hide');
  	location.href="<?php echo site_url('filiais/excluir'); ?>/"+id;
  	
});

});

</script>      

                 
                       
                        
                        
                        

