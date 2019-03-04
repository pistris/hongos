<?php 
    
    require('conexion.php');
    
    $Id_hongo=$_POST['Id_hongo'];
        $Reino =$_POST['Reino'];    
            $Phyllum =$_POST['Phyllum'];
            $Clase =$_POST['Clase'];
            $Orden =$_POST['Orden'];
            $Familia =$_POST['Familia'];
            $Genero =$_POST['Genero'];
            $Especie =$_POST['Especie'];
            $ejemplar =$_POST['ejemplar'];
            $clave_regis =$_POST['clave_regis'];
            $Emplear_tipo =$_POST['Emplear_tipo'];        
            $Tip_vegetacion =$_POST['Tip_vegetacion'];        
            $Hospedero =$_POST['Hospedero'];        
            $Descripcion =$_POST['Descripcion'];        
           
            
    
    
    $query="UPDATE hongos SET Reino='$Reino',Phyllum='$Phyllum',Clase='$Clase',Orden='$Orden',Familia='$Familia',Genero='$Genero',Especie='$Especie',ejemplar='$ejemplar' WHERE Id_hongo='$Id_hongo'";
    
    $resultado=$mysqli->query($query);
    // $quer = "UPDATE datos_geograficos SET Municipio='$cbx_municipio',Localidad='$cbx_localidad' WHERE Id_hongo='$Id_hongo'";
    //           $resul=$mysqli->query($quer);
                  $querys = "UPDATE dat_eco SET Tip_vegetacion='$Tip_vegetacion',Hospedero='$Hospedero' WHERE Id_hongo='$Id_hongo'";
                   $result=$mysqli->query($querys);
                     $queryss = "UPDATE citado SET Descripcion='$Descripcion' WHERE Id_hongo='$Id_hongo'";
                          $resultados=$mysqli->query($queryss);
   $querysss = "UPDATE herbario SET clave_regis='$clave_regis',Emplear_tipo='$Emplear_tipo' WHERE Id_hongo='$Id_hongo'";
                         $resultad=$mysqli->query($querysss);
    
?>

<html>
    <head>
        <title>Modificar Hongo</title>
    </head>
    
    <body>
        <center>
            
            <?php 
                if($resultado>0){
                ?>
                
                <h1>Hongo Modificado</h1>
                
                    <?php   }else{ ?>
                
                <h1>Error al Modificar hongo</h1>
                
            <?php   } ?>
            
            <p></p> 
            
            <a href="../hongos.php">Regresar</a>
            
        </center>
    </body>
</html>
                
                