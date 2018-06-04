<?php $objDateFormat = $this->DateFormat; ?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style type="text/css">
            table.bordasimples {border-collapse: collapse;}

            table.bordasimples tr td th {border:1px solid #666666;font-size:12px;font-family:verdana  }
            .rotulo{font-weight:bold;}
            .titulo{
                font-size:14px; 
            }
           
        </style>
    </head>
    <body>
       
        <?php $tipo = ($objPedido->getTipo()==ORCAMENTO)?"Orçamento":"Pedido";  ?>

       
         <h2>Dados <?php echo $tipo; ?>:</h2>

         <table border="1" cellspacing="3" cellpadding="8" width="100%" class="bordasimples">
         
            <tr>
                <td class="rotulo">Nº <?php echo $tipo; ?>: <?php echo $objPedido->getId_pedido(); ?> ( <?php echo $objPedido->printStatus(); ?> )</td>
                  <td class="rotulo">Data Pedido:  <?php echo $objDateFormat->date_format($objPedido->getData_inicio()); ?> </td>

            </tr>


            <tr>
                <td class="rotulo" colspan="2">Nome / Razão Social: <?php echo $objPedido->getCliente()->getNome_fantasia(); ?></td>
                

            </tr>

            <tr>
                <td class="rotulo">Telefone: <?php echo $objPedido->getCliente()->getTelefone1(); ?></td>
               
                <td class="rotulo">Celular: <?php echo $objPedido->getCliente()->getCelular(); ?></td>
                
            </tr>

            <tr>
                <td colspan="2" class="rotulo">E-mail: <?php echo $objPedido->getCliente()->getEmail(); ?></td>
               
              
                
            </tr>

            
        </table>


         <h2>Itens Pedidos:</h2>


         <table border="1" cellspacing="3" cellpadding="8" width="100%" class="bordasimples">
      <thead>
        <tr>
          <th>CODIGO</th>
          <th>PRODUTO</th>
          <th>VALOR UNITÁRIO</th>
          <th>QTD</th>
          <th>SUB-TOTAL</th>
          
        </tr>
      </thead>

      <tbody>
         <?php 
         $sub_total = 0;
         $total = 0;
         foreach($listItens as $objItem): 
            $sub_total = $objItem->getValor_unitario() * $objItem->getQtd();
            $total = $total + $sub_total;

           ?>
            <tr>           
                <td><?php echo $objItem->getProduto()->getCodigo(); ?></td>
                <td><?php echo $objItem->getProduto()->getDescricao(); ?></td>
                <td><?php echo number_format($objItem->getValor_unitario(), 2, ',', '.'); ?></td>
                <td><?php echo $objItem->getQtd(); ?></td>
                <td><?php echo number_format($sub_total, 2, ',', '.'); ?></td>
                

            </tr>
        
        
        <?php endforeach; ?>
        
         
        
      </tbody>

    </table>
    
<br />

   


    <?php if($objPedido->getStatus()==FINALIZADO){ ?>
    
    <h2>Financeiro:</h2>
    <table border="1" cellspacing="3" cellpadding="8" width="100%" class="bordasimples">

    <thead>
      <tr>
        <th>DATA VENCIMENTO</th>
        <th>FORMA DE PAG.</th>
        <th>VALOR TITULO</th>
        <th>PARCELA</th>
        <th>STATUS</th>
      </tr>
    </thead>

    <tbody>
      <?php 
      $total_lanc = 0;
      foreach ($listLanc as $objLanc): 
        $total_lanc+=$objLanc->getValor_titulo();   
        ?>

        <tr class="">
              
          <td><?php echo $objDateFormat->date_format($objLanc->getData_vencimento()); ?></td>
          <td><?php echo $objLanc->getForma()->getForma(); ?></td>
          <td><?php echo $objLanc->getValor_titulo(); ?></td>
          <td>
          <?php echo $objLanc->getParcela()." / ".$objLanc->getConta()->getParcela_qtd(); ?>
          <?php if($objLanc->getPagamento_antecipado()==SIM){ echo "<strong>(Pagamento Antecipado)</strong>"; } ?>
          </td>

          <td><?php echo $objLanc->printStatusPagar(); ?></td>



        </tr>

      <?php endforeach;?>

          
    </tbody>




    </table>




    <?php } //final status ?>



<br />


 <table border="1" cellspacing="3" cellpadding="8" width="100%" class="bordasimples">
        <tr>
            <td class="rotulo">TOTAL PEDIDO</td>
            <td class="rotulo">FRETE</td>
            <td class="rotulo">DESCONTO</td>
            <td class="rotulo">TOTAL PAGAR</td>
            


        </tr>

        <tr>
            <td><?php echo number_format($total, 2, ',', '.'); ?></td>
            <td><?php echo number_format($objPedido->getTaxa_frete(), 2, ',', '.');?></td>
            <td><?php echo number_format($objPedido->getDesconto(), 2, ',', '.'); ?></td>
            <?php $total_pagar = ($total + $objPedido->getTaxa_frete()) - $objPedido->getDesconto(); ?>
            <td><?php echo number_format($total_pagar, 2, ',', '.'); ?></td>
        </tr>



    </table>           
       
        
        

    
    </body>
</html>
