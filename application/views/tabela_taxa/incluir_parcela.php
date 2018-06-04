<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">

				<div class="x_title">
					<h2>Cadastrar Tabela Taxa</h2>
					<ul class="nav navbar-right panel_toolbox">
					 <li><a href="<?php echo site_url('tabela_taxa/filtro'); ?>"><i class="fa fa-search"></i> <strong>Pesquisar</strong></a></li>
          
        
          
          <li><a href="<?php echo site_url('formas_recebimentos/filtro'); ?>"><i class="fa fa-bars"></i> <strong>Formas de Recebimento</strong></a></li>

					</ul>                     
					<div class="clearfix"></div>
				</div>

				<!-- ********* INICIO MIOLO **********-->
				<div class="x_content"> <!-- INICIO MIOLO-->

					<?php if($msg==true){ ?>
					<div class="alert alert-success alert-dismissible fade in" role="alert"  id="msgOk">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
						</button>
						<strong><i class="fa fa-check"></i> Cadastro realizado com sucesso!</strong>
					</div>
					<?php } ?>

			  		<?php echo validation_errors(); ?>

			  	  <?php echo form_open('tabela_taxa/incluir_parcela/'.$objTabNome->getId_tabela_nome(),array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>

			  	  <input type="hidden" class="form-control" name="id_tabela_nome" id="id_tabela_nome" value="<?php echo set_value('nome',$objTabNome->getId_tabela_nome())?>" maxlength="50"/>

					<div class="form-group">
						
						<div class="col-md-11 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Nome da Tabela</label>
							<input type="text" class="form-control" disabled value="<?php echo set_value('nome',$objTabNome->getNome())?>" maxlength="50"/>
						</div>

					</div>


					<div class="form-group">
						
						<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Parcela De</label>
							<input type="text" class="form-control" name="parcela_inicio" value="<?php echo set_value('nome')?>" maxlength="50" onkeypress='return SomenteNumero(event)'/>
						</div>

						<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Parcela Até </label>
							<input type="text" class="form-control" name="parcela_fim" value="<?php echo set_value('nome')?>" maxlength="50" onkeypress='return SomenteNumero(event)'/>
						</div>

						<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Taxa(%)</label>
							<input type="text" class="form-control" tipo="moneyReal" name="taxa" value="<?php echo set_value('nome')?>" maxlength="50"/>
						</div>

						<div class="col-md-2 col-sm-6 col-xs-6 form-group has-feedback">
							<label>&nbsp;</label>
							<button type="submit" class="form-control btn btn-success"> <i class="fa fa-check"></i> Incluir</button>
						</div>

					</div>




						<div class="ln_solid"></div>


						 <div class="x_content"> <!-- INICIO MIOLO-->

          <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
               <tr class="fundoTituloTabela">
                  <th>PARCELA DE</th>
                  <th>PARCELA ATÉ</th>
                  <th>TAXA</th>
                <th>OPERAÇÕES</th>
              </tr>
            </thead>

            <tbody>
               <?php foreach ($listTab as $objTab): ?>
                 <tr class="dadosTabela">

                  <td><?php echo $objTab->getParcela_inicio(); ?></td>
                  <td><?php echo $objTab->getParcela_fim(); ?></td>
                  <td><?php echo $objTab->getTaxa(); ?></td>
                  <td class="td-actions">
                  <!--<a href="<?php echo site_url('/editar/'.$objTab->getId_tabela_taxa()); ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Editar</a>-->
                  <a href="#" class="confirm-delete btn btn-danger btn-sm" data-id="<?php echo $objTab->getId_tabela_taxa(); ?>"><i class="fa fa-trash"></i> Excluir</a>
                  </td>

                </tr>

              <?php endforeach;?>

              
            </tbody>

          </table>

        </div>  <!-- FINAL MIOLO -->

					



				</div>

		</div>  <!-- FINAL MIOLO -->

	</div> <!-- FINAL COL -->

</div> <!-- FINAL ROWS -->


 <!-- Start Calendar modal -->
      <div id="CalenderModalNew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel">Deseja realmente excluir o item?</h4>
            </div>
           
      <div class="modal-footer">
      <a href="#" id="btnYes" class="btn btn-danger"><i class="fa fa-trash"></i> Confirmar exclusão</a>
      <a href="#" data-dismiss="modal" aria-hidden="true" class="btn">Fechar Janela</a>
     
    </div>
          </div>
        </div>
      </div>








<script type="text/javascript">

<?php if($msg==true){ ?>
//função para ocultar mensagem de cadastro: arquivo: js/base.js
hideMessage();

<?php } ?>

</script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/text_numero.js"></script>

<script type="text/javascript">
$(function () {

 //OPERAÇÃO EXCLUSÃO 
  $('#CalenderModalNew').on('show', function() {
    var id = $(this).data('id'),
    removeBtn = $(this).find('.danger');
  });

  $(document).on('click', '.confirm-delete', function(e) {
    e.preventDefault();

    var id = $(this).data('id');
    $('#CalenderModalNew').data('id', id).modal('show');
  });

  $('#btnYes').click(function() {
    // handle deletion here
    var id = $('#CalenderModalNew').data('id');
    var id_tabela_nome = $("#id_tabela_nome").val();

    $('[data-id='+id+']').remove();
    $('#CalenderModalNew').modal('hide');
    location.href="<?php echo site_url('tabela_taxa/excluir_parcela'); ?>/"+id+"/"+id_tabela_nome;

  });
  //FINAL OPERAÇÃO EXCLUSÃO
 

});

</script>     


