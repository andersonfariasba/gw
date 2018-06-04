<div class="pull-right">
<a href="<?php echo site_url('produtos_compras/filtro'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-search"></i>Buscar Produto Compra</a>
</div>
<div class="row">
  <div class="span12">
       <div class="widget ">
        <div class="widget-header">
                <i class="icon-tags"></i>
                <h3>Produto Compra Editar</h3>
         </div> <!-- /widget-header -->
            <div class="widget-content">
              <div class="tab-pane" id="formcontrols">
        
      <!--  <form action="" id="edit-profile" class="form-horizontal">-->
      <?php echo form_open('produtos_compras/editar/'.$objProduto->getId_produto(),array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
      <input type="hidden" name="tipo" value="<?php echo set_value('tipo',PRODUTO); ?>" />   
      <input type="hidden" name="id_produto" value="<?php echo $objProduto->getId_produto(); ?>">
       <input type="hidden" name="abater_estoque" value="<?php echo $objProduto->getAbater_estoque(); ?>">
        <input type="hidden" name="habilitado_venda" value="<?php echo $objProduto->getHabilitado_venda(); ?>">
        

        
      
            
            <fieldset>
            
               
           <?php if($msg==true){ ?>
            <div class="alert alert-success" id="msgOk">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><img src="<?php echo base_url()."/images/ativo.png"?>" width="25px" border="0">Edição realizada com sucesso!</strong>
            </div>
            <?php } ?>
            
             <?php echo validation_errors(); ?>
                <div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Dados Básicos</a></li>
      <li role="presentation"><a href="#obs" aria-controls="obs" role="tab" data-toggle="tab">Observações</a></li>
    
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    
   <!-- DADOS BÁSCIOS --> 
   <div role="tabpanel" class="tab-pane active" id="home">
    
     <fieldset class="grupo">
                        
            <div class="campo">
                <label for="nome" class="labelDados">Categoria:</label>
                 <select name="id_categoria" id="id_unidade">
                        <option value="">Selecione...</option>
                         <?php foreach ($listCategoria as $objCategoria): 
                             $categoria = $objCategoria->getId_categoria();
                             ?>
                        <option value="<?php echo $objCategoria->getId_categoria(); ?>" <?php echo set_select('id_categoria',$categoria,$objProduto->categoriaIs($categoria)); ?>>
                           <?php echo $objCategoria->getCategoria(); ?>
                        </option>
                         <?php endforeach; ?>
                    </select>

            </div>
            
           <div class="campo">
                <label for="data_nascimento" class="labelDados">Unidade de Medida:</label>
               <select name="id_unidade" id="id_unidade">
                        <option value="">Selecione...</option>
                         <?php foreach ($listUnidade as $objUnidade): 
                             $unidade = $objUnidade->getId_unidade();
                             ?>
                        <option value="<?php echo $objUnidade->getId_unidade(); ?>" <?php echo set_select('id_unidade',$unidade,$objProduto->unidadeIs($unidade)); ?>>
                           <?php echo $objUnidade->getUnidade(); ?>
                        </option>
                         <?php endforeach; ?>
                    </select>

           </div>
           
           <div class="campo">
                <label for="data_nascimento" class="labelDados">Fornecedor:</label>
                <select name="id_fornecedor" id="id_fornecedor">
                        <option value="">Selecione...</option>
                         <?php foreach ($listFornecedor as $objFornecedor): 
                             $fornecedor = $objFornecedor->getId_fornecedor();
                             ?>
                        <option value="<?php echo $objFornecedor->getId_fornecedor(); ?>" <?php echo set_select('id_fornecedor',$fornecedor,$objProduto->fornecedorIs($fornecedor)); ?>>
                           <?php echo $objFornecedor->getNome_fantasia(); ?>
                        </option>
                         <?php endforeach; ?>
                    </select>

           </div>
       </fieldset>

       
       <fieldset class="grupo">
                        
            <div class="campo">
                <label for="nome" class="labelDados">Descrição:</label>
                <input type="text" name="descricao" class="span4" id="descricao" value="<?php echo set_value('descricao',$objProduto->getDescricao())?>">
            </div>
       
          <div class="campo">
               <label for="nome" class="labelDados">Código:</label>
               <input type="text" name="codigo" class="span2" id="codigo" value="<?php echo set_value('codigo',$objProduto->getCodigo())?>">
     
          </div>
       
           <div class="campo">
                <label for="nome" class="labelDados">Referência:</label>
                <input type="text" name="referencia" class="span4" id="referencia" value="<?php echo set_value('referencia',$objProduto->getReferencia())?>">
          </div>
       
        </fieldset>
       
      <!-- <fieldset class="grupo">
                        
            <div class="campo">
                <label for="nome" class="labelDados">Valor Compra:</label>
                <input type="text" name="valor_custo" tipo="moneyReal" class="span2" id="valor_custo" value="<?php echo set_value('valor_custo',$objProduto->getValor_custo())?>">
            </div>
       
         <div class="campo">
               <label for="nome" class="labelDados">Valor Venda:</label>
              <input type="text" name="valor_venda" class="span2" tipo="moneyReal" id="valor_venda" value="<?php echo set_value('valor_venda',$objProduto->getValor_venda())?>">
        
          </div>
          
       
           <div class="campo">
                <label for="nome" class="labelDados">Quantidade Minima:</label>
                <input type="text" name="qtd_minima" class="span2" id="qtd_minima" value="<?php echo set_value('qtd_minima',$objProduto->getQtd_minima())?>">
          </div>
       
           
           <div class="campo">
                <label for="nome" class="labelDados">Localização:</label>
                <input type="text" name="localizacao" class="span4" id="localizacao" value="<?php echo set_value('localizacao',$objProduto->getLocalizacao())?>">
          </div>
          
       
        </fieldset> -->

    

       <!-- <fieldset class="grupo">
            <div class="campo">
                <label for="id_cargo" class="labelDados">Habilitar produto para venda?</label>
                 <label class="radio inline">
                    <input type="radio"  name="habilitado_venda" <?php if($objProduto->getHabilitado_venda()==SIM){echo "checked=''"; }?> value="<?php echo set_value('habilitado_venda',SIM)?>"> Sim
                </label>

                <label class="radio inline">
                  <input type="radio" name="habilitado_venda" <?php if($objProduto->getHabilitado_venda()==NAO){echo "checked=''"; }?> value="<?php echo set_value('habilitado_venda',NAO)?>"> Não
                </label>
            </div>
       </fieldset>      -->  


       

    
    
    
    
    
    </div><!-- FINAL DADOS BÁSCIOS -->
    
    <div role="tabpanel" class="tab-pane" id="obs">
        <fieldset class="grupo">
                        
            <div class="campo">
                <label for="nome" class="labelDados">Observação:</label>
                <textarea cols="50" rows="10" class="span6" name="observacao" id="observacao">
                   <?php echo $objProduto->getObservacao(); ?>
               </textarea>
                
            </div>
        </fieldset>
        
    </div>
    
  </div>

</div>

                
            
           
                     
            <div class="form-actions">
            
            <input type="submit" value="Salvar" class="btn btn-primary" />
            
            
            </div> <!-- /form-actions -->
        </fieldset>
        </form>
            
   
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