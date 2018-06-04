<?php $objDateFormat = $this->DateFormat; ?> 
<html>

<head>
<title><?php echo $objSolicitacao->getId_pedido(); ?> - PC</title>

 <link href="<?= base_url(); ?>css/style_print.css" rel="stylesheet">

<style type="text/css">
    table.bordasimples{ 
 border-collapse: collapse;

}

table.bordasimples tr td th {
  border:1px solid #666666;font-size:11px;font-family:verdana;

}

</style>
</head>

<!-- HEADER - TOPO -->


<!-- FINAL TOPO -->



<body>


<!-- CONFIGURAÇÃO DO HEADER -->
<htmlpageheader name="firstpage" style="display:none;">

    <div>
      
       <table width="100%" border="1" class="bordasimples">
              <tr>
                  <td width="200px">
                    <img src="<?= base_url(); ?>images/<?php echo $this->session->userdata('logo'); ?>" alt="" width="120px;">
                </td>
                <td width="400px">
                    <p class="dadosEmpresa"><strong><?php echo $this->session->userdata('filial_nome'); ?></strong></p>
                   
                    <p class="dadosEmpresa"> 
                    <?php echo $this->session->userdata('filial_endereco')." ".$this->session->userdata('filial_bairro')." ".$this->session->userdata('filial_cidade')." ".$this->session->userdata('filial_estado'); ?>
                        
                    </p>
                     
                    <p class="dadosEmpresa"><?php echo $this->session->userdata('filial_email'); ?></p>
                    <p class="dadosEmpresa"><?php echo $this->session->userdata('filial_telefone'); ?> / <?php echo $this->session->userdata('filial_celular'); ?></p>
                     <p class="dadosEmpresa"><?php echo $this->session->userdata('filial_documento'); ?></p>
                </td>
                <td align="center" class="dadosEmpresa">

                    <h3><?php echo $objSolicitacao->getId_pedido(); ?></h3>
                    <br />
                    <hr>
                    <?php echo $objDateFormat->date_format($objSolicitacao->getData()); ?>
                  
                </td>
                </tr>
                <tr>

                <td colspan="3" align="center" style="background-color:green;color:#fff; "><h3>PEDIDO DE COMPRA</h3></td>
              </tr>
            </table>   
            

    </div>


</htmlpageheader>



<sethtmlpageheader name="firstpage" value="on" show-this-page="1" />
<sethtmlpageheader name="otherpages" value="on" />

<div style="margin-top:82px;">
 <table width="100%" border="1" class="bordasimples textoDadosPedido">
<tr>
    <td>
    Fornecedor:
    <?php 
        if($objSolicitacao->getFornecedor()!=null){
            echo $objSolicitacao->getFornecedor()->getNome_fantasia();
        } 
    ?> 
    <br />
    Contato: <?php echo $objSolicitacao->getContato(); ?>
    <br />
    Conforme solicitado, estamos encaminhando nosso Pedido de Compra dos item(s) abaixo relacionado(s).

    </td>
    
</tr>
 </table>


<table width="100%" border="1" class="bordasimples textoDadosPedido" cellpadding="7">
                            <thead>
                            <tr>
                            <th align="left">ITEM</th>
                            <th align="left">QTD</th>
                            <th align="left">UN</th>
                            <th align="left">DESCRIÇÃO</th>
                            <th align="left">P. UNITÁRIO</th>
                            <th align="left">P. TOTAL</th>
                            

                            <!--<th>OPERAÇÕES</th>-->
                            
                            </tr>
                            </thead>

                            <tbody>
                            <?php 
                            $total = 0;
                            $sub_total = 0;
                            $itens;
                            foreach ($listItens as $objIten):
                                   $itens++; 
                                    $sub_total = $objIten->getValor_unitario() * $objIten->getQtd();
                                    $total = $total + $sub_total;
                             ?>
                            <tr class="dadosTabela">

                            <td><?php echo $itens; ?></td>
                            <td><?php echo $objIten->getQtd(); ?></td>
                            <td>
                                
                                <?php 
                                if($objIten->getProduto()->getUnidade()!=null){        
                                    echo $objIten->getProduto()->getUnidade()->getSigla();
                                }

                                 ?>
                            </td>
                            
                            <td><?php echo $objIten->getProduto()->getDescricao(); ?></td>
                          
                        
                            
                            <td> R$ <?php echo number_format($objIten->getValor_unitario(), 2, ',', '.'); ?></td>

                            <td> R$ <?php echo number_format($objIten->getValor_unitario() * $objIten->getQtd(),   2, ',', '.'); ?></td>
                            
                            <!--<td><?php //echo $objDateFormat->date_format($objIten['data_entrega']); ?></td>-->

                            
                            
                            
                        
                            </tr>

                            <?php endforeach;?>


                        
