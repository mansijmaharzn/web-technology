<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                xmlns:ns="http://www.w3schools.com"
                exclude-result-prefixes="ns">
  
  <xsl:template match="/">
    <html>
      <head>
        <title>Bookstore</title>
        <style>
          table { border-collapse: collapse; width: 100%; }
          th, td { border: 1px solid black; padding: 8px; text-align: left; }
          th { background-color: #f2f2f2; }
        </style>
      </head>
      <body>
        <h2>Bookstore</h2>
        <table>
          <tr>
            <th>Category</th>
            <th>Title</th>
            <th>Language</th>
            <th>Author</th>
            <th>Year</th>
            <th>Price</th>
          </tr>
          <xsl:for-each select="ns:note/ns:bookstore/ns:book">
            <tr>
              <td><xsl:value-of select="@category"/></td>
              <td><xsl:value-of select="ns:title"/></td>
              <td><xsl:value-of select="ns:title/@lang"/></td>
              <td><xsl:value-of select="ns:author"/></td>
              <td><xsl:value-of select="ns:year"/></td>
              <td><xsl:value-of select="ns:price"/></td>
            </tr>
          </xsl:for-each>
        </table>
      </body>
    </html>
  </xsl:template>

</xsl:stylesheet>
