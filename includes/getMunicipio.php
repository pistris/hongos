<?php
	
header("Content-Type: text/html;charset=utf-8");
	require ('conexion.php');
	
	echo '<div class="input-field col s4"><p>Seleccione Municipio</p><select class="browser-default" onChange="getLocalidad(this.value);" name="cbx_municipio" id="cbx_municipio">';
	
	$query = "SELECT id_municipio, municipio FROM t_municipio ORDER BY municipio";
	
	if($resultado=$mysqli->query($query))
	{
		while($row = $resultado->fetch_assoc())
		{
		?>

		<option value="<?php echo $row['id_municipio']; ?>"><?php echo $row['municipio']; ?></option>
		
		<?php
		}
	}
	echo '</select>  </div>';
?>