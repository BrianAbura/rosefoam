<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track your order — Rosefoam</title>
    <link rel="icon" type="image/png" href="{{ asset('hearth/img/rosefoam-logo.png') }}">
    <meta name="description" content="Enter your Rosefoam order number to see the latest status and details.">

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
                <a href="{{ route('home') }}#categories">Mattresses</a>
                <a href="{{ route('shop') }}">Shop</a>
                <a href="{{ route('home') }}#why">Why Rosefoam</a>
                <a href="{{ route('home') }}#reviews">Reviews</a>
                <a href="{{ route('track-order') }}" class="nav__cta btn btn--line btn--sm">Track an order</a>
            </nav>

            <div class="header__tools">
                {{-- <button class="icon-btn" type="button" aria-label="Search products">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="11" cy="11" r="7" />
                        <path d="m20 20-3.5-3.5" />
                    </svg>
                </button>
                <button class="icon-btn" type="button" aria-label="Your account">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="12" cy="8" r="4" />
                        <path d="M4 20c0-4 3.6-6 8-6s8 2 8 6" />
                    </svg>
                </button> --}}
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
            <a href="{{ route('checkout') }}" class="btn btn--ember btn--block">
                Checkout
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                    stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M5 12h14M13 6l6 6-6 6" />
                </svg>
            </a>
        </div>
    </aside>

    <main id="main">
        <section class="section section--ivory" id="track-order" aria-labelledby="track-h">
            <div class="wrap track-wrap">
                <div class="track-head">
                    <span class="eyebrow">Customer support</span>
                    <h1 id="track-h">Track your order</h1>
                    <p>Enter your order number (e.g. RFM-000002) to see the latest status, items and delivery details.
                    </p>
                </div>

                <form method="GET" action="{{ route('track-order') }}" class="track-form" novalidate>
                    <label for="order_number" class="sr-only">Order number</label>
                    <input type="text" id="order_number" name="order_number" class="form-control"
                        value="{{ old('order_number', $orderNumber ?? '') }}"
                        placeholder="Order number, e.g. RFM-000002" required>
                    <button type="submit" class="btn btn--ember">Track order
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M5 12h14M13 6l6 6-6 6" />
                        </svg>
                    </button>
                </form>

                @if ($searched && !$order)
                    <div class="track-alert" role="alert">
                        <p>We could not find an order matching <strong>{{ $orderNumber }}</strong>. Please check the
                            number and try again, or <a href="tel:+256414660820">call us on 041 4660820</a> for help.
                        </p>
                    </div>
                @endif

                @if ($order)
                    <div class="track-result">
                        <div class="track-result__head">
                            <div>
                                <span class="eyebrow">Order {{ $order->order_number }}</span>
                                <h2>Placed on {{ $order->created_at->format('F j, Y') }}</h2>
                            </div>
                            <span
                                class="status-badge status-badge--{{ $order->order_status }}">{{ str_replace('_', ' ', ucfirst($order->order_status)) }}</span>
                        </div>

                        <div class="status-track" aria-label="Order status">
                            @php
                                $statuses = ['pending', 'confirmed', 'processing', 'dispatched', 'delivered'];
                                $currentIndex = array_search($order->order_status, $statuses);
                                if ($currentIndex === false) {
                                    $currentIndex = -1;
                                }
                            @endphp
                            @foreach ($statuses as $index => $status)
                                @php
                                    $isActive = $index <= $currentIndex;
                                    $isCurrent = $index === $currentIndex;
                                @endphp
                                <div
                                    class="status-step {{ $isActive ? 'is-active' : '' }} {{ $isCurrent ? 'is-current' : '' }}">
                                    <div class="status-dot"></div>
                                    <span>{{ str_replace('_', ' ', ucfirst($status)) }}</span>
                                </div>
                                @if (!$loop->last)
                                    <div class="status-line {{ $index < $currentIndex ? 'is-active' : '' }}"></div>
                                @endif
                            @endforeach
                        </div>

                        <div class="track-grid">
                            <div class="checkout-card">
                                <h3 class="checkout-card__title">Items</h3>
                                <table class="checkout-table">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Qty</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->items as $item)
                                            <tr>
                                                <td class="checkout-item">
                                                    <span>{{ $item->product_name }}</span>
                                                </td>
                                                <td class="checkout-qty">{{ $item->quantity }}</td>
                                                <td class="checkout-line">UGX {{ number_format($item->line_total) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="checkout-totals">
                                    <div class="totals-row totals-row--grand">
                                        <span>Total</span>
                                        <strong>UGX {{ number_format($order->total_amount) }}</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="checkout-card">
                                <h3 class="checkout-card__title">Delivery details</h3>
                                <div class="confirm-detail">
                                    <span>Name</span>
                                    <strong>{{ $order->customer_name }}</strong>
                                </div>
                                <div class="confirm-detail">
                                    <span>Phone</span>
                                    <strong>{{ $order->customer_phone }}</strong>
                                </div>
                                @if ($order->customer_email)
                                    <div class="confirm-detail">
                                        <span>Email</span>
                                        <strong>{{ $order->customer_email }}</strong>
                                    </div>
                                @endif
                                <div class="confirm-detail">
                                    <span>Address</span>
                                    <strong>{{ $order->delivery_address }}</strong>
                                </div>
                                @if ($order->delivery_district)
                                    <div class="confirm-detail">
                                        <span>District</span>
                                        <strong>{{ $order->delivery_district }}</strong>
                                    </div>
                                @endif
                                <div class="confirm-detail">
                                    <span>Payment</span>
                                    <strong>{{ str_replace('_', ' ', ucfirst($order->payment_method)) }} ·
                                        {{ str_replace('_', ' ', ucfirst($order->payment_status)) }}</strong>
                                </div>
                                @if ($order->customer_notes)
                                    <div class="confirm-detail">
                                        <span>Notes</span>
                                        <strong>{{ $order->customer_notes }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
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
                        Mbalala, Mukono, and delivered countrywide. A world of beautiful dreams.</p>
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
</body>

</html>
