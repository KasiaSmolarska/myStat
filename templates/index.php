<h1>hello majap!</h1>

<script>
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        
        if(request.readyState == 4){

           var text = request.responseText;
           var arr = JSON.parse(text);

           console.log(arr);
        }

    }

    request.open('GET', 'http://localhost/majap/index.php?action=getTask', false); 
request.send(null);
</script>