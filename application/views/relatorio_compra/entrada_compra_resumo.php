<div class="pull-right">
<a href="<?php echo site_url('relatorio_compra/menu'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-search"></i>Menu Compras</a>
</div>

<div class="row">
  <div class="span12">
       <div class="widget ">
        
             <div class="widget-header" style="padding-left:5px;"> 
           <img src="<?php echo base_url()."/imgs/compras.png"?>" width="30px" border="0">
                <h3>Relatório Compras</h3>
         </div> <!-- /widget-header -->
            <div class="widget-content">
              <div class="tab-pane" id="formcontrols">
        
      <!--  <form action="" id="edit-profile" class="form-horizontal">-->
            
       <form class="contact" method="post" target="_blank" id="forgot_form" action="<?php echo base_url(); ?>relatorio_compra/compras_resumo">
            
            
            <fieldset>
        
            
                           
      <fieldset class="grupo">
                        
         

            <div class="campo">
                <label for="nome" class="labelDados">Data De:</label>
                <input type="text" name="data_de" class="span2 calendario" id="data_de" value="<?php echo set_value('data_de')?>">
            </div>

             <div class="campo">
                <label for="nome" class="labelDados">Data Até:</label>
                <input type="text" name="data_ate" class="span2 calendario" id="data_ate" value="<?php echo set_value('data_ate')?>">
            </div>
        </fieldset>

      
<!--
      <fieldset class="grupo">

            <div class="campo">
                <label for="nome" class="labelDados">Código de Venda:</label>
                <input type="text" name="id_pedido" class="span2" id="id_pedido" value="<?php echo set_value('id_pedido')?>">
            </div>

            <div class="campo">
                <label for="nome" class="labelDados">Mesa:</label>
                  <select name="id_mesa" id="id_mesa" style="width:200px;">
            <option value="">Todos</option>
          
              <?php foreach ($listMesa as $objMesa): ?>
                  <option value="<?php echo $objMesa->getId_mesa(); ?>" <?php echo set_select('id_mesa',$objMesa->getId_mesa()); ?>>
                    <?php echo $objMesa->getNome(); ?>
                  </option>
              <?php endforeach; ?>
          </select>
                 
               
            </div>

                <div class="campo">
                <label for="nome" class="labelDados">Garçom:</label>
               <select name="id_garcom" id="id_garcom">
               <option value="">Todos</option>
              <?php foreach ($listGarcom as $objGarcom): ?>
                  <option value="<?php echo $objGarcom->getId_colaborador(); ?>" <?php echo set_select('id_colaborador',$objGarcom->getId_colaborador()); ?>>
                    <?php echo $objGarcom->getNome(); ?>
                  </option>
              <?php endforeach; ?>
          </select>
              
            </div>

              <div class="campo">
                <label for="nome" class="labelDados">Status:</label>
                  <select name="status" id="status">
                                    <option value="">Todos</option>   
                                    <option value="<?= ANDAMENTO; ?>" <?= set_select('status',ANDAMENTO); ?>>ANDAMENTO</option>
                                    <option value="<?= APROVADO; ?>" <?= set_select('status',APROVADO); ?>>REALIZADO</option>
                                    <option value="<?= FINALIZADO; ?>" <?= set_select('status',FINALIZADO); ?>>FINALIZADO</option>
                                    <option value="<?= CANCELADO; ?>" <?= set_select('status',CANCELADO); ?>>CANCELADO</option>
                                   </select>  
              </div>




    </fieldset>
          --> 
                        
                     
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
                        
