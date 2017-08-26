<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.materialdesignicons.com/2.0.46/css/materialdesignicons.min.css">
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
                    <td class="tesk__edit">
                        <a title="Edytuj zadanie" href="javascript:"><i onclick="editTask(<%= grupa[i].ID %>,'<%= grupa[i].Title %>', <%= grupa[i].Status %>, '<%= grupa[i].Groups %>');" class="mdi mdi-pencil"></i></a>
                    </td>
                    <td class="task__delete">
                        <a title="Usuń zadanie" href="javascript:"><i onclick="removeTask(<%= grupa[i].ID %>);" class="mdi mdi-delete"></i></a>
                    </td>
                    </tr>

                <% } %>
            <% } %>
        <% } %>
        </table>
        </div>
    </noscript>

    <noscript id="modalTemplate">
        <div class="modal">
            <div class="modal__window">
                <div class="modal__header">
                    <div class="modal__title">
                        <%= title %>
                    </div>
                    <div data-callback="cancel" class="modal__exit">
                        x
                    </div>
                </div>
                <div class="modal__content">
                   <%- content %>
                </div>
            </div>
        </div>
    </noscript>

    <noscript id="modalConfirm">
        <div class="confirm">
            <button class="button button--succes" data-callback="ok" type="button">OK</button> <button class="button button--failure" data-callback="cancel" type="button">Anuluj</button>
        </div>
    </noscript>

    <noscript id="modalAlert">
        <div class="alert">
            <button class="button button--succes" data-callback="ok">OK</button>
        </div>
    </noscript>

    <noscript id="addNewTask">
        
    
    <form class=" task__new" onsubmit="submitAddTask(this); return false;">
        <div class="row">
        <label class="col-xs-12">Tytuł zadania: <input type="text" name="title"></label>
        <label class="col-xs-12">Status zadania: <input type="text" name="status"></label>
        <label class="col-xs-12">Wybierz grupę: 
            <select name="group">
                <option value="Bugs">Bugs</option>
                <option value="Website">Website</option>
                <option value="Server">Server</option>
                <option value="Other">Other</option>
            </select>
        <input type="submit" value="Dodaj zadanie!">
        </label>
        </div>
    </form>
    </noscript>

    <noscript id="editTaskTemplate">

       <form class=" task__edit" onsubmit="return false;">
        <div class="row">
        <label class="col-xs-12">Tytuł zadania: <input type="text" name="title" value="<%= title %>"></label>
        <label class="col-xs-12">Status zadania: <input type="text" name="status" value="<%= status %>"></label>
        <label class="col-xs-12">Wybierz grupę: 
            <select name="groups" value="<%= groups %>">
                <option <%= groups === "Bugs" ? "selected" : '' %> value="Bugs">Bugs</option>
                <option  <%= groups === "Website" ? "selected" : '' %> value="Website">Website</option>
                <option  <%= groups === "Server" ? "selected" : '' %> value="Server">Server</option>
                <option  <%= groups === "Other" ? "selected" : '' %> value="Other">Other</option>
            </select>
        <button class="button button--succes" data-callback="ok" type="button">OK</button> <button class="button button--failure" data-callback="cancel" type="button">Anuluj</button>
        </label>
        </div>
    </form>
    </noscript>


</head>
<body>
    <header>
     <h1>hello majap!</h1>
    </header>
   
    <div id="tasksList"> </div>
    
    <div class="task__newContainer">
            <button id="newTaskAction" onclick="showNewTask();" class="button button--succes" data-callback="ok" type="button">Dodaj nowe zadanie!</button>
    </div>
   
    
</body>
</html>