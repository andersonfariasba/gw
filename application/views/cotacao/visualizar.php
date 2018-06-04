<link href="<?= base_url() ?>css/select/select2.min.css" rel="stylesheet">
  
<?php $objDateFormat = $this->DateFormat; 

    
      $janela = array(
              'width'      => '1024',
              'height'     => '400',
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
					<h2>Cotação de Materiais <?php //echo $qtd_cotacao_lancada." - ".$qtd_cotacao_total." - ".$status_geral; ?></h2>
					<ul class="nav navbar-right panel_toolbox">
					
					<li><a href="<?php echo site_url('cotacao/visualizar/'.$objSolicitacao->getId_solicitacao()); ?>"><i class="fa fa-refresh"></i> <strong>Atualizar Página</strong></a></li>
					<li><a href="<?php echo site_url('cotacao/filtro'); ?>"><i class="fa fa-search"></i> <strong>Pesquisar</strong></a></li>
					
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

			        
			  		<?php if($status_geral==SIM){ ?>
			        <div class="alert alert-success alert-dismissible fade in" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						</button>
						<strong><i class="fa fa-check"></i> Todos os itens dessa cotação já foram fechados!</strong>
					</div>
					<?php } ?>


			  	  <?php echo form_open('solicitacao/incluir_itens/'.$objSolicitacao->getId_solicitacao(),array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
			  	    <input type="hidden" name="id_solicitante" value="<?php echo $objSolicitacao->getId_solicitante(); ?>">
			  	    <input type="hidden" name="id_solicitacao" value="<?php echo $objSolicitacao->getId_solicitacao(); ?>">

					<div class="form-group">
						
						<?php 
								if($objSolicitacao->getColaborador()!=null){
									$solicitante = $objSolicitacao->getColaborador()->getNome();
								}
								else{
									$solicitante = "";
								}
						?>


						<div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Cod.</label>
							<input type="text" disabled class="form-control" value="<?php echo set_value('solicitante',$objSolicitacao->getId_solicitacao()); ?>"/>
						</div>

						<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Solicitante</label>
							<input type="text" disabled class="form-control" value="<?php echo set_value('solicitante',$solicitante); ?>"/>
						</div>

						<div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Data Solicitação</label>
							<input type="text" class="form-control" readonly name="data_criacao" id="data_criacao" value="<?php echo set_value('data_criacao',$objDateFormat->date_format($objSolicitacao->getData_criacao()))?>"/>
						</div>

						<div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Data de Necessidade</label>
							<input type="text" class="form-control" readonly name="data_necessidade" id="data_necessidade" value="<?php echo set_value('data_necessidade',$objDateFormat->date_format($objSolicitacao->getData_necessidade()))?>"/>
						</div>

					<?php 

					if($objSolicitacao->getObjStatusCotacao()!=null){
						$status = strtoupper($objSolicitacao->getObjStatusCotacao()->getStatus()); 
					}else{
						$status = "";
					}

					?>

						<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Status Cotação</label>
							<input style="font-size:11px;" type="text" disabled class="form-control" value="<?php echo set_value('solicitante',$status); ?>"/>
						</div>

						

						

					</div>

					<?php 
						if($objSolicitacao->getAprovador()!=null){
							$aprovador = $objSolicitacao->getAprovador()->getNome();
						}
						else{
							$aprovador = "";
						}
						
						
						if($objSolicitacao->getData_aprovacao_cotacao()!=null){
						?>
					
						<div class="form-group">
						
							<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
								<label>Aprovador</label>
								<input type="text" disabled class="form-control" value="<?php echo set_value('aprovador',$aprovador); ?>"/>
							</div>


						<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Data Aprovação Cotação</label>
							<input type="text" class="form-control" disabled id="data_aprovacao_cotacao" value="<?php echo set_value('data_aprovacao_cotacao',$objDateFormat->date_format($objSolicitacao->getData_aprovacao_cotacao()))?>"/>
						</div>

						</div>
						<?php } ?>

						<?php if($objSolicitacao->getObservacao()!=""){ ?>
							<div class="form-group">
						
							<div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
								<label>Observação da Solicitação</label>
								<input type="text" value="<?php echo $objSolicitacao->getObservacao(); ?>" class="form-control" readonly></input>
							</div>
							</div>
						
						<?php } ?>

						<?php if($objSolicitacao->getObservacao_cotacao()!=""){ ?>
							<div class="form-group">
						
							<div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
								<label>Observação da Cotação</label>
								<input type="text" value="<?php echo $objSolicitacao->getObservacao_cotacao(); ?>" class="form-control" readonly></input>
							</div>
							</div>
						
						<?php } ?>

						

					
					
					<!--<div>
						<div class="col-md-12 col-sm-12 col-xs-12">
							
							<button type="submit" class="btn btn-success"><i class="fa fa-plus-circle"></i> Incluir</button>
							</form>
						</div>
					</div>-->

					<!--<div class="ln_solid"></div>-->

					<!--<div class="x_title">
							<h2>Materiais</h2>

							<div class="clearfix"></div>
							</div>-->


						<div class="ln_solid"></div>

						<!-- LISTA DOS ITENS -->

						<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
							<thead>
							<tr class="fundoTituloTabela">
							<th>COD.</th>
							<th>MATERIAL</th>
							<th>QTD</th>
							<th>PREÇO FINAL</th>
							<th>SUB-TOTAL</th>
							<th>MENOR COTAÇÃO</th>
								<th>DT. ENTREGA</th>
							<th>ULT. COMPRA</th>

							<!--<th>PREÇO CUSTO</th>-->
							
							<!--<th>FORN. VENCEDOR</th>-->
							
						
							<th>OPERAÇÕES</th>
							</tr>
							</thead>

							<tbody>
							<?php 
							$sub_total = 0;
							$total = 0;
							foreach ($listItens as $objIten):
								$sub_total = $objIten['valor_final'] * $objIten['qtd'];
								$total = $total + $sub_total;

							 ?>
							<tr class="dadosTabela">
							<td><?php echo $objIten['id_produto']; //echo $objIten->getProduto()->getId_produto(); ?></td>
							<td><?php echo $objIten['descricao']; //echo $objIten->getProduto()->getDescricao(); ?></td>
							<td><?php echo $objIten['qtd']; //echo $objIten->getQtd(); ?></td>
							<td>
							
							<?php echo number_format($objIten['valor_final'], 2, ',', '.'); ?>
								
							</td>
							<td><?php echo number_format($sub_total, 2, ',', '.'); ?></td>
							<td><?php echo $objIten['menor_cotacao']; ?></td>
							<td><?php echo $objDateFormat->date_format($objIten['data_entrega']); ?></td>
							
							<td>
						<?php		
						//Resgatar última compra
						$pedidoBusiness = $this->Factory->createBusiness("comp_pedidos");
                        $ultimaCompra = $pedidoBusiness->ultima_compra($objIten['id_produto']);
						if($ultimaCompra!=null){
						echo number_format($ultimaCompra['valor_unitario'], 2, ',', '.');
						echo "<br>";
						echo $ultimaCompra['nome_fantasia'];
						}
						?>		
							</td>


							<!--<td></td>-->
							

							
							
							
							
							<td class="td-actions">
							
							
							<?php //if($objSolicitacao->getId_status_cotacao()==EM_ELABORACAO || $objSolicitacao->getId_status_cotacao()==ST_EM_APROVACAO || $objSolicitacao->getId_status_cotacao()==ST_APROVADO_PARCIAL){ 

								if($status_geral==NAO){
								?>
							 
							 <a data-toggle="modal" data-id="<?php echo $objIten['id_item']; ?>" data-qtd="<?php echo $objIten['qtd']; ?>" href="#modal_item" class="dadosItem btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Incluir Preço</a>
							 	<br />
							  
							 <!-- <a href="<?php echo site_url('solicitacao/incluir_itens/'.$objSolicitacao->getId_solicitacao()); ?>" class="btn btn-primary btn-sm" target="__blank"><i class="fa fa-pencil"></i> Editar Qtd</a>-->
							 	
							 	<?php } ?>
							 	
							 	
							  <a data-toggle="modal" data-id="<?php echo $objIten['id_item']; ?>" data-descricao="<?php echo $objIten['descricao']; ?>" href="#modal_item_listar" class="listarCotacao btn btn-primary btn-sm"><i class="fa fa-search"></i> Listar Preço</a>

						
							
						

							</td>

							</tr>

							<?php endforeach;?>


							</tbody>

						</table>

						<!--<h2 class="btn btn-primary"><strong>TOTAL COTAÇÃO R$ <?php echo number_format($total, 2, ',', '.'); ?></strong></h2>-->

						<!--<h2 class="btn"><a data-toggle="modal" data-id="<?php echo $objSolicitacao->getId_solicitacao(); ?>" href="#modal_item_listar" class="listarCotacao btn btn-primary"><strong>TOTAL COTAÇÃO R$ <?php echo number_format($total, 2, ',', '.'); ?></strong></a></h2>-->

						<div class="form-group">

							<div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">

							<label>&nbsp;</label>
							<br />
							<!--<button type="submit" class="btn btn-primary"><strong><i class="fa fa-check"></i> Confirmar Solicitação</strong> </button>-->

							<a data-toggle="modal" data-id="<?php echo $objSolicitacao->getId_solicitacao(); ?>" href="#modal_fornecedor_listar" class="listarFornecedor btn btn-primary"><strong><i class="fa fa-search"></i> TOTAL COTAÇÃO R$ <?php echo number_format($total, 2, ',', '.'); ?></strong> </a>

							</div>
						</div>
						




						<!-- FINAL LISTA DOS ITENS -->

							<?php if($status_geral!=SIM){ ?>
					<div class="form-group">

							<div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">

							<label>&nbsp;</label>
							<br />
							<!--<button type="submit" class="btn btn-primary"><strong><i class="fa fa-check"></i> Confirmar Solicitação</strong> </button>-->

							<a data-toggle="modal" href="#modal_pesquisa" class="btn btn-success"><strong><i class="fa fa-check"></i> Confirmar Cotação</strong> </a>

							</div>
						</div>
					<?php } ?>




				</div>

				

					

					



		</div>  <!-- FINAL MIOLO -->

	</div> <!-- FINAL COL -->

</div> <!-- FINAL ROWS -->


<!-- Start Calendar modal -->
<!-- ESSE MODAL NÃO ESTÁ SENDO USADO -->
      <div id="modal_pesquisa__" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-check"></i> Confirmar Solicitação</h4>
            </div>
            <div class="modal-body">
              <div id="testmodal">
                <!--<form id="antoform" class="form-horizontal" role="form">-->
                 <form class="form-horizontal" method="post" id="forgot_form" action="<?php echo base_url(); ?>solicitacao/confirmar/">
                 
                 <input type="hidden" name="id_solicitacao" value="<?php echo $objSolicitacao->getId_solicitacao(); ?>">
                  
               
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Código</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" readonly class="form-control" value="<?php echo set_value('categoria',$objSolicitacao->getId_solicitacao())?>" maxlength="50"/>
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Requisitante</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" readonly class="form-control" value="<?php echo set_value('categoria',$solicitante)?>" maxlength="50"/>
                    </div>
                  </div>


                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Data Criação</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_criacao" value="<?php echo set_value('categoria',$objDateFormat->date_format($objSolicitacao->getData_criacao()))?>" />
                    </div>
                  </div>

                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Data Prioridade</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_necessidade" value="<?php echo set_value('categoria',$objDateFormat->date_format($objSolicitacao->getData_necessidade()))?>"/>
                    </div>
                  </div>
               

                   
                   


                  

                 
                
              </div>
            </div>
            <div class="modal-footer">
              <!--<button type="button" class="btn antoclose" data-dismiss="modal">Fechar</button>-->
              <a href="#" data-dismiss="modal" aria-hidden="true" class="btn">Fechar Janela</a>
              <button type="submit" class="btn btn-primary"><strong><i class="fa fa-check"></i> Confirmar Solicitação</strong></button>

              </form>
            </div>
          </div>
        </div>
      </div>


      <!-- final modal pesquisa -->


<!-- Start Calendar modal -->
      <div id="modal_pesquisa" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-check"></i> Confirmar Cotação</h4>
            </div>
            <div class="modal-body">
              <div id="testmodal">
                <!--<form id="antoform" class="form-horizontal" role="form">-->
                 <form class="form-horizontal" method="post" id="forgot_form" action="<?php echo base_url(); ?>cotacao/confirmar/">
                 
                 <input type="hidden" name="id_solicitacao" value="<?php echo $objSolicitacao->getId_solicitacao(); ?>">
                  
               
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Código</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" readonly class="form-control" value="<?php echo set_value('categoria',$objSolicitacao->getId_solicitacao())?>" maxlength="50"/>
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Requisitante</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" readonly class="form-control" value="<?php echo set_value('categoria',$solicitante)?>" maxlength="50"/>
                    </div>
                  </div>


                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Data Criação</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" readonly name="data_criacao" value="<?php echo set_value('categoria',$objDateFormat->date_format($objSolicitacao->getData_criacao()))?>" />
                    </div>
                  </div>

                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Data de Necessidade</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" readonly class="form-control calendario" name="data_necessidade" value="<?php echo set_value('categoria',$objDateFormat->date_format($objSolicitacao->getData_necessidade()))?>"/>
                    </div>
                  </div>
               

                   
                   


                    

                  
                   <?php if($this->session->userdata('id_perfil')==PERFIL_COORDENADOR || $this->session->userdata('id_perfil')==PERFIL_MASTER){ ?>  
                    
                    <?php //if($objUser->getId_perfil()==PERFIL_COORDENADOR){ ?>  
                   
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                   
                      <select class="form-control" name="id_status_cotacao" id="id_status_cotacao">
                         <!--<option value="<?php $objSolicitacao->getObjStatus()->getId_status() ?>"> <?php echo strtoupper($objSolicitacao->getObjStatus()->getStatus()); ?> </option>-->
                         <?php foreach ($listStatus as $objStatus): 
                             $statusx = $objStatus->getId_status();
                             ?>
                        <option value="<?php echo $objStatus->getId_status(); ?>" <?php echo set_select('id_status_cotacao',$statusx,$objSolicitacao->statusCotacaoIs($statusx)); ?>>
                          
                           <?php 

                         
                           	echo $objStatus->getStatus();
                       	    
                            
                            ?>
                       
                        </option>
                         <?php endforeach; ?>

                       
                        </select>

                    </div>
                  </div>


                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Observação</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                     
                      <textarea class="form-control" name="observacao_cotacao"><?php echo $objSolicitacao->getObservacao_cotacao(); ?></textarea>
                    </div>
                  </div>
                  <?php } else{ ?>

                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Observação</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                     
                      <textarea class="form-control" readonly><?php echo $objSolicitacao->getObservacao_cotacao(); ?></textarea>
                    </div>
                  </div>
                  
                  <?php } ?>



                     <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Coordenador Aprovação</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                     
                      

                      <select class="form-control" name="id_aprovador_cotacao" id="id_aprovador_cotacao">
                         
                         <!---->
                           <!--<option value="">Selecione ...</option>-->
                           
                          <?php if($objUser->getId_perfil()!=PERFIL_COORDENADOR && $objUser->getId_perfil()!=PERFIL_MASTER){ ?>  
                        
                         <?php foreach ($listUser as $objUser): 
                             $aprovador = $objUser->getId_colaborador();
                             ?>
                        <option value="<?php echo $objUser->getId_colaborador(); ?>" <?php echo set_select('id_aprovador_cotacao',$aprovador,$objSolicitacao->aprovadorCotacaoIs($aprovador)); ?>>
                           <?php echo $objUser->getColaborador()->getNome(); ?>
                        </option>
                         <?php endforeach; ?>

                         <?php } else { ?>

                         <option value="<?php echo $objUser->getId_colaborador()?>"><?php echo $objUser->getColaborador()->getNome()?></option>

                         <?php } ?>

                       
                        </select>

                    </div>
                  </div>

                   
                
              </div>
            </div>
            <div class="modal-footer">
              <!--<button type="button" class="btn antoclose" data-dismiss="modal">Fechar</button>-->
              <a href="#" data-dismiss="modal" aria-hidden="true" class="btn">Fechar Janela</a>
              <button type="submit" class="btn btn-primary"><strong><i class="fa fa-check"></i> Confirmar Cotação</strong></button>
              </form>
            </div>
          </div>
        </div>
      </div>


      <!-- final modal pesquisa -->




<!-- MODAL EDITAR ITEM -->
      <div id="modal_item" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil"></i> Incluir Preço</h4>
            </div>
            <div class="modal-body">
              <div id="testmodal">
               
                 <form class="form-horizontal" id="ajax_edit_itens">

                 <!--<form class="form-horizontal" method="post" id="forgot_form" action="<?php echo base_url(); ?>cotacao/add_preco/">-->

                 
                 <input type="hidden" name="id_solicitacao" id="edit_id_solicitacao" value="<?php echo $objSolicitacao->getId_solicitacao(); ?>">
                 <input type="hidden" name="id_item" id="edit_id_item">
                   <input type="hidden" name="id_produto" id="edit_id_produto">
                   
                                   
               
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Material</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" readonly class="form-control" id="edit_produto_nome" />
                    </div>
                  </div>

                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Qtd</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control"  onkeypress='return SomenteNumero(event)' id="edit_qtd" name="qtd" />
                    </div>
                  </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Fornecedor:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                    <select class="form-control" name="id_fornecedor" id="id_fornecedor">
                        <option value="">Selecione...</option>
                         <?php foreach ($listFornecedor as $objFornecedor):   ?>
                           
                        <option value="<?php echo $objFornecedor->getId_fornecedor(); ?>" <?php echo set_select('id_fornecedor',$objFornecedor->getId_fornecedor()); ?>>
                           <?php echo $objFornecedor->getNome_fantasia(); ?>
                        </option>
                         <?php endforeach; ?>
                    </select>

                    </div>
                  </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Preço Unitário(R$):</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" tipo="moneyReal" id="valor" name="valor"/>
                    </div>
                  </div>


                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Data de Entrega:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_entrega" id="data_entrega"/>
                    </div>
                  </div>


                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Observacao</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" name="observacao" id="observacao" class="form-control"/>

                    </div>
                  </div>

                  <div class="form-group">
                      <label class="control-label col-md-6 col-sm-3 col-xs-12">Confirmar compra para esse fornecedor?</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                     <input type="checkbox" name="status" id="status_check" value="<?php echo set_value('status',COTACAO_APROVADA)?>">
                    </div>
                  </div>

                  <div class="alert alert-success alert-dismissible fade in" role="alert"  id="msgOk" style="display:none;">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
						</button>
						<strong><i class="fa fa-check"></i> Cadastro realizado com sucesso!</strong>
					</div>

                            

                  

                   
                
              </div>
            </div>
            <div class="modal-footer">
             
              <a href="#" data-dismiss="modal" aria-hidden="true" class="btn">Fechar Janela</a>
              <!--<button type="submit" class="btn btn-primary"><strong><i class="fa fa-plus-circle"></i> Incluir Preço</strong></button>-->
               <button class="btn btn-primary" id="edit_itens_btn"><strong><i class="fa fa-plus-circle"></i> Incluir Preço</strong></button>

              </form>
            </div>
          </div>
        </div>
      </div>


      <!-- final modal pesquisa -->


      <!-- MODAL EDITAR ITEM -->
      <div id="modal_item_listar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-search"></i> Exibir Preço -   <span class="nome_produto"></span> </h4>
             

            </div>
            <div class="modal-body">
              <div id="testmodal">
                


                 <table class="table table-striped table-bordered dt-responsive nowrap" id="tabela_lista_cotacao" cellspacing="0" width="100%">
            <thead>
              <tr>
                     <th>FORNECEDOR</th>
                     <th>QTD</th>
                     <th>VALOR UN.</th>
                     <th>SUB-TOTAL</th>
                     <th>DATA ENTREGA</th>
                     <th>CONFIRMAR</th>
                     <th>EXCLUIR</th>


               </tr>
               </thead>
               <tbody>
               	
               </tbody>
               
               </table>   
                            

                  

                   
                
              </div>
            </div>
            <div class="modal-footer">
              <!--<button type="button" class="btn antoclose" data-dismiss="modal">Fechar</button>-->
              <a href="#" data-dismiss="modal" aria-hidden="true" class="btn">Fechar Janela</a>
                         
            </div>
          </div>
        </div>
      </div>


      <!-- final modal pesquisa -->




      <!-- MODAL LISTAR FORNECEDOR -->
      <div id="modal_fornecedor_listar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-search"></i> FORNECEDORES</h4>
             

            </div>
            <div class="modal-body">
              <div id="testmodal">
                


                 <table class="table table-striped table-bordered dt-responsive nowrap" id="tabela_lista_fornecedor" cellspacing="0" width="100%">
            <thead>
              <tr>
                     <th>FORNECEDOR</th>
                      <th>TOTAL</th>
                   


               </tr>
               </thead>
               <tbody>
               	
               </tbody>
               
               </table>   
                            

                  

                   
                
              </div>
            </div>
            <div class="modal-footer">
              <!--<button type="button" class="btn antoclose" data-dismiss="modal">Fechar</button>-->
              <a href="#" data-dismiss="modal" aria-hidden="true" class="btn">Fechar Janela</a>
                         
            </div>
          </div>
        </div>
      </div>


      <!-- final modal pesquisa -->





<script type="text/javascript">

<?php if($msg==true){ ?>
//função para ocultar mensagem de cadastro: arquivo: js/base.js
hideMessage();

<?php } ?>

</script>


<script type="text/javascript" src="<?php echo base_url(); ?>js/text_numero.js"></script>

<script src="<?= base_url() ?>js/select/select2.full.js"></script>
<script src="<?= base_url() ?>js/jquery_plugin_cpfcnpj.js"></script> 

  <script>
    $(document).ready(function() {

			$(".select2_single").select2({
			placeholder: "Selecione...",
			allowClear: false
			});
			$(".select2_group").select2({});
			$(".select2_multiple").select2({
			maximumSelectionLength: 4,
			placeholder: "With Max Selection limit 4",
			allowClear: true
			});
	});

  $('#id_obra').change(function(){
 
   var url = '<?= site_url("/centro_custos/ajax_listar_por_obra/"); ?>/'+$(this).val();
   $.getJSON(url, function(j){
                             
      var options = '';
       //options += '<option value="">Selecione...</option>';
       for (var i = 0; i < j.length; i++) {
          options += '<option value="' + j[i].id_custo + '">' + j[i].custo + '</option>';
        } 
       
       $('#id_custo').html(options).show();
       
    });

     });


 $("#confirmar").click(function(){
        //$("#myModal").modal();
        alert('teste');
 });

  $(".dadosItem").click(function(){

  	   $("#msgOk").hide();
  	 //****** PEGA OS DADOS REFERENTE AO ITEM PARA SER EXIBIDO         
       var id_item = $(this).data('id');
       var qtd = $(this).data('qtd');
       //alert(qtd);



      var url = '<?= site_url("/solicitacao/ajax_visualizar_item/"); ?>/'+id_item;
    
   $.getJSON(url, function(j){
                             
    
       //var id_item = "";
       var id_solicitacao = "";
       var id_produto = "";
       var produto_nome = "";
       var custo = "";
      
       var obra = "";

       
       for (var i = 0; i < j.length; i++) {
        
          id_item = j[i].id_item;
          id_solicitacao = j[i].id_solicitacao;
          id_produto = j[i].id_produto;
          //qtd = j[i].qtd;
          produto_nome = j[i].produto_nome;
          //custo = j[i].custo;
          //obra = j[i].obra;



        } 


      $("#edit_id_item").val(id_item);
      $("#edit_id_solicitacao").val(id_solicitacao);
      $("#edit_id_produto").val(id_produto);
      $("#edit_qtd").val(qtd);
      //$("#edit_custo").val(custo);
      //$("#edit_obra").val(obra);
      $("#edit_produto_nome").val(produto_nome);
      $(".nome_produto").text(produto_nome);
     
    });
	 // FINAL ****** PEGA OS DADOS REFERENTE AO ITEM PARA SER EXIBIDO  



 });


 	//********** LISTA OS ITENS INSERIDOS NA COTAÃO *************
 	$(".listarCotacao").click(function(){

 		  var id_item = $(this).data('id');
 		  var descricao_produto = $(this).data('descricao');
 		  $(".nome_produto").text(descricao_produto);

 		  //MIOLO

 		  	var url_fat = '<?= site_url("/cotacao/ajax_listar_cotacao/"); ?>/'+id_item;
              $.getJSON(url_fat, function(j){

              //var options = '';
              //options += '<option value="">Nenhum...</option>';
              
              var html = '';
              var total_pago = 0;
              var rowCount = 0;
              var nome_produto;
              var css_aprovado = '';
              var data_entrega = '';

              //var flag_lancada = 0;
              var count_lancada = 0;

              for (var i = 0; i < j.length; i++) {
              nome_produto = j[i].descricao;
              //total_pago = parseFloat(total_pago) + parseFloat(j[i].valor);
               rowCount++;
              //options += '<option value="' + j[i].id_bandeira + '">' + j[i].bandeira + '</option>';

              	if(j[i].status==1){
              		css_aprovado = 'style=color:#006400;font-weight:900;';
              	}
              	else{
              		css_aprovado = '';
              	}

              	if(j[i].data_entrega!=null){
              		data_entrega = j[i].data_entrega;
              	}
              	else{
              		data_entrega = '';
              	}

              	if(j[i].lancada==1){
              		count_lancada++;
              	}


              

              //CASO O STATUS DA COTAÇÃO SEJA APROVADO NAO EXIBIR ITENS DE EXCLUSÃO E CONFIRMAR
              <?php //if($objSolicitacao->getId_status_cotacao()!=ST_APROVADO){ ?>
               
               if(count_lancada==0){
               html+= '<tr '+css_aprovado+'><td>'+j[i].nome_fantasia+'</td><td>'+j[i].qtd+'</td><td>'+j[i].valor+'</td><td>'+j[i].sub_total +'</td><td>'+data_entrega+'</td><td class=td-actions><a href="<?= site_url("/cotacao/aprovar_item/"); ?>/'+j[i].id_cotacao +'/'+j[i].id_solicitacao+' " id="excluir_fat" class="confirm btn-sm btn-success" data-id='+ j[i].id_cotacao +'><i class="fa fa-thumbs-up"></i></a></td> <td class=td-actions><a href="<?= site_url("/cotacao/excluir_item/"); ?>/'+j[i].id_cotacao +'/'+j[i].id_solicitacao+'" id="excluir_fat" class="confirm-delete-teste btn-sm btn-danger" data-id='+ j[i].id_cotacao +'><i class="fa fa-trash"></i></a></td></tr>';
               }
               
               else
                 {
              
               <?php //} else{ ?>

               	
               	 html+= '<tr '+css_aprovado+'><td>'+j[i].nome_fantasia+'</td><td>'+j[i].qtd+'</td><td>'+j[i].valor+'</td><td>'+j[i].sub_total +'</td><td>'+data_entrega+'</td><td class=td-actions></td> <td class=td-actions></td></tr>';

               	}

               	<?php //} ?>



               
              }

               $("#tabela_lista_cotacao > tbody:last").html(html);
                //$(".nome_produto").text(nome_produto);
             
     		});

 		  //FINAL MIOLO


 	

 	}); //FINAL
 	//********** LISTA OS ITENS INSERIDOS NA COTAÃO *************

  
 //INICIO LISTA TOTAL DE FORNECEDORES

//********** LISTA OS ITENS INSERIDOS NA COTAÃO *************
 	$(".listarFornecedor").click(function(){

 		  var id_solicitacao = $(this).data('id');

 		  //alert(id_solicitacao);
 		 

 		  //MIOLO

 		  	var url_fat = '<?= site_url("/cotacao/ajax_listar_fornecedor/"); ?>/'+id_solicitacao;
              $.getJSON(url_fat, function(j){

              //var options = '';
              //options += '<option value="">Nenhum...</option>';
              
              var html = '';
              var total_pago = 0;
              var rowCount = 0;
              var nome_produto;
              var css_aprovado = '';
              var data_entrega = '';

              //var flag_lancada = 0;
              var count_lancada = 0;

              for (var i = 0; i < j.length; i++) {
              nome_produto = j[i].descricao;
              //total_pago = parseFloat(total_pago) + parseFloat(j[i].valor);
               rowCount++;
              //options += '<option value="' + j[i].id_bandeira + '">' + j[i].bandeira + '</option>';

                           

                      
               
             
      html+= '<tr><th>'+j[i].fornecedor+'</th><th>R$: '+j[i].total +'</th></tr>';

             

        }

               $("#tabela_lista_fornecedor > tbody:last").html(html);
                //$(".nome_produto").text(nome_produto);
             
     		});

 		  //FINAL MIOLO


 	

 	}); //FINAL


 //FINAL DA LISTA




  $('#edit_itens_btn').click(function(e){
    //alert('TESTE');
      if($("#edit_qtd").val()=="")

      {
        alert("CAMPO QTD OBRIGATORIO")
         return false;
      }

      if($("#id_fornecedor").val()=="")

      {
        alert("CAMPO FORNECEDOR OBRIGATORIO")
         return false;
      }

      else {

    e.preventDefault();

     $.ajax({
             type: 'POST',
             url: "<?php echo site_url('cotacao/add_preco/'); ?>",         
             data: $('#ajax_edit_itens').serialize(),
             success : function(txt){
              var id_solicitacao = $("#edit_id_solicitacao").val();
              		
              //$('#myModal').modal('hide');
              $("#valor").val("");
              $("#data_entrega").val("");
              $("#observacao").val("");
              $("#id_fornecedor").val("");
              //$("#status_check").val("");
              $("#msgOk").show();

			if ($('#status_check').is(":checked"))
			{
				window.location.href="<?php echo site_url('cotacao/visualizar/'); ?>/"+id_solicitacao;
			}

               //var tipo = 2;
               
             
               
               //window.opener.location.href="<?php echo site_url('pedidos/filtro/'); ?>/"+tipo;
                               
              //window.close();
       },
        error: function (request, status, error) {
              alert(request.responseText);
              //alert('VENDA NÃO REALIZADA!');
              //window.back();
         }
             
         });

         return false;
}


  }); // FINAL EDIT PEDIDOS





  </script>


