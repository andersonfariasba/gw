<?php $objDateFormat = $this->DateFormat; ?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>PEDIDO Nº <?php echo $objPedido->getCodigo(); ?></title>
        <link href="<?= base_url(); ?>css/style_report.css" rel="stylesheet">
        <style type="text/css"> 
        body{font-size: 12px;}
        </style>
    </head>
    <body>
       
        <?php $tipo = ($objPedido->getTipo()==ORCAMENTO)?"Cotação":"Pedido";  ?>

        <?php if($this->session->userdata('logo')!=""){ ?>
               
            <table width="100%" class="dadosEmpresa">
              <tr>
                  <td>
                    <img src="<?= base_url(); ?>images/<?php echo $this->session->userdata('logo'); ?>" alt="" width="80px;">
                </td>
                <td>
                    <h2><?php echo $this->session->userdata('filial_nome'); ?></h2>
                    <p>CNPJ: <?php echo $this->session->userdata('filial_documento'); ?></p>
                    <p>Endereço: <?php echo $this->session->userdata('filial_endereco'); ?></p>
                    <p>Bairro: <?php echo $this->session->userdata('filial_bairro'); ?></p>
                </td>
                <td>
                    <p>Estado: <?php echo $this->session->userdata('filial_estado'); ?></p>
                    <p>Cidade: <?php echo $this->session->userdata('filial_cidade'); ?></p>   
                    <p>Email: <?php echo $this->session->userdata('filial_email'); ?></p>
                    <p>Telefone: <?php echo $this->session->userdata('filial_telefone'); ?> / <?php echo $this->session->userdata('filial_celular'); ?> <img src="<?= base_url(); ?>img/Whatsapp.png" alt=""  width="12px;"></p>
                </td>
              </tr>
            </table>            
               
              <?php } ?>

            <hr />      

       
            <h2>Dados <?php echo $tipo; ?></h2>
            <table border="0" cellspacing="8" cellpadding="5" class="bordasimples" width="100%">
              <tr>       
                <?php if($objPedido->getStatus()==FINALIZADO){ ?>
                <td align="left" class="rotulo">Nº <?php echo $tipo; ?>: <?php echo $objPedido->getCodigo(); ?> 
                </td>
                 <?php } ?>
                <td align="right" class="rotulo">Data Pedido: <?php echo $objDateFormat->date_format($objPedido->getData_inicio()); ?> 

                   <!-- Usuário:  <?php echo $objPedido->getUsuario()->getLogin(); ?> -->
                </td>
                <td align="right" class="rotulo">Data Prevista de Entrega: <?php echo $objDateFormat->date_format($objPedido->getData_final()); ?> 
                </td>
              </tr>
            </table>
         
            <table border="0" cellspacing="8" cellpadding="5" class="bordasimples" width="100%">
                <tr>
                  <td align="left" class="rotulo" colspan="4">Nome / Razão Social: <?php echo $objPedido->getCliente()->getNome_fantasia(); ?>  </td>
                  <td class="rotulo">Terceirizado: <?php

                      if($objPedido->getCliente()->getTerceirizado() == SIM) {
                        echo 'SIM';
                      }
                      else{
                        echo 'NÃO';
                      }
                   ?>

                  </td>
                </tr>
                <tr>
                  <td colspan="3" class="rotulo">E-mail: <?php echo $objPedido->getCliente()->getEmail(); ?></td>
                  <td align="center" class="rotulo">Telefone: <?php echo $objPedido->getCliente()->getTelefone1(); ?></td>
                  <td class="rotulo">Celular: <?php echo $objPedido->getCliente()->getCelular(); ?></td>
                  
                </tr>
            </table>

          <hr />
          
          <h2>Itens Pedidos</h2>

          <?php if($objPedido->getEscopo()==PRODUTO){ ?>

          <table border="0" cellspacing="3" cellpadding="8" width="100%" class="bordasimples">
            <thead>
                <tr>
                  <th align="center">CODIGO</th>
                  <th align="center">PRODUTO</th>
                  <th align="center">VALOR UNITÁRIO</th>
                  <th align="center">QTD</th>
                  <th align="center">SUB-TOTAL</th>  
                </tr>
            </thead>

            <tbody>
              <?php 
                $sub_total = 0;
                $total = 0;
                foreach($listItens as $objItem): 
                  $sub_total = $objItem->getValor_unitario() * $objItem->getQtd();
                  $total = $total + $sub_total;
                  ?>
                  <tr>           
                    <td align="center"><?php echo $objItem->getProduto()->getCodigo(); ?></td>
                    <td align="center"><?php echo $objItem->getProduto()->getDescricao(); ?></td>
                    <td align="center"><?php echo number_format($objItem->getValor_unitario(), 2, ',', '.'); ?></td>
                    <td align="center"><?php echo $objItem->getQtd(); ?></td>
                    <td align="center"><?php echo number_format($sub_total, 2, ',', '.'); ?></td>
                  </tr>
              <?php endforeach; ?>
            </tbody>
        </table>
        <?php } ?>

        <?php if($objPedido->getEscopo()==SERVICO){ ?>

        <table border="1" cellspacing="3" cellpadding="8" width="100%" class="bordasimples">
          <thead>
            <tr>
              <th align="left">SERVIÇO</th>
              <th align="left">VALOR UNITÁRIO</th>
              <th align="left">QTD</th>
              <th align="left">SUB-TOTAL</th>      
            </tr>
          </thead>
          <tbody>
             <?php 
                $sub_total = 0;
                $total = 0;
                foreach($listItens as $objItem): 
                $sub_total = $objItem->getValor_unitario() * $objItem->getQtd();
                $total = $total + $sub_total;
              ?>
                <tr>           
                  <td><?php echo $objItem->getDescricao(); ?></td>
                  <td><?php echo number_format($objItem->getValor_unitario(), 2, ',', '.'); ?></td>
                  <td><?php echo $objItem->getQtd(); ?></td>
                  <td><?php echo number_format($sub_total, 2, ',', '.'); ?></td>
                </tr>
        
        
        <?php endforeach; ?>
        
         
        
      </tbody>

    </table>




<?php } ?>
    
