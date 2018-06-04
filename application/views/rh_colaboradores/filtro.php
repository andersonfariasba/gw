<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Pesquisa Funcionários</h2>
          <ul class="nav navbar-right panel_toolbox">
          <li><a href="<?php echo site_url('rh_colaboradores/cadastrar'); ?>"><i class="fa fa-plus-circle"></i> <strong>Novo Funcionário</strong></a></li>
          <li><a data-toggle="modal" href="#modal_pesquisa"><i class="fa fa-search"></i> <strong>Pesquisar Funcionário</strong></a></li>
          <li><a href="<?php echo site_url('relatorio_painel/menu');?>"><i class="fa fa-bar-chart"></i> <strong>Relatórios</strong></a></li>
        </ul>
          <div class="clearfix"></div>
      </div>


        <!-- ********* INICIO MIOLO **********-->
        <div class="x_content"> <!-- INICIO MIOLO-->

          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
             <tr class="fundoTituloTabela">
                <th>NOME</th>
                <th>CARGO</th>
                <th>CELULAR</th>
                <th>STATUS</th>
                <th>OPERAÇÕES</th>
              </tr>
            </thead>

            <tbody>
              <?php foreach ($listColaborador as $objColaborador): ?>
                 <tr class="dadosTabela">
                  <td><?php echo $objColaborador->getNome(); ?></td>
                  <td><?php echo $objColaborador->getCargo()->getCargo(); ?></td>
                  <td><?php echo $objColaborador->getCelular1(); ?></td>
                   <td><?php echo $objColaborador->printStatus(); ?></td>
                  <td class="td-actions">
                  <a href="<?php echo site_url('rh_colaboradores/editar/'.$objColaborador->getId_colaborador()); ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Editar</a>
                  
                   <?php if($objColaborador->getId_colaborador() != PAD_FUNC_ADM){ ?>
                  <a href="#" class="confirm-delete btn btn-danger btn-sm" data-id="<?php echo $objColaborador->getId_colaborador(); ?>"><i class="fa fa-trash"></i> Excluir</a>
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
              
                 <form class="form-horizontal" method="post" id="forgot_form" action="<?php echo base_url(); ?>rh_colaboradores/filtro/">
                  
               
                  <div class="form-group">
                      <label class="control-label col-md-1 col-sm-3 col-xs-12">Nome</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" name="nome" value="<?php echo set_value('nome')?>" maxlength="50"/>
                    </div>
                  </div>

                   <div class="form-group">
                      <label class="control-label col-md-1 col-sm-3 col-xs-12">Cargo</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                    <select class="form-control" name="id_cargo" id="id_cargo">
                        <option value="">Todos...</option>
                             <?php foreach ($listCargo as $objCargo): ?>
                            <option value="<?php echo $objCargo->getId_cargo(); ?>" <?php echo set_select('id_cargo',$objCargo->getId_cargo()); ?>>
                               <?php echo $objCargo->getCargo(); ?>
                            </option>
                             <?php endforeach; ?>
                    </select>

                    </div>
                  </div>

                  



                
              </div>
            </div>
            <div class="modal-footer">
             <a href="#" data-dismiss="modal" aria-hidden="true" class="btn">Fechar Janela</a>
              <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>Pesquisar</button>
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
    location.href="<?php echo site_url('rh_colaboradores/excluir'); ?>/"+id;

  });
  //FINAL OPERAÇÃO EXCLUSÃO

  





});

</script>      