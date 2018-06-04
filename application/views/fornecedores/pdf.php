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
        <title><?php echo $objFornecedor->getNome_fantasia(); ?></title>
       <link href="<?= base_url(); ?>css/style_report.css" rel="stylesheet">

    </head>
    <body>
       
        <h1 class="titulo">DADOS FORNECEDOR - <?php echo $objFornecedor->getNome_fantasia(); ?> </h1>
        
        <table border="1" cellspacing="8" cellpadding="5" class="bordasimples" width="100%">
            <tr>
                <td class="rotulo">Fornecedor:</td>
                <td class="rotulo">CPF / CNPJ:</td>
                <td class="rotulo">Telefone(1):</td>
                <td class="rotulo">Telefone(2):</td>
                <td class="rotulo"></td>


            </tr>
            
            <tr>
              <td><?php echo $objFornecedor->getNome_fantasia(); ?></td>
              <td><?php echo $objFornecedor->getCnpj_cpf(); ?></td>
              <td><?php echo $objFornecedor->getTelefone1(); ?></td>
              <td><?php echo $objFornecedor->getTelefone2(); ?></td>
              <td></td>


            </tr>

             <tr>
                <td class="rotulo">Endereço:</td>
                <td class="rotulo">Bairro:</td>
                <td class="rotulo">Cidade:</td>
                <td class="rotulo">Estado:</td>
                <td class="rotulo">CEP:</td>
            </tr>

             <tr>
              <td><?php echo $objFornecedor->getEndereco(); ?></td>
              <td><?php echo $objFornecedor->getBairro(); ?></td>
              <td><?php echo $objFornecedor->getCidade(); ?></td>
              <td><?php echo $objFornecedor->getEstado(); ?></td>
              <td><?php echo $objFornecedor->getCep(); ?></td>
            </tr>

             <tr>
                <td class="rotulo">Email:</td>
                <td class="rotulo">Inscrição Municipal</td>
                <td class="rotulo">Inscrição Estadual:</td>
                <td class="rotulo">Status:</td>
                <td class="rotulo">Data Cadastro</td>
            </tr>

              <tr>
              <td><?php echo $objFornecedor->getEmail(); ?></td>
              <td><?php echo $objFornecedor->getInsc_municipal(); ?></td>
              <td><?php echo $objFornecedor->getInsc_estadual(); ?></td>
              <td><?php echo $objFornecedor->printStatus(); ?></td>
              <td><?php echo $objDateFormat->date_format($objFornecedor->getData_cadastro()); ?> </td>
          </tr>
   
    </table>
        
    </body>
</html>
