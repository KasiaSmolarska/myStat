function onChangeHandler() {
    console.time("abs");
    var weekday = document.getElementById('day').value;
    var isWeekend = checkWeekend(weekday);
    var startTime = document.getElementById('hourFrom').value * 60 + parseInt(document.getElementById('minutesFrom').value);
    var stopTime = document.getElementById('hourTo').value * 60 + parseInt(document.getElementById('minutesTo').value);
    

    var overtimeCount = document.getElementById("overtimeCount");
    overtimeCount.innerHTML = countSummaryTime(startTime, stopTime, isWeekend);
    console.timeEnd("abs");
}

function countSummaryTime(startTime, stopTime, isWeekend){
    var calcHours = ((stopTime - startTime) / 60).toFixed(0);
    if (isWeekend === 0) {
        calcHours -= 8;
    }
    calcHours = addZero(calcHours);
    var calcMinutes = parseInt((stopTime - startTime) % 60);
    calcMinutes = addZero(calcMinutes);
    return calcHours + ':' + calcMinutes;
}

function converMinutesToTime(minutes){
    var calcHours = (minutes / 60).toFixed(0);
    var calcMinutes = parseInt(minutes % 60);
    return addZero(calcHours) + ':' + addZero(calcMinutes);
}

function convertMySQLTimeToMinutes(time){
    var arr = time.split(':');


    return arr[0] * 60 + parseInt(arr[1]);

}

window.addEventListener("load", function () {
    getOvertime();
    var overtimeInputs = document.querySelectorAll(".timeField input");

    if (overtimeInputs.length > 0) {
        for (var i = 0; i < overtimeInputs.length; i++) {
            var input = overtimeInputs[i];
            input.value = '00';

            input.addEventListener("change", onChangeHandler)
        }

        document.getElementById('day').addEventListener("change", onChangeHandler)

    }
})



function addZero(calc) {
    if (calc <= 0) {
        calc = "00";
    } else if (calc < 10) {
        calc = "0" + calc;
    }

    return calc;
}

function checkWeekend(day) {

    var weekday = new Date(day).getDay();
    var weekend = 0;
    if (weekday === 6 || weekday === 0) {
        weekend = 1;
    }
    return weekend;
}

function addOvertime() {

    var data = {
        description: document.getElementById('description').value,
        client: document.getElementById('client').value,
        day: document.getElementById('day').value,
        dateFrom: document.getElementById('hourFrom').value + ":" + document.getElementById('minutesFrom').value + ":00",
        dateTo: document.getElementById('hourTo').value + ":" + document.getElementById('minutesTo').value + ":00"
    }

    data.weekend = checkWeekend(data.day);

    ajax('addOvertime', function (response) {

        getOvertime();
        console.log(response);
    }, convertObjectToPostData(data))

}


function getOvertime() {
    ajax('getOvertimeMonth', function (result) {
        var overtimeTemplate = document.getElementById('overtimeTable').innerText;
        var minutes = 0;


        for(var i = 0; i < result.length; i++) {
            var overtime = result[i];
            minutes += convertMySQLTimeToMinutes(countSummaryTime(
                convertMySQLTimeToMinutes(overtime.Time_from),
                convertMySQLTimeToMinutes(overtime.Time_to),
                overtime.Weekend))
                    
        }


        var container = document.getElementById('tableOvertime');
        container.innerHTML = ejs.render(overtimeTemplate, { 
            data : result,
            suma : converMinutesToTime(minutes)
        });

    }, convertObjectToPostData({
        month : 11,
        year : 2017
    }))
}