<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">

				<div class="x_title">
					<h2>Cadastrar Tabela Taxa</h2>
					<ul class="nav navbar-right panel_toolbox">
					 <li><a href="<?php echo site_url('tabela_taxa/filtro'); ?>"><i class="fa fa-search"></i> <strong>Pesquisar</strong></a></li>
          
        
          
          <li><a href="<?php echo site_url('formas_recebimentos/filtro'); ?>"><i class="fa fa-bars"></i> <strong>Formas de Recebimento</strong></a></li>

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

			  	  <?php echo form_open('tabela_taxa/cadastrar',array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>

					<div class="form-group">
						
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<label>Nome da Tabela</label>
							<input type="text" class="form-control" name="nome" id="nome" value="<?php echo set_value('nome')?>" maxlength="50"/>
						</div>

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






<script type="text/javascript">

<?php if($msg==true){ ?>
//função para ocultar mensagem de cadastro: arquivo: js/base.js
hideMessage();

<?php } ?>

</script>

<script type="text/javascript">
            /* Função jQuery para remover linha */

            $.removeLinha = function(element)
            {

                /* Conta quantidade de linhas na tabela */

                var linha_total = $('tbody#repetir tr').length;

                /* Condição que mantém pelo menos uma linha na tabela */

                if (linha_total > 1)
                {

                    /* Remove os elementos da linha onde está o botão clicado */

                    $(element).parent().parent().remove();

                }

                /* Avisa usuário de que não pode remover a última linha */

                else
                {

                    alert("Desculpe, mas você não pode remover esta última linha!");

                }

            };

            /* Quando o documento estiver carregado… */

            $(document).ready(function()
            {

                /* Variável que armazena limite de linhas (zero é ilimitada) */

                var limite_linhas = 36;

                /* Quando o botão adicionar for clicado... */

                $('#add').click(function()
                {

                    /* Conta quantidade de linhas na tabela */

                    var linha_total = $('tbody#repetir tr').length;

                    /* Condição que verifica se existe limite de linhas e, se existir, testa se usuário atingiu limite */

                    if (limite_linhas && limite_linhas > linha_total)
                    {

                        /* Pega uma linha existente */

                        var linha = $('tbody#repetir tr').html();

                        /* Conta quantidade de linhas na tabela */

                        var linha_total = $('tbody#repetir tr').length;

                        /* Pega a ID da linha atual */

                        var linha_id = $('tbody#repetir tr').attr('id');

                        /* Acrescenta uma nova linha, incluindo a nova ID da linha */

                        $('tbody#repetir').append('<tr id="linha_' + (linha_total + 1) + '">' + linha + '</tr>');

                    }

                    /* Se usuário atingiu limite de linhas… */

                    else
                    {
                        alert("Desculpe, mas você só pode adicionar até " + limite_linhas + " linhas!");
                    }

                });

            });
</script>



