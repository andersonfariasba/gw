<div class="pull-right">
<a href="<?php echo site_url('relatorio_financeiro/menu'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-search"></i>Menu Relatório Financeiro</a>
</div>


<div class="row">
  <div class="span12">
       <div class="widget ">
      
        <div class="widget-header" style="padding-left:5px;"> 
           <img src="<?php echo base_url()."/imgs/financeiro.png"?>" width="30px" border="0">
                <h3>Relatório Pagamentos</h3>
         </div> <!-- /widget-header -->
            <div class="widget-content">
              <div class="tab-pane" id="formcontrols">
        
      <!--  <form action="" id="edit-profile" class="form-horizontal">-->
            
       <form class="contact" method="post" target="_blank" id="forgot_form" action="<?php echo base_url(); ?>relatorio_financeiro/contas_pagar">
            
            
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
                <label for="nome" class="labelDados">Forma de Pagamento:</label>
                   <select name="id_forma" id="id_forma" style="width:220px;">
                        <option value="">Todos</option>
                         <?php foreach ($listForma as $objForma):   ?>
                           
                        <option value="<?php echo $objForma->getId_forma(); ?>" <?php echo set_select('id_forma',$objForma->getId_forma()); ?>>
                           <?php echo $objForma->getForma(); ?>
                        </option>
                         <?php endforeach; ?>
                </select>
               
            </div>

                <div class="campo">
                <label for="nome" class="labelDados">Status:</label>
                 <select name="status" id="status">
                    <option value="">Todos</option>   
                    <option value="<?= ABERTO; ?>" <?= set_select('status',ABERTO); ?>>NÃO AUTORIZADO</option>
                    <option value="<?= APROVADO; ?>" <?= set_select('status',APROVADO); ?>>AUTORIZADO</option>
                    <option value="<?= PAGO; ?>" <?= set_select('status',PAGO); ?>>CONCLUIDO</option>
                    <option value="<?= CANCELADO; ?>" <?= set_select('status',CANCELADO); ?>>CANCELADO
                  </select>   
              
            </div>

              <div class="campo">
                <label for="nome" class="labelDados">Centro de Custos:</label>
                <select name="id_custo" id="id_custo">
                        <option value="">Todos...</option>
                         <?php foreach ($listCusto as $objCusto): ?>
                        <option value="<?php echo $objCusto->getId_custo(); ?>" <?php echo set_select('id_custo',$objCusto->getId_custo()); ?>>
                           <?php echo $objCusto->getCusto(); ?>
                        </option>
                         <?php endforeach; ?>
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

<?php if($msg==true){ ?>
  //função para ocultar mensagem de cadastro: arquivo: js/base.js
  hideMessage();

<?php } ?>

</script>
                        
