<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="tablamax">
    <meta name="keywords" content="construccion, tablamax, tablaroca">
    <title>tablamax|Bienvenido <?php echo ($row['nombre']); ?> </title>

    <link rel="icon" href="images/favicon/tabla.png" sizes="32x32">
    <link rel="apple-touch-icon-precomposed" href="images/favicon/tabla.png">
    <meta name="msapplication-TileColor" content="#00bcd4">
    <meta name="msapplication-TileImage" content="images/favicon/tabla.png">


    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection">
    


    <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="js/plugins/data-tables/css/jquery.dataTables.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="js/plugins/jvectormap/jquery-jvectormap.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">
 

</head>

<body >
    <!-- <div id="loader-wrapper">
        <div id="loader"></div>        
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div> -->
    <header id="header" class="page-topbar">
        <div class="navbar-fixed">
            <nav class="cyan">
                <div class="nav-wrapper">
                    <h1 class="logo-wrapper"><a href="dash.php" class="brand-logo darken-1"><img src="images/materialize-logo.png" alt="materialize logo"></a> <span class="logo-text">Tablamax</span></h1>
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
                            
                            <li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i class="mdi-navigation-expand-more"></i> Insumos</a>
                                <div class="collapsible-body">
                                    <ul>
                                       <li class="bold"><a href="registro_insumo.php" class="waves-effect waves-cyan"><i class="mdi-image-add-to-photos"></i>Agregar Insumo</a>
                                        </li>
                                      <?php if($_SESSION['tipo_usuario']==1) { ?>        
                                    <li class="bold"><a href="insumos.php" class="waves-effect waves-cyan"><i class="mdi-image-nature"></i> Insumos </a>
                                    </li>
                                    
                                     <?php } ?>
                                      <!-- <li class="bold"><a href="hongousuario.php" class="waves-effect waves-cyan"><i class="mdi-action-speaker-notes"></i>Mis Insumos</a>
                                    </li> -->
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
       
            <section id="content">

 
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
                                        <?php } else{echo "Usuario";}?>
                                    </p>
                                    <p><i class="mdi-action-perm-phone-msg"></i> +1 (612) 222 8989</p>
                                    <p><i class="mdi-communication-email"></i> <?php echo $row['correo']?></p>

                            </div>
                            <div class="card-reveal">
                                <span class="card-title grey-text text-darken-4"><?php echo $row['nombre']?> <?php echo $row['apellidos']?> <i class="mdi-navigation-close right"></i></span>
                                    <p>Here is some more information about this card.</p>
                                    <p><i class="mdi-action-perm-identity"></i> <?php if($_SESSION['tipo_usuario']==1) { ?>
                                        Administrador
                                        <?php } else{echo "Usuario";}?>
                                    </p>
                                    <p><i class="mdi-action-perm-phone-msg"></i> +1 (612) 222 8989</p>
                                    <p><i class="mdi-communication-email"></i> <?php echo $row['correo']?></p>
                                    <p><i class="mdi-social-cake"></i> <?php echo $row['fecha']?></p>
                            </div>            
                        </div>
                    </div>
                    </div>
                </div>
