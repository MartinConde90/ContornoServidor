<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
<html> 
<body>
  <h2>My Books Collection</h2>
  <table border="1">
    <tr bgcolor="#9acd32">
    <th style="text-align:left">Id</th>
      <th style="text-align:left">Autor</th>
      <th style="text-align:left">Titulo</th>
      <th style="text-align:left">Genero</th>
      <th style="text-align:left">Precio</th>
      <th style="text-align:left">Fecha de publicacion</th>
      <th style="text-align:left">descripcion</th>
    </tr>
    <xsl:for-each select="catalog/book">
    <tr>
      <td><xsl:value-of select="./@id"/></td>
      <td><xsl:value-of select="author"/></td>
      <td><xsl:value-of select="title"/></td>
      <td><xsl:value-of select="genre"/></td>
      <td><xsl:value-of select="price"/></td>
      <td><xsl:value-of select="publish_date"/></td>
      <td><xsl:value-of select="description"/></td>
    </tr>
    </xsl:for-each>
  </table>
</body>
</html>
</xsl:template>
</xsl:stylesheet>