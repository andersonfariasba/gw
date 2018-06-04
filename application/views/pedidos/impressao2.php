<?php $objDateFormat = $this->DateFormat; 
$tipo = ($objPedido->getTipo()==ORCAMENTO)?"Cotação":"Pedido";
?>
 
<html>

<head>

 <link href="<?= base_url(); ?>css/style_print.css" rel="stylesheet">

</head>

<!-- HEADER - TOPO -->


<!-- FINAL TOPO -->



<body>


<!-- CONFIGURAÇÃO DO HEADER -->
<htmlpageheader name="firstpage" style="display:none;">

    <div>
      
       <table width="100%">
              <tr>
                  <td>
                    <img src="<?= base_url(); ?>images/<?php echo $this->session->userdata('logo'); ?>" alt="" width="80px;">
                </td>
                <td>
                    <p class="dadosEmpresa"><strong><?php echo $this->session->userdata('filial_nome'); ?></strong></p>
                    <p class="dadosEmpresa">CNPJ: <?php echo $this->session->userdata('filial_documento'); ?></p>
                    <p class="dadosEmpresa">Endereço: <?php echo $this->session->userdata('filial_endereco'); ?></p>
                    <p class="dadosEmpresa">Bairro: <?php echo $this->session->userdata('filial_bairro'); ?></p>
                </td>
                <td>
                    <p class="dadosEmpresa">Estado: <?php echo $this->session->userdata('filial_estado'); ?></p>
                    <p class="dadosEmpresa">Cidade: <?php echo $this->session->userdata('filial_cidade'); ?></p>   
                    <p class="dadosEmpresa">Email: <?php echo $this->session->userdata('filial_email'); ?></p>
                    <p class="dadosEmpresa">Telefone: <?php echo $this->session->userdata('filial_telefone'); ?> / <?php echo $this->session->userdata('filial_celular'); ?> <img src="<?= base_url(); ?>img/Whatsapp.png" alt=""  width="12px;"></p>
                </td>
              </tr>
            </table>   
            <hr />   

    </div>


</htmlpageheader>



<sethtmlpageheader name="firstpage" value="on" show-this-page="1" />
<sethtmlpageheader name="otherpages" value="on" />


<!-- FINAL HEADER PADRÃO -->

<!--
<htmlpageheader name="otherpages" style="display:none">
    <div style="text-align:center">fafafafafaf</div>
</htmlpageheader>

<sethtmlpageheader name="firstpage" value="on" show-this-page="1" />

<sethtmlpageheader name="otherpages" value="on" />
-->



<div style="margin-top:60px;"><!-- PRIMEIRA PÁGINA -->

<!-- DADOS DO PEDIDO -->
<h2 class="titulos">Dado <?php echo $tipo." ";
echo ($objPedido->getObjStatus()!=null)? "(".$objPedido->getObjStatus()->getStatus().")":"";

?>
  
 
</h2>
  
            <table border="0" cellspacing="2" cellpadding="2" class="textoDadosPedido" width="100%">
              <tr>       
               
                <td align="left" class="rotulo">
                 <?php if($objPedido->getFaturado()==SIM){ ?>
                <strong>Nº:<?php echo $objPedido->getCodigo(); ?></strong> 
                <?php } else{
                      echo "<strong>Cotação</strong>";
                  }  ?>
                
                </td>
                 
                

                <td align="right" class="rotulo">Data Pedido: <?php echo $objDateFormat->date_format($objPedido->getData_inicio()); ?> 

                   <!-- Usuário:  <?php echo $objPedido->getUsuario()->getLogin(); ?> -->
                </td>
                <td align="right" class="rotulo">Data Prevista de Entrega: <?php echo $objDateFormat->date_format($objPedido->getData_final()); ?> 
                </td>
              </tr>
            </table>
         
            <table border="0" cellspacing="2" cellpadding="2" class="textoDadosPedido" width="100%">
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
<!-- FINAL DADOS DO PEDIDO

<!-- ITENS DO PEDIDO -->

 <h2 class="titulos">Itens Pedidos</h2>
<table border="0" cellspacing="1" cellpadding="3" width="100%">
            <thead>
                <tr>
                  <td class="tabelaTitulos"><strong>CODIGO</strong></td>
                  <td class="tabelaTitulos"><strong>PRODUTO</strong></td>
                  <td class="tabelaTitulos"><strong>VALOR UNITÁRIO</strong></td>
                  <td class="tabelaTitulos"><strong>QTD</strong></td>
                  <td class="tabelaTitulos"><strong>SUB-TOTAL</strong></td>  
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
                    <td class="tabelaItens"><?php echo $objItem->getProduto()->getCodigo(); ?></td>
                    <td class="tabelaItens"><?php echo $objItem->getProduto()->getDescricao(); ?></td>
                    <td class="tabelaItens"><?php echo number_format($objItem->getValor_unitario(), 2, ',', '.'); ?></td>
                    <td class="tabelaItens"><?php echo $objItem->getQtd(); ?></td>
                    <td class="tabelaItens">R$: <?php echo number_format($sub_total, 2, ',', '.'); ?></td>
                  </tr>
              <?php endforeach; ?>
            </tbody>
        </table>

