<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Table;
use Illuminate\Http\Request;

class TablesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'Table';
        $data = Table::latest()->get();
        return view('tables.index', compact('page_title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Table Create';
        return view('tables.create-update', compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required'
        ]);

        $barcode = 'TBL' . time() . rand(1000, 9999).str_replace(' ', '', $request->name);

        Table::create([
            'name' => $request->name,
            'barcode' => $barcode,
            'status' => $request->status
        ]);

        return redirect()->route('tables.index')->with('success', 'Table created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_title = 'Table Edit';
        $data = Table::findOrFail($id);

        return view('tables.create-update', compact('page_title', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required'
        ]);

        $barcode = 'TBL' . time() . rand(1000, 9999).str_replace(' ', '', $request->name);
        $data = Table::findOrFail($id);

        $data->update([
            'name' => $request->name,
            'status' => $request->status
        ]);

        return redirect()->route('tables.index')->with('success', 'Table updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Table::findOrFail($id);
        $data->delete();
        return back()->with('toast_success', 'Tables Deleted Successfully');
    }

    public function printBarcode($id)
    {
        $data = Table::findOrFail($id);
        return view('tables.printBarcode', compact('data'));
    }
}
