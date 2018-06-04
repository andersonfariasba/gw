<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>AGENDA</title>

  <!-- Bootstrap core CSS -->

  <link href="<?= base_url(); ?>css/bootstrap.min.css" rel="stylesheet">

  <link href="<?= base_url(); ?>fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="<?= base_url(); ?>css/custom.css" rel="stylesheet">
  <link href="<?= base_url(); ?>css/icheck/flat/green.css" rel="stylesheet">

  <link href="<?= base_url(); ?>css/calendar/fullcalendar.css" rel="stylesheet">
  <link href="<?= base_url(); ?>css/calendar/fullcalendar.print.css" rel="stylesheet" media="print">



  <!--[if lt IE 9]>
            <script src="../assets/js/ie8-responsive-file-warning.js"></script>
            <![endif]-->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->

</head>


<body class="nav-md">


<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">

				<div class="x_title">
					<h2><i class="fa fa-calendar"></i> Agenda</h2>
            <div class="form-group">
                   
                    <div class="col-sm-6">
                      <select class="form-control input-sm" name="dentista" id="id_dentista">
                      <option value="">SELECIONE O DENTISTA</option>
                      <?php foreach ($listDentista as $objDentista): ?>
                      <option value="<?php echo $objDentista->getId(); ?>" <?php echo set_select('dentista',$objDentista->getNome()); ?>>
                      <?php echo $objDentista->getNome(); ?>
                      </option>
                      <?php endforeach; ?>
                      </select>
                       <input type="hidden" class="form-control input-sm" id="teste">
                    </div>
                  </div>
					<ul class="nav navbar-right panel_toolbox">
					
					<li><a href="<?php echo site_url('agenda/visualizar');?>"><i class="fa fa-refresh"></i> <strong>Atualizar Agenda</strong></a></li>
					<!--<li><a href="#"><i class="fa fa-search"></i> <strong>Filtrar Agenda</strong></a></li>
					<li><a href="#"><i class="fa fa-bar-chart"></i> <strong>Relatórios</strong></a></li>-->
					
					</ul>                     
					<div class="clearfix"></div>
				</div>

				<!-- ********* INICIO MIOLO **********-->
				<div class="x_content"> <!-- INICIO MIOLO-->

				  <div id='calendar'></div>
				
                </div> <!-- FINAL MIOLO -->
				

                <!-- MODAL -->



      <!-- Start Calendar modal -->
      <div id="CalenderModalNew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-calendar"></i> Novo Agendamento</h4>
            </div>
            <div class="modal-body">
              <div id="testmodal" style="padding: 5px 20px;">
                
                <!--<form id="antoform" class="form-horizontal calender" role="form">-->
                  <?php echo form_open('agenda/cadastrar',array("class"=>"form-horizontal")); ?>

                    <input type="hidden" class="form-control input-sm" name="start" id="data_inicio">
                    <input type="hidden" class="form-control input-sm" name="end" id="data_final">
                  
                    


                    <div class="form-group">
                    <label class="col-sm-3 control-label">Dentisa</label>
                    <div class="col-sm-9">
                      <select class="form-control input-sm" name="dentista" id="dentista">
                      <option value="">Selecione...</option>
                      <?php foreach ($listDentista as $objDentista): ?>
                      <option value="<?php echo $objDentista->getNome(); ?>" <?php echo set_select('dentista',$objDentista->getNome()); ?>>
                      <?php echo $objDentista->getNome(); ?>
                      </option>
                      <?php endforeach; ?>
                      </select>
                    </div>
                  </div>


              

                  <div class="form-group">
                    <label class="col-sm-3 control-label">Paciente</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control input-sm" id="paciente" name="paciente">
                    </div>

                  </div>

                   <div class="form-group">
                    <label class="col-sm-3 control-label">Hora Inicio</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control input-sm" id="hora">
                    </div>

                  </div>

                     <div class="form-group">
                    <label class="col-sm-3 control-label">Hora Término</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control input-sm" id="hora_termino">
                    </div>

                  </div>

                           

                  <!--<div class="form-group">
                    <label class="col-sm-3 control-label">Observação</label>
                    <div class="col-sm-9">
                      <textarea class="form-control input-sm" style="height:55px;" id="descr" name="descr"></textarea>
                    </div>
                  </div>-->

              
              </div>
            </div>
            <div class="modal-footer">
              <a href="#" data-dismiss="modal" aria-hidden="true" class="btn">Fechar Janela</a>          
              <!--<button type="button" class="btn btn-success antosubmit">-->
               <button type="submit" class="btn btn-success">
              <strong><i class="fa fa-calendar"></i> Confirmar</strong></button>
                </form>
            </div>
          </div>
        </div>
      </div>
      
      <div id="CalenderModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel2">Editar Agendamento</h4>
            </div>
            <div class="modal-body">

              <div id="testmodal2" style="padding: 5px 20px;">
                <!--<form id="antoform2" class="form-horizontal calender" role="form">-->
                  <?php echo form_open('agenda/cadastrar',array("class"=>"form-horizontal")); ?>

                    <input type="hidden" class="form-control input-sm" name="start" id="data_inicio">
                    <input type="hidden" class="form-control input-sm" name="end" id="data_final">
                  
                    


                    <div class="form-group">
                    <label class="col-sm-3 control-label">Dentisa</label>
                    <div class="col-sm-9">
                      <select class="form-control input-sm" name="dentista" id="dentista">
                      <option value="">Selecione...</option>
                      <?php foreach ($listDentista as $objDentista): ?>
                      <option value="<?php echo $objDentista->getNome(); ?>" <?php echo set_select('dentista',$objDentista->getNome()); ?>>
                      <?php echo $objDentista->getNome(); ?>
                      </option>
                      <?php endforeach; ?>
                      </select>
                    </div>
                  </div>


              

                  <div class="form-group">
                    <label class="col-sm-3 control-label">Paciente</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control input-sm" id="paciente" name="paciente">
                    </div>

                  </div>

                   <div class="form-group">
                    <label class="col-sm-3 control-label">Hora Inicio</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control input-sm" id="hora">
                    </div>

                  </div>

                     <div class="form-group">
                    <label class="col-sm-3 control-label">Hora Término</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control input-sm" id="hora_termino">
                    </div>

                  </div>

                  
                 
               

                </form>
              </div>
            </div>
            <div class="modal-footer">
              <a href="#" data-dismiss="modal" aria-hidden="true" class="btn">Fechar Janela</a>  
              <!--<button type="button" class="btn btn-danger antosubmit"><strong><i class="fa fa-trash"></i> Cancelar Horário</strong></button>        
              <button type="button" class="btn btn-success antosubmit"><strong><i class="fa fa-calendar"></i> Confirmar</strong></button>-->
            </div>
          </div>
        </div>
      </div>

      <div id="fc_create" data-toggle="modal" data-target="#CalenderModalNew"></div>
      <div id="fc_edit" data-toggle="modal" data-target="#CalenderModalEdit"></div>
                
                <!-- FINAL MODAL -->	


				<!-- ********* FINAL MIOLO **********-->



	</div> <!-- FINAL PANEL -->

	 

