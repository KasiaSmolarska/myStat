<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="templates/css/index.css">
    <script src="templates/js/ejs.min.js"></script>
    <script src="templates/js/ajax.js"></script>
    <script src="templates/js/main.js"></script>

    <noscript id="taskTemplate">
<div class="task">
    <div class="task__headers">
        <% for (var key in data) { %>
             <% if (data.hasOwnProperty(key)) { %>

      <div class="task__Header">  <%= key %></div>

<% } %>
<% } %>

    </div>
<div class="task__container">
<% for (var key in data) { %>
    <% if (data.hasOwnProperty(key)) { %>

        <% var grupa = data[key]; %>

        <% for (var i = 0; i < grupa.length; i++) { %>

            <div class="task__element">
                <div class="checkbox">
                    <input type="checkbox" id="task<%= i %>">
                    <label for="task<%= i %>"></label>
                </div>

               <div class="task__title">
                    <%=  grupa[i].Title %>
               </div>
               <div >
                 <span class="task__status  <%= grupa[i].Status == 1 ? "task__status--done" : "task__status--undone"  %>" > 
                     <%= grupa[i].Status == 1 ? "Wykonano!" : "Do wykonania"  %> 
                 </span>
               </div>
               <div class="task__data">
                   <%= grupa[i].Date %>
               </div>

            </div>

        <% } %>
    <% } %>
<% } %>
</div>
</div>
    </noscript>
</head>
<body>

    <h1>hello majap!</h1>
    <div id="tasksList"></div>
    
</body>
</html>