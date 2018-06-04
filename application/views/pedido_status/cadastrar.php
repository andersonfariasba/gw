<style type="text/css">
#theColor {
    width: 20px;
    height: 20px;
    float: left;
    border: 1px solid none;
}	
</style>

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">

				<div class="x_title">
					<h2>Cadastrar Status</h2>
					<ul class="nav navbar-right panel_toolbox">
					
					<li><a href="<?php echo site_url('pedido_status/filtro'); ?>"><i class="fa fa-search"></i> <strong>Pesquisar</strong></a></li>
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

			  	  <?php echo form_open('pedido_status/cadastrar',array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>

					<div class="form-group">
						
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Nome do Status</label>
							<input type="text" class="form-control" name="status" id="status" value="<?php echo set_value('status')?>" maxlength="50"/>
						</div>

							<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Cor Status</label>
							<select id="colorSelector" class="form-control" name="cor">
							<option value="">Selecione Cor ...</option>
							<option value="btn btn-sm btn-success">Verde</option>
							<option value="btn btn-sm btn-warning">Laranja</option>
							<option value="btn btn-sm btn-primary">Azul</option>
							<option value="btn btn-sm btn-danger">Vermelho</option>
							<!--<option value="#008000">Verde</option>
							<option value="#FF8C00">Laranja</option>
							<option value="#FF0000">Vermelho</option>-->
							</select>
						</div>

						<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
							<label></label><br />
							<div id="theColor"> </div> <span id="theName"></span>
							 <!--<button type="button" class="btn btn-sm btn-defult" id="botao"> </button>-->
							 <!--<button type="button" id="botao"> </button>-->

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

$("#colorSelector").change(function () {
	//alert($(this).val());
    
    var classe = $(this).val();
    var cor = "";
    if(classe=='btn btn-sm btn-success'){
    	cor = 'green';
    }
    if(classe=='btn btn-sm btn-primary'){
    	cor = 'blue';
    }
    if(classe=='btn btn-sm btn-warning'){
    	cor = 'orange';
    }
    if(classe=='btn btn-sm btn-danger'){
    	cor = 'red';
    }
   

    $("#theColor").css("background-color", cor);
    //$("#theName").html($(this).find("option:selected").text());

    //$("#botao").addClass($(this).val());
});

</script>
