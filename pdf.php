<?php
  
   @session_start();
    require('php/conexion.php');
    
    if(!isset($_SESSION["id_usuario"])){
        header("Location: index.php");
    }
       $idUsuario = $_SESSION['id_usuario'];
     $sql = "SELECT u.id, p.nombre, p.apellidos,p.imgperfil,u.usuario,u.id_tipo,u.status,p.correo,p.institucion,p.fecha FROM usuarios AS u INNER JOIN personal AS p ON u.id_personal=p.id WHERE u.id = '$idUsuario'";
    
    $result=$mysqli->query($sql);
    $row = $result->fetch_assoc();


      $query="SELECT * FROM personal WHERE id='$idUsuario'";
  
  $resultado=$mysqli->query($query);
     
    

?>

<!DOCTYPE html>
<html lang="en">

<!--================================================================================
  Item Name: Materialize - Material Design Admin Template
  Version: 1.0
  Author: GeeksLabs
  Author URL: http://www.themeforest.net/user/geekslabs
================================================================================ -->

<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
    <meta name="keywords" content="oaxaca,hongos,itvo">
    <title>Hongos|Bienvenido <?php echo ($row['nombre']); ?> </title>

    <link rel="icon" href="images/favicon/mushroom.png" sizes="32x32">
    <link rel="apple-touch-icon-precomposed" href="images/favicon/mushroom.png">
    <meta name="msapplication-TileColor" content="#00bcd4">
    <meta name="msapplication-TileImage" content="images/favicon/mushroom.png">
  <!-- For Windows Phone -->


  <!-- CORE CSS-->
  
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection">


  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="css/prism.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">
 <!--  <script>
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
      
      function validarTipoUsuario()
      {
        indice = document.getElementById("tipo_usuario").selectedIndex;
        if( indice == null || indice==0 ) {
          alert('Seleccione tipo de usuario');
          return false;
        } else { return true;}
      }
      
      function validar()
      {
        if(validarNombre() && validarUsuario() && validarPassword() && validarTipoUsuario())
        {
          document.registro.submit();
        }
      }
      
    </script>
 --></head>

<body>
  <!-- Start Page Loading -->