<br />
    <?php if($objPedido->getStatus()==FINALIZADO){ ?>
    
    <hr />
    <h2>Financeiro</h2>
    
    <table border="0" cellspacing="3" cellpadding="8" width="100%" class="bordasimples">

    <thead>
      <tr>
        <th align="center">FORMA DE PAGAMENTO</th>
        <th align="center">VALOR TITULO</th>
        <th align="center">PARCELA</th>
        <th align="center">STATUS</th>
        <th align="center">DESCONTO</th>
        <th align="center">TOTAL PAGAR</th>
      </tr>
    </thead>

    <tbody>
      <?php 
      $total_lanc = 0;
      foreach ($listLanc as $objLanc): 
        $total_lanc+=$objLanc->getValor_titulo();   
        ?>

        <tr class="">
          <td align="center"><?php echo $objLanc->getForma()->getForma(); ?></td>
          <td align="center"><?php echo $objLanc->getValor_titulo(); ?></td>
          <td align="center">
          <?php echo $objLanc->getParcela()." / ".$objLanc->getConta()->getParcela_qtd(); ?>
          
          </td>

          <td align="center"><?php echo $objLanc->printStatus(); ?></td>

          <td align="center"><?php echo number_format($objPedido->getDesconto(), 2, ',', '.'); ?></td>
            <?php $total_pagar = ($total + $objPedido->getTaxa_frete()) - $objPedido->getDesconto(); ?>
            <td align="center"><?php echo number_format($total_pagar, 2, ',', '.'); ?></td>
        </tr>

      <?php endforeach;?>

          
    </tbody>




    </table>




    <?php } //final status ?>



