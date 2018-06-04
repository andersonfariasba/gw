<!-- modal filtro avançado -->	
	<div id="form-content" class="modal hide fade in" style="display: none; ">
	        <div class="modal-header">
	              <a class="close" data-dismiss="modal">×</a>
                      <h3><i class="btn-icon-only icon-search"> </i>Pesquisa Avançada (Fornecedor)</h3>
	        </div>
		
			<!--<form class="contact">-->
                        
                        <form class="contact" method="post" id="forgot_form" action="<?php echo base_url(); ?>fornecedores/filtro">
                

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
                
               <button type="submit" class="btn btn-primary" id="salvar_orcamento">
                <i class="icon-search icon-white"></i> Buscar
               </button>
       
           <a href="#" class="btn" data-dismiss="modal"><i class="icon-remove icon-white"></i> Fechar</a>
  	   </div>
            </form>
	</div>
<!-- FINAL MODAL -->
                    

<div class="pull-right"> 
<a href="<?php echo site_url('fornecedores/cadastrar'); ?>" class="btn btn-small btn-success"><i class="btn-icon-only icon-ok"></i>Novo Fornecedor</a>
<a data-toggle="modal" href="#form-content" class="btn btn-primary btn-small" id="btMostrar"><i class="btn-icon-only icon-search"> </i>Pesquisa avançada</a>
</div>



<div class="row">
  <div class="span12">
      
     <div class="widget ">
        <div class="widget-header">
                <i class="icon-briefcase"></i>
                <h3>Fornecedores Listagem</h3><div id="thanks"></div>
         </div> <!-- /widget-header -->
         <div class="widget-content">
              <table id="listagemDados" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    
                    <th>FORNECEDOR</th>
                    <th>CNPJ / CPF</th>
                    <th>TELEFONE</th>
                    <th>STATUS</th>
                    <th class="td-actions">OPERAÇÕES</th>
                    <th>PDF</th>
                  </tr>
                </thead>
                
                <tfoot>
                  <tr>
                   
                    <th>FORNECEDOR</th>
                    <th>CNPJ / CPF</th>
                    <th>TELEFONE</th>
                    <th>STATUS</th>
                    <th class="td-actions">OPERAÇÕES</th>
                    <th>PDF</th>
                  </tr>
                </tfoot>
                
                <tbody>
                  <?php foreach ($listFornecedor as $objFornecedor): ?>
                  <tr>
                 
                  <td><?php echo $objFornecedor->getNome_fantasia(); ?></td>
                  <td><?php echo $objFornecedor->getCnpj_cpf(); ?></td>
                  <td><?php echo $objFornecedor->getTelefone1(); ?></td>
                   <td><?php echo $objFornecedor->printStatus(); ?></td>
                  
                  <td class="td-actions">
                     <a href="<?php echo site_url('fornecedores/editar/'.$objFornecedor->getId_fornecedor()); ?>" class="btn btn-small btn-primary"><i class="btn-icon-only icon-pencil"></i>Editar</a>
                     <a href="<?php echo site_url('fornecedores/visualizar/'.$objFornecedor->getId_fornecedor()); ?>" class="btn btn-small"><i class="btn-icon-only icon-list-alt"></i>Visualizar</a>
                     <a href="#" class="confirm-delete btn btn-danger btn-small" data-id="<?php echo $objFornecedor->getId_fornecedor(); ?>"><i class="btn-icon-only icon-remove"> </i>Excluir</a>
                    
                     
                   </td>
                   
                   <td> 
                       <a href="<?php echo site_url('fornecedores/pdf/'.$objFornecedor->getId_fornecedor()); ?>" target="_blank"><img src="<?php echo base_url()."/img/pdf.png"?>" title="Imprimir" width="30px" border="0"></a>
                   </td>
                   
                    
                  </tr>
                  
                  <?php endforeach;?>
                  
                                  
                </tbody>
              </table>

            
           <?php if($listFornecedor==null):?> 
           <div class="alert alert-success">
               <!--   <button type="button" class="close" data-dismiss="alert">&times;</button>-->
                    <strong>Nenhum Fornecedor encontrado!</strong> <a href="<?php echo site_url('fornecedores/cadastrar'); ?>" class="btn btn-small btn-success"><i class="btn-icon-only icon-ok"></i>Novo Fornecedor</a>
    
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
  	location.href="<?php echo site_url('fornecedores/excluir'); ?>/"+id;
  	
});

});

</script>      

                 
                       
                        
                        
                        