</div><!-- FINAL COL --> 

</div><!-- FINAL ROWS -->

</body>
</html>



  <script src="<?= base_url(); ?>js/jquery.min.js"></script>
  <script src="<?= base_url(); ?>js/bootstrap.min.js"></script>

  <script src="<?= base_url(); ?>js/nprogress.js"></script>
  
  <!-- bootstrap progress js -->
  <script src="<?= base_url(); ?>js/progressbar/bootstrap-progressbar.min.js"></script>

  <!-- icheck -->
  <script src="<?= base_url(); ?>js/icheck/icheck.min.js"></script>

  <script src="<?= base_url(); ?>js/custom.js"></script>

  <script src="<?= base_url(); ?>js/moment/moment.min.js"></script>
  <script src="<?= base_url(); ?>js/calendar/fullcalendar.min.js"></script>

<!--<script src="<?= base_url(); ?>js/calendar/pt-br.js"></script> -->

  <!-- pace -->
  <script src="<?= base_url(); ?>js/pace/pace.min.js"></script>
 

  <script>

 

$(window).load(function() {
 

 var id_dentista = "";
 $('#id_dentista').change(function(){
        //$("#myModal").modal();
        var id_dentista = $(this).val();

       // alert(id_dentista);
       //alert($("#id_dentista").val());


 });


      var date = new Date();
      var d = date.getDate();
      var m = date.getMonth();
      var y = date.getFullYear();
      var started;
      var categoryClass;
      var teste = 'DRA AMANDA ENDODONTIA';

     
      
      var calendar = $('#calendar').fullCalendar({
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,agendaWeek,agendaDay'
        },
        monthNames: [

'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
monthNamesShort: [

'Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
dayNames: [

'Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'],
dayNamesShort: [

'Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],

buttonText: {

today:"Hoje",
month:"Mês",
week:"Semana",
day:"Dia"
},


        
         
        selectable: true,
        selectHelper: true,
        editable: true,
        
       events: '<?= site_url("/agenda/ajax_listar/"); ?>', 

        select: function(start, end, allDay) {

          $('#fc_create').click();

          
          started = start;
          ended = end;

          //var inicio = moment(start).format('DD/MM/YYYY hh:mm:ss');
          var inicio = moment(start).format('YYYY-MM-DD hh:mm:ss');
          //var termino = moment(ended).format('DD/MM/YYYY hh:mm');
          var termino = moment(ended).format('YYYY-MM-DD hh:mm:ss');
          var hora_inicio = moment(start).format('hh:mm');
          var hora_fim = moment(ended).format('hh:mm');

          
        
           $("#hora").val(hora_inicio);
           $("#hora_termino").val(hora_fim);
           $("#data_inicio").val(inicio);
           $("#data_final").val(termino);
        

          $(".antosubmit").on("click", function() {
            var title = $("#title").val();
            if (end) {
              ended = end
            }
            categoryClass = $("#event_type").val();

            //if (title) {
              calendar.fullCalendar('renderEvent', {
                  title: title,
                  paciente: paciente,
                  start: started,
                  end: end,
                  allDay: allDay
                },
                true // make the event "stick"
              );
            //}
            $('#title').val('');
            calendar.fullCalendar('unselect');

            $('.antoclose').click();

            return false;
          });
        },
       
       /* eventClick: function(calEvent, jsEvent, view) {

          //alert(calEvent.title, jsEvent, view);

          $('#fc_edit').click();
          $('#title2').val(calEvent.title);
          categoryClass = $("#event_type").val();

          $(".antosubmit2").on("click", function() {
            calEvent.title = $("#title2").val();


            calendar.fullCalendar('updateEvent', calEvent);
            $('.antoclose2').click();
          });
          calendar.fullCalendar('unselect');
        },*/
        
      

      
    
       
      defaultView: 'agendaDay'
        /*events: [{
          title: 'Treinamento de Colaboradores',
          start: new Date(y, m, 1)
        }, {
          title: 'Reunião Equipe',
          start: new Date(y, m, d - 5),
          end: new Date(y, m, d - 2)
        }, {
          title: 'Reunião Equipe',
          start: new Date(y, m, d, 10, 30),
          allDay: false
        }, {
          title: 'Dr. Erica - Paciente: Pedro',
          start: new Date(y, m, d + 14, 12, 0),
          end: new Date(y, m, d, 14, 0),
          allDay: false
        }, {
          title: 'Dr. Eduardo - Paciente: Irlan',
          start: new Date(y, m, d + 1, 19, 0),
          end: new Date(y, m, d + 1, 22, 30),
          allDay: false
        }, {
          title: 'Dr. Gilmar - Paciente: Enzo',
          start: new Date(y, m, 28),
          end: new Date(y, m, 29),
          url: 'http://google.com/'
        }]*/

      });

 });


   

  </script>