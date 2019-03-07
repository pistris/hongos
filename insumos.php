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

     $query="SELECT * FROM insumo";
  
   $resultado=$mysqli->query($query);
   
//    $query="SELECT i.id_insumo,i.nombre,i.descripcion,i.medida,i.color,i.familia,i.unidad,i.status,d.nombre_prov FROM insumo AS i INNER JOIN insumo_proveedor AS p ON i.id_insumo = p.id_insumos RIGHT JOIN proveedor AS d
//    ON d.id_proveedor = p.id_proveedor";

//  $resultado=$mysqli->query($query);

   $mysqli = new mysqli("localhost","root", "", "hongo");
$query = $mysqli->prepare("SELECT * FROM hongos WHERE ID='$idUsuario'");
$query->execute();
$query->store_result();

$resultados = $query->num_rows;

?>
<?php include('header.php');
?>
        <div class="container">
          <div class="section">

            <p class="caption">En este panel podra ver los usuarios registrados en la pagina y que pueden ayudar a amplicarla con sus aportaciones</p>
            <div class="divider"></div>
            
            <!--DataTables example-->
            <div id="table-datatables">
              <h4 class="header">Aportadores</h4>
              <!-- este es la session -->
    <?php if($_SESSION['tipo_usuario']==1) { ?>
    
    <a href="registro_insumo.php">Registarse</a>
    <br />
    <?php } ?>
    <!-- termina session -->
              <div class="row">
             <!--    <div class="col s12 m4 l3">
                  <p>DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function.</p>

                  <p>Searching, ordering, paging etc goodness will be immediately added to the table, as shown in this example.</p>
                </div> -->
                <div class="col s12 m8 l12">
                  <table id="data-table-simple" class="display" cellspacing="0">
                    <thead>
                        <tr>

                            <th>Identificador</th>
                            <th>Nombre de insumo</th>
                            <th>descripcion</th>
                            <th>medida</th>
                            <th>color</th>
                            <th>unidad de usuario</th>
                            <th></th>
                            <th></th>
                               <th>Estatus</th>
                          
                        </tr>
                    </thead>
                      
                    <tbody><?php while($row=$resultado->fetch_assoc()){ ?>

                    <tr>
                       <td> 
            <p> <?php echo $row['id_insumo'];?>
       </p>
                       </td>
                       <td>
                         <?php echo $row['nombre'];?>
                       </td>
                       <td>
                         <?php echo $row['descripcion'];?>
                       </td>
                       <td>
                         <?php echo $row['medida'];?>
                       </td>
                       <td>
                         <?php echo $row['color'];?>
                       </td>
                       <td>
                         <?php echo $row['unidad'];?>
                       </td>
                            

                       <td>
                         <a href="modificar_insumo.php?id=<?php echo $row['id_insumo'];?>">Modificar</a>
                       </td>
                       
        <!-- este es la session -->
                          
                         <td>
                            <a href="php/eliminarinsumo.php?id=<?php echo $row['id_insumo'];?>">Eliminar</a>
                         </td>

         <!-- termina session -->
           <td>
                                      
                                        <?php if($row['status']=="A") {?>
                                            <a href="insumo-switch.php?id=<?php echo $row['id_insumo'];?>" target="_self">
                                                <button type="button" class="btn btn-large waves-effect waves-light light-green darken-4">
                                                Activo
                                                </button> 
                                            </a>
                                        <?php } else if($row['status'] == "I"){?>
                                            <a href="insumo-switch.php?id=<?php echo $row['id_insumo'];?>" target="_self">
                                            <button type="button" class="btn btn-large waves-effect waves-light red darken-4">
                                                Inactivo
                                            </button> 
                                            </a>
                                        <?php } ?>
                                        </td>

             
                    </tr>
                      
                        <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div> 
            <br>
            <div class="divider"></div> 
        

           
          </div>

   <?php include('footer.php'); ?> 