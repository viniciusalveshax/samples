<%-- 
    Document   : recebe
    Created on : 13 de set de 2021, 15:59:57
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
        <h1>Recebendo parâmetros ..</h1>
        
        <p><%= request.getParameter("name") %></p>
    </body>
</html>
