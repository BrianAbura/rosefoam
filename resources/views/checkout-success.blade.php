<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmed — Rosefoam</title>
    <link rel="icon" type="image/png" href="{{ asset('hearth/img/rosefoam-logo.png') }}">
    <meta name="description" content="Your Rosefoam order has been received. We will call you to confirm delivery.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,500;1,9..144,600&family=Figtree:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('hearth/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('hearth/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('hearth/css/rosefoam.css') }}">
</head>

<body>
    <main id="main" class="success-page">
        <div class="success-card">
            <div class="success-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" aria-hidden="true">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                    <polyline points="22 4 12 14.01 9 11.01" />
                </svg>
            </div>
            <h1>Thank you for your order!</h1>
            <p class="success-message">We have received your order and will call you on
                <strong>{{ $order->customer_phone }}</strong> to confirm delivery details.
            </p>

            <div class="success-order">
                <span>Order number</span>
                <strong>{{ $order->order_number }}</strong>
            </div>

            <div class="success-summary">
                <div class="success-row">
                    <span>Total amount</span>
                    <strong>UGX {{ number_format($order->total_amount) }}</strong>
                </div>
                <div class="success-row">
                    <span>Payment method</span>
                    <strong>{{ str_replace('_', ' ', ucfirst($order->payment_method)) }}</strong>
                </div>
            </div>

            <a href="{{ route('shop') }}" class="btn btn--ember">Continue shopping
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                    stroke-linejoin="round" aria-hidden="true">
                    <path d="M5 12h14M13 6l6 6-6 6" />
                </svg>
            </a>
        </div>
    </main>

    <script>
        (function() {
            var KEY = 'rosefoam-cart-v1';
            try {
                localStorage.removeItem(KEY);
            } catch (e) {}
            var count = document.getElementById('cartCount');
            if (count) count.textContent = '0';
        })();
    </script>
</body>

</html>
