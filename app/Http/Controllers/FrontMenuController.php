<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\MenuOrder;
use App\Models\MenuOrderDetail;
use App\Models\Table;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class FrontMenuController extends Controller
{
    public function index()
    {
        return view('frontend.menu.index');
    }

    public function scanMenu(Request $request)
    {
        $qr_code = substr(strrchr($request->qr_code, '/'), 1);
        $data = Table::firstWhere('barcode', $qr_code);
        if(!$data)
            return response()->json(['status' => false, 'message' => 'QR Code not found'], 404);
        session()->put('table', json_encode($data).'-'.$data->barcode);
        return response()->json(['status' => true, 'message' => 'QR Code found', 'redirect' => "/menu/list/$qr_code"], 200);
    }

    public function listMenu($table)
    {
        $category = Category::select('id', 'name')
                            ->orderBy('name', 'asc')
                            ->get();
        $data = Table::where('barcode', $table)->firstOrFail();
        $code_table = $table;
        return view('frontend.menu.list_menu', compact('category', 'code_table'));
    }

    public function getMenu(Request $request)
    {
        $menus = Menu::with('category')
                        ->orderBy('title', 'asc')
                        ->filter($request)
                        ->get();

        foreach($menus as $item) {
            $item->price = str_replace('.','',$item->price);
        }
        return view('frontend.menu.getMenu', compact('menus'));
    }

    public function getDetailMenu(Request $request, $id)
    {

        $select = explode(',', $request->select);
        $menu = new Menu();

        if($request->select)
            $menu = $menu->select($select);

        $menu = $menu->find($id);
        if(!$menu)
            return response()->json(['message' => 'Menu not found'], 404);
        $menu->price = str_replace('.','',$menu->price);

        return response()->json($menu);
    }

    public function checkout(Request $request, $table)
    {
        $table = Table::firstWhere('barcode', $table);
        if(!$table)
            return response()->json(['status' => false, 'message' => 'QR Code not found'], 404);

        $data = json_decode($request->data);
        $menu = Menu::whereIn('id', array_column($data,'id'))->get();
        if(count($data) !== count($menu))
            return response()->json(['status' => false, 'message' => 'Item belum terpilih']);
        if($data < 1)
            return response()->json(['status' => false, 'message' => 'Item belum terpilih']);
        $validasi = Validator::make($data, [
            '*id' => 'required',
            '*price' => 'required',
            '*qty' => 'required',
        ]);
        if($validasi->fails())
            return response()->json([
                'status' => false,
                'message' => $validasi->errors()
            ], 405);

        $findData = [];
        foreach($data as $val) {
            $findData[$val->id] = $val;
        }
        $totalPrice = 0;
        $totalQty = 0;
        $serviceCharge = 0;
        $pb1 = 0;
        foreach($menu as $item) {
            $item->qty = $findData[$item->id]->qty ?? 0;
            $item->price_checkout =  str_replace('.','', $findData[$item->id]->price  ?? 0);
            $totalPrice += $item->qty * str_replace('.','', $item->price  ?? 0);
            $totalQty += $item->qty;
            $serviceCharge += ($item->price_checkout * $item->qty) * 0.05;
            $pb1 += ($item->price_checkout * $item->qty) * 0.10;
        }

        if($request->type == 'last') {
            $menu_order = MenuOrder::create([
                'tables_id' => $table->id,
                'price_total' => $totalPrice,
                'qty_total' => $totalQty,
                'status' => 1,
                'order_id' => 'ORD'.time().rand(1000, 9999),
                'total_service_charge' => $serviceCharge,
                'total_pb1' => $pb1
            ]);

            foreach($menu as $item) {
                MenuOrderDetail::create([
                    'menu_orders_id' => $menu_order->id,
                    'menus_id' => $item->id,
                    'qty' => $item->qty,
                    'price_total' => $item->price_checkout,
                    'notes' => $findData[$item->id]->notes ?? '',
                ]);
            }

            session()->put('table_data', $table);
            session()->remove('cart');

            return response()->json([
                'status' => true,
                'message' => 'Order berhasil dibuat'
            ]);
        }else
            session()->put('cart', json_encode($menu));

        return response()->json([
            'status' => true,
            'code_table' => $table
        ]);
    }

    public function checkoutGet(Request $request, $table)
    {
        $data = Table::where('barcode', $table)->firstOrFail();
        $code_table = $table;

        $data = [];
        if(session()->get('cart'))
            $data = json_decode(session()->get('cart')) ?? [];

        if(count($data) < 1)
            return redirect()->route('listMenu', $table);
        $totalQty = 0;
        $totalPrice = 0;
        $serviceCharge = 0;
        $pb1 = 0;
        foreach($data as $item) {
            $totalQty += $item->qty;
            $totalPrice += $item->price_checkout * $item->qty;
            $serviceCharge += ($item->price_checkout * $item->qty) * 0.05;
            $pb1 += ($item->price_checkout * $item->qty) * 0.10;
            $item->price = str_replace('.','', $item->price  ?? 0);
        }
        $totalAll = $totalPrice + $serviceCharge + $pb1;
        return view('frontend.menu.checkoutMenu', compact('data', 'totalQty', 'totalPrice', 'code_table', 'serviceCharge', 'pb1', 'totalAll'));
    }

    public function deleteCart(Request $request)
    {
        $data = json_decode(session()->get('cart'));
        foreach($data as $key => $item) {
            if($item->id == $request->id)
                unset($data[$key]);
        }
        session()->put('cart', $data);
        return $data;
    }

    public function doneCheckout(Request $request)
    {
        $navbar_false = true;
        if(!session()->get('table_data'))
            return redirect()->route('menu');
        $name_table = session()->get('table_data')->name;
        return view('frontend.menu.done', compact('navbar_false', 'name_table'));
    }

}
