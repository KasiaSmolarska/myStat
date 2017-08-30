/**
 * @param {string} action
* @param {function} callback
* @param postData 
*/
function ajax(action, callback, postData){
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        
        if(request.readyState == 4){

            var text = request.responseText;
            var arr = JSON.parse(text);

            callback(arr);
        }

    };

    request.open('POST', 'http://localhost/majap/index.php?action='+ action, false); 
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(postData !== undefined ? postData : null);

}

/**
 * Funkcja tworzy zbiór wartości gotowy do wysłania przez Ajax
 * przykładowa zwaracana wartość: nazwa=abc&status=1
 * @param {element} form - można też przekazać diva
 * @return {string} np. : nazwa=abc&status=1 
 */
function convertFormToPostData(form){
   var inputs = form.querySelectorAll('[name]');
   var addtaskValues = [];
   for (var i = 0; i < inputs.length; i++) {
       var input = inputs[i];
       if (input.type == 'radio' && input.checked) {
           addtaskValues.push(input.name + '=' + input.value);
       }
       else if (input.type !== 'radio') {
            addtaskValues.push(input.name + '=' + input.value);
       }
      
   }
   return addtaskValues.join('&');
}