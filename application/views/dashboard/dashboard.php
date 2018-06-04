
<?php
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$mes_atual = strftime('%B / %Y', strtotime('today'));
$objDateFormat = $this->DateFormat;
?>



        <div class="row tile_count">
          
          <div class="animated flipInY col-md-4 col-sm-4 col-xs-4 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-money"></i> Recebimentos - <?php echo ucfirst(utf8_encode($mes_atual)); ?></span>
              <div class="count" style="font-size: 20px;">R$: <?php echo number_format($total_recebimento, 2, ',', '.'); ?></div>
              <span class="count_bottom"><i class="green"><a href="<?php echo site_url('contas_receber/filtro'); ?>" class="green">Exibir Detalhes</a></i></span>
            </div>
          </div>

        
            <div class="animated flipInY col-md-4 col-sm-4 col-xs-4 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-money"></i> Pagamentos - <?php echo ucfirst(utf8_encode($mes_atual)); ?></span>
              <div class="count" style="font-size: 20px;">R$: <?php echo number_format($total_pagamento, 2, ',', '.'); ?></div>
              <span class="count_bottom"><i class="green"><a href="<?php echo site_url('contas_pagar/filtro'); ?>" class="green">Exibir Detalhes</a></i></span>
            </div>
          </div>


          <div class="animated flipInY col-md-4 col-sm-4 col-xs-4 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-money"></i> Saldo</span>
              <div class="count" style="font-size: 20px;">R$: <?php echo number_format($saldo, 2, ',', '.'); ?></div>
              <span class="count_bottom"><i class="green"></i></span>
            </div>
          </div>





       
        </div>
        <!-- /top tiles -->
 


          <div class="row">
            <div class="col-md-4">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Produtos + Vendidos <small></small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                   
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content" style="height:300px;">
                <?php
                $qtd_estoque = "";
                  $qtd_itens = 0;
                  $sub_total = 0;
                  $total_geral = 0;
                 
                  if(sizeof($listProdutos)>0){
                  foreach ($listProdutos as $objProduto): 
                    if($objProduto['qtd'] > 0 ){
                  
                    $qtd_itens++;
                    //$sub_total = $objProduto['valor_unitario'] * $objProduto['Saida'];
                    $total_geral = $total_geral + $sub_total;

                   ?>
                  <article class="media event">
                    
                    <div class="media-body">
                      <span class="title"><strong><?php echo $objProduto['descricao']; ?> (<?php echo $objProduto['qtd']; ?>)</strong><span>

                      
                    </div>
                 
                  </article>

                  <?php 
                   }
                  endforeach;

                  }else{

                    echo " <span class='count_bottom'><i class='green'>Nenhum produto encontrado!</i></span>";
                  }



                  ?> 
                  
              </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Contas Pagar <small style="color:red;">Vencidas</small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                   
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content" style="height:300px;">
                  
                   <?php

                 if(sizeof($listCpVencido)>0){
                  foreach ($listCpVencido as $objLanc): 

                   ?>
                  <article class="media event">
                    
                    <div class="media-body">
                      <a href="<?php echo site_url('contas_pagar/editar/'.$objLanc->getId_lancamento()); ?>" class="title"><strong><?php echo $objDateFormat->date_format($objLanc->getData_vencimento())." R$: ".number_format($objLanc->getValor_titulo(), 2, ',', '.'); ?></strong></a>

                      <p><?php echo $objLanc->getConta()->getDescricao(); ?></p>
                      
                    </div>
                  </article>

                  <?php endforeach;

                  }else{

                    echo " <span class='count_bottom'><i class='green'>Não possui contas vencidas!</i></span>";
                  }
                

                  ?>


                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Útimas Vendas <small>Realizadas</small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                   
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content" style="height:300px;">
                  
                    <?php
                 
                 if(sizeof($listPedidos)){
                 foreach ($listPedidos as $objPedido): 
                   ;

                   ?>
                  <article class="media event">
                    
                    <div class="media-body">
                     

                      <span class="title"><strong><?php echo "Cod:.".$objPedido->getCodigo()." - ".$objDateFormat->date_format($objPedido->getData_inicio())." - R$: ".number_format(round($objPedido->getTotal_venda(),1), 2, ',', '.'); ?></strong></span>

                      <p><?php echo $objPedido->getCliente()->getNome_fantasia(); ?></p>
                      
                    </div>
                  </article>

                  <?php endforeach;

                  }else{

                    echo " <span class='count_bottom'><i class='green'>Nenhuma venda realizada!</i></span>";
                  }


                  ?>


                </div>
              </div>
            </div>
          </div>


                  






          <!--<div class="row">
            <div class="col-md-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Gráfico de Vendas - 2017</h2>
                  <div class="filter">
                    <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                      <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                      <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                </div>
                

                <div class="x_content">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="demo-container" style="height:280px">
                      <div id="placeholder33x" class="demo-placeholder"></div>
                    </div>
                    
                  </div>

                  

                </div>



              </div>
            </div>
          </div>

          -->



  
  