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
					<h2>Pedido de Compras <?php //echo $qtd_cotacao_lancada." - ".$qtd_cotacao_total." - ".$status_geral; ?></h2>
					<ul class="nav navbar-right panel_toolbox">
					
					<li><a href="<?php echo site_url('pedido_compra/filtro'); ?>"><i class="fa fa-search"></i> <strong>Pesquisar Pedido de Compras</strong></a></li>
					
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
						<strong><i class="fa fa-check"></i> Todos os itens já foram fechados!</strong>
					</div>
					<?php } ?>



			  	  <?php echo form_open('pedido_compra/aprovar/'.$objSolicitacao->getId_solicitacao(),array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
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
							<input type="text" readonly class="form-control" name="data_criacao" id="data_criacao" value="<?php echo set_value('data_criacao',$objDateFormat->date_format($objSolicitacao->getData_criacao()))?>"/>
						</div>

						<div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Data de Necessidade</label>
							<input type="text" readonly class="form-control" name="data_necessidade" id="data_necessidade" value="<?php echo set_value('data_necessidade',$objDateFormat->date_format($objSolicitacao->getData_necessidade()))?>"/>
						</div>

					<?php 

					if($objSolicitacao->getObjStatusCotacao()!=null){
						$status = strtoupper($objSolicitacao->getObjStatusCotacao()->getStatus()); 
					}else{
						$status = "";
					}

					?>

						<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Status Cotacao</label>
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
						
						
						if($objSolicitacao->getData_aprovacao()!=null){
						?>
					
						<div class="form-group">
						
						<div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Data Aprovação</label>
							<input type="text" class="form-control" disabled id="data_aprovacao" value="<?php echo set_value('data_aprovacao',$objDateFormat->date_format($objSolicitacao->getData_aprovacao()))?>"/>
						</div>

							<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
								<label>Aprovador Cotação</label>
								<input type="text" disabled class="form-control" value="<?php echo set_value('aprovador',$aprovador); ?>"/>
							</div>


					


						<!-- MOSTRAR APROVADOR CONTROLADORIA -->

						<?php 
						
						if($objSolicitacao->getAprovadorDiretoria()!=null){
							$aprovadorDiretoria = $objSolicitacao->getAprovadorDiretoria()->getNome();
						}
						else{
							$aprovadorDiretoria = "";
						}
						
						
					?>

					        
					      

					       <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
								<label>Administrador</label>
								<input type="text" disabled class="form-control" value="<?php echo set_value('aprovador',$aprovadorDiretoria); ?>"/>
							</div>



						<!-- FINAL EXIBIÇÃO CONTROLADORIA -->





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


						

							<div class="x_title">
							<h2>Controle de Aprovações</h2>

							<div class="clearfix"></div>
							</div>
						


						<div class="form-group">
						
						
						<?php if($this->session->userdata('id_perfil')==PERFIL_MASTER) { ?>
						
						<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Status Administrador</label>
							<select name="id_status_diretoria" id="id_status_diretoria" class="form-control">
							<option value="">Selecione...</option>
							 <?php foreach ($listStatus as $objStatusDir): 
                             $statusDir = $objStatusDir->getId_status();
                             ?>
                        <option value="<?php echo $objStatusDir->getId_status(); ?>" <?php echo set_select('id_status_diretoria',$statusDir,$objSolicitacao->statusDiretoriaIs($statusDir)); ?>>
                           <?php echo $objStatusDir->getStatus(); ?>
                        </option>
                         <?php endforeach; ?>
							
							</select>
						</div>

						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Observação Administrador</label>
							<input type="text" name="observacao_diretoria" class="form-control" value="<?php echo set_value('observacao_diretoria',$objSolicitacao->getObservacao_diretoria()); ?>"/>
						</div>
						<?php } ?>

						
						
						<?php //if( ($objSolicitacao->getId_status_diretoria()!=ST_APROVADO) && ( $this->session->userdata('id_perfil')==PERFIL_MASTER || $this->session->userdata('id_perfil')==PERFIL_CONTROLADORIA ) ){

						if( ($status_geral==NAO) AND ($this->session->userdata('id_perfil')==PERFIL_MASTER || $this->session->userdata('id_perfil')==PERFIL_COORDENADOR) ){		

						 ?>

						<div class="col-md-1 col-sm-6 col-xs-12 form-group has-feedback">
							
							<label>&nbsp;</label>
							<br />
							<button type="submit" class="btn btn-success"><strong><i class="fa fa-thumbs-up"></i> Aprovar </strong> </button>
							
						</div>
						<?php } ?>
						
						</div>

						

						</form>
						

					
					
				

					<div class="x_title">
							<h2>Materiais Selecionados</h2>

							<div class="clearfix"></div>
							</div>




						<!-- LISTA DOS ITENS -->

						<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
							<thead>
							<tr class="fundoTituloTabela">
							<th>MATERIAL</th>
							<th>QTD</th>
							<th>VALOR UN</th>
							<th>SUB-TOTAL</th>
							<th>FORNECEDOR</th>
							<th>ENTREGA</th>

							<th>OPERAÇÕES</th>
							
							</tr>
							</thead>

							<tbody>
							<?php 
							$total = 0;
							foreach ($listItensPc as $objIten):
									$total = $total + $objIten['sub_total'];
							 ?>
							
							<?php if($objIten['lancada']==SIM){ ?>
							<tr class="dadosTabela" style="color:green; font-weight:900;">
							<?php } else{ ?>
							<tr class="dadosTabela">
							<?php } ?>

							<td><?php echo $objIten['descricao']; ?></td>
						
							
								<td><?php echo $objIten['qtd']; ?></td>
							<td> <?php echo number_format($objIten['valor'], 2, ',', '.'); ?></td>
							<td> <?php echo number_format($objIten['sub_total'], 2, ',', '.'); ?></td>
							<td><?php echo $objIten['nome_fantasia']; ?></td>
							<td><?php echo $objDateFormat->date_format($objIten['data_entrega']); ?></td>

							
							
							
							<td class="td-actions">
							
							
							

							<?php //if($objSolicitacao->getId_status_diretoria()!=ST_APROVADO){
								if($objIten['lancada']!=SIM){
							 ?>
							 <a data-toggle="modal" data-id="<?php echo $objIten['id_item']; ?>" href="#modal_item" class="dadosItem btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Editar</a>

							<!--<a href="#" class="confirm-delete btn btn-danger btn-sm" data-id="<?php //echo $objIten->getId_item(); ?>"><i class="fa fa-trash"></i> Excluir</a>
							-->
							

							<?php } ?>

							</td>

							</tr>

							<?php endforeach;?>


							</tbody>

						</table>

						<h2 class="btn btn-primary"><strong>TOTAL PEDIDO R$ <?php echo number_format($total, 2, ',', '.'); ?></strong></h2>

						<!-- FINAL LISTA DOS ITENS -->




				</div>

					<?php if($objSolicitacao->getId_status()!=ST_APROVADO){ ?>
					<div class="form-group">

							<div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">

							<label>&nbsp;</label>
							<br />
							<!--<button type="submit" class="btn btn-primary"><strong><i class="fa fa-check"></i> Confirmar Solicitação</strong> </button>-->

							<a data-toggle="modal" href="#modal_pesquisa" class="btn btn-primary"><strong><i class="fa fa-check"></i> Confirmar Solicitação</strong> </a>

							</div>
						</div>
					<?php } ?>

					

					



		</div>  <!-- FINAL MIOLO -->

	</div> <!-- FINAL COL -->

</div> <!-- FINAL ROWS -->



<!-- Start Calendar modal -->
      <div id="modal_pesquisa" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                      <input type="text" class="form-control" readonly name="data_criacao" value="<?php echo set_value('categoria',$objDateFormat->date_format($objSolicitacao->getData_criacao()))?>" />
                    </div>
                  </div>

                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Data de Necessidade</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" readonly class="form-control calendario" name="data_necessidade" value="<?php echo set_value('categoria',$objDateFormat->date_format($objSolicitacao->getData_necessidade()))?>"/>
                    </div>
                  </div>
               

                   
                   


                     <?php if($objUser->getId_perfil()==PERFIL_COORDENADOR){ ?> 
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                   
                      <select class="form-control" name="id_status" id="id_status">
                         <!--<option value="<?php $objSolicitacao->getObjStatus()->getId_status() ?>"> <?php echo strtoupper($objSolicitacao->getObjStatus()->getStatus()); ?> </option>-->
                         <?php foreach ($listStatus as $objStatus): 
                             $statusx = $objStatus->getId_status();
                             ?>
                        <option value="<?php echo $objStatus->getId_status(); ?>" <?php echo set_select('id_status',$statusx,$objSolicitacao->statusIs($statusx)); ?>>
                           <?php echo $objStatus->getStatus(); ?>
                        </option>
                         <?php endforeach; ?>

                       
                        </select>

                    </div>
                  </div>
                  <?php } ?>



                     <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Coordenador Aprovação</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                     
                      

                      <select class="form-control" name="id_aprovador" id="id_aprovador">
                         
                         <!---->
                           <!--<option value="">Selecione ...</option>-->
                           
                          <?php if($objUser->getId_perfil()!=PERFIL_COORDENADOR){ ?> 
                         <option value="">Selecione ...</option>
                         <?php foreach ($listUser as $objUser): 
                             $aprovador = $objUser->getId_colaborador();
                             ?>
                        <option value="<?php echo $objUser->getId_colaborador(); ?>" <?php echo set_select('id_aprovador',$aprovador,$objSolicitacao->aprovadorIs($aprovador)); ?>>
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
              <button type="submit" class="btn btn-primary"><strong><i class="fa fa-check"></i> Confirmar Solicitação</strong></button>
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
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil"></i> Editar Item</h4>
            </div>
            <div class="modal-body">
              <div id="testmodal">
                <!--<form id="antoform" class="form-horizontal" role="form">-->
                 <form action="" class="form-horizontal" id="ajax_edit_itens">
                 
                 <input type="hidden" name="id_solicitacao" id="edit_id_solicitacao" value="<?php echo $objSolicitacao->getId_solicitacao(); ?>">
                 <input type="hidden" name="id_item" id="edit_id_item">
                  
               
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

                  

                   
                
              </div>
            </div>
            <div class="modal-footer">
              <!--<button type="button" class="btn antoclose" data-dismiss="modal">Fechar</button>-->
              <a href="#" data-dismiss="modal" aria-hidden="true" class="btn">Fechar Janela</a>
              <button type="submit" class="btn btn-primary" id="edit_itens_btn"><strong><i class="fa fa-check"></i> Salvar</strong></button>
              </form>
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
          options += '<option value="' + j[i].id_custo + '">' + j[i].codigo + '</option>';
        } 
       
       $('#id_custo').html(options).show();
       
    });

     });


 $("#confirmar").click(function(){
        //$("#myModal").modal();
        alert('teste');
 });

  $(".dadosItem").click(function(){

          
     var id_item = $(this).data('id');

      var url = '<?= site_url("/solicitacao/ajax_visualizar_item/"); ?>/'+id_item;
    
   $.getJSON(url, function(j){
                             
    
       //var id_item = "";
       var id_solicitacao = "";
       var id_produto = "";
       var produto_nome = "";
       var custo = "";
       var qtd = "";
       var obra = "";

       
       for (var i = 0; i < j.length; i++) {
        
          id_item = j[i].id_item;
          id_solicitacao = j[i].id_solicitacao;
          id_produto = j[i].id_produto;
          qtd = j[i].qtd;
          produto_nome = j[i].produto_nome;
          



        } 
      
      $("#edit_id_item").val(id_item);
      $("#edit_id_solicitacao").val(id_solicitacao);
      $("#edit_id_produto").val(id_produto);
      $("#edit_qtd").val(qtd);
     
      $("#edit_produto_nome").val(produto_nome);
      
      //$("#edit_id_produto").val(id_produto).change();
      //$("div.id_100 select").val(id_produto);
      //alert(acessou);

});




 });


  $('#edit_itens_btn').click(function(e){
    //alert('TESTE');
      if($("#edit_qtd").val()=="")

      {
        alert("CAMPO QTD OBRIGATORIO")
         return false;
      }

      else {

    e.preventDefault();

     $.ajax({
             type: 'POST',
             url: "<?php echo site_url('solicitacao/item_editar/'); ?>",         
             data: $('#ajax_edit_itens').serialize(),
             success : function(txt){
              var id_solicitacao = $("#edit_id_solicitacao").val();
              //alert('VENDA FINALIZADA!');
              $('#myModal').modal('hide');

               //var tipo = 2;
               window.location.href="<?php echo site_url('pedido_compra/visualizar/'); ?>/"+id_solicitacao;
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


