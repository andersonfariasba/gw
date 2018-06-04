<?php 
$mod_locacao = $this->session->userdata('mod_locacao');
 $mod_caixa = $this->session->userdata('mod_caixa');
 $mod_vendas = $this->session->userdata('mod_vendas');
 $mod_compras = $this->session->userdata('mod_compras');
  $mod_bar = $this->session->userdata('mod_bar');
?>


<script type="text/javascript">
$(function(){
  $(".cpfcnpj").keydown(function(){

    try {
      $(".cpfcnpj").unmask();
    } catch (e) {}
    
    var tamanho = $(".cpfcnpj").val().length;
  
    if(tamanho < 11){
        $(".cpfcnpj").mask("999.999.999-99");
    } else if(tamanho >= 11){
        $(".cpfcnpj").mask("99.999.999/9999-99");
    }                   
});

});

</script>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">

				<div class="x_title">
					<h2>Relatórios do Sistema</h2>
					<!--<ul class="nav navbar-right panel_toolbox">
					<li><a href="<?php echo site_url('centro_custos/cadastrar'); ?>"><i class="fa fa-plus-circle"></i> <strong>Novo</strong></a></li>
					<li><a href="<?php echo site_url('centro_custos/filtro'); ?>"><i class="fa fa-search"></i> <strong>Pesquisar</strong></a></li>
					<li><a href="#"><i class="fa fa-bar-chart"></i> <strong>Relatórios</strong></a></li>
					</ul>  -->                   
					<div class="clearfix"></div>
				</div>

				<!-- ********* INICIO MIOLO **********-->
				<!--<div class="x_content">--> <!-- INICIO MIOLO-->

				<!--<div class="col-md-6 col-sm-6 col-xs-12">-->
              <div class="x_panel">
                <!--<div class="x_title">
                  <h2><i class="fa fa-align-left"></i> Collapsible / Accordion <small>Sessions</small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>-->


                <!--<div class="x_content">-->

                  <!-- start accordion -->
                  <div class="accordion" id="accordion1" role="tablist" aria-multiselectable="true">
                    
                    <div class="panel">
                      <a class="panel-heading collapsed" role="tab" id="headingOne1" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne1" aria-expanded="false" aria-controls="collapseOne">
                        <h4 class="panel-title">Comercial</h4>
                      </a>
                      <div id="collapseOne1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                         
                         <ul>
                         	<li><a data-toggle="modal" href="#modal_cliente">Clientes</a></li>
                          <li><a data-toggle="modal" href="#modal_fornecedor">Fornecedores</a></li>
                         </ul>

                        </div>
                      
                      </div>
                    </div>

                    <?php if($mod_vendas==SIM){ ?>
                    <div class="panel">
                      <a class="panel-heading collapsed" role="tab" id="headingTwo1" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo1" aria-expanded="false" aria-controls="collapseTwo">
                        <h4 class="panel-title">Vendas / Cotações</h4>
                      </a>
                      <div id="collapseTwo1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body">
                         <ul>
                         	<li><a data-toggle="modal" href="#modal_vendas_resumida">Vendas Resumido</a></li>
                          <li><a data-toggle="modal" href="#modal_vendas_detalhada">Vendas Detalhada</a></li>
                         	<li><a data-toggle="modal" href="#modal_orcamentos_detalhada">Cotação</a></li>
                         	<!--<li><a href="#">Movimentação de Estoque</a></li>-->
                         </ul>
                        </div>
                      </div>
                    </div>
                    <?php } ?>

                      <?php if($mod_bar==SIM ){ ?>
                    <div class="panel">
                      <a class="panel-heading collapsed" role="tab" id="headingTwo1" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo1" aria-expanded="false" aria-controls="collapseTwo">
                        <h4 class="panel-title">Vendas</h4>
                      </a>
                      <div id="collapseTwo1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body">
                         <ul>
                          <li><a data-toggle="modal" href="#modal_vendas_resumida">Vendas Resumido</a></li>
                          <li><a data-toggle="modal" href="#modal_vendas_detalhada">Vendas Detalhada</a></li>
                         
                          <!--<li><a href="#">Movimentação de Estoque</a></li>-->
                         </ul>
                        </div>
                      </div>
                    </div>
                    <?php } ?>

                    <?php if($mod_locacao==SIM){ ?>
                     <div class="panel">
                      <a class="panel-heading collapsed" role="tab" id="headingTwo1" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo1Loc" aria-expanded="false" aria-controls="collapseTwo">
                        <h4 class="panel-title">Locação</h4>
                      </a>
                      <div id="collapseTwo1Loc" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body">
                         <ul>
                        
                          <li><a data-toggle="modal" href="#modal_locacao_detalhada">Locações</a></li>
                         <!-- <li><a data-toggle="modal" href="#modal_orcamentos_detalhada">Cotação</a></li>-->
                            <li><a data-toggle="modal" href="#modal_entrega">Entregas</a></li>
                          <!--<li><a href="#">Movimentação de Estoque</a></li>-->
                         </ul>
                        </div>
                      </div>
                    </div>
                    <?php } ?>



                    <div class="panel">
                      <a class="panel-heading collapsed" role="tab" id="headingFour1" data-toggle="collapse" data-parent="#accordion1" href="#collapseFour1" aria-expanded="false" aria-controls="collapseThree">
                        <h4 class="panel-title">Financeiro</h4>
                      </a>
                      <div id="collapseFour1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                        <div class="panel-body">
                          <ul>
                           <li><a data-toggle="modal" href="#modal_caixa">Caixa Análise</a></li>
                          <li><a data-toggle="modal" href="#modal_contas_pagar">Contas a Pagar</a></li>
                          <li><a data-toggle="modal" href="#modal_contas_receber">Contas a Receber Detalhado</a></li>
                          <li><a data-toggle="modal" href="#modal_contas_receber_forma">Vendas Agrupado por Forma de Recebimento</a></li>
                          
                          <li><a data-toggle="modal" href="#modal_comissao_venda">Comissão de Vendas</a></li>

                          <li><a data-toggle="modal" href="#modal_resumo_financeiro">Resumo Financeiro</a></li>
                          <!--<li><a href="#">Comissão de Vendas</a></li>
                          <li><a href="#">Fluxo de Caixa</a></li>-->
                          
                          <!--<li><a href="#">Lucratividade</a></li>
                          <li><a href="#">Comissão de Vendas</a></li>-->
                         </ul>
                        </div>
                      </div>
                    </div>


                    
                    <div class="panel">
                      <a class="panel-heading collapsed" role="tab" id="headingThree1" data-toggle="collapse" data-parent="#accordion1" href="#collapseThree1" aria-expanded="false" aria-controls="collapseThree">
                        <h4 class="panel-title">Estoque / Serviços</h4>
                      </a>
                      <div id="collapseThree1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                        <div class="panel-body">
                          <ul>
                         	<li><a data-toggle="modal" href="#modal_produtos">Produtos</a></li>
                         	<li><a data-toggle="modal" href="#modal_servico">Serviços</a></li>
                          <!--<li><a data-toggle="modal" href="#modal_produtos">Ranking de Produtos</a></li>-->
                        <!-- <li><a data-toggle="modal" href="#modal_ranking_produto">Ranking Produtos Vendidos</a></li>-->
                          <li><a data-toggle="modal" href="#modal_movimentacao">Movimentação de Estoque</a></li>


                            <!--<li><a data-toggle="modal" href="#modal_movimentacao_consolidado">Movimentação de Estoque</a></li>-->


                         </ul>
                        </div>
                      </div>
                    </div>

                    

                     <!--<div class="panel">
                      <a class="panel-heading collapsed" role="tab" id="headingFive1" data-toggle="collapse" data-parent="#accordion1" href="#collapseFive1" aria-expanded="false" aria-controls="collapseOne">
                        <h4 class="panel-title">Histórico de Acesso</h4>
                      </a>
                      <div id="collapseFive1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                         
                         <ul>
                          <li><a data-toggle="modal" href="#modal_transacao_user">Histórico de Acesso dos Usuários</a></li>
                         
                         </ul>

                        </div>
                      
                      </div>
                    </div>-->



                  </div>
                  <!-- end of accordion -->


               <!-- </div>-->
              <!--</div>
            </div>-->


		  	 

				     		
					</div> <!-- FINAL MIOLO -->
				</div>

		</div>  <!-- FINAL MIOLO -->

	</div> <!-- FINAL COL -->

