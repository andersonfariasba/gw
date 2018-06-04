<!DOCTYPE html>
<html lang="en">
  
 <head>
    <meta charset="utf-8">
    <title>FRENTE DE CAIXA</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    
 <link rel="shortcut icon" href="<?= base_url(); ?>img/favicon.png" />



    <link href="<?= base_url() ?>caixa/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>caixa/css/bootstrap-responsive.min.css" rel="stylesheet">

   
    
    <!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">-->

    <!--<link href="<?= base_url(); ?>caixa/css/font.css" rel="stylesheet">-->
  
    
    <link href="<?= base_url() ?>caixa/css/font-awesome.css" rel="stylesheet">
    

    
    <link href="<?= base_url() ?>caixa/css/style.css" rel="stylesheet">
     <link href="<?= base_url() ?>caixa/css/estilo_extra.css" rel="stylesheet">

    
    <link href="<?= base_url() ?>caixa/css/form_style.css" rel="stylesheet">
    
    <link href="<?= base_url() ?>caixa/css/pages/reports.css" rel="stylesheet">

     <link href="<?= base_url() ?>caixa/css/pages/faq.css" rel="stylesheet"> 
    <link type="text/css" rel="stylesheet" href="<?= base_url() ?>css/jquery.ui.theme/redmond/style.css" /> 

      <!--Css Padrao

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    

  </head>

<body>
<?php $objDateFormat = $this->DateFormat; 
$janela = array(
              'width'      => '1024',
              'height'     => '400',
              'scrollbars' => 'yes',
              'status'     => 'yes',
              'resizable'  => 'yes',
              'screenx'    => '200',
              'screeny'    => '100'
            );

?>
<?php $titulo_pedido = ($tipo == PEDIDO ? 'Venda' : 'Cotação'); ?>
    
    
<div class="main">
	
	<div class="main-inner">



	    <div class="container">

	    
     <div class="row">
          
         <div class="span12">
            
            <div class="widget">
              
          <div class="widget-header">
            <i class="icon-ok"></i>

            <!-- ABREVIAR NOME DO CLIENTE -->
            <?php 
            $partes = explode(' ', $objPedido->getCliente()->getNome_fantasia());
            $primeiroNome = array_shift($partes);
            $ultimoNome = array_pop($partes);
           
            ?>

            <h3 class="titulo_topo"><?php echo "Nº ". $titulo_pedido.": ". $objPedido->getCodigo()." | Usuário: ".$objPedido->getUsuario()->getLogin()." | Data:".$objDateFormat->date_format_pedido($objPedido->getData_inicio())." | Cliente: ".$primeiroNome." ".$ultimoNome;?> |    
            </h3> 
           
            <a href="#" class="btn btn-defalut btn-small" id="modal_alterar_pedido"><i class="icon-pencil"> </i> <strong>Alterar Dados</strong></a>


         <?php if($objPedido->getStatus()!=FINALIZADO){?>
            <a href="#" class="btn btn-default btn-small" id="modal_novo_cliente"><i class="icon-plus"> </i> <strong>Novo Cliente</strong></a>

             <a href="#" class="btn btn-default btn-small" id="modal_buscar_cliente"><i class="icon-filter"> </i> <strong>Buscar Cliente</strong></a>

             <?php } ?>



              <a href="#" title="Incluir Observação" class="btn btn-defalut btn-small" id="modal_incluir_obs"><i class="icon-pencil"> </i> </a>
            <a href="<?php echo site_url('pedidos/imprimir/'.$objPedido->getId_pedido()); ?>" target="_blank" class="btn btn-default btn-small"><i class="icon-print"> </i> <strong></strong></a>
           




          </div>
          
          
          </div>

          </div>
    </div>
     




    <!-- ******** FINAL SELEÇÃO DE ITENS DE PRODUTO *********** -->    
        
	<?php if($objPedido->getEscopo()==PRODUTO){ ?>



 <!-- ******** INICIO SELEÇÃO DE ITENS DE PRODUTO FORMA AUTOMATICA *********** -->    
     
     <div class="row">
          
         <div class="span12">
            
            <div class="widget">
              
          <div class="widget-header">
           

            <i class="icon-check"></i>
            <h3>Selecione o produto para <?php echo $titulo_pedido; ?>
            
   ( <?php echo anchor_popup(site_url('pedidos/estoque_pesquisa/'.$objPedido->getId_pedido()),'Pesquisar no estoque',$janela);?> )
             

          
          </div> <!-- /widget-header -->
          
          <div class="widget-content">
            
           <?php echo validation_errors(); ?>
          <?php echo form_open('pedidos/add_item/'.$objPedido->getId_pedido(),array("onsubmit"=>"return validate()","class"=>"form-horizontal","id"=>"formulario")); ?>
    <input type="hidden" name="id_pedido" id="id_pedido" value="<?php echo $objPedido->getId_pedido(); ?>" />
      

            
            <fieldset class="grupo">

                <div class="campo">

                  <label for="nome" class="labelDados">Código Produto</label>
                  <input type="text" name="codigo" id="codigo" value="" class="span4">
                </div>

               
                <div class="campo">
                  <label for="nome" class="labelDados">Qtd</label>
                  <input type="text" name="qtd" class="span2" id="qtd" onkeypress='return SomenteNumero(event)'>
                </div>

           <?php if($objPedido->getStatus()==ANDAMENTO || $objPedido->getStatus()==PROCESSAMENTO){ ?>
          <div class="campo">
            <label for="nome" class="labelDados">&nbsp</label>
            <button type="submit" class="btn btn-success" style="font-family: sans-serif;">
            <strong><i class="icon-plus-sign icon-white"></i> Incluir</strong>
            </button> 
             </div>      
         
          <?php } else{ ?>

          <div class="campo">
            <label for="nome" class="labelDados">&nbsp</label>
            <div class="alert"><strong>Venda Finalizada</strong></div>
          </div>

          <?php } ?>

         
                          

            </fieldset>

            
         </form>
          </div> <!-- /widget-content -->
        
        </div> <!-- /widget -->
                  
          </div> <!-- /span6 -->
          
    </div> <!-- /row -->



           <div class="row">
	      	
	      	<div class="span12">
	      		
	      		<div class="widget" >
						
					<div class="widget-header">
						<i class="icon-list"></i>
						<h3>Lista de Itens <!--<span style="padding:5px;" class="faq-number">2 Itens</span>--></h3>
					</div> <!-- /widget-header -->
					
					<div class="widget-content" id="itensCentral">
					  

            <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Código</th>
                    <th>Produto</th>
                    <th>Valor Unitário</th>
                     <th>Qtd</th>
                    <th>Sub Total</th>
                    <th class="td-actions">Remover</th>
                  </tr>
                </thead>
                <tbody>
                 <?php 
         $sub_total = 0;
         $total = 0;
         foreach($listItens as $objItem): 
            $sub_total = $objItem->getValor_unitario() * $objItem->getQtd();
            $total = $total + $sub_total; ?>
                  
                  <tr>           
                <td><?php echo $objItem->getProduto()->getCodigo(); ?></td>
                <td><?php echo $objItem->getProduto()->getDescricao(); if($objItem->getProduto()->getTipo()==SERVICO) {  echo " <strong>(SERVIÇO)</strong>"; } ?></td>
                <td><?php echo number_format($objItem->getValor_unitario(), 2, ',', '.'); ?></td>
               
                 <td>

                <?php 
                if($objItem->getProduto()->getUnidade()!=null){
                 echo $objItem->getQtd()." ".$objItem->getProduto()->getUnidade()->getSigla(); 
                }else{
                   echo $objItem->getQtd();
                }
                ?>
                </td>

                <td><?php echo number_format($sub_total, 2, ',', '.'); ?></td>
                <td>
                 <?php if($objPedido->getStatus()==ANDAMENTO || $objPedido->getStatus()==PROCESSAMENTO){ ?>
                <a href="#" class="confirm-delete btn btn-danger btn-small" data-id="<?php echo $objItem->getId_item(); ?>"><i class="btn-icon-only icon-remove"> </i>Excluir</a>
                 <?php } ?>
                </td>

            </tr>
        
        
        <?php endforeach; ?>
        
                    

                  </tbody>
                  <tfoot>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th><h4>R$: <?php echo number_format($total, 2, ',', '.'); ?></h4></th>
                     <th></th>

                  </tfoot>


                </table>
						

					</div> <!-- /widget-content -->
						
				</div> <!-- /widget -->
				
	      		
	      		

		    </div> <!-- /span6 -->
	      	
	      	
	      	


	      	
	      </div> <!-- /row -->
<!-- FINAL PARA PEDIDO DO TIPO AUTOMÁTICO -->
<?php } ?>




