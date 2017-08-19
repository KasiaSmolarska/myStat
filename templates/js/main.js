window.onload = function(){
    ajax('getTask', function (data) {

    var div = document.getElementById('tasksList');
    for (var key in data) {
        if (data.hasOwnProperty(key)) {

            var grupa = data[key];

            for (var i = 0; i < grupa.length; i++) {

                var elem = "<li>" + grupa[i].Title + " , grupa: " + grupa[i].Groups +  "</li> ";

                div.innerHTML += elem;
            }
        }
    }
});
}