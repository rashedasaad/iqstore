<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ URL::asset('stripe/scss/ar/index.css') }}">
    <title>{{ env('APP_NAME') }}</title>
</head>


<body>

    <form action="{{ route('buy') }}" method="POST" id="payment-form">
        
        <div class="allInput">
            <input name="lang" type="hidden" value="{{ $lang }}">
            <input class="email" name="email" type="email" placeholder="ايملات">
            <input class="number" name="number" type="number" placeholder="رقم تلفون">
        </div>
        <textarea id="productsData" name="prodcuts" style="display: none"></textarea>
        @csrf

        <div class="form-row">
            <label for="card-element">
                Credit or debit card
            </label>
            <div id="card-element">
                <!-- A Stripe Element will be inserted here. -->
            </div>

            <!-- Used to display Element errors. -->
            <div id="card-errors" role="alert"></div>
        </div>

        <button type="submit" id="paymentok">موافقه علي الدفع</button>
    </form>
    
    <script src="{{ URL::asset('stripe/js/index.js') }}"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{ URL::asset('js_cardinputs/card_inputs.js') }}"></script>
    <script>
        var is_can_submit = true;
        document.getElementById("paymentok").onclick = function(e){
            if (!is_can_submit) {

                return e.preventDefault()
                
            }
            is_can_submit = false

        }

        document.addEventListener('DOMContentLoaded', () => {
            var stripe = Stripe(
                'pk_test_51LRLpEJpSSRZs77gqTQxy8ykfvNTZRSaMAtmLs1j2TlMr44VglC41pCzBX8ifH2omb1vX8w5Iy0LyGXgbHak3BlG0058pHNmci'
                );
            var elements = stripe.elements();

            var style = {
                base: {
                    // Add your base input styles here. For example:
                    fontSize: '16px',
                    color: '#32325d',
                },
            };

            // Create an instance of the card Element.
            var card = elements.create('card', {
                style: style,
                hidePostalCode: false
            });

            // Add an instance of the card Element into the `card-element` <div>.
            card.mount('#card-element');
            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                stripe.createToken(card).then(function(result) {
                    if (result.error) {
                        // Inform the customer that there was an error.
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        // Send the token to your server.
                        stripeTokenHandler(result.token);
                    }
                });

            });

            function stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);

                // Submit the form
                form.submit();
            }
        })
    </script>
</body>

</html>
