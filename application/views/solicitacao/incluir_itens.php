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
					<h2>Nova Solicitação de Compra de Produtos</h2>
					<ul class="nav navbar-right panel_toolbox">
					<li><a href="<?php echo site_url('solicitacao/imprimir/'.$objSolicitacao->getId_solicitacao()); ?>" target="_blank" ><i class="fa fa-print"></i> <strong>Imprimir</strong></a></li>
					<!--<li><a href="<?php echo site_url('solicitacao/iniciar_importacao'); ?>"><i class="fa fa-cloud-upload"></i> <strong>Importação</strong></a></li>-->
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

			  			<?php echo validation_errors(); ?>

			  			<?php if($status_geral==SIM){ ?>
			        <div class="alert alert-success alert-dismissible fade in" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						</button>
						<strong><i class="fa fa-check"></i> Todos os itens da solicitação já foram fechados!</strong>
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
							<input type="text" readonly class="form-control" name="data_criacao" id="data_criacao" value="<?php echo set_value('data_criacao',$objDateFormat->date_format($objSolicitacao->getData_criacao()))?>"/>
						</div>

						<div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Data de Necessidade</label>
							<input type="text" readonly class="form-control" name="data_necessidade" id="data_necessidade" value="<?php echo set_value('data_necessidade',$objDateFormat->date_format($objSolicitacao->getData_necessidade()))?>"/>
						</div>

							<?php 

					if($objSolicitacao->getObjStatus()!=null){
						$status = strtoupper($objSolicitacao->getObjStatus()->getStatus()); 
					}else{
						$status = "";
					}

					?>

						<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Status</label>
							<input style="font-size:11px;" type="text" disabled class="form-control" value="<?php echo set_value('solicitante',$status); ?>"/>
						</div>

						<div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
								<label>Observação</label>
								<input type="text" value="<?php echo $objSolicitacao->getObservacao(); ?>" class="form-control" readonly>
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
					
					<!--<div class="form-group"  style="border:1px solid red; ">-->
						
							<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
								<label>Aprovador</label>
								<input type="text" disabled class="form-control" value="<?php echo set_value('aprovador',$aprovador); ?>"/>
							</div>


						<div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Data Aprovação</label>
							<input type="text" class="form-control" disabled id="data_aprovacao" value="<?php echo set_value('data_aprovacao',$objDateFormat->date_format($objSolicitacao->getData_aprovacao()))?>"/>
						</div>
						<?php } ?>

				

						

						

					</div>

					

						

						<!--</div> --> <!-- x content -->
						

						

						

						<!--<div class="ln_solid"></div>-->

							<div class="x_title">
							<h2>Seleção de Produtos</h2>

							<div class="clearfix"></div>
							</div>
						


						<div class="form-group">
						
						<div class="col-md-8 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Material</label>
							<select name="id_produto" id="id_produto" class="form-control select2_single" tabindex="1">
							<option value="">Selecione...</option>
							<?php foreach ($listProdutos as $objProduto): ?>
							<option value="<?php echo $objProduto['id_produto']; ?>" <?php echo set_select('id_produto'); ?>>
							<?php echo $objProduto['codigo']." ".$objProduto['produto']." - ".$objProduto['saldo']." ".$objProduto['unidade']; ?>
							</option>
							<?php endforeach; ?>
							</select>
						</div>

						<div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Quantidade</label>
							<input type="text" class="form-control"  onkeypress='return SomenteNumero(event)' name="qtd" id="qtd" value="<?php echo set_value('qtd_parcela')?>"/>
						</div>

					

						
						<?php if($objSolicitacao->getId_status()!=ST_APROVADO){ ?>

						<div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
							
							<label>&nbsp;</label>
							<br />
							<button type="submit" class="btn btn-success"><strong><i class="fa fa-plus-circle"></i> </strong> </button>
							
						</div>
						<?php } ?>

					
						
						</div>
												
	</form>
						

					


					<div class="form-group">
					
					

					<div class="x_title">
							<h2>Lista de Produtos Selecionados</h2>

							<div class="clearfix"></div>
					</div>

					</div>



						<!-- LISTA DOS ITENS -->

						<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
							<thead>
							<tr class="fundoTituloTabela">
							<th>MATERIAL</th>
							<th>QTD</th>
							
							<th>OPERAÇÕES</th>
							</tr>
							</thead>

							<tbody>
							<?php foreach ($listItens as $objIten): ?>
							<tr class="dadosTabela">

							<td><?php echo $objIten->getProduto()->getDescricao(); ?></td>
							<td><?php echo $objIten->getQtd(); ?></td>
							
							
							
							
							<td class="td-actions">
							
							
							 <?php //echo anchor_popup(site_url('solicitacao/item_editar/'.$objIten->getId_item()."/".$objSolicitacao->getId_solicitacao()),'<span class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Editar</span>',$janela); ?>

							<?php 
							//if( ($objSolicitacao->getId_status()!=ST_APROVADO) || ($this->session->userdata('id_perfil')==PERFIL_COORDENADOR || $this->session->userdata('id_perfil')==PERFIL_MASTER || $this->session->userdata('id_perfil')==PERFIL_CONTROLADORIA) || ($objSolicitacao->getId_status_diretoria()!=ST_APROVADO )  ){ 

							if($objSolicitacao->getId_status_diretoria()!=ST_APROVADO){

							?>
							 
							 <a data-toggle="modal" data-id="<?php echo $objIten->getId_item(); ?>" href="#modal_item" class="dadosItem btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Editar</a>

							<a href="#" class="confirm-delete btn btn-danger btn-sm" data-id="<?php echo $objIten->getId_item(); ?>"><i class="fa fa-trash"></i> Excluir</a>
							<?php } ?>

							</td>

							</tr>

							<?php endforeach;?>


							</tbody>

						</table>

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
               

                   
                   


                   



                     <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Coordenador Aprovação </label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                     
                      

                      <select class="form-control" name="id_aprovador" id="id_aprovador">
                         
                         <!---->
                           <!--<option value="">Selecione ...</option>-->
                           
                          <?php if($objUser->getId_perfil()!=PERFIL_COORDENADOR && $objUser->getId_perfil()!=PERFIL_MASTER){ ?> 
                        
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

                    <?php if($this->session->userdata('id_perfil')==PERFIL_COORDENADOR || $this->session->userdata('id_perfil')==PERFIL_MASTER){ ?> 
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
                  
                

                     <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Observação</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                     
                      <textarea class="form-control" name="observacao"><?php echo $objSolicitacao->getObservacao(); ?></textarea>
                    </div>
                  </div>

                   <?php } else{ ?>

                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Observação</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                     
                      <textarea class="form-control" readonly><?php echo $objSolicitacao->getObservacao(); ?></textarea>
                    </div>
                  </div>
                  
                  <?php } ?>
                   

                   
                
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
               
               window.location.href="<?php echo site_url('solicitacao/incluir_itens/'); ?>/"+id_solicitacao;
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




<!-- OPERAÇÃO PARA EXCLUSÃO DE DADOS -->
<script type="text/javascript">
$(function () {

 //OPERAÇÃO EXCLUSÃO 
  $('#CalenderModalNew').on('show', function() {
    var id = $(this).data('id'),
    removeBtn = $(this).find('.danger');
  });

  $(document).on('click', '.confirm-delete', function(e) {
    e.preventDefault();

    var id = $(this).data('id');
    $('#CalenderModalNew').data('id', id).modal('show');
  });

  $('#btnYes').click(function() {
    // handle deletion here
    var id = $('#CalenderModalNew').data('id');
    $('[data-id='+id+']').remove();
    $('#CalenderModalNew').modal('hide');
  
   location.href="<?php echo site_url('solicitacao/excluir_item'); ?>/"+id+"/"+<?php echo $objSolicitacao->getId_solicitacao(); ?>;

  });
  //FINAL OPERAÇÃO EXCLUSÃO


 //OPERAÇÃO DUPLICAÇÃO
 

  $(document).on('click', '.confirm-copia ', function(e) {
    e.preventDefault();

    var id = $(this).data('id');
     $("#id_solicitacao_copy").val(id);
    //$('#CalenderModalDup').data('id', id).modal('show');
  });

 
  //FINAL OPERAÇÃO DUPLICAÇÃO

 






});

</script>      