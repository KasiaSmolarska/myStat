function openModal(templateID, callback, title) {
    var modalTemplate = document.getElementById('modalTemplate').innerText;
    var contentTemplate = document.getElementById(templateID).innerText;
    var content = ejs.render(contentTemplate, {});
    var elem = document.createElement('div');
    elem.innerHTML = ejs.render(modalTemplate, {
        title: title,
        content: content
    });
    var modal = elem.querySelector('.modal');
    document.body.appendChild(modal);
    modalOperationsOnClick(modal, callback);
}

function modalOperationsOnClick(modal, callback) {
    var dataCallback = modal.querySelectorAll('[data-callback]');

    for (var i = 0; i < dataCallback.length; i++) {
        var button = dataCallback[i];

        button.addEventListener('click', function () {

            var status = this.dataset.callback;

            if (typeof callback === "function") {
                callback(status, modal);
            }
            modal.remove();
        });

    }
}

function sendRegisterForm(postdata) {
    var inputs = document.querySelectorAll('input');
    for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].value.length === 0) {
            openModal('modalAlert', '', "Uzupełnij puste pola!");
            return;
        }
    }
    ajax('register', function (data) {
        console.log(data);
        if (data.Status === 'OK') {
            window.location.search = '';
        }
        else {
            openModal('modalAlert', '', "Użytkownik o tym adresie email jest już zarejestrowany!");
        }
    }, postdata)
}

/**
 * 
 * 
 * 
 * 
 */
function accountLogin(postdata) {
    var inputs = document.querySelectorAll('input');
    for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].value.length === 0) {
            openModal('modalAlert', '', "Uzupełnij puste pola!");
            return;
        }
    }
    ajax('login', function (status) {
        console.log(status);
        window.location.reload();
    }, postdata)
}