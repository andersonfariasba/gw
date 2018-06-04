<div class="control-group">
    
        <div class="controls">
            <!-- Button to trigger modal -->
            <a href="#myModal" role="button" class="btn" data-toggle="modal">Abrir Janela</a>

            <!-- Modal -->
            <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="myModalLabel">Sucesso!</h3>
                </div>

                <div class="modal-body">
                    <p><img src="<?php echo base_url()."/images/ativo.png"?>" width="25px" border="0"> Cadastrao Realizado com Sucesso!</p>
                </div>
                
                <div class="modal-footer">
                    <button class="btn btn-success" data-dismiss="modal" aria-hidden="true">Ok</button>
                   
                </div>
            </div>

        </div> <!-- /controls -->   
</div> <!-- /control-group -->




<div class="pull-right">
<a href="<?php echo site_url('est_categorias/filtro'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-search"></i>Buscar Categoria</a>
</div>
<div class="row">
  <div class="span12">
       <div class="widget ">
        <div class="widget-header">
                <i class="icon-list-ul"></i>
                <h3>Categoria Cadastrar</h3>
         </div> <!-- /widget-header -->
            <div class="widget-content">
              <div class="tab-pane" id="formcontrols">
        
      <!--  <form action="" id="edit-profile" class="form-horizontal">-->
            
    <?php echo form_open('est_categorias/cadastrar',array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
            
            
            <fieldset>
            
       
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Sucesso!</strong> Cadastro realizado com sucesso!
            </div>
           
          
            
            
            <div id="erro_cadastro" style="display:none;">
            <div class="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Erro!</strong> Verifique os dados cadastrados!
                    
            </div>
            </div>
            
             <?php echo validation_errors(); ?>
            
                           
            
            <div class="control-group">											
                <label class="control-label" for="categoria"><strong>Categoria:</strong></label>
                <div class="controls">
                <input type="text" name="categoria" class="span4" id="categoria" value="<?php echo set_value('categoria')?>">
                
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->

           
                        
                     
            <div class="form-actions">
            
            <input type="submit" value="Salvar" class="btn btn-primary" />
            <input type="reset" value="Limpar" class="btn" />
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
                        
