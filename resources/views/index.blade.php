<!DOCTYPE html>
<html>
<head>
    <title>Payment Form</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Payment Form</div>

                    <div class="card-body">
                        <form action="{{ url('/checkout') }}" method="post" id="payment-form">
                            @csrf
                            <div id="card-element" class="form-group">
                            </div> 
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="text" name="amount" id="amount" value="1000 USD" readonly>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" name="description" id="description" value="IVDISPLAYS DIGITAL SERVICES PVT LTD" readonly>
                            </div>
                            <div id="card-errors" class="text-danger" role="alert"></div>
                            <br>
                            <button type="submit" class="btn btn-sm btn-primary">Pay</button>
                            <input type="hidden" name="stripeToken" id="stripeToken">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="thankYouModal" tabindex="-1" role="dialog" aria-labelledby="thankYouModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="thankYouModalLabel">Thank You! 😊</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Your payment was successful Done!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="paymentFailedModal" tabindex="-1" role="dialog" aria-labelledby="paymentFailedModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="paymentFailedModalLabel">Payment Failed 😞</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Oops! It seems there was an issue with your payment. Please try again later.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



@if ($showSuccessModal)
    <script>
        $(document).ready(function() {
            $('#thankYouModal').modal('show');
        });
    </script>
@endif

    @if ($showFailureModal)
        <script>
            $(document).ready(function() {
                $('#paymentFailedModal').modal('show');
            });
        </script>
    @endif

<!-- Modal code here -->

    <script>
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');
        var elements = stripe.elements();
        var card = elements.create('card');

        card.mount('#card-element');

        card.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    document.getElementById('stripeToken').value = result.token.id;

                    // Open the "Thank You" modal when payment is successful
                    $('#thankYouModal').modal('show');
                }
            });
        });
    </script>

    <!-- Include Bootstrap JS (optional, for certain components) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
