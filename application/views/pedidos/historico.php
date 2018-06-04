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
        <title><?php echo $objCliente->getNome_fantasia(); ?></title>
        <link href="<?= base_url(); ?>css/style_print.css" rel="stylesheet">

        </style>
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


       
       
       
         

<h1 class="titulos">DADOS CLIENTE - <?php echo $objCliente->getNome_fantasia(); ?> </h1>
        
        <table border="0" cellspacing="1" cellpadding="3" class="dadosEmpresa" width="100%">
            <tr>
               
                <td class="rotulo">CPF / CNPJ:</td>
                <td class="rotulo">Telefone(1):</td>
                <td class="rotulo">Telefone(2):</td>
                <td class="rotulo">Terceirizado:</td>


            </tr>
            
            <tr>
             
              <td><?php echo $objCliente->getCnpj_cpf(); ?></td>
              <td><?php echo $objCliente->getTelefone1(); ?></td>
              <td><?php echo $objCliente->getTelefone2(); ?></td>
              <td>
                 <?php if($objCliente->getTerceirizado() == SIM) {
                        echo 'SIM';
                      }
                      else{
                        echo 'NÃO';
                      }
                  ?>
              </td>


            </tr>

             <tr>
                <td class="rotulo">Endereço:</td>
                <td class="rotulo">Bairro:</td>
                <td class="rotulo">Cidade:</td>
                <td class="rotulo">Estado:</td>
                <td class="rotulo">CEP:</td>
            </tr>

             <tr>
              <td><?php echo $objCliente->getEndereco(); ?></td>
              <td><?php echo $objCliente->getBairro(); ?></td>
              <td><?php 

              if($objCliente->getCidadeObj()!=null){
               echo $objCliente->getCidadeObj()->getCt_nome(); 
              }

              ?></td>
              
              <td>
              <?php 
               if($objCliente->getEstadoObj()!=null){
                 echo $objCliente->getEstadoObj()->getUf_uf(); 
               }

              ?>
                
              </td>
              
              <td><?php echo $objCliente->getCep(); ?></td>
            </tr>

             <tr>
                <td class="rotulo">Email:</td>
                <td class="rotulo">Inscrição Municipal:</td>
                <td class="rotulo">Inscrição Estadual:</td>
                <td class="rotulo">Status:</td>
                <td class="rotulo">Data Cadastro:</td>
            </tr>

              <tr>
              <td><?php echo $objCliente->getEmail(); ?></td>
              <td><?php echo $objCliente->getInsc_municipal(); ?></td>
              <td><?php echo $objCliente->getInsc_estadual(); ?></td>
              <td><?php echo $objCliente->printStatus(); ?></td>
              <td><?php echo $objDateFormat->date_format($objCliente->getData_cadastro()); ?> </td>
          </tr>
   
    </table>
        

        <hr />


         <h1 class="titulos">HISTÓRICO DE PEDIDOS:</h1>
   
   <table border="0" cellspacing="1" cellpadding="3" class="tabelaItens" width="100%">
            <thead>
                  <tr>
                    <th align="left"></th>
                    <th align="left">DATA</th>
                    <th align="left">CÓDIGO</th>
                    
                     <th align="left">USUÁRIO</th>
                     <th align="left">VALOR</th>
                    <th align="left">STATUS</th>
                  
              </tr>
            </thead>

            <tbody>
           <?php 
                  $total = 0;
                  $item = 0;
                  foreach ($listPedidos as $objPedido): 
                   $total_pedido = ( $objPedido->getTotal_Itens() + $objPedido->getTaxa_frete() ) - $objPedido->getDesconto();
                    $total = $total + $total_pedido;
                    $item++;
                  ?>
                  <tr>
                 
                  <td><?php echo $item; ?></td>
                  <td><?php echo $objDateFormat->date_format_pedido($objPedido->getData_inicio()); ?></td>
                   <td><span><?php echo $objPedido->getCodigo(); ?></span></td>
                
                   <td><span><?php echo $objPedido->getUsuario()->getLogin(); ?></span></td>
                
                 
                  <td>R$: <?php echo number_format( ($objPedido->getTotal_Itens() + $objPedido->getTaxa_frete() ) - $objPedido->getDesconto(), 2, ',', '.');  ?> </td>
                    <td><?php 

                          if($objPedido->getObjStatus()!=null){
                            echo strtoupper($objPedido->getObjStatus()->getStatus());
                          }
                     ?></td>
                                
                  
                  
                </tr>

              <?php endforeach;?>

              
            </tbody>

        </table>

        <br />

        <h2 class="titulos">TOTAL VENDAS R$: <?php echo number_format($total, 2, ',', '.'); ?></h2>



<hr />

<br />

         <h1 class="titulos">HISTÓRICO DE ORÇAMENTOS:</h1>
   
   <table border="0" cellspacing="1" cellpadding="3" class="tabelaItens" width="100%">
            <thead>
                  <tr>
                    <th align="left"></th>
                    <th align="left">DATA</th>
                    <th align="left">CÓDIGO</th>
                    
                     <th align="left">USUÁRIO</th>
                     <th align="left">VALOR</th>
                    <th align="left">STATUS</th>
                  
              </tr>
            </thead>

            <tbody>
           <?php 
                  $total = 0;
                  $item = 0;
                  foreach ($listOrc as $objPedido): 
                   $total_pedido = ( $objPedido->getTotal_Itens() + $objPedido->getTaxa_frete() ) - $objPedido->getDesconto();
                    $total = $total + $total_pedido;
                    $item++;
                  ?>
                  <tr>
                   <td><?php echo $item; ?></td>
                  <td><?php echo $objDateFormat->date_format_pedido($objPedido->getData_inicio()); ?></td>
                   <td><span><?php echo $objPedido->getCodigo(); ?></span></td>
                
                   <td><span><?php echo $objPedido->getUsuario()->getLogin(); ?></span></td>
                
                 
                  <td>R$: <?php echo number_format( ($objPedido->getTotal_Itens() + $objPedido->getTaxa_frete() ) - $objPedido->getDesconto(), 2, ',', '.');  ?> </td>
                    <td><?php 

                          if($objPedido->getObjStatus()!=null){
                            echo strtoupper($objPedido->getObjStatus()->getStatus());
                          }
                     ?></td>
                                
                  
                  
                </tr>

              <?php endforeach;?>

              
            </tbody>

        </table>

        <br />

        <h2 class="titulos">TOTAL ORÇAMENTOS R$: <?php echo number_format($total, 2, ',', '.'); ?></h2>


         

   


        
        

    
    </body>
</html>
