<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">

				

				<!-- ********* INICIO MIOLO **********-->
				<div class="x_content"> <!-- INICIO MIOLO-->

				 <p>Obrigado por escolher nosso sistema, abaixo segue informações de como configurar o sistema antes de sua utilização.</p>

				<table class="table table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th width="200px">Descrição</th>
                        <th width="200px">Acesso</th>
                        <th>Observação</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                      <tr>
                        <th scope="row"></th>
                        <td>Dados Da Empresa</td>
                        <td><a href="<?php echo site_url('filiais/editar/'.PAD_CAD_FILIAL);?>" target="__blank">Dados da Empresa</a></td>
                        <td>Neste cadastro você realizará o cadastro das informações da empresa</td>
                      </tr>

                      <tr>
                        <th scope="row"></th>
                        <td>Colaboradores</td>
                        <td><a href="<?php echo site_url('rh_colaboradores/filtro/');?>" target="__blank">Colaboradores</a></td>
                        <td>Cadastro utilizado para controlar as informações dos colaboradores da empresa</td>
                      </tr>

                       <tr>
                        <th scope="row"></th>
                        <td>Usuários</td>
                        <td><a href="<?php echo site_url('acesso_usuarios/filtro/');?>" target="__blank">Usuários</a></td>
                        <td>Controla o acesso dos usuários no sistema</td>
                      </tr>

                       <tr>
                        <th scope="row"></th>
                        <td>Clientes</td>
                        <td><a href="<?php echo site_url('filiais/editar/');?>" target="__blank">Clientes</a></td>
                        <td>Controla os Clientes da Empresa</td>
                      </tr>


                      <tr>
                        <th scope="row"></th>
                        <td>Categoria do Estoque</td>
                        <td><a href="<?php echo site_url('est_categorias/filtro/');?>" target="__blank">Categoria de Estoque</a></td>
                        <td>Cadastro utilizado para identificar uma categoria no cadastro de produtos ou serviços</td>
                      </tr>

                       <tr>
                        <th scope="row"></th>
                        <td>Produtos ou Serviços</td>
                        <td><a href="<?php echo site_url('produtos/filtro/');?>" target="__blank">Produtos</a></td>
                        <td>Cadastro que controla as informações dos produtos utilizados na empresa, esses itens serão visualizados na Cotação ou Venda</td>
                      </tr>

                       <tr>
                        <th scope="row"></th>
                        <td>Serviços</td>
                        <td><a href="<?php echo site_url('servicos/filtro/');?>" target="__blank">Serviços</a></td>
                        <td>Cadastro que controla as informações dos serviços utilizados na empresa, esses itens serão visualizados na Cotação ou Venda</td>
                      </tr>

                     

                      <tr>
                        <th scope="row"></th>
                        <td>Fornecedores</td>
                        <td><a href="<?php echo site_url('fornecedores/filtro/');?>" target="__blank">Fornecedores</a></td>
                        <td>Controla os dados dos fornecedores da empresa</td>
                      </tr>

                       <tr>
                        <th scope="row"></th>
                        <td>Centro de Custos</td>
                        <td><a href="<?php echo site_url('centro_custos/filtro/');?>" target="__blank">Centro de custos</a></td>
                        <td>Cadastro utilizado na parte de contas a pagar para vincular os custos em determinada área da empresa.</td>
                      </tr>

                       <tr>
                        <th scope="row"></th>
                        <td>Contas a Pagar</td>
                        <td><a href="<?php echo site_url('contas_pagar/filtro/');?>" target="__blank">Contas a Pagar</a></td>
                        <td>Realiza os lançamentos de contas a pagar da empresa</td>
                      </tr>

                       <tr>
                        <th scope="row"></th>
                        <td>Formas de Recebimentos</td>
                        <td><a href="<?php echo site_url('formas_recebimentos/filtro/');?>" target="__blank">Formas de Recebimentos</a></td>
                        <td>Cadastro responsável por habilitar as formas de recebimentos aceitas na empresa e os prazos de compensação. (<span style="color: red;">Este cadastro preferencialmente fazer junto ao consultor no treinamento</span>)</td>
                     </tr>





                    </tbody>
                  </table>


					
				</div>  <!-- FINAL MIOLO -->

	</div> <!-- FINAL COL -->

</div> <!-- FINAL ROWS -->






<script type="text/javascript">

<?php if($msg==true){ ?>
//função para ocultar mensagem de cadastro: arquivo: js/base.js
hideMessage();

<?php } ?>

</script>