<?php if($objPedido->getEscopo()==SERVICO){ ?>
<!-- INICIO PEDIDO DO TIPO MANUAL -->



 <!-- ******** INICIO SELEÇÃO DE ITENS DE PRODUTO FORMA AUTOMATICA *********** -->    
     
     <div class="row">
          
         <div class="span12">
            
            <div class="widget">
              
          <div class="widget-header">
           

            <i class="icon-check"></i>
            <h3>Informe o serviço a ser realizado <?php echo $titulo_pedido; ?>
            
    <?php //echo anchor_popup(site_url('pedidos/estoque_pesquisa/'.$objPedido->getId_pedido()),'Pesquisar no estoque',$janela); ?> 
             

          
          </div> <!-- /widget-header -->
          
          <div class="widget-content">
            
           <?php echo validation_errors(); ?>
          <?php echo form_open('pedidos/add_item_manual/'.$objPedido->getId_pedido(),array("onsubmit"=>"return validate()","class"=>"form-horizontal","id"=>"formulario")); ?>
    <input type="hidden" name="id_pedido" id="id_pedido" value="<?php echo $objPedido->getId_pedido(); ?>" />
      

            
            <fieldset class="grupo">

                <div class="campo">
                  <label for="nome" class="labelDados">Descrição do Serviço</label>
                  <input type="text" name="descricao" id="descricao" value="" class="span6">
                </div>

                <div class="campo">
                  <label for="nome" class="labelDados">Valor Unitário</label>
                  <input type="text" tipo="moneyReal" name="valor_unitario" value="" class="span2">
                </div>

               
                <div class="campo">
                  <label for="nome" class="labelDados">Qtd</label>
                  <input type="text" name="qtd" class="span1" id="qtd" onkeypress='return SomenteNumero(event)'>
                </div>

           <?php if($objPedido->getStatus()==ANDAMENTO || $objPedido->getStatus()==PROCESSAMENTO){ ?>
          <div class="campo">
            <label for="nome" class="labelDados">&nbsp</label>
            <button type="submit" class="btn btn-success">
            <strong><i class="icon-plus-sign icon-white"></i> Incluir</strong>
            </button> 
             </div>      
         
          <?php } else{ ?>

          <div class="campo">
            <label for="nome" class="labelDados">&nbsp</label>
            <div class="alert"><strong>Venda Finalizada</strong></div>
          </div>

          <?php } ?>

         
                          

            </fieldset>

            
         </form>
          </div> <!-- /widget-content -->
        
        </div> <!-- /widget -->
                  
          </div> <!-- /span6 -->
          
    </div> <!-- /row -->


<div class="row">
          
          <div class="span12">
            
            <div class="widget" >
            
          <div class="widget-header">
            <i class="icon-list"></i>
            <h3>Lista de Itens <!--<span style="padding:5px;" class="faq-number">2 Itens</span>--></h3>
          </div> <!-- /widget-header -->
          
          <div class="widget-content" id="itensCentral">
            

            <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Item</th>
                    <th>Serviço</th>
                    <th>Valor Unitário</th>
                     <th>Qtd</th>
                    <th>Sub Total</th>
                    <th class="td-actions">Remover</th>
                  </tr>
                </thead>
                <tbody>
                 <?php 
         $sub_total = 0;
         $total = 0;
         $contador = 0;
         foreach($listItens as $objItem): 
            $sub_total = $objItem->getValor_unitario() * $objItem->getQtd();
            $total = $total + $sub_total; 
            $contador++;      
            ?>
                  <tr>           
                <td><?php echo $contador; ?></td>
                <td><?php echo $objItem->getDescricao(); ?></td>
                <td><?php echo number_format($objItem->getValor_unitario(), 2, ',', '.'); ?></td>
               
                 <td>

                <?php 
                        echo $objItem->getQtd(); 
                ?>
                </td>

                <td><?php echo number_format($sub_total, 2, ',', '.'); ?></td>
                <td>
                 <?php if($objPedido->getStatus()==ANDAMENTO || $objPedido->getStatus()==PROCESSAMENTO){ ?>
                <a href="#" class="confirm-delete btn btn-danger btn-small" data-id="<?php echo $objItem->getId_item(); ?>"><i class="btn-icon-only icon-remove"> </i>Excluir</a>
                 <?php } ?>
                </td>

            </tr>
        
        
        <?php endforeach; ?>
        
                    

                  </tbody>
                  <tfoot>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th><h4>R$: <?php echo number_format($total, 2, ',', '.'); ?></h4></th>
                     <th></th>

                  </tfoot>


                </table>
            

          </div> <!-- /widget-content -->
            
        </div> <!-- /widget -->
        
            
            

        </div> <!-- /span6 -->
          
          
          


          
        </div> <!-- /row -->


<!-- FINAL PARA PEDIDO DO TIPO MANUAL -->
<?php } ?>
	      
	      
			




	      



<!-- FINAL CAMADA GERAL DAS DIVS -->
	      
	    </div> <!-- /container -->
	    
	</div> <!-- /main-inner -->


</div> <!-- /main -->
    







<!-- JANEL FORMA DE PAGAMENTO MULTIPLA FORMAS DE PAGAMENTOS --> 

<!-- MODAL FORMA DE PAGAMENTOS -->  
  <div id="form-content" class="modal hide fade in" style="display: none; ">

    <?php
       $total_geral = ( $objPedido->getTotal_Itens() + $objPedido->getTaxa_frete() ) - $objPedido->getDesconto();
       ?> 
          <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                      <h3><i class="btn-icon-only icon-money"> </i>Forma de Pagamento</h3>
          </div>  

         <!--<form action="" method="post" id="ajax_finalizar">  -->
         
         <form action="" method="post" id="ajax_forma_pagamento">

         <input type="hidden" name="id_pedido" value="<?php echo $objPedido->getId_pedido(); ?>">
         <input type="hidden" name="valor_pedido" id="valorFlag" class="total_topo">
         <input type="hidden" name="id_cliente" value="<?php echo $objPedido->getId_cliente(); ?>">
         
         <input type="hidden" name="descontoFlag" id="descontoFlag">
         <input type="hidden" name="taxa_freteFlag" id="taxa_freteFlag">
         <input type="hidden" name="observacaoFlag" id="observacaoFlag">





          <fieldset>
             <div class="modal-body">

            <fieldset class="grupo">
            <!--<div class="pull-right">-->
             
             <div class="campo">
                <strong><span class="btn btn-primary botao_total_pedido" style="font-size:18px"></span></strong>
             </div>

             <div class="campo">
                <strong><span class="btn btn-success botao_total_pago" style="font-size:18px"></span></strong>
             </div>

             <div class="campo">
                <strong><span class="btn btn-warning botao_total_saldo" style="font-size:18px"></span></strong>
             </div>

           
             
           <!-- </div>-->

            <!-- <div class="campo">
                <label for="nome" class="labelDados">TOTAL PAGO R$:</label>
                  <input type="text" disabled="" tipo="moneyReal" class="span2" id="total_pago_topo">
             </div>-->



              
            </fieldset>


            <fieldset class="grupo">       

              <div class="campo">
                <label for="nome" class="labelDados">Forma de Pagamento:</label>
                 <select name="id_forma" id="id_forma" style="width:240px;">
                <option value="">Selecione...</option>
                </select>
              </div>

                <!--<div class="campo" id="operadora_camada">
                <label for="nome" class="labelDados">Operadora:</label>
                <select name="id_operadora" id="id_operadora" style="width:160px;">
                <option value="">Nenhuma</option>
              </select>
              </div>

                <div class="campo" id="bandeira_camada">
                <label for="nome" class="labelDados">Bandeira:</label>
                <select name="id_bandeira" id="id_bandeira" style="width:160px;">
                <option value="">Nenhuma</option>
              </select>
              </div>
              -->

               <div class="campo" id="camada_qtd_parcela">
                <label for="nome" class="labelDados">Qtd. Parcela:</label>
                 <select name="qtd_parcela_pag" id="qtd_parcela_select" style="width:160px;">
                <option value="">Nenhuma</option>
              </select>

                  <!--<input type="text" name="qtd_parcela_pag" value="1" onkeypress='return SomenteNumero(event)' class="span1" id="qtd_parcela_pag" value="<?php echo set_value('qtd_parcela_pag')?>">-->
               
               </div>


               <div class="campo">
                  <label for="nome" class="labelDados">Valor Pago</label>
                  <input type="text" name="valor_pago_forma" tipo="moneyReal" class="span2" id="valor_pago_forma" value="<?php echo set_value('taxa_frete','0,00')?>">
                </div>

                 
                 <div class="campo" id="camada_data_vencimento">
                  <label for="nome" class="labelDados">Data vencimento</label>
                  <input type="text" name="data_vencimento"  class="span2 calendario" id="data_vencimento" value="<?php echo set_value('data_vencimento','')?>">
                </div>



                 <div class="campo">
            <label for="nome" class="labelDados">&nbsp</label>
            <button type="submit" id="add_forma_btn" class="btn btn-success">
            <strong><i class="icon-plus-sign icon-white"></i> </strong>
            </button>       
            </div>



        </fieldset>  

        <fieldset class="grupo">
          
           <table class="table table-striped table-bordered" id="tabela_forma_pagamento">
                <thead>
                  <tr>
                    <th>FORMA</th>
                    <th>VALOR PAGO</th>
                    <th>QTD PARCELA</th>
                    <th class="td-actions">REMOVER</th>
                  </tr>
                </thead>
                <tbody>
                
                </tbody>
              
              </table>
              
        </fieldset>

</form>


<fieldset class="grupo">
       
    <form action="" method="post" id="ajax_forma_multipla">
        <input type="hidden" name="escopo" id="escopo" value="<?php echo $objPedido->getEscopo(); ?>">
         
         <input type="hidden" name="id_pedido" value="<?php echo $objPedido->getId_pedido(); ?>">
          <input type="hidden" name="valor_pedido" id="valorFlag" class="total_topo">
 
    
    <div class="campo" id="camada_confirmar" style="display:none;">
            <label for="nome" class="labelDados">&nbsp</label>
            <button type="submit" id="add_forma_mult_btn" class="btn btn-success">
            <strong><i class="icon-ok-sign icon-white"></i> CONFIRMAR PAGAMENTO</strong>
            </button>       
  <input type="hidden" name="id_pedido" value="<?php echo $objPedido->getId_pedido(); ?>">
  <input type="hidden" name="total_pago_forma" id="total_pago_forma">
  <input type="hidden" name="id_cliente" value="<?php echo $objPedido->getId_cliente(); ?>">
         

    </div>

    <!--<div class="campo">
            <label for="nome" class="labelDados">&nbsp</label>
            <button type="submit" id="add_forma_btn" class="btn btn-danger">
            <strong><i class="icon-remove-sign icon-white"></i> CANCELAR VENDA</strong>
            </button>       
  
    </div>-->

    <div class="campo">
            <label for="nome" class="labelDados">&nbsp</label>
            
            <button type="submit" class="btn fechar_janela">
            <strong><i class="icon-minus-sign icon-white"></i> FECHAR JANELA</strong>
            </button>       
  
    </div>



