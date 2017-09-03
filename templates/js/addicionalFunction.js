
window.addEventListener('load', function () {
    var account = document.querySelector('.account');
    if (account !== null) {
        account.classList.add('account__show');
    }
})

/**
 *  Funkcja tworzy nowy element html z modalem na podstawie dwóch szablonów ejsa
 *  @param {string} templateID - nazwa templatki modala, która jest wewnątrz
 *  @param {function} callback - funkcja przekazywana do modalOperationsOnClick
 *  @param {string} title - string wyświetlany jako tytuł modala
 * 
 */

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

/**
 *  Funkcja dodająca eventListener do elementów zawierających dataCallback
 *  dzięki tej funkcji po kliknięciu elementu, modal zostaje zamknięty oraz wywołuje się funkcja callback
 *  @param {element} modal - element html zawierający modala
 *  @param {function} callback - funkcja wykonująca operacje po kliknięciu elementu html, która zawiera atrybut dataCallback
 */
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
 *  Funkcja sprawdza, czy nie doszło do próby przesłania formularza, zawierającego puste pole
 *  jesli nie to przesyła dane w ajax (po wykonaniu ajaxa odpala się funckja 'reload', która przeładowuje okno)
 * 
 *  @param {string} postdata np. nazwa=abc&status=1 
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