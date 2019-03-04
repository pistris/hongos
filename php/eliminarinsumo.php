<?php 
	
	require('conexion.php');
	
	$id=$_GET['id'];
	
	$query="DELETE FROM insumo WHERE id_insumo='$id'";
	
	$resultado=$mysqli->query($query);
	$query="DELETE FROM insumo_proveedor WHERE id_insumo='$id'";
   
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
			
			<a href="../insumos.php">Regresar</a>
			
		</center>
	</body>
</html>