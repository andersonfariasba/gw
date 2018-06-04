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
					<h2>Pedido</h2>
					<ul class="nav navbar-right panel_toolbox">
					
					<li><a href="<?php echo site_url('pedidos_acompanhamento/imprimir/'.$objSolicitacao->getId_pedido()); ?>" target="_blank"><i class="fa fa-print"></i> <strong>Imprimir</strong></a></li>
					<li><a href="<?php echo site_url('pedidos_acompanhamento/filtro'); ?>"><i class="fa fa-search"></i> <strong>Pesquisar Pedidos</strong></a></li>
					
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



			  	  <?php echo form_open_multipart('pedidos_acompanhamento/visualizar/'.$objSolicitacao->getId_pedido(),array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
			  	   
			  	    <input type="hidden" name="id_pedido" value="<?php echo $objSolicitacao->getId_pedido(); ?>">
			  	    <input type="hidden" name="arquivo_atual" value="<?php echo $objSolicitacao->getArquivo(); ?>" />    

					<div class="form-group">
						
						<div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Cod. Pedido</label>
							<input type="text" disabled class="form-control" value="<?php echo set_value('solicitante',$objSolicitacao->getId_pedido()); ?>"/>
						</div>

						<div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Cod. Solicitação</label>
							<input type="text" disabled class="form-control" value="<?php echo set_value('solicitante',$objSolicitacao->getId_solicitacao()); ?>"/>
						</div>

						<?php if($objSolicitacao->getFornecedor()!=null){ ?>
						<div class="col-md-5 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Fornecedor</label>
							<input type="text" disabled class="form-control" value="<?php echo set_value('solicitante',$objSolicitacao->getFornecedor()->getNome_fantasia()); ?>"/>
						</div>
						<?php } ?>

						<?php if($objSolicitacao->getSolicitacao()->getColaborador()!=null){ ?>
						<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Responsável</label>
							<input type="text" disabled class="form-control" value="<?php echo set_value('solicitante',$objSolicitacao->getSolicitacao()->getColaborador()->getNome()); ?>"/>
						</div>
						<?php } ?>

				   </div>

				   <div class="form-group">
						
						<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Nº Nota Fiscal</label>
							<input type="text" name="numero_nf" class="form-control" value="<?php echo set_value('numero_nf',$objSolicitacao->getNumero_nf()); ?>"/>
						</div>

						<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Valor Nota Fiscal</label>
							<input type="text" name="valor_nf" tipo="moneyReal" class="form-control" value="<?php echo set_value('valor_nf',$objSolicitacao->getValor_nf()); ?>"/>
						</div>

						<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Desconto</label>
							<input type="text" name="desconto" tipo="moneyReal" class="form-control" value="<?php echo set_value('desconto',$objSolicitacao->getDesconto()); ?>"/>
						</div>
					</div>

					 <div class="form-group">

						<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Data Vencimento</label>
							<input type="text" name="data_vencimento" class="form-control calendario" value="<?php echo set_value('data_vencimento',$objDateFormat->date_format($objSolicitacao->getData_vencimento())); ?>"/>
						</div>

						<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Data Envio Financeiro</label>
							<input type="text" name="data_envio_financeiro" class="form-control calendario" value="<?php echo set_value('data_envio_financeiro',$objDateFormat->date_format($objSolicitacao->getData_envio_financeiro())); ?>"/>
						</div>

							<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Forma de Pagamento</label>
							<input type="text" name="forma_pagamento" class="form-control" value="<?php echo set_value('forma_pagamento',$objSolicitacao->getForma_pagamento()); ?>"/>
						</div>



				   </div>

				   <div class="form-group">

				   <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Transportadora</label>
							<select name="id_transportadora" id="id_transportadora" class="form-control">
							<option value="">Selecione...</option>
							 <?php foreach ($listTransportadora as $objTrans): 
                             $transportadora = $objTrans->getId_transportadora();
                             ?>
                        <option value="<?php echo $objTrans->getId_transportadora(); ?>" <?php echo set_select('id_transportadora',$transportadora,$objSolicitacao->transportadoraIs($transportadora)); ?>>
                           <?php echo $objTrans->getNome_fantasia(); ?>
                        </option>
                         <?php endforeach; ?>
							
							</select>
						</div>

						<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Conhecimento Transportadora</label>
							<input type="text" name="conhecimento_transportadora" class="form-control" value="<?php echo set_value('conhecimento_transportadora',$objSolicitacao->getConhecimento_transportadora()); ?>"/>
						</div>

						<div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Valor Transportadora</label>
							<input type="text" name="valor_transportadora" tipo="moneyReal" class="form-control" value="<?php echo set_value('valor_transportadora',$objSolicitacao->getValor_transportadora()); ?>"/>
						</div>

						<div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Data de Entrega</label>
							<input type="text" name="data_entrega" class="form-control calendario" value="<?php echo set_value('data_entrega',$objDateFormat->date_format($objSolicitacao->getData_entrega())); ?>"/>
						</div>

					
						


				   </div>

				      <div class="form-group">

				       <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Contato</label>
							
							<input type="text" name="contato" class="form-control" value="<?php echo set_value('contato',$objSolicitacao->getContato()); ?>"/>
						</div>

						<?php 
							$endereco_entrega = "";
							if($objSolicitacao->getEndereco_entrega()==""){
								$endereco_entrega = $this->session->userdata('filial_endereco')." ".$this->session->userdata('filial_bairro')." ".$this->session->userdata('filial_cidade')." ".$this->session->userdata('filial_estado');
							} 

							else{
								$endereco_entrega = $objSolicitacao->getEndereco_entrega();
							}
						?>

				      
				      <div class="col-md-8 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Endereço de Entrega</label>
							
							<input type="text" name="endereco_entrega" class="form-control" value="<?php echo set_value('endereco_entrega',$endereco_entrega); ?>"/>
						</div>
					</div>

				      

				      <div class="form-group">

				      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Observação</label>
							<input type="text" name="observacao" class="form-control" value="<?php echo set_value('observacao',$objSolicitacao->getObservacao()); ?>"/>
						</div>

						  <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Anexar Boleto</label>
						 <input type="file" name="arquivo" id="arquivo" size="50">
						 </div>

						  <div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
                        <?php if($objSolicitacao->getArquivo()!=""){ ?>
                        <label> <a href="<?php echo base_url()."/importacao/{$objSolicitacao->getArquivo()}" ?>" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-cloud-download"></i> <strong>Baixar</strong></a> </label>
                        <?php } ?>
                      </div>



						 	

				      </div>

<div class="form-group">
				       	<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Status</label>
							<select name="id_status" id="id_status" class="form-control">
							<option value="">Selecione...</option>
							 <?php foreach ($listStatus as $objStatus): 
                             $statusCont = $objStatus->getId_status();
                             ?>
                        <option value="<?php echo $objStatus->getId_status(); ?>" <?php echo set_select('id_status',$statusCont,$objSolicitacao->statusIs($statusCont)); ?>>
                           <?php echo $objStatus->getStatus(); ?>
                        </option>
                         <?php endforeach; ?>
							
							</select>
						</div>
					
				      <div class="col-md-1 col-sm-6 col-xs-12 form-group has-feedback">
							
							<label>&nbsp;</label>
							<br />
							<button type="submit" class="btn btn-success"><strong><i class="fa fa-check"></i> Salvar </strong> </button>
							
						</div>
					</div>

										

						

												


						

						</form>
						
		
					
				

					<div class="x_title">
							<h2>Materiais Solicitados</h2>

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
							

							<!--<th>OPERAÇÕES</th>-->
							
							</tr>
							</thead>

							<tbody>
							<?php 
							$total = 0;
							$sub_total = 0;
							foreach ($listItens as $objIten):
									
									$sub_total = $objIten->getValor_unitario() * $objIten->getQtd();
									$total = $total + $sub_total;
							 ?>
							<tr class="dadosTabela">

							<td><?php echo $objIten->getProduto()->getDescricao(); ?></td>
							<td><?php echo $objIten->getQtd(); ?></td>
						
							
							<td> <?php echo number_format($objIten->getValor_unitario(), 2, ',', '.'); ?></td>

						    <td> <?php echo number_format($objIten->getValor_unitario() * $objIten->getQtd(),   2, ',', '.'); ?></td>
							
							<!--<td><?php //echo $objDateFormat->date_format($objIten['data_entrega']); ?></td>-->

							
							
							
						
							</tr>

							<?php endforeach;?>


							</tbody>

						</table>

						<h2 class="btn btn-primary"><strong>TOTAL PEDIDO R$ <?php echo number_format($total, 2, ',', '.'); ?></strong></h2>

						<!-- FINAL LISTA DOS ITENS -->




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
      $("#edit_custo").val(custo);
      $("#edit_obra").val(obra);
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


