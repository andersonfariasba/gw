<!-- CATEGORIA -->
<div id="form-content" class="modal hide fade in" style="display: none; ">
	        <div class="modal-header">
	              <a class="close" data-dismiss="modal">×</a>
                      <h3><i class="btn-icon-only icon-plus"> </i>Nova Categoria</h3>
	        </div>
		
			<!--<form class="contact">-->
                        
               <form class="contact" id="ajax_form">
                

    			<fieldset>
		         <div class="modal-body">
		        	 <ul class="nav nav-list">
				<li class="nav-header">CATEGORIA</li>
				<li><input class="input-xlarge" type="text" name="categoria" id="categoria"></li>
				
				
				</ul> 
		        </div>
			</fieldset>
			
		
	     <div class="modal-footer">
                 <button class="btn btn-primary" id="submit">Incluir</button>

                  <!--<input type="submit" value="Incluir" class="btn btn-primary" />-->
	         <!--<button class="btn btn-primary" id="submit">Buscar</button>-->
	         <a href="#" class="btn" data-dismiss="modal">Fechar</a>
  	   </div>
            </form>
	</div>
<!-- FINAL MODAL -->




<!-- UNIDADE DE MEDIDA -->
<div id="form-unidade" class="modal hide fade in" style="display: none; ">
          <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                      <h3><i class="btn-icon-only icon-plus"> </i>Nova Unidade</h3>
          </div>
    
      <!--<form class="contact">-->
                        
               <form class="contact-unidade" id="ajax_form_unidade">
                

          <fieldset>
             <div class="modal-body">
               <ul class="nav nav-list">
               <li class="nav-header">UNIDADE DE MEDIDA</li>
               <li><input class="input-xlarge" type="text" name="unidade" id="unidade_modal"></li>

               <li class="nav-header">SIGLA</li>
               <li><input class="input-xlarge" type="text" name="sigla" id="sigla"></li>
        
        
        
        </ul> 
            </div>
      </fieldset>
      
    
       <div class="modal-footer">
                 <button class="btn btn-primary" id="submit">Incluir</button>

                  <!--<input type="submit" value="Incluir" class="btn btn-primary" />-->
           <!--<button class="btn btn-primary" id="submit">Buscar</button>-->
           <a href="#" class="btn" data-dismiss="modal">Fechar</a>
       </div>
            </form>
  </div>
<!-- FINAL MODAL -->


<!-- FORNECEDOR -->
<div id="form-fornecedor" class="modal hide fade in" style="display: none; ">
          <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                      <h3><i class="btn-icon-only icon-plus"> </i>Novo Fornecedor</h3>
          </div>
    
      <!--<form class="contact">-->
                        
               <form class="contact-fornecedor" id="ajax_form_fornecedor">
                

          <fieldset>
             <div class="modal-body">
               
               <ul class="nav nav-list">
               <li class="nav-header">NOME FANTASIA</li>
               <li><input class="input-xlarge" type="text" name="nome_fantasia" id="nome_fantasia"></li>

                 <li class="nav-header">TIPO</li>
                 <li>
               </label>
                    <label class="radio inline">            
                    <input type="radio" checked=""  name="tipo" value="<?php echo set_value('tipo',PESSOA_JURIDICA)?>">Pessoa Jurídica
                </label>

                <label class="radio inline">
                    <input type="radio" name="tipo" value="<?php echo set_value('tipo',PESSOA_FISICA)?>"> Pessoa Física
                </label>
                </li>
        
        
        
        </ul> 
            </div>
      </fieldset>
      
    
       <div class="modal-footer">
                 <button class="btn btn-primary" id="submit">Incluir</button>

                  <!--<input type="submit" value="Incluir" class="btn btn-primary" />-->
           <!--<button class="btn btn-primary" id="submit">Buscar</button>-->
           <a href="#" class="btn" data-dismiss="modal">Fechar</a>
       </div>
            </form>
  </div>
<!-- FINAL MODAL -->







