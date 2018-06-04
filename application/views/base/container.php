<!-- CONTAINER NOVO -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Gestor Web</title>

  <!-- Bootstrap core CSS -->
  
 <link rel="shortcut icon" href="<?= base_url(); ?>img/favicon.png" />

  <link href="<?= base_url(); ?>css/bootstrap.min.css" rel="stylesheet">

  <link href="<?= base_url(); ?>fonts/css/font-awesome.min.css" rel="stylesheet">

  <link href="<?= base_url(); ?>css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="<?= base_url(); ?>css/custom.css" rel="stylesheet">
  <link href="<?= base_url(); ?>css/icheck/flat/green.css" rel="stylesheet">
  <link href="<?= base_url(); ?>css/style.css" rel="stylesheet">

  <link href="<?= base_url(); ?>js/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url(); ?>js/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url(); ?>js/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url(); ?>js/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url(); ?>js/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link type="text/css" rel="stylesheet" href="<?= base_url() ?>css/jquery.ui.theme/redmond/style.css" /> <!--Css Padrao-->


  <script src="<?= base_url(); ?>js/jquery.min.js"></script>

  <script src="<?= base_url(); ?>js/base.js"></script>

  <!-- DATA PICKER UI -->
<script type="text/javascript" src="<?= base_url() ?>js/jquery-ui-1.9.1.custom.min.js"></script> <!--Jquery Padrao-->
<script type="text/javascript" src="<?= base_url() ?>js/jquery.ui.datepicker-pt-BR.js"></script> <!--Jquery Padrao-->

  

  <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

      
      <style type="text/css">
/*.footer {
  position: fixed;
  bottom: 0;
  width:auto;

  height: 50px;
  width:80%; 
  */

  .fundoCategoria{
  background-color:#2A3F54; 
  color:#FFFFFF;
} 
  
  </style>



</head>


<body class="nav-md">

  <div class="container body">


    <div class="main_container">

