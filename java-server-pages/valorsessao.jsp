<%-- 
    Document   : valorsessao
    Created on : 13 de set de 2021, 19:16:13
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
        <h1>Hello World!</h1>
        
        <%!
        String strIDKey = new String("userID");
        int userID;
        %>
        
        <%
        HttpSession secao = request.getSession(false);
        if (!session.isNew()) {
            out.println("Sessão existe");
            userID = (int)session.getAttribute(strIDKey);
            out.println(userID);
            out.println("<a href=\"eliminarsessao.jsp\">Sair</a>");
            }
        else {
            out.println("Sessão não existe");
            out.println("<a href=\"login.html\">Login</a>");
            }
        %>
    </body>
</html>
