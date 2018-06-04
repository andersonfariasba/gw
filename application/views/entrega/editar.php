<?php $objDateFormat = $this->DateFormat; ?>

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">

				<div class="x_title">
					<h2>Editar Entrega</h2>
					<ul class="nav navbar-right panel_toolbox">
					
					<li><a href="<?php echo site_url('entrega/filtro'); ?>"><i class="fa fa-search"></i> <strong>Pesquisar Entregas</strong></a></li>
					
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

			  	  <?php echo form_open('entrega/editar/'.$objItem->getId_item(),array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
			  	  <input type="hidden" name="id_item" value="<?php echo $objItem->getId_item(); ?>" />

			  	  	<div class="form-group">
						
						<?php 
								$produto = "";
								$cod_produto = "";
								if($objItem->getProduto()!=null){
									$produto = $objItem->getProduto()->getDescricao();
									
									$cod_produto = $objItem->getProduto()->getCodigo();

								}

								$cliente = "";

								if($objPedido->getCliente()!=null){
									$cliente = $objPedido->getCliente()->getNome_fantasia();
								}

						?>						

						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Cliente</label>
							<input type="text" class="form-control" readonly value="<?php echo set_value('cliente',$cliente)?>" maxlength="50"/>
						</div>

						<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Produto</label>
							<input type="text" class="form-control" readonly value="<?php echo set_value('produto',$cod_produto." ".$produto)?>" maxlength="50"/>
						</div>
						

						<div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Código Pedido</label>
							<input type="text" class="form-control" readonly value="<?php echo set_value('qtd',$objPedido->getCodigo())?>" maxlength="50"/>
						</div>

					</div>

					<div class="form-group">
						
						<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Data Prevista de Entrega</label>
							<input type="text" readonly class="form-control calendario" id="data_prev_entrega" value="<?php echo set_value('data_prev_entrega', $objDateFormat->date_format($objItem->getData_prev_entrega()))?>" maxlength="50"/>
						</div>

						<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Data da Entrega Realizada</label>
							<input type="text" class="form-control calendario" name="data_entrega_final" id="data_entrega_final" value="<?php echo set_value('data_entrega_final', $objDateFormat->date_format($objItem->getData_entrega_final()))?>" maxlength="50"/>
						</div>

						<?php 
							$qtd_entregue = 0;
							if($objItem->getQtd_entregue()>0){
								$qtd_entregue = $objItem->getQtd_entregue();
							}

						?>

						
						<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Qtd Solicitada / Entregue</label>
							<input type="text" class="form-control" readonly value="<?php echo set_value('qtd',round($objItem->getQtd())." / ".$qtd_entregue)?>" maxlength="50"/>
						</div>

						<?php if($objItem->getQtd_entregue()!=$objItem->getQtd()){ ?>
						<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Qtd Entregue</label>
							<input type="text" class="form-control" name="qtd_entregue" value="<?php echo set_value('qtd_entregue')?>" maxlength="50"/>
						</div>
						<?php }else{ ?>
							<input type="hidden" name="qtd_entregue" value="<?php echo $objItem->getQtd_entregue();?>" />
						<?php } ?>

				   </div>


<div class="form-group">

	<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Conferente</label>
						 <select class="form-control" name="conferente" id="conferente">
						 <option value="">Selecione...</option>
                       
                         <?php foreach ($listUser as $objUser): 
                             
                             ?>
                        <option <?php if($objItem->getConferente()==$objUser->getLogin()){echo "selected"; }  ?> value="<?php echo $objUser->getLogin(); ?>" <?php echo set_select('conferente'); ?>>
                           <?php echo $objUser->getLogin(); ?>
                        </option>
                         <?php endforeach; ?>

                       
                        </select>
                        </div>



	<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Forma de Entrega</label>
						 <select class="form-control" name="forma_entrega" id="forma_entrega">
						 <option value="">Selecione...</option>
                       
                         <?php foreach ($listForma as $objForma): 
                             
                             ?>
                        <option <?php if($objItem->getForma_entrega()==$objForma->getForma()){echo "selected"; }  ?>  value="<?php echo $objForma->getForma(); ?>" <?php echo set_select('forma'); ?>>
                           <?php echo $objForma->getForma(); ?>
                        </option>
                         <?php endforeach; ?>

                       
                        </select>
                        </div>
				   	
				   	<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Status Entrega</label>
						 <select class="form-control" name="id_status" id="id_status">
						 <option value="">Selecione...</option>
                       
                         <?php foreach ($listStatus as $objStatus): 
                             $status = $objStatus->getId_status();
                             ?>
                        <option value="<?php echo $objStatus->getId_status(); ?>" <?php echo set_select('id_status',$status,$objItem->statusIs($status)); ?>>
                           <?php echo $objStatus->getStatus(); ?>
                        </option>
                         <?php endforeach; ?>

                       
                        </select>
                        </div>


                       </div>

                       <div class="form-group">
				   	<div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Anotações</label>
							<input type="text" class="form-control" name="descricao" value="<?php echo set_value('descricao',$objItem->getDescricao())?>"/>
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


