@extends('layouts.backend.app', ['pageTitle' => $pageTitle])
@section('content')
    <div class="container mt-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $pageTitle }}</h6>
            </div>
            <div class="card card-body">
                <form action="{{ route('admin.withdraw.pay') }}" method="POST" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                    @csrf
                    <input type="hidden" value="{{ Crypt::encrypt($withdraw_id) }}" name="withdraw_id">
                    <div class="row">
                        <div class="col-xs-12 col-md-6 form-group required">
                            <label class="control-label">Name on Card</label>
                            <input type="text" class="form-control" size="4" type="text" value="Test">
                        </div>
                        <div class="col-xs-12 col-md-6 form-group required">
                            <label class="control-label">Card Number</label>
                            <input autocomplete="off" class="form-control card-number" size="20" type="tel" value="4242424242424242">
                        </div>
                        <div class="col-xs-12 col-md-4 form-group cvc required">
                            <label class="control-label">CVC</label>
                            <input autocomplete="off" class="form-control card-cvc" placeholder="ex. 311" size="4" type="number" value="311">
                        </div>
                        <div class="col-xs-12 col-md-4 form-group expiration required">
                            <label class="control-label">Expiration Month</label>
                            <input class="form-control card-expiry-month" placeholder="MM" size="2" type="number" value="02">
                        </div>
                        <div class="col-xs-12 col-md-4 form-group expiration required">
                            <label class="control-label">Expiration Year</label>
                            <input class="form-control card-expiry-year" placeholder="YYYY" size="4" type="number" value="2023">
                        </div>
                        <button class="btn btn-sm btn-primary w-100 checkout-button">Pay</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script id="strip-validation" type="text/javascript">
        $(function() {
            $('form').attr("class", "require-validation");
            $('form').attr("data-cc-on-file", "false");
            $('form').attr("data-stripe-publishable-key", "{{ env('STRIPE_KEY') }}");
            $('form').attr("id", "payment-form");

            var $form = $(".require-validation");
            $('form.require-validation').bind('submit', function(e) {
                var $form = $(".require-validation"),
                    inputSelector = ['input[type=email]', 'input[type=password]', 'input[type=text]', 'input[type=file]', 'textarea'].join(', '),
                    $inputs = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid = true;
                $errorMessage.addClass('hide');
                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('hide');
                        e.preventDefault();
                    }
                });
                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }
            });

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    /* token contains id, last4, and card type */
                    var token = response['id'];
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }
        });
    </script>
@endsection
@push('js')
@endpush
