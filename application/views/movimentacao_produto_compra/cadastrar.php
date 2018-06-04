<div class="pull-right">
<a href="<?php echo site_url('produtos_compras/filtro'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-search"></i>Buscar Produto Compra</a>
</div>

<div class="row">
  <div class="span12">
       <div class="widget ">
        <div class="widget-header">
                <i class="icon-retweet"></i>
                <h3>Movimentação de Compra Avulso</h3>
         </div> <!-- /widget-header -->
            <div class="widget-content">
              <div class="tab-pane" id="formcontrols">
        
      <!--  <form action="" id="edit-profile" class="form-horizontal">-->
            
    <?php echo form_open('movimentacao_produto_compra/cadastrar/'.$objProduto->getId_produto(),array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
      
      <input type="hidden" name="id_produto" class="span4" id="id_produto" value="<?php echo set_value('id_produto',$objProduto->getId_produto())?>">
                
            
            <fieldset>
            
             <?php if($msg==true){ ?>
            <div class="alert alert-success" id="msgOk">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><img src="<?php echo base_url()."/images/ativo.png"?>" width="25px" border="0">Cadastro realizado com sucesso!</strong>
            </div>
            <?php } ?>
                     
            
             <?php echo validation_errors(); ?>
            
                           
            
            <div class="control-group">											
                <label class="control-label" for="unidade"><strong>Produto:</strong></label>
                <div class="controls">
                <?php echo $objProduto->getDescricao(); ?>
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->
            
            <div class="control-group">											
            <label class="control-label"><strong>Tipo Movimentação:</strong></label>
             
             <div class="controls">
                <label class="radio inline">
                    <input type="radio"  name="tipo_movimentacao" id="tipo_mov_entrada" checked="" value="<?php echo set_value('tipo_movimentacao',ENTRADA)?>"> <span style="color:green;font-weight:bold">Entrada</span>
                </label>

                <label class="radio inline">
                    <input type="radio" name="tipo_movimentacao" id="tipo_mov_saida" value="<?php echo set_value('tipo_movimentacao',SAIDA)?>"> <span style="color:red;font-weight:bold">Saída</span>
                </label>
              </div>	<!-- /controls -->			
      </div> <!-- /control-group -->


           
            <div class="control-group">											
                <label class="control-label" for="qtd_mov"><strong>Quantidade:</strong></label>
                <div class="controls">
                <input type="text" name="qtd_mov" class="span2 quantidade" id="qtd_mov" value="<?php echo set_value('qtd_mov')?>" onkeypress='return SomenteNumero(event)'>
                
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->

            
            <div class="control-group">											
                <label class="control-label" for="responsavel"><strong>Responsável:</strong></label>
                <div class="controls">
                <input type="text" name="responsavel" class="span4" id="responsavel" value="<?php echo set_value('responsavel')?>">
                
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->
            
            
            <div class="control-group">											
                <label class="control-label" for="descricao"><strong>Motivo:</strong></label>
                <div class="controls">
                <input type="text" name="descricao" class="span4" id="descricao" value="<?php echo set_value('descricao')?>">
                
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->
            
            
            <div class="control-group" id="fornecedor_camada">											
                <label class="control-label" for="id_fornecedor"><strong>Fornecedor:</strong></label>
                <div class="controls">
                    <select name="id_fornecedor" id="id_fornecedor">
                        <option value="">Selecione...</option>
                         <?php foreach ($listFornecedor as $objFornecedor): ?>
                        <option value="<?php echo $objFornecedor->getId_fornecedor(); ?>" <?php echo set_select('id_fornecedor',$objFornecedor->getId_fornecedor()); ?>>
                           <?php echo $objFornecedor->getNome_fantasia(); ?>
                        </option>
                         <?php endforeach; ?>
                    </select>
                </div> <!-- /controls -->				
    </div> <!-- /control-group -->

            
            
            
            
            

            
                     
            <div class="form-actions">
            
            <input type="submit" value="Salvar" class="btn btn-primary" />
           
            <!-- <button type="submit" class="btn btn-primary">Salvar</button> 
            <button class="btn">Cancelar</button>-->
            
            
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


<script type="text/javascript">
 $(function() {

//mask quantidade
  $('.quantidade').keyup(function () {
    var v = this.value,
        integer = v.split('.')[0];

    v = v.replace(/\D/, "");
    v = v.replace(/^[0]+/, "");

    if (v.length <= 3 || !integer) {
        if (v.length === 1) v = '0.00' + v;
        if (v.length === 2) v = '0.0' + v;
        if (v.length === 3) v = '0.' + v;
    } else {
        v = v.replace(/^(\d{1,})(\d{3})$/, "$1.$2");
    }

    this.value = v;
});
  
      $(document).ready(function(){
                        
          

            $("#tipo_mov_entrada").click(function(){
                 $("#fornecedor_camada").show();
                
            });
             
             $("#tipo_mov_saida").click(function(){
                $("#fornecedor_camada").hide();
             });
                      
      });

  });

 </script>