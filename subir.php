<?php @session_start();
    require('php/conexion.php');
    
    if(!isset($_SESSION["id_usuario"])){
        header("Location: index.php");
    }
    
    $idUsuario = $_SESSION['id_usuario'];


    
 $resultado=$mysqli->query("SELECT MAX(Id_hongo) AS Id_hongo FROM hongos WHERE id= $idUsuario"); 
 	$row = $resultado->fetch_assoc();

$ruta = './files/'; //Decalaramos una variable con la ruta en donde almacenaremos los archivos
$mensage = '';//Declaramos una variable mensaje quue almacenara el resultado de las operaciones.



foreach ($_FILES as $key) //Iteramos el arreglo de archivos
{
	
			
	if($key['error'] == UPLOAD_ERR_OK )//Si el archivo se paso correctamente Ccontinuamos 
		{
	
			$key['name'] = $row['Id_hongo'];
		

			$NombreOriginal = $key['name'];//Obtenemos el nombre original del archivo
				$query="INSERT INTO imagen (id_hongo,id_persona) VALUES ('$NombreOriginal',$idUsuario)";
			$resultado=$mysqli->query($query);
			$hong = $mysqli->insert_id;
			$temporal = $key['tmp_name']; //Obtenemos la ruta Original del archivo
			$Destino = $ruta.$hong.'.jpg';	//Creamos una ruta de destino con la variable ruta y el nombre original del archivo	
			
			move_uploaded_file($temporal, $Destino); //Movemos el archivo temporal a la ruta especificada		
		}

	if ($key['error']=='') //Si no existio ningun error, retornamos un mensaje por cada archivo subido
		{
			$mensage .= '<img class="materialboxed" data-caption="El archivo '.$NombreOriginal.' se suibio correctamente" width="250" src="'.$Destino.'"> ';
		}
	if ($key['error']!='')//Si existio algún error retornamos un el error por cada archivo.
		{
			$mensage .= '-> No se pudo subir el archivo <b>'.$NombreOriginal.'</b> debido al siguiente Error: \n'.$key['error']; 
		}
	
}
echo $mensage;// Regresamos los mensajes generados al cliente
?>

   <script type="text/javascript">
      $(document).ready(function(){
    $('.materialboxed').materialbox();
  });

</script>