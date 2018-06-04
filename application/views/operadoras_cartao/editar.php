<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">

				<div class="x_title">
					<h2>Editar Operadora Cartão</h2>
					<ul class="nav navbar-right panel_toolbox">
					<li><a href="<?php echo site_url('operadoras_cartao/cadastrar'); ?>"><i class="fa fa-plus-circle"></i> <strong>Novo</strong></a></li>
					<li><a href="<?php echo site_url('operadoras_cartao/filtro'); ?>"><i class="fa fa-search"></i> <strong>Pesquisar</strong></a></li>
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

			  	  <?php echo form_open('operadoras_cartao/editar/'.$objOperadora->getId_operadora(),array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
                  <input type="hidden" class="form-control" name="id_operadora" value="<?php echo set_value('id_operadora',$objOperadora->getId_operadora())?>" maxlength="250"/>
			  	   
			  	   <!-- INICIO TAB GERAL -->
			  	   <div class="" role="tabpanel" data-example-id="togglable-tabs">
                   
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                      <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Dados Básicos</a>
                      </li>
                     
                      <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Info</a>
                      </li>
                    </ul>
                    
                    <div id="myTabContent" class="tab-content">
                      
                      <!-- ABA 001 -->
                      <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                        
                 


							  <div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
								<label>Empresa</label>
								<input type="text" class="form-control" name="empresa" id="empresa" value="<?php echo set_value('empresa',$objOperadora->getEmpresa())?>" maxlength="250"/>
							</div>

							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
								<label>Central de Atendimento</label>
								<input type="text" class="form-control" name="central_atendimento" id="central_atendimento" value="<?php echo set_value('central_atendimento',$objOperadora->getCentral_atendimento())?>" maxlength="250"/>
							</div>

							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
								<label>Representante</label>
								<input type="text" class="form-control" name="representante_nome" id="representante_nome" value="<?php echo set_value('representante_nome',$objOperadora->getRepresentante_nome())?>" maxlength="250"/>
							</div>

							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Telefone</label>
									<input type="text" class="form-control" name="representante_tel" id="representante_tel" value="<?php echo set_value('representante_tel',$objOperadora->getRepresentante_tel())?>"/>
						</div>


					  
					

						</div>



						
						
						<div class="form-group">
							
							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Endereço</label>
									<input type="text" class="form-control" name="endereco" id="endereco" value="<?php echo set_value('endereco',$objOperadora->getEndereco())?>"/>
							</div>

							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Bairro</label>
									<input type="text" class="form-control" name="bairro" id="bairro" value="<?php echo set_value('bairro',$objOperadora->getBairro())?>"/>
							</div>

							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Estado</label>
										<select class="form-control" name="estado" id="estado">
											<option value="<?php echo $objOperadora->getEstado(); ?>"><?php echo $objOperadora->getEstado(); ?></option>
											<option value="AC">AC</option>
											<option value="AL">AL</option>
											<option value="AM">AM</option>
											<option value="AP">AP</option>
											<option value="BA">BA</option>
											<option value="CE">CE</option>
											<option value="DF">DF</option>
											<option value="ES">ES</option>
											<option value="GO">GO</option>
											<option value="MA">MA</option>
											<option value="MG">MG</option>
											<option value="MS">MS</option>
											<option value="MT">MT</option>
											<option value="PA">PA</option>
											<option value="PB">PB</option>
											<option value="PE">PE</option>
											<option value="PI">PI</option>
											<option value="PR">PR</option>
											<option value="RJ">RJ</option>
											<option value="RN">RN</option>
											<option value="RS">RS</option>
											<option value="RO">RO</option>
											<option value="RR">RR</option>
											<option value="SC">SC</option>
											<option value="SE">SE</option>
											<option value="SP">SP</option>
											<option value="TO">TO</option>

										</select>
							</div>

							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Cidade</label>
									<input type="text" class="form-control" name="cidade" id="cidade" value="<?php echo set_value('cidade',$objOperadora->getCidade())?>"/>
							</div>

							
							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<label>E-mail</label>
									<input type="text" class="form-control" name="email" id="email" value="<?php echo set_value('email',$objOperadora->getEmail())?>"/>
						   </div>
							

						</div>

						
						
                      </div>  <!-- FINAL ABA 001 -->
                      <!-- **************** -->
                      
                     
                      
                      <!-- ABA 003 -->
                      <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                        
                          <div class="form-group">
		                  
			                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
								<label>Anotações</label>
								<textarea id="observacao" rows="10" class="form-control" name="observacao">
									 <?php echo $objOperadora->getObservacao(); ?>
								</textarea>
							  </div>
						  </div>

                      </div>  <!-- FINAL ABA 003 -->
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