</form>
</fieldset>
  </div><!-- final body modal -->

  </div>

<!-- FINAL JANELA FORMA DE PAGAMENTO -->
<!-- ****** FINAL FORMA DE PAGAMENTO ****************-->







<!-- JANEL FORMA DE PAGAMENTO A VISTA --> 
<!-- MODAL FORMA DE PAGAMENTOS -->  
  <div id="form-content-dinheiro" class="modal hide fade in" style="display: none; ">

    <?php
       $total_geral = ( $objPedido->getTotal_Itens() + $objPedido->getTaxa_frete() ) - $objPedido->getDesconto();
       ?> 
          <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                      <h3><i class="btn-icon-only icon-money"> </i>CONFIRMAR PAGAMENTO Á VISTA</h3>
          </div>  

         <!--<form action="" method="post" id="ajax_finalizar">  -->
         
         <form action="" method="post" id="ajax_forma_dinheiro">

         <input type="hidden" name="id_pedido" value="<?php echo $objPedido->getId_pedido(); ?>">
         <input type="hidden" name="escopo" id="escopo" value="<?php echo $objPedido->getEscopo(); ?>">
         
         <input type="hidden"  name="total_pedido" class="total_pedido_flag">
         <input type="hidden"  name="total_pagar" class="total_topo">

         <input type="hidden" name="id_cliente" value="<?php echo $objPedido->getId_cliente(); ?>">
         <input type="hidden" name="descontoFlag" class="desconto_flag">
         <input type="hidden" name="taxa_freteFlag" class="taxa_flag">
         <input type="hidden" name="observacaoFlag" id="observacaoFlag">


          <fieldset>
             <div class="modal-body">

            <fieldset class="grupo">
             
             <div class="campo">
                <!--<label for="nome" class="labelDados">TOTAL PEDIDO:</label>
                <input type="text" disabled="" tipo="moneyReal" class="span2 total_topo" id="total_topo">-->
                   <strong><span class="btn btn-primary botao_total_pedido" style="font-size:18px"></span></strong>
             </div>

             <!--<div class="campo">
                <label for="nome" class="labelDados">TOTAL PAGO R$:</label>
                  <input type="text" disabled="" tipo="moneyReal" class="span2" id="total_pago_topo">
             </div>-->



              
            </fieldset>


<fieldset class="grupo">
       
      
     <?php if($objPedido->getStatus()==ANDAMENTO || $objPedido->getStatus()==PROCESSAMENTO){ ?>
  
    <div class="campo">
            <label for="nome" class="labelDados">&nbsp</label>
            <button type="submit" id="add_forma_dinheiro_btn" class="btn btn-success">
            <strong><i class="icon-ok-sign icon-white"></i> CONFIRMAR PAGAMENTO</strong>
            </button>       
    </div>

     <?php } else{ ?>

  <div class="alert"><strong>Venda Finalizada</strong></div>

     <?php } ?>
  
    <div class="campo">
            <label for="nome" class="labelDados">&nbsp</label>
            <button type="submit" id="add_forma_btn" class="btn fechar_janela">
            <strong><i class="icon-minus-sign icon-white"></i> FECHAR JANELA</strong>
            </button>       
  
    </div>



</form>


</fieldset>
  </div><!-- final body modal -->

  </div>

<!-- FINAL JANELA FORMA DE PAGAMENTO -->
<!-- ****** FINAL FORMA DE PAGAMENTO ****************-->





<!-- JANELA ALTERAR DADOS DO ORÇAMENTO --> 
  <div id="form-content-alt-pedido" class="modal hide fade in" style="display: none; ">
 
 <form action="" method="post" id="ajax_edit_pedido">

 <!-- CRIAÇÃO DE FLAG PARA PARA SABER SE ORÇAMENTO NOVO, VENDA NOVO -->

<?php 

$flag_tipo_op = '';

//orcamento novo
if($objPedido->getTipo()==ORCAMENTO && $objPedido->getStatus()==ANDAMENTO){
$flag_tipo_op = 1;
}

//venda nova
if($objPedido->getTipo()==PEDIDO && $objPedido->getStatus()==ANDAMENTO){
$flag_tipo_op = 2;
}


?>


 <!-- FINAL -->

          <input type="hidden" name="flag_tipo_op" id="flag_tipo_op" value="<?php echo $flag_tipo_op; ?>">
        
         <input type="hidden" name="id_pedido" value="<?php echo $objPedido->getId_pedido(); ?>">
         
         
          <fieldset>
             <div class="modal-body">

            <fieldset class="grupo">
             
           
        <div class="campo">
            <label for="nome" class="labelDados">Cliente:</label>
          <select name="id_cliente" id="id_cliente" style="width:250px;">
            <option value="<?php echo PAD_CAD_CLIENTE; ?>">SEM CADASTRO</option>
              <?php foreach ($listCliente as $objCliente): 
                   $cliente = $objCliente->getId_cliente();
              ?>
      <option value="<?php echo $objCliente->getId_cliente(); ?>" <?php echo set_select('id_cliente',$cliente,$objPedido->clienteIs($cliente)); ?>>
                    <?php echo $objCliente->getNome_fantasia(); ?>
                  </option>
              <?php endforeach; ?>
          </select>
          </div>

           <div class="campo">
            <label for="nome" class="labelDados">Usuario:</label>
          <select name="id_usuario" id="id_usuario" style="width:250px;">
              <?php foreach ($listUser as $objUser): 
                  $user = $objUser->getId_usuario();
              ?>
  <option value="<?php echo $objUser->getId_usuario(); ?>" <?php echo set_select('id_usuario',$user,$objPedido->usuarioIs($user)); ?>>
                    <?php echo $objUser->getLogin(); ?>
                  </option>
              <?php endforeach; ?>
          </select>
          </div>

          <div class="campo">
            <label for="nome" class="labelDados">Tipo</label>

         <select name="tipo" id="tipo">
 
<?php $tipo = $objPedido->getTipo();?>
                          <option value="<?= $objPedido->getTipo(); ?>" <?= set_select('tipo',$tipo,$objPedido->tipoIs($tipo)); ?>>

                          <?php echo $titulo_pedido; ?>
          <?php if ($objPedido->getTipo()==ORCAMENTO) { ?>                
          <option value="<?= ORCAMENTO; ?>" <?= set_select('tipo',ORCAMENTO); ?>>COTAÇÃO</option>
          <option value="<?= PEDIDO; ?>" <?= set_select('tipo',PEDIDO); ?>>VENDA</option>
          <?php } ?>
                  
        
         </select>
         </div>

         <div class="campo">
            <label for="nome" class="labelDados">Status</label>

        <select name="status" id="status">
                   <?php $status = $objPedido->getStatus();?>
                          <option value="<?= $objPedido->getStatus(); ?>" <?= set_select('status',$status,$objPedido->statusIs($status)); ?>>
                           <?= $objPedido->printStatus(); ?>
                  <option value="<?= ANDAMENTO; ?>" <?= set_select('status',ANDAMENTO); ?>>ANDAMENTO</option>
                  
                </select>
         </div>



              
            </fieldset>


<fieldset class="grupo">
       
      
     <?php if($objPedido->getStatus()==ANDAMENTO || $objPedido->getStatus()==PROCESSAMENTO){ ?>
  
    <div class="campo">
            <label for="nome" class="labelDados">&nbsp</label>
            <button type="submit" id="edit_pedido_btn" class="btn btn-success">
            <strong><i class="icon-ok-sign icon-white"></i> CONFIRMAR ALTERAÇÕES</strong>
            </button>       
    </div>

     <?php } else{ ?>

  <div class="alert"><strong>Venda Finalizada</strong></div>

     <?php } ?>
  
    <div class="campo">
            <label for="nome" class="labelDados">&nbsp</label>
            <button type="submit" id="add_forma_btn" class="btn fechar_janela">
            <strong><i class="icon-minus-sign icon-white"></i> FECHAR JANELA</strong>
            </button>       
  
    </div>



</form>


</fieldset>
  </div><!-- final body modal -->

  </div>

<!-- ****** FINAL JANELA EDITAR DADOS ORÇAMENTO ****************-->




<!-- JANELA NOVO CLIENTE --> 
  <div id="form-content-novo-cliente" class="modal hide fade in" style="display: none; ">
 
 <form action="" method="post" id="ajax_novo_cliente">

 <!-- CRIAÇÃO DE FLAG PARA PARA SABER SE ORÇAMENTO NOVO, VENDA NOVO -->

<?php 

$flag_tipo_op = '';

//orcamento novo
if($objPedido->getTipo()==ORCAMENTO && $objPedido->getStatus()==ANDAMENTO){
$flag_tipo_op = 1;
}

//venda nova
if($objPedido->getTipo()==PEDIDO && $objPedido->getStatus()==ANDAMENTO){
$flag_tipo_op = 2;
}


?>


 <!-- FINAL -->

          <input type="hidden" name="flag_tipo_op" id="flag_tipo_op" value="<?php echo $flag_tipo_op; ?>">
        
         <input type="hidden" name="id_pedido" value="<?php echo $objPedido->getId_pedido(); ?>">
         
         
          <fieldset>
             <div class="modal-body">

            <fieldset class="grupo">


             
           
        <div class="campo">
        <!-- <label class="labelDados"><span>Pessoa Fisica</span>
          <input type="radio" name="tipo" id="tipo_pf"  value="<?php echo set_value('tipo',PESSOA_FISICA)?>" checked="" required /> 
          </label>
                     
          <label class="labelDados">Pessoa Jurídica:</label> 
          <label><input type="radio" name="tipo" id="tipo_pj" value="<?php echo set_value('tipo',PESSOA_JURIDICA)?>" />
        </label>-->

