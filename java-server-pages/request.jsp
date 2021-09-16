<%-- 
    Document   : request
    Created on : 13 de set de 2021, 17:38:37
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
        <h1>O objeto request</h1>
    
        IP: <%= request.getRemoteAddr() %> <br /><!-- comment -->
        Host: <%= request.getRemoteHost() %>
        
    </body>
</html>
