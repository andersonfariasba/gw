<div class="pull-right">
<a href="<?php echo site_url('produtos/filtro'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-search"></i>Buscar Produto</a>
</div>
<div class="row">
  <div class="span12">
       <div class="widget ">
        <div class="widget-header">
                <i class="icon-tags"></i>
                <h3>Produto Visualizar</h3>
         </div> <!-- /widget-header -->
            <div class="widget-content">
              <div class="tab-pane" id="formcontrols">
                  
            
            
            <fieldset>
            
            
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
                <select name="id_categoria" disabled="disabled" id="id_unidade">
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
               <select name="id_unidade" disabled="disabled" id="id_unidade">
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
                <select name="id_fornecedor" disabled="disabled" id="id_fornecedor">
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
                <input type="text" disabled="disabled" name="descricao" class="span4" id="descricao" value="<?php echo set_value('descricao',$objProduto->getDescricao())?>">
            </div>
       
          <div class="campo">
               <label for="nome" class="labelDados">Código:</label>
               <input type="text" name="codigo" disabled="disabled" class="span2" id="codigo" value="<?php echo set_value('codigo',$objProduto->getCodigo())?>">
     
          </div>
       
           <div class="campo">
                <label for="nome" class="labelDados">Referência:</label>
                <input type="text" name="referencia" disabled="disabled" class="span4" id="referencia" value="<?php echo set_value('referencia',$objProduto->getReferencia())?>">
          </div>
       
        </fieldset>
       
       <fieldset class="grupo">
                        
            <div class="campo">
                <label for="nome" class="labelDados">Valor Custo:</label>
                <input type="text" name="valor_custo" disabled="disabled" tipo="moneyReal" class="span2" id="valor_custo" value="<?php echo set_value('valor_custo',$objProduto->getValor_custo())?>">
            </div>
       
          <div class="campo">
               <label for="nome" class="labelDados">Valor Venda:</label>
              <input type="text" name="valor_venda" disabled="disabled" class="span2" tipo="moneyReal" id="valor_venda" value="<?php echo set_value('valor_venda',$objProduto->getValor_venda())?>">
        
          </div>
       
           <div class="campo">
                <label for="nome" class="labelDados">Quantidade Minima:</label>
                <input type="text" name="qtd_minima" disabled="disabled" class="span2" id="qtd_minima" value="<?php echo set_value('qtd_minima',$objProduto->getQtd_minima())?>">
          </div>
       
           
           <div class="campo">
                <label for="nome" class="labelDados">Localização:</label>
                <input type="text" name="localizacao" disabled="disabled" class="span4" id="localizacao" value="<?php echo set_value('localizacao',$objProduto->getLocalizacao())?>">
          </div>
       
        </fieldset>

       

    
    
    
    
    
    </div><!-- FINAL DADOS BÁSCIOS -->
    
    <div role="tabpanel" class="tab-pane" id="obs">
        <fieldset class="grupo">
                        
            <div class="campo">
                <label for="nome" class="labelDados">Observação:</label>
                <textarea cols="50" disabled="disabled" rows="10" class="span6" name="observacao" id="observacao">
                   <?php echo $objProduto->getObservacao(); ?>
               </textarea>
                
            </div>
        </fieldset>
        
    </div>
    
  </div>

</div>

                
            
           
                     
            <div class="form-actions">
            
           <a href="<?php echo site_url('produtos/editar/'.$objProduto->getId_produto()); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-edit"></i>Editar Produto</a>
           <a href="<?php echo site_url('produtos/cadastrar'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-plus"></i>Novo Produto</a>
           <a href="<?php echo site_url('produtos/filtro'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-search"></i>Buscar Produto</a>
           <!--<a href="<?php echo site_url('produtos/pdf/'.$objProduto->getId_produto()); ?>" target="_blank" class="btn btn-small btn-info"><i class="btn-icon-only icon-print"></i>Imprimir</a>--> 
            
            
            </div> <!-- /form-actions -->
        </fieldset>
        </form>
     
        
     
              </div>

            </div>
                </div>
                    </div> <!-- /widget-content -->
                        </div> <!-- /widget -->
                        

