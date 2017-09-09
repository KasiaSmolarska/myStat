var message = {
    queque: [],
    show: function (description) {
        var messageElem = document.querySelector('.message');
        if (messageElem.classList.contains('message__show')) {
           return;
        }
        messageElem.classList.add('message__show');
        var messageContainer = document.createElement('div');

        messageContainer.innerText = description;
        messageElem.appendChild(messageContainer);

        setTimeout(function () {
            messageElem.classList.remove('message__show');
            messageContainer.remove();
        }, 5000);
    }
}

