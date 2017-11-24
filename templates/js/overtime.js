function addOvertime(){

    var data = {
        description : document.getElementById('description').value,
        client : document.getElementById('client').value,
        day : document.getElementById('day').value,
        dateFrom : document.getElementById('hourFrom').value + ":" + document.getElementById('minutesFrom').value,
        dateTo : document.getElementById('hourTo').value + ":" + document.getElementById('minutesTo').value 
    }
      console.log(convertObjectToPostData(data));

}