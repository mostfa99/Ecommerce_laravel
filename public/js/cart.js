
(function ($) {
    // add this script for add to cart without reload page
    $('#add-to-cart').on('submit', function (e) {
        e.preventDefault();
        // can use ajax or post
        //$.ajax($(this).attr('action'),$(this).serialize() , function(items){
        $.post($(this).attr('action'), $(this).serialize(), function (items) {
            $('.cart-list').empty();
            for (i in items) {
                data = items[i];
                $('.cart-list').append(`<div class="product-widget">
                        <div class="product-img">
                            <img src="${data.product.image_url}" alt="Product Images">
                        </div>
                        <div class="product-body">
                            <h3 class="product-name"><a href="${data.premalink}">${data.product.name}</a> </h3>
                            <h4 class="product-price"><span class="qty" name="quantity">${data.quantity}x</span>${data.product.price}
                            </h4></div><button class="delete"><i class="fa fa-close"></i></button>
                        </div>`);
            }//end data loop function

            /*
            // display alert massage
            $('.alert-container').html(
                <div class="alert alert-success">
                </div>);
                */

        });//end post function
    }); // end function #add-to-cart

    $(document).ready(function () {
        $('#add-to-wishlist').click(function (event) {
            event.preventDefault();
            var productId = $(this).data('product-id');
            $.ajax({
                url: '/wishlist/add',
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'product_id': productId
                },
                success: function (response) {
                    var wishlistCount = response['wishlist_count'];
                    $('.wishlist-count').text(wishlistCount);
                    alert('Product added to wishlist!');
                },
                error: function (error) {
                    alert('An error occurred while adding the product to the wishlist.');
                }
            });
        });
    });

})(jQuery);



