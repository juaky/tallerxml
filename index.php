<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License

Name       : Premium Series
Description: A three-column, fixed-width blog design.
Version    : 1.0
Released   : 20090303

-->
<html xmlns="http://www.w3.org/1999/xhtml">

 
<?php
ini_set('display_errors', 1);  // Obrim el report d'errors en fase de desenvolupament
session_start();     // Iniciem sessio imprescindible per gestionar validacions
include_once "lib/llibreria.php";    // Incluim la nostra llibreria de funcions
connectar();    // Connectem la BD 
$visitant=visites();

// Validacio
if (isset($_REQUEST["accio"]) )  // Mirem quina acció hem escollit
{
if ($_REQUEST["accio"]=="logout")  logout();  // si hem escollit l'acció de sortida fem el logut cridant a la funció que tindrem a la llibreria.php
}

if(!isset($_SESSION['usuari']))     // Mirem si no estem validats
{
    if(isset($_POST['login']))   // Mirem si hem enviat la loginació
    {
        if(loginar($_POST['user'],$_POST['password']))  // Activem la funció de validació
        {
            $_SESSION['usuari'] = $_POST['user'] ;    // Si son correctes usuarii contrasenya grava usuari a la sessió
            header("location:index.php");               // Torna a carregar la pagina
        }
    }
    }
?>


<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Free XML</title>
<meta name="keywords" content="" />
<meta name="Premium Series" content="" />
<link href="default.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/propi.css" rel="stylesheet" type="text/css" media="screen" />

<style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
</style>





<script>
function cercar()
{
var cadena = '<style>' + "\n" ;
cadena +='TD.dada { ' + "\n" ;
cadena += 'font-weight: bold;' + "\n" ;
cadena += 'color : red;' + "\n" ;  
cadena += '}' + "\n" ;  
cadena += '</style>' + "\n" ;  
cadena +='<table border="2" colorborder="#AAD4FF">';
var valor = document.getElementById('s').value;
valor = valor.toUpperCase() ;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.open("GET","http://areasrecreativas.net16.net/unitat1/minerals_simple.xml",false);
xmlhttp.send();
xmlDoc=xmlhttp.responseXML;
var x=xmlDoc.getElementsByTagName("minerals");
for (i=0;i<x.length;i++)
  {
  if (x[i].getElementsByTagName("nom")[0].childNodes[0].nodeValue==valor)
  {
  cadena +='<tr><td colspan="3" align="center" class="dada">';
  cadena +=x[i].getElementsByTagName("nom")[0].childNodes[0].nodeValue;
  cadena +='</td></tr><tr><td>Duresa</td><td class="dada">';
  cadena +=x[i].getElementsByTagName("duressa")[0].childNodes[0].nodeValue;
  cadena +='</td><td rowspan="4"><img src="';
  cadena +=x[i].getElementsByTagName("foto")[0].childNodes[0].nodeValue;
  cadena += '" ></tr><tr><td>Densitat</td><td class="dada">';
  cadena +=x[i].getElementsByTagName("densitat")[0].childNodes[0].nodeValue;
  cadena +='</td></tr><tr><td>Composició</td><td class="dada">';
  cadena +=x[i].getElementsByTagName("composicio")[0].childNodes[0].nodeValue;
  cadena +='</td></tr><tr><td>Color</td><td class="dada">';
  cadena +=x[i].getElementsByTagName("color")[0].childNodes[0].nodeValue;
  cadena +='</td></tr><tr><td>Grup</td><td class="dada">';
  cadena +=x[i].getElementsByTagName("grup")[0].childNodes[0].nodeValue;
  cadena +='</td><td align="center" class="dada">';
  cadena +=x[i].getElementsByTagName("nom")[0].childNodes[0].nodeValue;
  cadena +='</td></tr>';  
  }
  }
  cadena +="</table>";
  document.getElementById("map-canvas").innerHTML = cadena;
  }
 
</script>

<script>

