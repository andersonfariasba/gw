<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">

        <div class="x_title">
          <h2>Cadastrar Transportadora</h2>
          <ul class="nav navbar-right panel_toolbox">
         
          <li><a href="<?php echo site_url('transportadoras/filtro'); ?>"><i class="fa fa-search"></i> <strong>Pesquisar Transportadora</strong></a></li>
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

                       <li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab4" data-toggle="tab" aria-expanded="false">Contatos</a>
                      </li>
                      
                      <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Anotações</a>
                      </li>
                    </ul>
                    
                    <div id="myTabContent" class="tab-content">
                      
                      <!-- ABA 001 -->
                      <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                        
                        <div class="form-group">

                        <div class="col-md-10 col-sm-6 col-xs-12 form-group has-feedback">
                <!--<label>Tipo de Cliente</label>-->
                <p>
                      <label>Pessoa Fisica:
                      <input type="radio" name="tipo" id="tipo_pf"  value="<?php echo set_value('tipo',PESSOA_FISICA)?>" required /></label> 
                      <label>Pessoa Jurídica:
                      <input type="radio" name="tipo" id="tipo_pj" checked="" value="<?php echo set_value('tipo',PESSOA_JURIDICA)?>"/></label>
                    </p>
              </div>

             
              </div>


                <div class="form-group">
              <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label class="campo_pj">Nome Fantasia <span class="obrigatorio">*</span></label>
                <label class="campo_pf" style="display:none;">Nome <span class="obrigatorio">*</span></label>
                <input type="text" class="form-control" name="nome_fantasia" id="nome_fantasia" value="<?php echo set_value('nome_fantasia')?>" maxlength="250"/>
              </div>

              <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback" id="camada_razao">
                <label>Razão Social</label>
                <input type="text" class="form-control" name="razao_social" id="razao_social" value="<?php echo set_value('razao_social')?>" maxlength="250"/>
              </div>

              <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                <label id="camada_cnpj">CNPJ</label>
                <label id="camada_pf" style="display:none;">CPF</label>
                                <input type="text" class="form-control" name="cnpj_cpf" id="cpfcnpj" value="<?php echo set_value('cnpj_cpf')?>" maxlength="50"/>
            </div>
            </div>

            <div class="form-group">

            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>Telefone(1)</label>
                  <input type="text" class="form-control telefone_fixo" name="telefone1" id="telefone1" value="<?php echo set_value('telefone1')?>"/>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>Telefone(2)</label>
                  <input type="text" class="form-control telefone_fixo" name="telefone2" id="telefone2" value="<?php echo set_value('telefone2')?>"/>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>Celular</label>
                  <input type="text" class="form-control telefone" name="celular" id="celular" value="<?php echo set_value('celular')?>"/>
            </div>

            </div>

              <div class="form-group">

              <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>CEP</label>
                  <input type="text" class="form-control cep" name="cep" id="cep" value="<?php echo set_value('cep')?>"/>
              </div>

            <div class="col-md-8 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>Endereço</label>
                  <input type="text" class="form-control" name="endereco" id="endereco" value="<?php echo set_value('endereco')?>"/>
              </div>

              </div>

               <div class="form-group">

              <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>Bairro</label>
                  <input type="text" class="form-control" name="bairro" id="bairro" value="<?php echo set_value('bairro')?>"/>
              </div>

              <div class="col-md-2 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>Estado</label>
                  <input type="text" class="form-control" name="estado" id="uf" value="<?php echo set_value('estado')?>"/>
              </div>

              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>Cidade</label>
                  <input type="text" class="form-control" name="cidade" id="cidade" value="<?php echo set_value('cidade')?>"/>
              </div>

            </div>

            <div class="form-group">

            

                <div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
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
                      

                      <!-- ABA 003 -->
                      <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                        
                          <div class="form-group">
                      
                        <!--<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                <label>Anotações</label>
                <textarea id="observacao" rows="10" class="form-control" name="observacao"></textarea>
                </div>-->

                <div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor">
                  <div class="btn-group">
                    <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                    </ul>
                  </div>
                  <div class="btn-group">
                    <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li>
                        <a data-edit="fontSize 5">
                          <p style="font-size:17px">Huge</p>
                        </a>
                      </li>
                      <li>
                        <a data-edit="fontSize 3">
                          <p style="font-size:14px">Normal</p>
                        </a>
                      </li>
                      <li>
                        <a data-edit="fontSize 1">
                          <p style="font-size:11px">Small</p>
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div class="btn-group">
                    <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                    <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                    <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                    <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
                  </div>
                  <div class="btn-group">
                    <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
                    <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
                    <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
                    <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>
                  </div>
                  <div class="btn-group">
                    <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
                    <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
                    <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
                    <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
                  </div>
                  <div class="btn-group">
                    <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="fa fa-link"></i></a>
                    <div class="dropdown-menu input-append">
                      <input class="span2" placeholder="URL" type="text" data-edit="createLink" />
                      <button class="btn" type="button">Add</button>
                    </div>
                    <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-cut"></i></a>

                  </div>

                  <!--<div class="btn-group">
                    <a class="btn" title="Insert picture (or just drag & drop)" id="pictureBtn"><i class="fa fa-picture-o"></i></a>
                    <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" />
                  </div>-->
                  
                  <div class="btn-group">
                    <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                    <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
                  </div>
                </div>
                <!-- FINAL -->
                <div id="editor"></div>
                 <textarea name="observacao" id="descr" style="display: none;"></textarea>



              </div>

                      </div>  <!-- FINAL ABA 003 -->
                      <!-- **************** -->

                        <!-- ABA CONTATOS -->
                       <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
                        
                          <div class="form-group">

                            <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>Responsável</label>
                  <input type="text" class="form-control" name="responsavel" id="responsavel" value="<?php echo set_value('responsavel')?>"/>
              </div>

              <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>Setor</label>
                  <input type="text" class="form-control" name="setor_resp" id="setor_resp" value="<?php echo set_value('setor_resp')?>"/>
              </div>

              <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>Telefone(s)</label>
                  <input type="text" class="form-control" name="telefone_resp" id="telefone_resp" value="<?php echo set_value('telefone_resp')?>"/>
              </div>

              <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>E-mail</label>
                  <input type="text" class="form-control" name="email_resp" id="email_resp" value="<?php echo set_value('email_resp')?>"/>
              </div>
            </div>

             <div class="form-group">

                            <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>Responsável</label>
                  <input type="text" class="form-control" name="responsavel2" id="responsavel2" value="<?php echo set_value('responsavel2')?>"/>
              </div>

              <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>Setor</label>
                  <input type="text" class="form-control" name="setor_resp2" id="setor_resp2" value="<?php echo set_value('setor_resp2')?>"/>
              </div>

              <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>Telefone(s)</label>
                  <input type="text" class="form-control" name="telefone_resp2" id="telefone_resp2" value="<?php echo set_value('telefone_resp2')?>"/>
              </div>

              <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>E-mail</label>
                  <input type="text" class="form-control" name="email_resp2" id="email_resp2" value="<?php echo set_value('email_resp2')?>"/>
              </div>


            </div>

               <div class="form-group">

                            <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>Responsável</label>
                  <input type="text" class="form-control" name="responsavel3" id="responsavel3" value="<?php echo set_value('responsavel3')?>"/>
              </div>

              <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>Setor</label>
                  <input type="text" class="form-control" name="setor_resp3" id="setor_resp3" value="<?php echo set_value('setor_resp3')?>"/>
              </div>

              <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>Telefone(s)</label>
                  <input type="text" class="form-control" name="telefone_resp3" id="telefone_resp3" value="<?php echo set_value('telefone_resp3')?>"/>
              </div>

              <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                  <label>E-mail</label>
                  <input type="text" class="form-control" name="email_resp3" id="email_resp3" value="<?php echo set_value('email_resp3')?>"/>
              </div>

              
            </div>
                       


                       </div>
                       <!-- FINAL CONTATOS -->
                    

                    
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

