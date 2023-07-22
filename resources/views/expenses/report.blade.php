@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <h2>{{$title}}</h2>
            <hr>


            <div class="card">

                <div class="card-body">

                <div class="table-responsive">

                    <form action="{{url('expense_reports')}}" method="POST">
                        @csrf 

                        <label for="from">From</label>
                        <input type="date" name="from_date" id="from_date" class="form-control col-md-6">
                         

                        <label for="to">To</label>
                        <input type="date" name="to_date" id="to_date" class="form-control col-md-6">
                        
                        <hr>
                        <button type="submit">Generate</button>


                    </form>
                     
                </div>
                                     
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
