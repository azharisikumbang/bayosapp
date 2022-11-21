<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;

class UserOrderController extends Controller
{
    public function index() : Response
    {
        // $orders = Order::factory(20)->create(['customer_id' => auth()->user()->id]);
        $orders = Order::latest()->paginate(10);

        return Inertia::render('User/Order/Index', [
            'orders' => $orders->toArray()
        ]);
    }

    public function show(Order $order) : Response
    {
        $order->load(['customer']);

        return Inertia::render('User/Order/Show', [
            'order' => $order->toArray()
        ]);
    }
}
