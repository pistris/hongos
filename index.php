<?php
    require('php/conexion.php');

    session_start();

    if(isset($_SESSION["num_usuario"])){
        header("Location: dash.php");
    }

  if(!empty($_POST))
  {
    $usuario = mysqli_real_escape_string($mysqli,$_POST['usuario']);
    $password = mysqli_real_escape_string($mysqli,$_POST['password']);
    $error = '';
    
    $sha1_pass = sha1($password);
    
    $sql = "SELECT id, id_tipo FROM usuarios WHERE usuario = '$usuario' AND password = '$sha1_pass'";
    $result=$mysqli->query($sql);
    $rows = $result->num_rows;
    
    if($rows > 0) {
      $row = $result->fetch_assoc();
      $_SESSION['id_usuario'] = $row['id'];
      $_SESSION['tipo_usuario'] = $row['id_tipo'];
      
      header("location: dash.php");
      } else {
      $error = "El nombre o contraseña son incorrectos";
    }
  }
?>
<!DOCTYPE html>
<html lang="en">

<!--================================================================================
	Item Name: Materialize - Material Design Admin Template
	Version: 1.0
	Author: GeeksLabs
	Author URL: http://www.themeforest.net/user/geekslabs
================================================================================ -->

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
  <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
  <title>Login Page | Materialize - Material Design Admin Template</title>

  <!-- Favicons-->
  <link rel="icon" href="images/favicon/favicon-32x32.png" sizes="32x32">
  <!-- Favicons-->
  <link rel="apple-touch-icon-precomposed" href="images/favicon/apple-touch-icon-152x152.png">
  <!-- For iPhone -->
  <meta name="msapplication-TileColor" content="#00bcd4">
  <meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">
  <!-- For Windows Phone -->


  <!-- CORE CSS-->
  
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/page-center.css" type="text/css" rel="stylesheet" media="screen,projection">

  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="css/prism.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
  
</head>

<body class="cyan">
  <!-- Start Page Loading -->
  <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
  <!-- End Page Loading -->



  <div id="login-page" class="row">
    <div class="col s12 z-depth-4 card-panel">
      <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="login-form">
        <div class="row">
          <div class="input-field col s12 center">
            <img src="images/favicon/mushroom.png" alt="" class="circle responsive-img valign profile-image-login">
            <p class="center login-form-text">Repositorio Digital de Hongos de Oaxaca</p>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-social-person-outline prefix"></i>
            <input id="usuario" name="usuario" type="text">
            <label for="username" class="center-align">Username</label>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="password" name="password" type="password">
            <label for="password">Password</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12 center">
           <button class="btn btn-block bg-pink waves-effect" type="submit">INICIAR</button>
          </div>
        </div>
         <div class="input-field col s12">
            <p class="margin center medium-small sign-up"><a href="registo.php">REGISTRARSE</a></p>
          </div>
      </form>
      
    </div>
      <div style = "font-size:14px; color:#ca006e;"><center><?php echo isset($error) ? utf8_decode($error) : '' ; ?></center>
            </div>
  </div>



  <!-- ================================================
    Scripts
    ================================================ -->

  <!-- jQuery Library -->
  <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
  <!--materialize js-->
  <script type="text/javascript" src="js/materialize.js"></script>
  <!--prism-->
  <script type="text/javascript" src="js/prism.js"></script>
  <!--scrollbar-->
  <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>

  <!--plugins.js - Some Specific JS codes for Plugin Settings-->
  <script type="text/javascript" src="js/plugins.js"></script>

</body>

</html>