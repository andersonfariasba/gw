<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">

				<div class="x_title">
					<h2>Abrir Caixa</h2>
					<ul class="nav navbar-right panel_toolbox">
					
					<li><a href="<?php echo site_url('caixa_abertura/filtro'); ?>"><i class="fa fa-search"></i> <strong>Pesquisar</strong></a></li>
					<li><a href="<?php echo site_url('relatorio_painel/menu');?>""><i class="fa fa-bar-chart"></i> <strong>Relatórios</strong></a></li>
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

			  	  <?php echo form_open('caixa_abertura/cadastrar',array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>

					<div class="form-group">

					<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
					<label>Data Abertura <span class="obrigatorio">*</span></label>
					<input type="text" class="form-control calendario" name="data" id="data" value="<?php echo set_value('data',date('d/m/Y'))?>"/>
					</div>

					<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
					<label>Hora <span class="obrigatorio">*</span></label>
					<input type="text" class="form-control hora" name="hora" id="hora" value="<?php echo set_value('hora',date('H:m'))?>"/>
					</div>
						
					</div>

					<div class="form-group">

					 <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Valor Inicial <span class="obrigatorio">*</span></label>
							<input type="text" class="form-control" tipo="moneyReal" name="valor_inicial" id="valor_inicial" value="<?php echo set_value('valor_inicial',0)?>"/>
						</div>

						 <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Usuário <span class="obrigatorio">*</span></label>
							<input type="text" readonly class="form-control" value="<?php echo set_value('valor_inicial',$this->session->userdata('login'))?>"/>
						</div>


					</div>

					<div class="form-group">

					 <div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Observação</label>
							<input type="text" class="form-control" name="observacao" id="observacao" value="<?php echo set_value('observacao')?>"/>
						</div>

						


					</div>


						<div class="ln_solid"></div>

					<div>
						<div class="col-md-12 col-sm-12 col-xs-12">
							<button type="reset" class="btn btn-danger"><i class="fa fa-remove"></i> Limpar</button>
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


