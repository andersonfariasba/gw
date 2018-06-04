<?php $objDateFormat = $this->DateFormat; ?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Pesquisa Entregas</h2>
          <ul class="nav navbar-right panel_toolbox">
         
          <li><a href="<?php echo site_url('entrega/filtro');?>"><i class="fa fa-refresh"></i> <strong>Atualizar Página</strong></a></li>
           <li><a href="<?php echo site_url('entrega/filtro_hoje');?>"><i class="fa fa-bell"></i> <strong>Entrega Hoje</strong></a></li>
          <li><a data-toggle="modal" href="#modal_pesquisa"><i class="fa fa-search"></i> <strong>Pesquisar Entrega</strong></a></li>
         
        </ul>
          <div class="clearfix"></div>
      </div>


        <!-- ********* INICIO MIOLO **********-->
        <div class="x_content"> <!-- INICIO MIOLO-->

          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr class="fundoTituloTabela">
                   <!-- <th><input type="checkbox" id="select_all"></th>-->
                    <th width="150px">DATA PREV. ENTREGA</th>
                    <th width="200px">PRODUTO</th>
                     <th width="100px">QTD</th>
                    <th width="160px" align="center">CODIGO LOCAÇÃO</th>
                     <th width="160px">CLIENTE</th>
                  
                    <th>STATUS</th>
                    <th class="td-actions">OPERAÇÕES</th>
              </tr>
            </thead>

            <tbody>
           <?php 
                  $total = 0;
                  foreach ($listItens as $objLanc): 
                   //$total+=$objLanc->getValor_titulo();   
                   ?>
                  
                  <?php if( ($objLanc['data_prev_entrega'] < date('Y-m-d')) && ($objLanc['id_status']!=LOC_ENTREGUE) ) { ?>
                   <tr class="aberto dadosTabela">
                  <?php } else{ ?>
                  <tr class="dadosTabela">

                  <?php } ?>
                  
                  
                 <!--<th><input type="checkbox" class="checkbox" name="id_item[]"></th>-->
                  <td><?php echo $objDateFormat->date_format($objLanc['data_prev_entrega']); ?></td>
                  
                

                  <td><?php echo $objLanc['produto']; ?></td>
                   <td><?php echo round($objLanc['qtd']); ?></td>

                  <td align="center"><span class="badge badge-success"><?php echo $objLanc['codigo_locacao']; ?></span></td>  
                
                  
                  <td><?php echo $objLanc['cliente']; ?></td>
                    <td width="200px">
                      
                      <!-- SELECÇÃO DE STATUS -->
    <div class="btn-group">

 <?php 

      $cor_direcao = "";
      
      //if($objItem->getObjStatus()!=null){ 

          $cor_direcao = $objLanc['cor'];
        //?>

  <button type="button" class="<?php echo $objLanc['cor']; ?>"><strong>
            
 
       <?php  echo $objLanc['status']; ?>
     
    
  </strong></button>
<?php //} ?>

  <button type="button" class="<?php echo $cor_direcao; ?> dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
  <span class="caret"></span>
  <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu" role="menu">
  <?php foreach($listStatus as $objStatus):  ?>
  <li><a href="<?php echo site_url('entrega/alterar_status/'.$objLanc['id_item'].'/'.$objStatus->getId_status()); ?>"><i class="fa fa-check"></i> <strong><?php echo $objStatus->getStatus(); ?></strong></a></li>
  <?php endforeach; ?>
  
  </ul>

</div>


    <!-- FINAL SELEÇÃO DE STATUS -->


                    </td>
                
                   
                  
                  <td class="td-actions">
                  
                 
                  
                  <a href="<?php echo site_url('entrega/editar/'.$objLanc['id_item']); ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> <strong></strong></a>
                  
                


                
                  
                  </td>

                  
                </tr>

              <?php endforeach;?>

              
            </tbody>

          

          </table>

            <!--  <div class="col-md-1 col-sm-6 col-xs-12 form-group has-feedback">
              
              <label>&nbsp;</label>
              <br />
              <button type="submit" class="btn btn-success"><strong><i class="fa fa-check"></i> Realizar Entrega </strong> </button>
              </div>-->





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
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-search"></i> Pesquisar Entrega</h4>
            </div>
            <div class="modal-body">
              <div id="testmodal">
              
                 <form class="form-horizontal" method="post" id="forgot_form" action="<?php echo base_url(); ?>entrega/filtro/">

             
                  
               
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Código Locação</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" name="codigo" value="<?php echo set_value('codigo')?>"/>
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Previsão De:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_de" value="<?php echo set_value('data_de')?>"/>
                    </div>
                  </div>

                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Previsão Até:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_ate" value="<?php echo set_value('data_ate')?>"/>
                    </div>
                  </div>

                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Cliente</label>
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

//select all checkboxes
$("#select_all").change(function(){  //"select all" change 
    $(".checkbox").prop('checked', $(this).prop("checked")); //change all ".checkbox" checked status
});

//".checkbox" change 
$('.checkbox').change(function(){ 
    //uncheck "select all", if one of the listed checkbox item is unchecked
    if(false == $(this).prop("checked")){ //if this item is unchecked
        $("#select_all").prop('checked', false); //change "select all" checked status to false
    }
    //check "select all" if all checkbox items are checked
    if ($('.checkbox:checked').length == $('.checkbox').length ){
        $("#select_all").prop('checked', true);
    }
});


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
    location.href="<?php echo site_url('entrega/excluir'); ?>/"+id;

  });
  //FINAL OPERAÇÃO EXCLUSÃO

  





});

</script>      