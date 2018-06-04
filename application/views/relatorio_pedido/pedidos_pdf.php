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


        <h2>Relatório de Vendas Detalhado</h2>
        <p class="data">Relatório emitido em: <?php echo $objDateFormat->date_format($data_hoje); ?> às <?php echo date('H:m');?></p>
        
        <div id="miolo_listar" class="filtro">
<fieldset>
       

 <!--<table class="dataTable">-->
     <table border="1" cellspacing="8" cellpadding="5" class="bordasimples" width="100%">
  
     <thead>
         <tr>                 
                  <td class="rotulo"></td>
                  <td class="rotulo" width="130px">DATA</td>
                  <td class="rotulo" width="50px">CÓDIGO</td>
                  <td class="rotulo" width="120px">CLIENTE</td>
                  <td class="rotulo" width="100px">USUÁRIO</td>
                  <td class="rotulo" width="80px">VALOR</td>
                  <td class="rotulo">STATUS</td>
          
        </tr>
     
     </thead>

    <tbody>
           <?php 
                  $total = 0;
                  $total_lanc = 0;
                  $contador = 0;
                  foreach ($listPedidos as $objPedido): 
                   $contador++;
                   
                   if($objPedido->getStatus()==FINALIZADO){
                     $total_lanc = $total_lanc + $objPedido->getTotal_venda();
                    }
                    else{

                   $total_pedido = ( $objPedido->getTotal_Itens() + $objPedido->getTaxa_frete() ) - $objPedido->getDesconto();
                   $total = $total + $total_pedido;
                   }
          ?>
                  <tr>
                 <td><?php echo $contador; ?></td>
                  <td><?php echo $objDateFormat->date_format_pedido($objPedido->getData_inicio()); ?></td>
                   <td><span><?php echo $objPedido->getCodigo(); ?></span></td>
                  <td><span><?php echo $objPedido->getCliente()->getNome_fantasia(); ?></span></td>
                   <td><span><?php echo $objPedido->getUsuario()->getLogin(); ?></span></td>
                
                 
                  <td>

                  R$: 

                  <?php 

                  
                  //SE FOR VENDA PEGAR OS LANÇAMENTOS DO FINANCEIRO
                  if($objPedido->getStatus()==FINALIZADO){
                   echo number_format(round($objPedido->getTotal_venda(),1), 2, ',', '.');
                  } 
                  //SE ESTIVER EM ANDAMENTO PEGA OS VALORES REFERENTE AOS ITENS E DESCONTOS E ACRESCIMOS
                  else{
                    echo number_format( ($objPedido->getTotal_Itens() + $objPedido->getTaxa_frete() ) - $objPedido->getDesconto(), 2, ',', '.');
                  }

                   ?>

                  </td>

                  <td> 

                  <?php 

                  if($objPedido->getObjStatus()!=null){
                    echo strtoupper($objPedido->getObjStatus()->getStatus()); 
                  }
                  ?>
                    
                  </td>
                                
                 
                  
                </tr>

              <?php endforeach;?>

              
            </tbody>

            </table>

            <h2>TOTAL: R$ <?php echo number_format(round($total + $total_lanc,1), 2, ',', '.'); ?></h2>

</fieldset>
      
</div>
        
    </body>
</html>
