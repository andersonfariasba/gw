<?php $objDateFormat = $this->DateFormat; ?> 
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">

        <div class="x_title">
          <h2>Editar Transportadora</h2>
          <ul class="nav navbar-right panel_toolbox">
          <li><a href="<?php echo site_url('transportadoras/cadastrar'); ?>"><i class="fa fa-plus-circle"></i> <strong>Novo</strong></a></li>
          <li><a href="<?php echo site_url('transportadoras/filtro'); ?>"><i class="fa fa-search"></i> <strong>Pesquisar</strong></a></li>
          <li><a href="<?php echo site_url('relatorio_painel/menu');?>"><i class="fa fa-bar-chart"></i> <strong>Relatórios</strong></a></li>
          </ul>                     
          <div class="clearfix"></div>
        </div>

        <!-- ********* INICIO MIOLO **********-->
        <div class="x_content"> <!-- INICIO MIOLO-->

          <?php if($msg==true){ ?>
          <div class="alert alert-success alert-dismissible fade in" role="alert"  id="msgOk">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <strong><i class="fa fa-check"></i> Cadastro realizado com sucesso!</strong>
          </div>
          <?php } ?>

            <?php echo validation_errors(); ?>

           <?php echo form_open('transportadoras/editar/'.$objTransportadora->getId_transportadora(),array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
           <input type="hidden" name="id_transportadora" value="<?php echo $objTransportadora->getId_transportadora(); ?>">
       
              
          <input type="hidden" name="data_cadastro" value="<?php echo $objTransportadora->getData_cadastro(); ?>">    
     
             <!-- INICIO TAB GERAL -->
             <div class="" role="tabpanel" data-example-id="togglable-tabs">
                   
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                      <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Dados Básicos</a>
                      </li>
                      <!--<li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Entrega</a>
                      </li>-->
                      <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Anotações</a>
                      </li>
                    </ul>
                    
                    <div id="myTabContent" class="tab-content">
                      
                      <!-- ABA 001 -->
                      <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                        
                        <div class="form-group">

                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                <!--<label>Tipo de Cliente</label>-->
                <p>
                      <label>Pessoa Fisica</label>
                      <input type="radio" name="tipo" id="tipo_pf" <?php if($objTransportadora->getTipo()==PESSOA_FISICA){echo "checked=''"; }?>  value="<?php echo set_value('tipo',PESSOA_FISICA)?>"  /> 
                      <label>Pessoa Jurídica:</label>
                      <input type="radio" name="tipo" id="tipo_pj" <?php if($objTransportadora->getTipo()==PESSOA_JURIDICA){echo "checked=''"; }?> value="<?php echo set_value('tipo',PESSOA_JURIDICA)?>" />
                     
                    </p>
              </div>
              </div>


                <div class="form-group">

              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">

                <label class="campo_pj">Nome Fantasia <span class="obrigatorio">*</span></label>
                <label class="campo_pf" style="display:none;">Nome <span class="obrigatorio">*</span></label>
                <input type="text" class="form-control" name="nome_fantasia" id="nome_fantasia" value="<?php echo set_value('nome_fantasia',$objTransportadora->getNome_fantasia())?>" maxlength="250"/>
              </div>

              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback campo_pj">
                <label>Razão Social</label>
                <input type="text" class="form-control" name="razao_social" id="razao_social" value="<?php echo set_value('razao_social',$objTransportadora->getRazao_social())?>" maxlength="250"/>
              </div>

              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                <label id="camada_cnpj">CNPJ</label>
                <label id="camada_pf" style="display:none;">CPF</label>                
                <input type="text" class="form-control" name="cnpj_cpf" id="cpfcnpj" value="<?php echo set_value('cnpj_cpf',$objTransportadora->getCnpj_cpf())?>" maxlength="50"/>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>Telefone(1)</label>
                  <input type="text" class="form-control telefone" name="telefone1" id="telefone1" value="<?php echo set_value('telefone1',$objTransportadora->getTelefone1())?>"/>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>Telefone(2)</label>
                  <input type="text" class="form-control telefone" name="telefone2" id="telefone2" value="<?php echo set_value('telefone2',$objTransportadora->getTelefone2())?>"/>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>Celular</label>
                  <input type="text" class="form-control telefone" name="celular" id="celular" value="<?php echo set_value('celular',$objTransportadora->getCelular())?>"/>
            </div>

            


                      
              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>Endereço</label>
                  <input type="text" class="form-control" name="endereco" id="endereco" value="<?php echo set_value('endereco',$objTransportadora->getEndereco())?>"/>
              </div>

              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>Bairro</label>
                  <input type="text" class="form-control" name="bairro" id="bairro" value="<?php echo set_value('bairro',$objTransportadora->getBairro())?>"/>
              </div>

              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>Estado</label>
                    <select class="form-control" name="uf" id="uf">
                      <option value="<?php echo $objTransportadora->getEstado(); ?>"><?php echo $objTransportadora->getEstado(); ?></option>
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

              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>Cidade</label>
                  <input type="text" class="form-control" name="cidade" id="cidade" value="<?php echo set_value('cidade',$objTransportadora->getCidade())?>"/>
              </div>

              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>CEP</label>
                  <input type="text" class="form-control cep" name="cep" id="cep" value="<?php echo set_value('cep',$objTransportadora->getCep())?>"/>
              </div>

              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>E-mail</label>
                  <input type="text" class="form-control" name="email" id="email" value="<?php echo set_value('email',$objTransportadora->getEmail())?>"/>
            </div>

              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback campo_pj">
                  <label>Inscrição Estadual</label>
                  <input type="text" class="form-control" name="insc_estadual" id="insc_estadual" value="<?php echo set_value('insc_estadual',$objTransportadora->getInsc_estadual())?>"/>
              </div>

              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback campo_pj">
                  <label>Inscrição Municipal</label>
                  <input type="text" class="form-control" name="insc_municipal" id="insc_municipal" value="<?php echo set_value('insc_municipal',$objTransportadora->getInsc_municipal())?>"/>
              </div>

              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>Status</label>
                    <select class="form-control" name="status" id="status">
                        <?php $status = $objTransportadora->getStatus();?>
                <option value="<?= $objTransportadora->getStatus(); ?>" <?= set_select('status',$status,$objTransportadora->statusIs($status)); ?>>
                <?= $objTransportadora->printStatus(); ?>
               <option value="<?= ATIVO; ?>" <?= set_select('status',ATIVO); ?>>ATIVO</option>
               <option value="<?= BLOQUEADO; ?>" <?= set_select('status',BLOQUEADO); ?>>BLOQUEADO</option>

                    </select>
              </div>


                          <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>Data Cadastro: </label>
                 <span><?php echo $objDateFormat->date_format($objTransportadora->getData_cadastro()); ?></span>
                           </div>
              

            </div>

            
            
                      </div>  <!-- FINAL ABA 001 -->
                      <!-- **************** -->
                      
                    
                      <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                        
                          <div class="form-group">
                      
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                <label>Anotações</label>
                <textarea id="observacao" rows="10" class="form-control" name="observacao">
                  <?php echo $objTransportadora->getObservacao(); ?>
                </textarea>
                </div>
              </div>

                      </div>  <!-- FINAL ABA 003 -->
                      <!-- **************** -->

                    
                    </div><!-- FINAL CONTENT TAB -->

                  </div> <!-- FINAL TAB GERAL -->

                  <div class="ln_solid"></div>

                  <div class="col-md-12 col-sm-12 col-xs-12">
              
              <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Salvar</button>
              
         </div>

         </form>



        

        </div>

    </div>  <!-- FINAL MIOLO -->

  </div> <!-- FINAL COL -->

</div> <!-- FINAL ROWS -->






<script type="text/javascript">

$("#camada_pf").hide();
   $(".campo_pf").hide();

   $("#tipo_pf").click(function(){
    
   $("#camada_pf").show();
   $("#camada_cnpj").hide();
   $("#camada_razao").hide();
   $(".campo_pf").show();
   $(".campo_pj").hide();
    

                
   });

   $("#tipo_pj").click(function(){
    
    $("#camada_pf").hide();
    $("#camada_cnpj").show();
    $("#camada_razao").show();
    $(".campo_pf").hide();
    $(".campo_pj").show();
     
               
   });

   $("#cpfcnpj").keydown(function(){
    try {
      $("#cpfcnpj").unmask();
    } catch (e) {}
    
    var tamanho = $("#cpfcnpj").val().length;
  
    if(tamanho < 11){
        $("#cpfcnpj").mask("999.999.999-99");
    } else if(tamanho >= 11){
        $("#cpfcnpj").mask("99.999.999/9999-99");
    }                   
});


<?php if($msg==true){ ?>
//função para ocultar mensagem de cadastro: arquivo: js/base.js
hideMessage();

<?php } ?>

</script>


