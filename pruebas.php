<?php
    @session_start();
    require('php/conexion.php');
    
    if(!isset($_SESSION["id_usuario"])){
        header("Location: index.php");
    }
    
    $idUsuario = $_SESSION['id_usuario'];
    
  $sql = "SELECT u.id, p.nombre, p.apellidos,p.imgperfil FROM usuarios AS u INNER JOIN personal AS p ON u.id_personal=p.id WHERE u.id = '$idUsuario'";
    $result=$mysqli->query($sql);
    $row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
		<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
    <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
    <title>Hongos - Repositorio digital de hongos de Oaxaca</title>

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


    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->    
    <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="js/plugins/jvectormap/jquery-jvectormap.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">
 <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script> <!-- Integramos jQuery-->
	<script src="js/script.js"></script> <!-- Integramos nuestro script que contendra nuestras funciones Javascript-->
		<script src="includes/js.js"></script>
		<script type="text/javascript">
function Mostrar(id) {
   var ele = document.getElementById(id);
   if (ele.style.display == "block") { ele.style.display = "none"; }
   else { ele.style.display = "block"; }
}

</script>
	</head>
	
	<body onload="getEstado();">
	<header id="header" class="page-topbar">
        <!-- start header nav-->
        <div class="navbar-fixed">
            <nav class="cyan">
                <div class="nav-wrapper">
                    <h1 class="logo-wrapper"><a href="index.html" class="brand-logo darken-1"><img src="images/materialize-logo.png" alt="materialize logo"></a> <span class="logo-text">Materialize</span></h1>
                    <ul class="right hide-on-med-and-down">
                        <li class="search-out">
                            <input type="text" class="search-out-text">
                        </li>
                        <li>    
                            <a href="javascript:void(0);" class="waves-effect waves-block waves-light show-search"><i class="mdi-action-search"></i></a>                              
                        </li>
                        <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light toggle-fullscreen"><i class="mdi-action-settings-overscan"></i></a>
                        </li>
                        <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light"><i class="mdi-social-notifications"></i></a>
                        </li>
                        <!-- Dropdown Trigger -->                        
                        <li><a href="#" data-activates="chat-out" class="waves-effect waves-block waves-light chat-collapse"><i class="mdi-communication-chat"></i></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- end header nav-->
    </header>
      <div id="main">
        <!-- START WRAPPER -->
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
                                    <li><a href="#"><i class="mdi-action-face-unlock"></i> Profile</a>
                                    </li>
                                    <li><a href="editarperfil.php"><i class="mdi-action-settings"></i> Settings</a>
                                    </li>
                                    <li><a href="#"><i class="mdi-communication-live-help"></i> Help</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li><a href="#"><i class="mdi-action-lock-outline"></i> Lock</a>
                                    </li>
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
                    <li class="bold"><a href="dash.php" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i> Dashboard</a>
                    </li>
              
                    <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                         
                                  <?php if($_SESSION['tipo_usuario']==1) { ?>
                                    <li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i class="mdi-action-account-child"></i>Usuarios</a>
                                <div class="collapsible-body">
                                    <ul>
                                        <li class="bold"><a href="registro.php" class="waves-effect waves-cyan"><i class="mdi-social-person-add"></i>Agregar Usuario</a>
                                        </li>
                                           
                                    <li class="bold"><a href="usuarios.php" class="waves-effect waves-cyan"><i class="mdi-social-group"></i> Usuarios <span class="new badge"></span></a>
                                    </li>
                            
                                  <!-- termina session -->
                                    </ul>
                                </div>
                            </li>
                                    <?php } ?>
                            
                            <li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i class="mdi-editor-border-all"></i> Hongos</a>
                                <div class="collapsible-body">
                                    <ul>
                                       <li class="bold"><a href="RegistrarHongo.php" class="waves-effect waves-cyan"><i class="mdi-social-person-add"></i>Agregar Hongo</a>
                                        </li>
                                           
                                    <li class="bold"><a href="hongos.php" class="waves-effect waves-cyan"><i class="mdi-social-group"></i> Hongos <span class="new badge"></span></a>
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
        
          
	
                <div class="container">
               
                </div>
          
            <div class="col s12 m12 l12">
              <div class="card-panel">
                <h4 class="header2">Registrar nueva observación</h4>
                <div class="row">
                  <form class="col s12" method="POST" action="subiendo.php" >
                    <section id="content">
                    <h6>Dónde se hizo la observación.</h6>
                    	<div class="row">
                    		<div id="estadoList"></div> 
			
							<div id="municipioList"></div> 
		
							<div id="localidadList"></div>
						</div>
						  </section>

              <div class="row col l12 m12 ss12">
				        	<p>
             
                      <input type="checkbox" class="filled-in" name="lugar" id="filled-in-box" checked="checked" />
                   
                        <label class="tooltipped  col l12 m12 s12" for="filled-in-box" data-position="top" data-delay="15" data-tooltip="Marque esta casilla si la ubicación de la observación es la misma en la que el hongo se encontraba creciendo. Deseleccionar si es sólo donde el hongo fue visto (e.g., feria de hongos, supermercado, o mesa de identificación de incursión, donde la ubicación de colección se desconoce).">                     _     ¿Es el lugar en dónde fue recolectado?</label>
                    </p>
            
</div>
 <div class="divider"></div>

