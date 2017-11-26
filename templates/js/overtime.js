function onChangeHandler() {
    console.time("abs");
    var weekday = document.getElementById('day').value;
    var weekend = checkWeekend(weekday);
    var startTime = document.getElementById('hourFrom').value * 60 + parseInt(document.getElementById('minutesFrom').value);
    var stopTime = document.getElementById('hourTo').value * 60 + parseInt(document.getElementById('minutesTo').value);
    var calcHours = ((stopTime - startTime) / 60).toFixed(0);
    if (weekend === 0) {
        calcHours -= 8;
    }
    calcHours = addZero(calcHours);
    var calcMinutes = parseInt((stopTime - startTime) % 60);
    calcMinutes = addZero(calcMinutes);
    var result = calcHours + ':' + calcMinutes;

    var overtimeCount = document.getElementById("overtimeCount");
    overtimeCount.innerHTML = result;
    console.timeEnd("abs");
}

window.addEventListener("load", function () {
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

    data.weekday = checkWeekend(data.day);

    ajax('addOvertime', function (response) {
        console.log(response);
    }, convertObjectToPostData(data))

}