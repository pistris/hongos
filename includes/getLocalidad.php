<?php
	header("Content-Type: text/html;charset=utf-8");
	require ('conexion.php');
	
	$id_municipio = $_GET['municipio_id'];
	
	echo '<div class="row">
                      <div class="input-field col s4"> <p>Seleccione Localidad</p><select class="browser-default" name="cbx_localidad" id="cbx_localidad">';
	
	$query = "SELECT id_localidad, localidad FROM t_localidad WHERE id_municipio = '$id_municipio' ORDER BY localidad";
	
	if($resultado=$mysqli->query($query))
	{
		while($row = $resultado->fetch_assoc())
		{
		?>
		
		<option value="<?php echo $row['id_localidad']; ?>"><?php echo $row['localidad']; ?></option>
		
		<?php
		}
	}
	echo '</select>  </div></div>';
?>