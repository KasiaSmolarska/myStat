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
                    <td>
                        <a href="javascript:"><i onclick="removeTask(<%= grupa[i].ID %>);" class="mdi mdi-delete"></i></a>
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
                        brawo my:)
                    </div>
                    <div class="modal__exit">
                        x
                    </div>
                </div>
                <div class="modal__content">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, accusamus.
                </div>
            </div>
        </div>
    </noscript>
</head>
<body>

    <h1>hello majap!</h1>
    <div id="tasksList"></div>
    <form onsubmit="submitAddTask(this); return false;">
        <label>Tytuł zadania: <input type="text" name="title"></label>
        <label>Status zadania: <input type="text" name="status"></label>
        <label>Wybierz grupę: 
            <select name="group">
                <option value="Bugs">Bugs</option>
                <option value="Website">Website</option>
                <option value="Server">Server</option>
                <option value="Other">Other</option>
            </select>
        <input type="submit" value="Dodaj zadanie!">
        </label>

    </form>
</body>
</html>