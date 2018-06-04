<?php $objDateFormat = $this->DateFormat; ?> 
<script type="text/javascript" src="<?php echo base_url(); ?>js/text_numero.js"></script>
  
<div class="pull-right">
<a href="<?php echo site_url('contas_receber/filtro'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-search"></i>Buscar Contas a Receber</a>
</div>
<div class="row">
  <div class="span12">
       <div class="widget ">
        <div class="widget-header">
                <i class="icon-money"></i>
                <h3>Contas a Receber Editar</h3>
         </div> <!-- /widget-header -->
            <div class="widget-content">
              <div class="tab-pane" id="formcontrols">
        
      <!--  <form action="" id="edit-profile" class="form-horizontal">-->
            
    <?php echo form_open('contas_receber/editar/'.$objLanc->getId_lancamento(),array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
      <input type="hidden" name="tipo" class="span4" id="tipo" value="<?php echo set_value('tipo',CONTAS_RECEBER)?>">
      <input type="hidden" name="id_conta" id="id_conta" value="<?php echo set_value('id_conta',$objLanc->getId_conta()); ?>">
      <input type="hidden" name="parcela" id="parcela" value="<?php echo set_value('parcela',$objLanc->getParcela()); ?>">
      <input type="hidden" name="valor_titulo" id="valor_titulo" value="<?php echo set_value('valor_titulo',$objLanc->getValor_titulo()); ?>">
      <input type="hidden" name="id_lancamento" id="id_lancamento" value="<?php echo set_value('id_lancamento',$objLanc->getId_lancamento()); ?>">
      <input type="hidden" name="pagamento_antecipado" id="pagamento_antecipado" value="<?php echo set_value('pagamento_antecipado',$objLanc->getPagamento_antecipado()); ?>">
      
      <!-- TEMPORÁRIO PARA TESTES -->
      <input type="hidden" name="id_forma" id="id_forma" value="<?php echo set_value('id_forma',$objLanc->getId_forma()); ?>">
      <input type="hidden" name="id_bandeira" id="id_bandeira" value="<?php echo set_value('id_bandeira',$objLanc->getId_bandeira()); ?>">
     

      <!-- FINAL -->


     
      
                
      
            
            
            <fieldset>
            
            <?php if($msg==true){ ?>
            <div class="alert alert-success" id="msgOk">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><img src="<?php echo base_url()."/images/ativo.png"?>" width="25px" border="0">Conta atualizada com sucesso!</strong>
            </div>
            <?php } ?>
            
             <?php echo validation_errors(); ?>
            
              <fieldset class="grupo">
                        
              <div class="campo">
                  <label for="nome" class="labelDados">Pedido Nº:</label>
                  <input type="text"  class="span1" readonly="" value="<?php echo set_value('descricao',$objLanc->getConta()->getId_pedido());?>">
              
              </div>
               
                  
                 <div class="campo">
                <label for="nome" class="labelDados">Mesa:</label>
                  <input type="text"  class="span3" readonly="" value="<?php echo set_value('descricao',$objLanc->getConta()->getPedido()->getMesa()->getNome());?>">
             
                </div>
                  
                      
            </fieldset>
                
            <fieldset class="grupo">
                        
              <div class="campo">
                  <label for="nome" class="labelDados">Parcela:</label>
                  <input type="text"  class="span1" readonly="" value="<?php echo set_value('descricao',$objLanc->getParcela()." / ".$objLanc->getConta()->getParcela_qtd())?>">
              
              </div>
                     
              <div class="campo">
                  <label for="nome" class="labelDados">Valor Parcela:</label>
                  <input type="text"  class="span2" readonly="" value="<?php echo set_value('descricao', $objLanc->getValor_titulo())?>">
              
              </div>
                     
                                 
          </fieldset>
                
             <fieldset class="grupo">
                        
              <div class="campo">
                  <label for="nome" class="labelDados">Data Vencimento:</label>
                  <input type="text" name="data_vencimento" class="span2 calendario" id="data_vencimento" value="<?php echo set_value('data_vencimento',$objDateFormat->date_format($objLanc->getData_vencimento()))?>">
                             
              </div>
              
              <div class="campo">
                  <label for="nome" class="labelDados">Data Pagamento:</label>
                 <input type="text" name="data_pagamento" class="span2 calendario" id="data_pagamento" value="<?php echo set_value('data_pagamento',$objDateFormat->date_format($objLanc->getData_pagamento()))?>">
                                             
              </div>
             
           

                
             



             </fieldset>

             <fieldset class="grupo">

               <div class="campo">
                  <label for="nome" class="labelDados">Forma de Pagamento:</label>  
                <select disabled="" style="width:170px;">
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


                <?php if($objLanc->getId_forma()==FORMA_PAG_CREDITO || $objLanc->getId_forma()==FORMA_PAG_DEBITO) {?>
                <div class="campo">
                  <label for="nome" class="labelDados">Bandeira:</label>  
                <select disabled="" style="width:170px;">
                        <option value="">Nenhum...</option>
                         <?php foreach ($listBandeira as $objBandeira): 
                             $bandeira = $objBandeira->getId_bandeira();
                             ?>
                        <option value="<?php echo $objBandeira->getId_bandeira(); ?>" <?php echo set_select('id_bandeira',$bandeira,$objLanc->bandeiraIs($bandeira)); ?>>
                           <?php echo $objBandeira->getBandeira(); ?>
                        </option>
                         <?php endforeach; ?>
                </select>
                </div>

                <div class="campo">
                  <label for="nome" class="labelDados">Operadora:</label>
                    <input type="text"  class="span3" readonly="" value="<?php echo set_value('descricao', $objLanc->getBandeira()->getOperadora()->getEmpresa());?>">
               
                  </div>
                  </fieldset>
                <?php } ?>

               <?php //if($objLanc->getStatus()!=PAGO){ ?>
                <!--<div class="campo">
                 <label for="nome" class="labelDados">&nbsp</label>
                  <a data-toggle="modal" href="#form-content" id="incluir_forma" class="btn btn-small btn-success"><i class="btn-icon-only icon-ok"> </i>Selecionar Forma de Pagamento</a>
               </div>-->
               <?php //} ?>

                    <div class="campo">
                  <label for="nome" class="labelDados">Status:</label>     
                    <select name="status" id="status">
                <?php $status = $objLanc->getStatus();?>
                <option value="<?= $objLanc->getStatus(); ?>" <?= set_select('status',$status,$objLanc->statusIs($status)); ?>>
                <?= $objLanc->printStatusReceber(); ?>
               <option value="<?= ABERTO; ?>" <?= set_select('status',ABERTO); ?>>AGUARDANDO</option>
               <option value="<?= PAGO; ?>" <?= set_select('status',PAGO); ?>>APROVADO</option>
               <option value="<?= CANCELADO; ?>" <?= set_select('status',CANCELADO); ?>>CANCELADO
              
               </option>
                  </select>
               </div>

               </fieldset>

                
             
              <?php
            $checked_sim = null;
            $checked_nao = null;
            if($objLanc->getJuros()> 0 || $objLanc->getMulta()>0 ){
                $checked_sim = 'checked=""';
            }else{
                $checked_nao = 'checked=""';
            }
            
            
            ?>   
            
                <fieldset class="grupo">
                        
              <div class="campo">
                  <label for="nome" class="labelDados">Incluir Multa / Juros ?</label>
                  <label class="radio inline">
                    <input type="radio" name="paga" <?php echo $checked_sim; ?> id="paga_sim" value="<?php echo set_value('paga',SIM)?>"> Sim
                </label>

                <label class="radio inline">
                  <input type="radio" name="paga" <?php echo $checked_nao; ?> id="paga_nao" value="<?php echo set_value('paga',NAO)?>"> Não
                </label>                            
              </div>
                    
                    <div id="data_pagamento_label" style="display:none;">
                        <div class="campo">
                            <label for="nome" class="labelDados">Juros:</label>
                            <input type="text" name="juros" class="span2" tipo="moneyReal" id="valor" value="<?php echo set_value('juros',$objLanc->getJuros());?>">
                         </div>
                        
                        <div class="campo">
                            <label for="nome" class="labelDados">Multa:</label>
                            <input type="text" name="multa" class="span2" tipo="moneyReal" id="valor" value="<?php echo set_value('multa',$objLanc->getMulta())?>">
                         </div>
                        
                    </div>
                    
                    
                    
                </fieldset>


                 <!--<fieldset class="grupo">
                   


              <div class="campo">
                  <label for="nome" class="labelDados">Pagamento Antecipado?</label>
                  <label class="radio inline">
                    <input type="radio" name="pagamento_antecipado"  <?php if($objLanc->getPagamento_antecipado()==SIM){echo "checked=''"; }?> value="<?php echo set_value('pagamento_antecipado',SIM)?>"> Sim
                </label>

                <label class="radio inline">
                  <input type="radio" name="pagamento_antecipado" <?php if($objLanc->getPagamento_antecipado()==NAO){echo "checked=''"; }?> value="<?php echo set_value('pagamento_antecipado',NAO)?>"> Não
                </label>                            
              </div>
              </fieldset>
              -->

               <fieldset class="grupo">
                        
              <div class="campo">
                  <label for="nome" class="labelDados">Anotação</label>
                  <textarea class="span6" rows="5" name="observacao"><?php echo $objLanc->getObservacao(); ?></textarea>
              </div>
              
              </fieldset>
            
      
      
      <div class="form-actions">
            
            <input type="submit" value="Editar" class="btn btn-primary" />
            
      </div> <!-- /form-actions -->
        </fieldset>
        </form>
        </div>

            </div>
                </div>
                    </div> <!-- /widget-content -->





<!-- ALTERAR FORMA DE PAGAMENTO -->
<div id="form-content" class="modal hide fade in" style="display: none; ">
          <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                      <h3><i class="btn-icon-only icon-money"> </i>Forma de Pagamento Alterar</h3>
          </div>
  

<form action="" method="post" id="ajax_finalizar_forma">  

         <input type="hidden" name="id_lancamento" value="<?php echo $objLanc->getId_lancamento(); ?>">
         
          <fieldset>
             <div class="modal-body">
               <fieldset class="grupo">
                                        
              <div class="campo">
                <label for="nome" class="labelDados">Forma de Pagamento:</label>
                <select name="id_forma_modal" id="id_forma_modal" style="width:190px;">
            <option value="">Selecione...</option>
            <?php foreach ($listForma as $objForma): ?>
            <option value="<?php echo $objForma->getId_forma(); ?>" <?php echo set_select('id_forma',$objForma->getId_forma()); ?>>
              <?php echo $objForma->getForma(); ?>
            </option>
          <?php endforeach; ?>
         </select>
               </div>


              <div class="campo" id="bandeira_camada">
                <label for="nome" class="labelDados">Bandeira:</label>
                <select name="id_bandeira_modal" id="id_bandeira_modal" style="width:160px;">
                <option value="">-- Escolha uma bandeira --</option>
              </select>
              </div>




           </fieldset>


           <fieldset class="grupo">
   <div class="campo">
              <label for="nome" class="labelDados">Status:</label>     
                    <select name="status_modal" id="status_modal">
                <?php $status = $objLanc->getStatus();?>
                <option value="<?= $objLanc->getStatus(); ?>" <?= set_select('status',$status,$objLanc->statusIs($status)); ?>>
                <?= $objLanc->printStatusReceber(); ?>
               <option value="<?= ABERTO; ?>" <?= set_select('status',ABERTO); ?>>AGUARDANDO</option>
               <option value="<?= PAGO; ?>" <?= set_select('status',PAGO); ?>>APROVADO</option>
               <option value="<?= CANCELADO; ?>" <?= set_select('status',CANCELADO); ?>>CANCELADO</option>
                  </select>
              </div>
              </fieldset>

  
  </div>    


      
    
       <div class="modal-footer">
          <input type="submit" class="btn btn-primary" value="Confirmar Alteração" id="alterar_forma" />
       
           <a href="#" class="btn" data-dismiss="modal"><i class="icon-remove icon-white"></i> Fechar</a>

       </div>
            </form>
  </div>
<!-- FINAL MODAL -->










                        </div> <!-- /widget -->
                        
                        

     <script type="text/javascript">
 $(function() {
      

$('#id_forma_modal').change(function(){
        if( $(this).val() ) {
         //alert($(this).val())
         //var id = $(this).val();

         
          $('.carregando').show();
            var url = '<?= site_url("/bandeira_cartao/listarPorForma/"); ?>/' + $(this).val();
       
         $.getJSON(url, function(j){
                   
            
            var options = '<option value="">Selecione...</option>'; 
              for (var i = 0; i < j.length; i++) {
                options += '<option value="' + j[i].id_bandeira + '">' + j[i].bandeira + '</option>';
              } 
             $('#id_bandeira_modal').html(options).show();
             
            
             if(j.length>0){
              $('#bandeira_camada').show();
             }else{
                $('#bandeira_camada').hide();
             }

             $('.carregando').hide();
          });

         
        } 
        else{
          $('#id_bandeira_modal').html('<option value="">-- Escolha uma Bandeira --</option>');
        }
      });


       
        //AO CONFIRMAR A FORMA DE PAGAMENTO
        $('#alterar_forma').click(function(e){

           
         //VALIDAÇÕES DOS CAMPOS DE FORMAS DE PAGAMENTOS
          if($('#id_forma_modal').val()==""){
            alert('Campo Forma de Pagamento Vazio.');
           return false;
          }

          
          if( ($('#id_forma_modal').val()==2 || $('#id_forma_modal').val()==3) && ( $('#id_bandeira_modal').val()=="" ) ){
            alert('Campo Bandeira Vazio.');
           return false;
          }
          // FINAL DA VALIDAÇÃO
                          
          e.preventDefault();
              
         $.ajax({
             type: 'POST',
             url: "<?php echo site_url('contas_receber/alterar_forma_pagamento/'); ?>",         
             data: $('#ajax_finalizar_forma').serialize(),
             success : function(txt){
              var id_lancamento = $('#id_lancamento').val();
              window.location.href="<?php echo site_url('contas_receber/editar/'); ?>"+"/"+id_lancamento;
              //window.close();
              
        },
        error: function (request, status, error) {
        alert(request.responseText);
         }
             
         });

         return false;

        });

//FINAL FORMA DE PAGAMENTO





      //$(document).ready(function(){
                     
               
                     
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
             
        

        //});

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
                            
                        

<script type="text/javascript">

<?php if($msg==true){ ?>
  //função para ocultar mensagem de cadastro: arquivo: js/base.js
  hideMessage();

<?php } ?>

</script>