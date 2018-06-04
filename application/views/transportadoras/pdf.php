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
       
        <h1 class="titulo">FICHA DE FORNECEDOR</h1>
        
        <table border="1" cellspacing="3" cellpadding="8" width="100%" class="bordasimples">
            <tr>
                <td class="rotulo">Fornecedor:</th>
                <td colspan="5"><?php echo $objFornecedor->getNome_fantasia(); ?>
                
                    - <strong>CPF / CNPJ:</strong>
                <?php echo $objFornecedor->getCnpj_cpf(); ?></td>
                
                
            </tr>
            
            <tr>
                <td class="rotulo">Telefone(1):</th>
                <td><?php echo $objFornecedor->getTelefone1(); ?></td>
                
                <td class="rotulo">Telefone(2):</th>
                <td><?php echo $objFornecedor->getTelefone2(); ?></td>
                
                <td class="rotulo">Celular:</th>
                <td><?php echo $objFornecedor->getCelular(); ?></td>
                
                
            </tr>
            
            <tr>
                <td class="rotulo">Email:</th>
                <td colspan="5"><?php echo $objFornecedor->getEmail(); ?></td>
                
            </tr>
           
             <tr>
                <td class="rotulo">Endereço:</th>
                <td colspan="2"><?php echo $objFornecedor->getEndereco(); ?></td>
                
                <td></td>
                
                <td class="rotulo">Bairro:</th>
                <td><?php echo $objFornecedor->getBairro(); ?></td>
                
                
            </tr>
           
            <tr>
                
                <td class="rotulo">Cidade:</th>
                <td><?php echo $objFornecedor->getCidade(); ?></td>
                
                
                <td class="rotulo">Estado:</th>
                <td><?php echo $objFornecedor->getEstado(); ?></td>
                
                <td class="rotulo">CEP:</th>
                <td><?php echo $objFornecedor->getCep(); ?></td>
                
                
            </tr>
           
            
            
            <tr>
                
                <td class="rotulo">Insc. Estadual:</th>
                <td><?php echo $objFornecedor->getInsc_estadual(); ?></td>
                
                
                <td class="rotulo">Insc. Municipal:</th>
                <td colspan="3"><?php echo $objFornecedor->getInsc_municipal(); ?></td>
                
               
                
            </tr>
            
            <tr>
                <td class="rotulo">Status:</td>
                <td colspan="5"><?php echo $objFornecedor->printStatus(); ?></td>
            </tr>
            
             <tr>
                <td class="rotulo" valign="top">Observação:</td>
                <td colspan="5"><?php echo $objFornecedor->getObservacao(); ?></td>
            </tr>
           
            
            
        </table>
        
    </body>
</html>
