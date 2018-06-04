<?php $objDateFormat = $this->DateFormat; 
 
 $janela = array(
              'width'      => '2048',
              'height'     => '790',
              'scrollbars' => 'yes',
              'status'     => 'yes',
              'resizable'  => 'yes',
              'screenx'    => '200',
              'screeny'    => '100'
            );

?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
      <?php $titulo_pedido = ($tipo == PEDIDO ? 'Venda' : 'Cotação'); ?>
        <h2>Pesquisa <?php echo ($tipo == PEDIDO ? 'Venda' : 'Cotação'); ?></h2>
          <ul class="nav navbar-right panel_toolbox">
          <li>

         <?php echo anchor_popup(site_url('pedidos/solicitar_cliente/'.$tipo),' <i class="fa fa-plus-circle"></i> <strong>Nova '.$titulo_pedido.'</strong>',$janela);?></li>

        <!--li> <?php echo anchor_popup(site_url('pedidos/solicitar_cliente2/'.$tipo),' <i class="fa fa-plus-circle"></i> <strong>'.$titulo_pedido.' de Serviços</strong>',$janela);?></li>-->



        
          <li><a data-toggle="modal" href="#modal_pesquisa"><i class="fa fa-search"></i> <strong>Pesquisar <?php echo $titulo_pedido; ?></strong></a></li>
           <li>

            <li><a href="<?php echo site_url('pedidos/filtro/'.$tipo);?>"><i class="fa fa-refresh"></i> <strong>Atualizar Página</strong></a></li>

         

          <li><a href="<?php echo site_url('relatorio_painel/menu');?>"><i class="fa fa-bar-chart"></i> <strong>Relatórios</strong></a></li>


        </ul>
          <div class="clearfix"></div>
      </div>


     <!-- <div class="row top_tiles" style="margin: 10px 0;">
            
            <div class="col-md-3 col-sm-3 col-xs-6 tile">
              <span>Vendas Finalizadas</span>
              <h2>R$: 231,809</h2>
            </div>

            <div class="col-md-3 col-sm-3 col-xs-6 tile">
              <span>Vendas em Aberto</span>
              <h2>R$: 231,809</h2>
            </div>
            
            
          </div>-->

          
         <!-- ********* INICIO MIOLO **********-->
        <div class="x_content"> <!-- INICIO MIOLO-->

          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr class="fundoTituloTabela">
                    <th>DATA</th>
                    <th>COD. <?php echo ($tipo == PEDIDO ? 'VENDA' : 'COTAÇÃO'); ?></th>
                     <th>CLIENTE</th>
                      <th>USUÁRIO</th>
                     <th>VALOR</th>
                   
                    <th width="210px" class="td-actions">OPERAÇÕES</th>
                     <th width="170px">STATUS</th>
              </tr>
            </thead>

            <tbody>
           <?php 
                  $total = 0;
                  $total_lanc = 0;
                  foreach ($listPedidos as $objPedido): 
                   
                   
                   //if($objPedido->getStatus()==FINALIZADO){
                    if($objPedido->getFaturado()==SIM){
                     $total_lanc = $total_lanc + $objPedido->getTotal_venda();
                    }
                    else{

                   $total_pedido = ( $objPedido->getTotal_Itens() + $objPedido->getTaxa_frete() ) - $objPedido->getDesconto();
                   $total = $total + $total_pedido;
                   }
          ?>
                  <tr class="dadosTabela">
                 
                  <td><?php echo $objDateFormat->date_format_pedido($objPedido->getData_inicio()); ?></td>
                   <td align="center">
                     
                      <?php if($tipo==PEDIDO){ ?>
                      <span class="badge badge-success"><?php echo $objPedido->getCodigo(); ?></span>
                      <?php } else if($tipo==ORCAMENTO){ ?>
                         <span class="badge badge-warning"><?php echo $objPedido->getCodigo_orcamento(); ?></span>
                      <?php } ?>

                   </td>
                  <td><?php echo $objPedido->getCliente()->getNome_fantasia(); ?></td>
                   

                   <td><?php 
                   if($objPedido->getUsuario()!=null){
                    echo $objPedido->getUsuario()->getLogin(); 
                   }

                   ?>
                     
                   </td>
                
                 
                  <td>

                  R$: 

                  <?php 

                  //SE FOR VENDA PEGAR OS LANÇAMENTOS DO FINANCEIRO
                 // if($objPedido->getStatus()==FINALIZADO){
                   if($objPedido->getFaturado()==SIM){
                   echo  number_format($objPedido->getTotal_venda(), 2, ',', '.'); //number_format(round($objPedido->getTotal_venda(),1), 2, ',', '.');
                  } 
                  //SE ESTIVER EM ANDAMENTO PEGA OS VALORES REFERENTE AOS ITENS E DESCONTOS E ACRESCIMOS
                  else{
                    echo number_format( ($objPedido->getTotal_Itens() + $objPedido->getTaxa_frete() ) - $objPedido->getDesconto(), 2, ',', '.');
                  }

                   ?>

                  </td>
                                
                  
                  
                  <td class="td-actions">
                   <?php echo anchor_popup(site_url('pedidos/novo/'.$objPedido->getId_pedido()),'<span class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i><strong> ' .$titulo_pedido.'</strong></span>',$janela);?>

                   <a href="<?php echo site_url('pedidos/imprimir/'.$objPedido->getId_pedido()); ?>" class="btn btn-primary btn-sm" title="Imprimir" target="_blank"><i class="fa fa-print"></i> <strong></strong></a>
                   
                  
                  <?php if($objPedido->getTipo()==ORCAMENTO){ ?>
                  <a href="#" title="Gerar Venda" class="confirm-gerar-venda btn btn-success btn-sm" data-id="<?php echo $objPedido->getId_pedido(); ?>"><i class="fa fa-thumbs-up"></i></a>

                  <?php } ?>

                  
                  <a data-toggle="modal" title="Excluir" href="#modal_cancelar" class="confirm-delete btn btn-danger btn-sm" data-id="<?php echo $objPedido->getId_pedido(); ?>"><i class="fa fa-trash"> </i></a>



                   
                  
                  </td>

                  <td width="200px"> 


                  <!--<a href="<?php echo site_url('pedidos/novo/'.$objPedido->getId_pedido()); ?>" target="__blank">
                  <?php echo $objPedido->printStatus(); ?></a>-->

                  <!-- SELECÇÃO DE STATUS -->
    <div class="btn-group">

 <?php 

      $cor_direcao = "";
      if($objPedido->getObjStatus()!=null){ 

          $cor_direcao = $objPedido->getObjStatus()->getCor();
        ?>

  <button type="button" class="<?php echo $objPedido->getObjStatus()->getCor(); ?>"><strong>
            
 
       <?php  echo strtoupper($objPedido->getObjStatus()->getStatus()); ?>
     
    
  </strong></button>
<?php } ?>

  <button type="button" class="<?php echo $cor_direcao; ?> dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
  <span class="caret"></span>
  <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu" role="menu">
  <?php foreach($listStatus as $objStatus):  ?>
  <li><a href="<?php echo site_url('pedidos/alterar_status_filtro/'.$objPedido->getId_pedido().'/'.$objStatus->getId_status().'/'.$objPedido->getTipo()); ?>"><i class="fa fa-check"></i> <strong><?php echo strtoupper($objStatus->getStatus()); ?></strong></a></li>
  <?php endforeach; ?>
  
  </ul>