<!--   <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div> -->
  <!-- End Page Loading -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START HEADER -->
 <header id="header" class="page-topbar">
        <div class="navbar-fixed">
            <nav class="cyan">
                <div class="nav-wrapper">
                    <h1 class="logo-wrapper"><a href="dash.php" class="brand-logo darken-1"><img src="images/materialize-logo.png" alt="materialize logo"></a> <span class="logo-text">Hongos de Oaxaca</span></h1>
                    <ul class="right hide-on-med-and-down">
                        <li class="search-out">
                            <input type="text" class="search-out-text">
                        </li>
                        <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light toggle-fullscreen"><i class="mdi-action-settings-overscan"></i></a>
                        </li>
                       
                    </ul>
                </div>
            </nav>
        </div>
    </header>
  <!-- END HEADER -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START MAIN -->
  <div id="main">
    <!-- START WRAPPER -->
    <div class="wrapper">

      <!-- START LEFT SIDEBAR NAV-->
      <aside id="left-sidebar-nav">
                <ul id="slide-out" class="side-nav fixed leftside-navigation">
                    <li class="user-details cyan darken-2">
                        <div class="row">
                            <div class="col col s4 m4 l4">
                                <img src="imgperfil/<?php echo $row['imgperfil'].'.jpg'?>" alt="" class="circle responsive-img valign profile-image">
                            </div>
                            <div class="col col s8 m8 l8">
                                <ul id="profile-dropdown" class="dropdown-content">
                                     <li><a class="modal-trigger" data-target="modal<?php echo $row['id'];?>">
                                      <i class="mdi-action-face-unlock"></i> Perfil</a>
                                    </li>
                                    <li><a href="editarperfil.php"><i class="mdi-action-settings"></i> Settings</a>
                                    </li>
                                 
                                    <li class="divider"></li>
                                   
                                    <li><a href="php/login/logout.php"><i class="mdi-hardware-keyboard-tab"></i> Logout</a>
                                    </li>
                                </ul>
                                <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown"><?php echo ($row['nombre']); ?> <?php echo ($row['apellidos']); ?><i class="mdi-navigation-arrow-drop-down right"></i></a>
                                <p class="user-roal">    <?php if($_SESSION['tipo_usuario']==1) { ?>
                                    Administrador
                                 <?php } else{echo "Usuario";}?></p>
                            </div>
                        </div>
                    </li>
                    <li class="active"><a href="dash.php" class="waves-effect waves-cyan"><i class="mdi-action-home"></i> Dashboard</a>
                    </li>
              
                    <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                         
                                  <?php if($_SESSION['tipo_usuario']==1) { ?>
                                    <li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i class="mdi-action-account-child"></i>Usuarios</a>
                                <div class="collapsible-body">
                                    <ul>
                                        <li class="bold"><a href="registro.php" class="waves-effect waves-cyan"><i class="mdi-social-person-add"></i>Agregar Usuario</a>
                                        </li>
                                           
                                    <li class="bold"><a href="usuarios.php" class="waves-effect waves-cyan"><i class="mdi-social-group"></i> Usuarios </a>
                                    </li>
                            
                                  <!-- termina session -->
                                    </ul>
                                </div>
                            </li>
                                    <?php } ?>
                            
                            <li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i class="mdi-navigation-expand-more"></i> Hongos</a>
                                <div class="collapsible-body">
                                    <ul>
                                       <li class="bold"><a href="RegistrarHongo.php" class="waves-effect waves-cyan"><i class="mdi-image-add-to-photos"></i>Agregar Hongo</a>
                                        </li>
                                      <?php if($_SESSION['tipo_usuario']==1) { ?>        
                                    <li class="bold"><a href="hongos.php" class="waves-effect waves-cyan"><i class="mdi-image-nature"></i> Hongos </a>
                                    </li>
                                      <li class="bold"><a href="hongosI.php" class="waves-effect waves-cyan"><i class="mdi-action-spellcheck"></i>Aprobar Hongos</a>
                                    </li>    <?php } ?>
                                      <li class="bold"><a href="hongousuario.php" class="waves-effect waves-cyan"><i class="mdi-action-speaker-notes"></i>Mis hongos</a>
                                    </li>
                                    </ul>
                                </div>
                            </li>
                       
                               <li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i class="mdi-file-folder-open"></i> Documentos</a>
                                <div class="collapsible-body">
                                    <ul>
                                       <li class="bold"><a href="pdf.php" class="waves-effect waves-cyan"><i class="mdi-file-file-upload"></i>Cargar PDF</a>
                                        </li>
                                           
                                    <li class="bold"><a href="documentos.php" class="waves-effect waves-cyan"><i class="mdi-file-attachment"></i> Documentos </a>
                                    </li>
                                    </ul>
                                </div>
                            </li>
                       
                       
                        </ul>
                    </li>
                           
                    <li class="li-hover"><div class="divider"></div></li>
                    
                </ul>
                <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only darken-2"><i class="mdi-navigation-menu" ></i></a>
            </aside>
      <!-- END LEFT SIDEBAR NAV-->

      <!-- //////////////////////////////////////////////////////////////////////////// -->

      <!-- START CONTENT -->
      <section id="content">


        <div class="container"><div id="modal<?php echo $row['id'];?>" class="modal">
                        <div class="col s12 m12 l12">
                 
                  <div id="profile-card" class="card">
                    <div class="card-image waves-effect waves-block waves-light">
                      <img class="activator" src="images/user-bg.jpg" alt="user bg">
                    </div>
                    <div class="card-content">
                      <img src="imgperfil/<?php echo $row['id'].'.jpg'?>" alt="Agregue  foto de Perfil" class="circle responsive-img activator card-profile-image">
                      <a class="btn-floating activator btn-move-up waves-effect waves-light darken-2 right">
                        <i class="mdi-editor-mode-edit"></i>
                      </a>

                      <span class="card-title activator grey-text text-darken-4"><?php echo $row['nombre']?> <?php echo $row['apellidos']?></span>
                      <p><i class="mdi-action-perm-identity"></i> <?php if($_SESSION['tipo_usuario']==1) { ?>
                                    Administrador
                                 <?php } else{echo "Usuario";}?></p>
                      <p><i class="mdi-action-perm-phone-msg"></i> +1 (612) 222 8989</p>
                      <p><i class="mdi-communication-email"></i> <?php echo $row['correo']?></p>

                    </div>
                    <div class="card-reveal">
                      <span class="card-title grey-text text-darken-4"><?php echo $row['nombre']?> <?php echo $row['apellidos']?> <i class="mdi-navigation-close right"></i></span>
                      <p>Here is some more information about this card.</p>
                      <p><i class="mdi-action-perm-identity"></i> <?php if($_SESSION['tipo_usuario']==1) { ?>
                                    Administrador
                                 <?php } else{echo "Usuario";}?></p>
                      <p><i class="mdi-action-perm-phone-msg"></i> +1 (612) 222 8989</p>
                      <p><i class="mdi-communication-email"></i> <?php echo $row['correo']?></p>
                      <p><i class="mdi-social-cake"></i> <?php echo $row['fecha']?>
                        </p>
                          <p>numero de aportaciones<h5><?php 

 $mysqli = new mysqli("localhost","root", "", "hongo");
