import './bootstrap';

import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.start();

alert(`Welcome back ${userName}`);

window.Echo.private('orders')
    .listen('.order.created', function (event) {
        alert(`New Order Created ${event.order.numbre}`)
    });

window.Echo.private(`Notifications.${userId}`)
    .notification(function (e) {
        var count = Number($('#unread').text());
        count++;
        $('.unread').text(count);
        $('#notifications').prepend(`
                <a href="#${e.id}" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i><b>*</b>
                    ${e.title}
                    <span class="float-right text-muted text-sm">${e.time}mins</span>
                </a>
                <div class="dropdown-divider"></div>
            `);

        alert(e.title);
    })

window.Echo.join('chat')
    .here((users) => {
        console.log(user);
    })
    .listen('MessageSent', function (event) {
        addMessage(event);
    });

(function ($) {
    $('#chat-form').on('submit', function (event) {
        event.prventDefault();
        $.post($(this).attr('action'), $($this).serialize(), function (res) {
            $('#chat-form input').val('');
            // addMessage();
        })
    });
})(jQuery)

function addMessage(event) {
    $('#mesages').append(
        `<div class="shadow-sm my-5 sm:rounded-lg">
        ${event.sender.name} : ${event.message}
        </div>`);
}

