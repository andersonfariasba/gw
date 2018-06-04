<?php $objDateFormat = $this->DateFormat; ?> 
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">

				<div class="x_title">
					<h2>Editar Funconário</h2>
					<ul class="nav navbar-right panel_toolbox">
					<li><a href="<?php echo site_url('rh_colaboradores/cadastrar'); ?>"><i class="fa fa-plus-circle"></i> <strong>Novo Funcionário</strong></a></li>
					<li><a href="<?php echo site_url('rh_colaboradores/filtro'); ?>"><i class="fa fa-search"></i> <strong>Pesquisar Funcionário</strong></a></li>
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

			  	        
                 <?php echo form_open('rh_colaboradores/editar/'.$objColaborador->getId_colaborador(),array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
                   <input type="hidden" name="id_colaborador" value="<?php echo $objColaborador->getId_colaborador()?>" />
        
			  	   <!-- INICIO TAB GERAL -->
			  	   <div class="" role="tabpanel" data-example-id="togglable-tabs">
                   
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                      <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Dados Básicos</a>
                      </li>
                      <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Documentos</a>
                      </li>
                      <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Info</a>
                      </li>
                    </ul>
                    
                    <div id="myTabContent" class="tab-content">
                      
                      <!-- ABA 001 -->
                      <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                        
                        <div class="form-group">
							
							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
								<label>Nome</label>
								<input type="text" class="form-control" name="nome" id="nome" value="<?php echo set_value('nome',$objColaborador->getNome())?>" maxlength="250"/>
							</div>

							 <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
								<label>Cargo</label>
									<select class="form-control" name="id_cargo" id="id_cargo">
										<option value="">Selecione...</option>
										<?php foreach ($listCargo as $objCargo): 

										$cargo = $objCargo->getId_cargo();

										?>
										<option value="<?php echo $objCargo->getId_cargo(); ?>" <?php echo set_select('id_cargo', $cargo,$objColaborador->cargoIs($cargo)); ?>>
										<?php echo $objCargo->getCargo(); ?>
										</option>
										<?php endforeach; ?>
									</select>
							</div>

							<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Comissão (%) </label>
									<input type="text" class="form-control" name="comissao_venda" id="comissao_venda" value="<?php echo set_value('comissao_venda',$objColaborador->getComissao_venda())?>"/>
							</div>

							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<label>E-mail</label>
									<input type="text" class="form-control" name="email" id="email" value="<?php echo set_value('email',$objColaborador->getEmail())?>"/>
							</div>

							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
								<label>Departamento</label>
									<select class="form-control" name="id_departamento" id="id_departamento">
									<option value="">Selecione...</option>
										<?php foreach ($listDep as $objDep): 
										$departamento = $objDep->getId_departamento();
										?>
										<option value="<?php echo $objDep->getId_departamento(); ?>" <?php echo set_select('id_departamento',$departamento,$objColaborador->departamentoIs($departamento)); ?>>
										<?php echo $objDep->getDepartamento(); ?>
										</option>
										<?php endforeach; ?>
									</select>
							</div>

							

						</div> 

						
						
						<div class="form-group">
							
							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Endereço</label>
									<input type="text" class="form-control" name="endereco" id="endereco" value="<?php echo set_value('endereco',$objColaborador->getEndereco())?>"/>
							</div>

							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Bairro</label>
									<input type="text" class="form-control" name="bairro" id="bairro" value="<?php echo set_value('bairro',$objColaborador->getBairro())?>"/>
							</div>

							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Estado</label>
										<select class="form-control" name="uf" id="uf">
											<option value="<?php echo $objColaborador->getUf(); ?>"><?php echo $objColaborador->getUf(); ?></option>
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
									<input type="text" class="form-control" name="cidade" id="cidade" value="<?php echo set_value('cidade',$objColaborador->getCidade())?>"/>
							</div>

								<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<label>CEP</label>
									<input type="text" class="form-control" name="cep" id="cep" value="<?php echo set_value('cep',$objColaborador->getCep())?>"/>
							</div>

							

							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
								<label>Data de Nascimento</label>
								<input type="text" class="form-control dataManual" name="data_nascimento" id="data_nascimento" value="<?php echo set_value('data_nascimento',$objDateFormat->date_format($objColaborador->getData_nascimento()))?>" maxlength="50"/>
							</div>



						</div>

						
						<div class="form-group">
							
							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Telefone Residencial</label>
									<input type="text" class="form-control" name="telefone" id="telefone" value="<?php echo set_value('telefone',$objColaborador->getTelefone())?>"/>
							</div>

							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Emergência</label>
									<input type="text" class="form-control" name="emergencia" id="emergencia" value="<?php echo set_value('emergencia',$objColaborador->getEmergencia())?>"/>
							</div>

							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Celular(1)</label>
									<input type="text" class="form-control" name="celular1" id="celular1" value="<?php echo set_value('celular1',$objColaborador->getCelular1())?>"/>
							</div>

							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Celular(2)</label>
									<input type="text" class="form-control" name="celular2" id="celular2" value="<?php echo set_value('celular2',$objColaborador->getCelular2())?>"/>
							</div>



					    </div>


                      </div>  <!-- FINAL ABA 001 -->
                      <!-- **************** -->
                      
                         <!-- ABA 002 -->
                      <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

						<div class="form-group">
		                  
		                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>RG</label>
							<input type="text" class="form-control" name="rg" id="rg" value="<?php echo set_value('rg',$objColaborador->getRg())?>"/>
						  </div>

						  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Estado</label>
										<select class="form-control" name="uf_exp" id="uf_exp">
											 <option value="<?php echo $objColaborador->getUf_exp(); ?>"><?php echo $objColaborador->getUf_exp(); ?></option>
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
							<label>Data Expedição</label>
							<input type="text" class="form-control" name="data_exp" id="data_exp" value="<?php echo set_value('data_exp',$objColaborador->getData_exp())?>"/>
						  </div>

						   <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>CPF</label>
							<input type="text" class="form-control" name="cpf" id="cpf" value="<?php echo set_value('cpf',$objColaborador->getCpf())?>"/>
						  </div>

						   <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Carteira Reservista</label>
							<input type="text" class="form-control" name="reservista" id="reservista" value="<?php echo set_value('carteira_reservista',$objColaborador->getReservista())?>"/>
						  </div>

						   <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>PIS/PASEP</label>
							<input type="text" class="form-control" name="pis" id="pis" value="<?php echo set_value('pis')?>"/>
						  </div>

						    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Data Cadastro PIS</label>
							<input type="text" class="form-control" name="data_cadastro_pis" id="data_cadastro_pis" value="<?php echo set_value('data_cadastro_pis',$objColaborador->getData_cadastro_pis())?>"/>
						  </div>

						   <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Título</label>
							<input type="text" class="form-control" name="titulo" id="titulo" value="<?php echo set_value('titulo',$objColaborador->getTitulo())?>"/>
						  </div>

						   <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Zona</label>
							<input type="text" class="form-control" name="zona" id="zona" value="<?php echo set_value('zona',$objColaborador->getZona())?>"/>
						  </div>

						    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Seção</label>
							<input type="text" class="form-control" name="secao" id="secao" value="<?php echo set_value('secao',$objColaborador->getSecao())?>"/>
						  </div>


				     </div>

				     
				     <div class="form-group">
		                  
		                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Banco</label>
							<input type="text" class="form-control" name="banco" id="banco" value="<?php echo set_value('banco',$objColaborador->getBanco())?>"/>
						  </div>

						  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Agência</label>
							<input type="text" class="form-control" name="agencia" id="agencia" value="<?php echo set_value('agencia',$objColaborador->getAgencia())?>"/>
						  </div>

						   <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Conta</label>
							<input type="text" class="form-control" name="conta" id="conta" value="<?php echo set_value('conta',$objColaborador->getConta())?>"/>
						  </div>

					</div>




                      </div> <!-- FINAL ABA 002 -->
                      <!-- **************** -->
                      
                      <!-- ABA 003 -->
                      <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                        
                          <div class="form-group">
		                  
			                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
								<label>Anotações</label>
								<textarea id="observacao" rows="10" class="form-control" name="observacao">
									<?php echo $objColaborador->getObservacao(); ?>
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


