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


  <script src="<?= base_url(); ?>js/jquery.min.js"></script>

  <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body style="background:#F7F7F7;">

  <div class="">
    <a class="hiddenanchor" id="toregister"></a>
    <a class="hiddenanchor" id="tologin"></a>
    <a class="hiddenanchor" id="toerro"></a>

    <div id="wrapper">
      <div id="login" class="animate form">
        <section class="login_content">
          <?= validation_errors(); ?>


          <?php if($flag_email!=false){ ?>
          <div class="alert alert-success alert-dismissible fade in" role="alert"  id="msgOk">
          <strong></strong>Enviamos um email com os dados de recuperação da sua senha.
          </div>
          <?php } ?>

   

         <?= form_open("login"); ?>

            <img src="<?= base_url(); ?>/img/logo.png" width="150px;" />
         <br />
         <br />
            <h1>Acesso Sistema</h1>
            <div>
              <input type="text" name="login" class="form-control" placeholder="login" required="" />
            </div>
            <div>
              <input type="password" name="senha" class="form-control" placeholder="senha de acesso" required="" />
            </div>
            <div>
             <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Entrar</button>
              <a href="#toregister" class="to_register">Esqueci minha senha?</a>
            </div>

            <div class="clearfix"></div>
            <div class="separator">

              <!--<p class="change_link">New to site?
                <a href="#toregister" class="to_register"> Create Account </a>
              </p>-->
              <div class="clearfix"></div>
              <br />
             
             <!-- <div>
                <h1><i class="fa fa-paw" style="font-size: 26px;"></i> Gentelella Alela!</h1>

                <p>©2015 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
              </div>-->


            </div>
          </form>
          <!-- form -->
        </section>
        <!-- content -->
      </div>
      



      <div id="register" class="animate form">
        <section class="login_content">
         <?php echo form_open('email/recuperar',array("onsubmit"=>"return validate()")); ?>
            <h1>Recuperar Senha</h1>


          <?php if(isset($_REQUEST['teste'])) { ?>
          <div class="alert alert-danger alert-dismissible fade in" role="alert"  id="msgOk">
          <strong></strong>Email não encontrado, por favor entre em contato com o administrador do sistema.
          </div>
          <?php } ?>
           
            <div>
              <input type="email" name="email" class="form-control" placeholder="Email" required="" />
            </div>
           
            <div>
              <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>Enviar</button>
            </div>
            <div class="clearfix"></div>
            <div class="separator">

              <p class="change_link">
                <a href="#tologin" class="to_register">Acessar Tela de Login</a>
              </p>
              <div class="clearfix"></div>
              <br />
              
              <!--<div>
                <h1><i class="fa fa-paw" style="font-size: 26px;"></i> Gentelella Alela!</h1>

                <p>©2015 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
              </div>-->

            </div>
          </form>
          <!-- form -->
        </section>
        <!-- content -->
      </div>
    </div>
  </div>

</body>

</html>
