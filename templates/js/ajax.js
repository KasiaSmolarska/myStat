 function ajax(action, callback, postData){
        var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        
        if(request.readyState == 4){

           var text = request.responseText;
           var arr = JSON.parse(text);

           callback(arr);
        }

    }
    
    request.open('POST', 'http://localhost/majap/index.php?action='+ action, false); 
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(postData !== undefined ? postData : null);

    }