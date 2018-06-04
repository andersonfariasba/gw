<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">

				<div class="x_title">
					<h2>Cadastrar Plano de Contas</h2>
					<ul class="nav navbar-right panel_toolbox">
					
					<li><a href="<?php echo site_url('plano_contas/filtro'); ?>"><i class="fa fa-search"></i> <strong>Pesquisar</strong></a></li>
					<li><a href="<?php echo site_url('relatorio_painel/menu'); ?>"><i class="fa fa-bar-chart"></i> <strong>Relatórios</strong></a></li>
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

			  	  <?php echo form_open('plano_contas/cadastrar',array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>

					<div class="form-group">

					<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Tipo de Conta</label>
										<select class="form-control" id="tipo_conta">
											<option>Selecione...</option>
											<option value="<?php echo CONTAS_PAGAR; ?>">DESPESAS</option>
											<option value="<?php echo CONTAS_RECEBER; ?>">RECEITAS</option>
										</select>
					</div>

					<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									 <label>Grupo</label>
                        <select class="form-control" name="id_plano_categoria" id="id_plano_categoria">

                        </select>
					</div>
						
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Classificação</label>
							<input type="text" class="form-control" name="classificacao" id="classificacao" value="<?php echo set_value('classificacao')?>"/>
						</div>

						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Nome do Plano</label>
							<input type="text" class="form-control" name="nome" id="nome" value="<?php echo set_value('nome')?>"/>
						</div>

						

					</div>



						<div class="ln_solid"></div>

					<div>
						<div class="col-md-12 col-sm-12 col-xs-12">
							
							<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Salvar</button>
							</form>
						</div>
					</div>
				</div>

		</div>  <!-- FINAL MIOLO -->

	</div> <!-- FINAL COL -->

</div> <!-- FINAL ROWS -->






<script type="text/javascript">

<?php if($msg==true){ ?>
//função para ocultar mensagem de cadastro: arquivo: js/base.js
hideMessage();

<?php } ?>

</script>

<script type="text/javascript">
 $(function(){
    	

	$('#tipo_conta').change(function(){

 
   var url = '<?= site_url("/plano_contas/ajax_listar_tipo/"); ?>/'+$(this).val();
   $.getJSON(url, function(j){
                             
      var options = '';
       options += '<option value="">Selecione...</option>';
       for (var i = 0; i < j.length; i++) {
          options += '<option value="' + j[i].id_plano_categoria + '">' +j[i].classificacao+" "+j[i].nome + '</option>';
        } 
       
       
       $('#id_plano_categoria').html(options).show();
       
    });

     });


});

</script>

