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

  $errors = '';
  $resultado = 0;

    $permitidos = array("image/jpeg");
    $limite_kb = 16384;

  $id=$_POST['id'];
  $nombre=$_POST['nombre'];
  $apellidos=$_POST['apellidos'];
  $institucion=$_POST['institucion'];
  $correo=$_POST['correo'];
   $img_perfil=$_POST['id'];

   

  $query="UPDATE personal SET nombre='$nombre', apellidos='$apellidos', institucion='$institucion', correo='$correo', imgperfil='$img_perfil'  WHERE id='$id'";
    $resultado=$mysqli->query($query);


  if ( ! isset($_FILES["imagen"]) || $_FILES["imagen"]["error"] > 0){
    

    
    } else {  
    
    if (in_array($_FILES['imagen']['type'], $permitidos) && $_FILES['imagen']['size'] <= $limite_kb * 1024){

   $info_img = pathinfo($_FILES['imagen']['name']);
  
  copy($_FILES['imagen']['tmp_name'],"imgperfil/".$id.'.'.$info_img['extension']);
      
      } else {
      $errors = "archivo no permitido, es tipo de archivo prohibido o excede el tamano de $limite_kb Kilobytes";
    }
}
  
?>
       
<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="Es una pagina dedicada a la micologia">
    <meta name="keywords" content="oaxaca,hongos,itvo">
    <title>Hongos|Bienvenido <?php echo ($row['nombre']); ?> </title>

    <link rel="icon" href="images/favicon/mushroom.png" sizes="32x32">
    <link rel="apple-touch-icon-precomposed" href="images/favicon/mushroom.png">
    <meta name="msapplication-TileColor" content="#00bcd4">
    <meta name="msapplication-TileImage" content="images/favicon/mushroom.png">


    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection">


    <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="js/plugins/jvectormap/jquery-jvectormap.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">
 

</head>

