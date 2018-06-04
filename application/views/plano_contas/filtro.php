<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Pesquisa Plano de Contas</h2>
          <ul class="nav navbar-right panel_toolbox">
          <li><a href="<?php echo site_url('plano_contas/cadastrar'); ?>"><i class="fa fa-plus-circle"></i> <strong>Novo</strong></a></li>
           <li><a data-toggle="modal" href="#modal_pesquisa"><i class="fa fa-search"></i> <strong>Pesquisar</strong></a></li>
          <li><a href="<?php echo site_url('relatorio_painel/menu'); ?>"><i class="fa fa-bar-chart"></i> <strong>Relatórios</strong></a></li>
        </ul>
          <div class="clearfix"></div>
      </div>


        <!-- ********* INICIO MIOLO **********-->
        <div class="x_content"> <!-- INICIO MIOLO-->

          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr class="fundoTituloTabela">
              <th>TIPO</th>
              <th>GRUPO</th>
              <th>CLASSIFICAÇÃO</th>
              <th>NOME</th>
              <th>STATUS</th>
              <th width="300px">OPERAÇÕES</th>
              </tr>
            </thead>

            <tbody>
              <?php foreach ($listPlanos as $objPlano): ?>
               <tr class="dadosTabela">

                  
                   <td>

                   <?php 

                   if($objPlano->getGrupo()!=null){
                          if($objPlano->getGrupo()->getTipo_conta()==CONTAS_PAGAR){
                            echo "DESPESAS";
                          }
                          else{
                            echo "RECEITAS";
                          }

                    }

                  ?>
                     
                   </td>
                  

                  <td>

                  <?php 
                  
                  if($objPlano->getGrupo()!=null){
                    echo $objPlano->getGrupo()->getNome(); 
                  }

                  ?>
                    

                  </td>
                  
                 
                   <td><?php echo $objPlano->getClassificacao(); ?></td>
                    <td><?php echo $objPlano->getNome(); ?></td>
                  <td><?php echo $objPlano->printStatus(); ?></td>
                  <td class="td-actions">
                  <a href="<?php echo site_url('plano_contas/editar/'.$objPlano->getId_plano()); ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Editar</a>
                  <a href="#" class="confirm-delete btn btn-danger btn-sm" data-id="<?php echo $objPlano->getId_plano(); ?>"><i class="fa fa-trash"></i> Excluir</a>
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
                 <form class="form-horizontal" method="post" id="forgot_form" action="<?php echo base_url(); ?>plano_contas/filtro/">
                  
               
                

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo de Conta</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                    <select class="form-control" id="tipo_conta" name="tipo_conta">
                      <option>Selecione...</option>
                      <option value="<?php echo CONTAS_PAGAR; ?>">DESPESAS</option>
                      <option value="<?php echo CONTAS_RECEBER; ?>">RECEITAS</option>
                    </select>
          </div>


          </div>

           <div class="form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12">Grupo</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                       
                        <select class="form-control" name="id_plano_categoria" id="id_plano_categoria">
                           <option value="">Selecione...</option>
                        </select>
          </div>
          </div>

            <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Classificação</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" name="classificacao" value="<?php echo set_value('classificacao')?>" maxlength="50"/>
                    </div>
            </div>

            <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Nome</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" name="nome" value="<?php echo set_value('nome')?>" maxlength="50"/>
                    </div>
            </div>
          

                   
                
              </div>
            </div>
            <div class="modal-footer">
              <!--<button type="button" class="btn antoclose" data-dismiss="modal">Fechar</button>-->
              <a href="#" data-dismiss="modal" aria-hidden="true" class="btn">Fechar Janela</a>
              <button type="submit" class="btn btn-primary"> <i class="fa fa-search"></i>  Pesquisar</button>
              </form>
            </div>
          </div>
        </div>
      </div>


      <!-- final modal pesquisa -->




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
    location.href="<?php echo site_url('plano_contas/excluir'); ?>/"+id;

  });

});

</script>      


<script type="text/javascript">
 $(function(){
      

  $('#tipo_conta').change(function(){

 
   var url = '<?= site_url("/plano_contas/ajax_listar_tipo/"); ?>/'+$(this).val();
   $.getJSON(url, function(j){
                             
      var options = '';
       options += '<option value="">Selecione...</option>';
       for (var i = 0; i < j.length; i++) {
          options += '<option value="' + j[i].id_plano_categoria + '">' +j[i].classificacao+" "+j[i].nome + '</option>';
        } 
       
       
       $('#id_plano_categoria').html(options).show();
       
    });

     });


});

</script>