<?php if(!isset($menu_geral)){ ?>
     
     <?= $menu; ?> 

<?php } ?>


      <!-- page content -->
      <div class="right_col" role="main">
         <div class="">
          
        <div class="clearfix"></div>

        <!-- INICIO CONTEINER -->
         <?= $content; ?>
        <!-- FINAL CONTEINER --> 

        </div>
              
              <!-- footer content -->
            <!-- <footer class="footer">
                <div class="pull-right">
                 AJF Sistemas - Designer: Copyright (c) Aigars Silkalns & Colorlib</a>
                </div>
                <div class="clearfix"></div>
              </footer>-->

              <!-- /footer content -->

            </div>
            <!-- /page content -->
          </div>

        </div>



        <div id="custom_notifications" class="custom-notifications dsp_none">
          <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
          </ul>
          <div class="clearfix"></div>
          <div id="notif-group" class="tabbed_notifications"></div>
        </div>

         

        <script src="<?= base_url(); ?>js/bootstrap.min.js"></script>

        <!-- bootstrap progress js -->
        <script src="<?= base_url(); ?>js/progressbar/bootstrap-progressbar.min.js"></script>
        <!-- icheck -->
        <script src="<?= base_url(); ?>js/icheck/icheck.min.js"></script>

        <script src="<?= base_url(); ?>js/custom.js"></script>


        <!-- Datatables -->
      
        <!-- Datatables-->
        <script src="<?= base_url(); ?>js/datatables/jquery.dataTables.min.js"></script>
        <script src="<?= base_url(); ?>js/datatables/dataTables.bootstrap.js"></script>
        <script src="<?= base_url(); ?>js/datatables/dataTables.buttons.min.js"></script>
        <script src="<?= base_url(); ?>js/datatables/buttons.bootstrap.min.js"></script>
        <script src="<?= base_url(); ?>js/datatables/jszip.min.js"></script>
        <script src="<?= base_url(); ?>js/datatables/pdfmake.min.js"></script>
        <script src="<?= base_url(); ?>js/datatables/vfs_fonts.js"></script>
        <script src="<?= base_url(); ?>js/datatables/buttons.html5.min.js"></script>
        <script src="<?= base_url(); ?>js/datatables/buttons.print.min.js"></script>
        <script src="<?= base_url(); ?>js/datatables/dataTables.fixedHeader.min.js"></script>
        <script src="<?= base_url(); ?>js/datatables/dataTables.keyTable.min.js"></script>
        <script src="<?= base_url(); ?>js/datatables/dataTables.responsive.min.js"></script>
        <script src="<?= base_url(); ?>js/datatables/responsive.bootstrap.min.js"></script>
        <script src="<?= base_url(); ?>js/datatables/dataTables.scroller.min.js"></script>

       
  
        <script type="text/javascript" src="<?= base_url() ?>js/jquery-maskMoney.js"></script> <!--Jquery ... -->
        <script type="text/javascript" src="<?= base_url() ?>js/jquery.magicforms-b1.0.js"></script> <!--Leonardo simas e Weslley leandro -->
        <script type="text/javascript" src="<?= base_url() ?>js/select.maskgrupo.myconfig.js"></script> <!--Leonardo simas e Weslley leandro -->

      <!--<script src="<?= base_url() ?>js/input_mask/jquery.inputmask.js"></script>-->

      <script src="<?= base_url() ?>js/jquery_plugin_cpfcnpj.js"></script> 

      <script>
    $(document).ready(function() {
     

         //$(":input").inputmask();
    $(".hora").mask("99:99");
   $(".cep").mask("99999-999");
   $(".cpf").mask("999-999-999-99");
   $(".telefone").mask("(99)99999-9999");
    $(".telefone_fixo").mask("(99)9999-9999");
   $(".dataManual").mask("99/99/9999");

    });
  </script>







        <!-- pace -->
        <!--<script src="<?= base_url(); ?>js/pace/pace.min.js"></script>
        <script>
          var handleDataTableButtons = function() {
              "use strict";
              0 !== $("#datatable-buttons").length && $("#datatable-buttons").DataTable({
                dom: "Bfrtip",
                buttons: [{
                  extend: "copy",
                  className: "btn-sm"
                }, {
                  extend: "csv",
                  className: "btn-sm"
                }, {
                  extend: "excel",
                  className: "btn-sm"
                }, {
                  extend: "pdf",
                  className: "btn-sm"
                }, {
                  extend: "print",
                  className: "btn-sm"
                }],
                responsive: !0
              })
            },
            TableManageButtons = function() {
              "use strict";
              return {
                init: function() {
                  handleDataTableButtons()
                }
              }
            }();
        </script>-->
        
        <script type="text/javascript">
          $(document).ready(function() {

           

            $(".calendario").datepicker();

            //$("#cnpj_cpf").val('tetetetet');

            $('#datatable').dataTable();
            $('#datatable-keytable').DataTable({
              keys: true
            });
            //$('#datatable-responsive').DataTable();
            $('#datatable-responsive').DataTable( {
              "ordering": false,
        "language": {
            "lengthMenu": "Mostrando _MENU_ registros por página",
            "zeroRecords": "Nenhum registro encontrado",
            "info": "Mostrando _PAGE_ de _PAGES_ paginas - Total Registro _MAX_ ",
            "infoEmpty": "Nenhum registro encontrado",
            "search": "Pesquisar", 
            paginate: {
            "first":      "Primeiro",
            "previous":   "Anterior",
            "next":       "Pr&oacute;ximo",
            "last":       "Ultimo"
        },
            "infoFiltered": "(filtrando de _MAX_ total de registros)"
        }
    });
      
      /*$('#datatable-scroller').DataTable({
        ajax: "js/datatables/json/scroller-demo.json",
        deferRender: true,
        scrollY: 380,
        scrollCollapse: true,
        scroller: true
      });*/
      
      var table = $('#datatable-fixed-header').DataTable({
        fixedHeader: true
      

      });

      

          });
          TableManageButtons.init();



        </script>
</body>

</html>
