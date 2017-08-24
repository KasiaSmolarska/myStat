function reloadTasks(){
    ajax('getTasks', function (data) {

    var div = document.getElementById('tasksList');
    var taskTemplate = document.getElementById('taskTemplate').innerText;
    div.innerHTML = ejs.render( taskTemplate, {data: data});
    createTabTask(div);
});
}
window.onload = function(){
    reloadTasks();
    openModal('modalConfirm', function(data){
        console.log(data);

    },"Czy na pewno chcesz usunąć to zadanie?");
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

function submitAddTask(form) {
   var inputs = form.querySelectorAll('[name]');
   var addtaskValues = [];
   for (var i = 0; i < inputs.length; i++) {
       var input = inputs[i];
       addtaskValues.push(input.name + '=' + input.value);
   }
   var postData = addtaskValues.join('&');
   
   ajax('addTask', function (){
    console.log("dziwacznie");
    reloadTasks();
   }, postData)
}

function removeTask(id) {
    var result = confirm("Czy napewno chcesz usunąć to zadanie o id:" + id);
    if(result){
        ajax('removeTask', function(){
            alert("Twoje zadanie zostało usunięte!");
            reloadTasks();
        }, "id=" + id)
    }
}

function openModal(templateID, callback, title){
    var modalTemplate = document.getElementById('modalTemplate').innerText;
    var contentTemplate = document.getElementById(templateID).innerText;
    var content = ejs.render(contentTemplate,{});
    var elem = document.createElement('div');
    elem.innerHTML = ejs.render( modalTemplate, {
        title: title,
        content : content
    });
    var modal = elem.querySelector('.modal');
    document.body.appendChild(modal);

    var dataCallback = modal.querySelectorAll('[data-callback]');

        for (var i = 0; i < dataCallback.length; i++) {
            var button = dataCallback[i];
            
            button.addEventListener('click', function(){
                modal.remove();
                callback(this.dataset.callback);
            });
            
        }
}