<!-- FINAL ITENS DO PEDIDO -->
<hr />
<!-- TOTAL PAGAR DO PEDIDO -->

<table border="0" cellspacing="1" cellpadding="2" width="100%">
            <thead>
                <tr>
                 <!-- <td class="tabelaTitulos"><strong>PERCENTUAL DESCONTO(%)</strong></td>-->
                  <td class="tabelaTitulos"><strong>(-)VALOR DESCONTO(R$)</strong></td>
                  <td class="tabelaTitulos"><strong>(+)ACRÉSCIMO(R$)</strong></td>
                  <td class="tabelaTitulos"><strong>TOTAL PEDIDO(R$)</strong></td>
                  <td class="tabelaTitulos"><strong>TOTAL(R$)</strong></td>
                </tr>
            </thead>

            <tbody>
                <tr>
                <!--<td class="tabelaTitulos"><?php echo number_format($objPedido->getDesconto_perc(), 2, ',', '.'); ?></td>-->
                <td class="tabelaTitulos"><?php echo number_format($objPedido->getDesconto(), 2, ',', '.'); ?></td>
                <td class="tabelaTitulos"><?php echo number_format($objPedido->getTaxa_frete(), 2, ',', '.'); ?></td>
                 <td class="tabelaTitulos"><strong>R$: 

                 
                 <?php 
                    if($objPedido->getFaturado()==SIM){
                      echo number_format($objPedido->getValor_total(), 2, ',', '.'); 
                    }
                    else{
                      echo number_format($total, 2, ',', '.'); 
                    }
                 ?>
                 </strong></td>

                 <td class="tabelaTitulos"><strong>R$: <?php echo number_format($objPedido->getValor_total() - $objPedido->getDesconto(), 2, ',', '.'); ?>  </strong></td>
                
                </tr>
            </tbody>
  </table>

<!-- FINAL TOTAL PEDIDO ->



<!-- INICO FINANCEIRO -->

<?php if($objPedido->getFaturado()==SIM){ ?>
    
    <hr />
    <h2 class="titulos">Financeiro</h2>
    
    <table border="0" cellspacing="1" cellpadding="3" width="100%">

    <thead>
      <tr>
        <td class="tabelaTitulos"><strong>FORMA DE PAGAMENTO</strong></td>
        <td class="tabelaTitulos"><strong>VALOR TITULO</strong></td>
        <td class="tabelaTitulos"><strong>PARCELA</strong></td>
        <td class="tabelaTitulos"><strong>STATUS</strong></td>
        
      </tr>
    </thead>

    <tbody>
      <?php 
      $total_lanc = 0;
      foreach ($listLanc as $objLanc): 
        $total_lanc+=$objLanc->getValor_titulo();   
        ?>

        <tr class="">
          <td class="tabelaItens"><?php echo $objLanc->getForma()->getForma(); ?></td>
          <td class="tabelaItens"><?php echo $objLanc->getValor_titulo(); ?></td>
          <td class="tabelaItens">
          <?php echo $objLanc->getParcela()." / ".$objLanc->getConta()->getParcela_qtd(); ?>
          
          </td>

          <td class="tabelaItens"><?php echo $objLanc->printStatus(); ?></td>

          
        </tr>

      <?php endforeach;?>

          
    </tbody>




    </table>




    <?php } //final if faturamento ?>



<!-- FINAL FINANCEIRO -->

<!-- OBSERVAÇÃO DO PEDIDO -->

<hr />
    <h2 class="titulos">Descrição do Pedido</h2>
    <?php echo $objPedido->getObservacao(); ?>  
<hr />

<table border="0" cellspacing="1" cellpadding="3" width="100%" class="bordasimples">
      <tr>
        <td class="dadosEntrega"><strong>Data Entrega: _______/_______/________</strong></td>
        <td class="dadosEntrega"><strong>Finalizado: _______/_______/________</strong></td>
        <td class="dadosEntrega"><strong>Entregue Por: ___________________________</strong></td>
      </tr> 
    </table>                   
      <p></p>
     <table border="0" cellspacing="1" cellpadding="3" width="100%" class="bordasimples">
      <tr> 
        <td class="dadosEntrega" align="center"> _______________________________________________</td>
        <td class="dadosEntrega" align="center"> _______________________________________________</td>
      </tr>
      <tr>
        <td class="dadosEntrega" align="center"><strong><?php echo $objPedido->getCliente()->getNome_fantasia(); ?></strong></td>
        <td class="dadosEntrega" align="center"><strong><!--Viu Aí Gráfica e Brindes--><?php echo $this->session->userdata('filial_nome'); ?></strong></td>
      </tr>
    </table>
    <br />
    <p class="obsPedido">* Eu autorizo a produção dos itens acima citados e assumo responsabilidade integral pela conferência da arte final, estando ciente de que não poderei abrir reclamações posteriores referentes à erros de designer. </p>
    <p class="obsPedido">** Os prazos podem sofrer modificações mediante aviso prévio.</p>

    <?php if($objPedido->getTipo()==ORCAMENTO){ ?>
      <p style="font-size:12px;font-family:sans-serif;"><strong>*** COTAÇÃO VÁLIDA POR 30 DIAS.</strong></p>
    <?php } ?>

