<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">

        <div class="x_title">
          <h2>Editar Produto</h2>
          <ul class="nav navbar-right panel_toolbox">
          <li><a href="<?php echo site_url('produtos/cadastrar'); ?>"><i class="fa fa-plus-circle"></i> <strong>Novo Produto</strong></a></li>
          <li><a href="<?php echo site_url('produtos/filtro'); ?>"><i class="fa fa-search"></i> <strong>Pesquisar Produto</strong></a></li>
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

            <?php echo form_open('produtos/editar/'.$objProduto->getId_produto(),array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
            <input type="hidden" name="tipo" value="<?php echo set_value('tipo',PRODUTO); ?>" />
             <input type="hidden" name="id_produto" value="<?php echo $objProduto->getId_produto(); ?>">
              <input type="hidden" name="abater_estoque" value="<?php echo $objProduto->getAbater_estoque(); ?>">   
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
                      
                    <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Código <span class="obrigatorio">*</span></label>
                        <input type="text" class="form-control" name="codigo" id="codigo" maxlength="250" value="<?php echo set_value('codigo',$objProduto->getCodigo())?>"/>
                        </div>


                      <div class="col-md-5 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Categoria <span class="obrigatorio">*</span></label>
                        <select class="form-control" name="id_categoria" id="id_categoria">
                          <option value="">Selecione...</option>
                         <?php foreach ($listCategoria as $objCategoria): 
                             $categoria = $objCategoria->getId_categoria();
                             ?>
                        <option value="<?php echo $objCategoria->getId_categoria(); ?>" <?php echo set_select('id_categoria',$categoria,$objProduto->categoriaIs($categoria)); ?>>
                           <?php echo $objCategoria->getCategoria(); ?>
                        </option>
                         <?php endforeach; ?>
                        </select>
                     </div>

                     <div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Unidade de Medida <span class="obrigatorio">*</span></label>
                        <select class="form-control" name="id_unidade" id="id_unidade">
                        <option value="">Selecione...</option>
                         <?php foreach ($listUnidade as $objUnidade): 
                             $unidade = $objUnidade->getId_unidade();
                             ?>
                        <option value="<?php echo $objUnidade->getId_unidade(); ?>" <?php echo set_select('id_unidade',$unidade,$objProduto->unidadeIs($unidade)); ?>>
                           <?php echo $objUnidade->getUnidade(); ?>
                        </option>
                         <?php endforeach; ?>
                        </select>
                     </div>



                   




                    </div>

                     

                     <div class="form-group">
                      
                        <div class="col-md-12 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Nome do Produto <span class="obrigatorio">*</span></label>
                        <input type="text" class="form-control" name="descricao" id="descricao" value="<?php echo set_value('descricao',$objProduto->getDescricao())?>" maxlength="250"/>
                        </div>

                   

                       
                     

                    </div>

                      <?php
                        $valor_custo = 0;
                        
                        if($valor_medio['valor_medio']>0){
                          $valor_custo = $valor_medio['valor_medio'];
                        }
                        else{
                          $valor_custo = $objProduto->getValor_custo();
                        }
                       
                       ?>

                       
 <?php if($valor_medio['valor_medio']>0){ ?>
                        <div class="form-group">

                          <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Valor Custo Médio Compra (R$)</label>
                        <input type="text" class="form-control" tipo="moneyReal" readonly value="<?php echo set_value('valor_medio', number_format($valor_custo, 2, ',', '.'))?>" maxlength="250"/>
                        </div>

                        </div>
<?php } ?>


                     

                     <div class="form-group">

                     

                        <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Valor Custo Informado(R$)</label>
                        <input type="text" class="form-control" tipo="moneyReal" id="valor_custo" value="<?php echo set_value('valor_medio', number_format($objProduto->getValor_custo(), 2, ',', '.'))?>" maxlength="250"/>
                        </div>

                       
                        <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Outras Despesas (R$)</label>
                        <input type="text" class="form-control" tipo="moneyReal" name="valor_despesas" id="valor_despesas" value="<?php echo set_value('valor_venda', number_format($objProduto->getValor_despesas(), 2, ',', '.'))?>" maxlength="250"/>
                        </div>

                         <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Percentual de Lucro(%)</label>
                        <input type="text" class="form-control" tipo="moneyReal" name="percentual_lucro" id="percentual_lucro" value="<?php echo set_value('valor_venda', number_format($objProduto->getPercentual_lucro(), 2, ',', '.'))?>" maxlength="250"/>
                        </div>

                        <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Valor Venda (R$) <span class="obrigatorio">*</span></label>
                        <input type="text" class="form-control" tipo="moneyReal" name="valor_venda" id="valor_venda" value="<?php echo set_value('valor_venda', number_format($objProduto->getValor_venda(), 2, ',', '.'))?>" maxlength="250"/>
                        </div>

                      </div>

                      <div class="form-group">

                        <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Quantidade Mínima</label>
                        <input type="text" class="form-control" onkeypress='return SomenteNumero(event)' name="qtd_minima" id="qtd_minima" value="<?php echo set_value('qtd_minima',$objProduto->getQtd_minima())?>" maxlength="250"/>
                        </div>


                        <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Referência</label>
                        <input type="text" class="form-control" name="referencia" id="referencia" maxlength="250" value="<?php echo set_value('referencia',$objProduto->getReferencia())?>"/>
                        </div>

                       

                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Localização do Produto Na Empresa</label>
                        <input type="text" class="form-control" name="localizacao" id="localizacao" value="<?php echo set_value('localizacao',$objProduto->getLocalizacao())?>" maxlength="250"/>
                        </div>
                     </div>

                    
                      <?php if($this->session->userdata('mod_vendas')==SIM){ ?>

                    <div class="form-group">

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">

                      <p>
                      <label>Habilitar Produto para Venda.</label>
                       <input type="checkbox" class="flat"  name="habilitado_venda" <?php if($objProduto->getHabilitado_venda()==SIM){ echo "checked='' "; } ?> value="1"> 
                     
                      </p>
                      </div>
                    </div>
                    <?php } ?>
                
                <?php if($this->session->userdata('mod_locacao')==SIM){ ?>

                  <div class="form-group">

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">

                      <p>
                      <label>Habilitar Produto para Locação.</label>
                       <input type="checkbox" class="flat"  name="habilitado_locacao" <?php if($objProduto->getHabilitado_locacao()==SIM){ echo "checked='' "; } ?> value="1"> 
                     
                      </p>
                      </div>
                    </div>

                <?php } ?>

              

            
            
                      </div>  <!-- FINAL ABA 001 -->
                      <!-- **************** -->
                      
                      <!-- ABA 003 -->
                      <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                        
                          <div class="form-group">
                      
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                <label>Anotações</label>
                <textarea id="observacao" rows="10" class="form-control" name="observacao">
                  
                  <?php echo $objProduto->getObservacao(); ?>
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

  


</script>


<script type="text/javascript" src="<?php echo base_url(); ?>js/text_numero.js"></script>

<script type="text/javascript">

<?php if($msg==true){ ?>
//função para ocultar mensagem de cadastro: arquivo: js/base.js
hideMessage();

<?php } ?>

 function moedaParaNumero(valor)
    {
      return isNaN(valor) == false ? parseFloat(valor) :   parseFloat(valor.replace("R$","").replace(".","").replace(",","."));
    }

    var valor_custo = moedaParaNumero($('#valor_custo').val());
    valor_custo = (isNaN(valor_custo) ? 0 : valor_custo);

    
    //AO DIGITAR OUTRAS DESPESAS
    $("#valor_despesas").focusout(function(){

      var valor_custo = moedaParaNumero($('#valor_custo').val());
       valor_custo = (isNaN(valor_custo) ? 0 : valor_custo);

        
        var valor_despesas = moedaParaNumero($('#valor_despesas').val());
        valor_despesas = (isNaN(valor_despesas) ? 0 : valor_despesas);

        var percentual_lucro = moedaParaNumero($('#percentual_lucro').val());
        percentual_lucro = (isNaN(percentual_lucro) ? 0 : percentual_lucro);
        
        var valor_venda = valor_custo + valor_despesas;

        var valor_percentual = (percentual_lucro / 100) * valor_venda;

        var valor_final = valor_venda + valor_percentual; 

       
        $("#valor_venda").val(valor_final.toFixed(2).replace(".", ","));

      });

    //AO PERCENTUAL DE LUCRO
    $("#percentual_lucro").focusout(function(){

      var valor_custo = moedaParaNumero($('#valor_custo').val());
       valor_custo = (isNaN(valor_custo) ? 0 : valor_custo);

        
        var valor_despesas = moedaParaNumero($('#valor_despesas').val());
        valor_despesas = (isNaN(valor_despesas) ? 0 : valor_despesas);

        var percentual_lucro = moedaParaNumero($('#percentual_lucro').val());
        percentual_lucro = (isNaN(percentual_lucro) ? 0 : percentual_lucro);
        
        var valor_venda = valor_custo + valor_despesas;

        var valor_percentual = (percentual_lucro / 100) * valor_venda;

       
        var valor_final = valor_venda + valor_percentual; 

       
        $("#valor_venda").val(valor_final.toFixed(2).replace(".", ","));

      });


    //AO DIGITAR VALOR CUSTO
    $("#valor_custo").focusout(function(){

      var valor_custo = moedaParaNumero($('#valor_custo').val());
       valor_custo = (isNaN(valor_custo) ? 0 : valor_custo);

        
        var valor_despesas = moedaParaNumero($('#valor_despesas').val());
        valor_despesas = (isNaN(valor_despesas) ? 0 : valor_despesas);

        var percentual_lucro = moedaParaNumero($('#percentual_lucro').val());
        percentual_lucro = (isNaN(percentual_lucro) ? 0 : percentual_lucro);
        
        var valor_venda = valor_custo + valor_despesas;

        var valor_percentual = (percentual_lucro / 100) * valor_venda;

       
        var valor_final = valor_venda + valor_percentual; 

       
        $("#valor_venda").val(valor_final.toFixed(2).replace(".", ","));

      });

    
    $("#valor_venda").keypress(function(event){

      if ( event.which == 13 ) {
       event.preventDefault();
      }


            
        var zerar = 0;
        $("#percentual_lucro").val(zerar.toFixed(2).replace(".", ","));
        $("#valor_despesas").val(zerar.toFixed(2).replace(".", ","));

      });







</script>


