<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js/jquery-ui-1.9.1.custom.min.js"></script>


<script>
$(document).ready(function(){

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
	
<!-- DADOS SELEÇÃO DOS ITENS DO PEDIDO -->
	<div class="widget-header">
        <i class="icon-group"></i>
        <h3><?php echo ($tipo==ORCAMENTO)?"Orçamento":"Venda"; ?> - Selecionar Mesa:</h3>
    </div> <!-- widget header -->



    <div class="widget-content">
     <?php echo form_open('pedidos/solicitar_cliente/'.$tipo,array("onsubmit"=>"return validate()","class"=>"form-horizontal")); ?>
     
      <strong><?php echo validation_errors(); ?></strong>


     <input type="hidden" name="tipo" value="<?php echo $tipo; ?>" />
       <fieldset class="grupo">

         <div class="campo">
            <label for="nome" class="labelDados">Mesa:</label>
          <select name="id_mesa" id="id_mesa" style="width:200px;">
          
              <?php foreach ($listMesa as $objMesa): ?>
                  <option value="<?php echo $objMesa->getId_mesa(); ?>" <?php echo set_select('id_mesa',$objMesa->getId_mesa()); ?>>
                    <?php echo $objMesa->getNome(); ?>
                  </option>
              <?php endforeach; ?>
          </select>
          </div>

        <div class="campo">
           <label for="id_cliente" class="labelDados">Cliente:</label>
          
          <!-- <input type="text" name="nome_fantasia" id="autocomplete" class="span3" />
           <input type="hidden" name="id_cliente" id="id_cliente" value="<?php echo set_value('id_cliente')?>"/>
          -->
           <select name="id_cliente" id="id_cliente" style="width:320px;">
            <option value="<?php echo PAD_CAD_CLIENTE; ?>">REALIZAR VENDA SEM CADASTRO DE CLIENTE</option>
              <?php foreach ($listCliente as $objCliente): ?>
                  <option value="<?php echo $objCliente->getId_cliente(); ?>" <?php echo set_select('id_cliente',$objCliente->getId_cliente()); ?>>
                    <?php echo $objCliente->getNome_fantasia(); ?>
                  </option>
              <?php endforeach; ?>
          </select>
          


        </div>


          <div class="campo">
            <label for="nome" class="labelDados">Garçom:</label>
          <select name="id_garcom" id="id_garcom" style="width:200px;">
          
              <?php foreach ($listGarcom as $objGarcom): ?>
                  <option value="<?php echo $objGarcom->getId_colaborador(); ?>" <?php echo set_select('id_colaborador',$objGarcom->getId_colaborador()); ?>>
                    <?php echo $objGarcom->getNome(); ?>
                  </option>
              <?php endforeach; ?>
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


