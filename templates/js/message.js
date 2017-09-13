var message = {
    queque: [],
    color: function () {
        return Math.round(Math.random() * 210);
    },
    show: function (description, type) {
        var messageElem = document.querySelector('.message');
        var messageContent = document.querySelector('.message__content');
        var icon = document.querySelector('.message__icon i');
        if (messageElem.classList.contains('message__show')) {
            return;
        }
        messageElem.classList.add('message__show');
        var messageContainer = document.createElement('div');
        var color = this.color() + "," + this.color() + "," + this.color();
        var background = 'rgb(' + color + ')';
        var boxShadow = '0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(' + color + ', 0.4)';
        messageElem.style.background = background;
        messageElem.style.boxShadow = boxShadow;
        icon.style.color = background;
        if (type !== "warning") {

            icon.classList.remove('mdi-alert-outline');
            icon.classList.add('mdi-lightbulb-on-outline');
        }

        messageContainer.innerText = description;
        messageContent.appendChild(messageContainer);

        function messageRemove() {
            messageElem.classList.remove('message__show');

            setTimeout(function () {
                messageContainer.remove();
            }, 1000);
        }

        document.querySelector('.message__close').addEventListener('click', function () {
            messageRemove();
        })

        setTimeout(function () {
            messageRemove();
        }, 5000);
    }
}

