<div class="pull-right">
<a href="<?php echo site_url('est_un_medida/filtro'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-search"></i>Buscar Unidade Medida</a>
</div>
<div class="row">
  <div class="span12">
       <div class="widget ">
        <div class="widget-header">
                <i class="icon-edit"></i>
                <h3>Unidade Medida Cadastrar</h3>
         </div> <!-- /widget-header -->
            <div class="widget-content">
              <div class="tab-pane" id="formcontrols">
        
      <!--  <form action="" id="edit-profile" class="form-horizontal">-->
            
    <?php echo form_open('est_un_medida/cadastrar',array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
            
            
            <fieldset>
            
              <?php if($msg==true){ ?>
            <div class="alert alert-success" id="msgOk">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><img src="<?php echo base_url()."/images/ativo.png"?>" width="25px" border="0">Cadastro realizado com sucesso!</strong>
            </div>
        <?php } ?>
            
             <?php echo validation_errors(); ?>
            
                           
            
            <div class="control-group">											
                <label class="control-label" for="unidade"><strong>Unidade de Medida:</strong></label>
                <div class="controls">
                <input type="text" name="unidade" class="span4" id="unidade" value="<?php echo set_value('unidade')?>">
                
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->

           
            <div class="control-group">											
                <label class="control-label" for="sigla"><strong>Sigla:</strong></label>
                <div class="controls">
                <input type="text" name="sigla" class="span2" id="sigla" value="<?php echo set_value('sigla')?>">
                
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