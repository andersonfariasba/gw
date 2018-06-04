<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">

				<div class="x_title">
					<h2>Nova Solicitação de Compra - Manual</h2>
					<ul class="nav navbar-right panel_toolbox">
					<li><a href="<?php echo site_url('solicitacao/iniciar_manual'); ?>"><i class="fa fa-plus-circle"></i> <strong>Nova Solicitação Manual</strong></a></li>
					<!--<li><a href="<?php echo site_url('solicitacao/iniciar_importacao'); ?>"><i class="fa fa-cloud-upload"></i> <strong>Importação</strong></a></li>-->
					<li><a href="<?php echo site_url('solicitacao/filtro'); ?>"><i class="fa fa-search"></i> <strong>Pesquisar Solicitações</strong></a></li>
					
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

			  	  <?php echo form_open('solicitacao/iniciar_manual',array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
			  	  <input type="hidden" name="id_solicitante" value="<?php echo $this->session->userdata('id_colaborador') ?>">

					<div class="form-group">
						
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Solicitante</label>
							<input type="text" disabled class="form-control" value="<?php echo set_value('solicitante',$this->session->userdata('nome_colaborador')); ?>"/>
						</div>

						<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Data Solicitação</label>
							<input type="text" readonly class="form-control" name="data_criacao" id="data_criacao" value="<?php echo set_value('data_criacao',date('d/m/Y'))?>"/>
						</div>

						<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Data de Necessidade</label>
							<input type="text" class="form-control calendario" name="data_necessidade" id="data_necessidade" value="<?php echo set_value('data_necessidade')?>"/>
						</div>

					</div>


					<div class="form-group">
						<div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
								<label>Observação</label>
								<input type="text" name="observacao" value="<?php echo set_value('observacao')?>" class="form-control">
					    </div>
					</div>


						<div class="ln_solid"></div>

					<div>
						<div class="col-md-12 col-sm-12 col-xs-12">
							<!--<button type="reset" class="btn btn-danger"><i class="fa fa-remove"></i> Limpar</button>-->
							<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Incluir Material</button>
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


