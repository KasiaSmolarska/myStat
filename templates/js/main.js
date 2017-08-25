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
    openModal('modalConfirm', function(data){

        if(data == 'ok'){
            ajax('removeTask', function(){
                openModal('modalAlert','', "Zadanie zostało usunięte!");
                reloadTasks();
            }, "id=" + id)
        }

        console.log(data);
    },"Czy na pewno chcesz usunąć to zadanie?");    
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
                var status = this.dataset.callback;
                    
                if (typeof callback === "function") {
                     callback(status);
                }
               
            });
            
        }
}

function showNewTask(){
  
   openModal('addNewTask', function () {     
   },'Dodaj nowe zadanie!');
}