</div>


    <!-- FINAL SELEÇÃO DE STATUS -->



                  </td>
                  

                  
                </tr>

              <?php endforeach;?>

              
            </tbody>

             <tfoot>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th>R$: <?php echo number_format(round($total + $total_lanc,1), 2, ',', '.'); ?></th>
                  <th></th>
                  <th></th>
                

                  
                </tfoot>

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
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-search"></i> Pesquisar <?php echo $titulo_pedido; ?></h4>
            </div>
            <div class="modal-body">
              <div id="testmodal">
              
                 <form class="form-horizontal" method="post" id="forgot_form" action="<?php echo base_url(); ?>pedidos/filtro/<?php echo $tipo; ?>" >
                 <input type="hidden" name="tipo" value="<?php echo $tipo; ?>" id="tipo">
                  
               
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Código <?php echo $titulo_pedido; ?></label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      
                      <?php if($tipo==PEDIDO){ ?>
                      <input type="text" class="form-control" name="codigo" value="<?php echo set_value('codigo')?>"/>
                      <?php } else{ ?>

                       <input type="text" class="form-control" name="codigo_orcamento" value="<?php echo set_value('codigo_orcamento')?>"/>

                      <?php } ?>

                    </div>
                  </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Período De:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_de" value="<?php echo set_value('data_de')?>"/>
                    </div>
                  </div>

                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Período Até:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_ate" value="<?php echo set_value('data_ate')?>"/>
                    </div>
                  </div>

                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Usuário</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <select class="form-control" name="id_usuario" id="id_usuario">
                        <option value="">Todos...</option>
                        <?php foreach ($listUser as $objUser):  ?>
                        <option value="<?php echo $objUser->getId_usuario(); ?>">
                        <?php echo $objUser->getLogin(); ?>
                        </option>
                        <?php endforeach; ?>
                      </select>

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
                   <select class="form-control" name="status" id="status">
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


