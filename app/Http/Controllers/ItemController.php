<?php

namespace App\Http\Controllers;

use App\Item;
use App\Stock;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::get();

        $data = [
            'items'=>$items,
            'title'=>'Stock items'
        ];

        return view('stores.items')->with($data);
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
        $rules = [
            'name'=>'required',
            'unit'=>'required'
        ];

        $this->validate($request,$rules);

        $saveItem = new Item();

        $saveItem->name = $request->name;

        $saveItem->unit = $request->unit;

        $saveItem->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        $stock_records = $item->stocks;

        $stock_issued = $item->issues;

        $data = [
            'stock_records'=>$stock_records,
            'stock_issues'=>$stock_issued,
            'title'=>'Stock records for '.$item->name." ".$item->unit,
        ];

        return view('stores.stock_details')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $data = [
            'item'=>$item,
            'title'=>'Item'
        ];

        return view('stores.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $item)
    {
       
        $saveItem = Item::find($item);

        $saveItem->name = $request->name;

        $saveItem->unit = $request->unit;

        $saveItem->save();

        return redirect()->route('items.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }
}
