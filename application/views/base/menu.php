<?php 

 $perfil_acesso = $this->session->userdata('id_perfil');
 $mod_locacao = $this->session->userdata('mod_locacao');
 $mod_caixa = $this->session->userdata('mod_caixa');
 $mod_vendas = $this->session->userdata('mod_vendas');
 $mod_compras = $this->session->userdata('mod_compras');
 $mod_bar = $this->session->userdata('mod_bar');

?>


 <?php $perfil = $this->session->userdata('id_perfil'); ?>  
   <script type="text/javascript">

   //Categoria   
   
   var url = '<?= site_url("/contas_pagar/ajax_lancamentos_vencidos/"); ?>/';
    
   $.getJSON(url, function(j){
                             
      var options = '';
       var total_msg = 0;
       var titulo = "R$: ";
       var valor_titulo = 0;
       var fornecedor = "";
       var data_vencimento = "";
       var natureza = "";
       var descricao = "";
       for (var i = 0; i < j.length; i++) {
            
            total_msg++;
            
            options +='<li><a href="<?= site_url("/contas_pagar/baixa/"); ?>/'+j[i].id_lancamento+'"><span><span><strong>'+titulo+j[i].valor_titulo+'</strong></span><span class="time" style="color:red;">Data Vencimento: '+j[i].data_vencimento+'</span></span><strong><span class="message">Natureza: '+j[i].natureza+'</span><span class="message">Fornecedor: '+j[i].fornecedor+'</span></strong></a></li>';
} 
       $('#listaMsgPendente').html(options).show();
      
        if(total_msg>0){
         $('#total_msg').html(total_msg+" Pagamento(s)").show();
        }

});

