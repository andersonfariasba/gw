<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">

				<div class="x_title">
					<h2>Editar Conta Bancária</h2>
					<ul class="nav navbar-right panel_toolbox">
					<li><a href="<?php echo site_url('contas_banco/cadastrar'); ?>"><i class="fa fa-plus-circle"></i> <strong>Novo</strong></a></li>
					<li><a href="<?php echo site_url('contas_banco/filtro'); ?>"><i class="fa fa-search"></i> <strong>Pesquisar</strong></a></li>
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

			  	  <?php echo form_open('contas_banco/editar/'.$objConta->getId_conta_banco(),array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
                   <input type="hidden" name="id_conta_banco" id="id_conta_banco" value="<?php echo set_value('id_conta_banco',$objConta->getId_conta_banco()); ?>">
			  	   <!-- INICIO TAB GERAL -->
			  	   <div class="" role="tabpanel" data-example-id="togglable-tabs">
                   
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                      <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Dados Básicos</a>
                      </li>
                     
                     <!-- <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Anotações</a>
                      </li>-->
                    </ul>
                    
                    <div id="myTabContent" class="tab-content">
                      
                      <!-- ABA 001 -->
                      <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                        
                
							  <div class="form-group">

							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
								<label>Empresa</label>
								<select class="form-control" name="id_filial" id="id_filial">						
									<?php 
									foreach ($listFilial as $objFilial): 
									$filial = $objFilial->getId_filial();      
									?>
									<option value="<?php echo $objFilial->getId_filial(); ?>" <?php echo set_select('id_filial',$filial,$objConta->filialIs($filial)); ?>>
									<?php echo $objFilial->getNome_fantasia()." - ".$objFilial->getCnpj_cpf(); ?>
									</option>
									<?php endforeach; ?>
								</select>
							</div>

							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
								<label>Banco</label>
								<input type="text" class="form-control" name="banco" id="banco" value="<?php echo set_value('banco',$objConta->getBanco())?>" maxlength="250"/>
							</div>

					    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
								<label>Agência</label>
								<input type="text" class="form-control" name="agencia" id="agencia" value="<?php echo set_value('agencia',$objConta->getAgencia())?>" maxlength="50"/>
						</div>

						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Conta</label>
									<input type="text" class="form-control" name="conta" id="conta" value="<?php echo set_value('conta',$objConta->getConta())?>"/>
						</div>

						 <div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
								<label>Descrição</label>
								<input type="text" class="form-control" name="observacao" id="observacao" value="<?php echo set_value('observacao',$objConta->getObservacao())?>" maxlength="50"/>
						</div>


						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Gerente</label>
									<input type="text" class="form-control" name="gerente" id="gerente" value="<?php echo set_value('gerente',$objConta->getGerente())?>"/>
						</div>

						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Central de Atendimento</label>
									<input type="text" class="form-control" name="central_atendimento" id="central_atendimento" value="<?php echo set_value('central_atendimento',$objConta->getCentral_atendimento())?>"/>
						</div>

					

						</div>



						
						
						
						
						
                      </div>  <!-- FINAL ABA 001 -->
                      <!-- **************** -->
                      
                        
                      <!-- ABA 003 -->
                      <!--<div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                        
                          <div class="form-group">
		                  
			                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
								<label>Anotações</label>
								<textarea id="observacao" rows="10" class="form-control" name="observacao">
									  <?php echo $objConta->getObservacao(); ?>
								</textarea>
							  </div>
						  </div>

                      </div>-->  <!-- FINAL ABA 003 -->
                      <!-- **************** -->

                    
                    </div><!-- FINAL CONTENT TAB -->

                  </div> <!-- FINAL TAB GERAL -->

                  <div class="ln_solid"></div>

                  <div class="col-md-12 col-sm-12 col-xs-12">
							
							<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Salvar</button>
							
				 </div>

				 </form>



				

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


