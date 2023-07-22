<?php

namespace App\Http\Controllers;

use App\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenditures = Expense::paginate(100);

        $data = [
            'expenditures'=>$expenditures,
            'title'=>'Expenditures'
        ];

        return view('expenses.list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title'=>'Get Expenditures report'
        ];

        return view('expenses.report')->with($data);
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
            'particluar'=>'required',
            'quantity'=>'required|numeric',
            'unit_price'=>'required|numeric',
        ];

        $this->validate($request,$rules);

        $saveExpense = new Expense();

        $saveExpense->particluar = $request->particluar;

        $saveExpense->qunatity = $request->quantity;

        $saveExpense->unit_price = $request->unit_price;

        $saveExpense->user_id = Auth::id();

        $saveExpense->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit($expense)
    {
        $expense = Expense::find($expense);

        $data = [
            'expense'=>$expense,
            'title'=>'Edit expense'
        ];

        return view('expenses.edit')->with($data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $expense)
    {
        $saveExpense = Expense::find($expense);

        $saveExpense->particluar = $request->particluar;

        $saveExpense->qunatity = $request->quantity;

        $saveExpense->unit_price = $request->unit_price;

        $saveExpense->save();

        return redirect('expenses');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        //
    }

    public function expense_reports(Request $request){

        $rules = [
            'from_date'=>'required',
            'to_date'=>'required',
        ];

        $this->validate($request,$rules);

        $expenditures = Expense::whereBetween('created_at',[$request->from_date,Carbon::parse($request->to_date)->addDay()])->paginate(1000);

        $data = [
            'expenditures'=>$expenditures,
            'title'=>'Expenditure reports'
        ];

        return view('expenses.list')->with($data);



    }
}
