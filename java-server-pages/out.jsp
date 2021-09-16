<%-- 
    Document   : out
    Created on : 13 de set de 2021, 17:41:18
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
        <p>
        <%
            out.print("Saída");
        %>
        </p>
        <p><%= "Saída 2" %></p>
    </body>
</html>
