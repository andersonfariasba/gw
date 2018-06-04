
<?php $objDateFormat = $this->DateFormat; 
 
 $janela = array(
              'width'      => '700',
              'height'     => '600',
              'scrollbars' => 'yes',
              'status'     => 'yes',
              'resizable'  => 'yes',
              'screenx'    => '200',
              'screeny'    => '100'
            );

?>


<!--<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.7.2.min.js"></script>
-->
<style type="text/css">

.titulos{
font-size:16px; 
}

.tituloItens{
  font-size:16px;
  font-weight:900;
  padding-bottom:5px;   
}

.tituloMostrarDados{
  font-size:16px;
  font-weight:900;
  padding-bottom:5px;   
}

.campoItens{
  /*height:50px;
  font-size:20px; 
*/
}

.btItensAdd{
  margin-top:5px; 
  font-weight:900;
  /*height:60px;
  font-size:20px;
  margin-top:10px; 
  font-weight:900; */ 
}

.btConsulta{
  font-size:16px;
  font-weight:900;  
}

.detalheItens{
   font-size:18px; 
}

.totalItens{
   font-size:30px;
   color: green; 
   font-weight:900;

}


.totalPagar{
   font-size:30px;
   color: green; 
   font-weight:900;
   margin-top:20px;
   background-color:#ffff99; 
   padding:10px;  

}


.totalSub{
   font-size:30px;
   color: green; 
   font-weight:900;
   background-color:#ffff99;


}

.listaItens{
/*overflow:auto ;max-height:200px; width:auto;*/
}




</style>



<script type="text/javascript" src="<?= base_url() ?>js/jquery-ui-1.9.1.custom.min.js"></script>


<script>
$(document).ready(function(){


  $(this).attr("title", "<?=$objPedido->getMesa()->getNome();?>");


      $('#autocomplete').autocomplete({
 
       source: function(request, response) {
      
      $.ajax({
        //q: request.term,
        url: "<?php echo site_url('pedidos/pesquisar_produto_auto'); ?>",
        data: { term: $("#autocomplete").val()},
        dataType: "json",
        type: "POST",
        success: function(data) {
          //console.info(data);
          response(data);
        }
      });

    },

    select: function(event, ui){
 
            // just in case you want to see the ID
            var accountVal = ui.item.value;
            console.log(accountVal);
 
            // now set the label in the textbox
            var accountText = ui.item.label;
            $('#autocomplete').val(accountText);
 
            return false;
        },

     minLength:2,
               
    focus: function( event, ui ) {
            // this is to prevent showing an ID in the textbox instead of name 
            // when the user tries to select using the up/down arrow of his keyboard
            $( "#autocomplete" ).val( ui.item.label );
            $( "#id_produto" ).val( ui.item.value );
            $( "#valor_unitario" ).val( ui.item.valor_venda);
            return false;  
        }  
 
   });


  
 
});

</script>


<?php $objDateFormat = $this->DateFormat; ?>
<div class="widget ">
	


<!-- DADOS DO CLIENTE -->
	<div class="widget-header">
      <i class="icon-group"></i>
      <h3>Dados Cliente:</h3>
  </div> <!-- widget header -->

  <div class="widget-content">
    <fieldset class="grupo">
    <?php
      //COR DE IDENTIFICAÇÃO PARA PEDIDOS OU ORÇAMENTOS
      if($objPedido->getTipo()==ORCAMENTO){
         $fundoCodigo = "class='btn btn-warning'";
       }
       else{
         $fundoCodigo = "class='btn btn-success'";
       }
    ?>

      <div class="campo">
        <label for="nome" class="labelDados"><span <?php echo $fundoCodigo; ?> >Pedido: <?php echo $objPedido->getId_pedido(); ?></span></label>
     
      </div>

      <div class="campo">
         <label for="nome" class="labelDados"><span <?php echo $fundoCodigo; ?> ><?php echo $objPedido->getMesa()->getNome(); ?></span></label>
     
       </div>

       <div class="campo">
         <label for="nome" class="labelDados"><span <?php echo $fundoCodigo; ?> >Data<?php echo $objDateFormat->date_format_pedido($objPedido->getData_inicio()); ?></span></label>
       
       </div>

       <?php if($objPedido->getTipo()==ORCAMENTO){ ?>
         <div class="campo">
            <label for="nome" class="labelDados">Alterar para Pedido:</label>
             <select name="tipo" id="tipo" style="width:100px;">
               <option value="">Não</option>
               <option value="<?php echo PEDIDO; ?>">Sim</option>
           </select>
         </div>
       <?php } ?>

<!--      <div class="campo">
       <label for="nome" class="labelDados">Funcionário: <?php echo $objPedido->getUsuario()->getLogin(); ?></label>
       
     </div>
    -->

     <div class="campo">
       <label for="nome" class="labelDados"><span <?php echo $fundoCodigo; ?> >Garçom <?php echo $objPedido->getGarcom()->getNome(); ?></span></label>
       
     </div>


  <?php if($objPedido->getStatus()==ANDAMENTO || $objPedido->getStatus()==APROVADO){ ?>

      <div class="campo">
        <label for="nome" class="labelDados">    <a data-toggle="modal" href="#form-alt-cliente" id="alterar_cliente" class="btn btn-small btn-success"><i class="btn-icon-only icon-pencil"> </i>Alterar Mesa</a></label>
     
             
     </div>

     <?php } ?>

      <div class="campo">
        <label for="nome" class="labelDados"><?php echo $objPedido->printStatus(); ?></label>
      
     </div>

   <div class="campo" style="margin-left:120px;">
     <img src="<?php echo base_url()."/img/logo.png"?>" width="200px" border="0">
     </div>

    </fieldset>
  </div> <!-- widgte content -->