</div> <!-- FINAL ROWS -->




<!-- TRANSAÇÃO ACESSO SISTEMA-->

<div id="modal_transacao_user" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bar-chart-o"></i> Relatório Histórico de Acesso</h4>
            </div>
            <div class="modal-body">
              <div id="testmodal">
              
                 <form class="form-horizontal" method="post" id="forgot_form" target="_blank" action="<?php echo base_url(); ?>relatorio_usuario/transacao_acesso/">
                  
               
                <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Usuário</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <select class="form-control" name="id_usuario" id="id_usuario">
                        <option value="">Todos...</option>
                        <?php foreach ($listUser as $objUser):  ?>
                        <option value="<?php echo $objUser->getId_usuario(); ?>">
                        <?php echo $objUser->getLogin(); ?>
                        </option>
                        <?php endforeach; ?>
                      </select>

                    </div>
                  </div>

                 
                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">De:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_de" value="<?php echo set_value('de',date('d/m/Y'))?>"/>
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Até:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_ate" value="<?php echo set_value('ate',date('d/m/Y'))?>"/>
                    </div>
                  </div>

                                    
       
              </div>

            </div>
            <div class="modal-footer">
             <span style="color:red;font-size:11px;text-align:left; ">São armazenaos dados dos últmos 90 dias.</span>
             <a href="#" data-dismiss="modal" aria-hidden="true" class="btn"> Fechar Janela</a>
              <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Pesquisar</button>
              </form>

            </div>

          </div>
        </div>
      </div>


<!-- FINAL TRANSAÇÃO -->



<!-- ENTRADA MOVIMENTACAO CONSOLIDADO -->


<!-- modal pesquisa comissao -->

      <!-- Start Calendar modal -->
      <div id="modal_resumo_financeiro" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bar-chart-o"></i> Relatório Resumo Financeiro</h4>
            </div>
            <div class="modal-body">
              <div id="testmodal">
              
                 <form class="form-horizontal" method="post" id="forgot_form" target="_blank" action="<?php echo base_url(); ?>relatorio_financeiro/resumo_financeiro/">
                  
               
                 
                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">De:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_de" value="<?php echo set_value('de')?>"/>
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Até:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_ate" value="<?php echo set_value('ate')?>"/>
                    </div>
                  </div>

                                    
       
              </div>

            </div>
            <div class="modal-footer">
             <a href="#" data-dismiss="modal" aria-hidden="true" class="btn"> Fechar Janela</a>
              <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Pesquisar</button>
              </form>
            </div>
          </div>
        </div>
      </div>


      <!-- final modal pesquisa -->


<!-- FINAL RELATÓRIO MOVIMENTACAO CONSOLIDADO -->






<!-- ENTRADA MOVIMENTACAO CONSOLIDADO -->


