<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function index(): View
    {
        return view('checkout');
    }

    public function review(Request $request): View|RedirectResponse
    {
        $validated = $this->validateOrder($request);

        $cart = json_decode($validated['cart_json'], true);

        if (!is_array($cart) || empty($cart)) {
            return redirect()->route('checkout')->with('error', 'Your cart is empty. Add some products first.');
        }

        $orderData = $this->prepareOrderData($validated['cart_json']);

        return view('checkout-confirm', [
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'],
            'delivery_address' => $validated['delivery_address'],
            'delivery_district' => $validated['delivery_district'],
            'customer_notes' => $validated['customer_notes'],
            'payment_method' => $validated['payment_method'],
            'cart_json' => $validated['cart_json'],
            'items' => $orderData['items'],
            'subtotal' => $orderData['subtotal'],
            'delivery_fee' => $orderData['delivery_fee'],
            'total' => $orderData['total'],
        ]);
    }

    public function confirm(Request $request): RedirectResponse
    {
        $validated = $this->validateOrder($request);

        $orderData = $this->prepareOrderData($validated['cart_json']);

        if ($orderData['items'] === []) {
            return redirect()->route('checkout')->with('error', 'Your cart is empty. Add some products first.');
        }

        $order = DB::transaction(function () use ($validated, $orderData) {
            $lastId = Order::max('id') ?? 0;
            $orderNumber = 'RFM-' . str_pad($lastId + 1, 6, '0', STR_PAD_LEFT);

            $order = Order::create([
                'order_number' => $orderNumber,
                'customer_name' => $validated['customer_name'],
                'customer_email' => $validated['customer_email'],
                'customer_phone' => $validated['customer_phone'],
                'delivery_address' => $validated['delivery_address'],
                'delivery_district' => $validated['delivery_district'],
                'customer_notes' => $validated['customer_notes'],
                'payment_method' => $validated['payment_method'],
                'payment_status' => 'unpaid',
                'order_status' => 'pending',
                'subtotal' => $orderData['subtotal'],
                'delivery_fee' => $orderData['delivery_fee'],
                'discount_amount' => 0,
                'total_amount' => $orderData['total'],
            ]);

            foreach ($orderData['items'] as $item) {
                $item['order_id'] = $order->id;
                OrderItem::create($item);
            }

            return $order;
        });

        return redirect()->route('checkout.success', $order)->with('clear_cart', true);
    }

    public function success(Order $order): View
    {
        return view('checkout-success', compact('order'));
    }

    private function validateOrder(Request $request): array
    {
        return $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'nullable|email|max:255',
            'customer_phone' => 'required|string|max:50',
            'delivery_address' => 'required|string|max:500',
            'delivery_district' => 'nullable|string|max:255',
            'customer_notes' => 'nullable|string|max:1000',
            'payment_method' => 'required|string|in:cash_on_delivery,mobile_money,bank_transfer',
            'cart_json' => 'required|string',
        ]);
    }

    private function prepareOrderData(string $cartJson): array
    {
        $cart = json_decode($cartJson, true);
        $subtotal = 0;
        $items = [];

        if (!is_array($cart)) {
            $cart = [];
        }

        foreach ($cart as $item) {
            $product = Product::find($item['id'] ?? null);
            $price = $item['price'] ?? ($product?->price ?? 0);
            $qty = max(1, (int) ($item['qty'] ?? 1));
            $lineTotal = $price * $qty;
            $subtotal += $lineTotal;

            $items[] = [
                'product_id' => $product?->id,
                'product_name' => $item['name'] ?? ($product?->name ?? 'Unknown'),
                'product_sku' => $product?->sku,
                'unit_price' => $price,
                'quantity' => $qty,
                'line_total' => $lineTotal,
                'img' => $item['img'] ?? null,
            ];
        }

        $deliveryFee = 0;
        $total = $subtotal + $deliveryFee;

        return [
            'items' => $items,
            'subtotal' => $subtotal,
            'delivery_fee' => $deliveryFee,
            'total' => $total,
        ];
    }
}