$query = $mysqli->prepare("SELECT * FROM hongos WHERE ID='$row[id]'");
$query->execute();
$query->store_result();

$resultados = $query->num_rows;

echo $resultados;


                          ?>
                          </h5>  </p>
                    </div>
                  </div>
                </div>
    </div>
          <div class="section">

        
<br>
  

          <!--Form Advance-->          
          <div class="row">
            <div class="col s12 m12 l12">
            <a href="dash.php" class="btn-floating activator btn-move-up waves-effect waves-light darken-2 right"><i class="mdi-content-clear"></i></a>
              <div class="card-panel">
                <h4 class="header2">Formuladrio para agregar pdf</h4>
                <div class="row">
                  <form class="col s12" name="modificar_usuario" method="POST" action="agregarpdf.php" enctype="multipart/form-data">

                   <input type="hidden" name="id" value="<?php echo $row['id']; ?>"> 
                     <div class="row">
                      <div class="input-field col s12">
                        <input id="nombre" type="text" name="nombre" value="">
                        <label for="first_name">Titulo del pdf</label>
                      </div>
                    
                      <div class="input-field col s12">
                        <input id="apellidos" type="text" name="apellidos" value="">
                        <label for="last_name">Autor</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="file-field input-field col s6">
                        <input class="file-path validate" type="text"/>
                        <div class="btn">
                          <span>Subir</span>
                          <input type="file" name="imagen" id="imagen" accept="application/pdf" />
                        </div>
                      </div>
                      </div>
               
                    
                    <div class="row">
                      <div class="row">
                        <div class="input-field col s12">
                          <button class="btn cyan waves-effect waves-light right" type="submit" name="Guardar" value="Guardar" >Guardar
                            <i class="mdi-content-send right"></i>

                          </button>
                        </div>
                      </div>
                    </div>
                  </form>
                    
                </div>
              </div>
            </div>
          </div>
      </div>
  </section>
  <!-- END CONTENT -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->
  <!-- START RIGHT SIDEBAR NAV-->
  
  <!-- LEFT RIGHT SIDEBAR NAV-->

  </div>
  <!-- END WRAPPER -->

  </div>
  <!-- END MAIN -->



  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START FOOTER -->
 <footer class="page-footer cyan lighten-1">
        <div class="container">
            <div class="row">
              
            </div>
        </div>
        <div class="footer-copyright cyan lighten-2">
            <div class="container cyan lighten-2">
                Copyright © 2017 <a class="grey-text text-lighten-4" href="http://themeforest.net/user/geekslabs/portfolio?ref=geekslabs" target="_blank">Instituto Tecnologico del Valle de Oaxaca</a> 
                <span class="right">  <a class="grey-text text-lighten-4" href="http://geekslabs.com/">Acnologia</a></span>
            </div>
        </div>
    </footer>
  <!-- END FOOTER -->



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
    <!-- chartist -->
    <script type="text/javascript" src="js/plugins/chartist-js/chartist.min.js"></script>   
    
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js/plugins.js"></script>
    
</body>

</html>