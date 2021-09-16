<%-- 
    Document   : do-login
    Created on : 13 de set de 2021, 17:49:01
    Author     : vinicius
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@page import="java.lang.*" %>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <h1>Tentando fazer login</h1>
        <%!
            String login, senha;
            String key_userID = new String("userID");
            int value_userID = 1000;
        %>
        <%
            login = request.getParameter("login");
            senha = request.getParameter("senha");
            // Em Java strings criadas de maneiras diferentes podem ser objetos diferentes
            // então é melhor usar o método .equals pra comparar strings
            if (login.equals("root") && senha.equals("1234")){
                out.println("Login com sucesso");
                session.setAttribute(key_userID, value_userID);
            }
            else
                out.println("."+login.getClass()+".");
        %>
    </body>
</html>