<!-- gerar venda -->

    <!-- Start venda -->
      <div id="CalenderModalVenda" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel">Deseja gerar uma venda?</h4>
            </div>
           
      <div class="modal-footer">
      <a href="#" id="btnYesVenda" class="btn btn-success"><i class="fa fa-thumbs-up"></i> Confirmar</a>
      <a href="#" data-dismiss="modal" aria-hidden="true" class="btn">Fechar Janela</a>
     
    </div>
          </div>
        </div>
      </div>
<!-- final gerar venda -->




<!-- Start Calendar modal -->
      <div id="modal_cancelar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-trash"></i> Cancelar Venda</h4>
            </div>
            <div class="modal-body">
              <div id="testmodal">
              
                 <form class="contact" method="post" action="<?php echo base_url(); ?>pedidos/cancelar/"; >
                 <input type="hidden" id="id_pedido_cancelar" name="id_pedido_cancelar" value="<?php echo set_value('id_pedido_cancelar')?>"> 
   
               
                  <div class="form-group">
                      <label class="control-label col-md-4 col-sm-3 col-xs-12">Senha Administrador</label>
                      <div class="col-md-4 col-sm-9 col-xs-12">
                      <input type="password" class="form-control" name="senha" value="<?php echo set_value('senha')?>"/>
                    </div>
                  </div>

                                                  



                
              </div>
            </div>
            <div class="modal-footer">
             <a href="#" data-dismiss="modal" aria-hidden="true" class="btn">Fechar Janela</a>
              <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Confirmar</button>
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
    $('#id_pedido_cancelar').val(id);
    
  });

  $('#btnYes').click(function() {
   
    var id = $('#CalenderModalNew').data('id');
    $('[data-id='+id+']').remove();
    $('#CalenderModalNew').modal('hide');
    location.href="<?php echo site_url('produtos/excluir'); ?>/"+id;

  });

  //FINAL OPERAÇÃO EXCLUSÃO

  


//OPERAÇÃO DE GERAR VENDA

 //OPERAÇÃO EXCLUSÃO 
  $('#CalenderModalVenda').on('show', function() {
    var id = $(this).data('id'),
    removeBtn = $(this).find('.danger');
  });

  $(document).on('click', '.confirm-gerar-venda', function(e) {
    e.preventDefault();

    var id = $(this).data('id');
    $('#CalenderModalVenda').data('id', id).modal('show');
  });

  $('#btnYesVenda').click(function() {
    // handle deletion here
   var id = $('#CalenderModalVenda').data('id');
    var id = $('#CalenderModalVenda').data('id');
    $('[data-id='+id+']').remove();
    $('#CalenderModalVenda').modal('hide');
    location.href="<?php echo site_url('pedidos/alterar_cotacao_filtro'); ?>/"+id;
    
    //alert(id);

  });
  //FINAL OPERAÇÃO EXCLUSÃO








});

</script>      