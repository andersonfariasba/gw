<div class="pull-right">
<a href="<?php echo site_url('filiais/filtro'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-search"></i>Buscar Filial</a>
</div>
<div class="row">
  <div class="span12">
       <div class="widget ">
        <div class="widget-header">
                <i class="icon-group"></i>
                <h3>Filial Cadastrar</h3>
         </div> <!-- /widget-header -->
            <div class="widget-content">
              <div class="tab-pane" id="formcontrols">
        
      <!--  <form action="" id="edit-profile" class="form-horizontal">-->
            
    <?php echo form_open('filiais/cadastrar',array("onsubmit"=>"return validate()","class"=>"form-horizontal","id"=>"form")); ?>
            
            
 <!-- <fieldset>-->
            
                             
           
            
        <?php if($msg==true){ ?>
            <div class="alert alert-success" id="msgOk">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><img src="<?php echo base_url()."/images/ativo.png"?>" width="25px" border="0">Cadastro realizado com sucesso!</strong>
            </div>
        <?php } ?>
                     
            
             <strong><?php echo validation_errors(); ?></strong>
                <div>

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
                <label for="data_nascimento" class="labelDados">CNPJ:</label>
               <input type="text" name="cnpj_cpf" class="span2" id="cnpj_cpf" value="<?php echo set_value('cnpj_cpf')?>">
           </div>

            <div class="campo">
                <label for="nome" class="labelDados">Nome:</label>
                 <input type="text" name="nome_fantasia" class="span5" id="nome_fantasia" value="<?php echo set_value('nome_fantasia')?>">
            </div>
            
        
           
           <div class="campo">
                <label for="data_nascimento" class="labelDados">Telefone(1):</label>
                <input type="text" name="telefone1" class="span2" id="telefone1" value="<?php echo set_value('telefone1')?>">
           </div>
           
           
       </fieldset>
       
       <fieldset class="grupo">
                        
          <div class="campo">
             <label for="data_nascimento" class="labelDados">Telefone(2):</label>
             <input type="text" name="telefone2" class="span2" id="telefone2" value="<?php echo set_value('telefone2')?>">
          </div>
           
           <div class="campo">
             <label for="data_nascimento" class="labelDados">Celular:</label>
            <input type="text" name="celular" class="span2" id="celular" value="<?php echo set_value('celular')?>">
           </div>
           
           <div class="campo">
             <label for="data_nascimento" class="labelDados">E-mail:</label>
           <input type="text" name="email" class="span4" id="email" value="<?php echo set_value('email')?>">
        
           </div>
           
        </fieldset>
       
       
       <fieldset class="grupo">
                        
          <div class="campo">
             <label for="data_nascimento" class="labelDados">Endereço:</label>
             <input type="text" name="endereco" class="span6" id="endereco" value="<?php echo set_value('endereco')?>">
          </div>
           
           <div class="campo">
             <label for="data_nascimento" class="labelDados">Bairro:</label>
             <input type="text" name="bairro" class="span2" id="bairro" value="<?php echo set_value('bairro')?>">
            </div>
       </fieldset>
       
       <fieldset class="grupo">
                        
         <div class="campo">
                <label for="cep" class="labelDados">CEP:</label>
                 <input type="text" name="cep" class="span2 cep" id="cep" value="<?php echo set_value('cep')?>">
            </div>
            
            <div class="campo">
                <label for="cidade" class="labelDados">Cidade:</label>
                 <input type="text" name="cidade" class="span4" id="cidade" value="<?php echo set_value('cidade')?>">
            </div>
            
            <div class="campo">
                <label for="estado" class="labelDados">UF:</label>
                 <select name="estado" id="estado">
                        <option value="">Selecione</option>
                        <option value="AC">AC</option>
                        <option value="AL">AL</option>
                        <option value="AM">AM</option>
                        <option value="AP">AP</option>
                        <option value="BA" selected="selected">BA</option>
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

    
            
    
    </div><!-- FINAL DADOS BÁSCIOS -->
    
    
    
    
        
    
    
    <!-- OUTROS DOCUMENTOS -->
    <div role="tabpanel" class="tab-pane" id="documentos">
    
         <fieldset class="grupo">
                        
          <div class="campo">
             <label for="data_nascimento" class="labelDados">Inscrição Municipal:</label>
           <input type="text" name="insc_municipal" class="span3" id="insc_municipal" value="<?php echo set_value('insc_municipal')?>">
          </div>
             
          <div class="campo">
             <label for="data_nascimento" class="labelDados">Inscrição Estadual:</label>
          <input type="text" name="insc_estadual" class="span3" id="insc_estadual" value="<?php echo set_value('insc_estadual')?>">
          </div>
             
             
         </fieldset>
        
        
     
    
    </div>
    
    <!-- OBSERVAÇÕES -->
    <div role="tabpanel" class="tab-pane" id="observacao">
    
        <fieldset class="grupo">
                        
          <div class="campo">
           <label for="data_nascimento" class="labelDados">Observação:</label>
           <textarea cols="50" rows="10" class="span6" name="observacao" id="observacao"></textarea>
          </div>
        </fieldset>
   </div>

   
    
    
  </div>

</div>

                
            
           
                     
            <div class="form-actions">
            
               <!-- <input type="submit" value="Salvar" class="btn btn-primary" id="submit" />-->


                 <input type="submit" value="Salvar" class="btn btn-primary" />
                  <input type="reset" value="Limpar" class="btn" />
               <!-- <button type="submit" class="btn btn-primary">
                <strong><i class="icon-save icon-white"></i> Salvar</strong>
               </button>

                 <button type="reset" class="btn">
                <strong><i class=" icon-check-empty icon-white"></i> Limpar</strong>
               </button>-->
            
            

                     
            </div> <!-- /form-actions -->
       
       <!-- </fieldset>-->
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
                        
                        

                        