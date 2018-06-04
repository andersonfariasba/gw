<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Pesquisa Forma de Entrega</h2>
          <ul class="nav navbar-right panel_toolbox">
          <li><a href="<?php echo site_url('forma_entrega/cadastrar'); ?>"><i class="fa fa-plus-circle"></i> <strong>Nova Forma de Entrega</strong></a></li>
          <li><a data-toggle="modal" href="#modal_pesquisa"><i class="fa fa-search"></i> <strong>Pesquisar Forma de Entrega</strong></a></li>
         
          
        </ul>
          <div class="clearfix"></div>
      </div>


        <!-- ********* INICIO MIOLO **********-->
        <div class="x_content"> <!-- INICIO MIOLO-->

          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
               <tr class="fundoTituloTabela">
                <th>NOME FORMA DE ENTREGA</th>
                <th>SITUAÇÃO</th>
                <th>OPERAÇÕES</th>
              </tr>
            </thead>

            <tbody>
               <?php foreach ($listCategoria as $objCategoria): ?>
                 <tr class="dadosTabela">

                  <td><?php echo $objCategoria->getForma(); ?></td>
                  <td><?php echo $objCategoria->printStatus(); ?></td>
                  <td class="td-actions">
                  
                  <?php //if($objCategoria->getId_status()!=EM_ELABORACAO && $objCategoria->getId_status()!=ST_APROVADO){ ?>
                  <a href="<?php echo site_url('forma_entrega/editar/'.$objCategoria->getId_forma()); ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Editar</a>

                  <a href="#" class="confirm-delete btn btn-danger btn-sm" data-id="<?php echo $objCategoria->getId_forma(); ?>"><i class="fa fa-trash"></i> Excluir</a>
                  
                  <?php //} ?>
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
      <div id="modal_pesquisa" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-search"></i> Pesquisar</h4>
            </div>
            <div class="modal-body">
              <div id="testmodal">
                <!--<form id="antoform" class="form-horizontal" role="form">-->
                 <form class="form-horizontal" method="post" id="forgot_form" action="<?php echo base_url(); ?>forma_entrega/filtro/">
                  
               
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Nome da Forma</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" name="forma" value="<?php echo set_value('forma')?>" maxlength="50"/>
                    </div>
                  </div>

<div class="form-group">
                 <label class="control-label col-md-3 col-sm-3 col-xs-12">Situação</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                    <select class="form-control" name="situacao" id="situacao">
                       
               <option value="">Todos...</option>
               <option value="<?= ATIVO; ?>" <?= set_select('situacao',ATIVO); ?>>ATIVO</option>
               <option value="<?= BLOQUEADO; ?>" <?= set_select('situacao',BLOQUEADO); ?>>BLOQUEADO</option>

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
    location.href="<?php echo site_url('forma_entrega/excluir'); ?>/"+id;

  });
  //FINAL OPERAÇÃO EXCLUSÃO

  





});

</script>      