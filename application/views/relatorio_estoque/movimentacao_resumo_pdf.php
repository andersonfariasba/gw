<style type="text/css">
  .saida{
    color:red;
    font-weight:bold;
}
.entrada{
    color:green;
    font-weight:bold;
}
</style>
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
        <h2>Relatório Movimentação de Estoque</h2>
        <p class="data">Relatório emitido em: <?php echo $objDateFormat->date_format($data_hoje); ?> às <?php echo date('H:m');?></p>
         <p class="data">Período da Pesquisa: <?php echo $data_de; ?> até <?php echo $data_ate; ?> </p>
        
        <div id="miolo_listar" class="filtro">
<fieldset>
       

    <table cellpadding="10" cellspacing="10" border="1" width="100%" class="borda">
                <thead>
                  <tr>
                  <th align="left" class="fundoTh"></th>
                
                  <th align="left" class="fundoTh">PRODUTO</th>
                 <th align="center" class="fundoTh">MOVIMENTAÇÃO</th>
                  <th align="left" class="fundoTh">QTD</th>
                   <th align="left" class="fundoTh">VENDAS</th>
                   <th align="left" class="fundoTh">CUSTOS</th>
                   <th align="left" class="fundoTh">LUCRO</th>
                 
               
                 
                  </tr>
                </thead>
                <tfoot>
                    <tr>
                   <th align="left" class="fundoTh"></th>
                
                  <th align="left" class="fundoTh">PRODUTO</th>
                  <th align="center" class="fundoTh">MOVIMENTAÇÃO</th>
                  <th align="left" class="fundoTh">QTD</th>
                   <th align="left" class="fundoTh">VENDAS</th>
                    <th align="left" class="fundoTh">CUSTOS</th>
                    <th align="left" class="fundoTh">LUCRO</th>
                 
                 
                  </tr>
                </tfoot>
                <tbody>
                  <?php 
                    $qtd_itens = 0;
                    $sub_total_venda = 0;
                    $sub_total_custo = 0;
                    $sub_lucro = 0;
                    $total_lucro = 0;
                    $total_venda = 0;
                    $total_custo = 0;
                  foreach ($listMov as $objMov):
                      $sub_total_venda = $objMov['valor_venda'] * $objMov['qtd'] ;
                      $sub_total_custo = $objMov['valor_custo'] * $objMov['qtd'] ;
                      $sub_lucro = $sub_total_venda - $sub_total_custo;
                      $total_lucro = $total_lucro + $sub_lucro;
                      $total_venda = $total_venda + $sub_total_venda;
                      $total_custo = $total_custo + $sub_total_custo;
                  
                    $qtd_itens++;
                  ?>
                  <tr>
                  <td><?php echo $qtd_itens; ?></td>
                  <td><?php echo $objMov['descricao']; ?></td>
                                 
                  <td align="center">
                 
                   <?php 
                  
                  if($objMov['tipo_movimentacao']==REMOVER_MOV){
                     echo '<span class=saida>';
                        echo "SAIDA";
                     echo '<span/>';
                  }
                  else{
                     echo '<span class=entrada>';
                        echo "ENTRADA";
                     echo '<span/>';
                  }



                  ?>
                    
                
                 

                  </td>
                 
                  <td><?php echo round($objMov['qtd'],0);?></td>
                    <td><?php echo number_format($sub_total_venda, 2, ',', '.'); ?></td>
                     <td><?php echo number_format($sub_total_custo, 2, ',', '.'); ?></td>
                        <td><?php echo number_format($sub_lucro, 2, ',', '.'); ?></td>
                   
                
                 
               
                    
                  </tr>
                  
                  <?php endforeach;?>
                  
                                  
                </tbody>
               
              </table>
              <br />

              <table cellpadding="10" cellspacing="10" border="1" width="100%" class="borda">
                <tr>
                  <th align="left" class="fundoTh">TOTAL VENDA</th>
                    <th align="left" class="fundoTh">TOTAL CUSTO</th>
                      <th align="left" class="fundoTh">TOTAL LUCRO</th>
                </tr>

                <tr>
                <td><?php echo number_format($total_venda, 2, ',', '.'); ?></td>
                <td><?php echo number_format($total_custo, 2, ',', '.'); ?></td>
                <td><?php echo number_format($total_lucro, 2, ',', '.'); ?></td>
                </tr>
              </table>
                




</fieldset>

     
</div>
        
    </body>
</html>
