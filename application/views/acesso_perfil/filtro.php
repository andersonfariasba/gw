<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Pesquisa Perfil</h2>
          <ul class="nav navbar-right panel_toolbox">
          <li><a href="<?php echo site_url('acesso_perfil/cadastrar'); ?>"><i class="fa fa-plus-circle"></i> <strong>Novo Perfil</strong></a></li>
          <li><a href="<?php echo site_url('acesso_perfil/filtro'); ?>"><i class="fa fa-search"></i> <strong>Pesquisar Perfil</strong></a></li>
          <li><a href="#"><i class="fa fa-bar-chart"></i> <strong>Relatórios</strong></a></li>
        </ul>
          <div class="clearfix"></div>
      </div>


        <!-- ********* INICIO MIOLO **********-->
        <div class="x_content"> <!-- INICIO MIOLO-->

          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr class="fundoTituloTabela">
              <th>PERFIL</th>
              <th width="100px">STATUS</th>
              <th width="300px">OPERAÇÕES</th>
              </tr>
            </thead>

            <tbody>
              <?php foreach ($listPerfil as $objPerfil): ?>
               <tr class="dadosTabela">

                  <td><?php echo $objPerfil->getPerfil(); ?></td>
                  <td><?php echo $objPerfil->printStatus(); ?></td>
                  <td class="td-actions">
                  <a href="<?php echo site_url('acesso_perfil/editar/'.$objPerfil->getId_perfil()); ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Editar</a>
                   <?php if($objPerfil->getId_perfil()!=PERFIL_MASTER){ ?>
                  <a href="#" class="confirm-delete btn btn-danger btn-sm" data-id="<?php echo $objPerfil->getId_perfil(); ?>"><i class="fa fa-trash"></i> Excluir</a>
                  <?php } ?>
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



<!-- OPERAÇÃO PARA EXCLUSÃO DE DADOS -->
<script type="text/javascript">
$(function () {

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
    location.href="<?php echo site_url('acesso_perfil/excluir'); ?>/"+id;

  });

});

</script>      