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


        <h2>Relatório de Vendas Resumido</h2>
        <p class="data">Relatório emitido em: <?php echo $objDateFormat->date_format($data_hoje); ?> às <?php echo date('H:m');?></p>
        
        <div id="miolo_listar" class="filtro">
<fieldset>
       

 <!--<table class="dataTable">-->
      <table border="1" cellspacing="8" cellpadding="5" class="bordasimples" width="100%">
   
     <thead>
         <tr>                 
                    <td class="rotulo">DATA</td>
                    <td class="rotulo">QUANTIDADE DE PEDIDOS</td>
                    <td class="rotulo">VALOR TOTAL</td>
                  
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
