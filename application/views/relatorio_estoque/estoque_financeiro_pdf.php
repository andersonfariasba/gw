<?php $objDateFormat = $this->DateFormat; 

$data_hoje = date('Y-m-d');

//if($tipo==ADD_MOV):
//    $tituloColuna = "ENTRADA";
//    $estilo_pedido = "";
//
//else:
//
//    $estilo_orcamento = "";
//    $tituloColuna = "SAIDA";
//endif;

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
        <title>RELATORIO FINANCEIRO ESTOQUE</title>
        <link href="<?= base_url() ?>css/relatorio.css" rel="stylesheet" type="text/css" />

    </head>
    <body>
        <h2>Relatório Financeiro Estoque<?php //echo $tituloColuna; ?></h2>
        <p class="data">Relatório emitido em: <?php echo $objDateFormat->date_format($data_hoje); ?> às <?php echo date('H:m');?></p>
        
        <div id="miolo_listar" class="filtro">

            
            <div id="miolo_listar" class="filtro">

                
                <table cellpadding="10" cellspacing="10" border="1" class="borda" width="100%">
      <thead>
       <tr>
         
         <th align="left" class="fundoTh" width="15%">DATA MOVIMENTAÇÃO</th>
          <th align="left" class="fundoTh" width="15%">PEDIDO</th>
           
         <th align="left" class="fundoTh">COD.</th>
         <th align="left" class="fundoTh">REF.</th>
         <th align="left" class="fundoTh">PRODUTO</th>
          <th align="left" class="fundoTh">VALOR CUSTO</th>
           <th align="left" class="fundoTh">VALOR VENDA</th>
          
         
         <th align="center" class="fundoTh">QTD</th>
         
         <th align="center" class="fundoTh">SUB-TOTAL VENDA</th>
          <th align="center" class="fundoTh">SUB-TOTAL CUSTO</th>
         
                 
       
           
     
     </thead>
     <tbody>
        <?php 
        $item = 0;
        $total_custo = 0;
        $sub_total_custo = 0; 
        $sub_total_venda = 0; 
        $total_venda = 0;
        foreach ($listEstoque as $objProduto):
         $item++;  
           //            if($objProduto->getCod_pedido()!=NULL):
        
         $sub_total_custo = $objProduto->getProduto()->getValor_custo() * $objProduto->getQtd_mov();
         $sub_total_venda = $objProduto->getValor_unitario() *  $objProduto->getQtd_mov();
         $total_custo = $total_custo + $sub_total_custo;
         $total_venda = $total_venda + $sub_total_venda;
            ?>
         
         
             <tr> 
              
               <td><?php echo $objDateFormat->date_format($objProduto->getData()); ?></td>
                <td><?php 
                              if($objProduto->getId_pedido()!=""){
                               echo  $objProduto->getId_pedido();
                              } else{
                                echo "Retirada avulso";
                              }

                           ?></td>
               
               <td><?php echo $objProduto->getProduto()->getCodigo(); ?></td>
               
               <td><?php echo $objProduto->getProduto()->getReferencia(); ?></td>
               
               <td><?php echo $objProduto->getProduto()->getDescricao(); ?></td>
               
                <td><?php echo $objProduto->getProduto()->getValor_custo(); ?></td>
                
                <td><?php echo $objProduto->getValor_unitario(); ?></td>
                
             
               
               <td align="center">
               <?php echo $objProduto->getQtd_mov(); ?>
               </td>
               
                   <td><?php echo number_format($sub_total_venda, 2, ',', '.'); //$objProduto->getValor_total(); ?></td>
                     <td><?php echo number_format($sub_total_custo, 2, ',', '.'); ?></td>
               
                   
                 
               
               
               </tr>
        <?php
                //endif;
            
        endforeach; ?>		
     </tbody>    
 </table>

                
</div>

<!--<h5>TOTAL ESTOQUE R$: <?php echo number_format($total_geral, 2, ',', '.'); ?></h5>  
-->
<h5>TOTAL ITENS: <?php echo $item; ?></h5>  
<h5>TOTAL VENDA R$: <?php echo number_format($total_venda, 2, ',', '.'); ?></h5>
<h5>TOTAL CUSTO R$: <?php echo number_format($total_custo, 2, ',', '.'); ?></h5>
<h5>SALDO R$: <?php echo number_format($total_venda-$total_custo, 2, ',', '.'); ?></h5>

</div>
        
        
        
        
    </body>
</html>
