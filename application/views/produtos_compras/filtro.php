<!-- modal filtro avançado -->	
<div id="form-content" class="modal hide fade in" style="display: none; ">
	        <div class="modal-header">
	              <a class="close" data-dismiss="modal">×</a>
                      <h3><i class="btn-icon-only icon-search"> </i>Pesquisa Avançada</h3>
	        </div>
		
			<!--<form class="contact">-->
                        
                        <form class="contact" method="post" id="forgot_form" action="<?php echo base_url(); ?>produtos/filtro">
                

    			<fieldset>
		         <div class="modal-body">
		        	 <ul class="nav nav-list">
                  <li class="nav-header">Categoria</li>
               <li> <select name="id_categoria" id="id_categoria">
                        <option value="">Selecione...</option>
                        <?php foreach ($listCategoria as $objCategoria): ?>
                        <option value="<?php echo $objCategoria->getId_categoria(); ?>" <?php echo set_select('id_categoria',$objCategoria->getId_categoria()); ?>>
                           <?php echo $objCategoria->getCategoria(); ?>
                        </option>
                         <?php endforeach; ?>
                 </select>
                </li>

                <li class="nav-header">Fornecedor</li>

                <li>
                   <select name="id_fornecedor" id="id_fornecedor">
                        <option value="">Selecione...</option>
                         <?php foreach ($listFornecedor as $objFornecedor): ?>
                        <option value="<?php echo $objFornecedor->getId_fornecedor(); ?>" <?php echo set_select('id_fornecedor',$objFornecedor->getId_fornecedor()); ?>>
                           <?php echo $objFornecedor->getNome_fantasia(); ?>
                        </option>
                         <?php endforeach; ?>
                </select>
                </li>


				<li class="nav-header">Descricao Produto</li>
				<li><input class="input-xlarge" type="text" name="descricao" id="descricao"></li>
				<li class="nav-header">Código Produto</li>
				<li><input class="input-xlarge" type="text" name="codigo" id="codigo"></li>
				
				</ul> 
		        </div>
			</fieldset>
			
		
	     <div class="modal-footer">
                 
               <button type="submit" class="btn btn-primary" id="salvar_orcamento">
                <i class="icon-search icon-white"></i> Buscar
               </button>
       
           <a href="#" class="btn" data-dismiss="modal"><i class="icon-remove icon-white"></i> Fechar</a>
  	   </div>
            </form>
	</div>
<!-- FINAL MODAL -->








<div class="pull-right"> 
<a href="<?php echo site_url('produtos_compras/cadastrar'); ?>" class="btn btn-small btn-success"><i class="btn-icon-only icon-plus"></i>Cadastrar Produto Compra</a>
<!--<a href="<?php echo site_url('movimentacao_produto_compra/filtro'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-search"></i>Listar Movimentação Compra</a>
-->
<a data-toggle="modal" href="#form-content" class="btn btn-primary btn-small"><i class="btn-icon-only icon-search"> </i>Pesquisa Avançada do Produto de Compra</a>

</div>