<!-- modal pesquisa comissao -->

      <!-- Start Calendar modal -->
      <div id="modal_movimentacao_consolidado" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bar-chart-o"></i> Relatório Movimentação de Estoque</h4>
            </div>
            <div class="modal-body">
              <div id="testmodal">
              
                 <form class="form-horizontal" method="post" id="forgot_form" target="_blank" action="<?php echo base_url(); ?>relatorio_estoque/movimentacao_consolidado/">
                  
               
                 
                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">De:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_de" value="<?php echo set_value('de')?>"/>
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Até:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_ate" value="<?php echo set_value('ate')?>"/>
                    </div>
                  </div>

                                    
       
              </div>

            </div>
            <div class="modal-footer">
             <a href="#" data-dismiss="modal" aria-hidden="true" class="btn"> Fechar Janela</a>
              <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Pesquisar</button>
              </form>
            </div>
          </div>
        </div>
      </div>


      <!-- final modal pesquisa -->


<!-- FINAL RELATÓRIO MOVIMENTACAO CONSOLIDADO -->



<!-- modal MOVIMENTAÇÃO -->

      <!-- Start Calendar modal -->
      <div id="modal_movimentacao" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bar-chart-o"></i> Relatório Movimentação de Estoque</h4>
            </div>
            <div class="modal-body">
              <div id="testmodal">
              
                 <form class="form-horizontal" method="post" id="forgot_form" target="_blank" action="<?php echo base_url(); ?>relatorio_estoque/movimentacao/">
                  
              
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo Movimentação</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                    <select class="form-control" name="tipo_movimentacao" id="tipo_movimentacao">
                    <option value="">Todos...</option>   
                        <option value="<?= ADD_MOV; ?>" <?= set_select('tipo_movimentacao',ADD_MOV); ?>>ENTRADA</option>
                        <option value="<?= REMOVER_MOV; ?>" <?= set_select('tipo_movimentacao',REMOVER_MOV); ?>>SAÍDA</option>
                    </select>

                    </div>
                  </div>


                 
                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">De:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_de" value="<?php echo set_value('de')?>"/>
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Até:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_ate" value="<?php echo set_value('ate')?>"/>
                    </div>
                  </div>

                                    
       
              </div>

            </div>
            <div class="modal-footer">
             <a href="#" data-dismiss="modal" aria-hidden="true" class="btn"> Fechar Janela</a>
              <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Pesquisar</button>
              </form>
            </div>
          </div>
        </div>
      </div>


      <!-- final modal pesquisa -->


<!-- FINAL RELATÓRIO MOVIMENTACAO CONSOLIDADO -->





<!-- ENTRADA RANKING DE PRODUTOS -->


<!-- modal pesquisa comissao -->

      <!-- Start Calendar modal -->
      <div id="modal_ranking_produto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bar-chart-o"></i> Relatório Ranking de Produto Vendido</h4>
            </div>
            <div class="modal-body">
              <div id="testmodal">
              
                 <form class="form-horizontal" method="post" id="forgot_form" target="_blank" action="<?php echo base_url(); ?>relatorio_estoque/ranking_produto/">
                  
               
                 
                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">De:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_de" value="<?php echo set_value('de')?>"/>
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Até:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_ate" value="<?php echo set_value('ate')?>"/>
                    </div>
                  </div>

                                    
       
              </div>

            </div>
            <div class="modal-footer">
             <a href="#" data-dismiss="modal" aria-hidden="true" class="btn"> Fechar Janela</a>
              <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Pesquisar</button>
              </form>
            </div>
          </div>
        </div>
      </div>


      <!-- final modal pesquisa -->


<!-- FINAL RELATÓRIO RANKING DE PRODUTOS -->







<!-- ENTRADA  COMISSAO VENDAS -->


<!-- modal pesquisa comissao -->

      <!-- Start Calendar modal -->
      <div id="modal_comissao_venda" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bar-chart-o"></i> Relatório Comissão de Vendas</h4>
            </div>
            <div class="modal-body">
              <div id="testmodal">
              
                 <form class="form-horizontal" method="post" id="forgot_form" target="_blank" action="<?php echo base_url(); ?>relatorio_financeiro/comissao_venda/">
                  
               
                 
                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">De:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_de" value="<?php echo set_value('de')?>"/>
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Até:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_ate" value="<?php echo set_value('ate')?>"/>
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Usuário</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <select class="form-control" name="id_usuario" id="id_usuario">
                      <!--  <option value="">Todos...</option>-->
                        <?php foreach ($listUser as $objUser):  ?>
                        <option value="<?php echo $objUser->getId_usuario(); ?>">
                        <?php echo $objUser->getLogin(); ?>
                        </option>
                        <?php endforeach; ?>
                      </select>

                    </div>
                  </div>

                  
                  
       
              </div>

            </div>
            <div class="modal-footer">
             <a href="#" data-dismiss="modal" aria-hidden="true" class="btn"> Fechar Janela</a>
              <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Pesquisar</button>
              </form>
            </div>
          </div>
        </div>
      </div>


      <!-- final modal pesquisa -->


<!-- FINAL RELATÓRIO VENDAS DETALHADA -->






<!-- ENTRADA CONTAS RECEBER -->


<!-- modal pesquisa vendas detalhada -->

      <!-- Start Calendar modal -->
      <div id="modal_contas_receber_forma" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bar-chart-o"></i> 
              Vendas Agrupado por Formas de Recebimentos
              </h4>
            </div>
            <div class="modal-body">
              <!--<div id="testmodal"> -->
              
                 <form class="form-horizontal" method="post" id="forgot_form" target="_blank" action="<?php echo base_url(); ?>relatorio_financeiro/contas_receber_agrupado/">

               <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Vencimento De:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_de" value="<?php echo set_value('data_de')?>"/>
                    </div>
                  </div>

                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Vencimento Até:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_ate" value="<?php echo set_value('data_ate')?>"/>
                    </div>
                  </div>

                    
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                    <select class="form-control" name="status" id="status">
                    <option value="">Todos...</option>   
                        <option value="<?= ABERTO; ?>" <?= set_select('status',ABERTO); ?>>PENDENTE</option>
                        <!--<option value="<?= APROVADO; ?>" <?= set_select('status',APROVADO); ?>>AUTORIZADO</option>-->
                        <option value="<?= PAGO; ?>" <?= set_select('status',PAGO); ?>>RECEBIDO</option>
                       <!-- <option value="<?= CANCELADO; ?>" <?= set_select('status',CANCELADO); ?>>CANCELADO-->
                    </select>

                    </div>
                  </div>

                  
           
                  
               
                 
        <!--</div> TESTE MODAL-->

            </div>
            <div class="modal-footer">
             <a href="#" data-dismiss="modal" aria-hidden="true" class="btn"> Fechar Janela</a>
              <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Pesquisar</button>
              </form>
            </div>
          </div>
        </div>
      </div>


      <!-- final modal pesquisa -->


