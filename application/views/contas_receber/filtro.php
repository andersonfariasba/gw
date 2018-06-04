<?php $objDateFormat = $this->DateFormat; ?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Pesquisa Contas a Receber</h2>
          <ul class="nav navbar-right panel_toolbox">
          <li><a href="<?php echo site_url('contas_receber/cadastrar'); ?>"><i class="fa fa-plus-circle"></i> <strong>Novo Recebimento</strong></a></li>
          
          
          <li><a data-toggle="modal" href="#modal_pesquisa"><i class="fa fa-search"></i> <strong>Pesquisar Recebimentos</strong></a></li>
          <li><a href="<?php echo site_url('relatorio_painel/menu');?>"><i class="fa fa-bar-chart"></i> <strong>Relatórios</strong></a></li>
        </ul>
          <div class="clearfix"></div>
      </div>


        <!-- ********* INICIO MIOLO **********-->
        <div class="x_content"> <!-- INICIO MIOLO-->

          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr class="fundoTituloTabela">
                    <th width="150px">DATA VENCIMENTO</th>
                    <th width="160px">CLIENTE</th>
                    <th width="80px">RECEBIMENTO</th>
                    <th width="120px">VALOR TITULO</th>
                    <th>PARCELA</th>
                    <th width="100px">FORMA PAG.</th>
                    <th>STATUS</th>
                    <th class="td-actions">OPERAÇÕES</th>
              </tr>
            </thead>

            <tbody>
                  <?php 
                  $total = 0;
                  foreach ($listLanc as $objLanc): 
                   $total+=$objLanc->getValor_titulo();   
                   ?>
                  
                  <?php //if( ($objLanc->getData_vencimento() < date('Y-m-d')) and $objLanc->getStatus()==ABERTO ) { ?>
                   <!--<tr class="aberto">-->
                  <?php //} else{ ?>
                  <tr class="dadosTabela">

                  <?php //} ?>
                  
                  <td><?php echo $objDateFormat->date_format($objLanc->getData_vencimento()); ?></td>
                  <td>
                  <?php 
                       if($objLanc->getConta()->getTipo()==CONTAS_RECEBER){ 
                         //echo "venda";
                         echo $objLanc->getConta()->getPedido()->getCliente()->getNome_fantasia(); 
                       } else{
                         echo $objLanc->getConta()->getCliente()->getNome_fantasia();
                         //echo "manual";
                       }
                       ?>
                  </td>
                  
                  <td>

                  <?php  if($objLanc->getConta()->getTipo()==CONTAS_RECEBER){  ?>
                  <a href="<?php echo site_url('pedidos/imprimir/'.$objLanc->getConta()->getId_pedido()); ?>" class="btn btn-info btn-sm" target="_blank">
                  <strong><?php echo "Venda Nº ".$objLanc->getConta()->getPedido()->getCodigo(); ?></strong>
                    </a>
                  <?php } else { 

                        echo $objLanc->getDescricao(); 

                     } ?>

                  </td>
                   
                   <td>R$: <?php echo number_format($objLanc->getValor_titulo(), 2, ',', '.'); ?></td>
                  <td>
                  <?php echo $objLanc->getParcela()." / ".$objLanc->getConta()->getParcela_qtd(); ?>
                 
                  </td>
                  <td><?php 
                  if($objLanc->getForma()!=null){
                    echo $objLanc->getForma()->getForma(); 
                   }

                  ?>

                  </td>
                  <td><?php echo $objLanc->printStatus(); ?></td>
                  
                  <td class="td-actions" width="300px">
                     
                     <a href="<?php echo site_url('contas_receber/editar/'.$objLanc->getId_lancamento()); ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> <strong>Visualizar</strong></a>

                      <a href="#" class="confirm-delete btn btn-danger btn-sm" data-id="<?php echo $objLanc->getId_lancamento(); ?>"><i class="fa fa-trash"></i> <strong></strong></a>
                     
                     

                    <!-- <?php if($objLanc->getStatus()==ABERTO){?>
                     <a href="<?php echo site_url('boletos/gerar_boleto/'); ?>" class="btn btn-sm btn-info" target="_blank"><i class="fa fa-barcode"></i> <strong>Boleto</strong></a>
                     <?php } ?>-->
                                      
                     
                   </td>
                    
                  </tr>
                  
                  <?php endforeach;?>
                  
                                  
                </tbody>
                <tfoot class="dadosTabela">
                  <th></th>
                  <th></th>
                  <th></th>
                  <th>R$: <?php echo number_format(round($total, 1), 2, ',', '.'); ?></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tfoot>
                

          </table>

        </div>  <!-- FINAL MIOLO -->

        <!-- ********* FINAL MIOLO **********-->
    </div> <!-- FINAL XPANEL -->
  </div> <!-- FINAL COL -->
