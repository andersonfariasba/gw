<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">

        <div class="x_title">
          <h2>Movimentação Produto</h2>
          <ul class="nav navbar-right panel_toolbox">
          <li><a href="<?php echo site_url('produtos/filtro'); ?>"><i class="fa fa-search"></i> <strong>Produtos</strong></a></li>
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

            <?php echo form_open('movimentacao_produto/cadastrar/'.$objProduto->getId_produto(),array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>

        <input type="hidden" name="id_produto" class="span4" id="id_produto" value="<?php echo set_value('id_produto',$objProduto->getId_produto())?>">
     
         

         <div class="form-group">
          
              <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
               <!-- <label>Movimentação</label>-->
  <p>
  <label>
<input type="radio" id="tipo_mov_entrada" name="tipo_movimentacao"  value="<?php echo set_value('tipo_movimentacao',ENTRADA)?>" checked=""/> 
  
  <span style="color:green;font-weight:bold">Entrada de Produto:</span>
  </label>

  <label><span style="color:red;font-weight:bold">Saída de Produto:</span>
  <input type="radio" id="tipo_mov_saida" name="tipo_movimentacao" value="<?php echo set_value('tipo_movimentacao',SAIDA)?>"/>
  </label>
  </p>
              </div>
        </div>

          
         <div class="form-group">
          <div class="col-md-10 col-sm-6 col-xs-12 form-group has-feedback">
              <label>Produto:</label>
              <input type="text" readonly="" class="form-control" value="<?php echo set_value('descricao',$objProduto->getDescricao()); ?>"/>
            </div>
        </div>


         <div class="form-group">
            
            <div class="col-md-5 col-sm-6 col-xs-12 form-group has-feedback">
              <label>Quantidade Informada <?php echo "em: ". $objProduto->getUnidade()->getSigla(); ?></label>
              <input type="text"  onkeypress='return SomenteNumero(event)' class="form-control" name="qtd_mov" id="qtd_mov" value="<?php echo set_value('qtd_mov')?>"/>
               
            </div>

              <div class="col-md-5 col-sm-6 col-xs-12 form-group has-feedback">
              <label>Quantidade No Estoque <?php echo "em: ". $objProduto->getUnidade()->getSigla(); ?></label>
              <input type="text" readonly onkeypress='return SomenteNumero(event)' class="form-control" value="<?php echo set_value('qtd_estoque',$qtd_estoque)?>"/>
               
            </div>

        <!-- </div>

          <div class="form-group">-->
            
              <div class="col-md-10 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Motivo Movimentação<!--<span class="obrigatorio">*</span> <a data-toggle="modal" href="#modal_categoria" class="btn-link"><i class="fa fa-plus-circle"></i></a>--></label>
                        <select class="form-control" name="descricao" id="id_categoria">
                        </select>
                     </div>

         <!--</div>



          <div class="form-group">-->
            
            <div class="col-md-10 col-sm-6 col-xs-12 form-group has-feedback">
              <label>Responsável:</label>
              <input type="text" readonly class="form-control" name="responsavel" id="responsavel" value="<?php echo set_value('responsavel',$this->session->userdata('login'))?>"/>
            </div>

       <!--  </div>

          

           
           <div class="form-group" id="fornecedor_camada">-->
            
         

         </div>





            <div class="ln_solid"></div>

          <div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <button type="reset" class="btn btn-danger"><i class="fa fa-remove"></i> Limpar</button>
              <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Salvar</button>
              </form>
            </div>
          </div>
        </div>

    </div>  <!-- FINAL MIOLO -->

  </div> <!-- FINAL COL -->

</div> <!-- FINAL ROWS -->




<script type="text/javascript" src="<?php echo base_url(); ?>js/text_numero.js"></script>


<script type="text/javascript">

<?php if($msg==true){ ?>

hideMessage();

<?php } ?>

</script>



<script type="text/javascript">


 $(function() {
        

 //ajax caso seja entrada de produtos
                    var url = '<?= site_url("/motivo_mov/ajax_listar/1"); ?>/1';
                    $.getJSON(url, function(j){
                           
                    var options = '';
                    options += '<option value="">Selecione...</option>';
                    for (var i = 0; i < j.length; i++) {
                    options += '<option value="' + j[i].descricao + '">' + j[i].descricao + '</option>';
                    } 
                    $('#id_categoria').html(options).show();

                    });
                //final ajax

            
            $("#tipo_mov_entrada").click(function(){
             
                 $("#fornecedor_camada").show();
                
            });
             
             $("#tipo_mov_saida").click(function(){
                $("#fornecedor_camada").hide();
             });
                      
     
  });

 </script>


