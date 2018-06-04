<?php $objDateFormat = $this->DateFormat; 

$status_lanc = $objLanc->getStatus();

?> 

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">

				<div class="x_title">
					<h2>Baixa Contas a Pagar</h2>
					<ul class="nav navbar-right panel_toolbox">
					<li><a href="<?php echo site_url('contas_pagar/cadastrar'); ?>"><i class="fa fa-plus-circle"></i> <strong>Nova Conta Pagar</strong></a></li>
					<li><a href="<?php echo site_url('contas_pagar/filtro'); ?>"><i class="fa fa-search"></i> <strong>Pesquisar Contas Pagar</strong></a></li>
					<li><a href="<?php echo site_url('contas_pagar/editar/'.$objLanc->getId_lancamento()); ?>"><i class="fa fa-search"></i> <strong>Tela de Editar Conta</strong></a></li>
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

			  	  <!-- ESTAVA COM BUG, CORRIGIDO ESTAVA PEGANDO  O VALOR DA CONTA E NÃO DO LANÇAMENTO -->
            <?php echo form_open_multipart('contas_pagar/baixa/'.$objLanc->getId_lancamento(),array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
          
          <input type="hidden" name="tipo" class="span4" id="tipo" value="<?php echo set_value('tipo',CONTAS_PAGAR)?>">
          
          <input type="hidden" name="id_conta" id="id_conta" value="<?php echo set_value('id_conta',$objLanc->getId_conta()); ?>">


          <input type="hidden" name="id_fornecedor" id="id_fornecedor" value="<?php echo set_value('id_fornecedor',$objLanc->getConta()->getId_fornecedor()); ?>">

          
          
          <input type="hidden" name="parcela" id="parcela" value="<?php echo set_value('parcela',$objLanc->getParcela()); ?>">
         <!-- <input type="hidden" name="valor_titulo" id="valor_titulo" value="<?php echo set_value('valor_titulo',$objLanc->getValor_titulo()); ?>">-->
          
          <input type="hidden" name="id_lancamento" id="id_lancamento" value="<?php echo set_value('id_lancamento',$objLanc->getId_lancamento()); ?>">

            <input type="hidden" name="arquivo_atual" value="<?php echo $objLanc->getArquivo(); ?>" /> 

            <div class="form-group">

           <?php if($objLanc->getConta()->getPlano()!=null){
                            $natureza =  $objLanc->getConta()->getPlano()->getNome(); 
                          }else{
                            $natureza = "";
                          }

                        if($objLanc->getConta()->getFornecedor()!=null){

                        $fornecedor = $objLanc->getConta()->getFornecedor()->getNome_fantasia(); 
                        }else{
                          $fornecedor = "";
                        }



              ?>

              <div class="col-md- col-sm-5 col-xs-12 form-group has-feedback">
              <label>Natureza</label>
              <input disabled type="text" class="form-control" disabled value="<?php echo set_value('natureza',$natureza)?>"/>
            </div>

            <div class="col-md- col-sm-5 col-xs-12 form-group has-feedback">
              <label>Fornecedor</label>
              <input disabled type="text" class="form-control" disabled value="<?php echo set_value('natureza',$fornecedor)?>"/>
            </div>

             

            </div>
         
      
                   
					<div class="form-group">
						
						
            
						<div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Data Vencimento</label>
							<input type="text" class="form-control calendario" name="data_vencimento" id="data_vencimento" value="<?php echo set_value('data_vencimento',$objDateFormat->date_format($objLanc->getData_vencimento()))?>"/>
						</div>

              <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
              <label>Data Pagamento</label>
              <input type="text" class="form-control calendario" name="data_pagamento" id="data_pagamento" value="<?php echo set_value('data_pagamento',$objDateFormat->date_format($objLanc->getData_pagamento()))?>"/>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Banco</label>
                        <select class="form-control" name="id_conta_banco" id="id_conta_banco">
                         <option value="">Nenhum...</option>
                         <?php foreach ($listContaBanco as $objContaBanco): 
                             $conta_banco = $objContaBanco->getId_conta_banco();
                             ?>
                        <option value="<?php echo $objContaBanco->getId_conta_banco(); ?>" <?php echo set_select('id_conta_banco',$conta_banco,$objLanc->contaBancoIs($conta_banco)); ?>>
                           <?php echo " Banco: ".$objContaBanco->getBanco()." Ag: ".$objContaBanco->getAgencia()." Conta: ".$objContaBanco->getConta(); ?>
                        </option>
                         <?php endforeach; ?>

                       
                        </select>
            </div>

						

	         
         <?php if($objLanc->getConta()->getParcela_qtd()>1){ ?>
          <div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
              <label>Parcela</label>
              <input type="text"  readonly="" class="form-control" value="<?php echo set_value('parcela_qtd',$objLanc->getParcela()." / ".$objLanc->getConta()->getParcela_qtd())?>"/>
            </div>
          <?php } ?>



           <?php 
           $valor_total = $objLanc->getConta()->getValor_total() * $objLanc->getConta()->getParcela_qtd(); 
           $valor_total = number_format($valor_total, 2, ',', '.');

           ?>

           <!--<div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Valor Lançado</label>
             <input type="text"  readonly="" class="form-control" tipo="moneyReal" value="<?php echo set_value('valor',$valor_total)?>"/>
						</div>-->
					

					

             


          
</div>

 <div class="form-group">

  <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
              <label>Valor</label>
              <input type="text" tipo="moneyReal" name="valor_titulo" class="form-control" value="<?php echo set_value('valor_parcela',$objLanc->getValor_titulo())?>"/>
            </div>
 

             <div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
              <label>+ Juros (R$)</label>
              <input type="text" class="form-control" tipo="moneyReal" name="juros" id="juros" value="<?php echo set_value('juros')?>"/>
            </div>

            <div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
              <label>+ Multa (R$)</label>
              <input type="text" class="form-control" tipo="moneyReal" name="multa" id="multa" value="<?php echo set_value('multa')?>"/>
            </div>

              <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Forma de Pagamento</label>
                        <select class="form-control" name="id_forma" id="id_forma">
                        <option value="">Nenhum...</option>
                         <?php foreach ($listForma as $objForma): 
                             $forma = $objForma->getId_forma();
                             ?>
                        <option value="<?php echo $objForma->getId_forma(); ?>" <?php echo set_select('id_forma',$forma,$objLanc->formaIs($forma)); ?>>
                           <?php echo $objForma->getForma(); ?>
                        </option>
                         <?php endforeach; ?>

                       
                        </select>
            </div>


            

             <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Centro de Custo </label>
                        <select class="form-control" name="id_custo" id="id_custo">
                         <option value="">Nenhum...</option>
                         <?php foreach ($listCusto as $objCusto): 
                             $custo = $objCusto->getId_custo();
                             ?>
                        <option value="<?php echo $objCusto->getId_custo(); ?>" <?php echo set_select('id_custo',$custo,$objLanc->getConta()->custoIs($custo)); ?>>
                           <?php echo $objCusto->getCusto(); ?>
                        </option>
                         <?php endforeach; ?>

                       
                        </select>
            </div>

          

              <div class="col-md-7 col-sm-6 col-xs-12 form-group has-feedback">
              <label>Histórico</label>
              <input type="text" class="form-control" name="descricao" value="<?php echo set_value('descricao', $objLanc->getDescricao())?>"/>
            </div>

            </div>

 <div class="form-group">
             <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <label>Anexo</label>
             <input type="file" name="arquivo" id="arquivo" size="50">
             </div>

             <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <?php if($objLanc->getArquivo()!=""){ ?>
                        <label> <br /><a href="<?php echo base_url()."/doc/{$objLanc->getArquivo()}" ?>" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-cloud-download"></i> <strong>Download</strong></a> </label>
                        <?php } ?>
            </div>
</div>

      


                 

          <div class="form-group">

              
                 
                <?php if(count($listLanc) > 1){ ?>
                 
                 <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                   <label>Contas Relacionadas</label>
                 <table  class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                  <thead>
                  <tr>
                    <td>Data Vencimento</td>
                    <td>Valor</td>
                    <td>Parcela</td>
                    <td>Staus</td>
                    <td>Visualizar</td>
                  </tr>
                  </thead>

                  <tbody>
                 <?php 
                  $total = 0;
                  $lanc_atual = $objLanc->getId_lancamento();
                  foreach ($listLanc as $objLanc): 
                   $total+=$objLanc->getValor_titulo();   
                   ?>
                   <tr>
                    <td><?php echo $objDateFormat->date_format($objLanc->getData_vencimento()); ?></td>
                     <td><?php echo number_format($objLanc->getValor_titulo(), 2, ',', '.'); ?></td>
                     <td><?php echo $objLanc->getParcela()." / ".$objLanc->getConta()->getParcela_qtd(); ?></td>
                     <td><?php echo $objLanc->printStatus(); ?></td>
                       
                  
                    <td>
                      <?php if($objLanc->getId_lancamento()!=$lanc_atual){ ?>
                      
                    
                    <a href="<?php echo site_url('contas_pagar/baixa/'.$objLanc->getId_lancamento()); ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> <strong>Visualizar</strong></a>
                     

                     <?php }else{ echo "Conta Visualizada na Tela"; } ?>

                     </td>
                     
                  </tr>

              <?php endforeach;?>

              
            </tbody>


                 </table>
          

                 </div>
                 <?php } ?>




            </div>

						<div class="ln_solid"></div>

					<div>
						<div class="col-md-12 col-sm-12 col-xs-12">
						
							<?php if($status_lanc==ABERTO){ ?>
              <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> <strong>Confirmar Baixa</strong></button>
              <?php } ?>


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
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-circle"></i> Adicionar Fornecedor</h4>
            </div>
            <div class="modal-body">
              <div id="testmodal">
               
             
               
                <form class="contact-fornecedor form-horizontal" id="ajax_form_fornecedor"> 
                 <input type="hidden" name="tipo" value="<?php echo set_value('tipo',PESSOA_JURIDICA)?>">
               
                  <div class="form-group">
                    
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Nome Fantasia:</label>
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


$('#flag_multa').change(function(){
        if(this.checked){
            $('.camada_multa').fadeIn('slow');
           
          
           }
        
        else{
          
            $('.camada_multa').fadeOut('slow');
           
          
           }

    });

         

 });

 </script>