</script>

 
 <!-- MENU LATERAL -->
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">

          <div class="navbar nav_title" style="margin-top:10px; ">
            <a href="<?php echo site_url('dashboard/entrada');?>"><img src="<?= base_url(); ?>/img/logo.png" width="100px;" border="0" /></a>
          </div>
          <div class="clearfix"></div>

          <!-- menu prile quick info -->
          
          <!-- /menu prile quick info -->

          <br />

        

            <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
              <h3>Módulos Sistema</h3>
              <ul class="nav side-menu">
                
              
                <?php if($perfil_acesso==PERFIL_MASTER || $perfil_acesso==PERFIL_COORDENADOR || $perfil_acesso==PERFIL_FINANCEIRO || $perfil_acesso==PERFIL_AUXILIAR || $perfil_acesso==PERFIL_VENDAS){ ?>
                <li><a><i class="fa fa-briefcase"></i> Comercial <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="<?php echo site_url('clientes/filtro');?>">Clientes</a></li>
                    
                    <li><a href="<?php echo site_url('fornecedores/filtro');?>">Fornecedores</a>
                    </li>
                    <li><a href="<?php echo site_url('transportadoras/filtro');?>">Transportadoras</a>
                    </li>
                  
                  </ul>
                </li>
                <?php } ?>

                <?php 

              if($mod_vendas==SIM){
                if($perfil_acesso==PERFIL_MASTER || $perfil_acesso==PERFIL_COORDENADOR || $perfil_acesso==PERFIL_FINANCEIRO || $perfil_acesso==PERFIL_VENDAS || $perfil_acesso==PERFIL_AUXILIAR){ ?>

                <li><a><i class="fa fa-tags"></i> Vendas <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                <li><a href="<?php echo site_url('pedidos/filtro/'.ORCAMENTO);?>">Pesquisar Cotação</a></li>
                     
                <li><a href="<?php echo site_url('pedidos/filtro/'.PEDIDO);?>">Pesquisar Venda</a></li>
                     
                   
                  </ul>
                </li>
                <?php } } ?>

                    <?php 

              if($mod_bar==SIM){
                if($perfil_acesso==PERFIL_MASTER || $perfil_acesso==PERFIL_COORDENADOR || $perfil_acesso==PERFIL_FINANCEIRO || $perfil_acesso==PERFIL_VENDAS || $perfil_acesso==PERFIL_AUXILIAR){ ?>

                <li><a><i class="fa fa-tags"></i> Controle de Mesas <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                
              <li><a href="<?php echo site_url('pedidos_mesa/controle/');?>">Mesas</a></li>
               <li><a href="<?php echo site_url('pedidos_mesa/filtro/'.PEDIDO);?>">Vendas</a></li>
                     
              
                     
                   
                  </ul>
                </li>
                <?php } } ?>

                  

                  <?php 

                if($mod_locacao==SIM){
                  if($perfil_acesso==PERFIL_MASTER || $perfil_acesso==PERFIL_COORDENADOR || $perfil_acesso==PERFIL_FINANCEIRO || $perfil_acesso==PERFIL_VENDAS || $perfil_acesso==PERFIL_AUXILIAR){ ?>
                

                <li><a><i class="fa fa-tags"></i> Locação <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                <li><a href="<?php echo site_url('locacao/filtro/'.ORCAMENTO);?>">Pesquisar Cotação</a></li>
                     
                <li><a href="<?php echo site_url('locacao/filtro/'.PEDIDO);?>">Pesquisar Locações</a></li>

                 <li><a href="<?php echo site_url('entrega/filtro/');?>">Entregas</a></li>
                     
                   
                  </ul>
                </li>
                <?php } } ?>





                
                 <?php if($perfil_acesso==PERFIL_MASTER || $perfil_acesso==PERFIL_COORDENADOR || $perfil_acesso==PERFIL_FINANCEIRO || $perfil_acesso==PERFIL_CONTADOR ){ ?>
                <li><a><i class="fa fa-calculator"></i> Financeiro <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                      <li><a href="<?php echo site_url('contas_pagar/filtro');?>">Contas a Pagar</a></li>
                        <li><a href="<?php echo site_url('contas_receber/filtro');?>">Contas a Receber</a></li>
                        
                  </ul>
                </li>
                <?php } ?>

                   


                   <?php 

                     if($mod_caixa==SIM){
                   if($perfil_acesso==PERFIL_MASTER || $perfil_acesso==PERFIL_COORDENADOR || $perfil_acesso==PERFIL_FINANCEIRO || $perfil_acesso==PERFIL_VENDAS){ ?>
                 <li><a><i class="fa fa-pencil-square-o"></i> Caixa<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                      <li><a href="<?php echo site_url('caixa_abertura/filtro');?>">Abertura de Caixa</a></li>
                       <li><a href="<?php echo site_url('caixa_sangria/filtro');?>">Retirada (Sangria)</a></li>
                       <li><a href="<?php echo site_url('caixa_reforco/filtro');?>">Reforço</a></li>
                        
                        
                  </ul>
                </li>
                <?php } } ?>

                   
                 <?php if($perfil_acesso==PERFIL_MASTER || $perfil_acesso==PERFIL_COORDENADOR || $perfil_acesso==PERFIL_AUXILIAR){ ?>
                <li><a><i class="fa fa-cubes"></i> Estoque / Serviços <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                      <li><a href="<?php echo site_url('produtos/filtro');?>">Produtos</a></li>
                        <li><a href="<?php echo site_url('servicos/filtro');?>">Serviços</a></li>
                       <!--<li><a href="<?php echo site_url('centro_custos/filtro');?>">Movimentação</a></li>-->
                    
                  </ul>
                </li>
                <?php } ?>

                
                 <?php 
                   if($mod_compras==SIM){
                 if($perfil_acesso==PERFIL_MASTER || $perfil_acesso==PERFIL_COORDENADOR || $perfil_acesso==PERFIL_FINANCEIRO || $perfil_acesso==PERFIL_AUXILIAR){ ?>

                <li><a><i class="fa fa-shopping-cart"></i> Compras <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                      <li><a href="<?php echo site_url('solicitacao/filtro');?>">Solicitações</a></li>
                        <li><a href="<?php echo site_url('cotacao/filtro');?>">Cotações</a></li>
                        <li><a href="<?php echo site_url('pedido_compra/filtro');?>">PCs Aprovação</a></li>
                         <li><a href="<?php echo site_url('pedidos_acompanhamento/filtro');?>">Acompanhamento</a></li>
                      
                    
                  </ul>
                </li>
                <?php } ?>


                 <?php if($perfil_acesso==PERFIL_MASTER || $perfil_acesso==PERFIL_COORDENADOR || $perfil_acesso==PERFIL_AUXILIAR){ ?>
                <li><a><i class="fa fa-barcode"></i> Almoxarifado <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                     
                        <li><a href="<?php echo site_url('almoxarifado/filtro');?>">Entrada de Produto</a></li>
                    
                  </ul>
                </li>
                 <?php } } ?>

             

                
               <?php if($perfil_acesso==PERFIL_MASTER || $perfil_acesso==PERFIL_COORDENADOR || $perfil_acesso==PERFIL_CONTADOR){ ?>
                  <li><a><i class="fa fa-group"></i> RH <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    
                    <li><a href="<?php echo site_url('rh_colaboradores/filtro');?>">Funcionários</a></li>
                    
                    <?php if($perfil_acesso!=PERFIL_CONTADOR){ ?>
                    <li><a href="<?php echo site_url('rh_cargos/filtro');?>">Cargos</a></li>
                    <li><a href="<?php echo site_url('rh_departamentos/filtro');?>">Departamentos</a></li>
                      <?php } ?>
                  </ul>
                </li>
                 <?php } ?>

               <?php if($perfil_acesso==PERFIL_MASTER){ ?>
                 <li><a><i class="fa fa-key"></i> Acesso <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="<?php echo site_url('acesso_perfil/filtro');?>">Perfil</a></li>
                    <li><a href="<?php echo site_url('acesso_usuarios/filtro');?>">Usuários</a></li>
                    <!--<li><a href="<?php echo site_url('acesso_historico/filtro');?>">Histórico</a></li>-->
                    <!--<li><a href="#">Permissões</a>-->
                    </li>
                   
                  </ul>
                </li>
                    <?php } ?>

                   <?php if($perfil_acesso==PERFIL_MASTER || $perfil_acesso==PERFIL_COORDENADOR || $perfil_acesso==PERFIL_CONTADOR){ ?>
                 <li><a><i class="fa fa-bar-chart-o"></i> Relatórios <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="<?php echo site_url('relatorio_painel/menu');?>">Painel de Relatório</a></li>
                  </ul>
                </li>
                 <?php } ?>

                  
                  <?php if($perfil_acesso==PERFIL_MASTER || $perfil_acesso==PERFIL_COORDENADOR){
                   ?>
                  <li><a><i class="fa fa-gear"></i> Configurações <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                     
                    <li><a href="<?php echo site_url('filiais/editar/'.PAD_CAD_FILIAL);?>">Parametrização</a></li>
                     
                    <li><a href="<?php echo site_url('clientes/passos/');?>">Informações Gerais</a></li>
                   
                    <li><a href="<?php echo site_url('plano_contas/filtro');?>">Plano de Contas</a></li>
                    <!--<li><a href="<?php echo site_url('filiais/editar/'.PAD_CAD_FILIAL);?>">Boletos</a></li> 
                    <li><a href="<?php echo site_url('filiais/editar/'.PAD_CAD_FILIAL);?>">Tributação</a></li> -->
                       
                  <li><a href="<?php echo site_url('pedido_status/filtro/');?>">Status Vendas</a></li>
                  
                  <?php  if($mod_compras==SIM){ ?>
                  <li><a href="<?php echo site_url('pedido_status_compras/filtro/');?>">Status Pedido Compras</a></li>
                  <?php } ?>

                  <?php  if($mod_locacao==SIM){ ?>
                  <li><a href="<?php echo site_url('forma_entrega/filtro/');?>">Formas de Entrega</a></li>
                   <li><a href="<?php echo site_url('itens_status/filtro/');?>">Status Entrega</a></li>
                  <?php } ?>

                    
                     <?php  if($mod_bar==SIM){ ?>
                    <li><a href="<?php echo site_url('mesas/filtro/');?>">Mesas</a></li>
                      <?php } ?>




                  <li><a href="<?php echo site_url('motivo_mov/filtro');?>">Motivos Mov. Estoque</a></li>
                    
                    
                     <li><a href="<?php echo site_url('contas_banco/filtro/');?>">Contas Bancárias</a></li>
                    <li><a href="<?php echo site_url('formas_recebimentos/filtro');?>">Formas de Recebimentos</a></li>
                    
                    <li><a href="<?php echo site_url('formas_pagamentos/filtro');?>">Formas de Pagamentos</a></li>
                    
                    <li><a href="<?php echo site_url('est_categorias/filtro');?>">Categoria de Estoque</a></li>
                    <li><a href="<?php echo site_url('centro_custos/filtro');?>">Centro de Custos</a></li>
                    <li><a href="<?php echo site_url('est_un_medida/filtro');?>">Unidade de Medida</a></li>
                   
                   
                   
                    
                    <!--<li><a href="<?php echo site_url('operadoras_cartao/filtro');?>">Operadoras Cartões</a></li>
                    <li><a href="<?php echo site_url('bandeira_cartao/filtro');?>">Bandeira de Cartões</a></li>
                    <li><a href="#">Boletos</a></li>-->
                    
                  </ul>
                </li>
                <?php } ?>



              </ul>
            </div>
            
         



          </div>


            <!-- /menu footer buttons -->
        <!--  <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
              <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
              <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
              <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout">
              <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
          </div>-->
          <!-- /menu footer buttons -->

       
        </div>
      </div> <!-- final menu lateral-->


  <!-- top navigation -->
      <div class="top_nav">

        <div class="nav_menu">
          <nav class="" role="navigation">
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
              <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <img src="<?= base_url(); ?>images/img.png" alt=""><?php echo $this->session->userdata('login'); ?>
                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                  
              
                 <!-- <li>
                    <a href="javascript:;">Ajuda</a>
                  </li>-->
                  <li><a href="<?php echo site_url('login/sair');?>"><i class="fa fa-sign-out pull-right"></i> Sair do Sistema</a>
                  </li>
                </ul>
              </li>

               <!--<li class="">
                <a href="<?php echo site_url('marketing/customizacao');?>" class="user-profile">
                                
                </a>
                
              </li>-->

               <li role="presentation" class="dropdown">
                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-bell-o"></i>
                  <span class="badge bg-red" id="total_msg"></span>
                </a>
                <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                 <span id="listaMsgPendente"></span>

                

                </ul>

              </li>

                <li role="presentation" class="dropdown">
                <a href="<?php echo site_url('agenda/visualizar');?>" target="__blank">
                  <i class="fa fa-calendar"></i>
                  <span class="badge bg-red"></span>
                </a>
                <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                 <span></span>

                

                </ul>

              </li>

              

           </ul>
          </nav>
        </div>

      </div>
      <!-- /top navigation -->


<!-- /subnavbar -->
<?php //print_r($this->session->all_userdata()); ?>

<?php  //echo $this->session->userdata('login'); ?>
