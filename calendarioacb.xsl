<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
  <html>
  <head>
  <script>
  var cl="";  
</script>

<style>
table {
   width: 480px;
   border: 2px solid #00f;
   align: right;
   left-margin: 10px;
}
td.petit, th.petit
{
width: 40px;
}
td.normal {
width : 80px;
}


caption {
   padding: 0.3em;
   color: #fff;
    background: #f00;
    font-size : 18px;
}
th {
   background: #cccccc;
}

</style>
  </head>
  <body>
    
<table border="1" width="400">
<caption> Calendari ACB Jornada 3</caption>
<tbody>
<th class="normal">Equip Local</th>
<th class="normal">Equip Visitant</th>
<th class="petit">Puntuació local</th>
<th class="petit">Puntuació visitant</th>
</tbody>


    <xsl:for-each select='a6988338_acb/calendari[jornada=3]' >   <!-- Filtre els jugadors en la psoció de Base -->
    <xsl:sort select="jornada" />                                      
<!-- <xsl:if test="position() &lt;= 5">   Només mostra si la posició en el node és mes petita o igual 5  -->
<tr onmouseover="cl=this.style.background;  this.style.background='pink';" onmouseout="this.style.background=cl;" >    <!-- Efecte resaltador al pasar ratoli -->
<!-- <xsl:if test="nacionalitat ='ESP'"><xsl:attribute name="bgcolor">yellow</xsl:attribute></xsl:if>   Si és de nacionalitat ESP posa color groc de fons -->
<td> <xsl:value-of select="equip_local" /></td>
<td><xsl:value-of select="equip_visitant" /></td>
<td><xsl:value-of select="punts_local" /></td>
<td><xsl:value-of select="punts_visitant" /></td>

</tr>
<!-- </xsl:if>     -->
   </xsl:for-each>

</table>  
  </body>
  </html>
</xsl:template>
</xsl:stylesheet>
