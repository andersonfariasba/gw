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
           <img src="<?php echo base_url()."/imgs/financeiro.png"?>" width="30px" border="0">
              <h3>Relatórios Financeiros</h3>
            </div>

            <!-- INICIO MENU -->

          <div class="widget-content">
          <div class="shortcuts"> 

       
          <a href="<?php echo site_url('relatorio_financeiro/contas_pagar/');?>" class="shortcut"><i class="shortcut-icon icon-minus"></i> <span class="shortcut-label">Contas a Pagar</span> </a>
          <a href="<?php echo site_url('relatorio_financeiro/contas_receber_resumo/');?>" class="shortcut"> <i class="shortcut-icon icon-plus"></i><span class="shortcut-label">Contas a Receber</span> </a>
            <a href="<?php echo site_url('relatorio_financeiro/contas_receber_cartao/');?>" class="shortcut"> <i class="shortcut-icon icon-credit-card"></i><span class="shortcut-label">Recebimentos com Cartões</span> </a>
         
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