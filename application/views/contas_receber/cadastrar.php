<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">

				<div class="x_title">
					<h2>Cadastrar Recebimento</h2>
					<ul class="nav navbar-right panel_toolbox">
					<li><a href="<?php echo site_url('contas_receber/filtro'); ?>"><i class="fa fa-search"></i> <strong>Pesquisar</strong></a></li>
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

			  	  <?php echo form_open('contas_receber/cadastrar',array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
                    <input type="hidden" name="tipo" class="span4" id="tipo" value="<?php echo set_value('tipo',CONTAS_RECEBER_MANUAL)?>">
      
                   
					<div class="form-group">
						
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Descrição</label>
							<input type="text" class="form-control" name="descricao" id="descricao" value="<?php echo set_value('descricao')?>"/>
						</div>

						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Data Vencimento</label>
							<input type="text" class="form-control calendario" name="data_vencimento" id="data_vencimento" value="<?php echo set_value('data_vencimento')?>"/>
						</div>

						 <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Cliente <a data-toggle="modal" href="#modal_fornecedor" class="btn-link"><i class="fa fa-plus-circle"></i></a></label>
                        <select class="form-control" name="id_cliente" id="id_cliente">
                        </select>
                      </div>

	         <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Valor Título</label>
							<input type="text" class="form-control" tipo="moneyReal" name="valor" id="valor" value="<?php echo set_value('valor')?>"/>
						</div>

            </div>



         <!-- <div class="form-group" id="entrada_repetir_conta">
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <label>Repetir Conta Mensalmente
                <input type="checkbox" name="repetir_conta" id="repetir_conta" value="<?php echo set_value('repetir_conta',SIM)?>"> 
                       </label>
                     
            </div>
          
        
       
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" id="camada_repetir" style="display:none;">
							<label>Quantidade a ser repetida em meses</label>
               <select class="form-control" name="parcela_qtd" id="parcela_qtd">
                <?php for($x=1;$x<37;$x++){ ?>
                <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                
                <?php } ?>
                </select>
							
						</div>

					
		     </div> -->



            <div class="form-group" id="entrada_pagamento_realizado">
            
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <label>Pagamento já realizado?
                <input type="checkbox" name="pagamento_realizado" id="pagamento_realizado" value="<?php echo set_value('pagamento_realizado',SIM)?>"> 
                       </label>
                     
            </div>
            

            </div>

             <div class="form-group" id="camada_pagamento" style="display:none">
             <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Forma de Pagamento</label>
                        <select class="form-control" name="id_forma" id="id_forma">
                        <option value="">Nenhum...</option>
                         <?php foreach ($listForma as $objForma): ?>
                        <option value="<?php echo $objForma->getId_forma(); ?>" <?php echo set_select('id_forma',$objForma->getId_forma()); ?>>
                           <?php echo $objForma->getForma(); ?>
                        </option>
                         <?php endforeach; ?>

                       
                        </select>
            </div>

             <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
              <label>Data Pagamento</label>
              <input type="text" class="form-control calendario" name="data_pagamento" id="data_pagamento" value="<?php echo set_value('data_pagamento')?>"/>
            </div>

            <!-- <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Centro de Custo </label>
                        <select class="form-control" name="id_custo" id="id_custo">
                         <option value="">Nenhum...</option>
                         <?php foreach ($listCusto as $objCusto): ?>
                        <option value="<?php echo $objCusto->getId_custo(); ?>" <?php echo set_select('id_custo',$objCusto->getId_custo()); ?>>
                           <?php echo $objCusto->getCusto(); ?>
                        </option>
                         <?php endforeach; ?>

                       
                        </select>
            </div>-->

            </div>

              <div class="form-group">

               <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                <label>Anotações</label>
                <textarea id="observacao" rows="5" class="form-control" name="observacao">
                 
                </textarea>
                </div>

            </div>







						<div class="ln_solid"></div>

					<div>
						<div class="col-md-12 col-sm-12 col-xs-12">
							<button type="reset" class="btn btn-danger"><i class="fa fa-remove"></i> Limpar</button>
							<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Salvar</button>
							</form>
						</div>
					</div>
				</div>

		</div>  <!-- FINAL MIOLO -->

	</div> <!-- FINAL COL -->

</div> <!-- FINAL ROWS -->



<!-- MODAL FORNECEDOR -->
      <div id="modal_fornecedor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-circle"></i> Adicionar Cliente</h4>
            </div>
            <div class="modal-body">
              <div id="testmodal">
               
             
               
                <form class="contact-fornecedor form-horizontal" id="ajax_form_fornecedor"> 
                 <input type="hidden" name="tipo" value="<?php echo set_value('tipo',PESSOA_JURIDICA)?>">
               
                  <div class="form-group">
                    
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Cliente:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" name="nome_fantasia" id="nome_fantasia" value="<?php echo set_value('nome_fantasia')?>" maxlength="100"/>
                    </div>
                  </div>

                                      
                
              </div>
            </div>
            <div class="modal-footer">
              <!--<button type="button" class="btn antoclose" data-dismiss="modal">Fechar</button>-->
              <a href="#" data-dismiss="modal" aria-hidden="true" class="btn">Fechar Janela</a>
              <button type="submit" class="btn btn-success"><i class="fa fa-plus-circle"></i> Incluir</button>
              </form>
            </div>
          </div>
        </div>
      </div>

<!-- FINAL MODAL FORNECEDOR -->




<script type="text/javascript">

<?php if($msg==true){ ?>
//função para ocultar mensagem de cadastro: arquivo: js/base.js
hideMessage();

<?php } ?>

</script>

<script type="text/javascript">



     //Fornecedor   
   var urlFornecedor = '<?= site_url("/clientes/ajax_listar/0"); ?>/';
   $.getJSON(urlFornecedor, function(u){
                             
      var optionsForn = '';
       optionsForn += '<option value="">Selecione...</option>';
       for (var x = 0; x < u.length; x++) {
          optionsForn += '<option value="' + u[x].id_cliente + '">' + u[x].nome_fantasia + '</option>';
        } 
       $('#id_cliente').html(optionsForn).show();
       
    });


     //FORCEDOR MODAL
  $("#novo_fornecedor").click(function(){             
      $('#form-fornecedor').modal({
        show: 'true'
      });
  });


  //AJAX FORNECEDOR MODAL
  $('#ajax_form_fornecedor').submit(function(){
 
    $.ajax({
    type: "POST",
    url: "<?php echo site_url('clientes/cadastrar'); ?>",
    data: $('form.contact-fornecedor').serialize(),
        success: function(msg){
         //Unidade   
   var urlFornecedor = '<?= site_url("/clientes/ajax_listar/1"); ?>/';
  
   $.getJSON(urlFornecedor, function(f){
                             
      var optionsFornecedores = '';
       //options += '<option value="">Selecione...</option>';
       for (var x = 0; x < f.length; x++) {
          optionsFornecedores += '<option value="' + f[x].id_cliente + '">' + f[x].nome_fantasia + '</option>';
        } 
          

            $('#id_cliente').html(optionsFornecedores).show();
       
        });
        
            $("#modal_fornecedor").modal('hide');                     
          
            },
            
    error: function(f){
      //alert("failure");
      }
          });

    return false;
  });


   
   $('#repetir_conta').change(function(){
        if(this.checked){
            $('#camada_repetir').fadeIn('slow');
            $('#entrada_pagamento_realizado').fadeOut('slow');
          
           }
        
        else{
          
            $('#camada_repetir').fadeOut('slow');
            $('#entrada_pagamento_realizado').fadeIn('slow');
          
           }

    });

   $('#pagamento_realizado').change(function(){
        if(this.checked){
           
            $('#camada_pagamento').fadeIn('slow');
            $('#entrada_repetir_conta').fadeOut('slow');
           
            }
             
             else {
             
              $('#camada_pagamento').fadeOut('slow');
               $('#entrada_repetir_conta').fadeIn('slow');
           
           }

    });
   


	/* 
jQuery(function ($) {
            
        
	 //Calcula o evento ao confirmar o valor em qtd de parcela
	   $("#parcela_qtd").keyup(function(){
             
     
      var valor = parseFloat($('#valor').val().replace(".", ""));
    var qtd_parcela = parseInt($("#parcela_qtd").val());
    var resultado = valor / qtd_parcela;

     $("input:text[name=valor_parcela]").val(resultado.toFixed(2));
     return false;
	 });
	 
	 
	 //Calcula o evento ao clicar no campo de valor de parcela
	  
    $("#valor_parcela").click(function(){
	    
    var valor = parseFloat($('#valor').val().replace(".", ""));
    var qtd_parcela = parseInt($("#parcela_qtd").val());
    var resultado = valor / qtd_parcela;

     $("input:text[name=valor_parcela]").val(resultado.toFixed(2));
   

	 });


    
$("#valor").keyup(function(){
    var valor = parseFloat($('#valor').val().replace(".", ""));
    var qtd_parcela = parseInt($("#parcela_qtd").val());
    var resultado = valor / qtd_parcela;

     $("input:text[name=valor_parcela]").val(resultado.toFixed(2));

   



   });

         

 });
*/


 </script>


