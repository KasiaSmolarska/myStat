function sendRegisterForm(postdata) {
    ajax('register', function (data) {
        console.log(data);
        if (data.status === 'ok') {
            window.location.search = '';
        }
        else {
            openModal('modalConfirm', function (data) {

                console.log(data);
            }, "Użytkownik o tym adresie email jest już zarejestrowany!");
        }
    }, postdata)
}