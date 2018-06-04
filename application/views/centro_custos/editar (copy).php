<div class="pull-right">
<a href="<?php echo site_url('centro_custos/filtro'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-search"></i>Buscar Centro de Custos</a>
</div>
<div class="row">
  <div class="span12">
       <div class="widget ">
        <div class="widget-header">
                <i class="icon-list-ul"></i>
                <h3>Centro de Custos Editar</h3>
         </div> <!-- /widget-header -->
            <div class="widget-content">
              <div class="tab-pane" id="formcontrols">
        
      <!--  <form action="" id="edit-profile" class="form-horizontal">-->
            
    <?php echo form_open('centro_custos/editar/'.$objCusto->getId_custo(),array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
    <input type="hidden" name="id_custo" value="<?php echo $objCusto->getId_custo(); ?>">    
    
            
            
            <fieldset>
            
            <?php if($msg==true){ ?>
            <div class="alert alert-success" id="msgOk">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><img src="<?php echo base_url()."/images/ativo.png"?>" width="25px" border="0">Edição realizada com sucesso!</strong>
            </div>
            <?php } ?>
            
             <?php echo validation_errors(); ?>
            
                           
            
            <div class="control-group">											
                <label class="control-label" for="custo"><strong>Centro de Custos:</strong></label>
                <div class="controls">
                <input type="text" name="custo" class="span4" id="custo" value="<?php echo set_value('custo',$objCusto->getCusto())?>">
                
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->

              <div class="control-group">                     
                <label class="control-label" for="status"><strong>Status:</strong></label>
                <div class="controls">
               <select name="status" id="status">
                <?php $status = $objCusto->getStatus();?>
                <option value="<?= $objCusto->getStatus(); ?>" <?= set_select('status',$status,$objCusto->statusIs($status)); ?>>
                <?= $objCusto->printStatus(); ?>
               <option value="<?= ATIVO; ?>" <?= set_select('status',ATIVO); ?>>ATIVO</option>
               <option value="<?= BLOQUEADO; ?>" <?= set_select('status',BLOQUEADO); ?>>BLOQUEADO</option>
            

            </select>     
                
                </div> <!-- /controls -->       
           </div> <!-- /control-group -->

           
                        
                     
            <div class="form-actions">
            
            <input type="submit" value="Editar" class="btn btn-primary" />
          
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