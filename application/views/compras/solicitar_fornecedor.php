<!--<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js/jquery-ui-1.9.1.custom.min.js"></script>
-->

<script>
$(document).ready(function(){

     //FORCEDOR MODAL
  $("#novo_fornecedor").click(function(){  

      $('#form-fornecedor').modal({
        show: 'true'
      });
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


      $('#autocomplete').autocomplete({
 
       source: function(request, response) {
      
      $.ajax({
        //q: request.term,
        url: "<?php echo site_url('pedidos/pesquisar_cliente_auto'); ?>",
        data: { term: $("#autocomplete").val()},
        dataType: "json",
        type: "POST",
        success: function(data) {
          //console.info(data);
          response(data);
        }
      });

    },

    select: function(event, ui){
 
            // just in case you want to see the ID
            var accountVal = ui.item.value;
            console.log(accountVal);
 
            // now set the label in the textbox
            var accountText = ui.item.label;
            $('#autocomplete').val(accountText);
 
            return false;
        },

     minLength:2,
               
    focus: function( event, ui ) {
            // this is to prevent showing an ID in the textbox instead of name 
            // when the user tries to select using the up/down arrow of his keyboard
            $( "#autocomplete" ).val( ui.item.label );
            $( "#id_cliente" ).val( ui.item.value );
            return false;  
        }  
 
   });


  
 
});





</script>






<div class="widget ">


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
	
<!-- DADOS SELEÇÃO DOS ITENS DO PEDIDO -->
	<div class="widget-header">
        <i class="icon-group"></i>
        <h3>Nova Compra:</h3>
    </div> <!-- widget header -->



    <div class="widget-content">
    <span><a href="#" id="novo_fornecedor" class="btn btn-primary">+ Novo Fornecedor</a></span>
    <br />
      <br />
     <?php echo form_open('compras/solicitar_fornecedor/'.$tipo,array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
     
      <strong><?php echo validation_errors(); ?></strong>


     <input type="hidden" name="tipo" value="<?php echo $tipo; ?>" />
       <fieldset class="grupo">

               <div class="campo">
                <label for="data_nascimento" class="labelDados">Fornecedor:</label>
                <select name="id_fornecedor" id="id_fornecedor">
                       
              </select>
           </div>

        




          <div class="campo">
           <label for="nome" class="labelDados">&nbsp</label>
           <button type="submit" class="btn btn-success" id="bt_confirmar">
                <i class="icon-play icon-white"></i> 
              </button>          
         </div>

               
       </fieldset>
       </form>
          
    </div> <!-- widgte content -->
<!-- FINAL SELEÇÃO DOS ITENS DO PEDIDO -->


</div><!-- widget -->


