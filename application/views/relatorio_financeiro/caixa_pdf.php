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


        <h2>Relatório Análise de Caixa</h2>
        <p class="data">Relatório emitido em: <?php echo $objDateFormat->date_format($data_hoje); ?> às <?php echo date('H:m');?></p>
        <?php if($data_de==null || $data_ate==null){
         echo "<p class=data>Filtro Não Especificado.</p>";
        }else { ?>
        
        <p class="data">Período De: <?php echo $data_de; ?> Até <?php echo $data_ate; ?> </p>
        
        <?php } ?>
        
        <div id="miolo_listar" class="filtro">
<fieldset>
       
<h2>(+)Recebimentos</h2>
 <table border="1" cellspacing="8" cellpadding="5" class="bordasimples" width="100%">
     
     <thead>
         <tr>                 
                    <!--<td class="rotulo">DATA</td>-->
                    <td class="rotulo">FORMA DE RECEBIMENTO</td>
                    <td class="rotulo">QTD DE VENDA</td>
                    <td class="rotulo">TOTAL</td>
          
        </tr>
     
     </thead>

      <tbody>
                  <?php 
                  $total = 0;
                  $total_pedido = 0;
                  $total_dinheiro = 0;
                  foreach ($listLanc as $objLanc): 
                   $total = $total + $objLanc['valor'];
                   $total_pedido = $total_pedido + $objLanc['qtd_pedido'];
                   
                   if($objLanc['id_forma']==FORMA_REC_DINHEIRO){
                     $total_dinheiro = $total_dinheiro + $objLanc['valor'];
                   }


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


<!-- ABERTURA DE CAIXA -->

 <h2>(+)Abertura de Caixa</h2>
<table border="1" cellspacing="8" cellpadding="5" class="bordasimples" width="100%">            <thead>
               <tr class="fundoTituloTabela">
                <td class="rotulo">DATA ABERTURA</td>
                 <td class="rotulo">USUÁRIO</td>
                  <td class="rotulo">VALOR INICIAL</td>
               
              </tr>
            </thead>

            <tbody>
               <?php 

               $total_abertura = 0;
               foreach ($listCaixa as $objCaixa): 
                $total_abertura = $total_abertura + $objCaixa->getValor_inicial();

                ?>
                 <tr class="dadosTabela">

                  <td><?php echo $objDateFormat->date_format($objCaixa->getData())." - ".$objCaixa->getHora(); ?></td>
                  <td><?php echo strtoupper($objCaixa->getUsuario()); ?></td>
                  
                  <td>R$: <?php echo number_format($objCaixa->getValor_inicial(), 2, ',', '.'); ?></td>
                 

                </tr>

              <?php endforeach;?>

              
            </tbody>

          </table>


<!-- FINAL ABERTURA DE CAIXA -->


<!-- ABERTURA DE CAIXA -->

 <h2>(+)Reforço de Caixa</h2>
<table border="1" cellspacing="8" cellpadding="5" class="bordasimples" width="100%">            <thead>
               <tr class="fundoTituloTabela">
                <td class="rotulo">DATA</td>
                 <td class="rotulo">USUÁRIO</td>
                  <td class="rotulo">VALOR REFORÇO</td>
                  <td class="rotulo">OBSERVAÇÃO</td>
               
              </tr>
            </thead>

            <tbody>
               <?php 

               $total_reforco = 0;
               foreach ($listReforco as $objCaixa):
               $total_reforco = $total_reforco + $objCaixa->getValor_inicial(); 

                ?>
                 <tr class="dadosTabela">

                  <td><?php echo $objDateFormat->date_format($objCaixa->getData())." - ".$objCaixa->getHora(); ?></td>
                  <td><?php echo strtoupper($objCaixa->getUsuario()); ?></td>
                  
                  <td>R$: <?php echo number_format($objCaixa->getValor_inicial(), 2, ',', '.'); ?></td>
                    <td><?php echo strtoupper($objCaixa->getObservacao()); ?></td>
                 

                </tr>

              <?php endforeach;?>

              
            </tbody>

          </table>


<!-- FINAL ABERTURA DE CAIXA -->



<!-- ABERTURA DE CAIXA -->

 <h2>(-)Retirada de Caixa (Sangria)</h2>
<table border="1" cellspacing="8" cellpadding="5" class="bordasimples" width="100%">            <thead>
               <tr class="fundoTituloTabela">
                <td class="rotulo">DATA RETIRADA</td>
                 <td class="rotulo">USUÁRIO</td>
                  <td class="rotulo">VALOR INICIAL</td>
                  <td class="rotulo">MOTIVO</td>
               
              </tr>
            </thead>

            <tbody>
               <?php 

               $total_sangria = 0;
               foreach ($listSangria as $objCaixa): 
                $total_sangria = $total_sangria + $objCaixa->getValor_retirada();

                ?>
                 <tr class="dadosTabela">

                  <td><?php echo $objDateFormat->date_format($objCaixa->getData())." - ".$objCaixa->getHora(); ?></td>
                  <td><?php echo strtoupper($objCaixa->getUsuario()); ?></td>
                  
                  <td>R$: <?php echo number_format($objCaixa->getValor_retirada(), 2, ',', '.'); ?></td>
                    <td><?php echo strtoupper($objCaixa->getObservacao()); ?></td>
                 

                </tr>

              <?php endforeach;?>

              
            </tbody>

          </table>

         


<!-- FINAL RETIRADA DE CAIXA -->








<?php 

$saldo_caixa = ($total_dinheiro + $total_abertura + $total_reforco) - $total_sangria; 

 ?>
 <h2>TOTAL CAIXA DINHEIRO</h2>
<table border="1" cellspacing="8" cellpadding="5" class="bordasimples" width="100%">            <thead>
               <tr class="fundoTituloTabela">
                
                <td class="rotulo">DINHEIRO(+)</td>
                <td class="rotulo">ABERTURA(+)</td>
                <td class="rotulo">REFORÇO(+)</td>
                <td class="rotulo">RETIRADA(SANGRIA)(-)</td>
                 <td class="rotulo">SALDO CAIXA</td>
                
               
              </tr>
            </thead>

            <tbody>
            <tr>
              <td>R$: <?php echo number_format($total_dinheiro, 2, ',', '.'); ?></td>
              <td>R$: <?php echo number_format($total_abertura, 2, ',', '.'); ?></td>
              <td>R$: <?php echo number_format($total_reforco, 2, ',', '.'); ?></td>
               <td>R$: <?php echo number_format($total_sangria, 2, ',', '.'); ?></td>
                <td><strong>R$: <?php echo number_format($saldo_caixa, 2, ',', '.'); ?></strong></td>

            </tr>
</tbody>
</table>



</fieldset>
      
</div>
        
    </body>
</html>
