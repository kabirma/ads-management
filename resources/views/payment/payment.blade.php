<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $setting->name }} | {{ __('messages.PaymentCheckout') }} </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #timer {
            font-size: 1rem;
            font-weight: bold;
        }
    </style>
</head>

<body>



    <section>
        <div class="container d-flex justify-content-center align-items-center vh-100">

            <div class="card">
                <div class="card-header" style="text-align: center">
                    <img src="{{ asset($setting->logo) }}" alt="{{ $setting->name }}">
                    <br>
                    <h5>{{ __('messages.Dear') }} {{ $user->full_name == '' ? $user->name : $user->full_name }}</h5>
                    <p>
                        {!! __('messages.ProvidePaymentInformation', ['AMOUNT' => $amount]) !!}
                    </p>
                </div>
                <div class="card-content">
                    <div class="card-body">

                        <form action="{{ route('wallet_top_up_redirect') }}?ref={{ $ref }}"
                            class="paymentWidgets" data-brands="VISA MASTER"></form>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            {{ __('messages.SessionExpire') }} <span id="timer">03:00</span>
                        </div>
                        <div class="col-md-6" style="text-align: right">
                            <a href="{{ route('wallet_top_up_cancel') }}"
                                class="btn btn-danger btn-sm">{{ __('messages.CancelWalletTopUp') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>

    <script src="{{ $checkoutUrl }}" integrity="{{ $integrity }}" crossorigin="anonymous"></script>
    <script>
        const countdownSeconds = 180;
        let timeLeft = countdownSeconds;
        let isCountingDown = true;
        const redirectUrl = "{{ route('wallet_top_up_cancel') }}";
        const timerDisplay = document.getElementById('timer');

        function formatTime(seconds) {
            const min = String(Math.floor(seconds / 60)).padStart(2, '0');
            const sec = String(seconds % 60).padStart(2, '0');
            return `${min}:${sec}`;
        }

        const interval = setInterval(() => {
            if (isCountingDown) {
                timerDisplay.textContent = formatTime(timeLeft);
                timeLeft--;

                if (timeLeft < 0) {
                    isCountingDown = false;
                    timeLeft = 0;
                    timerDisplay.textContent = '{{ __('messages.SessionExpired') }}';
                    setTimeout(() => {
                        window.location.href = redirectUrl;
                    }, 1000);
                }
            }
        }, 1000);
    </script>

</body>

</html>