</div><!-- FINAL PRIMEIRA PÁGINA -->






<!-- INICIO SEGUNDA PÁGINA -->
<div class="chapter2">

<table width="100%">
              <tr>
                  <td>
                    <img src="<?= base_url(); ?>images/<?php echo $this->session->userdata('logo'); ?>" alt="" width="80px;">
                </td>
                <td>
                    <p class="dadosEmpresa"><strong><?php echo $this->session->userdata('filial_nome'); ?></strong></p>
                    <p class="dadosEmpresa">CNPJ: <?php echo $this->session->userdata('filial_documento'); ?></p>
                    <p class="dadosEmpresa">Endereço: <?php echo $this->session->userdata('filial_endereco'); ?></p>
                    <p class="dadosEmpresa">Bairro: <?php echo $this->session->userdata('filial_bairro'); ?></p>
                </td>
                <td>
                    <p class="dadosEmpresa">Estado: <?php echo $this->session->userdata('filial_estado'); ?></p>
                    <p class="dadosEmpresa">Cidade: <?php echo $this->session->userdata('filial_cidade'); ?></p>   
                    <p class="dadosEmpresa">Email: <?php echo $this->session->userdata('filial_email'); ?></p>
                    <p class="dadosEmpresa">Telefone: <?php echo $this->session->userdata('filial_telefone'); ?> / <?php echo $this->session->userdata('filial_celular'); ?> <img src="<?= base_url(); ?>img/Whatsapp.png" alt=""  width="12px;"></p>
                </td>
              </tr>
            </table>   
            <hr />   



 
  <!-- DADOS DO PEDIDO -->
<h2 class="titulos">Dado <?php echo $tipo." ";
echo ($objPedido->getObjStatus()!=null)? "(".$objPedido->getObjStatus()->getStatus().")":"";

?>
  
 
</h2>
  
            <table border="0" cellspacing="2" cellpadding="2" class="textoDadosPedido" width="100%">
              <tr>       
               
                <td align="left" class="rotulo">
                 <?php if($objPedido->getFaturado()==SIM){ ?>
                <strong>Nº:<?php echo $objPedido->getCodigo(); ?></strong> 
                <?php } else{
                      echo "<strong>Cotação</strong>";
                  }  ?>
                
                </td>
                 
                

                <td align="right" class="rotulo">Data Pedido: <?php echo $objDateFormat->date_format($objPedido->getData_inicio()); ?> 

                   <!-- Usuário:  <?php echo $objPedido->getUsuario()->getLogin(); ?> -->
                </td>
                <td align="right" class="rotulo">Data Prevista de Entrega: <?php echo $objDateFormat->date_format($objPedido->getData_final()); ?> 
                </td>
              </tr>
            </table>
         
            <table border="0" cellspacing="2" cellpadding="2" class="textoDadosPedido" width="100%">
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
<!-- FINAL DADOS DO PEDIDO

<!-- ITENS DO PEDIDO -->

 <h2 class="titulos">Itens Pedidos</h2>
<table border="0" cellspacing="1" cellpadding="3" width="100%">
            <thead>
                <tr>
                  <td class="tabelaTitulos"><strong>CODIGO</strong></td>
                  <td class="tabelaTitulos"><strong>PRODUTO</strong></td>
                  <td class="tabelaTitulos"><strong>VALOR UNITÁRIO</strong></td>
                  <td class="tabelaTitulos"><strong>QTD</strong></td>
                  <td class="tabelaTitulos"><strong>SUB-TOTAL</strong></td>  
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
                    <td class="tabelaItens"><?php echo $objItem->getProduto()->getCodigo(); ?></td>
                    <td class="tabelaItens"><?php echo $objItem->getProduto()->getDescricao(); ?></td>
                    <td class="tabelaItens"><?php echo number_format($objItem->getValor_unitario(), 2, ',', '.'); ?></td>
                    <td class="tabelaItens"><?php echo $objItem->getQtd(); ?></td>
                    <td class="tabelaItens">R$: <?php echo number_format($sub_total, 2, ',', '.'); ?></td>
                  </tr>
              <?php endforeach; ?>
            </tbody>
        </table>

