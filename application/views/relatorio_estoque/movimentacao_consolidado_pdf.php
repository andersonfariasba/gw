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


    
        <h2>Relatório Movimentação de Estoque</h2>
        <p class="data">Relatório emitido em: <?php echo $objDateFormat->date_format($data_hoje); ?> às <?php echo date('H:m');?></p>

        <?php if($data_de==null || $data_ate==null){
         echo "<p class=data>Filtro Não Especificado.</p>";
        }else { ?>
        
        <p class="data">Período De: <?php echo $data_de; ?> Até <?php echo $data_ate; ?> </p>
        
        <?php } ?>
        
        
        <div id="miolo_listar" class="filtro">
<fieldset>
       

<table border="1" cellspacing="8" cellpadding="5" class="bordasimples" width="100%">
                <thead>
                  <tr>
                  <td class="rotulo"></td>
                  <td class="rotulo">PRODUTO</td>
                 <td class="rotulo">CÓDIGO</td>
                 <td class="rotulo">CATEGORIA</td>
                  <td class="rotulo">FORNECEDOR</td>
                  <td class="rotulo">QTD ENTRADA</td>
                  <td class="rotulo">QTD SAIDA</td>
                   <td class="rotulo">DISPONÍVEL</td>
                    
                  </tr>
                </thead>
                <tfoot>
                    <tr>
                  <td class="rotulo"></td>
                  <td class="rotulo">PRODUTO</td>
                 <td class="rotulo">CÓDIGO</td>
                 <td class="rotulo">CATEGORIA</td>
                  <td class="rotulo">FORNECEDOR</td>
                  <td class="rotulo">QTD ENTRADA</td>
                  <td class="rotulo">QTD SAIDA</td>
                    <td class="rotulo">DISPONÍVEL</td>
                  
                    
                  </tr>
                </tfoot>
                
                <tbody>
                  <?php 
                  $qtd_estoque = 0;
                  $qtd_itens = 0;
                  $sub_total = 0;
                  $total_geral = 0;
                  $entrada = 0;
                  $saida = 0;
                  foreach ($listProdutos as $objProduto): 
                    $qtd_itens++;
                    $sub_total = $objProduto['valor_unitario'] * $objProduto['Saida'];
                    $total_geral = $total_geral + $sub_total;

                    $entrada = $objProduto["Entrada"];
                    $saida = $objProduto["Saida"];
                   
                    $qtd_estoque = $entrada - $saida;

                  
                                  


                  ?>
                  
                 <tr class="">

                  <td><?php echo $qtd_itens; ?></td>
                  <td><?php echo $objProduto['produto']; ?></td>
                  <td><?php echo $objProduto['codigo']; ?></td>
                  <td><?php echo $objProduto['categoria']; ?></td>
                  <td><?php echo $objProduto['fornecedor']; ?></td>
                  <td><?php echo number_format($objProduto['Entrada'], 2, ',', '.'); ?></td>
                  <td><?php echo number_format($objProduto['Saida'], 2, ',', '.'); ?></td>
                   <td><?php echo number_format($qtd_estoque, 2, ',', '.'); ?></td>
                 
                                    
                
                    
                  </tr>
                  
                  <?php endforeach;?>
                  
                                  
                </tbody>
               
              </table>



</fieldset>
      
</div>
        
    </body>
</html>
