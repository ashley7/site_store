<?php

namespace App\Http\Controllers;

use App\Item;
use App\Stock;
use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = Stock::paginate(100);

        $items = Item::orderBy('name','ASC')->get();

        $stores = Store::get();

        $data = [
            'stock_records'=>$stocks,
            'stores'=>$stores,
            'items'=>$items,
            'title'=>'Stock records'
        ];

        return view('stores.stock_records')->with($data);


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
            'item_id'=>'required',
            'store_id'=>'required',
            'quantity'=>'required',
            'unit_price'=>'required',
        ];

        $this->validate($request,$rules);

        $saveStock = new Stock();

        $saveStock->user_id = Auth::id();

        $saveStock->item_id = $request->item_id;

        $saveStock->store_id = $request->store_id;

        $saveStock->quantity = $request->quantity;

        $saveStock->unit_price = $request->unit_price;

        $saveStock->supplier = $request->supplier;

        $saveStock->particulars = $request->particulars;

        $saveStock->save();

        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        $items = Item::orderBy('name','ASC')->get();

        $stores = Store::get();

        $data = [
            'stock_record'=>$stock,
            'stores'=>$stores,
            'items'=>$items,
            'title'=>'Stock records'
        ];

        return view('stores.edit_stock_records')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        $saveStock = $stock;

        $saveStock->item_id = $request->item_id;

        $saveStock->store_id = $request->store_id;

        $saveStock->quantity = $request->quantity;

        $saveStock->unit_price = $request->unit_price;

        $saveStock->supplier = $request->supplier;

        $saveStock->particulars = $request->particulars;

        $saveStock->save();

        return redirect()->route('stock.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        //
    }
}