<!-- FINAL RELATÓRIO ORÇAMENTOS -->




<!-- ENTRADA CONTAS RECEBER -->


<!-- modal pesquisa vendas detalhada -->

      <!-- Start Calendar modal -->
      <div id="modal_contas_receber" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bar-chart-o"></i> Relatório Contas Receber</h4>
            </div>
            <div class="modal-body">
              <!--<div id="testmodal"> -->
              
                 <form class="form-horizontal" method="post" id="forgot_form" target="_blank" action="<?php echo base_url(); ?>relatorio_financeiro/contas_receber/">

               <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Vencimento De:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_de" value="<?php echo set_value('data_de')?>"/>
                    </div>
                  </div>

                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Vencimento Até:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_ate" value="<?php echo set_value('data_ate')?>"/>
                    </div>
                  </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Cliente:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                  <select class="form-control" name="id_cliente" id="id_cliente">
                        <option value="">Todos...</option>
                        <option value="<?php echo PAD_CAD_CLIENTE; ?>">AVULSO</option>
                        <?php foreach ($listCliente as $objCliente): ?>
                        <option value="<?php echo $objCliente->getId_cliente(); ?>">
                        <?php echo $objCliente->getNome_fantasia(); ?>
                        </option>
                        <?php endforeach; ?>
                      </select>
                       </div>
                  </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Venda Nº</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" name="codigo" value="<?php echo set_value('codigo')?>"/>
                    </div>
                  </div>


                    

                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Forma de Recebimento</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                    <select class="form-control" name="id_forma" id="id_forma">
                        <option value="">Todos...</option>
                         <?php foreach ($listFormaRec as $objForma):   ?>
                           
                        <option value="<?php echo $objForma->getId_forma(); ?>" <?php echo set_select('id_forma',$objForma->getId_forma()); ?>>
                           <?php echo $objForma->getForma(); ?>
                        </option>
                         <?php endforeach; ?>
                    </select>

                    </div>
                  </div>

                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                    <select class="form-control" name="status" id="status">
                    <option value="">Selecione...</option>   
                        <option value="<?= ABERTO; ?>" <?= set_select('status',ABERTO); ?>>PENDENTE</option>
                        <!--<option value="<?= APROVADO; ?>" <?= set_select('status',APROVADO); ?>>AUTORIZADO</option>-->
                        <option value="<?= PAGO; ?>" <?= set_select('status',PAGO); ?>>RECEBIDO</option>
                       <option value="<?= CANCELADO; ?>" <?= set_select('status',CANCELADO); ?>>CANCELADO</option>
                    </select>

                    </div>
                  </div>

                  
           
                  
               
                 
        <!--</div> TESTE MODAL-->

            </div>
            <div class="modal-footer">
             <a href="#" data-dismiss="modal" aria-hidden="true" class="btn"> Fechar Janela</a>
              <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Pesquisar</button>
              </form>
            </div>
          </div>
        </div>
      </div>


      <!-- final modal pesquisa -->


<!-- FINAL RELATÓRIO ORÇAMENTOS -->




<!-- ENTRADA CONTAS PAGAR -->


