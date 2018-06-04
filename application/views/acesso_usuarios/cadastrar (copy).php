<div class="pull-right">
<a href="<?php echo site_url('acesso_usuarios/filtro'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-search"></i>Buscar Usuário</a>
</div>
<div class="row">
  <div class="span12">
       <div class="widget ">
        <div class="widget-header">
                <i class="icon-user"></i>
                <h3>Usuário Cadastrar</h3>
         </div> <!-- /widget-header -->
            <div class="widget-content">
              <div class="tab-pane" id="formcontrols">
        
      <!--  <form action="" id="edit-profile" class="form-horizontal">-->
            
    <?php echo form_open('acesso_usuarios/cadastrar',array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
            
            
            <fieldset>
            
             <?php if($msg==true){ ?>
            <div class="alert alert-success" id="msgOk">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><img src="<?php echo base_url()."/images/ativo.png"?>" width="25px" border="0">Cadastro realizado com sucesso!</strong>
            </div>
           <?php } ?>
            
             <?php echo validation_errors(); ?>
            
                           
            
            <div class="control-group">	
                
                <label class="control-label" for="id_perfil"><strong>Perfil:</strong></label>
                <div class="controls">
                    <select name="id_perfil" id="id_perfil">
                        <option value="">Selecione...</option>
                         <?php foreach ($listPerfil as $objPerfil): ?>
                        <option value="<?php echo $objPerfil->getId_perfil(); ?>" <?php echo set_select('id_perfil',$objPerfil->getId_perfil()); ?>>
                           <?php echo $objPerfil->getPerfil(); ?>
                        </option>
                         <?php endforeach; ?>
                    </select>
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->

              <div class="control-group"> 
                
                <label class="control-label" for="id_perfil"><strong>Colaborador:</strong></label>
                <div class="controls">
                    <select name="id_colaborador" id="id_colaborador">
                        <option value="">Selecione...</option>
                         <?php foreach ($listColaborador as $objColaborador): ?>
                        <option value="<?php echo $objColaborador->getId_colaborador(); ?>" <?php echo set_select('id_colaborador',$objColaborador->getId_colaborador()); ?>>
                           <?php echo $objColaborador->getNome(); ?>
                        </option>
                         <?php endforeach; ?>
                    </select>
                </div> <!-- /controls -->       
            </div> <!-- /control-group -->

                
            <div class="control-group">											
                <label class="control-label" for="login"><strong>Login:</strong></label>
                <div class="controls">
                <input type="text" name="login" class="span4" id="login" value="<?php echo set_value('login')?>">
                
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->

           
            <div class="control-group">											
                <label class="control-label" for="senha"><strong>Senha:</strong></label>
                <div class="controls">
                 <input type="password" name="senha" class="span4" id="senha" value="<?php echo set_value('senha')?>">
                
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
               