<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">

				<div class="x_title">
					<h2>Editar Departamento RH</h2>
					<ul class="nav navbar-right panel_toolbox">
					<li><a href="<?php echo site_url('rh_departamentos/cadastrar'); ?>"><i class="fa fa-plus-circle"></i> <strong>Novo Departamento</strong></a></li>
					<li><a href="<?php echo site_url('rh_departamentos/filtro'); ?>"><i class="fa fa-search"></i> <strong>Pesquisar Departamento</strong></a></li>
					<li><a href="#"><i class="fa fa-bar-chart"></i> <strong>Relatórios</strong></a></li>
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

			  		 <?php echo form_open('rh_departamentos/editar/'.$objDep->getId_departamento(),array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
   					 <input type="hidden" name="id_departamento" value="<?php echo $objDep->getId_departamento(); ?>">     

					<div class="form-group">
						
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Departamento</label>
							<input type="text" class="form-control" name="departamento" id="departamento" value="<?php echo set_value('departamento',$objDep->getDepartamento())?>" maxlength="50"/>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Status</label>
								<select class="form-control" name="status" id="status">
									 <?php $status = $objDep->getStatus();?>
                					<option value="<?= $objDep->getStatus(); ?>" <?= set_select('status',$status,$objDep->statusIs($status)); ?>>
                					<?= $objDep->printStatus(); ?>
									<option value="<?= ATIVO; ?>" <?= set_select('status',ATIVO); ?>>ATIVO</option>
									<option value="<?= BLOQUEADO; ?>" <?= set_select('status',BLOQUEADO); ?>>BLOQUEADO</option>
								</select>
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