<!-- modal pesquisa vendas detalhada -->

      <!-- Start Calendar modal -->
      <div id="modal_contas_pagar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bar-chart-o"></i> Relatório Contas a Pagar</h4>
            </div>
            <div class="modal-body">
              <div id="testmodal">
              
                 <form class="form-horizontal" method="post" id="forgot_form" target="_blank" action="<?php echo base_url(); ?>relatorio_financeiro/contas_pagar/">

               

                <div class="form-group">
            
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Natureza</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
               <select class="form-control" name="id_plano" id="id_plano">
               <option value="">Todos...</option>

              <?php foreach ($listPlanosCat as $objCategoria): ?>
                <option disabled value="" class="fundoCategoria"><?= $objCategoria->getNome(); ?></option>

                <?php 
                           $planosBusiness = $this->Factory->createBusiness("fin_plano_contas");
                           $listPlanos = $planosBusiness->listar_por_categoria($objCategoria->getId_plano_categoria());
                          foreach ($listPlanos as $objPlano):
                              
                             echo "<option value=".$objPlano->getId_plano().">&nbsp;&nbsp;=>".$objPlano->getClassificacao()." ".$objPlano->getNome()."</option>";
                         
                          endforeach;


                
                endforeach;?>
                </select>
            </div>
            </div>


               <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Histórico</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" name="descricao" value="<?php echo set_value('descricao')?>"/>
                    </div>
                </div>

                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Vencimento De:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_de" value="<?php echo set_value('data_de')?>"/>
                    </div>
                  </div>

                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Vencimento Até:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_ate" value="<?php echo set_value('data_ate')?>"/>
                    </div>
                  </div>

                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Fornecedor:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                    <select class="form-control" name="id_fornecedor" id="id_fornecedor">
                        <option value="">Todos...</option>
                         <?php foreach ($listFornecedor as $objFornecedor):   ?>
                           
                        <option value="<?php echo $objFornecedor->getId_fornecedor(); ?>" <?php echo set_select('id_fornecedor',$objFornecedor->getId_fornecedor()); ?>>
                           <?php echo $objFornecedor->getNome_fantasia(); ?>
                        </option>
                         <?php endforeach; ?>
                    </select>

                    </div>
                  </div>

                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Banco</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                   <select class="form-control" name="id_conta_banco" id="id_conta_banco">
                         <option value="">Todos</option>
                         <?php foreach ($listContaBanco as $objContaBanco): ?>
                        <option value="<?php echo $objContaBanco->getId_conta_banco(); ?>" <?php echo set_select('id_conta_banco',$objContaBanco->getId_conta_banco()); ?>>
                           <?php echo " Banco: ".$objContaBanco->getBanco()." Conta: ".$objContaBanco->getConta(); ?>
                        </option>
                         <?php endforeach; ?>

                       
                        </select>

                    </div>
                  </div>

                     <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Centro de Custo</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                    <select class="form-control" name="id_custo" id="id_custo">
                    <option value="">Todos...</option>
                         <?php foreach ($listCusto as $objCusto): ?>
                        <option value="<?php echo $objCusto->getId_custo(); ?>" <?php echo set_select('id_custo',$objCusto->getId_custo()); ?>>
                           <?php echo $objCusto->getCusto(); ?>
                        </option>
                         <?php endforeach; ?>
                    </select>

                    </div>
                  </div>

                     <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                    <select class="form-control" name="status" id="status">
                    <option value="">Todos...</option>   
                        <option value="<?= ABERTO; ?>" <?= set_select('status',ABERTO); ?>>ABERTO</option>
                        <!--<option value="<?= APROVADO; ?>" <?= set_select('status',APROVADO); ?>>AUTORIZADO</option>-->
                        <option value="<?= PAGO; ?>" <?= set_select('status',PAGO); ?>>PAGO</option>
                       <!-- <option value="<?= CANCELADO; ?>" <?= set_select('status',CANCELADO); ?>>CANCELADO-->
                    </select>

                    </div>
                  </div>

                  
               
                 
                                   

             </div>

            </div>
            <div class="modal-footer">
             <a href="#" data-dismiss="modal" aria-hidden="true" class="btn"> Fechar Janela</a>
              <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Pesquisar</button>
              </form>
            </div>
          </div>
        </div>
      </div>


      <!-- final modal pesquisa -->


<!-- FINAL RELATÓRIO ORÇAMENTOS -->









<!-- ENTRADA PRODUTOS -->


<!-- modal pesquisa vendas detalhada -->

      <!-- Start Calendar modal -->
      <div id="modal_produtos" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bar-chart-o"></i> Relatório de Produtos</h4>
            </div>
            <div class="modal-body">
              <div id="testmodal">
              
                 <form class="form-horizontal" method="post" id="forgot_form" target="_blank" action="<?php echo base_url(); ?>relatorio_estoque/produtos/">

                 <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Descrição</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" name="descricao" value="<?php echo set_value('descricao')?>"/>
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Código</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" name="codigo" value="<?php echo set_value('codigo')?>"/>
                    </div>
                  </div>

                 <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Categoria</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                    <select class="form-control" name="id_categoria" id="id_categoria">
                       <option value="">Selecione...</option>
                        <?php foreach ($listCategoria as $objCategoria): ?>
                        <option value="<?php echo $objCategoria->getId_categoria(); ?>" <?php echo set_select('id_categoria',$objCategoria->getId_categoria()); ?>>
                           <?php echo $objCategoria->getCategoria(); ?>
                        </option>
                         <?php endforeach; ?>
                    </select>

                    </div>
                  </div>

                     <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Fornecedor</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                    <select class="form-control" name="id_fornecedor" id="id_fornecedor">
                    <option value="">Selecione...</option>
                         <?php foreach ($listFornecedor as $objFornecedor): ?>
                        <option value="<?php echo $objFornecedor->getId_fornecedor(); ?>" <?php echo set_select('id_fornecedor',$objFornecedor->getId_fornecedor()); ?>>
                           <?php echo $objFornecedor->getNome_fantasia(); ?>
                        </option>
                         <?php endforeach; ?>
                    </select>

                    </div>
                  </div>

                                  

                  
               
                 
                                   

             </div>

            </div>
            <div class="modal-footer">
             <a href="#" data-dismiss="modal" aria-hidden="true" class="btn"> Fechar Janela</a>
              <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Pesquisar</button>
              </form>
            </div>
          </div>
        </div>
      </div>


      <!-- final modal pesquisa -->


<!-- FINAL RELATÓRIO PRODUTOS -->




<!-- ENTRADA PRODUTOS -->


<!-- modal pesquisa vendas detalhada -->

      <!-- Start Calendar modal -->
      <div id="modal_servico" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bar-chart-o"></i> Relatório de Serviços</h4>
            </div>
            <div class="modal-body">
              <div id="testmodal">
              
               <form class="form-horizontal" method="post" id="forgot_form" target="_blank" action="<?php echo base_url(); ?>relatorio_estoque/servicos/">

               <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Descrição</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" name="descricao" value="<?php echo set_value('descricao')?>"/>
                    </div>
                  </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Código</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" name="codigo" value="<?php echo set_value('codigo')?>"/>
                    </div>
                  </div>

                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Categoria</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                    <select class="form-control" name="id_categoria" id="id_categoria">
                       <option value="">Selecione...</option>
                        <?php foreach ($listCategoria as $objCategoria): ?>
                        <option value="<?php echo $objCategoria->getId_categoria(); ?>" <?php echo set_select('id_categoria',$objCategoria->getId_categoria()); ?>>
                           <?php echo $objCategoria->getCategoria(); ?>
                        </option>
                         <?php endforeach; ?>
                    </select>

                    </div>
              </div>

                  
               
                 
                                   

             </div>

            </div>
            <div class="modal-footer">
             <a href="#" data-dismiss="modal" aria-hidden="true" class="btn"> Fechar Janela</a>
              <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Pesquisar</button>
              </form>
            </div>
          </div>
        </div>
      </div>


      <!-- final modal pesquisa -->


