<div class="pull-right">
<a href="<?php echo site_url('relatorio_financeiro/menu'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-search"></i>Menu Relatório Financeiro</a>
</div>


<div class="row">
  <div class="span12">
       <div class="widget ">
         <div class="widget-header" style="padding-left:5px;"> 
           <img src="<?php echo base_url()."/imgs/financeiro.png"?>" width="30px" border="0">
                <h3>Relatório Recebimentos com Cartões</h3>
         </div> <!-- /widget-header -->
            <div class="widget-content">
              <div class="tab-pane" id="formcontrols">
        
      <!--  <form action="" id="edit-profile" class="form-horizontal">-->
            
       <form class="contact" method="post" target="_blank" id="forgot_form" action="<?php echo base_url(); ?>relatorio_financeiro/contas_receber_cartao">
            
            
            <fieldset>
        
            
                           
      <fieldset class="grupo">
                        
            <div class="campo">
                <label for="nome" class="labelDados">Periodo De:</label>
                <input type="text" name="data_de" class="span2 calendario" id="data_de" value="<?php echo set_value('data_de')?>">
            </div>

             <div class="campo">
                <label for="nome" class="labelDados">Periodo Até:</label>
                <input type="text" name="data_ate" class="span2 calendario" id="data_ate" value="<?php echo set_value('data_ate')?>">
            </div>

           <div class="campo">
                <label for="nome" class="labelDados">Operadora:</label>
                 <select name="id_operadora" id="id_operadora" style="width:160px;">
                <option value="">Selecione...</option>
              </select>
               
               </div>

                 <div class="campo" id="bandeira_camada">
                <label for="nome" class="labelDados">Bandeira:</label>
                <select name="id_bandeira" id="id_bandeira" style="width:160px;">
                <option value="">Nenhuma</option>
              </select>
              </div>


               



    </fieldset>
           
                        
                     
            <div class="form-actions">
            
            <input type="submit" value="Gerar Relatório" class="btn btn-primary" />
         
            
            
            </div> <!-- /form-actions -->
        </fieldset>
        </form>
        </div>

            </div>
                </div>
                    </div> <!-- /widget-content -->
                        </div> <!-- /widget -->


<script type="text/javascript">

$(function () {

   var url = '<?= site_url("/operadoras_cartao/ajax_listar/0"); ?>/';
          $.getJSON(url, function(j){
                   
            
            var options = '<option value="">Nenhum...</option>'; 
              for (var i = 0; i < j.length; i++) {
                options += '<option value="' + j[i].id_operadora + '">' + j[i].empresa + '</option>';
              } 
             $('#id_operadora').html(options).show();
             
            
            /* if(j.length>0){
              $('#operadora_camada').show();
             }else{
                $('#operadora_camada').hide();
             }*/

             $('.carregando').hide();
          });


           $('#id_operadora').change(function(){
       
   $('#bandeira_camada').show();
   var url = '<?= site_url("/bandeira_cartao/listarPorOperadora/"); ?>/'+$(this).val();
   $.getJSON(url, function(j){
                             
      var options = '';
       options += '<option value="">Nenhum...</option>';
       for (var i = 0; i < j.length; i++) {
          options += '<option value="' + j[i].id_bandeira + '">' + j[i].bandeira + '</option>';
        } 
       
       
       $('#id_bandeira').html(options).show();
       
    });
});



  });



<?php if($msg==true){ ?>
  //função para ocultar mensagem de cadastro: arquivo: js/base.js
  hideMessage();

<?php } ?>

</script>
                        
