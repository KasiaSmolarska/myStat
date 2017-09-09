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

    document.getElementById('submitDataCallback').addEventListener('click', function () {
        ajax('addTask', function (data) {
            if (data['Status'] !== 'OK') {
                message.show(data['Description'], "warning");
                return;
            }

            message.show(data['Description']);
            var inputs = div.querySelectorAll('input[name]');

            for (var i = 0; i < inputs.length; i++) {
                var input = inputs[i];
                input.value = '';
            }

            reloadTasks();
        }, convertFormToPostData(div))
    })

}