<!-- FINAL ITENS DO PEDIDO -->
<hr />
<!-- TOTAL PAGAR DO PEDIDO -->

<table border="0" cellspacing="1" cellpadding="2" width="100%">
            <thead>
                <tr>
                  <!--<td class="tabelaTitulos"><strong>PERCENTUAL DESCONTO(%)</strong></td>-->
                  <td class="tabelaTitulos"><strong>(-)VALOR DESCONTO(R$)</strong></td>
                  <td class="tabelaTitulos"><strong>(+)ACRÉSCIMO(R$)</strong></td>
                  <td class="tabelaTitulos"><strong>TOTAL PEDIDO(R$)</strong></td>
                  <td class="tabelaTitulos"><strong>TOTAL(R$)</strong></td>
                </tr>
            </thead>

            <tbody>
                <tr>
               <!-- <td class="tabelaTitulos"><?php echo number_format($objPedido->getDesconto_perc(), 2, ',', '.'); ?></td>-->
                <td class="tabelaTitulos"><?php echo number_format($objPedido->getDesconto(), 2, ',', '.'); ?></td>
                <td class="tabelaTitulos"><?php echo number_format($objPedido->getTaxa_frete(), 2, ',', '.'); ?></td>
                 <td class="tabelaTitulos"><strong>R$: 
                 <?php 
                    if($objPedido->getFaturado()==SIM){
                      echo number_format($objPedido->getValor_total(), 2, ',', '.'); 
                    }
                    else{
                      echo number_format($total, 2, ',', '.'); 
                    }
                 ?>                  
                 </strong></td>

                 <td class="tabelaTitulos"><strong>R$: <?php echo number_format($objPedido->getValor_total() - $objPedido->getDesconto(), 2, ',', '.'); ?>  </strong></td>
                </tr>
            </tbody>
  </table>

<!-- FINAL TOTAL PEDIDO ->



<!-- INICO FINANCEIRO -->

<?php if($objPedido->getFaturado()==SIM){ ?>
    
    <hr />
    <h2 class="titulos">Financeiro</h2>
    
    <table border="0" cellspacing="1" cellpadding="3" width="100%">

    <thead>
      <tr>
        <td class="tabelaTitulos"><strong>FORMA DE PAGAMENTO</strong></td>
        <td class="tabelaTitulos"><strong>VALOR TITULO</strong></td>
        <td class="tabelaTitulos"><strong>PARCELA</strong></td>
        <td class="tabelaTitulos"><strong>STATUS</strong></td>
       
      </tr>
    </thead>

    <tbody>
      <?php 
      $total_lanc = 0;
      foreach ($listLanc as $objLanc): 
        $total_lanc+=$objLanc->getValor_titulo();   
        ?>

        <tr class="">
          <td class="tabelaItens"><?php echo $objLanc->getForma()->getForma(); ?></td>
          <td class="tabelaItens"><?php echo $objLanc->getValor_titulo(); ?></td>
          <td class="tabelaItens">
          <?php echo $objLanc->getParcela()." / ".$objLanc->getConta()->getParcela_qtd(); ?>
          
          </td>

          <td class="tabelaItens"><?php echo $objLanc->printStatus(); ?></td>

          
        </tr>

      <?php endforeach;?>

          
    </tbody>




    </table>




    <?php } //final if faturamento ?>



<!-- FINAL FINANCEIRO -->

<!-- OBSERVAÇÃO DO PEDIDO -->

<hr />
    <h2 class="titulos">Descrição do Pedido</h2>
    <?php echo $objPedido->getObservacao(); ?>  
<hr />

<br />
<br />

 <table border="0" cellspacing="1" cellpadding="1" width="100%" class="dadosEntrega">
      <tr> 
        <td align="center"> ______________________________________________________________________</td>
      </tr>
      <tr>
        <td align="center"><strong><!--Viu Aí Gráfica e Brindes-->
          
          <?php echo $this->session->userdata('filial_nome'); ?>
        </strong></td>
      </tr>
    </table>

    <br />
    <p class="obsPedido">* Eu autorizo a produção dos itens acima citados e assumo responsabilidade integral pela conferência da arte final, estando ciente de que não poderei abrir reclamações posteriores referentes à erros de designer. </p>
    <p class="obsPedido">** Os prazos podem sofrer modificações mediante aviso prévio.</p>

      <?php if($objPedido->getTipo()==ORCAMENTO){ ?>
      <p style="font-size:12px;font-family: sans-serif;"><strong>*** COTAÇÃO VÁLIDA POR 30 DIAS.</strong></p>
    <?php } ?>


</div>
<!-- FINAL SEGUNDA PAGINA -->



</body></html>
