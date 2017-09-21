function showTileTaskStats() {
    ajax('getProfilStats', function (data) {
        document.getElementById('taskDoneTile').innerText = data.taskSummary;
        document.getElementById('taskUndoneTile').innerText = data.taskUndone;
    })
}

window.addEventListener('load', function () {
    showTileTaskStats();
    reloadTasks();
    showTileAddTask();
})

//nadpisanie funkcji reloadTask na stronę "Start"
function reloadTasks() {
    ajax('getFiveLastTasks', function (tasks) {
        var div = document.getElementById('tileTasks');
        var taskTemplate = document.getElementById('taskTile').innerText;
        div.innerHTML = ejs.render(taskTemplate, { data: tasks });
        createTabTask(div);
        showTileTaskStats();
    });
}

function showTileAddTask() {
    var div = document.getElementById('tileAddNewTask');
    var addNewTask = document.getElementById('addNewTask').innerText;
    div.innerHTML = ejs.render(addNewTask, {});

    setActiveTaskGroup(div);

    document.getElementById('submitDataCallback').addEventListener('click', function () {
        ajax('addTask', function (data) {
            if (data['Status'] !== 'OK') {
                message.show(data['Description'], "warning");
                return;
            }

            message.show(data['Description']);
            var input = div.querySelector('input[name="title"]');
            input.value = '';

            reloadTasks();
        }, convertFormToPostData(div))
    })

}

function setActiveTaskGroup(element) {

    var group = element.querySelector('select[name="group"]');
    var activeGroup = localStorage.getItem("activeGroup");

    group.value = activeGroup;
}