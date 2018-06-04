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


        <h2>Relatório de Locação</h2>
        <p class="data">Relatório emitido em: <?php echo $objDateFormat->date_format($data_hoje); ?> às <?php echo date('H:m');?></p>
        
        <div id="miolo_listar" class="filtro">
<fieldset>
       

 <!--<table class="dataTable">-->
     <table border="1" cellspacing="8" cellpadding="5" class="bordasimples" width="100%">
  
     <thead>
         <tr>                 
                 <th width="150px">DATA PREV. ENTREGA</th>
                    <th width="200px">PRODUTO</th>
                     <th width="100px">QTD</th>
                    <th width="160px" align="center">CODIGO LOCAÇÃO</th>
                     <th width="160px">CLIENTE</th>
                  
                    <th>STATUS</th>
          
        </tr>
     
     </thead>

    <tbody>
           <?php 
                  $total = 0;
                  $total_lanc = 0;
                  $contador = 0;
                foreach ($listItens as $objLanc):  
                  $contador++;
                   
                 
          ?>
                  <tr>
                
                  <td><?php echo $objDateFormat->date_format($objLanc['data_prev_entrega']); ?></td>
                  
                

                  <td><?php echo $objLanc['produto']; ?></td>
                   <td><?php echo round($objLanc['qtd']); ?></td>

                  <td align="center"><span class="badge badge-success"><?php echo $objLanc['codigo_locacao']; ?></span></td>  
                
                  
                  <td><?php echo $objLanc['cliente']; ?></td>
                    
                    <td width="200px">  
                     <?php  echo $objLanc['status']; ?>
                    </td>              
                 
                  
                </tr>

              <?php endforeach;?>

              
            </tbody>

            </table>

           

</fieldset>
      
</div>
        
    </body>
</html>