function temps()
{
var http_request = new XMLHttpRequest();
var url = "http://api.openweathermap.org/data/2.5/weather?q=Figueres,es&units=metric"; // URL que envia el fitxer JSON del temps
// retorna {"coord":{"lon":1.11,"lat":41.16},"sys":{"type":1,"id":5495,"message":0.0854,"country":"ES","sunrise":1415082645,"sunset":1415119652}
//,"weather":[{"id":801,"main":"Clouds","description":"few clouds","icon":"02n"}],"base":"cmc stations",
//"main":{"temp":13,"pressure":997,"humidity":58,"temp_min":13,"temp_max":13},"wind":{"speed":4.6,"deg":250,"var_beg":220,"var_end":290},
// "clouds":{"all":20},"dt":1415127600,"id":3111933,"name":"Reus","cod":200}

 

 // Descarrega les dades JSON del servidor.
http_request.onreadystatechange = handle_json;
http_request.open("GET", url, true);
http_request.send(null);
 
function handle_json() {
  if (http_request.readyState == 4) {
    if (http_request.status == 200) {
      var json_data = http_request.responseText;   // l'objecte json_data guarda les dades rebudes en format JSON
      var the_object = eval("(" + json_data + ")");   // guarda les dades en format objecte
      var json = JSON.parse(json_data);          // parseja les dades per si volem accedir a un valor concret ja separat
       var res = "La temperatura a Figueres actualment és de " + json.main.temp + " ºC " ; // Construim la cadena
       document.getElementById('temps').innerHTML = res ;    // Enviem la cadena construida a la capa amb id = temps
    } else {
      alert("Fora de servei ");   // Si no carrega mostra missatge d'error
    }
    http_request = null;
  }
}
}

</script>


   




</head>
<body onload="Load_partits(); temps();">




<!--  Inici del AJAX -->   
<SCRIPT language="JavaScript">
function omplir(minoacb) {
  // Obtener la instancia del objeto XMLHttpRequest
  if(window.XMLHttpRequest) {
    peticion_http = new XMLHttpRequest();
  }
  else if(window.ActiveXObject) {
    peticion_http = new ActiveXObject("Microsoft.XMLHTTP");
  }
 
  // Preparar la funcion de respuesta
  peticion_http.onreadystatechange = muestraContenido;
 
  // Realizar peticion HTTP
  peticion_http.open('GET', 'files/consulta.php?minoacb='+minoacb, true);
  peticion_http.send(null);
 
  function muestraContenido() {
    if(peticion_http.readyState == 4) {
      if(peticion_http.status == 200) {
        document.getElementById('buscar3').innerHTML =peticion_http.responseText;
      }
    }
  }
}
</SCRIPT>

 

<SCRIPT language="JavaScript">

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
  peticion_http2.open('GET', 'pages/taula_partits.php', true);
  peticion_http2.send(null);
 
  function muestraContenido2() {
    if(peticion_http2.readyState == 4) {
      if(peticion_http2.status == 200) {
        document.getElementById('map-canvas').innerHTML =peticion_http2.responseText;
      }
    }
  }
}

</SCRIPT>

<!-- Fi de l'AJAX -->





<!-- start header -->
<div id="header">
	<div id="logo">
		<h1><a href="#"><span>Liga</span>ACB</a></h1>
		<p>Diseño Joaquín Rubio</p>
		<!-- Capa afegida per loginar -->        
			<div id="loginar" style="width: 600px; float: right; text-align: center;">
			    <br />
			
			<?php
			    if(!isset($_SESSION['usuari']))  // Sino està validat
			    {
			?>
			    
			<form action="" method="post" class="login">
			    <label>Usuari &nbsp; </label><input name="user" type="text" size="10">
			    <label> &nbsp; Contrasenya &nbsp; </label><input name="password" type="password" size="10">
			    <input name="login" type="submit" value="login">
			</form>
			<?php
			}
			else     // Si està validat
			{
			echo $_SESSION["usuari"] . '<a href="index.php?accio=logout"> (Sortir) </a> ';  // Si està validat surt el nom d eusuari i l'enllaç per sortir
			}
			?>
			
			</div>    
		<!-- Fi de la capa de loginar --> 
	</div>
	<!--<div id="menu">
		<ul id="main">
			<li class="current_page_item"><a href="#">Homepage</a></li>
			<li><a href="#">Products</a></li>
			<li><a href="#">Services</a></li>
			<li><a href="#">About Us</a></li>
			<li><a href="#">Contact Us</a></li>
		</ul>
		<ul id="feed">
			<li><a href="#">Entries RSS</a></li>
			<li><a href="#">Comments RSS</a></li>
		</ul>
	</div> -->
	