<div class="pull-right">
<a href="<?php echo site_url('produtos_compras/filtro'); ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-search"></i>Buscar Produto Compra</a>
</div>
<div class="row">
  <div class="span12">
       <div class="widget ">
        <div class="widget-header">
                <i class="icon-tags"></i>
                <h3>Produto de Compra Cadastrar</h3>
         </div> <!-- /widget-header -->
            <div class="widget-content">
              <div class="tab-pane" id="formcontrols">
        
      <!--  <form action="" id="edit-profile" class="form-horizontal">-->
            
    <?php echo form_open('produtos_compras/cadastrar',array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
      <input type="hidden" name="tipo" value="<?php echo set_value('tipo',PRODUTO); ?>" />        
      <input type="hidden" name="habilitado_venda" value="<?php echo set_value('habilitado_venda',NAO); ?>" />          
            <fieldset>
            
           
             <?php if($msg==true){ ?>
            <div class="alert alert-success" id="msgOk">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><img src="<?php echo base_url()."/images/ativo.png"?>" width="25px" border="0">Cadastro realizado com sucesso!</strong>
            </div>
        <?php } ?>
            
             <?php echo validation_errors(); ?>
                <div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Dados Básicos</a></li>
      <li role="presentation"><a href="#obs" aria-controls="obs" role="tab" data-toggle="tab">Observações</a></li>
    
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    
   <!-- DADOS BÁSCIOS --> 
   <div role="tabpanel" class="tab-pane active" id="home">
    
     <fieldset class="grupo">
                        
            <div class="campo">

           
                <label for="nome" class="labelDados">Categoria: <a href="#" alt="Nova Categoria" title="Nova Categoria" id="nova_categoria" class="btn-small btn-primary">+</a></label>
                <select name="id_categoria" id="id_categoria" style="width:160px;">
                </select>
                
                <!--<select name="id_categoria" id="id_categoria">
                        
                        <?php foreach ($listCategoria as $objCategoria): ?>
                        <option value="<?php echo $objCategoria->getId_categoria(); ?>" <?php echo set_select('id_categoria',$objCategoria->getId_categoria()); ?>>
                           <?php echo $objCategoria->getCategoria(); ?>
                        </option>
                         <?php endforeach; ?>
                 </select> -->
                 
            </div>
            
           <div class="campo">
                <label for="data_nascimento" class="labelDados">Unidade de Medida: <a href="#" id="nova_unidade" class="btn-small btn-primary">+</a></label>
                <select name="id_unidade" id="id_unidade">
                      
                        
                        <!-- <?php foreach ($listUnidade as $objUnidade): ?>
                        <option value="<?php echo $objUnidade->getId_unidade(); ?>" <?php echo set_select('id_unidade',$objUnidade->getId_unidade()); ?>>
                           <?php echo $objUnidade->getUnidade(); ?>
                        </option>
                         <?php endforeach; ?>-->
                </select>
           </div>
           
           <div class="campo">
                <label for="data_nascimento" class="labelDados">Fornecedor: <a href="#" id="novo_fornecedor" class="btn-small btn-primary">+</a></label>
                <select name="id_fornecedor" id="id_fornecedor">
                       
                       <!--  <?php foreach ($listFornecedor as $objFornecedor): ?>
                        <option value="<?php echo $objFornecedor->getId_fornecedor(); ?>" <?php echo set_select('id_fornecedor',$objFornecedor->getId_fornecedor()); ?>>
                           <?php echo $objFornecedor->getNome_fantasia(); ?>
                        </option>
                         <?php endforeach; ?>-->
                </select>
           </div>
       </fieldset>

       
       <fieldset class="grupo">
                        
            <div class="campo">
                <label for="nome" class="labelDados">Descrição:</label>
                <input type="text" name="descricao" class="span4" id="descricao" value="<?php echo set_value('descricao')?>">
            </div>
       
          <div class="campo">
               <label for="nome" class="labelDados">Código:</label>
               <input type="text" name="codigo" class="span2" id="codigo" value="<?php echo set_value('codigo')?>">
     
          </div>
       
           <div class="campo">
                <label for="nome" class="labelDados">Referência:</label>
                <input type="text" name="referencia" class="span4" id="referencia" value="<?php echo set_value('referencia')?>">
          </div>
       
        </fieldset>
       
       <!--<fieldset class="grupo">
                        
            <div class="campo">
                <label for="nome" class="labelDados">Valor Compra:</label>
                <input type="text" name="valor_custo" tipo="moneyReal" class="span2" id="valor_custo" value="<?php echo set_value('valor_custo')?>">
            </div>
       
          <div class="campo">
               <label for="nome" class="labelDados">Valor Venda:</label>
              <input type="text" name="valor_venda" class="span2" tipo="moneyReal" id="valor_venda" value="<?php echo set_value('valor_venda')?>">
        
          </div>
          
       
           <div class="campo">
                <label for="nome" class="labelDados">Quantidade Minima:</label>
                <input type="text" name="qtd_minima" class="span2" id="qtd_minima" value="<?php echo set_value('qtd_minima')?>">
          </div>
          
       
           
           <div class="campo">
                <label for="nome" class="labelDados">Localização:</label>
                <input type="text" name="localizacao" class="span4" id="localizacao" value="<?php echo set_value('localizacao')?>">
          </div>
       
        </fieldset>-->

        <!--<fieldset class="grupo">
            <div class="campo">
                <label for="id_cargo" class="labelDados">Reduzir quantidade do estoque ao realizar um pedido?</label>
                 <label class="radio inline">
                    <input type="radio"  name="abater_estoque" checked="" value="<?php echo set_value('abater_estoque',SIM)?>"> Sim
                </label>

                <label class="radio inline">
                  <input type="radio" name="abater_estoque" value="<?php echo set_value('abater_estoque',NAO)?>"> Não
                </label>
            </div>
       </fieldset>
           


       <fieldset class="grupo">
            <div class="campo">
                <label for="id_cargo" class="labelDados">Habilitar produto para venda?</label>
                 <label class="radio inline">
                    <input type="radio"  name="habilitado_venda" checked="" value="<?php echo set_value('habilitado_venda',SIM)?>"> Sim
                </label>

                <label class="radio inline">
                  <input type="radio" name="habilitado_venda" value="<?php echo set_value('habilitado_venda',NAO)?>"> Não
                </label>
            </div>
       </fieldset>    
       --> 


    
    
    
    
    
    </div><!-- FINAL DADOS BÁSCIOS -->
    
    <div role="tabpanel" class="tab-pane" id="obs">
        <fieldset class="grupo">
                        
            <div class="campo">
                <label for="nome" class="labelDados">Observação:</label>
                <textarea cols="50" rows="10" class="span6" name="observacao" id="observacao">
               
               </textarea>
                
            </div>
        </fieldset>
        
    </div>
    
  </div>

</div>

                
            
           
                     
            <div class="form-actions">
            
            <input type="submit" value="Salvar" class="btn btn-primary" />
            <input type="reset" value="Limpar" class="btn" />
            <!-- <button type="submit" class="btn btn-primary">Salvar</button> 
            <button class="btn">Cancelar</button>-->
            
            
            </div> <!-- /form-actions -->
        </fieldset>
        </form>
        </div>

            </div>
                </div>
                    </div> <!-- /widget-content -->
                        </div> <!-- /widget -->
                        


<script type="text/javascript">

  //CATEGORIA MODAL
  $("#nova_categoria").click(function(){             
      $('#form-content').modal({
        show: 'true'
      });
  });

   
   //Categoria   
   var url = '<?= site_url("/comp_categorias/ajax_listar/0"); ?>/';
   $.getJSON(url, function(j){
                             
      var options = '';
       //options += '<option value="">Selecione...</option>';
       for (var i = 0; i < j.length; i++) {
          options += '<option value="' + j[i].id_categoria + '">' + j[i].categoria + '</option>';
        } 
       $('#id_categoria').html(options).show();
       
    });


    //Unidade   
   var urlUnidade = '<?= site_url("/est_un_medida/ajax_listar/0"); ?>/';
   $.getJSON(urlUnidade, function(u){
                             
      var optionsUnidade = '';
       //options += '<option value="">Selecione...</option>';
       for (var x = 0; x < u.length; x++) {
          optionsUnidade += '<option value="' + u[x].id_unidade + '">' + u[x].unidade + '</option>';
        } 
       $('#id_unidade').html(optionsUnidade).show();
       
    });


     //Fornecedor   
   var urlFornecedor = '<?= site_url("/fornecedores/ajax_listar/0"); ?>/';
   $.getJSON(urlFornecedor, function(u){
                             
      var optionsForn = '';
       //options += '<option value="">Selecione...</option>';
       for (var x = 0; x < u.length; x++) {
          optionsForn += '<option value="' + u[x].id_fornecedor + '">' + u[x].nome_fantasia + '</option>';
        } 
       $('#id_fornecedor').html(optionsForn).show();
       
    });



  //AJAX CATEGORIA MODAL
  $('#ajax_form').submit(function(){
 
    $.ajax({
  	type: "POST",
	  url: "<?php echo site_url('comp_categorias/cadastrar'); ?>",
	  data: $('form.contact').serialize(),
        success: function(msg){
	         //$("#teste").html(msg)
           var url = '<?= site_url("/comp_categorias/ajax_listar/1"); ?>/';

           $.getJSON(url, function(j){
                 
          
          var optionsUp = '';
           for (var i = 0; i < j.length; i++) {
              optionsUp += '<option value="' + j[i].id_categoria + '">' + j[i].categoria + '</option>';
            } 
           $('#id_categoria').html(optionsUp).show();

            });     	
          
            $("#form-content").modal('hide');                     
	        
            },
            
		error: function(j){
			//alert("failure");
			}
      		});

    return false;
	});





   //UNIDADE DE MEDIDA MODAL
  $("#nova_unidade").click(function(){             
      $('#form-unidade').modal({
        show: 'true'
      });
  });

//AJAX CATEGORIA MODAL
  $('#ajax_form_unidade').submit(function(){
 
    $.ajax({
    type: "POST",
    url: "<?php echo site_url('est_un_medida/cadastrar'); ?>",
    data: $('form.contact-unidade').serialize(),
        success: function(msg){
         //Unidade   
   var urlUnidade = '<?= site_url("/est_un_medida/ajax_listar/1"); ?>/';
   $.getJSON(urlUnidade, function(u){
                             
      var optionsUnidade = '';
       //options += '<option value="">Selecione...</option>';
       for (var x = 0; x < u.length; x++) {
          optionsUnidade += '<option value="' + u[x].id_unidade + '">' + u[x].unidade + '</option>';
        } 
          

            $('#id_unidade').html(optionsUnidade).show();
       
        });
        
            $("#form-unidade").modal('hide');                     
          
            },
            
    error: function(u){
      //alert("failure");
      }
          });

    return false;
  });




   //FORCEDOR MODAL
  $("#novo_fornecedor").click(function(){             
      $('#form-fornecedor').modal({
        show: 'true'
      });
  });


  //AJAX FORNECEDOR MODAL
  $('#ajax_form_fornecedor').submit(function(){
 
    $.ajax({
    type: "POST",
    url: "<?php echo site_url('fornecedores/cadastrar'); ?>",
    data: $('form.contact-fornecedor').serialize(),
        success: function(msg){
         //Unidade   
   var urlFornecedor = '<?= site_url("/fornecedores/ajax_listar/1"); ?>/';
  
   $.getJSON(urlFornecedor, function(f){
                             
      var optionsFornecedores = '';
       //options += '<option value="">Selecione...</option>';
       for (var x = 0; x < f.length; x++) {
          optionsFornecedores += '<option value="' + f[x].id_fornecedor + '">' + f[x].nome_fantasia + '</option>';
        } 
          

            $('#id_fornecedor').html(optionsFornecedores).show();
       
        });
        
            $("#form-fornecedor").modal('hide');                     
          
            },
            
    error: function(f){
      //alert("failure");
      }
          });

    return false;
  });





</script>



<script type="text/javascript">

<?php if($msg==true){ ?>
  //função para ocultar mensagem de cadastro: arquivo: js/base.js
  hideMessage();

<?php } ?>

</script>