<!-- FINAL RELATÓRIO PRODUTOS -->













<!-- ENTRADA ORÇAMENTOS RESUMIDA -->


<!-- modal pesquisa vendas detalhada -->

      <!-- Start Calendar modal -->
      <div id="modal_orcamentos_detalhada" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bar-chart-o"></i> Relatório de Orçamentos</h4>
            </div>
            <div class="modal-body">
              <div id="testmodal">
              
                 <form class="form-horizontal" method="post" id="forgot_form" target="_blank" action="<?php echo base_url(); ?>relatorio_pedido/orcamentos_detalhado/">
                  
               
                 
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Código Orçamento:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" name="codigo_orcamento" value="<?php echo set_value('codigo_orcamento')?>"/>
                    </div>
                  </div>

                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">De:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_de" value="<?php echo set_value('de')?>"/>
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Até:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_ate" value="<?php echo set_value('ate')?>"/>
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Usuário</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <select class="form-control" name="id_usuario" id="id_usuario">
                        <option value="">Todos...</option>
                        <?php foreach ($listUser as $objUser):  ?>
                        <option value="<?php echo $objUser->getId_usuario(); ?>">
                        <?php echo $objUser->getLogin(); ?>
                        </option>
                        <?php endforeach; ?>
                      </select>

                    </div>
                  </div>

                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Cliente</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <select class="form-control" name="id_cliente" id="id_cliente">
                        <option value="">Todos...</option>
                        <option value="<?php echo PAD_CAD_CLIENTE; ?>">AVULSO</option>
                        <?php foreach ($listCliente as $objCliente): ?>
                        <option value="<?php echo $objCliente->getId_cliente(); ?>">
                        <?php echo $objCliente->getNome_fantasia(); ?>
                        </option>
                        <?php endforeach; ?>
                      </select>

                    </div>
                  </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <select class="form-control" name="status" id="status">
                           <option value="">Todos...</option>
                       
                        <?php foreach ($listStatus as $objStatus): ?>
                        <option value="<?php echo $objStatus->getId_status(); ?>">
                        <?php echo $objStatus->getStatus(); ?>
                        </option>
                        <?php endforeach; ?>
                      </select>
                      </select>

                    </div>
                  </div>

            </div>

            </div>
            <div class="modal-footer">
             <a href="#" data-dismiss="modal" aria-hidden="true" class="btn"> Fechar Janela</a>
              <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Pesquisar</button>
              </form>
            </div>
          </div>
        </div>
      </div>


      <!-- final modal pesquisa -->


<!-- FINAL RELATÓRIO ORÇAMENTOS -->






<!-- ENTRADA VENDAS RESUMIDA -->


<!-- modal pesquisa vendas detalhada -->

      <!-- Start Calendar modal -->
      <div id="modal_vendas_detalhada" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bar-chart-o"></i> Relatório de Vendas Detalhada</h4>
            </div>
            <div class="modal-body">
              <div id="testmodal">
              
                 <form class="form-horizontal" method="post" id="forgot_form" target="_blank" action="<?php echo base_url(); ?>relatorio_pedido/pedidos_detalhado/">
                  
               
                 
                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">De:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_de" value="<?php echo set_value('de')?>"/>
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Até:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_ate" value="<?php echo set_value('ate')?>"/>
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Usuário</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <select class="form-control" name="id_usuario" id="id_usuario">
                        <option value="">Todos...</option>
                        <?php foreach ($listUser as $objUser):  ?>
                        <option value="<?php echo $objUser->getId_usuario(); ?>">
                        <?php echo $objUser->getLogin(); ?>
                        </option>
                        <?php endforeach; ?>
                      </select>

                    </div>
                  </div>

                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Cliente</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <select class="form-control" name="id_cliente" id="id_cliente">
                        <option value="">Todos...</option>
                        <option value="<?php echo PAD_CAD_CLIENTE; ?>">AVULSO</option>
                        <?php foreach ($listCliente as $objCliente): ?>
                        <option value="<?php echo $objCliente->getId_cliente(); ?>">
                        <?php echo $objCliente->getNome_fantasia(); ?>
                        </option>
                        <?php endforeach; ?>
                      </select>

                    </div>
                  </div>

                     <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                   <select class="form-control" name="status" id="status">
                        <option value="">Todos...</option>
                       
                        <?php foreach ($listStatus as $objStatus): ?>
                        <option value="<?php echo $objStatus->getId_status(); ?>">
                        <?php echo $objStatus->getStatus(); ?>
                        </option>
                        <?php endforeach; ?>
                      </select>

                    </div>
                  </div>








                  
       
              </div>

            </div>
            <div class="modal-footer">
             <a href="#" data-dismiss="modal" aria-hidden="true" class="btn"> Fechar Janela</a>
              <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Pesquisar</button>
              </form>
            </div>
          </div>
        </div>
      </div>


      <!-- final modal pesquisa -->


<!-- FINAL RELATÓRIO VENDAS DETALHADA -->


