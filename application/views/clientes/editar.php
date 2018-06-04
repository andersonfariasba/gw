<?php $objDateFormat = $this->DateFormat; 

 $janela = array(
              'width'      => '2048',
              'height'     => '790',
              'scrollbars' => 'yes',
              'status'     => 'yes',
              'resizable'  => 'yes',
              'screenx'    => '200',
              'screeny'    => '100'
            );

?>

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">

				<div class="x_title">
					<h2>Dados Cliente</h2>
					<ul class="nav navbar-right panel_toolbox">
					<li><a href="<?php echo site_url('clientes/cadastrar'); ?>"><i class="fa fa-plus-circle"></i> <strong>Novo Cliente</strong></a></li>

					
					  <li><?php echo anchor_popup(site_url('pedidos/solicitar_cliente/'.ORCAMENTO.'/'.$objCliente->getId_cliente()),' <i class="fa fa-plane"></i> <strong>Gerar Orçamento</strong>',$janela);?></li>

					  <li><?php echo anchor_popup(site_url('pedidos/solicitar_cliente/'.PEDIDO.'/'.$objCliente->getId_cliente()),' <i class="fa fa-rocket"></i> <strong>Gerar Venda</strong>',$janela);?></li>


					
					<li><a href="<?php echo site_url('clientes/filtro'); ?>"><i class="fa fa-search"></i> <strong>Pesquisar Clientes</strong></a></li>

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

			  	 <?php echo form_open('clientes/editar/'.$objCliente->getId_cliente(),array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
           <input type="hidden" name="id_cliente" value="<?php echo $objCliente->getId_cliente(); ?>">
          <input type="hidden" name="id_endereco" value="<?php echo $objEntrega->getId_endereco(); ?>">
              
          <input type="hidden" name="data_cadastro" value="<?php echo $objCliente->getData_cadastro(); ?>">    

        
     
			  	   <!-- INICIO TAB GERAL -->
			  	   <div class="" role="tabpanel" data-example-id="togglable-tabs">
                   
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                      <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Dados Básicos</a>
                      </li>
                    
                       <li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab4" data-toggle="tab" aria-expanded="false">Contatos</a>
                      </li>

                      <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Anotações</a>
                      </li>

                       <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Endereço de Entrega</a>
                      </li>

                    </ul>
                    
                    <div id="myTabContent" class="tab-content">
                      
                      <!-- ABA 001 -->
                      <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                        
                       
                        
           
    

  


                        <div class="form-group">

                       


                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
								<!--<label>Tipo de Cliente</label>-->
								<p>
                      <label>Pessoa Fisica
                      <input type="radio" id="tipo_pf" name="tipo" <?php if($objCliente->getTipo()==PESSOA_FISICA){echo "checked=''"; }?>  value="<?php echo set_value('tipo',PESSOA_FISICA)?>"/></label> 
                      <label>Pessoa Jurídica:
                      <input type="radio" id="tipo_pj" name="tipo"<?php if($objCliente->getTipo()==PESSOA_JURIDICA){echo "checked=''"; }?> value="<?php echo set_value('tipo',PESSOA_JURIDICA)?>" /></label>
                     
                    </p>
							</div>

							


							

							</div>


							  <div class="form-group">

							<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">

								
								<label class="campo_pj">Nome Fantasia <span class="obrigatorio">*</span></label>
								<label class="campo_pf" style="display:none;">Nome <span class="obrigatorio">*</span></label>
								<input type="text" class="form-control" name="nome_fantasia" id="nome_fantasia" value="<?php echo set_value('nome_fantasia',$objCliente->getNome_fantasia())?>" maxlength="250"/>
							</div>

							<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback campo_pj">
								<label>Razão Social</label>
								<input type="text" class="form-control" name="razao_social" id="razao_social" value="<?php echo set_value('razao_social',$objCliente->getRazao_social())?>" maxlength="250"/>
							</div>

					    <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
								<label id="camada_cnpj">CNPJ</label>
								<label id="camada_pf" style="display:none;">CPF</label>
								<input type="text" class="form-control" name="cnpj_cpf" id="cpfcnpj" value="<?php echo set_value('cnpj_cpf',$objCliente->getCnpj_cpf())?>" maxlength="50"/>
						</div>

						 <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback campo_pf">
								<label>RG</label>
								
								<input type="text" class="form-control"  name="rg" id="rg" value="<?php echo set_value('rg',$objCliente->getRg())?>" maxlength="50"/>

								
						</div>
						</div>

						  <div class="form-group">



						<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Telefone(1)</label>
									<input type="text" class="form-control telefone_fixo" name="telefone1" id="telefone1" value="<?php echo set_value('telefone1',$objCliente->getTelefone1())?>"/>
						</div>

						<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Telefone(2)</label>
									<input type="text" class="form-control telefone_fixo" name="telefone2" id="telefone2" value="<?php echo set_value('telefone2',$objCliente->getTelefone2())?>"/>
						</div>

						<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Celular</label>
									<input type="text" class="form-control telefone" name="celular" id="celular" value="<?php echo set_value('celular',$objCliente->getCelular())?>"/>
						</div>

						


						</div>



						
						
						<div class="form-group">

						<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
									<label>CEP</label>
									<input type="text" class="form-control cep" name="cep" id="cep" value="<?php echo set_value('cep',$objCliente->getCep())?>"/>
					</div>

							
							<div class="col-md-8 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Endereço</label>
									<input type="text" class="form-control" name="endereco" id="endereco" value="<?php echo set_value('endereco',$objCliente->getEndereco())?>"/>
							</div>
					</div>

					<div class="form-group">

							<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Bairro</label>
									<input type="text" class="form-control" name="bairro" id="bairro" value="<?php echo set_value('bairro',$objCliente->getBairro())?>"/>
							</div>

							<div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Estado</label>
									<input type="text" class="form-control" name="estado" id="uf" value="<?php echo set_value('estado',$objCliente->getEstado())?>"/>
							</div>

							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Cidade</label>
									<input type="text" class="form-control" name="cidade" id="cidade" value="<?php echo set_value('cidade'.$objCliente->getCidade())?>"/>
							</div>
							

							<div class="col-md-9 col-sm-6 col-xs-12 form-group has-feedback">
									<label>E-mail</label>
									<input type="text" class="form-control" name="email" id="email" value="<?php echo set_value('email',$objCliente->getEmail())?>"/>
						</div>

						 <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback campo_pf">
								<label>Data de Nascimento</label>
								
								<input type="text" class="form-control dataManual"  name="data_nascimento" id="data_nascimento" value="<?php echo set_value('data_pagamento',$objDateFormat->date_format($objCliente->getData_nascimento()))?>" maxlength="50"/>

								
						</div>



							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback campo_pj">
									<label>Inscrição Estadual</label>
									<input type="text" class="form-control" name="insc_estadual" id="insc_estadual" value="<?php echo set_value('insc_estadual',$objCliente->getInsc_estadual())?>"/>
							</div>

							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback campo_pj">
									<label>Inscrição Municipal</label>
									<input type="text" class="form-control" name="insc_municipal" id="insc_municipal" value="<?php echo set_value('insc_municipal',$objCliente->getInsc_municipal())?>"/>
							</div>

							<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Status</label>
										<select class="form-control" name="status" id="status">
											  <?php $status = $objCliente->getStatus();?>
                <option value="<?= $objCliente->getStatus(); ?>" <?= set_select('status',$status,$objCliente->statusIs($status)); ?>>
                <?= $objCliente->printStatus(); ?></option>
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
                      
                         <!-- ABA 002 -->
                      <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

						<div class="form-group">
							
							<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
									<label>CEP</label>
									<input type="text" class="form-control" name="cep_entrega" id="cep_entrega" value="<?php echo set_value('cep_entrega',$objEntrega->getCep())?>"/>
							</div>

							<div class="col-md-8 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Endereço</label>
									<input type="text" class="form-control" name="endereco_entrega" id="endereco_entrega" value="<?php echo set_value('endereco_entrega',$objEntrega->getEndereco())?>"/>
							</div>

							<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Bairro</label>
									<input type="text" class="form-control" name="bairro_entrega" id="bairro_entrega" value="<?php echo set_value('bairro_entrega',$objEntrega->getBairro())?>"/>
							</div>

							<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Estado</label>
									<input type="text" class="form-control" name="uf_entrega" id="uf_entrega" value="<?php echo set_value('uf_entrega',$objEntrega->getEstado())?>"/>

							</div>

							<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Cidade</label>
									<input type="text" class="form-control" name="cidade_entrega" id="cidade_entrega" value="<?php echo set_value('cidade_entrega',$objEntrega->getCidade())?>"/>
							</div>

							

						

						

							

						</div>

							 <div class="form-group">
		                  
			                  <div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
								<label>Anotações Entrega</label>
								<input type="text" class="form-control" name="observacao_entrega" id="observacao_entrega" value="<?php echo set_value('observacao_entrega',$objEntrega->getObservacao())?>"/>
								
							  </div>
						  </div>




                      </div> <!-- FINAL ABA 002 -->
                      <!-- **************** -->
                      
                      <!-- ABA 003 -->
                      <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                        
                          <div class="form-group">
		                  
			                  <!--<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
								<label>Anotações</label>
								
								<textarea id="observacao" rows="10" class="form-control" name="observacao">
									  <?php echo $objCliente->getObservacao(); ?>
								</textarea>
							  
							  </div>-->

							   <!-- COMPONENTES TEXT AREA -->
							  	 <div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor">
                  <div class="btn-group">
                    <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                    </ul>
                  </div>
                  <div class="btn-group">
                    <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li>
                        <a data-edit="fontSize 5">
                          <p style="font-size:17px">Huge</p>
                        </a>
                      </li>
                      <li>
                        <a data-edit="fontSize 3">
                          <p style="font-size:14px">Normal</p>
                        </a>
                      </li>
                      <li>
                        <a data-edit="fontSize 1">
                          <p style="font-size:11px">Small</p>
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div class="btn-group">
                    <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                    <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                    <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                    <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
                  </div>
                  <div class="btn-group">
                    <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
                    <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
                    <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
                    <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>
                  </div>
                  <div class="btn-group">
                    <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
                    <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
                    <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
                    <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
                  </div>
                  <div class="btn-group">
                    <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="fa fa-link"></i></a>
                    <div class="dropdown-menu input-append">
                      <input class="span2" placeholder="URL" type="text" data-edit="createLink" />
                      <button class="btn" type="button">Add</button>
                    </div>
                    <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-cut"></i></a>

                  </div>

                  <!--<div class="btn-group">
                    <a class="btn" title="Insert picture (or just drag & drop)" id="pictureBtn"><i class="fa fa-picture-o"></i></a>
                    <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" />
                  </div>-->
                  
                  <div class="btn-group">
                    <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                    <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
                  </div>
                </div>
							  <!-- FINAL -->
							  <div id="editor"><?php echo $objCliente->getObservacao(); ?>	

							  </div>
							   
							   <textarea name="observacao" id="descr" style="display: none;">
							   
							   </textarea>




						  </div><!-- final grupo -->

                      </div>  <!-- FINAL ABA 003 -->
                      <!-- **************** -->

                       <!-- ABA CONTATOS -->
                       <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
                        
                          <div class="form-group">

                          	<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Responsável</label>
									<input type="text" class="form-control" name="responsavel" id="responsavel" value="<?php echo set_value('responsavel',$objCliente->getResponsavel())?>"/>
							</div>

							<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Setor</label>
									<input type="text" class="form-control" name="setor_resp" id="setor_resp" value="<?php echo set_value('setor_resp',$objCliente->getSetor_resp())?>"/>
							</div>

							<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Telefone(s)</label>
									<input type="text" class="form-control" name="telefone_resp" id="telefone_resp" value="<?php echo set_value('telefone_resp',$objCliente->getTelefone_resp())?>"/>
							</div>

							<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
									<label>E-mail</label>
									<input type="text" class="form-control" name="email_resp" id="email_resp" value="<?php echo set_value('email_resp',$objCliente->getEmail_resp())?>"/>
							</div>
						</div>

						 <div class="form-group">

                          	<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Responsável</label>
									<input type="text" class="form-control" name="responsavel2" id="responsavel2" value="<?php echo set_value('responsavel2',$objCliente->getResponsavel2())?>"/>
							</div>

							<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Setor</label>
									<input type="text" class="form-control" name="setor_resp2" id="setor_resp2" value="<?php echo set_value('setor_resp2',$objCliente->getSetor_resp2())?>"/>
							</div>

							<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Telefone(s)</label>
									<input type="text" class="form-control" name="telefone_resp2" id="telefone_resp2" value="<?php echo set_value('telefone_resp2',$objCliente->getTelefone_resp2())?>"/>
							</div>

							<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
									<label>E-mail</label>
									<input type="text" class="form-control" name="email_resp2" id="email_resp2" value="<?php echo set_value('email_resp2',$objCliente->getEmail_resp2())?>"/>
							</div>


						</div>

							 <div class="form-group">

                          	<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Responsável</label>
									<input type="text" class="form-control" name="responsavel3" id="responsavel3" value="<?php echo set_value('responsavel3',$objCliente->getResponsavel3())?>"/>
							</div>

							<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Setor</label>
									<input type="text" class="form-control" name="setor_resp3" id="setor_resp3" value="<?php echo set_value('setor_resp3',$objCliente->getSetor_resp3())?>"/>
							</div>

							<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
									<label>Telefone(s)</label>
									<input type="text" class="form-control" name="telefone_resp3" id="telefone_resp3" value="<?php echo set_value('telefone_resp3',$objCliente->getTelefone_resp3())?>"/>
							</div>

							<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
									<label>E-mail</label>
									<input type="text" class="form-control" name="email_resp3" id="email_resp3" value="<?php echo set_value('email_resp3',$objCliente->getEmail_resp3())?>"/>
							</div>

							
						</div>
                       


                       </div>
                       <!-- FINAL CONTATOS -->
                    

                    
                    </div><!-- FINAL CONTENT TAB -->

                  </div> <!-- FINAL TAB GERAL -->

                  <div class="ln_solid"></div>

                  <div class="col-md-12 col-sm-12 col-xs-12">
							
							<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Salvar</button>
							<!--<a href="#" class="confirm-delete btn btn-danger" data-id="<?php echo $objCliente->getId_cliente(); ?>"><i class="fa fa-trash"></i> <strong>Excluir</strong></a>-->

							
				 </div>

				 </form>



				

				</div>

		</div>  <!-- FINAL MIOLO -->

	</div> <!-- FINAL COL -->

</div> <!-- FINAL ROWS -->



 <!-- modal exclusão -->
      <div id="CalenderModalNew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel">Deseja realmente excluir o item?</h4>
            </div>
           
      <div class="modal-footer">
      <a href="#" id="btnYes" class="btn btn-danger"><i class="fa fa-trash"></i> Confirmar exclusão</a>
      <a href="#" data-dismiss="modal" aria-hidden="true" class="btn">Fechar Janela</a>
     
    </div>
          </div>
        </div>
      </div>
      <!-- final modal exclusão -->




<script type="text/javascript">

   //$("#camada_pf").hide();
   //$(".campo_pf").hide();

   var myRadio = $('input[name="tipo"]');
   var checkedValue = myRadio.filter(':checked').val();

   //PJ
   if(checkedValue==1){
   	 $("#camada_pf").hide();
   	 $(".campo_pf").hide();
   	 $("#camada_cnpj").show();
     $("#camada_razao").show();
      $(".campo_pj").show();
  }
  else{

  	 $("#camada_pf").show();
   	 $(".campo_pf").show();
   	 $("#camada_cnpj").hide();
     $("#camada_razao").hide();
      $(".campo_pj").hide();

  }

  
  



   $("#tipo_pf").click(function(){
    
   $("#camada_pf").show();
   $("#camada_cnpj").hide();
   $("#camada_razao").hide();
   $(".campo_pf").show();
   $(".campo_pj").hide();
    

                
   });

   $("#tipo_pj").click(function(){
    
    $("#camada_pf").hide();
    $("#camada_cnpj").show();
    $("#camada_razao").show();
    $(".campo_pf").hide();
    $(".campo_pj").show();
     
               
   });

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

<?php if($msg==true){ ?>
//função para ocultar mensagem de cadastro: arquivo: js/base.js
hideMessage();

<?php } ?>

</script>



<script type="text/javascript">
   $(function(){
    

       function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#endereco").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
            }

              function limpa_formulário_cep_entrega() {
                // Limpa valores do formulário de cep.
                $("#endereco_entrega").val("");
                $("#bairro_entrega").val("");
                $("#cidade_entrega").val("");
                $("#uf_entrega").val("");
            }
            
            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#endereco").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#uf").val("...");
                        

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#endereco").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#uf").val(dados.uf);
                                
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });



            //Quando o campo cep perde o foco.
            $("#cep_entrega").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#endereco_entrega").val("...");
                        $("#bairro_entrega").val("...");
                        $("#cidade_entrega").val("...");
                        $("#uf_entrega").val("...");
                        

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#endereco_entrega").val(dados.logradouro);
                                $("#bairro_entrega").val(dados.bairro);
                                $("#cidade_entrega").val(dados.localidade);
                                $("#uf_entrega").val(dados.uf);
                                
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep_entrega();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep_entrega();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep_entrega();
                }
            });
   
   
  
  

});
</script>



