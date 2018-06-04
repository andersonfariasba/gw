<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">

				<div class="x_title">
					<h2>Editar Formas de Recebimentos</h2>
					<ul class="nav navbar-right panel_toolbox">
					<li><a href="<?php echo site_url('formas_recebimentos/cadastrar'); ?>"><i class="fa fa-plus-circle"></i> <strong>Novo</strong></a></li>
					<li><a href="<?php echo site_url('formas_recebimentos/filtro'); ?>"><i class="fa fa-search"></i> <strong>Pesquisar</strong></a></li>
					 <li><a href="<?php echo site_url('tabela_taxa/filtro'); ?>"><i class="fa fa-bars"></i> <strong>Tabela de Taxas</strong></a></li>
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

			  	  <?php echo form_open('formas_recebimentos/editar/'.$objForma->getId_forma(),array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
                    <input type="hidden" name="id_forma" value="<?php echo $objForma->getId_forma(); ?>">  

                     <div class="form-group" id="camada_data_manual">

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">

                      <p>
                      <label>Incluir Data de Vencimento Manualmente na tela de venda.</label>
                       <input type="checkbox" name="data_vencimento_manual" id="data_vencimento_manual" <?php if($objForma->getData_vencimento_manual()==SIM){ echo "checked='' "; } ?>  value="1"> 

                       <input type="hidden" id="flag_data_manual" value="<?php echo $objForma->getData_vencimento_manual()?>" />
                     
                     
                      </p>
                      </div>


                    </div>

                     <div class="form-group" id="camada_cartao">

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">

                      <p>
                      <label>Operação com Cartão de Crédito ou Débito.</label>
                       <input type="checkbox" name="cartao" id="cartao" <?php if($objForma->getCartao()==SIM){ echo "checked='' "; } ?> value="1"> 

                       <input type="hidden" id="flag_cartao" value="<?php echo $objForma->getCartao()?>" />
                     
                      </p>
                      </div>
    </div>
					

					<div class="form-group">
						
						
					  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Nome da Forma de Recebimento</label>
							<input type="text" class="form-control" name="forma" id="forma" value="<?php echo set_value('forma',$objForma->getForma())?>"/>
					  </div>

					 <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						<label>Como será créditado em minha conta?</label>
						<select class="form-control" name="tipo" id="tipo">
						<option <?php if($objForma->getTipo()==TIPO_REC_VISTA){ echo "selected=''"; } ?> value="<?= TIPO_REC_VISTA; ?>" <?= set_select('tipo',TIPO_REC_VISTA); ?>>A VISTA</option>
						
						<option <?php if($objForma->getTipo()==TIPO_REC_PARCELADO){ echo "selected=''"; } ?> value="<?= TIPO_REC_PARCELADO; ?>" <?= set_select('tipo',TIPO_REC_PARCELADO); ?>>PARCELADO</option>

						</select>
						</div>


                   

					  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Limite de Parcela</label>
							<input type="text" class="form-control" name="maximo_parcela" id="maximo_parcela" value="<?php echo set_value('maximo_parcela',$objForma->getMaximo_parcela())?>"/>
					  </div>

					  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Quantidade Dias Compensação</label>
							<input type="text" class="form-control" name="qtd_dia_compensa" id="qtd_dia_compensa" value="<?php echo set_value('qtd_dia_compensa',$objForma->getQtd_dia_compensa())?>"/>
					  </div>


					 <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" id="camada_taxa_tipo" style="display: none;">
                        <label>Tipo de Taxa</label>
                        
                       

                        <select class="form-control" name="taxa_tipo" id="taxa_tipo">
                      <option value="<?php echo $objForma->getTaxa_tipo(); ?>">
                        	<?php 

                        	    if($objForma->getTaxa_tipo()==TAXA_UNICA){
                        		echo "UNICA";
                        		}

                        		else if($objForma->getTaxa_tipo()==TAXA_TABELA){
                        		echo "POR TABELA DE PARCELA";
                        		}
                        		else{
                        			echo "Selecione...";
                        		}



                        		?>
                        </option> 
                      <option value="<?= TAXA_UNICA; ?>" <?= set_select('taxa_tipo',TAXA_UNICA); ?>>ÚNICA</option>

                         <option value="<?= TAXA_TABELA; ?>" <?= set_select('taxa_tipo',TAXA_TABELA); ?>>POR TABELA DE PARCELA</option>
             
                       
                        </select>
          </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" style="display:none;" id="camada_taxa">
							<label>Taxa(%)</label>
							<input type="text" class="form-control" tipo="moneyReal" name="taxa" id="taxa" value="<?php echo set_value('taxa',$objForma->getTaxa())?>"/>
					  </div>

					   <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback" style="display:none;" id="camada_taxa_tabela">
							<label>Tabela de Taxa</label>
						<select class="form-control" name="id_tabela_nome" id="id_tabela_nome">
                        <!--<option value="">Nenhum...</option>-->
                           <option value="">NÃO REALIZAR TRANSAÇÃO</option>
                         <?php foreach ($listTab as $objTab): 
                              $tab = $objTab->getId_tabela_nome();
                         ?>
                        <option value="<?php echo $objTab->getId_tabela_nome(); ?>" <?php echo set_select('id_tabela_nome',$tab,$objForma->tabelaIs($tab)); ?>>
                           <?php echo $objTab->getNome(); ?>
                        </option>
                         <?php endforeach; ?>
            </select>

                       
					  </div>
									

                       
					<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						<label>Status</label>
						<select class="form-control" name="status" id="status">
						<?php $status = $objForma->getStatus();?>
						<option value="<?= $objForma->getStatus(); ?>" <?= set_select('status',$status,$objForma->statusIs($status)); ?>>
						<?= $objForma->printStatus(); ?>
						<option value="<?= ATIVO; ?>" <?= set_select('status',ATIVO); ?>>ATIVO</option>
						<option value="<?= BLOQUEADO; ?>" <?= set_select('status',BLOQUEADO); ?>>BLOQUEADO</option>

						</select>
						</div>
					
					 <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Status ao gerar o Contas a Receber</label>
                        <select class="form-control" name="status_financeiro" id="status_financeiro">
                       <?php $status_financeiro = $objForma->getStatus_financeiro();?>
                <option value="<?= $objForma->getStatus_financeiro(); ?>" <?= set_select('status_financeiro',$status_financeiro,$objForma->statusFinanceiroIs($status_financeiro)); ?>>
                <?= $objForma->printStatusFinanceiro(); ?>
               <option value="<?= ABERTO; ?>" <?= set_select('status_financeiro',ABERTO); ?>>PENDENTE</option>
             
               <option value="<?= PAGO; ?>" <?= set_select('status_financeiro',PAGO); ?>>RECEBIDO</option>

</select>

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

   $(document).ready(function(){
              
         //if($('#data_vencimento_manual').val()==1){
if($('#flag_data_manual').val()==1){
        
          $( "#maximo_parcela" ).prop( "disabled", true );
          $( "#qtd_dia_compensa" ).prop( "disabled", true );
          $( "#tipo" ).prop( "disabled", true );
          $( "#camada_cartao").hide();
          $("#camada_taxa_tabela").hide();

         }


         $('#data_vencimento_manual').change(function(){
          if(this.checked){
           $( "#maximo_parcela" ).prop( "disabled", true );
           $( "#qtd_dia_compensa" ).prop( "disabled", true );
           $( "#tipo" ).prop( "disabled", true );
           $( "#camada_cartao").hide();

          
           }
        
        else{
          
           $("#maximo_parcela" ).prop( "disabled", false );
           $( "#qtd_dia_compensa" ).prop( "disabled", false );
           $( "#tipo" ).prop( "disabled", false );
            $( "#camada_cartao").show();

          
           }

    });
             

      if($("#flag_cartao").val()==1){
      	//alert('cart');
      	     $( "#camada_data_manual").hide();
             $( "#camada_taxa_tipo").show();
             $( "#camada_taxa").show();

      }
        else{
        	//alert('nao cart');

        	 $( "#camada_data_manual").show();
             $( "#camada_taxa_tipo").hide();
             $( "#camada_taxa").hide();
              $('#camada_taxa_tabela').hide();

       }

      if($('#taxa_tipo').val()==2){
   	   		   $('#camada_taxa').hide(); // hide the first one
               $('#camada_taxa_tabela').show(); // show the other one
              
   	   }else{
   	   	     
              $('#camada_taxa_tabela').hide();
            
   	   }

     


   	  $('#cartao').change(function(){
        if(this.checked){
            $( "#camada_data_manual").hide();
             $( "#camada_taxa_tipo").show();
             $( "#camada_taxa").show();
          
           }
        
        else{
          
           $( "#camada_data_manual").show();
           $( "#camada_taxa_tipo").hide();
           $( "#camada_taxa").hide();

          
           }

    });

   	   


     //seleção do tipo de taxa
   	  $('#taxa_tipo').bind('change', function(event) {

           var i= $('#taxa_tipo').val();

            if(i=="1") // equal to a selection option
             {
                 $('#camada_taxa').show();
                 $('#camada_taxa_tabela').hide();
             }
           
           else if(i=="2")
             {
               $('#camada_taxa').hide(); // hide the first one
               $('#camada_taxa_tabela').show(); // show the other one

              }
});







                                  
      }); //final jquery


<?php if($msg==true){ ?>
//função para ocultar mensagem de cadastro: arquivo: js/base.js
hideMessage();

<?php } ?>

</script>


