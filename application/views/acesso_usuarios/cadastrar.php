<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">

				<div class="x_title">
					<h2>Cadastrar Usuário</h2>
					<ul class="nav navbar-right panel_toolbox">
					
					<li><a href="<?php echo site_url('acesso_usuarios/filtro'); ?>"><i class="fa fa-search"></i> <strong>Pesquisar Usuário</strong></a></li>
					<li><a href="<?php echo site_url('relatorio_painel/menu');?>"><i class="fa fa-bar-chart"></i> <strong>Relatórios</strong></a></li>
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
                   
                   
                   <?php echo form_open('acesso_usuarios/cadastrar',array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
					
					<div class="form-group">
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Perfil <span class="obrigatorio">*</span></label>
								<select class="form-control" name="id_perfil" id="id_perfil">
									<option value="">Selecione...</option>
									<?php foreach ($listPerfil as $objPerfil): ?>
									<option value="<?php echo $objPerfil->getId_perfil(); ?>" <?php echo set_select('id_perfil',$objPerfil->getId_perfil()); ?>>
									<?php echo $objPerfil->getPerfil(); ?>
									</option>
									<?php endforeach; ?>
								</select>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Colaborador</label>
								<select class="form-control" name="id_colaborador" id="id_colaborador">
									<option value="">Selecione...</option>
									<?php foreach ($listColaborador as $objColaborador): ?>
									<option value="<?php echo $objColaborador->getId_colaborador(); ?>" <?php echo set_select('id_colaborador',$objColaborador->getId_colaborador()); ?>>
									<?php echo $objColaborador->getNome(); ?>
									</option>
									<?php endforeach; ?>
								</select>
						</div>
					</div>

					

					<div class="form-group">
						
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Login <span class="obrigatorio">*</span></label>
							<input type="text" class="form-control" name="login" value="<?php echo set_value('login')?>" maxlength="50"/>
						</div>
					</div>


					<div class="form-group">
						
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Senha <span class="obrigatorio">*</span></label>
							<input type="password" class="form-control" name="senha" id="senha" value="<?php echo set_value('senha')?>" maxlength="50"/>
						</div>
					</div>

					<div class="form-group">
						
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Email</label>
							<input type="text" class="form-control" name="email" value="<?php echo set_value('login')?>" maxlength="100"/>
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