<tr>
    <td align="center" colspan="5">
    <h4 class="btn btn-primary"><strong>SUB-TOTAL</strong></h4>
    <h4 class="btn btn-primary" style="color:red;"><strong>DESCONTO</strong></h4>
     
     <h4 class="btn btn-primary" style="color:blue;"><strong>TOTAL GERAL</strong></h4>

        

    </td>

    <td>
     <h5 class="btn btn-primary"><strong>R$ <?php echo number_format($total, 2, ',', '.'); ?></strong></h5>
    
   <h5 class="btn btn-primary" style="color:red;"><strong>R$ <?php echo number_format($objSolicitacao->getDesconto(), 2, ',', '.'); ?></strong></h5>
     
     <h3 class="btn btn-primary" style="color:blue;"><strong>R$ <?php echo number_format($total - $objSolicitacao->getDesconto(), 2, ',', '.'); ?></strong></h3>
        
    </td>
    
</tr>
 </table>

<table width="100%" border="1" class="bordasimples textoDadosPedido" cellpadding="7">

    <thead>
       <tr>
           
           <td>
               Condições de Pagamento: <?php echo $objSolicitacao->getForma_pagamento(); ?>
               <br />
               Prazo de Entrega:  <?php echo $objDateFormat->date_format($objSolicitacao->getData_entrega()); ?>
               <br />
                Transportadora:
                 <?php 
                 if($objSolicitacao->getTransportadora()!=null){
                     echo $objSolicitacao->getTransportadora()->getNome_fantasia(); 
                }
                 ?>
                  <br />
                  Endereço:  <?php echo $objSolicitacao->getEndereco_entrega(); ?> 
                  <br />
                  <br />
                  <br />

                    <?php 
                                $solicitante = "";
                                if($objSolicitacao->getSolicitacao()->getColaborador()!=null){
                                    $solicitante = $objSolicitacao->getSolicitacao()->getColaborador()->getNome();
                                }
                                else{
                                    $solicitante = "";
                                }


                                $controladoria = "";
                                if($objSolicitacao->getSolicitacao()->getAprovadorControladoria()!=null){
                                    $controladoria = $objSolicitacao->getSolicitacao()->getAprovadorControladoria()->getNome();
                                }
                                else{
                                    $controladoria = "";
                                }

                                 $diretoria = "";
                                if($objSolicitacao->getSolicitacao()->getAprovadorDiretoria()!=null){
                                    $diretoria = $objSolicitacao->getSolicitacao()->getAprovadorDiretoria()->getNome();
                                }
                                else{
                                    $diretoria = "";
                                }
                        

                        ?>

                      <table>
                          
                          <tr>
                              <td width="150px">AUTORIZADO POR:</td>
                              <td width="250">
                              <?php echo strtoupper($diretoria); ?>
                                
                              </td>
                               <td><?php echo $objDateFormat->date_format($objSolicitacao->getSolicitacao()->getData_aprovacao_diretoria()); ?></td>
                             

                          </tr>

                         <tr>
                              <td width="150px">CONFERIDO POR:</td>
                              <td width="250">
                              <?php echo strtoupper($controladoria); ?>
                                
                              </td>
                              <td><?php echo $objDateFormat->date_format($objSolicitacao->getSolicitacao()->getData_aprovacao_controladoria()); ?></td>

                          </tr>

                          <tr>
                              <td width="150px">SOLICITADO POR:</td>
                              <td width="250">
                              <?php echo strtoupper($solicitante); ?>
                                
                              </td>
                                <td><?php echo $objDateFormat->date_format($objSolicitacao->getSolicitacao()->getData_criacao()); ?></td>
                          </tr>
                      </table>




           </td>
       
       </tr>
    </thead>

</table>



</div> <!-- FINA DA PÁGINA -->





</body>

</html>