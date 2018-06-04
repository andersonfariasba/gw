<div class="pull-right">
<a href="<?php echo site_url('relatorio_estoque/menu'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-search"></i>Menu Relatorio Estoque</a>
</div>

<div class="row">
  <div class="span12">
       <div class="widget ">
        <div class="widget-header" style="padding-left:5px;">
                 <img src="<?php echo base_url()."/imgs/estoque.png"?>" width="30px" border="0">
                <h3>Relatório Movimentação Estoque</h3>
         </div> <!-- /widget-header -->
            <div class="widget-content">
              <div class="tab-pane" id="formcontrols">
        
      <!--  <form action="" id="edit-profile" class="form-horizontal">-->
            
       <form class="contact" method="post" target="_blank" id="forgot_form" action="<?php echo base_url(); ?>relatorio_estoque/movimentacao">
            
            
            <fieldset>
        
            
                           
      <fieldset class="grupo">
                        
             <div class="campo">
                <label for="nome" class="labelDados">Vencimento De:</label>
                <input type="text" name="data_de" class="span2 calendario" id="data_de" value="<?php echo set_value('data_de')?>">
            </div>

             <div class="campo">
                <label for="nome" class="labelDados">Vencimento Até:</label>
                <input type="text" name="data_ate" class="span2 calendario" id="data_ate" value="<?php echo set_value('data_ate')?>">
            </div>

             <div class="campo">
              <label for="nome" class="labelDados">Tipo Movimentação:</label>
              <label class="radio inline">
                    <input type="radio" name="tipo_movimentacao" checked="" value=""> <span style="font-weight:bold">Todas</span>
                </label>
                          <label class="radio inline">            
                    <input type="radio"  name="tipo_movimentacao" value="<?php echo set_value('tipo_movimentacao',ENTRADA)?>"> <span style="color:green;font-weight:bold">Entrada</span>
                </label>

                <label class="radio inline">
                    <input type="radio" name="tipo_movimentacao" value="<?php echo set_value('tipo_movimentacao',SAIDA)?>"> <span style="color:red;font-weight:bold">Saída</span>
                </label>
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

<?php if($msg==true){ ?>
  //função para ocultar mensagem de cadastro: arquivo: js/base.js
  hideMessage();

<?php } ?>

</script>
                        
