<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">

				<div class="x_title">
					<h2>Editar Categoria de Estoque</h2>
					<ul class="nav navbar-right panel_toolbox">
					<li><a href="<?php echo site_url('est_categorias/cadastrar'); ?>"><i class="fa fa-plus-circle"></i> <strong>Novo</strong></a></li>
					<li><a href="<?php echo site_url('est_categorias/filtro'); ?>"><i class="fa fa-search"></i> <strong>Pesquisar</strong></a></li>
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

			  	<?php echo form_open('est_categorias/editar/'.$objCategoria->getId_categoria(),array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
    			<input type="hidden" name="id_categoria" value="<?php echo $objCategoria->getId_categoria(); ?>">    
    
					<div class="form-group">
						
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Nome da Categoria</label>
							<input type="text" class="form-control" name="categoria" id="categoria" value="<?php echo set_value('categoria',$objCategoria->getCategoria())?>" maxlength="50"/>
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