<a  onClick="Mostrar('bloque'); return false;">Reconocido por la vista</a>
           <div id="bloque" style="display: none">
   <div class="row">
              
                <div class="col s12 m8 l9">
                  <div class="row">
                    <div class="input-field col s12">
                      <i class="mdi-editor-mode-edit prefix"></i>
                      <textarea id="icon_prefix2" name="vista" class="materialize-textarea"></textarea>
                      <label for="icon_prefix2" class="">Describir sus observaciones</label>
                    </div>
                  </div>
                </div>
              </div>
            </div> 
          <br>  <a  onClick="Mostrar('refer'); return false;">Referencias utilizadas</a>
           <div id="refer" style="display: none">
   <div class="row">
              
                <div class="col s12 m8 l9">
                  <div class="row">
                    <div class="input-field col s12">
                      <i class="mdi-editor-mode-edit prefix"></i>
                      <textarea id="icon_prefix2" name="libro" class="materialize-textarea"></textarea>
                      <label for="icon_prefix2" class="">Describir las referencias</label>
                    </div>
                  </div>
                </div>
              </div>
            </div> 
             <br>  <a  onClick="Mostrar('micros'); return false;">Referencias microscopicas</a>
           <div id="micros" style="display: none">
   <div class="row">
              
                <div class="col s12 m8 l9">
                  <div class="row">
                    <div class="input-field col s12">
                      <i class="mdi-editor-mode-edit prefix"></i>
                      <textarea id="icon_prefix2" name="micro" class="materialize-textarea"></textarea>
                      <label for="icon_prefix2" class="">Describir las referencias microscopicas</label>
                    </div>
                  </div>
                </div>
              </div>
            </div> 
             <br>  <a  onClick="Mostrar('qim'); return false;">Referencias qumicas</a>
           <div id="qim" style="display: none">
   <div class="row">
              
                <div class="col s12 m8 l9">
                  <div class="row">
                    <div class="input-field col s12">
                      <i class="mdi-editor-mode-edit prefix"></i>
                      <textarea id="icon_prefix2" name="quimica"  class="materialize-textarea"></textarea>
                      <label for="icon_prefix2" class="">Describir las características quimicas</label>
                    </div>
                  </div>
                </div>
              </div>
            </div> 
                <br>  <a  onClick="Mostrar('herbario'); return false;">Especimen en herbario disponible</a>
           <div id="herbario" style="display: none">
           <div class="col s12 m8 l9">
                  <div class="row">
                      <div class="input-field col l6 m8 s12">
                        <input id="herbario" name="herbario" type="text">
                        <label for="first_name">Nombre del herbario</label>
                      </div>
                        <div class="input-field col l6 m8 s12">
                        <input id="id_herbario" name="id_herbario" type="text">
                        <label for="first_name">Id herbario</label>
                      </div>
                    <!--   <div class="col s12 m8 l9">
                  <input type="date" class="datepicker">
                    <label for="first_name">Seleccine la fecha de colecta del ejemplar</label>
                </div>
 -->


                  </div>

            </div> 
</div>
 <div class="divider"></div>
                    <div class="row">
                      <div class="input-field col l6 m8 s12">
                        <input id="Reino" name="Reino" type="text">
                        <label for="first_name">Reino</label>
                      </div>
                    </div>
                       <div class="row">
                      <div class="input-field col l6 m8 s12">
                        <input id="Phyllum" name="Phyllum" type="text">
                        <label for="first_name">Phyllum</label>
                      </div>
                    </div>
                       <div class="row">
                      <div class="input-field col l6 m8 s12">
                        <input id="Clase" name="Clase" type="text">
                        <label for="first_name">Clase</label>
                      </div>
                    </div>

                       <div class="row">
                      <div class="input-field col l6 m8 s12">
                        <input id="Orden" name="Orden" type="text">
                        <label for="first_name">Orden</label>
                      </div>
                    </div>
                       <div class="row">
                      <div class="input-field col l6 m8 s12">
                        <input id="Familia" name="Familia" type="text">
                        <label for="first_name">Familia</label>
                      </div>
                    </div>
                       <div class="row">
                      <div class="input-field col l6 m8 s12">
                        <input id="Genero" name="Genero" type="text">
                        <label for="first_name">Genero</label>
                      </div>
                    </div>
                       <div class="row">
                      <div class="input-field col l6 m8 s12">
                        <input id="Especie" name="Especie" type="text">
                        <label for="first_name">Especie</label>
                      </div>
                    </div>

                      <div class="row">

                         <div class="input-field col l12 m12 s12">
                      <textarea id="icon_prefix2" name="ejemplar" class="materialize-textarea tooltipped l6" data-position="top" data-delay="15" data-tooltip="Por favor, incluir comentarios acerca de cómo se llegó al nombre propuesto, cualquier característica que no sea visible en las fotografías, como: hábitat, sustrato, cambios de color como resultado de la manipulación, aroma o sabor, reacciones químicas, etc."></textarea>
                      <label  for="icon_prefix2"  >Caracteristicas del ejemplar</label>
                    </div>

                      </div>
                      
                    
                   <input type="hidden" name="id" value="<?php echo $row['id']; ?>"> 
                   

                    <div class="row">
                      <div class="row">
                        <div class="input-field col s12">
                          <button class="btn cyan waves-effect waves-light right" >Submit
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
        <div class="footer-copyright">
            <div class="container">
                Copyright © 2016 <a class="grey-text text-lighten-4" href="http://themeforest.net/user/geekslabs/portfolio?ref=geekslabs" target="_blank">Instituto Tecnologico del Valle de Oaxaca</a> Departamento.
                <span class="right"> Design and Developed by <a class="grey-text text-lighten-4" href="http://geekslabs.com/">GeeksLabs</a></span>
            </div>
        </div>
    </footer>
     <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>    
    <!--materialize js-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		 <script type="text/javascript" src="js/plugins.js"></script>
	</body>
</html>
