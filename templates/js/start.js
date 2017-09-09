function taskTileStats() {
    ajax('getProfilStats', function (data) {
        console.log(data);
        document.getElementById('taskDoneTile').innerText = data.taskSummary;
        document.getElementById('taskUndoneTile').innerText = data.taskUndone;
    })
}

window.addEventListener('load', function(){
    taskTileStats();
})