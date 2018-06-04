<?php $objDateFormat = $this->DateFormat; 
 
 $janela = array(
              'width'      => '2048',
              'height'     => '790',
              'scrollbars' => 'yes',
              'status'     => 'yes',
              'resizable'  => 'yes',
              'screenx'    => '200',
              'screeny'    => '100',
              'class'    => 'btn btn-success'
            );

?>

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">

				<div class="x_title">
					<h2>Controle de Mesas</h2>
					<ul class="nav navbar-right panel_toolbox">
				
					 <li><a href="<?php echo site_url('pedidos_mesa/controle/');?>"><i class="fa fa-refresh"></i> <strong>Atualizar Página</strong></a></li>
					
					<li><a href="#"><i class="fa fa-search"></i> <strong>Filtro</strong></a></li>
					
					</ul>                     
					<div class="clearfix"></div>
				</div>

				<!-- ********* INICIO MIOLO **********-->
				<div class="x_content"> <!-- INICIO MIOLO-->

				 <div class="row">

                    <div class="col-md-12 col-sm-12 col-xs-12" style="text-align:center;">
                      <ul class="pagination pagination-split">
                         <li><a href="#">Todas</a>
                        </li>
                        <li><a href="#">Mesas Livres</a>
                        </li>
                        <li><a href="#">Mesas Ocupadas</a>
                        </li>
                        <li><a href="#">Mesas Inativas</a>
                        </li>
                       
                      </ul>
                    </div>
                   </div>


               <?php foreach ($listControle as $objControle): ?>


				 <div class="col-md-4 col-sm-4 col-xs-12 animated fadeInDown">
                      <div class="well profile_view">
                        <div class="col-sm-12">
                        <!--  <h4 class="brief"><i>Digital Strateg8st</i></h4>-->
                          <div class="left col-xs-12" style="height:100px;">
                            <h2><?php echo $objControle['nome']; ?></h2>
                            <p><strong>Capacidade: </strong> <?php echo $objControle['capacidade'] ?> </p>
                            <ul class="list-unstyled">
                              <li><i class="fa fa-clock-o"></i></li>
                            </ul>
                          </div>
                         
                        </div>
                        <div class="col-xs-12 bottom text-center">
                      
                          <div class="col-xs-12 col-sm-12 emphasis">
                           
                            <span>
                           
                           <!-- <a href="#" class="btn btn-success"> <i class="fa fa-check">
                                                            </i> Disponível </a>-->

                            <?php echo anchor_popup(site_url('pedidos_mesa/abrir/'.$objControle['id_mesa']),'<i class="fa fa-check"></i> <strong>Disponível</strong>',$janela);?>                                


                         </span>
                          </div>
                        </div>
                      </div>
                    </div>
                   <?php endforeach; ?>

				

			  	

			  	

				

						
				
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


