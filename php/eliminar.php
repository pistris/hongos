<?php 
	
	require('conexion.php');
	
	$id=$_GET['id'];
	
	$query="DELETE FROM usuarios WHERE id='$id'";
	
	$resultado=$mysqli->query($query);
	$query="DELETE FROM personal WHERE id='$id'";
   
   $row=$mysqli->query($query);
	
?>

<html>
	<head>
		<title>Eliminar usuario</title>
	</head>
	
	<body>
		<center>
			<?php 
				if($resultado and $row>0){
				?>
				
				<h1>Usuario Eliminado</h1>
				
				<?php 	}else{ ?>
				
				<h1>Error al Eliminar Usuario</h1>
				
			<?php	} ?>
			<p></p>		
			
			<a href="../usuarios.php">Regresar</a>
			
		</center>
	</body>
</html>