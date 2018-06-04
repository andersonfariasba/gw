<?php $objDateFormat = $this->DateFormat; 

$data_hoje = date('Y-m-d');
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $titulo; ?></title>
        <link href="<?= base_url() ?>css/relatorio.css" rel="stylesheet" type="text/css" />

    </head>
    <body>
        <h2>Relatório de Recebimentos</h2>
        <p class="data">Relatório emitido em: <?php echo $objDateFormat->date_format($data_hoje); ?> às <?php echo date('H:m');?></p>
        
        <div id="miolo_listar" class="filtro">
<fieldset>
       

 <!--<table class="dataTable">-->
    <table cellpadding="10" cellspacing="10" border="1" width="100%" class="borda">
     <thead>
         <tr>                 
                    <th align="left" class="fundoTh">DATA VENCIMENTO</th>
                 
                    <th align="left" class="fundoTh">FORMA DE PAGAMENTO</th>
                       <th align="left" class="fundoTh">QTD PEDIDO</th>
                    <th align="left" class="fundoTh">VALOR</th>
          
        </tr>
     
     </thead>

      <tbody>
                  <?php 
                  $total = 0;
                  $total_pedido = 0;
                  foreach ($listLanc as $objLanc): 
                   $total = $total + $objLanc['valor'];
                   $total_pedido = $total_pedido + $objLanc['qtd_pedido'];      
                   ?>
                   <tr class="">

               
                  
                  <td><?php echo $objDateFormat->date_format($objLanc['data_vencimento']); ?></td>
                 
                   <td><?php echo $objLanc['forma']; ?></td>
                  <td><?php echo $objLanc['qtd_pedido']; ?></td>
                  <td><?php echo $objLanc['valor']; ?></td>
                
                                
                
                  </tr>
                  
                  <?php endforeach;?>
                  
                                  
                </tbody>
   
                <tfoot>
                  <tr>
                  
                    <th colspan="2"></th>
                  
                 
                    
                    <th align="left"><h4>TOTAL PEDIDO: <?php echo $total_pedido; ?></h4></th>               
                    <th align="left"><h4>TOTAL RECEBER: R$ <?php echo number_format($total, 2, ',', '.'); ?></h4></th>
                  </tr>
                </tfoot>
 
 </table>
</fieldset>
      
</div>
        
    </body>
</html>
