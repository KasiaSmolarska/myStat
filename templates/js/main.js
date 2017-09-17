/**
 *  Funkcja pobiera wszystkie taski i wyświetla je w formie tabsów z tabelką
 *  do poprawnego działania wymaga dowolnego elementu z id 'tasklist' 
 */
function reloadTasks() {
    var sort = localStorage.getItem('sortBy') || 'ID';
    var sortDirection = localStorage.getItem('sortDir') || 'ASC';

    ajax('getTasks', function (tasks) {
        var div = document.getElementById('tasksList');
        var taskTemplate = document.getElementById('taskTemplate').innerText;
        div.innerHTML = ejs.render(taskTemplate, { 
            data: tasks, 
            sort : {
                'name' : sort,
                'dir' : sortDirection
            } });
        var sortableHeaders = div.querySelectorAll("[data-sort]");
        for(var i = 0; i < sortableHeaders.length; i++){
            var sortableHeader = sortableHeaders[i];

            sortableHeader.addEventListener('click', function () {
             
                if( sort === this.dataset.sort){
                    if (sortDirection === 'ASC') {
                       
                        localStorage.setItem('sortDir', 'DESC');
                    } else{
                       
                        localStorage.setItem('sortDir', 'ASC');
                    }
                } else{
                     
                    localStorage.setItem('sortDir', 'ASC');
                }

                localStorage.setItem('sortBy', this.dataset.sort);
               
                reloadTasks();


            })

        }
       // createTabTask(div);
    }, "sort=" + sort + "&sortDir=" + sortDirection + "&" + convertFormToPostData(document.getElementById('filterTasks')) + "&searcher=" + document.getElementById('taskSearcher').value);
}

function clearFilterData() {
    var inputs = document.querySelectorAll('.filter__inputs .form__input');

    for (var i = 0; i < inputs.length; i++) {
        inputs[i].value = '';
    }

    reloadTasks();
}

window.addEventListener('load', function () {

    var taskList = document.getElementById('tasksList');
    if (taskList !== null) {
        reloadTasks();
    }

})


function showUserData() {

    ajax('getUserData', function (data) {
        var div = document.getElementById('dane');
        var taskTemplate = document.getElementById('userData').innerText;
        div.innerHTML = ejs.render(taskTemplate, { data: data });

        //tu jest funkcja
        ajax('getProfilStats', function (data) {
            var contex = document.getElementById('profilTaskChart').getContext('2d');
            var myPieChart = new Chart(contex, {
                type: 'pie',
                data: {
                    labels: ["Ukończono: " + data.procentage.done + " ( " + data.taskDone + " zadań )", "Do zrobienia: " + data.procentage.undone + " ( " + data.taskUndone + " zadań )"],
                    datasets: [{
                        label: "Taski: ",
                        data: [data.taskDone, data.taskUndone],
                        backgroundColor: [
                            'rgba(33, 184, 13, 0.86)',
                            'rgba(206, 73, 1, 0.86)'
                        ]
                    }]
                },
                options: {
                    cutoutPercentage: 10,
                    legend: {
                        display: true,
                        labels: {
                            fontColor: 'rgb(0, 0, 0)',
                            fontSize: 13
                        }
                    }
                }
            });
            console.log(data);
        })
    });


}

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
            if (tasks[i].dataset.group === undefined) {
                break;
            }
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
        if (ajaxData['Status'] !== 'OK') {
            message.show(ajaxData['Description'], "warning");
            return;
        }

        message.show(ajaxData['Description']);
        reloadTasks();
    }, postData)
}



function showNewTask() {

    openModal('addNewTask', function (status, modal) {
        if(status !== "ok"){
            message.show("zadanie nie zostało dodane!", "warning");
            return;
        }
        submitAddTask(modal);
    }, 'Dodaj nowe zadanie!');
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
          if(data !== "ok"){
            message.show('Nie zmieniłeś treści zadania!', "warning");
            return;
        }
        var postData = convertFormToPostData(modal);
        ajax('editTask', function (ajaxData) {

            if (ajaxData['status'] === 'ok') {
                message.show("Zadanie: '" + title + "' zostało zmienione");
                reloadTasks();
            }
        }, postData + "&id=" + id)
    });

}


function editUserData(FirstName, SecondName, Sex, City, Job) {

    var modalTemplate = document.getElementById('modalTemplate').innerText;
    var contentTemplate = document.getElementById('editUserData').innerText;
    var content = ejs.render(contentTemplate, {
        FirstName: FirstName,
        SecondName: SecondName,
        SexValue: Sex,
        City: City,
        Job: Job
    })

    var elem = document.createElement('div');
    elem.innerHTML = ejs.render(modalTemplate, {
        title: "Czy na pewno chcesz swoje dane?",
        content: content
    });
    var modal = elem.querySelector('.modal');
    document.body.appendChild(modal);

    modalOperationsOnClick(modal, function (data) {
        if(data !== "ok"){
            message.show('Nie zmieniłeś swoich danych!', "warning");
            return;
        }

        var postData = convertFormToPostData(modal);
        ajax('editUserData', function (ajaxData) {

                if (ajaxData['status'] === 'ok') {
                    message.show("Twoje dane zostały zmienione");
                    showUserData();
                }
            }, postData)
    });

    console.log(FirstName, SecondName, Sex, City, Job);

}