<br />       

    <hr>
    <h2>Descrição do Pedido</h2>
    <?php echo $objPedido->getObservacao(); ?>  
    <hr>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <table border="0" cellspacing="3" cellpadding="5" width="100%" class="bordasimples">
      <tr>
        <td><strong>Data Entrega: _______/_______/________</strong></td>
        <td><strong>Finalizado: _______/_______/________</strong></td>
        <td><strong>Entregue Por: ___________________________</strong></td>
      </tr> 
    </table>                   
      <p></p>
     <table border="0" cellspacing="3" cellpadding="8" width="100%" class="bordasimples">
      <tr> 
        <td align="center"> _______________________________________________</td>
        <td align="center"> _______________________________________________</td>
      </tr>
      <tr>
        <td align="center"><strong><?php echo $objPedido->getCliente()->getNome_fantasia(); ?></strong></td>
        <td align="center"><strong>Viu Aí Gráfica e Brindes</strong></td>
      </tr>
    </table>
    <br />
    <p>* Eu autorizo a produção dos itens acima citados e assumo responsabilidade integral pela conferência da arte final, estando ciente de que não poderei abrir reclamações posteriores referentes à erros de designer. </p>
    <p>** Os prazos podem sofrer modificações mediante aviso prévio.</p>
    
    <!-- SEGUNDA PAGINA -->

    <?php $tipo = ($objPedido->getTipo()==ORCAMENTO)?"Cotação":"Pedido";  ?>

        <?php if($this->session->userdata('logo')!=""){ ?>
               
                <table width="100%" class="dadosEmpresa">
                  <tr>
                  <td>
                <img src="<?= base_url(); ?>images/<?php echo $this->session->userdata('logo'); ?>" alt="" width="80px;">
                </td>
                <td>
                   <h2><?php echo $this->session->userdata('filial_nome'); ?></h2>
                   <p>CNPJ: <?php echo $this->session->userdata('filial_documento'); ?></p>
                    <p>Endereço: <?php echo $this->session->userdata('filial_endereco'); ?></p>
                     <p>Bairro: <?php echo $this->session->userdata('filial_bairro'); ?></p>
                     

                </td>
                <td>
                       <p>Estado: <?php echo $this->session->userdata('filial_estado'); ?></p>
                       <p>Cidade: <?php echo $this->session->userdata('filial_cidade'); ?></p>
                       <p>Email: <?php echo $this->session->userdata('filial_email'); ?></p>
                       <p>Telefone: <?php echo $this->session->userdata('filial_telefone'); ?> / <?php echo $this->session->userdata('filial_celular'); ?> <img src="<?= base_url(); ?>img/Whatsapp.png" alt="" width="12px;"> </p> 
                </td>

                </table>            
               
              <?php } ?>

        <hr />      

       
         <h2>Dados <?php echo $tipo; ?></h2>

          <table border="0" cellspacing="8" cellpadding="5" class="bordasimples" width="100%">
              <tr>       
                <?php if($objPedido->getStatus()==FINALIZADO){ ?>
                <td align="left" class="rotulo">Nº <?php echo $tipo; ?>: <?php echo $objPedido->getCodigo(); ?> 
                </td>
                 <?php } ?>
                <td align="right" class="rotulo">Data Pedido: <?php echo $objDateFormat->date_format($objPedido->getData_inicio()); ?> 

                   <!-- Usuário:  <?php echo $objPedido->getUsuario()->getLogin(); ?> -->
                </td>
                <td align="right" class="rotulo">Data Prevista de Entrega: <?php echo $objDateFormat->date_format($objPedido->getData_final()); ?> 
                </td>
              </tr>
            </table>
         
            <table border="0" cellspacing="8" cellpadding="5" class="bordasimples" width="100%">
                <tr>
                  <td align="left" class="rotulo" colspan="4">Nome / Razão Social: <?php echo $objPedido->getCliente()->getNome_fantasia(); ?>  </td>
                  <td class="rotulo">Terceirizado: <?php

                      if($objPedido->getCliente()->getTerceirizado() == SIM) {
                        echo 'SIM';
                      }
                      else{
                        echo 'NÃO';
                      }
                   ?>

                  </td>
                </tr>
                <tr>
                  <td colspan="3" class="rotulo">E-mail: <?php echo $objPedido->getCliente()->getEmail(); ?></td>
                  <td align="center" class="rotulo">Telefone: <?php echo $objPedido->getCliente()->getTelefone1(); ?></td>
                  <td class="rotulo">Celular: <?php echo $objPedido->getCliente()->getCelular(); ?></td>
                  
                </tr>
            </table>

       
         <hr />
         <h2>Itens Pedidos</h2>
         
         

        <?php if($objPedido->getEscopo()==PRODUTO){ ?>

      <table border="0" cellspacing="3" cellpadding="8" width="100%" class="bordasimples">
      <thead>
        <tr>
          <th align="center">CODIGO</th>
          <th align="center">PRODUTO</th>
          <th align="center">VALOR UNITÁRIO</th>
          <th align="center">QTD</th>
          <th align="center">SUB-TOTAL</th>
          
        </tr>
      </thead>

      <tbody>
         <?php 
         $sub_total = 0;
         $total = 0;
         foreach($listItens as $objItem): 
            $sub_total = $objItem->getValor_unitario() * $objItem->getQtd();
            $total = $total + $sub_total;

           ?>
            <tr>           
                <td align="center"><?php echo $objItem->getProduto()->getCodigo(); ?></td>
                <td align="center"><?php echo $objItem->getProduto()->getDescricao(); ?></td>
                <td align="center"><?php echo number_format($objItem->getValor_unitario(), 2, ',', '.'); ?></td>
                <td align="center"><?php echo $objItem->getQtd(); ?></td>
                <td align="center"><?php echo number_format($sub_total, 2, ',', '.'); ?></td>
            </tr>
        
        
        <?php endforeach; ?>
        
         
        
      </tbody>

    </table>

    <?php } ?>

