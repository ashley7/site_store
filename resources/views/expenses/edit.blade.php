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

                        <form action="{{route('expenses.update',$expense->id)}}" method="POST">
                            @csrf 
                            {{method_field('PATCH')}}

                            <label for="">Particular</label>
                            <input type="text" class="form-control" value="{{$expense->particluar}}" name="particluar">

                            <label for="quantity">Quantity</label>
                            <input type="number" step="any" value="{{$expense->qunatity}}" class="form-control" name="quantity">

                            <label for="unit">Unit price</label>
                            <input type="text" class="form-control" value="{{$expense->unit_price}}" name="unit_price">

                            <hr>
                            <button type="submit">Save changes</button>
                        </form>       
    
                    </div>                                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
