<div class="pull-right">
<a href="<?php echo site_url('relatorio_comercial/menu'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-search"></i>Menu Relatorio Comercial</a>
</div>


<div class="row">
  <div class="span12">
       <div class="widget ">
        <div class="widget-header" style="padding-left:5px;">
                 <img src="<?php echo base_url()."/imgs/comercial.png"?>" width="30px" border="0">
                <h3>Relatório Cliente</h3>
         </div> <!-- /widget-header -->
            <div class="widget-content">
              <div class="tab-pane" id="formcontrols">
        
      <!--  <form action="" id="edit-profile" class="form-horizontal">-->
            
       <form class="contact" method="post" target="_blank" id="forgot_form" action="<?php echo base_url(); ?>relatorio_comercial/clientes">
            
            
            <fieldset>
        
            
                           
      <fieldset class="grupo">
                        
            <div class="campo">
             <label for="nome" class="labelDados">Tipo:</label>
             <select name="tipo" id="tipo">
                  <option value="">Todos</option>
                  <option value="<?= PESSOA_JURIDICA; ?>" <?= set_select('tipo',PESSOA_JURIDICA); ?>>Pessoa Juridica</option>
                  <option value="<?= PESSOA_FISICA; ?>" <?= set_select('tipo',PESSOA_FISICA); ?>>Pessoa Física</option>
              </select>
            </div>

           <div class="campo">
              <label for="nome" class="labelDados">Nome Fantasia:</label>
              <input type="text" name="nome_fantasia" class="span3" id="nome_fantasia" value="<?php echo set_value('nome_fantasia')?>">
             </div>

              <div class="campo">
              <label for="nome" class="labelDados">CPF OU CNPJ:</label>
              <input type="text"  name="cnpj_cpf" id="cnpj_cpf" class="span2" value="<?php echo set_value('cnpj_cpf')?>">
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
                        
