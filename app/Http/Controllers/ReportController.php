<?php

namespace App\Http\Controllers;

use App\Issue;
use App\Item;
use App\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $items = Item::get();

        $data = [
            'items'=>$items,
            'title'=>'Stock reports'
        ];

        return view('reports.make_report')->with($data);
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
            'items'=>'required',
            'from_date'=>'required',
            'to_date'=>'required',
        ];

        $this->validate($request,$rules);

        $stock_records = Stock::whereIn('item_id',$request->items)->whereBetween('created_at',[$request->from_date,Carbon::parse($request->to_date)->addDay()])->get();

        $stock_issued = Issue::whereIn('item_id',$request->items)->whereBetween('created_at',[$request->from_date,Carbon::parse($request->to_date)->addDay()])->get();


        $data = [
            'stock_records'=>$stock_records,
            'stock_issues'=>$stock_issued,
            'title'=>'Report from '.$request->from_date." to ".$request->to_date,
        ];

        return view('stores.stock_details')->with($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
}