<!-- FINAL DADOS DO CLIENTE -->

<!-- DADOS SELEÇÃO DOS ITENS DO PEDIDO -->
	<div class="widget-header">
        <i class="icon-shopping-cart"></i>
        <h3>Selecionar Itens:</h3>
  </div> <!-- widget header -->

  <div class="widget-content">
    <?php echo form_open('pedidos/add_item/'.$objPedido->getId_pedido(),array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
    <input type="hidden" name="id_pedido" id="id_pedido" value="<?php echo $objPedido->getId_pedido(); ?>" />
      <?php echo validation_errors(); ?>

      <fieldset class="grupo">


        <div class="campo">
        <!--<a data-toggle="modal" href="#form-pesquisar_produto" class="btn btn-small btn-success btConsulta"><i class="btn-icon-only icon-ok"> </i>Consultar Produto</a>
        -->
        <!--   <?php echo anchor_popup(site_url('pedidos/comanda_visualizar/'.$objPedido->getId_pedido()),'<span class="btn btn-small btn-info btConsulta"><i class="btn-icon-only icon-list-alt"></i><strong>Visualizar Comanda</strong></span>',$janela);?>
        -->
         </div>
      
      </fieldset>

      <fieldset class="grupo">


        <div class="campo">
         
       
         
         <label for="nome" class="tituloItens">Produto:</label>
         <select name="id_produto" id="id_produto" style="width:300px;">
                <option value="">Selecione...</option>
                    <?php 
                     

                    foreach ($listCategoria as $objCategoria):?>
                
                      <option value="" class="fundoSelect"><?= $objCategoria->getCategoria(); ?></option>
                          <?php 
                           $produtosBusiness = $this->Factory->createBusiness("est_produtos");
                           $listProduto = $produtosBusiness->listar_categoria($objCategoria->getId_categoria());
                          foreach ($listProduto as $objProduto):
                              
                             echo "<option value=".$objProduto->getId_produto().">&nbsp;&nbsp;=>".$objProduto->getDescricao()." - ".$objProduto->getValor_venda()."</option>";
                         
                          endforeach;
?>
                     
                           
                   
                       <?php endforeach;?>
            </select>

         <!--
         AUTOCOMPLETE
         <input type="text" name="produto" id="autocomplete" class="span3 campoItens" />
         <input type="hidden" name="id_produto" id="id_produto" value="<?php echo set_value('id_produto')?>"/>
          -->
       </div>

      <!--<div class="campo">
        <label for="nome" class="tituloItens">Valor Unitário:</label>
        <input type="text" name="valor_unitario" tipo="moneyReal" class="span2 campoItens" id="valor_unitario" value="<?php echo set_value('valor_unitario')?>">
      </div>
      -->

     <div class="campo">
       <label for="nome" class="tituloItens">Qtd:</label>
       <input type="text" name="qtd" class="span2 campoItens" id="qtd" value="<?php echo set_value('qtd')?>" onkeypress='return SomenteNumero(event)'>
     </div>

    <!-- <div class="campo">
       <label for="nome" class="tituloItens">Sub-total:</label>
       <input type="text" disabled name="sub_total " class="span2 campoItens" id="sub_total" value="<?php echo set_value('sub_total')?>">        
     </div>-->


  <?php if($objPedido->getStatus()==ANDAMENTO  || $objPedido->getStatus()==APROVADO){ ?>
     <div class="campo">
        <label for="nome" class="labelDados">&nbsp</label>
        <button type="submit" class="btn btn-success btItensAdd">
          <i class="icon-plus-sign icon-white "></i> Incluir
        </button>       
      </div>
  <?php } ?>

  


     <div class="campo">
     <label for="nome" class="labelDados">&nbsp</label>
     </div>

     <div class="campo">
     <label for="nome" class="labelDados">&nbsp</label>
      
      <!--<p class="btn btn-info btItensAdd"><i class="icon-shopping-cart icon-white"></i> <strong>TOTAL R$<span class="total_mostrar"></span></strong></p>-->
      <!--<p class="totalItens">
        TOTAL R$<span class="total_mostrar"></span>
      </p>
      --> 
      
      <!--<p class="totalSub">
                  TOTAL: <span class="total_mostrar"><</span>
      </p>-->
       
     </div>


      <div class="plan-container" style="padding:5px;">
    <div class="plan green">
      <div class="plan-header">

        <div class="plan-title" style="padding:10px;">
        <Strong>TOTAL</Strong>              
        </div> <!-- /plan-title -->

       <!-- <div class="plan-price" style="padding:10px;">
          R$ <span class="total_mostrar"><</span> <span class="term"></span>
        </div>-->

      <div class="plan-price" style="padding:10px;">
          R$ <span id="total_lado_item"></span> <span class="term"></span>
       
        </div> 
        
        <!-- /plan-price -->

      </div> <!-- /plan-header -->  
    </div> <!-- /plan-price -->

  </div> <!-- /plan-header -->  


     


  </fieldset>
  </form>

  </div> <!-- widgte content -->
<!-- FINAL SELEÇÃO DOS ITENS DO PEDIDO -->

<!-- DADOS DA LISTAGEM DOS  ITENS PEDIDO -->
	<div class="widget-header">
    <i class="icon-list"></i>
      <h3>Itens Selecionados:</h3>
  </div> <!-- widget header -->

  <div class="widget-content listaItens">

    <table class="table table-bordered">
      <thead>
        <tr>
          <td class="tituloMostrarDados">CODIGO</td>
          <td class="tituloMostrarDados">PRODUTO</td>
          <td class="tituloMostrarDados">VALOR UNITÁRIO</td>
          <td class="tituloMostrarDados">QTD</td>
          <td class="tituloMostrarDados">SUB-TOTAL</td>
          <td class="tituloMostrarDados">EXCLUIR</td>
        </tr>
      </thead>

      <tbody>
         <?php 
         $sub_total = 0;
         $total = 0;
         foreach($listItens as $objItem): 
            $sub_total = $objItem->getValor_unitario() * $objItem->getQtd();
            $total = $total + $sub_total;

           ?>
            <tr>           
                <td class="detalheItens"><?php echo $objItem->getProduto()->getCodigo(); ?></td>
                <td class="detalheItens"><?php echo $objItem->getProduto()->getDescricao(); ?></td>
                <td class="detalheItens"><?php echo number_format($objItem->getValor_unitario(), 2, ',', '.'); ?></td>
                <td class="detalheItens"><?php echo $objItem->getQtd(); ?></td>
                <td class="detalheItens"><?php echo number_format($sub_total, 2, ',', '.'); ?></td>
                <td>
                 <?php if($objPedido->getStatus()==ANDAMENTO || $objPedido->getStatus()==APROVADO){ ?>
                <a href="#" class="confirm-delete btn btn-danger btn-small" data-id="<?php echo $objItem->getId_item(); ?>"><i class="btn-icon-only icon-remove"> </i>Excluir</a>
                 <?php } ?>
                </td>

            </tr>
        
        
        <?php endforeach; ?>
        
         <!-- DIV PARA PEGAR O VALOR TOTAL -->
         <div id="total_itens" style="display:none;"><?php echo $total; //number_format($total, 2, '.', ','); ?></div>
        




      </tbody>

      <tfoot>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td class="totalItens"><?php echo number_format($total, 2, ',', '.'); ?></td>
        <td></td>

        </tfoot>
    </table>
                
    </div> <!-- widgte content -->
<!-- FINAL DA LISTAGEM DOS ITENS DO PEDIDO -->
 

<!-- DADOS BOTÃO DE FINALIZAÇÃO -->
  <div class="widget-header">
        <i class="icon-pencil"></i>
        <h3>Confirmar:</h3>
  </div> <!-- widget header -->

    <div class="widget-content">
        
      
        <form action="" method="post" id="ajax_pedido">
          <input type="hidden" name="id_pedido" id="id_pedido" value="<?php echo $objPedido->getId_pedido(); ?>" />
           <!--  <input type="hidden" name="total_pedido" class="span2 total_mostrar_rodape" id="total_pedido" value="<?php echo set_value('total_pedido')?>">
            -->
          <fieldset class="grupo">
             
             <div class="campo">
              <label for="nome" class="labelDados" style="font-size:18px;"> <i class="icon-shopping-cart icon-white"></i> Total Pedido:</label>
              <input type="text" disabled class="span2 total_mostrar_rodape campoItens" id="total_pedido" value="<?php echo set_value('total_pedido',number_format($total, 2, ',', '.'))?>">
            </div>

            <div class="campo">
              <label for="nome" class="labelDados" style="font-size:18px;"><i class="icon-plus"></i> Outras depespesas:</label>
              <input type="text" name="taxa_frete" tipo="moneyReal" class="span2 campoItens" id="taxa_entrega" value="<?php echo set_value('taxa_frete',number_format($objPedido->getTaxa_frete(), 2, ',', '.'))?>">
            </div>

            <div class="campo">
              <label for="nome" class="labelDados" style="font-size:18px;"><i class="icon-minus"></i> Desconto:</label>
              <input type="text" name="desconto" tipo="moneyReal" class="span2 campoItens" id="desconto" value="<?php echo set_value('desconto',number_format($objPedido->getDesconto(), 2, ',', '.'))?>">
            </div>

              

              <!--<div class="campo">
                <p class="totalPagar">
                  TOTAL PAGAR: <span class="total_mostrar"><</span>
                </p>

              </div>-->

 
<!--
  <div class="plan-container">
    <div class="plan green">
      <div class="plan-header">

        <div class="plan-title">
        <Strong>TOTAL</Strong>              
        </div>

        <div class="plan-price" style="padding:10px;">
          R$ <span class="total_mostrar"><</span> <span class="term"></span>
        </div> 

      </div> 
    </div> 

  </div>
  -->

   <!-- /plan-header -->  


     

         
        <!--  </fieldset>
          
          <fieldset class="grupo"> -->
                    
              <?php if($objPedido->getStatus()==ANDAMENTO || $objPedido->getStatus()==APROVADO ){ ?>
              
              <div class="campo">
               <label for="nome" class="labelDados">&nbsp</label>
              <a data-toggle="modal" href="#form-content" id="incluir_forma" class="btn btn-success btConsulta"><i class="btn-icon-only icon-ok"> </i>Incluir Forma de Pagamento</a>
             
             <!--<a data-toggle="modal" href="#form-content" class="btn btn-primary btn-small" id="btMostrar"><i class="btn-icon-only icon-search"> </i>Pesquisa avançada</a>
              -->
             </div>
             <?php } ?>

              
              <!--<div class="campo">
               <label for="nome" class="labelDados">&nbsp</label>
            
               <button type="submit" class="btn btn-success" id="salvar_pedido">
                <i class="icon-ok icon-white"></i> Salvar <?php echo ($objPedido->getTipo()==ORCAMENTO)?"Orçamento":"Pedido"; ?>
               </button>
             </div>

              <div class="campo">
               <label for="nome" class="labelDados">&nbsp</label>
              <a href="<?php echo site_url('pedidos/imprimir/'.$objPedido->getId_pedido()); ?>" target="_blank" class="btn btn-success"><i class="btn-icon-only icon-print"> </i>Imprimir Pedido</a>
             </div>

             <div class="campo">
               <label for="nome" class="labelDados">&nbsp</label>
              <a href="#" class="btn btn-success"><i class="btn-icon-only icon-envelope"> </i>Enviar por e-mail</a>
             </div>
             -->

              
            <?php //if($objPedido->getStatus()!=CANCELADO){ ?>
            <!--
            <div class="campo">
               <label for="nome" class="labelDados">&nbsp</label>
              <a href="#" class="confirm-cancel-pedido btn btn-danger btConsulta" data-id="<?php echo $objPedido->getId_pedido(); ?>"><i class="btn-icon-only icon-remove"> </i>Cancelar</a>
            </div>
            -->


            <?php //} ?>

             

           
           
          </fieldset>

            <fieldset class="grupo">
           
             <div class="campo">
               <label for="observacao" class="labelDados">Anotações:</label>
               <textarea name="observacao" id="observacao" class="span10" rows="5"><?php echo $objPedido->getObservacao(); ?></textarea>
             </div>
            </fieldset>


           </form>


           <?php //} ?>


      <!-- FINAL CONFIRMAÇÃO PEDIDO






   </div>
<!-- FINAL DADOS BOTÃO DE FINALIZAÇÃO -->




</div><!-- widget -->


<!-- MODAL EXCLUSÃO DE ITENS -->
 <div id="myModal" class="modal hide">
    <div class="modal-header">
        <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
         <h3>Excluir Item</h3>
    </div>
    <div class="modal-body">
        
        <p>Deseja realmente excluir o item ?</p>
    </div>
    <div class="modal-footer">
      <a href="#" id="btnYes" class="btn btn-danger"><i class="icon-remove icon-white"></i> Confirmar exclusão</a>
      <a href="#" data-dismiss="modal" aria-hidden="true" class="btn secondary">Cancelar</a>
    </div>
  </div> <!-- /widget-content -->

<!-- FINAL MODAL EXCLUSÃO DE ITENS -->


<!-- MODAL ALTERAR TIPO PARA ORÇAMENTO -->
  <div id="myModalTipo" class="modal hide">
    <div class="modal-header">
        <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
         <h3>Confirmar Alteração:</h3>
    </div>
    <div class="modal-body">
        
        <p>Deseja alterar o Orçamento para Pedido?</p>
    </div>
    <div class="modal-footer">
      <a href="<?php echo site_url('pedidos/alterar_tipo/'.$objPedido->getId_pedido());?>" id="btnYes" class="btn btn-success"><i class="icon-ok icon-white"></i> Confirmar</a>
      <a href="<?php echo site_url('pedidos/visualizar/'.$objPedido->getId_pedido());?>" class="btn secondary">Cancelar</a>
    </div>
  </div> <!-- /widget-content -->
<!-- FINAL MODAL ALTERAR TIPO PARA ORÇAMENTO -->


<!-- MODAL ALTERAR TIPO PARA ORÇAMENTO -->
  <div id="myModalCancelPedido" class="modal hide">
    <div class="modal-header">
        <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
         <h3>Confirmar Cancelamento:</h3>
    </div>
    <div class="modal-body">
        
        <p>Deseja confirmar o cancelamento?</p>
    </div>
    <div class="modal-footer">
      <a href="<?php echo site_url('pedidos/alterar_status/'.$objPedido->getId_pedido());?>" id="btnYes" class="btn btn-danger"><i class="icon-ok icon-white"></i> Sim</a>
      <a href="#" data-dismiss="modal" aria-hidden="true" class="btn secondary">Cancelar</a>
    </div>
  </div> <!-- /widget-content -->
<!-- FINAL MODAL ALTERAR TIPO PARA ORÇAMENTO -->



<!-- MODAL FORMA DE PAGAMENTOS -->  
  <div id="form-content" class="modal hide fade in" style="display: none; ">
          <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                      <h3><i class="btn-icon-only icon-money"> </i>Forma de Pagamento ( Pedido Nº: <?php echo $objPedido->getId_pedido(); ?> )</h3>
          </div>
   

       <?php
       $total_geral = ( $objPedido->getTotal_Itens() + $objPedido->getTaxa_frete() ) - $objPedido->getDesconto();
       ?>  

         <form action="" method="post" id="ajax_finalizar">  

         <input type="hidden" name="id_pedido" value="<?php echo $objPedido->getId_pedido(); ?>">
         <input type="hidden" name="valor" value="<?php echo $total_geral; ?>" >
         <input type="hidden" name="id_cliente" value="<?php echo $objPedido->getId_cliente(); ?>">
         
         <input type="hidden" name="descontoFlag" id="descontoFlag">
         <input type="hidden" name="taxa_freteFlag" id="taxa_freteFlag">
         <input type="hidden" name="observacaoFlag" id="observacaoFlag">





          <fieldset>
             <div class="modal-body">
               <fieldset class="grupo">
                                        
              <div class="campo">
                <label for="nome" class="labelDados">Forma de Pagamento:</label>
                 <select name="id_forma" id="id_forma" style="width:160px;">
                <option value="">Selecione...</option>
              </select>
                <!--<select name="id_forma" id="id_forma" style="width:190px;">
            <option value="">Selecione...</option>
            <?php foreach ($listFormas as $objForma): ?>
            <option value="<?php echo $objForma->getId_forma(); ?>" <?php echo set_select('id_forma',$objForma->getId_forma()); ?>>
              <?php echo $objForma->getForma(); ?>
            </option>
          <?php endforeach; ?>
         </select>-->
               </div>

               <!-- SELECIONAR A OPERADORA -->


              <div class="campo" id="operadora_camada">
                <label for="nome" class="labelDados">Operadora:</label>
                <select name="id_operadora" id="id_operadora" style="width:160px;">
                <option value="">Nenhuma</option>
              </select>
              </div>

               <!-- FINAL OPERADORA -->


              <div class="campo" id="bandeira_camada">
                <label for="nome" class="labelDados">Bandeira:</label>
                <select name="id_bandeira" id="id_bandeira" style="width:160px;">
                <option value="">Nenhuma</option>
              </select>
              </div>




               <div class="campo">
                <label for="nome" class="labelDados">Qtd. Parcela:</label>
                  <input type="text" name="qtd_parcela_pag" value="1" onkeypress='return SomenteNumero(event)' class="span1" id="qtd_parcela_pag" value="<?php echo set_value('qtd_parcela_pag')?>">
               </div>


          

           
      </fieldset>

  <fieldset class="grupo">
        <div class="campo">
                <label for="nome" class="labelDados">TOTAL(R$):</label>
                  <input type="text" disabled="" class="span2" id="total_geral_flag">
        </div>
  </fieldset>   
  
  <fieldset class="grupo">
  <div class="campo">
  <span style="color:blue;">Após essa operação, os devidos itens do estoque serão descontados e os lançamentos finaceiros serão gerados.</span>
  </div>
  </fieldset>


  </div>    
      
    
       <div class="modal-footer">
          <input type="submit" class="btn btn-primary" value="Finalizar" id="finalizar_pedido_btn" />
       
           <a href="#" class="btn" data-dismiss="modal"><i class="icon-remove icon-white"></i> Fechar</a>

       </div>
            </form>
  </div>
<!-- FINAL MODAL -->



<!-- MODAL ALTERAR CLIENTE -->
 <div id="form-alt-cliente" class="modal hide fade in" style="display: none; ">
          <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                      <h3><i class="btn-icon-only icon-money"> </i>Alterar Cliente <i><?php echo $objPedido->getCliente()->getNome_fantasia(); ?></i> para:</h3>
          </div>

          <form action="" method="post" id="ajax_alterar_cliente">
          <input type="hidden" name="id_pedido" value="<?php echo $objPedido->getId_pedido(); ?>">

           
          <fieldset>
             <div class="modal-body">
               <fieldset class="grupo">

          <div class="campo">
            <label for="nome" class="labelDados">Cliente:</label>
          <select name="id_cliente" id="id_cliente" style="width:400px;">
            <option value="<?php echo PAD_CAD_CLIENTE; ?>">REALIZAR VENDA SEM CADASTRO DE CLIENTE</option>
              <?php foreach ($listCliente as $objCliente): ?>
                  <option value="<?php echo $objCliente->getId_cliente(); ?>" <?php echo set_select('id_cliente',$objCliente->getId_cliente()); ?>>
                    <?php echo $objCliente->getNome_fantasia(); ?>
                  </option>
              <?php endforeach; ?>
          </select>
          </div>
          

          </fieldset>
        </div>



        

        <div class="modal-footer">
          <input type="submit" class="btn btn-primary" value="Confirmar Alteração" id="alterar_cliente_btn" />
       
           <a href="#" class="btn" data-dismiss="modal"><i class="icon-remove icon-white"></i> Fechar</a>

       </div>
  </form>



  </div> <!-- FINAL DIV -->
<!-- FINAL MODAL -->








<!-- MODAL FORMA DE PAGAMENTOS -->  
  <div id="form-pesquisar_produto" class="modal hide fade in" style="display: none; ">
          <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                      <h3><i class="btn-icon-only icon-tags"> </i>Consultar Produto</h3>
          </div>


           <form action="" method="post" class="contact" id="ajax_pesquisar_produto">  
   

         <input type="hidden" name="id_pedido" value="<?php echo $objPedido->getId_pedido(); ?>">
        




          <fieldset>
             <div class="modal-body">

               <div class="campo">
                <label for="nome" class="labelDados">PRODUTO:</label>
                  <input type="text" name="descricao" class="span3" id="descricao" value="<?php echo set_value('descricao')?>">
               </div>

                <div class="campo">
                <label for="nome" class="labelDados">CÓDIGO:</label>
                  <input type="text" name="id_produto" class="span3" id="qtd_parcela_pag" value="<?php echo set_value('descricao')?>">
               </div>

                <div class="campo">
                <div id="listar_produto"></div>   
              </div>
               

              </div> 

             
      
    
       <div class="modal-footer">
                <!--<button type="submit" class="btn btn-primary" id="salvar_orcamento">
                <i class="icon-search icon-ok"></i>Finalizar Pedido
               </button> -->

           <input type="submit" class="btn btn-primary" value="Buscar"/>
       
           <a href="#" class="btn" data-dismiss="modal"><i class="icon-remove icon-white"></i> Fechar</a>

       </div>
            </form>
  </div>
<!-- FINAL MODAL -->














</div> <!-- /widget -->

 <script type="text/javascript" src="<?php echo base_url(); ?>js/text_numero.js"></script>
<script type="text/javascript">
$(function () {



   $('#item_pesquisa').submit(function(){
    alert('teste');
   });



$('#ajax_pesquisar_produto').submit(function(){

  $.ajax({
    type: "POST",
    dataType : "json",
    url: "<?php echo site_url('produtos/ajax_listar_produto'); ?>",
    data: $('form.contact').serialize(),
        success: function(data){
                  
        var html = "";
        html+="<form action='teste.php' id='item_pesquisa'><table border='1' class='table table-striped table-bordered'><tr align='left'><th>Código</th><th>Produto</th><th>Valor</th><th>Selecionar</th></tr>";
 
        // executo este laço para ecessar os itens do objeto javaScript
            for($i=0; $i < data.length; $i++){
            
              //html+="<tr><td>"+data[$i].id_produto+"</td>"+"<td>"+data[$i].descricao+"</td><td>"+data[$i].valor_venda+"</td><td align='center'><input type='hidden' name='id_produto' value='"+data[$i].id_produto+"'><input type='hidden' name='descricao' value='"+data[$i].descricao+"'><a href='#' id='add_item_modal' class='btn btn-small btn-success'> <i class='btn-icon-only icon-plus-sign'></i>Incluir</a></td></tr>";
              html+="<tr><td>"+data[$i].id_produto+"</td>"+"<td>"+data[$i].descricao+"</td><td>"+data[$i].valor_venda+"</td><td align='center'><input type='hidden' name='id_produto' value='"+data[$i].id_produto+"'><input type='hidden' name='descricao' value='"+data[$i].descricao+"'><button class='btn btn-small btn-success'>Incluir</button></td></tr>";

            }//fim do laço

            html+="</table></table>";
 
        //coloco a variável html na tela
            //$('body').html(html);
              $('#listar_produto').html(html).show();


        $("#form-content").modal('hide');                     
          
        },
            
    error: function(j){
      //alert("failure");
      }
          });

 return false;
});




//REFERENTE A FORMA DE PAGAMENTO

$('#operadora_camada').hide();
$('#bandeira_camada').hide();

 var url = '<?= site_url("/formas_pagamentos/ajax_listar/2"); ?>/';
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



//REFERENTE A OPERADORA
 
       //$('#bandeira_camada').hide();
        //$('#operadora_camada').hide();
       
      $('#id_forma').change(function(){

        if( $(this).val() ) {



        //VERIFICA SE A FORMA FAZ REFERENCIA A ALGUMA CARTÃO
         var url = '<?= site_url("/formas_pagamentos/verificar_cartao/"); ?>/'+$(this).val();;
          $.getJSON(url, function(v){
                   
            
            var optionsV = '<option value="">Nenhum...</option>'; 
              for (var i = 0; i < v.length; i++) {
                optionsV += '<option value="' + v[i].id_operadora + '">' + v[i].empresa + '</option>';
              } 
             //$('#id_operadora').html(options).show();
                         
             if(v.length==0){
               $('#operadora_camada').hide();
               $('#bandeira_camada').hide();
             
             }
             else{
                 $('#operadora_camada').show();

             }

             $('.carregando').hide();
          });




       //***********FINAL VERIFICAÇÃO
               
          $('.carregando').show();
          var url = '<?= site_url("/operadoras_cartao/ajax_listar/0"); ?>/';
          $.getJSON(url, function(j){
                   
            
            var options = '<option value="">Nenhum...</option>'; 
              for (var i = 0; i < j.length; i++) {
                options += '<option value="' + j[i].id_operadora + '">' + j[i].empresa + '</option>';
              } 
             $('#id_operadora').html(options).show();
             
            
            /* if(j.length>0){
              $('#operadora_camada').show();
             }else{
                $('#operadora_camada').hide();
             }*/

             $('.carregando').hide();
          });

         
        } 
        else{
          $('#id_operadora').html('<option value="">-- Escolha uma Operadora --</option>');
        }
      });

//SELECIONA A BANDEIRA

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



    

    //CAPTAR OS DADOS DE DESCONTOS E FRETE QUANDO CLICA NA FORMA DE PAGAMENTO
        $('#incluir_forma').click(function(e){
        
      /*  $('#descontoFlag').val($('#desconto').val());
        $('#taxa_freteFlag').val($('#taxa_entrega').val());
      
       
        var descontoFlag  =  parseFloat($('#desconto').val());
        var taxaFlag      =  parseFloat($('#taxa_entrega').val());
        var valor_pedido  =  parseFloat($('#total_pedido').val()); 

        var pagamento = (valor_pedido + taxaFlag) - descontoFlag;


          $('#total_geral_flag').val(pagamento.toFixed(2));
          */

      var total_pedido =  $('#total_itens').text();
      var total_pedido = parseFloat(total_pedido);
     
      //desconto
      var desconto = $('#desconto').val().replace(/[.]/g,"");
      var desconto = parseFloat(desconto);

      //taxa de entrega
      var taxa_entrega = $('#taxa_entrega').val().replace(/[.]/g,"");
      var taxa_entrega = parseFloat(taxa_entrega);



      var total_pagar =  ( total_pedido + taxa_entrega ) - desconto;
      var resultado = total_pagar.toFixed(2).replace(".", ",");
      
      $('#total_geral_flag').val(resultado);

     



       });



       
        //AO CONFIRMAR A FORMA DE PAGAMENTO
        $('#finalizar_pedido_btn').click(function(e){

           //FLAG PARA ATUALIZAR DADOS ADICIONAIS DO PEDIDO QUANDO INCLUIR A FORMA DE PAGAMENTO
          $('#descontoFlag').val($('#desconto').val());
          $('#taxa_freteFlag').val($('#taxa_entrega').val());
          $('#observacaoFlag').val($('#observacao').val());
                   

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

          /*if( ($('#id_forma').val()==2 || $('#id_forma').val()==3) && ( $('#id_bandeira').val()=="" ) ){
            alert('Campo Bandeira Vazio.');
           return false;
          }*/

          // FINAL DA VALIDAÇÃO

                          
          e.preventDefault();
              
         $.ajax({
             type: 'POST',
             url: "<?php echo site_url('pedidos/finalizar_pedido/'); ?>",         
             data: $('#ajax_finalizar').serialize(),
             success : function(txt){
              var id_pedido = $('#id_pedido').val();
              window.opener.location.href="<?php echo site_url('pedidos/filtro/2'); ?>";
              window.close();
              
        },
        error: function (request, status, error) {
        alert(request.responseText);
         }
             
         });

         return false;

        });

//FINAL FORMA DE PAGAMENTO



//ALTERAR CLIENTE DO PEDIDO 
        $('#alterar_cliente_btn').click(function(e){
        
                                            
          e.preventDefault();
              
         $.ajax({
             type: 'POST',
             url: "<?php echo site_url('pedidos/alterar_cliente/'); ?>",         
             data: $('#ajax_alterar_cliente').serialize(),
             success : function(txt){
              var id_pedido = $('#id_pedido').val();
              window.location.href="<?php echo site_url('pedidos/visualizar'); ?>"+"/"+id_pedido;
              //window.opener.location.href="<?php echo site_url('pedidos/filtro/2'); ?>";
              //window.close();
              
        },
        error: function (request, status, error) {
        alert(request.responseText);
         }
             
         });

         return false;

        });



// FINAL ALTERAÇÃO CLIENTE PEDIDO





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

 //ALTERAÇÃO DE ORÇAMENTO PARA PEDIDO
 $("#tipo").change(function(){
       
          
    if($('#tipo option:selected').val() == 2) {
      $('#myModalTipo').modal('show');
    }

});


 //SALVAR PEDIDO (APENAS REDIRECIONAR PARA TELA DE LISTAGEM DE PEDIDO)

$('#salvar_orcamento').click(function(e) {
  e.preventDefault();
  location.href="<?php echo site_url('pedidos/filtro/'.PEDIDO); ?>";

});

//CANCELAR PEDIDO
$('.confirm-cancel-pedido').on('click', function(e) {
    e.preventDefault();

    var id = $(this).data('id');
    $('#myModalCancelPedido').data('id', id).modal('show');
});

//CALCULO TOTAL RODAPE COM DESCONTO E TAXA DE ENTREGA

   //CALCULA QUANDO CARREGAR A PÁGINA
   //var total_pedido =  $('#total_itens').text();
   //var taxa_entrega = parseFloat($('#taxa_entrega').val().replace(",", "."));
   //var desconto = parseFloat($('#desconto').val().replace(",", "."));

    var total_pedido =  $('#total_itens').text();
    var total_pedido = parseFloat(total_pedido);
     
     //desconto
     var desconto = $('#desconto').val().replace(/[.]/g,"");
     var desconto = parseFloat(desconto);

     //taxa de entrega
     var taxa_entrega = $('#taxa_entrega').val().replace(/[.]/g,"");
     var taxa_entrega = parseFloat(taxa_entrega);



   var total_pagar =  ( total_pedido + taxa_entrega ) - desconto;
   
   
    var resultado = total_pagar.toFixed(2).replace(".", ",");
    
       $("input:text[name=total_pagar]").val(resultado);
       $('.total_mostrar').text(resultado);
       $('#total_lado_item').text(resultado);


 //Calcula o evento ao confirmar o valor em qtd de parcela

 //CALCULO DIGITANDO EM DESCONTO

     $("#desconto").keyup(function(){
       //var total_pedido =  $('#total_itens').text();
       //var taxa_entrega = parseFloat($('#taxa_entrega').val().replace(",", "."));

       //total pedido
     var total_pedido =  $('#total_itens').text();
     var total_pedido = parseFloat(total_pedido);
     
     //desconto
     var desconto = $('#desconto').val().replace(/[.]/g,"");
     var desconto = parseFloat(desconto);

     //taxa de entrega
     var taxa_entrega = $('#taxa_entrega').val().replace(/[.]/g,"");
     var taxa_entrega = parseFloat(taxa_entrega);
        
        if(isNaN(taxa_entrega)){
         taxa_entrega = 0;
        }

       var total_pagar =  ( parseFloat($('#total_itens').text().replace(",", ".")) + taxa_entrega ) - parseFloat($('#desconto').val().replace(",", "."));
       var total_pagar = (total_pedido+taxa_entrega) - desconto;
     
       var resultado = total_pagar.toFixed(2).replace(".", ",");

        
       $("input:text[name=total_pagar]").val(resultado);
       $('.total_mostrar').text(resultado);
       return false;

  });


    //CALCULO DIGITANDO EM TAXA DE ENTREGA
   $("#taxa_entrega").keyup(function(){

     //total pedido
     var total_pedido =  $('#total_itens').text();
     var total_pedido = parseFloat(total_pedido);
     
     //desconto
     var desconto = $('#desconto').val().replace(/[.]/g,"");
     var desconto = parseFloat(desconto);

     //taxa de entrega
     var taxa_entrega = $('#taxa_entrega').val().replace(/[.]/g,"");
     var taxa_entrega = parseFloat(taxa_entrega);


     

     if(isNaN(desconto)){
      desconto = 0;
     }
 
     var total_pagar = (total_pedido-desconto) + taxa_entrega;
     
      
     var resultado = total_pagar.toFixed(2).replace(".", ",");
     
     

     $("input:text[name=total_pagar]").val(resultado);
     $('.total_mostrar').text(resultado);
     return false;

});


    //CALCULO DIGITANDO QTD NA ADIÇÃO DOS ITENS DO PEDIDO
   $("#qtd").keyup(function(){
     
    
     var valor_unitario = $('#valor_unitario').val().replace(/[.]/g,"");
     var valor_unitario = parseFloat(valor_unitario);
     var qtd = parseFloat($("#qtd").val());    
     var sub_total =  valor_unitario * qtd;
     
      if(isNaN(qtd)){
       qtd = 0;
       var resultado = valor_unitario.toFixed(2);

      }
      else{
       var resultado = sub_total.toFixed(2);
      }

      $("input:text[name=sub_total]").val(resultado);
    
     return false;

});



   //CALCULO DIGITANDO QTD NA ADIÇÃO DOS ITENS DO PEDIDO
   $("#valor_unitario").keyup(function(){

    var valor_unitario = $('#valor_unitario').val().replace(/[.]/g,"");
    var valor_unitario = parseFloat(valor_unitario);
    var qtd = parseFloat($("#qtd").val());    
    var sub_total =  valor_unitario * qtd;

     
      if(isNaN(qtd)){
       valor_unitario = 0.0;
       var resultado = valor_unitario.toFixed(2);

      }
      else{
       var resultado = sub_total.toFixed(2);
      }

      $("input:text[name=sub_total]").val(resultado);
    
     return false;

});




//EXECUTAR METODO DE SALVAR PEDIDO AO CLICAR NO BOTÃO
  $('#salvar_pedido').click(function(e){
    e.preventDefault();
               //  var dados = $('#ajax_form').serialize();        
         $.ajax({
             type: 'POST',
             url: "<?php echo site_url('pedidos/salvar_pedido/'); ?>",
             //data:'total_pedido='+total_pedido,
             data: $('#ajax_pedido').serialize(),
             success : function(txt){
              var id_pedido = $('#id_pedido').val();
              location.href="<?php echo site_url('pedidos/visualizar'); ?>/"+id_pedido;

              //alert(txt);
        }
             
         });

         return false;
             
  });






});

</script>      