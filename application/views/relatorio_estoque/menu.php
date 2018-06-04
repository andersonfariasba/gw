<div class="row">
  <div class="span12">
       <div class="widget ">
        

        <!--<div class="widget-header">
                <i class="icon-edit"></i>
                <h3>Seja bem Vindo!</h3>
         </div> 
         -->

            
          <!--  <div class="widget-content">-->

          <div class="span11">
          
             <div class="widget-header" style="padding-left:5px;">  
             <img src="<?php echo base_url()."/imgs/estoque.png"?>" width="30px" border="0">
              <h3>Relatórios Estoque</h3>
            </div>

            <!-- INICIO MENU -->

          <div class="widget-content">
          <div class="shortcuts"> 

       
          <a href="<?php echo site_url('relatorio_estoque/estoque/');?>" class="shortcut"><i class="shortcut-icon icon-barcode"></i> <span class="shortcut-label">Produtos Vendas</span> </a>
          <a href="<?php echo site_url('relatorio_estoque/movimentacao/');?>" class="shortcut"> <i class="shortcut-icon icon-undo"></i><span class="shortcut-label">Movimentação Vendas</span> </a>
          <br />

            <a href="<?php echo site_url('relatorio_compra/estoque/');?>" class="shortcut"><i class="shortcut-icon icon-tags"></i> <span class="shortcut-label">Produtos Compras</span> </a>
            <a href="<?php echo site_url('relatorio_compra/movimentacao/');?>" class="shortcut"> <i class="shortcut-icon icon-list"></i><span class="shortcut-label">Movimentação Compra</span> </a>
         

        
        <!--<a href="<?php echo site_url('relatorio_estoque/estoque_financeiro/');?>" class="shortcut"> <i class="shortcut-icon icon-list-alt"></i><span class="shortcut-label">Estoque Financeiro</span> </a>
         -->

          </div>
          <!-- /shortcuts --> 
          </div>
          <!-- /widget-content --> 

            <!-- FINAL MENUS-->
          
          </div><!-- SPAN 6 -->  

           <!-- </div> -->
                </div>
                    </div> <!-- /widget-content -->
                        </div> <!-- /widget -->
                        

<script type="text/javascript">

<?php if($msg==true){ ?>
  //função para ocultar mensagem de cadastro: arquivo: js/base.js
  hideMessage();

<?php } ?>

</script>