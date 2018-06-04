<div class="pull-right">
<a href="<?php echo site_url('fornecedores/filtro'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-search"></i>Buscar Fornecedor</a>
</div>
<div class="row">
  <div class="span12">
       <div class="widget ">
        <div class="widget-header">
                <i class="icon-group"></i>
                <h3>Fornecedor Visualizar</h3>
         </div> <!-- /widget-header -->
            <div class="widget-content">
              
              <div class="tab-pane" id="formcontrols">
     
            
            <fieldset>
            
            
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Dados Básicos</a></li>
    <li role="presentation"><a href="#documentos" aria-controls="documentos" role="tab" data-toggle="tab">Outros Documentos</a></li>
    <li role="presentation"><a href="#observacao" aria-controls="observacao" role="tab" data-toggle="tab">Observações</a></li>
    
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    
   <!-- DADOS BÁSCIOS --> 
   <div role="tabpanel" class="tab-pane active" id="home">
    
       <fieldset class="grupo">
            <div class="campo">
                <label for="id_cargo" class="labelDados">Tipo Fornecedor:</label>
                 <label class="radio inline">
                     <input type="radio" disabled="disabled"  name="tipo" <?php if($objFornecedor->getTipo()==PESSOA_JURIDICA){echo "checked=''"; }?> value="<?php echo set_value('tipo',PESSOA_JURIDICA)?>"> Pessoa Juridica
                </label>

                <label class="radio inline">
                  <input type="radio" disabled="disabled" name="tipo" <?php if($objFornecedor->getTipo()==PESSOA_FISICA){echo "checked=''"; }?>  value="<?php echo set_value('tipo',PESSOA_FISICA)?>"> Pessoa Física
                </label>
            </div>
       </fieldset> 
       
       <fieldset class="grupo">
                        
            <div class="campo">
                <label for="nome" class="labelDados">Empresa / Nome:</label>
                 <input type="text" disabled="disabled" name="nome_fantasia" class="span5" id="nome_fantasia" value="<?php echo set_value('nome_fantasia',$objFornecedor->getNome_fantasia())?>">
            </div>
            
           <div class="campo">
                <label for="data_nascimento" class="labelDados">CNPJ / CPF:</label>
               <input type="text" disabled="disabled" name="cnpj_cpf" class="span2" id="cnpj_cpf" value="<?php echo set_value('cnpj_cpf',$objFornecedor->getCnpj_cpf())?>">
           </div>
           
           <div class="campo">
                <label for="data_nascimento" class="labelDados">Telefone(1):</label>
                <input type="text" disabled="disabled" name="telefone1" class="span2" id="telefone1" value="<?php echo set_value('telefone1',$objFornecedor->getTelefone1())?>">
           </div>
           
           
       </fieldset>
       
       <fieldset class="grupo">
                        
          <div class="campo">
             <label for="data_nascimento" class="labelDados">Telefone(2):</label>
             <input type="text" disabled="disabled" name="telefone2" class="span2" id="telefone2" value="<?php echo set_value('telefone2',$objFornecedor->getTelefone2())?>">
          </div>
           
           <div class="campo">
             <label for="data_nascimento" class="labelDados">Celular:</label>
            <input type="text" disabled="disabled" name="celular" class="span2" id="celular" value="<?php echo set_value('celular'.$objFornecedor->getCelular())?>">
           </div>
           
           <div class="campo">
             <label for="data_nascimento" class="labelDados">E-mail:</label>
           <input type="text" disabled="disabled" name="email" class="span4" id="email" value="<?php echo set_value('email',$objFornecedor->getEmail())?>">
        
           </div>
           
        </fieldset>
       
       
       <fieldset class="grupo">
                        
          <div class="campo">
             <label for="data_nascimento" class="labelDados">Endereço:</label>
             <input type="text" disabled="disabled" name="endereco" class="span6" id="endereco" value="<?php echo set_value('endereco',$objFornecedor->getEndereco())?>">
          </div>
           
           <div class="campo">
             <label for="data_nascimento" class="labelDados">Bairro:</label>
             <input type="text" disabled="disabled" name="bairro" class="span3" id="bairro" value="<?php echo set_value('bairro',$objFornecedor->getBairro())?>">
            </div>
       </fieldset>
       
       <fieldset class="grupo">
                        
         <div class="campo">
                <label for="cep" class="labelDados">CEP:</label>
                 <input type="text" disabled="disabled" name="cep" class="span2 cep" id="cep" value="<?php echo set_value('cep',$objFornecedor->getCep())?>">
            </div>
            
            <div class="campo">
                <label for="cidade" class="labelDados">Cidade:</label>
                 <input type="text" disabled="disabled" name="cidade" class="span4" id="cidade" value="<?php echo set_value('cidade',$objFornecedor->getCidade())?>">
            </div>
            
            <div class="campo">
                <label for="estado" class="labelDados">UF:</label>
                 <select name="estado" disabled="disabled" id="estado">
                     <option value="<?php echo $objFornecedor->getEstado(); ?>"><?php echo $objFornecedor->getEstado(); ?></option>
    
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
                <?php $status = $objFornecedor->getStatus();?>
                <option value="<?= $objFornecedor->getStatus(); ?>" <?= set_select('status',$status,$objFornecedor->statusIs($status)); ?>>
                <?= $objFornecedor->printStatus(); ?>
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
           <input type="text" name="insc_municipal" disabled="disabled" class="span3" id="insc_municipal" value="<?php echo set_value('insc_municipal',$objFornecedor->getInsc_municipal())?>">
          </div>
             
          <div class="campo">
             <label for="data_nascimento" class="labelDados">Inscrição Estadual:</label>
          <input type="text" name="insc_estadual" disabled="disabled" class="span3" id="insc_estadual" value="<?php echo set_value('insc_estadual',$objFornecedor->getInsc_estadual())?>">
          </div>
             
             
         </fieldset>
        
        
     
    
    </div>
    
    <!-- OBSERVAÇÕES -->
    <div role="tabpanel" class="tab-pane" id="observacao">
    
        <fieldset class="grupo">
                        
          <div class="campo">
           <label for="data_nascimento" class="labelDados">Observação:</label>
           <textarea cols="50" rows="10" disabled="disabled" class="span6" name="observacao" id="observacao"><?php echo $objFornecedor->getObservacao(); ?></textarea>
          </div>
        </fieldset>
   </div>
    
    
    
  </div>

</div>

                
            
           
                     
            <div class="form-actions">
            
            
           <a href="<?php echo site_url('fornecedores/editar/'.$objFornecedor->getId_fornecedor()); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-edit"></i>Editar Fornecedor</a>
           <a href="<?php echo site_url('fornecedores/cadastrar'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-plus"></i>Novo Fornecedor</a>
           <a href="<?php echo site_url('fornecedores/filtro'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-search"></i>Buscar Fornecedor</a>
           <a href="<?php echo site_url('fornecedores/pdf/'.$objFornecedor->getId_fornecedor()); ?>" target="_blank" class="btn btn-small btn-info"><i class="btn-icon-only icon-print"></i>Imprimir</a> 
            
            
            </div> <!-- /form-actions -->
        </fieldset>
        </form>
        
     
        
                  
                  
                  
              </div>

            </div>
                </div>
                    </div> <!-- /widget-content -->
                        </div> <!-- /widget -->
                        

