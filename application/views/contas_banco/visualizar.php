<div class="pull-right">
<a href="<?php echo site_url('contas_banco/filtro'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-search"></i>Buscar Conta Bancária</a>
</div>
<div class="row">
  <div class="span12">
       <div class="widget ">
        <div class="widget-header">
                <i class="icon-wrench"></i>
                <h3>Contas Bancárias Visualizar</h3>
         </div> <!-- /widget-header -->
            <div class="widget-content">
              <div class="tab-pane" id="formcontrols">
        
      <!--  <form action="" id="edit-profile" class="form-horizontal">-->
   
      <input type="hidden" name="id_conta_banco" id="id_conta_banco" value="<?php echo set_value('id_conta_banco',$objConta->getId_conta_banco()); ?>">
            
            <fieldset>
          
                <div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Dados Básicos</a></li>
      <li role="presentation"><a href="#obs" aria-controls="obs" role="tab" data-toggle="tab">Anotações</a></li>
    
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    
   <!-- DADOS BÁSCIOS --> 
   <div role="tabpanel" class="tab-pane active" id="home">
    
     <fieldset class="grupo">
                        
            <div class="campo">
                <label for="nome" class="labelDados">Filial:</label>
               <select name="id_filial" id="id_filial" style="width:300px;">
            <option value="">SELECIONE ....</option>
              <?php 
              foreach ($listFilial as $objFilial): 
                $filial = $objFilial->getId_filial();      
              ?>
                  <option value="<?php echo $objFilial->getId_filial(); ?>" <?php echo set_select('id_filial',$filial,$objConta->filialIs($filial)); ?>>
                    <?php echo $objFilial->getNome_fantasia()." - ".$objFilial->getCnpj_cpf(); ?>
                  </option>
              <?php endforeach; ?>
          </select>

               
            </div>
         


       </fieldset>

       
       <fieldset class="grupo">
                        
        
              
           <div class="campo">
                <label for="data_nascimento" class="labelDados">Banco:</label>
                <input type="text" name="banco" class="span4" id="banco" value="<?php echo set_value('banco',$objConta->getBanco())?>">
     
           </div>
           
           <div class="campo">
                <label for="data_nascimento" class="labelDados">Agência:</label>
                <input type="text" name="agencia" class="span2" id="agencia" value="<?php echo set_value('agencia',$objConta->getAgencia())?>">
        
           </div>

            <div class="campo">
                <label for="data_nascimento" class="labelDados">Conta:</label>
                <input type="text" name="conta" class="span2" id="conta" value="<?php echo set_value('conta',$objConta->getConta())?>">
        
           </div>
       
        </fieldset>


          <fieldset class="grupo">
                        
        
              
           <div class="campo">
                <label for="data_nascimento" class="labelDados">Gerente:</label>
                <input type="text" name="gerente" class="span4" id="gerente" value="<?php echo set_value('gerente',$objConta->getGerente())?>">
     
           </div>
           
           <div class="campo">
                <label for="data_nascimento" class="labelDados">Telefone:</label>
                <input type="text" name="telefone" class="span2" id="telefone" value="<?php echo set_value('telefone',$objConta->getTelefone())?>">
        
           </div>

            <div class="campo">
                <label for="data_nascimento" class="labelDados">Central de Atendimento:</label>
                <input type="text" name="central_atendimento" class="span2" id="central_atendimento" value="<?php echo set_value('central_atendimento',$objConta->getCentral_atendimento())?>">
        
           </div>
       
        </fieldset>
       
       
       

    
    
    
    
    
    </div><!-- FINAL DADOS BÁSCIOS -->
    
    <div role="tabpanel" class="tab-pane" id="obs">
        <fieldset class="grupo">
                        
            <div class="campo">
                <label for="nome" class="labelDados">Anotação:</label>
                <textarea cols="50" rows="10" class="span6" name="observacao" id="observacao">
                  <?php echo $objConta->getObservacao(); ?>
               </textarea>
                
            </div>
        </fieldset>
        
    </div>
    
  </div>

</div>

                
            
           
                    
            <div class="form-actions">
            
                
           <a href="<?php echo site_url('contas_banco/editar/'.$objConta->getId_conta_banco()); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-edit"></i>Editar Conta Bancária</a>
           <a href="<?php echo site_url('contas_banco/cadastrar'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-plus"></i>Nova Conta Bancária</a>
           <a href="<?php echo site_url('contas_banco/filtro'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-search"></i>Buscar Conta Bancária</a>
  
          
            
            </div> <!-- /form-actions -->
        </fieldset>
        </form>
            
    
             </div>

            </div>
                </div>
                    </div> <!-- /widget-content -->
                        </div> <!-- /widget -->
                        


<script type="text/javascript">
     $('input').attr("disabled", true);
     $('select').attr("disabled", true);
     $('textarea').attr("disabled", true);

</script>
