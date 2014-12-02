<?php

function connectar()
{
mysql_connect("localhost","a6988338_acb",""); // Connexió servidor Mysql
mysql_select_db("a6988338_acb"); // Escollim Base de Dades

}


function loginar($usuari,$password)
    {
        $sql = "SELECT * FROM usuaris WHERE usuari='$usuari' and contrasenya= MD5('$password') ";
        echo $sql ;
        $result = mysql_query($sql);
        if (mysql_num_rows($result) >0)  return 1;
        else return 0 ;
        
    }
function logout()
{
    session_start();
    unset($_SESSION["usuari"]);
    session_unset();
    header('location: index.php?accio=');
}

function visites()
{
// Recopilem les dades de l'entorn
$ip= $_SERVER["REMOTE_ADDR"] ;
$navegador = $_SERVER["HTTP_USER_AGENT"] ;
$idioma= $_SERVER["HTTP_ACCEPT_LANGUAGE"] ;
$pagina = $_SERVER["HTTP_REFERER"] ;
                
// Fem la crida a Geoplugin indicant la ip obtinguda de la variable d'entorn                 
 $geoplugin = unserialize( file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $_SERVER["REMOTE_ADDR"]) );

 // llegim amb format JSON el retorn del WS del Geoplugin
    $lat = $geoplugin['geoplugin_latitude'];
    $long = $geoplugin['geoplugin_longitude'];
    $codi_pais = $geoplugin['geoplugin_countryCode'];  
    $nom_pais= $geoplugin['geoplugin_countryName'];  
    $ciutat = $geoplugin['geoplugin_city'];   
    $coordenades = $geoplugin['geoplugin_latitude'] . ',' . $geoplugin['geoplugin_longitude'];      
    
// connectem amb la BD
//include_once("llibreria.php");
connectar();
//Comanda per inserir un registre en la taula visites de la BD mysql
$res = mysql_query("INSERT INTO visites (data,ip,pais,ciutat,idioma,navegador,coordenades) VALUES (now(),'$ip','$nom_pais','$ciutat','$idioma','$navegador','$coordenades')");
 
return array($ip,$ciutat,$nom_pais,$coordenades);

}
?>


