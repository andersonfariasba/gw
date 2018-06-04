<?php $objDateFormat = $this->DateFormat; ?> 
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Pesquisa Pedidos de Compras</h2>
          <ul class="nav navbar-right panel_toolbox">
          
          <!--<li><a href="<?php echo site_url('solicitacao/iniciar_manual'); ?>"><i class="fa fa-plus-circle"></i> <strong>Nova Solicitação Manual</strong></a></li>
           <li><a href="<?php echo site_url('solicitacao/iniciar_importacao'); ?>"><i class="fa fa-cloud-upload"></i> <strong>Importação</strong></a></li>-->
          <li><a data-toggle="modal" href="#modal_pesquisa"><i class="fa fa-search"></i> <strong>Pesquisar Pedido</strong></a></li>

          <li><a href="<?php echo site_url('pedidos_acompanhamento/filtro'); ?>"><i class="fa fa-refresh"></i> <strong>Atualizar Página</strong></a></li>
         
        </ul>
          <div class="clearfix"></div>
      </div>


        <!-- ********* INICIO MIOLO **********-->
        <div class="x_content"> <!-- INICIO MIOLO-->

          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
               <tr class="fundoTituloTabela">
                <th>RESPONSÁVEL</th>
                 <th width="50px">Nº DO PEDIDO</th>
                 <th>FORNECEDOR</th>
                  <th>DATA</th>
                   <th>VALOR NF</th>
                    <th>Nº NF</th>
                      <th>STATUS</th>
                    
                <th width="300px">OPERAÇÕES</th>
              </tr>
            </thead>

            <tbody>
               <?php foreach ($listSolicitacao as $objSolicitacao): ?>
                 <tr class="dadosTabela">

                  <td><?php echo $objSolicitacao['solicitante']; ?></td>
                    <td><?php echo $objSolicitacao['id_pedido']; ?></td>
                      <td><?php echo $objSolicitacao['fornecedor']; ?></td>
                  <td><?php echo $objDateFormat->date_format($objSolicitacao['data']); ?></td>
                    <td><?php echo number_format($objSolicitacao['valor_nf'], 2, ',', '.'); ?></td>
                      <td><?php echo $objSolicitacao['numero_nf']; ?></td>
                      <td><button type="button" class="btn btn-sm btn-primary"><strong>
                        <?php echo $objSolicitacao['status']; ?>
                      </strong></button></td>
                 
                 
                    
                <td class="td-actions">
                 
                  <a href="<?php echo site_url('pedidos_acompanhamento/visualizar/'.$objSolicitacao['id_pedido']); ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> <strong>Visualizar</strong></a>

                   <a href="<?php echo site_url('pedidos_acompanhamento/imprimir/'.$objSolicitacao['id_pedido']); ?>" class="btn btn-sm btn-primary" target="_blank"><i class="fa fa-print"></i> <strong>Imprimir</strong></a>

                   <!--<a href="<?php echo site_url('pedidos_acompanhamento/imprimir_interna/'.$objSolicitacao['id_pedido']); ?>" class="btn btn-sm btn-primary" target="_blank"><i class="fa fa-print"></i> <strong>Interna</strong></a>-->

                

                

                 

                  </td>

                </tr>

              <?php endforeach;?>

              
            </tbody>

          </table>

        </div>  <!-- FINAL MIOLO -->

        <!-- ********* FINAL MIOLO **********-->
    </div> <!-- FINAL XPANEL -->
  </div> <!-- FINAL COL -->
