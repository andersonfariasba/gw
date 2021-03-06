<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">

				<div class="x_title">
					<h2>Cadastrar Bandeira Cartão</h2>
					<ul class="nav navbar-right panel_toolbox">
					<li><a href="<?php echo site_url('bandeira_cartao/cadastrar'); ?>"><i class="fa fa-plus-circle"></i> <strong>Novo</strong></a></li>
					<li><a href="<?php echo site_url('bandeira_cartao/filtro'); ?>"><i class="fa fa-search"></i> <strong>Pesquisar</strong></a></li>
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

			  	  <?php echo form_open('bandeira_cartao/cadastrar',array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>

			  	  <div class="form-group">
                  
                   <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <label>Operadora <a data-toggle="modal" href="#modal_categoria" class="btn-link"><i class="fa fa-plus-circle"></i></a></label>
                        <select class="form-control" name="id_operadora" id="id_operadora">
                        </select>
                     </div>

                  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
								<label>Tipo de Cartão</label>
								<select class="form-control" name="id_forma" id="id_forma">

								<option value="">Selecione...</option>
								<?php foreach ($listForma as $objForma): ?>
								<option value="<?php echo $objForma->getId_forma(); ?>" <?php echo set_select('id_forma',$objForma->getId_forma()); ?>>
								<?php echo $objForma->getForma(); ?>
								</option>
								<?php endforeach; ?>

								</select>
					</div>

					<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Bandeira</label>
							<input type="text" class="form-control" name="bandeira" id="bandeira" value="<?php echo set_value('bandeira')?>" maxlength="250"/>
					</div>

					<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Taxa (%)</label>
							<input type="text" class="form-control" name="taxa" id="taxa" value="<?php echo set_value('taxa')?>" maxlength="250"/>
					</div>

					<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Máximo Parcela</label>
							<input type="text" class="form-control" name="max_parcela" id="max_parcela" value="<?php echo set_value('max_parcela')?>" maxlength="250"/>
					</div>
					</div>


                    <div class="form-group">
					 <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">

                      <p>
                      <label>Antecipar Recebimento?</label>
                       <input type="checkbox" class="flat" checked="" name="antecipacao_pagamento" value="<?php echo set_value('antecipacao_pagamento',SIM)?>"> 
                     
                      </p>
                      </div>
                      </div>
                      </div>
                  




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
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-circle"></i> Adicionar Operadora</h4>
            </div>
            <div class="modal-body">
              <div id="testmodal">
                <!--<form id="antoform" class="form-horizontal" role="form">-->
               <form class="contact form-horizontal" id="ajax_form">
                  
               
                  <div class="form-group">
                    
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Empresa:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" name="empresa" id="empresa" value="<?php echo set_value('empresa')?>" maxlength="200"/>
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




<script type="text/javascript">

//CATEGORIA MODAL
  $("#nova_categoria").click(function(){             
      $('#form-content').modal({
        show: 'true'
      });
  });

    //CATEGORIA   
   var url = '<?= site_url("/operadoras_cartao/ajax_listar/0"); ?>/';
   $.getJSON(url, function(j){
                             
      var options = '';
       //options += '<option value="">Selecione...</option>';
       for (var i = 0; i < j.length; i++) {
          options += '<option value="' + j[i].id_operadora + '">' + j[i].empresa + '</option>';
        } 
       $('#id_operadora').html(options).show();
       
    });


   //AJAX CADASTRAR
  $('#ajax_form').submit(function(){
 
    $.ajax({
    type: "POST",
    url: "<?php echo site_url('operadoras_cartao/cadastrar'); ?>",
    data: $('form.contact').serialize(),
        success: function(msg){
           //$("#teste").html(msg)
           var url = '<?= site_url("/operadoras_cartao/ajax_listar/1"); ?>/';

           $.getJSON(url, function(j){
                 
          
          var optionsUp = '';
           for (var i = 0; i < j.length; i++) {
              optionsUp += '<option value="' + j[i].id_operadora + '">' + j[i].empresa + '</option>';
            } 
           $('#id_operadora').html(optionsUp).show();

            });       
          
          $("#modal_categoria").modal('hide');                             
          
            },
            
    error: function(j){
      //alert("failure");
      }
          });

    return false;
  });



<?php if($msg==true){ ?>
//função para ocultar mensagem de cadastro: arquivo: js/base.js
hideMessage();

<?php } ?>

</script>


