Stripe.setPublishibleKey('ppk_test_51Jzu2DKP87mFuadag9AeH0CBiFi6zZt4tMsg79NwnESky5OJg6NrwDZA4pf7TpIx1sRfM0DBEa8kPsDcNIWKa9pK008ExF2WzK');

var $form = $('#checkout-form');

$form.submit(function(event){
    $('charge-error').addClass('hidden');
    $form.find('button').prop('disable',true);
    Stripe.card.createToken({
        number: $('#card-number').val(),
        cvc: $('#card-cvc').val(),
        exp_month: $('#card-expiry-month').val(),
        exp_year: $('#card-expiry-year').val(),
        name: $('#card-name').val(),
    },stripeResponseHandler);
    return false;
});

function stripeResponseHandler(status,response){
    if(response.error){
        $('#charge-error').removeClass('hidden');
        $('#charge-error').text(response.error.message);
        $form.find('button').prop('disabled',false);
    }else{
        var token =response.id;
        $form.append($('<input type="hidden" name="stripeToken"/>'),val (token));
        $form.get(0).submit();

    }

}

