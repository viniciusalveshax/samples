<%-- 
    Document   : exemplo
    Created on : 13 de set de 2021, 16:39:49
    Author     : vinicius
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <h1>Exemplo básico</h1>
        
        <%
        int i;
        for (i=0; i<4; i++)
            out.println("N = " + i + "<br />");      
        %>
        
        <p>
            <%= i %>
        </p>
    </body>
</html>