<script type="text/javascript">
   $(function(){
    

       function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#endereco").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
            }
            
            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#endereco").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#uf").val("...");
                        

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#endereco").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#uf").val(dados.uf);
                                
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
   
  
  

});
</script>


<!-- richtext editor -->
  
  <!-- editor -->
  <link href="<?= base_url() ?>css/editor/external/google-code-prettify/prettify.css" rel="stylesheet">
  <link href="<?= base_url() ?>css/editor/index.css" rel="stylesheet">

  <script src="<?= base_url() ?>js/editor/bootstrap-wysiwyg.js"></script>
  <script src="<?= base_url() ?>js/editor/external/jquery.hotkeys.js"></script>
  <script src="<?= base_url() ?>js/editor/external/google-code-prettify/prettify.js"></script>
  <script>
    $(document).ready(function() {
      $('.xcxc').click(function() {
        $('#descr').val($('#editor').html());
      });

      $("#editor").keyup(function(){
          //alert('teste');
          $('#descr').val($('#editor').html());
      });



    });

    $(function() {
      function initToolbarBootstrapBindings() {
        var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier',
            'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
            'Times New Roman', 'Verdana'
          ],
          fontTarget = $('[title=Font]').siblings('.dropdown-menu');
        $.each(fonts, function(idx, fontName) {
          fontTarget.append($('<li><a data-edit="fontName ' + fontName + '" style="font-family:\'' + fontName + '\'">' + fontName + '</a></li>'));
        });
        $('a[title]').tooltip({
          container: 'body'
        });
        $('.dropdown-menu input').click(function() {
            return false;
          })
          .change(function() {
            $(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');
          })
          .keydown('esc', function() {
            this.value = '';
            $(this).change();
          });

        $('[data-role=magic-overlay]').each(function() {
          var overlay = $(this),
            target = $(overlay.data('target'));
          overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
        });
        if ("onwebkitspeechchange" in document.createElement("input")) {
          var editorOffset = $('#editor').offset();
          $('#voiceBtn').css('position', 'absolute').offset({
            top: editorOffset.top,
            left: editorOffset.left + $('#editor').innerWidth() - 35
          });
        } else {
          $('#voiceBtn').hide();
        }
      };

      function showErrorAlert(reason, detail) {
        var msg = '';
        if (reason === 'unsupported-file-type') {
          msg = "Unsupported format " + detail;
        } else {
          console.log("error uploading file", reason, detail);
        }
        $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
          '<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
      };
      initToolbarBootstrapBindings();
      $('#editor').wysiwyg({
        fileUploadError: showErrorAlert
      });
      window.prettyPrint && prettyPrint();
    });
  </script>
  <!-- /editor -->

