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
            $query = "SELECT i.id,p.Reino,p.Id_hongo,p.clase,p.status,p.Phyllum,p.Clase,p.Orden,p.Familia,p.Genero,p.Especie,p.ejemplar FROM usuarios AS u INNER JOIN hongos AS p ON u.id_personal=p.id INNER JOIN imagen AS i ON p.Id_hongo=i.id_hongo WHERE p.status = 'I' and u.status='A'";



  
   $resultado=$mysqli->query($query);

?>
<?php
include('header.php')

?>

 
     <!--Card Reveal-->
      
    <div id="card-reveal" >
            <h4 class="header">Nuevos hongos</h4>
        <div class="row">
          <?php while($row=$resultado->fetch_assoc()){ ?>

             <div class="col s12 m4 l4">
                
                  <div class="card">
                      <div class="card-image waves-effect waves-block waves-light">
                        <img class="activator" src="files/<?php echo $row['id'];?>.jpg" alt="Sin imagen del hongo">
                      </div>
                      <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4"><?php echo $row['Especie'];?> <i class="mdi-navigation-more-vert right"></i></span>
                        <?php if($_SESSION['tipo_usuario']==1) { ?>
                         <p><a href="hongosI.php">Aprobar Hongos</a>
                        </p>
                            <?php } ?>
                      </div>
                      <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4">Id del hongo: <?php echo $row['Id_hongo'];?><i class="mdi-navigation-close right"></i></span>
                        <p><?php echo $row['ejemplar'];?>.</p>
                      </div>
                    </div>
            </div>
                 <?php } ?>
        </div>

    </div>

  <?php include('footer.php') ?>