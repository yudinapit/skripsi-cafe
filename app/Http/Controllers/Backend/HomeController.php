<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Reserve;
use App\Models\MenuOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index()
    {
        $page_title = 'Menu Order';
        $data = MenuOrder::with('tables')->latest()->get();
        return view('menu-order.index', compact('page_title','data'));
    }
}
