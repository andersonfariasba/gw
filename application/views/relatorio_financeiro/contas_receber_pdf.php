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



        <h2>Relatório de Recebimentos</h2>
        <p class="data">Relatório emitido em: <?php echo $objDateFormat->date_format($data_hoje); ?> às <?php echo date('H:m');?></p>
        
        <div id="miolo_listar" class="filtro">
<fieldset>
       

  <table border="1" cellspacing="8" cellpadding="5" class="bordasimples" width="100%">

     <thead>
         <tr>                 
                    <td class="rotulo">DATA VENCIMENTO</td>
                    <td class="rotulo">CLIENTE</td>
                    <td class="rotulo">RECEBIMENTO</td>
                
                    <td class="rotulo">PARCELA</td>
                    <td class="rotulo">FORMA PAGAMENTO</td>
                    <td class="rotulo">STATUS</td>
                    <td class="rotulo">VALOR TITULO</td>
          
        </tr>
     
     </thead>

      <tbody>
                  <?php 
                  $total = 0;
                  foreach ($listLanc as $objLanc): 
                   $total+=$objLanc->getValor_titulo();   
                   ?>
                  
                  <?php //if( ($objLanc->getData_vencimento() < date('Y-m-d')) and $objLanc->getStatus()==ABERTO ) { ?>
                   <!--<tr class="aberto">-->
                  <?php //} else{ ?>
                  <tr class="">

                  <?php //} ?>
                  
                  <td><?php echo $objDateFormat->date_format($objLanc->getData_vencimento()); ?></td>
                  <td>
                    <?php 
                       if($objLanc->getConta()->getTipo()==CONTAS_RECEBER){ 
                         //echo "venda";
                         echo $objLanc->getConta()->getPedido()->getCliente()->getNome_fantasia(); 
                       } else{
                         echo $objLanc->getConta()->getCliente()->getNome_fantasia();
                         //echo "manual";
                       }
                       ?>  
                  </td>
                  
                  <td>

                  <?php
                    if($objLanc->getConta()->getTipo()==CONTAS_RECEBER){ 
                   echo "Venda Nº ".$objLanc->getConta()->getPedido()->getCodigo(); 
                     } else{

                      echo $objLanc->getDescricao();

                     }

                     ?>

                   </td>
                  

                  <td>
                  <?php echo $objLanc->getParcela()." / ".$objLanc->getConta()->getParcela_qtd(); ?>
                 
                  </td>
                  <td><?php 
                  if($objLanc->getForma()!=null){
                    echo $objLanc->getForma()->getForma(); 
                   }

                  ?>

                  </td>
                  <td><?php echo $objLanc->printStatus(); ?></td>
                  
                  <td>R$: <?php echo number_format($objLanc->getValor_titulo(), 2, ',', '.'); ?></td>
                  
                  
                  
                  
                
                  </tr>
                  
                  <?php endforeach;?>
                  
                                  
                </tbody>
   
                <tfoot>
                  <tr>
                  
                    <th colspan="6"></th>
                  
                 
                    
                                   
                    <th align="left"><h4>TOTAL: <?php echo number_format($total, 2, ',', '.'); ?></h4></th>
                  </tr>
                </tfoot>
 
 </table>
</fieldset>
      
</div>
        
    </body>
</html>
