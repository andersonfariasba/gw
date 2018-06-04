<?php $objDateFormat = $this->DateFormat; ?> 
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">

				<div class="x_title">
					<h2>Parametrização</h2>
					<!--<ul class="nav navbar-right panel_toolbox">
					<li><a href="<?php echo site_url('clientes/cadastrar'); ?>"><i class="fa fa-plus-circle"></i> <strong>Novo</strong></a></li>
					<li><a href="<?php echo site_url('clientes/filtro'); ?>"><i class="fa fa-search"></i> <strong>Pesquisar</strong></a></li>
					<li><a href="#"><i class="fa fa-bar-chart"></i> <strong>Relatórios</strong></a></li>
					</ul>-->                     
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

			  	 <?php echo form_open_multipart('filiais/editar/'.PAD_CAD_FILIAL,array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
                 <input type="hidden" name="id_filial" value="<?php echo $objCliente->getId_filial(); ?>">
                 <input type="hidden" name="data_cadastro" value="<?php echo $objCliente->getData_cadastro(); ?>">
                 <input type="hidden" name="arquivo_atual" value="<?php echo $objCliente->getLogo(); ?>" />   
                   <input type="hidden" id="cidade_flag" value="<?php echo $objCliente->getId_cidade(); ?>"> 
     
			  	   <!-- INICIO TAB GERAL -->
			  	   <div class="" role="tabpanel" data-example-id="togglable-tabs">
                   
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                      <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Dados da Empresa</a>
                      </li>
                     
                       <?php if($this->session->userdata('id_usuario')==CODIGO_VELLORE){ ?>
                       <li role="presentation" class=""><a href="#tab_content5" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Módulos</a>
                      </li>
                      <?php } ?>

                      <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Anotações</a>
                      </li>



                       <li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Logo</a>
                      </li>

                    </ul>
                    
                    <div id="myTabContent" class="tab-content">
                      
                      <!-- ABA 001 -->
                      <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                        
                      

							  <div class="form-group">

							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">

								<label>Nome Fantasia</label>
								<input type="text" class="form-control" name="nome_fantasia" id="nome_fantasia" value="<?php echo set_value('nome_fantasia',$objCliente->getNome_fantasia())?>" maxlength="250"/>
							</div>

							
					    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
								<label>CNPJ OU CPF</label>
								<input type="text" class="form-control" name="cnpj_cpf" id="cpfcnpj" value="<?php echo set_value('cnpj_cpf',$objCliente->getCnpj_cpf())?>" maxlength="50"/>
						</div>

						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Telefone(1)</label>
									<input type="text" class="form-control telefone" name="telefone1" id="telefone1" value="<?php echo set_value('telefone1',$objCliente->getTelefone1())?>"/>
						</div>

						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Telefone(2)</label>
									<input type="text" class="form-control telefone" name="telefone2" id="telefone2" value="<?php echo set_value('telefone2',$objCliente->getTelefone2())?>"/>
						</div>

						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Celular</label>
									<input type="text" class="form-control telefone" name="celular" id="celular" value="<?php echo set_value('celular',$objCliente->getCelular())?>"/>
						</div>

						
							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<label>E-mail</label>
									<input type="text" class="form-control" name="email" id="email" value="<?php echo set_value('email',$objCliente->getEmail())?>"/>
						</div>

						


						</div>



						
						
						<div class="form-group">
							
							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Endereço</label>
									<input type="text" class="form-control" name="endereco" id="endereco" value="<?php echo set_value('endereco',$objCliente->getEndereco())?>"/>
							</div>

							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Bairro</label>
									<input type="text" class="form-control" name="bairro" id="bairro" value="<?php echo set_value('bairro',$objCliente->getBairro())?>"/>
							</div>

							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Estado</label>
										<select class="form-control" name="id_estado" id="id_estado">
                  <option value="">Selecione...</option>
                  <?php foreach ($listEstados as $objEstado): 
                      $estado = $objEstado->getUf_id();
                  ?>
                  <option value="<?php echo $objEstado->getUf_id(); ?>" <?php echo set_select('id_estado',$estado,$objCliente->estadoIs($estado)); ?>>
                  <?php echo $objEstado->getUf_nome(); ?>
                  </option>
                  <?php endforeach; ?>
                </select>
							</div>

							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Cidade</label>
									 <select class="form-control" name="id_cidade" id="id_cidade"></select>
							</div>

							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<label>CEP</label>
									<input type="text" class="form-control cep" name="cep" id="cep" value="<?php echo set_value('cep',$objCliente->getCep())?>"/>
							</div>


							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Inscrição Estadual</label>
									<input type="text" class="form-control" name="insc_estadual" id="insc_estadual" value="<?php echo set_value('insc_estadual',$objCliente->getInsc_estadual())?>"/>
							</div>

							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Inscrição Municipal</label>
									<input type="text" class="form-control" name="insc_municipal" id="insc_municipal" value="<?php echo set_value('insc_municipal',$objCliente->getInsc_municipal())?>"/>
							</div>

							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Status</label>
										<select class="form-control" name="status" id="status">
											  <?php $status = $objCliente->getStatus();?>
                <option value="<?= $objCliente->getStatus(); ?>" <?= set_select('status',$status,$objCliente->statusIs($status)); ?>>
                <?= $objCliente->printStatus(); ?>
               <option value="<?= ATIVO; ?>" <?= set_select('status',ATIVO); ?>>ATIVO</option>
               <option value="<?= BLOQUEADO; ?>" <?= set_select('status',BLOQUEADO); ?>>BLOQUEADO</option>

										</select>
							</div>


                          <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Data Cadastro: </label>
							   <span><?php echo $objDateFormat->date_format($objCliente->getData_cadastro()); ?></span>
                           </div>
							

						</div>

						
						
                      </div>  <!-- FINAL ABA 001 -->
                      <!-- **************** -->



                            <!-- ABA 003 -->
                      <div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="profile-tab">
                        


                      	<div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label class="btn btn-danger">Acesso exclusivo pela Empresa responsável pelo sistema.</label>


						



							</div>
						</div>


						<div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Módulo Locação</label>


							<select class="form-control" name="mod_locacao" id="mod_locacao">
							<?php $loc = $objCliente->getMod_locacao();?>
							<option value="<?= $objCliente->getMod_locacao(); ?>" <?= set_select('mod_locacao',$loc,$objCliente->modLocacaoIs($loc)); ?>>
							<?= $objCliente->printModLocacao(); ?></option>
							<option value="<?= SIM; ?>" <?= set_select('mod_locacao',SIM); ?>>DISPONIVEL</option>
							<option value="<?= NAO; ?>" <?= set_select('mod_locacao',NAO); ?>>INDISPONIVEL</option>
							</select>



							</div>
						</div>

							<div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Módulo Vendas</label>


							<select class="form-control" name="mod_vendas" id="mod_vendas">
							<?php $venda = $objCliente->getMod_vendas();?>
							<option value="<?= $objCliente->getMod_vendas(); ?>" <?= set_select('mod_vendas',$loc,$objCliente->modVendasIs($venda)); ?>>
							<?= $objCliente->printModVendas(); ?></option>
							<option value="<?= SIM; ?>" <?= set_select('mod_vendas',SIM); ?>>DISPONIVEL</option>
							<option value="<?= NAO; ?>" <?= set_select('mod_vendas',NAO); ?>>INDISPONIVEL</option>
							</select>



							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Módulo Bar / Restaurante / Controle de Mesas</label>


							<select class="form-control" name="mod_bar" id="mod_bar">
							<?php $bar = $objCliente->getMod_bar();?>
							<option value="<?= $objCliente->getMod_bar(); ?>" <?= set_select('mod_bar',$bar,$objCliente->modBarIs($bar)); ?>>
							<?= $objCliente->printModBar(); ?></option>
							<option value="<?= SIM; ?>" <?= set_select('mod_caixa',SIM); ?>>DISPONIVEL</option>
							<option value="<?= NAO; ?>" <?= set_select('mod_caixa',NAO); ?>>INDISPONIVEL</option>
							</select>



							</div>
						</div>


						<div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Módulo Compras</label>


							<select class="form-control" name="mod_compras" id="mod_compras">
							<?php $compra = $objCliente->getMod_compras();?>
							<option value="<?= $objCliente->getMod_compras(); ?>" <?= set_select('mod_compras',$compra,$objCliente->modComprasIs($compra)); ?>>
							<?= $objCliente->printModCompras(); ?></option>
							<option value="<?= SIM; ?>" <?= set_select('mod_compras',SIM); ?>>DISPONIVEL</option>
							<option value="<?= NAO; ?>" <?= set_select('mod_compras',NAO); ?>>INDISPONIVEL</option>
							</select>



							</div>
						</div>

							<div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Módulo Caixa(sangria e reforço)</label>


							<select class="form-control" name="mod_caixa" id="mod_caixa">
							<?php $caixa = $objCliente->getMod_caixa();?>
							<option value="<?= $objCliente->getMod_caixa(); ?>" <?= set_select('mod_caixa',$loc,$objCliente->modCaixaIs($caixa)); ?>>
							<?= $objCliente->printModCaixa(); ?></option>
							<option value="<?= SIM; ?>" <?= set_select('mod_caixa',SIM); ?>>DISPONIVEL</option>
							<option value="<?= NAO; ?>" <?= set_select('mod_caixa',NAO); ?>>INDISPONIVEL</option>
							</select>



							</div>
						</div>

					



                      </div>  <!-- FINAL ABA 003 -->
                      <!-- **************** -->


                      
                       
                      <!-- ABA 003 -->
                      <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                        
                          <div class="form-group">
		                  
			                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
								<label>Anotações</label>
								<textarea id="observacao" rows="10" class="form-control" name="observacao">
									  <?php echo $objCliente->getObservacao(); ?>
								</textarea>
							  </div>
						  </div>

                      </div>  <!-- FINAL ABA 003 -->
                      <!-- **************** -->

                        <!-- ABA 004 -->
                      <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
                        
                          

                          <div class="form-group">
		                  
							  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
								<label>Imagem da Empresa</label>
								 <input type="file" name="logo" id="logo" size="50">
							  </div>
							  

							<?php if($objCliente->getLogo()!=""){ ?>
								<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
								<img src="<?= base_url(); ?>images/<?php echo $objCliente->getLogo(); ?>" alt="" width="140px;" >
														
								</div>
							<?php } ?>

			                


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


<script type="text/javascript">

 $("#cpfcnpj").keydown(function(){
    try {
      $("#cpfcnpj").unmask();
    } catch (e) {}
    
    var tamanho = $("#cpfcnpj").val().length;
  
    if(tamanho < 11){
        $("#cpfcnpj").mask("999.999.999-99");
    } else if(tamanho >= 11){
        $("#cpfcnpj").mask("99.999.999/9999-99");
    }                   
});

var uf = $("#id_estado").val();
var cidade_flag = $("#cidade_flag").val();

 var url = '<?= site_url("/regioes/visualizar_cidade/"); ?>/'+cidade_flag;
   $.getJSON(url, function(j){
                             
      var options = '';
       //options += '<option value="">Selecione...</option>';
       for (var i = 0; i < j.length; i++) {
          options += '<option value="' + j[i].ct_id + '">' + j[i].ct_nome + '</option>';
        } 
       
       $('#id_cidade').html(options).show();
       
    });

   $('#id_estado').change(function(){
 
   var url = '<?= site_url("/regioes/cidades/"); ?>/'+$(this).val();
   $.getJSON(url, function(j){
                             
      var options = '';
       options += '<option value="">Selecione...</option>';
       for (var i = 0; i < j.length; i++) {
          options += '<option value="' + j[i].ct_id + '">' + j[i].ct_nome + '</option>';
        } 
       
       $('#id_cidade').html(options).show();
       
    });

     });

</script>


