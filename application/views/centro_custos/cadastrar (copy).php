<div class="pull-right">
<a href="<?php echo site_url('centro_custos/filtro'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-search"></i>Buscar Centro de Custos</a>
</div>
<div class="row">
  <div class="span12">
       <div class="widget ">
        <div class="widget-header">
                <i class="icon-list-ul"></i>
                <h3>Centro de Custos Cadastrar</h3>
         </div> <!-- /widget-header -->
            <div class="widget-content">
              <div class="tab-pane" id="formcontrols">
        
      <!--  <form action="" id="edit-profile" class="form-horizontal">-->
            
    <?php echo form_open('centro_custos/cadastrar',array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
            
            
            <fieldset>
            
            <?php if($msg==true){ ?>
            <div class="alert alert-success" id="msgOk">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><img src="<?php echo base_url()."/images/ativo.png"?>" width="25px" border="0">Cadastro realizado com sucesso!</strong>
            </div>
        <?php } ?>
            
             <?php echo validation_errors(); ?>
            
                           
            
            <div class="control-group">											
                <label class="control-label" for="custo"><strong>Centro de Custo:</strong></label>
                <div class="controls">
                <input type="text" name="custo" class="span4" id="custo" value="<?php echo set_value('custo')?>">
                
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
                        
<script type="text/javascript">

<?php if($msg==true){ ?>
  //função para ocultar mensagem de cadastro: arquivo: js/base.js
  hideMessage();

<?php } ?>

</script>
               