<?php if($objPedido->getEscopo()==SERVICO){ ?>


  <table border="1" cellspacing="3" cellpadding="8" width="100%" class="bordasimples">
      <thead>
        <tr>
          
          <th align="left">SERVIÇO</th>
          <th align="left">VALOR UNITÁRIO</th>
          <th align="left">QTD</th>
          <th align="left">SUB-TOTAL</th>
          
        </tr>
      </thead>

      <tbody>
         <?php 
         $sub_total = 0;
         $total = 0;
         foreach($listItens as $objItem): 
            $sub_total = $objItem->getValor_unitario() * $objItem->getQtd();
            $total = $total + $sub_total;

           ?>
            <tr>           
               
                <td><?php echo $objItem->getDescricao(); ?></td>
                <td><?php echo number_format($objItem->getValor_unitario(), 2, ',', '.'); ?></td>
                <td><?php echo $objItem->getQtd(); ?></td>
                <td><?php echo number_format($sub_total, 2, ',', '.'); ?></td>
                

            </tr>
        
        
        <?php endforeach; ?>
        
         
        
      </tbody>

    </table>




<?php } ?>
    
<br />
    <?php if($objPedido->getStatus()==FINALIZADO){ ?>
    
    <hr />
    <h2>Financeiro</h2>
    
    <table border="0" cellspacing="3" cellpadding="8" width="100%" class="bordasimples">

    <thead>
      <tr>
        <th align="center">FORMA DE PAGAMENTO</th>
        <th align="center">VALOR TITULO</th>
        <th align="center">PARCELA</th>
        <th align="center">STATUS</th>
        <th align="center">DESCONTO</th>
        <th align="center">TOTAL PAGAR</th>
      </tr>
    </thead>

    <tbody>
      <?php 
      $total_lanc = 0;
      foreach ($listLanc as $objLanc): 
        $total_lanc+=$objLanc->getValor_titulo();   
        ?>

        <tr class="">
          <td align="center" style="font-size: 12"><?php echo $objLanc->getForma()->getForma(); ?></td>
          <td align="center " style="font-size: 12"><?php echo $objLanc->getValor_titulo(); ?></td>
          <td align="center" style="font-size: 12">
          <?php echo $objLanc->getParcela()." / ".$objLanc->getConta()->getParcela_qtd(); ?>
          
          </td>

          <td align="center" style="font-size: 12"><?php echo $objLanc->printStatus(); ?></td>

          <td align="center" style="font-size: 12"><?php echo number_format($objPedido->getDesconto(), 2, ',', '.'); ?></td>
            <?php $total_pagar = ($total + $objPedido->getTaxa_frete()) - $objPedido->getDesconto(); ?>
            <td align="center" style="font-size: 12"><?php echo number_format($total_pagar, 2, ',', '.'); ?></td>
        </tr>

      <?php endforeach;?>

          
    </tbody>




    </table>




    <?php } //final status ?>



<br />       

    <hr>
    <h2>Descrição do Pedido</h2>
    <?php echo $objPedido->getObservacao(); ?>  

    <hr>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
     <table border="0" cellspacing="3" cellpadding="8" width="100%" class="bordasimples">
      <tr> 
        <td align="center"> ______________________________________________________________________</td>
      </tr>
      <tr>
        <td align="center" style="font-size: 14"><strong>Viu Aí Gráfica e Brindes</strong></td>
      </tr>
    </table>
    <br />
    <p>* Eu autorizo a produção dos itens acima citados e assumo responsabilidade integral pela conferência da arte final, estando ciente de que não poderei abrir reclamações posteriores referentes à erros de designer. </p>
    <p>** Os prazos podem sofrer modificações mediante aviso prévio.</p>
    



    </body>
</html>
