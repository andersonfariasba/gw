<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style type="text/css">
            table.bordasimples {border-collapse: collapse;}

            table.bordasimples tr td {border:1px solid #666666;}
            .rotulo{font-weight:bold;}
            .titulo{
                font-size:14px; 
            }
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


       
        <h1 class="titulo">FICHA DE CLIENTE</h1>
        
        <table border="1" cellspacing="3" cellpadding="8" width="100%" class="bordasimples">
            <tr>
                <td class="rotulo">Nome / Empresa:</th>
                <td colspan="5"><?php echo $objCliente->getNome_fantasia(); ?>
                
                    - <strong>CPF / CNPJ:</strong>
                <?php echo $objCliente->getCnpj_cpf(); ?></td>
                
                
            </tr>
            
            <tr>
                <td class="rotulo">Telefone(1):</th>
                <td><?php echo $objCliente->getTelefone1(); ?></td>
                
                <td class="rotulo">Telefone(2):</th>
                <td><?php echo $objCliente->getTelefone2(); ?></td>
                
                <td class="rotulo">Celular:</th>
                <td><?php echo $objCliente->getCelular(); ?></td>
                
                
            </tr>
            
            <tr>
                <td class="rotulo">Email:</th>
                <td colspan="5"><?php echo $objCliente->getEmail(); ?></td>
                
            </tr>
           
             <tr>
                <td class="rotulo">Endereço:</th>
                <td colspan="2"><?php echo $objCliente->getEndereco(); ?></td>
                
                <td></td>
                
                <td class="rotulo">Bairro:</th>
                <td><?php echo $objCliente->getBairro(); ?></td>
                
                
            </tr>
           
            <tr>
                
                <td class="rotulo">Cidade:</th>
                <td><?php echo $objCliente->getCidade(); ?></td>
                
                
                <td class="rotulo">Estado:</th>
                <td><?php echo $objCliente->getEstado(); ?></td>
                
                <td class="rotulo">CEP:</th>
                <td><?php echo $objCliente->getCep(); ?></td>
                
                
            </tr>
           
            
            
            <tr>
                
                <td class="rotulo">Insc. Estadual:</th>
                <td><?php echo $objCliente->getInsc_estadual(); ?></td>
                
                
                <td class="rotulo">Insc. Municipal:</th>
                <td colspan="3"><?php echo $objCliente->getInsc_municipal(); ?></td>
                
               
                
            </tr>
            
            <tr>
                <td class="rotulo">Status:</td>
                <td colspan="5"><?php echo $objCliente->printStatus(); ?></td>
            </tr>
            
             <tr>
                <td class="rotulo" valign="top">Observação:</td>
                <td colspan="5"><?php echo $objCliente->getObservacao(); ?></td>
            </tr>
           
            
            
        </table>
        
    </body>
</html>
