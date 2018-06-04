<?php $objDateFormat = $this->DateFormat; 

$data_hoje = date('Y-m-d');

if($excel==true){
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=exceldata.xls");
header("Pragma: no-cache");
header("Expires: 0");
}


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
      
<fieldset>
   

<?php 

 
if($this->session->userdata('logo')!="" && $excel!=true){ ?>
               
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



  <h2>Relatório de Clientes</h2>
        <p class="data">Relatório emitido em: <?php echo $objDateFormat->date_format($data_hoje); ?> às <?php echo date('H:m');?></p>
        
        <div id="miolo_listar" class="filtro">


   <table border="1" cellspacing="8" cellpadding="5" class="bordasimples" width="100%">
                <thead>
                  <tr>
                   
                    <td class="rotulo"></td>
                    <td class="rotulo">CLIENTE</td>
                    <td class="rotulo">CPF/CNPJ</td>
                    <td class="rotulo">TELEFONE</td>
                    <td class="rotulo">EMAIL</td>
                    <td class="rotulo">DATA DE CADASTRO</td>
                    <td class="rotulo">STATUS</td>
                   
                  </tr>
                </thead>
                
                <tfoot>
                  <tr>
                   
                    <th class="rotulo" align="left"></th>
                    <td class="rotulo">CLIENTE</td>
                    <td class="rotulo">CPF/CNPJ</td>
                    <td class="rotulo">TELEFONE</td>
                     <td class="rotulo">EMAIL</td>
                     <td class="rotulo">DATA CADASTRO</td>
                    <td class="rotulo">STATUS</td>
                  
                  </tr>
                </tfoot>
                
                <tbody>
                  <?php 
                   $qtd_itens = 0;
                  foreach ($listCliente as $objCliente): 
                   $qtd_itens++;
                    ?>
                  <tr>
                 
                  <td><?php echo $qtd_itens; ?></td>
                  <td><?php echo $objCliente->getNome_fantasia(); ?></td>
                  <td><?php echo $objCliente->getCnpj_cpf(); ?></td>
                  <td><?php echo $objCliente->getCelular(); ?>
                    <br/>
                    <?php echo $objCliente->getTelefone1(); ?></td>
                   <td><?php echo $objCliente->getEmail(); ?></td>
                  <td><?php echo $objDateFormat->date_format($objCliente->getData_cadastro()); ?></td>
                   <td><?php echo $objCliente->printStatus(); ?></td>
                  
                 
                   
                  </tr>
                  
                  <?php endforeach;?>
                  
                                  
                </tbody>
              </table>    

   

</fieldset>
      
</div>
        
    </body>
</html>
