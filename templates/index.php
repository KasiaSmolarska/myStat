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
                        <% var colors = ['red', 'green', 'yellow', 'brown']; %>
                        <% var icons = ['emoticon-sad', 'emoticon-cool', 'emoticon-neutral', 'emoticon-poop' ];%>
                         <i style="color:<%= colors[grupa[i].Status]%>" class="mdi mdi-<%= icons[grupa[i].Status] %> "></i>
                        </span>
                    </span>
                    </td>
                    <td>
                    <span class="task__data">
                        <%= grupa[i].Date %>
                    </span>
                    </td>
                    <td class="task__edit">
                        <a title="Edytuj zadanie" href="javascript:"><i onclick="editTask(<%= grupa[i].ID %>,'<%= grupa[i].Title %>', <%= grupa[i].Status %>, '<%= grupa[i].Groups %>');" class="mdi mdi-pencil"></i></a>
                    </td>
                    <td class="task__delete">
                        <a title="Usuń zadanie" href="javascript:"><i onclick="removeTask(<%= grupa[i].ID %>,'<%= grupa[i].Title %>');" class="mdi mdi-delete"></i></a>
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
                        <%- title %>
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
        
    
    <div class="task__new form">
        
        <div class="form__row">
            <label class="form__label">Tytuł zadania: </label>
            <input class="form__input" type="text" name="title">
        </div>
        <div class="form__row form__row--radio">
            <label class="form__label">Status zadania: </label>
            <input type="radio" name="status" value="0" id="emoticon-sad"> <label for="emoticon-sad"><i style="color:red;" class="mdi mdi-emoticon-sad"></i></label>
            <input type="radio" name="status" value="1" id="emoticon-cool"> <label for="emoticon-cool"><i style="color:green;" class="mdi mdi-emoticon-cool"></i></label>
            <input type="radio" name="status" value="2" id="emoticon-neutral"> <label for="emoticon-neutral"><i style="color:yellow;" class="mdi mdi-emoticon-neutral"></i></label>
            <input type="radio" name="status" value="3" id="emoticon-poop"><label for="emoticon-poop"><i style="color:brown;" class="mdi mdi-emoticon-poop"></i></label>
        </div>
        <div class="form__row">
            <label class="form__label">Wybierz grupę: </label>
            <select class="form__input" name="group">
                    <option value="Bugs">Bugs</option>
                    <option value="Website">Website</option>
                    <option value="Server">Server</option>
                    <option value="Other">Other</option>
            </select>
        </div>
        <input id="submitDataCallback" class="button button--succes" type="button" value="Dodaj zadanie!" data-callback="ok">
    </div>
    </noscript>

    <noscript id="editTaskTemplate">

       <form class=" task__edit form" onsubmit="return false;">
            <div class="form__row">
                <label class="form__label">Tytuł zadania: </label>
                <input class="form__input" type="text" name="title" value="<%= title %>">
            </div>
            <div class="form__row  form__row--radio">
                <label class="form__label">Status zadania: </label>
                <input type="radio" name="status" value="0" <%= status===0 ? "checked" : '' %> id="emoticon-sad"> <label for="emoticon-sad"><i style="color:red;" class="mdi mdi-emoticon-sad"></i></label>
                <input type="radio" name="status" value="1" <%= status===1 ? "checked" : '' %> id="emoticon-cool"> <label for="emoticon-cool"><i style="color:green;" class="mdi mdi-emoticon-cool"></i></label>
                <input type="radio" name="status" value="2" <%= status===2 ? "checked" : '' %> id="emoticon-neutral"> <label for="emoticon-neutral"><i style="color:yellow;" class="mdi mdi-emoticon-neutral"></i></label>
                <input type="radio" name="status" value="3" <%= status===3 ? "checked" : '' %> id="emoticon-poop"><label for="emoticon-poop"><i style="color:brown;" class="mdi mdi-emoticon-poop"></i></label>
            </div>
            <div class="form__row">
                <label class="form__label">Wybierz grupę: </label>
                <select class="form__input" name="groups" value="<%= groups %>">
                    <option <%= groups === "Bugs" ? "selected" : '' %> value="Bugs">Bugs</option>
                    <option  <%= groups === "Website" ? "selected" : '' %> value="Website">Website</option>
                    <option  <%= groups === "Server" ? "selected" : '' %> value="Server">Server</option>
                    <option  <%= groups === "Other" ? "selected" : '' %> value="Other">Other</option>
                </select>
            </div>       
        <button class="button button--succes" data-callback="ok" type="button">OK</button> <button class="button button--failure" data-callback="cancel" type="button">Anuluj</button>
        
    </form>
    </noscript>


</head>
<body>
    <header>
     <h1>hello majap!</h1>
    </header>
   
    <div id="tasksList"> </div>
    
    <div class="task__newContainer">
            <button id="newTaskAction" onclick="showNewTask();" class="button button--succes button--newTask" data-callback="ok" type="button">Dodaj nowe zadanie!</button>
    </div>
   
    
</body>
</html>