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
        <h2>Relatório de Produtos de Compras</h2>
        <p class="data">Relatório emitido em: <?php echo $objDateFormat->date_format($data_hoje); ?> às <?php echo date('H:m');?></p>
        
        <div id="miolo_listar" class="filtro">
<fieldset>
       

    <table cellpadding="10" cellspacing="10" border="1" width="100%" class="borda">
                <thead>
                  <tr>
                   <th align="left" class="fundoTh"></th>
                  <th align="left" class="fundoTh">DESCRICAO</th>
                  <th align="left" class="fundoTh">CÓDIGO</th>
                  <th align="left" class="fundoTh">CATEGORIA</th>
                  <th align="left" class="fundoTh">QTD DISPONÍVEL</th>
                    
                  </tr>
                </thead>
                <tfoot>
                    <tr>
                    <th align="left" class="fundoTh"></th>
                  <th align="left" class="fundoTh">DESCRICAO</th>
                     <th align="left" class="fundoTh">CÓDIGO</th>
                    <th align="left" class="fundoTh">CATEGORIA</th>
                     
                    <th align="left" class="fundoTh">QTD DISPONÍVEL</th>
                    
                  </tr>
                </tfoot>
                <tbody>
                  <?php 
                  $qtd_estoque = "";
                  $qtd_itens = 0;
                  foreach ($listProdutos as $objProduto): 
                    $qtd_itens++;

                  
                     if ($objProduto->getQtdEstoque() != NULL) {
                        if($objProduto->getQtdEstoque()>0){
                      
                         $qtd_estoque = $objProduto->getQtdEstoque();
                        }
                    } else {
                        $qtd_estoque = '-';
                    } 

                    


                  ?>
                  
                <?php if($qtd_estoque<$objProduto->getQtd_minima()) { ?>
                  <tr class="aberto">
              <?php } else{ ?>
                  <tr class="">

              <?php } ?>

                    <td><?php echo $qtd_itens; ?></td>
                  <td><?php echo $objProduto->getDescricao(); ?></td>
                  <td><?php echo $objProduto->getCodigo(); ?></td>
                  <td><?php echo $objProduto->getCategoria()->getCategoria(); ?></td>
                 
                  
                 <td>
                    
                    <?php 
                        
                       echo $qtd_estoque;
                    ?>
                  </td>
                  
                
                    
                  </tr>
                  
                  <?php endforeach;?>
                  
                                  
                </tbody>
              </table>



</fieldset>
      
</div>
        
    </body>
</html>
