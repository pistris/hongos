<?php 
   @session_start();
    require('php/conexion.php');
    
    if(!isset($_SESSION["id_usuario"])){
        header("Location: index.php");
    }
      
$id=$_GET['id'];
    

	
		
	//consultamos el estatus del usuario
	$sqlstat = "SELECT * FROM hongos WHERE Id_hongo = '$id' AND status = 'A'";
    $result_stat=$mysqli->query($sqlstat);
    $rows = $result_stat->num_rows;

     if($rows > 0) {
            $query="UPDATE hongos SET status='I' WHERE Id_hongo = '$id'";
            $resultado=$mysqli->query($query);
            } else {
            
            $query="UPDATE hongos SET status='A' WHERE Id_hongo = '$id'";
            $resultado=$mysqli->query($query);
            
        }
	header('Location: hongos.php?msj=success');
?>
<!--
<html>
	<head>
		<title>Eliminar area</title>
	</head>
	
	<body>
		<center>
			<?php 
				if($resultado>0){
				?>
				
				<h1>Status Cambiado</h1>
				
				<?php 	}else{ ?>
				
				<h1>Error al Cambiar el status</h1>
				
			<?php	} ?>
			<p></p>		
			
			<a href="hongos.php">Regresar</a>
			
		</center>
	</body>
</html>
-->