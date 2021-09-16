<%-- 
    Document   : eliminarsessao
    Created on : 13 de set de 2021, 19:33:28
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
        <h1>Invalidando a sessão</h1>
        
        <%
            session.invalidate();
        %>
    </body>
</html>
