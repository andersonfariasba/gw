<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">

				<div class="x_title">
					<h2>Editar Formas de Pagamento</h2>
					<ul class="nav navbar-right panel_toolbox">
					<li><a href="<?php echo site_url('formas_pagamentos/cadastrar'); ?>"><i class="fa fa-plus-circle"></i> <strong>Novo</strong></a></li>
					<li><a href="<?php echo site_url('formas_pagamentos/filtro'); ?>"><i class="fa fa-search"></i> <strong>Pesquisar</strong></a></li>
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

			  	  <?php echo form_open('formas_pagamentos/editar/'.$objForma->getId_forma(),array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
                    <input type="hidden" name="id_forma" value="<?php echo $objForma->getId_forma(); ?>">  
					<div class="form-group">
						
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Nome da Forma</label>
							<input type="text" class="form-control" name="forma" id="forma" value="<?php echo set_value('forma',$objForma->getForma())?>"/>
						</div>

					</div>

					

                        
                     <!-- <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">

                      <p>
                      <label>Antecipar Pagamento?</label>
                       <input type="checkbox" class="flat" <?php if($objForma->getCpAntecipado()==SIM){ echo "checked='' "; } ?> name="cpAntecipado" value="<?php echo set_value('cpAntecipado',SIM)?>"> 
                     
                      </p>
                      </div>
                      </div>-->
                    


					<div class="form-group">
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						<label>Status</label>
						<select class="form-control" name="status" id="status">
						<?php $status = $objForma->getStatus();?>
						<option value="<?= $objForma->getStatus(); ?>" <?= set_select('status',$status,$objForma->statusIs($status)); ?>>
						<?= $objForma->printStatus(); ?>
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

   $(document).ready(function(){
              
            //$("#camada_antecipado").hide();
                        
           

            $("#cartao").click(function(){

              $("#camada_antecipado").show();
            });
             
                                  
      });


<?php if($msg==true){ ?>
//função para ocultar mensagem de cadastro: arquivo: js/base.js
hideMessage();

<?php } ?>

</script>


