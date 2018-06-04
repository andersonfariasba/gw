<?php 
$mod_locacao = $this->session->userdata('mod_locacao');
$mod_vendas = $this->session->userdata('mod_vendas');

$objDateFormat = $this->DateFormat; 

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
        <h2>Pesquisa Cliente</h2>
          <ul class="nav navbar-right panel_toolbox">
          <li><a href="<?php echo site_url('clientes/cadastrar'); ?>"><i class="fa fa-plus-circle"></i> <strong>Novo Cliente</strong></a></li>
          <li><a data-toggle="modal" href="#modal_pesquisa"><i class="fa fa-search"></i> <strong>Pesquisar Cliente</strong></a></li>
          <li><a href="<?php echo site_url('relatorio_painel/menu');?>"><i class="fa fa-bar-chart"></i> <strong>Relatórios</strong></a></li>
        </ul>
          <div class="clearfix"></div>
      </div>


        <!-- ********* INICIO MIOLO **********-->
        <div class="x_content"> <!-- INICIO MIOLO-->

          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr class="fundoTituloTabela">
                    <th>CLIENTE</th>
                    <th>CNPJ / CPF</th>
                    <th>TELEFONE</th>
                      
                  
                    <th>OPERAÇÕES</th>
                    
                    <th>HISTÓRICO</th>
                    
                    <?php if($mod_vendas==SIM){ ?>
                     <th>VENDA</th>
                    <?php } ?>
                    
                    <?php if($mod_locacao==SIM){ ?>
                     <th>LOCAÇÃO </th>
                     <?php } ?>
             

              </tr>
            </thead>

            <tbody>
             <?php foreach ($listCliente as $objCliente): ?>
                  <tr class="dadosTabela">
                    <td><?php echo $objCliente->getNome_fantasia(); ?></td>
                    <td><?php echo $objCliente->getCnpj_cpf(); ?></td>
                    <td>
                    <?php echo $objCliente->getCelular(); ?>
                    <br/>
                    <?php echo $objCliente->getTelefone1(); ?>

                    </td>
                  
                    
                  <td class="td-actions">
                

                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-primary">Opções</button>
                    <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                       <li><a href="<?php echo site_url('clientes/editar/'.$objCliente->getId_cliente()); ?>"><i class="fa fa-pencil"></i> <strong>Visualizar</strong></a>
                      </li>

                       <?php if($mod_vendas==SIM){ ?>
                      
                      <li>
                     
                      <?php echo anchor_popup(site_url('pedidos/solicitar_cliente/'.PEDIDO.'/'.$objCliente->getId_cliente()),'<span><i class="fa fa-rocket"></i> <strong>Gerar Venda</strong></span>',$janela);
?>
                      </a>
                      </li>

                      <?php } ?>

                         <?php if($mod_locacao==SIM){ ?>
                      
                      <li>
                     
                      <?php echo anchor_popup(site_url('locacao/solicitar_cliente/'.PEDIDO.'/'.$objCliente->getId_cliente()),'<span><i class="fa fa-rocket"></i> <strong>Gerar Venda</strong></span>',$janela);
?>
                      </a>
                      </li>

                      <?php } ?>
                      
                      <!--<li><?php echo anchor_popup(site_url('pedidos/solicitar_cliente/'.ORCAMENTO.'/'.$objCliente->getId_cliente()),'<span><i class="fa fa-plane"></i> <strong>Gerar Cotação</strong></span>',$janela);
?>
                      </li>-->

                      <li><a href="#" class="confirm-delete" data-id="<?php echo $objCliente->getId_cliente(); ?>"><i class="fa fa-trash"></i> <strong>Excluir Cliente</strong></a></li>
                     
                      <!--<li class="divider"></li>
                      <li><a href="#">Separated link</a>
                      </li>-->
                    </ul>
                  </div>
                  
                  </td>

                   <td align="center"> 
                   <a href="<?php echo site_url('pedidos/historico/'.$objCliente->getId_cliente()); ?>" class="btn btn-primary btn-sm" target="_blank" title="Historico do Cliente"><i class="fa fa-print"></i></a>
                       <!--<a href="<?php echo site_url('clientes/pdf/'.$objCliente->getId_cliente()); ?>" class="btn btn-info btn-sm" target="_blank"><i class="fa fa-file-pdf-o"></i> <strong>PDF</strong></a>-->
                   </td>

                   <?php if($mod_vendas==SIM){ ?>
                  <td>
                      <?php echo anchor_popup(site_url('pedidos/solicitar_cliente/'.PEDIDO.'/'.$objCliente->getId_cliente()),'<span class="btn btn-sm btn-success"><i class="fa fa-shopping-cart"></i><strong> Nova Venda</strong></span>',$janela);?>
                   </td>
                   <?php } ?>

                   <?php if($mod_locacao==SIM){ ?>
                  <td>
                      <?php echo anchor_popup(site_url('locacao/solicitar_cliente/'.PEDIDO.'/'.$objCliente->getId_cliente()),'<span class="btn btn-sm btn-success"><i class="fa fa-shopping-cart"></i><strong> Novo Locação</strong></span>',$janela);?>
                   </td>
                   <?php } ?>



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
              
                 <form class="form-horizontal" method="post" id="forgot_form" action="<?php echo base_url(); ?>clientes/filtro/">
                  
               
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Cliente</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" name="nome_fantasia" value="<?php echo set_value('nome_fantasia')?>"/>
                    </div>
                  </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">CNPJ OU CPF</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" name="cnpj_cpf" value="<?php echo set_value('cnpj_cpf')?>"/>
                    </div>
                  </div>

               
                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                    <select class="form-control" name="tipo" id="tipo">
                       <option value="">Todos</option>
                       <option value="<?= PESSOA_JURIDICA; ?>" <?= set_select('tipo',PESSOA_JURIDICA); ?>>Pessoa Juridica</option>
                      <option value="<?= PESSOA_FISICA; ?>" <?= set_select('tipo',PESSOA_FISICA); ?>>Pessoa Física</option>
                    </select>

                    </div>
                  </div>

                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                    <select class="form-control" name="status" id="status">
                      <option value="">Todos</option>
                      <option value="<?= ATIVO; ?>" <?= set_select('status',ATIVO); ?>>ATIVO</option>
                      <option value="<?= BLOQUEADO; ?>" <?= set_select('status',BLOQUEADO); ?>>BLOQUEADO</option>

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
    location.href="<?php echo site_url('clientes/excluir'); ?>/"+id;

  });
  //FINAL OPERAÇÃO EXCLUSÃO

  





});

</script>      