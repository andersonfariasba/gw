<div class="pull-right">
<a href="<?php echo site_url('est_categorias/filtro'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-search"></i>Buscar Categoria</a>
</div>
<div class="row">
  <div class="span12">
       <div class="widget ">
        <div class="widget-header">
                <i class="icon-list-ul"></i>
                <h3>Categoria Editar</h3>
         </div> <!-- /widget-header -->
            <div class="widget-content">
              <div class="tab-pane" id="formcontrols">
        
      <!--  <form action="" id="edit-profile" class="form-horizontal">-->
            
    <?php echo form_open('est_categorias/editar/'.$objCategoria->getId_categoria(),array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
    <input type="hidden" name="id_categoria" value="<?php echo $objCategoria->getId_categoria(); ?>">    
    
            
            
            <fieldset>
            
            <?php if($msg==true){ ?>
            <div class="alert alert-success" id="msgOk">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><img src="<?php echo base_url()."/images/ativo.png"?>" width="25px" border="0">Edição realizada com sucesso!</strong>
            </div>
            <?php } ?>
            
             <?php echo validation_errors(); ?>
            
                           
            
            <div class="control-group">											
                <label class="control-label" for="categoria"><strong>Categoria:</strong></label>
                <div class="controls">
                <input type="text" name="categoria" class="span4" id="categoria" value="<?php echo set_value('categoria',$objCategoria->getCategoria())?>">
                
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