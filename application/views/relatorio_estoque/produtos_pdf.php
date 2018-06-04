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
        <link href="<?= base_url(); ?>css/style_report.css" rel="stylesheet">


    </head>
    <body>

    <?php if($this->session->userdata('logo')!=""){ ?>
               
                <table width="100%" class="dadosEmpresa">
                  <tr>
                  <td>
                <img src="<?= base_url(); ?>images/<?php echo $this->session->userdata('logo'); ?>" alt="" width="80px;">
                </td>
                <td>
                   <h4><?php echo $this->session->userdata('filial_nome'); ?></h4>
                   <p>CNPJ: <?php echo $this->session->userdata('filial_documento'); ?></p>
                    <p>Endereço: <?php echo $this->session->userdata('filial_endereco'); ?></p>
                     <p>Bairro: <?php echo $this->session->userdata('filial_bairro'); ?></p>
                     

                </td>
                <td>
                       <p>Estado: <?php echo $this->session->userdata('filial_estado'); ?></p>
                       <p>Cidade: <?php echo $this->session->userdata('filial_cidade'); ?></p>
                       
                   <p>Email: <?php echo $this->session->userdata('filial_email'); ?></p>
                   <p>Telefone: <?php echo $this->session->userdata('filial_telefone'); ?></p>
                </td>

                </table>            
               
              <?php } ?>

        <hr />   



        <h2>Relatório de Produtos</h2>
        <p class="data">Relatório emitido em: <?php echo $objDateFormat->date_format($data_hoje); ?> às <?php echo date('H:m');?></p>
        
        <div id="miolo_listar" class="filtro">
<fieldset>
       

<table border="1" cellspacing="8" cellpadding="5" class="bordasimples" width="100%">
                <thead>
                  <tr>
                   <td class="rotulo"></td>
                   <td class="rotulo">PRODUTO</td>
                 <td class="rotulo">CÓDIGO</td>
                 <td class="rotulo">CATEGORIA</td>
                 
                 <td class="rotulo">VALOR VENDA</td>
                 
                 <td class="rotulo">QTD DISPONÍVEL</td>
                   <td class="rotulo">SUB-TOTAL FINANCEIRO</td>
                    
                  </tr>
                </thead>
               
                <tbody>
                  <?php 
                 $entrada = 0;
                  $saida = 0;
                  $qtd = 0;
                  $qtd_itens = 0;
                  $total_financeiro = 0;
                  $sub_total = 0;
                  $total_qtd;
                  foreach ($listProdutos as $objProduto): 
                    $qtd_itens++;
                  $sub_total = $objProduto['valor_venda'] * $objProduto['saldo'];
                  $total_financeiro = $total_financeiro + $sub_total;
                  $total_qtd = $total_qtd + $objProduto['saldo'];

                  
                   
                    $qtd = $objProduto['saldo'];

                    


                  ?>
                  
                 <?php if($qtd<0 || $qtd<$objProduto['qtd_minima'] ) { ?>
                   <tr class="dadosTabela aberto" style:color:red;>
              <?php } else { ?>
                  <tr class="dadosTabela">

              <?php } ?>

                   <td><?php echo $qtd_itens; ?></td>
                 <td><?php echo $objProduto['produto']; ?></td>
                  <td><?php echo $objProduto['codigo']; ?></td>
                  <td><?php echo $objProduto['categoria']; ?></td>
                 
                  <td>R$: <?php echo number_format($objProduto['valor_venda'], 2, ',', '.'); ?></td>
                                  

                 <td>
                  <?php 
                  echo round($objProduto['saldo'],0);
                  //echo number_fat($qtd, 2, ',', '.'); ?>  
                   
                 </td>
                   <td width="150px">R$: <?php echo number_format($objProduto['valor_venda'] * $objProduto['saldo'], 2, ',', '.'); ?></td>

                  
                
                  
                
                    
                  </tr>
                  
                  <?php endforeach;?>
                  
                                  
                </tbody>

                 <tfoot>
                    <tr>
                   <td class="rotulo"></td>
                   <td class="rotulo">PRODUTO</td>
                 <td class="rotulo">CÓDIGO</td>
                 <td class="rotulo">CATEGORIA</td>
                 
                 <td class="rotulo">VALOR VENDA</td>
                                  <td class="rotulo">TOTAL = <?php echo $total_qtd; ?></td>
                                   <td class="rotulo">TOTAL R$: <?php echo number_format($total_financeiro, 2, ',', '.'); ?></td>
                    
                  </tr>
                </tfoot>
              </table>



</fieldset>
      
</div>
        
    </body>
</html>
