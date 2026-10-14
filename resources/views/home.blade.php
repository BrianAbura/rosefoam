<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rosefoam — Mattresses &amp; Pillows | A World of Beautiful Dreams</title>
    <link rel="icon" type="image/png" href="{{ asset('hearth/img/rosefoam-logo.png') }}">
    <meta name="description"
        content="Rosefoam makes quality mattresses, pillows and toppers at our plant in Mbalala, Mukono. Free delivery countrywide. Shop foam, spring and orthopaedic mattresses made for Ugandan beds.">

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
        Free delivery countrywide · Made at our own plant in Mbalala, Mukono · Custom sizes available
    </div>

    <header class="header" id="header">
        <div class="wrap header__bar">
            <a class="brand" href="#top" aria-label="Rosefoam — home">
                <img class="brand__logo" src="{{ asset('hearth/img/rosefoam-logo.png') }}" alt="Rosefoam">
            </a>

            <nav class="nav" id="nav" aria-label="Primary">
                <a href="#top">Home</a>
                <a href="#categories">Mattresses</a>
                <a href="{{ route('shop') }}">Shop</a>
                <a href="#why">Why Rosefoam</a>
                <a href="#reviews">Reviews</a>
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
        <span id="top"></span>

        <!-- ===== hero ===== -->
        <!-- ===== hero carousel ===== -->
        <section class="hero hero--carousel" aria-label="Featured collection">
            <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel"
                data-bs-interval="5000" data-bs-pause="hover">
                @if ($heroBanners->count() > 1)
                    <div class="carousel-indicators">
                        @foreach ($heroBanners as $key => $banner)
                            <button type="button" data-bs-target="#heroCarousel"
                                data-bs-slide-to="{{ $key }}" class="{{ $key === 0 ? 'active' : '' }}"
                                aria-current="{{ $key === 0 ? 'true' : 'false' }}"
                                aria-label="Slide {{ $key + 1 }}"></button>
                        @endforeach
                    </div>
                @endif

                <div class="carousel-inner">
                    @forelse($heroBanners as $key => $banner)
                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                            <div class="hero__slide"
                                style="background-image: url('{{ $banner->image_path ? asset('storage/' . $banner->image_path) : asset('hearth/img/hero.jpg') }}')"
                                aria-label="{{ $banner->title }}">
                                <div class="hero__overlay"></div>
                                <div class="wrap hero__caption">
                                    <span class="eyebrow">{{ $banner->subtitle ?? 'The Rosefoam difference' }}</span>
                                    <h1>{{ $banner->title ?? 'Find your perfect mattress.' }}</h1>
                                    <p class="hero__lead">Award-winning foam and spring mattresses made in Mbalala,
                                        Mukono. Designed for Ugandan beds, delivered free countrywide.</p>
                                    <div class="hero__actions">
                                        <a href="{{ $banner->button_url ?? '#shop' }}" class="btn btn--ember">
                                            {{ $banner->button_text ?? 'Shop mattresses' }}
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                                                aria-hidden="true">
                                                <path d="M5 12h14M13 6l6 6-6 6" />
                                            </svg>
                                        </a>
                                        <a href="#categories" class="btn btn--line">Find your fit</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="carousel-item active">
                            <div class="hero__slide"
                                style="background-image: url('{{ asset('hearth/img/hero.jpg') }}')"
                                aria-label="Welcoming bedroom">
                                <div class="hero__overlay"></div>
                                <div class="wrap hero__caption">
                                    <span class="eyebrow">The Rosefoam difference</span>
                                    <h1>Find your perfect mattress.</h1>
                                    <p class="hero__lead">Award-winning foam and spring mattresses made in Mbalala,
                                        Mukono. Designed for Ugandan beds, delivered free countrywide.</p>
                                    <div class="hero__actions">
                                        <a href="#shop" class="btn btn--ember">
                                            Shop mattresses
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                                                aria-hidden="true">
                                                <path d="M5 12h14M13 6l6 6-6 6" />
                                            </svg>
                                        </a>
                                        <a href="#categories" class="btn btn--line">Find your fit</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>

                @if ($heroBanners->count() > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                @endif
            </div>
        </section>

        <!-- ===== trust strip ===== -->
        <div class="brandstrip">
            <div class="wrap">
                <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M3 7h11v9H3z" />
                        <path d="M14 10h4l3 3v3h-7z" />
                        <circle cx="7" cy="18" r="2" />
                        <circle cx="17" cy="18" r="2" />
                    </svg> Free delivery countrywide</span>
                <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M12 3l7 3v5c0 4.5-3 8-7 10-4-2-7-5.5-7-10V6l7-3Z" />
                        <path d="m9 12 2 2 4-4" />
                    </svg> 10-year quality guarantee</span>
                <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M12 3c2 4 6 6 6 11a6 6 0 0 1-12 0c0-3 1-4 2-6" />
                    </svg> Made in Mbalala, Mukono</span>
                <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M4 12l4 4 12-12" />
                        <path d="M4 19h16" />
                    </svg> Custom sizes on order</span>
            </div>
        </div>

        <!-- ===== categories ===== -->
        <section class="section wrap" id="categories" aria-labelledby="cat-h">
            <div class="section-head--between">
                <div>
                    <span class="eyebrow">Find your fit</span>
                    <h2 id="cat-h">Four ways to sleep well</h2>
                </div>
                <a href="#shop" class="textlink">Browse everything
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M5 12h14M13 6l6 6-6 6" />
                    </svg>
                </a>
            </div>
            <div class="cats">
                @forelse($categories as $category)
                    <a class="cat" href="#shop" data-reveal>
                        <img src="{{ $category->image ? asset('storage/' . $category->image) : asset('hearth/img/cat-living.jpg') }}"
                            alt="{{ $category->name }}" width="900" height="1120">
                        <div class="cat__body">
                            <span
                                class="cat__count">{{ $category->description ? strip_tags($category->description) : 'Explore' }}</span>
                            <h3>{{ $category->name }}</h3>
                            <span class="cat__link">Shop {{ $category->name }}
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"
                                    stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M5 12h14M13 6l6 6-6 6" />
                                </svg>
                            </span>
                        </div>
                    </a>
                @empty
                    <div class="col-12">
                        <p class="text-center text-muted">No mattress categories have been added yet. Create them from
                            the Filament admin.</p>
                    </div>
                @endforelse
            </div>
        </section>

        <!-- ===== product grid ===== -->
        <section class="section section--ivory" id="shop" aria-labelledby="shop-h">
            <div class="wrap">
                <div class="section-head--between">
                    <div>
                        <span class="eyebrow">Shop the collection</span>
                        <h2 id="shop-h">Mattresses people love</h2>
                    </div>
                    <div class="filters" role="tablist" aria-label="Filter products by category">
                        <button class="filter is-active" type="button" data-filter="all" role="tab"
                            aria-selected="true">All</button>
                        @foreach ($categories as $category)
                            <button class="filter" type="button" data-filter="{{ $category->slug }}"
                                role="tab" aria-selected="false">{{ $category->name }}</button>
                        @endforeach
                    </div>
                </div>

                <div class="products" id="products">
                    @forelse($products as $product)
                        <article class="card" data-cat="{{ $product->category?->slug ?? 'all' }}" data-reveal>
                            <div class="card__media">
                                @if ($product->compare_at_price && $product->compare_at_price > $product->price)
                                    <span class="card__tag card__tag--sale">Save UGX
                                        {{ number_format($product->compare_at_price - $product->price) }}</span>
                                @elseif($product->is_featured)
                                    <span class="card__tag">Featured</span>
                                @endif
                                <button class="wish" type="button" aria-label="Save {{ $product->name }}"
                                    aria-pressed="false"><svg viewBox="0 0 24 24" aria-hidden="true">
                                        <path
                                            d="M12 20s-7-4.6-9.3-9C1 8 2.6 4.8 6 4.8c2 0 3.2 1.2 4 2.4.8-1.2 2-2.4 4-2.4 3.4 0 5 3.2 3.3 6.2C19 15.4 12 20 12 20Z" />
                                    </svg></button>
                                <button class="card__media-trigger" type="button" data-bs-toggle="modal"
                                    data-bs-target="#homeProductModal{{ $product->id }}"
                                    aria-label="Quick view {{ $product->name }}">
                                    <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('hearth/img/prod-sofa.jpg') }}"
                                        alt="{{ $product->name }}" width="1000" height="1000">
                                </button>
                            </div>
                            <div class="card__body">
                                <span class="card__ey">{{ $product->category?->name ?? 'Mattress' }}</span>
                                <h3 class="card__name"><a href="javascript:void(0);" role="button"
                                        data-bs-toggle="modal"
                                        data-bs-target="#homeProductModal{{ $product->id }}">{{ $product->name }}</a>
                                </h3>
                                <p class="card__desc">
                                    {{ $product->short_description ?? 'Quality sleep made in Mbalala, Mukono.' }}</p>
                                <div class="rating"><svg viewBox="0 0 24 24" aria-hidden="true">
                                        <path
                                            d="m12 2 3 6.3 6.9.9-5 4.8 1.2 6.8L12 17.8 5.9 20.8 7.1 14l-5-4.8 6.9-.9L12 2Z" />
                                    </svg> 4.9 (100+)</div>
                                <div class="card__foot">
                                    <span class="price">
                                        UGX {{ number_format($product->price) }}
                                        @if ($product->compare_at_price && $product->compare_at_price > $product->price)
                                            <del>UGX {{ number_format($product->compare_at_price) }}</del>
                                        @endif
                                    </span>
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
                    @empty
                        <div class="col-12 text-center py-5">
                            <p class="text-muted">No featured products are set for the homepage.
                            </p>
                        </div>
                    @endforelse
                </div>

                <!-- home product quick-view modals (outside product grid to avoid clipping) -->
                <div class="product-modals" aria-hidden="true">
                    @foreach ($products as $product)
                        <div class="modal fade product-modal" id="homeProductModal{{ $product->id }}"
                            tabindex="-1" aria-labelledby="homeProductModalLabel{{ $product->id }}"
                            aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="homeProductModalLabel{{ $product->id }}">
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
                                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            aria-hidden="true">
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
            </div>
        </section>

        <!-- ===== promo banner ===== -->
        @php
            $promoImage =
                $promoBanner && $promoBanner->image_path
                    ? asset('storage/' . $promoBanner->image_path)
                    : asset('hearth/img/sale.jpg');
        @endphp
        <section class="section--tight sale" aria-labelledby="sale-h">
            <div class="sale__bg" aria-hidden="true"><img src="{{ $promoImage }}" alt="" width="1600"
                    height="900"></div>
            <div class="wrap sale__inner">
                <div data-reveal>
                    <span class="eyebrow"
                        style="color:var(--honey-soft)">{{ $promoBanner?->subtitle ?? 'Built for Ugandan beds' }}</span>
                    <h2 id="sale-h">{!! $promoBanner?->title ?: 'Sleep better, <em>wake stronger</em>' !!}</h2>
                    <p>{{ $promoBanner?->button_text ?? 'Standard 3 × 6 through 6 × 6 sizes, plus custom orders for hotels, schools and hospitals. Free delivery countrywide on every order.' }}
                    </p>
                    <a href="{{ $promoBanner?->button_url ?? '#shop' }}"
                        class="btn btn--ember">{{ $promoBanner?->button_text ?? 'Shop the collection' }}
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M5 12h14M13 6l6 6-6 6" />
                        </svg>
                    </a>
                </div>
                <div class="countdown" id="countdown" data-reveal data-delay="1"
                    aria-label="Time remaining in the sale">
                    <div class="count-cell"><b id="cd-d">04</b><span>Days</span></div>
                    <div class="count-cell"><b id="cd-h">12</b><span>Hrs</span></div>
                    <div class="count-cell"><b id="cd-m">45</b><span>Min</span></div>
                    <div class="count-cell"><b id="cd-s">30</b><span>Sec</span></div>
                </div>
            </div>
        </section>

        <!-- ===== why rosefoam ===== -->
        <!-- ===== why rosefoam ===== -->
        <section class="section section--oatdeep" id="why" aria-labelledby="why-h">
            <div class="wrap why">
                <div class="why__media" data-reveal>
                    <img src="{{ asset('hearth/img/about-rosefoam.png') }}" alt="Rosefoam mattress craftsmanship"
                        width="1200" height="900">
                </div>
                <div class="why__body" data-reveal data-delay="1">
                    <span class="eyebrow">Why Rosefoam</span>
                    <h2 id="why-h">{{ $whyPage?->title ?? 'Better sleep starts with better craftsmanship.' }}</h2>
                    <p class="why__lead">At Rosefoam, we believe a good mattress does more than fill a bed — it helps
                        you rest comfortably and wake up ready for the day. With our own manufacturing plant in Mbalala
                        along the Mukono–Jinja Road, we bring together careful workmanship, quality materials and
                        practical comfort for Ugandan homes.</p>

                    <ul class="why-list">
                        <li>
                            <span class="why-ico" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2 22V10l6-2v14" />
                                    <path d="M10 22V8l6-2v16" />
                                    <path d="M18 22V6l4-1v17" />
                                    <path d="M2 10h20" />
                                </svg>
                            </span>
                            <div>
                                <h4>Proudly made in Uganda</h4>
                                <p>Manufactured at our Mbalala plant, where we oversee the process from foam
                                    preparation to the final finish.</p>
                            </div>
                        </li>
                        <li>
                            <span class="why-ico" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 2l10 6-10 6L2 8l10-6Z" />
                                    <path d="M2 17l10 6 10-6" />
                                    <path d="M2 12l10 6 10-6" />
                                </svg>
                            </span>
                            <div>
                                <h4>Quality in every detail</h4>
                                <p>From foam selection and quilting to neat finishing, we pay attention to the details
                                    that make a mattress feel and look right.</p>
                            </div>
                        </li>
                        <li>
                            <span class="why-ico" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 12h18v7H3z" />
                                    <path d="M3 12V9a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v3" />
                                    <path d="M7 15v-3" />
                                    <path d="M17 15v-3" />
                                </svg>
                            </span>
                            <div>
                                <h4>The right fit for your bed</h4>
                                <p>Choose from standard mattress sizes, from 3 × 6 to 6 × 6, or ask us about custom
                                    sizes for homes, hotels, schools and hostels.</p>
                            </div>
                        </li>
                        <li>
                            <span class="why-ico" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 7h13l1 8H4L3 7Z" />
                                    <path d="M16 15h2l3-3V7h-4v8" />
                                    <circle cx="7" cy="17" r="2" />
                                    <circle cx="17" cy="17" r="2" />
                                </svg>
                            </span>
                            <div>
                                <h4>Delivered to your doorstep</h4>
                                <p>Enjoy convenient countrywide delivery, so you can shop for your mattress with less
                                    hassle.</p>
                            </div>
                        </li>
                    </ul>

                    <p class="why__cta-label">Suggested call to action</p>
                    <a href="#shop" class="btn btn--walnut">Explore Our Mattresses
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M5 12h14M13 6l6 6-6 6" />
                        </svg>
                    </a>
                </div>
            </div>
        </section>

        <!-- ===== reviews ===== -->
        <section class="section wrap" id="reviews" aria-labelledby="rev-h">
            <div class="section-head section-head--center">
                <span class="eyebrow eyebrow--center">Loved at home</span>
                <h2 id="rev-h">4.8 out of 5 across Uganda</h2>
                <p>Verified buyers on what it is like to sleep on Rosefoam.</p>
            </div>
            <div class="reviews-grid">
                <figure class="review" data-reveal>
                    <div class="review__stars" aria-label="Rated 5 out of 5">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="m12 2 3 6.3 6.9.9-5 4.8 1.2 6.8L12 17.8 5.9 20.8 7.1 14l-5-4.8 6.9-.9L12 2Z" />
                        </svg><svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="m12 2 3 6.3 6.9.9-5 4.8 1.2 6.8L12 17.8 5.9 20.8 7.1 14l-5-4.8 6.9-.9L12 2Z" />
                        </svg><svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="m12 2 3 6.3 6.9.9-5 4.8 1.2 6.8L12 17.8 5.9 20.8 7.1 14l-5-4.8 6.9-.9L12 2Z" />
                        </svg><svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="m12 2 3 6.3 6.9.9-5 4.8 1.2 6.8L12 17.8 5.9 20.8 7.1 14l-5-4.8 6.9-.9L12 2Z" />
                        </svg><svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="m12 2 3 6.3 6.9.9-5 4.8 1.2 6.8L12 17.8 5.9 20.8 7.1 14l-5-4.8 6.9-.9L12 2Z" />
                        </svg>
                    </div>
                    <blockquote class="review__quote">"We ordered a 5 × 6 high density mattress and it arrived the next
                        day. The foam is firm and has not sunk in six months."</blockquote>
                    <figcaption class="review__who">
                        <img src="{{ asset('hearth/img/rev-1.jpg') }}" alt="" width="46"
                            height="46">
                        <span><b>Sarah N.</b><span>High Density Smart · Kampala</span></span>
                        <span class="review__verified"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="m4 12 5 5 11-11" />
                            </svg>Verified</span>
                    </figcaption>
                </figure>

                <figure class="review" data-reveal data-delay="1">
                    <div class="review__stars" aria-label="Rated 5 out of 5">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="m12 2 3 6.3 6.9.9-5 4.8 1.2 6.8L12 17.8 5.9 20.8 7.1 14l-5-4.8 6.9-.9L12 2Z" />
                        </svg><svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="m12 2 3 6.3 6.9.9-5 4.8 1.2 6.8L12 17.8 5.9 20.8 7.1 14l-5-4.8 6.9-.9L12 2Z" />
                        </svg><svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="m12 2 3 6.3 6.9.9-5 4.8 1.2 6.8L12 17.8 5.9 20.8 7.1 14l-5-4.8 6.9-.9L12 2Z" />
                        </svg><svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="m12 2 3 6.3 6.9.9-5 4.8 1.2 6.8L12 17.8 5.9 20.8 7.1 14l-5-4.8 6.9-.9L12 2Z" />
                        </svg><svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="m12 2 3 6.3 6.9.9-5 4.8 1.2 6.8L12 17.8 5.9 20.8 7.1 14l-5-4.8 6.9-.9L12 2Z" />
                        </svg>
                    </div>
                    <blockquote class="review__quote">"The Bonvisco spring mattress supports my back without being too
                        hard. I wake up without the shoulder pain I used to have."</blockquote>
                    <figcaption class="review__who">
                        <img src="{{ asset('hearth/img/rev-2.jpg') }}" alt="" width="46"
                            height="46">
                        <span><b>Daniel O.</b><span>Bonvisco Spring · Jinja</span></span>
                        <span class="review__verified"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="m4 12 5 5 11-11" />
                            </svg>Verified</span>
                    </figcaption>
                </figure>

                <figure class="review" data-reveal data-delay="2">
                    <div class="review__stars" aria-label="Rated 5 out of 5">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="m12 2 3 6.3 6.9.9-5 4.8 1.2 6.8L12 17.8 5.9 20.8 7.1 14l-5-4.8 6.9-.9L12 2Z" />
                        </svg><svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="m12 2 3 6.3 6.9.9-5 4.8 1.2 6.8L12 17.8 5.9 20.8 7.1 14l-5-4.8 6.9-.9L12 2Z" />
                        </svg><svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="m12 2 3 6.3 6.9.9-5 4.8 1.2 6.8L12 17.8 5.9 20.8 7.1 14l-5-4.8 6.9-.9L12 2Z" />
                        </svg><svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="m12 2 3 6.3 6.9.9-5 4.8 1.2 6.8L12 17.8 5.9 20.8 7.1 14l-5-4.8 6.9-.9L12 2Z" />
                        </svg><svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="m12 2 3 6.3 6.9.9-5 4.8 1.2 6.8L12 17.8 5.9 20.8 7.1 14l-5-4.8 6.9-.9L12 2Z" />
                        </svg>
                    </div>
                    <blockquote class="review__quote">"We fitted our guest house with ten mattresses and Rosefoam
                        delivered all of them on time. The custom sizes were perfect."</blockquote>
                    <figcaption class="review__who">
                        <img src="{{ asset('hearth/img/rev-3.jpg') }}" alt="" width="46"
                            height="46">
                        <span><b>Grace A.</b><span>Bulk order · Entebbe</span></span>
                        <span class="review__verified"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="m4 12 5 5 11-11" />
                            </svg>Verified</span>
                    </figcaption>
                </figure>
            </div>
        </section>

        <!-- ===== newsletter ===== -->
        <section class="section--tight wrap" aria-labelledby="news-h">
            <div class="news" data-reveal>
                <div class="news__grid">
                    <div>
                        <span class="eyebrow" style="color:#fff">The Rosefoam sleep letter</span>
                        <h2 id="news-h">Sleep better, and hear about offers first</h2>
                        <p>One email a month: how to choose a mattress, how to make it last, and our offers before
                            anyone else.</p>
                    </div>
                    <div>
                        <form class="news__form" id="newsForm" novalidate>
                            <label class="sr-only" for="newsEmail">Email address</label>
                            <input type="email" id="newsEmail" name="email" placeholder="you@email.com"
                                autocomplete="email" required>
                            <button class="btn btn--walnut" type="submit">Join</button>
                        </form>
                        <p class="news__msg" id="newsMsg" role="status" aria-live="polite"></p>
                        <p class="news__fine">By subscribing you agree to our privacy policy. Unsubscribe anytime.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="wrap">
            <div class="footer__top">
                <div>
                    <a class="brand" href="#top" aria-label="Rosefoam — home">
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
                        <li><a href="#shop">All mattresses</a></li>
                        <li><a href="#categories">High density</a></li>
                        <li><a href="#categories">Spring</a></li>
                        <li><a href="#categories">Orthopaedic</a></li>
                        <li><a href="#shop">Pillows &amp; toppers</a></li>
                    </ul>
                </div>
                <div class="footer__col">
                    <h4>Help</h4>
                    <ul>
                        <li><a href="{{ route('track-order') }}">Track an order</a></li>
                        <li><a href="#">Bulk and trade</a></li>
                        <li><a href="#why">Why Rosefoam</a></li>
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
                <p style="margin:0;">&copy; 2026 Rosefoam · Rosefoam Foam Company Ltd. · All rights reserved.</p>
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
