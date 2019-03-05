<?php 
	
	require('conexion.php');
	
	$id_p=$_GET['id_p'];
	
	$query="DELETE FROM pdf WHERE id_p='$id_p'";
	$row=$mysqli->query($query);
	
	
   
   
	
?>

<html>
	<head>
		<title>Eliminar Documento</title>
	</head>
	
	<body>
		<center>
			<?php 
				if($resultado and $row>0){
				?>
				
				<h1>Documento eliminado</h1>
				
				<?php 	}else{ ?>
				
				<h1>Error al Eliminar documento</h1>
				
			<?php	} ?>
			<p></p>		
			
			<a href="../documentos.php">Regresar</a>
			
		</center>
	</body>
</html>