<style type="text/css">
    
    * {
    margin: 0;
    padding: 0;
}
 
fieldset {
    border: 0;
}
 
body, input, select, textarea, button {
    /*font-family: sans-serif;
    font-size: 1em;*/
}
 
.grupo:before, .grupo:after {
    content: " ";
    display: table;
}
 
.grupo:after {
    clear: both;
}
 
.campo {
    margin-bottom: 1em;
}
 
.campo label {
    margin-bottom: 0.2em;
    color: #666;
    display: block;
}
 
fieldset.grupo .campo {
    float:  left;
    margin-right: 1em;
}
 
.campo input[type="text"],
.campo input[type="email"],
.campo input[type="url"],
.campo input[type="tel"],
.campo select,
.campo textarea {
    padding: 0.2em;
    border: 1px solid #CCC;
    box-shadow: 2px 2px 2px rgba(0,0,0,0.2);
    display: block;
}
 
.campo select option {
    padding-right: 1em;
}
 
.campo input:focus, .campo select:focus, .campo textarea:focus {
    background: #FFC;
}
 
.campo label.checkbox {
    color: #000;
    display: inline-block;
    margin-right: 1em;
}
 
.botao {
    font-size: 1.5em;
    background: #F90;
    border: 0;
    margin-bottom: 1em;
    color: #FFF;
    padding: 0.2em 0.6em;
    box-shadow: 2px 2px 2px rgba(0,0,0,0.2);
    text-shadow: 1px 1px 1px rgba(0,0,0,0.5);
}
 
.botao:hover {
    background: #FB0;
    box-shadow: inset 2px 2px 2px rgba(0,0,0,0.2);
    text-shadow: none;
}
 
.botao, select, label.checkbox {
    cursor: pointer;
}
</style>
<div class="pull-right">
<a href="<?php echo site_url('est_categorias/filtro'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-search"></i>Buscar Categoria</a>
</div>
<div class="row">
    
  <div class="span12">
    
      <div class="widget ">
        <div class="widget-header">
                <i class="icon-list-ul"></i>
                <h3>Categoria Cadastrar</h3>
         </div> <!-- /widget-header -->
            
         <div class="widget-content"> 
             <!-- INICIO TESTES -->
          <form action="#" method="post">
    <fieldset>
        <fieldset class="grupo">
            <div class="campo">
                <label for="id_cargo" class="labelDados">Cargo</label>
                 <select name="id_cargo" id="id_cargo">
                        <option value="">Selecione...</option>
                         <?php foreach ($listCargo as $objCargo): ?>
                        <option value="<?php echo $objCargo->getId_cargo(); ?>" <?php echo set_select('id_cargo',$objCargo->getId_cargo()); ?>>
                           <?php echo $objCargo->getCargo(); ?>
                        </option>
                         <?php endforeach; ?>
                    </select>
            </div>
            <div class="campo">
                <label for="nome" class="labelDados">Nome:</label>
                <input type="text" name="nome" class="span4" id="nome" value="<?php echo set_value('nome')?>">
            </div>
            
            <div class="campo">
                <label for="data_nascimento" class="labelDados">Data de Nascimento</label>
                 <input type="text" name="data_nascimento" class="span2 dataManual" id="data_nascimento" value="<?php echo set_value('data_nascimento')?>">
            </div>
        </fieldset>
        
        <!-- DADOS ENDEREÇO -->
        <fieldset class="grupo">
            <div class="campo">
                <label for="endereco" class="labelDados">Endereço:</label>
                 <input type="text" name="endereco" class="span6" id="endereco" value="<?php echo set_value('endereco')?>">
            </div>
            
            <div class="campo">
                <label for="bairro" class="labelDados">Bairro:</label>
                 <input type="text" name="bairro" class="span2" id="bairro" value="<?php echo set_value('bairro')?>">
            </div>
            
        </fieldset>
        
        <fieldset class="grupo">
            <div class="campo">
                <label for="cep" class="labelDados">CEP:</label>
                 <input type="text" name="cep" class="span2" id="cep" value="<?php echo set_value('cep')?>">
            </div>
            
            <div class="campo">
                <label for="cidade" class="labelDados">Cidade:</label>
                 <input type="text" name="cidade" class="span4" id="cidade" value="<?php echo set_value('cidade')?>">
            </div>
            
            <div class="campo">
                <label for="uf" class="labelDados">UF:</label>
                 <select name="uf" id="uf">
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
        
        
        
        <!-- FINAL DADOS ENDEREÇO -->
        
        <fieldset class="grupo">
            <div class="campo">
                <label for="telefone" class="labelDados">Telefone</label>
                 <input type="text" name="telefone" class="span2" id="telefone" value="<?php echo set_value('telefone')?>">
        
            </div>
            <div class="campo">
                <label for="celular1" class="labelDados">Celular(1)</label>
                <input type="text" name="celular1" class="span2" id="celular1" value="<?php echo set_value('celular1')?>">
            </div>
            
            <div class="campo">
                <label for="celular2" class="labelDados">Celular(2)</label>
                <input type="text" name="celular2" class="span2" id="celular2" value="<?php echo set_value('celular2')?>">
            </div>
            
            <div class="campo">
                <label for="emergencia" class="labelDados">Emergência</label>
                <input type="text" name="emergencia" class="span2" id="emergencia" value="<?php echo set_value('emergencia')?>">
        
            </div>
        </fieldset>
        
        <fieldset class="grupo">
            <div class="campo">
                <label for="email" class="labelDados">Email:</label>
                 <input type="text" name="email" class="span4" id="email" value="<?php echo set_value('email')?>">
            </div>
        </fieldset>
        
        
        
    </fieldset>
          </form>
   
             
             <!-- FINAL TESTES -->
             
             
             
             
            </div> <!-- widget content -->
                
      
                 </div> <!-- widget -->
                    </div> <!-- /span -->
                        </div> <!-- /row -->
                        
