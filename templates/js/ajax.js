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