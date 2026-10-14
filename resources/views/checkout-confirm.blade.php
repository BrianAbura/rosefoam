<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm order — Rosefoam</title>
    <link rel="icon" type="image/png" href="{{ asset('hearth/img/rosefoam-logo.png') }}">
    <meta name="description" content="Review your Rosefoam order details before placing it.">

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
    <a class="skip-link" href="#main">Skip to content</a>

    <div class="announce">
        Delivery: Now · Ends 7 pm · City Centre, Plot 5 Jinja Road, Kampala · 041 4660820
    </div>

    <header class="header" id="header">
        <div class="wrap header__bar">
            <a class="brand" href="{{ route('home') }}" aria-label="Rosefoam — home">
                <img class="brand__logo" src="{{ asset('hearth/img/rosefoam-logo.png') }}" alt="Rosefoam">
            </a>
            <nav class="nav" id="nav" aria-label="Primary">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('shop') }}">Shop</a>
            </nav>
        </div>
    </header>

    <main id="main">
        <section class="section section--ivory" id="checkout" aria-labelledby="confirm-h">
            <div class="wrap">
                <div class="checkout-head">
                    <span class="eyebrow">Almost there</span>
                    <h1 id="confirm-h">Confirm your order</h1>
                    <p style="color:var(--slate); max-width:520px; margin:0.5rem auto 0;">Review the items and your
                        delivery details. When everything looks right, place the order.</p>
                </div>

                <div class="checkout-layout">
                    <div class="checkout-cart">
                        <div class="checkout-card">
                            <h2 class="checkout-card__title">Items ordered</h2>
                            <table class="checkout-table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $it)
                                        <tr>
                                            <td class="checkout-item">
                                                <img src="{{ $it['img'] ?? asset('hearth/img/prod-sofa.jpg') }}"
                                                    alt="{{ $it['product_name'] }}">
                                                <span>{{ $it['product_name'] }}</span>
                                            </td>
                                            <td class="checkout-price">UGX {{ number_format($it['unit_price']) }}</td>
                                            <td class="checkout-qty">{{ $it['quantity'] }}</td>
                                            <td class="checkout-line">UGX {{ number_format($it['line_total']) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="checkout-totals">
                                <div class="totals-row">
                                    <span>Subtotal</span>
                                    <strong>UGX {{ number_format($subtotal) }}</strong>
                                </div>
                                <div class="totals-row">
                                    <span>Delivery</span>
                                    <strong>Free</strong>
                                </div>
                                <div class="totals-row totals-row--grand">
                                    <span>Total</span>
                                    <strong>UGX {{ number_format($total) }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="checkout-form">
                        <div class="checkout-card">
                            <h2 class="checkout-card__title">Delivery &amp; payment details</h2>

                            <div class="confirm-detail">
                                <span>Name</span>
                                <strong>{{ $customer_name }}</strong>
                            </div>
                            <div class="confirm-detail">
                                <span>Phone</span>
                                <strong>{{ $customer_phone }}</strong>
                            </div>
                            @if ($customer_email)
                                <div class="confirm-detail">
                                    <span>Email</span>
                                    <strong>{{ $customer_email }}</strong>
                                </div>
                            @endif
                            <div class="confirm-detail">
                                <span>Address</span>
                                <strong>{{ $delivery_address }}</strong>
                            </div>
                            @if ($delivery_district)
                                <div class="confirm-detail">
                                    <span>District / City</span>
                                    <strong>{{ $delivery_district }}</strong>
                                </div>
                            @endif
                            <div class="confirm-detail">
                                <span>Payment method</span>
                                <strong>{{ str_replace('_', ' ', ucfirst($payment_method)) }}</strong>
                            </div>
                            @if ($customer_notes)
                                <div class="confirm-detail">
                                    <span>Order notes</span>
                                    <strong>{{ $customer_notes }}</strong>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('checkout.confirm') }}" class="mt-4">
                                @csrf
                                <input type="hidden" name="customer_name" value="{{ $customer_name }}">
                                <input type="hidden" name="customer_email" value="{{ $customer_email }}">
                                <input type="hidden" name="customer_phone" value="{{ $customer_phone }}">
                                <input type="hidden" name="delivery_address" value="{{ $delivery_address }}">
                                <input type="hidden" name="delivery_district" value="{{ $delivery_district }}">
                                <input type="hidden" name="customer_notes" value="{{ $customer_notes }}">
                                <input type="hidden" name="payment_method" value="{{ $payment_method }}">
                                <input type="hidden" name="cart_json" value="{{ $cart_json }}">

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn--ember btn--block">
                                        Place order
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                                            aria-hidden="true">
                                            <path d="M5 12h14M13 6l6 6-6 6" />
                                        </svg>
                                    </button>
                                    <a href="{{ route('checkout') }}" class="btn btn--outline btn--block">Edit
                                        details</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="wrap">
            <div class="footer__bar">
                <p style="margin:0;">&copy; 2026 Rosefoam · Royikems Foam Company Ltd. · All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('hearth/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('hearth/js/main.js') }}"></script>
</body>

</html>
