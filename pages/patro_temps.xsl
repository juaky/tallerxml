<?xml version="1.0" encoding="ISO-8859-1"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">

<xsl:for-each select="current">

<img>
<xsl:attribute name="src">
<xsl:value-of select='concat("http://openweathermap.org/img/w/", weather/@icon , ".png")' />
</xsl:attribute>

<xsl:attribute name="width">
<xsl:value-of select='200' />
</xsl:attribute>

</img>

<br />
<b> <xsl:value-of select="temperature/@value" />ºC</b>

</xsl:for-each>

</xsl:template>
</xsl:stylesheet>
