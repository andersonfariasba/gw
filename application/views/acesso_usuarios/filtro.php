<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Pesquisa Usuários Sistema</h2>
          <ul class="nav navbar-right panel_toolbox">
          <li><a href="<?php echo site_url('acesso_usuarios/cadastrar'); ?>"><i class="fa fa-plus-circle"></i> <strong>Novo Usuário</strong></a></li>
          <li><a data-toggle="modal" href="#modal_pesquisa"><i class="fa fa-search"></i> <strong>Pesquisar Usuário</strong></a></li>
          <li><a href="<?php echo site_url('relatorio_painel/menu');?>"><i class="fa fa-bar-chart"></i> <strong>Relatórios</strong></a></li>
        </ul>
          <div class="clearfix"></div>
      </div>


        <!-- ********* INICIO MIOLO **********-->
        <div class="x_content"> <!-- INICIO MIOLO-->

          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr class="fundoTituloTabela">
                <th>LOGIN</th>
                <th>COLABORADOR</th>
                <th>PERFIL</th>
                <th>STATUS</th>
                <th>OPERAÇÕES</th>
              </tr>
            </thead>

            <tbody>
              <?php foreach ($listUser as $objUser): ?>
               <tr class="dadosTabela">

                  <td><?php echo $objUser->getLogin(); ?></td>
                  <td><?php 
                       if($objUser->getColaborador()!=null){
                        echo $objUser->getColaborador()->getNome();
                      }

                   ?></td>
                  <td><?php echo $objUser->getPerfil()->getPerfil(); ?></td>
                  <td><?php echo $objUser->printStatus(); ?></td>
                  <td class="td-actions">
                  <a href="<?php echo site_url('acesso_usuarios/editar/'.$objUser->getId_usuario()); ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Editar</a>
                 <?php if($objUser->getId_usuario()!=CODIGO_ADMINISTRADOR){ ?>
                  <a href="#" class="confirm-delete btn btn-danger btn-sm" data-id="<?php echo $objUser->getId_usuario(); ?>"><i class="fa fa-trash"></i> Excluir</a>
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
                <!--<form id="antoform" class="form-horizontal" role="form">-->
                 <form class="form-horizontal" method="post" id="forgot_form" action="<?php echo base_url(); ?>acesso_usuarios/filtro/">
                  
                 <div class="form-group">
                      <label class="control-label col-md-1 col-sm-3 col-xs-12">Perfil</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                    <select class="form-control" name="id_perfil" id="id_perfil">
                        <option value="">Todos</option>
                         <?php foreach ($listPerfil as $objPerfil): ?>
                        <option value="<?php echo $objPerfil->getId_perfil(); ?>" <?php echo set_select('id_perfil',$objPerfil->getId_perfil()); ?>>
                           <?php echo $objPerfil->getPerfil(); ?>
                        </option>
                         <?php endforeach; ?>
                    </select>

                    </div>
                  </div>


                  <div class="form-group">
                      <label class="control-label col-md-1 col-sm-3 col-xs-12">Login</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" name="login" value="<?php echo set_value('login')?>" maxlength="50"/>
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
    location.href="<?php echo site_url('acesso_usuarios/excluir'); ?>/"+id;

  });
  //FINAL OPERAÇÃO EXCLUSÃO

  





});

</script>      