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



        <h2>Relatório de Contas Pagar</h2>
        <p class="data">Relatório emitido em: <?php echo $objDateFormat->date_format($data_hoje); ?> às <?php echo date('H:m');?></p>
        
        <div id="miolo_listar" class="filtro">
<fieldset>
       

 <table border="1" cellspacing="8" cellpadding="5" class="bordasimples" width="100%">
     <thead>
         <tr>
            <td></td>                 
            <td class="rotulo">DATA VENCIMENTO</td>
            <td class="rotulo">NATUREZA</td>
             <td class="rotulo">HISTORICO</td>
            <td class="rotulo">FORNECEDOR</td>
            <td class="rotulo">PARCELA</td>
           
           <td class="rotulo">STATUS</td>
             <td class="rotulo">VALOR TITULO</td>
          
        </tr>
     
     </thead>

     <tbody>
                  <?php 
                  $total = 0;
                  $contador = 0;
                  foreach ($listLanc as $objLanc): 
                   $total+=$objLanc->getValor_titulo(); 
                   $contador++;  
                   ?>
                  
                  <?php if( ($objLanc->getData_vencimento() < date('Y-m-d')) and $objLanc->getStatus()==ABERTO ) { ?>
                   <tr class="aberto">
                  <?php } else{ ?>
                  <tr class="">

                  <?php } ?>
                  <td><?php echo $contador; ?></td>
                  <td><?php echo $objDateFormat->date_format($objLanc->getData_vencimento()); ?></td>
                  
                  <td>
                    <?php 
                          if($objLanc->getConta()->getPlano()!=null){
                            echo $objLanc->getConta()->getPlano()->getNome(); 
                          }
                  ?>  
                  </td>

                   <td>
                    <?php 
                      echo $objLanc->getDescricao(); 
                    
                    ?>
                  </td>
                  
                  
                  <td>
                            <?php
                              if($objLanc->getConta()->getFornecedor()!=null){
                                echo $objLanc->getConta()->getFornecedor()->getNome_fantasia(); 
                              }
                              ?></td>

                  
                 
                  <td><?php echo $objLanc->getParcela()." / ".$objLanc->getConta()->getParcela_qtd(); ?></td>

                 
                  
                  <td><?php echo $objLanc->printStatus(); ?></td>
                   <td>R$ <?php echo number_format($objLanc->getValor_titulo(), 2, ',', '.'); ?></td>
                  
             
                    
                  </tr>
                  
                  <?php endforeach;?>
                  
                                  
                </tbody>
     
   
                <tfoot>
                  <tr>
                  
                    <th colspan="7"></th>
                  
                 
                    
                                   
                    <th align="left"><h4>TOTAL: R$ <?php echo number_format($total, 2, ',', '.'); ?></h4></th>
                  </tr>
                </tfoot>
 
 </table>
</fieldset>
      
</div>
        
    </body>
</html>