<div id="cssmenu">
<ul>
   <li class='active '><a href='index.html'><span>Inici</span></a></li>
   <li class='has-sub '><a href='#'><span>Visors</span></a>
      <ul>
         <li><a href='#'><span>XML</span></a></li>
         <li><a href='#'><span>RSS</span></a></li>
         <li><a href='#'><span>KML</span></a></li>
         <li><a href='#'><span>SVG</span></a></li> 
      </ul>
   </li>
   <li class='has-sub '><a href='#'><span>Exportació</span></a>
      <ul>
         <li><a href='#'><span>XML</span></a></li>
         <li><a href='http://areasrecreativas.net16.net/web4/pages/crea_preguntes.php'><span>Servei web propi</span></a></li>
         <li><a href='#'><span>RSS</span></a></li>
         <li><a href='#'><span>KML</span></a></li>
         <li><a href='#'><span>SVG</span></a></li>
         <li><a href='#'><span>CSV</span></a></li>
      </ul>
   </li>
   <li class='has-sub '><a href='#'><span>Formularis</span></a>
      <ul>
          <li><a href='javascript:omplir(1);'><span>Minerals</span></a></li>
         <li><a href='javascript:omplir(2);'><span>ACB</span></a></li>
         <li><a href='#'><span>Noticies</span></a></li>
         <li><a href='#'><span>Instituts</span></a></li>
     </ul>
   </li>
   <li class='has-sub '><a href='#'><span>Informació</span></a>
   
        <ul>
         <li><a href='#'><span>Bases</span></a></li>
         <li><a href='#'><span>Alers</span></a></li>
         <li><a href='#'><span>Àlbum ACB</span></a></li>
         <li><a href='#'><span>Preguntes</span></a></li>
         <li><a href='#'><span>Calendari de Partits</span></a></li>
         <li></li>
         <li><a href='http://areasrecreativas.net16.net/web4/pages/mapa_visites.html' target="visitas"><span>Mapa de visitants</span></a></li>
        </ul>
   </li>
   </ul>
	<div id="temps" style="color:#1F0000; font-size:14px;" align="right" >
	</div>
