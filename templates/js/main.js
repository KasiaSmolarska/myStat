/**
 *  Funkcja pobiera wszystkie taski i wyświetla je w formie tabsów z tabelką
 *  do poprawnego działania wymaga dowolnego elementu z id 'tasklist' 
 */
function reloadTasks() {
    ajax('getTasks', function (tasks) {
        var div = document.getElementById('tasksList');
        var taskTemplate = document.getElementById('taskTemplate').innerText;
        div.innerHTML = ejs.render(taskTemplate, { data: tasks });
        createTabTask(div);
    });
}

window.addEventListener('load', function () {
    reloadTasks();
})

/**
 *  Funkcja tworzy logikę dla tabsów (podpina eventy
 *  na headery oraz wywołuje funkcję do ukrywania tasków)
 *  @param {element} element - element HTML
 */
function createTabTask(element) {
    var tabsButton = element.querySelectorAll('.task__Header');
    var tasks = element.querySelectorAll('.task__element');
    var activeGroup = localStorage.getItem("activeGroup");

    showGroup(activeGroup || tabsButton[0].dataset.group);

    for (var i = 0; i < tabsButton.length; i++) {
        tabsButton[i].addEventListener("click", function () {
            var groupName = this.dataset.group;
            showGroup(groupName);
        });
    }

    /**
     * Wewnętrzna funkcja createTabTask, odpowiada za
     * określanie aktywnego nagłówka oraz 
     * filtrowanie po nazwie grupy
     * @param {string} groupName nazwa grupy zaczynająca się wielką literą
     */
    function showGroup(groupName) {
        localStorage.setItem('activeGroup', groupName);

        for (var i = 0; i < tabsButton.length; i++) {
            if (tabsButton[i].dataset.group !== groupName) {
                tabsButton[i].classList.remove("active");
            } else {
                tabsButton[i].classList.add('active');
            }
        }
        for (i = 0; i < tasks.length; i++) {
            if (tasks[i].dataset.group !== groupName) {
                tasks[i].style.display = "none";
            } else {
                tasks[i].style.display = "table-row";
            }
        }
    }
}

function submitAddTask(form) {
    var postData = convertFormToPostData(form);

    ajax('addTask', function (ajaxData) {
        if(ajaxData['Status'] !== 'OK'){
            showMessage(ajaxData['Description']);
            return;
        }

        showMessage(ajaxData['Description']);
        reloadTasks();
    }, postData)
}

function removeTask(id, title) {
    openModal('modalConfirm', function (data) {

        if (data == 'ok') {
            ajax('removeTask', function () {
                openModal('modalAlert', '', "Zadanie zostało usunięte!");
                reloadTasks();
            }, "id=" + id)
        }

        console.log(data);
    }, "Czy na pewno chcesz usunąć to zadanie o nazwie: <br/> " + title + "?");
}

function showNewTask() {

    openModal('addNewTask', function (status, modal) {
        submitAddTask(modal);
    }, 'Dodaj nowe zadanie!');
}

function editTask(id, title, status, groups) {

    var modalTemplate = document.getElementById('modalTemplate').innerText;
    var contentTemplate = document.getElementById('editTaskTemplate').innerText;
    var content = ejs.render(contentTemplate, {
        id: id,
        title: title,
        status: status,
        groups: groups
    });
    var elem = document.createElement('div');
    elem.innerHTML = ejs.render(modalTemplate, {
        title: "Czy na pewno chcesz zmienić zadanie?",
        content: content
    });
    var modal = elem.querySelector('.modal');
    document.body.appendChild(modal);

    modalOperationsOnClick(modal, function (data) {
        var postData = convertFormToPostData(modal);
        ajax('editTask', function (ajaxData) {

            if (ajaxData['status'] === 'ok') {
                showMessage("Zadanie: '" + title + "' zostało zmienione");
                reloadTasks();
            }
        }, postData + "&id=" + id)
    });

}
