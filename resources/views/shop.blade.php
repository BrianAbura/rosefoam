<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Rosefoam — Mattresses &amp; Pillows</title>
    <link rel="icon" type="image/png" href="{{ asset('hearth/img/rosefoam-logo.png') }}">
    <meta name="description"
        content="Shop Rosefoam mattresses, pillows and toppers. Filter by category and find the right comfort for your home. Free delivery countrywide.">

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
                <a href="{{ route('shop') }}" class="is-active">Shop</a>
                <a href="{{ route('home') }}#categories">Mattresses</a>
                <a href="{{ route('home') }}#why">Why Rosefoam</a>
                <a href="{{ route('home') }}#reviews">Reviews</a>
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
                    </svg> --}}
                </button>
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
        <section class="section section--ivory" id="shop" aria-labelledby="shop-h">
            <div class="wrap">
                <div class="shop-head">
                    <div>
                        <span class="eyebrow">Shop Rosefoam</span>
                        <h1 id="shop-h">Find the right comfort for your home.</h1>
                    </div>
                    <div class="shop-summary">
                        <span>{{ $products->total() }} product{{ $products->total() !== 1 ? 's' : '' }}</span>
                        @if ($activeCategory)
                            <span class="shop-filter">in
                                {{ $categories->firstWhere('slug', $activeCategory)?->name ?? $activeCategory }}</span>
                        @endif
                    </div>
                </div>

                <div class="filters filters--shop" aria-label="Filter by category">
                    <a class="filter {{ $activeCategory ? '' : 'is-active' }}" href="{{ route('shop') }}">All</a>
                    @foreach ($categories as $category)
                        <a class="filter {{ $activeCategory === $category->slug ? 'is-active' : '' }}"
                            href="{{ route('shop', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                    @endforeach
                </div>

                @if ($products->isEmpty())
                    <div class="shop-empty" data-reveal>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4"
                            stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M6 8h12l-1 12H7L6 8Z" />
                            <path d="M9 8a3 3 0 0 1 6 0" />
                        </svg>
                        <h3>No products in this category yet</h3>
                        <p>Try selecting another category or check back once products have been added from the admin.
                        </p>
                        <a href="{{ route('shop') }}" class="btn btn--ember">Browse all products
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M5 12h14M13 6l6 6-6 6" />
                            </svg>
                        </a>
                    </div>
                @else
                    <div class="products products--shop" id="products">
                        @foreach ($products as $product)
                            <article class="card card--shop" data-cat="{{ $product->category?->slug ?? 'all' }}"
                                data-reveal>
                                <div class="card__media">
                                    @if ($product->compare_at_price && $product->compare_at_price > $product->price)
                                        <span class="card__tag card__tag--sale">Save UGX
                                            {{ number_format($product->compare_at_price - $product->price) }}</span>
                                    @elseif($product->is_featured)
                                        <span class="card__tag">Featured</span>
                                    @endif
                                    <button class="card__media-trigger" type="button" data-bs-toggle="modal"
                                        data-bs-target="#productModal{{ $product->id }}"
                                        aria-label="Quick view {{ $product->name }}">
                                        <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('hearth/img/prod-sofa.jpg') }}"
                                            alt="{{ $product->name }}" width="1000" height="1000">
                                    </button>
                                </div>
                                <div class="card__body">
                                    <span class="card__ey">{{ $product->category?->name ?? 'Mattress' }}</span>
                                    <h3 class="card__name"><a href="javascript:void(0);" role="button"
                                            data-bs-toggle="modal"
                                            data-bs-target="#productModal{{ $product->id }}">{{ $product->name }}</a>
                                    </h3>
                                    <p class="card__desc">
                                        {{ $product->short_description ?? 'Quality sleep made in Mbalala, Mukono.' }}
                                    </p>
                                    <div class="card__foot">
                                        <span class="price">UGX {{ number_format($product->price) }}</span>
                                        <button class="add-btn" type="button" data-id="{{ $product->id }}"
                                            data-name="{{ $product->name }}" data-price="{{ $product->price }}"
                                            data-img="{{ $product->image ? asset('storage/' . $product->image) : asset('hearth/img/prod-sofa.jpg') }}"
                                            aria-label="Add {{ $product->name }} to cart">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" aria-hidden="true">
                                                <path d="M12 5v14M5 12h14" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                            </article>
                        @endforeach
                    </div>

                    <!-- product quick-view modals (outside product grid to avoid clipping) -->
                    <div class="product-modals" aria-hidden="true">
                        @foreach ($products as $product)
                            <div class="modal fade product-modal" id="productModal{{ $product->id }}"
                                tabindex="-1" aria-labelledby="productModalLabel{{ $product->id }}"
                                aria-hidden="true">
                                <div class="modal-dialog modal-xl modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="productModalLabel{{ $product->id }}">
                                                {{ $product->name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="product-modal__grid">
                                                <div class="product-modal__image">
                                                    <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('hearth/img/prod-sofa.jpg') }}"
                                                        alt="{{ $product->name }}">
                                                </div>
                                                <div class="product-modal__info">
                                                    <span
                                                        class="eyebrow">{{ $product->category?->name ?? 'Mattress' }}</span>
                                                    <h2>{{ $product->name }}</h2>
                                                    <span class="price price--lg">UGX
                                                        {{ number_format($product->price) }}</span>
                                                    <p>
                                                        {{ \Illuminate\Support\Str::limit(strip_tags($product->description ?? ($product->short_description ?? 'Quality sleep made in Mbalala, Mukono.')), 400) }}
                                                    </p>
                                                    <div class="product-modal__actions">
                                                        <button class="add-btn add-btn--lg" type="button"
                                                            data-id="{{ $product->id }}"
                                                            data-name="{{ $product->name }}"
                                                            data-price="{{ $product->price }}"
                                                            data-img="{{ $product->image ? asset('storage/' . $product->image) : asset('hearth/img/prod-sofa.jpg') }}"
                                                            aria-label="Add {{ $product->name }} to cart">
                                                            <svg viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" aria-hidden="true">
                                                                <path d="M12 5v14M5 12h14" />
                                                            </svg>
                                                        </button>
                                                        <span>Add to cart</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="shop-pagination">
                        {{ $products->links('pagination::bootstrap-5') }}
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
