<?php $perfil_acesso = $this->session->userdata('id_perfil'); ?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Pesquisa Motivo Movimentação Estoque</h2>
          <ul class="nav navbar-right panel_toolbox">
         
          <li><a href="<?php echo site_url('motivo_mov/cadastrar'); ?>"><i class="fa fa-plus-circle"></i> <strong>Novo Motivo</strong></a></li>
        

          <li><a data-toggle="modal" href="#modal_pesquisa"><i class="fa fa-search"></i> <strong>Pesquisar</strong></a></li>
          
        </ul>
          <div class="clearfix"></div>
      </div>


        <!-- ********* INICIO MIOLO **********-->
        <div class="x_content"> <!-- INICIO MIOLO-->

          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
               <tr class="fundoTituloTabela">
               
                <th>MOTIVO DA MOVIMENTAÇÃO</th>
                  <!--<th>CATEGORIA</th>-->
                <th>OPERAÇÕES</th>
              </tr>
            </thead>

            <tbody>
               <?php 


               foreach ($list as $objCategoria): ?>
                 <tr class="dadosTabela">

               
                  <td><?php echo $objCategoria->getDescricao(); ?></td>
                 <!-- <td><?php echo $objCategoria->printTipo(); ?></td>-->
                  <td class="td-actions">
                  
                  <a href="<?php echo site_url('motivo_mov/editar/'.$objCategoria->getId_motivo()); ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Editar</a>
                 
                  
                   <?php if($perfil_acesso==PERFIL_MASTER){ ?>
                  <a href="#" class="confirm-delete btn btn-danger btn-sm" data-id="<?php echo $objCategoria->getId_motivo(); ?>"><i class="fa fa-trash"></i> Excluir
                  </a>
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
                 <form class="form-horizontal" method="post" id="forgot_form" action="<?php echo base_url(); ?>motivo_mov/filtro/">
                  
               
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Motivo Movimentação</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" name="descricao" value="<?php echo set_value('descricao')?>" maxlength="50"/>
                    </div>
                  </div>

                    <!-- <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Categoria</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <select class="form-control" name="tipo" id="tipo">
                        
               <option value="">Selecione...</option>
               <option value="<?= TIPO_MOT_ENTRADA; ?>" <?= set_select('tipo',TIPO_MOT_ENTRADA); ?>>REQUISIÇÃO DE ENTRADA</option>
               <option value="<?= TIPO_MOT_TRANSF; ?>" <?= set_select('tipo',TIPO_MOT_TRANSF); ?>>TRANSFERÊNCIA</option>
                 <option value="<?= TIPO_MOT_SAIDA; ?>" <?= set_select('tipo',TIPO_MOT_SAIDA); ?>>REQUISIÇÃO DE SAÍDA</option>

                    </select>
                    </div>
                  </div>-->

                   
                
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
    location.href="<?php echo site_url('motivo_mov/excluir'); ?>/"+id;

  });
  //FINAL OPERAÇÃO EXCLUSÃO

  





});

</script>      