</div><!-- FINAL ROWS -->

           <!-- Start Calendar modal -->
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

      <!-- modal pesquisa -->

    <!-- Start Calendar modal -->
      <div id="CalenderModalDup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel">Deseja realmente duplicar a solicitação?</h4>
            </div>
           
      <div class="modal-footer">
      <a href="#" id="btnYesCopy" class="btn btn-success"><i class="fa fa-plus-circle "></i> Confirmar</a>
      <a href="#" data-dismiss="modal" aria-hidden="true" class="btn">Fechar Janela</a>
     
    </div>
          </div>
        </div>
      </div>

      <!-- modal pesquisa -->



      <!-- Start Calendar modal -->
      <div id="modal_pesquisa" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-search"></i> Pesquisar Pedido</h4>
            </div>
            <div class="modal-body">
              <div id="testmodal">
                <!--<form id="antoform" class="form-horizontal" role="form">-->
                 <form class="form-horizontal" method="post" id="forgot_form" action="<?php echo base_url(); ?>pedidos_acompanhamento/filtro/">
                  
               
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Data (De:)</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_de" value="<?php echo set_value('categoria')?>" maxlength="50" placeholder="99/99/9999"/>
                    </div>
                  </div>

                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Data (Até:)</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_ate" value="<?php echo set_value('categoria')?>" maxlength="50" placeholder="99/99/9999"/>
                    </div>
                  </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Fornecedor:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                    <select class="form-control" name="id_fornecedor" id="id_fornecedor">
                        <option value="">Todos...</option>
                         <?php foreach ($listFornecedor as $objFornecedor):   ?>
                           
                        <option value="<?php echo $objFornecedor->getId_fornecedor(); ?>" <?php echo set_select('id_fornecedor',$objFornecedor->getId_fornecedor()); ?>>
                           <?php echo $objFornecedor->getNome_fantasia(); ?>
                        </option>
                         <?php endforeach; ?>
                    </select>

                    </div>
                  </div>

                

                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Numero Pedido</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" name="id_pedido" value="<?php echo set_value('categoria')?>" maxlength="50"/>
                    </div>
                  </div>

                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Numero NF</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" name="numero_nf" value="<?php echo set_value('categoria')?>"/>
                    </div>
                  </div>


                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                   <select class="form-control" name="id_status" id="id_status">
                        <option value="">Todos...</option>
                       
                        <?php foreach ($listStatus as $objStatus): ?>
                        <option value="<?php echo $objStatus->getId_status(); ?>">
                        <?php echo $objStatus->getStatus(); ?>
                        </option>
                        <?php endforeach; ?>
                      </select>

                    </div>
                  </div>

                

                




                   
                
              </div>
            </div>
            <div class="modal-footer">
              <!--<button type="button" class="btn antoclose" data-dismiss="modal">Fechar</button>-->
              <a href="#" data-dismiss="modal" aria-hidden="true" class="btn">Fechar Janela</a>
              <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>Pesquisar</button>
              </form>
            </div>
          </div>
        </div>
      </div>


      <!-- final modal pesquisa -->



<!-- Start Calendar modal -->
      <div id="modal_copia" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-circle"></i> Duplicar Solicitação</h4>
            </div>
            <div class="modal-body">
              <div id="testmodal">
                <!--<form id="antoform" class="form-horizontal" role="form">-->
                 <form class="form-horizontal" method="post" id="forgot_form" action="<?php echo base_url(); ?>solicitacao/copiar/">

                 <input type="hidden" name="id_solicitacao" id="id_solicitacao_copy">
                  
               
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Data Solicitação</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_criacao" value="<?php echo set_value('categoria')?>" maxlength="50" placeholder="99/99/9999"/>
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Data de Necessidade</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_necessidade" value="<?php echo set_value('categoria')?>" maxlength="50" placeholder="99/99/9999"/>
                    </div>
                  </div>

                   



                   
                
              </div>
            </div>
            <div class="modal-footer">
              <!--<button type="button" class="btn antoclose" data-dismiss="modal">Fechar</button>-->
              <a href="#" data-dismiss="modal" aria-hidden="true" class="btn">Fechar Janela</a>
              <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Confirmar</button>
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
   // location.href="<?php echo site_url('est_categorias/excluir'); ?>/"+id;

  });
  //FINAL OPERAÇÃO EXCLUSÃO


 //OPERAÇÃO DUPLICAÇÃO
 

  $(document).on('click', '.confirm-copia ', function(e) {
    e.preventDefault();

    var id = $(this).data('id');
     $("#id_solicitacao_copy").val(id);
    //$('#CalenderModalDup').data('id', id).modal('show');
  });

 
  //FINAL OPERAÇÃO DUPLICAÇÃO

 






});

</script>      