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


  //COnsulta para traer la informacion del hongo
      $Id_hongo=$_GET['Id_hongo'];
      $query="SELECT p.Reino,p.Id_hongo,p.status,p.Phyllum,p.Clase,p.Orden,p.Familia,p.Genero,p.Especie,p.ejemplar,u.usuario,h.clave_regis,h.Emplear_tipo,m.Tip_vegetacion,m.Hospedero,c.Descripcion FROM usuarios AS u INNER JOIN hongos AS p ON u.id=p.id INNER JOIN herbario AS h ON h.id_hongo=p.Id_hongo INNER JOIN dat_eco AS m ON m.Id_hongo=p.Id_hongo INNER JOIN citado AS c ON c.Id_hongo=p.Id_hongo WHERE p.Id_hongo='$Id_hongo'";
  
  $resultado=$mysqli->query($query);

     
    

?>

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


    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection">


    <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="js/plugins/jvectormap/jquery-jvectormap.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">
 

</head>

<body >
    <div id="loader-wrapper">
        <div id="loader"></div>        
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
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

                <!--start container-->
                <div class="container">

<div id="modal<?php echo $row['id'];?>" class="modal">
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







   
  


<div class="divider"></div>
<div class="row">

             <div class="col s12 m12 l12">
              <div class="card-panel">
                <h4 class="header2">Editar Hongo</h4>
                <div class="row">
                  <form class="col s12" method="POST" name="modificar_hongo" method="POST" action="php/mod_hongo.php" >
                  <?php while($row = $resultado->fetch_assoc()){ ?>
                                       <input type="hidden" name="Id_hongo" value="<?php echo $Id_hongo; ?>"> 
                   
                      <div class="input-field col s12 l6">
                        <input id="Reino" name="Reino" type="text" value="<?php echo $row['Reino']; ?>">
                        <label for="first_name">Reino</label>
                      </div>
                  
                    
                      <div class="input-field col s12 l6">
                        <input id="Phyllum" name="Phyllum" type="text" value="<?php echo $row['Phyllum']; ?>">
                        <label for="first_name">Phyllum</label>
                      </div>
                 
           
                      <div class="input-field col s12 l6">
                        <input id="Clase" name="Clase" type="text" value="<?php echo $row['Clase']; ?>">
                        <label for="first_name">Clase</label>
                      </div>
               
                      <div class="input-field col s12 l6">
                        <input id="Orden" name="Orden" type="text" value="<?php echo $row['Orden']; ?>">
                        <label for="first_name">Orden</label>
                      </div>
                 
                      <div class="input-field col s12 l6">
                        <input id="Familia" name="Familia" type="text" value="<?php echo $row['Familia']; ?>">
                        <label for="first_name">Familia</label>
                      </div>
                  
                      <div class="input-field col s12 l6">
                        <input id="Genero" name="Genero" type="text" value="<?php echo $row['Genero']; ?>">
                        <label for="first_name">Genero</label>
                      </div>
                  
                      <div class="input-field col s12 l6">
                        <input id="Especie" name="Especie" type="text" value="<?php echo $row['Especie']; ?>">
                        <label for="first_name">Especie</label>
                      </div>
                         <div class="input-field col s12 l6">
                        <input id="ejemplar" name="ejemplar" type="text" value="<?php echo $row['ejemplar']; ?>">
                        <label for="first_name">Observaciones</label>
                      </div>
                   
                      <div class="input-field col s12 l6">
                        <input id="clave_regis" name="clave_regis" type="text" value="<?php echo $row['clave_regis']; ?>">
                        <label for="first_name">Clave de herbario</label>
                      </div>
                    <div class="input-field col s12 l6">
                        <input id="Emplear_tipo" name="Emplear_tipo" type="text" value="<?php echo $row['Emplear_tipo']; ?>">
                        <label for="first_name">Herbario del ejemplar</label>
                      </div>
                       <div class="input-field col s12 l6">
                        <input id="Tip_vegetacion" name="Tip_vegetacion" type="text" value="<?php echo $row['Tip_vegetacion']; ?>">
                        <label for="first_name">Tipo de vegetacion</label>
                      </div>
                       <div class="input-field col s12 l6">
                        <input id="Hospedero" name="Hospedero" type="text" value="<?php echo $row['Hospedero']; ?>">
                        <label for="first_name">Hospedero</label>
                      </div>
                       <div class="input-field col s12 l6">
                        <input id="Descripcion" name="Descripcion" type="text" value="<?php echo $row['Descripcion']; ?>">
                        <label for="first_name">libro citado</label>
                      </div>

                    
                   
                     <?php }?>

                    <div class="row">
                      <div class="row">
                        <div class="input-field col s12">
                          <button class="btn cyan waves-effect waves-light right" name="Guardar" value="Guardar" >Submit
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
                <!--end container-->
            </section>
            <!-- END CONTENT -->

            <!-- //////////////////////////////////////////////////////////////////////////// -->
            <!-- START RIGHT SIDEBAR NAV-->
          <!--  <aside id="right-sidebar-nav">
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
            </aside>
            -->
            <!-- LEFT RIGHT SIDEBAR NAV-->

                  
     
    

        </div>
        <!-- END WRAPPER -->

    </div>
    <!-- END MAIN -->



    <!-- //////////////////////////////////////////////////////////////////////////// -->

    <!-- START FOOTER -->
    <footer class="page-footer">
        <div class="container">
            <div class="row">
               <!-- <div class="col l6 s12">
                    <h5 class="white-text">World Market</h5>
                    <p class="grey-text text-lighten-4">World map, world regions, countries and cities.</p>
                    <div id="world-map-markers"></div>
                </div>
                <div class="col l4 offset-l2 s12">
                    <h5 class="white-text">Sales by Country</h5>
                    <p class="grey-text text-lighten-4">A sample polar chart to show sales by country.</p>
                    <div id="polar-chart-holder">
                        <canvas id="polar-chart-country" width="200"></canvas>
                    </div>
                </div>
                -->
            </div>
        </div>
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
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
       

    <!-- chartist -->
    <script type="text/javascript" src="js/plugins/chartist-js/chartist.min.js"></script>   

    <!-- chartjs -->
    <script type="text/javascript" src="js/plugins/chartjs/chart.min.js"></script>
    <script type="text/javascript" src="js/plugins/chartjs/chart-script.js"></script>

    <!-- sparkline -->
    <script type="text/javascript" src="js/plugins/sparkline/jquery.sparkline.min.js"></script>
    <script type="text/javascript" src="js/plugins/sparkline/sparkline-script.js"></script>
    
    <!--jvectormap-->
    <script type="text/javascript" src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script type="text/javascript" src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script type="text/javascript" src="js/plugins/jvectormap/vectormap-script.js"></script>
    
    
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js/plugins.js"></script>
    <!-- Toast Notification -->
    <script type="text/javascript">
    // Toast Notification
    $(window).load(function() {
        setTimeout(function() {
            Materialize.toast('<span>Hiya! I am a toast.</span>', 1500);
        }, 3000);
        setTimeout(function() {
            Materialize.toast('<span>You can swipe me too!</span>', 3000);
        }, 5500);
        setTimeout(function() {
            Materialize.toast('<span>You have new order.</span><a class="btn-flat yellow-text" href="#">Read<a>', 3000);
        }, 18000);
    });
    
    </script>
</body>

</html>

    
    