<div class="row">
  <div class="span12">
      
     <div class="widget ">
        <div class="widget-header">
                <i class="icon-tags"></i>
                <h3>Produtos de Compras Listagem</h3>
         </div> <!-- /widget-header -->
            <div class="widget-content">
              <table id="listagemDados" class="table table-striped table-bordered">

                <thead>
                  <tr>
                  <th width="130px">DESCRICAO</th>
                     <th width="50px">CÓDIGO</th>
                    <th>CATEGORIA</th>
                   <!--  <th>VALOR COMPRA</th>-->
                    <th>QTD DISPONÍVEL</th>
                    <th class="td-actions">OPERAÇÕES</th>
                  </tr>
                </thead>
                <tfoot>
                    <tr>
                  <th width="130px">DESCRICAO</th>
                     <th width="50px">CÓDIGO</th>
                    <th>CATEGORIA</th>
                     <!-- <th>VALOR COMPRA</th>-->
                    <th>QTD DISPONÍVEL</th>
                    <th class="td-actions">OPERAÇÕES</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php 
                  $qtd_estoque = 0;
                  foreach ($listProdutos as $objProduto): 

                  
                     if ($objProduto->getQtdEstoque() != NULL) {
                        if($objProduto->getQtdEstoque()>0){
                      
                         $qtd_estoque = $objProduto->getQtdEstoque();
                        }
                    } else {
                        $qtd_estoque = 0;
                    } 

                    


                  ?>
                  
                <?php if($qtd_estoque<$objProduto->getQtd_minima()) { ?>
                  <tr class="aberto">
              <?php } else{ ?>
                  <tr class="">

              <?php } ?>


                  <td><?php echo $objProduto->getDescricao(); ?></td>
                  <td><?php echo $objProduto->getCodigo(); ?></td>
                  <td><?php echo $objProduto->getCategoria()->getCategoria(); ?></td>
                  <!--<td>R$: <?php echo $objProduto->getValor_custo(); ?></td>-->
                  
                 <td>
                    
                    <?php 
                        
                       echo number_format($qtd_estoque, 3, ',', '.');
                       if($qtd_estoque>0){
                        echo " ".$objProduto->getUnidade()->getSigla();
                       }
                    ?>
                  </td>
                  
                  <td class="td-actions">
                     <a href="<?php echo site_url('produtos_compras/editar/'.$objProduto->getId_produto()); ?>" class="btn btn-small btn-primary"><i class="btn-icon-only icon-pencil"></i>Editar</a>
                     <a href="<?php echo site_url('produtos_compras/visualizar/'.$objProduto->getId_produto()); ?>" class="btn btn-small"><i class="btn-icon-only icon-list-alt"></i>Visualizar</a>
                      
                     <a href="<?php echo site_url('movimentacao_produto_compra/cadastrar/'.$objProduto->getId_produto()); ?>" class="btn btn-small btn-success"><i class="btn-icon-only icon-ok"></i>Movimentar Estoque Compra</a>
                      
                     <a href="#" class="confirm-delete btn btn-danger btn-small" data-id="<?php echo $objProduto->getId_produto(); ?>"><i class="btn-icon-only icon-remove"></i>Excluir Produto</a>
                    
                     
                   </td>
                    
                  </tr>
                  
                  <?php endforeach;?>
                  
                                  
                </tbody>
              </table>

            
           <?php if($listProdutos==null):?> 
           <div class="alert alert-success">
               <!--   <button type="button" class="close" data-dismiss="alert">&times;</button>-->
                    <strong>Nenhum Produto de Compra encontrado!</strong> <a href="<?php echo site_url('produtos_compras/cadastrar'); ?>" class="btn btn-small btn-success"><i class="btn-icon-only icon-ok"></i>Novo Produto Compra</a>
    
            </div>
            <?php endif; ?>
            
            </div>
                </div>
                
                
                
                <div id="myModal" class="modal hide">
    <div class="modal-header">
        <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
         <h3>Excluir</h3>
    </div>
    <div class="modal-body">
        
        <p><strong>Deseja realmente excluir o registro?</strong></p>
        <p class="saida">Essa operação apaga por completo os dados do produto, caso deseje realizar uma retirada no estoque acesse a opção "Movimentar Estoque" na listagem de produtos.</p>
    </div>
    <div class="modal-footer">
      <a href="#" id="btnYes" class="btn btn-danger">Confirmar exclusão</a>
      <a href="#" data-dismiss="modal" aria-hidden="true" class="btn secondary">Cancelar</a>
    </div>
                
                
                
                
                               
                    </div> <!-- /widget-content -->
                        </div> <!-- /widget -->
                        
                        
                    
<script type="text/javascript">
$(function () {

$('#myModal').on('show', function() {
    var id = $(this).data('id'),
        removeBtn = $(this).find('.danger');
});

$(document).on('click', '.confirm-delete', function(e) {
//$('.confirm-delete').on('click', function(e) {
   
    e.preventDefault();

    var id = $(this).data('id');
    $('#myModal').data('id', id).modal('show');
});

$('#btnYes').click(function() {
    // handle deletion here
  	var id = $('#myModal').data('id');
  	$('[data-id='+id+']').remove();
  	$('#myModal').modal('hide');
  	location.href="<?php echo site_url('produtos_compras/excluir'); ?>/"+id;
  	
});

});

</script>      


                  
                       
                        
                        
                        

