<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">

        <div class="x_title">
          <h2>Cadastrar Transportadora</h2>
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

            <?php echo form_open('transportadoras/cadastrar',array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>

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
                      <input type="radio" name="tipo" id="tipo_pf"  value="<?php echo set_value('tipo',PESSOA_FISICA)?>"  /> 
                      <label>Pessoa Jurídica:</label>
                      <input type="radio" name="tipo" id="tipo_pj"  checked="" value="<?php echo set_value('tipo',PESSOA_JURIDICA)?>" />
                    </p>
              </div>
              </div>


                <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <label class="campo_pj">Nome Fantasia <span class="obrigatorio">*</span></label>
                <label class="campo_pf" style="display:none;">Nome <span class="obrigatorio">*</span></label>

                <input type="text" class="form-control" name="nome_fantasia" id="nome_fantasia" value="<?php echo set_value('nome_fantasia')?>" maxlength="250"/>
              </div>

              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback campo_pj">
                <label>Razão Social</label>
                <input type="text" class="form-control" name="razao_social" id="razao_social" value="<?php echo set_value('razao_social')?>" maxlength="250"/>
              </div>

              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
               <label id="camada_cnpj">CNPJ</label>
                <label id="camada_pf" style="display:none;">CPF</label>
                <input type="text" class="form-control" name="cnpj_cpf" id="cpfcnpj" value="<?php echo set_value('cnpj_cpf')?>" maxlength="50"/>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>Telefone(1)</label>
                  <input type="text" class="form-control telefone" name="telefone1" id="telefone1" value="<?php echo set_value('telefone1')?>"/>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>Telefone(2)</label>
                  <input type="text" class="form-control telefone" name="telefone2" id="telefone2" value="<?php echo set_value('telefone2')?>"/>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>Celular</label>
                  <input type="text" class="form-control telefone" name="celular" id="celular" value="<?php echo set_value('celular')?>"/>
            </div>

          

                        
              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>Endereço</label>
                  <input type="text" class="form-control" name="endereco" id="endereco" value="<?php echo set_value('endereco')?>"/>
              </div>

              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>Bairro</label>
                  <input type="text" class="form-control" name="bairro" id="bairro" value="<?php echo set_value('bairro')?>"/>
              </div>

              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>Estado</label>
                    <select class="form-control" name="uf" id="uf">
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

              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>Cidade</label>
                  <input type="text" class="form-control" name="cidade" id="cidade" value="<?php echo set_value('cidade')?>"/>
              </div>

              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>CEP</label>
                  <input type="text" class="form-control cep" name="cep" id="cep" value="<?php echo set_value('cep')?>"/>
              </div>

                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>E-mail</label>
                  <input type="text" class="form-control" name="email" id="email" value="<?php echo set_value('email')?>"/>
            </div>


                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback campo_pj">
                  <label>Inscrição Estadual</label>
                  <input type="text" class="form-control" name="insc_estadual" id="insc_estadual" value="<?php echo set_value('insc_estadual')?>"/>
              </div>

              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback campo_pj">
                  <label>Inscrição Municipal</label>
                  <input type="text" class="form-control" name="insc_municipal" id="insc_municipal" value="<?php echo set_value('insc_municipal')?>"/>
              </div>

              

            </div>

            
            
                      </div>  <!-- FINAL ABA 001 -->
                      <!-- **************** -->
                      
                         <!-- ABA 002 -->
                     <!-- <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

            <div class="form-group">
              
              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>Endereço</label>
                  <input type="text" class="form-control" name="endereco_entrega" id="endereco_entrega" value="<?php echo set_value('endereco_entrega')?>"/>
              </div>

              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>Bairro</label>
                  <input type="text" class="form-control" name="bairro_entrega" id="bairro_entrega" value="<?php echo set_value('bairro_entrega')?>"/>
              </div>

              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>Estado</label>
                    <select class="form-control" name="uf_entrega" id="uf_entrega">
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

              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>Cidade</label>
                  <input type="text" class="form-control" name="cidade_entrega" id="cidade_entrega" value="<?php echo set_value('cidade_entrega')?>"/>
              </div>

              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>CEP</label>
                  <input type="text" class="form-control" name="cep_entrega" id="cep_entrega" value="<?php echo set_value('cep_entrega')?>"/>
              </div>

                      
             

            </div>

               <div class="form-group">
                      
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                <label>Anotações Entrega</label>
                <textarea id="observacao_entrega" rows="10" class="form-control" name="observacao_entrega"></textarea>
                </div>
              </div>




                      </div>--> <!-- FINAL ABA 002 -->
                      <!-- **************** -->
                      


                      <!-- ABA 003 -->
                      <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                        
                          <div class="form-group">
                      
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                <label>Anotações</label>
                <textarea id="observacao" rows="10" class="form-control" name="observacao"></textarea>
                </div>
              </div>

                      </div>  <!-- FINAL ABA 003 -->
                      <!-- **************** -->

                    
                    </div><!-- FINAL CONTENT TAB -->

                  </div> <!-- FINAL TAB GERAL -->

                  <div class="ln_solid"></div>

                  <div class="col-md-12 col-sm-12 col-xs-12">
              <button type="reset" class="btn btn-danger"><i class="fa fa-remove"></i> Limpar</button>
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


