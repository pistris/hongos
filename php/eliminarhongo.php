<?php 
	
	require('conexion.php');
	
	$id=$_GET['id'];
	
	$query="DELETE FROM hongos WHERE Id_hongo='$id'";
	
	$resultado=$mysqli->query($query);
	
   
   
	
?>

<html>
	<head>
		<title>Eliminar Hongo</title>
	</head>
	
	<body>
		<center>
			<?php 
				if($resultado >0){
				?>
				
				<h1>Hongo Eliminado</h1>
				
				<?php 	}else{ ?>
				
				<h1>Error al Eliminar Hongo</h1>
				
			<?php	} ?>
			<p></p>		
			
			<a href="../hongos.php">Regresar</a>
			
		</center>
	</body>
</html>