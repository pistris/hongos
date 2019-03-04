header("Content-Type: text/html;charset=utf-8");
function getEstado() {
	
	if (window.XMLHttpRequest) {
		xmlhttp3 = new XMLHttpRequest();
		} else { 
		xmlhttp3 = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp3.onreadystatechange=function() {
		if (xmlhttp3.readyState==4 && xmlhttp3.status==200) {
			document.getElementById("estadoList").innerHTML=xmlhttp3.responseText;
		}
	}
	xmlhttp3.open("GET","includes/getEstado.php",true);
	xmlhttp3.send();
}

function getMunicipio(estado_id) {
	
	if (window.XMLHttpRequest) {
		xmlhttp3 = new XMLHttpRequest();
		} else { 
		xmlhttp3 = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp3.onreadystatechange=function() {
		if (xmlhttp3.readyState==4 && xmlhttp3.status==200) {
			document.getElementById("municipioList").innerHTML=xmlhttp3.responseText;
		}
	}
	xmlhttp3.open("GET","includes/getMunicipio.php?estado_id="+estado_id,true);
	xmlhttp3.send();
}

function getLocalidad(municipio_id) {
	
	if (window.XMLHttpRequest) {
		xmlhttp3 = new XMLHttpRequest();
		} else { 
		xmlhttp3 = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp3.onreadystatechange=function() {
		if (xmlhttp3.readyState==4 && xmlhttp3.status==200) {
			document.getElementById("localidadList").innerHTML=xmlhttp3.responseText;
		}
	}
	xmlhttp3.open("GET","includes/getLocalidad.php?municipio_id="+municipio_id,true);
	xmlhttp3.send();
}