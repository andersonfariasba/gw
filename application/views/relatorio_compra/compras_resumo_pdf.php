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
        <h2>Relatório de Compras</h2>
        <p class="data">Relatório emitido em: <?php echo $objDateFormat->date_format($data_hoje); ?> às <?php echo date('H:m');?></p>
        
        <div id="miolo_listar" class="filtro">
<fieldset>
       

 <!--<table class="dataTable">-->
    <table cellpadding="10" cellspacing="10" border="1" width="100%" class="borda">
     <thead>
         <tr>                 
                    <th align="left" class="fundoTh">DATA</th>
                      <th align="left" class="fundoTh">QUANTIDADE DE PEDIDOS</th>
          
                    <th align="left" class="fundoTh">VALOR TOTAL</th>
                  
        </tr>
     
     </thead>

      <tbody>
                  <?php 
               
                  $total_resultado = 0;
                  $total_pedidos = 0;
                  foreach ($listConta as $objConta): 
                 
                   $total_resultado = $total_resultado + $objConta['valor_total'];
                   $total_pedidos = $total_pedidos + $objConta['qtd'];
                 
                  ?>
                  <tr>
                 
                  <td><?php echo $objDateFormat->date_format($objConta['data']); ?></td>
                  <td><?php echo $objConta['qtd']; ?></td>
                  <td><?php echo number_format($objConta['valor_total'], 2, ',', '.');  ?> </td>
                
               
                    
                  </tr>
                  
                  <?php endforeach;?>
                  
                                  
                </tbody>
   
                <tfoot>
                  <tr>
                  
                    <th colspan="1"></th>
                  
                 
                    
                      <th align="left"><h4>TOTAL PEDIDOS: <?php echo $total_pedidos; ?></h4></th>               
                    <th align="left"><h4>TOTAL: <?php echo number_format($total_resultado, 2, ',', '.'); ?></h4></th>
                  </tr>
                </tfoot>
 
 </table>
</fieldset>
      
</div>
        
    </body>
</html>
