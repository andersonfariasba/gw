<div class="pull-right">
 <a href="<?php echo site_url('rh_departamentos/filtro'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-search"></i>Buscar Departamento</a>
     <a href="<?php echo site_url('rh_departamentos/cadastrar'); ?>" class="btn btn-small btn-success"><i class="btn-icon-only icon-ok"></i>Novo Departamento</a>  
    
</div>

<div class="row">
  <div class="span12">
       
       <div class="widget ">
        <div class="widget-header">
                <i class="icon-edit"></i>
                <h3>Departamento Editar</h3>
         </div> <!-- /widget-header -->
            <div class="widget-content">
              <div class="tab-pane" id="formcontrols">
        
                 
    <?php echo form_open('rh_departamentos/editar/'.$objDep->getId_departamento(),array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
    <input type="hidden" name="id_departamento" value="<?php echo $objDep->getId_departamento(); ?>">        
            
            <fieldset>
            
           <?php if($msg==true){ ?>
            <div class="alert alert-success" id="msgOk">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><img src="<?php echo base_url()."/images/ativo.png"?>" width="25px" border="0">Edição realizada com sucesso!</strong>
            </div>
            <?php } ?>
            
             <?php echo validation_errors(); ?>
            
                             
            
            <div class="control-group">											
                <label class="control-label" for="cargo"><strong>Nome Departamento:</strong></label>
                <div class="controls">
                <input type="text" name="departamento" class="span4" id="departamento" value="<?php echo set_value('departamento',$objDep->getDepartamento())?>">
                
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->

            <div class="control-group">                      
                <label class="control-label" for="status"><strong>Status:</strong></label>
                <div class="controls">
               <select name="status" id="status">
                <?php $status = $objDep->getStatus();?>
                <option value="<?= $objDep->getStatus(); ?>" <?= set_select('status',$status,$objDep->statusIs($status)); ?>>
                <?= $objDep->printStatus(); ?>
               <option value="<?= ATIVO; ?>" <?= set_select('status',ATIVO); ?>>ATIVO</option>
               <option value="<?= BLOQUEADO; ?>" <?= set_select('status',BLOQUEADO); ?>>BLOQUEADO</option>
            

            </select>     
                
                </div> <!-- /controls -->       
           </div> <!-- /control-group -->

           
                     
            <div class="form-actions">
            
            <input type="submit" value="Editar" class="btn btn-primary" />
            
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