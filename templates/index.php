<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="templates/css/index.css">
    <script src="templates/js/ejs.min.js"></script>
    <script src="templates/js/ajax.js"></script>
    <script src="templates/js/main.js"></script>

    <noscript id="taskTemplate">
<div class="task">
    <div class="task__headers">
        <% for (var key in data) { %>
             <% if (data.hasOwnProperty(key)) { %>

      <div class="task__Header"  data-group="<%= key %>">  <%= key %></div>

<% } %>
<% } %>

    </div>
<table class="task__container">
<% for (var key in data) { %>
    <% if (data.hasOwnProperty(key)) { %>

        <% var grupa = data[key]; %>

        <% for (var i = 0; i < grupa.length; i++) { %>

            <tr class="task__element" data-group="<%= grupa[i].Groups %>">
                <td>
                <span class="checkbox">
                    <input type="checkbox" id="task<%= i %>">
                    <label for="task<%= i %>"></label>
                </span>
                </td>
                <td>
               <span class="task__title">
                    <%=  grupa[i].Title %>
               </span>
               </td>
               <td>
               <span >
                 <span class="task__status  <%= grupa[i].Status == 1 ? "task__status--done" : "task__status--undone"  %>" > 
                     <%= grupa[i].Status == 1 ? "Wykonano!" : "Do wykonania"  %> 
                 </span>
               </span>
               </td>
               <td>
               <span class="task__data">
                   <%= grupa[i].Date %>
               </span>
               </td>
            </tr>

        <% } %>
    <% } %>
<% } %>
</table>
</div>
    </noscript>
</head>
<body>

    <h1>hello majap!</h1>
    <div id="tasksList"></div>
    
</body>
</html>