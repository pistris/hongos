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
        
          
    
                <div class="container">
               
                </div>
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
                      <textarea id="icon_prefix2" name="ejemplar" class="materialize-textarea tooltipped l6" data-position="top" data-delay="15" data-tooltip="Por favor, incluir comentarios acerca de cómo se llegó al nombre propuesto, cualquier característica que no sea visible en las fotografías, como: hábitat, sustrato, cambios de color como resultado de la manipulación, aroma o sabor, reacciones químicas, etc." required></textarea>
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
     <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>    
    <!--materialize js-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
         <script type="text/javascript" src="js/plugins.js"></script>
    </body>
</html>