<span class="labelDados"><input type="radio" name="tipo" id="tipo_pf"  value="<?php echo set_value('tipo',PESSOA_FISICA)?>" checked="" />Pessoa Física</span>
<span class="labelDados"><input type="radio" name="tipo" id="tipo_pj" value="<?php echo set_value('tipo',PESSOA_JURIDICA)?>" />Pessoa Jurídica</span>



        </div>

        </fieldset>

         <fieldset class="grupo">

        <div class="campo">
           
          <label for="nome" class="campo_pj"><span class="labelDados">Nome Fantasia</span> <span class="obrigatorio">*</span></label>
                <label class="campo_pf labelDados" style="display:none;">Nome <span class="obrigatorio">*</span></label>
                <input type="text" class="form-control span4" name="nome_fantasia" id="nome_fantasia" value="<?php echo set_value('nome_fantasia')?>" maxlength="250"/>
          </div>
</fieldset>


<fieldset class="grupo">
        
        <div class="campo">
          
          <label id="camada_cnpj" class="campo_pj labelDados">CNPJ</label>
          <label id="camada_pf" class="labelDados" style="display:none;">CPF</label>
          <input type="text" class="form-control"  name="cnpj_cpf" id="cpfcnpj" value="<?php echo set_value('cnpj_cpf')?>" maxlength="50"/>
        </div>
           


              
            </fieldset>


<fieldset class="grupo">
       
      
     <?php if($objPedido->getStatus()==ANDAMENTO || $objPedido->getStatus()==PROCESSAMENTO){ ?>
  
    <div class="campo">
            <label for="nome" class="labelDados">&nbsp</label>
            <button type="submit" id="add_novo_cliente_btn" class="btn btn-success">
            <strong><i class="icon-ok-sign icon-white"></i>INCLUIR</strong>
            </button>       
    </div>

     <?php } else{ ?>

  <div class="alert"><strong>Venda Finalizada</strong></div>

     <?php } ?>
  
    <div class="campo">
            <label for="nome" class="labelDados">&nbsp</label>
            <button type="submit" id="add_forma_btn" class="btn fechar_janela">
            <strong><i class="icon-minus-sign icon-white"></i> FECHAR JANELA</strong>
            </button>       
  
    </div>



</form>


</fieldset>
  </div><!-- final body modal -->

  </div>

<!-- ****** FINAL JANELA NOVO CLIENTE ****************-->







<!-- JANELA NOVO CLIENTE --> 
  <div id="form-content-incluir-obs" class="modal hide fade in" style="display: none; ">
 
 <form action="" method="post" id="ajax_incluir_obs">

 <!-- CRIAÇÃO DE FLAG PARA PARA SABER SE ORÇAMENTO NOVO, VENDA NOVO -->

<?php 

$flag_tipo_op = '';

//orcamento novo
if($objPedido->getTipo()==ORCAMENTO && $objPedido->getStatus()==ANDAMENTO){
$flag_tipo_op = 1;
}

//venda nova
if($objPedido->getTipo()==PEDIDO && $objPedido->getStatus()==ANDAMENTO){
$flag_tipo_op = 2;
}


?>


 <!-- FINAL -->

          <input type="hidden" name="flag_tipo_op" id="flag_tipo_op" value="<?php echo $flag_tipo_op; ?>">
        
         <input type="hidden" name="id_pedido" value="<?php echo $objPedido->getId_pedido(); ?>">
         
         
          <fieldset>
             <div class="modal-body">


         <fieldset class="grupo">

        <div class="campo">
           
          <label for="nome"><span class="labelDados">Anotações Gerais</span></label>
              
                <textarea style="width:500px;" rows="" name="observacao" cols="5"><?php echo $objPedido->getObservacao(); ?> </textarea>
          </div>
          
         
</fieldset>

<h4>Dados para entrega</h4>
<hr />

 <fieldset class="grupo">

         
        <div class="campo">
          <label for="nome"><span class="labelDados">Endereço</span></label>
          <input type="text" class="span6" name="endereco_entrega" id="data_final" value="<?php echo $objPedido->getEndereco_entrega(); ?>">
        </div>

         <div class="campo">
          <label for="nome"><span class="labelDados">Ponto Referência</span></label>
          <input type="text" class="span5" name="ponto_entrega" id="data_final" value="<?php echo $objPedido->getPonto_entrega(); ?>">
        </div>

        <div class="campo">
          <label for="nome"><span class="labelDados">Estado</span></label>
          <select class="form-control" name="estado_entrega" id="estado_entrega">
            <option value="<?php echo $objPedido->getEstado_entrega(); ?>">
              <?php echo $objPedido->getEstado_entrega(); ?>
            </option>
                     
                      <option value="AC">AC</option>
                      <option value="AL">AL</option>
                      <option value="AM">AM</option>
                      <option value="AP">AP</option>
                      <option value="BA">BA</option>
                      <option value="CE">CE</option>
                      <option value="DF">DF</option>
                      <option value="ES">ES</option>
                      <option value="GO">GO</option>
                      <option value="MA">MA</option>
                      <option value="MG">MG</option>
                      <option value="MS">MS</option>
                      <option value="MT">MT</option>
                      <option value="PA">PA</option>
                      <option value="PB">PB</option>
                      <option value="PE">PE</option>
                      <option value="PI">PI</option>
                      <option value="PR">PR</option>
                      <option value="RJ">RJ</option>
                      <option value="RN">RN</option>
                      <option value="RS">RS</option>
                      <option value="RO">RO</option>
                      <option value="RR">RR</option>
                      <option value="SC">SC</option>
                      <option value="SE">SE</option>
                      <option value="SP">SP</option>
                      <option value="TO">TO</option>

                    </select>
        </div>

         <div class="campo">
          <label for="nome"><span class="labelDados">Cidade</span></label>
          <input type="text" name="cidade_entrega" id="data_final" value="<?php echo $objPedido->getCidade_entrega(); ?>">
        </div>

         <div class="campo">
          <label for="nome"><span class="labelDados">CEP</span></label>
          <input type="text" name="cep_entrega" id="cep_final" value="<?php echo $objPedido->getCep_entrega(); ?>">
        </div>

         <div class="campo">
           
          <label for="nome"><span class="labelDados">Data de Entrega</span></label>
          <input type="text" class="calendario" name="data_final" id="data_final" value="<?php echo $objDateFormat->date_format($objPedido->getData_final()); ?>">
        </div>


       




</fieldset>




<fieldset class="grupo">
       
      
     <?php //if($objPedido->getStatus()==ANDAMENTO || $objPedido->getStatus()==PROCESSAMENTO){ ?>
  
    <div class="campo">
            <label for="nome" class="labelDados">&nbsp</label>
            <button type="submit" id="add_incluir_obs" class="btn btn-success">
            <strong><i class="icon-ok-sign icon-white"></i>INCLUIR</strong>
            </button>       
    </div>

     <?php //} else{ ?>

  <!--<div class="alert"><strong>Venda Finalizada</strong></div>-->

     <?php //} ?>
  
    <div class="campo">
            <label for="nome" class="labelDados">&nbsp</label>
            <button type="submit" class="btn fechar_janela">
            <strong><i class="icon-minus-sign icon-white"></i> FECHAR JANELA</strong>
            </button>       
  
    </div>



</form>


</fieldset>
  </div><!-- final body modal -->

  </div>

<!-- ****** FINAL JANELA OBSERVACAO ****************-->







<!-- JANELA BUSCAR CLIENTE --> 
  <div id="form-content-buscar-cliente" class="modal hide fade in" style="display: none; ">
 
 <form action="" method="post" id="ajax_buscar_cliente">

 <!-- CRIAÇÃO DE FLAG PARA PARA SABER SE ORÇAMENTO NOVO, VENDA NOVO -->

<?php 

$flag_tipo_op = '';

//orcamento novo
if($objPedido->getTipo()==ORCAMENTO && $objPedido->getStatus()==ANDAMENTO){
$flag_tipo_op = 1;
}

//venda nova
if($objPedido->getTipo()==PEDIDO && $objPedido->getStatus()==ANDAMENTO){
$flag_tipo_op = 2;
}


?>


 <!-- FINAL -->

          <input type="hidden" name="flag_tipo_op" id="flag_tipo_op" value="<?php echo $flag_tipo_op; ?>">
        
         <input type="hidden" name="id_pedido" value="<?php echo $objPedido->getId_pedido(); ?>">
         
         
          <fieldset>
             <div class="modal-body">

            <fieldset class="grupo">


             
      

        </fieldset>

        <!-- <fieldset class="grupo">

        <div class="campo">
           
          <label for="nome" class="campo_pj"><span class="labelDados">Nome Fantasia</span> <span class="obrigatorio">*</span></label>
                <label class="campo_pf labelDados" style="display:none;">Nome <span class="obrigatorio">*</span></label>
                <input type="text" class="form-control span4" name="nome_fantasia" id="nome_fantasia" value="<?php echo set_value('nome_fantasia')?>" maxlength="250"/>
          </div>
</fieldset>-->


<fieldset class="grupo">
        
        <div class="campo">
          
          <label class="labelDados">CNPJ OU CPF</label>
          <input type="text" class="form-control"  name="cnpj_cpf" id="cpfcnpjBusca" value="<?php echo set_value('cnpj_cpf')?>" maxlength="50"/>
        </div>
           


              
            </fieldset>


<fieldset class="grupo">
       
      
     <?php if($objPedido->getStatus()==ANDAMENTO || $objPedido->getStatus()==PROCESSAMENTO){ ?>
  
    <div class="campo">
            <label for="nome" class="labelDados">&nbsp</label>
            <button type="submit" id="buscar_cliente_btn" class="btn btn-success">
            <strong><i class="icon-ok-sign icon-white"></i>PESQUISAR</strong>
            </button>       
    </div>

     <?php } else{ ?>

  <div class="alert"><strong>Venda Finalizada</strong></div>

     <?php } ?>
  
    <div class="campo">
            <label for="nome" class="labelDados">&nbsp</label>
            <button type="submit" id="add_forma_btn" class="btn fechar_janela">
            <strong><i class="icon-minus-sign icon-white"></i> FECHAR JANELA</strong>
            </button>       
  
    </div>



