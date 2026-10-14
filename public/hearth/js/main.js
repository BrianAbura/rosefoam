/* =========================================================================
   HEARTH — main.js
   Vanilla JS only. Each feature is a guard-claused init().
   Cart state is shared across index.html + product.html via localStorage.
   ========================================================================= */
(function () {
    "use strict";

    var reduceMotion = window.matchMedia(
        "(prefers-reduced-motion: reduce)",
    ).matches;

    /* ---------- helpers ---------- */
    function money(n, dec) {
        return (
            "UGX " +
            Number(n).toLocaleString("en-US", {
                minimumFractionDigits: dec || 0,
                maximumFractionDigits: dec || 0,
            })
        );
    }
    function lockScroll(on) {
        document.body.style.overflow = on ? "hidden" : "";
    }

    /* ==================================================== sticky header */
    function initHeaderStuck() {
        var header = document.getElementById("header");
        if (!header) return;
        var onScroll = function () {
            header.classList.toggle("is-stuck", window.scrollY > 12);
        };
        onScroll();
        window.addEventListener("scroll", onScroll, { passive: true });
    }

    /* ==================================================== mobile nav */
    function initMobileNav() {
        var toggle = document.getElementById("navToggle");
        var nav = document.getElementById("nav");
        var backdrop = document.getElementById("backdrop");
        if (!toggle || !nav) return;

        function setOpen(open) {
            nav.classList.toggle("is-open", open);
            toggle.classList.toggle("is-open", open);
            toggle.setAttribute("aria-expanded", open ? "true" : "false");
            if (backdrop) backdrop.classList.toggle("is-on", open);
            lockScroll(open);
        }
        toggle.addEventListener("click", function () {
            setOpen(!nav.classList.contains("is-open"));
        });
        // close when a nav link is tapped
        nav.querySelectorAll("a").forEach(function (a) {
            a.addEventListener("click", function () {
                setOpen(false);
            });
        });
        if (backdrop)
            backdrop.addEventListener("click", function () {
                setOpen(false);
            });
        document.addEventListener("keydown", function (e) {
            if (e.key === "Escape" && nav.classList.contains("is-open"))
                setOpen(false);
        });
    }

    /* ==================================================== cart */
    var Cart = (function () {
        var KEY = "rosefoam-cart-v1";
        var items = [];

        function load() {
            try {
                var raw = localStorage.getItem(KEY);
                items = raw ? JSON.parse(raw) : [];
                if (!Array.isArray(items)) items = [];
            } catch (e) {
                items = [];
            }
        }
        function save() {
            try {
                localStorage.setItem(KEY, JSON.stringify(items));
            } catch (e) {}
        }
        function count() {
            return items.reduce(function (s, i) {
                return s + i.qty;
            }, 0);
        }
        function total() {
            return items.reduce(function (s, i) {
                return s + i.qty * i.price;
            }, 0);
        }
        function add(item, qty) {
            qty = qty || 1;
            var found = items.filter(function (i) {
                return i.id === item.id;
            })[0];
            if (found) {
                found.qty += qty;
            } else {
                items.push({
                    id: item.id,
                    name: item.name,
                    price: item.price,
                    img: item.img,
                    qty: qty,
                });
            }
            save();
        }
        function setQty(id, qty) {
            var it = items.filter(function (i) {
                return i.id === id;
            })[0];
            if (!it) return;
            it.qty = qty;
            if (it.qty <= 0)
                items = items.filter(function (i) {
                    return i.id !== id;
                });
            save();
        }
        function remove(id) {
            items = items.filter(function (i) {
                return i.id !== id;
            });
            save();
        }
        load();
        return {
            items: function () {
                return items;
            },
            count: count,
            total: total,
            add: add,
            setQty: setQty,
            remove: remove,
        };
    })();

    function initCart() {
        var openBtn = document.getElementById("cartOpen");
        var closeBtn = document.getElementById("cartClose");
        var drawer = document.getElementById("cart");
        var backdrop = document.getElementById("backdrop");
        var body = document.getElementById("cartBody");
        var emptyEl = document.getElementById("cartEmpty");
        var totalEl = document.getElementById("cartTotal");
        var countEl = document.getElementById("cartCount");
        if (!drawer || !body) return;

        function open() {
            drawer.classList.add("is-open");
            drawer.setAttribute("aria-hidden", "false");
            if (backdrop) backdrop.classList.add("is-on");
            lockScroll(true);
            if (closeBtn) closeBtn.focus();
        }
        function close() {
            drawer.classList.remove("is-open");
            drawer.setAttribute("aria-hidden", "true");
            if (backdrop) backdrop.classList.remove("is-on");
            lockScroll(false);
        }

        function lineTemplate(it) {
            return (
                "" +
                '<div class="cart-item" data-id="' +
                it.id +
                '">' +
                '<img class="cart-item__img" src="' +
                it.img +
                '" alt="' +
                it.name +
                '">' +
                '<div class="cart-item__mid">' +
                '<div class="cart-item__name">' +
                it.name +
                "</div>" +
                '<div class="cart-item__meta">' +
                money(it.price) +
                " each</div>" +
                '<div class="qty" aria-label="Quantity for ' +
                it.name +
                '">' +
                '<button type="button" data-act="dec" aria-label="Decrease quantity">−</button>' +
                "<span>" +
                it.qty +
                "</span>" +
                '<button type="button" data-act="inc" aria-label="Increase quantity">+</button>' +
                "</div>" +
                "</div>" +
                '<div class="d-flex flex-column align-items-end">' +
                '<button class="cart-item__remove" type="button" data-act="rm" aria-label="Remove ' +
                it.name +
                '">' +
                '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" aria-hidden="true"><path d="M6 6l12 12M18 6 6 18"/></svg>' +
                "</button>" +
                '<span class="cart-item__price">' +
                money(it.qty * it.price) +
                "</span>" +
                "</div>" +
                "</div>"
            );
        }

        function render() {
            var items = Cart.items();
            // remove existing lines
            body.querySelectorAll(".cart-item").forEach(function (n) {
                n.remove();
            });
            if (items.length === 0) {
                if (emptyEl) emptyEl.style.display = "";
            } else {
                if (emptyEl) emptyEl.style.display = "none";
                items.forEach(function (it) {
                    body.insertAdjacentHTML("beforeend", lineTemplate(it));
                });
            }
            if (totalEl) totalEl.textContent = money(Cart.total(), 2);
            if (countEl) {
                var c = Cart.count();
                countEl.textContent = c;
                countEl.classList.toggle("is-on", c > 0);
            }
        }

        // delegated controls inside the drawer
        body.addEventListener("click", function (e) {
            var btn = e.target.closest("button[data-act]");
            if (!btn) return;
            var row = btn.closest(".cart-item");
            if (!row) return;
            var id = row.getAttribute("data-id");
            var it = Cart.items().filter(function (i) {
                return i.id === id;
            })[0];
            var act = btn.getAttribute("data-act");
            if (act === "inc") Cart.setQty(id, (it ? it.qty : 0) + 1);
            else if (act === "dec") Cart.setQty(id, (it ? it.qty : 0) - 1);
            else if (act === "rm") Cart.remove(id);
            render();
        });

        if (openBtn) openBtn.addEventListener("click", open);
        if (closeBtn) closeBtn.addEventListener("click", close);
        if (backdrop)
            backdrop.addEventListener("click", function () {
                if (drawer.classList.contains("is-open")) close();
            });
        document.addEventListener("keydown", function (e) {
            if (e.key === "Escape" && drawer.classList.contains("is-open"))
                close();
        });

        // expose add-with-open for product buttons
        window.__hearthAdd = function (item, qty) {
            Cart.add(item, qty);
            render();
            open();
        };

        window.RosefoamCart = {
            items: Cart.items,
            add: Cart.add,
            setQty: Cart.setQty,
            remove: Cart.remove,
            count: Cart.count,
            total: Cart.total,
            render: render,
        };

        render();
    }

    /* ==================================================== add-to-cart buttons */
    function initAddButtons() {
        // grid cards
        document.querySelectorAll(".add-btn[data-id]").forEach(function (btn) {
            btn.addEventListener("click", function () {
                var item = {
                    id: btn.dataset.id,
                    name: btn.dataset.name,
                    price: parseFloat(btn.dataset.price),
                    img: btn.dataset.img,
                };
                if (window.__hearthAdd) window.__hearthAdd(item, 1);
                btn.classList.add("is-added");
                setTimeout(function () {
                    btn.classList.remove("is-added");
                }, 1100);
            });
        });
    }

    /* ==================================================== wishlist */
    function initWishlist() {
        document.querySelectorAll(".wish").forEach(function (btn) {
            btn.addEventListener("click", function () {
                var on = btn.classList.toggle("is-on");
                btn.setAttribute("aria-pressed", on ? "true" : "false");
            });
        });
    }

    /* ==================================================== product filter */
    function initFilters() {
        var filters = document.querySelectorAll(".filter[data-filter]");
        var cards = document.querySelectorAll("#products .card");
        if (!filters.length || !cards.length) return;
        filters.forEach(function (f) {
            f.addEventListener("click", function () {
                filters.forEach(function (x) {
                    x.classList.remove("is-active");
                    x.setAttribute("aria-selected", "false");
                });
                f.classList.add("is-active");
                f.setAttribute("aria-selected", "true");
                var val = f.getAttribute("data-filter");
                cards.forEach(function (c) {
                    var show =
                        val === "all" || c.getAttribute("data-cat") === val;
                    c.classList.toggle("is-hidden", !show);
                });
            });
        });
    }

    /* ==================================================== countdown */
    function initCountdown() {
        var root = document.getElementById("countdown");
        if (!root) return;
        var d = document.getElementById("cd-d"),
            h = document.getElementById("cd-h"),
            m = document.getElementById("cd-m"),
            s = document.getElementById("cd-s");
        if (!d || !h || !m || !s) return;
        var end = Date.now() + ((4 * 24 + 12) * 3600 + 45 * 60 + 30) * 1000;
        function pad(n) {
            return (n < 10 ? "0" : "") + n;
        }
        function tick() {
            var diff = Math.max(0, end - Date.now());
            var sec = Math.floor(diff / 1000);
            d.textContent = pad(Math.floor(sec / 86400));
            h.textContent = pad(Math.floor((sec % 86400) / 3600));
            m.textContent = pad(Math.floor((sec % 3600) / 60));
            s.textContent = pad(sec % 60);
            if (diff <= 0 && timer) clearInterval(timer);
        }
        tick();
        var timer = setInterval(tick, 1000);
    }

    /* ==================================================== newsletter */
    function initNewsletter() {
        var form = document.getElementById("newsForm");
        if (!form) return;
        var input = document.getElementById("newsEmail");
        var msg = document.getElementById("newsMsg");
        var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        form.addEventListener("submit", function (e) {
            e.preventDefault();
            var val = (input.value || "").trim();
            if (!re.test(val)) {
                if (msg)
                    msg.textContent = "Please enter a valid email address.";
                input.focus();
                return;
            }
            if (msg)
                msg.textContent =
                    "You're on the list — check your inbox for your 10% code.";
            form.reset();
        });
    }

    /* ==================================================== scroll reveal */
    function initReveal() {
        var els = document.querySelectorAll("[data-reveal]");
        if (!els.length) return;
        if (reduceMotion || !("IntersectionObserver" in window)) {
            els.forEach(function (el) {
                el.classList.add("is-in");
            });
            return;
        }
        var io = new IntersectionObserver(
            function (entries) {
                entries.forEach(function (en) {
                    if (en.isIntersecting) {
                        en.target.classList.add("is-in");
                        io.unobserve(en.target);
                    }
                });
            },
            { threshold: 0.14, rootMargin: "0px 0px -40px 0px" },
        );
        els.forEach(function (el) {
            io.observe(el);
        });
    }

    /* ==================================================== PDP gallery */
    function initGallery() {
        var main = document.getElementById("galleryMain");
        var thumbs = document.querySelectorAll(".gallery__thumb");
        if (!main || !thumbs.length) return;
        thumbs.forEach(function (t) {
            t.addEventListener("click", function () {
                var full = t.getAttribute("data-full");
                if (!full) return;
                main.src = full;
                thumbs.forEach(function (x) {
                    x.classList.remove("is-active");
                });
                t.classList.add("is-active");
            });
        });
    }

    /* ==================================================== PDP variants */
    function initVariants() {
        function group(sel, curId) {
            var btns = document.querySelectorAll(sel);
            var cur = document.getElementById(curId);
            if (!btns.length) return;
            btns.forEach(function (b) {
                b.addEventListener("click", function () {
                    btns.forEach(function (x) {
                        x.classList.remove("is-active");
                        x.setAttribute("aria-pressed", "false");
                    });
                    b.classList.add("is-active");
                    b.setAttribute("aria-pressed", "true");
                    if (cur) cur.textContent = b.getAttribute("data-name");
                });
            });
        }
        group("#swatches .swatch", "curFabric");
        group("#sizes .size", "curSize");
    }

    /* ==================================================== PDP qty + add */
    function initPdp() {
        var minus = document.getElementById("qtyMinus"),
            plus = document.getElementById("qtyPlus"),
            val = document.getElementById("qtyVal"),
            add = document.getElementById("pdpAdd");
        if (!val) return;
        var q = 1;
        function paint() {
            val.textContent = q;
        }
        if (minus)
            minus.addEventListener("click", function () {
                q = Math.max(1, q - 1);
                paint();
            });
        if (plus)
            plus.addEventListener("click", function () {
                q = Math.min(20, q + 1);
                paint();
            });
        if (add)
            add.addEventListener("click", function () {
                var item = {
                    id: add.dataset.id,
                    name: add.dataset.name,
                    price: parseFloat(add.dataset.price),
                    img: add.dataset.img,
                };
                if (window.__hearthAdd) window.__hearthAdd(item, q);
            });
    }

    /* ==================================================== boot */
    document.addEventListener("DOMContentLoaded", function () {
        initHeaderStuck();
        initMobileNav();
        initCart();
        initAddButtons();
        initWishlist();
        initFilters();
        initCountdown();
        initNewsletter();
        initReveal();
        initGallery();
        initVariants();
        initPdp();
    });
})();
