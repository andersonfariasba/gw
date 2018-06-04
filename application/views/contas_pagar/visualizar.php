<?php $objDateFormat = $this->DateFormat; ?> 
<script type="text/javascript" src="<?php echo base_url(); ?>js/text_numero.js"></script>
  
<div class="pull-right">
<a href="<?php echo site_url('contas_pagar/filtro'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-search"></i>Buscar Contas a Pagar</a>
</div>
<div class="row">
  <div class="span12">
       <div class="widget ">
        <div class="widget-header">
                <i class="icon-money"></i>
                <h3>Contas a Pagar Visualizar</h3>
         </div> <!-- /widget-header -->
            <div class="widget-content">
              <div class="tab-pane" id="formcontrols">
        
      <!--  <form action="" id="edit-profile" class="form-horizontal">-->
            
    <?php echo form_open('contas_pagar/editar/'.$objLanc->getId_lancamento(),array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
      <input type="hidden" name="tipo" class="span4" id="tipo" value="<?php echo set_value('tipo',CONTAS_PAGAR)?>">
      <input type="hidden" name="id_conta" id="id_conta" value="<?php echo set_value('id_conta',$objLanc->getId_conta()); ?>">
      <input type="hidden" name="parcela" id="parcela" value="<?php echo set_value('parcela',$objLanc->getParcela()); ?>">
      <input type="hidden" name="valor_titulo" id="valor_titulo" value="<?php echo set_value('valor_titulo',$objLanc->getValor_titulo()); ?>">
      <input type="hidden" name="id_lancamento" id="id_lancamento" value="<?php echo set_value('id_lancamento',$objLanc->getId_lancamento()); ?>">
     
     
      
                
      
            
            
            <fieldset>
            
            <div id="msg" style="display:none;">
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Sucesso!</strong> Cadastro realizado com sucesso!
            </div>
            </div>
            
            
            <div id="erro_cadastro" style="display:none;">
            <div class="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Erro!</strong> Verifique os dados cadastrados!
                    
            </div>
            </div>
            
             <?php echo validation_errors(); ?>
            
             <div class="control-group">											
                <label class="control-label" for="id_fornecedor"><strong>Fornecedor:</strong></label>
               
                <div class="controls">
                   <?php echo $objLanc->getConta()->getFornecedor()->getNome_fantasia(); ?>
                </div> <!-- /controls -->				
              </div> <!-- /control-group -->
   
             
              <div class="control-group">											
                <label class="control-label" for="id_custo"><strong>Centro de Custo:</strong></label>
                <div class="controls">
                    <?php echo $objLanc->getConta()->getCusto()->getCusto(); ?>
                </div> <!-- /controls -->				
              </div> <!-- /control-group -->
   
              
                           
            
            <div class="control-group">											
                <label class="control-label" for="descricao"><strong>Descrição:</strong></label>
                <div class="controls">
                <?php echo $objLanc->getConta()->getDescricao(); ?>
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->

             
             <div class="control-group">											
             <label class="control-label" for="valor"><strong>Parcela:</strong></label>
                <div class="controls">
                        <?php echo $objLanc->getParcela()." / ".$objLanc->getConta()->getParcela_qtd(); ?>
                </div>				
             </div> <!-- /control-group -->

             
             <div class="control-group">											
             <label class="control-label" for="valor"><strong>Valor Parcela:</strong></label>
                <div class="controls">
                        <?php echo $objLanc->getValor_titulo(); ?>
                </div>				
             </div> <!-- /control-group -->
             
             <div class="control-group">											
             <label class="control-label" for="valor"><strong>Valor Total:</strong></label>
                <div class="controls">
                        <?php echo $objLanc->getConta()->getValor_total(); ?>
                </div>				
             </div> <!-- /control-group -->
            
           <div class="control-group">											
                <label class="control-label" for="data_vencimento"><strong>Data vencimento:</strong></label>
                <div class="controls">
                <?php echo $objDateFormat->date_format($objLanc->getData_vencimento()); ?>
                
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->
            
            <div class="control-group">											
                <label class="control-label" for="data_pagamento"><strong>Data pagamento:</strong></label>
                <div class="controls">
                 <?php echo $objDateFormat->date_format($objLanc->getData_pagamento()); ?>
                </div> <!-- /controls -->				
      </div> <!-- /control-group -->
      
      
       <div class="control-group">											
                <label class="control-label" for="status"><strong>Status:</strong></label>
                <div class="controls">
                  <?= $objLanc->printStatusPagar(); ?>
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->
      
      
    
    <div class="control-group">											
        <label class="control-label" for="juros"><strong>Juros:</strong></label>
        <div class="controls">
         <?php echo $objLanc->getJuros(); ?>
        </div> <!-- /controls -->					
    </div> <!-- /control-group -->
    
    <div class="control-group">											
        <label class="control-label" for="multa"><strong>Multa:</strong></label>
        <div class="controls">
         <?php echo $objLanc->getMulta(); ?>
        </div> <!-- /controls -->					
    </div> <!-- /control-group -->
    
   </div>
      
      
      <div class="form-actions">
            
       <a href="<?php echo site_url('contas_pagar/editar/'.$objLanc->getId_lancamento()); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-edit"></i>Editar Lançamento</a>
       <a href="<?php echo site_url('contas_pagar/filtro'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-search"></i>Buscar Conta</a>
       <a href="<?php echo site_url('contas_pagar/pdf/'.$objLanc->getId_lancamento()); ?>" target="_blank" class="btn btn-small btn-info"><i class="btn-icon-only icon-print"></i>Imprimir</a> 
           
            
      </div> <!-- /form-actions -->
        </fieldset>
        </form>
        </div>

            </div>
                </div>
                    </div> <!-- /widget-content -->
                        </div> <!-- /widget -->
                        
                        

     <script type="text/javascript">
 $(function() {
      $(document).ready(function(){
                     
               
                     
            $("#parcelado_sim").click(function(){
            	 $("#parcelado_label").show();
                 $('#paga_sim').attr("disabled", true);
                 $("#data_pagamento_label").hide();
            });
             
             $("#parcelado_nao").click(function(){
            	$("#parcelado_label").hide();
                $('#paga_sim').attr("disabled", false);
              
             });
        
        
            $("#paga_sim").click(function(){
            	 $("#data_pagamento_label").show();
                
            });
             
             $("#paga_nao").click(function(){
            	$("#data_pagamento_label").hide();
             });
             
             
             if($('#paga_sim').is(":checked")){
                  $("#data_pagamento_label").show();
             }
             
                     
       
        
        
             
             
             
             
             
             
          });

  });

 </script>
 
 <script type="text/javascript">
	 
jQuery(function ($) {
       //$("#valor_total").setMask('moeda');
        //$("#valor_cartao").setMask('moeda');
        
          
        
	 //Calcula o evento ao confirmar o valor em qtd de parcela
	   $("#parcela_qtd").keyup(function(){
             
            var valor_parcela = parseFloat($('#valor').val().replace(",", ".")) / parseFloat($('#parcela_qtd').val().replace(",", "."));
	     var qtd_parcela = $("input:text[name=qtd_parcela]").val();
	   
	      if(qtd_parcela!="" && qtd_parcela!=0) {  //para mostrar o resultado apenas com valore válidos
	       var resultado = valor_parcela.toFixed(2).replace(".", ",");
	       $("input:text[name=valor_parcela]").val(resultado);
		   return false;
		 }
	 });
	 
	 
	 //Calcula o evento ao clicar no campo de valor de parcela
	  $("#valor_parcela").click(function(){
	     var valor_parcela = parseFloat($('#valor').val().replace(",", ".")) / parseFloat($('#parcela_qtd').val().replace(",", "."));
	     var qtd_parcela = $("input:text[name=parcela_qtd]").val();
	   
	      if(qtd_parcela!="" && qtd_parcela!=0) {  //para mostrar o resultado apenas com valore válidos
	       var resultado = valor_parcela.toFixed(2).replace(".", ",");
	       $("input:text[name=valor_parcela]").val(resultado);
		   return false;
		 }
	 });
         

 });
 </script>
                            
                        
