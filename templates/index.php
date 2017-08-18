<h1>hello majap!</h1>
<ul id="bull"></ul>

<script>
    function ajax(action, callback){
        var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        
        if(request.readyState == 4){

           var text = request.responseText;
           var arr = JSON.parse(text);

           callback(arr);
        }

    }

    request.open('GET', 'http://localhost/majap/index.php?action='+ action, false); 
    request.send(null);

    }






























































ajax('getTask', function (data){

    var div = document.getElementById('bull');
    for(var i = 0; i < data.length; i++){
        
        var elem = "<li>" + data[i].Title + "</li>";
        
        div.innerHTML += elem;
        
    }

});






</script>


