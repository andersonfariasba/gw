<style type="text/css">
  .saida{
    color:red;
    font-weight:bold;
}
.entrada{
    color:green;
    font-weight:bold;
}
</style>
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
         <link href="<?= base_url(); ?>css/style_print.css" rel="stylesheet">

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
        <p class="dadosEmpresa">Relatório emitido em: <?php echo $objDateFormat->date_format($data_hoje); ?></p>
        
        <div id="miolo_listar" class="filtro">
<fieldset>
       

    <table cellpadding="2" cellspacing="5" border="0" width="100%" class="dadosEmpresa">
                <thead>
                  <tr>
                  <th align="left" class="fundoTh"></th>
                  <th align="left" class="fundoTh">DATA</th>
                  <th align="left" class="fundoTh">PRODUTO</th>
                  <th align="left" class="fundoTh">CÓDIGO</th>
                  <th align="center" class="fundoTh">MOVIMENTAÇÃO</th>
                  <th align="left" class="fundoTh">QTD</th>
                   <th align="left" class="fundoTh">RESPONSÁVEL</th>
                    <th align="left" class="fundoTh">OBSERVAÇÃO</th>

                 
                   <!--<th align="left" class="fundoTh">VL CUSTO</th>
                   <th align="left" class="fundoTh">LUCRO</th>-->
                 
               
                 
                  </tr>
                </thead>
                <tfoot>
                    <tr>
                   <th align="left" class="fundoTh"></th>
                  <th align="left" class="fundoTh">DATA</th>
                  <th align="left" class="fundoTh">PRODUTO</th>
                  <th align="left" class="fundoTh">CÓDIGO</th>
                  <th align="center" class="fundoTh">MOVIMENTAÇÃO</th>
                  <th align="left" class="fundoTh">QTD</th>
                    <th align="left" class="fundoTh">RESPONSÁVEL</th>
                      <th align="left" class="fundoTh">OBSERVAÇÃO</th>
                 
                   <!--  <th align="left" class="fundoTh">VL CUSTO</th>
                    <th align="left" class="fundoTh">LUCRO</th>-->
                 
                 
                  </tr>
                </tfoot>
                <tbody>
                  <?php 
                    $qtd_itens = 0;
                    $sub_total_venda = 0;
                    $sub_total_custo = 1;
                    $sub_lucro = 0;
                    $total_saida = 0;
                    $total_entrada = 0;
                    $total_valor_venda = 0;
                    $total_valor_entrada = 0;
                    $qtd_mov = 0;
                  foreach ($listMov as $objMov):
                   //$sub_total_venda = $objMov->getValor_unitario() * $objMov->getQtd_mov();
                   //$sub_total_custo = $objMov->getProduto()->getValor_custo() * $objMov->getQtd_mov();
                   //$sub_lucro = $sub_total_venda - $sub_total_custo;

                    $qtd_itens++;
                  ?>
                  <tr>
                  <td><?php echo $qtd_itens; ?></td>
                  <td><?php echo $objDateFormat->date_format($objMov->getData()); ?></td>
                  <td><?php echo $objMov->getProduto()->getDescricao(); ?></td>
                  <td><?php echo $objMov->getProduto()->getCodigo();?></td>
                 
                  <td align="center">
                 
                   <?php 
                  
                  if($objMov->getTipo_movimentacao()==REMOVER_MOV){
                     echo '<span class=saida>';
                        echo $objMov->printMovimentacao();
                     echo '<span/> ';
                     echo $objMov->getDescricao();
                     $total_saida = $total_saida + $objMov->getQtd_mov_saida();
                     $sub_total_venda = $objMov->getValor_unitario() * $objMov->getQtd_mov_saida();
                     $total_valor_venda = $total_valor_venda + $sub_total_venda ;
                     $qtd_mov = $objMov->getQtd_mov_saida();

                  }
                  else{
                     echo '<span class=entrada>';
                        echo $objMov->printMovimentacao();
                     echo '<span/>';
                     $total_entrada = $total_entrada + $objMov->getQtd_mov();
                     $sub_total_custo = $objMov->getValor_unitario() * $objMov->getQtd_mov();
                     $total_valor_entrada = $total_valor_entrada + $sub_total_custo;
                      $qtd_mov = $objMov->getQtd_mov();

                  }



                  ?>
                    
                
                 

                  </td>
                 
                  <td>

                  <?php 

                  //echo $objMov->getQtd_mov();
                   echo round( $qtd_mov,0);
                  
                  ?>
                    

                  </td>
                  <td><?php echo strtoupper($objMov->getResponsavel()); ?></td>
                                    
                                   
                  <!-- <td><?php echo $objMov->getProduto()->getValor_custo();?></td>
                   <td><?php echo number_format($sub_lucro, 2, ',', '.'); ?></td>-->
                 
                 <td><?php echo strtoupper($objMov->getDescricao()); ?></td>
                    
                  </tr>
                  
                  <?php endforeach;?>
                  
                                  
                </tbody>
              </table>


             


</fieldset>
      
 <table cellpadding="2" cellspacing="5" border="0" width="100%" class="dadosEmpresa">
                <thead>
                  <tr>
                  <td align="left" class="saida"><strong>TOTAL SAIDA: <?php echo $total_saida; ?></strong></td>
                  </tr>
                <tr>
                  <td align="left" class="entrada"><strong>TOTAL ENTRADA: <?php echo $total_entrada; ?>
                 
                    
                  </strong> </td>
                </tr>
               

                </thead>
              </table>


</div>
        
    </body>
</html>