<!-- modal pesquisa locação detalhada -->

      <!-- Start Calendar modal -->
      <div id="modal_locacao_detalhada" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bar-chart-o"></i> Relatório de Locação</h4>
            </div>
            <div class="modal-body">
              <div id="testmodal">
              
                 <form class="form-horizontal" method="post" id="forgot_form" target="_blank" action="<?php echo base_url(); ?>relatorio_locacao/pedidos_detalhado/">
                  
               
                 
                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">De:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_de" value="<?php echo set_value('de')?>"/>
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Até:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_ate" value="<?php echo set_value('ate')?>"/>
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Usuário</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <select class="form-control" name="id_usuario" id="id_usuario">
                        <option value="">Todos...</option>
                        <?php foreach ($listUser as $objUser):  ?>
                        <option value="<?php echo $objUser->getId_usuario(); ?>">
                        <?php echo $objUser->getLogin(); ?>
                        </option>
                        <?php endforeach; ?>
                      </select>

                    </div>
                  </div>

                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Cliente</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <select class="form-control" name="id_cliente" id="id_cliente">
                        <option value="">Todos...</option>
                        <option value="<?php echo PAD_CAD_CLIENTE; ?>">AVULSO</option>
                        <?php foreach ($listCliente as $objCliente): ?>
                        <option value="<?php echo $objCliente->getId_cliente(); ?>">
                        <?php echo $objCliente->getNome_fantasia(); ?>
                        </option>
                        <?php endforeach; ?>
                      </select>

                    </div>
                  </div>

                     <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                   <select class="form-control" name="status" id="status">
                        <option value="">Todos...</option>
                       
                        <?php foreach ($listStatus as $objStatus): ?>
                        <option value="<?php echo $objStatus->getId_status(); ?>">
                        <?php echo $objStatus->getStatus(); ?>
                        </option>
                        <?php endforeach; ?>
                      </select>

                    </div>
                  </div>








                  
       
              </div>

            </div>
            <div class="modal-footer">
             <a href="#" data-dismiss="modal" aria-hidden="true" class="btn"> Fechar Janela</a>
              <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Pesquisar</button>
              </form>
            </div>
          </div>
        </div>
      </div>


      <!-- final modal pesquisa -->


<!-- FINAL RELATÓRIO LOCAÇÃO DETALHADA -->


<!-- modal pesquisa entregas -->

      <!-- Start Calendar modal -->
      <div id="modal_entrega" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bar-chart-o"></i> Relatório de Entregas</h4>
            </div>
            <div class="modal-body">
              <div id="testmodal">
              
                 <form class="form-horizontal" method="post" id="forgot_form" target="_blank" action="<?php echo base_url(); ?>relatorio_locacao/entrega/">
                  
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Código Locação:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" name="codigo" value="<?php echo set_value('codigo')?>"/>
                    </div>
                  </div>

                 
                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Previsão De:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_de" value="<?php echo set_value('de')?>"/>
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Previsão Até:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_ate" value="<?php echo set_value('ate')?>"/>
                    </div>
                  </div>

               
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Cliente</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <select class="form-control" name="id_cliente" id="id_cliente">
                        <option value="">Todos...</option>
                        <option value="<?php echo PAD_CAD_CLIENTE; ?>">AVULSO</option>
                        <?php foreach ($listCliente as $objCliente): ?>
                        <option value="<?php echo $objCliente->getId_cliente(); ?>">
                        <?php echo $objCliente->getNome_fantasia(); ?>
                        </option>
                        <?php endforeach; ?>
                      </select>

                    </div>
                  </div>

                     <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                   <select class="form-control" name="id_status" id="id_status">
                        <option value="">Todos...</option>
                       
                        <?php foreach ($listStatusEntrega as $objStatus): ?>
                        <option value="<?php echo $objStatus->getId_status(); ?>">
                        <?php echo $objStatus->getStatus(); ?>
                        </option>
                        <?php endforeach; ?>
                      </select>

                    </div>
                  </div>








                  
       
              </div>

            </div>
            <div class="modal-footer">
             <a href="#" data-dismiss="modal" aria-hidden="true" class="btn"> Fechar Janela</a>
              <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Pesquisar</button>
              </form>
            </div>
          </div>
        </div>
      </div>


      <!-- final modal pesquisa -->


<!-- FINAL RELATÓRIO LOCAÇÃO DETALHADA -->








<!-- modal pesquisa vendas detalhada -->

      <!-- Start Calendar modal -->
      <div id="modal_caixa" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bar-chart-o"></i> Relatório Análise de Caixa</h4>
            </div>
            <div class="modal-body">
              <div id="testmodal">
              
                 <form class="form-horizontal" method="post" id="forgot_form" target="_blank" action="<?php echo base_url(); ?>relatorio_financeiro/caixa/">
                  
               
                 
                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">De:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_de" value="<?php echo set_value('de',date('d/m/Y'))?>"/>
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Até:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_ate" value="<?php echo set_value('ate',date('d/m/Y'))?>"/>
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Usuário</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <select class="form-control" name="usuario" id="usuario">
                        <option value="">Todos...</option>
                        <?php foreach ($listUser as $objUser):  ?>
                        <option value="<?php echo $objUser->getLogin(); ?>">
                        <?php echo $objUser->getLogin(); ?>
                        </option>
                        <?php endforeach; ?>
                      </select>

                    </div>
                  </div>

               

                    







                  
       
              </div>

            </div>
            <div class="modal-footer">
             <a href="#" data-dismiss="modal" aria-hidden="true" class="btn"> Fechar Janela</a>
              <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Pesquisar</button>
              </form>
            </div>
          </div>
        </div>
      </div>


      <!-- final modal pesquisa -->





<!-- ENTRADA VENDAS RESUMIDA -->


<!-- modal pesquisa vendas resumida -->

      <!-- Start Calendar modal -->
      <div id="modal_vendas_resumida" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bar-chart-o"></i> Relatório de Vendas Resumida</h4>
            </div>
            <div class="modal-body">
              <div id="testmodal">
              
                 <form class="form-horizontal" method="post" id="forgot_form" target="_blank" action="<?php echo base_url(); ?>relatorio_pedido/pedidos_resumo/">
                  
               
                 
                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">De:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="de" value="<?php echo set_value('de')?>"/>
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Até:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="ate" value="<?php echo set_value('ate')?>"/>
                    </div>
                  </div>
                  
       
              </div>

            </div>
            <div class="modal-footer">
             <a href="#" data-dismiss="modal" aria-hidden="true" class="btn"> Fechar Janela</a>
              <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Pesquisar</button>
              </form>
            </div>
          </div>
        </div>
      </div>


      <!-- final modal pesquisa -->


