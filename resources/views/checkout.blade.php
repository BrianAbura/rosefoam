<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout — Rosefoam</title>
    <link rel="icon" type="image/png" href="{{ asset('hearth/img/rosefoam-logo.png') }}">
    <meta name="description" content="Review your cart and complete your Rosefoam mattress, pillow or topper order.">

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
                <a href="{{ route('home') }}#categories">Mattresses</a>
                <a href="{{ route('home') }}#why">Why Rosefoam</a>
            </nav>

            <div class="header__tools">
                <button class="icon-btn" type="button" id="cartOpen" aria-label="Open cart" aria-haspopup="dialog">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M6 8h12l-1 12H7L6 8Z" />
                        <path d="M9 8a3 3 0 0 1 6 0" />
                    </svg>
                    <span class="cart-count" id="cartCount" aria-hidden="true">0</span>
                </button>
                <button class="nav-toggle" id="navToggle" type="button" aria-label="Open menu" aria-expanded="false"
                    aria-controls="nav">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </div>
    </header>
    <div class="backdrop" id="backdrop"></div>

    <aside class="cart" id="cart" role="dialog" aria-modal="true" aria-label="Shopping cart" aria-hidden="true">
        <div class="cart__head">
            <h2>Your cart</h2>
            <button class="icon-btn" type="button" id="cartClose" aria-label="Close cart">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round"
                    aria-hidden="true">
                    <path d="M6 6l12 12M18 6 6 18" />
                </svg>
            </button>
        </div>
        <div class="cart__body" id="cartBody">
            <div class="cart__empty" id="cartEmpty">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"
                    stroke-linejoin="round" aria-hidden="true">
                    <path d="M6 8h12l-1 12H7L6 8Z" />
                    <path d="M9 8a3 3 0 0 1 6 0" />
                </svg>
                <p>Your cart is empty.<br>Add something you will sleep better on.</p>
            </div>
        </div>
        <div class="cart__foot">
            <div class="cart__subtotal">
                <span class="lbl">Subtotal</span>
                <span class="val" id="cartTotal">UGX 0</span>
            </div>
            <p class="cart__note">Shipping &amp; taxes calculated at checkout. Free delivery countrywide.</p>
            <a href="{{ route('checkout') }}" class="btn btn--ember btn--block">Checkout
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                    stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M5 12h14M13 6l6 6-6 6" />
                </svg>
            </a>
        </div>
    </aside>

    <main id="main">
        <section class="section section--ivory" id="checkout" aria-labelledby="checkout-h">
            <div class="wrap">
                <div class="checkout-head">
                    <span class="eyebrow">Checkout</span>
                    <h1 id="checkout-h">Review your order</h1>
                </div>

                <div class="checkout-layout">
                    <div class="checkout-cart">
                        <div class="checkout-card">
                            <h2 class="checkout-card__title">Items in your cart</h2>

                            <div id="checkoutCartEmpty" class="checkout-empty" style="display:none;">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4"
                                    stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M6 8h12l-1 12H7L6 8Z" />
                                    <path d="M9 8a3 3 0 0 1 6 0" />
                                </svg>
                                <p>Your cart is empty.</p>
                                <a href="{{ route('shop') }}" class="btn btn--ember">Continue shopping
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M5 12h14M13 6l6 6-6 6" />
                                    </svg>
                                </a>
                            </div>

                            <div class="checkout-table-wrap" id="checkoutCartTable">
                                <table class="checkout-table">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="checkoutCartBody">
                                    </tbody>
                                </table>

                                <div class="checkout-totals">
                                    <div class="totals-row">
                                        <span>Subtotal</span>
                                        <strong id="checkoutSubtotal">UGX 0</strong>
                                    </div>
                                    <div class="totals-row">
                                        <span>Delivery</span>
                                        <strong>Free</strong>
                                    </div>
                                    <div class="totals-row totals-row--grand">
                                        <span>Total</span>
                                        <strong id="checkoutTotal">UGX 0</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="checkout-form">
                        <div class="checkout-card">
                            <h2 class="checkout-card__title">Delivery &amp; payment details</h2>

                            @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                            @endif

                            <form method="POST" action="{{ route('checkout.review') }}" id="checkoutForm"
                                novalidate>
                                @csrf
                                <input type="hidden" name="cart_json" id="cartJson" value="">

                                <div class="form-group">
                                    <label for="customer_name">Full name *</label>
                                    <input type="text" id="customer_name" name="customer_name"
                                        class="form-control" value="{{ old('customer_name') }}" required>
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="customer_phone">Phone number *</label>
                                        <input type="tel" id="customer_phone" name="customer_phone"
                                            class="form-control" value="{{ old('customer_phone') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="customer_email">Email</label>
                                        <input type="email" id="customer_email" name="customer_email"
                                            class="form-control" value="{{ old('customer_email') }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="delivery_address">Delivery address *</label>
                                    <textarea id="delivery_address" name="delivery_address" class="form-control" rows="3" required>{{ old('delivery_address') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="delivery_district">District / City</label>
                                    <input type="text" id="delivery_district" name="delivery_district"
                                        class="form-control" value="{{ old('delivery_district') }}">
                                </div>

                                <div class="form-group">
                                    <label for="customer_notes">Order notes</label>
                                    <textarea id="customer_notes" name="customer_notes" class="form-control" rows="2"
                                        placeholder="Anything we should know about your delivery">{{ old('customer_notes') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Payment method *</label>
                                    <div class="payment-options">
                                        <label class="payment-option">
                                            <input type="radio" name="payment_method" value="cash_on_delivery"
                                                {{ old('payment_method', 'cash_on_delivery') === 'cash_on_delivery' ? 'checked' : '' }}
                                                required>
                                            <span>Cash on delivery</span>
                                        </label>
                                        <label class="payment-option">
                                            <input type="radio" name="payment_method" value="mobile_money"
                                                {{ old('payment_method') === 'mobile_money' ? 'checked' : '' }}
                                                required>
                                            <span>Mobile Money</span>
                                        </label>
                                        <label class="payment-option">
                                            <input type="radio" name="payment_method" value="bank_transfer"
                                                {{ old('payment_method') === 'bank_transfer' ? 'checked' : '' }}
                                                required>
                                            <span>Bank transfer</span>
                                        </label>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn--ember btn--block" id="placeOrderBtn">
                                    Review order
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M5 12h14M13 6l6 6-6 6" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="wrap">
            <div class="footer__top">
                <div>
                    <a class="brand" href="{{ route('home') }}" aria-label="Rosefoam — home">
                        <img class="brand__logo" src="{{ asset('hearth/img/rosefoam-logo.png') }}" alt="Rosefoam">
                    </a>
                    <p class="footer__about">Rosefoam mattresses, pillows and toppers are made at our own plant in
                        Mbalala,
                        Mukono, and delivered countrywide. A world of beautiful dreams.</p>
                    <div class="footer__social">
                        <a href="#" aria-label="Rosefoam on Instagram"><svg viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.7" stroke-linecap="round"
                                stroke-linejoin="round" aria-hidden="true">
                                <rect x="3" y="3" width="18" height="18" rx="5" />
                                <circle cx="12" cy="12" r="4" />
                                <circle cx="17.3" cy="6.7" r="1" fill="currentColor" stroke="none" />
                            </svg></a>
                        <a href="#" aria-label="Rosefoam on Facebook"><svg viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.7" stroke-linecap="round"
                                stroke-linejoin="round" aria-hidden="true">
                                <path d="M14 8h2V5h-2c-2 0-3 1.3-3 3v2H9v3h2v6h3v-6h2l.5-3H14V8.6c0-.4.2-.6.7-.6Z" />
                            </svg></a>
                        <a href="#" aria-label="Rosefoam on WhatsApp"><svg viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.7" stroke-linecap="round"
                                stroke-linejoin="round" aria-hidden="true">
                                <path
                                    d="M12 3c5 0 9 4 9 9 0 1.5-.4 3-1 4.2L21 21l-4.3-1.4A9 9 0 0 1 3 12c0-5 4-9 9-9Z" />
                                <path d="M8.5 13.5S10 15 12 15c2 0 3.5-1.5 3.5-3.5S14 8 12 8c-2 0-3.5 1.5-3.5 1.5" />
                            </svg></a>
                    </div>
                </div>
                <div class="footer__col">
                    <h4>Shop</h4>
                    <ul>
                        <li><a href="{{ route('shop') }}">All mattresses</a></li>
                        <li><a href="{{ route('shop', ['category' => 'mattresses']) }}">Mattresses</a></li>
                        <li><a href="{{ route('shop', ['category' => 'pillows']) }}">Pillows</a></li>
                        <li><a href="{{ route('shop', ['category' => 'toppers']) }}">Toppers</a></li>
                        <li><a href="{{ route('shop', ['category' => 'accessories']) }}">Accessories</a></li>
                    </ul>
                </div>
                <div class="footer__col">
                    <h4>Help</h4>
                    <ul>
                        <li><a href="{{ route('track-order') }}">Track an order</a></li>
                        <li><a href="#">Bulk and trade</a></li>
                        <li><a href="{{ route('home') }}#why">Why Rosefoam</a></li>
                        <li><a href="#">Find a depot</a></li>
                        <li><a href="#">Customer support</a></li>
                    </ul>
                </div>
                <div class="footer__col">
                    <h4>Contact</h4>
                    <ul>
                        <li><span class="text-muted">Delivery: Now · Ends 7&nbsp;pm</span></li>
                        <li><a href="tel:+256414660820">041 4660820</a></li>
                        <li><a href="mailto:info@rosefoamug.com">info@rosefoamug.com</a></li>
                        <li><a href="#">City Centre, Plot 5 Jinja Road, Kampala</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer__bar">
                <p style="margin:0;">&copy; 2026 Rosefoam · Royikems Foam Company Ltd. · All rights reserved.</p>
                <div class="footer__pay" aria-label="Accepted payment methods">
                    <span>Visa</span><span>Mastercard</span><span>Mobile Money</span><span>Cash on delivery</span>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('hearth/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('hearth/js/main.js') }}"></script>
    <script src="{{ asset('hearth/js/checkout.js') }}"></script>
</body>

</html>
