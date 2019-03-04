<?php
	require('conexion.php');
	
	$query="SELECT id_admin, nombre, apellidos, admin_login FROM admin";
	
	$resultado=$mysqli->query($query);
	
?>

<html>
	<head>
		<title>Usuarios</title>
	</head>
	<body>
		
		<center><h1>Usuarios</h1></center>
		
		<a href="nuevo.php">Nuevo usuario</a>
		<p></p>
		<a href="buscar.php">Buscar usuario</a>
		<p></p>
		
		<table border=1 width="80%">
			<thead>
				<tr>
					<td><b>Usuario</b></td>
					<td><b>Email</b></td>
					<td></td>
					<td></td>
				</tr>
				<tbody>
					<?php while($row=$resultado->fetch_assoc()){ ?>
						<tr>
							<td><?php echo $row['nombre'];?>
							</td>
							<td>
								<?php echo $row['apellidos'];?>
							</td>
							<td>
								<a href="modificar.php?id=<?php echo $row['id_admin'];?>">Modificar</a>
							</td>
							<td>
								<a href="eliminar.php?id=<?php echo $row['id_admin'];?>">Eliminar</a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</body>
	</html>	
	