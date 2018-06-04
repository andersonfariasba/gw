<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">

				<div class="x_title">
					<h2>Editar Status</h2>
					<ul class="nav navbar-right panel_toolbox">
					<li><a href="<?php echo site_url('pedido_status_compras/cadastrar'); ?>"><i class="fa fa-plus-circle"></i> <strong>Novo Status</strong></a></li>
					<li><a href="<?php echo site_url('pedido_status/filtro'); ?>"><i class="fa fa-search"></i> <strong>Pesquisar</strong></a></li>
					
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

			  	  <?php echo form_open('pedido_status_compras/editar/'.$objCategoria->getId_status(),array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
			  	  <input type="hidden" name="id_status" value="<?php echo $objCategoria->getId_status(); ?>" />

					<div class="form-group">
						
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Nome do Status</label>
							<input type="text" class="form-control" name="status" id="status" value="<?php echo set_value('status',$objCategoria->getStatus())?>" maxlength="50"/>
						</div>

						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Status</label>
										<select class="form-control" name="situacao" id="situacao">
											  <?php $situacao = $objCategoria->getSituacao();?>
                <option value="<?= $objCategoria->getSituacao(); ?>" <?= set_select('situacao',$situacao,$objCategoria->situacaoIs($situacao)); ?>>
                <?= $objCategoria->printStatus(); ?></option>
               <option value="<?= ATIVO; ?>" <?= set_select('situacao',ATIVO); ?>>ATIVO</option>
               <option value="<?= BLOQUEADO; ?>" <?= set_select('situacao',BLOQUEADO); ?>>BLOQUEADO</option>

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


