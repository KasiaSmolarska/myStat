var message = {
    queque: [],
    show: function (description, type) {
        var messageElem = document.querySelector('.message');
        if (messageElem.classList.contains('message__show')) {
           return;
        }
        messageElem.classList.add('message__show');
        var messageContainer = document.createElement('div');
        if(type === "warning"){
            messageElem.style.background = "red";
        }
        else{
            messageElem.style.background = "dodgerblue";
        }
        messageContainer.innerText = description;
        messageElem.appendChild(messageContainer);

        setTimeout(function () {
            messageElem.classList.remove('message__show');
            messageContainer.remove();
        }, 5000);
    }
}

