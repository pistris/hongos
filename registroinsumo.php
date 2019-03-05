<?php
  
  
  require 'php/conexion.php';
  
  
  $bandera = false;
  
  if(!empty($_POST))
  {
    $nombre = mysqli_real_escape_string($mysqli,$_POST['nombre']);
    $usuario = mysqli_real_escape_string($mysqli,$_POST['usuario']);
    $password = mysqli_real_escape_string($mysqli,$_POST['password']);
    $sha1_pass = sha1($password);
    
    $error = '';
    
    $sqlUser = "SELECT id FROM usuarios WHERE usuario = '$usuario'";
    $resultUser=$mysqli->query($sqlUser);
    $rows = $resultUser->num_rows;
    
    if($rows > 0) {
      $error = "El usuario ya existe";
      } else {
      
      $sqlPerson = "INSERT INTO personal (nombre) VALUES('$nombre')";
      $resultPerson=$mysqli->query($sqlPerson);
      $idPersona = $mysqli->insert_id;
      
      $sqlUsuario = "INSERT INTO usuarios (usuario, password, id_personal, id_tipo) VALUES('$usuario','$sha1_pass','$idPersona',2)";
      $resultUsuario = $mysqli->query($sqlUsuario);
      
      if($resultUsuario>0)
      $bandera = true;
      else
      $error = "Error al Registrar";
      
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
  <title>Register Page | Materialize - Material Design Admin Template</title>

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
    <script>
      function validarNombre()
      {
        valor = document.getElementById("nombre").value;
        if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
          alert('Falta Llenar Nombre');
          return false;
        } else { return true;}
      }
      
      function validarUsuario()
      {
        valor = document.getElementById("usuario").value;
        if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
          alert('Falta Llenar Usuario');
          return false;
        } else { return true;}
      }
      
      function validarPassword()
      {
        valor = document.getElementById("password").value;
        if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
          alert('Falta Llenar Password');
          return false;
          } else { 
          valor2 = document.getElementById("con_password").value;
          
          if(valor == valor2) { return true; }
          else { alert('Las contraseña no coinciden'); return false;}
        }
      }
      
      
      
      function validar()
      {
        if(validarNombre() && validarUsuario() && validarPassword())
        {
          document.registro.submit();
        }
      }
      
    </script>
  
  
</head>

<body class="cyan">
  <!-- Start Page Loading -->
  <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
  <!-- End Page Loading -->
<?php if($bandera) { ?>
      <h3>Registro exitoso</h3>
           
      <?php }else{ ?>

    <?php } ?>


  <div id="login-page" class="row">
    <div class="col s12 z-depth-4 card-panel">
      <form id="registro" name="registro" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST"  class="login-form">
        <div class="row">
          <div class="input-field col s12 center">
            <h4>Registro</h4>
            <p class="center">Introdusca sus datos </p>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-social-person-outline prefix"></i>
            <input id="nombre" name="nombre" type="text" >
            <label for="username" class="center-align">Nombre</label>
          </div>
             <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-social-person-outline prefix"></i>
            <input id="usuario" name="usuario" type="text" >
            <label for="username" class="center-align">Nombre de Usuario</label>
          </div>
        </div>
        <!-- <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-communication-email prefix"></i>
            <input id="email" type="email">
            <label for="email" class="center-align">Email</label>
          </div>
        </div> -->
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="password" name="password" type="password">
            <label for="password">Password</label>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="con_password" name="con_password" type="password">
            <label for="password-again">Confirme Password </label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
  <input href="index.php"  class="waves-effect waves-light col s12 waves-input-wrapper" value="Registrar" name="registar" type="button"  onClick="validar();">

          </div>
          <div class="input-field col s12">
            <p class="margin center medium-small sign-up">Ya se encuentra registrado?<a href="index.php">Login</a></p>
          </div>
        </div>
      </form>
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