</form>


</fieldset>
  </div><!-- final body modal -->

  </div>

<!-- ****** FINAL JANELA NOVO CLIENTE ****************-->








 <!-- MODAL EXCLUSÃO DE ITENS -->
 <div id="myModal" class="modal hide">
    <div class="modal-header">
        <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
         <h3>Excluir Item</h3>
    </div>
    <div class="modal-body">
        
        <h3 style="color:red;">Deseja realmente excluir o item ?</h3>
    </div>
    <div class="modal-footer">
      <a href="#" id="btnYes" class="btn btn-danger"><i class="icon-remove icon-white"></i> Confirmar exclusão</a>
      <a href="#" data-dismiss="modal" aria-hidden="true" class="btn secondary">Cancelar</a>
    </div>
  </div> <!-- /widget-content -->

<!-- FINAL MODAL EXCLUSÃO DE ITENS -->



 <!-- MODAL SUCESSO VENDA -->
 <div id="myModalSucesso" class="modal hide">
    <div class="modal-header">
        <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
         <h3>Confirmação de Venda</h3>
    </div>
    <div class="modal-body">
    <button type="submit" class="btn btn-default" name="btn-login" id="btn-carregar">

        
        <h3 style="color:green;">Venda Realizada com Sucesso ?</h3>
    </div>
    
  </div> <!-- /widget-content -->

<!-- FINAL SUCESSO VENDA -->

   



    
    
<div class="footer">
<div class="container">
			
			<div class="row">

  <fieldset class="grupo">




                 <input type="hidden" disabled="" class="span2 total_mostrar_rodape campoItens" id="total_pedido" value="<?php echo set_value('total_pedido',number_format($total, 2, ',', ''))?>">
          
					      <div class="campo">
					        <label for="nome" class="titulo_rodape">Outras Despesas</label>
					        <input style="font-family: sans-serif;" type="text" tipo="moneyReal" name="taxa_frete" id="taxa_entrega" value="<?php echo set_value('taxa_frete',number_format($objPedido->getTaxa_frete(), 2, ',', ''))?>" class="span2 tamanho_campo">
					      </div>

					       <div class="campo">
					        <label for="nome" class="titulo_rodape">Desconto</label>
					        <input type="text" style="font-family: sans-serif;" tipo="moneyReal" name="desconto" id="desconto" class="span2 tamanho_campo" value="<?php echo set_value('desconto',number_format($objPedido->getDesconto(), 2, ',', ''))?>">
					      </div>

					       <div class="campo">
					        <label for="nome" class="titulo_rodape">Valor Pago</label>
					        <input type="text" style="font-family: sans-serif;" name="valor_pago" tipo="moneyReal" class="span2 tamanho_campo" id="valor_pago" value="<?php echo set_value('taxa_frete','0,00')?>">
					      </div>

                 <div class="campo">
                  <label for="nome" class="titulo_rodape">Troco</label>
                  <input type="text" style="font-family: sans-serif;" readonly="" name="troco" id="troco" class="span2 tamanho_campo">
                </div>

			
     <?php if( ($objPedido->getTipo()==PEDIDO) && ($objPedido->getStatus()==ANDAMENTO || $objPedido->getStatus()==PROCESSAMENTO)) { ?>
      <div class="campo">
         <label for="nome" class="titulo_rodape">Forma de Pagamento</label>
           <button <?php if(count($listItens)==0) {echo "disabled"; } ?> class="btn btn-success" style="height:50px;font-family: sans-serif;" data-toggle="modal" href="#form-content-dinheiro" id="incluir_forma_dinheiro">
           <strong><i class="icon-ok-sign icon-white"></i> DINHEIRO</strong>
        </button>

           <button <?php if(count($listItens)==0) {echo "disabled"; } ?> class="btn btn-success" style="height:50px;font-family: sans-serif;" data-toggle="modal" href="#form-content" id="incluir_forma">
         <strong><i class="icon-plus-sign icon-white"></i> OUTRAS</strong>
        </button>
      </div>
      <?php } ?>

        <?php if($objPedido->getTipo()==ORCAMENTO){ ?>
      <div class="campo">
         <label for="nome" class="titulo_rodape">&nbsp</label>
           <button class="btn btn-primary" style="height:50px;font-family: sans-serif;" data-toggle="modal" href="#form-content-orc-fechar" id="orcamento_fechar">
           <strong><i class="icon-ok-sign icon-white"></i> SALVAR COTAÇÃO</strong>
        </button>

         
      </div>
      <?php } ?>





       <div class="campo">
              <label for="nome" class="labelDados" style="font-size:16px;"><i class="icon-money"></i> TOTAL:</label>
                     
                              
                <div style="background-color:green; height:30px; color:#fff; font-size:28px; font-weight:900; padding:10px;">
                 R$ <span id="total_lado_item"></span> <span class="term"></span>
                </div>
              
        </div>

     
     <!--<div class="campo">
       <label for="nome" class="labelDados">&nbsp</label>
        <button class="btn btn-success" style="height:50px;" data-toggle="modal" href="#form-content" id="incluir_forma">
         <strong><i class="icon-ok icon-white"></i> OUTRAS.</strong>
        </button>
         
      </div>-->


					      </fieldset>

					      </div>
					      
					      


					      </div>
	
	
	
</div> <!-- /footer -->
    


</body>

</html>


<script type="text/javascript" src="<?php echo base_url(); ?>js/text_numero.js"></script>

<script src="<?= base_url() ?>caixa/js/jquery-1.7.2.min.js"></script>
<script src="<?= base_url() ?>caixa/js/bootstrap.js"></script>
<script src="<?= base_url() ?>caixa/js/base.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js/jquery-maskMoney.js"></script> <!--Jquery ... -->
<script type="text/javascript" src="<?= base_url() ?>js/jquery.magicforms-b1.0.js"></script> <!--Leonardo simas e Weslley leandro -->
<script type="text/javascript" src="<?= base_url() ?>js/select.maskgrupo.myconfig.js"></script> <!--Leonardo simas e Weslley leandro -->
<script type="text/javascript" src="<?= base_url() ?>js/jquery-ui-1.9.1.custom.min.js"></script> <!--Jquery Padrao-->
<script type="text/javascript" src="<?= base_url() ?>js/jquery.ui.datepicker-pt-BR.js"></script> <!--Jquery Padrao-->
<script src="<?= base_url() ?>js/jquery_plugin_cpfcnpj.js"></script> 



<script type="text/javascript">
    