<!-- richtext editor -->
  
  <!-- editor -->
  <link href="<?= base_url() ?>css/editor/external/google-code-prettify/prettify.css" rel="stylesheet">
  <link href="<?= base_url() ?>css/editor/index.css" rel="stylesheet">

  <script src="<?= base_url() ?>js/editor/bootstrap-wysiwyg.js"></script>
  <script src="<?= base_url() ?>js/editor/external/jquery.hotkeys.js"></script>
  <script src="<?= base_url() ?>js/editor/external/google-code-prettify/prettify.js"></script>
  <script>
    $(document).ready(function() {
      
       $('#descr').val($('#editor').html());
      $('.xcxc').click(function() {
        $('#descr').val($('#editor').html());
      });

      $("#editor").keyup(function(){
      		//alert('teste');
      		$('#descr').val($('#editor').html());
      });



    });

    $(function() {
      function initToolbarBootstrapBindings() {
        var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier',
            'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
            'Times New Roman', 'Verdana'
          ],
          fontTarget = $('[title=Font]').siblings('.dropdown-menu');
        $.each(fonts, function(idx, fontName) {
          fontTarget.append($('<li><a data-edit="fontName ' + fontName + '" style="font-family:\'' + fontName + '\'">' + fontName + '</a></li>'));
        });
        $('a[title]').tooltip({
          container: 'body'
        });
        $('.dropdown-menu input').click(function() {
            return false;
          })
          .change(function() {
            $(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');
          })
          .keydown('esc', function() {
            this.value = '';
            $(this).change();
          });

        $('[data-role=magic-overlay]').each(function() {
          var overlay = $(this),
            target = $(overlay.data('target'));
          overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
        });
        if ("onwebkitspeechchange" in document.createElement("input")) {
          var editorOffset = $('#editor').offset();
          $('#voiceBtn').css('position', 'absolute').offset({
            top: editorOffset.top,
            left: editorOffset.left + $('#editor').innerWidth() - 35
          });
        } else {
          $('#voiceBtn').hide();
        }
      };

      function showErrorAlert(reason, detail) {
        var msg = '';
        if (reason === 'unsupported-file-type') {
          msg = "Unsupported format " + detail;
        } else {
          console.log("error uploading file", reason, detail);
        }
        $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
          '<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
      };
      initToolbarBootstrapBindings();
      $('#editor').wysiwyg({
        fileUploadError: showErrorAlert
      });
      window.prettyPrint && prettyPrint();
    });
  </script>
  <!-- /editor -->