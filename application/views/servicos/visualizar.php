<div class="pull-right">
<a href="<?php echo site_url('servicos/filtro'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-search"></i>Buscar Prato</a>
</div>
<div class="row">
  <div class="span12">
       <div class="widget ">
        <div class="widget-header">
                <i class="icon-wrench"></i>
                <h3>Prato Visualizar</h3>
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
                <label for="data_nascimento" class="labelDados">Prato:</label>
                <input type="text" name="descricao" disabled="disabled" class="span4" id="descricao" value="<?php echo set_value('descricao',$objProduto->getDescricao())?>">
     
           </div>
           
           <div class="campo">
                <label for="data_nascimento" class="labelDados">Código:</label>
                <input type="text" name="codigo" disabled="disabled" class="span2" id="codigo" value="<?php echo set_value('codigo',$objProduto->getCodigo())?>">
        
           </div>
       </fieldset>

       
       <fieldset class="grupo">
                        
        
           <div class="campo">
                <label for="nome" class="labelDados">Referência:</label>
                <input type="text" name="referencia" disabled="disabled" class="span4" id="referencia" value="<?php echo set_value('referencia',$objProduto->getReferencia())?>">
          </div>
           
               <div class="campo">
                <label for="nome" class="labelDados">Valor Custo:</label>
                <input type="text" name="valor_custo" disabled="disabled" tipo="moneyReal" class="span2" id="valor_custo" value="<?php echo set_value('valor_custo',$objProduto->getValor_custo())?>">
            </div>
       
          <div class="campo">
               <label for="nome" class="labelDados">Valor Venda:</label>
              <input type="text" name="valor_venda" disabled="disabled" class="span2" tipo="moneyReal" id="valor_venda" value="<?php echo set_value('valor_venda',$objProduto->getValor_venda())?>">
        
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
            
          <a href="<?php echo site_url('servicos/editar/'.$objProduto->getId_produto()); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-edit"></i>Editar Serviço</a>
           <a href="<?php echo site_url('servicos/cadastrar'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-plus"></i>Novo Serviço</a>
           <a href="<?php echo site_url('servicos/filtro'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-search"></i>Buscar Serviço</a>
           <!--<a href="<?php echo site_url('servicos/pdf/'.$objProduto->getId_produto()); ?>" target="_blank" class="btn btn-small btn-info"><i class="btn-icon-only icon-print"></i>Imprimir</a>--> 
           
            
            
            </div> <!-- /form-actions -->
        </fieldset>
       
      
              </div>

            </div>
                </div>
                    </div> <!-- /widget-content -->
                        </div> <!-- /widget -->
                        

