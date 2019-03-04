<?php
	header("Content-Type: text/html;charset=utf-8");
	require ('conexion.php');
	
	echo ' <div class="input-field col s4"><p>Seleccione Estado</p><select class="browser-default" onChange="getMunicipio(this.value);" name="cbx_estado" id="cbx_estado">';
	
	$query = "SELECT id_estado, estado FROM t_estado ORDER BY estado";
	
	if($resultado=$mysqli->query($query))
	{
		while($row = $resultado->fetch_assoc())
		{
		?>
		<option value="">Selecciona Estado</option>
		<option value="<?php echo $row['id_estado']; ?>"><?php echo $row['estado']; ?></option>
		
		<?php
		}
	}
	echo '</select></div>';
?>