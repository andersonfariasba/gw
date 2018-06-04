<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Pesquisa Estoque</h2>
          <ul class="nav navbar-right panel_toolbox">
          <li><a href="<?php echo site_url('produtos/cadastrar'); ?>"><i class="fa fa-plus-circle"></i> <strong>Novo Produto</strong></a></li>
          <li><a data-toggle="modal" href="#modal_pesquisa"><i class="fa fa-search"></i> <strong>Pesquisar Produto</strong></a></li>
          <li><a href="<?php echo site_url('relatorio_painel/menu');?>"><i class="fa fa-bar-chart"></i> <strong>Relatórios</strong></a></li>
        </ul>
          <div class="clearfix"></div>
      </div>


        <!-- ********* INICIO MIOLO **********-->
        <div class="x_content"> <!-- INICIO MIOLO-->

          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr class="fundoTituloTabela">
                    <th width="130px">DESCRICAO</th>
                    <th width="50px">CÓDIGO</th>
                    <th>CATEGORIA</th>
                   
                    <th>VALOR</th>
                    <th>QTD DISPONÍVEL</th>
                   
                    <th class="td-actions" width="400px">OPERAÇÕES</th>
              </tr>
            </thead>

            <tbody>
             <?php 
                  $entrada = 0;
                  $saida = 0;
                  $qtd = 0;

                  
                  foreach ($listProdutos as $objProduto): 

                   
                    $qtd = $objProduto["saldo"];
   

                  
                     /*if ($objProduto->getQtdEstoque() != NULL) {
                        if($objProduto->getQtdEstoque()>0){
                      
                         $qtd_estoque = $objProduto->getQtdEstoque();
                        }
                    } else {
                        $qtd_estoque = '-';
                    } */

                  ?>
                  
                <?php if($qtd<0 || $qtd<$objProduto['qtd_minima'] ) { ?>
                   <tr class="dadosTabela aberto" style:color:red;>
              <?php } else { ?>
                  <tr class="dadosTabela">

              <?php } ?>


                  <td width="200px"><?php echo $objProduto['produto']; ?></td>
                  <td><?php echo $objProduto['codigo']; ?></td>
                  <td><?php echo $objProduto['categoria']; ?></td>
                
                  <td>R$: <?php echo number_format($objProduto['valor_venda'], 2, ',', '.'); ?></td>
                  
                 <td>
                  
                  <?php 
                  echo round($qtd,0);
                 ?>  
                   
                 </td>
                 
                  <td class="td-actions">
                 
                  <a href="<?php echo site_url('produtos/editar/'.$objProduto['id_produto']); ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> <strong>Visualizar</strong></a>
                  
                  <a href="<?php echo site_url('movimentacao_produto/cadastrar/'.$objProduto['id_produto']); ?>" class="btn btn-sm btn-success"><i class="fa fa-arrows-v"></i> <strong>Movimentar Estoque</strong></a>
                  

                  <a href="#" class="confirm-delete btn btn-danger btn-sm" data-id="<?php echo $objProduto['id_produto']; ?>"><i class="fa fa-trash"></i> <strong></strong></a>
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
              
                 <form class="form-horizontal" method="post" id="forgot_form" action="<?php echo base_url(); ?>produtos/filtro/">
                  
               
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Descrição</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" name="descricao" value="<?php echo set_value('descricao')?>"/>
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Código</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" name="codigo" value="<?php echo set_value('codigo')?>"/>
                    </div>
                  </div>

                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Categoria</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                    <select class="form-control" name="id_categoria" id="id_categoria">
                       <option value="">Selecione...</option>
                        <?php foreach ($listCategoria as $objCategoria): ?>
                        <option value="<?php echo $objCategoria->getId_categoria(); ?>" <?php echo set_select('id_categoria',$objCategoria->getId_categoria()); ?>>
                           <?php echo $objCategoria->getCategoria(); ?>
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
    location.href="<?php echo site_url('produtos/excluir'); ?>/"+id;

  });
  //FINAL OPERAÇÃO EXCLUSÃO

  





});

</script>      