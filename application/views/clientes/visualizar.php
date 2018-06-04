<div class="pull-right">
<a href="<?php echo site_url('clientes/filtro'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-search"></i>Buscar Cliente</a>
</div>
<div class="row">
  <div class="span12">
       <div class="widget ">
        <div class="widget-header">
                <i class="icon-group"></i>
                <h3>Cliente Visualizar</h3>
         </div> <!-- /widget-header -->
            <div class="widget-content">
              <div class="tab-pane" id="formcontrols">
                  
                  
            
            <fieldset>
            
            
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Dados Básicos</a></li>
    
    <li role="presentation"><a href="#observacao" aria-controls="observacao" role="tab" data-toggle="tab">Observações</a></li>
    
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    
   <!-- DADOS BÁSCIOS --> 
   <div role="tabpanel" class="tab-pane active" id="home">

    
    
       <fieldset class="grupo">
                        
            <div class="campo">
                <label for="nome" class="labelDados">Nome:</label>
                 <input type="text" disabled="disabled" name="nome_fantasia" class="span5" id="nome_fantasia" value="<?php echo set_value('nome_fantasia',$objCliente->getNome_fantasia())?>">
            </div>
            
           <div class="campo">
                <label for="data_nascimento" class="labelDados">CPF:</label>
               <input type="text" disabled="disabled" name="cnpj_cpf" class="span2" id="cnpj_cpf" value="<?php echo set_value('cnpj_cpf',$objCliente->getCnpj_cpf())?>">
           </div>
           
           <div class="campo">
                <label for="data_nascimento" class="labelDados">Telefone(1):</label>
                <input type="text" disabled="disabled" name="telefone1" class="span2" id="telefone1" value="<?php echo set_value('telefone1',$objCliente->getTelefone1())?>">
           </div>
           
           
       </fieldset>
       
       <fieldset class="grupo">
                        
          <div class="campo">
             <label for="data_nascimento" class="labelDados">Telefone(2):</label>
             <input type="text" disabled="disabled" name="telefone2" class="span2" id="telefone2" value="<?php echo set_value('telefone2',$objCliente->getTelefone2())?>">
          </div>
           
           <div class="campo">
             <label for="data_nascimento" class="labelDados">Celular:</label>
            <input type="text" name="celular" disabled="disabled" class="span2" id="celular" value="<?php echo set_value('celular'.$objCliente->getCelular())?>">
           </div>
           
           <div class="campo">
             <label for="data_nascimento" disabled="disabled" class="labelDados">E-mail:</label>
           <input type="text" name="email" disabled="disabled" class="span4" id="email" value="<?php echo set_value('email',$objCliente->getEmail())?>">
        
           </div>
           
        </fieldset>
       
       
       <fieldset class="grupo">
                        
          <div class="campo">
             <label for="data_nascimento"  class="labelDados">Endereço:</label>
             <input type="text" name="endereco" disabled="disabled" class="span6" id="endereco" value="<?php echo set_value('endereco',$objCliente->getEndereco())?>">
          </div>
           
           <div class="campo">
             <label for="data_nascimento" class="labelDados">Bairro:</label>
             <input type="text" disabled="disabled" name="bairro" class="span3" id="bairro" value="<?php echo set_value('bairro',$objCliente->getBairro())?>">
            </div>
       </fieldset>
       
       <fieldset class="grupo">
                        
         <div class="campo">
                <label for="cep"  class="labelDados">CEP:</label>
                 <input type="text" disabled="disabled" name="cep" class="span2 cep" id="cep" value="<?php echo set_value('cep',$objCliente->getCep())?>">
            </div>
            
            <div class="campo">
                <label for="cidade" class="labelDados">Cidade:</label>
                 <input type="text" disabled="disabled" name="cidade" class="span4" id="cidade" value="<?php echo set_value('cidade',$objCliente->getCidade())?>">
            </div>
            
            <div class="campo">
                <label for="estado" class="labelDados">UF:</label>
                 <select name="estado" disabled="disabled" id="estado">
                     <option value="<?php echo $objCliente->getEstado(); ?>"><?php echo $objCliente->getEstado(); ?></option>
    
                        <option value="">Selecione</option>
                        <option value="AC">AC</option>
                        <option value="AL">AL</option>
                        <option value="AM">AM</option>
                        <option value="AP">AP</option>
                        <option value="BA">BA</option>
                        <option value="CE">CE</option>
                        <option value="DF">DF</option>
                        <option value="ES">ES</option>
                        <option value="GO">GO</option>
                        <option value="MA">MA</option>
                        <option value="MG">MG</option>
                        <option value="MS">MS</option>
                        <option value="MT">MT</option>
                        <option value="PA">PA</option>
                        <option value="PB">PB</option>
                        <option value="PE">PE</option>
                        <option value="PI">PI</option>
                        <option value="PR">PR</option>
                        <option value="RJ">RJ</option>
                        <option value="RN">RN</option>
                        <option value="RS">RS</option>
                        <option value="RO">RO</option>
                        <option value="RR">RR</option>
                        <option value="SC">SC</option>
                        <option value="SE">SE</option>
                        <option value="SP">SP</option>
                        <option value="TO">TO</option>
                 </select>
            </div>

       </fieldset>
       
       <fieldset class="grupo">
                        
         <div class="campo">
                <label for="cep" class="labelDados">Status:</label>
                 <select name="status" disabled="disabled" id="status">
                <?php $status = $objCliente->getStatus();?>
                <option value="<?= $objCliente->getStatus(); ?>" <?= set_select('status',$status,$objCliente->statusIs($status)); ?>>
                <?= $objCliente->printStatus(); ?>
               <option value="<?= ATIVO; ?>" <?= set_select('status',ATIVO); ?>>ATIVO</option>
               <option value="<?= BLOQUEADO; ?>" <?= set_select('status',BLOQUEADO); ?>>BLOQUEADO</option>
              </select>     
               
                
            </div>
       </fieldset>

    
       
       
    
    </div><!-- FINAL DADOS BÁSCIOS -->
    
    
    
    
        
    
    
    <!-- OUTROS DOCUMENTOS -->
    <div role="tabpanel" class="tab-pane" id="documentos">
    
         <fieldset class="grupo">
                        
          <div class="campo">
             <label for="data_nascimento" class="labelDados">Inscrição Municipal:</label>
           <input type="text" name="insc_municipal" disabled="disabled" class="span3" id="insc_municipal" value="<?php echo set_value('insc_municipal',$objCliente->getInsc_municipal())?>">
          </div>
             
          <div class="campo">
             <label for="data_nascimento" class="labelDados">Inscrição Estadual:</label>
          <input type="text" name="insc_estadual" disabled="disabled" class="span3" id="insc_estadual" value="<?php echo set_value('insc_estadual',$objCliente->getInsc_estadual())?>">
          </div>
             
             
         </fieldset>
        
        
     
    
    </div>
    
    <!-- OBSERVAÇÕES -->
    <div role="tabpanel" class="tab-pane" id="observacao">
    
        <fieldset class="grupo">
                        
          <div class="campo">
           <label for="data_nascimento" class="labelDados">Observação:</label>
           <textarea cols="50" rows="10" disabled="disabled" class="span6" name="observacao" id="observacao"><?php echo $objCliente->getObservacao(); ?></textarea>
          </div>
        </fieldset>
   </div>
    
    
    
  </div>

</div>

                
            
           
                     
            <div class="form-actions">
            
         <a href="<?php echo site_url('clientes/editar/'.$objCliente->getId_cliente()); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-edit"></i>Editar Cliente</a>
           <a href="<?php echo site_url('clientes/cadastrar'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-plus"></i>Novo Cliente</a>
           <a href="<?php echo site_url('clientes/filtro'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-search"></i>Buscar Cliente</a>
           <a href="<?php echo site_url('clientes/pdf/'.$objCliente->getId_cliente()); ?>" target="_blank" class="btn btn-small btn-info"><i class="btn-icon-only icon-print"></i>Imprimir</a> 
              
            
            </div> <!-- /form-actions -->
        </fieldset>
        </form>
        
        
      
              </div>

            </div>
                </div>
                    </div> <!-- /widget-content -->
                        </div> <!-- /widget -->
                        