</div><!-- FINAL ROWS -->

   <!-- modal exclusão -->
      <div id="CalenderModalNew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel">Deseja realmente excluir o item?</h4>
            </div>
           
      <div class="modal-footer">
      <a href="#" id="btnYes" class="btn btn-danger"><i class="fa fa-trash"></i> Confirmar exclusão</a>
      <a href="#" data-dismiss="modal" aria-hidden="true" class="btn">Fechar Janela</a>
     
    </div>
          </div>
        </div>
      </div>
      <!-- final modal exclusão -->

      <!-- modal pesquisa -->

      <!-- Start Calendar modal -->
      <div id="modal_pesquisa" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-search"></i> Pesquisar</h4>
            </div>
            <div class="modal-body">
              <div id="testmodal">
              
                 <form class="form-horizontal" method="post" id="forgot_form" action="<?php echo base_url(); ?>contas_receber/filtro/">
                  
               
                
                


                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Vencimento De:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_de" value="<?php echo set_value('data_de')?>"/>
                    </div>
                  </div>

                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Vencimento Até:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_ate" value="<?php echo set_value('data_ate')?>"/>
                    </div>
                  </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Cliente:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                  <select class="form-control" name="id_cliente" id="id_cliente">
                        <option value="">Todos...</option>
                        <option value="<?php echo PAD_CAD_CLIENTE; ?>">AVULSO</option>
                        <?php foreach ($listCliente as $objCliente): ?>
                        <option value="<?php echo $objCliente->getId_cliente(); ?>">
                        <?php echo $objCliente->getNome_fantasia(); ?>
                        </option>
                        <?php endforeach; ?>
                      </select>
                       </div>
                  </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Venda Nº</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" name="codigo" value="<?php echo set_value('codigo')?>"/>
                    </div>
                  </div>


                    

                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Forma de Pagamento</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                    <select class="form-control" name="id_forma" id="id_forma">
                        <option value="">Todos...</option>
                         <?php foreach ($listForma as $objForma):   ?>
                           
                        <option value="<?php echo $objForma->getId_forma(); ?>" <?php echo set_select('id_forma',$objForma->getId_forma()); ?>>
                           <?php echo $objForma->getForma(); ?>
                        </option>
                         <?php endforeach; ?>
                    </select>

                    </div>
                  </div>

                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                    <select class="form-control" name="status" id="status">
                    <option value="">Todos...</option>   
                        <option value="<?= ABERTO; ?>" <?= set_select('status',ABERTO); ?>>PENDENTE</option>
                        <!--<option value="<?= APROVADO; ?>" <?= set_select('status',APROVADO); ?>>AUTORIZADO</option>-->
                        <option value="<?= PAGO; ?>" <?= set_select('status',PAGO); ?>>RECEBIDO</option>
                       <option value="<?= CANCELADO; ?>" <?= set_select('status',CANCELADO); ?>>CANCELADO</option>
                    </select>

                    </div>
                  </div>

                                  



                
              </div>
            </div>
            <div class="modal-footer">
             <a href="#" data-dismiss="modal" aria-hidden="true" class="btn">Fechar Janela</a>
              <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Pesquisar</button>
              </form>
            </div>
          </div>
        </div>
      </div>


      <!-- final modal pesquisa -->


<!-- OPERAÇÃO PARA EXCLUSÃO DE DADOS -->
<script type="text/javascript">
$(function () {

 //OPERAÇÃO EXCLUSÃO 
  $('#CalenderModalNew').on('show', function() {
    var id = $(this).data('id'),
    removeBtn = $(this).find('.danger');
  });

  $(document).on('click', '.confirm-delete', function(e) {
    e.preventDefault();

    var id = $(this).data('id');
    $('#CalenderModalNew').data('id', id).modal('show');
  });

  $('#btnYes').click(function() {
    // handle deletion here
    var id = $('#CalenderModalNew').data('id');
    $('[data-id='+id+']').remove();
    $('#CalenderModalNew').modal('hide');
    location.href="<?php echo site_url('contas_receber/excluir'); ?>/"+id;

  });
  //FINAL OPERAÇÃO EXCLUSÃO

  





});

</script>      