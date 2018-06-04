<!-- modal filtro avançado -->	
	<div id="form-content" class="modal hide fade in" style="display: none; ">
	        <div class="modal-header">
	              <a class="close" data-dismiss="modal">×</a>
                      <h3><i class="btn-icon-only icon-search"> </i>Pesquisa Avançada</h3>
	        </div>
		
			<!--<form class="contact">-->
                        
                        <form class="contact" method="post" id="forgot_form" action="<?php echo base_url(); ?>produtos/filtro">
                

    			<fieldset>
		         <div class="modal-body">
		        	 <ul class="nav nav-list">
				<li class="nav-header">Descricao Produto</li>
				<li><input class="input-xlarge" type="text" name="descricao" id="descricao"></li>
				<li class="nav-header">Código</li>
				<li><input class="input-xlarge" type="text" name="codigo" id="codigo"></li>
				
				</ul> 
		        </div>
			</fieldset>
			
		
	     <div class="modal-footer">
                  <input type="submit" value="Buscar" class="btn btn-primary" />
	         <!--<button class="btn btn-primary" id="submit">Buscar</button>-->
	         <a href="#" class="btn" data-dismiss="modal">Fechar</a>
  	   </div>
            </form>
	</div>
<!-- FINAL MODAL -->


<div class="pull-right">
<a data-toggle="modal" href="#form-content" class="btn btn-primary btn-small"><i class="btn-icon-only icon-search"> </i>Pesquisar Produto</a>

</div>
<div class="row">
  <div class="span12">
       <div class="widget ">
        <div class="widget-header">
                <i class="icon-retweet"></i>
                <h3>Movimentação Estoque</h3>
         </div> <!-- /widget-header -->
            <div class="widget-content">
              <div class="tab-pane" id="formcontrols">
        
      <!--  <form action="" id="edit-profile" class="form-horizontal">-->
            
    <?php echo form_open('movimentacao_produto/cadastrar/'.$objMov->getId_movimentacao(),array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
      
               
            
            <fieldset>
            
            
            
                          
            
            <div class="control-group">											
                <label class="control-label" for="unidade"><strong>Produto:</strong></label>
                <div class="controls">
                    <strong><?php echo $objMov->getProduto()->getDescricao(); ?></strong>
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->
            
            <div class="control-group">											
            <label class="control-label"><strong>Tipo Movimentação:</strong></label>
             
             <div class="controls">
                <?php echo $objMov->printMovimentacao();?>
              </div>	<!-- /controls -->			
      </div> <!-- /control-group -->


           
            <div class="control-group">											
                <label class="control-label" for="qtd_mov"><strong>Quantidade:</strong></label>
                <div class="controls">
                  <?php echo $objMov->getQtd_mov() ?>
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->

            
            <div class="control-group">											
                <label class="control-label" for="responsavel"><strong>Responsável:</strong></label>
                <div class="controls">
                <?php echo $objMov->getResponsavel(); ?>
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->
            
            
            <div class="control-group">											
                <label class="control-label" for="descricao"><strong>Descricao:</strong></label>
                <div class="controls">
                <?php echo $objMov->getDescricao(); ?>
                </div> <!-- /controls -->				
            </div> <!-- /control-group -->
            
            
            <div class="control-group">											
                <label class="control-label" for="id_fornecedor"><strong>Fornecedor:</strong></label>
                <div class="controls">
                    <?php 
                        if($objMov->getFornecedor()!=null){    
                            echo $objMov->getFornecedor()->getNome_fantasia(); 
                        }
                    ?>
                </div> <!-- /controls -->				
    </div> <!-- /control-group -->

            
            
            
            
            

            
                     
            <div class="form-actions">
            
                        
            </div> <!-- /form-actions -->
        </fieldset>
        </form>
        </div>

            </div>
                </div>
                    </div> <!-- /widget-content -->
                        </div> <!-- /widget -->
                        
