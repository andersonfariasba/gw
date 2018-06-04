<?php $objDateFormat = $this->DateFormat; ?> 
<div class="pull-right">
<a href="<?php echo site_url('rh_colaboradores/filtro'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-search"></i>Buscar Funcionário</a>
</div>
<div class="row">
  <div class="span12">
       <div class="widget ">
        <div class="widget-header">
                <i class="icon-group"></i>
                <h3>Funcionário Cadastrar</h3>
         </div> <!-- /widget-header -->
            <div class="widget-content">
              <div class="tab-pane" id="formcontrols">
        
      <!--  <form action="" id="edit-profile" class="form-horizontal">-->
            
    <?php echo form_open('rh_colaboradores/editar/'.$objColaborador->getId_colaborador(),array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
            <input type="hidden" name="id_colaborador" value="<?php echo $objColaborador->getId_colaborador()?>" />
            
            <fieldset>
            
            <div id="msg" style="display:none;">
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Sucesso!</strong> Cadastro realizado com sucesso!
            </div>
            </div>
            
            
            <div id="erro_cadastro" style="display:none;">
            <div class="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Erro!</strong> Verifique os dados cadastrados!
                    
            </div>
            </div>
            
             <?php echo validation_errors(); ?>
                <div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Dados Básicos</a></li>
    <li role="presentation"><a href="#documentos" aria-controls="documentos" role="tab" data-toggle="tab">Documentos</a></li>
    <li role="presentation"><a href="#banco" aria-controls="banco" role="tab" data-toggle="tab">Dados Bancários</a></li>
    <li role="presentation"><a href="#observacao" aria-controls="observacao" role="tab" data-toggle="tab">Observações</a></li>
    
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    
   <!-- DADOS BÁSCIOS --> 
   <div role="tabpanel" class="tab-pane active" id="home">
    <form action="#" method="post">
    <fieldset>
        <fieldset class="grupo">
            <div class="campo">
                <label for="id_cargo" class="labelDados">Cargo:</label>
                 <select name="id_cargo" id="id_cargo">
                        <option value="">Selecione...</option>
                         <?php foreach ($listCargo as $objCargo): 

                         $cargo = $objCargo->getId_cargo();

                         ?>
                        <option value="<?php echo $objCargo->getId_cargo(); ?>" <?php echo set_select('id_cargo', $cargo,$objColaborador->cargoIs($cargo)); ?>>
                           <?php echo $objCargo->getCargo(); ?>
                        </option>
                         <?php endforeach; ?>
                    </select>
            </div>
            <div class="campo">
                <label for="nome" class="labelDados">Nome:</label>
                <input type="text" name="nome" class="span4" id="nome" value="<?php echo set_value('nome',$objColaborador->getNome())?>">
            </div>
            
            <div class="campo">
                <label for="data_nascimento" class="labelDados">Data de Nascimento:</label>
                 <input type="text" name="data_nascimento" class="span2 dataManual" id="data_nascimento" value="<?php echo set_value('data_nascimento',$objDateFormat->date_format($objColaborador->getData_nascimento()))?>">
            </div>
        </fieldset>
        
        <!-- DADOS ENDEREÇO -->
        <fieldset class="grupo">
            <div class="campo">
                <label for="endereco" class="labelDados">Endereço:</label>
                 <input type="text" name="endereco" class="span6" id="endereco" value="<?php echo set_value('endereco',$objColaborador->getEndereco())?>">
            </div>
            
            <div class="campo">
                <label for="bairro" class="labelDados">Bairro:</label>
                 <input type="text" name="bairro" class="span2" id="bairro" value="<?php echo set_value('bairro',$objColaborador->getBairro())?>">
            </div>
            
        </fieldset>
        
        <fieldset class="grupo">
            <div class="campo">
                <label for="cep" class="labelDados">CEP:</label>
                 <input type="text" name="cep" class="span2" id="cep" value="<?php echo set_value('cep',$objColaborador->getCep())?>">
            </div>
            
            <div class="campo">
                <label for="cidade" class="labelDados">Cidade:</label>
                 <input type="text" name="cidade" class="span4" id="cidade" value="<?php echo set_value('cidade',$objColaborador->getCidade())?>">
            </div>
            
            <div class="campo">
                <label for="uf" class="labelDados">UF:</label>
                 <select name="uf" id="uf">
                        <option value="<?php echo $objColaborador->getUf(); ?>"><?php echo $objColaborador->getUf(); ?></option>
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
        
        
        
        <!-- FINAL DADOS ENDEREÇO -->
        
        <fieldset class="grupo">
            <div class="campo">
                <label for="telefone" class="labelDados">Telefone:</label>
                 <input type="text" name="telefone" class="span2" id="telefone" value="<?php echo set_value('telefone',$objColaborador->getTelefone())?>">
        
            </div>
            <div class="campo">
                <label for="celular1" class="labelDados">Celular(1):</label>
                <input type="text" name="celular1" class="span2" id="celular1" value="<?php echo set_value('celular1',$objColaborador->getCelular1())?>">
            </div>
            
            <div class="campo">
                <label for="celular2" class="labelDados">Celular(2):</label>
                <input type="text" name="celular2" class="span2" id="celular2" value="<?php echo set_value('celular2',$objColaborador->getCelular2())?>">
            </div>
            
            <div class="campo">
                <label for="emergencia" class="labelDados">Emergência:</label>
                <input type="text" name="emergencia" class="span2" id="emergencia" value="<?php echo set_value('emergencia',$objColaborador->getEmergencia())?>">
        
            </div>
        </fieldset>
        
        <fieldset class="grupo">
            <div class="campo">
                <label for="email" class="labelDados">Email:</label>
                 <input type="text" name="email" class="span6" id="email" value="<?php echo set_value('email',$objColaborador->getEmail())?>">
            </div>
        </fieldset>
        
        
        
     
    
    
    </div><!-- FINAL DADOS BÁSCIOS -->
    
    <!-- DOCUMENTAÇÃO -->
    <div role="tabpanel" class="tab-pane" id="documentos">
        <fieldset class="grupo">
           <div class="campo">
                <label for="rg" class="labelDados">RG:</label>
                 <input type="text" name="rg" class="span2" id="rg" value="<?php echo set_value('rg',$objColaborador->getRg())?>">
           </div>
            
            <div class="campo">
                <label for="uf_exp" class="labelDados">UF:</label>
                 <select name="uf_exp" id="uf">
                        <option value="<?php echo $objColaborador->getUf_exp(); ?>"><?php echo $objColaborador->getUf_exp(); ?></option>
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
            
            <div class="campo">
                <label for="data_expedicao" class="labelDados">Data Expedição:</label>
                 <input type="text" name="data_exp" class="span2" id="data_exp" value="<?php echo set_value('data_exp',$objColaborador->getData_exp())?>">
           </div>
         </fieldset>
    
   <fieldset class="grupo">
           <div class="campo">
                <label for="cpf" class="labelDados">CPF:</label>
                 <input type="text" name="cpf" class="span2" id="cpf" value="<?php echo set_value('cpf',$objColaborador->getCpf())?>">
           </div>
        
        <div class="campo">
                <label for="reservista" class="labelDados">Carteira de reservista:</label>
                 <input type="text" name="reservista" class="span2" id="reservista" value="<?php echo set_value('reservista',$objColaborador->getReservista())?>">
         </div>
        
   </fieldset>
        
   <fieldset class="grupo">
           <div class="campo">
                <label for="pis" class="labelDados">PIS/PASEP:</label>
                 <input type="text" name="pis" class="span2" id="pis" value="<?php echo set_value('pis',$objColaborador->getPis())?>">
           </div>
        
        <div class="campo">
                <label for="data_cadastro_pis" class="labelDados">Data de Cadastro:</label>
                 <input type="text" name="data_cadastro_pis" class="span2" id="data_pis" value="<?php echo set_value('data_pis',$objColaborador->getData_cadastro_pis())?>">
         </div>
        
   </fieldset>
        
        
        <fieldset class="grupo">
           <div class="campo">
                <label for="titulo_eleitor" class="labelDados">Título Eleitor:</label>
                 <input type="text" name="titulo" class="span2" id="titulo" value="<?php echo set_value('titulo_eleitor',$objColaborador->getTitulo())?>">
           </div>
        
        <div class="campo">
                <label for="zona" class="labelDados">Zona:</label>
                 <input type="text" name="zona" class="span1" id="zona" value="<?php echo set_value('zona',$objColaborador->getZona())?>">
         </div>
            
         <div class="campo">
                <label for="secao" class="labelDados">Seção:</label>
                 <input type="text" name="secao" class="span1" id="secao" value="<?php echo set_value('secao',$objColaborador->getSecao())?>">
         </div>
        
   </fieldset>
        
         <fieldset class="grupo">
           <div class="campo">
                <label for="habilitacao" class="labelDados">Habilitação:</label>
                 <input type="text" name="habilitacao" class="span2" id="habilitacao" value="<?php echo set_value('habilitacao',$objColaborador->getHabilitacao())?>">
           </div>
        
        <div class="campo">
                <label for="categoria_hab" class="labelDados">Categoria:</label>
                 <input type="text" name="categoria_hab" class="span1" id="habilitacao_categoria" value="<?php echo set_value('categoria_hab',$objColaborador->getCategoria_hab())?>">
         </div>
            
         <div class="campo">
                <label for="secao" class="labelDados">Validade:</label>
                 <input type="text" name="validade_hab" class="span2" id="validade_hab" value="<?php echo set_value('validade_hab',$objColaborador->getValidade_hab())?>">
         </div>
        
   </fieldset>
   
        
        
   
   
   
        
        
        
        
    </div>
    <!-- FINAL DOCUMENTAÇÃO -->
    
    <!-- INICIO DADOS BANCÁRIOS -->
    <div role="tabpanel" class="tab-pane" id="banco">
        
    <fieldset class="grupo">
           <div class="campo">
                <label for="banco" class="labelDados">Banco:</label>
                 <input type="text" name="banco" class="span2" id="banco" value="<?php echo set_value('banco',$objColaborador->getBanco())?>">
           </div>
        
        <div class="campo">
                <label for="agencia" class="labelDados">Agência:</label>
                 <input type="text" name="agencia" class="span2" id="agencia" value="<?php echo set_value('agencia',$objColaborador->getAgencia())?>">
         </div>
        
        <div class="campo">
                <label for="conta" class="labelDados">Conta:</label>
                 <input type="text" name="conta" class="span2" id="conta" value="<?php echo set_value('conta',$objColaborador->getConta())?>">
        </div>
        
        
   </fieldset>
   
    </div>
    <!-- FINAL DADOS BANCÁRIOS -->
    
    <!-- INICIO OBSERVACAO -->
    <div role="tabpanel" class="tab-pane" id="observacao">
        
        <fieldset class="grupo">
           <div class="campo">
                <label for="observacao" class="labelDados">Observacao:</label>
                <textarea class="span6" rows="10" name="observacao">
                    <?php echo $objColaborador->getObservacao(); ?>
                </textarea>
           </div>
        </fieldset>
    </div>
    <!-- FINAL OBSERVACAO -->
    
    
  </div>

</div>

                
            
           
                     
            <div class="form-actions">
            
                
           <a href="<?php echo site_url('rh_colaboradores/editar/'.$objColaborador->getId_colaborador()); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-edit"></i>Editar Funcionário</a>
           <a href="<?php echo site_url('rh_colaboradores/cadastrar'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-plus"></i>Novo Funcionário</a>
           <a href="<?php echo site_url('rh_colaboradores/filtro'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-search"></i>Buscar Funcionário</a>
  
          
            
            </div> <!-- /form-actions -->
            
            </fieldset>
          </form>
    
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