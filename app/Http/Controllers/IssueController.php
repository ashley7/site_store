<?php

namespace App\Http\Controllers;

use App\Issue;
use App\Item;
use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $issues = Issue::paginate(100);

        $items = Item::get();

        $stores = Store::get();

        $transaction_types = ['issued','lost','damaged'];

        $data = [
            'issues'=>$issues,
            'items'=>$items,
            'stores'=>$stores,
            'title'=>'Issue stock',
            'transaction_types'=>$transaction_types
        ];

        return view('stores.stock_issues')->with($data);
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
        ];

        $this->validate($request,$rules);

        $saveIssue = new Issue();

        $saveIssue->store_id = $request->store_id;

        $saveIssue->quantity = $request->quantity;

        $saveIssue->item_id = $request->item_id;

        $saveIssue->transaction_type = $request->transaction_type;

        $saveIssue->particulars = $request->particulars;

        $saveIssue->user_id = Auth::id();

        $saveIssue->save();

        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function show(Issue $issue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function edit($issue_id)
    {
        $issues = Issue::find($issue_id);

        $items = Item::get();

        $stores = Store::get();

        $transaction_types = ['issued','lost','damaged'];

        $data = [
            'issues'=>$issues,
            'items'=>$items,
            'stores'=>$stores,
            'title'=>'Edit Issue stock',
            'transaction_types'=>$transaction_types
        ];

        return view('stores.edit_stock_issues')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$issue_id)
    {
        
        $saveIssue = Issue::find($issue_id);

        $saveIssue->store_id = $request->store_id;

        $saveIssue->quantity = $request->quantity;

        $saveIssue->item_id = $request->item_id;

        $saveIssue->transaction_type = $request->transaction_type;

        $saveIssue->particulars = $request->particulars;

        $saveIssue->save();

        return redirect()->route('issue_stock.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Issue $issue)
    {
        //
    }
}
