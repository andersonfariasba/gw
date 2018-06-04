<?php $objDateFormat = $this->DateFormat; ?> 
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Pesquisar Cotação Materiais</h2>
          <ul class="nav navbar-right panel_toolbox">
                   
          <li><a data-toggle="modal" href="#modal_pesquisa"><i class="fa fa-search"></i> <strong>Pesquisar Cotações</strong></a></li>
          
        </ul>
          <div class="clearfix"></div>
      </div>


        <!-- ********* INICIO MIOLO **********-->
        <div class="x_content"> <!-- INICIO MIOLO-->

          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
               <tr class="fundoTituloTabela">
                <th>DATA SOLICITAÇÃO</th>
                <th>DATA PRIORIDADE</th>
                <th>Nº DA OS</th>
                <th>REQUISITANTE</th>
                <th>APROVADOR</th>
                <th>STATUS</th>
                <th>OPERAÇÕES</th>
              </tr>
            </thead>

            <tbody>
               <?php foreach ($listSolicitacao as $objSolicitacao): ?>
                 <tr class="dadosTabela">

                  <td><?php echo $objDateFormat->date_format($objSolicitacao->getData_criacao()); ?></td>
                   <td><?php echo $objDateFormat->date_format($objSolicitacao->getData_necessidade()); ?></td>
                   <td><?php echo $objSolicitacao->getId_solicitacao(); ?></td>
                   
                   <td>
                      <?php 
                          
                          if($objSolicitacao->getColaborador()!=null){
                            echo $objSolicitacao->getColaborador()->getNome();
                           }
                          ?>  
                   </td>

                    <td>
                      <?php 
                          
                          if($objSolicitacao->getAprovador_cotacao()!=null){
                            echo $objSolicitacao->getAprovador_cotacao()->getNome();
                            echo "<br>";
                            echo "Em: ".$objDateFormat->date_format($objSolicitacao->getData_aprovacao_cotacao());
                           }
                          ?>  
                   </td>

                   
                   <td>
                     <?php
                            //if($objSolicitacao->getObjStatus()!=null){
                            //echo $objSolicitacao->getObjStatus()->getStatus();
                           //}
                          ?> 

        <div class="btn-group">
          
            
            <?php 
            
            if($objSolicitacao->getObjStatusCotacao()!=null){
          
              if($objSolicitacao->getId_status_cotacao()==ST_APROVADO_PARCIAL){
                  echo "<button type='button' class='btn btn-sm btn-warning'><strong>".strtoupper($objSolicitacao->getObjStatusCotacao()->getStatus())." </strong></button>";
              }
              else if($objSolicitacao->getId_status_cotacao()==ST_APROVADO){
                  echo "<button type='button' class='btn btn-sm btn-success'><strong> ".strtoupper($objSolicitacao->getObjStatusCotacao()->getStatus())."</strong></button>";
              }
              else{
                echo "<button type='button' class='btn btn-sm btn-primary'><strong>".strtoupper($objSolicitacao->getObjStatusCotacao()->getStatus())." </strong></button>";
              }

              
                        
            }
            
            ?>
           
          
        </div>

    
                   </td>
                  
                  <td class="td-actions">
                 
                  <a href="<?php echo site_url('cotacao/visualizar/'.$objSolicitacao->getId_solicitacao()); ?>" class="btn btn-sm btn-primary"><strong><i class="fa fa-pencil"></i> Visualizar</strong></a>

                 <!-- <a href="#" class="confirm-delete btn btn-danger btn-sm" data-id="<?php echo $objSolicitacao->getId_solicitacao(); ?>"><i class="fa fa-trash"></i> Excluir</a>-->

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
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-search"></i> Pesquisar Cotação de Material</h4>
            </div>
            <div class="modal-body">
              <div id="testmodal">
                <!--<form id="antoform" class="form-horizontal" role="form">-->
                 <form class="form-horizontal" method="post" id="forgot_form" action="<?php echo base_url(); ?>cotacao/filtro/">
                  
               
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Criacao (De:)</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_de" value="<?php echo set_value('categoria')?>" maxlength="50" placeholder="99/99/9999"/>
                    </div>
                  </div>

                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Criacao (Até:)</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_ate" value="<?php echo set_value('categoria')?>" maxlength="50" placeholder="99/99/9999"/>
                    </div>
                  </div>

                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Prioridade (De:)</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_de_priori" value="<?php echo set_value('categoria')?>" maxlength="50" placeholder="99/99/9999"/>
                    </div>
                  </div>

                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Prioridade (Até:)</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_ate_priori" value="<?php echo set_value('categoria')?>" maxlength="50" placeholder="99/99/9999"/>
                    </div>
                  </div>

                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Numero OS</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" name="id_solicitacao" value="<?php echo set_value('categoria')?>" maxlength="50"/>
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

                     <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Requisitante</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <select class="form-control" name="id_solicitante" id="id_solicitante">
                        <option value="">Todos...</option>
                        <?php foreach ($listUser as $objUser):  ?>
                        <option value="<?php echo $objUser->getId_colaborador(); ?>">
                        <?php echo $objUser->getNome(); ?>
                        </option>
                        <?php endforeach; ?>
                      </select>

                    </div>
                  </div>

                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Aprovador</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                     <select class="form-control" name="id_aprovador" id="id_aprovador">
                         <option value="">Todos...</option>
                        <?php foreach ($listUserAprovador as $objUser): 
                           
                             ?>
                        <option value="<?php echo $objUser->getId_colaborador(); ?>" <?php echo set_select('id_aprovador'); ?>>
                           <?php echo $objUser->getColaborador()->getNome(); ?>
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
    location.href="<?php echo site_url('est_categorias/excluir'); ?>/"+id;

  });
  //FINAL OPERAÇÃO EXCLUSÃO

  





});

</script>      