$(function () {
 //****** INICIO JQUERY ***********************

  $(".calendario").datepicker();


   //NOVO CLIENTE JS
   $("#camada_pf").show();
   $("#camada_cnpj").hide();
   $("#camada_razao").hide();
   $(".campo_pf").show();
   $(".campo_pj").hide();

   $("#tipo_pf").click(function(){
    
   $("#camada_pf").show();
   $("#camada_cnpj").hide();
   $("#camada_razao").hide();
   $(".campo_pf").show();
   $(".campo_pj").hide();
    

                
   });

   $("#tipo_pj").click(function(){
    
    $("#camada_pf").hide();
    $("#camada_cnpj").show();
    $("#camada_razao").show();
    $(".campo_pf").hide();
    $(".campo_pj").show();
     
               
   });

   $("#cpfcnpj").keydown(function(){

    try {
      $("#cpfcnpj").unmask();
    } catch (e) {}
    
    var tamanho = $("#cpfcnpj").val().length;
  
    if(tamanho < 11){
        $("#cpfcnpj").mask("999.999.999-99");
    } else if(tamanho >= 11){
        $("#cpfcnpj").mask("99.999.999/9999-99");
    }                   
});
//FINAL NOVO CLIENTE JS

$("#cpfcnpjBusca").keydown(function(){

    try {
      $("#cpfcnpjBusca").unmask();
    } catch (e) {}
    
    var tamanho = $("#cpfcnpjBusca").val().length;
  
    if(tamanho < 11){
        $("#cpfcnpjBusca").mask("999.999.999-99");
    } else if(tamanho >= 11){
        $("#cpfcnpjBusca").mask("99.999.999/9999-99");
    }                   
});


//FUNÇÃO PARA AJUDAR NA FORMATAÇÃO DA MOEDA
function moedaParaNumero(valor)
{
    return isNaN(valor) == false ? parseFloat(valor) :   parseFloat(valor.replace("R$","").replace(".","").replace(",","."));
}

  //VALORES DO PEDIDO NA PARTE DO RODAPE
  /*var total_pedido = parseFloat($('#total_pedido').val().replace(",", "."));
  var desconto = parseFloat($('#desconto').val().replace(",", "."));
  var taxa_entrega = parseFloat($('#taxa_entrega').val().replace(",", "."))
  var total_pagar_pedido = (total_pedido + taxa_entrega ) - desconto;*/
  
  var total_pedido = moedaParaNumero($('#total_pedido').val());
  var desconto = moedaParaNumero($('#desconto').val());
  var taxa_entrega = moedaParaNumero($('#taxa_entrega').val());
  var total_pagar_pedido = (total_pedido + taxa_entrega ) - desconto; 
      

  
   $('.botao_total_pedido').text("TOTAL PEDIDO = R$: "+total_pagar_pedido.toFixed(2).replace(".", ","));
   $("input:text[name=total_pagar]").val(total_pagar_pedido);
   $('.total_mostrar').text(total_pagar_pedido);
   $('#total_lado_item').text(total_pagar_pedido.toFixed(2).replace(".", ","));
   $("input:text[name=valor_pago_forma]").val(total_pagar_pedido.toFixed(2).replace(".", ","));
   $("#total_topo").val(total_pagar_pedido.toFixed(2).replace(".", ","));

   $(".desconto_flag").val(desconto.toFixed(2).replace(".", ","));
   $(".taxa_flag").val(taxa_entrega.toFixed(2).replace(".", ","));
   $(".total_pedido_flag").val(total_pedido.toFixed(2).replace(".", ","));
   $(".total_topo").val(total_pagar_pedido.toFixed(2).replace(".", ","));
  
     
  
   //FINAL VALORES RODAPE

  







   //NICIO CÁLCULOS AO DIGITAR NOS VALORES DO RODAPÉ



   //OUTRAS DESPESAS AO DIGITAR

   //CALCULO DIGITANDO EM TAXA DE ENTREGA
  $("#taxa_entrega").keyup(function(){
   
      var total_pedido = moedaParaNumero($('#total_pedido').val());
      var desconto = moedaParaNumero($('#desconto').val());
      var taxa_entrega = moedaParaNumero($('#taxa_entrega').val());
      var total_pagar = (total_pedido + taxa_entrega ) - desconto; 
      
     if(isNaN(desconto)){
      desconto = 0;
     }
 
     var resultado = total_pagar.toFixed(2).replace(".", ",");
    // var valor_pago = parseFloat($('#valor_pago').val().replace(",", "."));
      var valor_pago = parseFloat($('#valor_pago').val().replace(".", ","));
     var troco = valor_pago - total_pagar;

    if(valor_pago>0){
      $("input:text[name=troco]").val(troco.toFixed(2).replace(".", ","));
    }
     //final troco
     

     $("input:text[name=total_pagar]").val(resultado);
     $('.total_mostrar').text(resultado);
     $('#total_lado_item').text(resultado);
     $("input:text[name=valor_pago_forma]").val(total_pagar);
     $("#total_topo").val(total_pagar.toFixed(2).replace(".", ","));

     $(".desconto_flag").val(desconto.toFixed(2).replace(".", ","));
     $(".taxa_flag").val(taxa_entrega.toFixed(2).replace(".", ","));
     
     $(".total_pedido_flag").val(total_pedido.toFixed(2).replace(".", ","));
     $(".total_topo").val(total_pagar.toFixed(2).replace(".", ","));
     $('.botao_total_pedido').text("TOTAL PEDIDO = R$: "+total_pagar.toFixed(2).replace(".", ","));
     $('.botao_total_saldo').text("SALDO = R$: "+total_pagar.toFixed(2).replace(".", ","));


  
  
  
  
     return false;

});
   //FINAL OUTRAS DESPESAS



 //CALCULO DESCONTO
  $("#desconto").keyup(function(){
   
      var total_pedido = moedaParaNumero($('#total_pedido').val());
      var desconto = moedaParaNumero($('#desconto').val());
      var taxa_entrega = moedaParaNumero($('#taxa_entrega').val());
     
      var total_pagar = (total_pedido + taxa_entrega ) - desconto; 
      
     if(isNaN(taxa_entrega)){
      taxa_entrega = 0;
     }
 
     var resultado = total_pagar.toFixed(2).replace(".", ",");
    // var valor_pago = parseFloat($('#valor_pago').val().replace(",", "."));
      var valor_pago = parseFloat($('#valor_pago').val().replace(".", ","));
     var troco = valor_pago - total_pagar;

    if(valor_pago>0){
      $("input:text[name=troco]").val(troco.toFixed(2).replace(".", ","));
    }
     //final troco
     

     $("input:text[name=total_pagar]").val(resultado);
     $('.total_mostrar').text(resultado);
     $('#total_lado_item').text(resultado);
     $("input:text[name=valor_pago_forma]").val(total_pagar.toFixed(2).replace(".", ","));
     $("#total_topo").val(total_pagar.toFixed(2).replace(".", ","));

     $(".desconto_flag").val(desconto.toFixed(2).replace(".", ","));
     $(".taxa_flag").val(taxa_entrega.toFixed(2).replace(".", ","));
     $(".total_pedido_flag").val(total_pedido.toFixed(2).replace(".", ","));
     $(".total_topo").val(total_pagar.toFixed(2).replace(".", ","));
     $('.botao_total_pedido').text("TOTAL PEDIDO = R$: "+total_pagar.toFixed(2).replace(".", ","));
     $('.botao_total_saldo').text("SALDO = R$: "+total_pagar.toFixed(2).replace(".", ","));


    

  
   
   
  
     return false;

});
   //FINAL DESCONTO



//VALOR PAGO
  $("#valor_pago").keyup(function(){
   
      var total_pedido = moedaParaNumero($('#total_pedido').val());
      var desconto = moedaParaNumero($('#desconto').val());
      var taxa_entrega = moedaParaNumero($('#taxa_entrega').val());
      var valor_pago = moedaParaNumero($('#valor_pago').val());
     
      var total_pagar = (total_pedido + taxa_entrega ) - desconto; 
      var troco = valor_pago - total_pagar;
      
     if(isNaN(taxa_entrega)){
      taxa_entrega = 0;
     }
 
     //var resultado = total_pagar.toFixed(2).replace(".", ",");
   
      //var valor_pago = parseFloat($('#valor_pago').val().replace(".", ","));
     var troco = valor_pago - total_pagar;

    if(troco>0){
      $("input:text[name=troco]").val(troco.toFixed(2).replace(".", ","));
    }else{
      $("input:text[name=troco]").val(0);
    }
     //final troco
     

     $("input:text[name=total_pagar]").val(resultado);
     $('.total_mostrar').text(resultado);
     $('#total_lado_item').text(resultado);
     
     $(".desconto_flag").val(desconto.toFixed(2).replace(".", ","));
     $(".taxa_flag").val(taxa_entrega.toFixed(2).replace(".", ","));
         
     $(".total_pedido_flag").val(total_pedido.toFixed(2).replace(".", ","));
     $(".total_topo").val(total_pagar.toFixed(2).replace(".", ","));
     $('.botao_total_pedido').text("TOTAL PEDIDO = R$: "+total_pagar.toFixed(2).replace(".", ","));


  
     return false;

});
   //FINAL DESCONTO


              var url_fat = '<?= site_url("/pedidos/ajax_listar_faturamento/"); ?>/'+$('#id_pedido').val();
              $.getJSON(url_fat, function(j){

              //var options = '';
              //options += '<option value="">Nenhum...</option>';
              
              var html = '';
              var total_pago = 0;
              var rowCount = 0;

              for (var i = 0; i < j.length; i++) {
              total_pago = parseFloat(total_pago) + parseFloat(j[i].valor);
               rowCount++;
              //options += '<option value="' + j[i].id_bandeira + '">' + j[i].bandeira + '</option>';
              

               html+= '<tr><td>'+j[i].forma+'</td><td>'+j[i].valor+'</td><td>'+j[i].parcela+'</td><td class=td-actions><a href="#" id="excluir_fat" class="confirm-delete-teste btn btn-danger btn-small" data-id='+ j[i].id_forma_fat +'><i class="btn-icon-only icon-remove"></i>Excluir</a></td></tr>';

                 //$('#tabela_forma_pagamento > tbody:last').append(html);


              }

              if(rowCount > 0){
                 $("#camada_confirmar").show();
               } 

              $("#tabela_forma_pagamento > tbody:last").html(html);
              $("input:text[name=total_pago_forma]").val(total_pago);
              $("#total_pago_topo").val(total_pago);
              
              $('.botao_total_pago').text("TOTAL PAGO = R$: "+total_pago.toFixed(2).replace(".", ","));

              var saldo = 0;
              saldo = total_pagar_pedido - total_pago;
              $('.botao_total_saldo').text("SALDO = R$: "+saldo.toFixed(2).replace(".", ","));


  
            });





   //********** INCLUIR FORMA DE PAGAMENTO LISTAGEM AJAX
$('#add_forma_btn').click(function(e){

  //VALIDAÇÕES

    //VALIDAÇÕES DOS CAMPOS DE FORMAS DE PAGAMENTOS
          if($('#id_forma').val()==""){
            alert('Campo Forma de Pagamento Vazio.');
           return false;
          }

          if($('#qtd_parcela_pag').val()==""){
            alert('Campo Parcela Vazio.');
           return false;
          }

          if($('#id_operadora').val()!="" && $('#id_bandeira').val()=="" ){
            alert('Campo Bandeira Vazio.');
           return false;
          }


  //FINAL VALIDAÇÕES

  e.preventDefault();

         $.ajax({
             
             type: 'POST',
             url: "<?php echo site_url('pedidos/add_forma_pagamento/'); ?>",         
             data: $('#ajax_forma_pagamento').serialize(),
             success : function(txt){

             //BUSCA O FATURAMENTO PO PEDIDO PARA EXIBIÇÃO NA LISTAGEM


              var url_fat = '<?= site_url("/pedidos/ajax_listar_faturamento/"); ?>/'+$('#id_pedido').val();
              $.getJSON(url_fat, function(j){

              //var options = '';
              //options += '<option value="">Nenhum...</option>';
              
              var html = '';
              var total_pago = 0;

              for (var i = 0; i < j.length; i++) {
              total_pago = parseFloat(total_pago) + parseFloat(j[i].valor);

              //options += '<option value="' + j[i].id_bandeira + '">' + j[i].bandeira + '</option>';
              

               html+= '<tr><td>'+j[i].forma+'</td><td>'+j[i].valor+'</td><td>'+j[i].parcela+'</td><td class=td-actions><a href="#" class="confirm-delete-teste btn btn-danger btn-small" data-id='+ j[i].id_forma_fat +'><i class="btn-icon-only icon-remove"></i>Excluir</a></td></tr>';

                 //$('#tabela_forma_pagamento > tbody:last').append(html);

              } 

              $("#valor_pago_forma").val("");
              $("#tabela_forma_pagamento > tbody:last").html(html);
             
              $("input:text[name=total_pago_forma]").val(total_pago);
              $("#total_pago_topo").val(total_pago);
              //$("#camada_confirmar").show();
              $('.botao_total_pago').text("TOTAL PAGO = R$: "+total_pago.toFixed(2).replace(".", ","));

              var saldo = 0;
              //saldo = total_pagar_pedido - total_pago;
              //$('.botao_total_saldo').text("SALDO = R$: "+saldo.toFixed(2).replace(".", ","));
             
               var total_pedido = moedaParaNumero($('#total_pedido').val());
               var desconto = moedaParaNumero($('#desconto').val());
               var taxa_entrega = moedaParaNumero($('#taxa_entrega').val());
     
               var total_pagar = (total_pedido + taxa_entrega ) - desconto; 

               saldo = total_pagar - total_pago;
          
               $('.botao_total_saldo').text("SALDO = R$: "+saldo.toFixed(2).replace(".", ","));

               if(total_pago==total_pagar){
                  $("#camada_confirmar").show();
               }

            });

             

        },

        error: function (request, status, error) {
        alert(request.responseText);
         }
             
         });

         return false





}); //final click


//********** FINAL INCLUSÃO FORMA DE PAGAMENTO AJAX



//************** CONFIRMAR PAGAMENTO A VISTA











   //************FINAL CÁLCULOS



   //***********EXCLUSÃO ITENS

   $('#myModal').on('show', function() {
    var id = $(this).data('id'),
        removeBtn = $(this).find('.danger');
});

$('.confirm-delete').on('click', function(e) {
    e.preventDefault();

    var id = $(this).data('id');
    $('#myModal').data('id', id).modal('show');
});

$('#btnYes').click(function() {
    // handle deletion here
    var id = $('#myModal').data('id');
    var id_pedido = $('#id_pedido').val();
    $('[data-id='+id+']').remove();
    $('#myModal').modal('hide');
    location.href="<?php echo site_url('pedidos/excluir_item'); ?>/"+id+"/"+id_pedido;
    
});

   //**********FINAL EXCLUSÃO ITENS

//************LISTAR FORMA DE PAGAMENTO
$('#operadora_camada').hide();
$('#bandeira_camada').hide();
$('#camada_qtd_parcela').hide();
$('#qtd_parcela_pag').val('1');


 var url = '<?= site_url("/formas_recebimentos/ajax_listar/"); ?>/';
          $.getJSON(url, function(j){
                
           var flag = "";
            var options = '<option value="">Selecione...</option>'; 
              for (var i = 0; i < j.length; i++) {
                options += '<option value="' + j[i].id_forma + '">' + j[i].forma + '</option>';
                flag = j[i].cartao;
              } 
           
             $('#id_forma').html(options).show();
                       
             /*if(j.length>0){
              $('#operadora_camada').show();
             }else{
                $('#operadora_camada').hide();
             }*/

             $('.carregando').hide();
          });
//************FINAL FORMA DE PAGAMENTO




//AO CLICAR NO SELECT DO MODAL EM FORMA DE PAGAMENTO

 $('#camada_data_vencimento').hide();
$('#id_forma').change(function(){

    var forma_dinheiro = "<?php echo FORMA_REC_DINHEIRO; ?>";

    if( $(this).val() ) {
        
        /*if( $(this).val()==forma_dinheiro){
           $('#camada_qtd_parcela').hide();
           $('#qtd_parcela_pag').val('1');
        }
        else{
          $('#camada_qtd_parcela').show();
        }*/

        $('#camada_qtd_parcela').show();


      
          
          $('.carregando').show();
          var url = '<?= site_url("/formas_recebimentos/exibir_parcela/"); ?>/'+$(this).val();
          $.getJSON(url, function(j){
                   
            
            //var options = '<option value="">Nenhum...</option>'; 
            var options ='';
              for (var i = 0; i < j.length; i++) {
                  
                  //Exibir campo data de vencimento manual no lançamento
                  if(j[i].data_vencimento_manual==1){
                       $('#camada_data_vencimento').show();
                    // alert('manual');
                  }else{
                    //alert('nao manual');
                      $('#camada_data_vencimento').hide();
                  }

                for(var x=1;x <= j[i].maximo_parcela;x++){
                  options += '<option value="' + x + '">' + x + '</option>';
                 }
              } 

             $('#qtd_parcela_select').html(options).show();
             
            
            /* if(j.length>0){
              $('#operadora_camada').show();
             }else{
                $('#operadora_camada').hide();
             }*/

             $('.carregando').hide();
          });






          //BANDEIRA
 $('#id_operadora').change(function(){
       
   $('#bandeira_camada').show();
   var url = '<?= site_url("/bandeira_cartao/listarPorOperadora/"); ?>/'+$(this).val();
   $.getJSON(url, function(j){
                             
      var options = '';
       options += '<option value="">Nenhum...</option>';
       for (var i = 0; i < j.length; i++) {
          options += '<option value="' + j[i].id_bandeira + '">' + j[i].bandeira + '</option>';
        } 
       
       
       $('#id_bandeira').html(options).show();
       
    });
});
//FINAL BANDEIRA

       //***********FINAL VERIFICAÇÃO



      } //FINAL VAL

  
  }); //FINAL SELEÇÃO DE FORMA DE PAGAMENTO
//FINAL CLICAR NA FORMA DE PAGAMENTO



  

//********** INCLUIR FORMA DE PAGAMENTO LISTAGEM AJAX
$('#add_forma_dinheiro_btn').click(function(e){


    e.preventDefault();

     $.ajax({
             type: 'POST',
             url: "<?php echo site_url('pedidos/finalizar_pedido_dinheiro/'); ?>",         
             data: $('#ajax_forma_dinheiro').serialize(),
             success : function(txt){
              var id_pedido = $('#id_pedido').val();
              var escopo = $('#escopo').val();

              //alert('VENDA FINALIZADA!');
              $('#form-content-dinheiro').modal('hide');
              $('#myModalSucesso').modal('show');
               $("#btn-carregar").html('<img src="<?= base_url(); ?>caixa/img/ajax-loader.gif" /> &nbsp; Salvando ...');

              if(escopo==1){ //caso seja pedido pelo estoque
              setTimeout('window.location.href = "<?php echo site_url('pedidos/solicitar_cliente/2'); ?>"; window.opener.location.href="<?php echo site_url('pedidos/filtro/2'); ?>"' , 3000);
              }else { //caso seja pedido manualmente
                setTimeout('window.location.href = "<?php echo site_url('pedidos/solicitar_cliente2/2'); ?>"; window.opener.location.href="<?php echo site_url('pedidos/filtro/2'); ?>"' , 3000);
              }
              
              //window.location.href="<?php echo site_url('pedidos/solicitar_cliente/2'); ?>";
              //window.opener.location.href="<?php echo site_url('pedidos/filtro/2'); ?>";
              //window.close();
              
        },
        error: function (request, status, error) {
              alert(request.responseText);
              //alert('VENDA NÃO REALIZADA!');
              //window.back();
         }
             
         });

         return false;

}); //final click btn dinheiro


//************* FINAL CONFIRMAÇÃO PAGAMENTO A VISTA




//********** INCLUIR FORMA DE PAGAMENTO LISTAGEM AJAX
$('#add_forma_mult_btn').click(function(e){


    e.preventDefault();

     $.ajax({
             type: 'POST',
             url: "<?php echo site_url('pedidos/finalizar_pedido_multipla/'); ?>",         
             data: $('#ajax_forma_multipla').serialize(),
             success : function(txt){
              var id_pedido = $('#id_pedido').val();
              var escopo = $('#escopo').val();

              //alert('VENDA FINALIZADA!');
              $('#form-content').modal('hide');
              $('#myModalSucesso').modal('show');
               $("#btn-carregar").html('<img src="<?= base_url(); ?>caixa/img/ajax-loader.gif" /> &nbsp; Salvando ...');

              if(escopo==1){
              setTimeout('window.location.href = "<?php echo site_url('pedidos/solicitar_cliente/2'); ?>"; window.opener.location.href="<?php echo site_url('pedidos/filtro/2'); ?>"' , 3000);
              }else{
                setTimeout('window.location.href = "<?php echo site_url('pedidos/solicitar_cliente2/2'); ?>"; window.opener.location.href="<?php echo site_url('pedidos/filtro/2'); ?>"' , 3000);
              }

              //window.location.href="<?php echo site_url('pedidos/solicitar_cliente/2'); ?>";
              //window.opener.location.href="<?php echo site_url('pedidos/filtro/2'); ?>";
              //window.close();
              
        },
        error: function (request, status, error) {
              alert(request.responseText);
              //alert('VENDA NÃO REALIZADA!');
              //window.back();
         }
             
         });

         return false;

}); //final click btn dinheiro


//************* FINAL CONFIRMAÇÃO PAGAMENTO A VISTA





//**** FECHAR JANELA PAGAMENTO

  $('.fechar_janela').click(function(e){
        
                                  
  
      e.preventDefault();
       $("#form-content-dinheiro").modal('hide');
       $("#form-content-alt-pedido").modal('hide');
        $("#form-content-novo-cliente").modal('hide');
         $("#form-content-incluir-obs").modal('hide');
         $("#form-content-buscar-cliente").modal('hide');
       $("#form-content").modal('hide');  

  });

//**** FINAL FECHAR PAGAMENTO 


//**** ABRIR BUSCAR CLIENTE

  $('#modal_buscar_cliente').click(function(e){
        
      e.preventDefault();
       $("#form-content-buscar-cliente").modal('show');  

  });

//**** FINAL ALTERAÇÃO DADOS



//**** ABRIR NOVO CLIENTE

  $('#modal_novo_cliente').click(function(e){
        
      e.preventDefault();
       $("#form-content-novo-cliente").modal('show');  

  });

//**** FINAL ALTERAÇÃO DADOS


//**** ABRIR NOVO CLIENTE

  $('#modal_incluir_obs').click(function(e){
        
      e.preventDefault();
       $("#form-content-incluir-obs").modal('show');  

  });

//**** FINAL ALTERAÇÃO DADOS




//**** ABRIR JANELA ALTERAR DADOS PEDIDO

  $('#modal_alterar_pedido').click(function(e){
        
      e.preventDefault();
       $("#form-content-alt-pedido").modal('show');  

  });

//**** FINAL ALTERAÇÃO DADOS




//********** INCLUIR FORMA DE PAGAMENTO LISTAGEM AJAX
$('#excluir_fat').click(function(e){

    alert('teste');
    //e.preventDefault();



   
}); //final click btn dinheiro



$(document).on('click', '.confirm-delete-teste', function(e) {
    
    e.preventDefault();
   
    var id = $(this).data('id');
    var id_pedido = $('#id_pedido').val(); 
    //alert(id);
    //$('#id_pedido').val()

             var url_fat = '<?= site_url("/pedidos/excluir_faturamento/"); ?>/'+id+'/'+id_pedido;
             $.getJSON(url_fat, function(j){

              //var options = '';
              //options += '<option value="">Nenhum...</option>';
              
              var html = '';
              var total_pago = 0;
                var rowCount = 0;

              for (var i = 0; i < j.length; i++) {
                rowCount++;
                total_pago = parseFloat(total_pago) + parseFloat(j[i].valor);

              //options += '<option value="' + j[i].id_bandeira + '">' + j[i].bandeira + '</option>';
              

               html+= '<tr><td>'+j[i].forma+'</td><td>'+j[i].valor+'</td><td>'+j[i].parcela+'</td><td class=td-actions><a href="#" class="confirm-delete-teste btn btn-danger btn-small" data-id='+ j[i].id_forma_fat +'><i class="btn-icon-only icon-remove"></i>Excluir</a></td></tr>';

                 //$('#tabela_forma_pagamento > tbody:last').append(html);

              } 

              $("#tabela_forma_pagamento > tbody:last").html(html);
              $("input:text[name=total_pago_forma]").val(total_pago);
              $("#total_pago_topo").val(total_pago);
              
              //if(rowCount==0){
                $("#camada_confirmar").hide();
              //}
              
              $('.botao_total_pago').text("TOTAL PAGO = R$: "+total_pago.toFixed(2).replace(".", ","));

              //var saldo = 0;
              //saldo = total_pagar_pedido - total_pago;
              //$('.botao_total_saldo').text("SALDO = R$: "+saldo.toFixed(2).replace(".", ","));

              var saldo = 0;
              //saldo = total_pagar_pedido - total_pago;
              //$('.botao_total_saldo').text("SALDO = R$: "+saldo.toFixed(2).replace(".", ","));
             
               var total_pedido = moedaParaNumero($('#total_pedido').val());
               var desconto = moedaParaNumero($('#desconto').val());
               var taxa_entrega = moedaParaNumero($('#taxa_entrega').val());
     
               var total_pagar = (total_pedido + taxa_entrega ) - desconto; 

               saldo = total_pagar - total_pago;
          
               $('.botao_total_saldo').text("SALDO = R$: "+saldo.toFixed(2).replace(".", ","));
             

            });


    
}); //final documenta click



//********** INCLUIR FORMA DE PAGAMENTO LISTAGEM AJAX
$('#orcamento_fechar').click(function(e){


    window.opener.location.href="<?php echo site_url('pedidos/filtro/1'); ?>";
    window.close();

    e.preventDefault();



   
}); //final click btn dinheiro


//************* FINAL CONFIRMAÇÃO PAGAMENTO A VISTA



//********** INCIO NOVO CLIENTE
$('#buscar_cliente_btn').click(function(e){
 var tipo = $('#tipo').val();
 var flag_tipo_op = $('#flag_tipo_op').val();

    e.preventDefault();

     $.ajax({
             type: 'POST',
             //url: "<?php echo site_url('pedidos/incluir_cliente/'); ?>", 
             url: "<?php echo site_url('pedidos/buscar_cliente/'); ?>",            
             data: $('#ajax_buscar_cliente').serialize(),
             success : function(txt){
              var id_pedido = $('#id_pedido').val();
              
              if(txt==1){
                 alert('PEDIDO ATUALIZADO COM SUCESSO!');
                $('#form-content-buscar-cliente').modal('hide');
               } else{
                alert('CLIENTE NÃO ENCONTRADO.');
                $("#form-content-buscar-cliente").modal('show');
               
               }

               window.location.href="<?php echo site_url('pedidos/visualizar/'); ?>/"+id_pedido;
                window.opener.location.href="<?php echo site_url('pedidos/filtro/'); ?>/"+tipo;

                //window.close();
      },
        error: function (request, status, error) {
              alert(request.responseText);
              //alert('VENDA NÃO REALIZADA!');
              //window.back();
         }
             
         });

         return false;



}); //final click btn dinheiro


//************* FINAL REQUISIÇÃO NOVO CLIENTE






//********** INCIO NOVO CLIENTE
$('#add_novo_cliente_btn').click(function(e){
 var tipo = $('#tipo').val();
 var flag_tipo_op = $('#flag_tipo_op').val();
 
 var nome_fantasia = $('#nome_fantasia').val();
 
 if(nome_fantasia==""){
   alert('INFORME UM NOME PARA O CADASTRO!');
  } else { 

    e.preventDefault();

     $.ajax({
             type: 'POST',
             //url: "<?php echo site_url('pedidos/editar_pedido/'); ?>",
             url: "<?php echo site_url('pedidos/incluir_cliente/'); ?>",         
             data: $('#ajax_novo_cliente').serialize(),
             success : function(txt){
              var id_pedido = $('#id_pedido').val();
              $('#form-content-novo-cliente').modal('hide');

               if(txt==1){
                 alert('CLIENTE JÁ EXISTE NA BASE DE DADOS!');
                 $('#form-content-buscar-cliente').modal('hide');
               } 


               window.location.href="<?php echo site_url('pedidos/visualizar/'); ?>/"+id_pedido;
               window.opener.location.href="<?php echo site_url('pedidos/filtro/'); ?>/"+tipo;

                //window.close();
      },
        error: function (request, status, error) {
              alert(request.responseText);
              //alert('VENDA NÃO REALIZADA!');
              //window.back();
         }
             
         });

         return false;
    }


}); //final click btn dinheiro


//************* FINAL REQUISIÇÃO NOVO CLIENTE




//********** INCIO CADASTRO OBSERVAÇÃO
$('#add_incluir_obs').click(function(e){
 var tipo = $('#tipo').val();
 var flag_tipo_op = $('#flag_tipo_op').val();
 
 
    e.preventDefault();

     $.ajax({
             type: 'POST',
             //url: "<?php echo site_url('pedidos/editar_pedido/'); ?>",
             url: "<?php echo site_url('pedidos/incluir_obs/'); ?>",         
             data: $('#ajax_incluir_obs').serialize(),
             success : function(txt){
              var id_pedido = $('#id_pedido').val();
              $('#form-content-incluir-obs').modal('hide');

              
               window.location.href="<?php echo site_url('pedidos/visualizar/'); ?>/"+id_pedido;
               window.opener.location.href="<?php echo site_url('pedidos/filtro/'); ?>/"+tipo;

                //window.close();
      },
        error: function (request, status, error) {
              alert(request.responseText);
              //alert('VENDA NÃO REALIZADA!');
              //window.back();
         }
             
         });

         return false;
    


}); //final click btn dinheiro


//************* FINAL REQUISIÇÃO OBSERVAÇÃO







//********** ALTERAR DADOS DO ORÇAMENTO AJAX
$('#edit_pedido_btn').click(function(e){
 var tipo = $('#tipo').val();
 var flag_tipo_op = $('#flag_tipo_op').val();

    e.preventDefault();

     $.ajax({
             type: 'POST',
             url: "<?php echo site_url('pedidos/editar_pedido/'); ?>",         
             data: $('#ajax_edit_pedido').serialize(),
             success : function(txt){
              var id_pedido = $('#id_pedido').val();
              //alert('VENDA FINALIZADA!');
              $('#form-content-alt-pedido').modal('hide');

               
               if(flag_tipo_op==1 && tipo==1){
                window.location.href="<?php echo site_url('pedidos/visualizar/'); ?>/"+id_pedido;
                window.opener.location.href="<?php echo site_url('pedidos/filtro/'); ?>/"+tipo;
               }

               if(flag_tipo_op==1 && tipo==2){
                /*setTimeout('window.location.href = "<?php echo site_url('pedidos/solicitar_cliente/2'); ?>"; window.opener.location.href="<?php echo site_url('pedidos/filtro/2'); ?>"' , 3000);*/
                 window.location.href="<?php echo site_url('pedidos/visualizar/'); ?>/"+id_pedido;
                window.opener.location.href="<?php echo site_url('pedidos/filtro/'); ?>/"+tipo;
               }

               if(flag_tipo_op==2){
                window.location.href="<?php echo site_url('pedidos/visualizar/'); ?>/"+id_pedido;
                window.opener.location.href="<?php echo site_url('pedidos/filtro/'); ?>/"+tipo;
               }else{
                 window.location.href="<?php echo site_url('pedidos/visualizar/'); ?>/"+id_pedido;
               }



                 
              //window.close();
             
  

              
        },
        error: function (request, status, error) {
              alert(request.responseText);
              //alert('VENDA NÃO REALIZADA!');
              //window.back();
         }
             
         });

         return false;



}); //final click btn dinheiro


//************* ALTERAR DADOS DO ORÇAMENTO








//*************************************
}); // FINAL JQUERY

</script>


