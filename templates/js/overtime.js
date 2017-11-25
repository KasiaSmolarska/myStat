function addOvertime() {

    var data = {
        description: document.getElementById('description').value,
        client: document.getElementById('client').value,
        day: document.getElementById('day').value,
        dateFrom: document.getElementById('hourFrom').value + ":" + document.getElementById('minutesFrom').value + ":00",
        dateTo: document.getElementById('hourTo').value + ":" + document.getElementById('minutesTo').value + ":00"
    }

    var weekday = new Date(data.day).getDay();
    if(weekday === 6 || weekday === 0){
        data.weekend = 1;
    }else{
        data.weekend = 0;
    }

    ajax('addOvertime', function (response) {
        console.log(response);
    }, convertObjectToPostData(data))

}