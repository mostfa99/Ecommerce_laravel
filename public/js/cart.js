
(function($){
    // add this script for add to cart without reload page

    $('#add-to-cart').on('submit', function (e) {
        e.preventDefault();
        $.post($(this).attr('action'),$(this).serialize() , function(item){
            $('.cart-list').empty();
            for(i in item){
                data = items[i];
            $('.cart-list').append(`<div class="product-widget">
                    <div class="product-img">
                        <img src="${data.product.image_url}" alt="">
                    </div>
                    <div class="product-body">
                        <h3 class="product-name"><a href="${data.premalink}">${data.product.name}</a> </h3>
                        <h4 class="product-price"><span class="qty" name="quantity">${data.quantity}x</span>${data.product.price}
                        </h4></div><button class="delete"><i class="fa fa-close"></i></button>
        </div>`);
    }
        });
    });
}) (jQuery);
