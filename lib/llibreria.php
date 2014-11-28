<?php

function connectar()
{
mysql_connect("localhost","a6988338_acb","Romario10@"); // Connexió servidor Mysql
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

?>


