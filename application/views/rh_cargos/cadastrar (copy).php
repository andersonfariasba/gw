<div class="pull-right">
<a href="<?php echo site_url('rh_cargos/filtro'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-search"></i>Buscar Cargo</a>
</div>
<div class="row">
  <div class="span12">
       <div class="widget ">
        <div class="widget-header">
                <i class="icon-edit"></i>
                <h3>Cargo Cadastrar</h3>
         </div> <!-- /widget-header -->
            <div class="widget-content">
              <div class="tab-pane" id="formcontrols">
        
      <!--  <form action="" id="edit-profile" class="form-horizontal">-->
      
              
    <?php echo form_open('rh_cargos/cadastrar',array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
            
            
            <fieldset>
            
            <?php if($msg==true){ ?>
            <div class="alert alert-success" id="msgOk">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><img src="<?php echo base_url()."/images/ativo.png"?>" width="25px" border="0">Cadastro realizado com sucesso!</strong>
            </div>
        <?php } ?>
            
            
             <?php echo validation_errors(); ?>
            
                           
            
            <div class="control-group">											
                <label class="control-label" for="cargo"><strong>Nome Cargo:</strong></label>
                <div class="controls">
                <input type="text" name="cargo" class="span4" id="cargo" value="<?php echo set_value('cargo')?>">
                
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