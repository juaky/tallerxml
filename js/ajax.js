function Load_partits(){

alert(1);
	
// Obtener la instancia del objeto XMLHttpRequest
  if(window.XMLHttpRequest) {
    peticion_http2 = new XMLHttpRequest();
  }
  else if(window.ActiveXObject) {
    peticion_http2 = new ActiveXObject("Microsoft.XMLHTTP");
  }

// Preparar la funcion de respuesta
  peticion_http2.onreadystatechange = muestraContenido2;
 
  // Realizar peticion HTTP
  peticion_http.open('GET', '../pages/taula_partits.php', true);
  peticion_http.send(null);
 
  function muestraContenido2() {
    if(peticion_http2.readyState == 4) {
      if(peticion_http2.status == 200) {
        document.getElementById('flowers').innerHTML =peticion_http.responseText;
      }
    }
  }
}
   
