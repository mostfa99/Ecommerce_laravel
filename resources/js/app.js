import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.Echo.privet('orders')
    .listen('.order.created', function(event){
        alert(`New Order Created ${event.order.numbre}`)
    });

window.Echo.join('chat')
    .here((users) => {
    console.log(user);
    })
    .listen('MessageSent', function(event){
        addMessage(event);
    });

    (function($) {
            $('#chat-form').on('submit', function(event){
                event.prventDefault();
                $.post($(this).attr('action'), $($this).serialize(), function(res){
                    $('#chat-form input').val('');
                    // addMessage();
            })
        });
    })(jQuery)

function addMessage(event){
    $('#mesages').append(
        `<div class="shadow-sm my-5 sm:rounded-lg">
        ${event.sender.name} : ${event.message}
        </div>`);
}
