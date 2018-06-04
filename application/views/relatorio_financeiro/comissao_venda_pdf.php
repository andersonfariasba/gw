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
        <h2>Relatório Comissão de Vendas</h2>
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
                    <td class="rotulo">DATA</td>
                    <td class="rotulo">CÓDIGO DA VENDA</td>
                    <td class="rotulo">LOGIN</td>
                    <td class="rotulo">COLABORADOR</td>
                    
                    <td class="rotulo">PERCENTUAL(%)</td>
                    <td class="rotulo">VALOR VENDA</td>
                    <td class="rotulo">RECEBER</td>



          
        </tr>
     
     </thead>

      <tbody>
                  <?php 
                  $total_comissao = 0;
                  $total_venda = 0;
                  $cont = 0;
                  
                  foreach ($listLanc as $objLanc): 
                   $total_venda = $total_venda + $objLanc['valor_venda'];
                   $total_comissao = $total_comissao + $objLanc['receber'];      
                   $cont++;
                   ?>
                   <tr class="">

               
                 <td><?php echo $cont; ?></td> 
                 <td><?php echo $objDateFormat->date_format($objLanc['data']); ?></td>
                 
                   <td><?php echo $objLanc['codigo']; ?></td>
                  <td><?php echo $objLanc['login']; ?></td>
                  <td><?php echo $objLanc['nome']; ?></td>
                  <td><?php echo number_format($objLanc['percentual'], 2, ',', '.'); ?></td>
                  <td><?php echo number_format($objLanc['valor_venda'], 2, ',', '.'); ?></td>
                                    <td><?php echo number_format($objLanc['receber'], 2, ',', '.'); ?></td>
                
                                
                
                  </tr>
                  
                  <?php endforeach;?>
                  
                                  
                </tbody>
   
                <tfoot>
                  <tr>
                  
                    <th></th>
                    <th></th>
                     <th></th>
                      <th></th>
                       <th></th>
                        <th></th>
                          <th align='left'><?php echo number_format($total_venda, 2, ',', '.'); ?></th>
                          <th align='left'><?php echo number_format($total_comissao, 2, ',', '.'); ?></th>
                  
                 
                    
                        
                
                  </tr>
                </tfoot>
 
 </table>

<hr />
 <table border="1" cellspacing="8" cellpadding="5" class="bordasimples" width="100%">

<tr>

<td width="150px">Data Pagamento</td>
<td>Autorizado por</td>
<td>Assinatura do Colaborador</td>
</tr>

<tr>

<td>____/_____/_____</td>
<td></td>
<td></td>
</tr>



</table>


</fieldset>


</div>
        
    </body>
</html>
