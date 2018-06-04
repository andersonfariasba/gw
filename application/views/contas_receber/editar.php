<?php $objDateFormat = $this->DateFormat; ?> 

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">

        <div class="x_title">
          <h2>Editar Contas a Receber</h2>
          <ul class="nav navbar-right panel_toolbox">
          
          <!--<li><a href="<?php echo site_url('contas_pagar/cadastrar'); ?>"><i class="fa fa-plus-circle"></i> <strong>Novo</strong></a></li>-->
          
          <li><a href="<?php echo site_url('contas_receber/filtro'); ?>"><i class="fa fa-search"></i> <strong>Pesquisar</strong></a></li>
          <li><a href="<?php echo site_url('relatorio_painel/menu');?>"><i class="fa fa-bar-chart"></i> <strong>Relatórios</strong></a></li>
          </ul>                     
          <div class="clearfix"></div>
        </div>

        <!-- ********* INICIO MIOLO **********-->
        <div class="x_content"> <!-- INICIO MIOLO-->

          <?php if($msg==true){ ?>
          <div class="alert alert-success alert-dismissible fade in" role="alert"  id="msgOk">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <strong><i class="fa fa-check"></i> Cadastro realizado com sucesso!</strong>
          </div>
          <?php } ?>

            <?php echo validation_errors(); ?>

            <?php echo form_open('contas_receber/editar/'.$objLanc->getId_lancamento(),array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
          <input type="hidden" name="tipo" class="span4" id="tipo" value="<?php echo set_value('tipo',$objLanc->getConta()->getTipo())?>">
      <input type="hidden" name="id_conta" id="id_conta" value="<?php echo set_value('id_conta',$objLanc->getId_conta()); ?>">
      <input type="hidden" name="parcela" id="parcela" value="<?php echo set_value('parcela',$objLanc->getParcela()); ?>">
      <input type="hidden" name="valor_titulo" id="valor_titulo" value="<?php echo set_value('valor_titulo',$objLanc->getValor_titulo()); ?>">
      <input type="hidden" name="id_lancamento" id="id_lancamento" value="<?php echo set_value('id_lancamento',$objLanc->getId_lancamento()); ?>">
      <input type="hidden" name="pagamento_antecipado" id="pagamento_antecipado" value="<?php echo set_value('pagamento_antecipado',$objLanc->getPagamento_antecipado()); ?>">
       <input type="hidden" name="transacao_cartao" id="transacao_cartao" value="<?php echo set_value('transacao_cartao',$objLanc->getTransacao_cartao()); ?>">
      
      <!-- TEMPORÁRIO PARA TESTES -->
      <input type="hidden" name="id_forma" id="id_forma" value="<?php echo set_value('id_forma',$objLanc->getId_forma()); ?>">
      <input type="hidden" name="id_bandeira" id="id_bandeira" value="<?php echo set_value('id_bandeira',$objLanc->getId_bandeira()); ?>">
     
      
                   
          <div class="form-group">
            
          <?php if($objLanc->getConta()->getTipo()==CONTAS_RECEBER){ ?>
          
          <div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
              <label>Nº Venda:</label>
              <input type="text" readonly="" class="form-control" value="<?php echo $objLanc->getConta()->getPedido()->getCodigo(); ?>"/>
          </div>

           <div class="col-md-5 col-sm-6 col-xs-12 form-group has-feedback">
              <label>Cliente:</label>
              <input type="text" readonly="" class="form-control" value="<?php echo $objLanc->getConta()->getPedido()->getCliente()->getNome_fantasia(); ?>"/>
            </div>

             <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
              <label>Usuário:</label>
              <input type="text" readonly="" class="form-control" value="<?php echo $objLanc->getConta()->getPedido()->getUsuario()->getLogin(); ?>"/>
            </div>


          <?php } ?>

           <?php if($objLanc->getConta()->getTipo()==CONTAS_RECEBER_MANUAL){ ?>
          
          <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <label>Descrição:</label>
              <input type="text" name="descricao" class="form-control" value="<?php echo $objLanc->getDescricao(); ?>"/>
          </div>

           <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
              <label>Cliente:</label>
              <input type="text" readonly="" class="form-control" value="<?php echo $objLanc->getConta()->getCliente()->getNome_fantasia(); ?>"/>
               
               <!--<select class="form-control" name="id_cliente" id="id_cliente">
               <?php foreach ($listCliente as $objCliente): 
                             $cliente = $objCliente->getId_cliente();
                         ?>
                        <option value="<?php echo $objCliente->getId_cliente(); ?>" <?php echo set_select('id_cliente',$cliente,$objLanc->getConta()->clienteIs($cliente)); ?>>
                           <?php echo $objCliente->getNome_fantasia(); ?>
                        </option>
                         <?php endforeach; ?>
                        </select>-->
            </div>

          <?php } ?>


           

          </div>

          <div class="form-group">

        
        <div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
              <label>Total Pedido:</label>
              <input type="text"  readonly="" class="form-control" tipo="moneyReal" value="<?php echo set_value('valor',  number_format($objLanc->getConta()->getValor_total(), 2, ',', '.'))?>"/>
        </div>

          <?php if($objLanc->getConta()->getParcela_qtd()>1){ ?>
            <div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
              <label>Parcela / Total Parcela</label>
              <input type="text"  readonly="" class="form-control" value="<?php echo set_value('parcela_qtd',$objLanc->getParcela()." / ".$objLanc->getConta()->getParcela_qtd())?>"/>
            </div>
          <?php } ?>

            <div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
              <label>Valor Lançamento</label>
              <input type="text" name="valor_titulo" tipo="moneyReal" class="form-control" value="<?php echo set_value('valor_parcela',number_format($objLanc->getValor_titulo(), 2, ',', '.'))?>"/>
            </div>

            <?php if($objLanc->getTransacao_cartao()==SIM){ ?>
             <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
              <label>Taxa Operadora Cartão(%)</label>
              <input type="text" tipo="moneyReal" name="taxa_operadora_cartao" class="form-control" value="<?php echo set_value('taxa_operadora_cartao',number_format($objLanc->getTaxa_operadora_cartao(), 2, ',', '.'))?>"/>
            </div>
             <?php } ?>
       


                          
         <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Forma de Recebimento</label>
                        <select class="form-control" name="id_forma" id="id_forma">
                        <option value="">Nenhum...</option>
                         <?php foreach ($listForma as $objForma): 
                             $forma = $objForma->getId_forma();
                             ?>
                        <option value="<?php echo $objForma->getId_forma(); ?>" <?php echo set_select('id_forma',$forma,$objLanc->formaIs($forma)); ?>>
                           <?php echo $objForma->getForma(); ?>
                        </option>
                         <?php endforeach; ?>

                       
                        </select>
            </div>

            </div>

        
        <div class="form-group">
       
       <div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
              <label>Data Vencimento:</label>
              <input type="text" name="data_vencimento" class="form-control calendario" value="<?php echo set_value('data_vencimento',$objDateFormat->date_format($objLanc->getData_vencimento()))?>"/>
        </div>

        <div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
              <label>Data Pagamento:</label>
              <input type="text" name="data_pagamento" class="form-control calendario" value="<?php echo set_value('data_pagamento',$objDateFormat->date_format($objLanc->getData_pagamento()))?>"/>
        </div>

       

            </div>


             <div class="form-group">



            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Conta Banco</label>
                        <select class="form-control" name="id_conta_banco" id="id_conta_banco">
                         <option value="">Nenhum...</option>
                         <?php foreach ($listContaBanco as $objContaBanco): 
                             $conta_banco = $objContaBanco->getId_conta_banco();
                             ?>
                        <option value="<?php echo $objContaBanco->getId_conta_banco(); ?>" <?php echo set_select('id_conta_banco',$conta_banco,$objLanc->contaBancoIs($conta_banco)); ?>>
                           <?php echo "Banco:".$objContaBanco->getBanco(). " Conta: ".$objContaBanco->getConta(); ?>
                        </option>
                         <?php endforeach; ?>

                       
                        </select>
            </div>



              <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Status</label>
                        <select class="form-control" name="status" id="status">
                       <?php $status = $objLanc->getStatus();?>
                <option value="<?= $objLanc->getStatus(); ?>" <?= set_select('status',$status,$objLanc->statusIs($status)); ?>>
                <?= $objLanc->printStatus(); ?>
               <option value="<?= ABERTO; ?>" <?= set_select('status',ABERTO); ?>>PENDENTE</option>
              <!-- <option value="<?= APROVADO; ?>" <?= set_select('status',APROVADO); ?>>AUTORIZADO</option>-->
               <option value="<?= PAGO; ?>" <?= set_select('status',PAGO); ?>>RECEBIDO</option>
<option value="<?= CANCELADO; ?>" <?= set_select('status',CANCELADO); ?>>CANCELADO</option>

                       
                        </select>

                        
            </div>

             <div class="col-md-1 col-sm-6 col-xs-12 form-group has-feedback">
             <label>
             <?php if($objLanc->getStatus()==PAGO){ ?>
             <img src="<?= base_url(); ?>/img/ativo.png" alt="Recebido" title="Recebido" width="30px;" border="0" />
             <?php } else {  ?>
              <img src="<?= base_url(); ?>/img/cancelado.png" alt="Pendente" title="Pendente" width="30px;" border="0" />
             <?php } ?>

             </label>
             
             </div>


             

             </div>

          <div class="form-group">


              <div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
                <label>Anotações</label>
                <!--<textarea id="observacao" rows="5" class="form-control" name="observacao">
                  <?php echo $objLanc->getObservacao(); ?>
                </textarea>-->
                <input type="text" name="observacao" class="form-control" value="<?php echo $objLanc->getObservacao(); ?>"/>

                </div>

                  
                      

             

              

            </div>

           
 <div class="ln_solid"></div>
          <div>
            <div class="col-md-12 col-sm-12 col-xs-12">
            
              <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Salvar</button>
              </form>
            </div>
          </div>
        </div>

        


            <div class="form-group">
              
              <?php if(count($listLanc) > 1){ ?>
                 
                 <div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
                   <label class="col-md-12" style="text-align: center;">Contas Relacionadas</label>
                 <table  class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                  <thead>
                  <tr>
                    <th>Data Vencimento</th>
                     <th>Data Pagamento</th>
                    <th>Valor</th>
                    <th>Parcela</th>
                    <th>Staus</th>
                    <th>Visualizar</th>
                  </tr>
                  </thead>

                  <tbody>
                 <?php 
                  $total = 0;
                  $lanc_atual = $objLanc->getId_lancamento();
                  foreach ($listLanc as $objLanc): 
                   $total+=$objLanc->getValor_titulo();   
                   ?>
                   <tr>
                    <td><?php echo $objDateFormat->date_format($objLanc->getData_vencimento()); ?></td>
                    <td><?php echo $objDateFormat->date_format($objLanc->getData_pagamento()); ?></td>
                     <td><?php echo number_format($objLanc->getValor_titulo(), 2, ',', '.'); ?></td>
                     <td><?php echo $objLanc->getParcela()." / ".$objLanc->getConta()->getParcela_qtd(); ?></td>
                     <td><?php echo $objLanc->printStatus(); ?></td>
                       
                  
                    <td>
                      <?php if($objLanc->getId_lancamento()!=$lanc_atual){ ?>
                    <a href="<?php echo site_url('contas_receber/editar/'.$objLanc->getId_lancamento()); ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> <strong>Visualizar</strong></a>
                     <?php }else{ echo "Conta Visualizada na Tela"; } ?>

                     </td>
                     
                  </tr>

              <?php endforeach;?>

              
            </tbody>


                 </table>
          

                 </div>
                 <?php } ?>


            </div>




            <!--<div class="ln_solid"></div>

          <div>
            <div class="col-md-12 col-sm-12 col-xs-12">
            
              <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Salvar</button>
              </form>
            </div>
          </div>
        </div>-->

    </div>  <!-- FINAL MIOLO -->

  </div> <!-- FINAL COL -->

</div> <!-- FINAL ROWS -->



<!-- MODAL FORNECEDOR -->
      <div id="modal_fornecedor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-circle"></i> Adicionar Fornecedor</h4>
            </div>
            <div class="modal-body">
              <div id="testmodal">
               
             
               
                <form class="contact-fornecedor form-horizontal" id="ajax_form_fornecedor"> 
                 <input type="hidden" name="tipo" value="<?php echo set_value('tipo',PESSOA_JURIDICA)?>">
               
                  <div class="form-group">
                    
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Nome Fantasia:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" name="nome_fantasia" id="nome_fantasia" value="<?php echo set_value('nome_fantasia')?>" maxlength="100"/>
                    </div>
                  </div>

                                      
                
              </div>
            </div>
            <div class="modal-footer">
              <!--<button type="button" class="btn antoclose" data-dismiss="modal">Fechar</button>-->
              <a href="#" data-dismiss="modal" aria-hidden="true" class="btn">Fechar Janela</a>
              <button type="submit" class="btn btn-success"><i class="fa fa-plus-circle"></i> Incluir</button>
              </form>
            </div>
          </div>
        </div>
      </div>

<!-- FINAL MODAL FORNECEDOR -->




<script type="text/javascript">

<?php if($msg==true){ ?>
//função para ocultar mensagem de cadastro: arquivo: js/base.js
hideMessage();

<?php } ?>

</script>

<script type="text/javascript">

jQuery(function ($) {
            
        
   //Calcula o evento ao confirmar o valor em qtd de parcela
     $("#parcela_qtd").keyup(function(){
             
     
      var valor = parseFloat($('#valor').val().replace(".", ""));
    var qtd_parcela = parseInt($("#parcela_qtd").val());
    var resultado = valor / qtd_parcela;

     $("input:text[name=valor_parcela]").val(resultado.toFixed(2));
     return false;
   });
   
   
   //Calcula o evento ao clicar no campo de valor de parcela
    
    $("#valor_parcela").click(function(){
      
    var valor = parseFloat($('#valor').val().replace(".", ""));
    var qtd_parcela = parseInt($("#parcela_qtd").val());
    var resultado = valor / qtd_parcela;

     $("input:text[name=valor_parcela]").val(resultado.toFixed(2));
   

   });


    
$("#valor").keyup(function(){
    var valor = parseFloat($('#valor').val().replace(".", ""));
    var qtd_parcela = parseInt($("#parcela_qtd").val());
    var resultado = valor / qtd_parcela;

     $("input:text[name=valor_parcela]").val(resultado.toFixed(2));

   



   });

         

 });

 </script>


