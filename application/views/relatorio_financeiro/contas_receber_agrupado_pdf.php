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


        <h2>Relatório Vendas Agrupado por Forma de Recebimento</h2>
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
                    <!--<td class="rotulo">DATA</td>-->
                    <td class="rotulo">FORMA DE RECEBIMENTO</td>
                    <td class="rotulo">QTD DE VENDA</td>
                    <td class="rotulo">VALOR</td>
          
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

               
                  
                 <!-- <td><?php echo $objDateFormat->date_format($objLanc['data_vencimento']); ?></td>-->
                 
                   <td><?php echo $objLanc['forma']; ?></td>
                  <td><?php echo $objLanc['qtd_pedido']; ?></td>
                  <td><?php echo number_format(round($objLanc['valor'],1), 2, ',', '.'); ?></td>
                
                                
                
                  </tr>
                  
                  <?php endforeach;?>
                  
                                  
                </tbody>
   
                <tfoot>
                  <tr>
                  
                    <th colspan="1"></th>
                  
                 
                    
                    <th align="left"><h4><?php echo $total_pedido; ?></h4></th>               
                    <th align="left"><h4>R$ <?php echo number_format(round($total,1), 2, ',', '.'); ?></h4></th>
                  </tr>
                </tfoot>
 
 </table>
</fieldset>
      
</div>
        
    </body>
</html>
