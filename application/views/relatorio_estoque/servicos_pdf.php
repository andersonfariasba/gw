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



        <h2>Relatório de Serviços</h2>
        <p class="data">Relatório emitido em: <?php echo $objDateFormat->date_format($data_hoje); ?> às <?php echo date('H:m');?></p>
        
        <div id="miolo_listar" class="filtro">
<fieldset>
       

<table border="1" cellspacing="8" cellpadding="5" class="bordasimples" width="100%">
                <thead>
                  <tr>
                   <td class="rotulo"></td>
                   <td class="rotulo">SERVIÇO</td>
                 <td class="rotulo">CÓDIGO</td>
                 <td class="rotulo">CATEGORIA</td>
                  
                 <td class="rotulo">VALOR VENDA</td>
                  <td class="rotulo">VALOR CUSTO</td>
                
                    
                  </tr>
                </thead>
                <tfoot>
                    <tr>
                   <td class="rotulo"></td>
                   <td class="rotulo">SERVIÇO</td>
                 <td class="rotulo">CÓDIGO</td>
                 <td class="rotulo">CATEGORIA</td>
                 
                 <td class="rotulo">VALOR VENDA</td>
                  <td class="rotulo">VALOR CUSTO</td>
               
                    
                  </tr>
                </tfoot>
                <tbody>
                  <?php 
                  $qtd_estoque = "";
                  $qtd_itens = 0;
                  foreach ($listProdutos as $objProduto): 
                    $qtd_itens++;

              ?>
                  
                <tr>
                    <td><?php echo $qtd_itens; ?></td>
                  <td><?php echo $objProduto->getDescricao(); ?></td>
                  <td><?php echo $objProduto->getCodigo(); ?></td>
                  <td><?php echo $objProduto->getCategoria()->getCategoria(); ?></td>
              
                  <td>R$: <?php echo number_format($objProduto->getValor_venda(), 2, ',', '.'); ?></td>
                   <td>R$: <?php echo number_format($objProduto->getValor_custo(), 2, ',', '.'); ?></td>
                  
                  
                
                    
                  </tr>
                  
                  <?php endforeach;?>
                  
                                  
                </tbody>
              </table>



</fieldset>
      
</div>
        
    </body>
</html>