<!-- FINAL RELATÓRIO CLIENTES -->










<!-- ENTRADA CLIENTES -->


<!-- modal pesquisa clientes -->

      <!-- Start Calendar modal -->
      <div id="modal_cliente" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bar-chart-o"></i> Relatório de Clientes</h4>
            </div>
            <div class="modal-body">
              <div id="testmodal">
              
                 <form class="form-horizontal" method="post" id="forgot_form" target="_blank" action="<?php echo base_url(); ?>relatorio_comercial/clientes/">
                  
               
                 
                
                  
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12"> Nome:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" name="nome_fantasia" value="<?php echo set_value('nome_fantasia')?>"/>
                    </div>
                  </div>

                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">CPF/CNPJ:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control cpfcnpj"  name="cnpj_cpf" value="<?php echo set_value('cnpj_cpf')?>"/>
                    </div>
                  </div>
                   

                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Data de Cadastro:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_cadastro" value="<?php echo set_value('data_cadastro')?>"/>
                    </div>
                  </div>

                    
                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                    <select class="form-control" name="tipo" id="tipo">
                       <option value="">Todos</option>
                       <option value="<?= PESSOA_JURIDICA; ?>" <?= set_select('tipo',PESSOA_JURIDICA); ?>>Pessoa Juridica</option>
                      <option value="<?= PESSOA_FISICA; ?>" <?= set_select('tipo',PESSOA_FISICA); ?>>Pessoa Física</option>
                    </select>

                    </div>
                  </div>

                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Status:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                    <select class="form-control" name="status" id="status">
                      <option value="">Todos</option>
                      <option value="<?= ATIVO; ?>" <?= set_select('status',ATIVO); ?>>ATIVO</option>
                      <option value="<?= BLOQUEADO; ?>" <?= set_select('status',BLOQUEADO); ?>>BLOQUEADO</option>

                    </select>

                    </div>
                  </div>

                     <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Formato</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                   <select class="form-control" name="formato" id="formato">
                  
                        <option value="WEB">WEB</option>
                       
                        <option value="EXCEL">EXCEL</option>
                          <option value="PDF">PDF</option>
                        
                        
                </select>

                    </div>
                  </div>

                  



                
              </div>
            </div>
            <div class="modal-footer">
             <a href="#" data-dismiss="modal" aria-hidden="true" class="btn"> Fechar Janela</a>
              <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Pesquisar</button>
              </form>
            </div>
          </div>
        </div>
      </div>


      <!-- final modal pesquisa -->


<!-- FINAL RELATÓRIO CLIENTES -->






<!-- ENTRADA FORNECEDORES -->


<!-- modal pesquisa fornecedores -->
 
      <!-- Start Calendar modal -->
      <div id="modal_fornecedor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bar-chart-o"></i> Relatório de Fornecedores</h4>
            </div>
            <div class="modal-body">
              <div id="testmodal">
              
                 <form class="form-horizontal" method="post" id="forgot_form" target="_blank" action="<?php echo base_url(); ?>relatorio_comercial/fornecedores/">
                  
               
                 
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12"> Nome:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" name="nome_fantasia" value="<?php echo set_value('nome_fantasia')?>"/>
                    </div>
                  </div>

                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">CPF/CNPJ:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control cpfcnpj"  name="cnpj_cpf" value="<?php echo set_value('cnpj_cpf')?>"/>
                    </div>
                  </div>


                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Data de Cadastro:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                      <input type="text" class="form-control calendario" name="data_cadastro" value="<?php echo set_value('data_cadastro')?>"/>
                    </div>
                  </div>

                    
                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                    <select class="form-control" name="tipo" id="tipo">
                       <option value="">Todos</option>
                       <option value="<?= PESSOA_JURIDICA; ?>" <?= set_select('tipo',PESSOA_JURIDICA); ?>>Pessoa Juridica</option>
                      <option value="<?= PESSOA_FISICA; ?>" <?= set_select('tipo',PESSOA_FISICA); ?>>Pessoa Física</option>
                    </select>

                    </div>
                  </div>

                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Status:</label>
                      <div class="col-md-6 col-sm-9 col-xs-12">
                    <select class="form-control" name="status" id="status">
                      <option value="">Todos</option>
                      <option value="<?= ATIVO; ?>" <?= set_select('status',ATIVO); ?>>ATIVO</option>
                      <option value="<?= BLOQUEADO; ?>" <?= set_select('status',BLOQUEADO); ?>>BLOQUEADO</option>

                    </select>

                    </div>
                  </div>

                  



                
              </div>
            </div>
            <div class="modal-footer">
             <a href="#" data-dismiss="modal" aria-hidden="true" class="btn"> Fechar Janela</a>
              <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Pesquisar</button>
              </form>
            </div>
          </div>
        </div>
      </div>


      <!-- final modal pesquisa -->


<!-- FINAL RELATÓRIO FORNECEDORES -->







<script type="text/javascript">



<?php if($msg==true){ ?>
//função para ocultar mensagem de cadastro: arquivo: js/base.js
hideMessage();

<?php } ?>


 //$(function(){
  //alert('agaaga');
/*$("#cpfcnpj").keydown(function(){

    try {
      $("#cpfcnpj").unmask();
    } catch (e) {}
    
    var tamanho = $("#cpfcnpj").val().length;
  
    if(tamanho < 11){
        $("#cpfcnpj").mask("999.999.999-99");
    } else if(tamanho >= 11){
        $("#cpfcnpj").mask("99.999.999/9999-99");
    }                   
});*/

//});



</script>


