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


        <h2>Relatório de Fornecedores</h2>
        <p class="data">Relatório emitido em: <?php echo $objDateFormat->date_format($data_hoje); ?> às <?php echo date('H:m');?></p>
        
        <div id="miolo_listar" class="filtro">
<fieldset>
   

<table border="1" cellspacing="8" cellpadding="5" class="bordasimples" width="100%">
                   <thead>
                  <tr>
                    
                    <th align="left"></th>
                    <th align="left">FORNECEDOR</th>
                    <th align="left">CNPJ / CPF</th>
                    <th align="left">TELEFONE</th>
                      <th align="left">EMAIL</th>
                    <th align="left">DATA DE CADASTRO</th>
                    <th align="left">STATUS</th>
                  
                  </tr>
                </thead>
                
                <tfoot>
                  <tr>
                   <th align="left"></th>
                    <th align="left">FORNECEDOR</th>
                    <th align="left">CNPJ / CPF</th>
                    <th align="left">TELEFONE</th>
                     <th align="left">EMAIL</th>
                    <th align="left">DATA DE CADASTRO</th>
                    <th align="left">STATUS</th>
                  
                  </tr>
                </tfoot>
                
                <tbody>
                  <?php 
                   $qtd_itens = 0;
                  foreach ($listFornecedor as $objFornecedor): 
                    $qtd_itens++;
                    ?>
                  <tr>
                 
                   <td><?php echo $qtd_itens; ?></td>
                  <td><?php echo $objFornecedor->getNome_fantasia(); ?></td>
                  <td><?php echo $objFornecedor->getCnpj_cpf(); ?></td>
                  <td><?php echo $objFornecedor->getTelefone1(); ?></td>
                   <td><?php echo $objFornecedor->getEmail(); ?></td>
                  <td><?php echo $objDateFormat->date_format($objFornecedor->getData_cadastro()); ?></td>
                  <td><?php echo $objFornecedor->printStatus(); ?></td>
                  
                 
                   
                    
                  </tr>
                  
                  <?php endforeach;?>
                  
                                  
                </tbody>
              </table>

   

</fieldset>
      
</div>
        
    </body>
</html>
