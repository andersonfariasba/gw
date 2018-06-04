<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">

				<div class="x_title">
					<h2>Nova Solicitação Via Importação</h2>
					<ul class="nav navbar-right panel_toolbox">
					<li><a href="<?php echo site_url('solicitacao/iniciar_manual'); ?>"><i class="fa fa-plus-circle"></i> <strong>Nova Solicitação Manual</strong></a></li>
					<li><a href="<?php echo site_url('solicitacao/iniciar_importacao'); ?>"><i class="fa fa-cloud-upload"></i> <strong>Importação</strong></a></li>
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

			  	  <?php echo form_open_multipart('solicitacao/importacao_confirmar',array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
			  	  <input type="hidden" name="id_solicitante" value="<?php echo $this->session->userdata('id_colaborador') ?>">

					<div class="form-group">
						
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Solicitante</label>
							<input type="text" disabled class="form-control" value="<?php echo set_value('solicitante',$this->session->userdata('nome_colaborador')); ?>"/>
						</div>

						<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Data Solicitação</label>
							<input type="text" class="form-control" readonly name="data_criacao" id="data_criacao" value="<?php echo set_value('data_criacao',date('d/m/Y'))?>"/>
						</div>

						<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Data de Necessidade</label>
							<input type="text" class="form-control calendario" name="data_necessidade" id="data_necessidade" value="<?php echo set_value('data_necessidade')?>"/>
						</div>

					</div>

					<div class="form-group">
						
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Coordenador Aprovação</label>
							 <select class="form-control" name="id_aprovador" id="id_aprovador">
							 <option value="">Selecione ...</option>
                        
                        <?php foreach ($listUser as $objUser): 
                           
                             ?>
                        <option value="<?php echo $objUser->getId_colaborador(); ?>" <?php echo set_select('id_aprovador'); ?>>
                           <?php echo $objUser->getColaborador()->getNome(); ?>
                        </option>
                         <?php endforeach; ?>

                       
                        </select>
						</div>


						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Status</label>
							 <select class="form-control" name="id_status" id="id_status">
                         <!--<option value="">Selecione ...</option>-->
                         <?php foreach ($listStatus as $objStatus): 
                             
                             ?>
                        <option value="<?php echo $objStatus->getId_status(); ?>" <?php echo set_select('id_status'); ?>>
                           <?php echo $objStatus->getStatus()->getStatus(); ?>
                        </option>
                         <?php endforeach; ?>

                       
                        </select>
						</div>

					</div>

					  <div class="form-group">
	        
               <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <label>Selecionar Arquivo</label>

                  <input type="file" name="arquivo" id="arquivo" size="50">
</div>


         <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
              <label></label><br />

                  <a href="<?php echo base_url()."/planilha/importar_material.xls" ?>" target="_blank" class="btn btn-small btn-primary"><i class="fa fa-cloud-download"></i> Modelo Documento (.xlsx ou .xls)</a>
            </div>

            </div>



						<div class="ln_solid"></div>

					<div>
						<div class="col-md-12 col-sm-12 col-xs-12">
							<!--<button type="reset" class="btn btn-danger"><i class="fa fa-remove"></i> Limpar</button>-->
							<button type="submit" class="btn btn-success"><i class="fa fa-cloud-upload"></i> Confirmar</button>
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