<body >
    
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


    <div id="main">
        <div class="wrapper">

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
        
        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper" class=" grey lighten-3">
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title"></h5>
                <ol class="breadcrumb">
                    <li><a href="dash.php">Dashboard</a></li>
                  
                    <li class="active">modificar perfil</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->
        

        <!--start container-->
        <div class="container">
          <div class="section">
 <a href="dash.php">Regresar a inicio</a>
            <p class="caption">El usuario fue modificado.</p>
             <?php 
        if($resultado>0){
        ?>
        
        <h1>Usuario Modificado</h1>
        
          <?php   }else{ ?>
        
        <h1><?php echo $errors; ?></h1>
        
      <?php } ?>
      
      <p></p> 
    
     
      
    
      

            <div class="divider"></div>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
          </div>
        </div>
        <!--end container-->
      </section>
      <!-- END CONTENT -->

      <!-- //////////////////////////////////////////////////////////////////////////// -->
      <!-- START RIGHT SIDEBAR NAV-->
      <!-- <aside id="right-sidebar-nav">
        <ul id="chat-out" class="side-nav rightside-navigation">
            <li class="li-hover">
            <a href="#" data-activates="chat-out" class="chat-close-collapse right"><i class="mdi-navigation-close"></i></a>
            <div id="right-search" class="row">
                <form class="col s12">
                    <div class="input-field">
                        <i class="mdi-action-search prefix"></i>
                        <input id="icon_prefix" type="text" class="validate">
                        <label for="icon_prefix">Search</label>
                    </div>
                </form>
            </div>
            </li>
            <li class="li-hover">
                <ul class="chat-collapsible" data-collapsible="expandable">
                <li>
                    <div class="collapsible-header teal white-text active"><i class="mdi-social-whatshot"></i>Recent Activity</div>
                    <div class="collapsible-body recent-activity">
                        <div class="recent-activity-list chat-out-list row">
                            <div class="col s3 recent-activity-list-icon"><i class="mdi-action-add-shopping-cart"></i>
                            </div>
                            <div class="col s9 recent-activity-list-text">
                                <a href="#">just now</a>
                                <p>Jim Doe Purchased new equipments for zonal office.</p>
                            </div>
                        </div>
                        <div class="recent-activity-list chat-out-list row">
                            <div class="col s3 recent-activity-list-icon"><i class="mdi-device-airplanemode-on"></i>
                            </div>
                            <div class="col s9 recent-activity-list-text">
                                <a href="#">Yesterday</a>
                                <p>Your Next flight for USA will be on 15th August 2015.</p>
                            </div>
                        </div>
                        <div class="recent-activity-list chat-out-list row">
                            <div class="col s3 recent-activity-list-icon"><i class="mdi-action-settings-voice"></i>
                            </div>
                            <div class="col s9 recent-activity-list-text">
                                <a href="#">5 Days Ago</a>
                                <p>Natalya Parker Send you a voice mail for next conference.</p>
                            </div>
                        </div>
                        <div class="recent-activity-list chat-out-list row">
                            <div class="col s3 recent-activity-list-icon"><i class="mdi-action-store"></i>
                            </div>
                            <div class="col s9 recent-activity-list-text">
                                <a href="#">Last Week</a>
                                <p>Jessy Jay open a new store at S.G Road.</p>
                            </div>
                        </div>
                        <div class="recent-activity-list chat-out-list row">
                            <div class="col s3 recent-activity-list-icon"><i class="mdi-action-settings-voice"></i>
                            </div>
                            <div class="col s9 recent-activity-list-text">
                                <a href="#">5 Days Ago</a>
                                <p>Natalya Parker Send you a voice mail for next conference.</p>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header light-blue white-text active"><i class="mdi-editor-attach-money"></i>Sales Repoart</div>
                    <div class="collapsible-body sales-repoart">
                        <div class="sales-repoart-list  chat-out-list row">
                            <div class="col s8">Target Salse</div>
                            <div class="col s4"><span id="sales-line-1"></span>
                            </div>
                        </div>
                        <div class="sales-repoart-list chat-out-list row">
                            <div class="col s8">Payment Due</div>
                            <div class="col s4"><span id="sales-bar-1"></span>
                            </div>
                        </div>
                        <div class="sales-repoart-list chat-out-list row">
                            <div class="col s8">Total Delivery</div>
                            <div class="col s4"><span id="sales-line-2"></span>
                            </div>
                        </div>
                        <div class="sales-repoart-list chat-out-list row">
                            <div class="col s8">Total Progress</div>
                            <div class="col s4"><span id="sales-bar-2"></span>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header red white-text"><i class="mdi-action-stars"></i>Favorite Associates</div>
                    <div class="collapsible-body favorite-associates">
                        <div class="favorite-associate-list chat-out-list row">
                            <div class="col s4"><img src="images/avatar.jpg" alt="" class="circle responsive-img online-user valign profile-image">
                            </div>
                            <div class="col s8">
                                <p>Eileen Sideways</p>
                                <p class="place">Los Angeles, CA</p>
                            </div>
                        </div>
                        <div class="favorite-associate-list chat-out-list row">
                            <div class="col s4"><img src="images/avatar.jpg" alt="" class="circle responsive-img online-user valign profile-image">
                            </div>
                            <div class="col s8">
                                <p>Zaham Sindil</p>
                                <p class="place">San Francisco, CA</p>
                            </div>
                        </div>
                        <div class="favorite-associate-list chat-out-list row">
                            <div class="col s4"><img src="images/avatar.jpg" alt="" class="circle responsive-img offline-user valign profile-image">
                            </div>
                            <div class="col s8">
                                <p>Renov Leongal</p>
                                <p class="place">Cebu City, Philippines</p>
                            </div>
                        </div>
                        <div class="favorite-associate-list chat-out-list row">
                            <div class="col s4"><img src="images/avatar.jpg" alt="" class="circle responsive-img online-user valign profile-image">
                            </div>
                            <div class="col s8">
                                <p>Weno Carasbong</p>
                                <p>Tokyo, Japan</p>
                            </div>
                        </div>
                        <div class="favorite-associate-list chat-out-list row">
                            <div class="col s4"><img src="images/avatar.jpg" alt="" class="circle responsive-img offline-user valign profile-image">
                            </div>
                            <div class="col s8">
                                <p>Nusja Nawancali</p>
                                <p class="place">Bangkok, Thailand</p>
                            </div>
                        </div>
                    </div>
                </li>
                </ul>
            </li>
        </ul>
      </aside> -->
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