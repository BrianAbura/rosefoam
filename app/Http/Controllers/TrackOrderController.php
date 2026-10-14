<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TrackOrderController extends Controller
{
    public function index(Request $request): View
    {
        $orderNumber = $request->input('order_number');
        $order = null;

        if ($orderNumber) {
            $order = Order::with('items')
                ->where('order_number', trim($orderNumber))
                ->first();
        }

        return view('track-order', [
            'order' => $order,
            'orderNumber' => $orderNumber,
            'searched' => filled($orderNumber),
        ]);
    }
}
