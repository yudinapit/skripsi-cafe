<?php

namespace App\Http\Controllers;

use App\Models\MenuOrder;
use Illuminate\Http\Request;

class OrderMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'Menu Order';
        $data = MenuOrder::with('tables')->latest()->get();
        return view('menu-order.index', compact('page_title','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = MenuOrder::with('menuOrderDetail', 'menuOrderDetail.menu')->find($id);
        if(!$data)
            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan']);

        return view('menu-order.detailModal', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = MenuOrder::with('tables')->findOrFail($id);
        $status = '';
        if($request->payment_method) {
            $data->update([
                'payment_method' => $request->payment_method
            ]);

            return back();
        }

        if($request->selectInput == 4 || $request->selectInput == 5)
            $status = 'available';
        else
            $status = 'unavailable';

        if(isset($data->tables))
            $data->tables->update([
                'status' => $status
            ]);

        $data->update([
            'status' => $request->selectInput
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function print($id)
    {
        $data = MenuOrder::with('menuOrderDetail', 'menuOrderDetail.menu')->findOrFail($id);
        return view('menu-order.print', compact('data'));
    }
}
