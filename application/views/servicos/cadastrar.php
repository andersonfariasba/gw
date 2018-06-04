<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">

        <div class="x_title">
          <h2>Cadastrar Serviço</h2>
          <ul class="nav navbar-right panel_toolbox">
         
          <li><a href="<?php echo site_url('servicos/filtro'); ?>"><i class="fa fa-search"></i> <strong>Pesquisar Serviço</strong></a></li>
          <li><a href="#"><i class="fa fa-bar-chart"></i> <strong>Relatórios</strong></a></li>
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

            <?php echo form_open('servicos/cadastrar',array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
            <input type="hidden" name="tipo" value="<?php echo set_value('tipo',SERVICO); ?>" />   
             <!-- INICIO TAB GERAL -->
             <div class="" role="tabpanel" data-example-id="togglable-tabs">
                   
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                      <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Dados Básicos</a>
                      </li>
                      
                      <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Info</a>
                      </li>
                    </ul>
                    
                    <div id="myTabContent" class="tab-content">
                      
                      <!-- ABA 001 -->
                    <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                        

                  


                    <div class="form-group">
                      
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Categoria <a data-toggle="modal" href="#modal_categoria" class="btn-link"><i class="fa fa-plus-circle"></i></a></label>
                        <select class="form-control" name="id_categoria" id="id_categoria">
                        </select>
                     </div>

                       <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Descrição</label>
                        <input type="text" class="form-control" name="descricao" id="descricao" value="<?php echo set_value('descricao')?>" maxlength="250"/>
                        </div>

                 

                    </div>

                     

                 
                    

                     <div class="form-group">

                       <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Valor Custo(R$)</label>
                        <input type="text" class="form-control" name="valor_custo" tipo="moneyReal" id="valor_custo" value="<?php echo set_value('valor_custo')?>" maxlength="250"/>
                        </div>
                     

                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Valor Venda(R$)</label>
                        <input type="text" class="form-control" tipo="moneyReal" name="valor_venda" id="valor_venda" value="<?php echo set_value('valor_venda')?>" maxlength="250"/>
                        </div>
                     </div>

                       <div class="form-group">

                       <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Código</label>
                        <input type="text" class="form-control" name="codigo" id="codigo" maxlength="250" value="<?php echo set_value('codigo')?>"/>
                        </div>
                     </div>

                     

                                 

            
            
                      </div>  <!-- FINAL ABA 001 -->
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



 <!-- MODAL CATEGORIA -->
      <div id="modal_categoria" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-circle"></i> Adicionar Categoria</h4>
            </div>
            <div class="modal-body">
              <div id="testmodal">
                <!--<form id="antoform" class="form-horizontal" role="form">-->
               <form class="contact form-horizontal" id="ajax_form">
                  
               
                  <div class="form-group">
                    
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Categoria:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" name="categoria" id="categoria" value="<?php echo set_value('categoria')?>" maxlength="50"/>
                    </div>
                  </div>

                   
                
              </div>
            </div>
            <div class="modal-footer">
              <!--<button type="button" class="btn antoclose" data-dismiss="modal">Fechar</button>-->
              <a href="#" data-dismiss="modal" aria-hidden="true" class="btn">Fechar Janela</a>
              <button type="submit" class="btn btn-success"><i class="fa fa-plus-circle"></i> Incluir</button>
              </form>
            </div>
          </div>
        </div>
      </div>

<!-- FINAL MODAL CATEGORIA -->


 <!-- MODAL UNIDADE DE MEDIA -->
      <div id="modal_unidade" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-circle"></i> Adicionar Unidade de Medida</h4>
            </div>
            <div class="modal-body">
              <div id="testmodal">
               
             
                <form class="contact-unidade form-horizontal" id="ajax_form_unidade">
                  
               
                  <div class="form-group">
                    
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Unidade de Medida:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" name="unidade" id="unidade" value="<?php echo set_value('unidade')?>" maxlength="50"/>
                    </div>
                  </div>

                   <div class="form-group">
                    
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Sigla:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" name="sigla" id="sigla" value="<?php echo set_value('unidade')?>" maxlength="50"/>
                    </div>
                  </div>

                   
                
              </div>
            </div>
            <div class="modal-footer">
              <!--<button type="button" class="btn antoclose" data-dismiss="modal">Fechar</button>-->
              <a href="#" data-dismiss="modal" aria-hidden="true" class="btn">Fechar Janela</a>
              <button type="submit" class="btn btn-success"><i class="fa fa-plus-circle"></i> Incluir</button>
              </form>
            </div>
          </div>
        </div>
      </div>

<!-- FINAL MODAL UNIDADE CATEGORIA -->


<!-- MODAL FORNECEDOR -->
      <div id="modal_fornecedor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-circle"></i> Adicionar Fornecedor</h4>
            </div>
            <div class="modal-body">
              <div id="testmodal">
               
             
               
                <form class="contact-fornecedor form-horizontal" id="ajax_form_fornecedor"> 
                 <input type="hidden" name="tipo" value="<?php echo set_value('tipo',PESSOA_JURIDICA)?>">
               
                  <div class="form-group">
                    
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Nome Fantasia:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" name="nome_fantasia" id="nome_fantasia" value="<?php echo set_value('nome_fantasia')?>" maxlength="100"/>
                    </div>
                  </div>

                                      
                
              </div>
            </div>
            <div class="modal-footer">
              <!--<button type="button" class="btn antoclose" data-dismiss="modal">Fechar</button>-->
              <a href="#" data-dismiss="modal" aria-hidden="true" class="btn">Fechar Janela</a>
              <button type="submit" class="btn btn-success"><i class="fa fa-plus-circle"></i> Incluir</button>
              </form>
            </div>
          </div>
        </div>
      </div>

<!-- FINAL MODAL FORNECEDOR -->



<script type="text/javascript">

  //CATEGORIA MODAL
  $("#nova_categoria").click(function(){             
      $('#form-content').modal({
        show: 'true'
      });
  });

   
   //Categoria   
   var url = '<?= site_url("/est_categorias/ajax_listar/0"); ?>/';
   $.getJSON(url, function(j){
                             
      var options = '';
       //options += '<option value="">Selecione...</option>';
       for (var i = 0; i < j.length; i++) {
          options += '<option value="' + j[i].id_categoria + '">' + j[i].categoria + '</option>';
        } 
       $('#id_categoria').html(options).show();
       
    });


    //Unidade   
   var urlUnidade = '<?= site_url("/est_un_medida/ajax_listar/0"); ?>/';
   $.getJSON(urlUnidade, function(u){
                             
      var optionsUnidade = '';
       //options += '<option value="">Selecione...</option>';
       for (var x = 0; x < u.length; x++) {
          optionsUnidade += '<option value="' + u[x].id_unidade + '">' + u[x].unidade + '</option>';
        } 
       $('#id_unidade').html(optionsUnidade).show();
       
    });


     //Fornecedor   
   var urlFornecedor = '<?= site_url("/fornecedores/ajax_listar/0"); ?>/';
   $.getJSON(urlFornecedor, function(u){
                             
      var optionsForn = '';
       //options += '<option value="">Selecione...</option>';
       for (var x = 0; x < u.length; x++) {
          optionsForn += '<option value="' + u[x].id_fornecedor + '">' + u[x].nome_fantasia + '</option>';
        } 
       $('#id_fornecedor').html(optionsForn).show();
       
    });



  //AJAX CATEGORIA MODAL
  $('#ajax_form').submit(function(){
 
    $.ajax({
    type: "POST",
    url: "<?php echo site_url('est_categorias/cadastrar'); ?>",
    data: $('form.contact').serialize(),
        success: function(msg){
           //$("#teste").html(msg)
           var url = '<?= site_url("/est_categorias/ajax_listar/1"); ?>/';

           $.getJSON(url, function(j){
                 
          
          var optionsUp = '';
           for (var i = 0; i < j.length; i++) {
              optionsUp += '<option value="' + j[i].id_categoria + '">' + j[i].categoria + '</option>';
            } 
           $('#id_categoria').html(optionsUp).show();

            });       
          
            $("#modal_categoria").modal('hide');                     
          
            },
            
    error: function(j){
      //alert("failure");
      }
          });

    return false;
  });





   //UNIDADE DE MEDIDA MODAL
  $("#nova_unidade").click(function(){             
      $('#form-unidade').modal({
        show: 'true'
      });
  });

//AJAX CATEGORIA MODAL
  $('#ajax_form_unidade').submit(function(){
 
    $.ajax({
    type: "POST",
    url: "<?php echo site_url('est_un_medida/cadastrar'); ?>",
    data: $('form.contact-unidade').serialize(),
        success: function(msg){
         //Unidade   
   var urlUnidade = '<?= site_url("/est_un_medida/ajax_listar/1"); ?>/';
   $.getJSON(urlUnidade, function(u){
                             
      var optionsUnidade = '';
       //options += '<option value="">Selecione...</option>';
       for (var x = 0; x < u.length; x++) {
          optionsUnidade += '<option value="' + u[x].id_unidade + '">' + u[x].unidade + '</option>';
        } 
          

            $('#id_unidade').html(optionsUnidade).show();
       
        });
        
            $("#modal_unidade").modal('hide');                     
          
            },
            
    error: function(u){
      //alert("failure");
      }
          });

    return false;
  });




   //FORCEDOR MODAL
  $("#novo_fornecedor").click(function(){             
      $('#form-fornecedor').modal({
        show: 'true'
      });
  });


  //AJAX FORNECEDOR MODAL
  $('#ajax_form_fornecedor').submit(function(){
 
    $.ajax({
    type: "POST",
    url: "<?php echo site_url('fornecedores/cadastrar'); ?>",
    data: $('form.contact-fornecedor').serialize(),
        success: function(msg){
         //Unidade   
   var urlFornecedor = '<?= site_url("/fornecedores/ajax_listar/1"); ?>/';
  
   $.getJSON(urlFornecedor, function(f){
                             
      var optionsFornecedores = '';
       //options += '<option value="">Selecione...</option>';
       for (var x = 0; x < f.length; x++) {
          optionsFornecedores += '<option value="' + f[x].id_fornecedor + '">' + f[x].nome_fantasia + '</option>';
        } 
          

            $('#id_fornecedor').html(optionsFornecedores).show();
       
        });
        
            $("#modal_fornecedor").modal('hide');                     
          
            },
            
    error: function(f){
      //alert("failure");
      }
          });

    return false;
  });





</script>



<script type="text/javascript">

<?php if($msg==true){ ?>
//função para ocultar mensagem de cadastro: arquivo: js/base.js
hideMessage();

<?php } ?>

</script>


