<?php
ob_start('limpiar');
function limpiar($buffer){
    return trim($buffer);
} 
include_once '../lib/llibreria.php'; 
connectar();
$res=mysql_query("SELECT * FROM visites;"); // consulta SQL 
// Capçalera fitxer XML a generar
$t ='<?xml version="1.0" encoding="utf-8" ?>' .chr(13).chr(10) ;
$t .= '<kml xmlns="http://www.opengis.net/kml/2.2">' . chr(13) . chr(10) ; // etiqueta arrel
$t .= '<Document>' . chr(13) . chr(10) ; // etiqueta Document
$t .= '<name>Visites </name> ' .  chr(13) . chr(10) ;
$t .= '<description></description>' . chr(13) . chr(10) ;
$t .= '<Folder>' . chr(13) . chr(10) ;
$t .= '<name>Localitzacions</name>' . chr(13) . chr(10) ;
$t .= "<Style id='ciutat'>"  . chr(13) . chr(10) ;
$t .= "<IconStyle>"   . chr(13) . chr(10) ;
//$t .= "<color>ff0000ff</color>"  . chr(13) . chr(10) ;
$t .= "<scale>1.1</scale>"  . chr(13) . chr(10) ;
$t .= "<Icon>"  . chr(13) . chr(10) ;
$t .= "<href>http://areasrecreativas.net16.net/web4/images/img01.jpg</href>"  . chr(13) . chr(10) ;
$t .= "</Icon>"  . chr(13) . chr(10) ;
$t .= "</IconStyle>"  . chr(13) . chr(10) ;
$t .= "</Style>"  . chr(13) . chr(10) ;
// A partir de la consulta anirem omplint cada node
for($x=0; $x < mysql_num_rows($res);$x++) // Bucle per recorrer tots els registres
{
$t .= '<Placemark>' . chr(13) . chr(10) ; // Obrim node de cada lloc
$t .= "<styleUrl>#basket</styleUrl> " . chr(13) . chr(10) ; // defineix l'estil de l'icona del lloc 
$t .= '<name>'. utf8_encode(mysql_result($res,$x,"ciutat")) . "</name>" . chr(13) . chr(10) ;
$t .= '<description>'. mysql_result($res,$x,"ciutat") . '</description>' . chr(13) . chr(10) ;
//$t .='<description>'. utf8_encode(mysql_result($res,$x,"descripcio")) . "</description>" . chr(13) . chr(10) ;
$t .= '<Point>';
$t .= '<coordinates>'. utf8_encode(mysql_result($res,$x,"coordenades")) . "</coordinates>" . chr(13) . chr(10) ;
$t .= '</Point>' . chr(13) . chr(10) ;
$t .= '</Placemark>' . chr(13) . chr(10) ;
}
$t .= '</Folder>' . chr(13) . chr(10) ;
$t .= '</Document>' . chr(13) . chr(10) ; // etiqueta Document
$t .= '</kml>';
header("Content-type: text/xml; charset=utf-8"); // Capçalera de fitxer XML
echo $t ;
ob_end_flush(); 
?>