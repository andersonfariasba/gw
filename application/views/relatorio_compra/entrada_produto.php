<div class="pull-right">
<a href="<?php echo site_url('relatorio_estoque/menu'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-search"></i>Menu Relatorio Estoque</a>
</div>


<div class="row">
  <div class="span12">
       <div class="widget ">
        <div class="widget-header" style="padding-left:5px;">
                 <img src="<?php echo base_url()."/imgs/compras.png"?>" width="30px" border="0">
                <h3>Relatório Produtos Compras</h3>
         </div> <!-- /widget-header -->
            <div class="widget-content">
              <div class="tab-pane" id="formcontrols">
        
      <!--  <form action="" id="edit-profile" class="form-horizontal">-->
            
       <form class="contact" method="post" target="_blank" id="forgot_form" action="<?php echo base_url(); ?>relatorio_compra/estoque">
            
            
            <fieldset>
        
            
                           
      <fieldset class="grupo">
                        
            <div class="campo">
             <label for="nome" class="labelDados">Categoria:</label>
             <select name="id_categoria" id="id_categoria">
                        <option value="">Todos...</option>
                        <?php foreach ($listCategoria as $objCategoria): ?>
                        <option value="<?php echo $objCategoria->getId_categoria(); ?>" <?php echo set_select('id_categoria',$objCategoria->getId_categoria()); ?>>
                           <?php echo $objCategoria->getCategoria(); ?>
                        </option>
                         <?php endforeach; ?>
                 </select>
            </div>

             <div class="campo">
              <label for="nome" class="labelDados">Fornecedor:</label>
               <select name="id_fornecedor" id="id_fornecedor">
                        <option value="">Todos...</option>
                         <?php foreach ($listFornecedor as $objFornecedor): ?>
                        <option value="<?php echo $objFornecedor->getId_fornecedor(); ?>" <?php echo set_select('id_fornecedor',$objFornecedor->getId_fornecedor()); ?>>
                           <?php echo $objFornecedor->getNome_fantasia(); ?>
                        </option>
                         <?php endforeach; ?>
                </select>
            </div>

             <div class="campo">
              <label for="nome" class="labelDados">Nome Produto:</label>
              <input type="text" name="descricao" class="span3" id="descricao" value="<?php echo set_value('descricao')?>">
             </div>

              <div class="campo">
              <label for="nome" class="labelDados">Código:</label>
              <input type="text" name="codigo" class="span2" id="codigo" value="<?php echo set_value('descricao')?>">
             </div>

              




    </fieldset>
           
                        
                     
            <div class="form-actions">
            
            <input type="submit" value="Gerar Relatório" class="btn btn-primary" />
         
            
            
            </div> <!-- /form-actions -->
        </fieldset>
        </form>
        </div>

            </div>
                </div>
                    </div> <!-- /widget-content -->
                        </div> <!-- /widget -->


<script type="text/javascript">

<?php if($msg==true){ ?>
  //função para ocultar mensagem de cadastro: arquivo: js/base.js
  hideMessage();

<?php } ?>

</script>
                        
