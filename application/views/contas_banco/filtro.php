<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Pesquisa Contas Bancárias</h2>
          <ul class="nav navbar-right panel_toolbox">
          <li><a href="<?php echo site_url('contas_banco/cadastrar'); ?>"><i class="fa fa-plus-circle"></i> <strong>Novo</strong></a></li>
          <li><a data-toggle="modal" href="#modal_pesquisa"><i class="fa fa-search"></i> <strong>Pesquisar</strong></a></li>
          <li><a href="#"><i class="fa fa-bar-chart"></i> <strong>Relatórios</strong></a></li>
        </ul>
          <div class="clearfix"></div>
      </div>


        <!-- ********* INICIO MIOLO **********-->
        <div class="x_content"> <!-- INICIO MIOLO-->

          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr class="fundoTituloTabela">
                     <th>FILIAL</th>
                     <th>BANCO</th>
                      <th width="50px">AGENCIA</th>
                     <th width="50px">CONTA</th>
                     <th width="50px">DESCRIÇÃO</th>
                      <th>OPERAÇÕES</th>
              </tr>
            </thead>

            <tbody>
             <?php foreach ($listConta as $objConta): ?>
                  <tr class="dadosTabela">
                    
                  <td><?php echo $objConta->getFilial()->getNome_fantasia()." - ".$objConta->getFilial()->getCnpj_cpf(); ?></td>
                  <td><?php echo $objConta->getBanco(); ?></td>
                  <td><?php echo $objConta->getAgencia(); ?></td>
                  <td><?php echo $objConta->getConta(); ?></td>
                   <td><?php echo $objConta->getObservacao(); ?></td>
                  <td class="td-actions">
                  <a href="<?php echo site_url('contas_banco/editar/'.$objConta->getId_conta_banco()); ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> <strong>Visualizar</strong></a>
                  <a href="#" class="confirm-delete btn btn-danger btn-sm" data-id="<?php echo $objConta->getId_conta_banco(); ?>"><i class="fa fa-trash"></i> <strong>Excluir</strong></a>
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
              
                 <form class="form-horizontal" method="post" id="forgot_form" action="<?php echo base_url(); ?>contas_banco/filtro/">
                  
               
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Banco</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" name="banco" value="<?php echo set_value('banco')?>"/>
                    </div>
                  </div>

                   
                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Empresa</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                    <select class="form-control" name="id_filial" id="id_filial">
                      
              <?php foreach ($listFilial as $objFilial): ?>
                  <option value="<?php echo $objFilial->getId_filial(); ?>" <?php echo set_select('id_filial',$objFilial->getId_filial()); ?>>
                    <?php echo $objFilial->getNome_fantasia(); ?>
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
    location.href="<?php echo site_url('contas_banco/excluir'); ?>/"+id;

  });
  //FINAL OPERAÇÃO EXCLUSÃO

  





});

</script>      