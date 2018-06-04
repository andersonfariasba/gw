<?php $objDateFormat = $this->DateFormat; ?> 
<html>

<head>
<title><?php echo $objSolicitacao->getId_solicitacao(); ?> </title>

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

                    <h3><?php echo $objSolicitacao->getId_solicitacao(); ?></h3>
                    <br />
                    <hr>
                    <?php echo $objDateFormat->date_format($objSolicitacao->getData_criacao()); ?>
                  
                </td>
                </tr>
                <tr>

                <td colspan="3" align="center" style="background-color:green;color:#fff; "><h3>SOLICITAÇÃO DE PREÇO DE MATERIAIS</h3></td>
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
     Data de Necessidade:
    <?php 
        echo $objDateFormat->date_format($objSolicitacao->getData_necessidade());
    ?> 
    </td>
    
</tr>
 </table>


<table width="100%" border="1" class="bordasimples textoDadosPedido" cellpadding="7">
                            <thead>
                            <tr>
                              <th align="left" width="50px">ITEM</th>
                              <th align="left">MATERIAL</th>
                              <th align="left">QTD</th>
                            

                            <!--<th>OPERAÇÕES</th>-->
                            
                            </tr>
                            </thead>

                         <tbody>
              <?php 
              $i = 0;
              foreach ($listItens as $objIten):
                  $i++;
               ?>
              <tr class="dadosTabela">

              <td><?php echo $i; ?></td>
              <td><?php echo $objIten->getProduto()->getDescricao(); ?></td>
              <td><?php echo $objIten->getQtd(); ?></td>
              
              </tr>

              <?php endforeach;?>


              </tbody>

 </table>






<table width="100%" border="1" class="bordasimples textoDadosPedido" cellpadding="7">
   
                          
                      <?php 
                if($objSolicitacao->getColaborador()!=null){
                  $solicitante = $objSolicitacao->getColaborador()->getNome();
                }
                else{
                  $solicitante = "";
                }
            ?>



                          <tr>
                              <td width="150px">SOLICITADO POR: <?php echo strtoupper($solicitante); ?></td>
                              
                                
                          </tr>
                      </table>




           </td>
       
       </tr>
    </thead>

</table>

</div> <!-- FINA DA PÁGINA -->





</body>

</html>