</div> 
<!-- end header -->
<div id="wrapper">
	<!-- start page -->
	<div id="page">
		<div id="sidebar1" class="sidebar">
			<ul>
				<li>
					<h2>Notícies ACB</h2>
					
						<?php
							$xslDoc = new DOMDocument();
							$xslDoc->load("rss.xsl");   // carrega el fitxer XSL per donar format HTML a les dades

							$xmlDoc = new DOMDocument();
							$xmlDoc->load("http://www.europapress.es/rss/rss.aspx?buscar=ACB"); // en aquest cas agafara la url del RSS de l'adreça

							$xsltProcessor = new XSLTProcessor();
							$xsltProcessor->registerPHPFunctions();
							$xsltProcessor->importStyleSheet($xslDoc);

							echo $xsltProcessor->transformToXML($xmlDoc);  // Escriu el resultat de la transformació XSLT
							?>


				</li>
				<li>
					<h2>Recent Comments</h2>
					<ul>
						<li><a href="#">Free CSS Templates</a> on <a href="#">Aliquam libero</a></li>
						<li><a href="#">Free CSS Templates</a> on <a href="#">Consectetuer adipiscing elit</a></li>
						<li><a href="#">Free CSS Templates</a> on <a href="#">Metus aliquam pellentesque</a></li>
						<li><a href="#">Free CSS Templates</a> on <a href="#">Suspendisse iaculis mauris</a></li>
						<li><a href="#">Free CSS Templates</a> on <a href="#">Urnanet non molestie semper</a></li>
						<li><a href="#">Free CSS Templates</a> on <a href="#">Proin gravida orci porttitor</a></li>
					</ul>
				</li>
				<li>
					<h2>Categories</h2>
					<ul>
						<li><a href="#">Aliquam libero</a></li>
						<li><a href="#">Consectetuer adipiscing elit</a></li>
						<li><a href="#">Metus aliquam pellentesque</a></li>
						<li><a href="#">Suspendisse iaculis mauris</a></li>
						<li><a href="#">Urnanet non molestie semper</a></li>
						<li><a href="#">Proin gravida orci porttitor</a></li>
					</ul>
				</li>
				<li>
					<h2>Archives</h2>
					<ul>
						<li><a href="#">September</a> (23)</li>
						<li><a href="#">August</a> (31)</li>
						<li><a href="#">July</a> (31)</li>
						<li><a href="#">June</a> (30)</li>
						<li><a href="#">May</a> (31)</li>
					</ul>
				</li>
			</ul>
		</div>
		<!-- start content -->
		<div id="content">
                    <div id="map-canvas" style="width: 500px ; height: 300px; align:center" >
                        <iframe src="http://areasrecreativas.net16.net/web4/pages/mapa_visites.html?ample=500&alt=350" name="visitas" scrolling="no" align="middle" height="300" width="500" scrolling="no" align="middle"  ></iframe>
   
                    </div>
                     
			<div class="post">
				<h1 class="title"><a href="#">Bienvenidos a nuestro sitio!</a></h1>
				<p class="byline"><small>8, de Noviembre de 2009 </small></p>
				<div class="entry">
					<iframe src="http://areasrecreativas.net16.net/unitat2/album_acb.php?ample=200&alt=250"  scrolling="yes" align="middle" height="300" width="500"></iframe> 
				</div> 
				 
			</div>
			<div class="post">
				<h2 class="title"><a href="#">Sample Tags</a></h2>
				<p class="byline"><small>Posted on October 1st, 2009 by <a href="#">Free CSS Templates</a></small></p>
				<div class="entry">
					<h3>An H3 Followed by a Blockquote:</h3>
					<blockquote>
						<p>&#8220;Donec leo, vivamus nibh in augue at urna congue rutrum. Quisque dictum integer nisl risus, sagittis convallis, rutrum id, congue, and nibh.&#8221;</p>
					</blockquote>
					<h3>Bulleted List:</h3>
					<ul>
						<li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
						<li>Phasellus nec erat sit amet nibh pellentesque congue.</li>
						<li>Cras vitae metus aliquam risus pellentesque pharetra.</li>
					</ul>
					<h3>Numbered List:</h3>
					<ol>
						<li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
						<li>Phasellus nec erat sit amet nibh pellentesque congue.</li>
						<li>Cras vitae metus aliquam risus pellentesque pharetra.</li>
					</ol>
					<p class="links"><a href="#" class="more">&laquo;&laquo;&nbsp;&nbsp;Read More&nbsp;&nbsp;&raquo;&raquo;</a></p>
				</div>
			</div>
			<div class="post">
				<h2 class="title"><a href="#">Lorem Ipsum Dolor </a></h2>
				<p class="byline"><small>Posted on October 1st, 2009 by <a href="#">Free CSS Templates</a></small></p>
				<div class="entry">
					<p>Consectetuer adipiscing elit. Nam pede erat, porta eu, lobortis eget, tempus et, tellus. Etiam neque. Vivamus consequat lorem at nisl. Nullam non wisi a sem semper eleifend. Donec mattis libero eget urna. Duis pretium velit ac mauris. Proin eu wisi suscipit nulla suscipit interdum. Aenean lectus lorem, imperdiet at, ultrices eget, ornare et, wisi. </p>
					<p class="links"><a href="#" class="more">&laquo;&laquo;&nbsp;&nbsp;Read More&nbsp;&nbsp;&raquo;&raquo;</a></p>
				</div>
			</div>
		</div>
		<!-- end content -->
		<!-- start sidebars -->
		<div id="sidebar2" class="sidebar">
			<ul>
				<li>
					<form id="searchform">
					<!--<form id="searchform" method="get" action="#">-->
						<div id="buscar2">
							<h2>Búsqueda</h2>
							<div id="buscar3">
								<input type="text" name="s" id="s" size="15" value="" onkeypress="if (event.keyCode == 13) cercar()" />
						  	</div>
						</div>
					</form>
				</li>
				<li>
					<h2>Tags</h2>
                                         <?php
                                                echo "IP: " . $visitant[0] ."<br/>";
                                                echo "Ciutat: " . $visitant[1] ."<br/>";
                                                echo "País: " . $visitant[2] ."<br/>";
                                                echo "Coor: " . $visitant[3] ."<br/>";

                                        ?>
                                        <dt>Localització:</dt>
                                        <a href="http://maps.google.com/maps?q=figueres&ll=42.2667,2.9667&spn=0.005245,0.010620&t=h&hl=en">
                                        <span class="geo"><abbr class="latitude" title="42.2667">42.2667</abbr> <abbr class="longitude"
                                        title="2.120052">2.9667</abbr></span></a>
                                          <div itemprop="contentLocation">
                                          <div itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
                                            <meta itemprop="longitude" content="2.9667" />
                                            <meta itemprop="latitude" content="42.2667" />
                                          </div>
					<!--<p class="tag"><a href="#">dolor</a> <a href="#">ipsum</a> <a href="#">lorem</a> <a href="#">sit amet</a> <a href="#">dolor</a> <a href="#">ipsum</a> <a href="#">lorem</a> <a href="#">sit amet</a></p> -->
                                </li> 
				<li>
					<h2>Calendar</h2>
					<div id="calendar_wrap">
						<table summary="Calendar">
							<caption>
							October 2009
							</caption>
							<thead>
								<tr>
									<th abbr="Monday" scope="col" title="Monday">M</th>
									<th abbr="Tuesday" scope="col" title="Tuesday">T</th>
									<th abbr="Wednesday" scope="col" title="Wednesday">W</th>
									<th abbr="Thursday" scope="col" title="Thursday">T</th>
									<th abbr="Friday" scope="col" title="Friday">F</th>
									<th abbr="Saturday" scope="col" title="Saturday">S</th>
									<th abbr="Sunday" scope="col" title="Sunday">S</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<td abbr="September" colspan="3" id="prev"><a href="#" title="View posts for September 2009">&laquo; Sep</a></td>
									<td class="pad">&nbsp;</td>
									<td colspan="3" id="next">&nbsp;</td>
								</tr>
							</tfoot>
							<tbody>
								<tr>
									<td>1</td>
									<td>2</td>
									<td>3</td>
									<td id="today">4</td>
									<td>5</td>
									<td>6</td>
									<td>7</td>
								</tr>
								<tr>
									<td>8</td>
									<td>9</td>
									<td>10</td>
									<td>11</td>
									<td>12</td>
									<td>13</td>
									<td>14</td>
								</tr>
								<tr>
									<td>15</td>
									<td>16</td>
									<td>17</td>
									<td>18</td>
									<td>19</td>
									<td>20</td>
									<td>21</td>
								</tr>
								<tr>
									<td>22</td>
									<td>23</td>
									<td>24</td>
									<td>25</td>
									<td>26</td>
									<td>27</td>
									<td>28</td>
								</tr>
								<tr>
									<td>29</td>
									<td>30</td>
									<td>31</td>
									<td class="pad" colspan="4">&nbsp;</td>
								</tr>
							</tbody>
						</table>
					</div>
				</li>
				<li>
                                <div class="vevent">
                                            <a class="url" href="http://areasrecreativas.net16.net/web4/">http://areasrecreativas.net16.net/web4 </a>
                                            <span class="summary">Curs XML </span>:
                                            <abbr class="dtstart" title="2014-10-06">6 d'Octubre del 2014</abbr>-
                                            <abbr class="dtend" title="2014-12-15">15 de desembre del 2014</abbr>,
                                            formació no presencial <span class="location">Plataforma Odissea</span>
                                </div>
					<h2>Categories</h2>
					<ul>
						<li><a href="#">Aliquam libero</a></li>
						<li><a href="#">Consectetuer adipiscing elit</a></li>
						<li><a href="#">Metus aliquam pellentesque</a></li>
						<li><a href="#">Suspendisse iaculis mauris</a></li>
						<li><a href="#">Urnanet non molestie semper</a></li>
						<li><a href="#">Proin gravida orci porttitor</a></li>
						<li><a href="#">Aliquam libero</a></li>
						<li><a href="#">Consectetuer adipiscing elit</a></li>
						<li><a href="#">Metus aliquam pellentesque</a></li>
						<li><a href="#">Urnanet non molestie semper</a></li>
						<li><a href="#">Proin gravida orci porttitor</a></li>
						<li><a href="#">Aliquam libero</a></li>
						<li><a href="#">Consectetuer adipiscing elit</a></li>
						<li><a href="#">Metus aliquam pellentesque</a></li>
						<li><a href="#">Suspendisse iaculis mauris</a></li>
						<li><a href="#">Urnanet non molestie semper</a></li>
						<li><a href="#">Proin gravida orci porttitor</a></li>
						<li><a href="#">Metus aliquam pellentesque</a></li>
						<li><a href="#">Suspendisse iaculis mauris</a></li>
						<li><a href="#">Urnanet non molestie semper</a></li>
						<li><a href="#">Proin gravida orci porttitor</a></li>
						<li><a href="#">Metus aliquam pellentesque</a></li>
					</ul>
				</li>
			</ul>
		</div>
		<!-- end sidebars -->
		<div class="separador_blanc"">&nbsp;</div>
	</div>
	<!-- end page -->
</div>
<div id="footer">
	<p class="copyright">&copy;&nbsp;&nbsp;2009 All Rights Reserved &nbsp;&bull;&nbsp; Design by <a href="http://www.freecsstemplates.org/">Free CSS Templates</a>.</p>
	<p class="link"><a href="#">Privacy Policy</a>&nbsp;&#8226;&nbsp;<a href="#">Terms of Use</a></p>
</div>
<div class="autor">This template  downloaded form <a href='http://all-free-download.com/free-website-templates/'>free website templates</a></div></body>
</html>
