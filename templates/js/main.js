window.onload = function(){
    ajax('getTask', function (data) {

    var div = document.getElementById('tasksList');
    var taskTemplate = document.getElementById('taskTemplate').innerText;
    div.innerHTML = ejs.render( taskTemplate, {data: data});
    createTabTask(div);
});
}

function createTabTask(element){
    var tabsButton = element.querySelectorAll('.task__Header');
    var tasks = element.querySelectorAll('.task__element');

    showGroup(tabsButton[0].dataset.group);
    
    for (var i = 0; i < tabsButton.length; i++) {
        tabsButton[i].addEventListener("click", function(){
        var groupName = this.dataset.group;
        
        showGroup(groupName);
        });
    }
    function showGroup(groupName) {
        for (var i = 0; i < tabsButton.length; i++) {
            if(tabsButton[i].dataset.group !== groupName){
                tabsButton[i].classList.remove("active");
            }
            else{
                tabsButton[i].classList.add('active');
            }
        }
        for (i = 0; i < tasks.length; i++) {
            if( tasks[i].dataset.group !== groupName){
                tasks[i].style.display = "none";
            }
            else{
                tasks[i].style.display = "table-row";
            }
        } 
    }
}