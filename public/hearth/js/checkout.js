/* ==================================================== checkout page cart & form */
(function () {
    "use strict";

    var KEY = "rosefoam-cart-v1";

    function money(n) {
        return (
            "UGX " +
            Number(n).toLocaleString("en-US", {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0,
            })
        );
    }

    function readCart() {
        if (window.RosefoamCart) return window.RosefoamCart.items();
        try {
            var raw = localStorage.getItem(KEY);
            var items = raw ? JSON.parse(raw) : [];
            return Array.isArray(items) ? items : [];
        } catch (e) {
            return [];
        }
    }

    function saveCart(items) {
        try {
            localStorage.setItem(KEY, JSON.stringify(items));
        } catch (e) {}
    }

    function updateCart(items) {
        saveCart(items);
        if (window.RosefoamCart) {
            window.RosefoamCart.render();
        }
    }

    function totalFor(items) {
        return items.reduce(function (sum, it) {
            return sum + (it.qty || 1) * (it.price || 0);
        }, 0);
    }

    function renderCheckoutCart() {
        var items = readCart();
        var tbody = document.getElementById("checkoutCartBody");
        var emptyEl = document.getElementById("checkoutCartEmpty");
        var tableEl = document.getElementById("checkoutCartTable");
        var subtotalEl = document.getElementById("checkoutSubtotal");
        var totalEl = document.getElementById("checkoutTotal");
        var cartJson = document.getElementById("cartJson");
        var placeBtn = document.getElementById("placeOrderBtn");

        if (!tbody) return;

        if (items.length === 0) {
            if (emptyEl) emptyEl.style.display = "block";
            if (tableEl) tableEl.style.display = "none";
            if (subtotalEl) subtotalEl.textContent = money(0);
            if (totalEl) totalEl.textContent = money(0);
            if (cartJson) cartJson.value = "";
            if (placeBtn) placeBtn.disabled = true;
            return;
        }

        if (emptyEl) emptyEl.style.display = "none";
        if (tableEl) tableEl.style.display = "block";
        if (placeBtn) placeBtn.disabled = false;

        tbody.innerHTML = "";
        items.forEach(function (it) {
            var row = document.createElement("tr");
            row.setAttribute("data-id", it.id);
            row.innerHTML =
                '<td class="checkout-item">' +
                '<img src="' +
                (it.img || "") +
                '" alt="' +
                (it.name || "") +
                '">' +
                "<span>" +
                (it.name || "") +
                "</span>" +
                "</td>" +
                '<td class="checkout-price">' +
                money(it.price || 0) +
                "</td>" +
                '<td class="checkout-qty">' +
                '<div class="qty qty--inline" aria-label="Quantity">' +
                '<button type="button" data-act="dec" aria-label="Decrease quantity">−</button>' +
                '<input type="number" value="' +
                (it.qty || 1) +
                '" min="1" data-act="input" aria-label="Quantity">' +
                '<button type="button" data-act="inc" aria-label="Increase quantity">+</button>' +
                "</div>" +
                "</td>" +
                '<td class="checkout-line">' +
                money((it.qty || 1) * (it.price || 0)) +
                "</td>" +
                '<td class="checkout-remove">' +
                '<button type="button" data-act="rm" class="btn-remove" aria-label="Remove ' +
                (it.name || "") +
                '">' +
                '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" aria-hidden="true"><path d="M6 6l12 12M18 6 6 18"/></svg>' +
                "</button>" +
                "</td>";
            tbody.appendChild(row);
        });

        var subtotal = totalFor(items);
        if (subtotalEl) subtotalEl.textContent = money(subtotal);
        if (totalEl) totalEl.textContent = money(subtotal);
        if (cartJson) cartJson.value = JSON.stringify(items);
    }

    function findIndex(items, id) {
        for (var i = 0; i < items.length; i++) {
            if (String(items[i].id) === String(id)) return i;
        }
        return -1;
    }

    function handleCheckoutClick(e) {
        var btn = e.target.closest("button[data-act], input[data-act]");
        if (!btn) return;
        var row = btn.closest("tr[data-id]");
        if (!row) return;
        var id = row.getAttribute("data-id");
        var items = readCart();
        var idx = findIndex(items, id);
        if (idx === -1) return;

        var act = btn.getAttribute("data-act");
        if (act === "inc") {
            items[idx].qty += 1;
        } else if (act === "dec") {
            items[idx].qty = Math.max(0, items[idx].qty - 1);
            if (items[idx].qty <= 0) items.splice(idx, 1);
        } else if (act === "rm") {
            items.splice(idx, 1);
        } else if (act === "input") {
            var val = parseInt(btn.value, 10);
            if (isNaN(val) || val < 1) {
                items.splice(idx, 1);
            } else {
                items[idx].qty = val;
            }
        }
        updateCart(items);
        renderCheckoutCart();
    }

    var tbody = document.getElementById("checkoutCartBody");
    if (tbody) {
        tbody.addEventListener("click", handleCheckoutClick);
        tbody.addEventListener("change", handleCheckoutClick);
    }

    var form = document.getElementById("checkoutForm");
    if (form) {
        form.addEventListener("submit", function (e) {
            var items = readCart();
            if (items.length === 0) {
                e.preventDefault();
                alert(
                    "Your cart is empty. Add some products before placing an order.",
                );
                return;
            }
            document.getElementById("cartJson").value = JSON.stringify(items);
        });
    }

    renderCheckoutCart();
})();
