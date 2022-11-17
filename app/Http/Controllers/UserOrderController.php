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
        $orders = Order::factory(10)->make();

        return Inertia::render('User/Order/Index', [
            'orders' => [
                'data' => $orders->toArray(),
                'prev_page_url' => true,
                'next_page_url' => true,
                'current_page' => 1,
                'total' => 10
            ]
        ]);
    }
}
