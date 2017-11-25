window.addEventListener("load", function () {
    var overtimeInputs = document.querySelectorAll(".timeField input");

    if (overtimeInputs.length > 0) {
        for (var i = 0; i < overtimeInputs.length; i++) {
            var input = overtimeInputs[i];
            input.value = '00';

            input.addEventListener("change", function () {
                var startTime = document.getElementById('hourFrom').value * 60 + parseInt(document.getElementById('minutesFrom').value);
                var stopTime = document.getElementById('hourTo').value * 60 + parseInt(document.getElementById('minutesTo').value);
                var calc = (stopTime - startTime) / 60;
                var result = calc.toFixed(0) + ':' + parseInt((stopTime - startTime) % 60);

                var overtimeCount = document.getElementById("overtimeCount");
                overtimeCount.innerHTML = result;
            })
        }
    }
})

function addOvertime() {

    var data = {
        description: document.getElementById('description').value,
        client: document.getElementById('client').value,
        day: document.getElementById('day').value,
        dateFrom: document.getElementById('hourFrom').value + ":" + document.getElementById('minutesFrom').value + ":00",
        dateTo: document.getElementById('hourTo').value + ":" + document.getElementById('minutesTo').value + ":00"
    }

    var weekday = new Date(data.day).getDay();
    if (weekday === 6 || weekday === 0) {
        data.weekend = 1;
    } else {
        data.weekend = 0;
    }

    ajax('addOvertime', function (response) {
        console.log(response);
    }, convertObjectToPostData(data))

}